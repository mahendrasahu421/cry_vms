<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Pre Registration Intern Report</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pre Registration Intern Report</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->


            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-3">
                                <input type="hidden" name="regionId" value="<?php $regionId = $this->session->userdata('region_id'); ?>">
									<?php $regionId = $this->session->userdata('region_id'); ?>
									<select class="form-control select2-show-search form-select" name="region_id" id="region_id">
										<option selected disabled value="">Select Region</option>
										<?php foreach ($regions as $rd) {
										?>
											<option value="<?php echo $rd['region_id']; ?>" <?php if ($regionId == $rd['region_id']) {
																								echo "selected";
																							} ?>><?php echo $rd['region_name'] ?></option>
										<?php } ?>
									</select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control select2-show-search form-select" name="state_name" id="state_name">
									<option value="">Select State</option>
									<?php foreach ($states as $sd) { ?>
										<option value="<?php echo $sd['state_id']; ?>" <?php if ($regi == $sd['state_id']) {
																							echo "selected";
																						} ?>>
											<?php echo $sd['state_name']; ?>
										</option>

									<?php } ?>
								</select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control select2-show-search form-select" name="task_title" id="task_title">
                                    <option value="">Select Task</option>
                                    <?php foreach ($task as $internt) { ?>
										<option value="<?php echo $internt['intern_task_id']; ?>" <?php if ($regi == $internt['intern_task_id']) {
																							echo "selected";
																						} ?>>
											<?php echo $internt['task_title']; ?>
										</option>

									<?php } ?>
                                </select>
                            </div>


                            <div class="col-md-3">
                                <div class="input-group  p-0">
                                    <span class="input-group-text btn btn-warning">GO</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr class="bg-gray-light">
                                            <th>SNo</th>
                                            <th>Name</th>
                                            <th>Date of Birth</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>State</th>
                                            <th>Joining Date</th>
                                            <th>CV</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $i=1; foreach($intern as $in){?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo $in['first_name']; ?><?php echo $in['last_name']; ?></td>
										<td><?php echo $in['date_of_birth']; ?></td>
										<td><?php echo $in['email']; ?></td>
										<td><?php echo $in['mobile']; ?></td>
										<td><?php echo $in['state_id']; ?></td>
										<td><?php echo $in['creation_date']; ?></td>
										<td><?php echo $in['cv_file']; ?></td>
										<?php if ($in['status'] == 1) { ?>
											<td><span class="badge rounded-pill bg-info me-1 mb-1 mt-1">Active</span></td>
										<?php } else { ?>
											<td><span class="badge rounded-pill bg-danger me-1 mb-1 mt-1">Inactive</span></td>
										<?php } ?>
									</tr>
									<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- ROW-1 END -->

                </div>
                <!-- CONTAINER END -->
            </div>
        </div>
        <!--app-content end-->
    </div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		let region_id = $('#region_id').val();
		if (region_id != null) {
			$('#region_id option:not(:selected)').attr('disabled', true);
		}

	});
</script>