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
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
			<div class="modal-body">
				<div class="modal-body row" id="profile_details">
					<div class="col-md-3 m-b-20 text-center">
						<img src="<?php echo base_url('admin/'); ?>assets/images/crop.jpg" class="img-fluid" alt="" title="">
					</div>
					<div class="col-md-8">
						<h2 class="">Mahendra sahu</h2>
						<div class="row mb-2">
							<div class="col-4 font-weight-bold text-dark">Volunteer ID</div>
							<div class="col">CS/DL/21/79</div>
						</div>
						<div class="row mb-2">
							<div class="col-4 font-weight-bold text-dark">Phone</div>
							<div class="col">9871191543</div>
						</div>
						<div class="row mb-2">
							<div class="col-4 font-weight-bold text-dark">Email</div>
							<div class="col"><a href="#" class="text-inverse"><span class="_cf_email_">thejasjohn12@gmail.com</span></a></div>
						</div>
						<div class="row mb-2">
							<div class="col-4 font-weight-bold text-dark">Date of Birth</div>
							<div class="col">25-11-2000</div>
						</div>


						<div class="row mb-2">
							<div class="col-4 font-weight-bold text-dark">State</div>
							<div class="col">Delhi</div>
						</div>
						<div class="row mb-2">
							<div class="col-4 font-weight-bold text-dark">City</div>
							<div class="col"></div>
						</div>
						<div class="row mb-2">
							<div class="col-4 font-weight-bold text-dark">Address</div>
							<div class="col"></div>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="modal-body">
                <div class="modal-body row" id="profile_details">
                    <div class="col-md-3 m-b-20 text-center">
                        <img src="<?php echo base_url('admin/'); ?>assets/images/crop.jpg" class="img-fluid" alt="" title="">
                    </div>
                    <div class="col-md-8">
                        <h2 class="">Ravi Sharma</h2>
                        <div class="row mb-2">
                            <div class="col-4 font-weight-bold text-dark">Volunteer ID</div>
                            <div class="col">CS/DL/21/78</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 font-weight-bold text-dark">Phone</div>
                            <div class="col">88747574748</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 font-weight-bold text-dark">Email</div>
                            <div class="col"><a href="#" class="text-inverse"><span class="_cf_email_">ravi.s1234@gmail.com</span></a></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 font-weight-bold text-dark">Date of Birth</div>
                            <div class="col">25-02-1998</div>
                        </div>


                        <div class="row mb-2">
                            <div class="col-4 font-weight-bold text-dark">State</div>
                            <div class="col">Delhi</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 font-weight-bold text-dark">City</div>
                            <div class="col"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 font-weight-bold text-dark">Address</div>
                            <div class="col"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">Enquired Volunteer</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Enquired Volunteer</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn" id="flip">
					<a href="javascript:void(0);">
						<!-- <span>
							<i class="fe fe-plus"></i>
						</span> View Filters -->
					</a>
					<div class="count-checkboxes-wrapper fs-6">
						<span id="count-checked-checkboxes">0</span> checked
					</div>
				</div>
			</div>

			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<form action="enquiry" method="post">
							<div class="card-header">
								<div class="col-md-3">
									<select class="form-control select2-show-search form-select" name="region_id" id="region_id">
										<option selected disabled value="">Select Region</option>
										<?php foreach ($regions as $rd) {
										?>
											<option value="<?php echo $rd['region_id']; ?>"><?php echo $rd['region_name'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-3">
									<select class="form-control select2-show-search form-select" name="state_name" id="state_name">
										<?php foreach ($states as $sd) { ?>
											<option value="<?php echo $sd['state_id']; ?>" <?php if ($sd['state_id'] == $sid) {
																								echo "selected";
																							} ?>>
												<?php echo $sd['state_name']; ?>
											</option>

										<?php } ?>
									</select>
								</div>
								<!-- <input type="hidden" class="input-sm form-control" name="start" value="<?php echo $date_from ?>" required /> -->
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
								<!-- <div class="col-md-2">
									<div class="input-group  p-0">
										<span id="email_preview" data-toggle="modal" data-target="#exampleModal3" data-whatever="item 2" class="input-group-text btn btn-warning">Email Preview</span>
									</div>
								</div> -->
							</div>
						</form>
						<form method="post" action="send_orientation_emails" id="id-form">
							<input type="hidden" value="" id="ids" name="ids">
							<div class="card-body">
								<div class="table-responsive ">
									<table id="example" class="display" cellspacing="0" width="100%">
										<thead>
											<tr class="bg-gray-light">
												<th><input class="che" id="chkParent" name="numchec[]" value="1" type="checkbox"></th>
												<th>Reg. Date</th>
												<th>Name</th>
												<th>Mobile</th>
												<th>Email</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$count = 1;
											foreach ($volunteer as $volunteerData) {
												$volunteer_id = $volunteerData['volunteer_id'];
												$volunteerEmail = $volunteerData['email'];
												$encoded_id = rtrim(strtr(base64_encode($volunteer_id), '+/', '-_'), '=');
											?>
												<tr>
													<td><input class="che" id="volunteer_id" name="numchec" value="<?php echo $volunteer_id; ?>" type="checkbox"></td>
													<td><?php echo $volunteerData['creation_date']; ?></td>
													<td>
														<a href="#" data-toggle="modal" data-target="#exampleModal1" data-whatever="item 1"><?php echo ucwords($volunteerData['first_name'] . ' ' . $volunteerData['last_name']); ?></a>
													</td>
													<td><?php echo $volunteerData['mobile']; ?></td>
													<td><?php echo $volunteerEmail; ?></td>
													<td><button type="button" onclick="getId_sendmail('<?php echo $volunteerEmail; ?>')" class="badge bg-info  me-1 mb-1 mt-1">Send Mail</button></td>


													<td style="display: none;"><span class="badge bg-info  me-1 mb-1 mt-1">Sent Mail</span></td>

												</tr>
											<?php
											} ?>
										</tbody>
									</table>
									<input type="botton" id="submit3" value="Invite For Orientation" class="mt-5 btn btn-warning  pull-right" id="map_button" style="padding: 1% 10% 1% 10%;">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
					$('select').selectpicker('refresh');
				}
			});
		});
	});
</script>
<script>
	function getId_sendmail(volunteerEmail) {
		var volunteer_sendId = volunteerEmail;
		datastr = {
			volunteer_sendId: volunteerEmail
		};

		$.ajax({
			url: '<?php echo base_url() ?>send_orientation_emails',
			type: 'post',
			data: datastr,
			success: function(response) {
				$("#state_name").html(response);
				$('select').selectpicker('refresh');
			}
		});

	}
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