<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Self Task Daily Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="javascript:void(0);">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Report
						</li>
					</ol>
				</div>
				<!-- <div class="ms-auto pageheader-btn">
					<a href="add-daily-report" class="btn btn-warning btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span>
						Add Daily Report
					</a>
				</div> -->
			</div>

			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">

						<!--<div class="card-header">
							<div class="col-md-1">
								<label for="validationCustom01" class="form-label">Select Task</label>
							</div>
							<div class="col-md-3">
								<select class="form-control select2-show-search form-select">
									<option value="AZ">Select Task</option>
									<option value="AZ">Humanitarian Aid And Disaster Risk Reduc</option>
									<option value="CO">Climate Adaptive Agriculture and Food So</option>
									<option value="ID">Livelihood and Skill Development</option>
									<option value="MT">Anti Human Trafficking & Safe Migration</option>
									<option value="NE">Health And Nutrition</option>
									<option value="NM">Peace Building</option>
								</select>
							</div>
							<div class="col-md-3">
								<div class="input-group  p-0">
									<span class="input-group-text btn btn-warning">Search</span>
								</div>
							</div>
						</div>-->
						<div class="card-body">
							<!--<div>
								<ul id="menu" class="list-inline ml-3 lp-5 font-medium font-12">
									<li><i class="fa fa-circle m-r-5 f-10 text-info"></i> New</li>
									<li><i class="fa fa-circle m-r-5 f-10 text-warning"></i> In process</li>

								</ul>
							</div>-->
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered">
									<thead>
										<tr class="bg-gray-light">
											<th>Sr.no</th>
											<th>Date</th>
											<th>Time In</th>
											<th>Time Out</th>
											<th>Task Title</th>
											<th>Task Activity</th>
											<th>Total Time</th>
											<!--<th></th>-->
										</tr>
									</thead>
								<tbody>
								<?php
								$i=1; foreach($report as $re){
									$encoded_id=rtrim(strtr(base64_encode($re['dailyReportID']), '+/', '-_'), '='); 
									$timeIn= $re['dailyReportTimeIn'];
									$time = date('h:i A', strtotime($timeIn));
									$timeOut= $re['dailyReportTimeOut'];
									$time1 = date('h:i A', strtotime($timeOut));
									
									$diff = abs(strtotime($time) - strtotime($time1));
									$tmins = $diff/60;
									$hours = floor($tmins/60);
									$mins = $tmins%60;
									//echo "<b>$hours</b> hours <b>$mins</b> minutes</b>";
								?>
								<tr>
								<td><?php echo $i;  ?> </td>
								<td><?php echo date('d-m-Y',strtotime($re['dailyReportCreationDate']));?></td>
								<td><?php echo $time ;?></td>
								<td><?php echo $time1 ;?></td>
								<td><?php echo $re['task_title'] ;?></td>
								<td><?php echo $re['dailyReportActivity'];?></td>
								<td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?></td>
								<!--<td>
									<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<div class="dropdown-menu">
									 <a href="<?php echo base_url().'daily-report-all-data/'.$encoded_id;?>" class="dropdown-item" href="#">View</a>
									</div>

								</td>-->
								</tr>
								<?php $i++; }?>

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
<script>
	function fetch_details(id, display_id) {
		//alert(id);
		$('#' + display_id).html('<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>');
		var request = $.ajax({
			url: '<?php echo base_url("fetch-user-info"); ?>',
			method: "POST",
			data: {
				userID: id
			},
			success: function(results) {
				//console.log(results);
				//alert(results);
				$('#' + display_id).html(results);
			}
		});
	}
</script>