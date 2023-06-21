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
				<!-- <div class="ms-auto pageheader-btn" id="flip">
					<a href="javascript:void(0);" class="btn btn-warning btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span> View Filters
					</a>
					<div class="count-checkboxes-wrapper fs-6">
						<span id="count-checked-checkboxes">0</span> checked
					</div>
				</div> -->
			</div>
			<?php echo $this->session->flashdata('master_insert_message'); ?>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12">
					<div class="card" id="panel">
						<div class="card-body">
							<form class="needs-validation" novalidate method="POST" id="form" action="">
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
											<option>Select Task</option>

										</select>
										<div class="invalid-feedback">Please Select Task</div>
									</div>
									<div class="col-md-2 mt-3">
										<label for="validationCustom03" class="form-label">State</label>
									</div>
									<div class="form-group col-md-4 mt-3">
										<select class="form-control select2-show-search form-select" data-placeholder="Select State" id="stateName" name="stateName" required>
											<option label="Select State"></option>
											<option value="All">All</option>

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
			url: '<?php echo base_url("fetch-user-info-intern"); ?>',
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
				url: '<?php echo base_url(); ?>interngetonline_offlineTask',
				type: 'post',
				data: datastr,
				success: function(response) {
					$("#taskName").html(response);
				}
			});
		});
		$('#taskName').change(function() {
			var taskName = $(this).val();
			datastr = {
				taskName: taskName
			};
			//alert(datastr)
			$.ajax({
				url: '<?php echo base_url(); ?>interngetTaskstate',
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
			datastr = {
				stateName: stateName,
				taskType: taskType,
				taskName: taskName,
			};

			$.ajax({
				url: '<?php echo base_url(); ?>all-intern',
				type: 'post',
				data: datastr,
				success: function(results) {
					console.log(results);
					//alert(results);
					$('#tbl_div').html(results);
				}
			});
		});
		// $('#cityName').change(function() {
		// 	var cityName = $(this).val();
		// 	//alert(cityName)
		// 	datastr = {
		// 		cityName: cityName
		// 	};

		// 	$.ajax({
		// 		url: '<?php echo base_url(); ?>all-valunteers',
		// 		type: 'post',
		// 		data: datastr,
		// 		success: function(results) {
		// 		console.log(results);
		// 		//alert(results);
		// 		$('#' + display_id).html(results);

		// 	}
		// 	});
		// });
	});
</script>

<!-- <script>
    $(document).ready(function() {
      $("#state").change(function() {
        var state_id = $(this).val();
        // alert(state_id);
        datastr = {
          state_id: state_id
        };

        $.ajax({
          url: '<?php echo base_url() ?>get-city',
          type: 'post',
          data: datastr,
          success: function(response) {
            $("#city_name").html(response);
            $('select').selectpicker('refresh');
          }
        });
      });

    });
  </script> -->

<!-- <script>
	function fetch_state_city(stateID, display_id, state_city) {
		var taskName = $('#taskName').val();
		alert(taskID);
		if (state_city == 'city') {
			var url = '<?php echo base_url("all-cities"); ?>';
		} else if (state_city == 'state') {
			var url = '<?php echo base_url("all-city"); ?>';
		} else {
			var url = '<?php echo base_url("all-valunteers"); ?>';
		}
		var request = $.ajax({
			url: url,
			method: "POST",
			data: {
				stateId: stateID,
				state_city: state_city,
				taskID: taskID
			},

			success: function(results) {
				console.log(results);
				//alert(results);
				$('#' + display_id).html(results);

			}

		});
	}
</script> -->
<!-- <script>
	let example = $('#example').DataTable({
		columnDefs: [{
			orderable: false,
			className: 'select-checkbox',
			targets: 0
		}],
		select: {
			style: 'os',
			selector: 'td:first-child'
		},
		order: [
			[1, 'asc']
		]
	});
	example.on("click", "th.select-checkbox", function() {
		if ($("th.select-checkbox").hasClass("selected")) {
			example.rows().deselect();
			$("th.select-checkbox").removeClass("selected");
		} else {
			example.rows().select();
			$("th.select-checkbox").addClass("selected");
		}
	}).on("select deselect", function() {
		("Some selection or deselection going on")
		if (example.rows({
				selected: true
			}).count() !== example.rows().count()) {
			$("th.select-checkbox").removeClass("selected");
		} else {
			$("th.select-checkbox").addClass("selected");
		}
	});
</script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<!-- <script>
	$(document).ready(function() {
		$("#flip").hide();
		$("#submit2").hide();
		$("#submit").click(function() {
			$("#panel").hide("slow");
			$("#flip").show("slow");
			$('.invisible').removeClass('invisible');
			$(this).addClass('visible');
		});
		$("#flip").click(function() {
			$("#panel").slideToggle("slow");
			$("#submit2").show();
			$("#flip").hide("slow");
		});
		$("#submit2").click(function() {
			$("#panel").slideUp("slow");
			$("#flip").show("slow");
		});
	});
</script> -->
<!-- <script>
	$(document).on('click', '#submit3', function() {
		var matches = [];
		var table = $('#file-datatable').dataTable();
		var checkedcollection = table.$(".che:checked", {
			"page": "all"
		});
		checkedcollection.each(function(index, elem) {
			matches.push($(elem).val());
		});
		var AccountsJsonString = JSON.stringify(matches);
		console.log(AccountsJsonString);
		alert(AccountsJsonString);
		$('#ids').val(AccountsJsonString);
		$('#id-form').submit();
	});
</script> -->
<!-- <script>
	$(document).ready(function() {
		var $checkboxes = $('#id-form td input[type="checkbox"]');
		$checkboxes.change(function() {
			var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
			$('#count-checked-checkboxes').text(countCheckedCheckboxes);
			$('#edit-count-checked-checkboxes').val(countCheckedCheckboxes);
		});
	});
</script> -->