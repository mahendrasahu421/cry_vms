<?php 
use SebastianBergmann\Exporter\Exporter;
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class volunteer_task extends MY_Controller
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


    public function add_task()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                }
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('add-task', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function view_task()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $task_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "task_id = '$val'";
                    $data['taskData'] = $this->Crud_modal->fetch_single_data('*', 'task', $where, 'task_id desc');
                } else {
                    $task_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "task_id = '$val'";
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $data['taskData'] = $this->Crud_modal->fetch_single_data('*', 'task', $where, 'task_id desc');
                }
                $data['taskData'] = $this->Crud_modal->fetch_single_data('*', 'task', $where, 'task_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('view-task', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function edit_task()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if($role==1){
                    $task_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "task_id = '$val'";
                    $data['task_type'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status=1');
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                    $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                    $data['taskData'] = $this->Crud_modal->all_data_select('*', 'task', $where, 'task_id desc');
                }else{
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $task_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "task_id = '$val'";
                    $data['task_type'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status=1');
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                    $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                    $data['taskData'] = $this->Crud_modal->all_data_select('*', 'task', $where, 'task_id desc');
                }
                $task_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                $where = "task_id = '$val'";
                $data['task_type'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status=1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                $data['taskData'] = $this->Crud_modal->all_data_select('*', 'task', $where, 'task_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('edit-task', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function update_task()
    {
        $task_id = $this->input->post('task_id');
        $task_type = $this->input->post('task_type_id');
        $task_for = 1;
        $region_id = $this->input->post('region_id');
        $state_name = $this->input->post('state_name');
        $sdate = $this->input->post('sdate');
        $edate = $this->input->post('edate');
        $volunteer_required = $this->input->post('volunteer_required');
        $title = $this->input->post('title');
        $what_to_do = $this->input->post('what_to_do');
        $status = $this->input->post('status');

        $updatetasData = array(
            'task_id' => $task_id,
            'task_type_id' => $task_type,
            'task_for' => 1,
            'region_id' => $region_id,
            'task_state_id' => $state_name,
            'start_date' => $sdate,
            'expected_end_date' => $edate,
            'volunteer_required' => $volunteer_required,
            'task_title' => $title,
            'task_brief' => $what_to_do,
            'status' => $status,

        );
        // echo "<pre>";
        // print_r( $updatetasData);exit;
        $where = "task_id = '$task_id'";
        if ($this->Crud_modal->update_data($where, 'task', $updatetasData)) {
            $this->session->set_flashdata('master_district', '<div class="alert alert-warning"><strong>Success!</strong> District Data has Updated.</div>');
            redirect(base_url() . 'task-list');
        } else {
            $this->session->set_flashdata('master_district', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');

            redirect(base_url() . 'task-list');
        }
    }

    public function task_list()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-10 days'));
                    $where = '1 =1';

                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "") {
                        $data['Tstate_name'] = $state_name = $this->input->post('state_name');
                        $data['task_regionName'] = $region_id = $this->input->post('region_id');
                        $taskType = $this->input->post('taskType');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . "  and status=1 and task_for=1 and task_state_id = '" . $state_name . "' and region_id = " . $region_id . "";
                        $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                        // echo "<pre>";
                        // print_r($data['taskData']);exit;
                    } else {
                        $date_to = date("Y-m-d");
                        $date_from = date("Y-m-d", strtotime($date2 . '-10 days'));
                        $data['creation_date'] = $date_from;
                        $data['creation_date'] = $date2;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and status = 1";
                        $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = '1 =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "" &&  $this->input->post('region_id') != "") {
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $data['StaskType'] = $taskType = $this->input->post('taskType');
                        $region_id = $this->input->post('region_id');
                        $data['Tstate_name'] = $state_name = $this->input->post('state_name');
                        $data['date_from'] = $date_from = date("Y-m-d", strtotime($date1));
                        $data['date_to'] =     $date_to = date("Y-m-d", strtotime($date2));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $data['region_id'] = $region_id;
                        //  $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=1";
                        $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                    } else if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "" &&  $this->input->post('region_id') != "" &&  $this->input->post('state_name') != "") {
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $data['StaskType'] = $taskType = $this->input->post('taskType');
                        $region_id = $this->input->post('region_id');
                        $data['Tstate_name']  = $state_name = $this->input->post('state_name');
                        $data['date_from'] = $date_from = date("Y-m-d", strtotime($date1));
                        $data['date_to'] =     $date_to = date("Y-m-d", strtotime($date2));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $data['region_id'] = $region_id;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=1";
                        $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                    } else {
                        //  $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                    }
                }
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('task-list', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insert_add_task()
    {
        try {
            $task_for = 1;
            $task_type = $this->input->post('task_type');
            $region_id = $this->input->post('region_id');
            $state_name = $this->input->post('state_name');
            $city = $this->input->post('city');
            $sdate = $this->input->post('sdate');
            $edate = $this->input->post('edate');
            $volunteer_required = $this->input->post('volunteer_required');
            $keyword = $this->input->post('keywords');
            $title = $this->input->post('title');
            $what_to_do = $this->input->post('what_to_do');
            $status = $this->input->post('status');
            $creation_date = $this->input->post('creation_date');
            $volunteerData = array(
                'task_type_id' => $task_type,
                'task_for' => $task_for,
                'region_id' => $region_id,
                'task_state_id' => $state_name,
                'city_id' => $city,
                'start_date' => $sdate,
                'expected_end_date' => $edate,
                'volunteer_required' => $volunteer_required,
                'keyword' => $keyword,
                'task_title' => $title,
                'task_brief' => $what_to_do,
                'creation_date' => date('Y-m-d'),
                'status' => $status,

            );
            $this->Crud_modal->data_insert('task', $volunteerData);
            $this->session->set_flashdata('master_insert_message', '<div class="alert alert-success"><strong>Task Create Success!</strong></div>');
            redirect(base_url() . 'task-list');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
?>