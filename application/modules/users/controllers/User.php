<?php

defined('BASEPATH') or exit('No direct script access allowed');
class User extends MY_Controller
{
    function __construct()
    {
        error_reporting(0);
        parent::__construct();
        // if ($this->session->userdata('userID')) {
        //     if ($this->session->userdata('roleID') == 2) {
        //     } else {
        //         redirect('admin-dashboard');
        //     }
        // } else {
        //     redirect('login');
        // }
        $CI = &get_instance();
        $CI->load->library('Get_library');
        $this->load->model('curl/Curl_model');
        $this->load->model('crud/Crud_modal');
        $this->load->model('User_model');
        $this->load->library('Phpmailer');
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');
    }

    public function volunteer_login()
    {
        $res['email'] = "";
        $res['password'] = "";
        if ($this->input->post()) {
            $res['email'] = $this->input->post('email');
            $res['password'] = $this->input->post('password');
            if ($this->input->post('signin') == 'signin') {
                $rules_array = array(
                    array(
                        'field' => 'email',
                        'label' => 'Email Address',
                        'rules' => 'trim|required',
                        'errors' => array(
                            'required' => 'Enter Email Address.',
                        ),
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required',
                        'errors' => array(
                            'required' => 'Enter Password',
                        ),
                    ),
                );

                $this->form_validation->set_rules($rules_array);
                if ($this->form_validation->run() == TRUE) {
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $fields = array(
                        'password',
                        'first_name',
                        'volunteer_id',
                        'state_id',
                        'status',
                    );
                    $where = array(
                        'email' => $email,
                    );
                    $limit = '';
                    $order_by = '';
                    $results = $this->Curl_model->fetch_data('volunteer', $fields, $where, $limit, $order_by);
                    if (!empty($results) && $results != '') {
                        $r_password = $results['password'];
                        if ($r_password == md5($password)) {
                            if ($results['status'] == 5) {
                                $this->session->set_userdata('volunteer_id', $results['volunteer_id']);
                                $this->session->set_userdata('first_name', $results['first_name']);
                                $this->session->set_userdata('state_id', $results['state_id']);
                                //echo "hello"; exit();
                                echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
                            } else {
                                $this->session->set_userdata('error', 'Your Login has been block.');
                            }
                        } else {
                            $this->session->set_userdata('error', 'Wrong Password');
                        }
                    } else {
                        $this->session->set_userdata('error', 'Please Enter Valid Email Address');
                    }
                }
            }
        }
        $this->load->view('volunteer-login', $res);
    }

    public function volunteer_logout()
    {
        $this->session->unset_userdata('volunteer_id');
        echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
    }

