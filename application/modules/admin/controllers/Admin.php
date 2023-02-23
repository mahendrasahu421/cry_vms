<?php

use SebastianBergmann\Exporter\Exporter;

ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MY_Controller
{
    public $nama_tabel = 'dioceses';

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


    public function dashboard()
    {
        if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
            $region = $this->session->userdata('region_id');
            $role = $this->session->userdata('role_id');
            if ($role == 1) {
                $where = 'v.status =1 OR v.status =2 And region_id = "' . $region . '"';
                $limit = '5';
                $data['totalvolunteer'] = $this->Admin_model->total_volunteer();
                $data['totalintern'] = $this->Admin_model->total_intern();
                $data['totaltask'] = $this->Admin_model->total_task_count();
                $data['totaltaskintern'] = $this->Admin_model->total_task_count_intern();
                $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Datalimit5($where, $limit);
                $volunteerTaskcount = 0;
                $internTaskcount = 0;
                foreach ($data['totaltask'] as $Ttask) {
                    if ($Ttask['task_for'] == 1) {
                        $volunteerTaskcount++;
                    }
                    if ($Ttask['task_for'] == 2) {
                        $internTaskcount++;
                    }
                }
                $data['volunteerTaskcount'] =  $volunteerTaskcount;
                $data['internTaskcount'] =  $internTaskcount;
            } else {
                $where = 'v.status =1 OR v.status =2 And region_id = "' . $region . '"';
                $limit = '5';
                $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                $statesID =  $data['rname']['state_id'];
                $data['totalvolunteer'] = $this->Admin_model->total_volunteer($statesID);
                $data['totalintern'] = $this->Admin_model->total_volunteer($statesID);
                $data['totaltask'] = $this->Admin_model->total_task_count($statesID);
                $data['totaltaskintern'] = $this->Admin_model->total_task_count_intern_state($statesID);
                $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Datalimit5($where, $limit);
                // echo "<pre>";
                // print_r($data['volunteer']);exit;
                $volunteerTaskcount = 0;
                $internTaskcount = 0;
                foreach ($data['totaltask'] as $Ttask) {
                    if ($Ttask['task_for'] == 1) {
                        $volunteerTaskcount++;
                    }
                    if ($Ttask['task_for'] == 2) {
                        $internTaskcount++;
                    }
                }
                $data['volunteerTaskcount'] =  $volunteerTaskcount;
                $data['internTaskcount'] =  $internTaskcount;
            }
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar');
            $this->load->view('index', $data);
            $this->load->view('temp/footer');
        }
    }

   

    public function interninsert_add_task()
    {
        try {
            $task_for = 2;
            $task_type = $this->input->post('task_type');
            $region_id = $this->input->post('region_id');
            $state_name = $this->input->post('state_name');
            $city = $this->input->post('city');
            $sdate = $this->input->post('sdate');
            $edate = $this->input->post('edate');
            $volunteer_required = $this->input->post('intern_required');
            $keyword = $this->input->post('keywords');
            $title = $this->input->post('title');
            $what_to_do = $this->input->post('what_to_do');
            $status = $this->input->post('status');
            $creation_date = $this->input->post('creation_date');
            // echo "<pre>";
            // print_r($creation_date);exit;
            $volunteerData = array(
                'task_type_id' => $task_type,
                'task_for' => $task_for,
                'region_id' => $region_id,
                'task_state_id' => $state_name,
                'city_id' => $city,
                'start_date' => $sdate,
                'expected_end_date' => $edate,
                'intern_required' => $volunteer_required,
                'keyword' => $keyword,
                'task_title' => $title,
                'task_brief' => $what_to_do,
                'status' => $status,
                'creation_date' => date('Y-m-d'),

            );
            // echo "<pre>";
            // print_r($volunteerData);exit;

            $this->Crud_modal->data_insert('interntask', $volunteerData);
            $this->session->set_flashdata('master_insert_message', '<div class="alert alert-success"><strong>Task Create Success!</strong></div>');
            redirect(base_url() . 'intern-task-list');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function intern_task_view()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $task_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "intern_task_id = '$val'";
                    $data['interntaskData'] = $this->Crud_modal->fetch_single_data('*', 'interntask', $where, 'intern_task_id desc');
                } else {
                    $task_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "intern_task_id = '$val'";
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $data['interntaskData'] = $this->Crud_modal->fetch_single_data('*', 'interntask', $where, 'intern_task_id desc');
                }
                $data['interntaskData'] = $this->Crud_modal->fetch_single_data('*', 'interntask', $where, 'intern_task_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('intern-task-view', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function intern_edit_task()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
               
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if($role==1){
                    $task_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "intern_task_id = '$val'";
                    $data['task_type'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status=1');
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                    $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                    $data['interntaskData'] = $this->Crud_modal->all_data_select('*', 'interntask', $where, 'intern_task_id desc');
                }else{
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $task_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "intern_task_id = '$val'";
                    $data['task_type'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status=1');
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                    $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                    $data['interntaskData'] = $this->Crud_modal->all_data_select('*', 'interntask', $where, 'intern_task_id desc');
                }
                $task_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($task_id, '-_', '+/'), strlen($task_id) % 4, '=', STR_PAD_RIGHT));
                $where = "intern_task_id = '$val'";
                $data['task_type'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status=1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
                $data['interntaskData'] = $this->Crud_modal->all_data_select('*', 'interntask', $where, 'intern_task_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('editintern-edit-task', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function intern_update_task()
    {

        $task_id = $this->input->post('intern_task_id');
        $task_type = $this->input->post('task_type_id');
        $task_for = 2;
        $region_id = $this->input->post('region_id');
        $state_name = $this->input->post('state_name');
        $sdate = $this->input->post('sdate');
        $edate = $this->input->post('edate');
        $volunteer_required = $this->input->post('intern_required');
        $title = $this->input->post('title');
        $what_to_do = $this->input->post('what_to_do');
        $status = $this->input->post('status');

        $updatetasData = array(
            'intern_task_id' => $task_id,
            'task_type_id' => $task_type,
            'task_for' => 2,
            'region_id' => $region_id,
            'task_state_id' => $state_name,
            'start_date' => $sdate,
            'expected_end_date' => $edate,
            'intern_required' => $volunteer_required,
            'task_title' => $title,
            'task_brief' => $what_to_do,
            'status' => $status,

        );

        $where = "intern_task_id = '$task_id'";
        if ($this->Crud_modal->update_data($where, 'interntask', $updatetasData)) {
            $this->session->set_flashdata('master_district', '<div class="alert alert-warning"><strong>Success!</strong> Intern Task Data has Updated.</div>');
            redirect(base_url() . 'intern-task-list');
        } else {
            $this->session->set_flashdata('master_district', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');

            redirect(base_url() . 'intern-task-list');
        }
    }

    public function intern_add_task()
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
                $this->load->view('intern-add-task', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function intern_task_list()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    //$where = '1 =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "") {
                        $taskType = $this->input->post('taskType');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . "  and status=1 and task_for=2";
                        $data['interntaskData'] = $this->Admin_model->intern_task_Data($where);
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
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=2";
                        $data['interntaskData'] = $this->Admin_model->intern_task_Data($where);
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
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=2";
                        // echo "<pre>";
                        // print_r($where);exit;
                        $data['interntaskData'] = $this->Admin_model->intern_task_Data($where);
                    } else {
                        //  $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                    }
                }
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('intern-task-list', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function request_certificate()
    {
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('request-certificate');
        $this->load->view('temp/footer');
    }

    

    public function getonline_offlineTask()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $sid = $this->session->userdata('sid');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $taskType = $this->input->post('taskType');
                    // echo "<pre>";
                    // print_r($taskType);exit;
                    $task = $this->Crud_modal->all_data_select('*', 'task', "task_type_id='$taskType'", 'task_title ASC');
                    // print_r($task);exit;
                    echo '<option value="">---Select Task---</option>';
                    foreach ($task as $taskData) {
                        $task_id = $taskData['task_id'];
                        $task_name = $taskData['task_title'];
                        echo '<option value="' . $task_id . '">' . rtrim($task_name, ' ') . '</option>';
                    }
                } else {
                    $taskType = $this->input->post('taskType');
                    $task = $this->Crud_modal->all_data_select('*', 'task', 'task_type_id=' . $taskType . ' and region_id=' . $region, 'task_title ASC');
                    // print_r($task);exit;

                    echo '<option value="">---Select Task---</option>';
                    foreach ($task as $taskData) {
                        $task_id = $taskData['task_id'];
                        $task_name = $taskData['task_title'];
                        echo '<option value="' . $task_id . '">' . rtrim($task_name, ' ') . '</option>';
                    }
                }
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function interngetonline_offlineTask()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $sid = $this->session->userdata('sid');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $taskType = $this->input->post('taskType');
                    $task = $this->Crud_modal->all_data_select('*', 'interntask', "task_type_id='$taskType'", 'task_title ASC');
                    // echo "<pre>";
                    //  print_r($task);exit;
                    echo '<option value="">---Select Task---</option>';
                    foreach ($task as $taskData) {
                        $task_id = $taskData['intern_task_id'];
                        $task_name = $taskData['task_title'];
                        echo '<option value="' . $task_id . '">' . rtrim($task_name, ' ') . '</option>';
                    }
                } else {
                    $taskType = $this->input->post('taskType');
                    $task = $this->Crud_modal->all_data_select('*', 'interntask', 'task_type_id=' . $taskType . ' and region_id=' . $region, 'task_title ASC');
                    // print_r($task);exit;

                    echo '<option value="">---Select Task---</option>';
                    foreach ($task as $taskData) {
                        $task_id = $taskData['intern_task_id'];
                        $task_name = $taskData['task_title'];
                        echo '<option value="' . $task_id . '">' . rtrim($task_name, ' ') . '</option>';
                    }
                }
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getTaskstate()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $sid = $this->session->userdata('sid');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $taskName = $this->input->post('taskName');
                    $states = $this->Admin_model->select_all_states_by_task($taskName);
                    if (empty($states[0]['state_id'])) {
                        $states = $this->Crud_modal->fetch_all_data('*', 'states','status = 1');
                    }
                    echo '<option value="">---Select State---</option>';
                    foreach ($states as $stateskData) {
                        $state_id = $stateskData['state_id'];
                        $state_name = $stateskData['state_name'];
                        echo '<option value="' . $state_id . '">' . rtrim($state_name, ' ') . '</option>';
                    }
                } else {
                   $taskName = $this->input->post('taskName');
                    $states = $this->Admin_model->select_all_states_by_task($taskName);
                    if (empty($states[0]['state_id'])) {
                        $states = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    }
                    echo '<option value="">---Select State---</option>';
                    foreach ($states as $stateskData) {
                        $state_id = $stateskData['state_id'];
                        $state_name = $stateskData['state_name'];
                        echo '<option value="' . $state_id . '">' . rtrim($state_name, ' ') . '</option>';
                    }
                }
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function interngetTaskstate()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $sid = $this->session->userdata('sid');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $taskName = $this->input->post('taskName');
                    $states = $this->Admin_model->internselect_all_states_by_task($taskName);
                    if (empty($states[0]['state_id'])) {
                        $states = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                    }
                    echo '<option value="">---Select State---</option>';
                    foreach ($states as $stateskData) {
                        $state_id = $stateskData['state_id'];
                        $state_name = $stateskData['state_name'];
                        echo '<option value="' . $state_id . '">' . rtrim($state_name, ' ') . '</option>';
                    }
                } else {
                   $taskName = $this->input->post('taskName');
                    $states = $this->Admin_model->internselect_all_states_by_task($taskName);
                    if (empty($states[0]['state_id'])) {
                        $states = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    }
                    echo '<option value="">---Select State---</option>';
                    foreach ($states as $stateskData) {
                        $state_id = $stateskData['state_id'];
                        $state_name = $stateskData['state_name'];
                        echo '<option value="' . $state_id . '">' . rtrim($state_name, ' ') . '</option>';
                    }
                }
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    function getStatetask()
    {
        $stateName = $this->input->post('stateName');
        $statestask = $this->Admin_model->select_all_task_by_state($stateName);
        // echo "<pre>";
        // print_r($statestask);exit;
        echo '<option value="">---Select Task---</option>';
        foreach ($statestask as $taskData) {
            $task_id = $taskData['task_id'];
            $task_name = $taskData['task_title'];
            echo '<option value="' . $task_id . '">' . rtrim($task_name, ' ') . '</option>';
        }
    }

    function interngetStatetask()
    {
        $stateName = $this->input->post('stateName');
        $statestask = $this->Admin_model->internselect_all_task_by_state($stateName);
        // echo "<pre>";
        // print_r($statestask);exit;
        echo '<option value="">---Select Task---</option>';
        foreach ($statestask as $taskData) {
            $task_id = $taskData['intern_task_id'];
            $task_name = $taskData['task_title'];
            echo '<option value="' . $task_id . '">' . rtrim($task_name, ' ') . '</option>';
        }
    }

    public function getTaskcity()
    {
        $stateID = $this->input->post('stateName');
        $tempcities = $this->Admin_model->select_all_city_by_task($stateID);
        echo '<option value="">Select City</option>';
        foreach ($tempcities as $key => $value) {

            echo '<option class="cv_' . $value['city_id'] . '" value="' . $value['city_id'] . '">' . ucwords($value['city_name']) . '</option>';
        }
    }


    public function fetch_task_info()
    {
        //print_r($this->input->post());
        $encode_userID = $this->input->post('volunteer_id');
        $lname = '';
        $causesN = '';
        if ($encode_userID != '') {
            $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
            $join_data = array(
                array(
                    'table' => 'assigning_task',
                    'fields' => array('task_id'),
                    'joinWith' => array('task_id'),
                    'where' => array(
                        'volunteer_id' => $userID
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task',
                    'fields' => array('task_title', 'task_brief', 'status', 'region_id', 'start_date'),
                    'joinWith' => array('task_id ', 'left'),
                    'where' => array(
                        'status !' => 1
                    ),
                ),
                array(
                    'joined' => 1,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );

            $limit = '';
            $order_by = '';

            $taskDetails = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
           
            $i = 0;
            if (sizeof($taskDetails) > 0) {
                foreach ($taskDetails as $key => $value) {
                    $fields = array(
                        'dr_date',
                    );
                    $where = array('task_id' => $value['task_id'], 'volunteer_id' => $userID);
                    $limit = 1;
                    $order_by = array('creation_date', 'DESC');
                    $daily_report_date = $this->Curl_model->fetch_data_in_many_array('daily_report', $fields, $where, $limit, $order_by);
                    $join_data = array(
                        array(
                            'table' => 'daily_report',
                            'fields' => array('dr_id', 'dr_time_in', 'volunteer_id', 'task_id', 'dr_time_out', 'dr_date', 'dr_activity'),
                            'joinWith' => array('volunteer_id'),
                            'where' => array(
                                'status' => 1,
                                'task_id' => $value['task_id'],
                                'volunteer_id' => $userID,
                                'approved_status !' => 0,
                                'approveddaily_ID !' => 0,
                            ),
                            'order_by' => array('dr_id', 'ASC'),
                            'group_by' => array('approveddaily_ID'),
                            // 'function'=>array('SUM','dailyReportTimeIn'),
                        ),
                        array(
                            'joined' => 0,
                            'table' => 'approveddaily_report',
                            'fields' => array('admin_time'),
                            'joinWith' => array('approveddaily_ID', 'left'),
                        ),
                    );
                    $limit = '';
                    $order_by = '';
                    $daily_report = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                    $phours = 0;
                    $pmint = 0;
                    $time = 0.0;
                    // echo "<pre>";
                    // print_r($daily_report);
                    // echo "</pre>";
                    foreach ($daily_report as $key => $value1) {

                        $time = explode('.', $value1['admin_time']);
                        //print_r($time);
                        $phours = $phours + $time[0];
                        $pmint = $pmint + $time[1];
                    }
                    $calcu = $pmint / 60;
                    $calcu = explode('.', $calcu);
                    $pmint = $pmint % 60;
                    $phours = $phours + $calcu[0];
                    // $phours = floor($time/(60*60));
                    // $pmint = floor(($time-($phours*(60*60)))/60);
                    //exit;
                    if ($i <= (sizeof($taskDetails) - 1)) {
                        if ($i != 0) {
                            echo "<hr>";
                        }
                    }
                    $i++;
                    # code...
?>
<div class="row form-group m-b-20">
    <div class="col-md-3">
        <h4 class="f-16 m-0 p-0 font-weight-bold">Task Title</h4>
    </div>
    <div class="col-md-9">
        <?php echo ucwords($value['task_title']); ?>
    </div>
</div>
<div class="row form-group m-b-20">
    <div class="col-md-3">
        <h4 class="f-16 m-0 p-0 font-weight-bold">Working Hours</h4>
    </div>
    <div class="col-md-9">
        <?php
                            if (sizeof($daily_report) > 0) {
                            ?>
        <?php echo $phours ?> Hours <?php echo $pmint ?> Mins
        <?php } else { ?>
        Not found
        <?php } ?>
    </div>
</div>
<div class="row form-group m-b-20">
    <div class="col-md-3">
        <h4 class="f-16  m-0 p-0 font-weight-bold">Start Working Date</h4>
    </div>
    <div class="col-md-9">
        <?php
                            if (sizeof($daily_report_date) > 0) {
                                echo date('d/m/Y', strtotime($daily_report_date[0]['dailyReportDate']));
                            } else {
                                echo "Not found";
                            }
                            ?>

    </div>
</div>
<?php

                }
            } else {
                ?>
<center>No data found</center>
<?php
            }
        }
    }

   

    public function intern_assigned_task()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
               $emp = $this->session->userdata('emp_id');
                $region = $this->session->userdata('region_id');
                $taskType = $this->input->post('taskType');
                if (!empty($this->input->post('assignTask'))) {
                    $task = $this->input->post('taskName');
                    $state = $this->input->post('stateName');
                    $assignDate = date("Y-m-d", strtotime($this->input->post('assignDate')));
                    $volunteerId = $this->input->post('interns');
                    $volunteerassignTask = array();
                    for ($i = 0; $i < count($volunteerId); $i++) {
                        $assignTask = array(
                            'intern_id' => $volunteerId[$i],
                            'intern_task_id' => $task,
                            'assigned_date' => $assignDate,
                            'assign_by_task'=>$emp,
                            'status' => 1,
                        );
                        array_push($volunteerassignTask, $assignTask);
                    }
                    $this->Crud_modal->insert_batch('intern_assigning_task', $volunteerassignTask);
                    $this->session->set_flashdata('master_insert_message', '<div class="alert alert-warning"><strong>You Assign a task!</strong></div>');
                    redirect(base_url() . 'intern-assigned-task');
                }
                $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('intern-assigned-task', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    function get_states_by_task()
    {
        $taskId = $this->input->post('taskId');
        $state = $this->Crud_modal->all_data_select('*', 'states', "region_id='$taskId'", 'state_name ASC');
        echo '<option value="">---Select State---</option>';
        foreach ($state as $state) {
            $state_id = $state['state_id'];
            $state_name = $state['state_name'];
            echo '<option value="' . $state_id . '">' . rtrim($state_name, ' ') . '</option>';
        }
    }

    public function program_volunteer()
    {

        $programName = $this->input->post('programName');
        $where = 'vpu.status =1 AND volunteer_programs = ' . $programName;
        $programData = $this->Admin_model->programvolunteer_enquiry_Data($where);
        // print_r($programData);
        // exit;
    }


       
    public function requested_task()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $data['taskId'] =  $task_id = $this->input->post('task_id');
                    $where  = 'sr.task_id=' . $task_id . '';
                    $data['requetedtask'] = $this->Admin_model->request_task_volunteer($where);
                   
                } else {
                    $data['taskId'] =  $task_id = $this->input->post('task_id');
                    $where  = 'sr.task_id=' . $task_id . '';
                    $data['requetedtask'] = $this->Admin_model->request_task_volunteer($where);
                    $data['rname'] = $this->Crud_modal->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                }

                $data['task'] = $this->Crud_modal->fetch_all_data('*', 'task', 'status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('requested-task', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

  

    public function change_password()
    {
        $CI = &get_instance();
        $userID = $this->session->userdata('userID');
        //$data['totaltask']= $this->User_model->total_task_count($userID);
        $data['totaltask'] = '';
        $userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table' => 'users',
                'fields' => array('firstName', 'lastName', 'mobile', 'email', 'userID'),
                'joinWith' => array('userID'),
                'where' => array(
                    'userID' => $userID
                ),

            ),
            array(
                'joined' => 0,
                'table' => 'user_data',
                'fields' => array('profile', 'correspontenceAddress'),
                'joinWith' => array('userID', 'left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by = '';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        if ($this->input->post()) {
            $rules_array = array(
                array(
                    'field' => 'oldpassword',
                    'label' => 'Current Password',
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => 'Please Enter Current Password',
                    ),
                ),
                array(
                    'field' => 'newpassword',
                    'label' => 'New Password',
                    'rules' => 'trim|required|min_length[8]',
                    'errors' => array(
                        'required' => 'Please Enter New Password',
                        'min_length' => 'Please Enter New Password at least 8 digits',
                    ),
                ),
                array(
                    'field' => 'confirmnewpassword',
                    'label' => 'Confirm Password',
                    'rules' => 'trim|required|matches[newpassword]',
                    'errors' => array(
                        'required' => 'Please Enter Confirm New Password',
                        'matches' => 'Confirm New Password Not Match',
                    ),
                ),
            );

            $this->form_validation->set_rules($rules_array);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('change-pwd');
            } else {
                $fields = array(
                    'password'
                );
                $where = array(
                    'userID' => $userID
                );
                $limit = '';
                $order_by = array('userID', 'DESC');
                $results = $this->Curl_model->fetch_data('users', $fields, $where, $limit, $order_by);
                //print_r($results);
                if (!empty($results) && $results != '') {
                    $r_password = $CI->get_library->decode($results['password']);
                    $oldpass = $this->input->post('oldpassword');
                    if ($oldpass == $r_password) {
                        $npass = $CI->get_library->encode($this->input->post('newpassword'));
                        $where = array(
                            'userID' => $userID,
                        );
                        $fields = array(
                            'password' => $npass
                        );
                        //die();
                        $results = $this->Curl_model->update_data('users', $fields, $where);
                        if ($results) {
                            $this->session->set_userdata('success', 'Your password has been changed');
                            echo '<script>window.location.href = "' . base_url() . 'admin-change-pwd"</script>';
                        }
                    } else {
                        $this->session->set_userdata('error', 'Plz enter right current password');
                        $this->load->view('change-pwd');
                    }
                }
            }
        } else {
            $this->load->view('change-pwd');
        }

        $this->load->view('temp/footer');
    }



    public function daily_report_approved()
    {
        $empId = $this->session->userdata('emp_id');
        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $total_time = $this->uri->segment(4);
        //$dailyReportDate = $this->uri->segment(5);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $data = array(
            'volunteer_id' => $userID,
            'task_id' => $taskID,
            'total_time' => $total_time,
            'status' => 1,
            'user_time' => $total_time,
            'admin_time' => $total_time,
            'approved_by'=>$empId,
        );
        $approveddaily_ID = $this->Curl_model->insert_data('approveddaily_report', $data);
        $where = array(
            'volunteer_id' => $userID,
            'task_id' => $taskID,
            //'CAST(`dr_date` as DATE)=' => $dailyReportDate
        );
        $fields = array(
            'approved_status' => 1,
            'approveddaily_ID' => $approveddaily_ID
        );
        $results = $this->Curl_model->update_data('daily_report', $fields, $where);

        if ($results) {
            $user_data = $this->Curl_model->fetch_data('volunteer', array('email'), array('volunteer_id' => $userID), '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $total_time_array = explode('.', $total_time);
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $msg = 'Cry VMS';
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Congratulation! </strong>Your daily report has been approved.</p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Your Total Time</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $total_time_array[0] . " Hours " . $total_time_array[1] . " Mins</td>
                </tr>
            </table>";
            //die();
            $subj = "Daily Report Activity";
            $btn = "Check Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

            $this->session->set_userdata('dailyreport_approved', 'true');
            echo '<script>window.location.href = "' . base_url() . 'admin-final-daily-report"</script>';
        }
    }

    public function intern_daily_report_approved()
    {
        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $total_time = $this->uri->segment(4);
        //$dailyReportDate = $this->uri->segment(5);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $data = array(
            'intern_id' => $userID,
            'intern_task_id' => $taskID,
            'total_time' => $total_time,
            'status' => 1,
            'user_time' => $total_time,
            'admin_time' => $total_time,
        );
        $approveddaily_ID = $this->Curl_model->insert_data('intern_dr_approval', $data);
        $where = array(
            'intern_id' => $userID,
            'intern_task_id' => $taskID,
            //'CAST(`dr_date` as DATE)=' => $dailyReportDate
        );
        $fields = array(
            'approved_status' => 1,
            'approveddaily_ID' => $approveddaily_ID
        );
        $results = $this->Curl_model->update_data('intern_daily_report', $fields, $where);

        if ($results) {
            $user_data = $this->Curl_model->fetch_data('interns', array('email'), array('intern_id' => $userID), '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $total_time_array = explode('.', $total_time);
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $msg = 'CRY VMS';
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Congratulation! </strong>Your daily report has been approved.</p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Your Total Time</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $total_time_array[0] . " Hours " . $total_time_array[1] . " Mins</td>
                </tr>
            </table>";
            //die();
            $subj = "Daily Report Activity";
            $btn = "Check Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

            $this->session->set_userdata('intern_dailyreport_approved', 'true');
            echo '<script>window.location.href = "' . base_url() . 'admin-intern-daily-report"</script>';
        }
    }


    public function daily_report_disapproved()
    {
        //echo "working";exit;
        $volunteer_id = $this->input->post('volunteer_id');
        $task_id = $this->input->post('task_id');
        $vwh = $this->input->post('vwh');
        $vwm = $this->input->post('vwm');
        $ywh = $this->input->post('ywh');
        $ywm = $this->input->post('ywm');
        $user_time = $vwh . '.' . $vwm;
        $admin_time = $ywh . '.' . $ywm;
        $reasonID = $this->input->post('reasonID');
        //$dr_date = $this->input->post('dr_date');

        $data = array(
            'volunteer_id' => $volunteer_id,
            'task_id' => $task_id,
            'total_time' => $admin_time,
            'status' => 2,
            'user_time' => $user_time,
            'admin_time' => $admin_time,
            'reason' => $reasonID,
        );
        $approveddaily_ID = $this->Curl_model->insert_data('approveddaily_report', $data);
        $where = array(
            'volunteer_id' => $volunteer_id,
            'task_id' => $task_id,
            ///'CAST(`dr_date` as DATE)=' => $dr_date
        );
        $fields = array(
            'approved_status' => 2,
            'approveddaily_ID' => $approveddaily_ID
        );
        $results = $this->Curl_model->update_data('daily_report', $fields, $where);
        if ($results) {
            $this->session->set_userdata('dailyreport_disapproved', 'true');
            echo '<script>window.location.href = "' . base_url() . 'admin-final-daily-report"</script>';
        }
    }

    public function daily_report_info()
    {
        $encode_taskID = $this->input->post('task_id');
        $encode_userID = $this->input->post('volunteer_id');
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taksID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $join_data = array(
            array(
                'table' => 'task',
                'fields' => array('task_id', 'task_title'),
                'joinWith' => array('task_id'),

            ),
            array(
                'joined' => 0,
                'table' => 'daily_report',
                'fields' => array('dr_id', 'dr_time_in', 'dr_time_out', 'dr_activity', 'dr_date', 'improvement', 'challenges', 'experience'),
                'joinWith' => array('task_id', 'volunteer_id', 'left'),
                'where' => array(
                    'volunteer_id' => $userID,
                    'task_id' => $taksID,
                    'approved_status' => 0,
                    'approveddaily_ID' => 0,
                ),
            ),
            array(
                'joined' => 1,
                'table' => 'volunteer',
                'fields' => array('first_name', 'last_name', 'mobile', 'email', 'volunteer_id'),
                'joinWith' => array('volunteer_id'),
                'where' => array(
                    'volunteer_id' => $userID
                ),

            ),
        );
        $limit = '';
        $order_by = array('dr_id', 'DESC');
        $dilyreportDetails = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        ?>
<h5 class="badge bg-warning text-black"> Name-
    <?php echo ucwords($dilyreportDetails[0]['first_name'] . ' ' . $dilyreportDetails[0]['last_name']); ?></h5>
<div class="row form-group m-b-20">
    <table id="dom-table" class="table table-striped table-bordered pre-line">
        <thead>
            <tr class="bg-gray">
                <th class="text-white">Sr</th>
                <th class="text-white">Date</th>
                <th class="text-white">Time In</th>
                <th class="text-white">Time Out</th>
                <th class="text-white">Activity</th>
                <th class="text-white">Improved Msg</th>
                <th class="text-white">Challeges Face</th>
                <th class="text-white">Experrience Any</th>
                <th class="text-white w-10">Total Time</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
                    foreach ($dilyreportDetails as $key => $value) {
                        $volunteer_id = $value['volunteer_id'];
                        $encoded_id = rtrim(strtr(base64_encode($volunteer_id), '+/', '-_'), '=');
                        $timeIn = $value['dr_time_in'];
                        $time = date('h:i A', strtotime($timeIn));
                        $timeOut = $value['dr_time_out'];
                        $time1 = date('h:i A', strtotime($timeOut));
                        $diff = abs(strtotime($time) - strtotime($time1));
                        $tmins = $diff / 60;
                        $hours = floor($tmins / 60);
                        $mins = $tmins % 60;
                        $total += $hours;
                        $totalmin += $mins;
                        $total_time1 = $total . '.' . $totalmin;
                    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo date('d/m/Y', strtotime($value['dr_date'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dr_time_in'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dr_time_out'])); ?></td>
                <td><?php echo ucwords($value['dr_activity']); ?></td>
                <td><?php echo ucwords($value['improvement']); ?></td>
                <td><?php echo ucwords($value['challenges']); ?></td>
                <td><?php echo ucwords($value['experience']); ?></td>
                <td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?></td>
            </tr>
            <?php $i++;
                    } ?><tr>
                <td colspan="8" class="text-end bg-gray text-white fw-bold">Total</td>
                <td class=" bg-gray text-white bold"><?php echo "<b>$total</b> hours <b>$totalmin</b> mins</b>" ?></td>
            </tr>
        </tbody>
    </table>

</div>
<div class="modal-footer">
    <a onclick="return confirm('Do you want to approved'); "
        href="<?php echo base_url(); ?>dailyreport-approved/<?php echo $encoded_id; ?>/<?php echo $encode_taskID; ?>/<?php echo $total_time1; ?>"><button
            type="button" class="btn btn-rounded  btn-warning ">Approve</button></a>
    <a href="#" data-toggle="modal" data-target=".project-details"
        onclick="disapproved('<?php echo $volunteer_id; ?>','<?php echo $value['task_id']; ?>','<?php echo $total_time1; ?>');"><button
            type="button" class="btn btn-rounded  btn-secondary">DisApprove</button></a>
    <button type="button" class="btn btn-rounded  btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
</div>
<?php
    }


    public function submission_report()
    {
        $sr_id = $this->input->post('sr_id');
        $encode_userID = $this->input->post('intern_id');
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $reportId = base64_decode(str_pad(strtr($sr_id, '-_', '+/'), strlen($sr_id) % 4, '=', STR_PAD_RIGHT));
        $where = 'sr_id="'.$reportId.'"';
        $limit = '';
        $order_by = array('sr_id', 'DESC');
        $dilyreportDetails = $this->Admin_model->submission_reportData($where);
      
        $where = 'at.sr_id = "'.$sr_id.'" AND at.intern_id = "'.$reportId.'" AND status = 1';
        $viewAttech = $this->Admin_model->submission_report_attecment($where);
    ?>
<h5 class="badge bg-warning text-black"> Name-
    <?php echo ucwords($dilyreportDetails[0]['first_name'] . ' ' . $dilyreportDetails[0]['last_name']); ?></h5>
<div class="row form-group m-b-20">
    <table id="dom-table" class="table table-striped table-bordered pre-line">
        <thead>
            <tr class="bg-gray">
                <th class="text-white">Sr</th>
                <th class="text-white">Date</th>
                <th class="text-white">Task</th>



            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
                    foreach ($dilyreportDetails as $key => $value) {
                        $intern_id = $value['intern_id'];
                        $sr_id = $value['sr_id'];
                        $encoded_id = rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
                        $submissionId = rtrim(strtr(base64_encode($sr_id), '+/', '-_'), '=');
                    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <!-- <td><?php echo $sr_id; ?></td>
                            <td><?php echo $intern_id; ?></td> -->
                <td><?php echo date('d-m-Y', strtotime($value['final_sunmission_date'])); ?></td>
                <td><?php echo ucwords($value['task_title']); ?></td>


            </tr>
            <?php $i++;
                    } ?>
        </tbody>
    </table>
    <div class="col-md-12">
        <div class="fs4"><strong>Task Description : </strong></div><br>
        <div class=""><?php echo ucwords($value['description']); ?></div><br>
        <div class=""><strong>Attechments </strong></div>
        <br>
        <?php $i = 1; foreach($viewAttech as $attech){?>
        <a href="<?php echo base_url(); ?>uploads/submission_report_data/<?php echo $attech['attachmentName']; ?>"
            target="_blank"> View Attechment <?php echo $i++;?></a> <b>,</b>

        <?php }?>

    </div>

</div>
<div class="modal-footer">
    <a onclick="return confirm('Do you want to approved'); "
        href="<?php echo base_url(); ?>submission-approved/<?php echo $encoded_id; ?>/<?php echo $submissionId; ?>"><button
            type="button" class="btn btn-rounded  btn-warning ">Approve</button></a>
    <a href="#" data-toggle="modal" data-target=".project-details"
        onclick="disapproved('<?php echo $intern_id; ?>','<?php echo $sr_id; ?>');"><button type="button"
            class="btn btn-rounded  btn-secondary">DisApprove</button></a>
    <button type="button" class="btn btn-rounded  btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
</div>
<?php
    }


    public function submission_approved()
    {
        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        //$dailyReportDate = $this->uri->segment(5);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'intern_id' => $userID,
            'status' => 1,
            //'CAST(`dr_date` as DATE)=' => $dailyReportDate
        );
        $fields = array(
            'status' => 2,
            // 'approveddaily_ID' => $approveddaily_ID
        );
        $results = $this->Curl_model->update_data('intern_submission_report', $fields, $where);

        if ($results) {
            $user_data = $this->Curl_model->fetch_data('interns', array('email'), array('intern_id' => $userID), '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $msg = 'CRY VMS';
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Congratulation! </strong>Your daily report has been approved.</p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Your Total Time</th>
                </tr>
            </table>";
            //die();
            $subj = "Submission Report";
            $btn = "Check Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

            $this->session->set_userdata('intern_dailyreport_approved', 'true');
            echo '<script>window.location.href = "' . base_url() . 'submission_reports"</script>';
        }
    }

    public function submission_reportReject()
    {
        //echo "working";exit;
        $intern_id = $this->input->post('intern_id');
        $sr_id = $this->input->post('sr_id');
        $reasonID = $this->input->post('reasonID');
        //print_r($intern_id);exit;
        $where = array(
            'intern_id' => $intern_id,
            'sr_id' => $sr_id,
            ///'CAST(`dr_date` as DATE)=' => $dr_date
        );
        $fields = array(
            'status' => 0,
            'Reason' => $reasonID,
        );
        $results = $this->Curl_model->update_data('intern_submission_report', $fields, $where);
        if ($results) {
            $this->session->set_userdata('submission-reportReject', 'true');
            // echo '<script>window.location.href = "' . base_url() . 'submission_reports"</script>';
            echo '1';
        }
    }

    public function daily_report_info_intern()
    {
        $encode_taskID = $this->input->post('intern_task_id');
        $encode_userID = $this->input->post('intern_id');
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taksID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $join_data = array(
            array(
                'table' => 'interntask',
                'fields' => array('intern_task_id', 'task_title'),
                'joinWith' => array('intern_task_id'),

            ),
            array(
                'joined' => 0,
                'table' => 'intern_daily_report',
                'fields' => array('intern_dr_id', 'dr_time_in', 'dr_time_out', 'dr_activity', 'dr_date', 'improvement', 'challenges', 'experience'),
                'joinWith' => array('intern_task_id', 'intern_id', 'left'),
                'where' => array(
                    'intern_id' => $userID,
                    'intern_task_id' => $taksID,
                    'approved_status' => 0,
                    //'dr_date' => "'" . $date . "'",
                    'approveddaily_ID' => 0,
                ),
            ),
            array(
                'joined' => 1,
                'table' => 'interns',
                'fields' => array('first_name', 'last_name', 'mobile', 'email', 'intern_id'),
                'joinWith' => array('intern_id'),
                'where' => array(
                    'intern_id' => $userID
                ),

            ),
        );
        $limit = '';
        $order_by = array('intern_dr_id', 'DESC');
        $dilyreportDetails = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    ?>
<h5 class="badge bg-warning text-black"> Name-
    <?php echo ucwords($dilyreportDetails[0]['first_name'] . ' ' . $dilyreportDetails[0]['last_name']); ?></h5>
<div class="row form-group m-b-20">
    <table id="dom-table" class="table table-striped table-bordered pre-line">
        <thead>
            <tr class="bg-gray">
                <th class="text-white">Sr</th>
                <th class="text-white">Date</th>
                <th class="text-white">Time In</th>
                <th class="text-white">Time Out</th>
                <th class="text-white">Activity</th>
                <th class="text-white">Improved Msg</th>
                <th class="text-white">Challeges Face</th>
                <th class="text-white">Experrience Any</th>
                <th class="text-white w-10">Total Time</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
                    foreach ($dilyreportDetails as $key => $value) {
                        $intern_id = $value['intern_id'];
                        $encoded_id = rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
                        $timeIn = $value['dr_time_in'];
                        $time = date('h:i A', strtotime($timeIn));
                        $timeOut = $value['dr_time_out'];
                        $time1 = date('h:i A', strtotime($timeOut));
                        $diff = abs(strtotime($time) - strtotime($time1));
                        $tmins = $diff / 60;
                        $hours = floor($tmins / 60);
                        $mins = $tmins % 60;
                        $total += $hours;
                        $totalmin += $mins;
                        $total_time1 = $total . '.' . $totalmin;
                    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo date('d/m/Y', strtotime($value['dr_date'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dr_time_in'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dr_time_out'])); ?></td>
                <td><?php echo ucwords($value['dr_activity']); ?></td>
                <td><?php echo ucwords($value['improvement']); ?></td>
                <td><?php echo ucwords($value['challenges']); ?></td>
                <td><?php echo ucwords($value['experience']); ?></td>
                <td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?></td>
            </tr>
            <?php $i++;
                    } ?><tr>
                <td colspan="8" class="text-end bg-gray text-white fw-bold">Total</td>
                <td class=" bg-gray text-white bold"><?php echo "<b>$total</b> hours <b>$totalmin</b> mins</b>" ?></td>
            </tr>
        </tbody>
    </table>

</div>
<div class="modal-footer">
    <a onclick="return confirm('Do you want to approved'); "
        href="<?php echo base_url(); ?>interndailyreport-approved/<?php echo $encoded_id; ?>/<?php echo $encode_taskID; ?>/<?php echo $total_time1; ?>"><button
            type="button" class="btn btn-rounded  btn-warning ">Approve</button></a>
    <a href="#" data-toggle="modal" data-target=".project-details"
        onclick="disapproved('<?php echo $intern_id; ?>','<?php echo $value['task_id']; ?>','<?php echo $total_time1; ?>');"><button
            type="button" class="btn btn-rounded  btn-secondary">DisApprove</button></a>
    <button type="button" class="btn btn-rounded  btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
</div>
<?php
    }



    public function create_role()
    {
        $userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table' => 'users',
                'fields' => array('firstName', 'lastName', 'mobile', 'email', 'userID'),
                'joinWith' => array('userID'),
                'where' => array(
                    'userID' => $userID
                ),

            ),
            array(
                'joined' => 0,
                'table' => 'user_data',
                'fields' => array('profile', 'correspontenceAddress'),
                'joinWith' => array('userID', 'left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by = '';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar');
        $this->load->view('create-role');
        $this->load->view('temp/footer');
    }


    public function user_daily_report_info()
    {
        $encode_taskID = $this->input->post('taskID');
        $encode_userID = $this->input->post('userID');
        $date = $this->input->post('dailyReportDate');
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taksID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $join_data = array(
            array(
                'table' => 'task',
                'fields' => array('taskID', 'taskTitle'),
                'joinWith' => array('taskID'),

            ),
            array(
                'joined' => 0,
                'table' => 'daily_report',
                'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity', 'dailyReportDate', 'dailyReportCreationDate'),
                'joinWith' => array('taskID', 'left'),
                'where' => array(
                    'userID' => $userID,
                    'taskID' => $taksID,
                    //'approved_status'=>0,
                    'dailyReportDate' => "'" . $date . "'",
                    //'approveddaily_ID'=>0,
                ),
            ),
        );
        $limit = '';
        $order_by = array('dailyReportID', 'DESC');
        $dilyreportDetails = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        //	print_r ('<pre>');
        //print_r ($dilyreportDetails); exit;

    ?>
<div class="row form-group m-b-20">
    <table id="dom-table" class="table table-striped table-bordered pre-line">
        <thead>
            <tr>
                <th>Sr.no</th>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Activity</th>
                <th>Total Time</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
                    foreach ($dilyreportDetails as $key => $value) {
                        $timeIn = $value['dailyReportTimeIn'];
                        $time = date('h:i A', strtotime($timeIn));
                        $timeOut = $value['dailyReportTimeOut'];
                        $time1 = date('h:i A', strtotime($timeOut));
                        $diff = abs(strtotime($time) - strtotime($time1));
                        $tmins = $diff / 60;
                        $hours = floor($tmins / 60);
                        $mins = $tmins % 60;

                    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo date('d/m/Y', strtotime($value['dailyReportDate'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dailyReportTimeIn'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dailyReportTimeOut'])); ?></td>
                <td><?php echo ucwords($value['dailyReportActivity']); ?></td>
                <td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?></td>
            </tr>
            <?php $i++;
                    } ?>
        </tbody>
    </table>

</div>
<?php
    }

    public function volunteer()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =5';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=5)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    'v.status =5';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=5)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('volunteer', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function co_volunteer_report()
    {
        // $CI = &get_instance();
        // $encode_data=$CI->get_library->encode('atif');
        // $userID = $this->session->userdata('userID');
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('volunteerID', 'firstName', 'userID', 'lastName', 'mobile', 'email', 'usersCreationDate', 'verify', 'status'),
        //         'joinWith' => array('userID'),
        //         'order_by' => array('userID', 'DESC'),
        //         'where' => array(
        //             'roleID' => 2
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('dateOfBirth', 'correspontenceAddress', 'gender', 'nationalityID', 'bloodGroupID', 'educationID', 'occupationID', 'stateID', 'cityID', 'permanentState', 'permanentCity', 'permanentAddress', 'heard_us', 'staff_member'),
        //         'joinWith' => array('userID', 'left'),
        //     ),

        //     array(
        //         'joined' => 0,
        //         'table' => 'position',
        //         'fields' => array('positionName'),
        //         'joinWith' => array('positionID', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'education',
        //         'fields' => array('educationName'),
        //         'joinWith' => array('educationID', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'occupation',
        //         'fields' => array('occupationName'),
        //         'joinWith' => array('occupationID', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'states',
        //         'fields' => array('stateName'),
        //         'joinWith' => array('stateID', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'cities',
        //         'fields' => array('cityName'),
        //         'joinWith' => array('cityID', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'nationality',
        //         'fields' => array('nationalityName'),
        //         'joinWith' => array('nationalityID', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'blood_group',
        //         'fields' => array('bloodGroupName'),
        //         'joinWith' => array('bloodGroupID', 'left'),
        //     ),
        // );

        // $limit = '';
        // $order_by = '';
        // $res['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        // $userID = $this->session->userdata('userID');
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('volunteerID', 'firstName', 'lastName', 'mobile', 'email', 'userID'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'userID' => $userID
        //         ),

        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('profile', 'correspontenceAddress'),
        //         'joinWith' => array('userID', 'left'),
        //     ),
        // );
        // $where = array();
        // $limit = '';
        // $order_by = '';
        // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('co-volunteer-report');
        $this->load->view('temp/footer');
    }

    public function tast_report()
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
                        $state_name = $this->input->post('state_name');
                        $region_id = $this->input->post('region_id');
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
                $this->load->view('tast-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function volenteership_verify()
    {
        $encode_userID = $this->uri->segment(2);
        $redirects = $this->uri->segment(3);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'userID' => $userID,
        );
        $fields = array(
            'verify' => 1
        );
        $results = $this->Curl_model->update_data('users', $fields, $where);
        if ($results) {
            $user_data = $this->Curl_model->fetch_data('users', array('email'), $where, '', '');
            // print_r();
            // die();
            $email = $user_data['email'];
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $msg = 'CRY VMS';
            $msg2 = "<p><stron style='font-weight:bold;'>Congratulation! </strong> Your account has been verified. Now, you can login your account</p>";
            $subj = "Verification mail from CRY";
            $btn = "LogIn";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
            $this->session->set_userdata('volenteership_verify', 'true');
            if ($redirects != '') {
                echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'volenteership"</script>';
            }
        }
    }

    public function volenteership_block()
    {
        $encode_userID = $this->uri->segment(2);
        $redirects = $this->uri->segment(3);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'userID' => $userID,
        );
        $fields = array(
            'verify' => 2
        );
        $results = $this->Curl_model->update_data('users', $fields, $where);
        if ($results) {
            $user_data = $this->Curl_model->fetch_data('users', array('email'), $where, '', '');
            // print_r();
            // die();
            $email = $user_data['email'];
            $href = base_url() . 'reset/' . rtrim(strtr(base64_encode($email), "+/", "-_"), "=");
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $msg = 'CRY VMS';
            $msg2 = "<p><stron style='font-weight:bold;'>Sorry! </strong> Your account has been block from admin. Please try again later</p>";
            $subj = "Verification mail from Cry";
            $btn = "Sign Up Now!";

            $html = $this->request_email_without_btn($msg, $msg2);
            $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
            $this->session->set_userdata('volenteership_block', 'true');
            if ($redirects != '') {
                echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'volenteership"</script>';
            }
        }
    }

    public function fetch_user_info()
    {
        $encode_volunteer_id = $this->input->post('volunteer_id');
        if ($encode_volunteer_id != '') {
            $volunteer_id = base64_decode(str_pad(strtr($encode_volunteer_id, '-_', '+/'), strlen($encode_volunteer_id) % 4, '=', STR_PAD_RIGHT));
            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('volunteer_id', 'first_name', 'last_name', 'mobile', 'email', 'date_of_birth', 'state_id', 'city_id', 'occupation_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('present_address', 'profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'cities',
                    'fields' => array('city_name'),
                    'joinWith' => array('city_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'occupation',
                    'fields' => array('occupation_name'),
                    'joinWith' => array('occupation_id', 'left'),
                ),
            );

            $limit = '';
            $order_by = '';

            $volunteerDetails = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        ?>
<div class="col-md-3 m-b-20 text-center">
    <?php if ($volunteerDetails['profile'] != '') { ?>
    <img src='<?php $image = $volunteerDetails['profile'];
                                echo base_url("user_profile/$image"); ?>' width="100%" height="auto"
        class="img-fluid border p-1" />
    <?php } else { ?>
    <img src="<?php echo base_url("user_profile/crop.jpg"); ?>" class="img-fluid" alt="" title="">
    <?php } ?>
</div>
<div class="col-md-8">
    <h2 class="f-14 font-medium">
        <?php echo ucwords($volunteerDetails[0]['first_name'] . ' ' . $volunteerDetails[0]['last_name']); ?></h2>
    <div class="row mb-2">
        <div class="col-4 "><b></b>Volunteer ID</div>
        <div class="col"><?php echo $volunteerDetails[0]['volunteer_id']; ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b></b>Phone</div>
        <div class="col"><?php echo $volunteerDetails[0]['mobile']; ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b></b>Email</div>
        <div class="col"><a href="#" class="text-inverse"><span
                    class="cf_email"><?php echo $volunteerDetails[0]['email']; ?></span></a></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b></b>Date of Birth</div>
        <div class="col"><?php if ($volunteerDetails['date_of_birth'] != '0000-00-00') {
                                            echo ucwords(date("d-m-Y", strtotime($volunteerDetails[0]['date_of_birth'])));
                                        } ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b></b>State</div>
        <div class="col"><?php echo $volunteerDetails[0]['state_name']; ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b></b>City</div>
        <div class="col"><?php echo $volunteerDetails[0]['city_name']; ?></div>
    </div>
    <!-- <div class="row mb-2">
                    <div class="col-4 "><b></b>Address</div>
                    <div class="col"><?php echo $volunteerDetails[0]['present_address']; ?></div>
                </div> -->
    <div class="row mb-2">
        <div class="col-4 "><b></b>Occupation</div>
        <div class="col "><?php echo ucwords($volunteerDetails[0]['occupation_name']); ?></div>
    </div>
</div>
<?php
        }
    }

    public function fetch_intern_info()
    {
        $encode_intern_id = $this->input->post('intern_id');
        // echo $encode_intern_id;exit;
        if ($encode_intern_id != '') {
            $intern_id = base64_decode(str_pad(strtr($encode_intern_id, '-_', '+/'), strlen($encode_intern_id) % 4, '=', STR_PAD_RIGHT));
            //echo $intern_id;exit;
            $join_data = array(
                array(
                    'table' => 'interns',
                    'fields' => array('intern_id', 'first_name', 'last_name', 'mobile', 'email', 'date_of_birth', 'state_id', 'city_id', 'occupation_id','past_volunteering','what_you_aim'),
                    'joinWith' => array('intern_id'),
                    'where' => array(
                        'intern_id' => $intern_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'skills',
                    'fields' => array('skill_name', 'skill_id'),
                    'joinWith' => array('skill_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'cities',
                    'fields' => array('city_name'),
                    'joinWith' => array('city_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'occupation',
                    'fields' => array('occupation_name'),
                    'joinWith' => array('occupation_id', 'left'),
                ),
            );

            $limit = '';
            $order_by = '';

            $internDetails = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            // echo '<pre>';
            // print_r($internDetails);exit;
        ?>
<div class="col-md-3 m-b-20 text-center">
    <?php if ($internDetails['profile'] != '') { ?>
    <img src='<?php $image = $internDetails['profile'];
                                echo base_url("user_profile/$image"); ?>' width="100%" height="auto"
        class="img-fluid border p-1" />
    <?php } else { ?>
    <img src="<?php echo base_url("user_profile/crop.jpg"); ?>" class="img-fluid" alt="" title="">
    <?php } ?>
</div>
<div class="col-md-8">
    <h2 class="f-14 font-medium">
        <?php echo ucwords($internDetails[0]['first_name'] . ' ' . $internDetails[0]['last_name']); ?></h2>
    <div class="row mb-2">
        <div class="col-4 "><b>intern ID</b></div>
        <div class="col"><?php echo $internDetails[0]['intern_id']; ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b>Phone</b></div>
        <div class="col"><?php echo $internDetails[0]['mobile']; ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b>Email</b></div>
        <div class="col"><a href="#" class="text-inverse"><span
                    class="cf_email"><?php echo $internDetails[0]['email']; ?></span></a></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b>Date of Birth</b></div>
        <div class="col"><?php if ($internDetails['date_of_birth'] != '0000-00-00') {
                                            echo ucwords(date("d-m-Y", strtotime($internDetails[0]['date_of_birth'])));
                                        } ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b>State</b></div>
        <div class="col"><?php echo $internDetails[0]['state_name']; ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-4 "><b>City</b></div>
        <div class="col"><?php echo $internDetails[0]['city_name']; ?></div>
    </div>

    <div class="row mb-2">
        <div class="col-4 "><b>Occupation</b></div>
        <div class="col "><?php echo ucwords($internDetails[0]['occupation_name']); ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-12 fs-6"><b>Question : Mention past volunteering and Internships you may have done?</b></div>
        <div class="col "><?php echo ucwords($internDetails[0]['past_volunteering']); ?></div>
    </div>
    <div class="row mb-2">
        <div class="col-12 fs-6"><b>Question : What you aim to value add on if chosen for an Internship with CRY ?</b>
        </div>
        <div class="col "><?php echo ucwords($internDetails[0]['what_you_aim']); ?></div>
    </div>
</div>
<?php
        }
    }


    public function uploadProfilefortask()
    {
        if (($this->session->userdata('userID') != "")) {
            $userID = $this->session->userdata('userID');
            $this->load->library('image_lib');
            $imageName = time() . $_FILES['profile']['name'];
            //echo $imageName; exit;
            $image = str_replace(" ", "_", $imageName);
            $config = array();
            $config['upload_path'] = './user_profile/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $image;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload("profile")) {
                echo $imageName;
                //$success = $this->User_model->userimg_file($image,$userID);
                // if($success != FALSE){
                //     echo 1;
                // }
                // else{ echo 2; }
            } else {
                print_r($this->upload->display_errors());
                exit;
            }
        } else {
            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        }
    }

    public function uploadProfile()
    {
        if (($this->session->userdata('userID') != "")) {
            $userID = $this->session->userdata('userID');
            $this->load->library('image_lib');
            $imageName = time() . $_FILES['profile']['name'];
            //echo $imageName; exit;
            $image = str_replace(" ", "_", $imageName);
            $config = array();
            $config['upload_path'] = './user_profile/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $image;
            print_r($config);
            die;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload("profile")) {
                $success = $this->User_model->userimg_file($image, $userID);
                if ($success != FALSE) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                print_r($this->upload->display_errors());
                exit;
            }
        } else {
            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        }
    }

    public function intern_task_accept()
    {

        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $redirects = $this->uri->segment(4);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $data = array(
            'intern_id' => $userID,
            'intern_task_id' => $taskID,
            //'status' => 1
        );

        $assigningTaskID = $this->Curl_model->insert_data('intern_assigning_task', $data);

        if ($assigningTaskID > 0) {
            $join_data = array(
                array(
                    'table' => 'interntask',
                    'fields' => array('task_description', 'intern_task_id', 'task_title', 'region_id', 'task_brief', 'start_date', 'status', 'status'),
                    'where' => array('intern_task_id' => $taskID),
                    'order_by' => array('intern_task_id', 'DESC'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $join_data1 = array(

                array(
                    'joined' => 0,
                    'table' => 'cities',
                    'fields' => array('city_name'),
                    'joinWith' => array('city_id', 'left'),
                ),
            );

            $limit = '';
            $order_by = '';
            $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
            $user_data = $this->Curl_model->fetch_data('interns', array('email'), $where, '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'testvms@mgracesolution.com';
            $msg = 'CRY VMS intern';

            function task_type($stauts)
            {
                if ($stauts == 0) {
                    return "<span style='padding:5px 10px;margin-right:5px;background-color:green;color:white;border-radius:10px;text-align:center;'>New</span>";
                }
                if ($stauts == 2) {
                    return "<span style='padding:5px 10px;margin-right:5px;background-color:orange;color:white;border-radius:10px;text-align:center;'>In-Working</span>";
                }
            }
            $task_stauts = task_type($task_data[0]['taskStatus']);
            $tlocation = '';
            $count = 1;
            foreach ($task_location_data as $key1 => $value1) {
                $tlocation .= "<span style='display:block;float:left; padding:5px 10px;margin-right:5px;margin-bottom:5px;background-color:#8f281f;color:white;border-radius:10px;text-align:center;'>" . $value1['cityName'] . "</span>";
                if (($count % 3) == 0) {
                    $tlocation .= "<br>";
                }
                $count++;
            }
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Congratulation! </strong>your task request has been accepted. Your assigned task Details is given below</p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['taskTitle'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Description</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['taskDescription'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Theme</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['causesName'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Type</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_stauts . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Location</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $tlocation . "</td>
                </tr>
            </table>";
            //die();
            $subj = "Assigned Task reminder from Caritas India";
            $btn = "Check Your Task Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

            $where = array(
                'intern_id' => $userID,
                'intern_task_id' => $taskID,
            );
            $fields = array(
                'status' => 1,
                'accepted_date' => date('Y-m-d h:i:s'),
            );

            $results = $this->Curl_model->update_data('intern_send_request', $fields, $where);

            $where = array(
                'intern_task_id' => $taskID,
                'intern_id' => $userID,
            );
            $fields = array(
                'status' => 1,
                'accepted_date' => date('y-m-d'),
            );
            $results = $this->Curl_model->update_data('intern_assigning_task', $fields, $where);


            if ($results) {
                $this->session->set_userdata('task_accept', 'true');
                if ($redirects != '') {
                    echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
                } else {
                    echo '<script>window.location.href = "' . base_url() . 'intern-requested-task"</script>';
                }
            }
        }
    }

    public function admin_task_accept()
    {

        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $redirects = $this->uri->segment(4);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        //echo $taskID;exit;
        $data = array(
            'volunteer_id' => $userID,
            'task_id' => $taskID,
            // 'assignedDate' => date('Y-m-d'),
        );

        $assigningTaskID = $this->Curl_model->insert_data('assigning_task', $data);
        if ($assigningTaskID > 0) {
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_description', 'task_id', 'task_title', 'region_id', 'task_brief', 'start_date', 'status', 'status'),
                    'where' => array('task_id' => $taskID),
                    'order_by' => array('task_id', 'DESC'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $join_data1 = array(
                
                array(
                    'joined' => 0,
                    'table' => 'cities',
                    'fields' => array('city_name'),
                    'joinWith' => array('city_id', 'left'),
                ),
            );

            $limit = '';
            $order_by = '';
            $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
            $user_data = $this->Curl_model->fetch_data('volunteer', array('email'), $where, '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'testvms@mgracesolution.com';
            $msg = 'CRY VMS Volunteer';

            function task_type($stauts)
            {
                if ($stauts == 0) {
                    return "<span style='padding:5px 10px;margin-right:5px;background-color:green;color:white;border-radius:10px;text-align:center;'>New</span>";
                }
                if ($stauts == 2) {
                    return "<span style='padding:5px 10px;margin-right:5px;background-color:orange;color:white;border-radius:10px;text-align:center;'>In-Working</span>";
                }
            }
            $task_stauts = task_type($task_data[0]['taskStatus']);
            $tlocation = '';
            $count = 1;
            foreach ($task_location_data as $key1 => $value1) {
                $tlocation .= "<span style='display:block;float:left; padding:5px 10px;margin-right:5px;margin-bottom:5px;background-color:#8f281f;color:white;border-radius:10px;text-align:center;'>" . $value1['cityName'] . "</span>";
                if (($count % 3) == 0) {
                    $tlocation .= "<br>";
                }
                $count++;
            }
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Congratulation! </strong>your task request has been accepted. Your assigned task Details is given below</p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['taskTitle'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Description</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['taskDescription'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Theme</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['causesName'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Type</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_stauts . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Location</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $tlocation . "</td>
                </tr>
            </table>";
            //die();
            $subj = "Assigned Task reminder from Caritas India";
            $btn = "Check Your Task Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

            $where = array(
                'volunteer_id' => $userID,
                'task_id' => $taskID,
            );
            $fields = array(
                'status' => 1,
                'accepted_date' => date('Y-m-d h:i:s'),
            );

            $results = $this->Curl_model->update_data('send_requiest', $fields, $where);

            $where = array(
                'task_id' => $taskID,
                'volunteer_id' => $userID,
            );
            $fields = array(
                'status' => 1,
                'accepted_date' => date('y-m-d'),
            );
            $results = $this->Curl_model->update_data('assigning_task', $fields, $where);


            if ($results) {
                $this->session->set_userdata('task_accept', 'true');
                if ($redirects != '') {
                    echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
                } else {
                    echo '<script>window.location.href = "' . base_url() . 'requested-task"</script>';
                }
            }
        }
    }

    public function admin_task_reject()
    {
        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $redirects = $this->uri->segment(4);
        $volunteer_id = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $task_id = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'volunteer_id' => $volunteer_id,
            'task_id' => $task_id,
        );
        $fields = array(
            'status' => 2,
            'rejected_date' => date('Y-m-d h:i:s'),
        );
        $results = $this->Curl_model->update_data('send_requiest', $fields, $where);
        if ($results) {
            $user_data = $this->Curl_model->fetch_data('volunteer', array('email'), array('volunteer_id' => $volunteer_id), '', '');
            // print_r();
            // die();
            $email = $user_data['email'];
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $href = base_url() . 'login';
            $msg = 'CRY VMS';
            $msg2 = "<p><stron style='font-weight:bold;'>Sorry! </strong> Your task request has been rejected. Please try other task.</p>";
            $subj = "Your task request status";
            $btn = "LogIn";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
            $this->session->set_userdata('task_reject', 'true');
            if ($redirects != '') {
                echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'requested-task"</script>';
            }
        }
    }

    public function intern_task_reject()
    {
        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $redirects = $this->uri->segment(4);
        $volunteer_id = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $task_id = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'intern_id' => $volunteer_id,
            'intern_task_id' => $task_id,
        );
        $fields = array(
            'status' => 2,
            'rejected_date' => date('Y-m-d h:i:s'),
        );
        $results = $this->Curl_model->update_data('intern_send_request', $fields, $where);
        if ($results) {
            $user_data = $this->Curl_model->fetch_data('interns', array('email'), array('intern_id' => $volunteer_id), '', '');
            // print_r();
            // die();
            $email = $user_data['email'];
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $href = base_url() . 'login';
            $msg = 'CRY VMS';
            $msg2 = "<p><stron style='font-weight:bold;'>Sorry! </strong> Your task request has been rejected. Please try other task.</p>";
            $subj = "Your task request status";
            $btn = "LogIn";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
            $this->session->set_userdata('task_reject', 'true');
            if ($redirects != '') {
                echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'intern-requested-task"</script>';
            }
        }
    }

    public function cancel_assined_task()
    {
        $encode_assigned_taskID = $this->uri->segment(2);
        $redirects = $this->uri->segment(3);
        $assigned_taskID = base64_decode(str_pad(strtr($encode_assigned_taskID, '-_', '+/'), strlen($encode_assigned_taskID) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'assigned_task_id' => $assigned_taskID,
        );
        $fields = array(
            'status' => 2,
            'rejected_date' => date('Y-m-d'),
            'other_reason' => 'From Admin Side',
        );
        $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
        if ($results) {
            $this->session->set_userdata('cancel_assined_task', $assigned_taskID);
            if ($redirects != '') {
                echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'view-assigned-task"</script>';
            }
        }
    }
    public function cancel_assined_task_intern()
    {
        $encode_assigned_taskID = $this->uri->segment(2);
        $redirects = $this->uri->segment(3);
        $assigned_taskID = base64_decode(str_pad(strtr($encode_assigned_taskID, '-_', '+/'), strlen($encode_assigned_taskID) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'intern_assigned_task_id' => $assigned_taskID,
        );
        $fields = array(
            'status' => 2,
            'rejected_date' => date('Y-m-d'),
            'other_reason' => 'From Admin Side',
        );
        $results = $this->Curl_model->update_data('intern_assigning_task', $fields, $where);
        if ($results) {
            $this->session->set_userdata('cancel_assined_task', $assigned_taskID);
            if ($redirects != '') {
                echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'view-intern-assigned-task"</script>';
            }
        }
    }

    public function mail_send($to, $from, $msg, $msg2, $subj, $link, $btn, $html)
    {
    
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "noreply@crymail.org";
        $mail->Password = "^%n7wh#m7_2k";
        $mail->setFrom($from);
        $mail->AddAddress($to);
        //$mail->AddAddress('atifahmad07860@gmail.com');
        $mail->addBCC("ravishankar.k@neuralinfo.org", "Pransi");
        $mail->FromName = $msg;
        $mail->IsHTML(true);
        $mail->Subject = $subj;
        $mail->Body = $html;
        if (!$mail->Send()) {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            return true;
        }
    }

    public function request_email($msg, $msg2, $link, $btn)
    {
        $html = '<div style="margin:0;padding:0" bgcolor="#FFFFFF">

        <table style="min-width:348px" width="100%" lang="en" height="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr style="height:32px" height="32">
                    <td>
                    </td>
                </tr>
                <tr align="center">
                    <td>
                        <div>
                            <div>
                            </div>
                        </div>
                        <table style="padding-bottom:20px;max-width:516px;min-width:220px" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="width:8px" width="8">
                                    </td>
                                    <td>
                                        <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" class="m_-3835115663774870952mdv2rw" align="center">
                                            <img src="https://mgracesolution.com/cryvms/users/assets/images/brand/ezgif.com-gif-maker.gif"
                                             aria-hidden="true" style="margin-bottom:16px" alt="caritas india" class="" width="150" height="70">
                                            <div style="border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                            <div style="font-size:24px">
                                                ' . $msg . '
                                            </div>
                                                
                                            </div>
                                            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                            ' . $msg2 . '<div style="padding-top:32px;text-align:center">
                                            <a href="' . $link . '" 
                                            style="line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#8e2c24;border-radius:5px;min-width:90px" 
                                            target="_blank" 
                                            data-saferedirecturl="' . $link . '">
                                            ' . $btn . '</a>
                                            </div>
                                            </div>
                                        </div>
                                        <div style="text-align:left">
                                            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                            <div>
                                                Cry VMS Headquarter:
                                                189/A Anand Estate, Diagonally Opposite Arthur Road Jail,
                                                Sane Guruji Marg, Mumbai – 400011</div>
                                            <div style="direction:ltr">
                                                Tel - 91-9115 9115 00 <a class="m_-3835115663774870952afal" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                                    Email - volunteer@cryvms.in</a>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width:8px" width="8">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="height:32px" height="32">
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>';
        return $html;
    }

    public function request_email_without_btn($msg, $msg2)
    {
        $html = '<div style="margin:0;padding:0" bgcolor="#FFFFFF">

        <table style="min-width:348px" width="100%" lang="en" height="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr style="height:32px" height="32">
                    <td>
                    </td>
                </tr>
                <tr align="center">
                    <td>
                        <div>
                            <div>
                            </div>
                        </div>
                        <table style="padding-bottom:20px;max-width:516px;min-width:220px" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="width:8px" width="8">
                                    </td>
                                    <td>
                                        <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" class="m_-3835115663774870952mdv2rw" align="center">
                                            <img src="https://mgracesolution.com/cryvms/users/assets/images/brand/ezgif.com-gif-maker.gif"
                                             aria-hidden="true" style="margin-bottom:16px" alt="caritas india" class="" width="150" height="70">
                                            <div style="border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                            <div style="font-size:24px">
                                                ' . $msg . '
                                            </div>
                                                
                                            </div>
                                            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                            ' . $msg2 . '<div style="padding-top:32px;text-align:center">
                                            </div>
                                            </div>
                                        </div>
                                        <div style="text-align:left">
                                            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                            <div>
                                                Cry VMS Headquarter:
                                                189/A Anand Estate, Diagonally Opposite Arthur Road Jail,
                                                Sane Guruji Marg, Mumbai – 400011</div>
                                            <div style="direction:ltr">
                                                Tel - 91 -9115 9115 00 <a class="m_-3835115663774870952afal" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                                    Email - volunteer@cryvms.in</a>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width:8px" width="8">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="height:32px" height="32">
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>';
        return $html;
    }

    public function intern_requested_task()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $data['taskId'] =  $task_id = $this->input->post('task_id');
                    $where  = 'isr.intern_task_id=' . $task_id . '';
                    $data['requetedtask'] = $this->Admin_model->request_task_intern($where);
                } else {

                    $data['taskId'] =  $task_id = $this->input->post('task_id');
                    $where  = 'isr.intern_task_id=' . $task_id . '';
                    $data['requetedtask'] = $this->Admin_model->request_task_intern($where);
                    $data['rname'] = $this->Crud_modal->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                }

                $data['interntask'] = $this->Crud_modal->fetch_all_data('*', 'interntask', 'status=1 AND region_id =' . $region . '');
                // echo "<pre>";
                // print_r($data['interntask']);
                // exit;
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('intern-request-task', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function volenteership_daily_report()
    {
        $userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table' => 'users',
                'fields' => array('firstName', 'lastName', 'mobile', 'email', 'userID'),
                'joinWith' => array('userID'),
                'where' => array(
                    'userID' => $userID
                ),

            ),
            array(
                'joined' => 0,
                'table' => 'user_data',
                'fields' => array('profile', 'correspontenceAddress'),
                'joinWith' => array('userID', 'left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by = '';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);


        $CI = &get_instance();
        $fields = array(
            'taskID',
            'taskTitle',
            'status',
            'taskStatus'
        );
        $where = array('status' => 1);
        $limit = '';
        $order_by = array('taskPublishedDate', 'DESC');
        $task = $this->Curl_model->fetch_data_in_many_array('task', $fields, $where, $limit, $order_by);
        $data['task'] = $task;
        $fields = array(
            'resionID',
            'resionName',
        );
        $where = array('status' => 1);
        $limit = '';
        $order_by = array('resionID', 'DESC');
        $data['mm_resion'] = $this->Curl_model->fetch_data_in_many_array('mm_resion', $fields, $where, $limit, $order_by);
        if ($this->input->get()) {
            $encode_userID = $this->uri->segment(2);
            $volunteerID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
            // print_r($this->input->get());
            $taskID = $this->input->get('taskID');
            $date = date("Y-m-d", strtotime($this->input->get('asdate')));
            $data['taskID'] = $taskID;
            $data['birthday'] = $date;
            //die();
            $join_data = array(
                array(
                    'table' => 'daily_report',
                    'fields' => array('dailyReportID', 'dailyReportTimeIn', 'userID', 'taskID', 'dailyReportTimeOut', 'dailyReportDate', 'dailyReportActivity'),
                    'joinWith' => array('userID'),
                    'where' => array(
                        'status' => 1,
                        'taskID' => $taskID,
                        'userID' => $volunteerID,
                        //'approved_status'=>0,
                        'dailyReportDate <' => "'" . $date . "'",
                        //'approveddaily_ID'=>0,
                    ),
                    'order_by' => array('dailyReportID', 'DESC'),
                    'group_by' => array('userID'),
                    // 'function'=>array('SUM','dailyReportTimeIn'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'users',
                    'fields' => array('verify', 'userID', 'firstName', 'lastName', 'mobile', 'email', 'usersCreationDate'),
                    'joinWith' => array('userID', 'left'),
                ),
                array(
                    'joined' => 1,
                    'table' => 'user_data',
                    'fields' => array('correspontenceAddress', 'stateID', 'cityID', 'gender'),
                    'joinWith' => array('userID', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'states',
                    'fields' => array('stateName'),
                    'joinWith' => array('stateID', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'cities',
                    'fields' => array('cityName'),
                    'joinWith' => array('cityID', 'left'),
                ),
            );

            $limit = '';
            $order_by = '';
            $data['daily_report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //print_r($data['daily_report']); exit();
        }


        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar');
        $this->load->view('volunteer-daily-report', $data);
        $this->load->view('temp/footer');
    }

    public function volenteership_daily_report_info()
    {
        $encode_taskID = $this->input->post('taskID');
        $encode_userID = $this->input->post('userID');
        $date = $this->input->post('dailyReportDate');
        //print_r($this->input->post());
        //exit;
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taksID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $join_data = array(
            array(
                'table' => 'task',
                'fields' => array('taskID', 'taskTitle'),
                'joinWith' => array('taskID'),

            ),
            array(
                'joined' => 0,
                'table' => 'daily_report',
                'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity', 'dailyReportDate'),
                'joinWith' => array('taskID', 'left'),
                'where' => array(
                    'userID' => $userID,
                    'taskID' => $taksID,
                    //'approved_status'=>0,
                    'dailyReportDate' => "'" . $date . "'",
                    //'approveddaily_ID'=>0,
                ),
            ),
        );
        $limit = '';
        $order_by = array('dailyReportID', 'DESC');
        $dilyreportDetails = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        //print_r ('<pre>');
        //print_r ($dilyreportDetails); exit;

        ?>
<div class="row form-group m-b-20">
    <table id="dom-table" class="table table-striped table-bordered pre-line">
        <thead>
            <tr>
                <th>Sr.no</th>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Activity</th>
                <th>Total Time</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
                    foreach ($dilyreportDetails as $key => $value) {
                        $timeIn = $value['dailyReportTimeIn'];
                        $time = date('h:i A', strtotime($timeIn));
                        $timeOut = $value['dailyReportTimeOut'];
                        $time1 = date('h:i A', strtotime($timeOut));
                        $diff = abs(strtotime($time) - strtotime($time1));
                        $tmins = $diff / 60;
                        $hours = floor($tmins / 60);
                        $mins = $tmins % 60;

                    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo date('d/m/Y', strtotime($value['dailyReportDate'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dailyReportTimeIn'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dailyReportTimeOut'])); ?></td>
                <td><?php echo ucwords($value['dailyReportActivity']); ?></td>
                <td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?></td>
            </tr>
            <?php $i++;
                    } ?>
        </tbody>
    </table>

</div>
<?php
    }

    public function export()
    {
        try {
            if ($this->session->userdata('roleID') == 1 && $this->session->userdata('userID') != "" || $this->session->userdata('userID') != null) {
                $this->load->library("excel");
                $table_columns = array("Patner title .", "Name", "Email", "Mobile", "Registration Date");
                $column = 0;
                foreach ($table_columns as $field) {
                }
                $this->db->select('*');
                $this->db->from($this->nama_tabel);
                $this->db->join('region_master', 'region_master.region_id = ' . $this->nama_tabel . '.region_id');
                $this->db->where($this->nama_tabel . '.status=1');
                $user_data = $this->db->get();
                $excel_row = 2;
        ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col"><b>#</b></th>
            <th scope="col"><b>Registration Date</b></th>
            <th scope="col"><b>Name</b></th>
            <th scope="col"><b>Email</b></th>
            <th scope="col"><b>Mobile No.</b></th>
            <th scope="col"><b>Region</b></th>
        </tr>
    </thead>
    <tbody>

        <?php
                        $c = 1;
                        foreach ($user_data->result() as $key => $value) {
                        ?>
        <tr>
            <th scope="row"><b><?php echo $c++; ?></b></th>
            <td><?php echo date('d-m-Y', strtotime($value->creation_date)); ?></td>
            <td><?php echo ucwords($value->name); ?></td>
            <td><?php echo $value->email; ?></td>
            <td><?php $mobile = str_replace(',', '/', trim($value->mobile));
                                    $mobile = str_replace(' ', '/', $mobile);
                                    $mobile = str_replace('//', '/', $mobile);
                                    echo $mobile; ?></td>
            <td><?php echo $value->region_name; ?></td>
        </tr>
        <?php // print_r($value); 
                            ?>
        <?php } ?>
    </tbody>
</table>
<button onclick="exportTableToCSV('members.csv')" id="csbbtn">Export HTML Table To CSV File</button>

<?php
            } else {
                redirect('admin');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
        }
    }


    public function export1()
    {
        try {
            if ($this->session->userdata('roleID') == 1 && $this->session->userdata('userID') != "" || $this->session->userdata('userID') != null) {
                $this->load->library("excel");
                $object = new PHPExcel();
                $object->setActiveSheetIndex(0);
                $table_columns = array("Patner title .", "Name", "Email", "Mobile", "Registration Date");
                $column = 0;
                foreach ($table_columns as $field) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                    $column++;
                }
                $user_data = $this->db->get($this->nama_tabel);
                $excel_row = 2;
                //foreach($user_data->result() as $row)
                // {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, 'a');
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, 'a');
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, 'a');
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, 'a');
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, 'a');
                $excel_row++;
                //}
                $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="Conclave_registration_2019.xls"');
                $object_writer->save('php://output');
            } else {
                redirect('admin');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
        }
    }


    public function daily_report_self_approved()
    {
        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $total_time = $this->uri->segment(4);
        $dailyReportDate = $this->uri->segment(5);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $vself_task_id = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $data = array(
            'volunteer_id' => $userID,
            'vself_task_id' => $vself_task_id,
            'total_time' => $total_time,
            'status' => 1,
            'user_time' => $total_time,
            'admin_time' => $total_time,
        );
        $approveddaily_ID = $this->Curl_model->insert_data('approveddaily_report', $data);
        $where = array(
            'volunteer_id' => $userID,
            'vself_task_id' => $vself_task_id,
            'CAST(`dailyReportDate` as DATE)=' => $dailyReportDate
        );
        $fields = array(
            'approved_status' => 1,
            'approveddaily_ID' => $approveddaily_ID
        );
        $results = $this->Curl_model->update_data('self_task_daily_report', $fields, $where);

        if ($results) {
            $user_data = $this->Curl_model->fetch_data('volunteer', array('email'), array('volunteer_id' => $userID), '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $total_time_array = explode('.', $total_time);
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $msg = 'CRY VMS';
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Congratulation! </strong>Your daily report has been approved.</p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Your Total Time</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $total_time_array[0] . " Hours " . $total_time_array[1] . " Mins</td>
                </tr>
            </table>";
            //die();
            $subj = "Daily Report Activity";
            $btn = "Check Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

            $this->session->set_userdata('dailyreport_approved1', 'true');
            echo '<script>window.location.href = "' . base_url() . 'view-self-task-report"</script>';
        }
    }

    public function daily_report_self_disapproved()
    {
        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $total_time = $this->uri->segment(4);
        $dailyReportDate = $this->uri->segment(5);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $vself_task_id = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $data = array(
            'volunteer_id' => $userID,
            'vself_task_id' => $vself_task_id,
            'total_time' => $total_time,
            'status' => 2,
            'user_time' => $total_time,
            'admin_time' => $total_time,
        );
        $approveddaily_ID = $this->Curl_model->insert_data('approveddaily_report', $data);
        $where = array(
            'volunteer_id' => $userID,
            'vself_task_id' => $vself_task_id,
            'CAST(`dailyReportDate` as DATE)=' => $dailyReportDate
        );
        $fields = array(
            'approved_status' => 2,
            'approveddaily_ID' => $approveddaily_ID
        );
        $results = $this->Curl_model->update_data('self_task_daily_report', $fields, $where);

        if ($results) {
            $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $total_time_array = explode('.', $total_time);
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $msg = 'CRY VMS';
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Congratulation! </strong>Your daily report has been approved.</p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Your Total Time</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $total_time_array[0] . " Hours " . $total_time_array[1] . " Mins</td>
                </tr>
            </table>";
            //die();
            $subj = "Daily Report Activity";
            $btn = "Check Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

            $this->session->set_userdata('dailyreport_disapproved1', 'true');
            echo '<script>window.location.href = "' . base_url() . 'view-self-task-report"</script>';
        }
    }

    public function donate_user()
    {
        $join_data = array(
            array(
                'table' => 'vol_donation_data',
                'fields' => array('vol_donation_data_id', 'first_name', 'mobile', 'email', 'my_donation', 'amount', 'status'),
                'order_by' => array('vol_donation_data_id', 'desc'),
            ),

        );

        $limit = '';
        $order_by = array('vol_donation_data_id', 'DESC');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('donate_user', $data);
        $this->load->view('temp/footer');
    }


    public function insert_menu_master()
    {
        try {
            $createdata = array(
                'menu_description' => $this->input->post('menu_description'),
                'menu_route_name' => $this->input->post('menu_route_name'),
                'creation_date' => date('Y-m-d H:i:s'),
                'status' => $this->input->post('status'),
            );

            $this->Crud_modal->data_insert('master_menu', $createdata);
            $this->session->set_flashdata('master_insert_message', '<div class="alert alert-info"><strong>Success!</strong> masters has Inserted.</div>');
            redirect(base_url() . 'view-menu');
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function add_menu_form()
    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('add-menu-form');
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function view_add_menu()
    {
        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $data['master_menu'] = $this->Crud_modal->fetch_alls('master_menu', 'menu_id  desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('view-menu', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_menu_form()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $menu_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($menu_id, '-_', '+/'), strlen($menu_id) % 4, '=', STR_PAD_RIGHT));
                $where = "menu_id = '$val'";
                $data['menu'] = $this->Crud_modal->all_data_select('*', 'master_menu', $where, 'menu_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('edit-menu-form', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_menu_master()
    {
        $menu_id = $this->input->post('menu_id');
        $menu_description = $this->input->post('menu_description');
        $menu_route_name = $this->input->post('menu_route_name');
        $status = $this->input->post('status');
        $update_data = array(
            'menu_description' => $menu_description,
            'menu_route_name' => $menu_route_name,
            'status' => $status,
            'modification_date' => date('Y-m-d')
        );
        $where = "menu_id = '$menu_id'";
        if ($this->Crud_modal->update_data($where, 'master_menu', $update_data)) {
            $this->session->set_flashdata('master_menud', '<div class="alert alert-warning"><strong>Success!</strong> Menu Data has Updated.</div>');
            redirect(base_url() . 'view-menu');
        } else {
            $this->session->set_flashdata('master_menud', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');
            redirect(base_url() . 'view-menu');
        }
    }

    public function view_sub_menu()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $data['master_sub_menu'] = $this->Crud_modal->fetch_alls('master_sub_menu', 'sub_menu_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('view-sub-menu', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function sub_menu_form()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $data['master_menu'] = $this->Crud_modal->fetch_alls('master_menu', 'menu_id ASC');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('sub-menu-form', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insert_sub_menu_master()
    {
        try {
            $createdata = array(
                'menu_id' => $this->input->post('user'),
                'sub_menu_description' => $this->input->post('sub_menu_description'),
                'sub_menu_route' => $this->input->post('sub_menu_route'),
                'creation_date' => date('Y-m-d H:i:s'),
                'status' => $this->input->post('status'),
            );
            $this->Crud_modal->data_insert('master_sub_menu', $createdata);
            $this->session->set_flashdata('master_sub_menu_insert_message', '<div class="alert alert-info"><strong>Success!</strong> sub menu master has Inserted.</div>');
            redirect(base_url() . 'view-sub-menu');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_sub_menu_form()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $sub_menu_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($sub_menu_id, '-_', '+/'), strlen($sub_menu_id) % 4, '=', STR_PAD_RIGHT));
                // print_r($val);exit;
                $where = "sub_menu_id = '$val'";
                $data['sub_menu'] = $this->Crud_modal->all_data_select('*', 'master_sub_menu', $where, 'sub_menu_id desc');
                // echo "<pre>";
                // print_r($data['sub_menu']);exit;
                $data['master_menu'] = $this->Crud_modal->fetch_alls('master_menu', 'menu_id ASC');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('edit-sub-menu-form', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_sub_menu_master()
    {
        $sub_menu_id = $this->input->post('sub_menu_id');
        $sub_menu_description = $this->input->post('sub_menu_description');
        $sub_menu_route = $this->input->post('sub_menu_route');
        $status = $this->input->post('status');
        $update_data = array(
            'sub_menu_id' => $sub_menu_id,
            'sub_menu_description' => $sub_menu_description,
            'sub_menu_route' => $sub_menu_route,
            'status' => $status,
            'modification_date' => date('Y-m-d')
        );
        // echo "<pre>";
        // print_r($update_data);exit;
        $where = "sub_menu_id = '$sub_menu_id'";
        if ($this->Crud_modal->update_data($where, 'master_sub_menu', $update_data)) {
            $this->session->set_flashdata('master_sub_menud', '<div class="alert alert-warning"><strong>Success!</strong> Sub Menu Data has Updated.</div>');
            redirect(base_url() . 'view-sub-menu');
        } else {
            $this->session->set_flashdata('master_sub_menud', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');
            redirect(base_url() . 'view-sub-menu');
        }
    }

    public function view_add_role()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $data['master_role'] = $this->Crud_modal->fetch_alls('master_role', 'role_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('view-add-role', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function new_role()
    { {
            try {
                if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                    $this->load->view('temp/head');
                    $this->load->view('temp/header');
                    $this->load->view('temp/sidebar');
                    $this->load->view('new-role');
                    $this->load->view('temp/footer');
                } else {
                    redirect(base_url() . 'login', 'refresh');
                }
            } catch (Exception $e) {

                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }

    public function insert_role_master()
    {
        try {
            $createdata = array(
                'role_name' => $this->input->post('role_name'),
                'role_description' => $this->input->post('role_name'),
                'creation_date' => date('Y-m-d H:i:s'),
                'status' => $this->input->post('status'),
            );
            $result =   $this->Crud_modal->data_insert('master_role', $createdata);
            // echo "<pre>";
            // print_r($result);exit;
            $this->session->set_flashdata('role_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Role Master has Inserted.</div>');
            redirect(base_url() . 'view-add-role');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_role()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $role_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($role_id, '-_', '+/'), strlen($role_id) % 4, '=', STR_PAD_RIGHT));
                $where = "role_id = '$val'";
                $data['role'] = $this->Crud_modal->all_data_select('*', 'master_role', $where, 'role_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('edit-role', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_role_master()
    {
        $role_id = $this->input->post('role_id');
        $role_name = $this->input->post('role_name');
        $role_de = $this->input->post('role_name');
        $status = $this->input->post('status');
        $update_data = array(
            'role_name' => $role_name,
            'role_description' => $role_de,
            'status' => $status,
            'modification_date' => date('Y-m-d')
        );
        $where = "role_id = '$role_id'";
        if ($this->Crud_modal->update_data($where, 'master_role', $update_data)) {
            $this->session->set_flashdata('master_role_message', '<div class="alert alert-warning"><strong>Success!</strong> Role Data has Updated.</div>');
            redirect(base_url() . 'view-add-role');
        } else {
            $this->session->set_flashdata('master_role_message', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');
            redirect(base_url() . 'view-add-role');
        }
    }


    public function view_add_permission()
    { {
            try {
                if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                    $data['master_permission'] = $this->Crud_modal->fetch_alls('master_permission', 'permission_id desc');
                    $this->load->view('temp/head');
                    $this->load->view('temp/header');
                    $this->load->view('temp/sidebar');
                    $this->load->view('view-add-permission', $data);
                    $this->load->view('temp/footer');
                } else {
                    redirect(base_url() . 'login', 'refresh');
                }
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }

    public function insert_permission_master()
    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

                $createdata = array(

                    'permission_description' => $this->input->post('permission_name'),

                    'creation_date' => date('Y-m-d H:i:s'),

                    'status' => $this->input->post('status'),

                );

                $this->Crud_modal->data_insert('master_permission', $createdata);

                $this->session->set_flashdata('permission_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Permission has Inserted.</div>');

                redirect(base_url() . 'view-add-permission');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function add_permission()
    {
        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('add-permission');
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_permission()
    {
        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

                $permission_id = $this->uri->segment(2);

                $val = base64_decode(str_pad(strtr($permission_id, '-_', '+/'), strlen($permission_id) % 4, '=', STR_PAD_RIGHT));

                $where = "permission_id = '$val'";

                $data['permission'] = $this->Crud_modal->all_data_select('*', 'master_permission', $where, 'permission_id desc');

                $this->load->view('temp/head');

                $this->load->view('temp/header');

                $this->load->view('temp/sidebar');

                $this->load->view('edit-permission', $data);

                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_permission_master()
    {

        $permission_id = $this->input->post('permission_id');
        $permission_de = $this->input->post('permission_name');
        $status = $this->input->post('status');
        $update_data = array(
            'permission_description' => $permission_de,
            'status' => $status,
            'modification_date' => date('Y-m-d')
        );
        // echo "<pre>";
        // print_r($update_data);exit;



        $where = "permission_id = '$permission_id'";

        if ($this->Crud_modal->update_data($where, 'master_permission', $update_data)) {

            $this->session->set_flashdata('master_permission_message', '<div class="alert alert-warning"><strong>Success!</strong> Permission Data has Updated.</div>');

            redirect(base_url() . 'view-add-permission');
        } else {

            $this->session->set_flashdata('master_role_message', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');

            redirect(base_url() . 'view-add-permission');
        }
    }

    public function map_role_permission()

    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $where = "status = '1'";
                $data['master_menu'] = $this->Crud_modal->all_data_select('*', 'master_menu', $where, 'menu_id ASC');
                $where1 = "status = '1'";
                $data['master_sub_menu'] = $this->Crud_modal->all_data_select('*', 'master_sub_menu', $where1, 'sub_menu_id ASC');
                $where2 = "status = '1'";
                $data['master_sub_sub_menu'] = $this->Crud_modal->all_data_select('*', 'master_sub_sub_menu', $where2, 'sub_sub_menu_id ASC');
                $where3 = "status = '1'";
                $data['master_role'] = $this->Crud_modal->all_data_select('*', 'master_role', $where3, 'role_id ASC');
                $where4 = "status = '1'";
                $data['master_permission'] = $this->Crud_modal->all_data_select('*', 'master_permission', $where4, 'permission_id ASC');
                $where5 = "status = '1'";
                $data['mapping_role_data'] = $this->Crud_modal->all_data_select('*', 'mapping_role_permission_master_menu', $where5, 'role_id ASC');
                $this->load->view('temp/head', $data);
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar', $data);
                $this->load->view('map-role-permission', $data);
                $this->load->view('temp/footer', $data);
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function map_role_permission_form_save()

    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {


                $menu_count = count($this->input->post('main_menu_id'));

                $sub_count = count($this->input->post('sub_menu_id'));

                //$sub_sub_count = count($this->input->post('sub_sub_menu_id'));

                $menu_id = $this->input->post('main_menu_id');

                // print_r($menu_id);

                $sub_id = $this->input->post('sub_menu_id');

                //$sub_sub_id = $this->input->post('sub_sub_menu_id');

                $loopj_count = 0;

                $loopk_count = 0;

                for ($i = 0; $i <= $menu_count - 1; $i++) {

                    $m = $menu_id[$i];

                    $string[$i] = $m . "|";

                    for ($j = 0; $j <= $sub_count - 1; $j++) {

                        $subb_id = explode('$', $sub_id[$j]);

                        $s = $subb_id[0];

                        if ($m == $s) {

                            $string[$i] .= $sub_id[$j] . "|";
                        }
                    }

                    $string[$i] = rtrim($string[$i], '|');

                    // print_r($string);



                    //print_r($string);

                }

                $access_master_menu = implode('&&', $string);

                $role = $this->input->post('group_type');

                $perm = $this->input->post('Permission');

                $permission = implode('|', $perm);



                $table_name = 'mapping_role_permission_master_menu';

                $field = array(

                    'role_id' => $role,

                    'permission_id' => $permission,

                    'menu_master_id' => $access_master_menu,

                    'status' => 1,

                    'creation_date' => date('Y-m-d H:i:s')

                );

                $orderby = 'role_id ASC';

                $where1 = "role_id = '$role' and status=1";

                $data1 = $this->Crud_modal->all_data_select('*', 'mapping_role_permission_master_menu', $where1, $orderby);

                if ($data1) {

                    echo 0;
                } else {

                    $data = $this->Crud_modal->data_insert($table_name, $field);

                    if ($data) {

                        echo 1;
                    }
                }
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function  edit_map_role_permission()
    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

                $data['title'] = 'Admin Dashboard for caritas';

                $val = base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));

                $where = "status = '1'";

                $data['master_menu'] = $this->Crud_modal->all_data_select('*', 'master_menu', $where, 'menu_id ASC');

                $where1 = "status = '1'";

                $data['master_sub_menu'] = $this->Crud_modal->all_data_select('*', 'master_sub_menu', $where1, 'sub_menu_id ASC');

                $where2 = "status = '1'";

                $data['master_sub_sub_menu'] = $this->Crud_modal->all_data_select('*', 'master_sub_sub_menu', $where2, 'sub_sub_menu_id ASC');

                $where3 = "status = '1'";

                $data['master_role'] = $this->Crud_modal->all_data_select('*', 'master_role', $where3, 'role_id ASC');

                $where4 = "status = '1'";

                $data['master_permission'] = $this->Crud_modal->all_data_select('*', 'master_permission', $where4, 'permission_id ASC');

                $where5 = "status = '1' and role_id = '$val'";

                $data['mapping_role_data'] = $this->Crud_modal->all_data_select('*', 'mapping_role_permission_master_menu', $where5, 'role_id ASC');



                //print_r($data['master_role']); exit;



                $this->load->view('temp/head');

                $this->load->view('temp/header');

                $this->load->view('temp/sidebar');

                $this->load->view('edit-map-role-permission', $data);

                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_map_role_permission_form_save()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $menu_count = count($this->input->post('main_menu_id'));
                $sub_count = count($this->input->post('sub_menu_id'));
                $menu_id = $this->input->post('main_menu_id');
                $role_id = $this->input->post('update_role_id');
                $sub_id = $this->input->post('sub_menu_id');
                $loopj_count = 0;
                $loopk_count = 0;
                for ($i = 0; $i <= $menu_count - 1; $i++) {
                    $m = $menu_id[$i];
                    $string[$i] = $m . "|";
                    for ($j = 0; $j <= $sub_count - 1; $j++) {
                        $subb_id = explode('$', $sub_id[$j]);
                        $s = $subb_id[0];
                        if ($m == $s) {
                            $string[$i] .= $sub_id[$j] . "|";
                        }
                    }
                    $string[$i] = rtrim($string[$i], '|');
                    //print_r($string);

                }
                $access_master_menu = implode('&&', $string);
                $role = $this->input->post('group_type');
                $perm = $this->input->post('Permission');
                $permission = implode('|', $perm);
                //$portids = implode(',',$pids);
                $field = array(
                    'permission_id' => $permission,
                    'menu_master_id' => $access_master_menu,
                    'modification_date' => date('Y-m-d H:i:s')
                );
                $where = "role_id = '$role_id'";
                $tblname = 'mapping_role_permission_master_menu';
                $data = $this->Crud_modal->update_data($where, $tblname, $field);
                // $orderby= 'role_id ASC';
                // $where1 = "role_id = '$role' and status=1";
                // $data1 = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where1,$orderby);
                if ($data) {
                    $this->session->set_flashdata('master_map_message', '<div class="alert alert-info"><strong>Success!</strong> Mapping data has been Updated.</div>');
                    redirect(base_url() . 'map-role-permission');
                } else {

                    echo 0;
                }
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function add_state()
    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('add-state');
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insert_state()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

                $createdata = array(
                    'state_name' => $this->input->post('state_name'),
                    'code' => $this->input->post('code'),
                    'status' => $this->input->post('status'),

                );
                $this->Crud_modal->data_insert('states', $createdata);
                $this->session->set_flashdata('state_insert_message', '<div class="alert alert-info"><strong>Success!</strong> State has Inserted.</div>');

                redirect(base_url() . 'add-state-list');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function add_state_list()
    {
        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

                $data['state'] = $this->Crud_modal->fetch_alls('states', 'state_id  desc');
                // echo "<pre>";
                // print_r($data['state']);exit;

                $this->load->view('temp/head');

                $this->load->view('temp/header');

                $this->load->view('temp/sidebar');

                $this->load->view('add-state-list', $data);

                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_state()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $s_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($s_id, '-_', '+/'), strlen($s_id) % 4, '=', STR_PAD_RIGHT));
                $where = "state_id = '$val'";
                $data['state'] = $this->Crud_modal->all_data_select('*', 'states', $where, 'state_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('edit-state', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_state()
    {
        $sid = $this->input->post('state_id');
        $state_name = $this->input->post('state_name');
       $code= $this->input->post('code');
        $status = $this->input->post('status');
        $updatestate = array(
            'state_name' => $state_name,
            'status' => $status,
            'code'=>$code,
        );
        
        $where = "state_id = '$sid'";

        if ($this->Crud_modal->update_data($where,'states',$updatestate)) {
            $this->session->set_flashdata('master_states', '<div class="alert alert-warning"><strong>Success!</strong> State Data has Updated.</div>');
            redirect(base_url() . 'add-state-list');
        } else {
            $this->session->set_flashdata('master_states', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');
            redirect(base_url() . 'add-state-list');
        }
    }

    public function add_city_list()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $data['cities'] = $this->Crud_modal->fetch_alls('cities', 'city_id desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('add-city-list', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function add_city()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $data['state'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('add-city', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insert_city()
    {
        try {
            $state_name = $this->input->post('state_name');
            $city_name = $this->input->post('city_name');
            $code = $this->input->post('code');
            $status = $this->input->post('status');
            $createdata = array(
                //'country_id' => 101,
                'state_id' => $state_name,
                'city_name' => $city_name,
                'code' => $code,
                'status' => $status,
            );
            // echo "<pre>";
            // print_r($createdata);
            // exit;

            $this->Crud_modal->data_insert('cities', $createdata);
            $this->session->set_flashdata('district_insert_message', '<div class="alert alert-info"><strong>Success!</strong> District has Inserted.</div>');
            redirect(base_url() . 'add-district-list');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_city()
    {
        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $ci_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($ci_id, '-_', '+/'), strlen($ci_id) % 4, '=', STR_PAD_RIGHT));
                $where = $val;
                $data['cities'] = $this->Admin_model->all_City_data($where);
                $data['state'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('edit-city', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_city()
    {
        $city_id = $this->input->post('city_id');
        $name = $this->input->post('city_name');
        $state_id = $this->input->post('state_id');
        $code = $this->input->post('code');
        $status = $this->input->post('status');
        $update_data = array(
            'city_name' => $name,
            'state_id' => $state_id,
            'code' => $code,
            'status' => $status,
        );
        $where = "city_id = '$city_id'";
        if ($this->Crud_modal->update_data($where, 'cities', $update_data)) {
            $this->session->set_flashdata('master_district', '<div class="alert alert-warning"><strong>Success!</strong> District Data has Updated.</div>');
            redirect(base_url() . 'add-district-list');
        } else {
            $this->session->set_flashdata('master_district', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');

            redirect(base_url() . 'add-district-list');
        }
    }

    public function addregions()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $data['state'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                // echo "<pre>";
                // print_r($data['state']);exit;
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('addregions', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insert_region()
    {
        try {
            $createdata = array(
                //'country_id' => 101,
                'state_id' => implode(',', $this->input->post('states')),

                'region_name' => $this->input->post('region_name'),
                'region_status' => $this->input->post('status'),
            );
            //  echo "<pre>";
            //  print_r($createdata);exit;

            $result =  $this->Crud_modal->data_insert_returnid('regions', $createdata);
            $updat_region = $this->Admin_model->updateStateregion($result, $this->input->post('states'));
            //    $update_new = implode(',', $updat_region);


            $this->session->set_flashdata('district_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Regions has Inserted.</div>');
            redirect(base_url() . 'regions-list');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function region_list()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                // $data['region'] = $this->Admin_model->get_all_region_data();
                $data['region'] = $this->Crud_modal->fetch_all_data('*', 'regions', '1=1');
                // echo "<pre>";
                // print_r($data['region']);exit;
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('regions-list', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_addregions()
    {
        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $ci_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($ci_id, '-_', '+/'), strlen($ci_id) % 4, '=', STR_PAD_RIGHT));
                $where = "region_id = '$val'";
                $data['region'] = $this->Crud_modal->all_data_select('*', 'regions', $where, 'region_id desc');
                // echo "<pre>";
                // print_r($data['region']);exit;
                $data['state'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('edit-addregions', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function send_reminder()
    {
        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $encode_assigned_taskID = $this->uri->segment(4);
        $redirects = $this->uri->segment(5);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $assigned_taskID = base64_decode(str_pad(strtr($encode_assigned_taskID, '-_', '+/'), strlen($encode_assigned_taskID) % 4, '=', STR_PAD_RIGHT));
        $join_data = array(
            array(
                'table' => 'task',
                'fields' => array('task_id', 'task_title', 'task_brief', 'creation_date', 'status'),
                'where' => array('task_id' => $taskID),
                'order_by' => array('task_id', 'DESC'),
            ),

        );
        $join_data1 = array(

            array(
                'joined' => 0,
                'table' => 'cities',
                'fields' => array('city_name'),
                'joinWith' => array('city_id', 'left'),
            ),
        );
        //$where = 'assigned_task_id = "'.$assigned_taskID.'"';
        $limit = '';
        $order_by = '';
        $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        // echo "<pre>";
        // print_r($task_data);exit;
        $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
        //$user_data = $this->Curl_model->fetch_data('volunteer', array('email'), $where, '', '');
        $user_data = $this->Curl_model->fetch_data('volunteer', array('email'), array('volunteer_id' => $userID), '', '');
      $email = $user_data['email'];
        $href = base_url() . 'login';
        //$href2 = base_url().'verify/'.md5($results);
        $to = $email;
        $from = 'noreply@crymail.org';
        $msg = 'Cry Vms';
        function task_type($stauts)
        {
            if ($stauts == 0) {
                return "<span style='padding:5px 10px;margin-right:5px;background-color:green;color:white;border-radius:10px;text-align:center;'>New</span>";
            }
            if ($stauts == 2) {
                return "<span style='padding:5px 10px;margin-right:5px;background-color:orange;color:white;border-radius:10px;text-align:center;'>In-Working</span>";
            }
        }
        $task_stauts = task_type($task_data[0]['status']);
        $msg2 = "
            <center><p><strong style='font-weight:bold;'>Please check your task assigned list and reply for that some task had been assigned to you. Task details is given below</strong></p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_title'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Description</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_brief'] . "</td>
                </tr>
                
               
                
            </table>";
        //die();
        $subj = "Assigned Task reminder from Cry Vms";
        $btn = "Check Your Assigned Task Now!";

        $html = $this->request_email($msg, $msg2, $href, $btn);
        $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
        $where = array(
            'assigned_task_id' => $assigned_taskID,
        );
        $reminder_data = $this->Curl_model->fetch_data('assigning_task', array('reminder'), $where, '', '');
        $fields = array(
            'reminder' => $reminder_data['reminder'] + 1,
        );
        $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
        if ($results) {
            $this->session->set_userdata('task_reminder', $reminder_data['reminder'] + 1);
            if ($redirects != '') {
                echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'view-assigned-task"</script>';
            }
        }
    }

    public function send_reminder_intern()
    {
        $encode_userID = $this->uri->segment(2);
        $encode_taskID = $this->uri->segment(3);
        $encode_assigned_taskID = $this->uri->segment(4);
        $redirects = $this->uri->segment(5);
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $assigned_taskID = base64_decode(str_pad(strtr($encode_assigned_taskID, '-_', '+/'), strlen($encode_assigned_taskID) % 4, '=', STR_PAD_RIGHT));
        $join_data = array(
            array(
                'table' => 'interntask',
                'fields' => array('intern_task_id', 'task_title', 'task_brief', 'creation_date', 'status'),
                'where' => array('intern_task_id' => $taskID),
                'order_by' => array('intern_task_id', 'DESC'),
            ),

        );
        $join_data1 = array(

            array(
                'joined' => 0,
                'table' => 'cities',
                'fields' => array('city_name'),
                'joinWith' => array('city_id', 'left'),
            ),
        );
        //$where = 'assigned_task_id = "'.$assigned_taskID.'"';
        $limit = '';
        $order_by = '';
        $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
        //$user_data = $this->Curl_model->fetch_data('volunteer', array('email'), $where, '', '');
        $user_data = $this->Curl_model->fetch_data('interns', array('email'), array('intern_id' => $userID), '', '');
      $email = $user_data['email'];
      
        $href = base_url() . 'login';
        //$href2 = base_url().'verify/'.md5($results);
        $to = $email;
        $from = 'noreply@crymail.org';
        $msg = 'Cry Vms';
        function task_type($stauts)
        {
            if ($stauts == 0) {
                return "<span style='padding:5px 10px;margin-right:5px;background-color:green;color:white;border-radius:10px;text-align:center;'>New</span>";
            }
            if ($stauts == 2) {
                return "<span style='padding:5px 10px;margin-right:5px;background-color:orange;color:white;border-radius:10px;text-align:center;'>In-Working</span>";
            }
        }
        $task_stauts = task_type($task_data[0]['status']);
        $msg2 = "
            <center><p><strong style='font-weight:bold;'>Please check your task assigned list and reply for that some task had been assigned to you. Task details is given below</strong></p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_title'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Description</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_brief'] . "</td>
                </tr>
                
                
                
            </table>";
        //die();
        $subj = "Assigned Task reminder from Cry Vms";
        $btn = "Check Your Assigned Task Now!";

        $html = $this->request_email($msg, $msg2, $href, $btn);
        $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
        $where = array(
            'intern_assigned_task_id' => $assigned_taskID,
        );
        $reminder_data = $this->Curl_model->fetch_data('intern_assigning_task', array('reminder'), $where, '', '');
        $fields = array(
            'reminder' => $reminder_data['reminder'] + 1,
        );
        $results = $this->Curl_model->update_data('intern_assigning_task', $fields, $where);
        if ($results) {
            $this->session->set_userdata('task_reminder', $reminder_data['reminder'] + 1);
            if ($redirects != '') {
                echo '<script>window.location.href = "' . base_url($redirects) . '"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'view-intern-assigned-task"</script>';
            }
        }
    }

    public function update_region()
    {

        $regionId = $this->input->post('region_id');
        $regionName = $this->input->post('region_name');
        $stateName = implode(',', $this->input->post('state_id'));
        $status = $this->input->post('region_status');

        $updateRegiondata = array(
            'region_id' => $regionId,
            'region_name' => $regionName,
            'state_id' => $stateName,
            'region_status' => $status
        );
        //echo "<pre>";
        //print_r($this->input->post('state_id'));exit;
        $where = "region_id = '$regionId'";
        if ($this->Crud_modal->update_data($where, 'regions', $updateRegiondata)) {
            $updat_region = $this->Admin_model->updateStateregion($regionId, $this->input->post('state_id'));
            $this->session->set_flashdata('master_district', '<div class="alert alert-warning"><strong>Success!</strong> District Data has Updated.</div>');
            redirect(base_url() . 'regions-list');
        } else {
            $this->session->set_flashdata('master_district', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');

            redirect(base_url() . 'regions-list');
        }
    }


    public function employee_master_list()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $data['state'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                $data['employee'] = $this->Admin_model->get_all_employee();
                // echo "<pre>";
                // print_r($data['employee']);exit;
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('employee-master-list', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function add_employee()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                //$data['state'] = $this->Crud_modal->fetch_all_data('*', 'states', '1=1');
                $data['designationData'] =$designation= $this->Crud_modal->fetch_all_data('*', 'designation', 'status=1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $data['master_role'] = $this->Crud_modal->fetch_all_data('*', 'master_role', 'status=1');
                // echo "<pre>";
                // print_r($data['regions']);exit;
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('add-employee', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_employee()
    {
        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $emp_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($emp_id, '-_', '+/'), strlen($emp_id) % 4, '=', STR_PAD_RIGHT));
                $where = "emp_id = '$val'";
                $data['employee'] = $this->Admin_model->fetch_emp_data($where);
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $data['role'] = $this->Crud_modal->fetch_all_data('*', 'master_role', 'status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('edit-employee', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insert_employee()
    {
        try {
            $createdata = array(
                'region_id' => $this->input->post('region_id'),
                'role_id' => $this->input->post('role_id'),
                'emp_name' => $this->input->post('emp_name'),
                'des_id' => $this->input->post('designation'),
                'sid' => implode(',', $this->input->post('state_name')),
                'emp_contact' => $this->input->post('mobile_number'),
                'emp_email' => $this->input->post('email'),
                'emp_password' => md5($this->input->post('password')),
                'emp_gender' => $this->input->post('gender'),
                'status' => $this->input->post('status'),
            );
            //  echo "<pre>";
            //  print_r($createdata);exit;

            $this->Crud_modal->data_insert('employee', $createdata);
            $this->session->set_flashdata('district_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Regions has Inserted.</div>');
            redirect(base_url() . 'employee-master-list');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_employee()
    {

        $emp_id = $this->input->post('emp_id');
        $region_id = $this->input->post('region_id');
        $role_id = $this->input->post('role_id');
        $emp_name = $this->input->post('emp_name');
        $mobile_number = $this->input->post('mobile_number');
        $email = $this->input->post('email');
        $gender = $this->input->post('emp_gender');
        $status = $this->input->post('status');

        $updateRegiondata = array(
            'emp_id' => $emp_id,
            'region_id' => $region_id,
            'role_id' => $role_id,
            'emp_name' => $emp_name,
            'emp_contact' => $mobile_number,
            'emp_email' => $email,
            'emp_gender' => $gender,
            'status' => $status

        );
        // echo "<pre>";
        // print_r($updateRegiondata);exit;
        $where = "emp_id = '$emp_id'";
        if ($this->Crud_modal->update_data($where, 'employee', $updateRegiondata)) {
            $this->session->set_flashdata('master_district', '<div class="alert alert-warning"><strong>Success!</strong> District Data has Updated.</div>');
            redirect(base_url() . 'employee-master-list');
        } else {
            $this->session->set_flashdata('master_district', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');

            redirect(base_url() . 'employee-master-list');
        }
    }

    public function forgot_password()
    {
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('forgot-password');
        $this->load->view('temp/footer');
    }

    public function applied_candidates()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
               $data['regionData']= $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'i.status =1 OR i.status =2';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $state_name = $this->input->post('state_name');
                        $data['date_from'] = $date_from = date("Y-m-d", strtotime($date1));
                        $data['date_to'] =     $date_to = date("Y-m-d", strtotime($date2));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and i.state_id=" . $state_name . "  and (i.status=1 OR i.status=2)";
                        $data['intern'] = $this->Admin_model->intern_enquiry_Data($where);
                        // echo "<pre>";
                        // print_r($data['intern']);exit;
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'i.status =1 OR i.status =2';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $date1 = date("Y-m-d", strtotime($this->input->post('start_new')));
                        $date2 = $this->input->post('end_new');
                        $state_name = $this->input->post('state_name');
                        $data['date_from'] = $date_from = date("Y-m-d", strtotime($date1));
                        $data['date_to'] =     $date_to = date("Y-m-d", strtotime($date2));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and i.state_id=" . $state_name . "  and (i.status=1 OR i.status=2)";
                        $data['intern'] = $this->Admin_model->intern_enquiry_Data($where);
                        // echo "<pre>";
                        // print_r($data['intern']);exit;
                    }
                }
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('applied-candidates', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }



    public function admin_self_task_daily_report()
    {
        // $data['startDate'] = date('m/d/Y');
        // $data['endDate'] = date('Y-m-d', strtotime('-28 days', strtotime($data['startDate'])));
        // $where111['vself_task_id !'] = 0;
        // if ($this->input->post('submit')) {
        //     if ($this->input->post('submit') == "Search") {
        //print_r($this->input->post('datefilter')); die();
        // $datefilter = $this->input->post('datefilter');

        // $datefilter = explode("-", $datefilter);
        //print_r($datefilter); die;
        // $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
        // $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1])));
        //die;
        //$date = explode('-',$this->input->post('datefilter'));
        // if(sizeof($date)>0)
        // {
        // $data['startDate'] = $first_date;
        // $data['endDate'] = $second_date;
        //}
        //die();
        //     }
        // }
        // $where222['status'] = 1;
        // $where112['dailyReportDate'] = "'" . date("Y-m-d", strtotime($data['startDate'])) . "'";
        // $where113['dailyReportDate'] = "'" . date("Y-m-d", strtotime($data['endDate'])) . "'";
        // $join_data = array(
        //     array(
        //         'table' => 'self_task_daily_report',
        //         'fields' => array('vself_task_id', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity', 'dailyReportCreationDate', 'dailyReportDate', 'task_title', 'challeges_face', 'improved_msg', 'dailyReportActivity'),
        //         'joinWith' => array('userID'),
        //         'where' => $where111,
        //         'order_by' => array('vself_task_id', 'DESC'),
        //         'where_function' => array(
        //             array('CAST', 'DATE', $where112, '<'),
        //             array('CAST', 'DATE', $where113, '>')
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'users',
        //         'fields' => array('firstName', 'lastName', 'userID'),
        //         'joinWith' => array('userID', 'left'),
        //     ),
        // );
        // $limit = '';
        // $order_by = array('vself_task_id', 'DESC');
        // $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        // $userID = $this->session->userdata('userID');
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('firstName', 'lastName', 'mobile', 'email', 'userID'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'userID' => $userID
        //         ),

        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('profile', 'correspontenceAddress'),
        //         'joinWith' => array('userID', 'left'),
        //     ),
        // );
        // $where = array();
        // $limit = '';
        // $order_by = '';
        // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('self_task_daily_report');
        $this->load->view('temp/footer');
    }


    public function fetch_self_daily_report_info()
    {
        $encode_taskID = $this->input->post('vself_task_id');
        $encode_userID = $this->input->post('userID');
        $date = $this->input->post('dailyReportDate');
        //print_r($this->input->post());
        //exit;
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taksID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        //echo $userID;
        //echo  $taksID; exit;
        $join_data = array(
            array(
                'table' => 'self_task_daily_report',
                'fields' => array('vself_task_id', 'task_title', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity', 'dailyReportDate', 'improved_msg', 'challeges_face', 'experience_any'),
                'joinWith' => array('userID'),
                'where' => array(
                    'userID' => $userID,
                    'vself_task_id' => $taksID,
                    'approved_status' => 0,
                    'dailyReportDate' => "'" . $date . "'",
                    'approveddaily_ID' => 0,
                ),

            ),
            array(
                'joined' => 0,
                'table' => 'users',
                'fields' => array('firstName', 'lastName', 'mobile', 'email', 'userID'),
                'joinWith' => array('userID'),
                'where' => array(
                    'userID' => $userID
                ),

            ),

        );
        $limit = '';
        $order_by = array('vself_task_id', 'DESC');
        $dilyreportDetails = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        //print_r ('<pre>');
        //print_r ($dilyreportDetails); exit;

        ?>
<h5 class="badge badge-primary"> Name-
    <?php echo ucwords($dilyreportDetails[0]['firstName'] . ' ' . $dilyreportDetails[0]['lastName']); ?></h5>
<div class="row form-group m-b-20">
    <table id="dom-table" class="table table-striped table-bordered pre-line">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Activity</th>
                <th>Improved Msg</th>
                <th>Challeges Face</th>
                <th>Experrience Any</th>
                <!--<th>Total Time</th>-->
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
                    foreach ($dilyreportDetails as $key => $value) {
                        $timeIn = $value['dailyReportTimeIn'];
                        $time = date('h:i A', strtotime($timeIn));
                        $timeOut = $value['dailyReportTimeOut'];
                        $time1 = date('h:i A', strtotime($timeOut));
                        $diff = abs(strtotime($time) - strtotime($time1));
                        $tmins = $diff / 60;
                        $hours = floor($tmins / 60);
                        $mins = $tmins % 60;

                    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo date('d/m/Y', strtotime($value['dailyReportDate'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dailyReportTimeIn'])); ?></td>
                <td><?php echo date('h:i A', strtotime($value['dailyReportTimeOut'])); ?></td>
                <td><?php echo ucwords($value['dailyReportActivity']); ?></td>
                <td><?php echo ucwords($value['improved_msg']); ?></td>
                <td><?php echo ucwords($value['challeges_face']); ?></td>
                <td><?php echo ucwords($value['experrience_any']); ?></td>
                <!--<td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?></td>-->
            </tr>
            <?php $i++;
                    } ?>
        </tbody>
    </table>

</div>
<?php
    }

   

    public function all_onboard_intern()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'i.status =7';
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
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and i.state_id=" . $state_name . "  and (i.status=7)";
                        $data['intern'] = $this->Admin_model->intern_enquiry_Data($where);
                        // echo "<pre>";
                        // print_r($data['volunteer']);exit;
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'i.status =7';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $data['state'] =   $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and i.state_id=" . $state_name . "  and (i.status=7)";
                        $data['intern'] = $this->Admin_model->intern_enquiry_Data($where);
                    }
                }

                $data['email_templates'] = $this->Crud_modal->fetch_single_data('email_templates_id,body_content', 'email_templates', 'status=1 AND email_templates_id=4');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('all-onboard-intern', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function final_daily_report()
    {
        
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    if ($this->input->post('start_new') != "" &&  $this->input->post('task_id') != "") {
                        $date1 = date("Y-m-d", strtotime($this->input->post('start_new')));
                        $taskName = $this->input->post('task_id');
                        $data['dr_date'] = $date1;
                        $data['task'] = $taskName;
                        $where = "dr.dr_date>='" . $date1 . "' and dr.task_id=" . $taskName . " AND (v.status=5) and dr.approved_status=0";
                     
                        $data['volunteerdailyReport'] = $this->Admin_model->volunteer_dailyReportData($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    if ($this->input->post('start_new') != "" &&  $this->input->post('end_new') != "" &&  $this->input->post('task_id') != "") {
                        $date1 = date("Y-m-d", strtotime($this->input->post('start_new')));
                        $date2 = date("Y-m-d", strtotime($this->input->post('end_new')));
                        $taskName = $this->input->post('task_id');
                        $data['start_new'] = $date1;
                        $data['end_new'] = $date2;
                        $data['task_id'] = $taskName;
                        $where = "dr.dr_date>='" . $date1 . "' and dr.dr_date<='" . $date2 . "' and dr.task_id=" . $taskName . "  and (v.status=5) and  dr.approved_status=0";
                        // echo "<pre>";
                        // print_r($where);exit;
                        $data['volunteerdailyReport'] = $this->Admin_model->volunteer_dailyReportData($where);
                    }
                }
                $data['task'] = $this->Crud_modal->fetch_all_data('*', 'task', 'status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('final-daily-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function intern_daily_report()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    if ($this->input->post('start_new') != "" &&  $this->input->post('state_name') != "") {
                        $date1 = date("Y-m-d", strtotime($this->input->post('start_new')));
                        $state_name = $this->input->post('state_name');
                        $taskName = $this->input->post('taskName');
                        $data['dr_date'] = $date1;
                        $data['state_name'] = $state_name;
                        $data['task'] = $taskName;
                        $where = "idr.dr_date>='" . $date1 . "' and idr.intern_task_id=" . $taskName . " and i.state_id=" . $state_name . "  and (i.status=5) and idr.approved_status=0";
                        $data['internDailyReport'] = $this->Admin_model->intern_dailyReportData($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    if ($this->input->post('start_new') != "" &&  $this->input->post('end_new') != "" &&  $this->input->post('task_id') != "") {
                        $date1 = date("Y-m-d", strtotime($this->input->post('start_new')));
                        $date2 = date("Y-m-d", strtotime($this->input->post('end_new')));
                        $taskName = $this->input->post('task_id');
                        $data['start_new'] = $date1;
                        $data['end_new'] = $date2;
                        $data['task_id'] = $taskName;
                        $where = "idr.dr_date>='" . $date1 . "' and idr.dr_date<='" . $date2 . "' and idr.intern_task_id=" . $taskName . "  and (i.status=5) and  idr.approved_status=0";
                        $data['internDailyReport'] = $this->Admin_model->intern_dailyReportData($where);
                        // echo "<pre>";
                        // print_r($data['internDailyReport']);
                        // exit;
                    }
                }
                $data['interntask'] = $this->Crud_modal->fetch_all_data('*', 'interntask', 'status=1');

                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('admin-intern-daily-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function send_orientation_emails()
    {
        $volunteerEmail = $this->input->post('volunteer_sendId');
        $emailContentValue = $this->input->post('emailContentValue');
        $emailBody = $emailContentValue;

        $to = $volunteerEmail; {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Username = "noreply@crymail.org";
            $mail->Password = "^%n7wh#m7_2k";
            $mail->setFrom('noreply@crymail.org');
            $mail->AddAddress($to);
            $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
            $mail->FromName = 'cry Vms';
            $mail->IsHTML(true);
            $mail->Subject = 'Orientation From CRY VMS ';
            $mail->Body = $emailBody;

            if (!$mail->Send()) {
                echo "Message could not be sent. <p>";
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {

                $this->Admin_model->count_send_mail($volunteerEmail);
            }
        }
    }


    public function offer_lattersend_orientation_emails()
    {
        $intern_id = $this->input->post('intern_id');
        $intern_email = $this->input->post('intern_email');
        $emialcontent = $this->input->post('emialcontent');
        // echo "<pre>";
        // print($emialcontent);exit;
        $val =  rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
        $intern = $this->Crud_modal->fetch_single_data('*', 'interns', "intern_id=$intern_id");
        // $email_templates = $this->Crud_modal->fetch_all_data('*', 'email_templates', 'status=1 AND email_templates_id=5');
        $where = 'intern_id = "' . $intern_id . '" AND email = "' . $intern_email . '"';
        $emailData = array(
            'offer_latter_email' => strip_tags($emialcontent),
        );
        $this->Crud_modal->update_data($where, 'interns', $emailData);
    }



    public function send_loginCredntional_emails()
    {
        $volunteer_id = $this->input->post('volunteer_sendId');
        $volunteerEmail = $this->input->post('volunteer_sendId');
        $emailContentValue = $this->input->post('emailContentValue');
        $val =  rtrim(strtr(base64_encode($volunteer_id), '+/', '-_'), '=');
        $volunteer = $this->Crud_modal->fetch_single_data('*', 'volunteer', "volunteer_id=$volunteer_id");
        // $email_templates = $this->Crud_modal->fetch_all_data('*', 'email_templates', 'status=1 AND email_templates_id=5');
        $val = rtrim(strtr(base64_encode($volunteer['volunteer_id']), '+/', '-_'), '=');
        $url = base_url('') . 'volunteer-login';
        $password = 'volunteer12345';
        $to = $volunteer['email']; {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Username = "noreply@crymail.org";
            $mail->Password = "^%n7wh#m7_2k";
            $mail->setFrom('noreply@crymail.org');
            $mail->AddAddress($to);
            $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
            $mail->FromName = 'cry Vms';
            $mail->IsHTML(true);
            $mail->Subject = 'Post Registration form
            CRY VMS ';
            $mail->Body = $emailContentValue . "<br>" . 'Your Login Credentials,' . " " . "<br>" . "Lin k:" . " " . $url . "<br><br>" . "Your Email:" . " " . $volunteer['email'] . '<br>' . "Your Password:" . "  " . $password . "<br><br>" . "Thank you for being a volunteer with CRY.";
            if (!$mail->Send()) {
                echo "Message could not be sent. <p>";
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $this->Admin_model->count_send_maillogincredational($volunteer_id);
            }
        }
    }

    public function send_postRegistration_emailsLink()
    {
        $volunteer_id = $this->input->post('volunteer_sendId');
        $volunteerEmail = $this->input->post('volunteer_sendId');
        $val =  rtrim(strtr(base64_encode($volunteer_id), '+/', '-_'), '=');
        $volunteer = $this->Crud_modal->fetch_single_data('*', 'volunteer', "volunteer_id=$volunteer_id");
        $val = rtrim(strtr(base64_encode($volunteer['volunteer_id']), '+/', '-_'), '=');
        $url = base_url('') . 'post-registration-volunteer/' . $val;
        $to = $volunteer['email']; {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Username = "noreply@crymail.org";
            $mail->Password = "^%n7wh#m7_2k";
            $mail->setFrom('noreply@crymail.org');
            $mail->AddAddress($to);
            $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
            $mail->FromName = 'cry Vms';
            $mail->IsHTML(true);
            $mail->Subject = 'Post Registration form
            CRY VMS ';
            $mail->Body = 'Please Fill Your Basic Details' . ' ' . $url;
            if (!$mail->Send()) {
                echo "Message could not be sent. <p>";
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $this->Admin_model->count_send_mailPostRegistration($volunteer_id);
            }
        }
    }

    public function send_volunteerstateUpdate_email()
    {
        $volunteerEmail = $this->input->post('volunteer_sendId');
        $relocateState = $this->input->post('relocateState');
        $volunteer_city = $this->input->post('volunteer_city');
        $relocate_id = $this->input->post('relocate_id');
        $volunteer_id = $this->input->post('volunteer_id');
        // echo "<pre>";
        // print_r($volunteer_id);exit;
        $to = $volunteerEmail; {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Username = "noreply@crymail.org";
            $mail->Password = "^%n7wh#m7_2k";
            $mail->setFrom('noreply@crymail.org');
            $mail->AddAddress($to);
            $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
            $mail->FromName = 'cry Vms';
            $mail->IsHTML(true);
            $mail->Subject = 'Update State ';
            $mail->Body = 'Your State Update Successfully...!';

            if (!$mail->Send()) {
                echo "Message could not be sent. <p>";
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $this->Admin_model->program_volunteer_stateUpdate($volunteerEmail, $relocateState, $volunteer_city);
                $this->Admin_model->program_volunteer_statusUpdate($volunteer_id, $relocate_id);
            }
        }
    }

    public function send_internstateUpdate_email()
    {
        $internEmail = $this->input->post('internEmail');
        $internRelocate = $this->input->post('relocateState');
        $internRelocateCity = $this->input->post('relocate_city');
        $relocate_id = $this->input->post('relocate_id');
        $intern_id = $this->input->post('intern_id');
        // echo "<pre>";
        // print_r($internRelocateCity);exit;
        $to = $internEmail; {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Username = "noreply@crymail.org";
            $mail->Password = "^%n7wh#m7_2k";
            $mail->setFrom('noreply@crymail.org');
            $mail->AddAddress($to);
            $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
            $mail->FromName = 'cry Vms';
            $mail->IsHTML(true);
            $mail->Subject = 'Update State ';
            $mail->Body = 'Update Your State Successfully...!';

            if (!$mail->Send()) {
                echo "Message could not be sent. <p>";
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {

                $this->Admin_model->program_intern_Updatestate($internEmail, $internRelocate, $internRelocateCity);
                $this->Admin_model->program_intern_UpdateStatus($relocate_id, $intern_id);
            }
        }
    }

    function get_states()
    {
        $region = $this->input->post('region_id');
        $state = $this->Crud_modal->all_data_select('*', 'states', "region_id='$region'", 'state_name ASC');
        echo '<option value="">---Select State---</option>';
        foreach ($state as $state) {
            $state_id = $state['state_id'];
            $state_name = $state['state_name'];
            echo '<option value="' . $state_id . '">' . rtrim($state_name, ' ') . '</option>';
        }
    }

    function get_district_admin()
    {
        $stateName = $this->input->post('state_name');
        $cities = $this->Crud_modal->all_data_select('*', 'cities', "state_id='$stateName'", 'city_name ASC');
        echo '<option value="">---Select State---</option>';
        foreach ($cities as $cityData) {
            $cityId = $cityData['city_id'];
            $cityName = $cityData['city_name'];
            echo '<option value="' . $cityId . '">' . rtrim($cityName, ' ') . '</option>';
        }
    }

    function get_city_by_task()
    {
        $state = $this->input->post('state_name');
        $city = $this->Crud_modal->all_data_select('*', 'cities', "state_id='$state'", 'city_name ASC');
        // echo "<pre>";
        // print_r($city);exit;
        echo '<option value="">---Select District---</option>';
        foreach ($city as $city) {
            $city_id = $city['city_id'];
            $city_nam = $city['city_name'];
            echo '<option value="' . $city_id . '">' . rtrim($city_nam, ' ') . '</option>';
        }
    }

    function get_city()
    {
        $stat = $this->input->post('sid');
        $city = $this->Crud_modal->all_data_select('*', 'cities', "state_id='$stat'", 'name ASC');
        echo '<option value="">---Select District---</option>';
        foreach ($city as $city) {
            $city_id = $city['ci_id'];
            $city_nam = $city['name'];
            echo '<option value="' . $city_id . '">' . rtrim($city_nam, ' ') . '</option>';
        }
    }

    public function email_template()
    {
        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $data['email_template'] = $this->Crud_modal->fetch_alls('email_templates', 'email_templates_id   desc');
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $data['email_template'] = $this->Crud_modal->fetch_alls('email_templates', 'email_templates_id   desc');
                }
                $this->load->view('temp/head', $data);
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar', $data);
                $this->load->view('email_template', $data);
                $this->load->view('temp/footer', $data);
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function create_template()
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
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('create-template', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function edit_email_template()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $email_templates_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($email_templates_id, '-_', '+/'), strlen($email_templates_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "email_templates_id = '$val'";
                    $data['email_tep'] = $this->Crud_modal->all_data_select('*', 'email_templates', $where, 'email_templates_id desc');
                } else {

                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $email_templates_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($email_templates_id, '-_', '+/'), strlen($email_templates_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "email_templates_id = '$val'";
                    $data['email_tep'] = $this->Crud_modal->all_data_select('*', 'email_templates', $where, 'email_templates_id desc');
                }

                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('edit-email-template', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_template_data()
    {
        $email_templates_id = $this->input->post('email_templates_id');
        $template_name = $this->input->post('template_name');
        $body_content = $this->input->post('body_content');
        $notes = $this->input->post('notes');
        $status = $this->input->post('status');
        $update_data = array(
            'email_templates_id' => $email_templates_id,
            'template_name' => $template_name,
            'body_content' => $body_content,
            'notes' => $notes,
            'status' => $status,
            'modification_date' => date('Y-m-d')
        );
        $where = "email_templates_id = '$email_templates_id'";
        if ($this->Crud_modal->update_data($where, 'email_templates', $update_data)) {
            $this->session->set_flashdata('master_menud', '<div class="alert alert-warning"><strong>Success!</strong> Menu Template has Updated.</div>');
            redirect(base_url() . 'email_template');
        } else {
            $this->session->set_flashdata('master_menud', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');
            redirect(base_url() . 'email_template');
        }
    }

    public function insert_template_data()
    {
        try {
            $createdata = array(
                'template_name' => $this->input->post('template_name'),
                'body_content' => $this->input->post('body_content'),
                'notes' => $this->input->post('notes'),
                'creation_date' => date('Y-m-d H:i:s'),
                'status' => $this->input->post('status'),
            );
            $this->Crud_modal->data_insert('email_templates', $createdata);

            $this->session->set_flashdata('master_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Template has Created.</div>');
            redirect(base_url() . 'email_template');
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function program_volunteer_list()
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
                $this->load->view('program-volunteer-list', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function add_program_volunteer()
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
                $this->load->view('add-program-volunteer', $data);
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
                $this->load->view('edit-program-volunteer', $data);
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
                redirect(base_url() . 'program-volunteer-list');
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
                    redirect(base_url() . 'program-volunteer-list');
                } else {
                    $this->session->set_flashdata('master_menud', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');
                    redirect(base_url() . 'program-volunteer-list');
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function updatePresent_volunteer()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $data['ProgramVolunteer'] = $ProgramVolunteer_id = $this->input->post('ProgramVolunteer_id');
                $certificateId = $this->input->post('certificateId');
                $status = 1;
                for ($i = 0; $i < count($ProgramVolunteer_id); $i++) {
                    $result = $this->db->where(['id' => $ProgramVolunteer_id[$i]])
                        ->update('volunteer_program_users', [
                            'status' => 2,
                            'certificate_id' => $certificateId,
                        ]);
                }
                if ($result) {

                    $this->session->set_flashdata('maped_successfully', '<div class="alert alert-warning"><strong>Certificate maped Successfully...!</strong></div>');
                    redirect(base_url() . 'volunteer-list');
                }
            }
            $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
            $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
            $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar');
            $this->load->view('volunteer-list', $data);
            $this->load->view('temp/footer');
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
                    if ($this->input->post('programName') != "") {
                        $programName = $this->input->post('programName');

                        $where = 'vpu.status =2 AND volunteer_programs = ' . $programName;
                        $data['programData'] = $this->Admin_model->programvolunteer_enquiry_Data($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
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
                $where = 'pv.program_region = ' . $region . ' AND pv.status=1';
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

    //----------------------------UI Amisha Singh ------------------------//

    public function transfer_table()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'it.status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "it.creation_date>='" . $date_from . "' and it.creation_date<='" . $date_to . "' and it.current_state=" . $state_name . "  and (it.status=1)";
                        $data['internTransfer'] = $this->Admin_model->intern_transferRequest($where);

                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'it.status =1 and ';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "it.creation_date>='" . $date_from . "' and it.creation_date<='" . $date_to . "' and it.current_state=" . $state_name . "  and (it.status=1)";
                        $data['internTransfer'] = $this->Admin_model->intern_transferRequest($where);
                    }
                }
                $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('transfer-table', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function voleentur_transfer_table()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'vt.status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "vt.creation_date>='" . $date_from . "' and vt.creation_date<='" . $date_to . "' and vt.current_state=" . $state_name . "  and (vt.status=1)";
                        $data['volunteerTransfer'] = $this->Admin_model->volunteer_transferRequest($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'vt.status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "vt.creation_date>='" . $date_from . "' and vt.creation_date<='" . $date_to . "' and vt.relocate_state=" . $state_name . "  and (vt.status=1)";

                        $data['volunteerTransfer'] = $this->Admin_model->volunteer_transferRequest($where);

                    }
                }
                // $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('voleentur-transfer-table', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
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
               
                if ($role == 1) {
                    if ($this->input->post('programName') != "") {
                        $programName = $this->input->post('programName');
                        $where = 'vpu.status =0 AND volunteer_programs = ' . $programName;
                        $data['programData'] = $this->Admin_model->programvolunteer_enquiry_Data($where);
                        
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    if ($this->input->post('programName') != "") {
                        $data['program']  = $programName = $this->input->post('programName');
                        $where = 'vpu.status =1 OR 2 AND  volunteer_programs = ' . $programName;
                        $data['programData'] = $this->Admin_model->programvolunteer_enquiry_Data($where);
                        // echo "<pre>";
                        // print_r($data['programData']);exit;
                    }
                }
                $where = 'pv.program_region = ' . $region . ' AND pv.status=1';
                $data['certificateFormat'] = $this->Crud_modal->fetch_all_data('*', 'certificate_format_master', 'status=1');
                $data['volunteer_programs'] = $this->Crud_modal->fetch_all_data('*','program_volunteer','status=1');
                // echo "<pre>";
                // print_r($data['volunteer_programs']);exit;
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('volunteer-list', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function country_master()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $data['countries'] = $this->Crud_modal->fetch_alls('countries', 'country_id   desc');
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('country-master', $data);
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function add_country()
    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('add-country');
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insert_country()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

                $createdata = array(
                    'Name' => $this->input->post('Name'),
                    'short_name' => $this->input->post('short_name'),
                    'status' => $this->input->post('status'),

                );
                //     echo "<pre>";
                // print_r($createdata);exit;
                $this->Crud_modal->data_insert('countries', $createdata);
                $this->session->set_flashdata('state_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Country has Inserted.</div>');

                redirect(base_url() . 'country-master');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function volunteer_program_report()
    {

        try {

            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('volunteer-program-report');
                $this->load->view('temp/footer');
            } else {

                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function intern_transfer_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'it.status =2';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "it.creation_date>='" . $date_from . "' and it.creation_date<='" . $date_to . "' and it.current_state=" . $state_name . "  and (it.status=2)";
                        $data['internTransfer'] = $this->Admin_model->intern_transferRequest($where);
                        // echo "<pre>";
                        // print_r($data['internTransfer']);exit;
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'it.status =2';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "it.creation_date>='" . $date_from . "' and it.creation_date<='" . $date_to . "' and it.current_state=" . $state_name . "  and (it.status=2)";
                        $data['internTransfer'] = $this->Admin_model->intern_transferRequest($where);
                        // echo "<pre>";
                        // print_r($data['internTransfer']);exit;
                    }
                }
                $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                // echo "<pre>";
                // print_r($data['states']);exit;
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('intern-transfer-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function send_certificate_emails()
    {
        $ProgramVolunteer_id = $this->input->post('ProgramVolunteer_id');
        $where = 'vpu.id = "' . $ProgramVolunteer_id . '"';
        $sendCertificate = $this->Admin_model->programvolunteer_enquiry_Data($where);
        $certificateData = $sendCertificate[0]['email'];
        $certificatecertificate_type = $sendCertificate[0]['certificate_type'];
        $to = $certificateData;
        $att = $this->generate_certificate($sendCertificate);
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "noreply@crymail.org";
        $mail->Password = "^%n7wh#m7_2k";
        $mail->setFrom('noreply@crymail.org');
        $mail->AddAttachment($att);
        $mail->AddAddress($to);
        $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
        $mail->FromName = 'cry Vms';
        $mail->IsHTML(true);
        $mail->Subject = 'certificate From CRY VMS ';
        $mail->Body = 'Download your certificate';
        if (!$mail->Send()) {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {

            $this->Admin_model->updateStatus($certificateData);
        }
    }

    public function generate_certificate($sendCertificate)
    {
        $certificateFirstname = $sendCertificate[0]['first_name'];
        $certificateLastname = $sendCertificate[0]['last_name'];
        $certificateEmail = $sendCertificate[0]['email'];
        $certificateprogram_name = $sendCertificate[0]['program_name'];
        $certificatecertificate_type = $sendCertificate[0]['certificate_type'];
        $certificatecertificate_path = $sendCertificate[0]['certificate_path'];
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetFillColor(190, 210, 2400);
        $pdf->Image(base_url() . 'uploads/certificate/' . $certificatecertificate_path, 10, 7, 185);
       // $pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/uploads/certificate/' . $certificatecertificate_path, 10, 7, 185);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(40);
        $pdf->Cell(10, 100, $certificateFirstname . $certificateLastname);
        $pdf->Cell(10, 100, $certificateprogram_name);
        $pdf->Cell(1, 190, date('d-m-Y'));

        //$pdf->Output();
        $path = 'users/' . rand() . '.pdf';
        $pdf->Output($path, 'F');
        return $path;
    }

    public function view_self_task_report()
    {
        $userID = $this->session->userdata('volunteer_id');
        $region = $this->session->userdata('region_id');
        if ($this->input->get()) {
            // print_r($this->input->get());
            $date = date("Y-m-d", strtotime($this->input->get('asdate')));
            $res['birthday'] = $date;
            //die();
            $join_data = array(
                array(
                    'table' => 'self_task_daily_report',
                    'fields' => array('vself_task_id', 'dailyReportTimeIn', 'volunteer_id', 'task_title', 'dailyReportTimeOut', 'dailyReportDate', 'dailyReportActivity', 'improved_msg', 'challeges_face'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'status' => 1,
                        'approved_status' => 0,
                        'dailyReportDate <' => "'" . $date . "'",
                        'approveddaily_id' => 0,
                    ),
                    'order_by' => array('vself_task_id', 'DESC'),
                    'group_by' => array('volunteer_id'),
                    //'function'=>array('SUM','dailyReportTimeIn'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer',
                    'fields' => array('volunteer_id', 'first_name', 'last_name', 'mobile', 'email', 'state_id', 'city_id'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 1,
                    'table' => 'states',
                    'fields' => array('state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
                array(
                    'joined' => 1,
                    'table' => 'cities',
                    'fields' => array('city_name'),
                    'joinWith' => array('city_id', 'left'),
                ),
            );

            $limit = '';
            $order_by = '';
            $data['daily_report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        } else {
            $date = date("Y-m-d");
            $data['birthday'] = $date;
        }
        if ($this->input->post()) {
            if ($this->input->post('disaproved') == 'disaproved') {
                $userID = $this->input->post('volunteer_id');
                $vwh = $this->input->post('vwh');
                $vwm = $this->input->post('vwm');
                $ywh = $this->input->post('ywh');
                $ywm = $this->input->post('ywm');
                $user_time = $vwh . '.' . $vwm;
                $admin_time = $ywh . '.' . $ywm;
                $dailyReportDate = $this->input->post('dailyReportDate');

                $data = array(
                    'volunteer_id' => $userID,
                    'total_time' => $admin_time,
                    'status' => 2,
                    'user_time' => $user_time,
                    'admin_time' => $admin_time,
                );
                $approveddaily_ID = $this->Curl_model->insert_data('approveddaily_report', $data);
                $where = array(
                    'volunteer_id' => $userID,
                    'CAST(`dailyReportDate` as DATE)=' => $dailyReportDate
                );
                $fields = array(
                    'approved_status' => 2,
                    'approveddaily_id' => $approveddaily_id
                );
                $results = $this->Curl_model->update_data('self_task_daily_report', $fields, $where);

                if ($results) {
                    $user_data = $this->Curl_model->fetch_data('volunteer', array('email'), array('volunteer_id' => $userID), '', '');
                    // print_r($task_data);
                    // die();
                    $email = $user_data['email'];
                    $href = base_url() . 'login';
                    //$href2 = base_url().'verify/'.md5($results);
                    $to = $email;
                    $from = 'volunteer@caritasindia.org';
                    $msg = 'CRY VMS';
                    $msg2 = "
                    <center><p><strong style='font-weight:bold;'>Oops! </strong>Your Self daily report has been disapproved.</p></center>
                    <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                        <tr>
                            <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Your Total Time</th>
                            <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $vwh . " Hours " . $vwm . " Min</td>
                        </tr>
                        <tr>
                            <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Admin Total Time</th>
                            <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $ywh . " Hours" . $ywm . " Min</td>
                        </tr>
                        <tr>
                            <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Reason</th>
                            <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . ucwords($reasonID) . "</td>
                        </tr>
                    </table>";
                    //die();
                    $subj = "Daily Report Activity";
                    $btn = "Check Now!";

                    $html = $this->request_email($msg, $msg2, $href, $btn);
                    $data = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
                    //echo "1";
                    $this->session->set_userdata('dailyreport_disapproved1', 'true');
                    echo '<script>window.location.href = "' . base_url() . 'view-self-task-report"</script>';
                    die();
                }

                // print_r($this->input->post());

            }
        }

        $data['enc_userID'] = rtrim(strtr(base64_encode($userID), "+/", "-_"), "=");
        $data['self_task_daily_report'] = $userID;
        // echo "<pre>";
        // print_r($res);
        // die();
        $userID = $this->session->userdata('volunteer_id');
        $join_data = array(
            array(
                'table' => 'volunteer',
                'fields' => array('first_name', 'last_name', 'mobile', 'email', 'volunteer_id'),
                'joinWith' => array('volunteer_id'),
                'where' => array(
                    'volunteer_id' => $userID
                ),

            ),
            array(
                'joined' => 0,
                'table' => 'volunteer_data',
                'fields' => array('profile'),
                'joinWith' => array('volunteer_id', 'left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by = '';
        $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
        $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar');
        $this->load->view('view-self-task-report', $data);
        $this->load->view('temp/footer');
    }


    public function hr_process()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');

                if ($role == 1) {
                    $internuser_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($internuser_id, '-_', '+/'), strlen($internuser_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "intern_id = '$val'";
                    //$data['interuser'] = $this->Admin_model->get_all_intern_onlineOffline($where);
                    $data['interuser'] = $this->Crud_modal->fetch_single_data('*', 'interns', $where);
                   
                    $data['user_schedule'] = $this->Crud_modal->all_data_select("*", "interview_schedule_detail", "intern_id='$val'", "schedule_id asc");
                    $data['step_name'] = $this->Crud_modal->all_data_select("*", "interview_process_step", "1=1", "step_id asc");
                } else {
                    $data['rname'] = $this->Crud_modal->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $internuser_id = $this->uri->segment(2);
                    $val = base64_decode(str_pad(strtr($internuser_id, '-_', '+/'), strlen($internuser_id) % 4, '=', STR_PAD_RIGHT));
                    $where = "intern_id = '$val'";
                    //$data['interuser'] = $this->Admin_model->get_all_intern_onlineOffline($where);
                    $data['interuser'] = $this->Crud_modal->fetch_single_data('*', 'interns', $where);
                    $data['user_schedule'] = $this->Crud_modal->all_data_select("*", "interview_schedule_detail", "intern_id='$val'", "schedule_id asc");
                    $data['step_name'] = $this->Crud_modal->all_data_select("*", "interview_process_step", "1=1", "step_id asc");
                }
                
                $data['email_templates'] = $this->Crud_modal->fetch_single_data('email_templates_id,body_content', 'email_templates', 'status=1 AND email_templates_id=8');
               // $internCity = $data['interuser']['city_name'];
                $searchArray = array("online", "7-8", "September , 2022.","Mahendra Sahu",'Kanpur Uttar Pradesh');
                $latsarrayTemplate = array(
                    $data['interuser']['vol_type_name'],
                    $data['interuser']['internshipDeruation'],
                    date('d M Y', strtotime($data['interuser']['creation_date'])).'.',
                    $data['interuser']['first_name']." ".$data['interuser']['last_name'],
                    trim($data['interuser']['city_name']," ").",".$data['interuser']['state_name'],
                );
                $lasttemplate = str_replace($searchArray, $latsarrayTemplate, $data['email_templates']['body_content'], $count);
                $data['final_offerdata'] = $lasttemplate;
                //  print_r($lasttemplate); exit;
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('hr-process', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function shortlist_status_update()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $intern_id = $this->input->post('intern_id');
            $status = $this->input->post('status');
            if ($status == 0) { // when reject
                if ($this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['status' => '0'])) {
                    echo true;
                } else {
                    echo false;
                }
            } else if ($status == 2) { // when shortlist for next round
                if ($this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['status' => '2'])) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        }
    }

    function get_same_day_schedule_user_count()
    {
        $emp_id = $this->session->userdata('emp_id');
        $date = date("Y-m-d", strtotime($this->input->post('date_value')));
        echo $this->Crud_modal->check_numrow("interview_schedule_detail", "schedule_date_time like '%$date%'");
    }

    public function save_interview_schedule_data()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {

            if ($this->input->post('schedule_id') == '') {
                $data['mode'] = $data1['mode'] = $this->input->post('mode');
                $data['hr_description'] = $this->input->post('hr_description');
                $data['schedule_date_time'] = $data1['reschedule_date_time'] = date("Y-m-d H:i:s", strtotime($this->input->post('schedule_date') . ' ' . $this->input->post('schedule_time')));
                if ($data['mode'] == "Face to Face") {
                    $data['venue'] = $this->input->post('venue');
                }
                $data['round'] = $data1['round'] = $this->input->post('round');
                $data['intern_id'] = $data1['intern_id'] = $this->input->post('intern_id');
                $data['created_date'] = $data1['created_date'] = date("Y-m-d H:i:s");
                $data['created_by'] = $data1['created_by'] = $this->session->userdata('emp_id');
                $this->Crud_modal->data_insert("interview_schedule_detail", $data);
                $this->Crud_modal->data_insert("interview_reschedule", $data1);
            } else {
                $data['mode'] = $data1['mode'] = $this->input->post('mode');
                $data['hr_description'] = $this->input->post('hr_description');
                $data['schedule_date_time'] = $data1['reschedule_date_time'] = date("Y-m-d H:i:s", strtotime($this->input->post('schedule_date') . ' ' . $this->input->post('schedule_time')));
                if ($data['mode'] == "Face to Face") {
                    $data['venue'] = $this->input->post('venue');
                }
                $data['round'] = $data1['round'] = intval($this->input->post('round')) - 1;
                $data['intern_id'] = $data1['intern_id'] = $this->input->post('intern_id');
                $data['created_date'] = $data1['created_date'] = date("Y-m-d H:i:s");
                $data['created_by'] = $data1['created_by'] = $this->session->userdata('emp_id');
                $schedule_id = $this->input->post('schedule_id');
                $this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data);
                $this->Crud_modal->data_insert("interview_reschedule", $data1);
            }
        }
    }

    function clear_interview()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            //print_r($this->input->post());
            $data['round_status'] = $this->input->post('status');
            $data['comment'] = $this->input->post('comment');
            $schedule_id = $this->input->post('schedule_id');
            if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", ['job_process_step' => '4-0'])) {
                if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        }
    }

    function ongoing_interview()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            print_r($this->input->post());
            $data['round_status'] = $this->input->post('status');
            $data['comment'] = $this->input->post('comment');
            $schedule_id = $this->input->post('schedule_id');
            if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data)) {
                $data1['intern_id'] = $this->input->post('intern_id');
                $data1['round'] = $this->input->post('round');
                $data1['created_by'] = $this->session->userdata('emp_id');
                $data1['created_date'] = date("Y-m-d H:i:s");
                if ($this->Crud_modal->data_insert("interview_schedule_detail", $data1)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        }
    }

    function reject_interview()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            //print_r($this->input->post());
            $data['round_status'] = $this->input->post('status');
            $data['comment'] = $this->input->post('comment');
            $schedule_id = $this->input->post('schedule_id');
            if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", ['job_process_step' => '3-1'])) {
                if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        }
    }

    function update_job_schedule_data()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            print_r($this->input->post());
            $data['mode'] = $data1['mode'] = $this->input->post('mode');
            $data['schedule_date_time'] = $data1['reschedule_date_time'] = date("Y-m-d H:i:s", strtotime($this->input->post('schedule_date') . ' ' . $this->input->post('schedule_time')));
            if ($data['mode'] == "Face to Face") {
                $data['venue'] = $this->input->post('venue');
            }
            $data['comment'] = $this->input->post('comment');
            $data1['round'] = intval($this->input->post('round')) - 1;
            $data1['intern_id'] = $this->input->post('intern_id');
            $data['created_date'] = $data1['created_date'] = date("Y-m-d H:i:s");
            $data['created_by'] = $data1['created_by'] = $this->session->userdata('emp_id');
            $data['round_status'] = 0;
            $schedule_id = $this->input->post('schedule_id');
            $this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data);
            $this->Crud_modal->data_insert("interview_reschedule", $data1);
        }
    }

    function mail_interview_data()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $round = intval($this->input->post('round')) - 1;
            $emp_id = $this->session->userdata('emp_id');
            $intern_id = $this->input->post('intern_id');
            $user_data = $this->Crud_modal->fetch_single_data("first_name,last_name, email ", "interns", "intern_id='$intern_id'");
            $data['mode'] = $this->input->post('mode');
            $data['schedule_date'] = $this->input->post('schedule_date');
            $data['schedule_time'] = $this->input->post('schedule_time');
            $data['venue'] = $this->input->post('venue');
            $data['hr_description'] = $this->input->post('hr_description');
            $data['first_name'] = $user_data['first_name'];
            $data['last_name'] = $user_data['last_name'];
            $data['user_email'] = $user_data['email'];
            if ($this->input->post('data_action') == '') {
                if ($this->Admin_model->schedule_mail_to_user($data)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                $old_schedule_data = $this->Admin_model->get_prev_schedule_date("reschedule_date_time,reschedule_id", "interview_reschedule", "intern_id='$intern_id' and round='$round' and created_by='$emp_id'", "reschedule_id desc");
                $data['old_schedule_date'] = date("F d,Y", strtotime($old_schedule_data['reschedule_date_time']));
                $data['old_schedule_time'] = date("h:i A", strtotime($old_schedule_data['reschedule_date_time']));
                if ($this->Admin_model->reschedule_mail_to_user($data)) {
                    echo true;
                } else {
                    echo false;
                }
            }
        }
    }

    function interview_final_mail()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $emp_id = $this->session->userdata('emp_id');
            $intern_id = $this->input->post('intern_id');
            $user_data = $this->Crud_modal->fetch_single_data("first_name,last_name,email", "interns", "intern_id='$intern_id'");
            $interview_status = $this->Crud_modal->fetchdata_with_limit("job_process_step", "interview_schedule_detail", "intern_id='$intern_id'", "schedule_id desc", 1);
            $process_step = explode('-', $interview_status[0]['job_process_step']);
            $data['user_name'] = $user_data['first_name'];
            $data['user_email'] = $user_data['email'];
            if ($process_step[0] == 4) {
                if ($this->Admin_model->interview_final_mail($data)) {
                    echo true;
                } else {
                    echo false;
                }
            }
        }
    }

    public function shortlist_mail()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $emp_id = $this->session->userdata('emp_id');
            $intern_id = $this->input->post('intern_id');
            $user_data = $this->Crud_modal->fetch_single_data("first_name,email", "interns", "intern_id='$intern_id'");
            $data['user_name'] = $user_data['first_name'];
            $data['user_email'] = $user_data['email'];
            if ($this->Admin_model->shortlist_mail($data)) {
                echo true;
            } else {
                echo false;
            }
        }
    }


    function send_offer_to_user()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $config['upload_path'] = './uploads/offer_letter/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 2000;
            $config['file_name'] = date("dmYhis") . '-' . $_FILES['offer_letter']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('offer_letter')) {
                $data1 = $this->upload->data();
                $full_path = $data1['full_path'];
                $file_name = $data1['file_name'];
                $data['offer_letter'] = $data1['file_name'];
                $data['job_process_step'] = '5-0';
                $data['status'] = '5';
                $intern_id = $this->input->post('intern_id');
                $enc_intern = rtrim(strtr(base64_encode($intern_id), "+/", "-_"), "=");
                $url = base_url('post-registration-intern/' . $enc_intern);
                $this->Crud_modal->update_data("intern_id='$intern_id'", "interns", $data);
                $user_data = $this->Crud_modal->fetch_single_data("first_name,email", "interns", "intern_id='$intern_id'");
                $data['first_name'] = $user_data['first_name'];
                $data['email'] = $user_data['email'];
                if ($this->Admin_model->send_offer_letter($full_path, $file_name, $data, $url)) {
                    echo true;
                    $this->Crud_modal->update_data("intern_id='$intern_id'", "interns", $data);
                } else {
                    echo false;
                }
            } else {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            }
        }
    }

    function confirm_joining()
    {
        $creation_date = $this->input->post("creation_date");
        $intern_id = $this->input->post("intern_id");
        $internEmail = $this->input->post('email');
        $val =  rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
        $intern = $this->Crud_modal->fetch_single_data('*', 'interns', "intern_id=$intern_id");
        // $email_templates = $this->Crud_modal->fetch_all_data('*', 'email_templates', 'status=1 AND email_templates_id=5');
        $val = rtrim(strtr(base64_encode($intern['intern_id']), '+/', '-_'), '=');
        $url = base_url('') . 'intern-login';
        $password = 'intern12345';
        $to = $intern['email']; {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Username = "noreply@crymail.org";
            $mail->Password = "^%n7wh#m7_2k";
            $mail->setFrom('noreply@crymail.org');
            $mail->AddAddress($to);
            $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
            $mail->FromName = 'cry Vms';
            $mail->IsHTML(true);
            $mail->Subject = 'Joining Letter';
            $mail->Body = "" . "<br>" . 'Your Login Credentials,' . " " . "<br>" . "Link:" . " " . $url . "<br><br>" . "Your Email:" . " " . $intern['email'] . '<br>' . "Your Password:" . "  " . $password . "<br><br>" . "Thank you for being a intern with CRY.";
            if (!$mail->Send()) {
                echo "Message could not be sent. <p>";
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $this->Admin_model->intern_count_send_maillogincredational($intern_id, $creation_date);
            }
        }
    }

    public function intern_task_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    //$where = '1 =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "") {
                        $taskType = $this->input->post('taskType');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . "  and status=1 and task_for=2";
                        $data['interntaskData'] = $this->Admin_model->intern_task_Data($where);
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
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=2";
                        // echo "<pre>";
                        // print_r($where);exit;
                        $data['interntaskData'] = $this->Admin_model->intern_task_Data($where);
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
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=2";
                        // echo "<pre>";
                        // print_r($where);exit;
                        $data['interntaskData'] = $this->Admin_model->intern_task_Data($where);
                    } else {
                    }
                }
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('intern-task-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function pre_registration_intern_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $data['task'] = $this->Crud_modal->fetch_all_data('*', 'interntask', 'status=1');
                    $where = 'i.status =1';
                    $state_name = $this->input->post('state_name');
                    //$where = "i.state_id=" . $state_name . "  and (i.status=1)";
                    $data['intern'] = $this->Admin_model->intern_pre_registration_report($where);
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $data['task'] = $this->Crud_modal->fetch_all_data('*', 'interntask', 'status=1');
                    $where = 'i.status =1';
                    $state_name = $this->input->post('state_name');
                    //$where = "i.state_id=" . $state_name . "  and (i.status=1)";
                    $data['intern'] = $this->Admin_model->intern_pre_registration_report($where);
                }
                $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('pre-registration-intern-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function post_registration_intern_report()
    {
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('post-registration-intern-report');
        $this->load->view('temp/footer');
    }

    public function intern_assign_task_report()
    {
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('intern-assign-task-report');
        $this->load->view('temp/footer');
    }


    public function pre_registration_volunteer_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=1)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    'v.status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=1)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('pre-registration-volunteer-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function post_registration_volunteer_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =4';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=4)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    'v.status =4';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=4)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('post-registration-volunteer-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function volunteer_assign_task()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "") {
                        $taskType = $this->input->post('taskType');
                        $taskName = $this->input->post('taskName');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_id=" . $taskName . "  and (status=1)";
                        $data['volunteerDetails'] = $this->Admin_model->assign_task_volunteer_taskType($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    'v.status =5';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=5)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('volunteer-assign-task', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function view_onboarding_candidate()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'i.status =7';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and i.state_id=" . $state_name . "  and (i.status=7)";
                        $data['intern'] = $this->Admin_model->intern_enquiry_Data($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    'i.status =7';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and i.state_id=" . $state_name . "  and (i.status=7)";
                        $data['intern'] = $this->Admin_model->intern_enquiry_Data($where);
                    }
                }
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('view-onboarding-candidate', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function volunteer_certificate_report()
    {
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('volunteer-certificate-report');
        $this->load->view('temp/footer');
    }

    public function volunteer_self_task_daily_report()
    {
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('volunteer-self-task-daily-report');
        $this->load->view('temp/footer');
    }

    public function volunteer_transfer_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $this->load->view('temp/head');
                $this->load->view('temp/header');
                $this->load->view('temp/sidebar');
                $this->load->view('volunteer-transfer-report');
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function intern_tast_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    //$where = '1 =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "") {
                        $taskType = $this->input->post('taskType');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . "  and status=1 and task_for=2";
                        $data['interntaskData'] = $this->Admin_model->intern_task_Data($where);
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
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=2";

                        $data['interntaskData'] = $this->Admin_model->intern_task_Data($where);
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
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=2";
                        $data['interntaskData'] = $this->Admin_model->intern_task_Data($where);
                    } else {
                    }
                }
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('intern-tast-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function submission_reports()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "" && $this->input->post('region_id') != "") {
                        $data['states'] =  $state_name = $this->input->post('state_name');
                        $data['region_id'] =  $region_id = $this->input->post('region_id');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['final_sunmission_date'] = $date1;
                        $data['final_sunmission_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "i.state_id = '" . $state_name . "' AND ism.final_sunmission_date>='" . $date_from . "' and ism.final_sunmission_date<='" . $date_to . "' AND (ism.status=1)";

                        $data['submissionReports'] = $this->Admin_model->intern_submission_report($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
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
                        $data['final_sunmission_date'] = $date1;
                        $data['final_sunmission_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "i.state_id = '" . $state_name . "' AND ism.final_sunmission_date>='" . $date_from . "' and ism.final_sunmission_date<='" . $date_to . "' AND (ism.status=1)";
                        $data['submissionReports'] = $this->Admin_model->intern_submission_report($where);
                    }
                }

                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('submission_reports', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function update_offer_latter()
    {
        try {
            $inter_id = $this->input->post('intern_id');
            $offerLatter_update_date = $this->input->post('offerLatter_update_date');
            $internshipType = $this->input->post('internshipType');
            $internship_durations = $this->input->post('internship_durations');
            $where = 'intern_id = "' . $inter_id . '"';
            $update_intershiopjoiningData = array(
                'creation_date' => $offerLatter_update_date,
                'internshipType' => $internshipType,
                'internshipDeruation' => $internship_durations,

            );
            if ($this->Crud_modal->update_data($where, 'interns', $update_intershiopjoiningData)) {
                echo 1;
            } else {
                return 2;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function view_offer_letter()
    {
        $intern_id = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
        $where = 'intern_id = "' . $val . '"';
        $internemailData = $this->Crud_modal->fetch_single_data('*', 'interns', $where);
        $offerEmailFormat = $internemailData['offer_latter_email'];
        $date= date('d-m-Y');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Image(base_url() . '/uploads/offer.png', 10, 8, 185);
        //$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/uploads/Intern-offer-Letter.png', 10, 7, 185);
        $pdf->SetY(38.6);
        $pdf->SetX(147);
        $pdf->Cell(10,5,$date,0,'R');
        $pdf->SetY(60);
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->multiCell(170, 4, strip_tags($offerEmailFormat),5);
        $pdf->Output();
        $this->load->view('view_offer_letter');
    }

    public function send_offer_letter( $internemailData)
    {
 
         $offerEmailFormat = $internemailData['offer_latter_email'];
        $date= date('d-m-Y');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 9);
      $pdf->Image(base_url() . '/uploads/offer.png', 10, 8, 185);
       //$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/uploads/offer.png', 10, 8, 185);
        $pdf->SetY(38.6);
        $pdf->SetX(147);
        $pdf->Cell(10,5,$date,0,'R');
        $pdf->SetY(60);
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->multiCell(170, 4, strip_tags($offerEmailFormat),5);
        $path = 'offeremail/' . rand() . '.pdf';
        $pdf->Output($path, 'F');
        return $path;
        $this->load->view('view_offer_letter');
    }
    

    public function send_offerLetter_emails()
    {
        $intern_id = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
        $where = 'intern_id = "' . $val . '"';
        $internemailData = $this->Crud_modal->fetch_single_data('first_name,last_name,email,offer_latter_email', 'interns', $where);
        $internEmail = $internemailData['email'];
        $url = base_url('') . 'post-registration-intern/' . $intern_id;
        $to = $internEmail;
        $att = $this->send_offer_letter($internemailData);
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "noreply@crymail.org";
        $mail->Password = "^%n7wh#m7_2k";
        $mail->setFrom('noreply@crymail.org');
        $mail->AddAttachment($att);
        $mail->AddAddress($to);
        $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
        $mail->FromName = 'cry Vms';
        $mail->IsHTML(true);
        $mail->Subject = 'Cry Offer Letter';
        $mail->Body = 'Please Fill Your Basic Details And Accept Your Offer Letter' . ' ' . $url;
        if (!$mail->Send()) {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {

           // $this->Admin_model->updateStatus($internemailData);
            redirect(base_url() . 'hr-process/'.$intern_id);
        }
    }

    public function rate_and_review()
    {
        {
            try {
                if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                    $region = $this->session->userdata('region_id');
                    $role = $this->session->userdata('role_id');
                    if ($role == 1) {
                        $date2 = $data['date_to'] = date("Y-m-d");
                        $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                        $where = 'status =1';
                        if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "" && $this->input->post('region_id') != "") {
                            $data['states'] =  $state_name = $this->input->post('state_name');
                            $data['region_id'] =  $region_id = $this->input->post('region_id');
                            $date1 = $this->input->post('start_new');
                            $date2 = $this->input->post('end_new');
                            $date_from = date("Y-m-d", strtotime($date1));
                            $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                            $data['creation_date'] = $date1;
                            $data['creation_date'] = $date2;
                            $data['state_name'] = $state_name;
                            $where = "i.state_id = '" . $state_name . "' AND fd.creation_date>='" . $date_from . "' and fd.creation_date<='" . $date_to . "' AND (fd.status=1)";
                            $data['rateingData'] = $this->Admin_model->rate_and_reviewData($where);
                            
                        }
                    } else {
                        $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                        $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
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
                            $data['final_sunmission_date'] = $date1;
                            $data['final_sunmission_date'] = $date2;
                            $data['state_name'] = $state_name;
                            $where = "i.state_id = '" . $state_name . "' AND fd.creation_date>='" . $date_from . "' and fd.creation_date<='" . $date_to . "' AND (fd.status=1)";
                            $data['rateingData'] = $this->Admin_model->rate_and_reviewData($where);

                        }
                    }
    
                    $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                    $this->load->view('temp/head');
                    $this->load->view('temp/header', $data);
                    $this->load->view('temp/sidebar');
                    $this->load->view('rate_and_review', $data);
                    $this->load->view('temp/footer');
                } else {
                    redirect(base_url() . 'login', 'refresh');
                }
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    
    }

    public function view_rating(){
        $intern_id = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
        $where = 'intern_id = "' . $val . '"';
        $data['feedbackData'] = $this->Admin_model->get_all_feedback($where);
        
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar');
        $this->load->view('view_rating', $data);
        $this->load->view('temp/footer');
 }


 public function onboard_volunteer()
 {

     try {
         if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
             $region = $this->session->userdata('region_id');
             $role = $this->session->userdata('role_id');
             if ($role == 1) {
                 $date2 = $data['date_to'] = date("Y-m-d");
                 $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                 $where = 'v.status =5';
                 if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {

                    $config = array();
					$config["per_page"] = 10;
					$config["uri_segment"] = 2;
                     $config["base_url"] = base_url() . "onboard-volunteer";
                     $config["total_rows"] = $this->Admin_model->get_all_volunteer_count();
                     $this->pagination->initialize($config);
					$data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
					$data['volunteer'] = $this->Admin_model->get_all_volunteer($config["per_page"], $data['page']);
					$data["links"] = $this->pagination->create_links();
                 }
             } else {
                 $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                 $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                 $date2 = $data['date_to'] = date("Y-m-d");
                 $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                 'v.status =5';
                 if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                     $state_name = $this->input->post('state_name');
                     $date1 = $this->input->post('start_new');
                     $date2 = $this->input->post('end_new');
                     $date_from = date("Y-m-d", strtotime($date1));
                     $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                     $data['creation_date'] = $date1;
                     $data['creation_date'] = $date2;
                     $data['state_name'] = $state_name;
                     $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=5)";
                     $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                 }
             }
             $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
             $this->load->view('temp/head');
             $this->load->view('temp/header', $data);
             $this->load->view('temp/sidebar');
             $this->load->view('onboard-volunteer', $data);
             $this->load->view('temp/footer');
         } else {
             redirect(base_url() . 'login', 'refresh');
         }
     } catch (Exception $e) {
         echo 'Caught exception: ',  $e->getMessage(), "\n";
     }
 }

 

 public function view_assigned_task_intern()
    {
        try{
    
            if(($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)){
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
               
                if($role == 1){
                    if($this->input->post('intern_task_id')!=""){
                        $assignTaskid = $this->input->post('intern_task_id');
                        $where = 'iast.status = 0 OR iast. status = 1 OR iast.status = 2 And i.status = 7 AND iast.intern_task_id = "'.$assignTaskid.'"';
                        $data['internAssignTaskdata'] = $this->Admin_model->intern_by_assign_task($where);
                    }
                    

                }else{

                    if($this->input->post('intern_task_id')!=""  || $this->session->userdata('emp_id') != null){
                        $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                        $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                        $assignTaskid = $this->input->post('intern_task_id');
                       $empId =  $this->session->userdata('emp_id');
                       $where = 'iast.status in (0,1,2) And i.status = 7 AND iast.intern_task_id = "'.$assignTaskid.'" AND iast.assign_by_task = "'.$empId.'"';
                        $data['internAssignTaskdata'] = $this->Admin_model->intern_by_assign_task($where);
                        
                        
                    }
                }
                $where = 'iast.status=1';
                $data['internAssigntask'] = $this->Admin_model->all_assign_task_intern($where);
                
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('view-intern-assigned-task', $data);
                $this->load->view('temp/footer');
    
            }else {
                    redirect(base_url() . 'login', 'refresh');
                }
        }catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
    }

    

}