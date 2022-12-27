<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

    function __construct()
    {
        parent :: __construct();
        
        $CI =& get_instance();
        $CI->load->library('Get_library');
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');

	}
	public function fetch_daily_report($where_task){	   
	    $sql="SELECT * FROM task u, daily_report ta where u.taskID = ta.taskID and $where_task";
		$d = $this->db->query($sql);
		$result = $d->result_array();
		return $result;
   }
	public function fetch_details()
	{
		
	}
	
	function check_user_password($userID){
		$this->db->select('password');
		$this->db->from('users');
		$this->db->where('userID',$userID);
		$query = $this->db->get();
		//echo $this->db->last_query();
        //die();
		return $query->row_array();
   }
   public function total_task_count($userID)
	{
		$this->db->select('assigningTaskID');
		$this->db->from('assigning_task');
		$this->db->where('userID',$userID);
		$query = $this->db->get();
		$count= $query->num_rows("array");
		return $count;             
	}
   public function total_field_count($userID)
   {
	  //$this->db->select('*');
	  //$this->db->from('user_data');
	  //$query = $this->db->get();
	  //$fields  = $query->num_fields("array"); 
	  //var_dump($query->num_fields());
	  //return $fields;
	  
	   $percentage = 0;
       $sql ="SELECT * FROM user_data  WHERE userID=$userID";
       $d = $this->db->query($sql);

      if ($d->num_rows() > 0)
          { 
            $notEmpty =   0;
            $totalField = 25;
            foreach ($d->result() as $row)
              {
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
          $percentage = $notEmpty/$totalField *100;
          }
        return $percentage;
   }
   public function fetch_my_task($where_task)
   {
		$sql="SELECT * FROM task u, user_area_of_interest uai, assigning_task ta where u.taskID = ta.taskID and $where_task GROUP BY ta.taskID";
		$d = $this->db->query($sql);
		//echo $this->db->last_query(); exit();
		$result = $d->result_array();
		return $result;
   }
   public function timein_calculate($userID)
   {
		$this->db->select('SUM(`dailyReportTimeIn`) AS dailyReportTimeIn ');
		$this->db->from('daily_report');
		$this->db->where('userID',$userID);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit();
		$result= $query->result_array();
		return $result;
   }
   public function timeout_calculate($userID)
   {
		$this->db->select('SUM(`dailyReportTimeOut`) AS dailyReportTimeOut ');
		$this->db->from('daily_report');
		$this->db->where('userID',$userID);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit();
		$result=$query->result_array();
		return $result;
   }
   public function column_count($userID)
   {
		$row = $this->db
			->get_where('user_data', ['userID' => $userID])
			->row_array();
			return $row;
   }
   function userimg_file($img, $userID){
		$data = array(
		 'profile' =>$img,
		);
        if($this->db->where(array("userID"=>$userID))->update("user_data",$data))
		{ 
		return TRUE;
		}else { 
		return FALSE; 
		}
	}
	
   public function fetch_find_task($where_task)
   {
		$sql="SELECT * FROM task u, user_area_of_interest uai, assigning_task ta , task_location tl where u.taskID = ta.taskID and $where_task GROUP BY ta.taskID";
		$d = $this->db->query($sql);
		//echo $this->db->last_query(); exit();
		$result = $d->result_array();
		return $result;
   }
   public function fetch_my_task_final($where_task){	   
	    $sql="SELECT * FROM task u, assigning_task ta where u.taskID = ta.taskID and $where_task ";
		$d = $this->db->query($sql);
		//echo $this->db->last_query(); exit();
		$result = $d->result_array();
		return $result;
   }
   
	
	
}
