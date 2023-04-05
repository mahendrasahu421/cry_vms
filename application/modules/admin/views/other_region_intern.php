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
<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title"> Intern Transfer </h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page"> Intern Transfer </li>
					</ol>
				</div>
			</div>
			<style>
				#success_msg {
					/* padding: 20px; */
					/* background-color: #f7b731; */
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
						<form action="other_region_intern" method="post">
							<div class="card-header">
								<div class="col-md-3">
									<input type="hidden" name="regionId" value="<?php $regionId = $this->session->userdata('region_id'); ?>">
									<?php $regionId = $this->session->userdata('region_id'); ?>
									<select class="form-control select2-show-search form-select" name="region_id" id="region_id">
										<option selected disabled value="">Select Region</option>
										<?php foreach ($regions as $rd) {
										?>
											<option value="<?php echo $rd['region_id']; ?>" <?php if ($regionId == $rd['region_id']) {
																								echo "selected";
																							} ?>><?php echo $rd['region_name'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-3">
									<select class="form-control select2-show-search form-select" name="state_name" id="state_name">
										<option value="">Select State</option>

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
						<form method="post" action="send_internstateUpdate_email" id="id-form">
							<input type="hidden" value="" id="ids" name="ids">
							<div class="card-body">
								<div class="table-responsive ">
									<table id="example" class="display nowrap" style="width:100%">
										<thead>
											<tr class="bg-gray-light">
												<th>Sr.no</th>
												<th>Request Date</th>
												<th>Name </th>
												<th>Mobile Number</th>
												<th>Email</th>
												<th>Current State</th>
												<th>Where to Relocate State</th>
												<th>Where to Relocate City</th>
												<th>Resion</th>
												<th>Action </th>


											</tr>
										</thead>
										<tbody>
											<?php
											$count = 1;
											foreach ($internTransfer as $volunteerData) {
												$relocate_id = $volunteerData['relocate_id'];
												$relocateState = $volunteerData['relocate_state'];
												$relocate_city = $volunteerData['relocate_city'];
												$intern_id = $volunteerData['intern_id'];
												$internEmail = $volunteerData['email'];
												$encoded_id = rtrim(strtr(base64_encode($volunteer_id), '+/', '-_'), '=');
												$internencoded_id = rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
											?>
												<tr>
													<td>
														<input class="che" id="intern_id" name="numchec" value="<?php echo $intern_id; ?>" type="checkbox">
													</td>
													<td>
														<?php echo date("d-m-Y", strtotime($volunteerData['creation_date'])); ?>
													</td>
													<td>
														<?php echo ucwords($volunteerData['first_name'] . ' ' . $volunteerData['last_name']); ?>
														<br>
														<a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encoded_id; ?>','profile_details');">
															<small class="text-primary">(View Profile)</small></a>
													</td>
													<td><?php echo $volunteerData['mobile']; ?>
													</td>
													<td><?php echo $internEmail; ?></td>

													<td><?php echo $volunteerData['state_name']; ?></td>
													<td>
														<?php echo $volunteerData['relocate_state_name']; ?></td>
													<td>
														<?php echo $volunteerData['relocate_city_name']; ?></td>
													<td>
														<?php echo $volunteerData['relocate_reason']; ?></td>
													<td>
														<?php if ($volunteerData['status'] == 2) { ?>
															<button type='button' onclick="getId_sendmail('<?php echo $internEmail; ?>',<?php echo $relocateState; ?>,<?php echo $relocate_id; ?>,<?php echo $intern_id; ?>,<?php echo $relocate_city; ?>)" class='badge bg-warning  me-1 mb-1 mt-1'>Accepted</button>
														<?php } else { ?>
															<button type='button' onclick="getId_sendmail('<?php echo $internEmail; ?>',<?php echo $relocateState; ?>,<?php echo $relocate_id; ?>,<?php echo $intern_id; ?>,<?php echo $relocate_city; ?>)" class='badge bg-info  me-1 mb-1 mt-1'>Accept</button>

														<?php } ?>
													</td>
												</tr>
											<?php
											} ?>
										</tbody>
									</table>
									<!-- <input type="botton" id="submit3" value="Send Post Registration" class="mt-5 btn btn-warning  pull-right" id="map_button" style="padding: 1% 2% 1% 2%;"> -->
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
</div>
<script>
	function getId_sendmail(internEmail, relocateState, relocate_id, intern_id, relocate_city) {
		var internEmail = internEmail;
		var relocateState = relocateState;
		var relocate_city = relocate_city;
		var relocate_id = relocate_id;
		var intern_id = intern_id;
		//alert(relocate_city);
		datastr = {
			internEmail: internEmail,
			relocateState: relocateState,
			relocate_city: relocate_city,
			relocate_id: relocate_id,
			intern_id: intern_id
		};

		$.ajax({
			url: '<?php echo base_url() ?>update_intern_by_region_manager',
			type: 'post',
			data: datastr,
			success: function(response) {
				$('#success_msg').html('Update State Successfully..');

			}
		});

	}
</script>

<script>
	function fetch_details(id, display_id) {
		//alert(id);
		$('#' + display_id).html('<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>');
		var request = $.ajax({
			url: '<?php echo base_url("fetch-user-info"); ?>',
			method: "POST",
			data: {
				volunteer_id: id
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
	$(document).ready(function() {

			var region_id = $('#region_id').val();
	
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