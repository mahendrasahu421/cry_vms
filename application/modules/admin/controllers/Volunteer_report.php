<?php 
use SebastianBergmann\Exporter\Exporter;
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Volunteer_report extends MY_Controller
{
    public $nama_tabel = 'volunteer';
    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        // if ($this->session->userdata('userID')) {
        //     if ($this->session->userdata('roleID') == 2) {
        //         echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        //     } else {
        //     }
        // } else {
        //     echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        // }
        $CI = &get_instance();
        $CI->load->library('Get_library');
        $this->load->library('upload');
        $this->load->library('csvimport');
        //$this->load->library("PHPExcel");
        $this->load->helper('url');
        $this->load->library("pagination");
        $this->load->model('crud/Crud_modal');
        $this->load->model('curl/Curl_model');
        $this->load->model('users/User_model');
        $this->load->model('admin/Admin_model');
        $this->load->library('Phpmailer');
        $this->load->library('Fpdf_gen');

        date_default_timezone_set('Asia/Kolkata');
    }

    public function pre_registration_volunteer_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=1)";
                        $data['volunteer'] = $this->Admin_model->full_volunteer_data_to_excel($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    'v.status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=1)";
                        $data['volunteer'] = $this->Admin_model->full_volunteer_data_to_excel($where);
                    }
                }
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('pre-registration-volunteer-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function post_registration_volunteer_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =4';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=4)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    'v.status =4';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=4)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('post-registration-volunteer-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function onboard_volunteer()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'v.status =5';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {

                        $date2 = $data['date_to'] = date("Y-m-d");
                        $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                        'v.status =5';
                        if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                            $state_name = $this->input->post('state_name');
                            $date1 = $this->input->post('start_new');
                            $date2 = $this->input->post('end_new');
                            $date_from = date("Y-m-d", strtotime($date1));
                            $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                            $data['creation_date'] = $date1;
                            $data['creation_date'] = $date2;
                            $data['state_name'] = $state_name;
                            $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=5)";
                            $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                        }
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    'v.status =5';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=5)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('onboard-volunteer', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function volunteer_assign_task()
    {

        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = 'status =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "") {
                        $taskType = $this->input->post('taskType');
                        $taskName = $this->input->post('taskName');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['assigned_date'] = $date1;
                        $data['assigned_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $where = "assigned_date>='" . $date_from . "' and assigned_date<='" . $date_to . "' and as.task_id=" . $taskName . "  and (as.status=1)";
                        $data['volunteerDetails'] = $this->Admin_model->assign_task_volunteer_taskType($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    'v.status =5';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                        $state_name = $this->input->post('state_name');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['assigned_date'] = $date1;
                        $data['assigned_date'] = $date2;
                        $data['state_name'] = $state_name;
                        $where = "assigned_date>='" . $date_from . "' and assigned_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=5)";
                        $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                    }
                }
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('volunteer-assign-task', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function task_report()
    {
        try {
            if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
                $region = $this->session->userdata('region_id');
                $role = $this->session->userdata('role_id');
                if ($role == 1) {
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-10 days'));
                    $where = '1 =1';

                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "") {
                        $state_name = $this->input->post('state_name');
                        $region_id = $this->input->post('region_id');
                        $taskType = $this->input->post('taskType');
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $date_from = date("Y-m-d", strtotime($date1));
                        $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . "  and status=1 and task_for=1 and task_state_id = '" . $state_name . "' and region_id = " . $region_id . "";
                        $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                        // echo "<pre>";
                        // print_r($data['taskData']);exit;
                    } else {
                        $date_to = date("Y-m-d");
                        $date_from = date("Y-m-d", strtotime($date2 . '-10 days'));
                        $data['creation_date'] = $date_from;
                        $data['creation_date'] = $date2;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and status = 1";
                        $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                    }
                } else {
                    $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                    $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                    $date2 = $data['date_to'] = date("Y-m-d");
                    $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                    $where = '1 =1';
                    if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "" &&  $this->input->post('region_id') != "") {
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $data['StaskType'] = $taskType = $this->input->post('taskType');
                        $region_id = $this->input->post('region_id');
                        $data['Tstate_name'] = $state_name = $this->input->post('state_name');
                        $data['date_from'] = $date_from = date("Y-m-d", strtotime($date1));
                        $data['date_to'] =     $date_to = date("Y-m-d", strtotime($date2));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $data['region_id'] = $region_id;
                        //  $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=1";
                        $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                    } else if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('taskType') != "" &&  $this->input->post('region_id') != "" &&  $this->input->post('state_name') != "") {
                        $date1 = $this->input->post('start_new');
                        $date2 = $this->input->post('end_new');
                        $data['StaskType'] = $taskType = $this->input->post('taskType');
                        $region_id = $this->input->post('region_id');
                        $data['Tstate_name']  = $state_name = $this->input->post('state_name');
                        $data['date_from'] = $date_from = date("Y-m-d", strtotime($date1));
                        $data['date_to'] =     $date_to = date("Y-m-d", strtotime($date2));
                        $data['creation_date'] = $date1;
                        $data['creation_date'] = $date2;
                        $data['taskType'] = $taskType;
                        $data['region_id'] = $region_id;
                        $data['state_name'] = $state_name;
                        $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and task_type_id=" . $taskType . " and region_id =" . $region_id . " and status =1 and task_for=1";
                        $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                    } else {
                        //  $data['taskData'] = $this->Admin_model->volunteer_task_Data($where);
                    }
                }
                $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'task_type', 'status = 1');
                $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
                $this->load->view('temp/head');
                $this->load->view('temp/header', $data);
                $this->load->view('temp/sidebar');
                $this->load->view('task-report', $data);
                $this->load->view('temp/footer');
            } else {
                redirect(base_url() . 'login', 'refresh');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function export()
	{
		try
	       {
			if($this->session->userdata('role_id')==1 && $this->session->userdata('volunteer_id')!="" || $this->session->userdata('volunteer_id')!=null )
		    {
			$this->load->library("excel");
			$table_columns = array("first_name", "last_name", "email", "mobile");
			$column = 0;
			foreach($table_columns as $field)
			  {
              }
                $this->db->select('*');
                $this->db->from($this->nama_tabel);
               // $this->db->join('region_master', 'region_master.region_id = '.$this->nama_tabel.'.region_id');
                $this->db->where($this->nama_tabel.'.status=1');
                $user_data = $this->db->get();
                $excel_row = 2;
			    ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col"><b>#</b></th>
                        <th scope="col"><b>Registration Date</b></th>
                        <th scope="col"><b>Name</b></th>
                        <th scope="col"><b>Email</b></th>
                        <th scope="col"><b>Mobile No.</b></th>
                        <th scope="col"><b>Region</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php
                    $c=1;
                    foreach ($user_data->result() as $key => $value) {
                    ?>
                        <tr>
                            <th scope="row"><b><?php echo $c++; ?></b></th>
                            <td><?php echo date('d-m-Y',strtotime($value->creation_date)); ?></td>
                            <td><?php echo ucwords($value->name); ?></td>
                            <td><?php echo $value->email; ?></td>
                            <td><?php $mobile = str_replace(',','/',trim($value->mobile)); $mobile = str_replace(' ','/',$mobile); $mobile = str_replace('//','/',$mobile);echo $mobile; ?></td>
                            <td><?php echo $value->region_name; ?></td>
                        </tr>
                    <?php // print_r($value); ?>
                    <?php } ?>
                    </tbody>
                </table>
                <button onclick="exportTableToCSV('members.csv')" id="csbbtn">Export HTML Table To CSV File</button>
                    
                <?php
            }
			else
			{
				redirect('admin');
			}
		   }
		   catch (Exception $e)
		   {
                    echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
           }
	}
}
?>