<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Partner extends MY_Controller
{

    function __construct()
    {
        parent :: __construct();
        error_reporting(1);
        if($this->session->userdata('dioceses_id'))
        {
           //echo '<script>window.location.href = "'.base_url().'partner-dashboard"</script>'; 
        }
        else
        {
            echo '<script>window.location.href = "'.base_url().'partner-login"</script>';
        }
        $CI =& get_instance();
        $CI->load->library('Get_library');
        $this->load->library('upload');
        $this->load->model('curl/Curl_model');
		$this->load->model('partner/Partner_model');
        $this->load->library('Phpmailer');
        date_default_timezone_set('Asia/Kolkata');

    }
	public function index()
	{
        $dioceses_id = $this->session->userdata('dioceses_id');
		$data['totalvolunteer']= $this->Partner_model->total_volunteer_count();
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('index',$data);
        $this->load->view('temp/footer');
    }
    public function createExcel() {
        $fileName = 'volunteer_'.date('dmyHis').'.xlsx';  
        $dioceses_id = $this->session->userdata('dioceses_id');
            $join_data = array(
                array(
                    'table'=>'user_area_of_interest',
                    'fields'=>array('userAreaOfInterestID'),
                    'joinWith'=>array('userID'),
                ),
                array(
                    'joined'=>0,
                    'table'=>'users',
                    'fields'=>array('verify','userID','volunteerID','firstName','lastName','mobile','email','usersCreationDate'),
                    'joinWith'=>array('userID'),
                    'order_by'=>array('userID','DESC'),
                ),
                array(
                    'joined'=>1,
                    'table'=>'user_data',
                    'fields'=>array('correspontenceAddress','stateID','cityID','gender'),
                    'joinWith'=>array('userID','left'),
                    'where'=>array('dioceses_id'=>$dioceses_id,),
                ),
                array(
                    'joined'=>2,
                    'table'=>'states',
                    'fields'=>array('stateName'),
                    'joinWith'=>array('stateID','left'),
                ),
                array(
                    'joined'=>2,
                    'table'=>'cities',
                    'fields'=>array('cityName'),
                    'joinWith'=>array('cityID','left'),
                ),
            ); 
        
        $limit = '';
        $order_by ='';
        $employeeData = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		//$employeeData = $this->EmployeeModel->employeeList();
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
		$sheet->setCellValue('A1', 'Volunteer ID');
		$sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Mobile');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Reg. Date');
		$sheet->setCellValue('F1', 'Location');       
        $rows = 2;
        foreach ($employeeData as $val){
            $sheet->setCellValue('A' . $rows, $val['volunteerID']);
            $sheet->setCellValue('B' . $rows, ucwords($val['firstName'].' '.$val['lastName']));
            $sheet->setCellValue('C' . $rows, $val['mobile']);
            $sheet->setCellValue('D' . $rows, $val['email']);
            $sheet->setCellValue('E' . $rows, date('d/m/Y',strtotime($val['usersCreationDate'])));
			$sheet->setCellValue('F' . $rows, ucwords($val['cityName'].', '.$val['stateName']));
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("upload/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        echo '<script>window.location.href = "'.base_url()."/upload/".$fileName.'"</script>';
		ob_start();
        // echo '<script>window.location.href = "'.base_url().'"</script>';
        redirect(base_url('partner-dashboard'));  
        // header ('Location: '.base_url().'/upload/'.$fileName);            
    } 
    public function partner_dashboard()
	{
        $dioceses_id = $this->session->userdata('dioceses_id');
        $data['totalvolunteer']= $this->Partner_model->total_volunteer_count();
        $join_data = array(
            array(
                'table'=>'user_data',
                'fields'=>array('userDataID','userID','dioceses_id'),
                'where'=>array('dioceses_id'=>$dioceses_id),
            ),
			array(
               'joined'=>0,
			   'table'=>'daily_report',
			   'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut'),
			   'joinWith'=>array('userID','left'),
			   'where'=>array('approveddaily_ID !'=>0,),
			   'group_by'=>array('approveddaily_ID'),
		   ),
		   array(
			   'joined'=>1,
			   'table'=>'task',
			   'fields'=>array('taskID'),
			   'joinWith'=>array('taskID','left'),
		   ),
		  
		 array(
			   'joined'=>1,
			   'table'=>'approveddaily_report',
			   'fields'=>array('admin_time'),
			   'joinWith'=>array('approveddaily_ID','left'),
		   ),			
	   );
	   
	   $limit = '';
	   $order_by ='';
       $data['reporttotal'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        //    print_r($res['reporttotal']);
        //    die();
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('index',$data);
        $this->load->view('temp/footer');
    }
	public function partner_volunteer()
	{
		$dioceses_id = $this->session->userdata('dioceses_id');
		$fields = array(
            'causesName',
            'causesID',
            'causesImg',
            'status'
        );
        $where = '';
        $limit = '';
        $order_by = array('causesID','DESC');
        $res['causes'] = $this->Curl_model->fetch_data_in_many_array('causes',$fields,$where,$limit,$order_by);
		$res['causesID'] = "";
		if($this->input->post())
        {
            if($this->input->post('cause')!='')
            {
                $where11['causesID'] = $this->input->post('cause');
                $res['causesID'] = $this->input->post('cause');
            }
            //die();
        }
            $join_data = array(
                array(
                    'table'=>'user_area_of_interest',
                    'fields'=>array('userAreaOfInterestID','userID'),
                    'joinWith'=>array('userID'),
					'where'=>$where11,
                ),
                array(
                    'joined'=>0,
                    'table'=>'users',
                    'fields'=>array('verify','userID','volunteerID','firstName','lastName','mobile','email','usersCreationDate'),
                    'joinWith'=>array('userID'),
                    'order_by'=>array('userID','DESC'),
                ),
                array(
                    'joined'=>1,
                    'table'=>'user_data',
                    'fields'=>array('correspontenceAddress','stateID','cityID','gender'),
                    'joinWith'=>array('userID','left'),
                    'where'=>array('dioceses_id'=>$dioceses_id,),
                ),
                array(
                    'joined'=>2,
                    'table'=>'states',
                    'fields'=>array('stateName'),
                    'joinWith'=>array('stateID','left'),
                ),
                array(
                    'joined'=>2,
                    'table'=>'cities',
                    'fields'=>array('cityName'),
                    'joinWith'=>array('cityID','left'),
                ),
            ); 
        
        $limit = '';
        $order_by ='';
        $res['volunteerDetails'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);

        $this->load->view('temp/head');
        $this->load->view('temp/header',$res);
        $this->load->view('temp/sidebar');
        $this->load->view('volunteer-list',$res);
        $this->load->view('temp/footer');
	}
	public function fetch_user_info()
    {
        $encode_userID = $this->input->post('userID');
        $lname = '';
        $causesN = '';
		$sername ='';
		$vol_sername ='';
		$area_name ='';
        if($encode_userID!=''){
        $userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $join_data = array(
            array(
                'table'=>'users',
                'fields'=>array('volunteerID','firstName','lastName','mobile','email'),
                'joinWith'=>array('userID'),
                'where'=>array(
                    'userID'=>$userID
                ),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('dateOfBirth','correspontenceAddress','heard_us','gender','staff_member','nationalityID','bloodGroupID','educationID','occupationID','stateID','cityID','permanentState','permanentCity','permanentAddress','profile','govt_name','govt_type','dioceses_id','dioceses'),
                'joinWith'=>array('userID','dioceses_id','left'),
            ),
			array(
                'joined'=>1,
                'table'=>'dioceses',
                'fields'=>array('name','dioceses_id'),
                'joinWith'=>array('dioceses_id','left'),
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
                'table'=>'education',
                'fields'=>array('educationName'),
                'joinWith'=>array('educationID','left'),
            ),
            array(
                'joined'=>1,
                'table'=>'nationality',
                'fields'=>array('nationalityName'),
                'joinWith'=>array('nationalityID','left'),
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
        
        $limit = '';
        $order_by ='';
        
        $volunteerDetails = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
        foreach ($volunteerDetails as $key => $value) {
            $join_data = array(
                array(
                    'table'=>'user_area_of_interest',
                    'fields'=>array('causesID'),
                    'joinWith'=>array('causesID'),
                    'where'=>array(
                        'userID'=>$userID
                    ),
                ),
                array(
                    'joined'=>0,
                    'table'=>'causes',
                    'fields'=>array('causesName'),
                    'joinWith'=>array('causesID','left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by ='';
            $causesName = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
            foreach ($causesName as $key1 => $value1) {
                if($causesN!='')
                {
                    $causesN = $causesN.', '.ucwords($value1['causesName']);
                }
                else
                {
                    $causesN = ucwords($value1['causesName']);  
                }
            }
            $join_data = array(
                array(
                    'table'=>'user_language',
                    'fields'=>array('languageID'),
                    'joinWith'=>array('languageID'),
                    'where'=>array(
                        'userID'=>$userID
                    ),
                ),
                array(
                    'joined'=>0,
                    'table'=>'language',
                    'fields'=>array('languageName'),
                    'joinWith'=>array('languageID','left'),
                ),
            );
            $where = array();
            $limit = '';
            $order_by ='';
            $languageName = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
            foreach ($languageName as $key1 => $value1) {
                if($lname!='')
                {
                    $lname = $lname.', '.ucwords($value1['languageName']);
                }
                else
                {
                    $lname = ucwords($value1['languageName']);  
                }
            }
			
			$join_data = array(
				array(
					'table'=>'user_service_area',
					'fields'=>array('serviceAreaID'),
					'joinWith'=>array('serviceAreaID'),
					'where'=>array(
						'userID'=>$userID
					),
				),
				array(
					'joined'=>0,
					'table'=>'service_area',
					'fields'=>array('serviceAreaName'),
					'joinWith'=>array('serviceAreaID','left'),
				),
			);
			$where = array();
			$limit = '';
			$order_by ='';
			$serviceName = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
			foreach ($serviceName as $key1 => $value1) {
				if($sername!='')
				{
					$sername = $sername.', '.ucwords($value1['serviceAreaName']);
				}
				else
				{
					$sername = ucwords($value1['serviceAreaName']);  
				}
			}
			$join_data = array(
				array(
					'table'=>'user_voluntary_service',
					'fields'=>array('voluntaryServiceID'),
					'joinWith'=>array('voluntaryServiceID'),
					'where'=>array(
						'userID'=>$userID
					),
				),
				array(
					'joined'=>0,
					'table'=>'voluntary_service',
					'fields'=>array('voluntaryServiceName'),
					'joinWith'=>array('voluntaryServiceID','left'),
				),
			);
			$where = array();
			$limit = '';
			$order_by ='';
			$volunteerName = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
			foreach ($volunteerName as $key1 => $value1) {
				if($vol_sername!='')
				{
					$vol_sername = $vol_sername.','.ucwords($value1['voluntaryServiceName']);
				}
				else
				{
					$vol_sername = ucwords($value1['voluntaryServiceName']);  
				}
			}
			$join_data = array(
				array(
					'table'=>'user_area_of_experties',
					'fields'=>array('areaOfExpertiesID'),
					'joinWith'=>array('areaOfExpertiesID'),
					'where'=>array(
						'userID'=>$userID
					),
				),
				array(
					'joined'=>0,
					'table'=>'area_of_experties',
					'fields'=>array('areaOfExpertiesName'),
					'joinWith'=>array('areaOfExpertiesID','left'),
				),
			);
			$where = array();
			$limit = '';
			$order_by ='';
			$areaName = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
			foreach ($areaName as $key1 => $value1) {
				if($area_name!='')
				{
					$area_name = $area_name.', '.ucwords($value1['areaOfExpertiesName']);
				}
				else
				{
					$area_name = ucwords($value1['areaOfExpertiesName']);  
				}
			}
            
            //echo $lname;
        ?>   
         <div class="col-md-3 m-b-20 text-center">
		 <?php if($value['profile']!=''){?>
		  <img src='<?php $image = $value['profile']; echo base_url("user_profile/$image"); ?>'  width="100%" height="auto" class="img-fluid border p-1"/>
		 <?php } else{?>
		   <img src="<?php echo base_url("user_profile/crop.jpg"); ?>" class="img-fluid" alt="" title="">
		 <?php }?> 
		 </div>
		    <div class="col-md-8">
		    <h2 class="f-24 font-medium"><?php echo ucwords($value['firstName'].' '.$value['lastName']); ?></h2>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Volunteer ID</div>
				<div class="col"><?php echo $value['volunteerID']; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Phone</div>
				<div class="col"><?php echo $value['mobile']; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Email</div>
				<div class="col"><a href="#" class="text-inverse"><span class="_cf_email_"><?php echo $value['email']; ?></span></a></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Date of Birth</div>
				<div class="col"><?php if($value['dateOfBirth']!='0000-00-00'){echo ucwords(date("d-m-Y", strtotime($value['dateOfBirth'])));} ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Partner Name</div>
				<?php if ($value['dioceses_id']==0){?>
				<div class="col"><?php echo ucwords($value['dioceses']); ?></div>
				<?php }else {?>
				<div class="col"><?php if($value['dioceses_id']!='0'){echo ucwords($value['name']);} ?></div>
				<?php } ?>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Govt. Identity Type</div>
				<div class="col"><?php if($value['govt_type']!=''){echo ucwords($value['govt_type']);} ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Govt. Identity Name</div>
				<div class="col"><?php if($value['govt_name']!=''){echo ucwords($value['govt_name']);} ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Education</div>
				<div class="col"><?php echo ucwords($value['educationName']); ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Blood Group</div>
				<div class="col"><?php echo $value['bloodGroupName']; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">State</div>
				<div class="col"><?php echo $value['stateName']; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">City</div>
				<div class="col"><?php echo $value['cityName']; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Address</div>
				<div class="col"><?php echo $value['correspontenceAddress']; ?></div>
			</div>
			
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Theme</div>
				<div class="col"><?php echo $causesN; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Language</div>
				<div class="col"><?php echo $lname; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Nationality</div>
				<div class="col"><?php echo $value['bloodGroupName']; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Occupation</div>
				<div class="col "><?php echo ucwords($value['occupationName']); ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Partner/Forum/Caritas India Staff member</div>
				<div class="col "><?php if($value['staff_member']=='1'){echo 'Yes';}else { echo 'No' ;} ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Service Area</div>
				<div class="col"><?php echo $sername; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Voluntary Service</div>
				<div class="col"><?php echo $vol_sername; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Area Of Expertise</div>
				<div class="col"><?php echo $area_name; ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-4 font-weight-bold text-dark">Heard about Caritas India Volunteer form</div>
				<div class="col "><?php echo ucwords($value['heard_us']); ?></div>
			</div>
			
            </div>
            <?php
            }
        }
    }
	public function change_pwd()
	{
        $dioceses_id = $this->session->userdata('dioceses_id');
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
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
                    $this->load->view('change-pwd');
                }
                else
                {
                    $fields = array(
                        'password'
                    );
                    $where = array(
                        'dioceses_id'=>$dioceses_id
                    );
                    $limit = '';
                    $order_by = array('dioceses_id','DESC');
                    $results = $this->Curl_model->fetch_data('dioceses',$fields,$where,$limit,$order_by);
                    if(!empty($results) && $results!='')
                    {
                        $r_password = $results['password'];
                        $oldpass = md5($this->input->post('oldpassword'));
                        if($oldpass==$r_password)
                        {
                            $npass = md5($this->input->post('newpassword'));
                            $where = array(
                                'dioceses_id'=>$dioceses_id,
                            );
                            $fields = array(
                                'password'=>$npass
                            );
                            //die();
                            $results = $this->Curl_model->update_data('dioceses',$fields,$where);
                            if($results)
                            {
                                $this->session->set_userdata('success','Your password has been changed');
                                echo '<script>window.location.href = "'.base_url().'partner-change-pwd"</script>';
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
    
	public function partner_profile()
	{
        $dioceses_id = $this->session->userdata('dioceses_id');
		$fields = array(
		    'dioceses_id',
			'user_id',
			'profile_img',
            'name',
            'email',
            'mobile',
            'status',
			'creation_date'
        );
        $where = array(
				'dioceses_id'=>$dioceses_id
			);
        $limit = '';
        $order_by = '';
        $data['partner_profile'] = $this->Curl_model->fetch_data_in_many_array('dioceses',$fields,$where,$limit,$order_by);
		//print_r($data['partner_profile']); exit();
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('partner-profile',$data);
        $this->load->view('temp/footer');
    }
	
	public function partner_volunteer_task()
	{
        $dioceses_id = $this->session->userdata('dioceses_id');
		$join_data = array(
			array(
                'table'=>'dioceses',
                'fields'=>array('name','mobile','status','email','user_id','dioceses_id'),
                'joinWith'=>array('dioceses_id'),
                				
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('userID','dioceses_id'),
                'joinWith'=>array('dioceses_id','userID','left'),
				'where'=>array('dioceses_id'=>$dioceses_id),
            ),
			array(
				'joined'=>1,
                'table'=>'users',
                'fields'=>array('firstName','lastName','mobile','email','userID','usersCreationDate'),
                'joinWith'=>array('userID','left'),
            ),
			array(
				'joined'=>1,
                'table'=>'daily_report',
                'fields'=>array('taskID','userID'),
                'joinWith'=>array('userID','left'),
				
            ),
			array(
				'joined'=>3,
                'table'=>'task',
                'fields'=>array('taskID','taskTitle','taskPublishedDate','taskDescription'),
                'joinWith'=>array('taskID','left'),
				
            ),
			
		);
		
		$limit = '';
		$order_by ='';
		$data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
				
        $this->load->view('temp/head');
        $this->load->view('temp/header');
        $this->load->view('temp/sidebar');
        $this->load->view('partner-volunteer-task',$data);
        $this->load->view('temp/footer');
    }
	public function partner_volunteer_task_info()
	{
		$dioceses_id = $this->session->userdata('dioceses_id');
        $v = $this->uri->segment(2);
        $data['encode_taskID'] = $v;
		//echo ($data['encode_taskID']);exit;
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
                    'taskID'=>$val,
					'dailyReportID'=>0,
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
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar');
        $this->load->view('task-info', $data);
        $this->load->view('temp/footer');
    }
	
	public function daily_report_volunteer()
	{
		$dioceses_id = $this->session->userdata('dioceses_id');
		$join_data = array(
			array(
                'table'=>'dioceses',
                'fields'=>array('name','mobile','status','email','user_id','dioceses_id'),
                'joinWith'=>array('dioceses_id'),
                				
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('userID','dioceses_id'),
                'joinWith'=>array('dioceses_id','userID','left'),
				'where'=>array('dioceses_id'=>$dioceses_id),
            ),
			array(
				'joined'=>1,
                'table'=>'users',
                'fields'=>array('firstName','lastName','mobile','email','userID','usersCreationDate'),
                'joinWith'=>array('userID','left'),
            ),
			array(
				'joined'=>1,
                'table'=>'daily_report',
                'fields'=>array('taskID','userID'),
                'joinWith'=>array('userID','left'),
				
            ),
			array(
				'joined'=>3,
                'table'=>'task',
                'fields'=>array('taskID','taskTitle','taskPublishedDate','taskDescription'),
                'joinWith'=>array('taskID','left'),
				
            ),
			
		);
		
		$limit = '';
		$order_by ='';
		$data['task'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		
	if($this->input->get())
	{
		$encode_userID =$this->uri->segment(2);
		$volunteerID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
			 //print_r($this->input->get());
			$taskID = $this->input->get('taskID');
			$date = date("Y-m-d", strtotime($this->input->get('asdate')));
			$data['taskID']=$taskID;
			$data['birthday']=$date;
			//die();
			$join_data = array(
				array(
					'table'=>'daily_report',
					'fields'=>array('dailyReportID','dailyReportTimeIn','userID','taskID','dailyReportTimeOut','dailyReportDate','dailyReportActivity'),
					'joinWith'=>array('userID'),
					'where'=>array(
						'status'=>1,
						'taskID'=>$taskID,
						//'userID'=>$volunteerID,
						//'approved_status'=>0,
						'dailyReportDate <'=>"'".$date."'",
						//'approveddaily_ID'=>0,
					),
					'order_by'=>array('dailyReportID','DESC'),
					'group_by'=>array('userID'),
					// 'function'=>array('SUM','dailyReportTimeIn'),
				),
				array(
					'joined'=>0,
					'table'=>'users',
					'fields'=>array('verify','userID','firstName','lastName','mobile','email','usersCreationDate'),
					'joinWith'=>array('userID','left'),
				),
				array(
					'joined'=>1,
					'table'=>'user_data',
					'fields'=>array('correspontenceAddress','stateID','cityID','gender','dioceses_id'),
					'joinWith'=>array('userID','left'),
					'where'=>array('dioceses_id'=>$dioceses_id),
				),
				array(
					'joined'=>2,
					'table'=>'states',
					'fields'=>array('stateName'),
					'joinWith'=>array('stateID','left'),
				),
				array(
					'joined'=>2,
					'table'=>'cities',
					'fields'=>array('cityName'),
					'joinWith'=>array('cityID','left'),
				),
			);
			
			$limit = '';
			$order_by = '';
			$data['daily_report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		//print_r($data['daily_report']); exit();
	}
		
        $this->load->view('temp/head');
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar');
        $this->load->view('partner-volunteer-daily-report', $data);
        $this->load->view('temp/footer');
    }
	
	
	/*if($this->input->get())
	{
		$encode_userID =$this->uri->segment(2);
		$volunteerID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
			 //print_r($this->input->get());
			$taskID = $this->input->get('taskID');
			$date = date("Y-m-d", strtotime($this->input->get('asdate')));
			$data['taskID']=$taskID;
			$data['birthday']=$date;
			//die();
			$join_data = array(
				array(
					'table'=>'daily_report',
					'fields'=>array('dailyReportID','dailyReportTimeIn','userID','taskID','dailyReportTimeOut','dailyReportDate','dailyReportActivity'),
					'joinWith'=>array('userID'),
					'where'=>array(
						'status'=>1,
						'taskID'=>$taskID,
						'userID'=>$volunteerID,
						//'approved_status'=>0,
						'dailyReportDate <'=>"'".$date."'",
						//'approveddaily_ID'=>0,
					),
					'order_by'=>array('dailyReportID','DESC'),
					'group_by'=>array('userID'),
					// 'function'=>array('SUM','dailyReportTimeIn'),
				),
				array(
					'joined'=>0,
					'table'=>'users',
					'fields'=>array('verify','userID','firstName','lastName','mobile','email','usersCreationDate'),
					'joinWith'=>array('userID','left'),
				),
				array(
					'joined'=>1,
					'table'=>'user_data',
					'fields'=>array('correspontenceAddress','stateID','cityID','gender'),
					'joinWith'=>array('userID','left'),
				),
				array(
					'joined'=>2,
					'table'=>'states',
					'fields'=>array('stateName'),
					'joinWith'=>array('stateID','left'),
				),
				array(
					'joined'=>2,
					'table'=>'cities',
					'fields'=>array('cityName'),
					'joinWith'=>array('cityID','left'),
				),
			);
			
			$limit = '';
			$order_by = '';
			$data['daily_report'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		//print_r($data['daily_report']); exit();
	}*/
	
	public function daily_report_volunteer_info()
    {
        $encode_taskID = $this->input->post('taskID');
		$encode_userID = $this->input->post('userID');
		$date = $this->input->post('dailyReportDate');
		 //print_r($this->input->post());
		 //exit;
		$userID = base64_decode(str_pad(strtr($encode_userID, '-_', '+/'), strlen($encode_userID) % 4, '=', STR_PAD_RIGHT));
        $taksID = base64_decode(str_pad(strtr($encode_taskID, '-_', '+/'), strlen($encode_taskID) % 4, '=', STR_PAD_RIGHT));
        $join_data = array(
            array(
                'table'=>'task',
                'fields'=>array('taskID','taskTitle'),
                'joinWith'=>array('taskID'),
				
            ),
            array(
                'joined'=>0,
                'table'=>'daily_report',
                'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut','dailyReportActivity','dailyReportDate'),
                'joinWith'=>array('taskID','left'),
				'where'=>array(
                        'userID'=>$userID,
						'taskID'=>$taksID,
						//'approved_status'=>0,
						'dailyReportDate'=>"'".$date."'",
						//'approveddaily_ID'=>0,
						),
            ),     
        );
        $limit = '';
        $order_by =array('dailyReportID', 'DESC');
        $dilyreportDetails = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
		//print_r ('<pre>');
		//print_r ($dilyreportDetails); exit;
          
        ?>   
         <div class="row form-group m-b-20">
			<table id="dom-table" class="table table-striped table-bordered pre-line">
				<thead>
					<tr>
						<th>Sr.no</th>
						<th>Date</th>
						<th>Time In</th>
						<th>Time Out</th>
						<th>Activity</th>
						<th>Total Time</th>
					</tr>
				</thead>
			<tbody>
			<?php $i=1; foreach ($dilyreportDetails as $key => $value) { 
				$timeIn= $value['dailyReportTimeIn'];
				$time = date('h:i A', strtotime($timeIn));
				$timeOut= $value['dailyReportTimeOut'];
				$time1 = date('h:i A', strtotime($timeOut));
				$diff = abs(strtotime($time) - strtotime($time1));
				$tmins = $diff/60;
				$hours = floor($tmins/60);
				$mins = $tmins%60;
			
			?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo date('d/m/Y',strtotime($value['dailyReportDate'])); ?></td>
			<td><?php echo date('h:i A',strtotime($value['dailyReportTimeIn'])); ?></td>
			<td><?php echo date('h:i A',strtotime($value['dailyReportTimeOut'])); ?></td>
			<td><?php echo ucwords($value['dailyReportActivity']); ?></td>
			<td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?></td>
			</tr>
			<?php $i++;} ?>
			</tbody>
			</table>

		</div>
        <?php
	}
	
	public function uploadProfile(){
        if(($this->session->userdata('dioceses_id')!="")){
            $userID = $this->session->userdata('dioceses_id');
           $this->load->library('image_lib'); 
           $imageName = time().$_FILES['profile']['name'];
           //echo $imageName; exit;
           $image = str_replace(" ","_",$imageName);
           $config = array();
           $config['upload_path'] = './partner_profile/';
           $config['allowed_types'] = 'jpg|png|jpeg';
           $config['file_name'] = $image;
           $this->load->library('upload',$config);
           $this->upload->initialize($config);	
           if($this->upload->do_upload("profile")){
              $success = $this->Partner_model->userimg_file($image,$userID);
              if($success != FALSE){
                  echo 1;
              }
              else{ echo 2; }
           }
           else{ 
               print_r($this->upload->display_errors());exit;  
           }
          }else{
              echo '<script>window.location.href = "'.base_url().'partner-login"</script>';
            }
 
     }
	
	
	
	
	 
}
