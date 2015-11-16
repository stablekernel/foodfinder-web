<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
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

    /*
    Author : Habile Developer
    Last Modified : 10/9/2012
    Descr : This controller involves admin operations
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

    public function getcitilist()
    {
        $statecode = $this->uri->segment(3);
        echo $citylist = $this->adminhelper->getcitylist($statecode);
    }

    public function index()
    {
        $data = array();
        if (isset($_POST['submit'])) {
            /*$captcha1=$this->input->post('word');
            $captcha2=$this->session->userdata('word');
            if($captcha1!=$captcha2) {
                $this->session->set_flashdata('loginstatus', 'Please enter correct captcha value');
                 redirect('admin/','refresh');
            } else { */
            $email = mysql_real_escape_string(trim($_REQUEST['email']));
            $password = md5(mysql_real_escape_string(trim($_REQUEST['password'])));
            $userstatus = $this->adminhelper->check_user($email, $password);
            if ($userstatus == false) {
                $this->session->set_flashdata('loginstatus', 'Incorrect Login');
                redirect('admin/index', 'refresh');
            } else {
                $this->session->set_userdata('user', $userstatus);
                redirect('admin/dashboard', 'refresh');
            }
        } else {
            $this->load->helper('captcha');
            $captchaimageurl = base_url() . "captcha/";
            $vals = array(
                'img_path' => './captcha/',
                'img_url' => $captchaimageurl,
                'img_width' => '100',
                'img_height' => 30,
                'border' => 0,
                'expiration' => 7200
            );

            $cap = create_captcha($vals);
            $data['image'] = $cap['image'];
            $this->session->set_userdata('word', $cap['word']);
            $this->load->view('admin/index', $data);
        }
    }


    public function dashboard()
    {
        $data = $this->session->userdata('user');
        if (isset($data['aid'])) {
            $data = array();
            $data['pageName'] = $this->uri->segment(2);
            $this->load->view('admin/header', $data);
            $this->load->view('admin/dashboard');
            $this->load->view('admin/footer');
        } else {
            redirect('/admin', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect('/admin/', 'location');
    }

    public function addschool()
    {
        if (isset($_POST['submit'])) {
            $data = $this->input->post();
            $checkvalue = $this->adminhelper->checkschooladdress($data);
            if ($checkvalue == 4) {
                $insertaction = $this->adminhelper->addschool($data);
                if ($insertaction == 1) {
                    $this->session->set_flashdata('errmsg', 'Unable to find geolocation for this address. Please verify');
                    redirect('admin/addschool', 'refresh');
                } elseif ($insertaction == 2) {
                    $this->session->set_flashdata('errmsg', 'Could not get location details. Please add an event after some time.');
                    redirect('admin/addschool', 'refresh');
                } else {
                    $this->session->set_flashdata('updmsg', 'School added successfully');
                    redirect('admin/manageschool', 'refresh');
                }
            } else {
                $this->session->set_flashdata('errmsg', 'Already added added');
                redirect('admin/addschool', 'refresh');
            }
        }

        $data = $this->session->userdata('user');
        $data = array();
        $data['pageName'] = $this->uri->segment(2);
        $data["allstatelist"] = $this->adminhelper->allstatelist();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/addschool');
        $this->load->view('admin/footer');
    }

    public function manageschool()
    {
        $data = $this->session->userdata('user');
        $data = array();
        if (isset($_POST['Filter'])) {
            $data['product_name'] = $_REQUEST["searchproductname"];
            $data['product_code'] = $_REQUEST["searchproductcode"];
            $data['supplier_name'] = $_REQUEST["searchsuppliername"];
            $data['location'] = $_REQUEST["searchlocation"];
            $data['store'] = $_REQUEST["searchstore"];
            $data['order'] = $_REQUEST["order"];
            $data["providerdetails"] = $this->product_module->product_search($data);
        } else {
            $data["schooldetails"] = $this->adminhelper->manageschool();
        }
        $data['pageName'] = $this->uri->segment(2);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/manageschool');
        $this->load->view('admin/footer');
    }

    function deleteschool()
    {
        if (isset($_POST["school_id"])):
            $school_id = $_POST["school_id"];
            $this->adminhelper->deleteschool($school_id);
            $this->session->set_flashdata('updmsg', 'School deleted successfully');
            redirect('admin/manageschool', 'refresh');
        endif;
    }

    public function schooledit()
    {
        $id = $this->uri->segment(3);
        $school = $this->adminhelper->getSchool($id);
        $state = $school['0']['state'];
        $citylist = $this->adminhelper->getCityByStateSelectElement($state, $school);

        if (isset($_POST["updateschool"])):
            $data = $this->input->post();
            $checkvalue = $this->adminhelper->checkschooladdress1($id, $data);
            if ($checkvalue == 5) {
                $insertaction = $this->adminhelper->updateschool($id, $data);
                if ($insertaction == 1) {
                    $this->session->set_flashdata('errmsg', 'Unable to find geolocation for this address. Please verify');
                    redirect('admin/schooledit/' . $id);
                } elseif ($insertaction == 2) {
                    $this->session->set_flashdata('errmsg', 'Could not get location details. Please add an event after some time.');
                    redirect('admin/schooledit/' . $id);
                } else {
                    $this->session->set_flashdata('updmsg', 'School updated successfully');
                    redirect('admin/manageschool', 'refresh');
                }
            } else {
                $this->session->set_flashdata('errmsg', 'Already address is added');
                redirect('admin/schooledit/' . $id);
            }
        else:
            $data = $this->session->userdata('user');
            $data = array();
            $data['pageName'] = $this->uri->segment(2);
            $data['results'] = $this->adminhelper->load_single_school($id);
            $data["allstatelist"] = $this->adminhelper->allstatelist();
            $data["allcitylist"] = $citylist;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/editschool');
            $this->load->view('admin/footer');
        endif;
    }

    public function changepassword()
    {
        $data = $this->session->userdata('user');
        $aid = $data['aid'];
        $data = array();
        $data['aid'] = $aid;

        if (isset($_POST['submit'])) {
            $data = $this->input->post();
            if (($_POST['n_password']) != ($_POST['c_password'])) {
                $this->session->set_flashdata('errmsg', 'Confirmation password does not match');
                redirect('admin/changepassword');
            } else {
                if (($_POST['o_password']) == ($_POST['c_password'])) {
                    $this->session->set_flashdata('errmsg', 'Enter different password');
                    redirect('admin/changepassword');
                } else {
                    $opassword = md5(mysql_real_escape_string(trim($_POST['o_password'])));
                    $userstatus = $this->adminhelper->checkchangepassword($aid, $opassword);
                    if ($userstatus == false) {
                        $this->session->set_flashdata('errmsg', 'The current password is wrong');
                        redirect('admin/changepassword');
                    } else {
                        $password = md5(mysql_real_escape_string(trim($_POST['n_password'])));
                        $new_pass = md5(mysql_real_escape_string(trim($_POST['n_password'])));
                        $insertaction = $this->adminhelper->changepassword($aid, $new_pass);
                        if ($insertaction == false):
                            $this->session->set_flashdata('errmsg', 'Password could not be updated');
                            redirect('admin/changepassword');
                        else:
                            $this->session->set_userdata('user', $userstatus);
                            redirect('admin/', 'refresh');
                        endif;
                    }
                }
            }
        }
        $data['pageName'] = $this->uri->segment(2);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/changepassword');
        $this->load->view('admin/footer');
    }

    public function addprovider()
    {
        if (isset($_POST['submit'])) {
            $data = $this->input->post();
            $checkvalue = $this->adminhelper->checkprovideraddress($data);
            if ($checkvalue == 4) {
                // if(!isset($data['school']))
                // {
                // 	$this->session->set_flashdata('errmsg', 'Please add school');
                // 	redirect('admin/addprovider','refresh');
                // }
                $insertaction = $this->adminhelper->addprovider($data);
                if ($insertaction == false):
                    $this->session->set_flashdata('errmsg', 'Already provider added');
                    redirect('admin/addprovider', 'refresh');
                else:
                    $this->session->set_flashdata('updmsg', 'Provider added successfully');
                    redirect('admin/manageprovider', 'refresh');
                endif;
            } else {
                $this->session->set_flashdata('errmsg', 'Already address added');
                redirect('admin/addprovider', 'refresh');
            }
        }

        $data = $this->session->userdata('user');
        $data = array();
        $data['pageName'] = $this->uri->segment(2);
        $data["allstatelist"] = $this->adminhelper->allstatelist();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/addprovider');
        $this->load->view('admin/footer');
    }

    public function manageprovider()
    {
        $data = $this->session->userdata('user');
        $data = array();
        if (isset($_POST['Filter'])) {
            $data['product_name'] = $_REQUEST["searchproductname"];
            $data['product_code'] = $_REQUEST["searchproductcode"];
            $data['supplier_name'] = $_REQUEST["searchsuppliername"];
            $data['location'] = $_REQUEST["searchlocation"];
            $data['store'] = $_REQUEST["searchstore"];
            $data['order'] = $_REQUEST["order"];
            $data["providerdetails"] = $this->product_module->product_search($data);
        } else {
            $data["providerdetails"] = $this->adminhelper->manageprovider();
        }
        $data['pageName'] = $this->uri->segment(2);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/manageprovider');
        $this->load->view('admin/footer');
    }

    function deleteprovider()
    {
        if (isset($_POST["provider_id"])):
            $provider_id = $_POST["provider_id"];
            $this->adminhelper->deleteprovider($provider_id);
            $this->session->set_flashdata('updmsg', 'Provider deleted successfully');
            redirect('admin/manageprovider', 'refresh');
        endif;
    }

    public function provideredit()
    {
        $id = $this->uri->segment(3);
        $provider = $this->adminhelper->getProvider($id);
        $state = $provider['0']['state'];
        $citylist = $this->adminhelper->getCityByStateSelectElement($state, $provider);

        if (isset($_POST["updateprovider"])):
            $data = $this->input->post();
            $checkvalue = $this->adminhelper->checkprovideraddress1($id, $data);
            if ($checkvalue == 5) {
                $insertaction = $this->adminhelper->updateprovider($id, $data);
                if ($insertaction == false):
                    $this->session->set_flashdata('errmsg', 'Already provider added');
                    redirect('admin/provideredit/' . $id);
                else:
                    $this->session->set_flashdata('updmsg', 'Provider updated successfully');
                    redirect('admin/manageprovider');
                endif;
            } else {
                $this->session->set_flashdata('errmsg', 'Already address added');
                redirect('admin/provideredit/' . $id);
            }
        else:

            $data = $this->session->userdata('user');
            $data = array();
            $data['pageName'] = $this->uri->segment(2);
            $data["allstatelist"] = $this->adminhelper->allstatelist();
            $data["allcitylist"] = $citylist;
            $data['results'] = $this->adminhelper->load_single_provider($id);

            $this->load->view('admin/header', $data);
            $this->load->view('admin/editprovider');
            $this->load->view('admin/footer');
        endif;
    }


}
