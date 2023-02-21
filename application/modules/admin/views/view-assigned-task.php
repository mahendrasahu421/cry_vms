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
					<h1 class="page-title">Assigned Task List</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Assigned Task List</li>
					</ol>
				</div>
			</div>
<?php
if($this->session->userdata('task_reminder'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull! </strong><?php echo $this->session->userdata('task_reminder'); ?> Reminder send.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('task_reminder'); } ?>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<form action="#" method="POST">

							<div class="card-header">
								<div class="col-md-6">
									<select class="form-control select2-show-search form-select" name="task_id">
										<?php
										foreach ($task as $t) {
										?>
											<option value="<?php echo $t['task_id']; ?>"><?php echo $t['task_title']; ?></option>
										<?php
										}
										?>

									</select>
								</div>
								<div class="col-md-2">
									<div class="input-group  p-0">
										<button type="submit" class="btn btn-warning btn-sm">Search</button>
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
												<th>Name</th>
												<th>Mobile</th>
												<th>Email</th>
												<th>Assign Date</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											foreach ($assignTaskdata as $key => $value) {
												$encode_assigningTaskID = rtrim(strtr(base64_encode($value['assigned_task_id']), "+/", "-_"), "=");
												$encode_userID = rtrim(strtr(base64_encode($value['volunteer_id']), "+/", "-_"), "=");
												$encode_taskID = rtrim(strtr(base64_encode($value['task_id']), "+/", "-_"), "=");
											?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo ucwords($value['first_name'] . ' ' . $value['last_name']); ?> <br><a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encode_userID; ?>','profile_details');">
															<small class="text-primary">(View Profile)</small></a></td>
													<td><?php echo $value['mobile']; ?></td>
													<td><?php echo $value['email']; ?></td>
													<td><?php echo date("d-m-Y", strtotime($value['assigned_date'])); ?></td>
													<?php
													if ($value['accepted_date'] != '0000-00-00') {
														echo '<td><span class="badge bg-success  me-1 mb-1 mt-1">Accept</span></td>';
													} else if ($value['rejected_date'] != '0000-00-00') {
														if ($value['resionID'] != 0) {
															$resion = "'" . ucwords($value['resionName']) . "'";
														} else {
															$resion = "'" . ucwords($value['other_reason']) . "'";
														}
														echo '<td><span class="badge bg-danger  me-1 mb-1 mt-1">Reject</span>
		<br><a href="#" data-toggle="modal" data-target=".reject-reason-details"><small class="text-primary" onclick="reject_resion(' . $resion . ')">(View Reason)</small></a>
		</td>';
													} else {
														if ($value['reminder'] <= 2) {
															$count = $value['reminder'];
															echo '<td><span class="badge bg-info  me-1 mb-1 mt-1">Pending</span>
		<br><a href="'.base_url('send-reminder-for-assigned-task/').$encode_userID.'/'.$encode_taskID.'/'.$encode_assigningTaskID.'"><small class="text-primary">(Send Reminder) </small></a>(' . $count . '/3)</td>';
														} else {
															$txt = "'Do you want to cancel it.'";
															echo '<td><a onclick="return confirm(' . $txt . ');" href="' . base_url('cancel-assined-task/') . $encode_assigningTaskID . '"><span class="badge bg-danger ">Cancel</span></a></td>';
														}
													}
													?>

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
	//	alert(id);
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