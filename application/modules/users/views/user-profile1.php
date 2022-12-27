<div class="pcoded-main-container">
<div class="pcoded-content">
<style>
#profileImage {
    background: #f9f9f9;
    border: 5px solid #88c;
    padding: 15px;
    border-radius: 5px;
    margin: 10px;
    cursor: pointer;
}
.fa-camera{color:#fff;}
.icon-add{background: #8f281f;
    padding: 6px;
    border-radius: 50%;
    width: 30px;
	margin-top: -18px;
    margin-right: -27px;}
</style>
<div class="row">
<div class="col-lg-3 col-md-3 mail-list">
<div class="card">
<div class="card-body">
<a href="<?php echo base_url('edit-profile');?>" class="btn btn-rounded btn-primary waves-effect waves-light btn-block">Edit Profile</a>
</div>
<ul class="list-group list-group-full">
<li class="list-group-item"><a href="#profile" class="text-muted"><i class="fa fa-user-o"></i> Profile</a> </li>
<li class="list-group-item"><a href="#Address" class="text-muted"><i class="fa fa-map-marker"></i> Address</a></li>
</ul>
</div>

<div class="card">
<div class="card-body">
<span class="btn btn-warning">Reference 1</span>
</div>
<ul class="list-group list-group-full">
<li class="list-group-item"><i class="fa fa-user-o"></i> <b>Name:-</b> <?php echo ucwords($userDetails[0]['ref1_name']);?> </li>
<li class="list-group-item"><i class="fa fa-retweet"></i> <b>Relation:-</b> <?php echo ucwords($userDetails[0]['ref1_relation']);?> </li>
<li class="list-group-item"><i class="fa fa-phone"></i> <b>Contact:-</b> <?php echo ucwords($userDetails[0]['ref1_contact']);?> </li>
<li class="list-group-item"><i class="fa fa-envelope-o"></i> <b>Email:-</b> <?php echo ucwords($userDetails[0]['ref1_email']);?> </li>
<li class="list-group-item"><i class="fa fa-map-marker"></i> <b>Address:-</b> <?php echo ucwords($userDetails[0]['ref1_address']);?> </li>
</ul>
</div>

<div class="card">
<div class="card-body">
<span class="btn btn-warning">Reference 2</span>
</div>
<ul class="list-group list-group-full">
<li class="list-group-item"><i class="fa fa-user-o"></i> <b>Name:-</b> <?php echo ucwords($userDetails[0]['ref2_name']);?> </li>
<li class="list-group-item"><i class="fa fa-retweet"></i> <b>Relation:-</b> <?php echo ucwords($userDetails[0]['ref2_relation']);?> </li>
<li class="list-group-item"><i class="fa fa-phone"></i> <b>Contact:-</b> <?php echo ucwords($userDetails[0]['ref2_contact']);?> </li>
<li class="list-group-item"><i class="fa fa-envelope-o"></i> <b>Email:-</b> <?php echo ucwords($userDetails[0]['ref2_email']);?> </li>
<li class="list-group-item"><i class="fa fa-map-marker"></i> <b>Address:-</b> <?php echo ucwords($userDetails[0]['ref2_address']);?> </li>
</ul>
</div>

</div>
<div class="col-lg-9 col-md-9" id="profile">
<div class="card">
<div class="card-body  card2 pt-3">
<div class="row">
<div class="col-lg-6 col-md-9 f-18 font-weight-bold text-uppercase">Profile</div>
<div class="col-lg-6 col-md-9 text-right f-16 font-weight-bold text-uppercase profile-social">
<ul>
<li><a href="https://twitter.com/login" class="icoTwitter" title="Twitter" value="<?php echo ($userDetails[0]['twitter']);?>" target="_blank"><i class="fa fa-twitter"></i> </a></li>
<li><a href="#" class="icoGoogle" title="Linkedin" value="<?php echo ($userDetails[0]['linkedin']);?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
</ul>
</div>
</div>
</div>
<div class="card-body">
<div class="row">

<div class="col-md-4 m-b-20 text-center">
<form id="profileImageForm" name="profileImageForm">
<span id="result"></span>
 <?php 
if($userDetails[0]['profile']!=''){
	?>
<img src='<?php $image = $userDetails[0]['profile']; echo base_url("user_profile/$image"); ?>'  width="100%" height="auto" class="img-fluid border p-1" id="profileImage"/>
<?php 
  }
else{?>
 <img src="<?php echo base_url('user_profile/');?>crop.jpg" class="img-fluid border p-1" width="100%"  height="auto" id="profileImage" > 
   <?php
}
?> 
<input type="file" name="profile" id="my_file" style="display:none"/>
<div class="icon-add pull-right"><i class="fa fa-camera"></i></div>
<button type="submit" name="submit" value="submit" class="btn btn-danger" disabled style="display:none">Save</button>

</form>
</div>


<script>
document.getElementById('profileImage').onclick = function() {
    document.getElementById('my_file').click();
};
</script>


<div class="col-md-8">
<h2 class="f-24 font-medium"><?php echo ucwords($userDetails[0]['firstName']);?> <?php echo ucwords($userDetails[0]['lastName']);?></h2>
<p class="m-b-20">Online</p>
<div class="row mb-2">
	<div class="col-4 font-weight-bold text-dark">Phone</div>
	<div class="col"><?php echo ucwords($userDetails[0]['mobile']); ?></div>
</div>
<div class="row mb-2">
	<div class="col-4 font-weight-bold text-dark">Email</div>
	<div class="col"><a href="#" class="text-inverse"><span class="__cf_email__" data-cfemail="<?php echo $userDetails[0]['email']; ?>"><?php echo $userDetails[0]['email']; ?></span></a></div>
</div>

<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Date of Birth</div>
<div class="col"><?php if($userDetails[0]['dateOfBirth']!='0000-00-00'){echo ucwords(date("d-m-Y", strtotime($userDetails[0]['dateOfBirth'])));} ?></div>
</div>
<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Govt. Identity Name</div>
<div class="col"><?php if($userDetails[0]['govt_name']!=''){echo ucwords($userDetails[0]['govt_name']);} ?></div>
</div>

<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Causes</div>
<div class="col">
<?php
$lname = '';
$userID = $this->session->userdata('userID');
$this->load->model('curl/Curl_model');
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
	if($lname!='')
	{
		$lname = '<span class="badge badge-primary">'.$lname.'</span> <span class="badge badge-primary mt-1 ">'.ucwords($value1['causesName'].'</span>');
	}
	else
	{
		$lname = '<span class="badge badge-primary">'.ucwords($value1['causesName'].'</span>');  
	}
}
echo $lname;
?>
</div>
</div>
<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Education</div>
<div class="col"><?php echo ucwords($userDetails[0]['educationName']); ?></div>
</div>
<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Language</div>
<div class="col">
<?php
$lname = '';
$userID = $this->session->userdata('userID');
$this->load->model('curl/Curl_model');
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
		$lname = '<span class="badge badge-primary">'.$lname.'</span> <span class="badge badge-primary mt-1 ">'.ucwords($value1['languageName'].'</span>');
	}
	else
	{
		$lname = '<span class="badge badge-primary">'.ucwords($value1['languageName'].'</span>');  
	}
}
echo $lname;
?>
</div>
</div>
<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Blood Group</div>
<div class="col"><?php echo ucwords($userDetails[0]['bloodGroupName']); ?></div>
</div>
<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Nationality</div>
<div class="col f-w-700"><?php echo ucwords($userDetails[0]['nationalityName']); ?></div>
</div>
<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Occupation</div>
<div class="col "><?php echo ucwords($userDetails[0]['occupationName']); ?></div>
</div>
<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Service Area</div>
<div class="col">
<?php
$lname = '';
$userID = $this->session->userdata('userID');
$this->load->model('curl/Curl_model');
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
	if($lname!='')
	{
		$lname = '<span class="badge badge-primary">'.$lname.'</span> <span class="badge badge-primary mt-1 ">'.ucwords($value1['serviceAreaName'].'</span>');
	}
	else
	{
		$lname = '<span class="badge badge-primary">'.ucwords($value1['serviceAreaName'].'</span>');  
	}
}
echo $lname;
?>
</div>
</div>

