<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Permissions Master</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Permissions Master</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn">
					<a href="<?php echo base_url(); ?>add-permission" class="btn btn-warning btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span>Add Permissions
					</a>

				</div>
			</div>
			<?php echo $this->session->userdata('permission_insert_message'); ?>
			<?php
			if ($this->session->userdata('master_permission_message')) {
			?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Permissions Data has been Updated.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php $this->session->unset_userdata('master_permission_message');
			} ?>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="">
								<div class="table-responsive ">
									<table id="example" class="display nowrap" style="width:100%">
										<thead>
											<tr class="bg-gray-light">
												<th>Sr.no</th>
												<th>Permissions Name</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>

											<?php $i = 1;
											foreach ($master_permission as $mp) {
												$permission_id = $mp['permission_id'];
												$encoded_id = rtrim(strtr(base64_encode($permission_id), '+/', '-_'), '=');
											?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $mp['permission_description']; ?></td>
													<?php if ($mp['status'] == 1) { ?>
														<td><span class="badge rounded-pill bg-warning me-1 mb-1 mt-1">Active</span></td>
													<?php } else { ?>
														<td><span class="badge rounded-pill bg-secondary me-1 mb-1 mt-1">Deactive</span></td>
													<?php } ?>
													<td><a href="<?php echo base_url() ?>edit-permission/<?php echo $encoded_id; ?>" onClick="javascript:if(confirm('Do You Want to Edit Permission ?')){return true;}else{return false}"><i class="fa fa-edit"></i></a></td>
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
</div>