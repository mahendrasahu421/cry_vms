<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">
						Master Sub Menu</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">
						Master Sub Menu</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xl-6">
					<div class="card">
						<div class="card-header bg-warning">
							MASTER SUB MENU</h3>
						</div>
						<div class="card-body">
							<form class="needs-validation" method="post" action="<?php echo base_url(); ?>insert_sub_menu_master" novalidate>
								<div class="form-row">
									<div class="col-md-12 mb-3">
										<label for="validationCustom02">Menu Name</label>
										<!-- <select class="form-control select2-show-search form-select" name="user"  name="status"> -->
										<select class="form-control select2-show-search form-select" name="user"  required>
											<option value="" selected>Select Menu</option>
											<?php foreach ($master_menu as $mm) { ?>
												<option value="<?php echo $mm['menu_id']; ?>"><?php echo $mm['menu_description']; ?></option>
											<?php } ?>
										</select>
										<div class="invalid-feedback">Select Menu</div>
									</div>
									<div class="col-md-12 mb-3">
										<label for="validationCustom02">Sub Menu Name</label>
										<input type="text" name="sub_menu_description" class="form-control" id="validationCustom02" value="" placeholder="Sub Menu Name" required>
										<div class="invalid-feedback">Select Sub Menu Name</div>
									</div>
									<div class="col-md-12 mb-3">
										<label for="validationCustom02">Route Name</label>
										<input type="text" name="sub_menu_route" class="form-control" id="validationCustom02" value="" placeholder="Route Name" required>
										<div class="invalid-feedback">Select Route Name</div>
									</div>
									<div class="col-xl-12 col-lg-12 mb-3">
										<label for="validationCustom04">Status</label>
										<select name="status" class="form-select select2 form-control" id="validationCustom04" required>
											<option selected disabled value="">Select Status</option>
											<option value="1">Active</option>
											<option value="2">Inactive</option>
										</select>
										<div class="invalid-feedback">Select Status</div>

									</div>
								</div>
								<button class="btn btn-warning mt-3" type="submit">Submit</button>
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