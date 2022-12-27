
<div class="loader-bg">
<div class="loader-track">
<div class="loader-fill"></div>
</div>
</div>

<div class="content-main  container mt-3">

<div class="col-md-12">
	<div class="card">
		<div class="card-body">
			<div class="bt-wizard" id="progresswizard">
				<ul class="nav nav-pills nav-fill mb-3">
				<li class="nav-item"><a href="#progress-t-tab1" class="nav-link" data-toggle="tab">Profile</a></li>
				<li class="nav-item"><a href="#progress-t-tab2" class="nav-link" data-toggle="tab">Address</a></li>
				<li class="nav-item"><a href="#progress-t-tab3" class="nav-link" data-toggle="tab">Final</a></li>
				</ul>
				<div id="bar" class="bt-wizard progress mb-3" style="height:6px">
				<div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
				</div>
				<div class="tab-content">
					<div class="tab-pane active show" id="progress-t-tab1">
					<form>
						<div class="form-group row">
						<label for="progress-t-name" class="col-sm-3 col-form-label"> Full Name</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="progress-t-name" placeholder="John">
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="progress-t-name2" placeholder="Deo">
							</div>
						</div>
						<div class="form-group row">
						<label for="progress-t-email" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="progress-t-email" placeholder="caritasindia@gmail.com">
							</div>
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Date of Birth</label>
							<div class="col-sm-8">

								<input type="date" class="form-control" id="progress-t-pwd">
							</div>
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Mobile No.</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="progress-t-pwd2" placeholder="9874563256">
							</div>
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Gender</label>
								<div class="radio radio-warning d-inline ml-3">
								<input type="radio" name="radio-w-in-1" id="radio-w-in-1" >
								<label for="radio-w-in-1" class="cr">Male</label>
								</div>
								<div class="radio radio-warning d-inline">
								<input type="radio" name="radio-w-in-1" id="radio-w-in-2">
								<label for="radio-w-in-2" class="cr">Female</label>
								</div>
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Nationality</label>
							<div class="col-sm-8">
								<select class="form-control">
									<option>Select Nationality</option>
									<option value="Hindu">Hindu</option>
									<option value="Muslim">Muslim</option>
									<option value="Other">Other</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Blood Group</label>
							<div class="col-sm-8">
								<select class="form-control">
									<option>Select Blood Group</option>
									<option value="A+">A+</option>
									<option value="B+">B+</option>
									<option value="A-">A-</option>
									<option value="B-">B-</option>
									<option value="AB+">AB+</option>
									<option value="AB-">AB-</option>
									<option value="O+">O+</option>
									<option value="O-">O-</option>
								</select>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Education</label>
							<div class="col-sm-8">
								<select class="form-control">
									<option>Select Education</option>
									<option value="Graduate">Graduate</option>
									<option value="Post Graduate">Post Graduate</option>
									<option value="Above PG">Above PG</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Language</label>
							<div class="col-sm-8">
							<select class="js-example-basic-multiple col-sm-12" multiple="multiple">
								<option value="AL">Hindi</option>
								<option value="WY">English</option>
								<option value="WS">John Doe</option>
							</select>
							</div>	
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Occupation</label>
							<div class="col-sm-8">
								<select class="form-control">
									<option>Select Occupation</option>
									<option value="Student">Student</option>
									<option value="Govt. Employed">Govt. Employed</option>
									<option value="Religious">Religious</option>
									<option value="Pvt. Employed">Pvt. Employed</option>
									<option value="Self Employed">Self Employed</option>
									<option value="Retired">Retired</option>
									<option value="Others">Others</option>
								</select>
							</div>	
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Service Area</label>
							<div class="col-sm-8">
								<select class="form-control">
									<option>Select Service Area</option>
									<option value="Parish/Local">Parish/Local</option>
									<option value="Diocese/District">Diocese/District</option>
									<option value="Regional/State">Regional/State</option>
									<option value="National">National</option>
								</select>
							</div>	
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Voluntary Service</label>
							<div class="col-sm-8">
								<select class="form-control">
									<option>Select voluntary service</option>
									<option value="Community Mobilization">Community Mobilization</option>
									<option value="Survey">Survey</option>
									<option value="Awareness">Awareness</option>
									<option value="Fund Raising">Fund Raising</option>
									<option value="Information & technology">Information & technology</option>
									<option value="Administrative work">Administrative work</option>
									<option value="Documentation & Publication">Documentation & Publication</option>
									<option value="Others">Others</option>
								</select>
							</div>	
						</div>

					</form>
					</div>
					<div class="tab-pane" id="progress-t-tab2" ng-controller="ExampleController">
					<form>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">State</label>
							<div class="col-sm-8">
								<select class="form-control" ng-model="sa.state" ng-change="sameAddress && update()">
									<option>Select State</option>
									<option value="Community Mobilization">Uttar Pradesh</option>
									<option value="Survey">Madhya Pradesh</option>
								</select>
							</div>	
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">City</label>
							<div class="col-sm-8">
								<select class="form-control" ng-model="sa.city" ng-change="sameAddress && update()">
									<option>Select City</option>
									<option value="Agra">Agra</option>
									<option value="Kanpur">Kanpur</option>
								</select>
							</div>	
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label" ng-model="sameAddress" ng-change="sameAddress && update()">Correspondence Address</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="progress-t-address2" rows="3" spellcheck="false" placeholder="Correspondence Address" ng-model="sa.name" ng-change="sameAddress && update()"></textarea>
						</div>
						</div>
						
						<div class="d-inline-block">
						<label class="check-task custom-control custom-checkbox d-flex justify-content-center">
						<input type="checkbox" class="custom-control-input" class="other">
						<span class="custom-control-label"><b>Check if Correspondence address and Permeant address is same</b>
						</label>
						</div>
						
						

						
						<div class="form-group row mt-3">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">State</label>
							<div class="col-sm-8">
								<select class="form-control" ng-model="ba.street" ng-disabled="sameAddress">
									<option>Select State</option>
									<option value="Community Mobilization">Uttar Pradesh</option>
									<option value="Survey">Madhya Pradesh</option>
								</select>
							</div>	
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">City</label>
							<div class="col-sm-8">
								<select class="form-control" ng-model="ba.city" ng-disabled="sameAddress">
									<option>Select City</option>
									<option value="Agra">Agra</option>
									<option value="Kanpur">Kanpur</option>
								</select>
							</div>	
						</div>
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Permanent Address</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="progress-t-address1" rows="3" spellcheck="false" placeholder="Permanent Address" ng-model="ba.name" ng-disabled="sameAddress"></textarea>
						</div>
						</div>
						
						<div class="form-group row">
							<label for="progress-t-pwd" class="col-sm-3 col-form-label">Specify your area of Expertise</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="progress-t-pwd21" placeholder="Specify area of Expertise, Talents and Skills (Eg.Photography, Writing, Journalism Etc.)">
						</div>
						</div>

					</form>
					</div>
					<div class="tab-pane" id="progress-t-tab3">
					<form>
						<center><img src="assets/images/user/check.png" width="130px"/></center>
						<h5 class="mt-3 text-center">Profile Update! . .</h5>
						<p>I hereby agree to be a volunteer for Caritas India having understood the code of Conduct for volunteers and abide by the same as mentioned below. </p>
						<ul>
						<li>Volunteers are expected to support the vision, mission, values and ethics as specified in the volunteer guide book of Caritas India in delivering of services. </li>
						<li>Volunteers are expected to participate in training and development opportunities provided by Caritas India. </li>
						<li>Volunteers are expected not to use their role within the organization to receive preferential treatment when seeking services for themselves, family or friends. </li>
						<li>	Depending upon the need of the organization and nature of involvement of the volunteer, separate agreement will be made with specific terms and conditions.  </li>
						</ul>

					</form>
				</div>
				<div class="row justify-content-between btn-page">
					<div class="col-sm-6">
					<a href="#!" class="btn btn-primary button-previous">Previous</a>
					</div>
					<div class="col-sm-6 text-md-right">
					<a href="#!" class="btn btn-primary button-next">Next</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


