
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Dashboard Analytics</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard'; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard Analytics</li>
                    </ol>
                </div>
            </div>
			
			
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card bg-primary img-card box-primary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <p class="text-white mb-0">TASK </p>
                                    <h2 class="mb-0 number-font"><?php echo $totaltask; ?></h2>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-send-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card  bg-success img-card box-success-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <p class="text-white mb-0">
                                        PROFILE STATUS
                                    </p>
                                    <?php $totalfield;
                                    $profile = round($totalfield, 2); ?>
                                    <h3 class="mb-0 number-font"><?php echo $profile; ?>% Complete</h3>
                                </div>
                                <div class="ms-auto">
                                    <h2 class="text-muted m-b-0"><a href="profile"><button class="btn btn-warning pull-right up" data-toggle="tooltip" data-placement="bottom" title="Update Profile">Update</button></a></h2>
                                    </i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-sm-6">
                    <div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title col-md-5">Current Task (<?php echo $totaltask; ?>)</h3>
							
							<div class="ms-auto text-center lh-sm">
								<div class="fs-23"><i class="fa fa-info" data-bs-toggle="tooltip" title="Task Assigned By Admin"></i></div>
							</div>
						</div>
                        <div class="card-body">
                            <div class="table-responsive export-table">
                                <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                                    <tbody>
									<?php foreach ($task as $key => $value) {
										$publishdate = $value['creation_date'];
										$encoded_id = rtrim(strtr(base64_encode($value['task_id']), '+/', '-_'), '=');
									  ?>
                                        <tr>
                                            <td>
                                                <span class="txt-dark weight-700" style="text-transform: capitalize;">
                                                    <i class="fa fa-circle text-primary me-1"></i><?php echo $value['task_title']; ?> (<?php echo date("d-m-Y", strtotime($publishdate)); ?>)
                                                </span>
                                            </td>
											<?php if ($value['status'] == 0) {  ?>

											<td><a href="<?php echo base_url() . 'dashboard-task-accept/' . $encoded_id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure, you want to Accept it?')" title="Accept">Accept</a></td>

											<td><a href="<?php echo base_url() . 'dashboard-task-reject/' . $encoded_id; ?>" class="btn btn-primary" data-val="2" onclick="return confirm('Are you sure, you want to Reject it?')" title="Reject">Reject</a></td>

										  <?php } else if ($value['status'] == 1) { ?>
											<td><span class="badge bg-info  me-1 mb-1 mt-1">Accepted </span></td>

										  <?php } else if ($value['status'] == 2) { ?>

											<td><span class="badge bg-danger  me-1 mb-1 mt-1">Rejected </span></td>

										  <?php } ?>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6">
                    <div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title col-md-5">Find Task</h3>
							
							<div class="ms-auto text-center lh-sm">
								<div class="fs-23"><i class="fa fa-info" data-bs-toggle="tooltip" title="Find Task Depends of Your Choice"></i></div>
							</div>
						</div>
					
                        <div class="card-body">
                            <div class="table-responsive export-table">
                                <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                                    <tbody>
									<?php foreach ($find_task as $key => $value) {
									  $publishdate = $value['creation_date'];
									  $encoded_id11 = rtrim(strtr(base64_encode($value['task_id']), '+/', '-_'), '=');
									?>
                                        <tr>
                                            <td>
                                                <span class="txt-dark weight-700 text-wrap" style="text-transform: capitalize;">
                                                    <i class="fa fa-circle text-primary"></i>&nbsp;
                                                    <?php echo $value['task_title']; ?> (<?php echo date("d-m-Y", strtotime($publishdate)); ?>)
                                                </span>
                                            </td>
											<td>
                                                <span class="txt-dark weight-700 text-wrap">
                                                    <?php echo $value['task_type']; ?>
                                                </span>
                                            </td>
                                            <td><span class="badge bg-secondary  me-1 mb-1 mt-1" id="send_request">Request Send
                                                </span></td>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-warning ">
                            <h3 class="card-title">Daily Report List</h3>
							<div class="ms-auto text-center lh-sm">
								<a href="add-daily-report"><button class="btn btn-info" data-bs-toggle="tooltip" title="Add Daily Report" data-placement="bottom"><i class="fa fa-plus"></i></button></a>
                                <a href="daily-report"><button class="btn btn-danger mr-1" data-bs-toggle="tooltip" data-placement="bottom" title="View Daily Report"><i class="fa fa-eye"></i></button></a>
							</div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th class="bg-gray-light">S.no</th>

                                            <th class="wid-120 bg-gray-light">Date</th>

                                            <th class="bg-gray-light">Task</th>

                                            <th class="bg-gray-light">Time In</th>

                                            <th class="bg-gray-light">Time Out</th>

                                            <th class="bg-gray-light">Status</th>

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
                                        <td><?php echo $re['task_title']; ?></td>
										<td><?php echo $time; ?></td>
										<td><?php echo $time1; ?></td>
                                            <td><span class="badge bg-warning  me-1 mb-1 mt-1">Pending</span></td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {

        $('#send_request').on('click', function() {

            alert('are You Sure You Want To send Request..?')

        });

    });
</script>