<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Voluntery Service</div>
<div class="col">
<?php
$lname = '';
$userID = $this->session->userdata('userID');
$this->load->model('curl/Curl_model');
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
$serviceName = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
foreach ($serviceName as $key1 => $value1) {
	if($lname!='')
	{
		$lname = '<span class="badge badge-primary">'.$lname.'</span> <span class="badge badge-primary mt-1 ">'.ucwords($value1['voluntaryServiceName'].'</span>');
	}
	else
	{
		$lname = '<span class="badge badge-primary">'.ucwords($value1['voluntaryServiceName'].'</span>');  
	}
}
echo $lname;
?>
</div>
</div>

<div class="row mb-2">
<div class="col-4 font-weight-bold text-dark">Area Of Experties</div>
<div class="col">
<?php
$lname = '';
$userID = $this->session->userdata('userID');
$this->load->model('curl/Curl_model');
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
$serviceName = $this->Curl_model->fetch_data_with_joining($join_data,$limit,$order_by);
foreach ($serviceName as $key1 => $value1) {
	if($lname!='')
	{
		$lname = '<span class="badge badge-primary">'.$lname.'</span> <span class="badge badge-primary mt-1 ">'.ucwords($value1['areaOfExpertiesName'].'</span>');
	}
	else
	{
		$lname = '<span class="badge badge-primary">'.ucwords($value1['areaOfExpertiesName'].'</span>');  
	}
}
echo $lname;
?>
</div>
</div>


