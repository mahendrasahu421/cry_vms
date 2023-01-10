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
        $res['dioceses'] = $this->Curl_model->fetch_data_in_many_array('dioceses',$fields123,$where123,$limit123,$order_by123);
		$res['tvol'] = $this->Curl_model->check_numrow('users','roleID=2 and status=1');
		$total_h = $this->Web_model->get_total_volunteering_hours();
		$time_array=explode('.',$total_h[0]['tvh']);
		$res['tvh']=$time_array[0];
		$res['recent_opp'] = $this->Curl_model->fetch_data_in_many_array('task',array('taskTitle','taskDescription'),array('status'=>1),'3','');
		
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
										<th style="text-align: center;">Email</th>
										<th style="text-align: center;">Contact</th>
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
				<td>'.$bb['email'].'</td>
				<td>'.$bb['mobile'].'</td>
				<td style="text-align:center">0</td>
				</tr>
			  ';
	    	}
			echo '<input type="hidden" style="display:none;" id="last" value="'.$last.'" name="last"/>';
		 }
	}
	
	
	
	
	
	
}
