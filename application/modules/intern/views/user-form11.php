<style>
.modal-dialog {
	max-width: 880px !important;}
</style>
<section class="pcoded-main-container" >
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10">User Profile</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Edit Profile</a></li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">

<div class="col-md-12">
<div class="card">
<div class="card-header">
<h5>Update Your Profile</h5>
</div>
<div class="card-body">
<div class="bt-wizard" id="progresswizard">
<ul class="nav nav-pills nav-fill mb-3">
<li class="nav-item"><a href="#progress-t-tab1" class="nav-link f-w-700" data-toggle="tab" id="Profile">Profile</a></li>
<li class="nav-item"><a href="#progress-t-tab2" class="nav-link f-w-700" data-toggle="tab" id="Address_Information">Address Information</a></li>
<li class="nav-item"><a href="#progress-t-tab3" class="nav-link f-w-700" data-toggle="tab" id="Final">Final</a></li>
</ul>
<div id="bar" class="bt-wizard progress mb-3" style="height:6px">
<div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
</div>
<div class="tab-content">

<div class="modal fade policy-details" id="myModal_reason" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-body">
		<div class="row form-group m-b-20">
			<embed src="<?php echo base_url('users/');?>assets/images/manual.pdf" frameborder="1" width="100%" height="540px">
		</div>

	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
	</div>
	</div>
</div>


