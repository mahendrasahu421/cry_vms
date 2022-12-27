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
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Request For Task ( intern )</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Request For Task</li>
					</ol>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<form action="#" method="post">
							<div class="card-header">
								<div class="col-md-3">
									<select class="form-control select2-show-search form-select" name="task_id">
										<option value="">Select Task</option>
										<?php
										foreach ($interntask as $value) {
										?>
											<option value="<?php echo $value['intern_task_id']; ?>" <?php echo $taskId == $value['intern_task_id'] ? 'selected' : ''; ?>><?php echo ucwords($value['task_title']); ?></option>
										<?php
										}
										?>

									</select>
								</div>

								<div class="col-md-3">
									<div class="input-group  p-0">
										<button class="btn btn-primary" type="submit">Search </button>
									</div>
								</div>
							</div>

						</form>
						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th>S.No.</th>
											<th>Requested Date</th>
											<th>Name</th>
											<th>Task</th>
											<th>Description</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($requetedtask as $value) {
											$requiestDate = $value['sendRequiestCreatingDate'];
											$encode_userID = rtrim(strtr(base64_encode($value['intern_id']), "+/", "-_"), "=");
											$encode_taskID = rtrim(strtr(base64_encode($value['intern_task_id']), "+/", "-_"), "=");
										?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo date("d-m-Y", strtotime($requiestDate)); ?></td>
												<td><?php echo ucwords($value['first_name'] . ' ' . $value['last_name']); ?> <br><a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encode_userID; ?>','profile_details');">
														<small class="text-primary">(View Profile)</small></a></td>
												<td><?php echo $value['task_title']; ?></td>
												<td><?php echo $value['task_brief']; ?></td>
												<?php if ($value['rstatus'] == 0) {	?>
													<td>
														<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="<?php echo base_url(); ?>intern-task-accept/<?php echo $encode_userID; ?>/<?php echo $encode_taskID; ?>">Accept</a>
															<a href="<?php echo base_url(); ?>intern-task-reject/<?php echo $encode_userID; ?>/<?php echo $encode_taskID; ?>" class="dropdown-item">Reject</a>
														</div>
													</td>
												<?php } else if ($value['rstatus'] == 1) { ?>
													<td>

														<span class="badge bg-info  me-1 mb-1 mt-1">Accepted</span>

													</td>
												<?php } else if ($value['rstatus'] == 2) { ?>
													<td>
														<span class="badge bg-danger  me-1 mb-1 mt-1">Task Rejected</span>
													</td>
												<?php } ?>
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