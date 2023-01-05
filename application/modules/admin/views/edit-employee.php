<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Employee Master</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Employee Master
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Add Employee</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo base_url(); ?>update_employee" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input name="emp_id" required id="hidden" type="hidden" class="form-control" value="<?php echo $employee[0]['emp_id']; ?>">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Region Name</label>
                                        <select class="form-control select2-show-search form-select" name="region_id" id="validationCustom04" required>
                                            <option selected disabled value="">Choose Region </option>
                                            <?php foreach ($regions as $rd) { ?>
                                                <option value="<?php echo $rd['region_id']; ?>" <?php if ($employee[0]['region_id'] == $rd['region_id']) {
                                                                                                    echo  "selected";
                                                                                                } ?>><?php echo $rd['region_name']; ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Choose Region</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Role Name</label>
                                        <select class="form-control select2-show-search form-select" name="role_id" id="validationCustom04" required>
                                            <option>Select Role</option>
                                            <?php foreach ($master_role as $roleData) { ?>
                                                <option value="<?php echo $roleData['role_id']; ?>" <?php if ($employee[0]['role_id'] == $roleData['role_id']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $roleData['role_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Choose Role Name</div>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Employee Name</label>
                                        <input type="text" name="emp_name" class="form-control" id="validationCustom02" value="<?php echo $employee[0]['emp_name']; ?>" placeholder="Employee Name " required>
                                        <div class="invalid-feedback">Enter Employee Name</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Mobile Number</label>
                                        <input type="tel" class="form-control" onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)" maxlength="10" name="mobile_number" id="validationCustom02" value="<?php echo $employee[0]['emp_contact']; ?>" placeholder="Mobile Number" required>
                                        <div class="invalid-feedback">Enter 10 Digit Mobile Number</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom04" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="validationCustom02" value="<?php echo $employee[0]['emp_email']; ?>" placeholder="Email" required>
                                        <div class="invalid-feedback">Enter Your Email</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="validationCustom04" class="form-label">Gender</label>
                                        <select class="form-select select2 form-control" name="emp_gender" id="validationCustom04" required>
                                            <option selected disabled value="">Select Gender</option>
                                            <option value="1" <?php if ($employee[0]['emp_gender'] == '1') {
                                                                    echo  "selected";
                                                                } ?>>
                                                Male
                                            </option>

                                            <option value="2" <?php if ($employee[0]['emp_gender'] == '1') {
                                                                    echo  "selected";
                                                                } ?>>
                                                Female
                                            </option>

                                        </select>
                                        <div class="invalid-feedback">Select Gender</div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="validationCustom04" class="form-label">Status</label>
                                        <select class="form-select select2 form-control" name="status" id="validationCustom04" required>
                                            <option selected disabled value="">Choose</option>
                                            <option value="1" <?php if ($employee[0]['status'] == 1) {
                                                                    echo  "selected";
                                                                } ?>>
                                                Active
                                            </option>
                                            <option value="2" <?php if ($employee[0]['status'] == 2) {
                                                                    echo  "selected";
                                                                } ?>>
                                                Inactive
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Choose Status</div>

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