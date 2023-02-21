<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Edit  Master Sub Menu
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url();?>admin-dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active text-warning" aria-current="page">
                            Edit Master  Sub Menu
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h1 class="page-title">
                                Edit Master Sub Menu
                            </h1>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate method="post" action="<?php echo base_url(); ?>update_sub_menu_master">
                                <input name="sub_menu_id" type="hidden" class="form-control" value="<?php echo $sub_menu[0]['sub_menu_id']; ?>">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom02">Menu Name</label>
                                        <select class="form-control form-select select2" id="Sctype" name="status" required>
                                            <?php foreach ($master_menu as $mm) { ?>
                                                <option value="<?php echo $mm['menu_id']; ?>" <?php if ($sub_menu[0]['status'] == $mm['menu_id']) {
                                                                                                    echo  "selected";
                                                                                                } ?>><?php echo $mm['menu_description']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom02">Sub Menu Name</label>
                                        <input type="text" name="sub_menu_description" class="form-control" id="validationCustom02" value="<?php echo $sub_menu[0]['sub_menu_description']; ?>" placeholder="Sub Menu Name" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom02">Route Name</label>
                                        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $sub_menu[0]['sub_menu_route']; ?>" name="sub_menu_route" placeholder="Route Name" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 mb-3">
                                        <label for="validationCustom04">Status</label>
                                        <select class="form-control form-select select2" name="status" required id="scoree">
                                            <option value="">Select Status</option>
                                            <option value="1" <?php if ($sub_menu[0]['status'] == 1) {
                                                                    echo  "selected";
                                                                } ?>>Active</option>
                                            <option value="2" <?php if ($sub_menu[0]['status'] == 2) {
                                                                    echo  "selected";
                                                                } ?>>Deactive</option>
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