<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    function __construct()
    {
		error_reporting(0);
        parent :: __construct();
        if($this->session->userdata('userID'))
        {
            if($this->session->userdata('roleID')==2)
            {
                 
            }
            else
            {
                redirect('admin-dashboard');
            }
        }
        else{
            redirect('login');
        }
        $CI =& get_instance();
        $CI->load->library('Get_library');
        $this->load->model('curl/Curl_model');
		$this->load->model('User_model');
        //$this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');

    }
    public function dashboard()
	{
        $CI =& get_instance();
		$userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		//$data['timetask']= $this->User_model->timein_calculate($userID);
		//$data['timeouttask']= $this->User_model->timeout_calculate($userID);
		$join_data = array(
			 array(
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut'),
                'joinWith'=>array('approveddaily_ID','left'),
				'where'=>array('userID'=>$userID,
								'approveddaily_ID !'=>0,),
				'group_by'=>array('approveddaily_ID'),
            ),
            array(
				'joined'=>0,
                'table'=>'task',
                'fields'=>array('taskID'),
                'joinWith'=>array('taskID'),
            ),
           
		  array(
                'joined'=>0,
                'table'=>'approveddaily_report',
                'fields'=>array('admin_time'),
				//'function'=>array('SUM','admin_time'),
                'joinWith'=>array('approveddaily_ID','left'),
            ),			
        );
        
        $limit = '';
        $order_by ='';
        $data['reporttotal'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$data['countfield']= $this->User_model->column_count($userID);
		$data['totalfield']= $this->User_model->total_field_count($userID);
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle','taskPublishedDate'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('taskID','status'),
                'joinWith'=>array('taskID','left'),
				'where'=>array('userID'=>$userID, ),
				'order_by'=>array('taskID','desc'),
            ),       
        );
        
        $limit = 5;
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportDate','dailyReportActivity'),
                'joinWith'=>array('taskID','left'),
				'where'=>array('userID'=>$userID),
				'order_by'=>array(
                    'dailyReportID','DESC'
                ),
            ),       
        );
        
        $limit = '5';
        $order_by =array('dailyReportID', 'DESC');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('index', $data);
        $this->load->view('temp/footer');
    }
	public function dashboard111()
	{
        $CI =& get_instance();
		$userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		//$data['timetask']= $this->User_model->timein_calculate($userID);
		//$data['timeouttask']= $this->User_model->timeout_calculate($userID);
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportActivity'),
                'joinWith'=>array('taskID','left'),
				'where'=>array('userID'=>$userID),
				'order_by' =>array('dailyReportID','desc'),
            ),       
        );
        
        $limit = '';
        $order_by =array('dailyReportID', 'DESC');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$data['countfield']= $this->User_model->column_count($userID);
		$data['totalfield']= $this->User_model->total_field_count($userID);
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle','taskPublishedDate'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('taskID','status'),
                'joinWith'=>array('taskID','left'),
				'where'=>array('userID'=>$userID, ),
				'order_by'=>array('taskID','desc'),
            ),       
        );
        
        $limit = 5;
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportDate','dailyReportActivity'),
                'joinWith'=>array('taskID','left'),
				'where'=>array('userID'=>$userID),
            ),       
        );
        
        $limit = '5';
        $order_by =array('dailyReportID', 'DESC');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('index', $data);
        $this->load->view('temp/footer');
    }
	public function dashboard_task_accept()
    {
		$userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'taskID'=>$taskID,
			'userID'=>$userID,
        );
        $fields = array(
            'status'=>1,
			'accepted_date'=>date('y-m-d'),
        );
        $results = $this->Curl_model->update_data('assigning_task',$fields,$where);
        if($results)
        {
            $this->session->set_userdata('task_accept','true');
			echo '<script>window.location.href = "'.base_url().'dashboard"</script>';
        }
    }
	public function dashboard_task_reject()
    {
		$userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'taskID'=>$taskID,
			'userID'=>$userID,
        );
        $fields = array(
            'status'=>2,
			'rejected_date'=>date('y-m-d'),
			'rejected_reason'=>'test',
        );
        $results = $this->Curl_model->update_data('assigning_task',$fields,$where);
        if($results)
        {
            $this->session->set_userdata('task_reject','true');
			echo '<script>window.location.href = "'.base_url().'dashboard"</script>';
        }
    }
	
    public function task()
	{
		if(($this->session->userdata('userID')!="")){
		$data['causes']=$this->Curl_model->fetch_all_data("causesID,causesName",'causes','status=1');
		
		$userID = $this->session->userdata('userID');
		
        $join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle','taskBrief','taskPublishedDate','taskStatus','taskDescription','volunteers'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('taskID','status'),
                'joinWith'=>array('taskID','left'),
				'where'=>array('userID'=>$userID),
				'order_by'=>array('assigningTaskID','desc'),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$data['totaltask']= $this->User_model->total_task_count($userID);
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar',$data);
        $this->load->view('task-list', $data);
        $this->load->view('temp/footer');
		}
	   else{ 
			echo '<script>window.location.href = "'.base_url().'login"</script>';
		   //redirect(base_url().'login','refresh');
		   }
    }
	public function task_accept()
    {
		$userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'taskID'=>$taskID,
			'userID'=>$userID,
        );
        $fields = array(
            'status'=>1,
			'accepted_date'=>date('y-m-d'),
        );
        $results = $this->Curl_model->update_data('assigning_task',$fields,$where);
        if($results)
        {
            $this->session->set_userdata('task_accept','true');
			echo '<script>window.location.href = "'.base_url().'task"</script>';
            //redirect('task');
        }
    }
	
	
	public function task_reject()
    {
		$userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'taskID'=>$taskID,
			'userID'=>$userID,
        );
        $fields = array(
            'status'=>2,
			'rejected_date'=>date('y-m-d'),
			'rejected_reason'=>'test',
        );
        $results = $this->Curl_model->update_data('assigning_task',$fields,$where);
        if($results)
        {
            $this->session->set_userdata('task_reject','true');
			echo '<script>window.location.href = "'.base_url().'task"</script>';
            //redirect('task');
        }
    }
	
	public function filter_my_task(){
		if(($this->session->userdata('userID')!="")){
            $data['cause']='';
            $data['datefilter']='';
            $data['status']='';
			$userID = $this->session->userdata('userID');
			$data['totaltask']= $this->User_model->total_task_count($userID);
			if($this->input->get('cause')!=''  && $this->input->get('datefilter')!='' && $this->input->get('status')!=''){
				$cause=$this->input->get('cause');
				$datefilter=$this->input->get('datefilter');
				$datefilter = explode("-", $datefilter);
				 $first_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[0])));
			     $second_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[1])));
				$status=$this->input->get('status');
				$where_task="FIND_IN_SET('$cause', u.causesID) and ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$userID', ta.userID)";
				$data['cause']=$cause;
				$data['datefilter']=$this->input->get('datefilter');
				$data['status']=$status;
			}			
			else if($this->input->get('cause')!=''  && $this->input->get('datefilter')!=''){
				$cause=$this->input->get('cause');
				$datefilter=$this->input->get('datefilter');
				$datefilter = explode("-", $datefilter);
				 $first_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[0])));
			     $second_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[1])));
				$where_task="FIND_IN_SET('$cause', u.causesID) and ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
				$data['cause']=$cause;
				$data['datefilter']=$this->input->get('datefilter');
			}
			else if($this->input->get('datefilter')!='' && $this->input->get('status')!=''){
				$datefilter=$this->input->get('datefilter');
				$status=$this->input->get('status');
				$where_task="FIND_IN_SET('$datefilter', ta.assignedDate)and FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$userID', ta.userID)";
				$data['datefilter']=$this->input->get('datefilter');
				$data['status']=$status;
			}
			else if($this->input->get('cause')!='' && $this->input->get('status')!=''){
				$cause=$this->input->get('cause');
				$status=$this->input->get('status');
				$where_task="FIND_IN_SET('$cause', u.causesID)and FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$userID', ta.userID)";
				$data['cause']=$cause;
				$data['status']=$status;
			}
			else if($this->input->get('cause')!=''){
				$cause=$this->input->get('cause');
				$where_task="FIND_IN_SET('$cause', u.causesID)and FIND_IN_SET('$userID', ta.userID)";
				$data['cause']=$cause;
			}
			else if($this->input->get('status')!=''){
				$status=$this->input->get('status');
				$where_task="FIND_IN_SET('$status', ta.status)and FIND_IN_SET('$userID', ta.userID)";
				$data['status']=$status;
			}
			else if($this->input->get('datefilter')!=''){
			     $datefilter=$this->input->get('datefilter');
				 $datefilter = explode("-", $datefilter);
				 $first_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[0])));
			     $second_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[1]))); //exit;
				 $where_task="ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
				 $data['datefilter']=$this->input->get('datefilter');
			
			}
			
			else{
				$userID = $this->session->userdata('userID');
				$where_task ="ta.userID=$userID"; 
			}
			$data["task"] = $this->User_model->fetch_my_task($where_task);
			$data['causes']=$this->Curl_model->fetch_all_data("causesID,causesName",'causes','status=1');
			
			$join_data = array(
				array(
					'table'=>'users',
					'fields'=>array('firstName','lastName'),
					'joinWith'=>array('userID'),
					'where'=>array(
						'userID'=>$userID
					),
				),
				array(
					'joined'=>0,
					'table'=>'user_data',
					'fields'=>array('profile'),
					'joinWith'=>array('userID','left'),
				),
			);
			$where = array();
			$limit = '';
			$order_by ='';
			$data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
			
			$this->load->view('temp/head');
			$this->load->view('temp/header', $data);
			$this->load->view('temp/sidebar',$data);
			$this->load->view('task-list', $data);
			$this->load->view('temp/footer');
			
		}
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		   }
	}
	
	
	public function view_task_details()
	{
		if(($this->session->userdata('userID')!="")){
        $v = $this->uri->segment(2);
        $data['encode_taskID'] = $v;
		$val=base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$where = "taskID = '$val'";
		$data['task'] = $this->Curl_model->fetch_single_data('*','task',$where);
		$join_data = array(
            array(
                'table'=>'attachment',
                'fields'=>array('attachmentName','attachmentSize','attachmentDate','userID','attachmentTypeID'),
                'joinWith'=>array('attachmentTypeID'),
                'where'=>array(
                    'status'=>1,
                    'taskID'=>$val
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'attachment_type',
                'fields'=>array('attachmentTypeName','attachmentFileType'),
                'joinWith'=>array('attachmentTypeID','left'),
            ),
            array(
                'joined'=>0,
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID','left'),
            ),
        );
        
        $limit = '';
        $order_by ='';
        $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$join_data = array(
            array(
                'table'=>'assigning_task',
                'fields'=>array('taskID','userID'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'status'=>1,
                    'taskID'=>$val
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'user_data',
                'fields'=>array('gender','profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $limit = '';
        $order_by ='';
        $data['valunteers'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
        $CI =& get_instance();
		$userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('view-task', $data);
        $this->load->view('temp/footer');
	  }
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		   //redirect(base_url().'login','refresh');
		   }
    }
	public function task_member()
	{
        $encode_taskID = $this->uri->segment(2);
        $res['encode_taskID'] = $encode_taskID;
        $taskID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $join_data = array(
            array(
                'table'=>'assigning_task',
                'fields'=>array('taskID','userID'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'status'=>1,
                    'taskID'=>$taskID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'users',
                'fields'=>array('firstName','lastName','mobile','email'),
                'joinWith'=>array('userID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'user_data',
                'fields'=>array('gender','profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $limit = '';
        $order_by ='';
        $res['valunteers'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        
        $CI =& get_instance();
		$userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        // echo "<pre>";
        // print_r($res);
        // die();
        $this->load->view('temp/head');
        $this->load->view('temp/header',$data);
        $this->load->view('temp/sidebar');
        $this->load->view('task-member',$res);
        $this->load->view('temp/footer');
    }
    public function add_daily_report()
	{
		$userID = $this->session->userdata('userID');
		//$data['report']=$this->Curl_model->fetch_all_data("dailyReportID,dailyReportTimeIn,dailyReportTimeOut,dailyReportActivity",'daily_report','status=1& userID='.$userID.' & (dailyReportCreationDate >= CURDATE())');
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportActivity'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID,
					'status'=>1,
					'dailyReportCreationDate'=>'CURDATE()'
                ),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$join_data = array(
            array(
                'table'=>'attachment',
                'fields'=>array('attachmentName','attachmentSize','attachmentDate','userID','attachmentTypeID'),
                'joinWith'=>array('attachmentTypeID'),
                'where'=>array(
                    'status'=>1,
                    'taskID'=>$taskID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'attachment_type',
                'fields'=>array('attachmentTypeName','attachmentFileType'),
                'joinWith'=>array('attachmentTypeID','left'),
            ),
            array(
                'joined'=>0,
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID','left'),
            ),
        );
        
        $limit = '';
        $order_by ='';
        $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('taskID'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID,
					'status'=>'1',
                ),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$fields = array(
            'attachmentTypeID',
            'attachmentTypeName',
            'attachmentFileType'
        );
        $where = array('status'=>1);
        $limit = '';
        $order_by = array('attachmentTypeID','ASC');
        $data['attachment_type'] = $this->Curl_model->fetch_data_in_many_array('attachment_type',$fields,$where,$limit,$order_by);
		$data['totaltask']= $this->User_model->total_task_count($userID);
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$fields = array(
            'attachmentTypeID',
            'attachmentTypeName',
            'attachmentFileType'
        );
        $where = array('status'=>1);
        $limit = '';
        $order_by = array('attachmentTypeID','ASC');
        $data['attachment_type'] = $this->Curl_model->fetch_data_in_many_array('attachment_type',$fields,$where,$limit,$order_by);
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
		if(!empty($this->input->post('submit')) && $this->input->post('submit')=='submit')
        {
            //print_r($this->input->post());
            $rules_array = array(
                array(
                        'field' => 'tasktitle',
                        'label' => 'Task',
                        'rules' => 'trim|required',
                        'errors' => array(
                            'required' => 'Please Select Task.',
                    ),
                ),
                array(
                    'field' => 'birthday1',
                    'label' => 'Date',
                    'rules' => 'trim|required|regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]',
                    'errors' => array(
                        'required' => 'Please Select Date.',
                    ),
                ),
                array(
                        'field' => 'improved_msg',
                        'label' => 'Improved Message',
                        'rules' => 'trim',
                ),
                array(
                        'field' => 'dailyActivity',
                        'label' => 'Activity',
                        'rules' => 'trim|required|max_length[150]',
                        'errors' => array(
                            'required' => 'Please Enter Activity',
							'max_length' => 'Please Enter Activity less then and equal to 300 character',
                    ),
                ),
                array(
                        'field' => 'dailyReportTimeIn',
                        'label' => 'TimeIn',
                        'rules' => 'trim|required|min_length[3]|max_length[5]|callback_validate_time',
                        'errors' => array(
                            'required' => 'Please Enter Time In.',
                        ),
                    ),
                    array(
                        'field' => 'dailyReportTimeOut',
                        'label' => 'Time Out',
                        'rules' => 'trim|required|min_length[3]|max_length[5]|callback_validate_time',
                        'errors' => array(
                            'required' => 'Please Enter Time Out.',
                        ),
                    ),
                    array(
                        'field' => 'challeges_face',
                        'label' => 'Challenges Faced',
                        'rules' => 'trim|max_length[300]',
                        
                    ),
                    array(
                        'field' => 'experrience_any',
                        'label' => 'Experience Sharing For Task?',
                        'rules' => 'trim',
                        
                    ),
                );
            
            $this->form_validation->set_rules($rules_array);
            if ($this->form_validation->run() == FALSE)
                {
                    //print_r($this->input->post());
                    $attachmentTypeIDs = $this->input->post('attachmentTypeID');
                    $tasktitle=$this->input->post('tasktitle');
					$date=$this->input->post('birthday1');
					$dailyIn=$this->input->post('dailyReportTimeIn');
					$dailyOut=$this->input->post('dailyReportTimeOut');
					$dailyActivity=$this->input->post('dailyActivity');
					$improved_msg=$this->input->post('improved_msg');
					$challeges_face=$this->input->post('challeges_face');
					$experrience_any=$this->input->post('experrience_any');
                    //$taskID=1;
                    $data = array(
                        'taskID'=>$tasktitle,
						'userID'=>$userID,
						'dailyReportDate'=>date('Y-m-d',strtotime($date)),
						'dailyReportTimeIn'=>$dailyIn,
						'dailyReportTimeOut'=>$dailyOut,
						'dailyReportActivity'=>$dailyActivity,
						'improved_msg'=>$improved_msg,
						'challeges_face'=>$challeges_face,
						'experrience_any'=>$experrience_any,
						'status'=>1,
                    );
                    //print_r($attachmentTypeIDs);
                    $dailyReportID = $this->Curl_model->insert_data('daily_report',$data);
                    foreach ($attachmentTypeIDs as $key => $value) {
					$fields = array(
						'attachmentTypeName',
					);
					$where = array(
						'status'=>1,
						'attachmentTypeID'=>$value
					);
					$limit = '';
					$order_by = array('attachmentTypeID','ASC');
					$results = $this->Curl_model->fetch_data('attachment_type',$fields,$where,$limit,$order_by);
					$name = $results['attachmentTypeName'];
					$tempfilename = $this->input->post('temp'.$name);
					$idfilename = $this->input->post('id'.$name);
					$sizefilename = $this->input->post('size'.$name);
					$filename = $_FILES[$name]['name'];
					$filesize = $_FILES[$name]['size'];
					 //print_r($imgname);
					 //print_r($filename);exit;
					foreach ($filename as $key1 => $value1) {
							if($value1!='')
							{ 
						     $fsize = ($filesize[$key1]/1024)/1024;
								if($idfilename[$key1]=='')
                                    {
                                        $data = array(
                                            'userID'=>$userID,
											'dailyReportID'=>$dailyReportID,
                                            'attachmentTypeID'=>$value,
                                            'attachmentName'=>$value1,
                                            'attachmentSize'=>$fsize,
											'attachmentDate'=>date('Y-m-d',strtotime($date)),
                                            'taskID'=>$tasktitle,
                                            'status'=>1,
                                        );
                                        //echo "11<br>";
                                        $results = $this->Curl_model->insert_data('attachment',$data);
                                    }
                                    else{
                                        //echo "12<br>";
                                        $where3 = array(
                                            'attachmentID'=>$idfilename[$key1]
                                        );
                                        $data = array(
                                            'userID'=>$userID,
											'dailyReportID'=>$dailyReportID,
                                            'attachmentID'=>$idfilename[$key1],
                                            'attachmentTypeID'=>$value,
                                            'attachmentName'=>$value1,
                                            'attachmentSize'=>$fsize,
											'attachmentDate'=>date('Y-m-d',strtotime($date)),
                                            'taskID'=>$tasktitle,
                                            'status'=>1,
                                        );
                                        $results = $this->Curl_model->insert_data('attachment',$data,$where3);
                                    }
								
                        }
						else
                                {
                                    //print_r($data);
                                    if($idfilename[$key1]!='')
                                    {
                                        $data = array(
                                            'userID'=>$userID,
                                            'attachmentID'=>$idfilename[$key1],
                                            'attachmentTypeID'=>$value,
                                            'attachmentName'=>$tempfilename[$key1],
                                            'attachmentSize'=>$sizefilename[$key1],
											'attachmentDate'=>date('Y-m-d',strtotime($date)),
                                            'taskID'=>$tasktitle,
                                            'status'=>1,
                                        );
                                        $where3 = array(
                                            'attachmentID'=>$idfilename[$key1]
                                        );
                                        $results = $this->Curl_model->insert_data('attachment',$data);
                                    }
                                }
                        //print_r($this->input->post());
                        //die();
						$this->session->set_flashdata('data_message','Successfully Submitted!');
                        echo '<script>window.location.href = "'.base_url().'daily-report"</script>';
                }
			}
	      }
		}
		
		
        $this->load->view('add-daily-report', $data);
        $this->load->view('temp/footer');
    }
	public function validate_time($str)
	{
		list($hh, $mm) = split('[:]', $str);
		if (!is_numeric($hh) || !is_numeric($mm))
		{
			$this->form_validation->set_message('validate_time', 'Not numeric');
			return FALSE;
		}
		else if ((int) $hh > 24 || (int) $mm > 59)
		{
			$this->form_validation->set_message('validate_time', 'Invalid time');
			return FALSE;
		}
		else if (mktime((int) $hh, (int) $mm) === FALSE)
		{
			$this->form_validation->set_message('validate_time', 'Invalid time');
			return FALSE;
		}
		return TRUE;
	}
	
	public function task_lists(){
	 if(($this->session->userdata('userID')!="")){
		 
		$userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
				'order_by'=>array('taskID','desc'),
            ),
            array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('taskID'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID,
					'status'=>'1',
                ),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		if($this->input->post()){
			if($this->input->post('task')!=''){
				$data['letest_taskID'] = $this->input->post('task');
			}
			else{
				$data['letest_taskID'] = $data['task'][0]['taskID'];
			}
		}
		else{
			$data['letest_taskID'] = $data['task'][0]['taskID'];
		}
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportActivity'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID,
					'taskID'=>$data['letest_taskID']
                ),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$data['totaltask']= $this->User_model->total_task_count($userID);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$this->load->view('temp/head');
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('daily-report', $data);
		$this->load->view('temp/footer');
	   }else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		    //redirect(base_url().'login','refresh');
	    }
	 }
	 
	 public function task_lists_daily(){
	 if(($this->session->userdata('userID')!="")){
		 
		$userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
				'order_by'=>array('taskID','desc'),
            ),
            array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('taskID'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID,
					'status'=>'1',
                ),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		if($this->input->post()){
			if($this->input->post('task')!=''){
				$data['letest_taskID'] = $this->input->post('task');
			}
			else{
				$data['letest_taskID'] = $data['task'][0]['taskID'];
			}
		}
		else{
			$data['letest_taskID'] = $data['task'][0]['taskID'];
		}
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportCreationDate','dailyReportActivity'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID,
					'taskID'=>$data['letest_taskID']
                ),
            ),       
        );
        
        $limit = '6';
        $order_by =array('dailyReportID', 'desc');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$data['totaltask']= $this->User_model->total_task_count($userID);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$this->load->view('temp/head');
		$this->load->view('temp/header', $data);
		$this->load->view('temp/sidebar', $data);
		$this->load->view('add-daily-report', $data);
		$this->load->view('temp/footer');
	   }else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
	    }
	 }
	
    public function daily_report()
	{
		$userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('taskID'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID,
					'status'=>'1',
                ),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportActivity'),
                'joinWith'=>array('taskID','left'),
				'where'=>array('userID'=>$userID),
				'order_by' =>array('dailyReportID','desc'),
            ),       
        );
        
        $limit = '';
        $order_by =array('dailyReportID', 'DESC');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$join_data = array(
            array(
                'table'=>'attachment',
                'fields'=>array('attachmentName','attachmentSize','attachmentDate','userID','attachmentTypeID'),
                'joinWith'=>array('attachmentTypeID'),
                'where'=>array(
                    'status'=>1,
                    'taskID'=>$taskID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'attachment_type',
                'fields'=>array('attachmentTypeName','attachmentFileType'),
                'joinWith'=>array('attachmentTypeID','left'),
            ),
            array(
                'joined'=>0,
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID','left'),
            ),
        );
        
        $limit = '';
        $order_by ='';
        $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$data['totaltask']= $this->User_model->total_task_count($userID);
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('daily-report', $data);
        $this->load->view('temp/footer');
    }
	
	public function daily_report_all_data()
	{
		if(($this->session->userdata('userID')!="")){
		$userID = $this->session->userdata('userID');
		$v = $this->uri->segment(2);
		$val=base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$where = "dailyReportID = '$val'";
		$data['report'] = $this->Curl_model->fetch_single_data('*','daily_report',$where);
		$join_data = array(
            array(
                'table'=>'attachment',
                'fields'=>array('attachmentName','attachmentSize','attachmentDate','userID','attachmentTypeID'),
                'joinWith'=>array('attachmentTypeID'),
                'where'=>array(
                    'status'=>1,
                    'dailyReportID'=>$val,
					'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'attachment_type',
                'fields'=>array('attachmentTypeName','attachmentFileType'),
                'joinWith'=>array('attachmentTypeID','left'),
            ),
            array(
                'joined'=>0,
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID','left'),
            ),
        );
        
        $limit = '';
        $order_by ='';
        $data['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        $CI =& get_instance();
		$userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('view-all-daily-data', $data);
        $this->load->view('temp/footer');
	  }
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		   }
    }
	
	
    public function find_task()
	{
		if(($this->session->userdata('userID')!="")){
		$userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		$fields = array(
            'stateID',
            'stateName',
        );
        $where = '';
        $limit = '';
        $order_by = array('stateID','ASC');
        $data['state'] = $this->Curl_model->fetch_data_in_many_array('states',$fields,$where,$limit,$order_by);
		$data['causes']=$this->Curl_model->fetch_all_data("causesID,causesName",'causes','status=1');
		
        $join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle','taskDescription','taskPublishedDate'),
                'joinWith'=>array('taskID'),
            ),
			array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('userID'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                     'userID'=>!$userID,
					),
            ),                 
        );
        
        $limit = '';
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$join_data = array(
					array(
						'table'=>'users',
						'fields'=>array('firstName','lastName'),
						'joinWith'=>array('userID'),
						'where'=>array(
							'userID'=>$userID
						),
					),
					array(
						'joined'=>0,
						'table'=>'user_data',
						'fields'=>array('profile'),
						'joinWith'=>array('userID','left'),
					),
				);
				$where = array();
				$limit = '';
				$order_by ='';
				$data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);		
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar',$data);
        $this->load->view('find-task', $data);
        $this->load->view('temp/footer');
		}
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		   }
    }
	public function send_request()
    {
		$userID = $this->session->userdata('userID');
        $task = $this->uri->segment(2);
        $taskID = base64_decode(str_pad(strtr($task, '-_', '+/'), strlen($task) % 4, '=', STR_PAD_RIGHT));
        $data = array(
			'taskID'=>$taskID,
			'userID'=>$userID,
            'status'=>0,
			'sendRequiestCreatingDate'=>date('y-m-d h:i:s'),
        );
        $results = $this->Curl_model->insert_data('send_requiest',$data);
        if($results)
        {
            $this->session->set_userdata('request_send','true');
			echo '<script>window.location.href = "'.base_url().'find-task"</script>';
        }
    }
	
	public function search_find_task(){
		if(($this->session->userdata('userID')!="")){
            $userID = $this->session->userdata('userID');
            $data['cause']="";
            $data['states']="";
            $data['city']=array();
            $data['cities']="";
			$data['totaltask']= $this->User_model->total_task_count($userID);
			if($this->input->get('causes')!=''  && $this->input->get('state')!='' && $this->input->get('cities')!=''){
				$causes=$this->input->get('causes');
				$state=$this->input->get('state');
				$cities=$this->input->get('cities');
				$where_task="FIND_IN_SET('$causes', u.causesID) and FIND_IN_SET('$state', tl.stateID)and FIND_IN_SET('$cities', tl.cityID)";
				$data['cause']=$causes;
				$data['states']=$state;
				$data['cities']=$cities;
			}			
			else if($this->input->get('causes')!=''  && $this->input->get('state')!=''){
				$causes=$this->input->get('causes');
				$state=$this->input->get('state');
				$where_task="FIND_IN_SET('$causes', u.causesID) and FIND_IN_SET('$state', tl.stateID)";
				$data['cause']=$causes;
				$data['states']=$state;
			}
			else if($this->input->get('state')!='' && $this->input->get('cities')!=''){
				$state=$this->input->get('state');
				$cities=$this->input->get('cities');
				$where_task="FIND_IN_SET('$state', tl.stateID)and FIND_IN_SET('$cities', tl.cityID)";
				$data['states']=$state;
				$data['cities']=$cities;
			}
			else if($this->input->get('causes')!=''){
				$causes=$this->input->get('causes');
				$where_task="FIND_IN_SET('$causes', u.causesID)";
				$data['cause']=$causes;
			}
			else if($this->input->get('state')!=''){
				$state=$this->input->get('state');
				$where_task="FIND_IN_SET('$state', tl.stateID)";
				$data['states']=$state;
			}
			
			else{
				$userID = $this->session->userdata('userID');
				$where_task ="ta.userID=$userID"; 
			}
			$data["task"] = $this->User_model->fetch_find_task($where_task);
			$data['causes']=$this->Curl_model->fetch_all_data("causesID,causesName",'causes','status=1');
			
			$join_data = array(
				array(
					'table'=>'users',
					'fields'=>array('firstName','lastName'),
					'joinWith'=>array('userID'),
					'where'=>array(
						'userID'=>$userID
					),
				),
				array(
					'joined'=>0,
					'table'=>'user_data',
					'fields'=>array('profile'),
					'joinWith'=>array('userID','left'),
				),
			);
			$where = array();
			$limit = '';
			$order_by ='';
			$data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
			
			$fields = array(
            'stateID',
            'stateName',
			);
			$where = '';
			$limit = '';
			$order_by = array('stateID','ASC');
            $data['state'] = $this->Curl_model->fetch_data_in_many_array('states',$fields,$where,$limit,$order_by);
            if($data['states']!='')
            {
            $fields = array(
            'cityID',
            'cityName',
            );
            $where = array('stateID'=>$data['states']);
            $limit = '';
            $order_by = '';
            $data['city'] = $this->Curl_model->fetch_data_in_many_array('cities',$fields,$where,$limit,$order_by);
            }
            // echo "<pre>";
            // print_r($data);
            // die();	
			$this->load->view('temp/head');
			$this->load->view('temp/header', $data);
			$this->load->view('temp/sidebar',$data);
			$this->load->view('find-task', $data);
			$this->load->view('temp/footer');
			
		}
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		   }
	}
	public function reward_point()
	{
		if(($this->session->userdata('userID')!="")){
		$userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		$join_data = array(
			 array(
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut'),
                'joinWith'=>array('approveddaily_ID','left'),
				'where'=>array('userID'=>$userID,
								'approveddaily_ID !'=>0,),
				'group_by'=>array('approveddaily_ID'),
            ),
            array(
				'joined'=>0,
                'table'=>'task',
                'fields'=>array('taskID'),
                'joinWith'=>array('taskID'),
            ),
           
		  array(
                'joined'=>0,
                'table'=>'approveddaily_report',
                'fields'=>array('admin_time'),
				//'function'=>array('SUM','admin_time'),
                'joinWith'=>array('approveddaily_ID','left'),
            ),			
        );
        
        $limit = '';
        $order_by ='';
        $data['reporttotal'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('reward-point', $data);
        $this->load->view('temp/footer');
		}
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		   //redirect(base_url().'login','refresh');
		   }
    }
	public function reward_point111()
	{
		if(($this->session->userdata('userID')!="")){
		$userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportActivity'),
                'joinWith'=>array('taskID','left'),
				'where'=>array('userID'=>$userID),
				'order_by' =>array('dailyReportID','desc'),
            ),       
        );
        
        $limit = '';
        $order_by =array('dailyReportID', 'DESC');
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('reward-point', $data);
        $this->load->view('temp/footer');
		}
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		   //redirect(base_url().'login','refresh');
		   }
    }
	public function reward_report()
	{
		if(($this->session->userdata('userID')!="")){
		$userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('reward-report', $data);
        $this->load->view('temp/footer');
		}
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		   }
    }
	public function final_task_report()
	{
		if(($this->session->userdata('userID')!="")){
        $CI =& get_instance();
		$data['causes']=$this->Curl_model->fetch_all_data("causesID,causesName",'causes','status=1');
		$userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle','taskBrief','taskPublishedDate','taskStatus','taskDescription'),
                'joinWith'=>array('taskID'),
				
            ),
            array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('taskID'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID
                ),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$data['totaltask']= $this->User_model->total_task_count($userID);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('tast-report', $data);
        $this->load->view('temp/footer');
		}
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
		   //redirect(base_url().'login','refresh');
		   }
    }
	public function final_daily_report()
	{
		if(($this->session->userdata('userID')!="")){
		 $userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'assigning_task',
                'fields'=>array('taskID'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID
                ),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportActivity'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                    'userID'=>$userID
                ),
                'order_by'=>array(
                    'dailyReportID','DESC'
                ),
            ),       
        );
        
        $limit = '';
        $order_by ='';
        $data['report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
		$join_data = array(
            array(
                'table'=>'attachment',
                'fields'=>array('attachmentName','attachmentSize','attachmentDate','userID','attachmentTypeID'),
                'joinWith'=>array('attachmentTypeID'),
                'where'=>array(
                    'status'=>1,
                    'taskID'=>$taskID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'attachment_type',
                'fields'=>array('attachmentTypeName','attachmentFileType'),
                'joinWith'=>array('attachmentTypeID','left'),
            ),
            array(
                'joined'=>0,
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID','left'),
            ),
        );
        
        $limit = '';
        $order_by ='';
        $res['attachment'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$data['totaltask']= $this->User_model->total_task_count($userID);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('final-daily-report', $data);
        $this->load->view('temp/footer');
		}
	   else{
		   echo '<script>window.location.href = "'.base_url().'login"</script>';
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
        $CI =& get_instance();
        $userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
		
		$join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('profile'),
                'joinWith'=>array('userID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        if($this->input->post())
        {
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
            if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('change-pwd',$res);
                }
                else
                {
                    $fields = array(
                        'password'
                    );
                    $where = array(
                        'userID'=>$userID
                    );
                    $limit = '';
                    $order_by = array('userID','DESC');
                    $results = $this->Curl_model->fetch_data('users',$fields,$where,$limit,$order_by);
                    //print_r($results);
                    if(!empty($results) && $results!='')
                    {
                        $r_password = $CI->get_library->decode($results['password']);
                        $oldpass = $this->input->post('oldpassword');
                        if($oldpass==$r_password)
                        {
                            $npass = $CI->get_library->encode($this->input->post('newpassword'));
                            $where = array(
                                'userID'=>$userID,
                            );
                            $fields = array(
                                'password'=>$npass
                            );
                            //die();
                            $results = $this->Curl_model->update_data('users',$fields,$where);
                            if($results)
                            {
                                $this->session->set_userdata('success','Your password has been changed');
                                echo '<script>window.location.href = "'.base_url().'change-password"</script>';
                            }
                        }
                        else{
                            $this->session->set_userdata('error','Plz enter right current password');
                            $this->load->view('change-pwd');
                        }
                    }
                   
                }
        }
        else{
            $this->load->view('change-pwd');
        }
        
        $this->load->view('temp/footer');
    }
	

    public function profile()
	{
        $CI =& get_instance();
        
        $userID = $this->session->userdata('userID');
        $join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName','mobile','email'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('dateOfBirth','correspontenceAddress','govt_name','time_duration','ref1_name','ref1_relation', 'ref1_contact','ref1_email','ref1_address','ref2_name','ref2_relation', 'ref2_contact','ref2_email','ref2_address','profile'),
                'joinWith'=>array('userID','left'),
            ),
            array(
                'joined'=>0,
                'table'=>'position',
                'fields'=>array('positionName'),
                'joinWith'=>array('positionID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'states',
                'fields'=>array('stateName'),
                'joinWith'=>array('stateID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'cities',
                'fields'=>array('cityName'),
                'joinWith'=>array('cityID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'nationality',
                'fields'=>array('nationalityName'),
                'joinWith'=>array('nationalityID','left'),
            ),
			array(
                'joined'=>1,
                'table'=>'education',
                'fields'=>array('educationName'),
                'joinWith'=>array('educationID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'blood_group',
                'fields'=>array('bloodGroupName'),
                'joinWith'=>array('bloodGroupID','left'),
            ),
			array(
                'joined'=>1,
                'table'=>'occupation',
                'fields'=>array('occupationName'),
                'joinWith'=>array('occupationID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $res['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		$data['totaltask']= $this->User_model->total_task_count($userID);
        $this->load->view('temp/head');
        $this->load->view('temp/header', $res);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('user-profile',$res);
        $this->load->view('temp/footer',$res);
    }
    public function edit_profile()
	{
        $CI =& get_instance();
        $userID = $this->session->userdata('userID');
		$data['totaltask']= $this->User_model->total_task_count($userID);
        $join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('firstName','lastName','mobile','email'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('dateOfBirth','correspontenceAddress','gender','nationalityID','bloodGroupID','educationID','occupationID','stateID','cityID','permanentState','permanentCity','permanentAddress','govt_name','time_duration','ref1_name','ref1_relation', 'ref1_contact','ref1_email','ref1_address','ref2_name','ref2_relation', 'ref2_contact','ref2_email','ref2_address','profile'),
                'joinWith'=>array('userID','left'),
            ),
            array(
                'joined'=>0,
                'table'=>'position',
                'fields'=>array('positionName'),
                'joinWith'=>array('positionID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'states',
                'fields'=>array('stateName'),
                'joinWith'=>array('stateID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'cities',
                'fields'=>array('cityName'),
                'joinWith'=>array('cityID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'occupation',
                'fields'=>array('occupationName'),
                'joinWith'=>array('occupationID','left'),
            ),
        );
        $where = array();
        $limit = '';
        $order_by ='';
        $res['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        $fields2 = array(
            'areaOfExpertiesID',
        );
        $where2 = array('userID'=>$userID);
        $limit2 = '';
        //$order_by = array('userID','DESC');
        $order_by2 = "";
        $res['user_area_of_experties'] = $this->Curl_model->fetch_data_in_many_array('user_area_of_experties',$fields2,$where2,$limit2,$order_by2);
        $fields2 = array(
            'voluntaryServiceID',
        );
        $where2 = array('userID'=>$userID);
        $limit2 = '';
        //$order_by = array('userID','DESC');
        $order_by2 = "";
        $res['user_voluntary_service'] = $this->Curl_model->fetch_data_in_many_array('user_voluntary_service',$fields2,$where2,$limit2,$order_by2);
        $fields2 = array(
            'serviceAreaID',
        );
        $where2 = array('userID'=>$userID);
        $limit2 = '';
        //$order_by = array('userID','DESC');
        $order_by2 = "";
        $res['user_service_area'] = $this->Curl_model->fetch_data_in_many_array('user_service_area',$fields2,$where2,$limit2,$order_by2);
        $fields2 = array(
            'languageID',
        );
        $where2 = array('userID'=>$userID);
        $limit2 = '';
        //$order_by = array('userID','DESC');
        $order_by2 = "";
        $res['user_language'] = $this->Curl_model->fetch_data_in_many_array('user_language',$fields2,$where2,$limit2,$order_by2);
        $fields2 = array(
            'bloodGroupID',
            'bloodGroupName',
        );
        $where2 = array('status'=>1);
        $limit2 = '';
        //$order_by = array('userID','DESC');
        $order_by2 = "";
        $res['bloodGroup'] = $this->Curl_model->fetch_data_in_many_array('blood_group',$fields2,$where2,$limit2,$order_by2);
        $fields3 = array(
            'educationID',
            'educationName',
        );
        $where3 = array('status'=>1);
        $limit3 = '';
        //$order_by = array('userID','DESC');
        $order_by3 = "";
        $res['education'] = $this->Curl_model->fetch_data_in_many_array('education',$fields3,$where3,$limit3,$order_by3);
        $fields3 = array(
            'languageID',
            'languageName',
        );
        $where3 = array('status'=>1);
        $limit3 = '';
        //$order_by = array('userID','DESC');
        $order_by3 = "";
        $res['language'] = $this->Curl_model->fetch_data_in_many_array('language',$fields3,$where3,$limit3,$order_by3);
        $fields3 = array(
            'nationalityID',
            'nationalityName',
        );
        $where3 = array('status'=>1);
        $limit3 = '';
        //$order_by = array('userID','DESC');
        $order_by3 = "";
        $res['nationality'] = $this->Curl_model->fetch_data_in_many_array('nationality',$fields3,$where3,$limit3,$order_by3);
        $fields3 = array(
            'serviceAreaID',
            'serviceAreaName',
        );
        $where3 = array('status'=>1);
        $limit3 = '';
        //$order_by = array('userID','DESC');
        $order_by3 = "";
        $res['service_area'] = $this->Curl_model->fetch_data_in_many_array('service_area',$fields3,$where3,$limit3,$order_by3);
        $fields3 = array(
            'occupationID',
            'occupationName',
        );
        $where3 = array('status'=>1);
        $limit3 = '';
        //$order_by = array('userID','DESC');
        $order_by3 = "";
        $res['occupation'] = $this->Curl_model->fetch_data_in_many_array('occupation',$fields3,$where3,$limit3,$order_by3);
        $fields3 = array(
            'voluntaryServiceID',
            'voluntaryServiceName',
        );
        $where3 = array('status'=>1);
        $limit3 = '';
        //$order_by = array('userID','DESC');
        $order_by3 = "";
        $res['voluntary_service'] = $this->Curl_model->fetch_data_in_many_array('voluntary_service',$fields3,$where3,$limit3,$order_by3);
        $fields3 = array(
            'areaOfExpertiesID',
            'areaOfExpertiesName',
        );
        $where3 = array('status'=>1);
        $limit3 = '';
        //$order_by = array('userID','DESC');
        $order_by3 = "";
        $res['area_of_experties'] = $this->Curl_model->fetch_data_in_many_array('area_of_experties',$fields3,$where3,$limit3,$order_by3);
        $fields3 = array(
            'stateID',
            'stateName',
        );
        $where3 = '';
        $limit3 = '';
        //$order_by = array('userID','DESC');
        $order_by3 = "";
        $res['states'] = $this->Curl_model->fetch_data_in_many_array('states',$fields3,$where3,$limit3,$order_by3);
        $fields3 = array(
            'cityID',
            'cityName',
        );
        $where3 = '';
        $limit3 = '';
        //$order_by = array('userID','DESC');
        $order_by3 = "";
        $res['cities'] = [];
        $this->load->view('temp/head');
        $this->load->view('temp/header', $res);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('user-form',$res);
        $this->load->view('temp/footer',$res);
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
        if($arr['birthday']!='')
        {
        $dateOfBirth = date("Y-m-d", strtotime($arr['birthday']));
        }
        else{
            $dateOfBirth=0;
        }
		
        $where = array(
            'userID'=>$userID
        );
        if($btn==1)
        {
           $data =  array(
            'dateOfBirth'=>$dateOfBirth,
			'govt_name'=>$arr['govt_name'],
            'gender'=>$arr['gender'],
            'govt_name'=>$arr['govt_name'],
            'nationalityID'=>$arr['nationality'],
            'bloodGroupID'=>$arr['bloodGroup'],
            'educationID'=>$arr['education'],
            'occupationID'=>$arr['occupation']
            );

            if($language!='' && !empty($language))
            {
                $this->Curl_model->delete_data('user_language',['userID'=>$userID]);
                foreach ($language as $key => $value) {
                    $dataCD = array(
                        'userID'=>$userID,
                        'languageID'=>$value
                    );
                    $resultsID = $this->Curl_model->insert_data('user_language',$dataCD);
                }
            }
            if($serviceArea!='' && !empty($serviceArea))
            {
                $this->Curl_model->delete_data('user_service_area',['userID'=>$userID]);
                foreach ($serviceArea as $key => $value) {
                    $dataCD = array(
                        'userID'=>$userID,
                        'serviceAreaID'=>$value
                    );
                    $resultsID = $this->Curl_model->insert_data('user_service_area',$dataCD);
                }
            }
            if($voluntaryService!='' && !empty($voluntaryService))
            {
                $this->Curl_model->delete_data('user_voluntary_service',['userID'=>$userID]);
                foreach ($voluntaryService as $key => $value) {
                    $dataCD = array(
                        'userID'=>$userID,
                        'voluntaryServiceID'=>$value
                    );
                    $resultsID = $this->Curl_model->insert_data('user_voluntary_service',$dataCD);
                }
            }
        }
        else if($btn==2){
            $data = array(
				'time_duration'=>$arr['time_duration'],
                'stateID'=>$arr['tstate'],
                'cityID'=>$arr['tcities'],
                'permanentState'=>$arr['pstate'],
                'permanentCity'=>$arr['pcities'],
                'correspontenceAddress'=>$arr['taddress'],
                'permanentAddress'=>$arr['paddress'],
                'time_duration'=>$arr['time_duration'],
                'ref1_name'=>$arr['ref1_name'],
                'ref1_relation'=>$arr['ref1_relation'],
                'ref1_contact'=>$arr['ref1_contact'],
                'ref1_email'=>$arr['ref1_email'],
                'ref1_address'=>$arr['ref1_address'],
                'ref2_name'=>$arr['ref2_name'],
                'ref2_relation'=>$arr['ref2_relation'],
                'ref2_contact'=>$arr['ref2_contact'],
                'ref2_email'=>$arr['ref2_email'],
                'ref2_address'=>$arr['ref2_address'],
            );
            if($expertise!='' && !empty($expertise))
            {
                $this->Curl_model->delete_data('user_area_of_experties',['userID'=>$userID]);
                foreach ($expertise as $key => $value) {
                    $dataCD = array(
                        'userID'=>$userID,
                        'areaOfExpertiesID'=>$value
                    );
                    $resultsID = $this->Curl_model->insert_data('user_area_of_experties',$dataCD);
                }
            }
        }
        $results = $this->Curl_model->update_data('user_data',$data,$where);
        echo $results;
        //print_r($data);
    }
	
	public function uploadProfile(){
	   if(($this->session->userdata('userID')!="")){
		 $userID = $this->session->userdata('userID');
		  $this->load->library('image_lib'); 
		  $imageName = time().$_FILES['profile']['name'];
		  //echo $imageName; exit;
		  $image = str_replace(" ","_",$imageName);
		  $config = array();
		  $config['upload_path'] = './user_profile/';
		  $config['allowed_types'] = 'jpg|png|jpeg';
		  $config['file_name'] = $image;
		  $this->load->library('upload',$config);	
		  if($this->upload->do_upload("profile")){
			 $success = $this->User_model->userimg_file($image,$userID);
			 if($success != FALSE){
				 echo 1;
			 }
			 else{ echo 2; }
		  }
		  else{ 
			  print_r($this->upload->display_errors());exit;  
		  }
		 }else{
			 echo '<script>window.location.href = "'.base_url().'login"</script>';
		   }

	}  
	
	public function search_filter_task(){
		if(($this->session->userdata('userID')!="")){
		$data['causes']=$this->Curl_model->fetch_all_data("causesID,causesName",'causes','status=1');
		$userID = $this->session->userdata('userID');
			if($this->input->get('cause')!=''  && $this->input->get('datefilter')!=''){
				$cause=$this->input->get('cause');
				$datefilter=$this->input->get('datefilter');
				$datefilter = explode("-", $datefilter);
				$first_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[0])));
			    $second_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[1])));
				$where_task="FIND_IN_SET('$cause', u.causesID) and ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
				$data['cause']=$cause;
				$data['datefilter']=$this->input->get('datefilter');
			}			
			else if($this->input->get('datefilter')!=''){
			     $datefilter=$this->input->get('datefilter');
				 $datefilter = explode("-", $datefilter);
				 $first_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[0])));
			     $second_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[1]))); 
				 $where_task="ta.assigningTaskCreationDate >= '$first_date' AND ta.assigningTaskCreationDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
				 $data['datefilter']=$this->input->get('datefilter');
			
			}
			else if($this->input->get('cause')!=''){
				$cause=$this->input->get('cause');
				$where_task="FIND_IN_SET('$cause', u.causesID)and FIND_IN_SET('$userID', ta.userID)";
				$data['cause']=$cause;
			}	
			
			else{
				$where_task ="ta.userID=$userID"; 
			}
			$data["task"] = $this->User_model->fetch_my_task_final($where_task,$first_date_cal , $second_date_cal);
			$data['totaltask']= $this->User_model->total_task_count($userID);
			$join_data = array(
					array(
						'table'=>'users',
						'fields'=>array('firstName','lastName'),
						'joinWith'=>array('userID'),
						'where'=>array(
							'userID'=>$userID
						),
					),
					array(
						'joined'=>0,
						'table'=>'user_data',
						'fields'=>array('profile'),
						'joinWith'=>array('userID','left'),
					),
				);
				$where = array();
				$limit = '';
				$order_by ='';
				$data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
			$this->load->view('temp/head');
			$this->load->view('temp/header', $data);
			$this->load->view('temp/sidebar',$data);
			$this->load->view('tast-report', $data);
			$this->load->view('temp/footer');

		}
		else {
			echo '<script>window.location.href = "'.base_url().'login"</script>';
		}
	}
    public function final_daily_filter(){
        if(($this->session->userdata('userID')!="")){
          $userID = $this->session->userdata('userID');
          $join_data = array(
                  array(
                      'table'=>'task',
                      'fields'=>array('taskID','taskTitle'),
                      'joinWith'=>array('taskID'),
                  ),
                  array(
                      'joined'=>0,
                      'table'=>'assigning_task',
                      'fields'=>array('taskID'),
                      'joinWith'=>array('taskID','left'),
                      'where'=>array(
                          'userID'=>$userID,
                          'status'=>'1',
                      ),
                  ),       
              );
              
              $limit = '';
              $order_by ='';
              $data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
              
              if($this->input->get('tasks')!=''  && $this->input->get('datefilter')!=''){
                  $tasks=$this->input->get('tasks');
                  $datefilter=$this->input->get('datefilter');
                  $datefilter = explode("-", $datefilter);
                  $first_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[0])));
                  $second_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[1])));
                  $where_task="FIND_IN_SET('$tasks', ta.taskID) and ta.dailyReportDate >= '$first_date' AND ta.dailyReportDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
                  $data['tasks']=$tasks;
                  $data['datefilter']=$this->input->get('datefilter');
              }			
              else if($this->input->get('datefilter')!=''){
                   $datefilter=$this->input->get('datefilter');
                   $datefilter = explode("-", $datefilter);
                   $first_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[0])));
                   $second_date=date('Y-m-d',strtotime(str_replace('/','-',$datefilter[1]))); 
                   $where_task="ta.dailyReportDate >= '$first_date' AND ta.dailyReportDate <= '$second_date'and FIND_IN_SET('$userID', ta.userID)";
                   $data['datefilter']=$this->input->get('datefilter');
              
              }
              else if($this->input->get('tasks')!=''){
                  $tasks=$this->input->get('tasks');
                  $where_task="FIND_IN_SET('$tasks', ta.taskID)and FIND_IN_SET('$userID', ta.userID)";
                  $data['tasks']=$tasks;
              }	
              
              else{
                  $where_task ="ta.userID=$userID"; 
              }
              $data["report"] = $this->User_model->fetch_daily_report($where_task);
              
              
     
          $data['totaltask']= $this->User_model->total_task_count($userID);
          $join_data = array(
                  array(
                      'table'=>'users',
                      'fields'=>array('firstName','lastName'),
                      'joinWith'=>array('userID'),
                      'where'=>array(
                          'userID'=>$userID
                      ),
                  ),
                  array(
                      'joined'=>0,
                      'table'=>'user_data',
                      'fields'=>array('profile'),
                      'joinWith'=>array('userID','left'),
                  ),
              );
              $where = array();
              $limit = '';
              $order_by ='';
              $data['userDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
              $this->load->view('temp/head');
              $this->load->view('temp/header', $data);
              $this->load->view('temp/sidebar',$data);
              $this->load->view('final-daily-report',$data);
              $this->load->view('temp/footer');
  
          }
          else {
              echo '<script>window.location.href = "'.base_url().'login"</script>';
          }
       }
	
	
	
	
	
    
}
