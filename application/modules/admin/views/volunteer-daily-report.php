<style>
	table td {
		white-space: initial !important;
	}

	.col-md-6 .card-header {
		padding: 6px 25px !important;
	}

	.card .card-block,
	.card .card-body {
		padding: 1px 25px !important;
	}
</style>
<section class="pcoded-main-container">
	<div class="pcoded-content">

		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Daily Report</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="admin-dashboard"><i class="fa fa-home"></i>Home</a></li>
							<li class="breadcrumb-item text-warning"><a href="#">Report</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>


		<div class="row">

			<div class="col-sm-12">

				<div class="card">
					<div class="card-header">
						<h5>Daily Report List</h5>
					</div>
					<hr>
					<form action="#" method="get">
						<div class="row ml-3">

							<div class="col-md-5">
								<div class="card-header">
									<h5>Search By Task</h5>
								</div>
								<div class="card-body">
									<select class="form-control" name="taskID" required>
										<option value="">Select Task</option>
										<?php
										foreach ($task as $key => $value) {
										?>
											<option value="<?php echo $value['taskID']; ?>" <?php if ($taskID == $value['taskID']) {
																								echo "selected";
																							} ?>><?php echo ucwords($value['taskTitle']); ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card-header">
									<h5>Search By Date</h5>
								</div>
								<div class="card-body">
									<input type="text" name="asdate" required class="form-control dob_caf" value="<?php if (isset($birthday)) {
																														echo date("d-m-Y", strtotime($birthday));
																													} ?>" />
								</div>
							</div>
							<div class="col-md-2">
								<div class="card-header">
									<br>
									<br>
									<button type="submit" class="btn btn-primary btn-sm" name="search" value="search">Search</button>
								</div>
							</div>

						</div>
					</form>
					<hr>

					<!--- Daily Report Details Model Popup----->
					<div class="modal fade daily-report" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title text-uppercase font-weight-bold">Daily Report Details</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body" id="daily-report">

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
								</div>
							</div>
						</div>
					</div>
					<!------ End Model Daily Report View popup ----->

					<?php
					if (isset($daily_report)) {
					?>
						<div class="card-body">
							<div class="dt-responsive table-responsive">
								<table id="dom-table" class="table table-striped table-bordered pre-line">
									<thead>
										<tr>
											<th>S.no</th>
											<th>Volunteer Name</th>
											<th>Mobile</th>
											<th>Email</th>
											<th>Total Time</th>
										</tr>
									</thead>
									<tbody>
										<?php $count = 1;
										foreach ($daily_report as $key => $value) {
											$encode_taskID = rtrim(strtr(base64_encode($value['taskID']), "+/", "-_"), "=");
											$encode_userID = rtrim(strtr(base64_encode($value['userID']), "+/", "-_"), "=");
											$date =  date("Y-m-d", strtotime($birthday));
										?>
											<tr>
												<td><?php echo $count++; ?></td>
												<td><?php if ($value['gender'] == 1) {
														echo "Mr.";
													} elseif ($value['gender'] == 2) {
														echo "Mrs.";
													} ?> <?php echo ucwords($value['firstName'] . ' ' . $value['lastName']); ?> <br><a href="#" data-toggle="modal" data-target=".daily-report" onclick="fetch_details('<?php echo $encode_taskID; ?>','<?php echo $encode_userID; ?>','<?php echo $value['dailyReportDate']; ?>','daily-report');"><small class="text-primary">(View details)</small></a></td>
												<td><?php echo $value['mobile']; ?></td>
												<td><?php echo $value['email']; ?></td>
												<?php
												$phours = 0;
												$pmint = 0;
												$this->load->model('Curl_model');
												$join_data = array(
													array(
														'table' => 'daily_report',
														'fields' => array('dailyReportID', 'dailyReportTimeIn', 'userID', 'taskID', 'dailyReportTimeOut', 'dailyReportDate', 'dailyReportActivity'),
														'joinWith' => array('userID'),
														'where' => array(
															'status' => 1,
															'userID' => $value['userID'],
															'taskID' => $value['taskID'],
															'dailyReportDate' => "'" . $value['dailyReportDate'] . "'"
														),
														'order_by' => array('dailyReportID', 'DESC'),
													),
												);
												$limit = '';
												$order_by = '';
												$daily_time = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
												//print_r($daily_time);
												foreach ($daily_time as $key => $value1) {
													$timeIn = $value1['dailyReportTimeIn'];
													$time = date('h:i A', strtotime($timeIn));
													$timeOut = $value1['dailyReportTimeOut'];
													$time1 = date('h:i A', strtotime($timeOut));
													$diff = abs(strtotime($time) - strtotime($time1));
													$tmins = $diff / 60;
													$hours = floor($tmins / 60);
													$mins = $tmins % 60;
													$ph += $hours;
													$pmint += $mins;
													$tmin = $pmint % 60;
													$mi = floor($pmint / 60);
													$phours += $hours + $mi;

													if ($tmin < 10) {
														$tmin = '0' . $tmin;
													}
													if ($phours < 10) {
														$phours = '0' . $phours;
													}
													//echo $phours.'.'.$tmin; 

												}
												//exit;
												$total_time = $phours . '.' . $tmin;
												?>
												<td><?php echo "$phours Hours $tmin mins"; ?> </td>

											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>




		</div>

	</div>

</section>

</div>

<script>
	function fetch_details(id, userid, date, display_id) {
		//alert(id);
		$('#' + display_id).html('<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>');
		var request = $.ajax({
			url: '<?php echo base_url("fetch-daily-report-info-volunteer"); ?>',
			method: "POST",
			data: {
				taskID: id,
				userID: userid,
				dailyReportDate: date
			},
			success: function(results) {
				//console.log(results);
				//alert(results);
				$('#' + display_id).html(results);

			}
		});
	}
</script>