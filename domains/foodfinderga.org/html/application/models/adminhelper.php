<?php

/*
		Author : Suresh K
		Description : This function involves all admin functionalities
		Last Modified : 22/04/2014
*/

class Adminhelper extends CI_Model
{
    function _construct()
    {
        // Call the Model constructor
        parent::_construct();
    }

    public function getProvider($id)
    {
        $results = mysql_query("Select * from ff_provider WHERE provider_id = $id");

        $list = array();
        while ($row = mysql_fetch_assoc($results)) {
            $list[] = $row;
        }
        return $list;
    }

    public function getSchool($id)
    {
        $results = mysql_query("Select * from ff_school WHERE school_id = $id");

        $list = array();
        while ($row = mysql_fetch_assoc($results)) {
            $list[] = $row;
        }
        return $list;

    }

    public function allstatelist()
    {
        $results = mysql_query("Select * from ff_states");
        $list = array();
        while ($row = mysql_fetch_assoc($results)) {
            $list[] = $row;
        }
        return $list;
    }

    public function getCityByStateSelectElement($statecode, $location = null)
    {

        $statelist = "";
        $query = mysql_query("Select * from ff_cities where state_code='$statecode'");
        if (isset($location) && !is_null($location)) {
            $statelist .= '<select id="city" name="city"><option value="">Select city</option>';
            while ($row = mysql_fetch_assoc($query)):
                $statelist .= ($location[0]['city'] == $row['city']) ? '<option value="' . $row['city'] . '" selected>' . $row['city'] . '</option>' : '<option value="' . $row['city'] . '">' . $row['city'] . '</option>';
            endwhile;
            $statelist .= "</select>";
        } else {
            $statelist .= '<select id="city" name="city"><option value="">Select city</option>';
            while ($row = mysql_fetch_assoc($query)):
                $statelist .= '<option value="' . $row['city'] . '">' . $row['city'] . '</option>';
            endwhile;
            $statelist .= "</select>";
        }

        return $statelist;
    }

    public function getcitylist($statecode)
    {
        $statelist = "";
        $query = mysql_query("Select * from ff_cities where state_code='$statecode'");
        $statelist .= '<select id="city" name="city">
		<option value="">Select city</option>';
        while ($row = mysql_fetch_assoc($query)) {
            $statelist .= '<option value="' . $row['city'] . '">' . $row['city'] . '</option>';
        }
        $statelist .= "</select>";
        echo $statelist;
    }

    function check_user($email, $password)
    {
        if ($email == '' || $password == "")
            return false;
        $r = mysql_query("SELECT * FROM ff_admin WHERE email='{$email}' and password='{$password}'");
        if (mysql_num_rows($r) == 0)
            return false;
        return mysql_fetch_assoc($r);
    }

    function addschool($arr_data)
    {
        $data = $arr_data;
        unset($data['submit']);

        $schooladdress2 = $data['schooladdress2'];
        if ($schooladdress2 != "") {
            $address = $data['schooladdress1'] . ',' . $data['schooladdress2'] . ',' . $data['city'] . ',' . $data['state'] . ',' . $data['county'] . ',' . $data['zipcode'];
        } else {
            $address = $data['schooladdress1'] . ',' . $data['city'] . ',' . $data['state'] . ',' . $data['county'] . ',' . $data['zipcode'];
        }

        // Google HQ
        $prepAddr = str_replace(' ', '+', $address);
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false');
        $output = json_decode($geocode);

        if ($output->status == 'ZERO_RESULTS') {
            $ErrorMessage = 1;
        } elseif ($output->status == 'OVER_QUERY_LIMIT') {
            $ErrorMessage = 2;
        } else {
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;
            $school_name = $data['schoolname'];
            $insert = array('school_name' => $school_name, 'school_address1' => $data['schooladdress1'], 'school_address2' => $data['schooladdress2'], 'city' => $data['city'], 'county' => $data['county'], 'state' => $data['state'], 'zipcode' => $data['zipcode'], 'phonenumber' => $data['phonenumber'], 'latitude' => $latitude, 'longitude' => $longitude);
            $this->db->insert('ff_school', $insert);
            $ErrorMessage = 3;
        }

        return $ErrorMessage;
    }

