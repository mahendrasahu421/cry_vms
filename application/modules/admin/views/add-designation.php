<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                    Designation</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Designation
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Add Designation</h3>
                        </div>
                        <div class="card-body"><h5 class="card-title">Add Designation</h5>
						<form class="needs-validation" novalidate="" method="post" action="<?php echo base_url()?>insert_designation_master">
							<div class="position-relative form-group">
							<label for="name" class="">Designation Name</label>
							<input placeholder="Designation Name" id="name" required="" name="designation_name" type="text" class="form-control"></div>
							
							 <div class="position-relative form-group">
							<label for="status" class="">Status</label>
							<select class="form-control" name="status" id="status" required="">
								<option value="">Select Status</option>
								<option value="1">Active</option>
								<option value="2">Inactive</option>
							</select>
							</div>
							
							
							<button type="submit" class="mt-1 btn btn-warning">Submit</button>
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