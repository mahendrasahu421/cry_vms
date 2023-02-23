<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Edit Program Volunteer</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Edir Program Volunteer
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
                            <h3 class="card-title text-white">Program Volunteer</h3>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="<?php echo base_url(); ?>update-program" method="post" novalidate>
                                <input type="hidden" value="<?php echo $volunteer_programs[0]['program_id']; ?>" name="program_id">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <?php $regionId = $this->session->userdata('region_id'); ?>
                                        <label class="form-label fw-bold" for="validationCustom02">Region Name</label>
                                        <select class="form-control select2-show-search form-select" name="region_id" id="region_id" required>
                                            <option selected disabled value="">Choose Region</option>
                                            <?php foreach ($regions as $rd) { ?>
                                                <option value="<?php echo $rd['region_id']; ?>" <?php if ($volunteer_programs[0]['program_region'] == $rd['region_id']) {
                                                                                                    echo  "selected";
                                                                                                } ?>><?php echo $rd['region_name']; ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom04">Program Name</label>
                                        <input type="text" name="programName" class="form-control" id="validationCustom02" value="<?php echo $volunteer_programs[0]['program_name']; ?>" placeholder="Program Name" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom04">Program Start Date</label>
                                        <input type="date" name="programstart-date" class="form-control" id="programstart-date" value="<?php echo $volunteer_programs[0]['programstart_date']; ?>" placeholder="Program Name" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom04">Program End Date</label>
                                        <input type="date" name="programend-date" class="form-control" id="programend-date" value="<?php echo $volunteer_programs[0]['programend_date']; ?>" placeholder="Program Name" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom04">URL Expire Date</label>
                                        <input type="date" name="programexp-date" class="form-control" id="programexp-date" value="<?php echo $volunteer_programs[0]['programexp_date']; ?>" placeholder="Program Name" required />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom04">Program In Brife</label>
                                        <textarea type="date" maxlength="500" name="programInbrife" class="form-control" id="programInbrife" value="" placeholder="Program In Brife" required><?php echo $volunteer_programs[0]['programIn_brife']; ?></textarea>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom04">Status</label>
                                        <select class="form-select select2 form-control" name="status" id="validationCustom04" required>
                                            <option selected disabled value="">Choose</option>
                                            <option value="1" <?php if ($volunteer_programs[0]['status'] == 1) {
                                                                    echo  "selected";
                                                                } ?>>
                                                Published
                                            </option>
                                            <option value="2" <?php if ($volunteer_programs[0]['status'] == 2) {
                                                                    echo  "selected";
                                                                } ?>>
                                                Unpublished
                                            </option>
                                        </select>
                                    </div>
                                    <style>
                                        #programSubmit {
                                            margin-top: 35px;
                                            /* // margin-left: 500px; */
                                        }
                                    </style>
                                    <div class="col-md-6" id="programSubmit">
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </div>
                                </div>


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
<script>
    $(document).ready(function() {
        let region_id = $('#region_id').val();
        if (region_id != null) {
            $('#region_id option:not(:selected)').attr('disabled', true);
        }

    });
</script>
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
        $("#state_name").change(function() {
            var state_name = $(this).val();
            // alert(state_name);
            datastr = {
                state_name: state_name
            };

            $.ajax({
                url: '<?php echo base_url() ?>get-district-admin',
                type: 'post',
                data: datastr,
                success: function(response) {
                    $("#cityName").html(response);
                    $('select').selectpicker('refresh');
                }
            });
        });

    });
</script>