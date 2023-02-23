<?php  
use SebastianBergmann\Exporter\Exporter;
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class volunteer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        // if ($this->session->userdata('userID')) {
        //     if ($this->session->userdata('roleID') == 2) {
        //         echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        //     } else {
        //     }
        // } else {
        //     echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        // }
        $CI = &get_instance();
        $CI->load->library('Get_library');
        $this->load->library('upload');
        $this->load->library('csvimport');
        //$this->load->library("PHPExcel");
        $this->load->helper('url');
        $this->load->library("pagination");
        $this->load->model('crud/Crud_modal');
        $this->load->model('curl/Curl_model');
        $this->load->model('users/User_model');
        $this->load->model('admin/Admin_model');
        $this->load->library('Phpmailer');
        $this->load->library('Fpdf_gen');

        date_default_timezone_set('Asia/Kolkata');
    }

    public function enquiry()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =1 OR v.status =2';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "" && $this->input->post('region_id') != "") {
                        $data['state'] =  $state_name = $this->input->post('state_name');
                        $data['region_id'] =  $region_id = $this->input->post('region_id');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        //$data['region_id'] = $region_id;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=1 OR v.status=2)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                        // echo "<pre>";
                        // print_r($data['volunteer']);exit;
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =1 OR v.status =2';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $data['state'] =   $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=1 OR v.status=2)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }

                $data['email_templates'] = $this->Crud_modal->fetch_single_data('email_templates_id,body_content', 'email_templates', 'status=1 AND email_templates_id=4');
             
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('enquiry', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function ragistration_volunteer()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =2 OR v.status =3';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $data['state'] =  $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=2 OR v.status=3)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =2 OR v.status =3';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $data['state'] = $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=2 OR v.status=3)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }
                $data['email_templates'] = $this->Crud_modal->fetch_single_data('email_templates_id,body_content', 'email_templates', 'status=1 AND email_templates_id=5');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('ragistration-volunteer', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function volenteership()
    {
       
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
              
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                   // $where = 'v.status =4 OR v.status =5';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $data['state'] =  $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status = 4 OR v.status=5)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                        // echo "<pre>";
                        // print_r($data['volunteer']);exit;

                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =4 OR v.status =5';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $data['state'] = $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=4 OR v.status=5)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }
                $data['emailData'] = $this->Crud_modal->fetch_single_data('email_templates_id,body_content', 'email_templates', 'status=1 AND email_templates_id=6');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('volenteership', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}

?>