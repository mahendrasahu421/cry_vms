<div class="main-content app-content mt-0">
	<div class="side-app">

		<!-- CONTAINER -->
		<div class="main-container container-fluid">

			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">
						User Profile</h1>
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
							<form class="needs-validation" novalidate>
								<div class="form-row">
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold">First Name</label>
										<input type="text" class="form-control" placeholder="First Name" required>
									</div>
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold">Last Name</label>
										<input type="text" class="form-control" placeholder="Last Name" required>
									</div>
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold">Age</label>
										<div class="input-group mb-4">
											<input type="text" class="form-control" placeholder="Date of Birth" name="dob" id="dob" required autocomplete="off">
										</div>
										<span id="lblError" style="color:Red"><?php echo $this->session->flashdata('dob_error'); ?></span>
									</div>

									<div class="form-group col-md-6 mb-0 select-dropdown">
										<label class="form-label fw-bold">City</label>
										<select class="form-control select2" data-placeholder="">
											<option>Male</option>
											<option>Female</option>
											<option>Transgender</option>
										</select>
									</div>
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold"> Enter Email</label>
										<input type="email" class="form-control" placeholder="Email" required>
									</div>
									<div class="form-group col-md-6 mb-0">
										<label class="form-label fw-bold"> Enter Mobile Number</label>
										<input type="text" class="form-control" placeholder="Mobile number" required>
									</div>

									<div class="form-group col-md-6 mb-0 select-dropdown">
										<label class="form-label fw-bold">City</label>
										<select class="form-control select2" data-placeholder="">
											<option selected>Select City...</option>
											<option>Delhi</option>
											<option>Mumbai</option>
											<option>Bangalore</option>
											<option>Hyderabad</option>
										</select>
									</div>
									<div class="form-group col-md-6 mb-0 select-dropdown">
										<label class="form-label fw-bold">Occupation</label>
										<select class="form-control select2" data-placeholder="">
											<option selected>Select Occupation...</option>
											<option>School student</option>
											<option>college/university student</option>
											<option>working professional</option>
											<option>Retired</option>
											<option>home maker</option>
											<option>personal business</option>
											<option>others</option>
										</select>
									</div>

									<div class="form-group col-md-6 mb-0 select-dropdown">
										<label class="form-label fw-bold">Type Of Volunteering</label>
										<select class="form-control select2" data-placeholder="">
											<option value="Firefox">
												Online
											</option>
											<option value="Chrome selected">
												Onground
											</option>



										</select>
									</div>
									<div class="form-group col-md-6 mb-0 select-dropdown">
										<label class="form-label fw-bold">Where did you get to know about this
											opportunity</label>
										<select class="form-control select2" data-placeholder="" multiple>
											<option value="Firefox">
												CRY website
											</option>
											<option value="Chrome selected">
												social media sites
											</option>
											<option value="Safari">
												hoardings
											</option>
											<option value="Opera">
												Family/Friend
											</option>
											<option value="Internet Explorer">
												CRY volunteers/interns
											</option>
											<option value="Internet Explorer">
												CRY staff
											</option>
											<option value="Internet Explorer">
												Online ads and posts
											</option>
											<option>Others</option>
										</select>
									</div>
								</div>
								<button class="btn btn-warning mt-5" type="submit">Submit form</button>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</div>