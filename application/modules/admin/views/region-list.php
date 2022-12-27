
<div class="main-content app-content mt-0">
	<div class="side-app">

		<!-- CONTAINER -->
		<div class="main-container container-fluid">

			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">Regions</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Regions</li>
					</ol>
				</div>

			</div>
			<!-- PAGE-HEADER END -->

			<!-- ROW-1 -->

			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title text-white">Region List</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive export-table">
								<table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
									<thead>
										<tr class="bg-gray-light">
											<th class="border-bottom-0">Sn. no</th>
											<th class="border-bottom-0">Name</th>
											<th class="border-bottom-0">Status</th>
										</tr>
									</thead>
									<tbody>
										
										<?php
										$count = 1;
										foreach ($region as $key => $value) {
											$encode_regionID = rtrim(strtr(base64_encode($value['region_id']), "+/", "-_"), "=");
										?>
											<tr>
												<td><?php echo $count++; ?></td>
												<td><?php echo $value['region_name']; ?></td>
												<td><?php if ($value['region_status'] == 1) { ?>
														<span class="badge badge-pill badge-success">Active</span>
													<?php } ?>
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