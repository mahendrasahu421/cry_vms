<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">Self Daily Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Self Daily Report</li>
					</ol>
				</div>
			</div>
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
			<div class="modal fade project-details" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title text-uppercase font-weight-bold">Daily Report Reject</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<form method="post" action="#">
							<div class="modal-body">
								<div class="row form-group m-b-20">
									<div class="col-md-12">
										<input type="text" class="form-control" required name="dailyReportDate" id="dailyReportDate" value="" style="display:none;" />
										<input type="text" class="form-control" value="" required name="volunteer_id" id="userid" style="display:none;" />
										<input type="text" class="form-control" value="" required name="taskid" id="taskid" style="display:none;" />
									</div>
								</div>
								<div class="row form-group m-b-20">
									<div class="col-md-3">
										<h4 class="f-16 m-0 p-0 font-weight-bold">Volunteers Working Hours</h4>
									</div>
									<div class="col-md-8">
										<div class="input-group mb-3">
											<input type="number" class="form-control" required readonly id="vwh" name="vwh" placeholder="0" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
								<div class="row form-group m-b-20">
									<div class="col-md-3">
										<h4 class="f-16 m-0 p-0 font-weight-bold">Your Working Hours</h4>
									</div>
									<div class="col-md-8">
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
								<div class="row form-group m-b-20">
									<div class="col-md-3">
										<h4 class="f-16  m-0 p-0 font-weight-bold">Reason</h4>
									</div>
									<div class="col-md-8">
										<textarea class="form-control" cols="30" rows="5" name="reasonID" id="reasonID" required placeholder="Give some reason"></textarea>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-rounded btn-primary" name="disaproved" value="disaproved">Submit</button>
								<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="mb-0">
							<div class="card-header bg-danger-light">
								<h4 class="card-title col-md-9"><i class="fa fa-filter me-2"></i> Search Filters</h4>
								<form action="#" method="get">
									<div class="input-group col-md-12 p-0">
										<input type="text" name="asdate" required class="form-control" value="<?php if (isset($birthday)) {
																													echo date("d-m-Y", strtotime($birthday));
																												} ?>" />

										<button type="submit" class="input-group-text btn btn-warning btn-sm" name="search" value="search">GO</button>
									</div>
								</form>
							</div>
						</div>
						<div class="table-responsive">
							<table id="example" class="display nowrap" style="width:100%">
								<thead>
									<tr class="bg-gray-light">
										<th>S.no</th>
										<th>Volunteer Name</th>
										<th>Mobile</th>
										<th>Email</th>
										<th>Total Time</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php $count = 1;
									foreach ($daily_report as $key => $value) {
										$encode_taskID = rtrim(strtr(base64_encode($value['vself_task_id']), "+/", "-_"), "=");
										$encode_userID = rtrim(strtr(base64_encode($value['volunteer_id']), "+/", "-_"), "=");
										$date =  date("Y-m-d", strtotime($birthday));
									?>
										<tr>
											<td><?php echo $count++; ?></td>
											<td><?php echo ucwords($value['first_name'] . ' ' . $value['last_name']); ?> <br><a href="#" data-toggle="modal" data-target=".daily-report" onclick="fetch_details('<?php echo $encode_taskID; ?>','<?php echo $encode_userID; ?>','<?php echo $value['dailyReportDate']; ?>','daily-report');"><small class="text-primary">(View details)</small></a></td>
											<td><?php echo $value['mobile']; ?></td>
											<td><?php echo $value['email']; ?></td>
											<?php
											$phours = 0;
											$pmint = 0;
											$this->load->model('Curl_model');
											$join_data = array(
												array(
													'table' => 'self_task_daily_report',
													'fields' => array('vself_task_id', 'dailyReportTimeIn', 'volunteer_id', 'task_title', 'dailyReportTimeOut', 'dailyReportDate', 'dailyReportActivity'),
													'joinWith' => array('volunteer_id'),
													'where' => array(
														'status' => 1,
														'volunteer_id' => $value['userID'],
														'dailyReportDate' => "'" . $value['dailyReportDate'] . "'"
													),
													'order_by' => array('vself_task_id', 'DESC'),
												),
											);
											$limit = '';
											$order_by = '';
											$daily_time = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
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
											}
											$total_time = $phours . '.' . $tmin;
											?>
											<td><?php echo "$phours Hours $tmin mins"; ?> </td>
											<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu">
													<a onclick="return confirm('Do you want to approved'); " href="<?php echo base_url(); ?>dailyreport-self-approved/<?php echo $encode_userID; ?>/<?php echo $encode_taskID; ?>/<?php echo $total_time; ?>/<?php echo $value['dailyReportDate']; ?>" class="dropdown-item" href="#">Approve</a>

													<a onclick="return confirm('Do you want to Disapproved'); " href="<?php echo base_url(); ?>dailyreport-self-disapproved/<?php echo $encode_userID; ?>/<?php echo $encode_taskID; ?>/<?php echo $total_time; ?>/<?php echo $value['dailyReportDate']; ?>" class="dropdown-item">DisApprove</a>
												</div>
											</td>
										</tr>
									<?php } ?>
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










<script>
	function fetch_details(id, userid, date, display_id)

	{

		//alert(userid);

		$('#' + display_id).html('<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>');

		var request = $.ajax({

			url: '<?php echo base_url("fetch-self-daily-report-info"); ?>',

			method: "POST",

			data: {
				vself_task_id: id,
				volunteer_id: userid,
				dailyReportDate: date
			},

			success: function(results)

			{

				//console.log(results);

				//alert(results);

				$('#' + display_id).html(results);



			}

		});

	}
</script>



<script>
	function disapproved(userID, taskid, time, date)

	{

		$('#volunteer_id').val(userID);

		$('#taskid').val(taskid);

		$('#dailyReportDate').val(date);

		var t = time.split('.');

		$('#vwh').val(t[0]);

		$('#vwm').val(t[1]);

	}

	function mins(id)

	{

		var mins = $(id).val();

		if (mins < 0)

		{

			$(id).val('0');

		} else if (mins > 59)

		{

			$(id).val('59');

		} else if (mins < 10) {



			$(id).val('0' + mins);



		}

	}

	function hours(id)

	{

		var hours = $(id).val();

		if (hours < 0)

		{

			$(id).val('0');

		} else if (hours > 23)

		{

			$(id).val('23');

		} else if (hours < 10) {



			$(id).val('0' + hours);



		}

	}
</script>