</div>
</div>
</div>
</div>


<div class="card" id="Address">
<div class="card-body card2">
<div class="row">
<div class="col-lg-6 col-md-6 f-18 font-weight-bold text-uppercase">Corr. Address</div>
<div class="col-lg-6 col-md-6 f-18 font-weight-bold text-uppercase">Permanent Address</div>
</div>
</div>
<div class="card-body ">
<div class="row ">
	<div class="col-lg-2 col-md-6 f-14 font-weight-bold m-b-20"><span class="fa fa-circle text-danger circle-tab "></span> State</div>
	<div class="col-lg-4 col-md-6 m-b-20">
	<span class="font-bold"><?php echo ucwords($userDetails[0]['stateName']); ?></span>
	<div class="clearfix"></div>
	</div>
	
	<div class="col-lg-2 col-md-6 f-14 font-weight-bold m-b-20"><span class="fa fa-circle text-danger circle-tab "></span> State</div>
	<div class="col-lg-4 col-md-6 m-b-20">
	<span class="font-bold"><?php echo ucwords($userDetails[0]['stateName']); ?></span>
	<div class="clearfix"></div>
	</div>
</div>
	<div class="row">
		<div class="col-lg-2 col-md-6 f-14 font-weight-bold m-b-20"><span class="fa fa-circle text-danger circle-tab "></span> City</div>
		<div class="col-lg-4 col-md-6 m-b-20">
		<span class="font-bold"><?php echo ucwords($userDetails[0]['cityName']); ?></span>
		<div class="clearfix"></div>
		</div>
		
		<div class="col-lg-2 col-md-6 f-14 font-weight-bold m-b-20"><span class="fa fa-circle text-danger circle-tab "></span> City</div>
		<div class="col-lg-4 col-md-6 m-b-20">
		<span class="font-bold"><?php echo ucwords($userDetails[0]['cityName']); ?></span>
		<div class="clearfix"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-md-6 f-14 font-weight-bold m-b-20"><span class="fa fa-circle text-danger circle-tab "></span> Address</div>
		<div class="col-lg-4 col-md-6 m-b-20">
		<span class="font-bold"><?php echo ucwords($userDetails[0]['correspontenceAddress']); ?></span>
		<div class="clearfix"></div>
		</div>
		
		<div class="col-lg-2 col-md-6 f-14 font-weight-bold m-b-20"><span class="fa fa-circle text-danger circle-tab "></span> Address</div>
		<div class="col-lg-4 col-md-6 m-b-20">
		<span class="font-bold"><?php echo ucwords($userDetails[0]['correspontenceAddress']); ?></span>
		<div class="clearfix"></div>
		</div>
	</div>
</div>
</div>
</div>
</div>


</div>
</div>

</div>