<div class="tab-pane active show" id="progress-t-tab1">
<form action="<?php echo base_url('profile'); ?>" method="post" name="form" id="form">
		<div class="form-group row">
		<label for="progress-t-name" class="col-sm-3 col-form-label"> Full Name</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="progress-t-name" name="fname" readonly placeholder="<?php echo ucwords($userDetails[0]['firstName']); ?>" value="<?php echo ucwords($userDetails[0]['firstName']); ?>">
			</div>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="progress-t-name2" name="lname" readonly placeholder="<?php echo ucwords($userDetails[0]['lastName']); ?>" value="<?php echo ucwords($userDetails[0]['lastName']); ?>">
			</div>
		</div>
		<div class="form-group row">
			<label for="progress-t-email" class="col-sm-3 col-form-label">Email</label>
			<div class="col-sm-8">
				<input type="email" class="form-control" id="progress-t-email" name="email" readonly placeholder="<?php echo $userDetails[0]['email']; ?>" value="<?php echo ucwords($userDetails[0]['email']); ?>">
			</div>
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Date of Birth</label>
			<div class="col-sm-8">
				<input type="text" id="dob_caf" name="birthday1" onkeyup="onlyNumber('dob_caf');" placeholder="Date Of Birth" <?php if($userDetails[0]['dateOfBirth']!='0000-00-00'){ echo 'value="'.ucwords(date("d-m-Y", strtotime($userDetails[0]['dateOfBirth']))).'"';} ?> class="form-control birthday" required />
			</div>
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Mobile no.</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="progress-t-pwd2" name="mobile" readonly placeholder="<?php echo ucwords($userDetails[0]['mobile']); ?>" value="<?php echo ucwords($userDetails[0]['mobile']); ?>" data-mask="9999-999-999" required >
			</div>
		</div>
		
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">LinkdIn</label>
			<div class="col-sm-8">
				<input type="url" class="form-control linkedin" id="progress-t-pwd2" name="linkedin"  placeholder="<?php echo ucwords($userDetails[0]['linkedin']); ?>" value="<?php echo ucwords($userDetails[0]['linkedin']); ?>"  >
			</div>
		</div>
		
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Twitter</label>
			<div class="col-sm-8">
				<input type="url" class="form-control twitter" id="progress-t-pwd2" name="twitter" placeholder="<?php echo ucwords($userDetails[0]['twitter']); ?>" value="<?php echo ucwords($userDetails[0]['twitter']); ?>" >
			</div>
		</div>
		
		<div class="form-group row">
			<label for="progress-t-email" class="col-sm-3 col-form-label">Govt.Idenity Name & No.</label>
			<div class="col-sm-8">
				<input type="text" class="form-control govt_name" id="progress-t-email" name="govt_name" placeholder="<?php echo $userDetails[0]['govt_name']; ?>" value="<?php echo ucwords($userDetails[0]['govt_name']); ?>">
			</div>
		</div>
		
		<div class="form-group row">
			<label for="gender" class="col-sm-3 col-form-label">Gender</label>
				<div class="radio radio-warning d-inline ml-3">
				<input type="radio" name="gender" id="radio-w-in-1" class="male" <?php if($userDetails[0]['gender']==1){ echo "checked"; } ?>>
				<label for="radio-w-in-1" class="cr">Male</label>
				</div>
				<div class="radio radio-warning d-inline">
				<input type="radio" name="gender" id="radio-w-in-2" class="female" <?php if($userDetails[0]['gender']==2){ echo "checked"; } ?>>
				<label for="radio-w-in-2" class="cr">Female</label>
				</div>
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Nationality</label>
			<div class="col-sm-8">
				<select class="form-control nationality" name="nationality">
					<option value="">Select Nationality</option>
						<?php
						foreach ($nationality as $key => $value) {
						?>
							<option value="<?php echo $value['nationalityID']; ?>" <?php if($userDetails[0]['nationalityID']==$value['nationalityID']){ echo "selected"; } ?>><?php echo ucwords($value['nationalityName']); ?></option>
						<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Blood Group</label>
			<div class="col-sm-8">
				<select class="form-control bloodGroup" name="bloodGroup">
				<option value="">Select Blood Group</option>
				<?php
				foreach ($bloodGroup as $key => $value) {
				?>
					<option value="<?php echo $value['bloodGroupID']; ?>" <?php if($userDetails[0]['bloodGroupID']==$value['bloodGroupID']){ echo "selected"; } ?>><?php echo ucwords($value['bloodGroupName']); ?></option>
				<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Higher Education</label>
			<div class="col-sm-8">
				<select class="form-control education" name="education">
					<option value="">Select Education</option>
					<?php
					foreach ($education as $key => $value) {
					?>
						<option value="<?php echo $value['educationID']; ?>" <?php if($userDetails[0]['educationID']==$value['educationID']){ echo "selected"; } ?>><?php echo ucwords($value['educationName']); ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Language</label>
			<div class="col-sm-8">
			<select class="form-control js-example-basic-multiple language" multiple="multiple" name="language">
					<?php
					foreach ($language as $key => $value) {
						$selected = "";
						foreach ($user_language as $key1 => $value1) {
							if($value1['languageID']==$value['languageID'])
							{
								$selected='selected';
							}
						}
					?>
						<option value="<?php echo $value['languageID']; ?>" <?php echo $selected;?>><?php echo ucwords($value['languageName']); ?></option>
					<?php } ?>
			</select>
			</div>	
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Occupation</label>
			<div class="col-sm-8">
				<select class="form-control occupation" name="occupation">
					<option value="">Select Occupation</option>
					<?php
					foreach ($occupation as $key => $value) {
					?>
						<option value="<?php echo $value['occupationID']; ?>" <?php if($userDetails[0]['occupationID']==$value['occupationID']){ echo "selected"; } ?>><?php echo ucwords($value['occupationName']); ?></option>
					<?php } ?>
				</select>
			</div>	
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Service Area</label>
			<div class="col-sm-8">
				<select class="form-control js-example-basic-multiple serviceArea" multiple="multiple" name="serviceArea">
					
					<?php
					foreach ($service_area as $key => $value) {
						$selected = "";
						foreach ($user_service_area as $key1 => $value1) {
							if($value1['serviceAreaID']==$value['serviceAreaID'])
							{
								$selected='selected';
							}
						}
					?>
						<option value="<?php echo $value['serviceAreaID']; ?>" <?php echo $selected; ?>><?php echo ucwords($value['serviceAreaName']); ?></option>
					<?php } ?>
				</select>
			</div>	
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Voluntary Service</label>
			<div class="col-sm-8">
				<select class="form-control js-example-basic-multiple voluntaryService" multiple="multiple" name="voluntaryService">
					
					<?php
					foreach ($voluntary_service as $key => $value) {
						$selected = "";
						foreach ($user_voluntary_service as $key1 => $value1) {
							if($value1['voluntaryServiceID']==$value['voluntaryServiceID'])
							{
								$selected='selected';
							}
						}
					?>
						<option value="<?php echo $value['voluntaryServiceID']; ?>" <?php echo $selected; ?>><?php echo ucwords($value['voluntaryServiceName']); ?></option>
					<?php } ?>
				</select>
			</div>	
		</div>
		
		
	
</div>

<div class="tab-pane" id="progress-t-tab2" ng-controller="ExampleController">
	
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">State</label>
			<div class="col-sm-8">
				<select class="form-control tstate" onchange="fetch_city(this.value,'tcity');" ng-model="sa.state" ng-change="sameAddress && update()" name="tstate">
					<option value="">Select State</option>
					<?php
					foreach ($states as $key => $value) {
					?>
						<option class="sv_<?php echo $value['stateID']; ?>" value="<?php echo $value['stateID']; ?>" <?php if($userDetails[0]['stateID']==$value['stateID']){ echo "selected"; } ?>><?php echo ucwords($value['stateName']); ?></option>
					<?php } ?>
				</select>
			</div>	
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">City</label>
			<div class="col-sm-8">
				<select class="form-control tcity" ng-model="sa.city" ng-change="sameAddress && update()" name="tcity">
					<option value="">Select City</option>
					<?php
					if($userDetails[0]['stateID']!='')
					{
					$fields3 = array(
						'cityID',
						'cityName',
					);
					$where3 = array(
						'stateID'=>$userDetails[0]['stateID']
					);
					$limit3 = '';
					//$order_by = array('userID','DESC');
					$order_by3 = "";
					$tempcities = $this->Curl_model->fetch_data_in_many_array('cities',$fields3,$where3,$limit3,$order_by3);
					foreach ($tempcities as $key => $value) {
					?>
						<option class="cv_<?php echo $value['cityID']; ?>" value="<?php echo $value['cityID']; ?>" <?php if($userDetails[0]['cityID']==$value['cityID']){ echo "selected"; } ?>><?php echo ucwords($value['cityName']); ?></option>
					<?php }} ?>
				</select>
			</div>	
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label" ng-model="sameAddress" ng-change="sameAddress && update()">Correspondence Address</label>
			<div class="col-sm-8">
				<textarea class="form-control taddress" name="taddress" id="progress-t-address2" rows="3" spellcheck="false" placeholder="Correspondence Address" ng-model="sa.name" ng-change="sameAddress && update()"><?php echo $userDetails[0]['correspontenceAddress']; ?></textarea>
		</div>
		</div>
		
		<div class="d-inline-block">
			<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
			<input type="checkbox" class="custom-control-input corr_check corr" class="other" name="corr_check" value="0">
			<span class="custom-control-label"><b>Check if Correspondence address and Permeant address is same</b>
			</label>
		</div>

		
		<div class="form-group row mt-3">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">State</label>
			<div class="col-sm-8">
				<select class="form-control pstate" ng-model="ba.street" onchange="fetch_city(this.value,'pcities');" ng-disabled="sameAddress" name="pstate">
					<option value="">Select State</option>
					<?php
					foreach ($states as $key => $value) {
					?>
						<option value="<?php echo $value['stateID']; ?>" <?php if($userDetails[0]['permanentState']==$value['stateID']){ echo "selected"; } ?>><?php echo ucwords($value['stateName']); ?></option>
					<?php } ?>
				</select>
				<select class="form-control ppstate" ng-model="ba.street" ng-disabled="sameAddress" name="ppstate" style="display:none;">
				</select>
			</div>	
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">City</label>
			<div class="col-sm-8">
				<select class="form-control pcities" ng-model="ba.city" ng-disabled="sameAddress" name="pcities">
					<option value="">Select City</option>
					<?php
					if($userDetails[0]['permanentState']!='')
					{
					$fields3 = array(
						'cityID',
						'cityName',
					);
					$where3 = array(
						'stateID'=>$userDetails[0]['permanentState']
					);
					$limit3 = '';
					//$order_by = array('userID','DESC');
					$order_by3 = "";
					$pcities = $this->Curl_model->fetch_data_in_many_array('cities',$fields3,$where3,$limit3,$order_by3);
					foreach ($pcities as $key => $value) {
					?>
						<option value="<?php echo $value['cityID']; ?>" <?php if($userDetails[0]['permanentCity']==$value['cityID']){ echo "selected"; } ?>><?php echo ucwords($value['cityName']); ?></option>
					<?php }} ?>
				</select>
				<select class="form-control ppcities" ng-model="ba.street" ng-disabled="sameAddress" name="ppcities" style="display:none;">
				</select>
			</div>	
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-form-label">Permanent Address</label>
			<div class="col-sm-8">
				<textarea class="form-control paddress" name="paddress" id="progress-t-address1" rows="3" spellcheck="false" placeholder="Permanent Address"><?php echo $userDetails[0]['permanentAddress']; ?></textarea>
		</div>
		</div>
		
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-md-3 col-form-label">Specify your area of Expertise</label>
			<div class="col-sm-9 col-md-9">
				<select class="form-control js-example-basic-multiple expertise" multiple="multiple" name="expertise" style="width:88%;">
						<?php
						foreach ($area_of_experties as $key => $value) {
							$selected = "";
							foreach ($user_area_of_experties as $key1 => $value1) {
								if($value1['areaOfExpertiesID']==$value['areaOfExpertiesID'])
								{
									$selected='selected';
								}
							}
						?>
							<option value="<?php echo $value['areaOfExpertiesID']; ?>" <?php echo $selected; ?>><?php echo ucwords($value['areaOfExpertiesName']); ?></option>
						<?php } ?>
					</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-3 col-md-3 col-form-label">Time Period of Volunteer Associaton</label>
			<div class="col-sm-8">
				<input type="number" class="form-control time_duration" id="progress-t-email" name="time_duration" placeholder="<?php echo $userDetails[0]['time_duration']; ?>" value="<?php echo ucwords($userDetails[0]['time_duration']); ?>">
			</div>
		</div>
		
		<div class="border p-4 mb-3">
		<center><div class="d-inline-block">
			<label class="d-flex justify-content-center mb-3">
			<b>References (Kindly give 2 references)</b>
			</label>
		</div></center>
		<p><span class="pcoded-badge badge badge-success">References-1</span></p>
		
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-2 col-form-label">Name</label>
			<div class="col-sm-4">
				<input type="text" class="form-control ref1_name" id="progress-t-email" name="ref1_name" placeholder="<?php echo $userDetails[0]['ref1_name']; ?>" value="<?php echo ucwords($userDetails[0]['ref1_name']); ?>">
			</div>
			
			<label for="progress-t-pwd" class="col-sm-2 col-form-label">Relation</label>
			<div class="col-sm-4">
				<input type="text" class="form-control ref1_relation" id="progress-t-email" name="ref1_relation" placeholder="<?php echo $userDetails[0]['ref1_relation']; ?>" value="<?php echo ucwords($userDetails[0]['ref1_relation']); ?>">
			</div>
		</div>
		
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-2 col-form-label">Contact</label>
			<div class="col-sm-4">
				<input type="text" class="form-control ref1_contact" id="ref1_contact" name="ref1_contact" placeholder="<?php echo $userDetails[0]['ref1_contact']; ?>" value="<?php echo ucwords($userDetails[0]['ref1_contact']); ?>" data-mask="9999-999-999">
			</div>
			
			<label for="progress-t-pwd" class="col-sm-2 col-form-label">Email</label>
			<div class="col-sm-4">
				<input type="email" class="form-control ref1_email" id="progress-t-email" name="ref1_email" placeholder="<?php echo $userDetails[0]['ref1_email']; ?>" value="<?php echo ucwords($userDetails[0]['ref1_email']); ?>">
			</div>
		</div>
		<div class="form-group row">
			<label for="progress-t-pwd" class="col-sm-2 col-form-label">Address</label>
			<div class="col-sm-10">
				<textarea class="form-control ref1_address" name="ref1_address" > <?php echo ucwords($userDetails[0]['ref1_address']); ?></textarea>
			</div>
		</div>
		
		<p><span  class="pcoded-badge badge badge-success">References-2</span></p>
		
		<div class="form-group row">
			<label for="ref2_name" class="col-sm-2 col-form-label">Name</label>
			<div class="col-sm-4">
				<input type="text" class="form-control ref2_name" id="ref2_name" name="ref2_name" placeholder="<?php echo $userDetails[0]['ref2_name']; ?>" value="<?php echo ucwords($userDetails[0]['ref2_name']); ?>" />
			</div>
			
			<label for="ref2_name" class="col-sm-2 col-form-label">Relation</label>
			<div class="col-sm-4">
				<input type="text" class="form-control ref2_relation" id="ref2_name" name="ref2_relation" placeholder="<?php echo $userDetails[0]['ref2_relation']; ?>" value="<?php echo ucwords($userDetails[0]['ref2_relation']); ?>">
			</div>
		</div>
		
		<div class="form-group row">
			<label for="ref2_contact" class="col-sm-2 col-form-label">Contact</label>
			<div class="col-sm-4">
				<input type="text" class="form-control ref2_contact" id="ref2_contact" name="ref2_contact" placeholder="<?php echo $userDetails[0]['ref2_contact']; ?>" value="<?php echo ucwords($userDetails[0]['ref2_contact']); ?>" data-mask="9999-999-999" />
			</div>
			
			<label for="ref2_email" class="col-sm-2 col-form-label">Email</label>
			<div class="col-sm-4">
				<input type="email" class="form-control ref2_email" id="ref2_email" name="ref2_email" placeholder="<?php echo $userDetails[0]['ref2_email']; ?>" value="<?php echo ucwords($userDetails[0]['ref2_email']); ?>" />
			</div>
		</div>
		<div class="form-group row">
			<label for="ref2_address" class="col-sm-2 col-form-label">Address</label>
			<div class="col-sm-10">
				<textarea class="form-control ref2_address" id="ref2_address" name="ref2_address" ><?php echo ucwords($userDetails[0]['ref2_address']); ?></textarea>
			</div>
		</div>
	  </div>
	
</div>
<div class="tab-pane" id="progress-t-tab3">

	<center><img src="<?php echo base_url('users/');?>assets/images/user/check.png" width="130px"/></center>
	<h5 class="mt-3 text-center">Profile Update! . .</h5>
	<div class="custom-control custom-checkbox">
	<input type="checkbox" class="custom-control-input policy_status" id="customCheck1" name="policy_status" required <?php if($userDetails[0]['policy_status']==1){ echo "checked"; } ?>/>
	<label class="custom-control-label" for="customCheck1">I hereby agree to be a volunteer for Caritas India having understood the <a href="#" data-toggle="modal" data-target=".policy-details"><b>Code of Conduct (volunteer Policy)</b></a> for volunteers and abide by the same as mentioned below.</label>
	</div>
	<ul class="mt-3 ml-3">
	<li>Volunteers are expected to support the vision, mission, values and ethics as specified in the volunteer guide book of Caritas India in delivering of services. </li>
	<li>Volunteers are expected to participate in training and development opportunities provided by Caritas India. </li>
	<li>Volunteers are expected not to use their role within the organization to receive preferential treatment when seeking services for themselves, family or friends. </li>
	<li>	Depending upon the need of the organization and nature of involvement of the volunteer, separate agreement will be made with specific terms and conditions.  </li>
	</ul>


</div>
	<div class="row justify-content-between btn-page">
		<div class="col-sm-6" id="left_previous">
		<button type="button" class="btn btn-primary button-previous" onclick="previous_btn();" style="display:none;">Previous</button>
		</div>
		<div class="col-sm-6 text-md-right" id="right_next">
		<button type="button" class="btn btn-primary button-next" onclick="next_btn(<?php echo $this->session->userdata('userID');?>);" id="button_next" >Next</button>
		<button type="submit" class="btn btn-info button-next" style="display:none;" id="done_next" disabled="disabled">Done</button>
		</div>
	</div>
</form>
</div>
</div>
</div>
</div>
</div>
<script>
function red(url){
	window.location.href = url;
}
</script>


</div>

</div>
</section>

</div>
<script>
	function onlyNumber(id) {
        var id_value = $('#' + id).val();
        id_value = id_value.replace(/[^0-9\.]/g, '');
        $('#' + id).val(id_value);

    }
</script>