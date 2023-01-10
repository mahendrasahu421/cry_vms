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
   public function total_field_count()
   {
	  $this->db->select('*');
	  $this->db->from('user_data');
	  $query = $this->db->get();
	  $fields  = $query->num_fields("array"); 
	  //var_dump($query->num_fields());
	  return $fields;
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
   
	
	
}
