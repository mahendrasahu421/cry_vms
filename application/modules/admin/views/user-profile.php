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
		margin-top: -18px;
		margin-right: -27px;
	}
</style>
<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">

			<div class="page-header">
				<div>
					<h1 class="page-title">Edit Profile</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Edit Profile</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn">
					<a href="add-daily-report" class="btn btn-warning btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span> Edit Profile
					</a>

				</div>
			</div>
			<div class="row">
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
										<img src='http://localhost/vms/user_profile/1653049649Partnership-Insurance_(1).jpg' width="100%" class="img-fluid border p-1" id="profileImage" />
										<input type="file" name="profile" id="my_file" style="display:none" />
										<!-- <div class="icon-add pull-right">
											<i class="fa fa-camera "></i>
										</div> -->
										<button type="submit" name="submit" value="submit" class="btn btn-danger" disabled style="display:none">Save</button>

									</form>
								</div>


								<script>
									document.getElementById('profileImage').onclick = function() {
										document.getElementById('my_file').click();
									};
								</script>


								<div class="col-md-8">
									<h2 class="f-24 font-medium">Pransi Gupta</h2>
									<!-- <p class="m-b-20">Online</p> -->
									<!-- <div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Volunteer </div>
										<div class="col">CS/UP/20/01</div>
									</div> -->
									<div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Phone</div>
										<div class="col">8299756650</div>
									</div>
									<div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Email</div>
										<div class="col"><span class="text-inverse"><span class="__cf_email__" data-cfemail="pransi.g@neuralinfo.org">pransi.g@neuralinfo.org</span></span></div>
									</div>

									<div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Date of Birth</div>
										<div class="col">30-06-1996</div>
									</div>


									<div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Education</div>
										<div class="col">Post-Graduate</div>
									</div>
									<div class="row mb-2">
										<div class="col-4 font-weight-bold text-dark">Occupation</div>
										<div class="col ">Student</div>
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