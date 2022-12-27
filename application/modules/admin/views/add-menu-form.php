<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">
						Master Menu</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);"> Master Menu
							</a>
						</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xl-6">


					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title text-white">Master Menu</h3>
						</div>
						<div class="card-body">
							<form action="<?php echo base_url(); ?>insert_menu_master" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
								<div class="form-row">
									<div class="col-md-12 mb-3">
										<label for="validationCustom04" class="form-label">Menu Name</label>
										<input type="text" name="menu_description" class="form-control" id="validationCustom04" value="" placeholder="Menu Name " required>
										<div class="invalid-feedback"></div>
									</div>
									<div class="col-md-12 mb-3">
										<label for="validationCustom02" class="form-label">Route Name</label>
										<input type="text" name="menu_route_name" class="form-control" id="validationCustom04" value="" placeholder="Route Name" required>
										<div class="invalid-feedback"></div>
									</div>
									<div class="form-group col-md-12 mb-3">
										<label for="validationCustom04" class="form-label">Status</label>
										<select name="status" class="form-control select2 form-select" id="validationCustom04" data-placeholder="Select Status" required>
											<option label="Choose one">
											</option>
											<option value="1">Active</option>
											<option value="2">Inactive</option>
										</select>
										<div class="invalid-feedback">

										</div>
									</div>
								</div>
								<button href="view-menu" class="btn btn-warning mt-3" type="submit">Submit</button>
							</form>
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