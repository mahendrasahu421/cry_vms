<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>

					<h1 class="page-title">Self Task Daily Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Report</li>
					</ol>
				</div>

				<div class="ms-auto pageheader-btn">
					<a href="add-daily-report" class="btn btn-warning btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span>Add Daily Report
					</a>
				</div>
			</div>

			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title text-white">Self Task Daily Report</h3>
						</div>
						<div class="mb-0 bg-default">
							<div class="card-header bg-danger-light">
								<h4 class="card-title col-md-3"><i class="fa fa-filter me-2"></i> Search Filters</h4>

								<div class="input-group col-md-3 p-0">
									<input type="text" class="form-control " placeholder="Search for...">
									<span class="input-group-text btn btn-warning">Go!</span>
								</div>
							</div>
						</div>
						<div class="">
							<div class="table-responsive ">
								<table class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
									<thead>
										<tr class="bg-gray-light">
											<th>Sr.no</th>
											<th>Date</th>
											<th>Time In</th>
											<th>Time Out</th>
											<th>Task Activity</th>
											<th>Total Time</th>

										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>11/5/2022</td>
											<td>11:40</td>
											<td>12:40</td>
											<td>Test Task 1</td>
											<td>1 Hour</td>


										</tr>
										<tr>
											<td>2</td>
											<td>11/5/2022</td>
											<td>Edinburgh</td>
											<td>51</td>
											<td>Active</td>
											<td>Pandding</td>


										</tr>
										<tr>
											<td>3</td>
											<td>11/5/2022</td>
											<td>Singapore</td>
											<td>29</td>
											<td>Active</td>
											<td>Pandding</td>


										</tr>
										<?php
										$count = 1;
										foreach ($volunteerDetails as $key => $value) {
											$location = '';
											if ($value['correspontenceAddress'] != '') {
												//$location.=$value['correspontenceAddress'].',';
											}
											if ($value['cityName'] != '') {
												$location .= $value['cityName'] . ',';
											}
											if ($value['stateName'] != '') {
												$location .= $value['stateName'];
											}
											//$location = $value['correspontenceAddress'].', '.$value['cityName'].', '.$value['stateName'];
											$encode_userID = rtrim(strtr(base64_encode($value['userID']), "+/", "-_"), "=");
										?>
											<tr <?php if ($value['verify'] == 1) {
													echo 'class="bg-info td-white"';
												} ?>>
												<td><?php echo $count++; ?></td>
												<td><?php echo $value['volunteerID']; ?></td>
												<td><?php echo ucwords($value['firstName'] . ' ' . $value['lastName']); ?> <br><a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encode_userID; ?>','profile_details');"><small class="text-primary">(View Profile)</small></a></td>
												<td><?php echo $value['mobile']; ?></td>
												<td><?php echo $value['email']; ?></td>
												<td><?php echo date("d/m/Y", strtotime($value['usersCreationDate'])); ?></td>
												<td><?php echo $location; ?></td>
												<?php
												if ($value['verify'] == 0) {
												?>
													<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
														<div class="dropdown-menu">
															<a class="dropdown-item" onclick="return confirm('Are you want to verify');" href="<?php echo base_url(); ?>volenteership-verify/<?php echo $encode_userID; ?>">Verify</a>
															<a href="<?php echo base_url(); ?>volenteership-block/<?php echo $encode_userID; ?>" onclick="return confirm('Are you want to block');" class="dropdown-item">Block</a>
														</div>
													</td>
												<?php } else { ?>
													<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
														<div class="dropdown-menu">
															<a href="volenteership-block/<?php echo $encode_userID; ?>" class="dropdown-item">Block</a>
														</div>
													</td>
												<?php } ?>
											</tr>
										<?php
										}
										?>

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