    public function checkschooladdress($data)
    {
        $school_address1 = $data['schooladdress1'];
        $school_address2 = $data['schooladdress2'];
        $city = $data['city'];
        $state = $data['state'];
        $county = $data['county'];
        $zipcode = $data['zipcode'];
        $r = mysql_query("SELECT * FROM ff_school WHERE school_address1='$school_address1' and school_address2='$school_address2' and city='$city' and state='$state' and county='$county' and zipcode='$zipcode'");
        if (mysql_num_rows($r) == 0) {
            return "4";
        } else {
            return "5";
        }
    }

    public function checkschooladdress1($id, $data)
    {
        $school_address1 = $data['schooladdress1'];
        $school_address2 = $data['schooladdress2'];
        $city = $data['city'];
        $state = $data['state'];
        $county = $data['county'];
        $zipcode = $data['zipcode'];
        $r = mysql_query("SELECT * FROM ff_school WHERE school_address1='$school_address1' and school_address2='$school_address2' and city='$city' and state='$state' and county='$county' and zipcode='$zipcode' and school_id='{$id}'");
        if (mysql_num_rows($r) == 0) {
            $r = mysql_query("SELECT * FROM ff_school WHERE school_address1='$school_address1' and school_address2='$school_address2' and city='$city' and state='$state' and county='$county' and zipcode='$zipcode'");
            if (mysql_num_rows($r) == 0) {
                return "5";
            } else {
                return "4";
            }
        } else {
            return "5";
        }
    }

    public function checkprovideraddress($data)
    {
        $streetaddress1 = $data['streetaddress1'];
        $streetaddress2 = $data['streetaddress2'];
        $city = $data['city'];
        $state = $data['state'];
        $county = $data['county'];
        $zipcode = $data['zipcode'];
        $r = mysql_query("SELECT * FROM ff_provider WHERE streetaddress1='$streetaddress1' and streetaddress2='$streetaddress2' and city='$city' and state='$state' and county='$county' and zipcode='$zipcode'");
        if (mysql_num_rows($r) == 0) {
            return "4";
        } else {
            return "5";
        }
    }

    public function checkprovideraddress1($id, $data)
    {
        $streetaddress1 = $data['streetaddress1'];
        $streetaddress2 = $data['streetaddress2'];
        $city = $data['city'];
        $state = $data['state'];
        $county = $data['county'];
        $zipcode = $data['zipcode'];
        $r = mysql_query("SELECT * FROM ff_provider WHERE streetaddress1='$streetaddress1' and streetaddress2='$streetaddress2' and city='$city' and state='$state' and county='$county' and zipcode='$zipcode' and provider_id='{$id}'");
        if (mysql_num_rows($r) == 0) {
            $r = mysql_query("SELECT * FROM ff_provider WHERE streetaddress1='$streetaddress1' and streetaddress2='$streetaddress2' and city='$city' and state='$state' and county='$county' and zipcode='$zipcode'");
            if (mysql_num_rows($r) == 0) {
                return "5";
            } else {
                return "4";
            }
        } else {
            return "5";
        }
    }

    public function manageschool()
    {
        $query = "SELECT * from ff_school order by school_id DESC";
        $results = mysql_query($query);
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row;
        endwhile;
        return $list;
    }

    function deleteschool($school_id)
    {
        $this->db->delete('ff_school', array('school_id' => $school_id));
        return "delete";
    }

    public function load_single_school($id)
    {
        $query = $this->db->get_where('ff_school', array('school_id' => $id));
        $list = array();
        foreach ($query->result() as $row) {
            $list[] = $row;
        }
        return $list;
    }

