<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class School extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function _remap($method)
    {
        $data = $this->session->userdata('user');
        if ($method == 'logout') {
            $this->$method();
        } else {
            $this->$method();
        }
    }

    public function index()
    {
        //$searched_school=$_GET['searched_school'];
        $data = array();

        if (isset($_POST['submit'])) {
            $data = $this->input->post();
            $data["searchdata"] = $this->input->post('schooladdress');

            $this->session->set_userdata('searchedschool', $data['searchdata']);
            $this->session->userdata('searchedschool');

            $school_id = $this->input->post('school_id');
            $school_name = $this->input->post('school_name');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            if ($school_id != '' && $school_name != '' && $latitude != '' && $longitude != '') {
                redirect(base_url() . 'school/schoolmap/' . $school_id . '/' . $school_name . '/' . $latitude . '/' . $longitude . '/');
            } else {

                $data["searchresult"] = $this->schoolmodel->searchschool($data);
                $this->load->view('header', $data);
                $this->load->view('schoolresult');
                $this->load->view('footer');
            }
        } else if (isset($_POST['schooladdress'])) {
            $data = $this->input->post();
            $data["searchdata"] = $this->input->post('schooladdress');
            //$this->session->set_userdata('searchedschool',$data['searchdata']);

            $school_id = $this->input->post('school_id');
            $school_name = $this->input->post('school_name');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            if ($school_id != '' && $school_name != '' && $latitude != '' && $longitude != '') {
                redirect(base_url() . 'school/schoolmap/' . $school_id . '/' . $school_name . '/' . $latitude . '/' . $longitude . '/');
            } else {

                $data["searchresult"] = $this->schoolmodel->searchschool($data);

                $this->load->view('header', $data);
                $this->load->view('schoolresult');
                $this->load->view('footer');
            }

        } else {

            $this->load->view('header');
            $this->load->view('school');
            $this->load->view('footer');
        }
    }

    public function schoolmap()
    {
        $schoolid = $this->uri->segment(3);
        $schoolname = $this->uri->segment(4);
        $latitude = $this->uri->segment(5);
        $longitude = $this->uri->segment(6);

        $rad = 7;
        $schoolmapresult = $this->schoolmodel->searchhome($latitude, $longitude, $rad);

        if (!empty($schoolmapresult)) {
            //$centerlatitude=$schoolmapresult['0']["lat"];
            //$centerlongitude=$schoolmapresult['0']["lon"];
            //$centerschoolname=$schoolmapresult['0']['school_name'];
            $centerlatitude = $latitude;
            $centerlongitude = $longitude;
            $centerschoolname = str_replace('%20', ' ', $schoolname);
            $data['latit'] = $latitude;
            $data['longit'] = $longitude;
            $data['searchdata'] = str_replace('%20', ' ', $schoolname);

            $this->load->library('googlemaps');

            $config['center'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
            $config['zoom'] = 'auto';
            $this->googlemaps->initialize($config);

            $marker['position'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
            $marker['infowindow_content'] = $centerschoolname;
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=S|9999FF|FFFFFF';
            $this->googlemaps->add_marker($marker);

            for ($t = 0; $t < count($schoolmapresult); $t++) {
                $latitude = $schoolmapresult[$t]["latitude"];
                $longitude = $schoolmapresult[$t]["longitude"];
                $providername = $schoolmapresult[$t]["providername"];
                $providerid = $schoolmapresult[$t]["provider_id"];
                $clicklink = "<a href='" . base_url() . "school/providerdetails/" . $providerid . "'>" . $providername . "</a>";

                $marker = array();
                $marker['position'] = '' . $latitude . ', ' . $longitude . '';
                $marker['infowindow_content'] = '' . $clicklink . ''; // coudln't replicate that the forum is filtering the (\)
                $this->googlemaps->add_marker($marker);
            }
            $data['map'] = $this->googlemaps->create_map();


            $this->load->view('header', $data);
            $this->load->view('schoolmap');
            $this->load->view('footer');
        } else {
            redirect('school/index', 'refresh');

        }
    }

    public function providerdetails()
    {
        $providerid = $this->uri->segment(3);
        $data["provider"] = $this->schoolmodel->singleproviderdetails($providerid);
        $this->load->view('header', $data, $providerid);
        $this->load->view('provider');
        $this->load->view('footer');
    }

    public function providerdetails_home()
    {
        $providerid = $this->uri->segment(3);
        $data["provider"] = $this->schoolmodel->singleproviderdetails($providerid);
        $this->load->view('header', $data);
        $this->load->view('provider_home');
        $this->load->view('footer');
    }

    public function homeway()
    {
        $data = array();
        if (isset($_POST['submit'])) {
            $data = $this->input->post();
            $data["searchdata"] = $this->input->post('homeaddress');
            //echo $data["searchdata"];exit;
            unset($data['submit']);
            $this->session->set_userdata('searchedhome', $data['searchdata']);
            $this->session->userdata('searchedhome');

            $homeaddress = $data['homeaddress'];
            // Google HQ
            $prepAddr = str_replace(' ', '+', $homeaddress);
            $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false');
            $output = json_decode($geocode);
//                        echo '<pre>';print_r($output);exit;

            if ($output->status == 'ZERO_RESULTS') {
                $data['zero'] = 1;
                $this->load->view('header');
                $this->load->view('homeresult');
                $this->load->view('footer');
            } elseif ($output->status == 'OVER_QUERY_LIMIT') {
                $data['overquery'] = 2;
                $this->load->view('header');
                $this->load->view('homeresult');
                $this->load->view('footer');
            } else {
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;
                $rad = 5;
                /* $cookie = array(
                         'name' => 'homedata',
                         'value' => $data["searchdata"],
                         'expire' => '86500',
                         'domain' => '.localhost',
                         'prefix' => 'ff_'
                     );

                     set_cookie($cookie);*/
                $data['latit'] = $output->results[0]->geometry->location->lat;
                $data['longit'] = $output->results[0]->geometry->location->lng;
                $data['true'] = 3;
                $allproviderresult = $this->schoolmodel->searchhome($latitude, $longitude, $rad);
                if (!empty($allproviderresult)) {
                    $centerlatitude = $latitude;
                    $centerlongitude = $longitude;
                    $centerschoolname = $homeaddress;
                    $this->load->library('googlemaps');

                    $config['center'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
                    $config['zoom'] = 'auto';
                    $this->googlemaps->initialize($config);

                    $marker['position'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
                    $marker['infowindow_content'] = $centerschoolname;
                    $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|FFFFFF';
                    $this->googlemaps->add_marker($marker);

                    for ($t = 0; $t < count($allproviderresult); $t++) {
                        $latitude = $allproviderresult[$t]["latitude"];
                        $longitude = $allproviderresult[$t]["longitude"];
                        $providername = $allproviderresult[$t]["providername"];
                        $providerid = $allproviderresult[$t]["provider_id"];
                        $clicklink = "<a href='" . base_url() . "school/providerdetails/" . $providerid . "'>" . $providername . "</a>";

                        $marker = array();
                        $marker['position'] = '' . $latitude . ', ' . $longitude . '';
                        $marker['infowindow_content'] = '' . $clicklink . ''; // coudln't replicate that the forum is filtering the (\)
                        $this->googlemaps->add_marker($marker);
                    }
                    $data['map'] = $this->googlemaps->create_map();


                    $this->load->view('header', $data);
                    $this->load->view('homemap');
                    $this->load->view('footer');
                } else {
                    $this->load->view('header');
                    $this->load->view('homeresult');
                    $this->load->view('footer');
                }

            }


        } else {
            $this->load->view('header');
            $this->load->view('homeway');
            $this->load->view('footer');
        }
    }

    public function locationway()
    {
        $data = array();
        if (isset($_POST['submit'])) {
            $data = $this->input->post();
            $data["searchdata"] = $this->input->post('homeaddress');
            //echo $data["searchdata"];exit;
            unset($data['submit']);
            $this->session->set_userdata('searchedhome', $data['searchdata']);
            $this->session->userdata('searchedhome');

            $homeaddress = $data['homeaddress'];
            // Google HQ
            $prepAddr = str_replace(' ', '+', $homeaddress);
            $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false');
            $output = json_decode($geocode);
//                        echo '<pre>';print_r($output);exit;

            if ($output->status == 'ZERO_RESULTS') {
                $data['zero'] = 1;
                $this->load->view('header');
                $this->load->view('homeresult');
                $this->load->view('footer');
            } elseif ($output->status == 'OVER_QUERY_LIMIT') {
                $data['overquery'] = 2;
                $this->load->view('header');
                $this->load->view('homeresult');
                $this->load->view('footer');
            } else {
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;
                $rad = 5;
                $cookie = array(
                    'name' => 'homedata',
                    'value' => $data["searchdata"],
                    'expire' => '86500',
                    'domain' => '.localhost',
                    'prefix' => 'ff_'
                );

                set_cookie($cookie);
                $data['latit'] = $output->results[0]->geometry->location->lat;
                $data['longit'] = $output->results[0]->geometry->location->lng;
                $data['true'] = 3;
                $allproviderresult = $this->schoolmodel->searchhome($latitude, $longitude, $rad);
                if (!empty($allproviderresult)) {
                    $centerlatitude = $latitude;
                    $centerlongitude = $longitude;
                    $centerschoolname = $homeaddress;
                    $this->load->library('googlemaps');

                    $config['center'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
                    $config['zoom'] = 'auto';
                    $this->googlemaps->initialize($config);

                    $marker['position'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
                    $marker['infowindow_content'] = $centerschoolname;
                    $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|FFFFFF';
                    $this->googlemaps->add_marker($marker);

                    for ($t = 0; $t < count($allproviderresult); $t++) {
                        $latitude = $allproviderresult[$t]["latitude"];
                        $longitude = $allproviderresult[$t]["longitude"];
                        $providername = $allproviderresult[$t]["providername"];
                        $providerid = $allproviderresult[$t]["provider_id"];
                        $clicklink = "<a href='" . base_url() . "school/providerdetails/" . $providerid . "'>" . $providername . "</a>";

                        $marker = array();
                        $marker['position'] = '' . $latitude . ', ' . $longitude . '';
                        $marker['infowindow_content'] = '' . $clicklink . ''; // coudln't replicate that the forum is filtering the (\)
                        $this->googlemaps->add_marker($marker);
                    }
                    $data['map'] = $this->googlemaps->create_map();


                    $this->load->view('header', $data);
                    $this->load->view('homemap');
                    $this->load->view('footer');
                } else {
                    $this->load->view('header');
                    $this->load->view('homeresult');
                    $this->load->view('footer');
                }

            }


        } else {
            $this->load->view('header');
            $this->load->view('locationway');
            $this->load->view('footer');
        }
    }

    public function homeway_radius()
    {
        $data = array();
        $radius_data = $_POST['radius'];
        $data['rad'] = $_POST['radius'];
        $data['latit'] = $_POST['latit'];
        $data['longit'] = $_POST['longit'];
        $latit_data = $_POST['latit'];
        $longit_data = $_POST['longit'];
        $data["searchdata"] = $_POST['search_data'];
        $search_data = $_POST['search_data'];
        $rad = $radius_data;
        $allproviderresult = $this->schoolmodel->searchhome($latit_data, $longit_data, $rad);
        $data['allprovider'] = $this->schoolmodel->searchhome($latit_data, $longit_data, $rad);
        echo json_encode($data);
    }

    public function locationway_radius()
    {
        $data = array();
        $radius_data = $_POST['radius'];
        $data['rad'] = $_POST['radius'];
        $data['latit'] = $_POST['latit'];
        $data['longit'] = $_POST['longit'];
        $latit_data = $_POST['latit'];
        $longit_data = $_POST['longit'];
        //$data["searchdata"] = $_POST['search_data'];
        //$search_data = $_POST['search_data'];
        $rad = $radius_data;
        $allproviderresult = $this->schoolmodel->searchhome($latit_data, $longit_data, $rad);
        $data['allprovider'] = $this->schoolmodel->searchhome($latit_data, $longit_data, $rad);
        echo json_encode($data);
    }

    public function providermap()
    {
        $providerid = $this->uri->segment(3);
        $schoolmapresult = $this->schoolmodel->search_providermap($providerid);

        if (!empty($schoolmapresult)) {
            $centerlatitude = $schoolmapresult['0']["latitude"];
            $centerlongitude = $schoolmapresult['0']["longitude"];

            $this->load->library('googlemaps');
            $config['center'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
            $config['zoom'] = '14';
            $this->googlemaps->initialize($config);

            for ($t = 0; $t < count($schoolmapresult); $t++) {
                $latitude = $schoolmapresult[$t]["latitude"];
                $longitude = $schoolmapresult[$t]["longitude"];
                $providername = $schoolmapresult[$t]["providername"];
                $providerid = $schoolmapresult[$t]["provider_id"];
                $clicklink = "<a href='" . base_url() . "school/providerdetails/" . $providerid . "'>" . $providername . "</a>";

                $marker = array();
                $marker['position'] = '' . $latitude . ', ' . $longitude . '';
                $marker['infowindow_content'] = '' . $clicklink . ''; // coudln't replicate that the forum is filtering the (\)
                $this->googlemaps->add_marker($marker);
            }
            $data['map'] = $this->googlemaps->create_map();

            $this->load->view('header', $data);
            $this->load->view('homemap');
            $this->load->view('footer');
        } else {
            redirect('school/homeway', 'refresh');

        }
    }

    public function locationmap()
    {
        $location_lat = $_GET['lat'];
        $location_lng = $_GET['lng'];
        $rad = 5;
        $data['latit'] = $_GET['lat'];
        $data['longit'] = $_GET['lng'];
        $data['search_data'] = "You are Here";
        $allproviderresult = $this->schoolmodel->searchhome($location_lat, $location_lng, $rad);
        if (!empty($allproviderresult)) {
            $centerlatitude = $location_lat;
            $centerlongitude = $location_lng;
            $centerschoolname = "You are Here";
            $this->load->library('googlemaps');

            $config['center'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
            $config['zoom'] = 'auto';
            $this->googlemaps->initialize($config);

            $marker['position'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
            $marker['infowindow_content'] = $centerschoolname;
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|FFFFFF';
            $this->googlemaps->add_marker($marker);

            for ($t = 0; $t < count($allproviderresult); $t++) {
                $latitude = $allproviderresult[$t]["latitude"];
                $longitude = $allproviderresult[$t]["longitude"];
                $providername = $allproviderresult[$t]["providername"];
                $providerid = $allproviderresult[$t]["provider_id"];
                $clicklink = "<a href='" . base_url() . "school/providerdetails/" . $providerid . "'>" . $providername . "</a>";

                $marker = array();
                $marker['position'] = '' . $latitude . ', ' . $longitude . '';
                $marker['infowindow_content'] = '' . $clicklink . ''; // coudln't replicate that the forum is filtering the (\)
                $this->googlemaps->add_marker($marker);
            }
            $data['map'] = $this->googlemaps->create_map();


            $this->load->view('header', $data);
            $this->load->view('locationmap');
            $this->load->view('footer');
        } else {
            $this->load->view('header');
            $this->load->view('locationresult');
            $this->load->view('footer');
        }
        //echo "Current Location marked";
    }

    public function locationmap_to()
    {
        $providerid = $this->uri->segment(3);
        $providermap_result = $this->schoolmodel->search_providermap($providerid);
        //$this->session->set_userdata('locationurl',$_SERVER['HTTP_REFERER']);
        if (!empty($providermap_result)) {
            $centerlatitude = $providermap_result['0']["latitude"];
            $centerlongitude = $providermap_result['0']["longitude"];

            $this->load->library('googlemaps');

            $config['center'] = '' . $centerlatitude . ', ' . $centerlongitude . '';
            $config['zoom'] = 'auto';
            $this->googlemaps->initialize($config);

            for ($t = 0; $t < count($providermap_result); $t++) {
                $latitude = $providermap_result[$t]["latitude"];
                $longitude = $providermap_result[$t]["longitude"];
                $providername = $providermap_result[$t]["providername"];
                $providerid = $providermap_result[$t]["provider_id"];
                $clicklink = "<a href='" . base_url() . "school/providerdetails/" . $providerid . "'>" . $providername . "</a>";

                $marker = array();
                $marker['position'] = '' . $latitude . ', ' . $longitude . '';
                $marker['infowindow_content'] = '' . $clicklink . ''; // coudln't replicate that the forum is filtering the (\)
                $this->googlemaps->add_marker($marker);
            }
            $data['map'] = $this->googlemaps->create_map();
            $this->load->view('header', $data);
            $this->load->view('providermap2');
            $this->load->view('footer');

        } else {
            $this->load->view('header', $data);
            $this->load->view('providermap2');
            $this->load->view('footer');
        }
    }


    public function testdata()
    {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->schoolmodel->get_data($q);
        }
    }

    public function aboutus()
    {
        $this->load->view('header');
        $this->load->view('aboutus');
        $this->load->view('footer');

    }

    public function supporters()
    {
        $this->load->view('header');
        $this->load->view('supporters');
        $this->load->view('footer');

    }

    public function privacypolicy()
    {
        $this->load->view('header');
        $this->load->view('privacypolicy');
        $this->load->view('footer');

    }

    public function terms_conditions()
    {
        $this->load->view('header');
        $this->load->view('terms_conditions');
        $this->load->view('footer');

    }

    public function contactus()
    {
        $this->load->view('header');
        $this->load->view('contactus');
        $this->load->view('footer');

    }

    public function list_schooladdress()
    {
        $schooladdress = $this->input->post('schooladdress');


        $return_data = $this->schoolmodel->list_schooladdress($schooladdress);
        echo json_encode(array('school_id' => $return_data[0]['school_id'], 'school_name' => $return_data[0]['school_name'], 'latitude' => $return_data[0]['latitude'], 'longitude' => $return_data[0]['longitude']));
    }
}

