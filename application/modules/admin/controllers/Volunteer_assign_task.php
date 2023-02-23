<?php 
use SebastianBergmann\Exporter\Exporter;
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Volunteer_assign_task extends MY_Controller
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

    public function assigned_task()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $emp_id = $this->session->userdata('emp_id');
                $region = $this->session->userdata('region_id');
                $taskType = $this->input->post('taskType');
                if (!empty($this->input->post('assignTask'))) {
                    $task = $this->input->post('taskName');
                    $state = $this->input->post('stateName');
                    $assignDate = date("Y-m-d", strtotime($this->input->post('assignDate')));
                    $volunteerId = $this->input->post('valunteers');
                    $volunteerassignTask = array();
                    for ($i = 0; $i < count($volunteerId); $i++) {
                        $assignTask = array(
                            'volunteer_id' => $volunteerId[$i],
                            'task_id' => $task,
                            'assigned_date' => $assignDate,
                            'status' => 0,
                            'assign_by'=> $emp_id,
                        );
                        array_push($volunteerassignTask, $assignTask);
                    }
                    $this->Crud_modal->insert_batch('assigning_task', $volunteerassignTask);
                    $this->session->set_flashdata('master_insert_message', '<div class="alert alert-warning"><strong>You Assign a task!</strong></div>');
                    redirect(base_url() . 'assigned-task');
                }
                $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('assigned-task', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    
    public function view_assigned_task()
{
    try{

        if(($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)){
            $region = $this->session->userdata('region_id');
            $role = $this->session->userdata('role_id');
           
            if($role == 1){
                if($this->input->post('task_id')!=""){
                    $assignTaskid = $this->input->post('task_id');
                    $where = 'as.status = 0 OR as. status = 1 OR as.status = 2 And v.status = 5 AND as.task_id = "'.$assignTaskid.'"';
                    $data['assignTaskdata'] = $this->Admin_model->volunteer_by_assign_task($where);
                }
                
               
            }else{
                if($this->input->post('task_id')!="" || $this->session->userdata('emp_id')!=""){
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                     $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $assignTaskid = $this->input->post('task_id');
                    $emp = $this->session->userdata('emp_id');
                    $where = 'as.status in (0,1,2) And v.status = 5 AND as.task_id = "'.$assignTaskid.'" AND as.assign_by = "'.$emp.'"';
                    //echo $where;exit;
                    $data['assignTaskdata'] = $this->Admin_model->volunteer_by_assign_task($where);
                   
                }

            }
            $where = 'ast.status=0';
            $data['task'] = $this->Admin_model->all_assign_task($where);
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar');
            $this->load->view('view-assigned-task', $data);
            $this->load->view('temp/footer');

        }else {
                redirect(base_url() . 'login', 'refresh');
            }
    }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
}
}
?>