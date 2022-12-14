<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">
						Country Master</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">Country Master
							</a></li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xl-6">
					<div class="card">
						<div class="card-header bg-warning">
							<h3 class="card-title text-white">Country State </h3>
						</div>
						<div class="card-body">
							<form action="<?php echo base_url(); ?>insert_country" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
								<div class="form-row">
									<div class="col-md-12 mb-3">
										<label for="validationCustom04" class="form-label">Country Name</label>
										<input type="text" name="Name" class="form-control" id="validationCustom02" value="" placeholder="Country Name " required>
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-md-12 mb-3">
										<label for="validationCustom04" class="form-label">Abbreviation Name</label>
										<input type="text" name="short_name" class="form-control" id="validationCustom02" value="" placeholder="Abbreviation Name" required>
										<div class="valid-feedback">Looks good!</div>
									</div>
									<div class="col-xl-12 col-lg-12 mb-3">
										<label for="validationCustom04" class="form-label">Status</label>
										<select name="status" class="form-select select2 form-control" id="validationCustom04" required>
											<option selected disabled value="">Select Status</option>
											<option value="1">Active</option>
											<option value="2">Inactive</option>
										</select>
									</div>
								</div>
								<button class="btn btn-warning mt-3" name="submit" value="submit" type="submit">Submit</button>
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