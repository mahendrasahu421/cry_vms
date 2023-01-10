<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Daily Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard'; ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Daily Report</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn">
					<a href="add-daily-report" class="btn btn-warning btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span> Add Daily Report
					</a>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title text-white"> Daily Report List</h3>
						</div>
						<div class="card-header">
							<div class="col-md-2">
								<label for="validationCustom01" class="form-label">Select Task</label>
							</div>
							<div class="col-md-3">
								<select class="form-control form-select" id="task" name="task">
									<?php foreach($task as $key => $value){
										$allasid = $value['task_id'];
										$tv=$task_value;
										if($allasid==$letest_taskID){
											$tk = 'selected';
										}else{
											$tk = '';
										}
									?>
									<option value="<?php echo $value['task_id']?>" <?php echo $tk; ?>><?php echo $value['task_title']?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-3">
								<div class="input-group  p-0">
									<span class="input-group-text btn btn-warning">Search</span>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th class="w-5">SNo.</th>
											<th>Date</th>
											<th>Time In</th>
											<th>Time Out</th>
											<th>Task Activity</th>
											<th>Total Time</th>
										</tr>
									</thead>
									<tbody>
										<?php $i=1; foreach($report as $re){
											$publishdate= $re['dr_create_date'];
											$timeIn= $re['dr_time_in'];
											$time = date('g:i A', strtotime($timeIn));
											$timeOut= $re['dr_time_out'];
											$time1 = date('g:i A', strtotime($timeOut));
											 
											$diff = abs(strtotime($time) - strtotime($time1));
											$tmins = $diff/60;
											$hours = floor($tmins/60);
											$mins = $tmins%60;
										?>
										<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo date('d-m-Y',strtotime($publishdate));?></td>
										<td><?php echo $time ;?></td>
										<td><?php echo $time1 ;?></td>
										<td><?php echo $re['dr_activity'];?></td>
										<td><?php echo "<b>$hours</b> hour <b>$mins</b> min</b>" ?></td>

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