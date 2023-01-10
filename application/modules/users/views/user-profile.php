<style>
	#profileImage {
		background: #f9f9f9;
		border: 5px solid #88c;
		padding: 15px;
		border-radius: 5px;
		margin: 10px;
		cursor: pointer;
	}

	.fa-camera {
		color: #fff;
	}

	.icon-add {
		background: #8f281f;
		padding: 6px;
		border-radius: 50%;
		width: 30px;
		margin-top: -20px;
		margin-right: -11px;
	}
	.icon-add:before {
		content: none;
		}
</style>
<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">Edit Profile</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
						<li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn">
					<a href="edit-profile" class="btn btn-primary btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span> Edit Profile
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-4 col-md-12 col-sm-12">
					<div class="card">
					</div>
				</div>
				<div class="col-xl-12 col-md-12 col-sm-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Edit Profile</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-4 m-b-20 text-center">
									<form id="profileImageForm" name="profileImageForm">
										<span id="result"></span>
										<img src='<?php echo base_url(); ?>user_profile/crop.jpg' class="img-fluid border p-1" id="profileImage" style=" width: 340px;height: 257px;"/>
										<input type="file" name="profile" id="my_file" style="display:none" />
										<div class="icon-add pull-right"><i class="fa fa-camera "></i></div>
										<button type="submit" name="submit" value="submit" class="btn btn-danger" disabled style="display:none">Save</button>
									</form>
								</div>
								<script>
									document.getElementById('profileImage').onclick = function() {
										document.getElementById('my_file').click();
									};
								</script>
								<div class="col-md-8">
									<h2 class="f-24 font-medium"><?php echo $volunteerDetails[0]['first_name'].' '.$volunteerDetails[0]['last_name']; ?></h2>
									<p class="m-b-20">Online</p>
									<div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Volunteer ID</div>
										<div class="col"><?php echo $volunteerDetails[0]['volunteer_id']; ?></div>
									</div>
									<div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Phone</div>
										<div class="col"><?php echo $volunteerDetails[0]['mobile']; ?></div>
									</div>
									<div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Email</div>
										<div class="col"><span class="text-inverse"><span class="__cf_email__" data-cfemail="<?php echo $volunteerDetails[0]['email']; ?>"><?php echo $volunteerDetails[0]['email']; ?></span></span></div>
									</div>
									<div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Date of Birth</div>
										<div class="col"><?php echo $volunteerDetails[0]['date_of_birth']; ?></div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>