    public function dashboard()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null || $this->session->userdata('state_id') != "" || $this->session->userdata('state_id') != null || $this->session->userdata('first_name') != "" || $this->session->userdata('first_name') != null) {
			
			$today =  date('Y-m-d');
            $state_id = $this->session->userdata('state_id');
            $volunteer_id = $this->session->userdata('volunteer_id');
            $data['totaltask'] = $this->User_model->total_task_count($volunteer_id);
            $data['totalfield'] = $this->User_model->total_field_count($volunteer_id);
            //$data['timetask']= $this->User_model->timein_calculate($volunteer_id);
            //$data['timeouttask']= $this->User_model->timeout_calculate($volunteer_id);

            $join_data = array(
                array(
                    'table' => 'daily_report',
                    'fields' => array('dr_id', 'dr_time_in', 'dr_time_out'),
                    'joinWith' => array('approveddaily_ID', 'left'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id,
                        'approveddaily_ID !' => 0,
                    ),
                    'group_by' => array('approveddaily_ID'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task',
                    'fields' => array('task_id'),
                    'joinWith' => array('task_id'),
                ),

                array(
                    'joined' => 0,
                    'table' => 'approveddaily_report',
                    'fields' => array('admin_time'),
                    //'function'=>array('SUM','admin_time'),
                    'joinWith' => array('approveddaily_ID', 'left'),
                ),
            );

            $limit = '';
            $order_by = '';
            $data['reporttotal'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title', 'creation_date'),
                    'joinWith' => array('task_id'),
                    'group_by' => array('task_id'),
                    'where' => array(
                        'task_for' => 1
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'assigning_task',
                    'fields' => array('task_id', 'status'),
                    'joinWith' => array('task_id', 'left'),
                    'where' => array('volunteer_id' => $volunteer_id,),
                    'order_by' => array('task_id', 'desc'),
                ),
            );
            $limit = 5;
            $order_by = '';
            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title'),
                    'joinWith' => array('task_id'),
                    'group_by' => array('task_id'),
                    'where' => array(
                        'task_for' => 1
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'daily_report',
                    'fields' => array('dr_id', 'dr_time_in', 'dr_time_out', 'dr_activity', 'dr_create_date'),
                    'joinWith' => array('task_id', 'left'),
                    'where' => array('volunteer_id' => $volunteer_id, 'status' => 0, 'status' => 1,),
                    'order_by' => array(
                        'dr_id', 'DESC'
                    ),
                ),
            );

            $limit = '5';
            $order_by = array('dr_id', 'DESC');
            $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $join_data = array(
                array(
                    'table' => 'assigning_task',
                    'fields' => array('task_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id,
                        'status' => 0,
                    ),
                ),
            );
            $limit = '';
            $order_by = '';
            $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            foreach ($task as $key => $value) {
                $taskIDs[$key] = $value['task_id'];
            }

            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title', 'task_description', 'creation_date', 'status', 'region_id', 'task_state_id', 'task_type_id', 'task_brief'),
                    'joinWith' => array('task_id', 'task_type_id', 'region_id'),
                    'where' => array(
                        //'region_id' => 'region_id',
                        'status' => 1,
                        'task_status' => 0,
                        'task_for' => 1,
                        'task_type_id' => 1,
						'expected_end_date >' => "'".$today."'",

                    ),
                    'order_by' => array(
                        'task_id', 'DESC'
                    ),
                    'where_not_in' => array('task_id' => $taskIDs)
                ),
                array(
                    'joined' => 0,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task_type',
                    'fields' => array('task_type'),
                    'joinWith' => array('task_type_id', 'left'),
                ),
            );

            $limit = '5';

            $order_by = '';

            $data['find_task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $join_data = array(
                array(
                    'table' => 'assigning_task',
                    'fields' => array('task_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id,
                    ),
                ),
            );
            $limit = '';
            $order_by = '';
            $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            foreach ($task as $key => $value) {
                $taskIDs[$key] = $value['task_id'];
            }
			

            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title', 'task_description', 'creation_date', 'status', 'region_id', 'task_state_id', 'task_type_id', 'task_brief','expected_end_date'),
                    'joinWith' => array('task_id', 'task_type_id', 'region_id'),
                    'where' => array(
                        'task_state_id' => $state_id,
                        'status' => 1,
                        'task_status' => 0,
                        'task_for' => 1,
                        'task_type_id' => 2,
						'expected_end_date >' => "'".$today."'",
                    ),
                    'order_by' => array(
                        'task_id', 'DESC'
                    ),
                    'where_not_in' => array('task_id' => $taskIDs)
                ),
                array(
                    'joined' => 0,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task_type',
                    'fields' => array('task_type'),
                    'joinWith' => array('task_type_id', 'left'),
                ),
            );

            $limit = '5';

            $order_by = '';

            $data['find_task_offline'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id', 'mobile', 'vol_type_id'),
                    'joinWith' => array('volunteer_id','vol_type_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
				
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('index', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function dashboard_task_accept()
    {
        $volunteer_id = $this->session->userdata('volunteer_id');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'task_id' => $taskID,
            'volunteer_id' => $volunteer_id,
        );
        $fields = array(
            'status' => 1,
            'accepted_date' => date('y-m-d'),
        );
        $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
        if ($results) {
            $this->session->set_userdata('task_accept', 'true');
            echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        }
    }
    
    public function dashboard_task_reject()
    {
        $volunteer_id = $this->session->userdata('volunteer_id');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'task_id' => $taskID,
            'volunteer_id' => $volunteer_id,
        );
        $fields = array(
            'status' => 2,
            'rejected_date' => date('y-m-d'),
            //'rejected_reason'=>'test',
        );
        $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
        if ($results) {
            $this->session->set_userdata('task_reject', 'true');
            echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        }
    }

    public function task()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            $volunteer_id = $this->session->userdata('volunteer_id');
            $data['states'] = $this->Curl_model->fetch_all_data("state_id,state_name", 'states', 'status=1');
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title', 'task_brief', 'creation_date', 'task_status', 'task_description'),
                    'joinWith' => array('task_id'),
                    'group_by' => array('task_id'),
                    'where' => array(
                        'task_for' => 1
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'assigning_task',
                    'fields' => array('task_id', 'status'),
                    'joinWith' => array('task_id', 'left'),
                    'where' => array('volunteer_id' => $volunteer_id),
                    'order_by' => array('assigned_task_id', 'desc'),
                ),
            );
            $limit = '';
            $order_by = '';
            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('task-list', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function task_accept()
    {
        $volunteer_id = $this->session->userdata('volunteer_id');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'task_id' => $taskID,
            'volunteer_id' => $volunteer_id,
        );
        $fields = array(
            'status' => 1,
            'accepted_date' => date('y-m-d'),
        );

        $results = $this->Curl_model->update_data('assigning_task', $fields, $where);

        if ($results) {
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_description', 'task_id', 'task_title', 'task_brief', 'status', 'task_status'),
                    'where' => array('task_id' => $taskID),
                    'order_by' => array('task_id', 'DESC'),
                ),
            );
            $limit = '';
            $order_by = '';
            $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $email = $user_data['email'];
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'noreply@crymail.org';
            $msg = 'CRY VMS';

            function task_type($stauts)
            {
                if ($stauts == 0) {
                    return "<span style='padding:5px 10px;margin-right:5px;background-color:green;color:white;border-radius:10px;text-align:center;'>New</span>";
                }

                if ($stauts == 2) {
                    return "<span style='padding:5px 10px;margin-right:5px;background-color:orange;color:white;border-radius:10px;text-align:center;'>In-Working</span>";
                }
            }

            $task_stauts = task_type($task_data[0]['task_status']);

            
            $msg2 = "

            <center><p><strong style='font-weight:bold;'>Thanks for accepting the task. Task details is given below</strong></p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_title'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Description</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_brief'] . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Type</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_stauts . "</td>
                </tr>
            </table>";

            //die();
            $subj = "Assigned Task reminder from CRY";
            $btn = "Check Your Assigned Task Now!";
            $html = $this->request_email($msg, $msg2, $href, $btn);
            $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
            $this->session->set_userdata('task_accept', 'true');
            echo '<script>window.location.href = "' . base_url() . 'task"</script>';
        }
    }

    public function task_reject()
    {
        $volunteer_id = $this->session->userdata('volunteer_id');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
		$where = array(
			'task_id' => $taskID,
			'volunteer_id' => $volunteer_id,
		);
		$fields = array(
			'status' => 2,
			'rejected_date' => date('Y-m-d'),
		);
		$results = $this->Curl_model->update_data('assigning_task', $fields, $where);
		if ($results) {
			$join_data = array(
				array(
					'table' => 'task',
					'fields' => array('task_description', 'task_id', 'task_title', 'task_brief', 'status', 'task_status'),
					'where' => array('task_id' => $taskID),
					'order_by' => array('task_id', 'DESC'),
				),
			);
			$limit = '';
			$order_by = '';
			$task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
			$user_data = $this->Curl_model->fetch_data('volunteer', array('email'), array('volunteer_id' => $volunteer_id), '', '');
			// print_r($task_data);
			// die();
			$email = $user_data['email'];
			$href = base_url() . 'login';
			//$href2 = base_url().'verify/'.md5($results);
			$to = $email;
			$from = 'noreply@crymail.org';
			$msg = 'CRY VMS';
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
			$msg2 = "
			<center><p><strong style='font-weight:bold;'>You have cancel assigned task. Task details is given below</strong></p></center>
			<table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
				<tr>
					<th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
					<td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_title'] . "</td>
				</tr>
				<tr>
					<th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Description</th>
					<td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_brief'] . "</td>
				</tr>

				<tr>
					<th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Type</th>
					<td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_stauts . "</td>
				</tr>

			</table>";

			//die();

			$subj = "Assigned Task Rejected from CRY";
			$btn = "Check Your Assigned Task Now!";
			$html = $this->request_email_without_btn($msg, $msg2);
			$res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
			$this->session->set_userdata('task_reject', 'true');
			echo '<script>window.location.href = "' . base_url() . 'task"</script>';
		}
    }

    public function filter_my_task()
    {
        if (($this->session->userdata('volunteer_id') != "")) {
            $data['state'] = '';
            $data['datefilter'] = '';
            $data['status'] = '';
            $volunteer_id = $this->session->userdata('volunteer_id');
            //$data['totaltask'] = $this->User_model->total_task_count($volunteer_id);
            if ($this->input->get('state') != ''  && $this->input->get('datefilter') != '' && $this->input->get('status') != '') {
                $state = $this->input->get('state');
                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1])));
                $status = $this->input->get('status');
                $where_task = "FIND_IN_SET('$state', u.state_id) and ta.creation_date >= '$first_date' AND ta.creation_date <= '$second_date'and FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$volunteer_id', ta.volunteer_id)";
                $data['state'] = $state;
                $data['datefilter'] = $this->input->get('datefilter');
                $data['status'] = $status;
            } else if ($this->input->get('state') != ''  && $this->input->get('datefilter') != '') {
                $state = $this->input->get('state');
                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1])));
                $where_task = "FIND_IN_SET('$state', u.state_id) and ta.creation_date >= '$first_date' AND ta.creation_date <= '$second_date'and FIND_IN_SET('$volunteer_id', ta.volunteer_id)";
                $data['state'] = $state;
                $data['datefilter'] = $this->input->get('datefilter');
            } else if ($this->input->get('datefilter') != '' && $this->input->get('status') != '') {
                $datefilter = $this->input->get('datefilter');
                $status = $this->input->get('status');
                $where_task = "FIND_IN_SET('$datefilter', ta.assigned_date)and FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$volunteer_id', ta.volunteer_id)";
                $data['datefilter'] = $this->input->get('datefilter');
                $data['status'] = $status;
            } else if ($this->input->get('state') != '' && $this->input->get('status') != '') {
                $state = $this->input->get('state');
                $status = $this->input->get('status');
                $where_task = "FIND_IN_SET('$state', u.state_id)and FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$volunteer_id', ta.volunteer_id)";
                $data['state'] = $state;
                $data['status'] = $status;
            } else if ($this->input->get('state') != '') {
                $state = $this->input->get('state');
                $where_task = "FIND_IN_SET('$state', u.state_id)and FIND_IN_SET('$volunteer_id', ta.volunteer_id)";
                $data['state'] = $state;
            } else if ($this->input->get('status') != '') {
                $status = $this->input->get('status');
                $where_task = "FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$volunteer_id', ta.volunteer_id)";
                $data['status'] = $status;
            } else if ($this->input->get('datefilter') != '') {

                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1]))); //exit;
                $where_task = "ta.creation_date >= '$first_date' AND ta.creation_date <= '$second_date'and FIND_IN_SET('$volunteer_id', ta.volunteer_id)";
                $data['datefilter'] = $this->input->get('datefilter');
            } else {

                $volunteer_id = $this->session->userdata('volunteer_id');
                $where_task = "ta.volunteer_id=$volunteer_id";
            }

            $data["task"] = $this->User_model->fetch_my_task($where_task);
            $data['states'] = $this->Curl_model->fetch_all_data("state_id,state_name", 'states', 'status=1');
            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id', 'mobile'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('task-list', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function view_task_details()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            $volunteer_id = $this->session->userdata('volunteer_id');
            $v = $this->uri->segment(2);
            $data['encode_taskID'] = $v;
            $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
            $where = "task_id = '$val'";
            $data['task'] = $this->Curl_model->fetch_single_data('*', 'task', $where);
            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('view-task', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function task_member()
    {
        // $encode_taskID = $this->uri->segment(2);
        // $res['encode_taskID'] = $encode_taskID;
        // $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        // $join_data = array(
        //     array(
        //         'table' => 'assigning_task',
        //         'fields' => array('taskID', 'userID'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'status' => 1,
        //             'taskID' => $taskID
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'users',
        //         'fields' => array('firstName', 'lastName', 'mobile', 'email'),
        //         'joinWith' => array('userID', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'user_data',
        //         'fields' => array('gender', 'profile'),
        //         'joinWith' => array('userID', 'left'),
        //     ),
        // );
        // $limit = '';
        // $order_by = '';
        // $res['valunteers'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        // $CI = &get_instance();
        // $userID = $this->session->userdata('userID');
        // $data['totaltask'] = $this->User_model->total_task_count($userID);

        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('task-member');
        $this->load->view('temp/footer');
    }

    public function add_daily_report()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            $volunteer_id = $this->session->userdata('volunteer_id');
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title'),
                    'joinWith' => array('task_id'),
                    'group_by' => array('task_id'),
                    'where' => array(
                        'task_for' => 1
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'assigning_task',
                    'fields' => array('task_id'),
                    'joinWith' => array('task_id', 'left'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id,
                        'status' => '1',
                    ),
                ),
            );
            $limit = '';
            $order_by = '';
            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            if ($this->input->post()) {
                if ($this->input->post('task') != '') {
                    $data['letest_taskID'] = $this->input->post('task');
                } else {
                    $data['letest_taskID'] = $data['task'][0]['task_id'];
                }
            } else {
                $data['letest_taskID'] = $data['task'][0]['task_id'];
            }

            $join_data = array(
                array(
                    'table' => 'daily_report',
                    'fields' => array('dr_id', 'dr_time_in', 'dr_time_out', 'dr_activity'),
                    'joinWith' => array('task_id'),
                    'where' => array('volunteer_id' => $volunteer_id),
                    'order_by' => array('dr_id', 'desc'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title'),
                    'joinWith' => array('task_id', 'left'),
                    'where' => array('task_id' => $data['letest_taskID']),
                ),
            );
            $limit = '';
            $order_by = array('dr_id', 'DESC');
            $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $data['totaltask'] = $this->User_model->total_task_count($volunteer_id);


            if (!empty($this->input->post('submit')) && $this->input->post('submit') == 'submit') {
                    //print_r($this->input->post()); die();
                    $attachmentTypeIDs = $this->input->post('attachmentTypeID');
                    $tasktitle = $this->input->post('tasktitle');
                    $date = $this->input->post('birthday1');
                    $dailyIn = $this->input->post('dailyReportTimeIn');
                    $dailyIn1 = $this->input->post('dailyReportTimeIn1');
                    $dailyOut = $this->input->post('dailyReportTimeOut');
                    $dailyOut1 = $this->input->post('dailyReportTimeOut1');
                    $dailyActivity = $this->input->post('dailyActivity');
                    $improved_msg = $this->input->post('improved_msg');
                    $challeges_face = $this->input->post('challeges_face');
                    $experrience_any = $this->input->post('experrience_any');
                    //$taskID=1;
                    $data = array(
                        'task_id' => $tasktitle,
                        'volunteer_id' => $volunteer_id,
                        'dr_date' => date('Y-m-d', strtotime($date)),
                        'dr_time_in' => $dailyIn . ':' . $dailyIn1,
                        'dr_time_out' => $dailyOut . ':' . $dailyOut1,
                        'dr_activity' => $dailyActivity,
                        'improvement' => $improved_msg,
                        'challenges' => $challeges_face,
                        'experience' => $experrience_any,
                        'status' => 1,
                        'dr_create_date' => date('Y-m-d'),
                    );
					
					$config['upload_path']          = 'uploads/dr_attach/';
					$config['allowed_types']        = 'doc|docx|pdf|jpg';
					$new_name = time().$_FILES["attachment"]['name'];
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if ($this->upload->do_upload('attachment')){					
						$file=$this->upload->data();					
						$data['attachment']=$file['file_name'];	
					}

                    //print_r($data); die();
                    $dailyReportID = $this->Curl_model->insert_data('daily_report', $data);
					$this->session->set_flashdata('data_message','Successfully Submitted!');
                    echo '<script>window.location.href = "'.base_url().'add-daily-report"</script>';
                    exit();
                    $datats['task_status'] = 2;
                    $task_data = $this->Curl_model->update_data('task', $datats, array('task_id' => $tasktitle));
                
            }
           
			
            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name','vol_type_id'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('add-daily-report', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function validate_time($str)
    {
        list($hh, $mm) = split('[:]', $str);

        if (!is_numeric($hh) || !is_numeric($mm)) {

            $this->form_validation->set_message('validate_time', 'Not numeric');

            return FALSE;
        } else if ((int) $hh > 24 || (int) $mm > 59) {

            $this->form_validation->set_message('validate_time', 'Invalid time');

            return FALSE;
        } else if (mktime((int) $hh, (int) $mm) === FALSE) {

            $this->form_validation->set_message('validate_time', 'Invalid time');

            return FALSE;
        }

        return TRUE;
    }

    public function daily_report()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            $volunteer_id = $this->session->userdata('volunteer_id');
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title'),
                    'joinWith' => array('task_id'),
                    'where' => array(
                        'task_for' => 1
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'assigning_task',
                    'fields' => array('task_id'),
                    'joinWith' => array('task_id', 'left'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id,
                        'status' => '1',
                    ),
                ),
            );
            $limit = '';
            $order_by = '';
            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            if ($this->input->post()) {
                if ($this->input->post('task') != '') {
                    $data['letest_taskID'] = $this->input->post('task');
                } else {
                    $data['letest_taskID'] = $data['task'][0]['task_id'];
                }
            } else {
                $data['letest_taskID'] = $data['task'][0]['task_id'];
            }

            $join_data = array(
                array(
                    'table' => 'daily_report',
                    'fields' => array('dr_id', 'dr_time_in', 'dr_time_out', 'dr_activity', 'dr_create_date'),
                    'joinWith' => array('task_id'),
                    'where' => array('volunteer_id' => $volunteer_id),
                    'order_by' => array('dr_id', 'desc'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title'),
                    'joinWith' => array('task_id', 'left'),
                    'where' => array('task_id' => $data['letest_taskID']),
                ),
            );
            $limit = '';
            $order_by = array('dr_id', 'DESC');
            $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //print_r($data['report']); die();
            $data['totaltask'] = $this->User_model->total_task_count($volunteer_id);
            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('daily-report', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function daily_report_all_data()
    {
        if (($this->session->userdata('userID') != "")) {
            $userID = $this->session->userdata('userID');
            $v = $this->uri->segment(2);
            $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
            $where = "dailyReportID = '$val'";
            $data['report'] = $this->Curl_model->fetch_single_data('*', 'daily_report', $where);

            $join_data = array(
                array(
                    'table' => 'attachment',
                    'fields' => array('attachmentName', 'attachmentSize', 'attachmentDate', 'userID', 'attachmentTypeID'),
                    'joinWith' => array('attachmentTypeID'),
                    'where' => array(
                        'status' => 1,
                        'dailyReportID' => $val,
                        'userID' => $userID
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'attachment_type',
                    'fields' => array('attachmentTypeName', 'attachmentFileType'),
                    'joinWith' => array('attachmentTypeID', 'left'),
                ),

                array(
                    'joined' => 0,
                    'table' => 'users',
                    'fields' => array('firstName', 'lastName'),
                    'joinWith' => array('userID', 'left'),
                ),

            );
            $limit = '';
            $order_by = '';
            $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $CI = &get_instance();
            $userID = $this->session->userdata('userID');
            $data['totaltask'] = $this->User_model->total_task_count($userID);
            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('view-all-daily-data', $data);

            $this->load->view('temp/footer');
        } else {

            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }


    public function all_city()
    {
        echo '<option value="">Select City</option>';
        $stateID = $this->input->post('stateId');
        if ($this->input->post('stateId') != 0) {
            $fields3 = array(
                'cityID',
                'cityName',
            );
            $where3 = array(
                'stateID' => $stateID
            );
            $limit3 = '';
            //$order_by = array('userID','DESC');
            $order_by3 = "";
            $tempcities = $this->Curl_model->fetch_data_in_many_array('cities', $fields3, $where3, $limit3, $order_by3);

            foreach ($tempcities as $key => $value) {

                echo '<option class="cv_' . $value['cityID'] . '" value="' . $value['cityID'] . '">' . ucwords($value['cityName']) . '</option>';
            }
        }
    }

    public function find_task()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            $volunteer_id = $this->session->userdata('volunteer_id');
            $state_id = $this->session->userdata('state_id');

            $data['state'] = $this->Curl_model->fetch_all_data("state_id,state_name", 'states', 'status=1');
            $join_data = array(
                array(
                    'table' => 'assigning_task',
                    'fields' => array('task_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id,
                    ),
                ),
            );
            $limit = '';
            $order_by = '';
            $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            foreach ($task as $key => $value) {
                $taskIDs[$key] = $value['task_id'];
            }
			$today =  date('Y-m-d');
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title', 'task_description', 'creation_date', 'status', 'region_id', 'task_state_id', 'task_type_id', 'task_brief','expected_end_date'),
                    'joinWith' => array('task_id', 'task_type_id', 'region_id'),
                    'where' => array(
                        //'task_state_id' => $state_id,
                        'status' => 1,
                        'task_status' => 0,
                        'task_for' => 1,
						'expected_end_date >' => "'".$today."'",

                    ),
                    'order_by' => array(
                        'task_id', 'DESC'
                    ),
                    'where_not_in' => array('task_id' => $taskIDs)
                ),
                array(
                    'joined' => 0,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task_type',
                    'fields' => array('task_type','task_type_id'),
                    'joinWith' => array('task_type_id', 'left'),
                ),
            );

            $limit = '';

            $order_by = '';

            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
			
			$join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title', 'task_description', 'creation_date', 'status', 'region_id', 'task_state_id', 'task_type_id', 'task_brief','expected_end_date'),
                    'joinWith' => array('task_id', 'task_type_id', 'region_id'),
                    'where' => array(
                        //'task_state_id' => $state_id,
                        'status' => 1,
                        'task_status' => 0,
                        'task_for' => 1,
						'task_type_id'=>1,
						'expected_end_date >' => "'".$today."'",

                    ),
                    'order_by' => array(
                        'task_id', 'DESC'
                    ),
                    'where_not_in' => array('task_id' => $taskIDs)
                ),
                array(
                    'joined' => 0,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task_type',
                    'fields' => array('task_type','task_type_id'),
                    'joinWith' => array('task_type_id', 'left'),
                ),
            );

            $limit = '';

            $order_by = '';

            $data['task_online'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
			
			$join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title', 'task_description', 'creation_date', 'status', 'region_id', 'task_state_id', 'task_type_id', 'task_brief','expected_end_date'),
                    'joinWith' => array('task_id', 'task_type_id', 'region_id'),
                    'where' => array(
                        //'task_state_id' => $state_id,
                        'status' => 1,
                        'task_status' => 0,
                        'task_for' => 1,
						'task_type_id'=>2,
						'expected_end_date >' => "'".$today."'",

                    ),
                    'order_by' => array(
                        'task_id', 'DESC'
                    ),
                    'where_not_in' => array('task_id' => $taskIDs)
                ),
                array(
                    'joined' => 0,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task_type',
                    'fields' => array('task_type','task_type_id'),
                    'joinWith' => array('task_type_id', 'left'),
                ),
            );

            $limit = '';

            $order_by = '';

            $data['task_offline'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
//print_r($data['task']); exit;
            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name','vol_type_id'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('find-task', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function send_request()

    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            $volunteer_id = $this->session->userdata('volunteer_id');
            $task = $this->uri->segment(2);
            $task_id = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
            $data = array(
                'task_id' => $task_id,
                'volunteer_id' => $volunteer_id,
                'status' => 0,
                'sendRequiestCreatingDate' => date('y-m-d h:i:s'),
            );

            $results = $this->Curl_model->insert_data('send_requiest', $data);

            if ($results) {

                $join_data = array(

                    array(

                        'table' => 'task',

                        'fields' => array('task_description', 'task_id', 'task_title', 'task_brief', 'creation_date', 'status'),

                        'where' => array('task_id' => $task_id),

                        'order_by' => array('task_id', 'DESC'),

                    ),
                );
                $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);


                $user_data = $this->Curl_model->fetch_data('volunteer', array('email'), array('volunteer_id' => $volunteer_id), '', '');

                // print_r($task_data);

                // die();
                $email = $user_data['email'];
                $href = base_url() . 'login';
                $to = $email;
                $from = 'noreply@crymail.org';
                $msg = 'CRY Volunteer';
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

            <center><p><strong style='font-weight:bold;'>Thanks for sending request for task. Task details is given below</strong></p></center>

            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>

                <tr>

                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>

                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_title'] . "</td>

                </tr>

                <tr>

                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Description</th>

                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_data[0]['task_brief'] . "</td>

                </tr>

                <tr>

                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Type</th>

                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $task_stauts . "</td>

                </tr>

            </table>";

                //die();

                $subj = "Send Request for Task from Caritas India";

                $btn = "LogIn Now!";



                $html = $this->request_email($msg, $msg2, $href, $btn);

                $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

                $this->session->set_userdata('request_send', 'true');

                echo '<script>window.location.href = "' . base_url() . 'find-task"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
            }
        }
    }



    public function search_find_task()

    {

        // if (($this->session->userdata('userID') != "")) {

        //     $userID = $this->session->userdata('userID');

        //     $data['cause'] = "";

        //     $data['states'] = "";

        //     $data['city'] = array();

        //     $data['cities'] = "";

        //     $data['totaltask'] = $this->User_model->total_task_count($userID);

        //     $join_data = array(

        //         array(

        //             'table' => 'assigning_task',

        //             'fields' => array('taskID'),

        //             'where' => array(

        //                 'userID' => $userID,

        //             ),

        //         ),

        //     );



        //     $limit = '';

        //     $order_by = '';

        //     $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        //     foreach ($task as $key => $value) {

        //         $taskIDs[$key] = $value['taskID'];

        //     }

        //     $where111['taskLocationID !'] = 0;

        //     $where['taskStatus !'] = 1;

        //     $join_data = array(

        //         array(

        //             'table' => 'task',

        //             'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate', 'taskCreationDate', 'taskStatus'),

        //             'joinWith' => array('taskID'),

        //             'where' => $where,

        //             'where_not_in' => array('taskID' => $taskIDs)

        //         ),

        //     );

        //     if ($this->input->get('causes') != '') {

        //         $where['causesID'] = $this->input->get('causes');

        //         $data['cause'] = $this->input->get('causes');

        //         $join_data = array(

        //             array(

        //                 'table' => 'task',

        //                 'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate', 'taskCreationDate', 'taskStatus'),

        //                 'joinWith' => array('taskID'),

        //                 'where' => $where,

        //                 'where_not_in' => array('taskID' => $taskIDs)

        //             ),

        //         );

        //     }

        //     if ($this->input->get('cities') != '') {

        //         $where111['cityID'] = $this->input->get('cities');

        //         $data['cities'] = $this->input->get('cities');

        //         $join_data = array(

        //             array(

        //                 'table' => 'task',

        //                 'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate', 'taskCreationDate', 'taskStatus'),

        //                 'joinWith' => array('taskID'),

        //                 'where' => $where,

        //                 'where_not_in' => array('taskID' => $taskIDs)

        //             ),

        //             array(

        //                 'joined' => 0,

        //                 'table' => 'task_location',

        //                 'fields' => array('stateID'),

        //                 'where' => $where111,

        //                 'joinWith' => array('taskID', 'left'),

        //             ),

        //         );

        //     }

        //     if ($this->input->get('state') != '') {

        //         $where111['stateID'] = $this->input->get('state');

        //         $data['states'] = $this->input->get('state');

        //         $join_data = array(

        //             array(

        //                 'table' => 'task_location',

        //                 'fields' => array('stateID'),

        //                 'where' => $where111,

        //                 'group_by' => array('stateID'),

        //             ),

        //             array(

        //                 'joined' => 0,

        //                 'table' => 'task',

        //                 'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate', 'taskCreationDate', 'taskStatus'),

        //                 'joinWith' => array('taskID', 'left'),

        //                 'where' => $where,

        //                 'where_not_in' => array('taskID' => $taskIDs)

        //             ),

        //         );

        //     }



        //     $limit = '';

        //     $order_by = '';

        //     $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        //     $data['causes'] = $this->Curl_model->fetch_all_data("causesID,causesName", 'causes', 'status=1');



        //     $join_data = array(

        //         array(

        //             'table' => 'users',

        //             'fields' => array('firstName', 'lastName'),

        //             'joinWith' => array('userID'),

        //             'where' => array(

        //                 'userID' => $userID

        //             ),

        //         ),

        //         array(

        //             'joined' => 0,

        //             'table' => 'user_data',

        //             'fields' => array('profile', 'dioceses_id'),

        //             'joinWith' => array('userID', 'dioceses_id', 'left'),

        //         ),

        //         array(

        //             'joined' => 1,

        //             'table' => 'dioceses',

        //             'fields' => array('name', 'dioceses_id'),

        //             'joinWith' => array('dioceses_id', 'left'),

        //         ),

        //     );

        //     $where = array();

        //     $limit = '';

        //     $order_by = '';

        //     $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);



        //     $fields = array(

        //         'stateID',

        //         'stateName',

        //     );

        //     $where = '';

        //     $limit = '';

        //     $order_by = array('stateID', 'ASC');

        //     $data['state'] = $this->Curl_model->fetch_data_in_many_array('states', $fields, $where, $limit, $order_by);

        //     if ($data['states'] != '') {

        //         $fields = array(

        //             'cityID',

        //             'cityName',

        //         );

        //         $where = array('stateID' => $data['states']);

        //         $limit = '';

        //         $order_by = '';

        //         $data['city'] = $this->Curl_model->fetch_data_in_many_array('cities', $fields, $where, $limit, $order_by);

        //     }

        // echo "<pre>";

        // print_r($data);

        // die();	

        $this->load->view('temp/head');

        $this->load->view('temp/header');

        $this->load->view('temp/sidebar');

        $this->load->view('find-task');

        $this->load->view('temp/footer');

        // } else {

        //     echo '<script>window.location.href = "' . base_url() . 'login"</script>';

        // }

    }



    public function reward_point()

    {

        if (($this->session->userdata('userID') != "")) {

            $userID = $this->session->userdata('userID');

            $data['totaltask'] = $this->User_model->total_task_count($userID);

            $join_data = array(

                array(

                    'table' => 'daily_report',

                    'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut'),

                    'joinWith' => array('approveddaily_ID', 'left'),

                    'where' => array(

                        'userID' => $userID,

                        'approveddaily_ID !' => 0,

                    ),

                    'group_by' => array('approveddaily_ID'),

                ),

                array(

                    'joined' => 0,

                    'table' => 'task',

                    'fields' => array('taskID'),

                    'joinWith' => array('taskID'),

                ),



                array(

                    'joined' => 0,

                    'table' => 'approveddaily_report',

                    'fields' => array('admin_time'),

                    //'function'=>array('SUM','admin_time'),

                    'joinWith' => array('approveddaily_ID', 'left'),

                ),

            );



            $limit = '';

            $order_by = '';

            $data['reporttotal'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);



            $fields = array(

                'badgeName',

                'badgeLimit',

            );

            $where = '';

            $limit = '';

            $order_by = array('badgeID', 'ASC');

            $data['mm_badge'] = $this->Curl_model->fetch_data_in_many_array('mm_badge', $fields, $where, $limit, $order_by);



            $join_data = array(

                array(

                    'table' => 'approveddaily_report',

                    'fields' => array('userID', 'taskID', 'admin_time', 'creation_date'),

                    'joinWith' => array('userID'),

                    'where' => array(

                        'userID' => $userID

                    ),

                    'order_by' => array('creation_date', 'ASC'),

                    // 'function'=>array('SUM','admin_time'),

                ),

            );

            $where = array();

            $limit = '';

            $order_by = '';

            $res['rewardDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $temp_userid = 0000 - 00 - 00;

            $h = 0;

            $m = 0;

            //$badges =200;

            $badges_less = 0;

            $dta = array();

            $dta1 = array();

            $dta2 = array();

            foreach ($res['rewardDetails'] as $key => $value) {

                //echo $temp_userid;

                $temp_admin_time = explode('.', $value['admin_time']);

                $cmp_date = date('Y-m', strtotime($value['creation_date'])) . '-01';

                if ($cmp_date == $temp_userid) {

                    $h += $temp_admin_time[0];

                    $m += $temp_admin_time[1];

                    $mmm = $m % 60;

                    $h += ($m - $mmm) / 60;

                    $m = $mmm;

                    // if(isset($badges)){

                    //     if($h>=$badges){

                    //         //echo $badges;

                    //         $dta[$value['userID']]=$h.'.'.$m;

                    //     }

                    // }

                    if ($key == (sizeof($res['rewardDetails']) - 1)) {

                        if ($h >= $badges_less) {

                            //echo $badges;

                            $dta1[$cmp_date] = $h . '.' . $m;

                            $dta2[date('M', strtotime($cmp_date))] = $h . '.' . $m;
                        }
                    }

                    $temp_userid = $cmp_date;

                    //echo "in"; 

                } else {

                    $h += $temp_admin_time[0];

                    $m += $temp_admin_time[1];

                    $mmm = $m % 60;

                    $h += ($m - $mmm) / 60;

                    $m = $mmm;

                    // if(isset($badges)){

                    //     if($h>=$badges){

                    //         //echo $badges;

                    //         $dta[$value['userID']]=$h.'.'.$m;

                    //     }

                    // }

                    if (isset($badges_less)) {

                        if ($h >= $badges_less) {

                            //echo $badges;

                            $dta1[$cmp_date] = $h . '.' . $m;

                            $dta2[date('M', strtotime($cmp_date))] = $h . '.' . $m;
                        }
                    }

                    $temp_userid = $cmp_date;

                    //echo "out";

                }
            }

            // if(isset($badges)){

            // $data['reward_user'] = $dta;

            // }

            $data['reward_user_count'] = $dta1;

            $data['reward_user_count_by_month'] = $dta2;

            //ksort($data['reward_user_count'],2);

            // print_r($data['reward_user_count']);

            // die();

            $join_data = array(

                array(

                    'table' => 'users',

                    'fields' => array('firstName', 'lastName'),

                    'joinWith' => array('userID'),

                    'where' => array(

                        'userID' => $userID

                    ),

                ),

                array(

                    'joined' => 0,

                    'table' => 'user_data',

                    'fields' => array('profile', 'dioceses_id'),

                    'joinWith' => array('userID', 'dioceses_id', 'left'),

                ),

                array(

                    'joined' => 1,

                    'table' => 'dioceses',

                    'fields' => array('name', 'dioceses_id'),

                    'joinWith' => array('dioceses_id', 'left'),

                ),

            );

            $where = array();

            $limit = '';

            $order_by = '';

            $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);



            $this->load->view('temp/head');

            $this->load->view('temp/header', $data);

            $this->load->view('temp/sidebar', $data);

            $this->load->view('reward-point', $data);

            $this->load->view('temp/footer');
        } else {

            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';

            //redirect(base_url().'login','refresh');

        }
    }

    public function reward_report()

    {

        if (($this->session->userdata('userID') != "")) {

            $userID = $this->session->userdata('userID');

            $data['totaltask'] = $this->User_model->total_task_count($userID);



            $join_data = array(

                array(

                    'table' => 'users',

                    'fields' => array('firstName', 'lastName'),

                    'joinWith' => array('userID'),

                    'where' => array(

                        'userID' => $userID

                    ),

                ),

                array(

                    'joined' => 0,

                    'table' => 'user_data',

                    'fields' => array('profile'),

                    'joinWith' => array('userID', 'left'),

                ),

            );

            $where = array();

            $limit = '';

            $order_by = '';

            $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $join_data = array(

                array(

                    'table' => 'approveddaily_report',

                    'fields' => array('userID', 'taskID', 'admin_time', 'creation_date'),

                    'joinWith' => array('userID'),

                    'where' => array(

                        'userID' => $userID

                    ),

                    // 'function'=>array('SUM','admin_time'),

                ),

            );

            $where = array();

            $limit = '';

            $order_by = '';

            $res['rewardDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $temp_userid = 0000 - 00 - 00;

            $h = 0;

            $m = 0;

            //$badges =200;

            $badges_less1 = 100;

            $badges_less = 100;

            $dta = array();

            $dta1 = array();

            $dta2 = array();

            foreach ($res['rewardDetails'] as $key => $value) {

                //echo $temp_userid;

                $temp_admin_time = explode('.', $value['admin_time']);

                $cmp_date = date('Y-m-d', strtotime($value['creation_date']));

                if ($cmp_date == $temp_userid) {

                    $h += $temp_admin_time[0];

                    $m += $temp_admin_time[1];

                    $mmm = $m % 60;

                    $h += ($m - $mmm) / 60;

                    $m = $mmm;

                    // if(isset($badges)){

                    //     if($h>=$badges){

                    //         //echo $badges;

                    //         $dta[$value['userID']]=$h.'.'.$m;

                    //     }

                    // }

                    if ($key == (sizeof($res['rewardDetails']) - 1)) {

                        if ($h >= $badges_less) {

                            if ($h >= 4000) {

                                //echo $badges;

                                $dta1['PLATINUM'] = array($cmp_date => $h . '.' . $m);

                                $badges_less = 40000;
                            } else if ($h >= 500) {

                                //echo $badges;

                                $dta1['GOLD'] = array($cmp_date => $h . '.' . $m);

                                $badges_less = 4000;
                            } else if ($h >= 250) {

                                //echo $badges;

                                $dta1['SILVER'] = array($cmp_date => $h . '.' . $m);

                                $badges_less = 500;
                            } else if ($h >= 100) {

                                //echo $badges;

                                $dta1['BRONZE'] = array($cmp_date => $h . '.' . $m);

                                $badges_less = 250;
                            }
                        }

                        if ($h >= $badges_less1) {

                            $dta2[date('M', strtotime($cmp_date))] = $h . '.' . $m;
                        }
                    }

                    $temp_userid = $cmp_date;

                    //echo "in"; 

                } else {

                    $h += $temp_admin_time[0];

                    $m += $temp_admin_time[1];

                    $mmm = $m % 60;

                    $h += ($m - $mmm) / 60;

                    $m = $mmm;

                    // if(isset($badges)){

                    //     if($h>=$badges){

                    //         //echo $badges;

                    //         $dta[$value['userID']]=$h.'.'.$m;

                    //     }

                    // }

                    if (isset($badges_less)) {

                        if ($h >= $badges_less) {

                            if ($h >= 4000) {

                                //echo $badges;

                                $dta1['PLATINUM'] = array($cmp_date => $h . '.' . $m);

                                $badges_less = 40000;
                            } else if ($h >= 500) {

                                //echo $badges;

                                $dta1['GOLD'] = array($cmp_date => $h . '.' . $m);

                                $badges_less = 4000;
                            } else if ($h >= 250) {

                                //echo $badges;

                                $dta1['SILVER'] = array($cmp_date => $h . '.' . $m);

                                $badges_less = 500;
                            } else if ($h >= 100) {

                                //echo $badges;

                                $dta1['BRONZE'] = array($cmp_date => $h . '.' . $m);

                                $badges_less = 250;
                            }
                        }

                        if ($h >= $badges_less1) {

                            $dta2[date('M', strtotime($cmp_date))] = $h . '.' . $m;
                        }
                    }

                    $temp_userid = $cmp_date;

                    //echo "out";

                }
            }

            // if(isset($badges)){

            // $data['reward_user'] = $dta;

            // }

            $data['reward_user_count'] = $dta1;

            $data['reward_user_count_by_month'] = $dta2;



            $this->load->view('temp/head');

            $this->load->view('temp/header', $data);

            $this->load->view('temp/sidebar', $data);

            $this->load->view('reward-report', $data);

            $this->load->view('temp/footer');
        } else {

            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        }
    }

    public function final_task_report()

    {

        if (($this->session->userdata('userID') != "")) {

            $CI = &get_instance();

            $data['causes'] = $this->Curl_model->fetch_all_data("causesID,causesName", 'causes', 'status=1');

            $userID = $this->session->userdata('userID');

            $join_data = array(

                array(

                    'table' => 'task',

                    'fields' => array('taskID', 'taskTitle', 'taskBrief', 'taskPublishedDate', 'taskStatus', 'taskDescription'),

                    'joinWith' => array('taskID'),



                ),

                array(

                    'joined' => 0,

                    'table' => 'assigning_task',

                    'fields' => array('taskID'),

                    'joinWith' => array('taskID', 'left'),

                    'where' => array(

                        'userID' => $userID

                    ),

                ),

            );



            $limit = '';

            $order_by = '';

            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $data['totaltask'] = $this->User_model->total_task_count($userID);



            $join_data = array(

                array(

                    'table' => 'users',

                    'fields' => array('firstName', 'lastName'),

                    'joinWith' => array('userID'),

                    'where' => array(

                        'userID' => $userID

                    ),

                ),

                array(

                    'joined' => 0,

                    'table' => 'user_data',

                    'fields' => array('profile', 'dioceses_id'),

                    'joinWith' => array('userID', 'dioceses_id', 'left'),

                ),

                array(

                    'joined' => 1,

                    'table' => 'dioceses',

                    'fields' => array('name', 'dioceses_id'),

                    'joinWith' => array('dioceses_id', 'left'),

                ),

            );

            $where = array();

            $limit = '';

            $order_by = '';

            $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);



            $this->load->view('temp/head');

            $this->load->view('temp/header', $data);

            $this->load->view('temp/sidebar', $data);

            $this->load->view('tast-report', $data);

            $this->load->view('temp/footer');
        } else {

            echo '<script>window.location.href = "' . base_url() . 'login"</script>';

            //redirect(base_url().'login','refresh');

        }
    }

    public function final_daily_report()

    {

        if (($this->session->userdata('userID') != "")) {

            $userID = $this->session->userdata('userID');

            $join_data = array(

                array(

                    'table' => 'task',

                    'fields' => array('taskID', 'taskTitle'),

                    'joinWith' => array('taskID'),

                ),

                array(

                    'joined' => 0,

                    'table' => 'assigning_task',

                    'fields' => array('taskID'),

                    'joinWith' => array('taskID', 'left'),

                    'where' => array(

                        'userID' => $userID

                    ),

                ),

            );



            $limit = '';

            $order_by = '';

            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);



            $join_data = array(

                array(

                    'table' => 'task',

                    'fields' => array('taskID', 'taskTitle'),

                    'joinWith' => array('taskID'),

                ),

                array(

                    'joined' => 0,

                    'table' => 'daily_report',

                    'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity', 'dailyReportCreationDate'),

                    'joinWith' => array('taskID', 'left'),

                    'where' => array(

                        'userID' => $userID

                    ),

                    'order_by' => array(

                        'dailyReportID', 'DESC'

                    ),

                ),

            );



            $limit = '';

            $order_by = '';

            $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);



            $join_data = array(

                array(

                    'table' => 'attachment',

                    'fields' => array('attachmentName', 'attachmentSize', 'attachmentDate', 'userID', 'attachmentTypeID'),

                    'joinWith' => array('attachmentTypeID'),

                    'where' => array(

                        'status' => 1,

                        'taskID' => $taskID

                    ),

                ),

                array(

                    'joined' => 0,

                    'table' => 'attachment_type',

                    'fields' => array('attachmentTypeName', 'attachmentFileType'),

                    'joinWith' => array('attachmentTypeID', 'left'),

                ),

                array(

                    'joined' => 0,

                    'table' => 'users',

                    'fields' => array('firstName', 'lastName'),

                    'joinWith' => array('userID', 'left'),

                ),

            );



            $limit = '';

            $order_by = '';

            $res['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $data['totaltask'] = $this->User_model->total_task_count($userID);



            $join_data = array(

                array(

                    'table' => 'users',

                    'fields' => array('firstName', 'lastName'),

                    'joinWith' => array('userID'),

                    'where' => array(

                        'userID' => $userID

                    ),

                ),

                array(

                    'joined' => 0,

                    'table' => 'user_data',

                    'fields' => array('profile', 'dioceses_id'),

                    'joinWith' => array('userID', 'dioceses_id', 'left'),

                ),

                array(

                    'joined' => 1,

                    'table' => 'dioceses',

                    'fields' => array('name', 'dioceses_id'),

                    'joinWith' => array('dioceses_id', 'left'),

                ),

            );

            $where = array();

            $limit = '';

            $order_by = '';

            $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);



            $this->load->view('temp/head');

            $this->load->view('temp/header', $data);

            $this->load->view('temp/sidebar', $data);

            $this->load->view('final-daily-report', $data);

            $this->load->view('temp/footer');
        } else {

            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';

            //redirect(base_url().'login','refresh');

        }
    }


    public function change_password()
    {
        $volunteer_id = $this->session->userdata('volunteer_id');
        $data['totaltask'] = $this->User_model->total_task_count($volunteer_id);
        $join_data = array(
            array(
                'table' => 'volunteer',
                'fields' => array('first_name', 'last_name', 'state_id', 'mobile'),
                'joinWith' => array('volunteer_id'),
                'where' => array(
                    'volunteer_id' => $volunteer_id
                ),
            ),
            array(
                'joined' => 0,
                'table' => 'volunteer_data',
                'fields' => array('profile'),
                'joinWith' => array('volunteer_id', 'left'),
            ),
            array(
                'joined' => 0,
                'table' => 'states',
                'fields' => array('region_id', 'state_name'),
                'joinWith' => array('state_id', 'left'),
            ),
			array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
            array(
                'joined' => 2,
                'table' => 'regions',
                'fields' => array('region_name'),
                'joinWith' => array('region_id', 'left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by = '';
        $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

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
                    'rules' => 'trim|required|min_length[5]',
                    'errors' => array(
                        'required' => 'Please Enter New Password',
                        'min_length' => 'Please Enter New Password at least 5 digits',
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
                    'volunteer_id' => $volunteer_id
                );

                $limit = '';
                $order_by = array('volunteer_id', 'DESC');
                $results = $this->Curl_model->fetch_data('volunteer', $fields, $where, $limit, $order_by);

                //print_r($results);

                if (!empty($results) && $results != '') {

                    $r_password = $results['password'];
                    $oldpass = md5($this->input->post('oldpassword'));
                    if ($oldpass == $r_password) {
                        $npass = md5($this->input->post('newpassword'));
                        //echo $npass; exit;
                        $where = array(
                            'volunteer_id' => $volunteer_id,
                        );
                        $fields = array(
                            'password' => $npass
                        );
                        $results = $this->Curl_model->update_data('volunteer', $fields, $where);
                        if ($results) {
                            $this->session->set_userdata('success', 'Your password has been changed');
                            echo '<script>window.location.href = "' . base_url() . 'change-password"</script>';
                        }
                    } else {
                        $this->session->set_userdata('error', 'Plz enter right current password');
                        $this->load->view('change-pwd');
                    }
                }
            }
        } else {

            $this->load->view('change-pwd', $data);
        }
        $this->load->view('temp/footer');
    }

    public function profile()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null || $this->session->userdata('state_id') != "" || $this->session->userdata('state_id') != null || $this->session->userdata('first_name') != "" || $this->session->userdata('first_name') != null) {

            $state_id = $this->session->userdata('state_id');
            $volunteer_id = $this->session->userdata('volunteer_id');


            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id', 'email', 'mobile', 'volunteer_id', 'date_of_birth'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $data['city'] = $this->Curl_model->fetch_all_data("city_id,city_name", 'cities', 'status=0');
            $data['occup'] = $this->Curl_model->fetch_all_data("occupation_id,occupation_name", 'occupation', 'status=1');
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('user-profile', $data);
            $this->load->view('temp/footer');
        } else {

            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function edit_profile()

    {

        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null || $this->session->userdata('state_id') != "" || $this->session->userdata('state_id') != null || $this->session->userdata('first_name') != "" || $this->session->userdata('first_name') != null) {

            $state_id = $this->session->userdata('state_id');
            $volunteer_id = $this->session->userdata('volunteer_id');


            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id', 'email', 'mobile', 'volunteer_id', 'date_of_birth', 'gender', 'vol_type_id', 'occupation_id', 'city_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('present_address','permanent_address','emergency_contact'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            // echo '<pre>';
            // print_r($data['volunteerDetails']);exit;
            $data['city'] = $this->Curl_model->fetch_all_data("city_id,city_name", 'cities', 'status=0');
            $data['occup'] = $this->Curl_model->fetch_all_data("occupation_id,occupation_name", 'occupation', 'status=1');
            $data['vol_type'] = $this->Curl_model->fetch_all_data("vol_type_id,vol_type_name", 'volunteer_type', 'status=1');
            $data['oppor'] = $this->Curl_model->fetch_all_data("opportunity_id, opportunity_name", 'opportunity', 'opportunity_status=1');
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('user-form', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function update_profile()
    {
        try {
            if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null || $this->session->userdata('state_id') != "" || $this->session->userdata('state_id') != null || $this->session->userdata('first_name') != "" || $this->session->userdata('first_name') != null) {

                $state_id = $this->session->userdata('state_id');
                $volunteer_id = $this->session->userdata('volunteer_id');
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    //'date_of_birth' => $this->input->post('dob'),
                    //'gender' => $this->input->post('gender'),
                    //'email' => $this->input->post('email'),
                    'mobile' => $this->input->post('mobile'),
                    //'city_id' => $this->input->post('city_id'),
                    //'occupation_id' => $this->input->post('occupation_id'),
                   // 'vol_type_id ' => $this->input->post('vol_type_id'),
                    //'present_address ' => $this->input->post('present_address'),
                    //'permanent_address ' => $this->input->post('permanent_address'),
                   // 'emergency_contact ' => $this->input->post('emergency_contact'),
                   // 'where_did_u_know' => implode($this->input->post('opportunity_id')),
                );
                $where = "volunteer_id = $volunteer_id";
               $data['data_update'] = $this->Curl_model->update_data('volunteer', $data, $where);
               $data1 = array(
                    'present_address ' => $this->input->post('present_address'),
                    'permanent_address ' => $this->input->post('permanent_address'),
                    'emergency_contact ' => $this->input->post('emergency_contact'),
                    //'where_did_u_know' => implode($this->input->post('opportunity_id')),
                );
               $data['data_update'] = $this->Curl_model->update_data('volunteer_data', $data1, $where);
              
                //echo '<pre>';
               // print_r($data['data_update']);exit;
                if ($data['data_update'] == 1) {
                    $this->session->set_flashdata('sucess', 'Profile Updated');
                   echo '<script>window.location.href = "' . base_url() . 'profile"</script>';
                }
            } else {
                echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function update_data()

    {

        //print_r($this->input->post('obj'));  exit;

        $btn = $this->input->post('btn');

        $language = $this->input->post('language');

        $expertise = $this->input->post('expertise');

        $serviceArea = $this->input->post('serviceArea');

        $voluntaryService = $this->input->post('voluntaryService');

        $arr = $this->input->post('obj');

        $userID = $this->input->post('userID');

        if ($arr['birthday'] != '') {

            $dateOfBirth = date("Y-m-d", strtotime($arr['birthday']));
        } else {

            $dateOfBirth = 0;
        }



        $where = array(

            'userID' => $userID

        );

        if ($btn == 1) {

            $data =  array(

                'dateOfBirth' => $dateOfBirth,

                'govt_type' => $arr['govt_type'],

                'govt_name' => $arr['govt_name'],

                'gender' => $arr['gender'],

                'staff_member' => $arr['staff_member'],

                'linkedin' => $arr['linkedin'],

                'twitter' => $arr['twitter'],

                'nationalityID' => $arr['nationality'],

                'bloodGroupID' => $arr['bloodGroup'],

                'educationID' => $arr['education'],

                'occupationID' => $arr['occupation']

            );



            if ($language != '' && !empty($language)) {

                $this->Curl_model->delete_data('user_language', ['userID' => $userID]);

                foreach ($language as $key => $value) {

                    $dataCD = array(

                        'userID' => $userID,

                        'languageID' => $value

                    );

                    $resultsID = $this->Curl_model->insert_data('user_language', $dataCD);
                }
            }

            if ($serviceArea != '' && !empty($serviceArea)) {

                $this->Curl_model->delete_data('user_service_area', ['userID' => $userID]);

                foreach ($serviceArea as $key => $value) {

                    $dataCD = array(

                        'userID' => $userID,

                        'serviceAreaID' => $value

                    );

                    $resultsID = $this->Curl_model->insert_data('user_service_area', $dataCD);
                }
            }

            if ($voluntaryService != '' && !empty($voluntaryService)) {

                $this->Curl_model->delete_data('user_voluntary_service', ['userID' => $userID]);

                foreach ($voluntaryService as $key => $value) {

                    $dataCD = array(

                        'userID' => $userID,

                        'voluntaryServiceID' => $value

                    );

                    $resultsID = $this->Curl_model->insert_data('user_voluntary_service', $dataCD);
                }
            }
        } else if ($btn == 2) {

            $data = array(

                'time_duration' => $arr[''],

                'stateID' => $arr['tstate'],

                'cityID' => $arr['tcities'],

                'permanentState' => $arr['pstate'],

                'permanentCity' => $arr['pcities'],

                'correspontenceAddress' => $arr['taddress'],

                'permanentAddress' => $arr['paddress'],

                'time_duration' => $arr['time_duration'],

                'ref1_name' => $arr['ref1_name'],

                'ref1_relation' => $arr['ref1_relation'],

                'ref1_contact' => $arr['ref1_contact'],

                'ref1_email' => $arr['ref1_email'],

                'ref1_address' => $arr['ref1_address'],

                'ref2_name' => $arr['ref2_name'],

                'ref2_relation' => $arr['ref2_relation'],

                'ref2_contact' => $arr['ref2_contact'],

                'ref2_email' => $arr['ref2_email'],

                'ref2_address' => $arr['ref2_address'],

                'heard_us' => $arr['heard_us'],

            );

            if ($expertise != '' && !empty($expertise)) {

                $this->Curl_model->delete_data('user_area_of_experties', ['userID' => $userID]);

                foreach ($expertise as $key => $value) {

                    $dataCD = array(

                        'userID' => $userID,

                        'areaOfExpertiesID' => $value

                    );

                    $resultsID = $this->Curl_model->insert_data('user_area_of_experties', $dataCD);
                }
            }
        }
        $results = $this->Curl_model->update_data('user_data', $data, $where);

        echo $results;

        //print_r($data);

    }



    public function uploadProfile()

    {

        // if (($this->session->userdata('userID') != "")) {

        //     $userID = $this->session->userdata('userID');

        //     $this->load->library('image_lib');

        //     $imageName = time() . $_FILES['profile']['name'];

        //echo $imageName; exit;

        //         $image = str_replace(" ", "_", $imageName);

        //         $config = array();

        //         $config['upload_path'] = './user_profile/';

        //         $config['allowed_types'] = 'jpg|png|jpeg';

        //         $config['file_name'] = $image;

        //         $this->load->library('upload', $config);

        //         if ($this->upload->do_upload("profile")) {

        //             $success = $this->User_model->userimg_file($image, $userID);

        //             if ($success != FALSE) {

        //                 echo 1;

        //             } else {

        //                 echo 2;

        //             }

        //         } else {

        //             print_r($this->upload->display_errors());

        //             exit;

        //         }

        //     } else {

        //         echo '<script>window.location.href = "' . base_url() . 'login"</script>';

        //     }

    }



    public function search_filter_task()
    {
        if (($this->session->userdata('userID') != "")) {
            $data['causes'] = $this->Curl_model->fetch_all_data("causesID,causesName", 'causes', 'status=1');
            $userID = $this->session->userdata('userID');
            if ($this->input->get('cause') != ''  && $this->input->get('datefilter') != '') {
                $cause = $this->input->get('cause');
                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1])));
                $where_task = "FIND_IN_SET('$cause', u.causesID) and ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
                $data['cause'] = $cause;
                $data['datefilter'] = $this->input->get('datefilter');
            } else if ($this->input->get('datefilter') != '') {
                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1])));
                $where_task = "ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
                $data['datefilter'] = $this->input->get('datefilter');
            } else if ($this->input->get('cause') != '') {
                $cause = $this->input->get('cause');
                $where_task = "FIND_IN_SET('$cause', u.causesID)and FIND_IN_SET('$userID', ta.userID)";
                $data['cause'] = $cause;
            } else {
                $where_task = "ta.userID=$userID";
            }
            $data["task"] = $this->User_model->fetch_my_task_final($where_task, $first_date_cal, $second_date_cal);
            $data['totaltask'] = $this->User_model->total_task_count($userID);
            $join_data = array(
                array(
                    'table' => 'users',
                    'fields' => array('firstName', 'lastName'),
                    'joinWith' => array('userID'),
                    'where' => array(
                        'userID' => $userID
                    ),

                ),

                array(
                    'joined' => 0,
                    'table' => 'user_data',
                    'fields' => array('profile'),
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
            $this->load->view('tast-report', $data);
            $this->load->view('temp/footer');
        } else {

            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        }
    }

    public function final_daily_filter()
    {
        if (($this->session->userdata('userID') != "")) {
            $userID = $this->session->userdata('userID');
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('taskID', 'taskTitle'),
                    'joinWith' => array('taskID'),
                ),

                array(
                    'joined' => 0,
                    'table' => 'assigning_task',
                    'fields' => array('taskID'),
                    'joinWith' => array('taskID', 'left'),
                    'where' => array(
                        'userID' => $userID,
                        'status' => '1',
                    ),
                ),
            );

            $limit = '';
            $order_by = '';
            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);


            if ($this->input->get('tasks') != ''  && $this->input->get('datefilter') != '') {
                $tasks = $this->input->get('tasks');
                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1])));
                $where_task = "FIND_IN_SET('$tasks', ta.taskID) and ta.dailyReportDate >= '$first_date' AND ta.dailyReportDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
                $data['tasks'] = $tasks;
                $data['datefilter'] = $this->input->get('datefilter');
            } else if ($this->input->get('datefilter') != '') {
                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1])));
                $where_task = "ta.dailyReportDate >= '$first_date' AND ta.dailyReportDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
                $data['datefilter'] = $this->input->get('datefilter');
            } else if ($this->input->get('tasks') != '') {
                $tasks = $this->input->get('tasks');
                $where_task = "FIND_IN_SET('$tasks', ta.taskID)and FIND_IN_SET('$userID', ta.userID)";
                $data['tasks'] = $tasks;
            } else {

                $where_task = "ta.userID=$userID";
            }

            $data["report"] = $this->User_model->fetch_daily_report($where_task);


            $data['totaltask'] = $this->User_model->total_task_count($userID);

            $join_data = array(

                array(
                    'table' => 'users',
                    'fields' => array('firstName', 'lastName'),
                    'joinWith' => array('userID'),
                    'where' => array(
                        'userID' => $userID

                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'user_data',
                    'fields' => array('profile', 'dioceses_id'),
                    'joinWith' => array('userID', 'dioceses_id', 'left'),

                ),
                array(
                    'joined' => 1,
                    'table' => 'dioceses',
                    'fields' => array('name', 'dioceses_id'),
                    'joinWith' => array('dioceses_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('final-daily-report', $data);

            $this->load->view('temp/footer');
        } else {

            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
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

        $mail->addBCC("pransi.g@neuralinfo.org", "Pransi");

        $mail->FromName = $msg;

        $mail->IsHTML(true);

        $mail->Subject = $subj;

        $mail->Body = $html;

        if (!$mail->Send()) {

            echo "Message could not be sent. <p>";

            echo "Mailer Error: " . $mail->ErrorInfo;
        }

        //return true;

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

                                            <img src="https://www.caritasindia.org/wp-content/uploads/2019/09/Caritas-India-Logo.png"

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

                                                Caritas India Headquarter:

                                                Caritas India, CBCI Centre, Ashok Place, Opposite to Goledakkhana,

                                                New Delhi - 11 00 01, India</div>

                                            <div style="direction:ltr">

                                                Tel - 91 -11 - 2336 3390 / 2374 23 39, <a class="m_-3835115663774870952afal" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">

                                                    Email - noreply@crymail.org</a>

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

                                            <img src="https://www.caritasindia.org/wp-content/uploads/2019/09/Caritas-India-Logo.png"

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

                                                Caritas India Headquarter:

                                                Caritas India, CBCI Centre, Ashok Place, Opposite to Goledakkhana,

                                                New Delhi - 11 00 01, India</div>

                                            <div style="direction:ltr">

                                                Tel - 91 -11 - 2336 3390 / 2374 23 39, <a class="m_-3835115663774870952afal" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">

                                                    Email - noreply@crymail.org</a>

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

    public function consultant_register()

    {

        try {

            $this->load->view('consultant-register');
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }



    public function certificate()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            $volunteer_id = $this->session->userdata('volunteer_id');
            $join_data = array(
                array(
                    'table' => 'daily_report',
                    'fields' => array('dr_id', 'dr_time_in', 'dr_time_out'),
                    'joinWith' => array('dr_id', 'left'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id,
                        'approveddaily_ID !' => 0,
                    ),
                    'group_by' => array('approveddaily_ID'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task',
                    'fields' => array('task_id'),
                    'joinWith' => array('task_id'),
                ),

                array(
                    'joined' => 0,
                    'table' => 'approveddaily_report',
                    'fields' => array('admin_time'),
                    //'function'=>array('SUM','admin_time'),
                    'joinWith' => array('approveddaily_ID', 'left'),
                ),
            );

            $limit = '';
            $order_by = '';
            $data['reporttotal'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $join_data = array(
                array(
                    'table' => 'approveddaily_report',
                    'fields' => array('volunteer_id', 'task_id', 'admin_time', 'creation_date'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                    'order_by' => array('creation_date', 'ASC'),
                    // 'function'=>array('SUM','admin_time'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $res['rewardDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $temp_userid = 0000 - 00 - 00;
            $h = 0;
            $m = 0;
            //$badges =200;
            $badges_less = 0;
            $dta = array();
            $dta1 = array();
            $dta2 = array();
            foreach ($res['rewardDetails'] as $key => $value) {
                $temp_admin_time = explode('.', $value['admin_time']);
                $cmp_date = date('Y-m', strtotime($value['creation_date'])) . '-01';
                if ($cmp_date == $temp_userid) {
                    $h += $temp_admin_time[0];
                    $m += $temp_admin_time[1];
                    $mmm = $m % 60;
                    $h += ($m - $mmm) / 60;
                    $m = $mmm;

                    if ($key == (sizeof($res['rewardDetails']) - 1)) {
                        if ($h >= $badges_less) {
                            $dta1[$cmp_date] = $h . '.' . $m;
                            $dta2[date('M', strtotime($cmp_date))] = $h . '.' . $m;
                        }
                    }
                    $temp_userid = $cmp_date;
                } else {
                    $h += $temp_admin_time[0];
                    $m += $temp_admin_time[1];
                    $mmm = $m % 60;
                    $h += ($m - $mmm) / 60;
                    $m = $mmm;
                    if (isset($badges_less)) {
                        if ($h >= $badges_less) {
                            $dta1[$cmp_date] = $h . '.' . $m;
                            $dta2[date('M', strtotime($cmp_date))] = $h . '.' . $m;
                        }
                    }
                    $temp_userid = $cmp_date;
                }
            }
            $data['reward_user_count'] = $dta1;
            $data['reward_user_count_by_month'] = $dta2;



            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('task_id', 'task_title'),
                    'joinWith' => array('task_id'),
                    'group_by' => array('task_id'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'assigning_task',
                    'fields' => array('task_id'),
                    'joinWith' => array('task_id', 'left'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id,
                        'status' => '1',
                    ),
                ),
            );
            $limit = '';
            $order_by = '';
            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('certificate', $data);
            $this->load->view('temp/footer');
        } else {

            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }


    public function transfer_form()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            $volunteer_id = $this->session->userdata('volunteer_id');
            $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('volunteer_id', 'first_name', 'last_name', 'state_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name','region_id'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            //  echo"<pre>";
            //  print_r( $volunteerDetails);exit;

            $data['state'] = $this->Curl_model->fetch_all_data("state_id,state_name", 'states', 'status=1');
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('transfer-form', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }

    public function insert_volunteer_transfer()
    {

        try {

            if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
                //$volunteer_id = $this->session->userdata('volunteer_id');
				$region_id = $this->input->post('region_id');
                $volunteer_id = $this->input->post('volunteer_id');
                $current_State = $this->input->post('current_State');
                $relocate_state = $this->input->post('relocate_state');
                $relocate_city = $this->input->post('relocate_city');
                $relocate_resion = $this->input->post('relocate_resion');
                $data = array(
                    'volunteer_id' => $volunteer_id,
                    'region_id' => $region_id,
                    'current_state' => $current_State,
                    'relocate_state' => $relocate_state,
                    'relocate_city' => $relocate_city,
                    'relocate_resion' => $relocate_resion,
                    'creation_date' => date('Y-m-d'),
                    'status' => 0,
                    'region_status' => 0,
                );
                // echo "<pre>";
                // print_r($data);
                // exit;
                $this->Crud_modal->data_insert('volunteer_transfer', $data);
                echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
            } else {
                echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
            }
        } catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    function transfer_intern_city()
    {

        $stat = $this->input->post('state_name');
        $citys = $this->Crud_modal->all_data_select('*', 'cities', "state_id='$stat'", 'city_name ASC');
        //print_r($citys);
        echo '<option value="">---Select City---</option>';
        foreach ($citys as $city) {
            $city_id = $city['city_id'];
            $city_nam = $city['city_name'];
            echo '<option value="' . $city_id . '">' . rtrim($city_nam, ' ') . '</option>';
        }
    }
	
	public function self_task_daily_report()
	{
		if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
        $volunteer_id = $this->session->userdata('volunteer_id');
		//$data['totaltask']= $this->User_model->total_task_count($volunteer_id);
		$join_data = array(
			array(
				'table' => 'volunteer',
				'fields' => array('volunteer_id', 'first_name', 'last_name', 'state_id'),
				'joinWith' => array('volunteer_id'),
				'where' => array(
					'volunteer_id' => $volunteer_id
				),
			),
			array(
				'joined' => 0,
				'table' => 'volunteer_data',
				'fields' => array('profile'),
				'joinWith' => array('volunteer_id', 'left'),
			),
			array(
				'joined' => 0,
				'table' => 'states',
				'fields' => array('region_id', 'state_name'),
				'joinWith' => array('state_id', 'left'),
			),
			array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
			array(
				'joined' => 2,
				'table' => 'regions',
				'fields' => array('region_name'),
				'joinWith' => array('region_id', 'left'),
			),
		);
		$where = array();
		$limit = '';
		$order_by = '';
		$data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
		
		if(!empty($this->input->post('submit')) && $this->input->post('submit')=='submit')
        {
            //print_r($this->input->post()); exit;
			$tasktitle=$this->input->post('tasktitle');
			$location=$this->input->post('location');
			$date=$this->input->post('birthday1');
			$dailyIn=$this->input->post('dailyReportTimeIn');
			$dailyIn1=$this->input->post('dailyReportTimeIn1');
			$dailyOut=$this->input->post('dailyReportTimeOut');
			$dailyOut1=$this->input->post('dailyReportTimeOut1');
			$dailyActivity=$this->input->post('dailyActivity');
			$improved_msg=$this->input->post('improved_msg');
			$challeges_face=$this->input->post('challeges_face');
			$experience_any=$this->input->post('experience_any');
			//$taskID=1;
			$data = array(
				'task_title'=>$tasktitle,
				'location'=>$location,
				'volunteer_id'=>$volunteer_id,
				'dailyReportDate'=>date('Y-m-d',strtotime($date)),
				'dailyReportTimeIn'=>$dailyIn.':'.$dailyIn1,
				'dailyReportTimeOut'=>$dailyOut.':'.$dailyOut1,
				'dailyReportActivity'=>$dailyActivity,
				'improved_msg'=>$improved_msg,
				'challeges_face'=>$challeges_face,
				'experience_any'=>$experience_any,
				'status'=>1,
				'dailyReportCreationDate'=>date('y-m-d'),
			);
			
				$config['upload_path']          = 'uploads/dr_attach/';
				$config['allowed_types']        = 'doc|docx|pdf|jpg';
				$new_name = time().$_FILES["attachment"]['name'];
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if ($this->upload->do_upload('attachment')){					
					$file=$this->upload->data();					
				 	$data['attachment']=$file['file_name'];	
				//	$this->Crud_modal->data_insert("self_task_daily_report",$data);	
				}
				
			if($dailyReportID = $this->Curl_model->insert_data('self_task_daily_report',$data)){	
			$user_data = $this->Curl_model->fetch_data('volunteer',array('email'),array('volunteer_id'=>$volunteer_id),'','');
			$taskTitle = $dailyReportID['task_title'];
			$email = $user_data['email'];
			$href=base_url().'volunteer-login';
			$to=$email;
			$from='noreply@crymail.org';
			$msg='CRY VMS';
			$msg2="
			<center><p><strong style='font-weight:bold;'>Thanks for giving daily report. Your daily report details is given below.</strong></p></center>
			<table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
				<tr>
					<th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
					<td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>".ucwords($taskTitle)."</td>
				</tr>
				<tr>
					<th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Time In</th>
					<td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>".$dailyIn.':'.$dailyIn1."</td>
				</tr>
				<tr>
					<th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Time Out</th>
					<td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>".$dailyOut.':'.$dailyOut1."</td>
				</tr>
				<tr>
					<th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Activity</th>
					<td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>".$dailyActivity."</td>
				</tr>
				<tr>
					<th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Date</th>
					<td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>".date('d/m/Y')."</td>
				</tr>
			</table>";
			//die();
			$subj = "Assigned Task reminder from Caritas India";
			$btn = "Check Daily Report Now!";
			$html = $this->request_email($msg,$msg2,$href,$btn);
			$res = $this->mail_send($to,$from,$msg,$msg2,$subj,$href,$btn,$html);
				$this->session->set_flashdata('data_message','Successfully Submitted!');
				echo '<script>window.location.href = "'.base_url().'self-task-daily-report"</script>';
				}
				else {
					$this->session->set_flashdata('data_message','Successfully Submitted!');
				echo '<script>window.location.href = "'.base_url().'dashboard"</script>';
				}
				
				
			//$dailyReportID = $this->Curl_model->insert_data('self_task_daily_report',$data);
		  
			
			
			//$this->session->set_flashdata('data_message','Successfully Submitted!');
			//echo '<script>window.location.href = "'.base_url().'self-task-daily-report"</script>';
			//exit();
	      }
        $this->load->view('self-task-daily-report', $data);
        $this->load->view('temp/footer');
		} else {
                echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
            }
    }
	
	public function self_task_view_daily_report()
	{
		if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
		$volunteer_id = $this->session->userdata('volunteer_id');
        $where1['volunteer_id'] = $volunteer_id;
		$data['totaltask']= $this->User_model->total_task_count($volunteer_id);
		$join_data = array(
            array(
                'table'=>'self_task_daily_report',
                'fields'=>array('vself_task_id','task_title','dailyReportTimeIn','dailyReportTimeOut','dailyReportActivity','dailyReportCreationDate'),
                //'joinWith'=>array('taskID'),
				'where'=>$where1,
				'order_by' =>array('vself_task_id','desc'),
            ),   
        );
        
        $limit = '';
        $order_by =array('vself_task_id', 'DESC');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$data['totaltask']= $this->User_model->total_task_count($volunteer_id);
		$join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('volunteer_id', 'first_name', 'last_name', 'state_id'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('self-task-view-report', $data);
        $this->load->view('temp/footer');
		
		} else {
                echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
            }
    }
	
	
	
	public function transfer_report()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            $volunteer_id = $this->session->userdata('volunteer_id');
             $join_data = array(
                array(
                    'table' => 'volunteer',
                    'fields' => array('first_name', 'last_name', 'state_id', 'mobile'),
                    'joinWith' => array('volunteer_id'),
                    'where' => array(
                        'volunteer_id' => $volunteer_id
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'volunteer_data',
                    'fields' => array('profile'),
                    'joinWith' => array('volunteer_id', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'states',
                    'fields' => array('region_id', 'state_name'),
                    'joinWith' => array('state_id', 'left'),
                ),
				array(
                    'joined' => 0,
                    'table' => 'volunteer_type',
                    'fields' => array('vol_type_name'),
                    'joinWith' => array('vol_type_id', 'left'),
                ),
                array(
                    'joined' => 2,
                    'table' => 'regions',
                    'fields' => array('region_name'),
                    'joinWith' => array('region_id', 'left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by = '';
            $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $data['transfer_data'] = $this->User_model->get_transfer_city($volunteer_id);
            $data['state'] = $this->Curl_model->fetch_all_data("state_id,state_name", 'states', 'status=1');
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('transfer-report', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'volunteer-login"</script>';
        }
    }
	
	public function reset_password()
    {
        if ($this->session->userdata('volunteer_id') != "" || $this->session->userdata('volunteer_id') != null) {
            echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        }
        if ($this->input->post()) {
            $rules_array = array(
                array(
                    'field' => 'resent_email',
                    'label' => 'Email Address',
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => 'Please Enter Email Address.',
                    ),
                ),
            );

            $this->form_validation->set_rules($rules_array);
            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('resent_email');
                $href = base_url() . 'reset/' . rtrim(strtr(base64_encode($email), "+/", "-_"), "=");
                $href2 = base_url() . 'verify/' . md5($results);
                $to = $email;
                $from = 'noreply@crymail.org';
                $msg = 'Cry VMS';
                $msg2 = "Please click on 'Reset Password' button for reset your password.";
                $subj = "Reset Password link from Caritas India";
                $btn = "Reset Password";

                $html = $this->request_email($msg, $msg2, $href, $btn);
                $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
                $html = Modules::run('Mails/request_email', $msg, $msg2, $href, $btn);
                $res = Modules::run('Mails/mail_send', $to, $from, $msg, $msg2, $subj, $href, $btn, $html);
                die();
                $res = $this->session->set_userdata('resent_password_success', 'Reset password link has been sent on your email address please check.');
                echo '<script>window.location.href = "' . base_url() . 'volunteer-reset-password"</script>';
                redirect('reset-password');
            } else {
                $this->load->view('reset-password');
            }
        } else {
        }
        $this->load->view('reset-password');
    }
	public function resetPassword()
    {
        $link2 = $this->uri->segment(2);
        $res['link2'] = $link2;
        if ($link2 != '') {
            $email = base64_decode(str_pad(strtr($link2, '-_', '+/'), strlen($link2) % 4, '=', STR_PAD_RIGHT));
            $where = array(
                'email' => $email,
            );
            $fields = array(
                'mailConfrmationStatus'
            );
            $results = $this->Curl_model->fetch_data('volunteer', $fields, $where, "", "");
            print_r($results);
            if ($results['mailConfrmationStatus'] == 1) {
                if ($this->input->post()) {
                    $rules_array = array(
                        array(
                            'field' => 'npass',
                            'label' => 'New Password',
                            'rules' => 'trim|required|min_length[8]',
                            'errors' => array(
                                'required' => 'Please Enter New Password',
                                'min_length' => 'Please Enter New Password at least 8 digits',
                            ),
                        ),
                        array(
                            'field' => 'cnpass',
                            'label' => 'Confirm New Password',
                            'rules' => 'trim|required|matches[npass]',
                            'errors' => array(
                                'required' => 'Please Enter Confirm New Password',
                                'matches' => 'Confirm New Password Not Match',
                            ),
                        ),
                    );

                    $this->form_validation->set_rules($rules_array);
                    if ($this->form_validation->run() == TRUE) {
                        $npass = $CI->get_library->encode($this->input->post('npass'));
                        $where = array(
                            'email' => $email,
                        );
                        $fields = array(
                            'password' => $npass
                        );
                        $results = $this->Curl_model->update_data('volunteer', $fields, $where);
                        if ($results) {
                            $res['results'] = "Password has been reseted.";
                            $res['href'] = base_url('volunteer-login');
                            $res['btn'] = "Login Now";
                            $res['heading'] = "Successfull";
                            $this->load->view('error', $res);
                        }
                    } else {
                        $this->load->view('reset', $res);
                    }
                } else {
                    $this->load->view('reset', $res);
                }
            } else {
                $res['results'] = "This Link has been expired";
                $res['href'] = base_url();
                $res['btn'] = "Go Home";
                $res['heading'] = "Error!";
                $this->load->view('error', $res);
            }
        } else {
            $res['results'] = "Invalid Link";
            $res['href'] = base_url();
            $res['btn'] = "Go Home";
            $res['heading'] = "Error!";
            $this->load->view('error', $res);
        }
        $this->load->view('reset');
    }
	
	
	
}
