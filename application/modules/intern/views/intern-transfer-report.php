<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Transfer Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard'; ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Transfer Report</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn">
					<a href="intern-transfer-form" class="btn btn-warning btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span> Transfer  Report
					</a>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title text-white"> Transfer Report List</h3>
						</div>
						<!-- <div class="card-header">
							<div class="col-md-2">
								<label for="validationCustom01" class="form-label">Select Task</label>
							</div>
							<div class="col-md-3">
								<select class="form-control form-select" id="task" name="task">
									
									<option value=""</option>
									
								</select>
							</div>
							<div class="col-md-3">
								<div class="input-group  p-0">
									<span class="input-group-text btn btn-warning">Search</span>
								</div>
							</div>
						</div> -->
						<div class="card-body">
							
							<div class="table-responsive">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th class="w-5">SNo.</th>
											<th>Current State</th>
											<th>Where to Relocate</th>
											<th>Relocate City</th>
											<th>Reason</th>
											<th>Status </th>
										</tr>
									</thead>
									<tbody>
                                    <?php $i=1; foreach($transfer_data as $it){
							$relocate_id =$it['relocate_id ']; 
							$encoded_id=rtrim(strtr(base64_encode($relocate_id), '+/', '-_'), '=');
							?>
										<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo $it['state_name']; ?></td>
										<td><?php echo $it['relocate_state_name']; ?></td>
										<td><?php echo $it['city_name']; ?></td>
										<td><?php echo $it['relocate_reason']; ?></td>
                                        <?php if($it['status']==1){ ?>
										 <td><span class="badge bg-success">Accept</span></td>
                                         <?php }  else if($it['status']==2){?> 
                                         <td><span class="badge bg-danger">Reject</span></td>
                                         <?php }  else{?>
                                         <td><span class="badge bg-warning">On-Process</span></td>
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