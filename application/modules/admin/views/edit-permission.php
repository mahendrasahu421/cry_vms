<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">

                        Permissions</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> Permissions
                            </a></li>

                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-6">


                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">EDIT PERMISSIONS</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>update_permission_master" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input name="permission_id" type="hidden" class="form-control" value="<?php echo $permission[0]['permission_id']; ?>" required>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom04" class="form-label">Permissions Name</label>
                                        <input type="text" name="permission_name" class="form-control" id="validationCustom02" value="<?php echo $permission[0]['permission_description']; ?>" placeholder="Menu Name " required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 mb-3">
                                        <label for="validationCustom04" class="form-label">Status</label>
                                        <select class="form-select select2 form-control" name="status" id="validationCustom04" required>
                                            <option selected disabled value="">Choose</option>
                                            <option value="1" <?php if ($permission[0]['status'] == 1) {
                                                                    echo  "selected";
                                                                } ?>>Active</option>

                                            <option value="2" <?php if ($permission[0]['status'] == 2) {
                                                                    echo  "selected";
                                                                } ?>>Deactive</option>
                                        </select>

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