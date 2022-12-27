<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">Edit Task</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Task</li>
					</ol>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-warning">
						<div class="card-title">Edit Task</div>
					</div>
					<form action="<?php echo base_url(); ?>update_task" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
						<div class="card-body">
							<div class="row">
								<input name="task_id" type="hidden" class="form-control" value="<?php echo $taskData[0]['task_id']; ?>" required>
								<div class="col-md-4">
									<label for="validationCustom02" class="form-label">Task Type<sup class="text-danger fs-6">*</sup></label>
									<select class="form-control select2-show-search form-select" name="task_type_id" id="validationCustom04" required>
										<option selected disabled value="">Choose Task Type </option>
										<?php foreach ($task_type as $tt) { ?>
											<option value="<?php echo $tt['task_type_id']; ?>" <?php if ($taskData[0]['task_type_id'] == $tt['task_type_id']) {
																									echo  "selected";
																								} ?>><?php echo $tt['task_type']; ?></option>

										<?php } ?>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<!-- <div class="col-md-4">
									<label for="validationCustom02" class="form-label">Task For<sup class="text-danger fs-6">*</sup></label>
									<select class="form-select select2 form-control" name="task_for" id="validationCustom04" required>
										<option selected disabled value="">Choose</option>
										<option value="1" <?php if ($taskData[0]['task_for'] == 1) {
																echo  "selected";
															} ?>>
											Volunteer
										</option>
										<option value="2" <?php if ($taskData[0]['task_for'] == 2) {
																echo  "selected";
															} ?>>
											Intern
										</option>
									</select>

									<div class="invalid-feedback"></div>
								</div> -->
								<div class="col-md-4">
									<label for="validationCustom02" class="form-label">Select Region<sup class="text-danger fs-6">*</sup></label>
									<select class="form-control select2-show-search form-select" name="region_id" id="region_id" required>
										<option selected disabled value="">Choose Region</option>
										<?php foreach ($regions as $rd) { ?>
											<option value="<?php echo $rd['region_id']; ?>" <?php if ($taskData[0]['region_id'] == $rd['region_id']) {
																								echo  "selected";
																							} ?>><?php echo $rd['region_name']; ?></option>

										<?php } ?>
									</select>

									<div class="invalid-feedback"></div>
								</div>
								<div class="col-md-4 thisOnline">
									<label for="validationCustom02" class="form-label">Select State<sup class="text-danger fs-6">*</sup></label>
									<select class="form-control select2-show-search form-select" disabled name="state_name" id="state_name" required>
										<option selected disabled value="">Choose State </option>
										<?php foreach ($states as $sd) { ?>
											<option value="<?php echo $sd['state_id']; ?>" <?php if ($taskData[0]['task_state_id'] == $sd['state_id']) {
																								echo  "selected";
																							} ?>><?php echo $sd['state_name']; ?></option>

										<?php } ?>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="col-md-4 thisOnline">
									<label for="validationCustom02" class="form-label">Select District<sup class="text-danger fs-6">*</sup></label>
									<select class="form-control select2-show-search form-select" name="city" id="city" required>
										<option>Select District</option>
										<?php foreach ($cities as $cd) { ?>
											<option value="<?php echo $cd['city_id']; ?>" <?php if ($taskData[0]['city_id'] == $cd['city_id']) {
																								echo "selected";
																							} ?>>
												<?php echo $cd['city_name']; ?>
											</option>

										<?php } ?>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="col-md-4">
									<label for="validationCustom02" class="form-label">Start Date<sup>*</sup></label>
									<input type="date" name="sdate" id="sdate" value="<?php echo $taskData[0]['start_date']; ?>" onkeyup="onlyNumber('sdate');" class="form-control dob_caf" required />
									<div class="ininvalid-feedback"></div>
								</div>
								<div class="col-md-4 ">
									<label for="validationCustom02" class="form-label">Expected End Date <sup>*</sup></label>
									<input type="date" name="edate" id="edate" onkeyup="onlyNumber('sdate');" value="<?php echo $taskData[0]['expected_end_date']; ?>" class="form-control dob_caf" required />
									<div id="expdateerror" class="col-md-12"></div>
									<div class="invalid-feedback"></div>
								</div>
								<div class="col-md-4">
									<label for="validationCustom02" class="form-label">Total Volunteers Required <sup>*</sup></label>
									<input type="text" class="form-control" onkeyup="onlyNumber('volunteer');" id="volunteer" name="volunteer_required" value="<?php echo $taskData[0]['volunteer_required']; ?>" required />
								</div>
								
								<div class="col-md-4">
									<label for="validationCustom02" class="form-label">Keywords<sup>*</sup></label>
									<select class="form-control select2-show-search form-select" name="keywords" id="city" required>

										<option value="0">Select Keywords</option>
										<option value="Research" <?php echo $taskData[0]['keyword'] == "Research" ? 'selected' : ''; ?>>Research</option>
										<option value="Documentation" <?php echo $taskData[0]['keyword'] == "Documentation" ? 'selected' : ''; ?>>Documentation</option>
										<option value="Data Analysis" <?php echo $taskData[0]['keyword'] =="Data Analysis" ?'selected':'';?>>Data Analysis</option>
										<option value="Layout and design" <?php echo $taskData[0]['keyword'] =="Layout and design" ?'selected':'';?>>Layout and design</option>
										<option value="Direct work with children" <?php echo $taskData[0]['keyword'] =="Direct work with children" ?'slected':'';?>>Direct work with children</option>
										<option value="Awareness campaigns" <?php echo $taskData[0]['keyword'] =="Awareness campaigns" ?'selected':'';?>>Awareness campaigns</option>
										<option value="Fundraising" <?php echo $taskData[0]['keyword'] =="Fundraising" ?'selected':'';?>>Fundraising</option>
										<option value="Video/film making" <?php echo $taskData[0]['keyword'] =="Video/film making" ?'selected':'';?>>Video/film making</option>

									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="col-md-4">
									<label for="validationCustom02" class="form-label">Task Title <sup>*</sup></label>
									<textarea class="form-control" value="" id="exampleFormControlTextarea2" rows="2" placeholder="Title" maxlength="150" name="title" required><?php echo $taskData[0]['task_title']; ?></textarea>
									<div class="invalid-feedback"></div>
								</div>
								<div class="col-md-12">
									<label for="validationCustom04" class="form-label">What To Do ?<sup>*</sup></label>
									<div class="">
										<textarea class="content" name="what_to_do" rows="4" cols="10" required><?php echo $taskData[0]['task_brief']; ?></textarea>
									</div>
								</div>
								<div class="col-md-6 upstair">
									<label for="inputEmail3" class="form-label">Status</label>
									<select class="form-select select2 form-control" name="status" id="validationCustom04" required>
										<option selected disabled value="">Choose</option>
										<option value="1" <?php if ($taskData[0]['status'] == 1) {
																echo  "selected";
															} ?>>
											Published
										</option>
										<option value="2" <?php if ($taskData[0]['status'] == 2) {
																echo  "selected";
															} ?>>
											Unpublished
										</option>
									</select>
								</div>
								<div class="col-md-6 upstair float-left">
									<button class="btn btn-warning" type="submit" value="Submit" style="margin-top: 6%; margin-left:80%;">Submit
									</button>
								</div>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		let region_id = $('#region_id').val();
		if (region_id != null) {
			$('#region_id option:not(:selected)').attr('disabled', true);
		}

	});
</script>
<script>
	$(document).ready(function() {
		$('#task_type').change(function() {
			var task_type = $('#task_type').val();
			if (task_type == 1) {
				$('.thisOnline').hide();
			} else {
				$('.thisOnline').show();
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		$("#region_id").change(function() {
			var region_id = $(this).val();
			datastr = {
				region_id: region_id
			};

			$.ajax({
				url: '<?php echo base_url() ?>get-states-admin',
				type: 'post',
				data: datastr,
				success: function(response) {
					$("#state_name").html(response);
					$('select').selectpicker('refresh');
				}
			});
		});

	});
	$(document).ready(function() {
		$("#state_name").change(function() {
			var state_name = $(this).val();
			datastr = {
				state_name: state_name
			};
			//alert(datastr)
			$.ajax({
				url: '<?php echo base_url() ?>get-city-by-task',
				type: 'post',
				data: datastr,
				success: function(response) {
					$("#city").html(response);
					//$('select').selectpicker('refresh');
				}
			});
		});

	});
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