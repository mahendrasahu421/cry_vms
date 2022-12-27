<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_model extends CI_Model{

    function __construct()
    {
        parent :: __construct();
        
        $CI =& get_instance();
        $CI->load->library('Get_library');
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');

    }
    public function total_volunteer_count()
	{
		$dioceses_id = $this->session->userdata('dioceses_id');
		$this->db->select('dioceses_id');
		$this->db->from('user_data');
		$this->db->where('status',1);
		$this->db->where('dioceses_id',$dioceses_id);
		$query = $this->db->get();
		$count= $query->num_rows("array");
		return $count;             
	}
	
	function userimg_file($img, $userID){
		$data = array(
		 'profile_img' =>$img,
		);
        if($this->db->where(array("dioceses_id"=>$userID))->update("dioceses",$data))
		{ 
		return TRUE;
		}else { 
		return FALSE; 
		}
	}
	
	
}
