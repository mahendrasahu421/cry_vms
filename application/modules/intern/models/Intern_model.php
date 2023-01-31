<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Intern_model extends CI_Model
{



	function __construct()

	{

		parent::__construct();



		$CI = &get_instance();

		$CI->load->library('Get_library');

		$this->load->database();

		date_default_timezone_set('Asia/Kolkata');
	}


	public function fetch_daily_report($where_task)
	{

		$sql = "SELECT * FROM task u, daily_report ta where u.taskID = ta.taskID and $where_task";

		$d = $this->db->query($sql);

		$result = $d->result_array();

		return $result;
	}

	public function fetch_details()

	{
	}



	function check_user_password($userID)
	{

		$this->db->select('password');

		$this->db->from('users');

		$this->db->where('userID', $userID);

		$query = $this->db->get();

		//echo $this->db->last_query();

		//die();

		return $query->row_array();
	}

	//    public function total_task_count($userID)

	// 	{

	// 		$this->db->select('assigningTaskID');

	// 		$this->db->from('assigning_task');

	// 		$this->db->where('status',1);

	// 		$this->db->where('userID',$userID);

	// 		$query = $this->db->get();

	// 		$count= $query->num_rows("array");

	// 		return $count;             

	// 	}

	public function total_field_count($userID)

	{

		$percentage = 0;

		$sql = "SELECT * FROM user_data  WHERE userID=$userID";

		$d = $this->db->query($sql);



		if ($d->num_rows() > 0) {

			$notEmpty =   0;

			$totalField = 28;

			foreach ($d->result() as $row) {

				$notEmpty +=  ($row->dateOfBirth != '') ? 1 : 0;

				$notEmpty +=  ($row->gender != '') ? 1 : 0;

				$notEmpty +=  ($row->govt_name != '') ? 1 : 0;

				$notEmpty +=  ($row->nationalityID != '') ? 1 : 0;

				$notEmpty +=  ($row->bloodGroupID != '') ? 1 : 0;

				$notEmpty +=  ($row->educationID != '') ? 1 : 0;

				$notEmpty +=  ($row->occupationID != '') ? 1 : 0;

				$notEmpty +=  ($row->stateID != '') ? 1 : 0;

				$notEmpty +=  ($row->cityID != '') ? 1 : 0;

				$notEmpty +=  ($row->permanentState != '') ? 1 : 0;

				$notEmpty +=  ($row->permanentCity != '') ? 1 : 0;

				$notEmpty +=  ($row->correspontenceAddress != '') ? 1 : 0;

				$notEmpty +=  ($row->permanentAddress != '') ? 1 : 0;

				$notEmpty +=  ($row->time_duration != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_name	 != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_relation != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_contact != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_email != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_address != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_name != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_relation != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_contact != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_email != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_address != '') ? 1 : 0;

				$notEmpty +=  ($row->profile != '') ? 1 : 0;

				$notEmpty +=  ($row->policy_status != '') ? 1 : 0;

				$notEmpty +=  ($row->linkedin != '') ? 1 : 0;

				$notEmpty +=  ($row->twitter != '') ? 1 : 0;
			}

			$percentage = $notEmpty / $totalField * 100;
		}

		return $percentage;
	}

	public function total_field_count123($userID)

	{

		//$this->db->select('*');

		//$this->db->from('user_data');

		//$query = $this->db->get();

		//$fields  = $query->num_fields("array"); 

		//var_dump($query->num_fields());

		//return $fields;



		$percentage = 0;

		$sql = "SELECT * FROM user_data  WHERE userID=$userID";

		$d = $this->db->query($sql);



		if ($d->num_rows() > 0) {

			$notEmpty =   0;

			$totalField = 25;

			foreach ($d->result() as $row) {

				$notEmpty +=  ($row->dateOfBirth != '') ? 1 : 0;

				$notEmpty +=  ($row->gender != '') ? 1 : 0;

				$notEmpty +=  ($row->govt_name != '') ? 1 : 0;

				$notEmpty +=  ($row->nationalityID != '') ? 1 : 0;

				$notEmpty +=  ($row->bloodGroupID != '') ? 1 : 0;

				$notEmpty +=  ($row->educationID != '') ? 1 : 0;

				$notEmpty +=  ($row->occupationID != '') ? 1 : 0;

				$notEmpty +=  ($row->stateID != '') ? 1 : 0;

				$notEmpty +=  ($row->cityID != '') ? 1 : 0;

				$notEmpty +=  ($row->permanentState != '') ? 1 : 0;

				$notEmpty +=  ($row->permanentCity != '') ? 1 : 0;

				$notEmpty +=  ($row->correspontenceAddress != '') ? 1 : 0;

				$notEmpty +=  ($row->permanentAddress != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_name	 != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_relation != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_contact != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_email != '') ? 1 : 0;

				$notEmpty +=  ($row->ref1_address != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_name != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_relation != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_contact != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_email != '') ? 1 : 0;

				$notEmpty +=  ($row->ref2_address != '') ? 1 : 0;

				$notEmpty +=  ($row->profile != '') ? 1 : 0;

				$notEmpty +=  ($row->policy_status != '') ? 1 : 0;
			}

			$percentage = $notEmpty / $totalField * 100;
		}

		return $percentage;
	}

	public function fetch_my_task($where_task)

	{

		$sql = "SELECT * FROM task u, user_area_of_interest uai, assigning_task ta where u.taskID = ta.taskID and $where_task GROUP BY ta.taskID";

		$d = $this->db->query($sql);

		//echo $this->db->last_query(); exit();

		$result = $d->result_array();

		return $result;
	}

	public function timein_calculate($userID)

	{

		$this->db->select('SUM(`dailyReportTimeIn`) AS dailyReportTimeIn ');

		$this->db->from('daily_report');

		$this->db->where('userID', $userID);

		$query = $this->db->get();

		//echo $this->db->last_query(); exit();

		$result = $query->result_array();

		return $result;
	}

	public function timeout_calculate($userID)

	{

		$this->db->select('SUM(`dailyReportTimeOut`) AS dailyReportTimeOut ');

		$this->db->from('daily_report');

		$this->db->where('userID', $userID);

		$query = $this->db->get();

		//echo $this->db->last_query(); exit();

		$result = $query->result_array();

		return $result;
	}

	public function column_count($userID)

	{

		$row = $this->db

			->get_where('user_data', ['userID' => $userID])

			->row_array();

		return $row;
	}

	function userimg_file($img, $userID)
	{

		$data = array(

			'profile' => $img,

		);

		if ($this->db->where(array("userID" => $userID))->update("user_data", $data)) {

			return TRUE;
		} else {

			return FALSE;
		}
	}



	public function fetch_find_task($where_task)

	{

		$sql = "SELECT * FROM task u, user_area_of_interest uai, assigning_task ta , task_location tl where u.taskID = ta.taskID and $where_task GROUP BY ta.taskID";

		$d = $this->db->query($sql);

		//echo $this->db->last_query(); exit();

		$result = $d->result_array();

		return $result;
	}

	public function fetch_my_task_final($where_task)
	{

		$sql = "SELECT * FROM task u, assigning_task ta where u.taskID = ta.taskID and $where_task ";

		$d = $this->db->query($sql);

		//echo $this->db->last_query(); exit();

		$result = $d->result_array();

		return $result;
	}

	function check_user_donation($userID)
	{

		$this->db->select('SUM(`amount`) AS amount, status');

		$this->db->from('vol_donation_data');

		$this->db->where('status', 'SUCCESS');

		$this->db->where('volunteer_id', $userID);

		$query = $this->db->get();

		//echo $this->db->last_query();

		//die();

		return $query->row_array();
	}


	public function total_task_count($intern_id)
	{
		$this->db->select('intern_assigned_task_id');
		$this->db->from('intern_assigning_task');
		$this->db->where('status', 0);
		$this->db->where('intern_id', $intern_id);
		$this->db->group_by('intern_task_id');
		$query = $this->db->get();
		$count = $query->num_rows("array");
		return $count;
	}


	function get_intern_transfer_city($intern_id)
	{
		$this->db->initialize();
		$this->db->select('it.*,s.state_name as state_name,sw.state_name as relocate_state_name, c.city_name as city_name,it.*');
		$this->db->from('intern_transfer it');
		$this->db->join('states s', 's.state_id = it.current_state', 'left');
		$this->db->join('states sw', 'sw.state_id = it.relocate_state', 'left');
		$this->db->join('cities c', 'c.city_id  = it.relocate_city', 'left');
		$this->db->where('it.intern_id', $intern_id);
		//$this->db->where('vt.status !=0');
		$this->db->order_by('it.relocate_id   DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}

	function intern_assignTask($where)
	{
		$this->db->initialize();
		$this->db->select('ist.*,it.*');
		$this->db->from('intern_assigning_task ist');
		$this->db->join('interntask it', 'it.intern_task_id = ist.intern_task_id');
		$this->db->where($where);
		$this->db->order_by('ist.intern_assigned_task_id   DESC');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// die();
		$result = $query->result_array();
		$this->db->close();
		return $result;
	}
}
