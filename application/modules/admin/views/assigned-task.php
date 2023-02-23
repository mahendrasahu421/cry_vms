<style>
	.card {
		position: relative;
		margin-bottom: 1.5rem;
		width: 100%;
	}
</style>

<div class="modal fade project-details" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-uppercase font-weight-bold">Project Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="project-details">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
			</div>
		</div>
	</div>
</div>
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

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel" style="font-size: 24px;">Project Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body row" id="profile_details">

				<div class="col-md-3">
					<div>
						<dt>Task Tittle</dt>
					</div>
					<div class="mt-5">
						<dt>Working Hours</dt>
					</div>
					<div class="mt-5">
						<dt>Start Working Date
						</dt>
					</div>

				</div>
				<div class="col-md-9">
					<div class="col">Risk Communication And Community Engagement (RCCE)</div>
					<div class="col">705 Hours 10 Mins</div>
					<div class="col mt-5">17/12/2021</div>
				</div>

			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-success" data-dismiss="modal">
					Approved
				</button> -->
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
					<h1 class="page-title">Assign Task</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Assign Task</li>
					</ol>
				</div>
				
			</div>
			<?php echo $this->session->flashdata('master_insert_message'); ?>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12">
					<div class="card" id="panel">
						<div class="card-body">
							<form class="needs-validation" novalidate method="POST" id="form" action="assigned-task">
								<div class="form-row">
									<div class="col-md-2">
										<label for="validationCustom01" class="form-label">Select Task Type</label>
									</div>
									<div class="col-md-4">
										<select class="form-control select2-show-search form-select" name="taskType" id="taskType" required>
											<option selected disabled value="">Select Task Type</option>
											<?php foreach ($taskType as $tt) {
											?>
												<option value="<?php echo $tt['task_type_id']; ?>"><?php echo $tt['task_type'] ?></option>
											<?php } ?>
										</select>
										<div class="invalid-feedback">Please Select Task Type</div>
									</div>
									<div class="col-md-2">
										<label for="validationCustom02" class="form-label">Select Task</label>
									</div>
									<div class="col-md-4">
										<select class="form-control select2-show-search form-select" name="taskName" id="taskName" required>
											<option value="">Select Task</option>

										</select>
										<div class="invalid-feedback">Please Select Task</div>
									</div>
									<div class="col-md-2 mt-3">
										<label for="validationCustom03" class="form-label">State</label>
									</div>
									<div class="form-group col-md-4 mt-3">
										<select class="form-control select2-show-search form-select" data-placeholder="Select State" id="stateName" name="stateName" required>
											<option label="Select State"></option>

										</select>
										<div class="invalid-feedback">Please Select State</div>
									</div>
									<div class="col-md-2 mt-3">
										<label for="validationCustom04" class="form-label">Assigned Date</label>
									</div>
									<div class="col-md-4 mt-3">
										<input type="date" class="form-control" name="assignDate" required value="" required>
										<div class="invalid-feedback">Please Select Date</div>
									</div>

								</div>
								<div class="col-md-12">
									<div id="tbl_div">

									</div>


									<button type="submit" name="assignTask" value="submit" id="submit" class="btn btn-primary pull-right mb-5">Assign Task</button>

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
	function fetch_task_details(id, display_id) {
		//alert(id);
		$('#' + display_id).html('<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>');
		var request = $.ajax({
			url: '<?php echo base_url("fetch-task-info"); ?>',
			method: "POST",
			data: {
				userID: id
			},
			success: function(results) {
				$('#' + display_id).html(results);

			}
		});
	}
</script>
<script>
	$(document).ready(function() {
		$('#taskType').change(function() {
			var taskType = $(this).val();
			datastr = {
				taskType: taskType
			};
			$.ajax({
				url: '<?php echo base_url(); ?>getonline_offlineTask',
				type: 'post',
				data: datastr,
				success: function(response) {
					//alert(response);
					$("#taskName").html(response);
				}
			});
		});
		$('#taskName').change(function() {
			var taskName = $(this).val();
			//alert(taskName);
			datastr = {
				taskName: taskName
			};
			//alert(datastr)
			$.ajax({
				url: '<?php echo base_url(); ?>getTaskstate',
				type: 'post',
				data: datastr,
				success: function(response) {
					$('#stateName').html(response);
				}
			});
		});
		$('#stateName').change(function() {
			var stateName = $(this).val();
			var taskType = $('#taskType').val();
			var taskName = $('#taskName').val();
			//alert(taskName)
			datastr = {
				stateName: stateName,
				taskType: taskType,
				taskName: taskName
			};

			$.ajax({
				url: '<?php echo base_url(); ?>all-valunteers',
				type: 'post',
				data: datastr,
				success: function(results) {
					console.log(results);
					//alert(results);
					$('#tbl_div').html(results);
				}
			});
		});
		
	});
</script>


