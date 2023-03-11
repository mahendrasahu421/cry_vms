<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $CI = &get_instance();
        $CI->load->library('Get_library');
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }
    public function fetch_details($email, $password)
    {
        $this->db->select('password,userID,mailConfrmationStatus,verify,status,roleID,mobileConfrmationStatus');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->or_where('mobile', $email);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function email_exsist()
    {
        try {
            $this->db->initialize();
            $email = trim($this->input->post('VOLUNTEEREMAIL'));
            $looking_for = trim($this->input->post('SINGLE'));
            if ($looking_for == 'volunteering') {
                $this->db->select('*');
                $this->db->from('volunteer');
                $this->db->where(array('email' => $email));
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return 1;
                } else {
                    //$this->db->close();
                    return 0;
                }
            } else {
                $this->db->select('*');
                $this->db->from('interns');
                $this->db->where(array('email' => $email));
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return 1;
                } else {
                    //$this->db->close();
                    return 0;
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
        }
    }

    public function volunteer_programs_email_exsist()
    {
        try {
            $this->db->initialize();
            $email = trim($this->input->post('PROGRAME'));
            $this->db->select('*');
            $this->db->from('volunteer_program_users');
            $this->db->where(array('email' => $email));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return 1;
            } else {
                //$this->db->close();
                return 0;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
        }
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

    function select_all_city_by_task($state)
    {
        $this->db->initialize();
        $city = $this->db->select('c.city_id,c.city_name');
        $this->db->from('cities c');
        $this->db->where('c.state_id ', $state);
        $query = $this->db->get();
        $result = $query->result_array();
        //$this->db->close();	exit;
        return $result;
    }

    public function allDatavolunteers($where)
    {
        $this->db->initialize();
        $this->db->select('v.*,s.state_name,c.city_name,vd.*');
        $this->db->from('volunteer v');
        $this->db->join('volunteer_data vd', 'v.volunteer_id = vd.volunteer_id', 'left');
        $this->db->join('states s', 's.state_id = v.state_id', 'left');
        $this->db->join('cities c', 'c.city_id = v.city_id', 'left');
        $this->db->where('v.volunteer_id', $where);
        $query = $this->db->order_by('v.volunteer_id desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $result = $query->row_array();
        $this->db->close();
        return $result;
    }
    public function allDataintern($where)
    {
        $this->db->initialize();
        $this->db->select('i.*,i.intern_id as internID,s.state_name,c.city_name,id.*');
        $this->db->from('interns i');
        $this->db->join('interns_data id', 'i.intern_id = id.intern_id', 'left');
        $this->db->join('states s', 's.state_id = i.state_id', 'left');
        $this->db->join('cities c', 'c.city_id = i.city_id', 'left');
        $this->db->where('i.intern_id', $where);
        $query = $this->db->order_by('i.intern_id desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $result = $query->row_array();
        $this->db->close();
        return $result;
    }

    function assign_task_volunteer($cityID, $taskType,$skills)
    {
        //echo $taskID;exit;
        $vtype = '3,' . $taskType;
        $this->db->initialize();
        $this->db->select('v.volunteer_id,v.first_name,v.last_name,v.email,v.mobile,v.volunteer_skill,s.state_name,c.city_name');
        $this->db->from('volunteer v');
        $this->db->join('states s', 's.state_id = v.state_id', 'left');
        $this->db->join('cities c', 'c.city_id = v.city_id', 'left');
        $this->db->where('v.status =5');
        $this->db->where('v.state_id', $cityID);
        $this->db->where_in('v.vol_type_id', $vtype, false);
        $this->db->where_in('v.volunteer_skill', $skills, false);
        $this->db->order_by('v.volunteer_id   DESC');
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $result = $query->result_array();
        $this->db->close();
        return $result;
    }

    function assign_task_intern($cityID)
    {
        
        $this->db->initialize();
        $this->db->select('i.*,s.state_name,c.city_name');
        $this->db->from('interns i');
        $this->db->join('states s', 's.state_id = i.state_id', 'left');
        $this->db->join('cities c', 'c.city_id = i.city_id', 'left');
        $this->db->where('i.status =8');
        $this->db->where('i.state_id', $cityID);
        $this->db->order_by('i.intern_id   DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        // die;
        $result = $query->result_array();
        $this->db->close();
        return $result;
    }

    function assign_task_volunteer_taskType($cityID, $taskID, $volunteer_id)
    {
        $this->db->initialize();
        $this->db->select('as.volunteer_id');
        $this->db->from('assigning_task as');
        $this->db->where('as.volunteer_id', $volunteer_id);
        $this->db->where('as.task_id', $taskID);
        $this->db->order_by('as.assigned_task_id   DESC');
        $query = $this->db->get();
        //  echo $this->db->last_query();
        //  die;
        $result = $query->result_array();
        $this->db->close();
        return $result;
    }

    function assign_task_intern_taskType($cityID, $taskID, $intern_id)
    {
        $this->db->initialize();
        $this->db->select('iast.intern_id');
        $this->db->from('intern_assigning_task iast');
        $this->db->where('iast.intern_id', $intern_id);
        $this->db->where('iast.intern_task_id', $taskID);
        $this->db->order_by('iast.intern_assigned_task_id   DESC');
        $query = $this->db->get();
        //  echo $this->db->last_query();
        //  die;
        $result = $query->result_array();
        $this->db->close();
        return $result;
    }

    function get_all_program()
    {
        $this->db->initialize();
        $this->db->select('pv.*,s.state_name,r.region_name as region_name,c.city_name');
        $this->db->from('program_volunteer pv');
        $this->db->join('states s', 's.state_id = pv.program_state', 'left');
        $this->db->join('cities c', 'c.city_id = pv.program_city', 'left');
        $this->db->join('regions r', 'r.region_id = pv.program_region', 'left');
        $this->db->where('pv.status !=0');
        $this->db->order_by('pv.program_id    DESC');
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $result = $query->result_array();
        $this->db->close();
        return $result;
    }
}