    public function updateschool($id, $data)
    {
        $schooladdress2 = $data['schooladdress2'];
        if ($schooladdress2 != "") {
            $address = $data['schooladdress1'] . ',' . $data['schooladdress2'] . ',' . $data['city'] . ',' . $data['state'] . ',' . $data['county'] . ',' . $data['zipcode'];
        } else {
            $address = $data['schooladdress1'] . ',' . $data['city'] . ',' . $data['state'] . ',' . $data['county'] . ',' . $data['zipcode'];
        }

        // Google HQ
        $prepAddr = str_replace(' ', '+', $address);
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false');
        $output = json_decode($geocode);

        if ($output->status == 'ZERO_RESULTS') {
            $ErrorMessage = 1;
        } elseif ($output->status == 'OVER_QUERY_LIMIT') {
            $ErrorMessage = 2;
        } else {
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;
            $insert = array('school_name' => $data['schoolname'], 'school_address1' => $data['schooladdress1'], 'school_address2' => $data['schooladdress2'], 'city' => $data['city'], 'county' => $data['county'], 'state' => $data['state'], 'zipcode' => $data['zipcode'], 'phonenumber' => $data['phonenumber'], 'latitude' => $latitude, 'longitude' => $longitude);
            $res = $this->db->update('ff_school', $insert, "school_id = '{$id}'");
            $ErrorMessage = 3;
        }
        return $ErrorMessage;
    }

