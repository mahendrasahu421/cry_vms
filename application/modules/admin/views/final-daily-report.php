<?php $date = date("Y/m/d"); ?>
<!--- Reject Model Popup----->
<div class="modal fade project-details" role="dialog" aria-hidden="true" style="z-index:99999;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h4 class="modal-title text-uppercase fw-bold">Daily Report Reject</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form method="post" action="disapproved-report" id="disaprovedReport">
				<div class="modal-body">
					<div class="row form-group">
						<div class="col-md-12">
							<!--<input ype="text" class="form-control" required name="dr_date" id="dr_date" value="" style="display:none;" />-->
							<input type="text" class="form-control" value="" required name="volunteer_id" id="volunteer_id" style="display:none;" />
							<input type="text" class="form-control" value="" required name="task_id" id="task_id" style="display:none;" />
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-4">

							<h4 class="">Volunteers Working Hours</h4>

						</div>

						<style>
							.input-group-text {

								padding: 0.7rem 0.75rem;

							}
						</style>

						<div class="col-md-12">

							<div class="input-group mb-3">

								<input type="number" class="form-control" required readonly id="vwh" name="vwh" placeholder="0" aria-label="Recipient's username" value="" aria-describedby="basic-addon2">

								<div class="input-group-append">

									<span class="input-group-text" id="basic-addon2">Hours</span>

								</div>

								<input type="number" class="form-control" required id="vwm" readonly name="vwm" placeholder="0" aria-label="Recipient's username" aria-describedby="basic-addon2">

								<div class="input-group-append">

									<span class="input-group-text" id="basic-addon3">Mins</span>

								</div>

							</div>

						</div>

					</div>

					<div class="row form-group">

						<div class="col-md-12">

							<h4 class="f-16 m-0 p-0 font-weight-bold">Your Working Hours</h4>

						</div>

						<div class="col-md-12">

							<div class="input-group mb-3">

								<input type="number" class="form-control" onchange="hours(this);" required id="ywh" name="ywh" placeholder="00" value="00" aria-label="Recipient's username" aria-describedby="basic-addon2">

								<div class="input-group-append">

									<span class="input-group-text" id="basic-addon2">Hours</span>

								</div>

								<input type="number" class="form-control" required onchange="mins(this);" id="ywm" name="ywm" placeholder="00" value="00" aria-label="Recipient's username" aria-describedby="basic-addon2">

								<div class="input-group-append">

									<span class="input-group-text" id="basic-addon2">Mins</span>

								</div>

							</div>

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

					<button type="submit" class="btn btn-rounded btn-primary" id="disaproved" name="disaproved" value="disaproved">Submit</button>

					<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>

				</div>

			</form>

		</div>

	</div>

</div>

<!------ End Model Reject popup ----->







<!--- Daily Report Details Model Popup----->

<div class="modal fade daily-report" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog modal-xl">

		<div class="modal-content">

			<div class="modal-header bg-warning">

				<h4 class="modal-title text-uppercase fw-bold">Daily Report Details</h4>

				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

			</div>

			<div class="modal-body" id="daily-report">



			</div>



		</div>

	</div>

</div>

<!------ End Model Daily Report View popup ----->



