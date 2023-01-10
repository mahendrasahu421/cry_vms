<div class="main-content app-content mt-0">
	<div class="side-app">

		<!-- CONTAINER -->
		<div class="main-container container-fluid">

			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">
						Intern Profile</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<!-- <li class="breadcrumb-item "><a href="javascript:void(0);"> Dashboards
							</a></li> -->
						<li class="breadcrumb-item active text-warning" aria-current="page">
							Edit Profile</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xl-12">
					<div class="card">
						<div class="card-header bg-warning">
							Update Your Profile</h3>
						</div>
						<div class="card-body">
							<form class="needs-validation" action="<?php echo base_url(); ?>update_profile" method="post" name="form" id="form" novalidate>
								<div class="form-row">
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold">First Name</label>
										<input type="text" class="form-control" value="<?php echo $internDetails[0]['first_name']; ?>" required name="first_name">
									</div>
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold">Last Name</label>
										<input type="text" class="form-control" value="<?php echo $internDetails[0]['last_name']; ?>" required name="last_name">
									</div>

									<!-- <div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold">Age</label>
										<div class="input-group mb-4">
											<?php if($internDetails[0]['date_of_birth']=="0000-00-00"){
												$dob="";
											 }else{
												$dob= date('d/m/Y',strtotime($internDetails[0]['date_of_birth']));
											 }?>
											<input type="text" class="form-control" value="<?php echo $dob; ?>" name="dob" id="dob" required autocomplete="off">
										</div>
										<span id="lblError" style="color:Red"><?php echo $this->session->flashdata('dob_error'); ?></span>
									</div> -->

									<!-- <div class="form-group col-md-6 mb-0 select-dropdown">
										<label class="form-label fw-bold">Gender</label>
										<select class="form-control" data-placeholder="" name="gender">
											<option <?php if($internDetails[0]['gender']==1){echo 'selected=selected';}?> value="1" <?php echo $volunteerDetails[0]['gender']; ?>>Male</option>
											<option <?php if($internDetails[0]['gender']==2){echo 'selected=selected';}?> value="2" <?php echo $volunteerDetails[0]['gender']; ?>>Female</option>
											<option <?php if($internDetails[0]['gender']==3){echo 'selected=selected';}?> value="3" <?php echo $volunteerDetails[0]['gender']; ?>>Transgender</option>
										</select>
									</div> -->
									<!-- <div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold"> Enter Email</label>
										<input type="email" class="form-control" placeholder="Email" value="<?php echo $internDetails[0]['email']; ?>" required name="email">
									</div> -->
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold"> Enter Mobile Number</label>
										<input type="text" class="form-control" placeholder="Mobile number" value="<?php echo $internDetails[0]['mobile']; ?>" required name="mobile">
									</div>

									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold">Present Address</label>
										<input type="text" class="form-control" placeholder="" value="<?php echo $internDetails[0]['present_address']; ?>" required name="present_address">
									</div>
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold">Permanent Address</label>
										<input type="text" class="form-control" placeholder="" value="<?php echo $internDetails[0]['permanent_address']; ?>" required name="permanent_address">
									</div>
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold">Emergency Contact</label>
										<input type="text" class="form-control" placeholder="" value="<?php echo $internDetails[0]['emergency_contact']; ?>" required name="emergency_contact">
									</div>
<!-- 
									<div class="form-group col-md-6 mb-0 select-dropdown">
										<label class="form-label fw-bold">District</label>
										<select class="form-control select2" name="city_id">
											<option selected>Select District...</option>
											<?php foreach ($city as $cc) { ?>
											<option <?php if($internDetails[0]['city_id']==$cc['city_id']){echo 'selected=selected';}?> value="<?php $cc['city_id']; ?>"><?php echo $cc['city_name']; ?></option>
											<?php } ?>
										</select>
									</div> -->
									<!--<div class="form-group col-md-6 mb-0 select-dropdown">
										<label class="form-label fw-bold">Occupation</label>
										<select class="form-control select2" name="occupation_id">
											<option selected>Select Occupation...</option>
											<?php foreach ($occup as $occ) { ?>
											<option <?php if($internDetails[0]['occupation_id']==$occ['occupation_id']){echo 'selected=selected';}?> value="<?php $occ['occupation_id']; ?>"><?php echo $occ['occupation_name']; ?></option>
											<?php } ?>
										</select>
									</div>-->

									<!-- <div class="form-group col-md-6 mb-0 select-dropdown">
										<label class="form-label fw-bold">Type Of Volunteering</label>
										<select class="form-control select2" name="vol_type_id">
											<option selected>Select Type...</option>
											<?php foreach ($vol_type as $vt) { ?>
											<option <?php if($internDetails[0]['vol_type_id']==$vt['vol_type_id']){echo 'selected=selected';}?> value="<?php echo $vt['vol_type_id']; ?>"><?php echo $vt['vol_type_name']; ?></option>
											<?php } ?>
										</select>
									</div> -->
									<!-- <div class="form-group col-md-12 mb-0 select-dropdown">
										<label class="form-label fw-bold">Where did you get to know about this
											opportunity</label>
										<select class="form-control select2"  multiple name="opportunity_id[]">
											<option value="0">Select Opportunity...</option>
											<?php foreach ($oppor as $opr) { ?>
											<option <?php if($internDetails[0]['opportunity_id']==$opr['opportunity_id']){echo 'selected=selected';}?> value="<?php $opr['opportunity_id']; ?>"><?php echo $opr['opportunity_name']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div> -->
								<button class="btn btn-warning mt-5" type="submit">Update</button>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</div>