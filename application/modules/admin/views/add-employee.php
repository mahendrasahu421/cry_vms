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
                            <form action="<?php echo base_url(); ?>insert_employee" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="role_name" class="form-label">Role Name</label>
                                        <select class="form-control select2-show-search form-select" name="role_id" id="role_name" required>
                                            <option selected disabled value="">Select Role</option>
                                            <?php foreach ($master_role as $rolesData) { ?>
                                                <option value="<?php echo $rolesData['role_id']; ?>"><?php echo $rolesData['role_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback"></div>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="region_id" class="form-label">Region Name</label>
                                        <select class="form-control select2-show-search form-select" name="region_id" id="region_id" required>
                                            <option selected disabled value="">Select Region</option>
                                            <?php foreach ($regions as $rd) {
                                            ?>
                                                <option value="<?php echo $rd['region_id']; ?>"><?php echo $rd['region_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="state_name" class="form-label">State Name</label>
                                        <select class="form-control select2-show-search form-select" name="state_name[]" id="state_name" required multiple>
                                            <?php foreach ($states as $sd) { ?>
                                                <option value="<?php echo $sd['state_id']; ?>" <?php if ($sd['state_id'] == $sid) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                                    <?php echo $sd['state_name']; ?>
                                                </option>

                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="emp_name" class="form-label">Employee Name</label>
                                        <input type="text" name="emp_name" class="form-control" id="emp_name" value="" placeholder="Employee Name " required>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="mobile_number" class="form-label">Mobile Number</label>
                                        <input type="tel" class="form-control" name="mobile_number" id="mobile_number" value="" placeholder="Mobile Number" onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)" maxlength="10" required>
                                        <div class="valid-feedback"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select select2 form-control" name="gender" id="gender" required>
                                            <option selected disabled value="">Select Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" value="" placeholder="Email" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" value="" placeholder="Email" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select select2 form-control" name="status" id="status" required>
                                            <option selected disabled value="">Select</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback"></div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#region_id").change(function() {
            var region_id = $(this).val();
            //alert(region_id);
            datastr = {
                region_id: region_id
            };

            $.ajax({
                url: '<?php echo base_url() ?>get-states-admin',
                type: 'post',
                data: datastr,
                success: function(response) {
                    $("#state_name").html(response);
                    $('select').selectpicker('refresh');
                }
            });
        });

    });
</script>