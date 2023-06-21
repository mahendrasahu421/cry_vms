<style>
	.card {
		position: relative;
		margin-bottom: 1.5rem;
		width: 100%;
	}
</style>
<!-- <?php print_r(
			$_POST['ids']
		); ?> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--- Reject Model Popup----->
<div class="modal fade project-details" role="dialog" aria-hidden="true" style="z-index:99999;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h4 class="modal-title text-uppercase fw-bold">Reject Report Reject</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form method="post" action="" id="disaprovedReport">
				<div class="modal-body">
					<div class="row form-group">
						<div class="col-md-12">
							<input type="hidden" class="form-control" required name="intern_id" id="intern_id" />
							<input type="hidden" class="form-control" required name="sr_id" id="sr_id" />
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<h4 class="">Reason</h4>
						</div>
						<div class="col-md-12">
							<textarea class="form-control" cols="30" rows="5" name="reasonID" id="reasonID" required placeholder="Give some reason"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-rounded btn-primary" id="disaproved" name="disaproved" value="disaproved">Submit</button>
					<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>

				</div>

			</form>

		</div>

	</div>

</div>

<!------ End Model Reject popup ----->
<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">Reject Reports</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Reject Reports</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn" id="flip">
					<a href="javascript:void(0);">
						<!-- <span>
							<i class="fe fe-plus"></i>
						</span> View Filters -->
					</a>

				</div>
			</div>

			<div class="modal fade profile-details" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">
								Profile Details
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body row" id="profile_details">

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade daily-report" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
						<div class="modal-header bg-warning">
							<h4 class="modal-title text-uppercase fw-bold">Reject Report</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body" id="daily-report">
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="card-body">
							<h2>Feedback Report</h2>
							<div class="col-md-12">
								<div class=""><strong>Name : </strong>Name and address of the institution</div><br>
								<div class=""><strong>Name of the Department you interned in: </strong>Name and address
									of the institution</div><br>
								<div class=""><strong>Name & Address: </strong>Name and address of the institution</div>
								<br>
								<div class=""><strong>City of Intership: </strong>Bihar</div><br>
								<div class=""><strong>Intership Tenure: </strong>Name and address of the institution
								</div><br>
								<div class=""><strong>Start Date: </strong>:21/01/2023</div><br>
								<div class=""><strong>End Date :</strong>:21/01/2023</div><br>
								<div class=""><strong>Nature of assignment:</strong>Name and address of the institution
								</div><br>
							</div>
							<div class="modal-footer">
							</div>
							<button type="button" class="btn btn-secondary" id="saveData" data-dismiss="modal">
								Print Full Feedback
							</button>
						</div>

					</div>
				</div>
			</div>

			<style>
				#success_msg {
					color: black;
					margin-bottom: 15px;
					font-size: 20px;
				}
			</style>
			<p id="success_msg"></p>
			<!-- <?php echo $this->session->flashdata('master_insert_message'); ?> -->
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<form action="intern-reject-report" method="post" id="form">
							<div class="card-header">
								<div class="col-md-3">
									<input type="hidden" name="regionId" value="<?php $regionId = $this->session->userdata('region_id'); ?>">
									<?php $regionId = $this->session->userdata('region_id'); ?>
									<select class="form-control select2-show-search form-select" name="region_id" id="region_id">
										<option selected disabled value="">Select Region</option>
										<?php foreach ($regions as $rd) {
										?>
											<option value="<?php echo $rd['region_id']; ?>" <?php if ($region_id == $rd['region_id']) {
																								echo "selected";
																							} ?>><?php echo $rd['region_name'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-3">
									<select class="form-control select2-show-search form-select" name="state_name" id="state_name">
										<option value="">Select State</option>
										<?php foreach ($states as $sd) { ?>
											<option value="<?php echo $sd['state_id']; ?>" <?php echo $states == $sd['state_id'] ? "selected" : ""; ?>>
												<?php echo $sd['state_name']; ?>
											</option>

										<?php } ?>
									</select>
								</div>

								<div class="col-lg-2">
									<div class="input-group">
										<div class="input-group-text">
											<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
										</div>
										<input class="form-control fc-datepicker" name="start_new" value="<?php echo date("m/d/Y", strtotime($date_from)) ?>" required placeholder="To" id="toDate" type="text">
									</div>
								</div>
								<strong style="font-size: 15px; font:900">To</strong>
								<div class="col-lg-2">
									<div class="input-group">
										<div class="input-group-text">
											<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
										</div>
										<input class="form-control fc-datepicker" name="end_new" value="<?php echo date("m/d/Y", strtotime($date_to)) ?>" required placeholder="From" id="fromDate" type="text">
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-group  p-0">
										<button type="submit" name="submit" id="searchData" class="input-group-text btn btn-warning">Search</button>
									</div>
								</div>

							</div>
						</form>
						<div class="card-body">
							<div class="table-responsive ">
								<table id="example" class="display" cellspacing="0" width="100%">
									<thead>
										<tr class="bg-gray-light">
											<th>Sr.no</th>
											<th>Reject Date</th>
											<th>Name</th>
											<th>Mobile</th>
											<th>State</th>
											<th>Districts</th>
											<th>Email</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										foreach ($RejectReports as $RejectReportsData) {
											$intern_id = $RejectReportsData['intern_id'];
											$sr_id = $RejectReportsData['sr_id'];
											$volunteerEmail = $RejectReportsData['email'];
											$encoded_id = rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
											$encoded_sr_id = rtrim(strtr(base64_encode($sr_id), '+/', '-_'), '=');
										?>
											<tr>
												<td>
													<?php echo $count++; ?>
												</td>
												<td>
													<?php echo date("d-m-Y", strtotime($RejectReportsData['final_sunmission_date'])); ?>
												</td>
												<td>
													<?php echo ucwords($RejectReportsData['first_name'] . ' ' . $RejectReportsData['last_name']); ?>
													<br>
													<a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encoded_id; ?>','profile_details');">
														<small class="text-primary">(View Profile)</small></a>
												</td>
												<td><?php echo $RejectReportsData['mobile']; ?>
												</td>
												<td><?php echo $RejectReportsData['state_name']; ?></td>
												<td><?php echo $RejectReportsData['city_name']; ?></td>
												<td><?php echo $volunteerEmail; ?></td>
												<td>
													<span class="badge bg-warning  me-1 mb-1 mt-1">Rejected</span>
												</td>
											</tr>
										<?php
										} ?>
									</tbody>
								</table>
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
<script>
	function disapproved(intern_id, sr_id) {
		// alert(intern_id);
		$('#intern_id').val(intern_id);
		$('#sr_id').val(sr_id);

	}
</script>

<script>
	$("#disaproved").click(function(ev) {
		var intern_id = $("#intern_id").val();
		var sr_id = $("#sr_id").val();
		var reasonID = $("#reasonID").val();
		datastr = {
			intern_id: intern_id,
			sr_id: sr_id,
			reasonID: reasonID,
		};
		$.ajax({
			url: '<?php echo base_url() ?>Reject-reportReject',
			type: 'post',
			data: datastr,
			success: function(data) {
				if (data == 1) {
					window.location.href = "Reject_reports";
				}
				$('#success_msg').html('Your Registration Complete We Will Contact Soon!');
			},
			error: function(data) {}
		});

	});
</script>

<script>
	function fetch_report(id, userid, display_id) {
		//alert(id);
		$('#' + display_id).html('<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>');
		var request = $.ajax({
			url: '<?php echo base_url("Reject_report"); ?>',
			method: "POST",
			data: {
				sr_id: id,
				intern_id: userid,
			},
			success: function(results) {
				$('#' + display_id).html(results);
			}
		});
	}
</script>
<script>
	function fetch_details(id, display_id) {
		//alert(id);
		$('#' + display_id).html(
			'<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>'
		);
		var request = $.ajax({
			url: '<?php echo base_url("fetch-user-info-intern"); ?>',
			method: "POST",
			data: {
				intern_id: id
			},
			success: function(results) {
				// console.log(results);
				//alert(results);
				$('#' + display_id).html(results);

			}
		});
	}
</script>
<script>
	$(document).ready(function() {
		$('#projectData').click(function() {
			let project = $('#projectData').val();
			if (project != null) {
				//alert(emialcontent);
				$('#projectData').val(projectData);
			} else {

			}
		})

	});
</script>


<script>
	$(document).ready(function() {
		$('#saveData').click(function() {
			let emialcontent = $('#emialcontent').val();
			if (emialcontent != null) {
				//alert(emialcontent);
				$('#emailContentValue').val(emialcontent);
			} else {

			}
		})

	});
</script>

<!-- <script>
	$(document).ready(function() {
		let region_id = $('#region_id').val();
		
			$('#region_id option:not(:selected)').attr('disabled', true);
	

	});
</script> -->
<script>
	let example = $('#example').DataTable({
		columnDefs: [{
			orderable: false,
			className: 'select-checkbox',
			targets: 0
		}],
		select: {
			style: 'os',
			selector: 'td:first-child'
		},
		order: [
			[1, 'asc']
		]
	});
	example.on("click", "th.select-checkbox", function() {
		if ($("th.select-checkbox").hasClass("selected")) {
			example.rows().deselect();
			$("th.select-checkbox").removeClass("selected");
		} else {
			example.rows().select();
			$("th.select-checkbox").addClass("selected");
		}
	}).on("select deselect", function() {
		("Some selection or deselection going on")
		if (example.rows({
				selected: true
			}).count() !== example.rows().count()) {
			$("th.select-checkbox").removeClass("selected");
		} else {
			$("th.select-checkbox").addClass("selected");
		}
	});
</script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script>
	$(document).ready(function() {
		$("#region_id").change(function() {
			var region_id = $(this).val();
			//alert(region_id);
			datastr = {
				region_id: region_id
			};

			$.ajax({
				url: '<?php echo base_url() ?>get-states-admin',
				type: 'post',
				data: datastr,
				success: function(response) {
					$("#state_name").html(response);
					// $('select').selectpicker('refresh');
				}
			});
		});

	});
</script>

<script>
	$(document).on('click', '#submit3', function() {
		var matches = [];
		var table = $('#file-datatable').dataTable();
		var checkedcollection = table.$(".che:checked", {
			"page": "all"
		});
		checkedcollection.each(function(index, elem) {
			matches.push($(elem).val());
		});
		var AccountsJsonString = JSON.stringify(matches);
		console.log(AccountsJsonString);
		alert(AccountsJsonString);
		$('#ids').val(AccountsJsonString);
		$('#id-form').submit();
	});
</script>

<script>
	$(document).ready(function() {
		$('#chkParent').click(function() {
			var isChecked = $(this).prop("checked");
			$('#example tr:has(td)').find('input[type="checkbox"]').prop('checked', isChecked);
		});

		$('#example tr:has(td)').find('input[type="checkbox"]').click(function() {
			var isChecked = $(this).prop("checked");
			var isHeaderChecked = $("#chkParent").prop("checked");
			if (isChecked == false && isHeaderChecked)
				$("#chkParent").prop('checked', isChecked);
			else {
				$('#example tr:has(td)').find('input[type="checkbox"]').each(function() {
					if ($(this).prop("checked") == false)
						isChecked = false;
				});
				console.log(isChecked);
				$("#chkParent").prop('checked', isChecked);
			}
		});
	});


	$(document).ready(function() {
		var $checkboxes = $('#id-form td input[type="checkbox"]');
		$checkboxes.change(function() {
			var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
			$('#count-checked-checkboxes').text(countCheckedCheckboxes);
			$('#edit-count-checked-checkboxes').val(countCheckedCheckboxes);
		});
	});
</script>