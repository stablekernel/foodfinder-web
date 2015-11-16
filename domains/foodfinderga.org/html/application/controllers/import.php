<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->database();
        $this->load->library('curl');
    }

    public function index()
    {
        $this->load->view('import', array('error' => ' '));
    }

    public function providers()
    {
        $data = ($_FILES['import_csv']);
        $temp_filename = $data['tmp_name'];
        $file_resource = fopen($temp_filename, 'r');
        $table = [];

        while (($row = fgetcsv($file_resource)) !== false) {
            $table[] = $row;
        }

        $properties = $table[0];
        array_shift($table);

        $data = $this->formatProviderObjects($properties, $table);

        if ($this->uploadProvidersToDB($data)) die('Providers successfully uploaded.');
        die('Oops there was an error uploading the CSV.');
    }

    public function schools()
    {
        $this->load->view('import-schools', array('error' => ' '));
    }

    public function importSchools()
    {
        $data = ($_FILES['import_csv']);
        $temp_filename = $data['tmp_name'];
        $file_resource = fopen($temp_filename, 'r');
        $table = [];

        while (($row = fgetcsv($file_resource)) !== false) {
            $table[] = $row;
        }
        $properties = $table[0];

        $data = $this->formatSchoolObjects($properties, $table);

        if ($this->uploadSchoolsToDB($data)) die('Schools successfully uploaded.');
        die('Oops there was an error uploading the CSV.');
    }

    public function uploadProvidersToDB($data)
    {
        $success = false;

        foreach ($data as $row):
            //$this->dd($row);
            $SCHOOL_ID = $row->SCHOOL_ID;
            $SCHOOL_NAME = $row->SCHOOL_NAME;
            $SCHOOL_ADDRESS = $row->SCHOOL_ADDRESS;
            $SCHOOL_CITY = $row->SCHOOL_CITY;
            $STATE = $row->STATE;
            $COUNTY = $row->COUNTY;
            $SCHOOL_ZIP = $row->SCHOOL_ZIP;
            $SCHOOL_PHONE = $row->SCHOOL_PHONE;

            $sql = "INSERT INTO ff_provider (providername, streetaddress1, city, state, county, zipcode, phonenumber)
			VALUES ("
                . $this->db->escape($SCHOOL_NAME) . ","
                . $this->db->escape($SCHOOL_ADDRESS) . ","
                . $this->db->escape($SCHOOL_CITY) . ","
                . $this->db->escape($STATE) . ","
                . $this->db->escape($COUNTY) . ","
                . $this->db->escape($SCHOOL_ZIP) . ","
                . $this->db->escape($SCHOOL_PHONE) . ")";

            $this->db->query($sql);
        endforeach;

        if ($this->db->affected_rows() > 0) $success = TRUE;
        return $success;
    }

    public function uploadSchoolsToDB($data)
    {
        $success = false;

        foreach ($data as $row):
            //$this->dd($row);
            $SCHOOL_ID = $row->SCHOOL_ID;
            $SCHOOL_NAME = $row->SCHOOL_NAME;
            $SCHOOL_ADDRESS = $row->SCHOOL_ADDRESS;
            $SCHOOL_CITY = $row->SCHOOL_CITY;
            $STATE = $row->STATE;
            $COUNTY = $row->COUNTY;
            $SCHOOL_ZIP = $row->SCHOOL_ZIP;
            $SCHOOL_PHONE = $row->SCHOOL_PHONE;

            $sql = "INSERT INTO ff_school (school_name, school_address1, city, state, county, zipcode, phonenumber)
			VALUES ("
                . $this->db->escape($SCHOOL_NAME) . ","
                . $this->db->escape($SCHOOL_ADDRESS) . ","
                . $this->db->escape($SCHOOL_CITY) . ","
                . $this->db->escape($STATE) . ","
                . $this->db->escape($COUNTY) . ","
                . $this->db->escape($SCHOOL_ZIP) . ","
                . $this->db->escape($SCHOOL_PHONE) . ")";

            $this->db->query($sql);
        endforeach;

        if ($this->db->affected_rows() > 0) $success = TRUE;
        return $success;
    }

    public function formatProviderObjects($properties, $table)
    {
        $data = [];
        $count = count($properties);

        foreach ($table as $idx => $row):
            if (count($row) !== $count) die('error with the csv file on row: ' . ($idx + 1));

            $provider = [];
            $provider['SCHOOL_ID'] = $row[0];
            $provider['SCHOOL_NAME'] = $row[1];
            $provider['SCHOOL_ADDRESS'] = $row[2];
            $provider['SCHOOL_CITY'] = $row[3];
            $provider['STATE'] = $row[4];
            $provider['COUNTY'] = $row[5];
            $provider['SCHOOL_ZIP'] = $row[6];
            $provider['SCHOOL_PHONE'] = $row[7];

            $data[] = (object)$provider;
        endforeach;

        return $data;
    }


    public function formatSchoolObjects($properties, $table)
    {
        $data = [];
        $count = count($properties);

        foreach ($table as $idx => $row):
            if (count($row) !== $count) die('error with the csv file on row: ' . ($idx + 1));

            $provider = [];
            $provider['SCHOOL_ID'] = $row[0];
            $provider['SCHOOL_NAME'] = $row[1];
            $provider['SCHOOL_ADDRESS'] = $row[2];
            $provider['SCHOOL_CITY'] = $row[3];
            $provider['STATE'] = $row[4];
            $provider['COUNTY'] = $row[5];
            $provider['SCHOOL_ZIP'] = $row[6];
            $provider['SCHOOL_PHONE'] = $row[7];

            $data[] = (object)$provider;
        endforeach;

        return $data;
    }

    /**
     * Grabs all the providers that have a blank latitude or longitude
     */
    public function pullProvidersWithoutGeo()
    {
        $results = array();
        $sql = "SELECT * FROM ff_provider WHERE latitude = '' or longitude = ''";
        $query = $this->db->query($sql);

        foreach ($query->result() as $result):
            array_push($results, $result);
        endforeach;

        return $results;
    }

    public function geodata()
    {
        $toUpdate = FALSE;
        if (array_key_exists('update', $_GET) && strlen($_GET['update']) > 0) $toUpdate = TRUE;

        if (!$toUpdate) {
            $this->load->view('geodata', array('error' => ' '));
        } else {
            $providers = $this->pullProvidersWithoutGeo();
            $decoratedProviders = $this->populateGeoDataPerProvider($providers);
            $this->dd($decoratedProviders);
        }
    }

    public function decorateProviderWithGoogleMapsApiData($provider)
    {
        $url = '';
        $GeoData = 'w';
        $base_api_url = "http://maps.googleapis.com/maps/api/geocode/json?address=";
        $country = 'United States';
        $APIKEY = 'AIzaSyCeluQNCbj636CiqcBTlW7RuMjHU1l6H8o';

        $address = $provider->streetaddress1 . ',' . $provider->city . ',' . $provider->state . ',' . $country . "&sensor=false&key=" . $APIKEY;
        $address = str_replace(',', '+', $address);
        $address = urlencode($address);
        $url = $base_api_url . $address;


        $this->curl->create($url);

        //$this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
        //$this->curl->option('returntransfer', 1);
        //$this->curl->option('followlocation', 1);
        //$this->curl->option('HEADER', false);
        $this->curl->option('connecttimeout', 600);
        $data = $this->curl->execute();
        $data = json_decode($data);

        //TODO: If no result is set handle the error accordingly
        $geo = $data->results[0]->geometry->location;
        $provider->latitude = $geo->lat;
        $provider->longitude = $geo->lng;

        return $provider;
    }

    public function populateGeoDataPerProvider($providers)
    {
        $decoratedProviders = array();

        foreach ($providers as $idx => $provider):
            array_push($decoratedProviders, $this->decorateProviderWithGoogleMapsApiData($provider));
            $this->updateProviderWithGeoData($provider);
        endforeach;

        return $decoratedProviders;
    }

    public function updateProviderWithGeoData($provider)
    {
        $sql = "UPDATE ff_provider SET latitude = " . $this->db->escape($provider->latitude) . ", longitude = " . $this->db->escape($provider->longitude) . " WHERE provider_id = " . $provider->provider_id;
        $this->db->query($sql);
    }

    public function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die;
    }
}
