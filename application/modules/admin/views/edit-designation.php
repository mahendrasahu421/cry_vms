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
			<div class="col-md-6">
				<div class="main-card mb-3 card">
					<div class="card-body"><h5 class="card-title">Edit Designation</h5>
						<form class="needs-validation" novalidate method="post"  action="<?php echo base_url();?>update_designation_master">
							<div class="position-relative form-group">
							<input name="des_id" type="hidden" id="needs-validation" required class="form-control" value="<?php echo $pravasi_designation[0]['des_id'];?>">
							<label for="name" class="">Designation Name</label>
							<input placeholder="Designation Name" id="name" required  name="designation_name" type="text" class="form-control" value="<?php echo $pravasi_designation[0]['des_name'];?>"></div>
							
							 <div class="position-relative form-group">
							<label for="status" class="">Status</label>
							<select class="form-control" required name="status" id="status">
								<option value="">Select Status</option>
								<option value="1" <?php if ($pravasi_designation[0]['status']==1){ echo  "selected";} ?>>Active</option>
								<option value="2" <?php if ($pravasi_designation[0]['status']==2){ echo  "selected";} ?>>Inactive</option>
							</select>
							</div>
							
							
							<button type="submit" class="mt-1 btn btn-primary">Update</button>
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