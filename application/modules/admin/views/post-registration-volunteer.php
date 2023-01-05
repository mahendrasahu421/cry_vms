<?php $base_url = base_url() . 'admin/'; ?>
<!doctype html>
<html lang="en" dir="ltr">

<head>

	<!-- META DATA -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">


	<!-- FAVICON -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon.png"" />

  <!-- TITLE -->
  <title>CRY : VMS</title>

  <!-- BOOTSTRAP CSS -->
  <link id=" style" href="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<!-- STYLE CSS -->
	<link href="<?php echo base_url('admin/'); ?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url('admin/'); ?>assets/css/dark-style.css" rel="stylesheet" />
	<link href="<?php echo base_url('admin/'); ?>assets/css/skin-modes.css" rel="stylesheet" />
	<link href="<?php echo base_url('admin/'); ?>assets/css/transparent-style.css" rel="stylesheet" />
	<link href="<?php echo base_url('admin/'); ?>assets/css/animated.css" rel="stylesheet" />

	<!--- FONT-ICONS CSS -->
	<link href="<?php echo base_url('admin/'); ?>assets/css/icons.css" rel="stylesheet" />
	<link type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
	<link type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">

	<!-- COLOR SKIN CSS -->
	<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('admin/'); ?>assets/colors/color1.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Select2 CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

</head>
<style>
	select.form-control:not([size]):not([multiple]) {
		height: 3.375rem;
	}

	.login100-form {
		width: 573px;

	}

	@media (max-width: 992px) {
		.login100-form {
			width: 100%;
		}
	}

	.login100-form {
		/* width: 320px; */
	}


	.form-label {
		display: block;
		margin-bottom: 0.375rem;
		font-weight: 500;
		font-size: 1.40rem;
		margin-top: 9px;
	}

	.error {
		width: 100%;
		text-align: left;
		color: red;
	}

	#calendar_details_b2c,
	#calendar_details_b2b {
		display: none;
	}

	.select2-container .select2-selection--single {
		height: 3.375rem !important;
	}
</style>

