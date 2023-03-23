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

	public function total_task_for_volunteer_region_wise($region)
	{
		$sql = $region == 0 ? "SELECT * FROM task WHERE status=1" : "SELECT * FROM task WHERE region_id = '" . $region . "'AND status=1";
		$querry = $this->db->query($sql);
		$count = $querry->result_array();
		return $count;
	}
	public function total_task_count_intern_region_wise($region)
	{
		$sql = $region == 0 ? "SELECT * FROM interntask WHERE status=1" : "SELECT * FROM interntask WHERE region_id = '" . $region . "'AND status=1";
		$querry = $this->db->query($sql);
		$count = $querry->num_rows();
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
		$this->db->from('interntask it');
		$this->db->where('task_for = 2');
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

	public function last_five_pending_volunteer($statesID = 0)
	{
		$sql = $statesID == 0 ? "SELECT * FROM volunteer WHERE ORDER BY volunteer_id DESC LIMIT  5 status=1 " : "SELECT * FROM volunteer WHERE state_id IN ($statesID) AND status=1 ORDER BY volunteer_id DESC LIMIT  5";
		$querry = $this->db->query($sql);
		$count = $querry->result_array();
		return $count;
	}

	public function total_intern_region_wise($statesID = 0)
	{
		$sql = $statesID == 0 ? "SELECT * FROM interns WHERE status=8" : "SELECT * FROM interns WHERE state_id IN ($statesID) AND status=8";
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
		$sql = $statesID == 0 ? "SELECT * FROM interns WHERE status=8" : "SELECT * FROM interns WHERE state_id IN ($statesID) AND status=5";
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
		//$this->db->limit(10);  
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

	function intern_submission_report($where)
	{
		$this->db->initialize();
		$this->db->select('ism.*,i.intern_id,i.first_name,i.last_name,i.mobile,i.email,s.state_name,c.city_name');
		$this->db->from('intern_submission_report ism');
		$this->db->join('interns i', 'i.intern_id = ism.intern_id');
		$this->db->join('states s', 's.state_id = i.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('ism.intern_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	public function submission_reportData($where)
	{
		$this->db->initialize();
		$this->db->select('isr.*,ist.*,it.task_title,i.first_name,i.last_name');
		$this->db->from('intern_submission_report isr');
		$this->db->join('intern_assigning_task ist', 'ist.intern_id = isr.intern_id');
		$this->db->join('interntask it', 'ist.intern_task_id = it.intern_task_id');
		$this->db->join('interns i', 'i.intern_id = isr.intern_id');
		$this->db->where($where);
		$query = $this->db->order_by('isr.sr_id desc');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function volunteer_enquiry_Data_count($where)
	{

		$this->db->initialize();
		$this->db->select('v.volunteer_id,v.first_name,v.last_name,v.mobile,v.email,v.state_id,v.city_id,v.creation_date');
		$this->db->from('volunteer v');
		$this->db->where($where);
		$query = $this->db->order_by('volunteer_id desc');
		$query = $this->db->get();
		$result = $query->num_rows();
		// echo $this->db->last_query();
		// die;
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
		// echo $this->db->last_query();
		// die;
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
		$this->db->select('i.*,s.state_name,c.city_name,is.skill_name,is.skill_id');
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

	public function get_all_intern_onlineOffline($where)
	{
		$this->db->initialize();
		$this->db->select('i.*,s.state_name,c.city_name,is.*,vt.*');
		$this->db->from('interns i');
		$this->db->join('states s', 's.state_id = i.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
		$this->db->join('skills is', 'is.skill_id = i.skill_id', 'left');
		$this->db->join('volunteer_type vt', 'vt.vol_type_id = i.internshipType', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('intern_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->row_array();
		$this->db->close();
		return $result;
	}

	function get_all_employee()
	{
		$this->db->initialize();
		$this->db->select('e.*,s.state_name as state_name,mr.role_name,rm.region_name');
		$this->db->from('employee e');
		$this->db->join('states s', 's.state_id = e.sid', 'left');
		//$this->db->join('cities c', 'c.ci_id = e.ci_id', 'left');
		// $this->db->join('pravasi_designation pd', 'pd.des_id  = e.des_id', 'left');
		$this->db->join('master_role mr', 'mr.role_id  = e.role_id', 'left');
		$this->db->join('regions rm', 'rm.region_id  = e.region_id', 'left');
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
		$this->db->select('t.*,s.skill_name as keywords');
		$this->db->from('task t');
		$this->db->join('skills s', 's.skill_id  = t.keyword', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('task_id desc');
		$query = $this->db->get();
		// echo $this->db->last_query();
		//  die;
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

	public function count_send_mail($val)
	{
		$this->db->initialize();
		$updateCount = "UPDATE intern_submission_report SET `status` = 3  WHERE intern_id ='" . $val . "'";
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}

	public function update_send_certificate_mail($volunteerEmail)
	{
		$this->db->initialize();
		$updateCount = "UPDATE volunteer SET mail_count = mail_count + 1,status=2 WHERE email ='" . $volunteerEmail . "'";
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}


	public function sended_certificate_to_inters($val)
	{
		$this->db->initialize();
		$updateCount = "UPDATE intern_submission_report SET status = 3 WHERE intern_id ='" . $val . "'";
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}


	public function certificate_send($val)
	{
		$this->db->initialize();
		$updateCount = "UPDATE intern_submission_report SET status = 3 WHERE intern_id ='" . $val . "'";
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}
	public function sent_certificate_to_intern($val)
	{
		$this->db->initialize();
		$updateCount = "UPDATE interns SET certificate_status = 1 WHERE intern_id ='" . $val . "'";
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}


	public function feedbackcertificate_send($val)
	{
		$this->db->initialize();
		$updateCount = "UPDATE feedback SET status = 2 creation_date = date('Y-m-d) WHERE intern_id ='" . $val . "'";
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
	public function intern_status_update($intern_id)
	{
		$this->db->initialize();
		$updateCount = "UPDATE interns SET status=6 WHERE intern_id ='" . $intern_id . "'";
		$querry = $this->db->query($updateCount);
		//$count = $querry->num_rows();
		return true;
	}


	function check_status($status)
	{

		switch ($status) {
			case "1":
				echo "Onboarding-Candidate";
				break;
			case "2":
				echo "Shortlisted";
				break;
			case "3":
				echo "Interview Scheduled";
				break;
			case "4":
				echo "Interview Ongoing";
				break;
			case "5":
				echo "Interview Cleared";
				break;
			case "6":
				echo "Sent Offer Letter";
				break;
			case "7":
				echo "Post Registraion Completed";
				break;
			case "8":
				echo "Candidate Onboarded";
				break;
			case "9":
				echo "Inactive User";
				break;
			case "10":
				echo "Candidate rejected";
				break;
		}
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
	public function intern_count_send_maillogincredational($intern_id, $creation_date)
	{
		$this->db->initialize();
		$pass = 'intern12345';
		$newpass = md5($pass);
		$updateCount = "UPDATE interns SET  `password`= '$newpass',`status`=8,`creation_date`= '" . $creation_date . "' WHERE intern_id ='" . $intern_id . "'";

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

	function intern_post_registration_report($where)
	{
		$this->db->initialize();
		$this->db->select('i.intern_id,i.first_name,i.last_name,i.date_of_birth,i.mobile,i.email,i.state_id,i.city_id,i.creation_date,i.cv_file,i.status,s.state_name,c.city_name');
		$this->db->from('interns i');
		$this->db->join('states s', 's.state_id = i.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('intern_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function intern_pre_registration_report($where)
	{
		$this->db->initialize();
		$this->db->select('i.intern_id,i.first_name,i.last_name,i.date_of_birth,i.mobile,i.email,i.state_id,i.city_id,i.creation_date,i.cv_file,i.status,s.state_name,c.city_name');
		$this->db->from('interns i');
		$this->db->join('states s', 's.state_id = i.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('i.intern_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function assign_task_volunteer_taskType($where)
	{
		$this->db->initialize();
		$this->db->select('as.volunteer_id,as.assigned_date,as.task_id,v.first_name,v.last_name,v.email,v.mobile,t.task_title');
		$this->db->from('assigning_task as');
		$this->db->join('task t', 't.task_id = as.task_id', 'left');
		$this->db->join('volunteer v', 'v.volunteer_id = as.volunteer_id', 'left');
		$this->db->where($where);
		$this->db->order_by('as.assigned_task_id   DESC');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function assign_task_intern_taskType($where)
	{
		$this->db->initialize();
		$this->db->select('ias.intern_id,ias.assigned_date,i.first_name,i.last_name,i.email,i.mobile,it.task_title');
		$this->db->from('intern_assigning_task ias');
		$this->db->join('interntask it', 'it.intern_task_id = ias.intern_task_id', 'left');
		$this->db->join('interns i', 'i.intern_id = ias.intern_id', 'left');
		$this->db->where($where);
		$this->db->order_by('ias.intern_assigned_task_id   DESC');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// die;
		$result = $query->result_array();
		$this->db->close();
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
		$mail->Host = 'smtp.office365.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "noreply@crymail.org";
		$mail->Password = "^%n7wh#m7_2k";
		$mail->setFrom('noreply@crymail.org');
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
		$subject = $data['mode'] . '|' . date("F d,Y h:i A", strtotime($data['old_schedule_date'] . ' ' . $data['old_schedule_time']));
		// $from = 'info@drycoder.com';
		$message = $this->load->view('admin/schedule_mail_to_user', $data, true);
		$mail->IsSMTP();
		$mail->Host = 'smtp.office365.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "noreply@crymail.org";
		$mail->Password = "^%n7wh#m7_2k";
		$mail->setFrom('noreply@crymail.org');
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
		$subject = 'Interview Process';
		$message = $this->load->view('admin/interview_final_mail_to_user', $data, true);
		$mail->IsSMTP();
		$mail->Host = 'smtp.office365.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "noreply@crymail.org";
		$mail->Password = "^%n7wh#m7_2k";
		$mail->setFrom('noreply@crymail.org');
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
		$subject = 'CRY VMS Shotlisted User';
		// $from = 'info@drycoder.com';
		$message = $this->load->view('admin/shortlist_mail_to_user', $data, true);
		$mail->IsSMTP();
		$mail->Host = 'smtp.office365.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "noreply@crymail.org";
		$mail->Password = "^%n7wh#m7_2k";
		$mail->setFrom('noreply@crymail.org');
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



	function assign_task_volunteer($cityID, $taskType)
	{
		$vtype = '3,' . $taskType;
		$this->db->initialize();
		$this->db->select('v.*,s.state_name,c.city_name');
		$this->db->from('volunteer v');
		$this->db->join('states s', 's.state_id = v.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = v.city_id', 'left');
		$this->db->where('v.status =5');
		$this->db->where('v.state_id', $cityID);
		$this->db->where_in('v.vol_type_id', $vtype, false);
		$this->db->order_by('v.volunteer_id   DESC');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	public function send_offer_letter($full_path, $file_name, $data, $url)
	{
		$mail = new PHPMailer();
		$full_path = (file_get_contents($full_path));
		$data['url'] = $url;
		$to = $data['email'];
		$subject = 'Offer letter From CRY VMS';
		// $from = 'info@drycoder.com';
		$message = $this->load->view('admin/offer_letter_to_user', $data, true);
		$mail->IsSMTP();
		$mail->Host = 'smtp.office365.com';
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Port = 587;
		$mail->Username = "noreply@crymail.org";
		$mail->Password = "^%n7wh#m7_2k";
		$mail->setFrom('noreply@crymail.org');
		$mail->FromName = $subject;
		$mail->AddAddress($to);
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->addBCC('pransi.g@neuralinfo.org');
		$mail->addstringAttachment($full_path, $file_name);
		$mail->Body = $message;
		if ($mail->Send()) {
			return 1;
		} else {
			return 0;
		}
	}


	public function offerLetterData($where)
	{ {
			$this->db->initialize();
			$this->db->select('i.*,s.state_name,c.city_name,cfm.certificate_type,cfm.certificate_path');
			$this->db->from('interns i');
			$this->db->join('states s', 's.state_id = i.state_id', 'left');
			$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
			$this->db->join('certificate_format_master cfm', 'cfm.certificate_id = vpu.certificate_id', 'left');
			$this->db->where($where);
			$query = $this->db->order_by('id desc');
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			$result = $query->result_array();
			$this->db->close();
			return $result;
		}
	}

	function rate_and_reviewData($where)
	{
		$this->db->initialize();
		$this->db->select('fd.intern_id,i.intern_id,i.first_name,i.last_name,i.mobile,i.email,s.state_name,c.city_name');
		$this->db->from('feedback fd');
		$this->db->join('interns i', 'i.intern_id = fd.intern_id');
		$this->db->join('states s', 's.state_id = i.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('fd.intern_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}


	public function get_all_feedback($where)
	{
		$this->db->initialize();
		$this->db->select('fd.*,i.intern_id,i.first_name,i.last_name,i.mobile,i.email,');
		$this->db->from('feedback fd');
		$this->db->join('interns i', 'i.intern_id = fd.intern_id');
		//$this->db->where($where);
		$query = $this->db->order_by('fd.intern_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->row_array();
		$this->db->close();
		return $result;
	}

	public function submission_report_attecment($userID)
	{
		$this->db->initialize();
		$this->db->select('at.attachmentName,at.intern_id');
		$this->db->from('attachment at');
		$this->db->join('interns i', 'i.intern_id = at.intern_id');
		$this->db->join('intern_submission_report isr', 'isr.sr_id = at.sr_id');
		$this->db->where('at.intern_id = "' . $userID . '"');
		$query = $this->db->order_by('at.attachmentID desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	public function send_certificate_by_feedback($where, $empId, $role)
	{
		$this->db->initialize();
		$this->db->select('fd.status,emp.emp_name,emp.emp_email,emp.des_id,mr.role_name,fd.intern_id,fd.creation_date,id.name_of_school,i.certificate_email,i.status,i.skill_id,sk.skill_name,i.first_name,i.last_name,i.email,i.state_id,i.city_id,i.mobile,isr.status,s.state_name,c.city_name,d.des_name');
		$this->db->from('feedback fd');
		$this->db->join('intern_submission_report isr', 'isr.intern_id = fd.intern_id');
		$this->db->join('interns i', 'i.intern_id = fd.intern_id');
		$this->db->join('interns_data id', 'id.intern_id = fd.intern_id');
		$this->db->join('states s', 's.state_id = i.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
		$this->db->join('employee emp', 'emp.emp_id = "' . $empId . '"');
		$this->db->join('master_role mr', 'mr.role_id = "' . $role . '"');
		$this->db->join('designation d', 'd.des_id = emp.des_id');
		$this->db->join('skills sk', 'sk.skill_id = i.skill_id');
		$this->db->where($where);
		$query = $this->db->order_by('fd.feedback_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	public function fetch_emp_data($where)
	{
		$this->db->initialize();
		$this->db->select('e.*,mr.role_name,mr.role_id,dd.des_name,s.state_name');
		$this->db->from('employee e');
		$this->db->join('master_role mr', 'mr.role_id = e.role_id');
		$this->db->join('regions rd', 'rd.region_id = e.region_id');
		$this->db->join('designation dd', 'e.des_id = e.des_id');
		$this->db->join('states s', 's.state_id = e.sid');
		$this->db->where($where);
		$query = $this->db->order_by('e.emp_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->row_array();
		$this->db->close();
		return $result;
	}

	public function all_assign_task($where)
	{
		$this->db->initialize();
		$this->db->select('ast.*,t.task_id,t.task_title');
		$this->db->from('assigning_task ast');
		$this->db->join('task t', 't.task_id = ast.task_id');
		$this->db->where($where);
		$query = $this->db->group_by('ast.task_id', 'desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	public function all_assign_task_intern($where)
	{
		$this->db->initialize();
		$this->db->select('iast.*,it.intern_task_id,it.task_title');
		$this->db->from('intern_assigning_task iast');
		$this->db->join('interntask it', 'it.intern_task_id = iast.intern_task_id');
		$this->db->where($where);
		$query = $this->db->group_by('iast.intern_task_id');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	public function volunteer_by_assign_task($where)
	{
		$this->db->initialize();
		$this->db->select('as.*,v.volunteer_id,v.first_name,v.last_name,v.email,v.mobile,t.task_id');
		$this->db->from('assigning_task as');
		$this->db->join('volunteer v', 'v.volunteer_id = as.volunteer_id');
		$this->db->join('task t', 't.task_id = as.task_id');
		$this->db->where($where);
		$query = $this->db->order_by('as.volunteer_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}
	public function intern_by_assign_task($where)
	{
		$this->db->initialize();
		$this->db->select('iast.*,i.intern_id,i.first_name,i.last_name,i.email,i.mobile,it.intern_task_id');
		$this->db->from('intern_assigning_task iast');
		$this->db->join('interns i', 'i.intern_id = iast.intern_id');
		$this->db->join('interntask it', 'it.intern_task_id = iast.intern_task_id');
		$this->db->where($where);
		$query = $this->db->order_by('iast.intern_task_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}


	public function edit_task($where)
	{
		$this->db->initialize();
		$this->db->select('t.*');
		$this->db->from('task t');
		$this->db->join('state s', 's.state_id = t.state_id');
		$this->db->where($where);
		$query = $this->db->order_by('iast.intern_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function full_volunteer_data_to_excel($where)
	{

		$this->db->initialize();
		$this->db->select('v.volunteer_id,v.first_name,v.last_name,v.mobile,v.email,v.state_id,v.city_id,v.creation_date,s.state_name,c.city_name');
		$this->db->from('volunteer v');
		//$this->db->limit(10);  
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



	public function send_certificate_to_intern($where, $empId, $role)
	{
		$this->db->initialize();
		$this->db->select('fd.status,emp.emp_name,emp.emp_email,emp.des_id,mr.role_name,fd.intern_id,fd.creation_date,id.name_of_school,i.certificate_email,i.status,i.skill_id,sk.skill_name,i.first_name,i.last_name,i.email,i.state_id,i.city_id,i.mobile,isr.status,s.state_name,c.city_name,d.des_name');
		$this->db->from('feedback fd');
		$this->db->join('intern_submission_report isr', 'isr.intern_id = fd.intern_id');
		$this->db->join('interns i', 'i.intern_id = fd.intern_id');
		$this->db->join('interns_data id', 'id.intern_id = fd.intern_id');
		$this->db->join('states s', 's.state_id = i.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
		$this->db->join('employee emp', 'emp.emp_id = "' . $empId . '"');
		$this->db->join('master_role mr', 'mr.role_id = "' . $role . '"');
		$this->db->join('designation d', 'd.des_id = emp.des_id');
		$this->db->join('skills sk', 'sk.skill_id = i.skill_id');
		$this->db->where($where);
		$query = $this->db->order_by('fd.feedback_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}


	public function assign_task_vol($where)
	{ {
			$this->db->initialize();
			$this->db->select('t.*');
			$this->db->from('task t');

			$this->db->where($where);
			$this->db->where("t.expected_end_date>", date('Y-m-d'));
			$query = $this->db->order_by('task_id desc');
			$query = $this->db->get();
			//  echo $this->db->last_query();
			//  die;
			$result = $query->result_array();
			$this->db->close();
			return $result;
		}
	}
	public function hr_process_intern($where)
	{
		$this->db->initialize();
		$this->db->select('i.*,s.state_name,c.city_name');
		$this->db->from('interns i');
		$this->db->join('states s', 's.state_id = i.state_id', 'left');
		$this->db->join('cities c', 'c.city_id = i.city_id', 'left');
		$this->db->where($where);
		$query = $this->db->order_by('i.intern_id desc');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result = $query->row_array();
		$this->db->close();
		return $result;
	}

	public function count_fale_user($where)
	{
		$this->db->initialize();
		$this->db->select('v.gender');
		$this->db->from('volunteer v');
		$this->db->where('state_id = "'.$where.'" AND gender = 1');
		$this->db->where('state_id = "'.$where.'" AND gender = 2');
		$query = $this->db->get();
		$count = $query->num_rows($query);
		echo $count;
	}
	public function female_count($where)
	{
		$this->db->initialize();
		$this->db->select('v.gender');
		$this->db->from('volunteer v');
		
		$query = $this->db->get();
		$count = $query->num_rows($query);
		echo $count;
	}
}