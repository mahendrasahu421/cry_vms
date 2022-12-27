<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller
{

    function __construct()
    {
        parent :: __construct();
		$this->load->model('curl/Curl_model');
		$this->load->model('Web_model');
        if($this->session->userdata('userID'))
        {
            redirect('dashboard');
        }
        date_default_timezone_set('Asia/Kolkata');

    }
	public function index()
	{
		$fields123 = array(
			'dioceses_id',
            'name',
			'mobile',
			'email',
            'status',
        );
        $where123 = array('status'=>1);
        $limit123 = '10';
        $order_by123 = '';
        $res['dioceses'] = $this->Curl_model->dioceses_list(0);
		$atvol = $this->Curl_model->check_numrow('users','roleID=2 and status=1');
		$res['tvol'] = $atvol+20000;
		$res['ptvol'] = ($atvol+20000)/1000;
		$total_h = $this->Web_model->get_total_volunteering_hours();
		$time_array=explode('.',$total_h[0]['tvh']);
		$res['tvh']=$time_array[0];
		$res['recent_opp'] = $this->Curl_model->fetch_data_in_many_array('task',array('taskTitle','taskDescription'),array('status'=>1),'3',array('taskID','DESC'));
		$join_data = array(
			array(
			   'table'=>'daily_report',
			   'fields'=>array('dailyReportID','dailyReportTimeIn','dailyReportTimeOut'),
			   'joinWith'=>array('approveddaily_ID','left'),
			   'where'=>array('approveddaily_ID !'=>0,),
			   'group_by'=>array('approveddaily_ID'),
		   ),
		   array(
			   'joined'=>0,
			   'table'=>'task',
			   'fields'=>array('taskID'),
			   'joinWith'=>array('taskID','left'),
		   ),
		  
		 array(
			   'joined'=>0,
			   'table'=>'approveddaily_report',
			   'fields'=>array('admin_time'),
			   'joinWith'=>array('approveddaily_ID','left'),
		   ),			
	   );
	   
	   $limit = '';
	   $order_by ='';
	   $res['reporttotal'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
	   
	   $res['rewardDetails'] = $this->Web_model->get_rewarded_users();
	   //print_r($res['rewardDetails']); exit;
	   
		/*$join_data = array(
			array(
                'table'=>'dioceses',
                'fields'=>array('name','mobile','status','email','user_id','dioceses_id'),
                'joinWith'=>array('dioceses_id'),
            ),
            array(
                'joined'=>0,
                'table'=>'user_data',
                'fields'=>array('stateID','userID','dioceses_id'),
                'joinWith'=>array('dioceses_id','userID','left'),
				//'where'=>array('dioceses_id','ASC'),
				
            ),
			array(
				'joined'=>1,
                'table'=>'users',
                'fields'=>array('firstName','lastName','mobile','email','userID','usersCreationDate'),
                'joinWith'=>array('userID'),
            ),
		);
		$where = array();
        $limit = '';
        $order_by ='';
        $res['dioceses'] = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);*/
		
        $CI =& get_instance();
        $this->load->view('index', $res);
    }
	
	public function dioceses_load(){
	  //$lastID = $this->input->post('last');
	 $lastID = $this->uri->segment(2);
	  //echo $lastID; exit;
	  $dioceses = array();
	  $dioceses = $this->Curl_model->dioceses_list($lastID);
	  echo '<tr>
										<th style="text-align: center;">Sr.No</th>
										<th style="text-align: center;">Title</th>
										<!--<th style="text-align: center;">Email</th>
										<th style="text-align: center;">Contact</th>-->
										<th style="text-align: center;">Total Volunteers</th>
									  </tr>';
	    if(count($dioceses) != 0){
		 foreach ($dioceses as $bb){
			 $registerdate= $bb['creation_date'];
			 $name= $bb['name'];
			 $email= $bb['email'];
			 $mobile= $bb['mobile'];
			 $last= $bb['dioceses_id'];
			 $encoded_id=rtrim(strtr(base64_encode($bb['dioceses_id']), '+/', '-_'), '=');
		 echo '<tr>
				<td>'.$lastID++.'</td>
				<td>'.$bb['name'].'</td>
				<!--<td>'.$bb['email'].'</td>
				<td>'.$bb['mobile'].'</td>-->
				<td style="text-align:center">'.$bb['tv'].'</td>
				</tr>
			  ';
	    	}
			echo '<input type="hidden" style="display:none;" id="last" value="'.$last.'" name="last"/>';
		 }
	}
	
function api_check(){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://uat.signdesk.in/api/emandate/getLiveBankList",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n    \"authentication_mode\" : \"netBanking\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: f2f9ca1d-73c6-0cbb-74b8-530a7d7c1006",
    "x-parse-application-id: caritas-india_emandate_uat",
    "x-parse-rest-api-key: 8bb76746790ce6672fecc332be9387fb"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}	


    function request_emandate(){
    $curl = curl_init();
    //print_r($_POST); die;
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.signdesk.in/api/live/emandateRequest ",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\r\n\"reference_id\":\"2\",\r\n\"debtor_account_type\":\"SAVINGS\",\r\n\"debtor_account_id\":\"12345678\",\r\n\"instructing_agent_id\":\"\",\r\n\"occurance_sequence_type\":\"RCUR\",\r\n\"occurance_frequency_type\":\"MNTH\",\r\n\"scheme_reference_number\":\"\",\r\n\"consumer_reference_number\":\"\",\r\n\"debtor_name\":\"pransi Gupta Testing\",\r\n\"email_address\":\"pransi.g@neuralinfo.org\",\r\n\"first_collection_date\":\"2020-10-20\",\r\n\"final_collection_date\":\"2021-10-21\",\r\n\"phone_number\":\"8299756650\",\r\n\"mobile_number\":\"8299756050\",\r\n\"collection_amount_type\":\"FIXED\",\r\n\"amount\":2000,\r\n\"other_reference\":\"no\",\r\n\"mandate_type_category_code\":\"A001\",\r\n\"is_until_cancel\": \"\",\r\n\"net_banking_auth_mode\":\"Net\",\r\n\"quick_invite\":\"\",\r\n\"corporate_name\":\"\",\r\n\"instructed_agent_code\":\"KKBK\"\r\n}",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 71a6d53d-5e4a-3361-6c61-93acca4b4918",
        "x-parse-application-id: caritas-india-_emandate_live",
        "x-parse-rest-api-key: 4376f65643c5daa33247050f310d85a1"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
    }
	
	
	
}