    function checkchangepassword($aid, $password)
    {
        if ($aid == '' || $password == "") {
            return false;
        }
        $r = mysql_query("SELECT * FROM ff_admin WHERE aid='$aid' and password='$password'");
        if (mysql_num_rows($r) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function changepassword($aid, $new_pass)
    {
        $data = array('password' => $new_pass,);
        $r = mysql_query("update ff_admin set password='$new_pass' WHERE aid='$aid'");
        return true;
    }

    function allschools()
    {
        $results = mysql_query("SELECT school_id, school_name FROM ff_school order by school_name asc");
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row;
        endwhile;
        return $list;
    }

    function addprovider($arr_data)
    {
        $data = $arr_data;
        unset($data['submit']);

        $streetaddress2 = $data['streetaddress2'];
        if ($streetaddress2 != "") {
            $address = $data['streetaddress1'] . ',' . $data['streetaddress2'] . ',' . $data['city'] . ',' . $data['state'] . ',' . $data['county'] . ',' . $data['zipcode'];
        } else {
            $address = $data['streetaddress1'] . ',' . $data['city'] . ',' . $data['state'] . ',' . $data['county'] . ',' . $data['zipcode'];
        }

        // Google HQ
        $prepAddr = str_replace(' ', '+', $address);
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false');
        $output = json_decode($geocode);

        if ($output->status == 'ZERO_RESULTS') {
            $ErrorMessage = 1;
        } elseif ($output->status == 'OVER_QUERY_LIMIT') {
            $ErrorMessage = 2;
        } else {
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;

            $insert = array('providername' => $data['providername'], 'streetaddress1' => $data['streetaddress1'], 'streetaddress2' => $data['streetaddress2'], 'city' => $data['city'], 'county' => $data['county'], 'state' => $data['state'], 'zipcode' => $data['zipcode'], 'phonenumber' => $data['phonenumber'], 'url' => $data['url'], 'email' => $data['pemail'], 'contactperson' => $data['contactperson'], 'operatingdays' => $data['operatingdays'], 'operatinghours' => $data['operatinghours'], 'servicearea' => $data['servicearea'], 'languages' => $data['languages'], 'services1' => $data['services1'], 'services2' => $data['services2'], 'services3' => $data['services3'], 'latitude' => $latitude, 'longitude' => $longitude);
            $this->db->insert('ff_provider', $insert);
            $provider_id = $this->db->insert_id();

            try {
                $this->upsertherokuprovider($provider_id, $data, $latitude, $longitude);
            } catch (PDOException $e) {
                //NOP
            }

            $ErrorMessage = 3;
        }
        return $ErrorMessage;
    }

    public function manageprovider()
    {
        $query = "SELECT * from ff_provider order by provider_id DESC";
        $results = mysql_query($query);
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row;
        endwhile;
        return $list;
    }

    function deleteprovider($provider_id)
    {
        $this->db->delete('ff_provider', array('provider_id' => $provider_id));
        try {
            $this->deleteherokuprovider($provider_id);
        } catch (PDOException $e) {
            //NOP
        }
        return "delete";
    }

    public function load_single_provider($id)
    {
        $query = $this->db->get_where('ff_provider', array('provider_id' => $id));
        $list = array();
        foreach ($query->result() as $row) {
            $list[] = $row;
        }
        return $list;
    }

    public function updateprovider($id, $data)
    {
        $streetaddress2 = $data['streetaddress2'];
        if ($streetaddress2 != "") {
            $address = $data['streetaddress1'] . ',' . $data['streetaddress2'] . ',' . $data['city'] . ',' . $data['state'] . ',' . $data['county'] . ',' . $data['zipcode'];
        } else {
            $address = $data['streetaddress1'] . ',' . $data['city'] . ',' . $data['state'] . ',' . $data['county'] . ',' . $data['zipcode'];
        }

        // Google HQ
        $prepAddr = str_replace(' ', '+', $address);
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false');
        $output = json_decode($geocode);

        if ($output->status == 'ZERO_RESULTS') {
            $ErrorMessage = 1;
        } elseif ($output->status == 'OVER_QUERY_LIMIT') {
            $ErrorMessage = 2;
        } else {
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;

            $insert = array('providername' => $data['providername'], 'streetaddress1' => $data['streetaddress1'], 'streetaddress2' => $data['streetaddress2'], 'city' => $data['city'], 'county' => $data['county'], 'state' => $data['state'], 'zipcode' => $data['zipcode'], 'phonenumber' => $data['phonenumber'],
                'url' => $data['url'], 'email' => $data['pemail'], 'contactperson' => $data['contactperson'], 'operatingdays' => $data['operatingdays'], 'operatinghours' => $data['operatinghours'], 'servicearea' => $data['servicearea'], 'languages' => $data['languages'],
                'services1' => $data['services1'], 'services2' => $data['services2'], 'services3' => $data['services3'], 'latitude' => $latitude, 'longitude' => $longitude);
            $res = $this->db->update('ff_provider', $insert, "provider_id = '{$id}'");

            $provider_id = $id;

            try {
                $this->upsertherokuprovider($id, $data, $latitude, $longitude);
            } catch (PDOException $e) {
                //NOP
            }

            $ErrorMessage = 3;
        }
        return $ErrorMessage;
    }

    private function upsertherokuprovider($id, $data, $latitude, $longitude) {
        $heroku_db = $this->herokudb();

        $insert = "INSERT INTO ff_provider (provider_id, providername, streetaddress1, streetaddress2, city, county, state, zipcode, phonenumber, url, email, contactperson, operatingdays, operatinghours, servicearea, languages, services1, services2, services3, latitude, longitude) 
                       SELECT $id, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                       WHERE NOT EXISTS (SELECT * FROM ff_provider WHERE provider_id=$id)";
        $update = "UPDATE ff_provider 
                       SET providername=?, streetaddress1=?, streetaddress2=?, city=?, county=?, state=?, zipcode=?, phonenumber=?, url=?, email=?, contactperson=?, operatingdays=?, operatinghours=?, servicearea=?, languages=?, services1=?, services2=?, services3=?, latitude=?, longitude=?
                       WHERE provider_id=$id";

        $bind_values = array($data['providername'], $data['streetaddress1'], $data['streetaddress2'], $data['city'], $data['county'], $data['state'], $data['zipcode'], $data['phonenumber'],
            $data['url'], $data['pemail'], $data['contactperson'], $data['operatingdays'], $data['operatinghours'], $data['servicearea'], $data['languages'],
            $data['services1'], $data['services2'], $data['services3'], $latitude, $longitude);

        $insert_sth = $heroku_db->prepare($insert);
        $update_sth = $heroku_db->prepare($update);

        $update_sth->execute($bind_values);
        $insert_sth->execute($bind_values);

        $heroku_db = null;
    }

    private function deleteherokuprovider($id) {
        $heroku_db = $this->herokudb();

        $delete = "DELETE FROM ff_provider WHERE provider_id=?";

        $bind_values = array($id);

        $delete_sth = $heroku_db->prepare($delete);

        $delete_sth->execute($bind_values);

        $heroku_db = null;
    }

    private function herokudb()
    {
        $heroku_dbname = getenv('HTTP_HEROKU_DBNAME');
        $heroku_dbhost = getenv('HTTP_HEROKU_DBHOST');
        $heroku_dbuser = getenv('HTTP_HEROKU_DBUSER');
        $heroku_dbpass = getenv('HTTP_HEROKU_DBPASS');
        $heroku_db = new PDO("pgsql:dbname=$heroku_dbname;host=$heroku_dbhost;user=$heroku_dbuser;password=$heroku_dbpass");

        return $heroku_db;
    }

}

?>
