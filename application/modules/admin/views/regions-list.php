<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Region List</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Region List</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn">
					<a href="addregions" class="btn btn-warning btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span> Region
					</a>

				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive export-table">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th>Sn. no</th>
											<th>Region Name</th>
											<th>States</th>
											<th>Status</th>
											<th>Action</th>

										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($region as $rd) {
											$region_id = $rd['region_id'];
											$encoded_id = rtrim(strtr(base64_encode($region_id), '+/', '-_'), '=');
											$statesID = $rd['state_id'];
											$stateCode  = $this->Admin_model->get_all_region_data($statesID);
											$result = array_column($stateCode, 'code');

										?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $rd['region_name']; ?></td>
												<td>
													<?php echo implode(',', $result); ?>
												</td>
												<?php if ($rd['region_status'] == 1) { ?>
													<td><span class="badge rounded-pill bg-warning me-1 mb-1 mt-1">Active</span></td>
												<?php } else { ?>
													<td><span class="badge rounded-pill bg-danger me-1 mb-1 mt-1">Deactive</span></td>
												<?php } ?>
												<td><a href="<?php echo base_url() ?>edit-addregions/<?php echo $encoded_id; ?>" onClick="javascript:if(confirm('Do You Want to Edit State ?')){return true;}else{return false}"><i class="fa fa-edit"></i></a></td>
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