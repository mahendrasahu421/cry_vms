<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">Patners</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Patners List</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn">
					<a href="add-patners" class="btn btn-primary btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span> Add Patners
					</a>

				</div>
			</div>
			<!-- PAGE-HEADER END -->

			<!-- ROW-1 -->

			<div class="row row-sm">
				<div class="col-lg-12">
					<?php
					if ($this->session->userdata('patners_verify')) {
					?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Successfull!</strong> Patners has been verified.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php $this->session->unset_userdata('patners_verify');
					} ?>

					<?php
					if ($this->session->userdata('patners_block')) {
					?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Successfull!</strong> Partners has been blocked.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php $this->session->unset_userdata('patners_block');
					} ?>
					<?php
					if ($this->session->userdata('dioceses_add')) {
					?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Successfull!</strong> Partners has been Added.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php $this->session->unset_userdata('dioceses_add');
					} ?>
					<?php
					if ($this->session->userdata('dioceses_update')) {
					?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Successfull!</strong> Partners Details has been Update.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php $this->session->unset_userdata('dioceses_update');
					} ?>
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title text-white">Patners List</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive export-table">
								<table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
									<thead>
										<tr class="bg-gray-light">
											<th>S.no</th>
											<th>Reg. Date</th>
											<th>User ID</th>
											<th>Title</th>
											<th>Mobile</th>
											<th>Email</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										foreach ($dioceses as $key => $value) {
											$encode_diocesesID = rtrim(strtr(base64_encode($value['dioceses_id']), "+/", "-_"), "=");
										?>
											<tr>
												<td><?php echo $count++; ?></td>
												<td><?php echo date("d/m/Y", strtotime($value['creation_date'])); ?></td>
												<td><?php echo $value['user_id']; ?></td>
												<td><?php echo $value['name']; ?></td>
												<td><?php echo $value['mobile']; ?></td>
												<td><?php echo $value['email']; ?></td>
												<td>
													<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu">
														<a href="<?php echo base_url(); ?>edit-patners/<?php echo $encode_diocesesID; ?>" class="dropdown-item" href="#">Edit</a>
														<?php if ($value['status'] == 0) { ?>
															<a href="<?php echo base_url(); ?>patners-verify/<?php echo $encode_diocesesID; ?>" onclick="return confirm('Are you want to Active');" class="dropdown-item" href="#">Block</a>
														<?php } else { ?>
															<a href="<?php echo base_url(); ?>patners-block/<?php echo $encode_diocesesID; ?>" onclick="return confirm('Are you want to Block');" class="dropdown-item" href="#">Active</a>
														<?php } ?>
													</div>
												</td>
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