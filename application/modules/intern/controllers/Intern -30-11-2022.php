<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intern extends MY_Controller
{

    function __construct()
    {
        error_reporting(0);
        parent::__construct();
        $CI = &get_instance();
        $CI->load->library('Get_library');
        $this->load->model('curl/Curl_model');
        $this->load->model('crud/Crud_modal');
        $this->load->model('Intern_model');
        $this->load->library('Phpmailer');
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');
    }
	public function intern_login()
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
                        'intern_id',
                        'status',
                    );
                    $where = array(
                        'email' => $email,
                    );
                    $limit = '';
                    $order_by = '';
                    $results = $this->Curl_model->fetch_data('interns', $fields, $where, $limit, $order_by);
                    if (!empty($results) && $results != '') {
                        $r_password = $results['password'];

                        if ($r_password == md5($password)) {
                                if ($results['status'] == 1) {
                                    $this->session->set_userdata('intern_id', $results['intern_id']);
                                    $this->session->set_userdata('first_name', $results['first_name']);
									//echo "hello"; exit();
                                    echo '<script>window.location.href = "'.base_url().'intern-dashbord"</script>';
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
		 $this->load->view('intern-login', $res);
	}
	public function intern_logout()
    {
        $this->session->unset_userdata('intern_id');
        echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
    }

    public function dashboard()
    {
	 if($this->session->userdata('intern_id')!="" || $this->session->userdata('intern_id')!=null || $this->session->userdata('state_id')!="" || $this->session->userdata('state_id')!=null || $this->session->userdata('first_name')!="" || $this->session->userdata('first_name')!=null){
		 
		 $state_id = $this->session->userdata('state_id');
         $intern_id = $this->session->userdata('intern_id');
         $data['totaltask']=$this->Intern_model->total_task_count($intern_id);
        //  echo "<pre>";
        //  print_r($data['totaltask']);exit;
         $join_data = array(
             array(
                 'table' => 'interntask',
                 'fields' => array('intern_task_id', 'task_title', 'creation_date'),
                 'joinWith' => array('intern_task_id'),
				 'group_by' => array('intern_task_id'),
             ),
             array(
                 'joined' => 0,
                 'table' => 'intern_assigning_task',
                 'fields' => array('intern_task_id', 'status'),
                 'joinWith' => array('intern_task_id', 'left'),
                 'where' => array('intern_id' => $intern_id,),
                 'order_by' => array('intern_task_id', 'desc'),
             ),
         );
         $limit = 5;
         $order_by = '';
         $data['interntask'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
    //    echo "<pre>";
    //      print_r($data['interntask'] );exit;
         $join_data = array(
             array(
                 'table' => 'interntask',
                 'fields' => array('intern_task_id', 'task_title'),
                 'joinWith' => array('intern_task_id'),
				 'group_by' => array('intern_task_id'),
             ),
             array(
                 'joined' => 0,
                 'table' => 'intern_daily_report',
                 'fields' => array('intern_dr_id', 'dr_time_in', 'dr_time_out', 'dr_activity', 'dr_create_date'),
                 'joinWith' => array('intern_task_id', 'left'),
                 'where' => array('intern_id' => $intern_id, 'status' => 0, 'status' => 1,),
                 'order_by' => array(
                     'intern_dr_id', 'DESC'
                 ),
             ),
         );

         $limit = '5';
         $order_by = array('intern_dr_id', 'DESC');
         $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
         	// echo '<pre>'.$data['report']. '</pre>'; exit();
        //          echo "<pre>";
        //  print_r($data['report'] );exit;
		 
           $join_data = array(
			 array(
				 'table' => 'intern_assigning_task',
				 'fields' => array('intern_task_id'),
				 'where' => array(
					 'intern_id' => $intern_id,
					  'status' => 0,
				 ),
			 ),
            );
             $limit = '';
             $order_by = '';
             $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
             foreach ($task as $key => $value) {
                 $taskIDs[$key] = $value['intern_task_id'];
             }

             $join_data = array(
                 array(
                     'table' => 'interntask',
                     'fields' => array('intern_task_id', 'task_title', 'task_description', 'creation_date', 'status','region_id','task_state_id','task_type_id','task_brief'),
                     'joinWith' => array('intern_task_id','task_type_id', 'region_id'),
                     'where' => array(
						 //'task_state_id' => $state_id,
                         'status' => 1,
                         'task_status' => 0,
						 'task_for' => 2,
						 'task_type_id' => 1,
						 
                     ),
                     'order_by' => array(
                         'intern_task_id', 'DESC'
                     ),
                   'where_not_in' => array('intern_task_id' => $taskIDs)
                ),
					array(
						'joined'=>0,
						'table'=>'regions',
						'fields'=>array('region_name'),
						'joinWith'=>array('region_id','left'),
					),
					array(
						'joined'=>0,
						'table'=>'task_type',
						'fields'=>array('task_type'),
						'joinWith'=>array('task_type_id','left'),
					),
				);

             $limit = '';

             $order_by = '';

            $data['find_task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            // echo '<pre>';
            // print_r ($data['find_task']);exit;
			
			$join_data = array(
			 array(
				 'table' => 'intern_assigning_task',
				 'fields' => array('intern_task_id'),
				 'where' => array(
					 'intern_id' => $intern_id,
				 ),
			 ),
            );
             $limit = '';
             $order_by = '';
             $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
             foreach ($intern_task_id as $key => $value) {
                 $taskIDs[$key] = $value['intern_task_id'];
             }

             $join_data = array(
                 array(
                     'table' => 'interntask',
                     'fields' => array('intern_task_id', 'task_title', 'task_description', 'creation_date', 'status','region_id','task_state_id','task_type_id','task_brief'),
                     'joinWith' => array('intern_task_id','task_type_id', 'region_id'),
                     'where' => array(
						 'task_state_id' => $state_id,
                         'status' => 1,
                         'task_status' => 0,
						 'task_for' => 2,
						 'task_type_id' =>2,
						 
                     ),
                     'order_by' => array(
                         'intern_task_id', 'DESC'
                     ),
                   'where_not_in' => array('intern_task_id' => $taskIDs)
                ),
					array(
						'joined'=>0,
						'table'=>'regions',
						'fields'=>array('region_name'),
						'joinWith'=>array('region_id','left'),
					),
					array(
						'joined'=>0,
						'table'=>'task_type',
						'fields'=>array('task_type'),
						'joinWith'=>array('task_type_id','left'),
					),
				);

             $limit = '';

             $order_by = '';

            $data['find_task_offline'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
		//   echo "<pre>";
        //   print_r($data['find_task_offline']);exit;
		 $join_data = array(
            array(
                'table'=>'interns',
                'fields'=>array('first_name','last_name', 'state_id', 'mobile'),
                'joinWith'=>array('intern_id'),
                'where'=>array(
                    'intern_id'=>$intern_id
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'interns_data',
                'fields'=>array('occupation'),
                'joinWith'=>array('intern_id','left'),
            ),
			array(
                'joined'=>0,
                'table'=>'states',
                'fields'=>array('region_id','state_name'),
                'joinWith'=>array('state_id','left'),
            ),
			array(
                'joined'=>2,
                'table'=>'regions',
                'fields'=>array('region_name'),
                'joinWith'=>array('region_id','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['internDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		// echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('index', $data);
        $this->load->view('temp/footer');
		}else{					
			echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
		 }	
    }

    public function dashboard123()
    {
        $CI = &get_instance();
        $userID = $this->session->userdata('userID');
        $data['totaltask'] = $this->User_model->total_task_count($userID);
        //$data['timetask']= $this->User_model->timein_calculate($userID);
        //$data['timeouttask']= $this->User_model->timeout_calculate($userID);
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

        $data['countfield'] = $this->User_model->column_count($userID);
        $data['totalfield'] = $this->User_model->total_field_count($userID);
        $join_data = array(
            array(
                'table' => 'task',
                'fields' => array('taskID', 'taskTitle', 'taskPublishedDate'),
                'joinWith' => array('taskID'),
            ),
            array(
                'joined' => 0,
                'table' => 'assigning_task',
                'fields' => array('taskID', 'status'),
                'joinWith' => array('taskID', 'left'),
                'where' => array('userID' => $userID,),
                'order_by' => array('taskID', 'desc'),
            ),
        );

        $limit = 5;
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
                'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportDate', 'dailyReportActivity'),
                'joinWith' => array('taskID', 'left'),
                'where' => array('userID' => $userID),
                'order_by' => array(
                    'dailyReportID', 'DESC'
                ),
            ),
        );

        $limit = '5';
        $order_by = array('dailyReportID', 'DESC');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        $join_data = array(
            array(
                'table' => 'task',
                'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate'),
                'joinWith' => array('taskID'),
            ),
            array(
                'joined' => 0,
                'table' => 'assigning_task',
                'fields' => array('userID'),
                'joinWith' => array('taskID', 'left'),
                'where' => array(
                    'userID' => !$userID,
                ),
            ),
        );

        $limit = 5;
        $order_by = array('taskID', 'DESC');
        $data['find_task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

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
        $this->load->view('index', $data);
        $this->load->view('temp/footer');
    }
    public function account_deactive()
    {
        $userID = $this->session->userdata('userID');
        if ($this->input->post()) {
            if ($this->input->post('deactive') == 'submit') {
                $de_reason = $this->input->post('showthis');
                $data = array(
                    'userID' => $userID,
                    'status' => 1,
                    'de_reason' => $de_reason,
                );
                $deactive_userID = $this->Curl_model->insert_data('deactivate_user', $data);

                $where = array(
                    'userID' => $userID,
                );

                $fields = array(
                    'status' => 0,
                    'deactiveID' => $deactive_userID
                );

                $results = $this->Curl_model->update_data('users', $fields, $where);

                if ($results) {
                    $reason_data = $this->Curl_model->fetch_data('mm_resion', array('resionName'), array('resionID' => $de_reason), '', '');
                    $user_data = $this->Curl_model->fetch_data('users', array('email', 'firstName', 'lastName'), array('userID' => $userID), '', '');
                    // print_r($task_data);
                    // die();
                    $email = $user_data['email'];
                    $href = base_url() . 'login';
                    //$href2 = base_url().'verify/'.md5($results);
                    $to = $email;
                    $from = 'volunteer@caritasindia.org';
                    $msg = 'Caritas India Volunteer';
                    $msg2 = "
                    <center><p><strong style='font-weight:bold;'>Hai, " . ucfirst($user_data['firstName']) . " " . ucfirst($user_data['lastName']) . " Your account has been deactivated.</strong></p></center>
                    <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                        <tr>
                            <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Reason</th>
                            <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $reason_data['resionName'] . "</td>
                        </tr>
                        <tr>
                            <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Date</th>
                            <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . date('d/m/Y') . "</td>
                        </tr>
                    </table>";
                    //die();
                    $subj = "Assigned Task Rejected from Caritas India";
                    $btn = "If you want to activate account, LogIn Now!";
                    $html = $this->request_email_without_btn($msg, $msg2, $href, $btn);
                    $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
                    $this->session->sess_destroy();
                    //$this->session->set_userdata('user_deactive','true');
                    echo '<script>window.location.href = "' . base_url() . 'login"</script>';
                }
            }
        }
    }
    public function dashboard_send_request()
    {
        $userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $data = array(
            'taskID' => $taskID,
            'userID' => $userID,
            'status' => 0,
            'sendRequiestCreatingDate' => date('y-m-d h:i:s'),
        );
        $results = $this->Curl_model->insert_data('send_requiest', $data);
        if ($results) {
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('taskDescription', 'taskID', 'taskTitle', 'causesID', 'taskBrief', 'taskPublishedDate', 'status', 'taskStatus'),
                    'where' => array('taskID' => $taskID),
                    'order_by' => array('taskID', 'DESC'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'causes',
                    'fields' => array('causesName'),
                    'joinWith' => array('causesID', 'left'),
                ),
            );
            $join_data1 = array(
                array(
                    'table' => 'task_location',
                    'fields' => array('cityID'),
                    'where' => array('taskID' => $taskID),
                    'joinWith' => array('taskID', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'cities',
                    'fields' => array('cityName'),
                    'joinWith' => array('cityID', 'left'),
                ),
            );
            $limit = '';
            $order_by = '';
            $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
            $admin_data = $this->Curl_model->fetch_data('users', array('email', 'firstName', 'lastName'), array('roleID' => 1), 1, array('userID', 'ASC'));
            $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $to_admin = $admin_data['email'];
            $from = 'volunteer@caritasindia.org';
            $msg = 'Caritas India Volunteer';
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
                    // $tlocation.= "<br>";
                }
                $count++;
            }
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Thanks for sending request for task. Task details is given below</strong></p></center>
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
            $admin_msg = "<center><p><strong style='font-weight:bold;'>Some one is sending request for task. Details is given below</strong></p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Name</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . ucwords($user_data['firstName'] . ' ' . $user_data['lastName']) . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Email</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $user_data['email'] . "</td>
                </tr>
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
            $subj = "Send Request for Task from Caritas India";
            $btn = "LogIn Now!";
            $user_html = $this->request_email($msg, $msg2, $href, $btn);
            $admin_html = $this->request_email($msg, $admin_msg, $href, $btn);
            $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $user_html);
            $res = $this->mail_send($to_admin, $from, $msg, $admin_msg, $subj, $href, $btn, $admin_html);
            $this->session->set_userdata('request_send', 'true');
            echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        }
    }
    public function dashboard_task_accept()
    {
        $userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'taskID' => $taskID,
            'userID' => $userID,
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
                    'fields' => array('taskDescription', 'taskID', 'taskTitle', 'causesID', 'taskBrief', 'taskPublishedDate', 'status', 'taskStatus'),
                    'where' => array('taskID' => $taskID),
                    'order_by' => array('taskID', 'DESC'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'causes',
                    'fields' => array('causesName'),
                    'joinWith' => array('causesID', 'left'),
                ),
            );
            $join_data1 = array(
                array(
                    'table' => 'task_location',
                    'fields' => array('cityID'),
                    'where' => array('taskID' => $taskID),
                    'joinWith' => array('taskID', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'cities',
                    'fields' => array('cityName'),
                    'joinWith' => array('cityID', 'left'),
                ),
            );
            $limit = '';
            $order_by = '';
            $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
            $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'volunteer@caritasindia.org';
            $msg = 'Caritas India Volunteer';

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
            <center><p><strong style='font-weight:bold;'>Thanks for accepting the task. Task details is given below</strong></p></center>
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
            $btn = "Check Your Assigned Task Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
            $this->session->set_userdata('task_accept', 'true');
            echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        }
    }
    public function dashboard_task_reject123()
    {
        $userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'taskID' => $taskID,
            'userID' => $userID,
        );
        $fields = array(
            'status' => 2,
            'rejected_date' => date('y-m-d'),
            'rejected_reason' => 'test',
        );
        $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
        if ($results) {
            $this->session->set_userdata('task_reject', 'true');
            echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        }
    }
    public function dashboard_task_reject()
    {
        $userID = $this->session->userdata('userID');
        if ($this->input->post()) {
            if ($this->input->post('submit') == 'submit') {
                $taskID = $this->input->post('taskid');
                $rejected_reason = $this->input->post('reject_reason');
                $other_reason = $this->input->post('other_reason');
                $where = array(
                    'taskID' => $taskID,
                    'userID' => $userID,
                );
                $fields = array(
                    'status' => 2,
                    'rejected_date' => date('Y-m-d'),
                    'resionID' => $rejected_reason,
                    'other_reason' => $other_reason,
                );
                $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
                if ($results) {
                    $join_data = array(
                        array(
                            'table' => 'task',
                            'fields' => array('taskDescription', 'taskID', 'taskTitle', 'causesID', 'taskBrief', 'taskPublishedDate', 'status', 'taskStatus'),
                            'where' => array('taskID' => $taskID),
                            'order_by' => array('taskID', 'DESC'),
                        ),
                        array(
                            'joined' => 0,
                            'table' => 'causes',
                            'fields' => array('causesName'),
                            'joinWith' => array('causesID', 'left'),
                        ),
                    );
                    $join_data1 = array(
                        array(
                            'table' => 'task_location',
                            'fields' => array('cityID'),
                            'where' => array('taskID' => $taskID),
                            'joinWith' => array('taskID', 'left'),
                        ),
                        array(
                            'joined' => 0,
                            'table' => 'cities',
                            'fields' => array('cityName'),
                            'joinWith' => array('cityID', 'left'),
                        ),
                    );
                    $limit = '';
                    $order_by = '';
                    $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                    $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
                    $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
                    // print_r($task_data);
                    // die();
                    $email = $user_data['email'];
                    $href = base_url() . 'login';
                    //$href2 = base_url().'verify/'.md5($results);
                    $to = $email;
                    $from = 'volunteer@caritasindia.org';
                    $msg = 'Caritas India Volunteer';

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
                    <center><p><strong style='font-weight:bold;'>You have cancel assigned task. Task details is given below</strong></p></center>
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
                    $subj = "Assigned Task Rejected from Caritas India";
                    $btn = "Check Your Assigned Task Now!";

                    $html = $this->request_email_without_btn($msg, $msg2);
                    $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
                    $this->session->set_userdata('task_reject', 'true');
                    echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
                }
            }
        }
    }
    public function dashboard_task_reject321()
    {
        $userID = $this->session->userdata('userID');
        if ($this->input->post()) {
            if ($this->input->post('submit') == 'submit') {
                $taskID = $this->input->post('taskid');
                $rejected_reason = $this->input->post('reject_reason');
                $other_reason = $this->input->post('other_reason');
                $where = array(
                    'taskID' => $taskID,
                    'userID' => $userID,
                );
                $fields = array(
                    'status' => 2,
                    'rejected_date' => date('Y-m-d'),
                    'rejected_reason' => $rejected_reason,
                    'other_reason' => $other_reason,
                );
                $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
                if ($results) {
                    $this->session->set_userdata('task_reject', 'true');
                    echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
                }
            }
        }
    }
    public function task123()
    {
        if (($this->session->userdata('userID') != "")) {
            $data['causes'] = $this->Curl_model->fetch_all_data("causesID,causesName", 'causes', 'status=1');

            $userID = $this->session->userdata('userID');

            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('taskID', 'taskTitle', 'taskBrief', 'taskPublishedDate', 'taskStatus', 'taskDescription', 'volunteers'),
                    'joinWith' => array('taskID'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'assigning_task',
                    'fields' => array('taskID', 'status'),
                    'joinWith' => array('taskID', 'left'),
                    'where' => array('userID' => $userID),
                    'order_by' => array('assigningTaskID', 'desc'),
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
            $this->load->view('task-list', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
            //redirect(base_url().'login','refresh');
        }
    }

    // public function task()
    // {
    //     // if (($this->session->userdata('userID') != "")) {
    //     //     $data['causes'] = $this->Curl_model->fetch_all_data("causesID,causesName", 'causes', 'status=1');

    //     //     $userID = $this->session->userdata('userID');

    //     //     $join_data = array(
    //     //         array(
    //     //             'table' => 'task',
    //     //             'fields' => array('taskID', 'taskTitle', 'taskBrief', 'taskPublishedDate', 'taskStatus', 'taskDescription', 'volunteers'),
    //     //             'joinWith' => array('taskID'),
    //     //         ),
    //     //         array(
    //     //             'joined' => 0,
    //     //             'table' => 'assigning_task',
    //     //             'fields' => array('taskID', 'status'),
    //     //             'joinWith' => array('taskID', 'left'),
    //     //             'where' => array('userID' => $userID),
    //     //             'order_by' => array('assigningTaskID', 'desc'),
    //     //         ),
    //     //     );

    //     //     $limit = '';
    //     //     $order_by = '';
    //     //     $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
    //     //     $data['totaltask'] = $this->User_model->total_task_count($userID);
    //     //     $join_data = array(
    //     //         array(
    //     //             'table' => 'users',
    //     //             'fields' => array('firstName', 'lastName'),
    //     //             'joinWith' => array('userID'),
    //     //             'where' => array(
    //     //                 'userID' => $userID
    //     //             ),
    //     //         ),
    //     //         array(
    //     //             'joined' => 0,
    //     //             'table' => 'user_data',
    //     //             'fields' => array('profile', 'dioceses_id'),
    //     //             'joinWith' => array('userID', 'dioceses_id', 'left'),
    //     //         ),
    //     //         array(
    //     //             'joined' => 1,
    //     //             'table' => 'dioceses',
    //     //             'fields' => array('name', 'dioceses_id'),
    //     //             'joinWith' => array('dioceses_id', 'left'),
    //     //         ),
    //     //     );
    //     //     $where = array();
    //     //     $limit = '';
    //     //     $order_by = '';
    //     //     $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     //     $fields123 = array(
    //     //         'resionID',
    //     //         'resionName',
    //     //     );
    //     //     $where123 = array('status' => 1);
    //     //     $limit123 = '';
    //     //     $order_by123 = array('resionID', 'DESC');
    //     //     $data['mm_resion'] = $this->Curl_model->fetch_data_in_many_array('mm_resion', $fields123, $where123, $limit123, $order_by123);


    //     $this->load->view('temp/head');
    //     $this->load->view('temp/header');
    //     $this->load->view('temp/sidebar');
    //     $this->load->view('task-list');
    //     $this->load->view('temp/footer');
    //     // } else {
    //     //     echo '<script>window.location.href = "' . base_url() . 'login"</script>';
    //     //     //redirect(base_url().'login','refresh');
    //     // }
    // }


    public function task()
    {
	if($this->session->userdata('intern_id')!="" || $this->session->userdata('intern_id')!=null){
		 $intern_id = $this->session->userdata('intern_id');
		 $data['states']=$this->Curl_model->fetch_all_data("state_id,state_name",'states','status=1');
		 $join_data = array(
			 array(
				 'table' => 'interntask',
				 'fields' => array('intern_task_id', 'task_title', 'task_brief', 'creation_date', 'task_status', 'task_description'),
				 'joinWith' => array('intern_task_id'),
				 'group_by' => array('intern_task_id'),
			 ),
			 array(
				 'joined' => 0,
				 'table' => 'intern_assigning_task',
				 'fields' => array('intern_task_id', 'status'),
				 'joinWith' => array('intern_task_id', 'left'),
				 'where' => array('intern_id' => $intern_id),
				 'order_by' => array('intern_assigned_task_id', 'desc'),
			 ),
		 );
		 $limit = '';
		 $order_by = '';
		 $data['interntask'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
         	// echo '<pre>'. $data['interntask']. '</pre>'; exit();

		 
		 $join_data = array(
            array(
                'table'=>'interns',
                'fields'=>array('first_name','last_name', 'state_id'),
                'joinWith'=>array('intern_id'),
                'where'=>array(
                    'intern_id'=>$intern_id
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'interns_data',
                'fields'=>array('occupation'),
                'joinWith'=>array('intern_id','left'),
            ),
			array(
                'joined'=>0,
                'table'=>'states',
                'fields'=>array('region_id','state_name'),
                'joinWith'=>array('state_id','left'),
            ),
			array(
                'joined'=>2,
                'table'=>'regions',
                'fields'=>array('region_name'),
                'joinWith'=>array('region_id','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['internDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		// echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('task-list', $data);
        $this->load->view('temp/footer');
        }else{					
			echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
		 }
    }
    public function task_accept()
    {
        $userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'taskID' => $taskID,
            'userID' => $userID,
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
                    'fields' => array('taskDescription', 'taskID', 'taskTitle', 'causesID', 'taskBrief', 'taskPublishedDate', 'status', 'taskStatus'),
                    'where' => array('taskID' => $taskID),
                    'order_by' => array('taskID', 'DESC'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'causes',
                    'fields' => array('causesName'),
                    'joinWith' => array('causesID', 'left'),
                ),
            );
            $join_data1 = array(
                array(
                    'table' => 'task_location',
                    'fields' => array('cityID'),
                    'where' => array('taskID' => $taskID),
                    'joinWith' => array('taskID', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'cities',
                    'fields' => array('cityName'),
                    'joinWith' => array('cityID', 'left'),
                ),
            );
            $limit = '';
            $order_by = '';
            $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
            $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'volunteer@caritasindia.org';
            $msg = 'Caritas India Volunteer';

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
            <center><p><strong style='font-weight:bold;'>Thanks for accepting the task. Task details is given below</strong></p></center>
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
            $btn = "Check Your Assigned Task Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
            $this->session->set_userdata('task_accept', 'true');
            echo '<script>window.location.href = "' . base_url() . 'task"</script>';
            //redirect('task');
        }
    }
    public function task_reject()
    {
        $userID = $this->session->userdata('userID');
        if ($this->input->post()) {
            if ($this->input->post('submit') == 'submit') {
                $taskID = $this->input->post('taskid');
                $rejected_reason = $this->input->post('reject_reason');
                $other_reason = $this->input->post('other_reason');
                $where = array(
                    'taskID' => $taskID,
                    'userID' => $userID,
                );
                $fields = array(
                    'status' => 2,
                    'rejected_date' => date('Y-m-d'),
                    'resionID' => $rejected_reason,
                    'other_reason' => $other_reason,
                );
                $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
                if ($results) {
                    $join_data = array(
                        array(
                            'table' => 'task',
                            'fields' => array('taskDescription', 'taskID', 'taskTitle', 'causesID', 'taskBrief', 'taskPublishedDate', 'status', 'taskStatus'),
                            'where' => array('taskID' => $taskID),
                            'order_by' => array('taskID', 'DESC'),
                        ),
                        array(
                            'joined' => 0,
                            'table' => 'causes',
                            'fields' => array('causesName'),
                            'joinWith' => array('causesID', 'left'),
                        ),
                    );
                    $join_data1 = array(
                        array(
                            'table' => 'task_location',
                            'fields' => array('cityID'),
                            'where' => array('taskID' => $taskID),
                            'joinWith' => array('taskID', 'left'),
                        ),
                        array(
                            'joined' => 0,
                            'table' => 'cities',
                            'fields' => array('cityName'),
                            'joinWith' => array('cityID', 'left'),
                        ),
                    );
                    $limit = '';
                    $order_by = '';
                    $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                    $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
                    $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
                    // print_r($task_data);
                    // die();
                    $email = $user_data['email'];
                    $href = base_url() . 'login';
                    //$href2 = base_url().'verify/'.md5($results);
                    $to = $email;
                    $from = 'volunteer@caritasindia.org';
                    $msg = 'Caritas India Volunteer';
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
                    <center><p><strong style='font-weight:bold;'>You have cancel assigned task. Task details is given below</strong></p></center>
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
                    $subj = "Assigned Task Rejected from Caritas India";
                    $btn = "Check Your Assigned Task Now!";
                    $html = $this->request_email_without_btn($msg, $msg2);
                    $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
                    $this->session->set_userdata('task_reject', 'true');
                    echo '<script>window.location.href = "' . base_url() . 'task"</script>';
                }
            }
        }
    }
    public function task_reject321()
    {
        $userID = $this->session->userdata('userID');
        if ($this->input->post()) {
            if ($this->input->post('submit') == 'submit') {
                $taskID = $this->input->post('taskid');
                $rejected_reason = $this->input->post('reject_reason');
                $other_reason = $this->input->post('other_reason');
                $where = array(
                    'taskID' => $taskID,
                    'userID' => $userID,
                );
                $fields = array(
                    'status' => 2,
                    'rejected_date' => date('Y-m-d'),
                    'rejected_reason' => $rejected_reason,
                    'other_reason' => $other_reason,
                );
                $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
                if ($results) {
                    $this->session->set_userdata('task_reject', 'true');
                    echo '<script>window.location.href = "' . base_url() . 'task"</script>';
                }
            }
        }
    }
    public function task_reject123()
    {
        $userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'taskID' => $taskID,
            'userID' => $userID,
        );
        $fields = array(
            'status' => 2,
            'rejected_date' => date('y-m-d'),
            'rejected_reason' => 'test',
        );
        $results = $this->Curl_model->update_data('assigning_task', $fields, $where);
        if ($results) {
            $this->session->set_userdata('task_reject', 'true');
            echo '<script>window.location.href = "' . base_url() . 'task"</script>';
            //redirect('task');
        }
    }

    public function filter_my_task()
    {
        if (($this->session->userdata('userID') != "")) {
            $data['cause'] = '';
            $data['datefilter'] = '';
            $data['status'] = '';
            $userID = $this->session->userdata('userID');
            $data['totaltask'] = $this->User_model->total_task_count($userID);
            if ($this->input->get('cause') != ''  && $this->input->get('datefilter') != '' && $this->input->get('status') != '') {
                $cause = $this->input->get('cause');
                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1])));
                $status = $this->input->get('status');
                $where_task = "FIND_IN_SET('$cause', u.causesID) and ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$userID', ta.userID)";
                $data['cause'] = $cause;
                $data['datefilter'] = $this->input->get('datefilter');
                $data['status'] = $status;
            } else if ($this->input->get('cause') != ''  && $this->input->get('datefilter') != '') {
                $cause = $this->input->get('cause');
                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1])));
                $where_task = "FIND_IN_SET('$cause', u.causesID) and ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
                $data['cause'] = $cause;
                $data['datefilter'] = $this->input->get('datefilter');
            } else if ($this->input->get('datefilter') != '' && $this->input->get('status') != '') {
                $datefilter = $this->input->get('datefilter');
                $status = $this->input->get('status');
                $where_task = "FIND_IN_SET('$datefilter', ta.assignedDate)and FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$userID', ta.userID)";
                $data['datefilter'] = $this->input->get('datefilter');
                $data['status'] = $status;
            } else if ($this->input->get('cause') != '' && $this->input->get('status') != '') {
                $cause = $this->input->get('cause');
                $status = $this->input->get('status');
                $where_task = "FIND_IN_SET('$cause', u.causesID)and FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$userID', ta.userID)";
                $data['cause'] = $cause;
                $data['status'] = $status;
            } else if ($this->input->get('cause') != '') {
                $cause = $this->input->get('cause');
                $where_task = "FIND_IN_SET('$cause', u.causesID)and FIND_IN_SET('$userID', ta.userID)";
                $data['cause'] = $cause;
            } else if ($this->input->get('status') != '') {
                $status = $this->input->get('status');
                $where_task = "FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$userID', ta.userID)";
                $data['status'] = $status;
            } else if ($this->input->get('datefilter') != '') {
                $datefilter = $this->input->get('datefilter');
                $datefilter = explode("-", $datefilter);
                $first_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[0])));
                $second_date = date('Y-m-d', strtotime(str_replace('/', '-', $datefilter[1]))); //exit;
                $where_task = "ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
                $data['datefilter'] = $this->input->get('datefilter');
            } else {
                $userID = $this->session->userdata('userID');
                $where_task = "ta.userID=$userID";
            }
            $data["task"] = $this->User_model->fetch_my_task($where_task);
            $data['causes'] = $this->Curl_model->fetch_all_data("causesID,causesName", 'causes', 'status=1');

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
            $this->load->view('task-list', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        }
    }


    // public function view_task_details()
    // {
    //     if (($this->session->userdata('userID') != "")) {
    //         $userID = $this->session->userdata('userID');
    //         $v = $this->uri->segment(2);
    //         $data['encode_taskID'] = $v;
    //         $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
    //         $where = "taskID = '$val'";
    //         $data['task'] = $this->Curl_model->fetch_single_data('*', 'task', $where);
    //         $join_data = array(
    //             array(
    //                 'table' => 'attachment',
    //                 'fields' => array('attachmentName', 'attachmentSize', 'attachmentDate', 'userID', 'attachmentTypeID'),
    //                 'joinWith' => array('attachmentTypeID'),
    //                 'where' => array(
    //                     'status' => 1,
    //                     'taskID' => $val,
    //                     'dailyReportID' => 0,
    //                 ),
    //             ),
    //             array(
    //                 'joined' => 0,
    //                 'table' => 'attachment_type',
    //                 'fields' => array('attachmentTypeName', 'attachmentFileType'),
    //                 'joinWith' => array('attachmentTypeID', 'left'),
    //             ),
    //             array(
    //                 'joined' => 0,
    //                 'table' => 'users',
    //                 'fields' => array('firstName', 'lastName'),
    //                 'joinWith' => array('userID', 'left'),
    //             ),
    //         );

    //         $limit = '';
    //         $order_by = '';
    //         $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //         $join_data = array(
    //             array(
    //                 'table' => 'assigning_task',
    //                 'fields' => array('taskID', 'userID'),
    //                 'joinWith' => array('userID'),
    //                 'where' => array(
    //                     'status' => 1,
    //                     'taskID' => $val
    //                 ),
    //             ),
    //             array(
    //                 'joined' => 0,
    //                 'table' => 'users',
    //                 'fields' => array('firstName', 'lastName'),
    //                 'joinWith' => array('userID', 'left'),
    //             ),
    //             array(
    //                 'joined' => 1,
    //                 'table' => 'user_data',
    //                 'fields' => array('gender', 'profile'),
    //                 'joinWith' => array('userID', 'left'),
    //             ),
    //         );
    //         $limit = '';
    //         $order_by = '';
    //         $data['valunteers'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //         $CI = &get_instance();
    //         $userID = $this->session->userdata('userID');
    //         $data['totaltask'] = $this->User_model->total_task_count($userID);

    //         $join_data = array(
    //             array(
    //                 'table' => 'users',
    //                 'fields' => array('firstName', 'lastName'),
    //                 'joinWith' => array('userID'),
    //                 'where' => array(
    //                     'userID' => $userID
    //                 ),
    //             ),
    //             array(
    //                 'joined' => 0,
    //                 'table' => 'user_data',
    //                 'fields' => array('profile', 'dioceses_id'),
    //                 'joinWith' => array('userID', 'dioceses_id', 'left'),
    //             ),
    //             array(
    //                 'joined' => 1,
    //                 'table' => 'dioceses',
    //                 'fields' => array('name', 'dioceses_id'),
    //                 'joinWith' => array('dioceses_id', 'left'),
    //             ),
    //         );
    //         $where = array();
    //         $limit = '';
    //         $order_by = '';
    //         $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
    //         $this->load->view('temp/head');
    //         $this->load->view('temp/header', $data);
    //         $this->load->view('temp/sidebar', $data);
    //         $this->load->view('view-task', $data);
    //         $this->load->view('temp/footer');
    //     } else {
    //         echo '<script>window.location.href = "' . base_url() . 'login"</script>';
    //         //redirect(base_url().'login','refresh');
    //     }
    // }
    public function view_intern_task_details()
    {
        // if (($this->session->userdata('userID') != "")) {
        //     $userID = $this->session->userdata('userID');
        //     $v = $this->uri->segment(2);
        //     $data['encode_taskID'] = $v;
        //     $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
        //     $where = "taskID = '$val'";
        //     $data['task'] = $this->Curl_model->fetch_single_data('*', 'task', $where);
        //     $join_data = array(
        //         array(
        //             'table' => 'attachment',
        //             'fields' => array('attachmentName', 'attachmentSize', 'attachmentDate', 'userID', 'attachmentTypeID'),
        //             'joinWith' => array('attachmentTypeID'),
        //             'where' => array(
        //                 'status' => 1,
        //                 'taskID' => $val,
        //                 'dailyReportID' => 0,
        //             ),
        //         ),
        //         array(
        //             'joined' => 0,
        //             'table' => 'attachment_type',
        //             'fields' => array('attachmentTypeName', 'attachmentFileType'),
        //             'joinWith' => array('attachmentTypeID', 'left'),
        //         ),
        //         array(
        //             'joined' => 0,
        //             'table' => 'users',
        //             'fields' => array('firstName', 'lastName'),
        //             'joinWith' => array('userID', 'left'),
        //         ),
        //     );

        //     $limit = '';
        //     $order_by = '';
        //     $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        //     $join_data = array(
        //         array(
        //             'table' => 'assigning_task',
        //             'fields' => array('taskID', 'userID'),
        //             'joinWith' => array('userID'),
        //             'where' => array(
        //                 'status' => 1,
        //                 'taskID' => $val
        //             ),
        //         ),
        //         array(
        //             'joined' => 0,
        //             'table' => 'users',
        //             'fields' => array('firstName', 'lastName'),
        //             'joinWith' => array('userID', 'left'),
        //         ),
        //         array(
        //             'joined' => 1,
        //             'table' => 'user_data',
        //             'fields' => array('gender', 'profile'),
        //             'joinWith' => array('userID', 'left'),
        //         ),
        //     );
        //     $limit = '';
        //     $order_by = '';
        //     $data['valunteers'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        //     $CI = &get_instance();
        //     $userID = $this->session->userdata('userID');
        //     $data['totaltask'] = $this->User_model->total_task_count($userID);

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
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('view-task');
        $this->load->view('temp/footer');
        // } else {
        //     echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        //     //redirect(base_url().'login','refresh');
        // }
    }
    public function intern_task_member()
    {
        //     $encode_taskID = $this->uri->segment(2);
        //     $res['encode_taskID'] = $encode_taskID;
        //     $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        //     $join_data = array(
        //         array(
        //             'table' => 'assigning_task',
        //             'fields' => array('taskID', 'userID'),
        //             'joinWith' => array('userID'),
        //             'where' => array(
        //                 'status' => 1,
        //                 'taskID' => $taskID
        //             ),
        //         ),
        //         array(
        //             'joined' => 0,
        //             'table' => 'users',
        //             'fields' => array('firstName', 'lastName', 'mobile', 'email'),
        //             'joinWith' => array('userID', 'left'),
        //         ),
        //         array(
        //             'joined' => 1,
        //             'table' => 'user_data',
        //             'fields' => array('gender', 'profile'),
        //             'joinWith' => array('userID', 'left'),
        //         ),
        //     );
        //     $limit = '';
        //     $order_by = '';
        //     $res['valunteers'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        //     $CI = &get_instance();
        //     $userID = $this->session->userdata('userID');
        //     $data['totaltask'] = $this->User_model->total_task_count($userID);

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
        // echo "<pre>";
        // print_r($res);
        // die();
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('task-member');
        $this->load->view('temp/footer');
    }
    // public function add_daily_report()
    // {
    //     // $userID = $this->session->userdata('userID');

    //     // if ($this->input->post('task')) {
    //     //     if ($this->input->post('task') != '') {

    //     //         $data['letest_taskID'] = $this->input->post('task');

    //     //         $where1['taskID'] = $data['letest_taskID'];
    //     //     }
    //     // }
    //     // $where1['status'] = 1;
    //     // $where1['userID'] = $userID;
    //     // $where121['dailyReportCreationDate'] = "'" . date("Y-m-d") . "'";
    //     // $join_data = array(
    //     //     array(
    //     //         'table' => 'daily_report',
    //     //         'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity'),
    //     //         'joinWith' => array('taskID', 'left'),
    //     //         'where' => $where1,
    //     //         'where_function' => array(
    //     //             array('CAST', 'DATE', $where121, '')
    //     //         ),
    //     //     ),
    //     //     array(
    //     //         'joined' => 0,
    //     //         'table' => 'task',
    //     //         'fields' => array('taskID', 'taskTitle'),
    //     //         'joinWith' => array('taskID', 'left'),
    //     //     ),
    //     // );

    //     // $limit = '';
    //     // $order_by = '';
    //     // $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     // $userID = $this->session->userdata('userID');
    //     // $join_data = array(
    //     //     array(
    //     //         'table' => 'task',
    //     //         'fields' => array('taskID', 'taskTitle'),
    //     //         'joinWith' => array('taskID'),
    //     //     ),
    //     //     array(
    //     //         'joined' => 0,
    //     //         'table' => 'assigning_task',
    //     //         'fields' => array('taskID'),
    //     //         'joinWith' => array('taskID', 'left'),
    //     //         'where' => array(
    //     //             'userID' => $userID,
    //     //             'status' => '1',
    //     //         ),
    //     //     ),
    //     // );

    //     // $limit = '';
    //     // $order_by = '';
    //     // $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     // $fields = array(
    //     //     'attachmentTypeID',
    //     //     'attachmentTypeName',
    //     //     'attachmentFileType'
    //     // );
    //     // $where = array('status' => 1);
    //     // $limit = '';
    //     // $order_by = array('attachmentTypeID', 'ASC');
    //     // $data['attachment_type'] = $this->Curl_model->fetch_data_in_many_array('attachment_type', $fields, $where, $limit, $order_by);

    //     // $data['totaltask'] = $this->User_model->total_task_count($userID);
    //     // $join_data = array(
    //     //     array(
    //     //         'table' => 'users',
    //     //         'fields' => array('firstName', 'lastName'),
    //     //         'joinWith' => array('userID'),
    //     //         'where' => array(
    //     //             'userID' => $userID
    //     //         ),
    //     //     ),
    //     //     array(
    //     //         'joined' => 0,
    //     //         'table' => 'user_data',
    //     //         'fields' => array('profile', 'dioceses_id'),
    //     //         'joinWith' => array('userID', 'dioceses_id', 'left'),
    //     //     ),
    //     //     array(
    //     //         'joined' => 1,
    //     //         'table' => 'dioceses',
    //     //         'fields' => array('name', 'dioceses_id'),
    //     //         'joinWith' => array('dioceses_id', 'left'),
    //     //     ),
    //     // );
    //     // $where = array();
    //     // $limit = '';
    //     // $order_by = '';
    //     // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     // $fields = array(
    //     //     'attachmentTypeID',
    //     //     'attachmentTypeName',
    //     //     'attachmentFileType'
    //     // );
    //     // $where = array('status' => 1);
    //     // $limit = '';
    //     // $order_by = array('attachmentTypeID', 'ASC');
    //     // $data['attachment_type'] = $this->Curl_model->fetch_data_in_many_array('attachment_type', $fields, $where, $limit, $order_by);
    //     // $fields = array(
    //     //     'dailyReportID',
    //     //     'dailyReportTimeIn',
    //     //     'dailyReportTimeOut',
    //     //     'dailyReportDate',
    //     //     'status'
    //     // );
    //     // $where = array('userID' => $userID, 'status' => 1);
    //     // $limit = 1;
    //     // $order_by = array('dailyReportID', 'DESC');
    //     // $data['leatest_daily_report'] = $this->Curl_model->fetch_data_in_many_array('daily_report', $fields, $where, $limit, $order_by);
    //     // $this->load->view('temp/head');
    //     // $this->load->view('temp/header');
    //     // $this->load->view('temp/sidebar');
    //     // if (!empty($this->input->post('submit')) && $this->input->post('submit') == 'submit') {

    //     //     $rules_array = array(
    //     //         array(
    //     //             'field' => 'tasktitle',
    //     //             'label' => 'Task',
    //     //             'rules' => 'trim|required',
    //     //             'errors' => array(
    //     //                 'required' => 'Please Select Task.',
    //     //             ),
    //     //         ),
    //     //         array(
    //     //             'field' => 'birthday1',
    //     //             'label' => 'Date',
    //     //             'rules' => 'trim|required',
    //     //             'errors' => array(
    //     //                 'required' => 'Please Select Date.',
    //     //             ),
    //     //         ),
    //     //         array(
    //     //             'field' => 'improved_msg',
    //     //             'label' => 'Improved Message',
    //     //             'rules' => 'trim',
    //     //         ),
    //     //         array(
    //     //             'field' => 'dailyActivity',
    //     //             'label' => 'Activity',
    //     //             'rules' => 'trim|required|max_length[150]',
    //     //             'errors' => array(
    //     //                 'required' => 'Please Enter Activity',
    //     //                 'max_length' => 'Please Enter Activity less then and equal to 300 character',
    //     //             ),
    //     //         ),
    //     //         array(
    //     //             'field' => 'dailyReportTimeIn',
    //     //             'label' => 'TimeIn',
    //     //             'rules' => 'trim|required',
    //     //             'errors' => array(
    //     //                 'required' => 'Please Enter Time In.',
    //     //             ),
    //     //         ),
    //     //         array(
    //     //             'field' => 'dailyReportTimeIn1',
    //     //             'label' => 'TimeIn',
    //     //             'rules' => 'trim|required',
    //     //             'errors' => array(
    //     //                 'required' => 'Please Enter Time In.',
    //     //             ),
    //     //         ),
    //     //         array(
    //     //             'field' => 'dailyReportTimeOut',
    //     //             'label' => 'Time Out',
    //     //             'rules' => 'trim|required',
    //     //             'errors' => array(
    //     //                 'required' => 'Please Enter Time Out.',
    //     //             ),
    //     //         ),
    //     //         array(
    //     //             'field' => 'dailyReportTimeOut1',
    //     //             'label' => 'Time Out',
    //     //             'rules' => 'trim|required',
    //     //             'errors' => array(
    //     //                 'required' => 'Please Enter Time Out.',
    //     //             ),
    //     //         ),
    //     //         array(
    //     //             'field' => 'challeges_face',
    //     //             'label' => 'Challenges Faced',
    //     //             'rules' => 'trim|max_length[300]',

    //     //         ),
    //     //         array(
    //     //             'field' => 'experrience_any',
    //     //             'label' => 'Experience Sharing For Task?',
    //     //             'rules' => 'trim',

    //     //         ),
    //     //     );

    //     //     $this->form_validation->set_rules($rules_array);
    //     //     if ($this->form_validation->run()) {
    //     //print_r($this->input->post());
    //     // $attachmentTypeIDs = $this->input->post('attachmentTypeID');
    //     // $tasktitle = $this->input->post('tasktitle');
    //     // $date = $this->input->post('birthday1');
    //     // $dailyIn = $this->input->post('dailyReportTimeIn');
    //     // $dailyIn1 = $this->input->post('dailyReportTimeIn1');
    //     // $dailyOut = $this->input->post('dailyReportTimeOut');
    //     // $dailyOut1 = $this->input->post('dailyReportTimeOut1');
    //     // $dailyActivity = $this->input->post('dailyActivity');
    //     // $improved_msg = $this->input->post('improved_msg');
    //     // $challeges_face = $this->input->post('challeges_face');
    //     // $experrience_any = $this->input->post('experrience_any');
    //     //$taskID=1;
    //     // $data = array(
    //     //     'taskID' => $tasktitle,
    //     //     'userID' => $userID,
    //     //     'dailyReportDate' => date('Y-m-d', strtotime($date)),
    //     //     'dailyReportTimeIn' => $dailyIn . ':' . $dailyIn1,
    //     //     'dailyReportTimeOut' => $dailyOut . ':' . $dailyOut1,
    //     //     'dailyReportActivity' => $dailyActivity,
    //     //     'improved_msg' => $improved_msg,
    //     //     'challeges_face' => $challeges_face,
    //     //     'experrience_any' => $experrience_any,
    //     //     'status' => 1,
    //     // );
    //     // print_r($attachmentTypeIDs);
    //     // die();
    //     // $dailyReportID = $this->Curl_model->insert_data('daily_report', $data);
    //     // $datats['taskStatus'] = 2;
    //     // $task_data = $this->Curl_model->update_data('task', $datats, array('taskID' => $taskID));
    //     // foreach ($attachmentTypeIDs as $key => $value) {
    //     //     $fields = array(
    //     //         'attachmentTypeName',
    //     //     );
    //     //     $where = array(
    //     //         'status' => 1,
    //     //         'attachmentTypeID' => $value
    //     //     );
    //     //     $limit = '';
    //     //     $order_by = array('attachmentTypeID', 'ASC');
    //     //     $results = $this->Curl_model->fetch_data('attachment_type', $fields, $where, $limit, $order_by);
    //     //     $name = $results['attachmentTypeName'];
    //     //     $tempfilename = $this->input->post('temp' . $name);
    //     //     $idfilename = $this->input->post('id' . $name);
    //     //     $sizefilename = $this->input->post('size' . $name);
    //     //     $filename = $_FILES[$name]['name'];
    //     //     $filesize = $_FILES[$name]['size'];
    //     //     //print_r($imgname);
    //     //     //print_r($filename);exit;
    //     //     foreach ($filename as $key1 => $value1) {
    //     //         if ($value1 != '') {
    //     //             $_FILES['file']['name'] = $_FILES[$name]['name'][$key1];
    //     //             $_FILES['file']['type'] = $_FILES[$name]['type'][$key1];
    //     //             $_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'][$key1];
    //     //             $_FILES['file']['error'] = $_FILES[$name]['error'][$key1];
    //     //             $_FILES['file']['size'] = $_FILES[$name]['size'][$key1];
    //     //             $config['upload_path']          = 'user_profile/task/';
    //     //             $config['allowed_types']        = 'gif|jpg|png|jpeg';
    //     //             $config['max_size']             = 1100;
    //     //             // $config['max_width']            = 1024;
    //     //             // $config['max_height']           = 768;

    //     //             $this->load->library('upload', $config);
    //     //             $this->upload->initialize($config);

    //     //             if (!$this->upload->do_upload('file')) {
    //     //                 array_push($error, array('error' => $this->upload->display_errors()));
    //     //print_r($this->upload->display_errors());
    //     //$this->session->set_userdata('error_task', $error);
    //     //$this->load->view('upload_form', $error);
    //     //} else {
    //     //print_r($this->upload->data());
    //     // $imgs = $this->upload->data('file_name');
    //     //    }
    //     //     $fsize = $filesize[$key1];
    //     //     $data = array(
    //     //         'userID' => $userID,
    //     //         'dailyReportID' => $dailyReportID,
    //     //         'attachmentTypeID' => $value,
    //     //         'attachmentName' => $imgs,
    //     //         'attachmentSize' => $fsize,
    //     //         'attachmentDate' => date('Y-m-d', strtotime($date)),
    //     //         'taskID' => $tasktitle,
    //     //         'status' => 1,
    //     //     );
    //     //     $results = $this->Curl_model->insert_data('attachment', $data);
    //     // }

    //     //print_r($this->input->post());
    //     //die();

    //     // }
    //     // $task_data = $this->Curl_model->fetch_data('task', array('taskTitle'), array('taskID' => $tasktitle), '', '');
    //     // $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
    //     // print_r($task_data);
    //     // die();
    //     // $taskTitle = $task_data['taskTitle'];
    //     // $email = $user_data['email'];
    //     // $href = base_url() . 'login';
    //     //$href2 = base_url().'verify/'.md5($results);
    //     // $to = $email;
    //     // $from = 'volunteer@caritasindia.org';
    //     // $msg = 'Caritas India Volunteer';
    //     // $msg2 = "
    //     // <center><p><strong style='font-weight:bold;'>Thanks for giving daily report. Your daily report details is given below.</strong></p></center>
    //     // <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
    //     //     <tr>
    //     //         <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
    //     //         <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . ucwords($taskTitle) . "</td>
    //     //     </tr>
    //     //     <tr>
    //     //         <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Time In</th>
    //     //         <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $dailyIn . ':' . $dailyIn1 . "</td>
    //     //     </tr>
    //     //     <tr>
    //     //         <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Time Out</th>
    //     //         <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $dailyOut . ':' . $dailyOut1 . "</td>
    //     //     </tr>
    //     //     <tr>
    //     //         <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Activity</th>
    //     //         <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $dailyActivity . "</td>
    //     //     </tr>
    //     //     <tr>
    //     //         <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Date</th>
    //     //         <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . date('d/m/Y') . "</td>
    //     //     </tr>
    //     // </table>";
    //     //die();
    //     //         $subj = "Assigned Task reminder from Caritas India";
    //     //         $btn = "Check Daily Report Now!";
    //     //         $html = $this->request_email($msg, $msg2, $href, $btn);
    //     //         $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

    //     //         $this->session->set_flashdata('data_message', 'Successfully Submitted!');
    //     //         echo '<script>window.location.href = "' . base_url() . 'daily-report"</script>';
    //     //         exit();
    //     //     }
    //     // }
    //     //}

    //     $this->load->view('temp/head');
    //     $this->load->view('temp/header');
    //     $this->load->view('temp/sidebar');
    //     $this->load->view('add-daily-report');
    //     $this->load->view('temp/footer');
    // }
    // public function add_daily_report11()
    // {
    //     $userID = $this->session->userdata('userID');
    //     //$data['report']=$this->Curl_model->fetch_all_data("dailyReportID,dailyReportTimeIn,dailyReportTimeOut,dailyReportActivity",'daily_report','status=1& userID='.$userID.' & (dailyReportCreationDate >= CURDATE())');
    //     $join_data = array(
    //         array(
    //             'table' => 'task',
    //             'fields' => array('taskID', 'taskTitle'),
    //             'joinWith' => array('taskID'),
    //         ),
    //         array(
    //             'joined' => 0,
    //             'table' => 'daily_report',
    //             'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity'),
    //             'joinWith' => array('taskID', 'left'),
    //             'where' => array(
    //                 'userID' => $userID,
    //                 'status' => 1,
    //                 'dailyReportCreationDate' => 'CURDATE()'
    //             ),
    //         ),
    //     );

    //     $limit = '';
    //     $order_by = '';
    //     $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     $join_data = array(
    //         array(
    //             'table' => 'attachment',
    //             'fields' => array('attachmentName', 'attachmentSize', 'attachmentDate', 'userID', 'attachmentTypeID'),
    //             'joinWith' => array('attachmentTypeID'),
    //             'where' => array(
    //                 'status' => 1,
    //                 'taskID' => $taskID
    //             ),
    //         ),
    //         array(
    //             'joined' => 0,
    //             'table' => 'attachment_type',
    //             'fields' => array('attachmentTypeName', 'attachmentFileType'),
    //             'joinWith' => array('attachmentTypeID', 'left'),
    //         ),
    //         array(
    //             'joined' => 0,
    //             'table' => 'users',
    //             'fields' => array('firstName', 'lastName'),
    //             'joinWith' => array('userID', 'left'),
    //         ),
    //     );

    //     $limit = '';
    //     $order_by = '';
    //     $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     $userID = $this->session->userdata('userID');
    //     $join_data = array(
    //         array(
    //             'table' => 'task',
    //             'fields' => array('taskID', 'taskTitle'),
    //             'joinWith' => array('taskID'),
    //         ),
    //         array(
    //             'joined' => 0,
    //             'table' => 'assigning_task',
    //             'fields' => array('taskID'),
    //             'joinWith' => array('taskID', 'left'),
    //             'where' => array(
    //                 'userID' => $userID,
    //                 'status' => '1',
    //             ),
    //         ),
    //     );

    //     $limit = '';
    //     $order_by = '';
    //     $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     $fields = array(
    //         'attachmentTypeID',
    //         'attachmentTypeName',
    //         'attachmentFileType'
    //     );
    //     $where = array('status' => 1);
    //     $limit = '';
    //     $order_by = array('attachmentTypeID', 'ASC');
    //     $data['attachment_type'] = $this->Curl_model->fetch_data_in_many_array('attachment_type', $fields, $where, $limit, $order_by);
    //     $data['totaltask'] = $this->User_model->total_task_count($userID);
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
    //             'fields' => array('profile'),
    //             'joinWith' => array('userID', 'left'),
    //         ),
    //     );
    //     $where = array();
    //     $limit = '';
    //     $order_by = '';
    //     $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     $fields = array(
    //         'attachmentTypeID',
    //         'attachmentTypeName',
    //         'attachmentFileType'
    //     );
    //     $where = array('status' => 1);
    //     $limit = '';
    //     $order_by = array('attachmentTypeID', 'ASC');
    //     $data['attachment_type'] = $this->Curl_model->fetch_data_in_many_array('attachment_type', $fields, $where, $limit, $order_by);

    //     $this->load->view('temp/head');
    //     $this->load->view('temp/header', $data);
    //     $this->load->view('temp/sidebar', $data);
    //     if (!empty($this->input->post('submit')) && $this->input->post('submit') == 'submit') {
    //         //print_r($this->input->post());
    //         $rules_array = array(
    //             array(
    //                 'field' => 'tasktitle',
    //                 'label' => 'Task',
    //                 'rules' => 'trim|required',
    //                 'errors' => array(
    //                     'required' => 'Please Select Task.',
    //                 ),
    //             ),
    //             array(
    //                 'field' => 'birthday1',
    //                 'label' => 'Date',
    //                 'rules' => 'trim|required|regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]',
    //                 'errors' => array(
    //                     'required' => 'Please Select Date.',
    //                 ),
    //             ),
    //             array(
    //                 'field' => 'improved_msg',
    //                 'label' => 'Improved Message',
    //                 'rules' => 'trim',
    //             ),
    //             array(
    //                 'field' => 'dailyActivity',
    //                 'label' => 'Activity',
    //                 'rules' => 'trim|required|max_length[150]',
    //                 'errors' => array(
    //                     'required' => 'Please Enter Activity',
    //                     'max_length' => 'Please Enter Activity less then and equal to 300 character',
    //                 ),
    //             ),
    //             array(
    //                 'field' => 'dailyReportTimeIn',
    //                 'label' => 'TimeIn',
    //                 'rules' => 'trim|required|min_length[3]|max_length[5]|callback_validate_time',
    //                 'errors' => array(
    //                     'required' => 'Please Enter Time In.',
    //                 ),
    //             ),
    //             array(
    //                 'field' => 'dailyReportTimeOut',
    //                 'label' => 'Time Out',
    //                 'rules' => 'trim|required|min_length[3]|max_length[5]|callback_validate_time',
    //                 'errors' => array(
    //                     'required' => 'Please Enter Time Out.',
    //                 ),
    //             ),
    //             array(
    //                 'field' => 'challeges_face',
    //                 'label' => 'Challenges Faced',
    //                 'rules' => 'trim|max_length[300]',

    //             ),
    //             array(
    //                 'field' => 'experrience_any',
    //                 'label' => 'Experience Sharing For Task?',
    //                 'rules' => 'trim',

    //             ),
    //         );

    //         $this->form_validation->set_rules($rules_array);
    //         if ($this->form_validation->run() == FALSE) {
    //             //print_r($this->input->post());
    //             $attachmentTypeIDs = $this->input->post('attachmentTypeID');
    //             $tasktitle = $this->input->post('tasktitle');
    //             $date = $this->input->post('birthday1');
    //             $dailyIn = $this->input->post('dailyReportTimeIn');
    //             $dailyOut = $this->input->post('dailyReportTimeOut');
    //             $dailyActivity = $this->input->post('dailyActivity');
    //             $improved_msg = $this->input->post('improved_msg');
    //             $challeges_face = $this->input->post('challeges_face');
    //             $experrience_any = $this->input->post('experrience_any');
    //             //$taskID=1;
    //             $data = array(
    //                 'taskID' => $tasktitle,
    //                 'userID' => $userID,
    //                 'dailyReportDate' => date('Y-m-d', strtotime($date)),
    //                 'dailyReportTimeIn' => $dailyIn,
    //                 'dailyReportTimeOut' => $dailyOut,
    //                 'dailyReportActivity' => $dailyActivity,
    //                 'improved_msg' => $improved_msg,
    //                 'challeges_face' => $challeges_face,
    //                 'experrience_any' => $experrience_any,
    //                 'status' => 1,
    //             );
    //             //print_r($attachmentTypeIDs);
    //             //$dailyReportID = $this->Curl_model->insert_data('daily_report',$data);
    //             if ($dailyReportID != '') {
    //                 $this->session->set_flashdata('data_message', 'Successfully Submitted!');
    //                 $dailyReportID = $this->Curl_model->insert_data('daily_report', $data);
    //             }
    //             foreach ($attachmentTypeIDs as $key => $value) {
    //                 $fields = array(
    //                     'attachmentTypeName',
    //                 );
    //                 $where = array(
    //                     'status' => 1,
    //                     'attachmentTypeID' => $value
    //                 );
    //                 $limit = '';
    //                 $order_by = array('attachmentTypeID', 'ASC');
    //                 $results = $this->Curl_model->fetch_data('attachment_type', $fields, $where, $limit, $order_by);
    //                 $name = $results['attachmentTypeName'];
    //                 $tempfilename = $this->input->post('temp' . $name);
    //                 $idfilename = $this->input->post('id' . $name);
    //                 $sizefilename = $this->input->post('size' . $name);
    //                 $filename = $_FILES[$name]['name'];
    //                 $filesize = $_FILES[$name]['size'];
    //                 //print_r($imgname);
    //                 //print_r($filename);exit;
    //                 foreach ($filename as $key1 => $value1) {
    //                     if ($value1 != '') {
    //                         $fsize = ($filesize[$key1] / 1024) / 1024;
    //                         if ($idfilename[$key1] == '') {
    //                             $data = array(
    //                                 'userID' => $userID,
    //                                 'dailyReportID' => $dailyReportID,
    //                                 'attachmentTypeID' => $value,
    //                                 'attachmentName' => $value1,
    //                                 'attachmentSize' => $fsize,
    //                                 'attachmentDate' => date('Y-m-d', strtotime($date)),
    //                                 'taskID' => $tasktitle,
    //                                 'status' => 1,
    //                             );
    //                             //echo "11<br>";
    //                             $results = $this->Curl_model->insert_data('attachment', $data);
    //                         } else {
    //                             //echo "12<br>";
    //                             $where3 = array(
    //                                 'attachmentID' => $idfilename[$key1]
    //                             );
    //                             $data = array(
    //                                 'userID' => $userID,
    //                                 'dailyReportID' => $dailyReportID,
    //                                 'attachmentID' => $idfilename[$key1],
    //                                 'attachmentTypeID' => $value,
    //                                 'attachmentName' => $value1,
    //                                 'attachmentSize' => $fsize,
    //                                 'attachmentDate' => date('Y-m-d', strtotime($date)),
    //                                 'taskID' => $tasktitle,
    //                                 'status' => 1,
    //                             );
    //                             $results = $this->Curl_model->insert_data('attachment', $data, $where3);
    //                         }
    //                     } else {
    //                         //print_r($data);
    //                         if ($idfilename[$key1] != '') {
    //                             $data = array(
    //                                 'userID' => $userID,
    //                                 'attachmentID' => $idfilename[$key1],
    //                                 'attachmentTypeID' => $value,
    //                                 'attachmentName' => $tempfilename[$key1],
    //                                 'attachmentSize' => $sizefilename[$key1],
    //                                 'attachmentDate' => date('Y-m-d', strtotime($date)),
    //                                 'taskID' => $tasktitle,
    //                                 'status' => 1,
    //                             );
    //                             $where3 = array(
    //                                 'attachmentID' => $idfilename[$key1]
    //                             );
    //                             $results = $this->Curl_model->insert_data('attachment', $data);
    //                         }
    //                     }
    //                     //print_r($this->input->post());
    //                     //die();
    //                     $this->session->set_flashdata('data_message', 'Successfully Submitted!');
    //                     echo '<script>window.location.href = "' . base_url() . 'daily-report"</script>';
    //                 }
    //             }
    //         }
    //     }


    //     $this->load->view('add-daily-report', $data);
    //     $this->load->view('temp/footer');
    // }

    
    public function add_daily_report()
    {
		if($this->session->userdata('intern_id')!="" || $this->session->userdata('intern_id')!=null){
            $state_id = $this->session->userdata('state_id');
            $intern_id = $this->session->userdata('intern_id');
            $data['totaltask']=$this->Intern_model->total_task_count($intern_id);
           
            $join_data = array(
                array(
                    'table' => 'interntask',
                    'fields' => array('intern_task_id', 'task_title', 'creation_date'),
                    'joinWith' => array('intern_task_id'),
                    'group_by' => array('intern_task_id'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'intern_assigning_task',
                    'fields' => array('intern_task_id', 'status'),
                    'joinWith' => array('intern_task_id', 'left'),
                    'where' => array('intern_id' => $intern_id,),
                    'order_by' => array('intern_task_id', 'desc'),
                ),
            );
            $limit = 5;
            $order_by = '';
            $data['interntask'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
       //    echo "<pre>";
       //      print_r($data['interntask'] );exit;
            $join_data = array(
                array(
                    'table' => 'interntask',
                    'fields' => array('intern_task_id', 'task_title'),
                    'joinWith' => array('intern_task_id'),
                    'group_by' => array('intern_task_id'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'intern_daily_report',
                    'fields' => array('intern_dr_id', 'dr_time_in', 'dr_time_out', 'dr_activity', 'dr_create_date'),
                    'joinWith' => array('intern_task_id', 'left'),
                    'where' => array('intern_id' => $intern_id, 'status' => 0, 'status' => 1,),
                    'order_by' => array(
                        'intern_dr_id', 'DESC'
                    ),
                ),
            );
   
            $limit = '5';
            $order_by = array('intern_dr_id', 'DESC');
            $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                // echo '<pre>'.$data['report']. '</pre>'; exit();
           //          echo "<pre>";
           //  print_r($data['report'] );exit;
            
              $join_data = array(
                array(
                    'table' => 'intern_assigning_task',
                    'fields' => array('intern_task_id'),
                    'where' => array(
                        'intern_id' => $intern_id,
                         'status' => 0,
                    ),
                ),
               );
                $limit = '';
                $order_by = '';
                $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                foreach ($task as $key => $value) {
                    $taskIDs[$key] = $value['intern_task_id'];
                }
   
                $join_data = array(
                    array(
                        'table' => 'interntask',
                        'fields' => array('intern_task_id', 'task_title', 'task_description', 'creation_date', 'status','region_id','task_state_id','task_type_id','task_brief'),
                        'joinWith' => array('intern_task_id','task_type_id', 'region_id'),
                        'where' => array(
                            //'task_state_id' => $state_id,
                            'status' => 1,
                            'task_status' => 0,
                            'task_for' => 2,
                            'task_type_id' => 1,
                            
                        ),
                        'order_by' => array(
                            'intern_task_id', 'DESC'
                        ),
                      'where_not_in' => array('intern_task_id' => $taskIDs)
                   ),
                       array(
                           'joined'=>0,
                           'table'=>'regions',
                           'fields'=>array('region_name'),
                           'joinWith'=>array('region_id','left'),
                       ),
                       array(
                           'joined'=>0,
                           'table'=>'task_type',
                           'fields'=>array('task_type'),
                           'joinWith'=>array('task_type_id','left'),
                       ),
                   );
   
                $limit = '';
   
                $order_by = '';
   
               $data['find_task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
               // echo '<pre>';
               // print_r ($data['find_task']);exit;
               
               $join_data = array(
                array(
                    'table' => 'intern_assigning_task',
                    'fields' => array('intern_task_id'),
                    'where' => array(
                        'intern_id' => $intern_id,
                    ),
                ),
               );
                $limit = '';
                $order_by = '';
                $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                foreach ($intern_task_id as $key => $value) {
                    $taskIDs[$key] = $value['intern_task_id'];
                }
   
                $join_data = array(
                    array(
                        'table' => 'interntask',
                        'fields' => array('intern_task_id', 'task_title', 'task_description', 'creation_date', 'status','region_id','task_state_id','task_type_id','task_brief'),
                        'joinWith' => array('intern_task_id','task_type_id', 'region_id'),
                        'where' => array(
                            'task_state_id' => $state_id,
                            'status' => 1,
                            'task_status' => 0,
                            'task_for' => 2,
                            'task_type_id' =>2,
                            
                        ),
                        'order_by' => array(
                            'intern_task_id', 'DESC'
                        ),
                      'where_not_in' => array('intern_task_id' => $taskIDs)
                   ),
                       array(
                           'joined'=>0,
                           'table'=>'regions',
                           'fields'=>array('region_name'),
                           'joinWith'=>array('region_id','left'),
                       ),
                       array(
                           'joined'=>0,
                           'table'=>'task_type',
                           'fields'=>array('task_type'),
                           'joinWith'=>array('task_type_id','left'),
                       ),
                   );
   
                $limit = '';
   
                $order_by = '';
   
               $data['find_task_offline'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
           //   echo "<pre>";
           //   print_r($data['find_task_offline']);exit;
            $join_data = array(
               array(
                   'table'=>'interns',
                   'fields'=>array('first_name','last_name', 'state_id', 'mobile'),
                   'joinWith'=>array('intern_id'),
                   'where'=>array(
                       'intern_id'=>$intern_id
                   ),
               ),
               array(
                   'joined'=>0,
                   'table'=>'interns_data',
                   'fields'=>array('occupation'),
                   'joinWith'=>array('intern_id','left'),
               ),
               array(
                   'joined'=>0,
                   'table'=>'states',
                   'fields'=>array('region_id','state_name'),
                   'joinWith'=>array('state_id','left'),
               ),
               array(
                   'joined'=>2,
                   'table'=>'regions',
                   'fields'=>array('region_name'),
                   'joinWith'=>array('region_id','left'),
               ),
           );
           $where = array();
           $limit = '';
           $order_by ='';
           $data['internDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
             //   echo "<pre>";
           //   print_r($data['find_task_offline']);exit
           $data['state']=$this->Curl_model->fetch_all_data("state_id,state_name",'states','status=1');
        $this->load->view('temp/head');
        $this->load->view('temp/header',$data);
        $this->load->view('temp/sidebar');
        $this->load->view('add-daily-report',$data);
        $this->load->view('temp/footer');
		}else{					
			echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
		 }	
    }


    // public function insert_daily_report()
    // {
    //     try {
    //         $data = array(
               
    //             'tasktitle' => $this->input->post('tasktitle'),
    //             'dr_time_in' => $this->input->post('dr_time_in'),
    //             'dr_time_out' => $this->input->post('dr_time_out'),
    //             'dr_date' => $this->input->post('dr_date'),
    //             'improvement' => $this->input->post('improvement'),
    //             'challenges' => $this->input->post('challenges'),
    //             'dr_activity' => $this->input->post('dr_activity'),
    //             'experience' => $this->input->post('experience'),
                
    //             //'status' => $this->input->post('status'),
    //         );

    //         // echo "<pre>";
    //         // print_r($createdata);exit; 
           

    //         $this->Crud_modal->data_insert('intern_daily_report', $data);
    //         //  echo "<pre>";
    //         // print_r($this);exit; 
            
    //        // $this->session->set_flashdata('intern_daily_report_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Daily Work Report has Inserted.</div>');
    //        // redirect(base_url() . 'daily-report');
    //     } catch (Exception $e) {
    //         echo 'Caught exception: ',  $e->getMessage(), "\n";
    //     }
    // }
    public function insert_daily_report()
    {
        
        try {
            
            if($this->session->userdata('intern_id')!="" || $this->session->userdata('intern_id')!=null){

                $intern_id = $this->session->userdata('intern_id');
                $tasktitle = $this->input->post('tasktitle');
             //echo '<pre>';
             //print_r($tasktitle );exit;
                $dr_time_in = $this->input->post('dr_time_in');
                $dailyIn1 = $this->input->post('dailytimeIn1');
                $dr_time_out =$this->input->post('dr_time_out');
                $dailyOut1 = $this->input->post('dailytimeOut1');
                $dr_date = $this->input->post('birthday1');
                $improvement = $this->input->post('improvement');
                $challenges =$this->input->post('challenges');
                $dr_activity = $this->input->post('dr_activity');
                $experience = $this->input->post('experience');
            $data = array(
                // 'tasktitle' => $intern_task_id,
                'intern_task_id' => $tasktitle,
                'intern_id' => $intern_id,
                'dr_date' => date('Y-m-d', strtotime($dr_date)),
                'dr_time_in' => $dr_time_in . ':' . $dailyIn1,
                'dr_time_out' => $dr_time_out . ':'. $dailyOut1,
                'dr_activity' => $dr_activity,
                'improvement' => $improvement,
                'challenges' => $challenges,
                'experience' => $experience,
                'status' => 1,
                'dr_create_date' => date('Y-m-d'),
                            
            );
            // echo $data;exit;        
            $results=$this->Curl_model->insert_data('intern_daily_report',$data);

            // echo "<pre>";
            // print_r($results);exit;

            //$this->session->set_flashdata('volunteer_transfer_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Relocated  successfully.</div>');
           // redirect(base_url() . 'intern-daily-report');
        }else{					
			echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
		 }	
        
        } 	catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
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

    public function task_lists()
    {
        if (($this->session->userdata('userID') != "")) {

            $userID = $this->session->userdata('userID');
            $join_data = array(
                array(
                    'table' => 'assigning_task',
                    'fields' => array('taskID'),
                    'joinWith' => array('taskID'),
                    'where' => array(
                        'userID' => $userID,
                        'status' => '1',
                    ),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task',
                    'fields' => array('taskID', 'taskTitle'),
                    'joinWith' => array('taskID', 'left'),
                    'order_by' => array('taskID', 'desc'),
                ),

            );
            $limit = '';
            $order_by = '';
            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            if ($this->input->post()) {
                if ($this->input->post('task') != '') {
                    $data['letest_taskID'] = $this->input->post('task');
                } else {
                    $data['letest_taskID'] = $data['task'][0]['taskID'];
                }
            } else {
                $data['letest_taskID'] = $data['task'][0]['taskID'];
            }
            $join_data = array(
                array(
                    'table' => 'daily_report',
                    'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity'),
                    'joinWith' => array('taskID'),
                    'where' => array('userID' => $userID),
                    'order_by' => array('dailyReportID', 'desc'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'task',
                    'fields' => array('taskID', 'taskTitle'),
                    'joinWith' => array('taskID', 'left'),
                    'where' => array('taskID' => $data['letest_taskID']),
                ),
            );
            $limit = '';
            $order_by = array('dailyReportID', 'DESC');
            $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
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
            $this->load->view('daily-report', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
            //redirect(base_url().'login','refresh');
        }
    }

    public function task_lists_daily()
    {
        if (($this->session->userdata('userID') != "")) {

            $userID = $this->session->userdata('userID');
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('taskID', 'taskTitle'),
                    'joinWith' => array('taskID'),
                    'order_by' => array('taskID', 'desc'),
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
            if ($this->input->post()) {
                if ($this->input->post('task') != '') {
                    $data['letest_taskID'] = $this->input->post('task');
                } else {
                    $data['letest_taskID'] = $data['task'][0]['taskID'];
                }
            } else {
                $data['letest_taskID'] = $data['task'][0]['taskID'];
            }
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('taskID', 'taskTitle'),
                    'joinWith' => array('taskID'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'daily_report',
                    'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportCreationDate', 'dailyReportActivity'),
                    'joinWith' => array('taskID', 'left'),
                    'where' => array(
                        'userID' => $userID,
                        'taskID' => $data['letest_taskID']
                    ),
                ),
            );

            $limit = '6';
            $order_by = array('dailyReportID', 'desc');
            $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
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
            $data['internDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            // echo '<pre>';
            // print_r (' $data['internDetails']');exit;
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('add-daily-report', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        }
    }

    // public function daily_report()
    // {
    //     // $userID = $this->session->userdata('userID');
    //     // $join_data = array(
    //     //     array(
    //     //         'table' => 'assigning_task',
    //     //         'fields' => array('taskID'),
    //     //         'joinWith' => array('taskID'),
    //     //         'where' => array(
    //     //             'userID' => $userID,
    //     //             'status' => '1',
    //     //         ),
    //     //     ),
    //     //     array(
    //     //         'joined' => 0,
    //     //         'table' => 'task',
    //     //         'fields' => array('taskID', 'taskTitle'),
    //     //         'joinWith' => array('taskID', 'left'),
    //     //         'order_by' => array('taskID', 'desc'),
    //     //     ),

    //     // );

    //     // $limit = '';
    //     // $order_by = '';
    //     // $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
    //     // $where1['userID'] = $userID;
    //     // if ($this->input->post('task')) {
    //     //     if ($this->input->post('task') != '') {
    //     //         $data['letest_taskID'] = $this->input->post('task');
    //     //         $where1['taskID'] = $this->input->post('task');
    //     // print_r($this->input->post());
    //     // die();
    //     // }
    //     // }
    //     //$where1['taskID'] = $data['task'][0]['taskID'];
    //     // $join_data = array(
    //     //     array(
    //     //         'table' => 'daily_report',
    //     //         'fields' => array('dailyReportID', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity', 'dailyReportCreationDate'),
    //     //         'joinWith' => array('taskID'),
    //     //         'where' => $where1,
    //     //         'order_by' => array('dailyReportID', 'desc'),
    //     //     ),
    //     //     array(
    //     //         'joined' => 0,
    //     //         'table' => 'task',
    //     //         'fields' => array('taskID', 'taskTitle'),
    //     //         'joinWith' => array('taskID', 'left'),
    //     //     ),
    //     // );

    //     // $limit = '';
    //     // $order_by = array('dailyReportID', 'DESC');
    //     // $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     // $join_data = array(
    //     //     array(
    //     //         'table' => 'attachment',
    //     //         'fields' => array('attachmentName', 'attachmentSize', 'attachmentDate', 'userID', 'attachmentTypeID'),
    //     //         'joinWith' => array('attachmentTypeID'),
    //     //         'where' => array(
    //     //             'status' => 1,
    //     //         ),
    //     //     ),
    //     //     array(
    //     //         'joined' => 0,
    //     //         'table' => 'attachment_type',
    //     //         'fields' => array('attachmentTypeName', 'attachmentFileType'),
    //     //         'joinWith' => array('attachmentTypeID', 'left'),
    //     //     ),
    //     // );

    //     // $limit = '';
    //     // $order_by = '';
    //     // $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
    //     // $data['totaltask'] = $this->User_model->total_task_count($userID);
    //     // $join_data = array(
    //     //     array(
    //     //         'table' => 'users',
    //     //         'fields' => array('firstName', 'lastName'),
    //     //         'joinWith' => array('userID'),
    //     //         'where' => array(
    //     //             'userID' => $userID
    //     //         ),
    //     //     ),
    //     //     array(
    //     //         'joined' => 0,
    //     //         'table' => 'user_data',
    //     //         'fields' => array('profile', 'dioceses_id'),
    //     //         'joinWith' => array('userID', 'dioceses_id', 'left'),
    //     //     ),
    //     //     array(
    //     //         'joined' => 1,
    //     //         'table' => 'dioceses',
    //     //         'fields' => array('name', 'dioceses_id'),
    //     //         'joinWith' => array('dioceses_id', 'left'),
    //     //     ),
    //     // );
    //     // $where = array();
    //     // $limit = '';
    //     // $order_by = '';
    //     // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
    //     $this->load->view('temp/head');
    //     $this->load->view('temp/header');
    //     $this->load->view('temp/sidebar');
    //     $this->load->view('daily-report');
    //     $this->load->view('temp/footer');
    // }

    public function daily_report()
    {
            if($this->session->userdata('intern_id')!="" || $this->session->userdata('intern_id')!=null){
             $intern_id = $this->session->userdata('intern_id');
             $join_data = array(
                 array(
                     'table' => 'interntask',
                     'fields' => array('intern_task_id', 'task_title'),
                     'joinWith' => array('intern_task_id'),
                 ),
                 array(
                     'joined' => 0,
                     'table' => 'intern_assigning_task',
                     'fields' => array('intern_task_id'),
                     'joinWith' => array('intern_task_id', 'left'),
                     'where' => array(
                         'intern_id' => $intern_id,
                         'status' => '1',
                     ),
                 ),
             );
            $limit = '';
            $order_by = '';
            $data['interntask'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

            // echo '<pre>';
            // print_r ($data['interntask'] );exit;
                
                if ($this->input->post()) {
                    if ($this->input->post('interntask') != '') {
                        $data['letest_taskID'] = $this->input->post('interntask');
                       
                    } else {
                        $data['letest_taskID'] = $data['interntask'][0]['intern_task_id'];
                    }
                } else {
                    $data['letest_taskID'] = $data['interntask'][0]['intern_task_id'];
                }
    
                $join_data = array(
                    array(
                        'table' => 'intern_daily_report',
                        'fields' => array('intern_dr_id', 'dr_time_in', 'dr_time_out', 'dr_activity', 'dr_create_date'),
                        'joinWith' => array('intern_task_id'),
                        'where' => array('intern_id' => $intern_id),
                        'order_by' => array('intern_dr_id', 'desc'),
                    ),
                    array(
                        'joined' => 0,
                        'table' => 'interntask',
                        'fields' => array('intern_task_id', 'task_title'),
                        'joinWith' => array('intern_task_id', 'left'),
                        'where' => array('intern_task_id' => $data['letest_taskID']),
                    ),
                );
                $limit = '';
                $order_by = array('intern_dr_id', 'DESC');
                $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                // print_r($data['report']); die();
                $data['totaltask'] = $this->Intern_model->total_task_count($intern_id);
                
            // echo '<pre>';
            // print_r ( $data['totaltask']);exit;
                $join_data = array(
                array(
                    'table'=>'interns',
                    'fields'=>array('first_name','last_name', 'state_id'),
                    'joinWith'=>array('intern_id'),
                    'where'=>array(
                        'intern_id'=>$intern_id
                    ),
                ),
                array(
                    'joined'=>0,
                    'table'=>'interns_data',
                    'fields'=>array('occupation'),
                    'joinWith'=>array('intern_id','left'),
                ),
                array(
                    'joined'=>0,
                    'table'=>'states',
                    'fields'=>array('region_id','state_name'),
                    'joinWith'=>array('state_id','left'),
                ),
                array(
                    'joined'=>2,
                    'table'=>'regions',
                    'fields'=>array('region_name'),
                    'joinWith'=>array('region_id','left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by ='';
            $data['internDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
            // echo '<pre>'.$data['internDetails']. '</pre>'; exit();
    
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
                $this->load->view('daily-report', $data);
                $this->load->view('temp/footer');
            } else {
                echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
            }
        }

    public function daily_report_all_data()
    {
        // if (($this->session->userdata('userID') != "")) {
        //     $userID = $this->session->userdata('userID');
        //     $v = $this->uri->segment(2);
        //     $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
        //     $where = "dailyReportID = '$val'";
        //     $data['report'] = $this->Curl_model->fetch_single_data('*', 'daily_report', $where);
        //     $join_data = array(
        //         array(
        //             'table' => 'attachment',
        //             'fields' => array('attachmentName', 'attachmentSize', 'attachmentDate', 'userID', 'attachmentTypeID'),
        //             'joinWith' => array('attachmentTypeID'),
        //             'where' => array(
        //                 'status' => 1,
        //                 'dailyReportID' => $val,
        //                 'userID' => $userID
        //             ),
        //         ),
        //         array(
        //             'joined' => 0,
        //             'table' => 'attachment_type',
        //             'fields' => array('attachmentTypeName', 'attachmentFileType'),
        //             'joinWith' => array('attachmentTypeID', 'left'),
        //         ),
        //         array(
        //             'joined' => 0,
        //             'table' => 'users',
        //             'fields' => array('firstName', 'lastName'),
        //             'joinWith' => array('userID', 'left'),
        //         ),
        //     );

        //     $limit = '';
        //     $order_by = '';
        //     $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        //     $CI = &get_instance();
        //     $userID = $this->session->userdata('userID');
        //     $data['totaltask'] = $this->User_model->total_task_count($userID);
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
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('view-all-daily-data');
        $this->load->view('temp/footer');
        //} 
        // else {
        //     echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        // }
    }


    // public function find_task()
    // {
    //     // if (($this->session->userdata('userID') != "")) {
    //     //     $userID = $this->session->userdata('userID');
    //     //     $data['totaltask'] = $this->User_model->total_task_count($userID);
    //     //     $fields = array(
    //     //         'stateID',
    //     //         'stateName',
    //     //     );
    //     //     $where = '';
    //     //     $limit = '';
    //     //     $order_by = array('stateID', 'ASC');
    //     //     $data['state'] = $this->Curl_model->fetch_data_in_many_array('states', $fields, $where, $limit, $order_by);
    //     //     $data['causes'] = $this->Curl_model->fetch_all_data("causesID,causesName", 'causes', 'status=1');
    //     //     $join_data = array(
    //     //         array(
    //     //             'table' => 'assigning_task',
    //     //             'fields' => array('taskID'),
    //     //             'where' => array(
    //     //                 'userID' => $userID,
    //     //             ),
    //     //         ),
    //     //     );

    //     //     $limit = '';
    //     //     $order_by = '';
    //     //     $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
    //     //     foreach ($task as $key => $value) {
    //     //         $taskIDs[$key] = $value['taskID'];
    //     //     }

    //     //     $join_data = array(
    //     //         array(
    //     //             'table' => 'task',
    //     //             'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate', 'taskCreationDate', 'taskStatus'),
    //     //             'joinWith' => array('taskID'),
    //     //             'where' => array(
    //     //                 'status' => 1,
    //     //                 'taskStatus !' => 1,
    //     //             ),
    //     //             'order_by' => array(
    //     //                 'taskID', 'DESC'
    //     //             ),
    //     //             'where_not_in' => array('taskID' => $taskIDs)
    //     //         ),
    //     //     );

    //     //     $limit = '';
    //     //     $order_by = '';
    //     //     $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
    //     // echo "<br>";
    //     // print_r($data['task']);
    //     // die();
    //     // $join_data = array(
    //     //     array(
    //     //         'table' => 'users',
    //     //         'fields' => array('firstName', 'lastName'),
    //     //         'joinWith' => array('userID'),
    //     //         'where' => array(
    //     //             'userID' => $userID
    //     //         ),
    //     //     ),
    //     //     array(
    //     //         'joined' => 0,
    //     //         'table' => 'user_data',
    //     //         'fields' => array('profile', 'dioceses_id'),
    //     //         'joinWith' => array('userID', 'dioceses_id', 'left'),
    //     //     ),
    //     //     array(
    //     //         'joined' => 1,
    //     //         'table' => 'dioceses',
    //     //         'fields' => array('name', 'dioceses_id'),
    //     //         'joinWith' => array('dioceses_id', 'left'),
    //     //     ),
    //     // );
    //     // $where = array();
    //     // $limit = '';
    //     // $order_by = '';
    //     // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //     $this->load->view('temp/head');
    //     $this->load->view('temp/header');
    //     $this->load->view('temp/sidebar');
    //     $this->load->view('find-task');
    //     $this->load->view('temp/footer');
    //     // } else {
    //     //     echo '<script>window.location.href = "' . base_url() . 'login"</script>';
    //     // }
    // }


    // public function find_task()
    // {
    //     if($this->session->userdata('intern_id')!="" || $this->session->userdata('intern_id')!=null){
    //        $intern_id = $this->session->userdata('intern_id');
	// 	   $state_id = $this->session->userdata('state_id');
		   
	// 	   $data['state']=$this->Curl_model->fetch_all_data("state_id,state_name",'states','status=1');
    //        $join_data = array(
	// 		 array(
	// 			 'table' => 'assigning_task',
	// 			 'fields' => array('task_id'),
	// 			 'where' => array(
	// 				 'intern_id' => $intern_id,
	// 			 ),
	// 		 ),
    //         );
    //          $limit = '';
    //          $order_by = '';
    //          $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
    //          foreach ($task as $key => $value) {
    //              $taskIDs[$key] = $value['task_id'];
    //          }

    //          $join_data = array(
    //              array(
    //                  'table' => 'task',
    //                  'fields' => array('task_id', 'task_title', 'task_description', 'creation_date', 'status','region_id','task_state_id','task_type_id','task_brief'),
    //                  'joinWith' => array('task_id','task_type_id', 'region_id'),
    //                  'where' => array(
	// 					 //'task_state_id' => $state_id,
    //                      'status' => 1,
    //                      'task_status' => 0,
	// 					 'task_for' => 1,
						 
    //                  ),
    //                  'order_by' => array(
    //                      'task_id', 'DESC'
    //                  ),
    //                'where_not_in' => array('task_id' => $taskIDs)
    //             ),
	// 				array(
	// 					'joined'=>0,
	// 					'table'=>'regions',
	// 					'fields'=>array('region_name'),
	// 					'joinWith'=>array('region_id','left'),
	// 				),
	// 				array(
	// 					'joined'=>0,
	// 					'table'=>'task_type',
	// 					'fields'=>array('task_type'),
	// 					'joinWith'=>array('task_type_id','left'),
	// 				),
	// 			);

    //          $limit = '';

    //          $order_by = '';

    //         $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

    //    $join_data = array(
    //         array(
    //             'table'=>'volunteer',
    //             'fields'=>array('first_name','last_name', 'state_id'),
    //             'joinWith'=>array('volunteer_id'),
    //             'where'=>array(
    //                 'volunteer_id'=>$volunteer_id
    //             ),
    //         ),
    //         array(
    //             'joined'=>0,
    //             'table'=>'volunteer_data',
    //             'fields'=>array('profile'),
    //             'joinWith'=>array('volunteer_id','left'),
    //         ),
	// 		array(
    //             'joined'=>0,
    //             'table'=>'states',
    //             'fields'=>array('region_id','state_name'),
    //             'joinWith'=>array('state_id','left'),
    //         ),
	// 		array(
    //             'joined'=>2,
    //             'table'=>'regions',
    //             'fields'=>array('region_name'),
    //             'joinWith'=>array('region_id','left'),
    //         ),
    //     );
    //     $where = array();
    //     $limit = '';
    //     $order_by ='';
    //     $data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
	// 	//echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

    //     $this->load->view('temp/head');
    //     $this->load->view('temp/header', $data);
    //     $this->load->view('temp/sidebar', $data);
    //     $this->load->view('find-task', $data);
    //     $this->load->view('temp/footer');
    //      } else {
    //          echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
    //      }

    // }

    public function find_task()
    {
        if($this->session->userdata('intern_id')!="" || $this->session->userdata('intern_id')!=null){
           $intern_id = $this->session->userdata('intern_id');
		   $state_id = $this->session->userdata('state_id');
		   
		   $data['state']=$this->Curl_model->fetch_all_data("state_id,state_name",'states','status=1');
           $join_data = array(
			 array(
				 'table' => 'intern_assigning_task',
				 'fields' => array('intern_task_id'),
				 'where' => array(
					 'intern_id' => $intern_id,
				 ),
			 ),
            );
             $limit = '';
             $order_by = '';
             $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
             foreach ($task as $key => $value) {
                 $taskIDs[$key] = $value['intern_task_id'];
             }

             $join_data = array(
                 array(
                     'table' => 'interntask',
                     'fields' => array('intern_task_id ', 'task_title', 'task_description', 'creation_date', 'status','region_id','task_state_id','task_type_id','task_brief'),
                     'joinWith' => array('intern_task_id ','task_type_id', 'region_id'),
                     'where' => array(
						 //'task_state_id' => $state_id,
                         'status' => 1,
                         'task_status' => 0,
						 'task_for' => 1,
						 
                     ),
                     'order_by' => array(
                         'intern_task_id ', 'DESC'
                     ),
                   'where_not_in' => array('intern_task_id ' => $taskIDs)
                ),
					array(
						'joined'=>0,
						'table'=>'regions',
						'fields'=>array('region_name'),
						'joinWith'=>array('region_id','left'),
					),
					array(
						'joined'=>0,
						'table'=>'task_type',
						'fields'=>array('task_type'),
						'joinWith'=>array('task_type_id','left'),
					),
				);

             $limit = '';

             $order_by = '';

            $data['interntask'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            // echo '<pre>';
            // print_r ('$data['interntask']');exit;

       $join_data = array(
            array(
                'table'=>'interns',
                'fields'=>array('first_name','last_name', 'state_id'),
                'joinWith'=>array('intern_id'),
                'where'=>array(
                    'intern_id'=>$intern_id
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'interns_data',
                'fields'=>array('occupation'),
                'joinWith'=>array('intern_id','left'),
            ),
			array(
                'joined'=>0,
                'table'=>'states',
                'fields'=>array('region_id','state_name'),
                'joinWith'=>array('state_id','left'),
            ),
			array(
                'joined'=>2,
                'table'=>'regions',
                'fields'=>array('region_name'),
                'joinWith'=>array('region_id','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        //$data['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        $data['internDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		//echo '<pre>'.$data['volunteerDetails']. '</pre>'; exit();

        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('intern-find-task', $data);
        $this->load->view('temp/footer');
         } else {
             echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
         }

    }

   
    public function send_request()
    {
        $userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $data = array(
            'taskID' => $taskID,
            'userID' => $userID,
            'status' => 0,
            'sendRequiestCreatingDate' => date('y-m-d h:i:s'),
        );
        $results = $this->Curl_model->insert_data('send_requiest', $data);
        if ($results) {
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('taskDescription', 'taskID', 'taskTitle', 'causesID', 'taskBrief', 'taskPublishedDate', 'status', 'taskStatus'),
                    'where' => array('taskID' => $taskID),
                    'order_by' => array('taskID', 'DESC'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'causes',
                    'fields' => array('causesName'),
                    'joinWith' => array('causesID', 'left'),
                ),
            );
            $join_data1 = array(
                array(
                    'table' => 'task_location',
                    'fields' => array('cityID'),
                    'where' => array('taskID' => $taskID),
                    'joinWith' => array('taskID', 'left'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'cities',
                    'fields' => array('cityName'),
                    'joinWith' => array('cityID', 'left'),
                ),
            );
            $limit = '';
            $order_by = '';
            $task_data = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $task_location_data = $this->Curl_model->fetch_data_with_joining($join_data1, $limit, $order_by);
            $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
            // print_r($task_data);
            // die();
            $email = $user_data['email'];
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $email;
            $from = 'volunteer@caritasindia.org';
            $msg = 'Caritas India Volunteer';

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
                if ($count == (sizeof($task_location_data) - 1)) {
                }
                $count++;
            }
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Thanks for sending request for task. Task details is given below</strong></p></center>
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
            $subj = "Send Request for Task from Caritas India";
            $btn = "LogIn Now!";

            $html = $this->request_email($msg, $msg2, $href, $btn);
            $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
            $this->session->set_userdata('request_send', 'true');
            echo '<script>window.location.href = "' . base_url() . 'find-task"</script>';
        }
    }

    public function search_find_task()
    {
        if (($this->session->userdata('userID') != "")) {
            $userID = $this->session->userdata('userID');
            $data['cause'] = "";
            $data['states'] = "";
            $data['city'] = array();
            $data['cities'] = "";
            $data['totaltask'] = $this->User_model->total_task_count($userID);
            $join_data = array(
                array(
                    'table' => 'assigning_task',
                    'fields' => array('taskID'),
                    'where' => array(
                        'userID' => $userID,
                    ),
                ),
            );

            $limit = '';
            $order_by = '';
            $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            foreach ($task as $key => $value) {
                $taskIDs[$key] = $value['taskID'];
            }
            $where111['taskLocationID !'] = 0;
            $where['taskStatus !'] = 1;
            $join_data = array(
                array(
                    'table' => 'task',
                    'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate', 'taskCreationDate', 'taskStatus'),
                    'joinWith' => array('taskID'),
                    'where' => $where,
                    'where_not_in' => array('taskID' => $taskIDs)
                ),
            );
            if ($this->input->get('causes') != '') {
                $where['causesID'] = $this->input->get('causes');
                $data['cause'] = $this->input->get('causes');
                $join_data = array(
                    array(
                        'table' => 'task',
                        'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate', 'taskCreationDate', 'taskStatus'),
                        'joinWith' => array('taskID'),
                        'where' => $where,
                        'where_not_in' => array('taskID' => $taskIDs)
                    ),
                );
            }
            if ($this->input->get('cities') != '') {
                $where111['cityID'] = $this->input->get('cities');
                $data['cities'] = $this->input->get('cities');
                $join_data = array(
                    array(
                        'table' => 'task',
                        'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate', 'taskCreationDate', 'taskStatus'),
                        'joinWith' => array('taskID'),
                        'where' => $where,
                        'where_not_in' => array('taskID' => $taskIDs)
                    ),
                    array(
                        'joined' => 0,
                        'table' => 'task_location',
                        'fields' => array('stateID'),
                        'where' => $where111,
                        'joinWith' => array('taskID', 'left'),
                    ),
                );
            }
            if ($this->input->get('state') != '') {
                $where111['stateID'] = $this->input->get('state');
                $data['states'] = $this->input->get('state');
                $join_data = array(
                    array(
                        'table' => 'task_location',
                        'fields' => array('stateID'),
                        'where' => $where111,
                        'group_by' => array('stateID'),
                    ),
                    array(
                        'joined' => 0,
                        'table' => 'task',
                        'fields' => array('taskID', 'taskTitle', 'taskDescription', 'taskPublishedDate', 'taskCreationDate', 'taskStatus'),
                        'joinWith' => array('taskID', 'left'),
                        'where' => $where,
                        'where_not_in' => array('taskID' => $taskIDs)
                    ),
                );
            }

            $limit = '';
            $order_by = '';
            $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
            $data['causes'] = $this->Curl_model->fetch_all_data("causesID,causesName", 'causes', 'status=1');

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

            $fields = array(
                'stateID',
                'stateName',
            );
            $where = '';
            $limit = '';
            $order_by = array('stateID', 'ASC');
            $data['state'] = $this->Curl_model->fetch_data_in_many_array('states', $fields, $where, $limit, $order_by);
            if ($data['states'] != '') {
                $fields = array(
                    'cityID',
                    'cityName',
                );
                $where = array('stateID' => $data['states']);
                $limit = '';
                $order_by = '';
                $data['city'] = $this->Curl_model->fetch_data_in_many_array('cities', $fields, $where, $limit, $order_by);
            }
            // echo "<pre>";
            // print_r($data);
            // die();	
            $this->load->view('temp/head');
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('find-task', $data);
            $this->load->view('temp/footer');
        } else {
            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        }
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
            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
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
            echo '<script>window.location.href = "' . base_url() . 'login"</script>';
            //redirect(base_url().'login','refresh');
        }
    }
    /*public function timeline()
	{
        $CI =& get_instance();
        $encode_data=$CI->get_library->encode('atif');
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('time-line');
        $this->load->view('temp/footer');
    }*/
    public function change_password()
    {
        $CI = &get_instance();
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
                $this->load->view('change-pwd', $res);
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
                            echo '<script>window.location.href = "' . base_url() . 'change-password"</script>';
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


    public function profile()
    {
        // $CI = &get_instance();

        // $userID = $this->session->userdata('userID');
        // if ($this->input->post()) {
        //     if ($this->input->post('policy_status')) {
        //         $policy_status = 1;
        //         $where = array(
        //             'userID' => $userID
        //         );
        //         $data =  array(
        //             'policy_status' => $policy_status,
        //         );
        //         $results = $this->Curl_model->update_data('user_data', $data, $where);
        //     }
        //print_r($this->input->post('policy_status'));
        // die();
        // }
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('volunteerID', 'firstName', 'lastName', 'mobile', 'email'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'userID' => $userID
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('dateOfBirth', 'correspontenceAddress', 'heard_us', 'staff_member', 'govt_name', 'time_duration', 'ref1_name', 'ref1_relation', 'ref1_contact', 'ref1_email', 'ref1_address', 'ref2_name', 'ref2_relation', 'ref2_contact', 'ref2_email', 'ref2_address', 'profile', 'policy_status', 'linkedin', 'twitter', 'dioceses', 'dioceses_id', 'govt_type'),
        //         'joinWith' => array('userID', 'dioceses_id', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'dioceses',
        //         'fields' => array('name', 'dioceses_id'),
        //         'joinWith' => array('dioceses_id', 'left'),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'position',
        //         'fields' => array('positionName'),
        //         'joinWith' => array('positionID', 'left'),
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
        //         'table' => 'education',
        //         'fields' => array('educationName'),
        //         'joinWith' => array('educationID', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'blood_group',
        //         'fields' => array('bloodGroupName'),
        //         'joinWith' => array('bloodGroupID', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'occupation',
        //         'fields' => array('occupationName'),
        //         'joinWith' => array('occupationID', 'left'),
        //     ),
        // );
        // $where = array();
        // $limit = '';
        // $order_by = '';
        // $res['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        // $data['totaltask'] = $this->User_model->total_task_count($userID);
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('intern-profile');
        $this->load->view('temp/footer');
    }
    public function edit_profile()
    {
        // $CI = &get_instance();
        // $userID = $this->session->userdata('userID');
        // $data['totaltask'] = $this->User_model->total_task_count($userID);
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('firstName', 'lastName', 'mobile', 'email'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'userID' => $userID
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('dateOfBirth', 'correspontenceAddress', 'heard_us', 'gender', 'staff_member', 'nationalityID', 'bloodGroupID', 'educationID', 'occupationID', 'stateID', 'cityID', 'permanentState', 'permanentCity', 'permanentAddress', 'govt_name', 'time_duration', 'ref1_name', 'ref1_relation', 'ref1_contact', 'ref1_email', 'ref1_address', 'ref2_name', 'ref2_relation', 'ref2_contact', 'ref2_email', 'ref2_address', 'profile', 'policy_status', 'linkedin', 'twitter', 'dioceses', 'dioceses_id', 'govt_type'),
        //         'joinWith' => array('userID', 'dioceses_id', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'dioceses',
        //         'fields' => array('name', 'dioceses_id'),
        //         'joinWith' => array('dioceses_id', 'left'),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'position',
        //         'fields' => array('positionName'),
        //         'joinWith' => array('positionID', 'left'),
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
        //         'table' => 'occupation',
        //         'fields' => array('occupationName'),
        //         'joinWith' => array('occupationID', 'left'),
        //     ),
        // );
        // $where = array();
        // $limit = '';
        // $order_by = '';
        // $res['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        // $fields2 = array(
        //     'areaOfExpertiesID',
        // );
        // $where2 = array('userID' => $userID);
        // $limit2 = '';
        //$order_by = array('userID','DESC');
        // $order_by2 = "";
        // $res['user_area_of_experties'] = $this->Curl_model->fetch_data_in_many_array('user_area_of_experties', $fields2, $where2, $limit2, $order_by2);
        // $fields2 = array(
        //     'voluntaryServiceID',
        // );
        // $where2 = array('userID' => $userID);
        // $limit2 = '';
        //$order_by = array('userID','DESC');
        // $order_by2 = "";
        // $res['user_voluntary_service'] = $this->Curl_model->fetch_data_in_many_array('user_voluntary_service', $fields2, $where2, $limit2, $order_by2);
        // $fields2 = array(
        //     'serviceAreaID',
        // );
        // $where2 = array('userID' => $userID);
        // $limit2 = '';
        //$order_by = array('userID','DESC');
        // $order_by2 = "";
        // $res['user_service_area'] = $this->Curl_model->fetch_data_in_many_array('user_service_area', $fields2, $where2, $limit2, $order_by2);
        // $fields2 = array(
        //     'languageID',
        // );
        // $where2 = array('userID' => $userID);
        // $limit2 = '';
        //$order_by = array('userID','DESC');
        // $order_by2 = "";
        // $res['user_language'] = $this->Curl_model->fetch_data_in_many_array('user_language', $fields2, $where2, $limit2, $order_by2);
        // $fields2 = array(
        //     'bloodGroupID',
        //     'bloodGroupName',
        // );
        // $where2 = array('status' => 1);
        // $limit2 = '';
        //$order_by = array('userID','DESC');
        // $order_by2 = "";
        // $res['bloodGroup'] = $this->Curl_model->fetch_data_in_many_array('blood_group', $fields2, $where2, $limit2, $order_by2);
        // $fields3 = array(
        //     'educationID',
        //     'educationName',
        // );
        // $where3 = array('status' => 1);
        // $limit3 = '';
        //$order_by = array('userID','DESC');
        // $order_by3 = "";
        // $res['education'] = $this->Curl_model->fetch_data_in_many_array('education', $fields3, $where3, $limit3, $order_by3);
        // $fields3 = array(
        //     'languageID',
        //     'languageName',
        // );
        // $where3 = array('status' => 1);
        // $limit3 = '';
        //$order_by = array('userID','DESC');
        // $order_by3 = "";
        // $res['language'] = $this->Curl_model->fetch_data_in_many_array('language', $fields3, $where3, $limit3, $order_by3);
        // $fields3 = array(
        //     'nationalityID',
        //     'nationalityName',
        // );
        // $where3 = array('status' => 1);
        // $limit3 = '';
        //$order_by = array('userID','DESC');
        // $order_by3 = "";
        // $res['nationality'] = $this->Curl_model->fetch_data_in_many_array('nationality', $fields3, $where3, $limit3, $order_by3);
        // $fields3 = array(
        //     'serviceAreaID',
        //     'serviceAreaName',
        // );
        // $where3 = array('status' => 1);
        // $limit3 = '';
        //$order_by = array('userID','DESC');
        // $order_by3 = "";
        // $res['service_area'] = $this->Curl_model->fetch_data_in_many_array('service_area', $fields3, $where3, $limit3, $order_by3);
        // $fields3 = array(
        //     'occupationID',
        //     'occupationName',
        // );
        // $where3 = array('status' => 1);
        // $limit3 = '';
        //$order_by = array('userID','DESC');
        // $order_by3 = "";
        // $res['occupation'] = $this->Curl_model->fetch_data_in_many_array('occupation', $fields3, $where3, $limit3, $order_by3);
        // $fields3 = array(
        //     'voluntaryServiceID',
        //     'voluntaryServiceName',
        // );
        // $where3 = array('status' => 1);
        // $limit3 = '';
        //$order_by = array('userID','DESC');
        // $order_by3 = "";
        // $res['voluntary_service'] = $this->Curl_model->fetch_data_in_many_array('voluntary_service', $fields3, $where3, $limit3, $order_by3);
        // $fields3 = array(
        //     'areaOfExpertiesID',
        //     'areaOfExpertiesName',
        // );
        // $where3 = array('status' => 1);
        // $limit3 = '';
        //$order_by = array('userID','DESC');
        // $order_by3 = "";
        // $res['area_of_experties'] = $this->Curl_model->fetch_data_in_many_array('area_of_experties', $fields3, $where3, $limit3, $order_by3);
        // $fields3 = array(
        //     'stateID',
        //     'stateName',
        // );
        // $where3 = '';
        // $limit3 = '';
        //$order_by = array('userID','DESC');
        // $order_by3 = "";
        // $res['states'] = $this->Curl_model->fetch_data_in_many_array('states', $fields3, $where3, $limit3, $order_by3);
        // $fields3 = array(
        //     'cityID',
        //     'cityName',
        // );
        // $where3 = '';
        // $limit3 = '';
        //$order_by = array('userID','DESC');
        // $order_by3 = "";
        // $res['cities'] = [];
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('user-form');
        $this->load->view('temp/footer');
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
        // $mail->IsSMTP();
        $mail->Host = 'office365.caritasindia.org';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "volunteer@caritasindia.org";
        $mail->Password = "volunteer@123";
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
                                                    Email - volunteer@caritasindia.org</a>
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
                                                    Email - volunteer@caritasindia.org</a>
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

    public function referal_link()
    {
        $CI = &get_instance();
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
        $this->load->view('referal_link', $data);
        $this->load->view('temp/footer');
    }


    public function consultant_register()
    {
        try {
            $this->load->view('consultant-register');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function self_task_daily_report()
    {
        // $CI = &get_instance();
        // $userID = $this->session->userdata('userID');
        // $data['totaltask'] = $this->User_model->total_task_count($userID);
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('firstName', 'lastName'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'userID' => $userID
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('profile', 'dioceses_id'),
        //         'joinWith' => array('userID', 'dioceses_id', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'dioceses',
        //         'fields' => array('name', 'dioceses_id'),
        //         'joinWith' => array('dioceses_id', 'left'),
        //     ),
        // );
        // $where = array();
        // $limit = '';
        // $order_by = '';
        // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        // $this->load->view('temp/head');
        // $this->load->view('temp/header', $data);
        // $this->load->view('temp/sidebar', $data);

        //if (!empty($this->input->post('submit')) && $this->input->post('submit') == 'submit') {
        //print_r($this->input->post());
        // $rules_array = array(
        //     array(
        //         'field' => 'tasktitle',
        //         'label' => 'Task',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Task.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'location',
        //         'label' => 'Location',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Location.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'birthday1',
        //         'label' => 'Date',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Select Date.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'improved_msg',
        //         'label' => 'Improved Message',
        //         'rules' => 'trim',
        //     ),
        //     array(
        //         'field' => 'dailyActivity',
        //         'label' => 'Activity',
        //         'rules' => 'trim|required|max_length[150]',
        //         'errors' => array(
        //             'required' => 'Please Enter Activity',
        //             'max_length' => 'Please Enter Activity less then and equal to 300 character',
        //         ),
        //     ),
        //     array(
        //         'field' => 'dailyReportTimeIn',
        //         'label' => 'TimeIn',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Time In.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'dailyReportTimeIn1',
        //         'label' => 'TimeIn',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Time In.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'dailyReportTimeOut',
        //         'label' => 'Time Out',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Time Out.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'dailyReportTimeOut1',
        //         'label' => 'Time Out',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Time Out.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'challeges_face',
        //         'label' => 'Challenges Faced',
        //         'rules' => 'trim|max_length[300]',

        //     ),
        //     array(
        //         'field' => 'experience_any',
        //         'label' => 'Experience Sharing For Task?',
        //         'rules' => 'trim',

        //     ),
        // );

        // $this->form_validation->set_rules($rules_array);
        // if ($this->form_validation->run()) {
        //print_r($this->input->post());
        // $attachmentTypeIDs = $this->input->post('attachmentTypeID');
        // $tasktitle = $this->input->post('tasktitle');
        // $location = $this->input->post('location');
        // $date = $this->input->post('birthday1');
        // $dailyIn = $this->input->post('dailyReportTimeIn');
        // $dailyIn1 = $this->input->post('dailyReportTimeIn1');
        // $dailyOut = $this->input->post('dailyReportTimeOut');
        // $dailyOut1 = $this->input->post('dailyReportTimeOut1');
        // $dailyActivity = $this->input->post('dailyActivity');
        // $improved_msg = $this->input->post('improved_msg');
        // $challeges_face = $this->input->post('challeges_face');
        // $experience_any = $this->input->post('experience_any');
        //$taskID=1;
        // $data = array(
        //     'task_title' => $tasktitle,
        //     'location' => $location,
        //     'userID' => $userID,
        //     'dailyReportDate' => date('Y-m-d', strtotime($date)),
        //     'dailyReportTimeIn' => $dailyIn . ':' . $dailyIn1,
        //     'dailyReportTimeOut' => $dailyOut . ':' . $dailyOut1,
        //     'dailyReportActivity' => $dailyActivity,
        //     'improved_msg' => $improved_msg,
        //     'challeges_face' => $challeges_face,
        //     'experience_any' => $experience_any,
        //     'status' => 1,
        //     'dailyReportCreationDate' => date('y-m-d'),
        // );
        // print_r($attachmentTypeIDs);
        // die();
        // $dailyReportID = $this->Curl_model->insert_data('self_task_daily_report', $data);

        // $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
        // $taskTitle = $dailyReportID['task_title'];
        // $email = $user_data['email'];
        // $href = base_url() . 'login';
        //$href2 = base_url().'verify/'.md5($results);
        // $to = $email;
        // $from = 'volunteer@caritasindia.org';
        // $msg = 'Caritas India Volunteer';
        // $msg2 = "
        //     <center><p><strong style='font-weight:bold;'>Thanks for giving daily report. Your daily report details is given below.</strong></p></center>
        //     <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . ucwords($taskTitle) . "</td>
        //         </tr>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Time In</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $dailyIn . ':' . $dailyIn1 . "</td>
        //         </tr>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Time Out</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $dailyOut . ':' . $dailyOut1 . "</td>
        //         </tr>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Activity</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $dailyActivity . "</td>
        //         </tr>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Date</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . date('d/m/Y') . "</td>
        //         </tr>
        //     </table>";
        //die();
        //         $subj = "Assigned Task reminder from Caritas India";
        //         $btn = "Check Daily Report Now!";
        //         $html = $this->request_email($msg, $msg2, $href, $btn);
        //         $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

        //         $this->session->set_flashdata('data_message', 'Successfully Submitted!');
        //         echo '<script>window.location.href = "' . base_url() . 'self-task-daily-report"</script>';
        //         exit();
        //     }
        // }
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('self-task-daily-report');
        $this->load->view('temp/footer');
    }
    public function intern_self_task_daily_report()
    {
        // $CI = &get_instance();
        // $userID = $this->session->userdata('userID');
        // $data['totaltask'] = $this->User_model->total_task_count($userID);
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('firstName', 'lastName'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'userID' => $userID
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('profile', 'dioceses_id'),
        //         'joinWith' => array('userID', 'dioceses_id', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'dioceses',
        //         'fields' => array('name', 'dioceses_id'),
        //         'joinWith' => array('dioceses_id', 'left'),
        //     ),
        // );
        // $where = array();
        // $limit = '';
        // $order_by = '';
        // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        // $this->load->view('temp/head');
        // $this->load->view('temp/header', $data);
        // $this->load->view('temp/sidebar', $data);

        //if (!empty($this->input->post('submit')) && $this->input->post('submit') == 'submit') {
        //print_r($this->input->post());
        // $rules_array = array(
        //     array(
        //         'field' => 'tasktitle',
        //         'label' => 'Task',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Task.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'location',
        //         'label' => 'Location',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Location.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'birthday1',
        //         'label' => 'Date',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Select Date.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'improved_msg',
        //         'label' => 'Improved Message',
        //         'rules' => 'trim',
        //     ),
        //     array(
        //         'field' => 'dailyActivity',
        //         'label' => 'Activity',
        //         'rules' => 'trim|required|max_length[150]',
        //         'errors' => array(
        //             'required' => 'Please Enter Activity',
        //             'max_length' => 'Please Enter Activity less then and equal to 300 character',
        //         ),
        //     ),
        //     array(
        //         'field' => 'dailyReportTimeIn',
        //         'label' => 'TimeIn',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Time In.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'dailyReportTimeIn1',
        //         'label' => 'TimeIn',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Time In.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'dailyReportTimeOut',
        //         'label' => 'Time Out',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Time Out.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'dailyReportTimeOut1',
        //         'label' => 'Time Out',
        //         'rules' => 'trim|required',
        //         'errors' => array(
        //             'required' => 'Please Enter Time Out.',
        //         ),
        //     ),
        //     array(
        //         'field' => 'challeges_face',
        //         'label' => 'Challenges Faced',
        //         'rules' => 'trim|max_length[300]',

        //     ),
        //     array(
        //         'field' => 'experience_any',
        //         'label' => 'Experience Sharing For Task?',
        //         'rules' => 'trim',

        //     ),
        // );

        // $this->form_validation->set_rules($rules_array);
        // if ($this->form_validation->run()) {
        //print_r($this->input->post());
        // $attachmentTypeIDs = $this->input->post('attachmentTypeID');
        // $tasktitle = $this->input->post('tasktitle');
        // $location = $this->input->post('location');
        // $date = $this->input->post('birthday1');
        // $dailyIn = $this->input->post('dailyReportTimeIn');
        // $dailyIn1 = $this->input->post('dailyReportTimeIn1');
        // $dailyOut = $this->input->post('dailyReportTimeOut');
        // $dailyOut1 = $this->input->post('dailyReportTimeOut1');
        // $dailyActivity = $this->input->post('dailyActivity');
        // $improved_msg = $this->input->post('improved_msg');
        // $challeges_face = $this->input->post('challeges_face');
        // $experience_any = $this->input->post('experience_any');
        //$taskID=1;
        // $data = array(
        //     'task_title' => $tasktitle,
        //     'location' => $location,
        //     'userID' => $userID,
        //     'dailyReportDate' => date('Y-m-d', strtotime($date)),
        //     'dailyReportTimeIn' => $dailyIn . ':' . $dailyIn1,
        //     'dailyReportTimeOut' => $dailyOut . ':' . $dailyOut1,
        //     'dailyReportActivity' => $dailyActivity,
        //     'improved_msg' => $improved_msg,
        //     'challeges_face' => $challeges_face,
        //     'experience_any' => $experience_any,
        //     'status' => 1,
        //     'dailyReportCreationDate' => date('y-m-d'),
        // );
        // print_r($attachmentTypeIDs);
        // die();
        // $dailyReportID = $this->Curl_model->insert_data('self_task_daily_report', $data);

        // $user_data = $this->Curl_model->fetch_data('users', array('email'), array('userID' => $userID), '', '');
        // $taskTitle = $dailyReportID['task_title'];
        // $email = $user_data['email'];
        // $href = base_url() . 'login';
        //$href2 = base_url().'verify/'.md5($results);
        // $to = $email;
        // $from = 'volunteer@caritasindia.org';
        // $msg = 'Caritas India Volunteer';
        // $msg2 = "
        //     <center><p><strong style='font-weight:bold;'>Thanks for giving daily report. Your daily report details is given below.</strong></p></center>
        //     <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Title</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . ucwords($taskTitle) . "</td>
        //         </tr>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Time In</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $dailyIn . ':' . $dailyIn1 . "</td>
        //         </tr>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Time Out</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $dailyOut . ':' . $dailyOut1 . "</td>
        //         </tr>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Activity</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $dailyActivity . "</td>
        //         </tr>
        //         <tr>
        //             <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Date</th>
        //             <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . date('d/m/Y') . "</td>
        //         </tr>
        //     </table>";
        //die();
        //         $subj = "Assigned Task reminder from Caritas India";
        //         $btn = "Check Daily Report Now!";
        //         $html = $this->request_email($msg, $msg2, $href, $btn);
        //         $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);

        //         $this->session->set_flashdata('data_message', 'Successfully Submitted!');
        //         echo '<script>window.location.href = "' . base_url() . 'self-task-daily-report"</script>';
        //         exit();
        //     }
        // }
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('intern-self-task-daily-report');
        $this->load->view('temp/footer');
    }

    public function self_task_view_daily_report()
    {
        // $userID = $this->session->userdata('userID');
        // $where1['userID'] = $userID;
        // $data['totaltask'] = $this->User_model->total_task_count($userID);
        // $join_data = array(
        //     array(
        //         'table' => 'self_task_daily_report',
        //         'fields' => array('vself_task_id', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity', 'dailyReportCreationDate'),

        //         'where' => $where1,
        //         'order_by' => array('vself_task_id', 'desc'),
        //     ),

        // );

        // $limit = '';
        // $order_by = array('vself_task_id', 'DESC');
        // $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        // $data['totaltask'] = $this->User_model->total_task_count($userID);
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('firstName', 'lastName'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'userID' => $userID
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('profile', 'dioceses_id'),
        //         'joinWith' => array('userID', 'dioceses_id', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'dioceses',
        //         'fields' => array('name', 'dioceses_id'),
        //         'joinWith' => array('dioceses_id', 'left'),
        //     ),
        // );
        // $where = array();
        // $limit = '';
        // $order_by = '';
        // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('self-task-view-report');
        $this->load->view('temp/footer');
    }
    public function intern_self_task_view_daily_report()
    {
        // $userID = $this->session->userdata('userID');
        // $where1['userID'] = $userID;
        // $data['totaltask'] = $this->User_model->total_task_count($userID);
        // $join_data = array(
        //     array(
        //         'table' => 'self_task_daily_report',
        //         'fields' => array('vself_task_id', 'dailyReportTimeIn', 'dailyReportTimeOut', 'dailyReportActivity', 'dailyReportCreationDate'),

        //         'where' => $where1,
        //         'order_by' => array('vself_task_id', 'desc'),
        //     ),

        // );

        // $limit = '';
        // $order_by = array('vself_task_id', 'DESC');
        // $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        // $data['totaltask'] = $this->User_model->total_task_count($userID);
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('firstName', 'lastName'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'userID' => $userID
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('profile', 'dioceses_id'),
        //         'joinWith' => array('userID', 'dioceses_id', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'dioceses',
        //         'fields' => array('name', 'dioceses_id'),
        //         'joinWith' => array('dioceses_id', 'left'),
        //     ),
        // );
        // $where = array();
        // $limit = '';
        // $order_by = '';
        // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('intern-self-task-view-daily-report');
        $this->load->view('temp/footer');
    }

    public function donation_report()
    {
        $CI = &get_instance();
        $userID = $this->session->userdata('userID');
        $data['totaltask'] = $this->User_model->total_task_count($userID);
        $where1['volunteer_id'] = $userID;
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

        $join_data = array(
            array(
                'table' => 'vol_donation_data',
                'fields' => array('vol_donation_data_id', 'first_name', 'mobile', 'email', 'my_donation', 'amount', 'status'),
                'where' => $where1,
                'order_by' => array('vol_donation_data_id', 'desc'),
            ),

        );

        $limit = '';
        $order_by = array('vol_donation_data_id', 'DESC');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        //print_r($data['report']); exit;

        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('donation_report', $data);
        $this->load->view('temp/footer');
    }
    public function certificate()
    {
        // $CI = &get_instance();
        // $userID = $this->session->userdata('userID');
        // $data['totaltask'] = $this->User_model->total_task_count($userID);
        // $where1['volunteer_id'] = $userID;
        // $join_data = array(
        //     array(
        //         'table' => 'users',
        //         'fields' => array('firstName', 'lastName'),
        //         'joinWith' => array('userID'),
        //         'where' => array(
        //             'userID' => $userID
        //         ),
        //     ),
        //     array(
        //         'joined' => 0,
        //         'table' => 'user_data',
        //         'fields' => array('profile', 'dioceses_id'),
        //         'joinWith' => array('userID', 'dioceses_id', 'left'),
        //     ),
        //     array(
        //         'joined' => 1,
        //         'table' => 'dioceses',
        //         'fields' => array('name', 'dioceses_id'),
        //         'joinWith' => array('dioceses_id', 'left'),
        //     ),
        // );
        // $where = array();
        // $limit = '';
        // $order_by = '';
        // $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        // $join_data = array(
        //     array(
        //         'table' => 'vol_donation_data',
        //         'fields' => array('vol_donation_data_id', 'first_name', 'mobile', 'email', 'my_donation', 'amount', 'status'),
        //         'where' => $where1,
        //         'order_by' => array('vol_donation_data_id', 'desc'),
        //     ),

        // );

        // $limit = '';
        // $order_by = array('vol_donation_data_id', 'DESC');
        // $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);

        //print_r($data['report']); exit;

        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('certificate');
        $this->load->view('temp/footer');
    }

    public function intern_transfer_form()
    {
		if($this->session->userdata('intern_id')!="" || $this->session->userdata('intern_id')!=null){
            $state_id = $this->session->userdata('state_id');
            $intern_id = $this->session->userdata('intern_id');
            $data['totaltask']=$this->Intern_model->total_task_count($intern_id);
           
            $join_data = array(
                array(
                    'table' => 'interntask',
                    'fields' => array('intern_task_id', 'task_title', 'creation_date'),
                    'joinWith' => array('intern_task_id'),
                    'group_by' => array('intern_task_id'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'intern_assigning_task',
                    'fields' => array('intern_task_id', 'status'),
                    'joinWith' => array('intern_task_id', 'left'),
                    'where' => array('intern_id' => $intern_id,),
                    'order_by' => array('intern_task_id', 'desc'),
                ),
            );
            $limit = 5;
            $order_by = '';
            $data['interntask'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
       //    echo "<pre>";
       //      print_r($data['interntask'] );exit;
            $join_data = array(
                array(
                    'table' => 'interntask',
                    'fields' => array('intern_task_id', 'task_title'),
                    'joinWith' => array('intern_task_id'),
                    'group_by' => array('intern_task_id'),
                ),
                array(
                    'joined' => 0,
                    'table' => 'intern_daily_report',
                    'fields' => array('intern_dr_id', 'dr_time_in', 'dr_time_out', 'dr_activity', 'dr_create_date'),
                    'joinWith' => array('intern_task_id', 'left'),
                    'where' => array('intern_id' => $intern_id, 'status' => 0, 'status' => 1,),
                    'order_by' => array(
                        'intern_dr_id', 'DESC'
                    ),
                ),
            );
   
            $limit = '5';
            $order_by = array('intern_dr_id', 'DESC');
            $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                // echo '<pre>'.$data['report']. '</pre>'; exit();
           //          echo "<pre>";
           //  print_r($data['report'] );exit;
            
              $join_data = array(
                array(
                    'table' => 'intern_assigning_task',
                    'fields' => array('intern_task_id'),
                    'where' => array(
                        'intern_id' => $intern_id,
                         'status' => 0,
                    ),
                ),
               );
                $limit = '';
                $order_by = '';
                $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                foreach ($task as $key => $value) {
                    $taskIDs[$key] = $value['intern_task_id'];
                }
   
                $join_data = array(
                    array(
                        'table' => 'interntask',
                        'fields' => array('intern_task_id', 'task_title', 'task_description', 'creation_date', 'status','region_id','task_state_id','task_type_id','task_brief'),
                        'joinWith' => array('intern_task_id','task_type_id', 'region_id'),
                        'where' => array(
                            //'task_state_id' => $state_id,
                            'status' => 1,
                            'task_status' => 0,
                            'task_for' => 2,
                            'task_type_id' => 1,
                            
                        ),
                        'order_by' => array(
                            'intern_task_id', 'DESC'
                        ),
                      'where_not_in' => array('intern_task_id' => $taskIDs)
                   ),
                       array(
                           'joined'=>0,
                           'table'=>'regions',
                           'fields'=>array('region_name'),
                           'joinWith'=>array('region_id','left'),
                       ),
                       array(
                           'joined'=>0,
                           'table'=>'task_type',
                           'fields'=>array('task_type'),
                           'joinWith'=>array('task_type_id','left'),
                       ),
                   );
   
                $limit = '';
   
                $order_by = '';
   
               $data['find_task'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
               // echo '<pre>';
               // print_r ($data['find_task']);exit;
               
               $join_data = array(
                array(
                    'table' => 'intern_assigning_task',
                    'fields' => array('intern_task_id'),
                    'where' => array(
                        'intern_id' => $intern_id,
                    ),
                ),
               );
                $limit = '';
                $order_by = '';
                $task = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                foreach ($intern_task_id as $key => $value) {
                    $taskIDs[$key] = $value['intern_task_id'];
                }
   
                $join_data = array(
                    array(
                        'table' => 'interntask',
                        'fields' => array('intern_task_id', 'task_title', 'task_description', 'creation_date', 'status','region_id','task_state_id','task_type_id','task_brief'),
                        'joinWith' => array('intern_task_id','task_type_id', 'region_id'),
                        'where' => array(
                            'task_state_id' => $state_id,
                            'status' => 1,
                            'task_status' => 0,
                            'task_for' => 2,
                            'task_type_id' =>2,
                            
                        ),
                        'order_by' => array(
                            'intern_task_id', 'DESC'
                        ),
                      'where_not_in' => array('intern_task_id' => $taskIDs)
                   ),
                       array(
                           'joined'=>0,
                           'table'=>'regions',
                           'fields'=>array('region_name'),
                           'joinWith'=>array('region_id','left'),
                       ),
                       array(
                           'joined'=>0,
                           'table'=>'task_type',
                           'fields'=>array('task_type'),
                           'joinWith'=>array('task_type_id','left'),
                       ),
                   );
   
                $limit = '';
   
                $order_by = '';
   
               $data['find_task_offline'] = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
           //   echo "<pre>";
           //   print_r($data['find_task_offline']);exit;
            $join_data = array(
               array(
                   'table'=>'interns',
                   'fields'=>array('first_name','last_name', 'state_id', 'mobile'),
                   'joinWith'=>array('intern_id'),
                   'where'=>array(
                       'intern_id'=>$intern_id
                   ),
               ),
               array(
                   'joined'=>0,
                   'table'=>'interns_data',
                   'fields'=>array('occupation'),
                   'joinWith'=>array('intern_id','left'),
               ),
               array(
                   'joined'=>0,
                   'table'=>'states',
                   'fields'=>array('region_id','state_name'),
                   'joinWith'=>array('state_id','left'),
               ),
               array(
                   'joined'=>2,
                   'table'=>'regions',
                   'fields'=>array('region_name'),
                   'joinWith'=>array('region_id','left'),
               ),
           );
           $where = array();
           $limit = '';
           $order_by ='';
           $data['internDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
             //   echo "<pre>";
           //   print_r($data['find_task_offline']);exit
           $data['state']=$this->Curl_model->fetch_all_data("state_id,state_name",'states','status=1');
        $this->load->view('temp/head');
        $this->load->view('temp/header',$data);
        $this->load->view('temp/sidebar');
        $this->load->view('intern-transfer-form',$data);
        $this->load->view('temp/footer');
		}else{					
			echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
		 }	
    }

    public function insert_intern_transfer()
    {
        
        try {
            
            if($this->session->userdata('intern_id')!="" || $this->session->userdata('intern_id')!=null){
             $intern_id = $this->session->userdata('intern_id');

            $data = array(
                'intern_id' => $intern_id,
                'current_state' => $this->input->post('current_State'),
                'relocate_state' => $this->input->post('relocate_state'),
                'relocate_city' => $this->input->post('relocate_city'),
                'relocate_reason' => $this->input->post('relocate_reason'),
                'creation_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            // echo $data;exit;
            
            $results=$this->Curl_model->insert_data('intern_transfer',$data);

            // echo "<pre>";
            // print_r( $results);exit;

            //$this->session->set_flashdata('volunteer_transfer_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Relocated  successfully.</div>');
            redirect(base_url() . 'intern-transfer-form');
        }else{					
			echo '<script>window.location.href = "' . base_url() . 'intern-login"</script>';
		 }	
        
        } 	catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
    function transfer_city()
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
}
