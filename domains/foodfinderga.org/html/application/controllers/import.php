<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->database();
	}

	public function index(){	
		$this->load->view('import', array('error' => ' '));
	}

	public function providers(){
		$data 			= ($_FILES['import_csv']);
		$temp_filename 	= $data['tmp_name'];
		$file_resource 	= fopen ($temp_filename , 'r');
		$size 			= $data['size'];
		$table 			= [];

		while(($row 	= fgetcsv($file_resource)) !== false){
			$table[]    = $row;
		}
		
		$properties 	= $table[0];
		array_shift($table);
		
		$data 			= $this->formatProviderObjects($properties, $table);
		
		if($this->uploadProvidersToDB($data)) die('Providers successfully uploaded.');
		die('Oops there was an error uploading the CSV.'); 
	}	

	public function uploadProvidersToDB($data){
		$success = false;
		
		foreach($data as $row):
			//$this->dd($row);
		 	$SCHOOL_ID 		= $row->SCHOOL_ID;
			$SCHOOL_NAME 	= $row->SCHOOL_NAME;
		 	$SCHOOL_ADDRESS = $row->SCHOOL_ADDRESS;
		 	$SCHOOL_CITY 	= $row->SCHOOL_CITY;
		 	$STATE 			= $row->STATE;
		 	$COUNTY 		= $row->COUNTY;
			$SCHOOL_ZIP 	= $row->SCHOOL_ZIP;
		 	$SCHOOL_PHONE 	= $row->SCHOOL_PHONE;

			$sql = "INSERT INTO ff_provider (providername, streetaddress1, city, state, county, zipcode, phonenumber) 
			VALUES ("
			.$this->db->escape($SCHOOL_NAME).","
			.$this->db->escape($SCHOOL_ADDRESS).","
			.$this->db->escape($SCHOOL_CITY).","
			.$this->db->escape($STATE).","
			.$this->db->escape($COUNTY).","
			.$this->db->escape($SCHOOL_ZIP).","
			.$this->db->escape($SCHOOL_PHONE).")";

			$this->db->query($sql);
		endforeach;

		if($this->db->affected_rows() > 0) $success = TRUE;
		return $success;
	}

	public function formatProviderObjects($properties, $table){
		$data 	= [];
		$count 	= count($properties);

		foreach($table as $idx => $row):
			if(count($row) !== $count) die('error with the csv file on row: '.  ($idx + 1));

			$provider = [];
			$provider['SCHOOL_ID'] 		= $row[0];
			$provider['SCHOOL_NAME'] 	= $row[1];
			$provider['SCHOOL_ADDRESS']	= $row[2];
			$provider['SCHOOL_CITY'] 	= $row[3];
			$provider['STATE'] 			= $row[4];
			$provider['COUNTY'] 		= $row[5];
			$provider['SCHOOL_ZIP'] 	= $row[6];
			$provider['SCHOOL_PHONE'] 	= $row[7];

			$data[] = (object) $provider;
		endforeach;

		return $data;
	}

	public function dd($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		die;
	}
}
