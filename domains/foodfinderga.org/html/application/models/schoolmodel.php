<?php

/*
		Author : Suresh K
		Description : This function involves all admin functionalities
		Last Modified : 22/04/2014
*/

class Schoolmodel extends CI_Model
{
    function _construct()
    {
        parent::_construct();
    }

    function searchschool($data)
    {
        unset($data['submit']);
        $schooladdress = $data['schooladdress'];
        $results = mysql_query("SELECT * FROM ff_school WHERE school_name LIKE '%$schooladdress%'");
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row;
        endwhile;
        return $list;
    }

    function singleproviderdetails($providerid)
    {
        $results = mysql_query("SELECT * FROM ff_provider WHERE provider_id='$providerid'");
        $list = array();
        while ($row = mysql_fetch_assoc($results)) {
            $list[] = $row;
        }
        return $list;
    }

    function searchhome($lat, $lng, $rad)
    {

        $results = mysql_query("SELECT * , 3956 *2 * ASIN( SQRT( POWER( SIN( ('$lat' - abs( dest.latitude ) ) * pi( ) /180 /2 ) , 2 ) + COS( '$lat' * pi( ) /180 ) * COS( abs( dest.latitude ) * pi( ) /180 ) * POWER( SIN( ('$lng' - dest.longitude) * pi( ) /180 /2 ) , 2 ) )) AS distance FROM ff_provider dest HAVING distance < '$rad'");
        $list = array();
        while ($row = mysql_fetch_assoc($results)) {
            $list[] = $row;
        }
        return $list;
    }

    function allproviders($lat, $lng)
    {

        $results = mysql_query("SELECT * , 3956 *2 * ASIN( SQRT( POWER( SIN( ('$lat' - abs( dest.latitude ) ) * pi( ) /180 /2 ) , 2 ) + COS( '$lat' * pi( ) /180 ) * COS( abs( dest.latitude ) * pi( ) /180 ) * POWER( SIN( ('$lng' - dest.longitude) * pi( ) /180 /2 ) , 2 ) )) AS distance FROM ff_provider dest HAVING distance < 7");
        $list = array();
        while ($row = mysql_fetch_assoc($results)) {
            $list[] = $row;
        }
        return $list;
    }

    function search_providermap($providerid)
    {
        $results = mysql_query("SELECT provider_id, providername, latitude, longitude FROM ff_provider WHERE provider_id = '$providerid'");
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row;
        endwhile;
        return $list;

    }

    function get_data($q)
    {
        $results = mysql_query("SELECT school_name FROM ff_school WHERE school_name LIKE '%$q%'");

        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row['school_name'];
        endwhile;
        echo json_encode($list);

    }

    function list_schooladdress($schooladdress)
    {
        $row = array();
        $this->db->select('*');
        $this->db->where('school_name', $schooladdress);
        $query = $this->db->get('ff_school');
        if ($query->num_rows() > 0 && $query->num_rows() == 1) {
            $row = $query->result_Array();
            return $row;
        } else {
            return false;
        }

    }
}

?>
