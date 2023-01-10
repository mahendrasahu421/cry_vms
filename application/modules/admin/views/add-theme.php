<script>
	var count_img = 1;
	var count_file = 1;
</script>
<div class="main-content app-content mt-0">
	<div class="side-app">

		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Add Task</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Task</li>
					</ol>
				</div>

			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<?php
					$taskTitle = '';
					$taskDescription = '';
					$taskBrief = '';
					$taskID = 0;
					$causesID = '';
					$sDate = '';
					$sTime = '';
					$volunteers = '';
					$expDate = '';
					$expTime = '';
					$status = '';
					if ($task_details != '') {
						echo "<h5>Edit Task</h5>";
						foreach ($task_details as $key => $value) {
							$taskTitle = $value['taskTitle'];
							$taskDescription = $value['taskDescription'];
							$taskBrief = $value['taskBrief'];
							$taskID = $value['taskID'];
							$causesID = $value['causesID'];
							$sDate = $value['sDate'];
							$sTime = $value['sTime'];
							$volunteers = $value['volunteers'];
							$expDate = $value['expDate'];
							$expTime = $value['expTime'];
							$status = $value['status'];
						}
					} else {
						//echo "<h5>Add Task</h5>";
					}
					?>
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title text-white">Add Task</h3>
						</div>
						<div class="card-body">
							<form class="needs-validation" novalidate>
								<div class="form-row">
									<div class="col-md-6 mb-3">
										<label for="validationCustom02">Theme Name</label>
										<input type="text" class="form-control" id="validationCustom02" value="Otto" required>
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-md-6 mb-3">
										<label for="validationCustom02">Theme Images</label>
										<input type="file" class="form-control" id="validationCustom02" value="Otto" required>
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-xl-6 col-lg-12 mb-3">
										<label for="validationCustom04">Status</label>
										<select class="form-select select2 form-control" id="validationCustom04" required>
											<option selected disabled value="">Choose</option>
											<option>Active</option>
											<option>Inactive</option>
										</select>
										<!-- <div class="invalid-feedback">Please select a valid state.</div> -->
									</div>
								</div>
								<button class="btn btn-primary" type="submit">Submit form</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
				Launch demo modal
			</button>

			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							...
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</div>
			</div>



			<!-- ROW CLOSED -->

			<!--app-content open-->
		</div>
	</div>
	<script>
		function all_city(stateId) {
			//alert(stateId);
			$.ajax({
				url: '<?php echo base_url(); ?>fetch-city',
				type: 'POST',
				data: {
					stateId: stateId
				},
				cache: false,
				success: function(response) {
					$('#location').html(response);
					//alert(response);
					//$('#csbbtn').click();
				},
			});
		}

		function onlyNumber(id) {
			var id_value = $('#' + id).val();
			id_value = id_value.replace(/[^0-9\.]/g, '');
			$('#' + id).val(id_value);

		}
	</script>
	<script>
		// function do_upload(id,name)
		// {
		// 	alert(id);
		// 	$.ajax({
		// 				url:'<?php echo base_url(); ?>do-upload',
		// 				type:"post",
		// 				data:new FormData('#img1'),
		// 				processData:false,
		// 				contentType:false,
		// 				cache:false,
		// 				async:false,
		// 				success: function(data){
		// 					alert("Upload Image Successful.");
		// 					console.log(data);

		// 				}
		// 			});
		// }
		// $(document).ready(function(){
		// 	$('#img22').change(function(){
		// 		alert(id);
		// 		$.ajax({
		// 				url:'<?php echo base_url(); ?>do-upload',
		// 				type:"post",
		// 				data:new FormData(this),
		// 				processData:false,
		// 				contentType:false,
		// 				cache:false,
		// 				async:false,
		// 				success: function(data){
		// 					alert("Upload Image Successful.");
		// 					console.log(data);

		// 				}
		// 			});
		// 	});
		// });
		function validate() {

			var job_start_date = $('#sdate').val();
			var job_end_date = $('#expdate').val();
			var stimeh = $('#stimeh').val();
			var stimem = $('#stimem').val();
			var exptimeh = $('#exptimeh').val();
			var exptimem = $('#exptimem').val();
			job_start_date = job_start_date.split('-');
			job_end_date = job_end_date.split('-');

			var new_start_date = new Date(job_start_date[2], job_start_date[1] - 1, job_start_date[0]);
			var new_end_date = new Date(job_end_date[2], job_end_date[1] - 1, job_end_date[0]);
			// alert(new_start_date);
			// alert(new_end_date);
			if (job_end_date != '') {
				if (new_end_date >= new_start_date) {
					$('#expdateerror').html('');
					return true;
					// var str1 = stimeh+':'+stimem+':00';
					// var str2 = exptimeh+':'+exptimem+':00';

					// str1 =  str1.split(':');
					// str2 =  str2.split(':');

					// totalSeconds1 = parseInt(str1[0] * 3600 + str1[1] * 60 + str1[0]);
					// totalSeconds2 = parseInt(str2[0] * 3600 + str2[1] * 60 + str2[0]);

					// // compare them

					// if (totalSeconds1 < totalSeconds2 ) {
					// 	$('#exptimeerror').html('');
					// 	return true;
					// }
					// else{
					// 	$('#exptimeerror').html('<span style="color:red;">Please choose valid time.</span>');
					// 	return false;
					// }
					// your code
				} else {
					$('#expdateerror').html('<span style="color:red;">Please choose valid date.</span>');
					//alert('kss');
					return false;
				}
			} else {
				return true;
			}
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