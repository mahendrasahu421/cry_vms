<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_model extends CI_Model{

    function __construct()
    {
        parent :: __construct();
        
        $CI =& get_instance();
        $CI->load->library('Get_library');
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');

	}
	public function get_total_volunteering_hours(){	   
	    $sql="SELECT sum(admin_time) as tvh FROM `approveddaily_report` where status=1";
		$d = $this->db->query($sql);
		$result = $d->result_array();
		return $result;
   }
    public function get_rewarded_users()
   {
		$this->db->select('SUM(`admin_time`) AS admin_time,userID,taskID,vself_task_id');
		$this->db->from('approveddaily_report');
		$this->db->group_by('userID');
		$this->db->order_by('admin_time desc');
		$this->db->limit(3);
		$query = $this->db->get();
		$result=$query->result_array();
		//echo $this->db->last_query();
       // die();
		return $result;
   }
	
   
	
	
}