<div class="main-content app-content mt-0">

	<div class="side-app">

		<div class="main-container container-fluid">

			<div class="page-header">

				<div>

					<h1 class="page-title">Approve Daily Report ( Volunteer )</h1>

					<ol class="breadcrumb">

						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>

						<li class="breadcrumb-item active" aria-current="page">Approve Daily Report</li>

					</ol>

				</div>



			</div>

			<div class="row row-sm">

				<div class="col-lg-12">

					<div class="card">

						<form action="admin-final-daily-report" method="post">

							<div class="card-header">

								<div class="col-md-3">

									<select class="form-control select2-show-search form-select" name="task_id">

										<option value="">Select Task</option>

										<?php

										foreach ($task as $value) {

										?>

											<option value="<?php echo $value['task_id']; ?>" <?php echo $task_id == $value['task_id'] ? 'selected' : ''; ?>><?php echo ucwords($value['task_title']); ?></option>

										<?php

										}

										?>

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

								<span><b>TO</b> </span>

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

							<div class="table-responsive">

								<table id="example" class="display nowrap" style="width:100%">

									<thead>

										<tr class="bg-gray-light">

											<th>S.no</th>

											<th>Volunteer Name</th>

											<th>Mobile</th>

											<th>Email</th>

											<!--<th>Total Time</th>

											<th>Action</th>-->

										</tr>

									</thead>

									<tbody>

										<?php

										$count = 1;

										foreach ($volunteerdailyReport as $volunteerData) {

											$volunteer_id = $volunteerData['volunteer_id'];

											$encode_taskID = rtrim(strtr(base64_encode($volunteerData['task_id']), "+/", "-_"), "=");

											$encode_userID = rtrim(strtr(base64_encode($volunteerData['volunteer_id']), "+/", "-_"), "=");

											// $volunteerEmail = $volunteerData['email'];

											$encoded_id = rtrim(strtr(base64_encode($volunteer_id), '+/', '-_'), '=');



											$timeIn = $volunteerData['dr_time_in'];

											$time = date('h:i A', strtotime($timeIn));

											$timeOut = $volunteerData['dr_time_out'];

											$time1 = date('h:i A', strtotime($timeOut));



											$time1 = date('h:i A', strtotime($timeOut));

											$diff = abs(strtotime($time) - strtotime($time1));

											$tmins = $diff / 60;

											$hours = floor($tmins / 60);

											$mins = $tmins % 60;

											$total += $hours;

											$totalmin += $mins;

											$total_time1 = $total . '.' . $totalmin;

										?>

											<tr>

												<td>

													<?php echo $count++; ?>

												</td>

												<td>

													<?php echo ucwords($volunteerData['first_name'] . ' ' . $volunteerData['last_name']); ?>

													<br>

													<a href="#" data-toggle="modal" data-target=".daily-report" onclick="fetch_details('<?php echo $encode_taskID; ?>','<?php echo $encode_userID; ?>','daily-report');"><small class="text-primary">(View details)</small></a>

												</td>

												<td><?php echo $volunteerData['mobile']; ?> </td>

												<td><?php echo $volunteerData['email']; ?></td>

												<!-- <td><?php echo $volunteerData['state_name']; ?></td>

												<td><?php echo $volunteerData['city_name']; ?></td> 

												<td><?php echo "<b>$total</b> hours <b>$totalmin</b> mins</b>" ?></td>

												<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

													<div class="dropdown-menu">

														<a onclick="return confirm('Do you want to approved'); " href="<?php echo base_url(); ?>dailyreport-approved/<?php echo $encoded_id; ?>/<?php echo $encode_taskID; ?>/<?php echo $total_time; ?>/<?php echo $volunteerData['dr_date']; ?>" class="dropdown-item" href="#">Approve</a>

														<a href="#" data-toggle="modal" data-target=".project-details" class="dropdown-item" onclick="disapproved('<?php echo $volunteerData['volunteer_id']; ?>','<?php echo $volunteerData['task_id']; ?>','<?php echo $total_time; ?>','<?php echo $volunteerData['dr_date']; ?>');">DisApprove</a>

													</div>

												</td>-->

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

</div>
<script>
	function fetch_details(id, userid, display_id) {
		//alert(id);
		$('#' + display_id).html('<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>');
		var request = $.ajax({
			url: '<?php echo base_url("fetch-daily-report-info"); ?>',
			method: "POST",
			data: {
				task_id: id,
				volunteer_id: userid,
			},
			success: function(results) {
				$('#' + display_id).html(results);
			}
		});
	}
</script>

<script>
	function disapproved(volunteer_id, task_id, time) {

		$('#volunteer_id').val(volunteer_id);

		$('#task_id').val(task_id);

		//$('#dr_date').val(date);

		var t = time.split('.');

		$('#vwh').val(t[0]);

		$('#vwm').val(t[1]);

	}



	function mins(id) {

		var mins = $(id).val();

		if (mins < 0) {

			$(id).val('0');

		} else if (mins > 59) {

			$(id).val('59');

		} else if (mins < 10) {



			$(id).val('0' + mins);



		}

	}



	function hours(id) {

		var hours = $(id).val();

		if (hours < 0) {

			$(id).val('0');

		} else if (hours > 23) {

			$(id).val('23');

		} else if (hours < 10) {



			$(id).val('0' + hours);

		}
	}
</script>

<script>
	$("#disaproved").click(function(ev) {
		var form = $("#disaprovedReport");
		var url = '<?php echo base_url() . 'disapproved-report' ?>';
		$.ajax({
			type: "POST",
			url: url,
			data: form.serialize(),
			success: function(data) {
				$('#success_msg').html('Your Registration Complete We Will Contact Soon!');
			},
			error: function(data) {}
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
				}
			});
		});
	});
</script>

<script>
	$(document).ready(function() {
		$('#state_name').change(function() {
			var stateName = $(this).val();
			datastr = {
				stateName: stateName
			};
			$.ajax({
				url: '<?php echo base_url() ?>getStatetask',
				type: 'post',
				data: datastr,
				success: function(response) {
					$("#taskName").html(response);
				}
			});
		});
	});
</script>