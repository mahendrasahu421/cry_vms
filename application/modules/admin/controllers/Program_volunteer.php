<?php 
use SebastianBergmann\Exporter\Exporter;
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Program_volunteer extends MY_Controller
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

    public function program_list()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $where = 'pv.status !=0';
                    $data['state'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                    $data['program'] = $this->Admin_model->get_all_program($where);
                } else {
                    $where = 'pv.program_region = ' . $region . ' AND pv.status !=0';
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $data['state'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                    $data['program'] = $this->Admin_model->get_all_program($where);
                }
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('program-list', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function create_program()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $where = 'program_region=' . $region . '';
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['master_role'] = $this->Crud_modal->fetch_all_data('*', 'master_role', 'status=1');
                    $data['program'] = $this->Admin_model->get_all_program($where);
                } else {
                    $where = 'program_region=' . $region . '';
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['master_role'] = $this->Crud_modal->fetch_all_data('*', 'master_role', 'status=1');
                    $data['program'] = $this->Admin_model->get_all_program($where);
                }
                $data['program'] = $this->Admin_model->get_all_program($where);
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('create-program', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_program_volunteer()
    {
        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $ci_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($ci_id, '-_', '+/'), strlen($ci_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "program_id = '$val'";
                    $data['volunteer_programs'] = $this->Crud_modal->all_data_select('*', 'program_volunteer', $where, 'program_id desc');
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                    $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                } else {
                    $ci_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($ci_id, '-_', '+/'), strlen($ci_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "program_id = '$val'";
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $data['volunteer_programs'] = $this->Crud_modal->all_data_select('*', 'program_volunteer', $where, 'program_id desc');
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                    $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                }

                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('edit-created-program', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function insert_program()
    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $regionName = $this->input->post('region_id');
                $programName = $this->input->post('programName');
                $programstart = $this->input->post('program_start_date');
                $programend = $this->input->post('program_end_date');
                $programexp = $this->input->post('program_exp_date');
                $programInbrife = $this->input->post('programInbrife');
                $status = 2;
                $insertData = array(
                    'program_region' => $regionName,
                    'program_name' => $programName,
                    'programstart_date' => $programstart,
                    'programend_date' => $programend,
                    'programexp_date' => $programexp,
                    'programIn_brife' => $programInbrife,
                    'creation_date' => date('Y-m-d'),
                    'status' => $status,
                );
                $this->Crud_modal->data_insert('program_volunteer', $insertData);
                $this->session->set_flashdata('master_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Template has Created.</div>');
                redirect(base_url() . 'program-list');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_program()
    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $programId = $this->input->post('program_id');
                $regionName = $this->input->post('region_id');
                $state_name = $this->input->post('state_name');
                $districtName = $this->input->post('districtName');
                $programName = $this->input->post('programName');
                $status = $this->input->post('status');
                $update_data = array(
                    'program_id' => $programId,
                    'program_region' => $regionName,
                    'program_state' => $state_name,
                    'program_city' => $districtName,
                    'program_name' => $programName,
                    'status' => $status,
                    'modification_date' => date('Y-m-d'),
                );
                // echo "<pre>";
                // print_r($update_data);exit;
                $where = "program_id = '$programId'";
                if ($this->Crud_modal->update_data($where, 'program_volunteer', $update_data)) {
                    $this->session->set_flashdata('master_menud', '<div class="alert alert-warning"><strong>Success!</strong> Menu Template has Updated.</div>');
                    redirect(base_url() . 'program-list');
                } else {
                    $this->session->set_flashdata('master_menud', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');
                    redirect(base_url() . 'program-list');
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function volunteer_list()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if($role==1){
                    if ($this->input->post('programName') != "") {
                        $programName = $this->input->post('programName');
                        $where = 'vpu.status =0 AND volunteer_programs = ' . $programName;
                        $data['programData'] = $this->Admin_model->programvolunteer_enquiry_Data($where);
                        
                    }
                }else{
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $where = 'pv.program_region = ' . $region . ' AND pv.status=1';
                    $data['certificateFormat'] = $this->Crud_modal->fetch_all_data('*', 'certificate_format_master', 'status=1');
                    $data['volunteer_programs'] = $this->Crud_modal->fetch_all_data('*','program_volunteer','status=1');
                    if ($this->input->post('programName') != "") {
                        $programName = $this->input->post('programName');
                        $where = 'vpu.status =0 AND volunteer_programs = ' . $programName;
                        $data['programData'] = $this->Admin_model->programvolunteer_enquiry_Data($where);
                        
                    }
                }
                $where = 'pv.program_region = ' . $region . ' OR pv.status=1';
                $data['certificateFormat'] = $this->Crud_modal->fetch_all_data('*', 'certificate_format_master', 'status=1');
                $data['volunteer_programs'] = $this->Crud_modal->fetch_all_data('*','program_volunteer','status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('volunteer-list', $data);
                $this->load->view('temp/footer');
            }else{
                redirect(base_url() . 'login', 'refresh');
            }
          
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function issue_certificate()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                $data['certificateId'] = $certificate = $this->input->post('certificate');
                $data['program'] = $programName = $this->input->post('programName');
                if ($role == 1) {
                    if ($programName != "" && $certificate == "") {
                        $programName = $this->input->post('programName');
                        $where = 'vpu.status =2 AND volunteer_programs = "' . $programName . '"';
                        $data['programData'] = $this->Admin_model->programvolunteer_enquiry_Data($where);
                    } else if ($programName != "" && $certificate != "") {
                        $where = 'vpu.status =2 AND vpu.volunteer_programs = "' . $programName . '" AND vpu.certificate_id = "' . $certificate . '"';
                        $data['programData'] = $this->Admin_model->programvolunteer_enquiry_Data($where);
                    } else {
                    }
                } else {
                   
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $where = 'pv.program_region = ' . $region . ' AND pv.status=1';
                    $data['volunteer_programs'] = $this->Admin_model->get_all_program($where);
                    $data['certificateFormat'] = $this->Crud_modal->fetch_all_data('*', 'certificate_format_master', 'status=1');
                    if ($programName != "" && $certificate == "") {
                        $programName = $this->input->post('programName');
                        $where = 'vpu.status =2 AND volunteer_programs = "' . $programName . '"';
                        $data['programData'] = $this->Admin_model->programvolunteer_enquiry_Data($where);
                    } else if ($programName != "" && $certificate != "") {
                        $where = 'vpu.status =2 AND vpu.volunteer_programs = "' . $programName . '" AND vpu.certificate_id = "' . $certificate . '"';
                        $data['programData'] = $this->Admin_model->programvolunteer_enquiry_Data($where);
                    } else {
                    }
                }
                $where = 'pv.program_region = ' . $region . ' OR pv.status=1';
                $data['volunteer_programs'] = $this->Admin_model->get_all_program($where);
                $data['certificateFormat'] = $this->Crud_modal->fetch_all_data('*', 'certificate_format_master', 'status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('issue-certificate', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function share_link()
    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $where = 'status=1';
                    $data['program'] = $this->Admin_model->get_all_program($where);
                } else {
                    $expDate = date('Y-m-d');
                    $where = 'pv.program_region = ' . $region . ' AND pv.status=1 AND pv.programexp_date >= "' . $expDate . '"';
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['program'] = $this->Admin_model->get_all_program($where);
                }
                $data['program'] = $this->Admin_model->get_all_program($where);
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('share-link', $data);
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