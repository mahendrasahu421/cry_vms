<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Edit Menu</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> Edit Menu
                            </a></li>

                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-6">


                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Edit Menu</h3>
                        </div>
                        <div class="card-body">update_menu_master
                            <form action="<?php echo base_url(); ?>update_menu_master" method="POST" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input name="menu_id" type="hidden" class="form-control" value="<?php echo $menu[0]['menu_id']; ?>" required>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom04" class="form-label">Menu Name</label>
                                        <input name="menu_description" type="text" class="form-control" id="validationCustom02" value="<?php echo $menu[0]['menu_description']; ?>" placeholder="Menu Name " required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom04" class="form-label">Route Name</label>
                                        <input type="text" name="menu_route_name" class="form-control" id="validationCustom02" value="<?php echo $menu[0]['menu_route_name']; ?>" placeholder="Route Name" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 mb-3">
                                        <label for="validationCustom04" class="form-label">Status</label>
                                        <select name="status" class="form-select select2 form-control" id="validationCustom04" required>
                                            <option selected disabled value="">Choose</option>
                                            <option value="1" <?php if ($menu[0]['status'] == 1) {
                                                                    echo  "selected";
                                                                } ?>>Active</option>

                                            <option value="2" <?php if ($menu[0]['status'] == 2) {
                                                                    echo  "selected";
                                                                } ?>>Inactive</option>
                                        </select>

                                    </div>
                                </div>
                                <button class="btn btn-warning mt-3" type="submit">Update</button>
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