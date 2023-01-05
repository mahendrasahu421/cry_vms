<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();

		$CI = &get_instance();
		$CI->load->library('Get_library');
		$this->load->database();
		date_default_timezone_set('Asia/Kolkata');
	}

	public function total_task_count($statesID = 0)
	{
		$sql = $statesID == 0 ? "SELECT * FROM task WHERE status=1" : "SELECT * FROM task WHERE task_state_id IN ($statesID) AND status=1";
		$querry = $this->db->query($sql);
		$count = $querry->result_array();
		return $count;
	}
	public function total_task_count_intern_state($statesID = 0)
	{
		$sql = $statesID == 0 ? "SELECT * FROM interntask WHERE status=1" : "SELECT * FROM interntask WHERE task_state_id IN ($statesID) AND status=1";
		$querry = $this->db->query($sql);
		$count = $querry->result_array();
		return $count;
	}

	public function total_task_count_intern()
	{
		$this->db->select('intern_task_id');
		$this->db->from('interntask');
		$this->db->where('task_for', 2);
		$query = $this->db->get();
		$count = $query->num_rows("array");
		return $count;
	}

	function select_all_states_by_task($taskid)
	{
		$this->db->initialize();
		$this->db->select('s.state_id,s.state_name');
		$this->db->from('task t');
		$this->db->join('states s', 't.task_state_id=s.state_id', 'left');
		$this->db->where('t.task_id ', $taskid);
		$query = $this->db->get();
		$result = $query->result_array();
		//$this->db->close();	
		return $result;
	}

	function internselect_all_states_by_task($taskid)
	{
		$this->db->initialize();
		$this->db->select('s.state_id,s.state_name');
		$this->db->from('interntask it');
		$this->db->join('states s', 'it.task_state_id=s.state_id', 'left');
		$this->db->where('it.intern_task_id ', $taskid);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		//$this->db->close();	
		return $result;
	}

	function select_all_task_by_state($stateName)
	{
		$this->db->initialize();
		$this->db->select('t.*,s.state_id,s.state_name');
		$this->db->from('task t');
		$this->db->join('states s', 't.task_state_id=s.state_id', 'left');
		$this->db->where('t.task_state_id ', $stateName);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		//$this->db->close();	
		return $result;
	}
	function internselect_all_task_by_state($stateName)
	{
		$this->db->initialize();
		$this->db->select('it.*,s.state_id,s.state_name');
		$this->db->from('interntask it');
		$this->db->join('states s', 'it.task_state_id=s.state_id', 'left');
		$this->db->where('it.task_state_id ', $stateName);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		//$this->db->close();	
		return $result;
	}

	function select_all_city_by_task($state)
	{
		$this->db->initialize();
		$city = $this->db->select('c.city_id,c.city_name');
		$this->db->from('cities c');
		$this->db->where('c.state_id ', $state);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		//$this->db->close();	exit;
		return $result;
	}
	function all_City_data($where)
	{
		$this->db->initialize();
		$city = $this->db->select('c.city_id,c.city_name,c.code,c.state_id,s.state_name');
		$this->db->from('cities c');
		$this->db->join('states s', 's.state_id = c.state_id', 'left');
		$this->db->where('c.city_id ', $where);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		//$this->db->close();	exit;
		return $result;
	}
	public function total_task_count_volunteer()
	{
		$this->db->select('task_id');
		$this->db->from('task');
		$this->db->where('task_for', 1);
		$query = $this->db->get();
		$count = $query->num_rows("array");
		return $count;
	}

	public function total_volunteer($statesID = 0)
	{
		$sql = $statesID == 0 ? "SELECT * FROM volunteer WHERE status=5" : "SELECT * FROM volunteer WHERE state_id IN ($statesID) AND status=5";
		$querry = $this->db->query($sql);
		$count = $querry->result_array();
		return $count;
	}


	public function get_regionAnd_allRegionStates()
	{
		$this->db->initialize();
		$this->db->select('r.*,s.state_name');
		$this->db->from('regions r');
		$this->db->join('states s', 's.state_id = r.state_id', 'left');
		$this->db->where('status=1');
		$query = $this->db->order_by('region_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	public function total_intern($statesID = 0)
	{
		$sql = $statesID == 0 ? "SELECT * FROM interns WHERE status=5" : "SELECT * FROM interns WHERE state_id IN ($statesID) AND status=5";
		$querry = $this->db->query($sql);
		$count = $querry->result_array();
		return $count;
	}
	public function total_volunteer123()
	{
		$this->db->select('userID');
		$this->db->from('users');
		$query = $this->db->get();
		$count = $query->num_rows("array");
		return $count;
	}

	function intern_transferRequest($where)
	{
		$this->db->initialize();
		$this->db->select('it.*,s.state_name,i.first_name,i.last_name,i.mobile,i.email,i.state_id,rs.state_name as relocate_state_name,rc.city_name as relocate_city_name');
		$this->db->from('intern_transfer it');
		$this->db->join('states s', 's.state_id = it.current_state', 'left');
		$this->db->join('states rs', 'it.relocate_state = rs.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = it.relocate_city', 'left');
		$this->db->join('cities rc', 'it.relocate_city = rc.city_id', 'left');
		$this->db->join('interns i', 'i.intern_id = it.intern_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('relocate_id  desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function volunteer_transferRequest($where)
	{
		$this->db->initialize();
		$this->db->select('vt.*,s.state_name,v.first_name,v.last_name,v.mobile,v.email,v.state_id,ts.state_name as relocate_state_name,rc.city_name as relocate_city_name');
		$this->db->from('volunteer_transfer vt');
		$this->db->join('states s', 's.state_id = vt.current_state', 'left');
		$this->db->join('states ts', 'vt.relocate_state = ts.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = vt.relocate_city', 'left');
		$this->db->join('cities rc', 'vt.relocate_city = rc.city_id', 'left');
		$this->db->join('volunteer v', 'v.volunteer_id = vt.volunteer_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('volunteer_relocate_id  desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function volunteer_enquiry_Data($where)
	{
		$this->db->initialize();
		$this->db->select('v.volunteer_id,v.first_name,v.last_name,v.mobile,v.email,v.state_id,v.city_id,v.creation_date,s.state_name,c.city_name');
		$this->db->from('volunteer v');
		$this->db->join('states s', 's.state_id = v.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = v.city_id', 'left');
		//$this->db->join('email_templates et', 'et.email_templates_id = et.city_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('volunteer_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}
	function volunteer_enquiry_Datalimit5($where, $limit)
	{

		$this->db->initialize();
		$this->db->select('v.*,s.state_name,c.city_name');
		$this->db->from('volunteer v');
		$this->db->join('states s', 's.state_id = v.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = v.city_id', 'left');
		//$this->db->join('email_templates et', 'et.email_templates_id = et.city_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('volunteer_id desc');
		$this->db->limit($limit);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function request_task_volunteer($where)
	{
		$this->db->initialize();
		$this->db->select('sr.*,sr.status as rstatus,v.*,t.task_title,t.task_brief');
		$this->db->from('send_requiest sr');
		$this->db->join('volunteer v', 'v.volunteer_id = sr.volunteer_id', 'left');
		$this->db->join('task t', 't.task_id = sr.task_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('sendRequiestID desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}
	function request_task_intern($where)
	{
		$this->db->initialize();
		$this->db->select('isr.*,isr.status as rstatus,i.*,it.task_title,it.task_brief');
		$this->db->from('intern_send_request isr');
		$this->db->join('interns i', 'i.intern_id = isr.intern_id', 'left');
		$this->db->join('interntask it', 'it.intern_task_id = isr.intern_task_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('intern_request_id desc');

		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}


	function programvolunteer_enquiry_Data($where)
	{
		$this->db->initialize();
		$this->db->select('vpu.*,s.state_name,c.city_name,vp.program_name,cfm.certificate_type,cfm.certificate_path');
		$this->db->from('volunteer_program_users vpu');
		$this->db->join('states s', 's.state_id = vpu.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = vpu.city_id', 'left');
		$this->db->join('certificate_format_master cfm', 'cfm.certificate_id = vpu.certificate_id', 'left');
		$this->db->join('program_volunteer vp', 'vp.program_id = vpu.volunteer_programs', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function volunteer_dailyReportData($where)
	{
		$this->db->initialize();
		//$this->db->select('v.*,t.*,dr.*, sum(dr.dr_time_in)');
		$this->db->select('v.first_name,v.last_name, v.status,v.mobile, v.email, t.task_id,t.task_title, t.task_brief,dr.*');
		$this->db->from('daily_report dr');
		$this->db->join('task t', 't.task_id = dr.task_id', 'left');
		$this->db->join('volunteer v', 'v.volunteer_id = dr.volunteer_id', 'left');
		$this->db->where($where);
		$query = $this->db->group_by('v.volunteer_id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function intern_dailyReportData($where)
	{
		$this->db->initialize();
		$this->db->select('i.first_name,i.last_name, i.status,i.mobile, i.email, it.intern_task_id,it.task_title, it.task_brief,idr.*');
		$this->db->from('intern_daily_report idr');
		$this->db->join('interntask it', 'it.intern_task_id = idr.intern_task_id', 'left');
		$this->db->join('interns i', 'i.intern_id = idr.intern_id', 'left');
		$this->db->where($where);
		$query = $this->db->group_by('i.intern_id');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function volunteer_orientationcome_Data($where)
	{
		$this->db->initialize();
		$this->db->select('v.*,s.state_name,c.city_name');
		$this->db->from('volunteer v');
		$this->db->join('states s', 's.state_id = v.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = v.city_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('volunteer_id desc');
		$query = $this->db->get();

		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function intern_enquiry_Data($where)
	{
		$this->db->initialize();
		$this->db->select('i.*,s.state_name,c.city_name,is.*');
		$this->db->from('interns i');
		$this->db->join('states s', 's.state_id = i.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
		$this->db->join('skills is', 'is.skill_id = i.skill_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('intern_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}



	function get_all_employee()
	{
		$this->db->initialize();
		$this->db->select('e.*,s.state_name as state_name');
		$this->db->from('employee e');
		$this->db->join('states s', 's.state_id = e.sid', 'left');
		//$this->db->join('cities c', 'c.ci_id = e.ci_id', 'left');
		// $this->db->join('pravasi_designation pd', 'pd.des_id  = e.des_id', 'left');
		$this->db->join('master_role mr', 'mr.role_id  = e.role_id', 'left');
		$this->db->where('e.status !=0');
		$this->db->order_by('e.emp_id   DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}
	function volunteer_task_Data($where)
	{
		$this->db->initialize();
		$this->db->select('*');
		$this->db->from('task');
		$this->db->where($where);
		$query = $this->db->order_by('task_id desc');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}
	function intern_task_Data($where)
	{
		$this->db->initialize();
		$this->db->select('*');
		$this->db->from('interntask');
		$this->db->where($where);
		$query = $this->db->order_by('intern_task_id desc');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	public function count_send_mail($volunteerEmail)
	{
		$this->db->initialize();
		$updateCount = "UPDATE volunteer SET mail_count = mail_count + 1,status=2 WHERE email ='" . $volunteerEmail . "'";
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}

	public function program_volunteer_stateUpdate($volunteerEmail, $relocateState, $volunteer_city)
	{
		$this->db->initialize();
		$updatestatus = "UPDATE volunteer SET state_id = $relocateState,city_id= $volunteer_city WHERE email ='" . $volunteerEmail . "'";
		// echo "<pre>";
		// print_r($updatestatus);exit;
		$querry = $this->db->query($updatestatus);
		//$count = $querry->num_rows();
		return true;
	}

	public function program_volunteer_statusUpdate($volunteer_id, $relocate_id)
	{
		$this->db->initialize();
		$updateCount = "UPDATE volunteer_transfer SET status=2 WHERE volunteer_relocate_id = $relocate_id OR volunteer_id=$volunteer_id";
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}

	public function program_intern_UpdateStatus($relocate_id, $intern_id)
	{
		$this->db->initialize();
		$updatestatus = "UPDATE intern_transfer SET status=2 WHERE relocate_id = $relocate_id OR intern_id=$intern_id";
		// echo "<pre>";
		// print_r($updatestatus);exit;
		$querry = $this->db->query($updatestatus);
		//$count = $querry->num_rows();
		return true;
	}
	public function program_intern_Updatestate($internEmail, $relocateState, $relocatecity)
	{
		$this->db->initialize();
		$updateCount = "UPDATE interns SET state_id = $relocateState,city_id= $relocatecity WHERE email ='" . $internEmail . "'";
		// echo "<pre>";
		// print_r($updateCount);exit;
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}

	public function updateStatus($certificateData)
	{
		$this->db->initialize();
		$updateCount = "UPDATE volunteer_program_users SET status=3 WHERE email ='" . $certificateData . "'";
		//print_r($updateCount);exit;
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}

	public function count_send_mailPostRegistration($volunteerEmail)
	{
		$this->db->initialize();
		$updateCount = "UPDATE volunteer SET mail_count = mail_count + 1,status=3 WHERE volunteer_id ='" . $volunteerEmail . "'";
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}
	public function count_send_maillogincredational($volunteerEmail)
	{
		$this->db->initialize();
		$pass = 'volunteer12345';
		$newpass = md5($pass);
		$updateCount = "UPDATE volunteer SET `mail_count`=' mail_count + 1', `password`= '$newpass',`status`=5 WHERE volunteer_id ='" . $volunteerEmail . "'";

		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}

	public function total_assigningtask()
	{
		$this->db->select('userID');
		$this->db->from('assigning_task');
		$query = $this->db->get();
		$count = $query->num_rows("array");
		return $count;
	}
	public function timein_calculate()
	{
		$this->db->select('SUM(`dailyReportTimeIn`) AS dailyReportTimeIn ');
		$this->db->from('daily_report');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	public function timeout_calculate()
	{
		$this->db->select('SUM(`dailyReportTimeOut`) AS dailyReportTimeOut ');
		$this->db->from('daily_report');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function get_rewarded_users()
	{
		$this->db->select('SUM(`admin_time`) AS admin_time,userID,taskID,vself_task_id');
		$this->db->from('approveddaily_report');
		$this->db->group_by('userID');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function check_user_donation()
	{
		$this->db->select('SUM(`amount`) AS amount, status');
		$this->db->from('vol_donation_data');
		$this->db->where('status', 'SUCCESS');
		$query = $this->db->get();
		//echo $this->db->last_query();
		// die();
		$result = $query->result_array();
		return $result;
	}

	public function donation_vol_list()
	{
		$query = $this->db->query("SELECT u.userID, u.firstName,u.lastName FROM `users` u LEFT JOIN `vol_donation_data` vd ON vd.volunteer_id = u.userID where vd.status='SUCCESS' GROUP BY vd.volunteer_id order by u.firstName ASC");
		return $query->result_array();
	}

	public function user_dobation_report($where)
	{
		$query = $this->db->query("SELECT first_name,mobile,email,my_donation,amount,p_date,status FROM vol_donation_data where " . $where);
		//echo $this->db->last_query();die();
		return $query->result_array();
	}


	public function get_all_regionwise_state()
	{
		$this->db->initialize();
		$this->db->select('rd.*,s.state_name as state_name');
		$this->db->from('regions rd');
		$this->db->join('states s', 's.state_id = rd.state_id', 'left');

		$this->db->order_by('rd.region_id  DESC');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}


	function get_all_region_data($state_id)
	{

		$re = explode(',', $state_id);
		// echo "<pre>";
		// print_r($re);exit;
		$this->db->select('code,state_name');
		$this->db->from('states');

		$this->db->where_in('state_id', $state_id, false); //WHERE author IN ('Bob', 'Geoff')
		//$this->db->get('states');
		$query = $this->db->get();
		//cho $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function get_all_program($where)
	{
		$this->db->initialize();
		$this->db->select('pv.*,r.region_name as region_name');
		$this->db->from('program_volunteer pv');
		//$this->db->join('states s', 's.state_id = pv.program_state', 'left');
		//$this->db->join('cities c', 'c.city_id = pv.program_city', 'left');
		$this->db->join('regions r', 'r.region_id = pv.program_region', 'left');
		$this->db->where($where);
		$this->db->order_by('pv.program_id    DESC');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	public function updateStateregion($region_id, $state)
	{
		$states = implode(',', $state);
		$sql = "UPDATE states SET region_id = $region_id WHERE  state_id IN ($states)";
		$query = $this->db->query($sql);
	}

	public function first($table, $id)
	{
		return $this->db->select('*')->from($table)->where('emp_id', $id, false)->get()->row_array();
	}


	function get_prev_schedule_date($fields, $tbl_name, $where, $orderby)
	{
		$this->db->select($fields);
		$this->db->from($tbl_name);
		$this->db->where($where);
		$query = $this->db->order_by($orderby);
		$query = $this->db->limit(1, 1);
		$query = $this->db->get();
		$result =    $query->row_array();
		return $result;
	}
	public function reschedule_mail_to_user($data)
	{
		$mail = new PHPMailer();
		$to = $data['user_email'];
		$subject = $data['mode'] . '| reschedule ' . date("F d,Y h:i A", strtotime($data['old_schedule_date'] . ' ' . $data['old_schedule_time']));
		// $from = 'info@drycoder.com';
		$message = $this->load->view('admin/reschedule_mail_to_user', $data, true);
		$mail->IsSMTP();
		$mail->Host = 'mail.mgracesolution.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "testvms@mgracesolution.com";
		$mail->Password = "smvtset@1234";
		$mail->setFrom('testvms@mgracesolution.com');
		$mail->FromName = $subject;
		$mail->AddAddress($to);
		$mail->addBCC('pransi.g@neuralinfo.org');
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		if ($mail->Send()) {
			return 1;
		} else {
			return 0;
		}
	}
	public function schedule_mail_to_user($data)
	{
		$mail = new PHPMailer();
		$to = $data['user_email'];
		$subject = $data['mode'] . '|' . date("F d,Y h:i A", strtotime($data['schedule_date'] . ' ' . $data['schedule_time']));
		// $from = 'info@drycoder.com';
		$message = $this->load->view('admin/schedule_mail_to_user', $data, true);
		$mail->IsSMTP();
		$mail->Host = 'mail.mgracesolution.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "testvms@mgracesolution.com";
		$mail->Password = "smvtset@1234";
		$mail->setFrom('testvms@mgracesolution.com');
		$mail->FromName = $subject;
		$mail->AddAddress($to);
		$mail->addBCC('pransi.g@neuralinfo.org');
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		if ($mail->Send()) {
			return 1;
		} else {
			return 0;
		}
	}
	public function interview_final_mail($data)
	{
		$mail = new PHPMailer();
		$to = $data['user_email'];
		$subject = 'shotlisted';
		$message = $this->load->view('admin/interview_final_mail_to_user', $data, true);
		//$mail->IsSMTP();
		$mail->Host = 'mail.mgracesolution.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "testvms@mgracesolution.com";
		$mail->Password = "smvtset@1234";
		$mail->setFrom('testvms@mgracesolution.com');
		$mail->FromName = $subject;
		$mail->AddAddress($to);
		$mail->addBCC('pransi.g@neuralinfo.org');
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		if ($mail->Send()) {
			return 1;
		} else {
			return 0;
		}
	}
	public function shortlist_mail($data)
	{
		$mail = new PHPMailer();
		$to = $data['user_email'];
		$subject = 'shotlisted';
		// $from = 'info@drycoder.com';
		$message = $this->load->view('admin/shortlist_mail_to_user', $data, true);
		//$mail->IsSMTP();
		$mail->Host = 'mail.mgracesolution.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "testvms@mgracesolution.com";
		$mail->Password = "smvtset@1234";
		$mail->setFrom('testvms@mgracesolution.com');
		$mail->FromName = $subject;
		$mail->AddAddress($to);
		$mail->IsHTML(true);
		$mail->addBCC('pransi.g@neuralinfo.org');
		$mail->Subject = $subject;
		$mail->Body = $message;
		if ($mail->Send()) {
			return 1;
		} else {
			return 0;
		}
	}
	public function send_offer_letter($full_path, $file_name, $data)
	{
		$mail = new PHPMailer();
		$full_path = (file_get_contents($full_path));
		$to = $data['user_email'];
		$subject = 'Offer letter';
		// $from = 'info@drycoder.com';
		$message = $this->load->view('mailer/offer_letter_to_user', $data, true);
		//$mail->IsSMTP();
		$mail->Host = 'mail.mgracesolution.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "testvms@mgracesolution.com";
		$mail->Password = "smvtset@1234";
		$mail->setFrom('testvms@mgracesolution.com');
		$mail->FromName = $subject;
		$mail->AddAddress($to);
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->addBCC('ravishankar.k@neuralinfo.org');
		$mail->addstringAttachment($full_path, $file_name);
		$mail->Body = $message;
		if ($mail->Send()) {
			return 1;
		} else {
			return 0;
		}
	}
}