<body>

	<!-- BACKGROUND-IMAGE -->
	<div class="bg-warning">

		<!-- GLOABAL LOADER -->
		<div id="global-loader">
			<img src="<?php echo base_url('users/'); ?>assets/images/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- /GLOABAL LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="">
				<!-- CONTAINER OPEN -->
				<div class="col col-login mx-auto">

					<div class="text-center mt-5">
						<img src="<?php echo base_url('users/'); ?>assets/images/brand/ezgif.com-gif-maker.gif" style="border-radius: 10px;" class="" alt="">
					</div>
				</div>
				<div class="col col-login mx-auto">
					<div class="text-center">
						<img src="assets/images/brand/logo.png" class="header-brand-img" alt="">
					</div>
				</div>
				<div class="container-login100">
					<div class="wrap-login100 p-0">
						<div class="card-header">
							<span class="login100-form-title">Post Registration</span>
						</div>

						<?php echo $this->session->flashdata('master_insert_message'); ?>
						<!-- Row -->
						<form class="needs-validation" novalidate>
							<div class="row ">
								<div class="col-md-12">
									<div class="">
										<div class="card-body">
											<div id="wizard1">
												<h3>Personal Information</h3>
												<div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Name</label>
															<input type="text" name="first_name" class="form-control" placeholder="Name" required>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Email id
															</label>
															<input type="email" name="last_name" class="form-control" placeholder="Email id" required>
														</div>
													</div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Phone No.</label>
															<input type="text" name="first_name" class="form-control" placeholder="Phone No." required>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Date of Birth</label>
															<input type="text" class="form-control" placeholder="Date of Birth" name="dob" id="dob" required autocomplete="off">
															<span id="lblError" style="color:Red"><?php echo $this->session->flashdata('dob_error'); ?></span>
														</div>
													</div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Age</label>
															<input type="text" name="first_name" class="form-control" placeholder="Age" required>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Gender</label>
															<select class="form-control select2 form-select" name="gender" data-placeholder="Select Gender">
																<option label="Select Gender"></option>
																<option value="1">Male</option>
																<option value="2">Female</option>
																<option value="3">Transgender</option>
															</select>
														</div>
													</div>
													<div class="row">
														<div class="control-group form-group col-md-12 mb-0">
															<label class="form-label fw-bold">Present Address
															</label>
															<input type="text" name="first_name" class="form-control" placeholder="Permanent Address" required>
														</div>
													</div>
													<div class="row">
														<div class="control-group form-group col-md-12 mb-0">
															<label class="form-label fw-bold">Permanent Address</label>
															<input type="text" name="first_name" class="form-control" placeholder="Permanent Address" required>
														</div>
													</div>
													<div class="row">
														<div class="control-group form-group col-md-12 mb-0">
															<label class="form-label fw-bold">City of Residence</label>
															<input type="text" name="first_name" class="form-control" placeholder="City of Residence" required>
														</div>
													</div>
												</div>
												<h3>Document Details</h3>
												<div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">ID proof<span class="text-red">*</span>
																<span class="col-auto align-self-center">
																	<span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="(Please attach a scan copy of your PAN Card, aadhar card, passport, driving license, voter id card, ration card)
													" data-bs-original-title="" title="" aria-describedby="popover10908">?</span>
																</span></label>
															<input type="file" name="first_name" class="form-control" required>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Address proof
																<span class="col-auto align-self-center">
																	<span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="(only if you are below 18 years)
													" data-bs-original-title="" title="" aria-describedby="popover10908">?</span>
																</span></label>
															<input type="file" name="first_name" class="form-control" required>
														</div>
													</div>

													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">consent letter from your parents<span class="text-red">*</span> </label>
															<input type="file" name="first_name" class="form-control" required>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Upload a close up photo
															</label>
															<input type="file" name="first_name" class="form-control" required>
														</div>
													</div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Upload your CV

																<span class="col-auto align-self-center">
																	<span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="(Name, Address, and phone number)" data-bs-original-title="" title="" aria-describedby="popover10908">?</span>
																</span> </label>
															<input type="file" name="first_name" class="form-control" required>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Emergency Contact
																<span class="col-auto align-self-center">
																	<span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="(any letter from your professional circle, teachers, professors, or any person in some power who can vouch for you)" data-bs-original-title="" title="" aria-describedby="popover10908">?</span>
																</span>
															</label>
															<input type="text" name="first_name" class="form-control" required>
														</div>

													</div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Reference etter
																<span class="col-auto align-self-center">
																	<span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Please share the contact details: full name, designation, phone and email ID of the person who has written the recommendation letter." data-bs-original-title="" title="" aria-describedby="popover10908">?</span>
																</span>
															</label>
															<input type="file" name="first_name" class="form-control" required>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">share the contact details
																<span class="col-auto align-self-center">
																	<span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="(any letter from your professional circle, teachers, professors, or any person in some power who can vouch for you)" data-bs-original-title="" title="" aria-describedby="popover10908">?</span>
																</span>
															</label>
															<input type="text" name="first_name" class="form-control" required>
														</div>
													</div>


												</div>
												<h3>Occupation Details</h3>
												<div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Occupation</label>
															<select class="form-control select2 form-select" name="gender" data-placeholder="Select Occupation">
																<option label="Select Occupation"></option>
																<option value="1">School Student</option>
																<option value="2">College/university student</option>
																<option value="3">Working professional</option>
																<option value="3">Retired</option>
																<option value="3">Home maker</option>
																<option value="3">Personal business</option>
																<option value="3">Other</option>
															</select>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Name of your school</label>
															<input type="text" name="first_name" class="form-control" placeholder="Name of your school/ college" required>
														</div>
													</div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Designation if working</label>
															<input type="text" name="first_name" class="form-control" placeholder="Designation if working" required>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Languages known</label>
															<select class="form-control select2 form-select" name="gender" data-placeholder="Select Languages">
																<option label="Languages known"></option>
																<option value="1">English</option>
																<option value="2">Hindi</option>
																<option value="3">Other</option>

															</select>
														</div>
													</div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Which kind of programs interests you?</label>
															<select class="form-control select2 form-select" name="gender" data-placeholder=" Your Answer">
																<option label="kind of programs"></option>
																<option value="1">Research and Documentation</option>
																<option value="2">Working with Communities and Children</option>
																<option value="3">Designing posters and pamphlets</option>
																<option value="3">Media related work/ Publishing articles</option>
																<option value="3">Initiating a campaign</option>
																<option value="3">Fundraising</option>
																<option value="3">Video editing, photography etc</option>
																<option value="3">Preparing professional PPT's/documents</option>

															</select>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">What is the time commitment that you can offer with CRY?</label>
															<select class="form-control select2 form-select" name="gender" data-placeholder=" Your Answer">
																<option label="commitment"></option>
																<option value="2">3 to 6 months</option>
																<option value="3">More then 6 months</option>
																<option value="3">More then 1 year</option>
															</select>
														</div>
													</div>

													<div class="row">
														<div class="control-group form-group col-md-12 mb-0">
															<label class="form-label fw-bold">How did you came to know about CRY?</label>
															<select class="form-control select2 form-select" name="gender" data-placeholder=" Your Answer">
																<option label="know about"></option>
																<option value="2">CRY's website</option>
																<option value="3">Social media sites</option>
																<option value="3">Print Ads/ Hoardings</option>
																<option value="3">Friends/Family</option>
																<option value="3">CRY Volunteers/interns</option>
																<option value="3">CRY Staff</option>
																<option value="3">Online ads and posts</option>
																<option value="3">Other</option>
															</select>
														</div>
													</div>
													<hr>
													<h5>Please read the below 3 documents properly</h5>
													<div class="row">
														<div class="col-md-6 mb-0">
															<a href="https://drive.google.com/drive/folders/1OA4CvaYcoVowDUMYyUbmnMvwKKhhiVpt" target="_blank">
																<h5>CRY's Child Protection Policy</h5>
															</a>
														</div>
														<div class="col-md-6 mb-0">
															<a href="https://docs.google.com/document/d/14G9qJjqgCFiapxChbbMRW2dsLPnK8WpVxyZo05qSWsk/edit?usp=sharing" target="_blank">
																<h5>CRY's Code of Conduct</h5>
															</a>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6 mb-0">
															<a href="https://drive.google.com/file/d/119ksoFAzQ7gE8uuvRol0EaCfjbwGL6sz/view?usp=sharing" target="_blank">
																<h5>CRY's Online sessions SOP</h5>
															</a>
														</div>
														<div class="col-md-6 mb-0"></div>
													</div>
													<div class="row">
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Signature</label>
															<input type="text" name="first_name" class="form-control" placeholder="Signature" required>
														</div>
														<div class="control-group form-group col-md-6 mb-0">
															<label class="form-label fw-bold">Date of submission</label>
															<input type="date" name="first_name" class="form-control" required>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/Row -->
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
	<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
	<!-- JQUERY JS -->
	<script>
		$(document).ready(function() {
			$("#country_id").change(function() {

				var country_id = $(this).val();
				// alert(country_id);
				datastr = {
					country_id: country_id
				};

				$.ajax({
					url: '<?php echo base_url() ?>get-states',
					type: 'post',
					data: datastr,
					success: function(response) {
						$("#state_name").html(response);
						$('select').selectpicker('refresh');
					}
				});
			});

		});
	</script>
	<script>
		$(document).ready(function() {
			$("#state_name").change(function() {

				var state_id = $(this).val();
				// alert(state_id);
				datastr = {
					state_id: state_id
				};

				$.ajax({
					url: '<?php echo base_url() ?>get-city',
					type: 'post',
					data: datastr,
					success: function(response) {
						$("#city_name").html(response);
						$('select').selectpicker('refresh');
					}
				});
			});

		});
	</script>
	<script>
		$(function() {
			$("#dob").datepicker({
				changeMonth: true,
				changeYear: true,
				// showOn: 'button',
				buttonImageOnly: false,
				buttonImage: '<?php echo base_url() ?>web/images/calendar.gif',
				dateFormat: 'dd-mm-yy',
				yearRange: '1900:+0',
				onSelect: function(dateString, txtDate) {
					ValidateDOB(dateString);
				}
			});
		});

		function ValidateDOB(dateString) {
			var lblError = $("#lblError");
			var parts = dateString.split("-");
			var dtDOB = new Date(parts[1] + "-" + parts[0] + "-" + parts[2]);
			var dtCurrent = new Date();
			lblError.html("Eligibility 18 years ONLY.")
			if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 18) {
				$('#dob').val('');
				return false;
			}

			if (dtCurrent.getFullYear() - dtDOB.getFullYear() == 18) {
				if (dtCurrent.getMonth() < dtDOB.getMonth()) {
					$('#dob').val('');
					return false;
				}
				if (dtCurrent.getMonth() == dtDOB.getMonth()) {
					if (dtCurrent.getDate() < dtDOB.getDate()) {
						$('#dob').val('');
						return false;
					}
				}
			}
			lblError.html("");
			return true;
		}
	</script>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict'

			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.querySelectorAll('.needs-validation')

			// Loop over them and prevent submission
			Array.prototype.slice.call(forms)
				.forEach(function(form) {
					form.addEventListener('submit', function(event) {
						if (!form.checkValidity()) {
							event.preventDefault()
							event.stopPropagation()
						}

						form.classList.add('was-validated')
					}, false)
				})
		})()
	</script>

	<!-- BACK-TO-TOP -->
	<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

	<!-- JQUERY JS -->
	<script src="<?php echo $base_url; ?>assets/js/jquery.min.js"></script>

	<!-- BOOTSTRAP JS -->
	<script src="<?php echo $base_url; ?>assets/plugins/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo $base_url; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- SIDE-MENU JS-->
	<script src="<?php echo $base_url; ?>assets/plugins/sidemenu/sidemenu.js"></script>

	<!-- Sticky js -->
	<script src="<?php echo $base_url; ?>assets/js/sticky.js"></script>

	<!-- SIDEBAR JS -->
	<script src="<?php echo $base_url; ?>assets/plugins/sidebar/sidebar.js"></script>

	<script src="<?php echo $base_url; ?>assets/plugins/date-picker/jquery-ui.js"></script>
	<script src="<?php echo $base_url; ?>assets/plugins/input-mask/jquery.maskedinput.js"></script>

	<!-- FORM WIZARD JS-->
	<script src="<?php echo $base_url; ?>assets/plugins/formwizard/jquery.smartWizard.js"></script>
	<script src="<?php echo $base_url; ?>assets/plugins/formwizard/fromwizard.js"></script>

	<!-- INTERNAl Jquery.steps js -->
	<script src="<?php echo $base_url; ?>assets/plugins/jquery-steps/jquery.steps.min.js"></script>
	<script src="<?php echo $base_url; ?>assets/plugins/parsleyjs/parsley.min.js"></script>

	<!-- Perfect SCROLLBAR JS-->
	<script src="<?php echo $base_url; ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>
	<script src="<?php echo $base_url; ?>assets/plugins/p-scroll/pscroll.js"></script>
	<script src="<?php echo $base_url; ?>assets/plugins/p-scroll/pscroll-1.js"></script>

	<!-- INTERNAL Accordion-Wizard-Form js-->
	<script src="<?php echo $base_url; ?>assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script>
	<script src="<?php echo $base_url; ?>assets/js/form-wizard.js"></script>

	<!-- Color Theme js -->
	<script src="<?php echo $base_url; ?>assets/js/themeColors.js"></script>

	<!-- CUSTOM JS -->
	<script src="<?php echo $base_url; ?>assets/js/custom.js"></script>

</body>

</html>