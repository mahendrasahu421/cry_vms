<?php
$today = date("Y-m-d");

?>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Intern Add Task</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Intern Task</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-warning">
                        <div class="card-title">Intern Add Task</div>
                    </div>
                    <form action="<?php echo base_url(); ?>interninsert_add_task" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <input type="hidden" value="<?php echo $today; ?>" name="creation_date">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Task Type<sup class="text-danger fs-6">*</sup></label>
                                    <select class="form-control select2-show-search form-select" name="task_type" id="task_type" required>
                                        <option selected disabled value="">Select Task Type</option>
                                        <?php foreach ($taskType as $tt) {
                                        ?>
                                            <option value="<?php echo $tt['task_type_id']; ?>">
                                                <?php echo $tt['task_type'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">Select Task Type</div>
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Select Region<sup class="text-danger fs-6">*</sup></label>
                                    <input type="hidden" name="regionId" value="<?php $regionId = $this->session->userdata('region_id'); ?>">
                                    <?php $regionId = $this->session->userdata('region_id'); ?>
                                    <select class="form-control select2-show-search form-select" name="region_id" id="region_id">
                                        <option selected disabled value="">Select Region</option>
                                        <?php foreach ($regions as $rd) {
                                        ?>
                                            <option value="<?php echo $rd['region_id']; ?>" <?php if ($regionId == $rd['region_id']) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $rd['region_name'] ?></option>
                                        <?php } ?>
                                    </select>

                                    <div class="invalid-feedback">Select Region</div>
                                </div>
                                <div class="col-md-4 thisOnline">
                                    <label for="validationCustom02" class="form-label">Select State<sup class="text-danger fs-6">*</sup></label>
                                    <select class="form-control select2-show-search form-select" name="state_name" id="state_name">
                                        <option>Select State</option>
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
                                <div class="col-md-4 thisOnline">
                                    <label for="validationCustom02" class="form-label">Select Districts<sup class="text-danger fs-6">*</sup></label>
                                    <select class="form-control select2-show-search form-select" name="city" id="city">
                                        <option value="">Select City</option>
                                        <?php foreach ($cities as $cd) { ?>
                                            <option value="<?php echo $cd['city_id']; ?>" <?php if ($cd['state_id'] == $sid) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                <?php echo $cd['city_name']; ?>
                                            </option>

                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Start Date <sup class="text-danger fs-6">*</sup></label>
                                    <input type="date" name="sdate" id="sdate" onkeyup="onlyNumber('sdate');" value="" class="form-control dob_caf" required />
                                    <div class="invalid-feedback">Select Start Date</div>
                                </div>
                                <div class="col-md-4 ">
                                    <label for="validationCustom02" class="form-label">Expected End Date
                                        <sup class="text-danger fs-6">*</sup></label>
                                    <input type="date" name="edate" id="edate" onkeyup="onlyNumber('sdate');" value="" class="form-control dob_caf" required />
                                    <div id="expdateerror" class="col-md-12"></div>
                                    <div class="invalid-feedback"> Select Expected End Date</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Total Intern Required
                                        <sup class="text-danger fs-6">*</sup></label>
                                    <input type="text" class="form-control" onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)" id="volunteer" name="intern_required" value="" required placeholder="Total Intern Required" />
                                    <div class="invalid-feedback">Select Total Volunteers Required</div>
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Keywords <sup class="text-danger fs-6">*</sup></label>
                                    <select class="form-control select2 form-select" name="keywords[]" multiple required id="keywords">
                                        <option disabled value="">Select KeyWord</option>

                                        <?php foreach ($skills as $skillsData) { ?>
                                            <option value="<?php echo $skillsData['skill_id']; ?>">
                                                <?php echo $skillsData['skill_name']; ?></option>

                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">Select Keywords</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Task Title <sup class="text-danger fs-6">*</sup></label>
                                    <textarea class="form-control" id="exampleFormControlTextarea2" rows="2" placeholder="Title" maxlength="150" name="title" required></textarea>
                                    <div class="invalid-feedback">Please Fill Task Title</div>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationCustom04" class="form-label">What To Do ?<sup class="text-danger fs-6">*</sup> <small>(Enter max limit 300 characters)</small></label>
                                    <div class="">
                                        <textarea class="content" name="what_to_do" rows="4" cols="10" required></textarea>
                                    </div>
                                    <div class="invalid-feedback">Please Fill What To Do ?</div>
                                </div>
                                <div class="col-md-6 upstair">
                                    <label for="inputEmail3" class="form-label">Status <sup class="text-danger fs-6">*</sup></label>
                                    <select class="form-control select2-show-search form-select" id="location" name="status" required>
                                        <option value="">
                                             Select Status
                                        </option>
                                        <option value="1">
                                            Published
                                        </option>
                                        <option value="2">
                                            Saved
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Status</div>
                                </div>
                                <div class="col-md-6 upstair float-left">
                                    <button class="btn btn-warning" type="submit" value="Submit" style="margin-top: 6%; margin-left:80%;">Submit
                                    </button>
                                </div>

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
<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('sdate').setAttribute('min', today);
    document.getElementById('sdate').value = today;
</script>



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
        $('#task_type').change(function() {
            var task_type = $('#task_type').val();
            if (task_type == 1) {
                $('.thisOnline').hide();
            } else {
                $('.thisOnline').show();
            }
        });
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
                    // $('select').selectpicker('refresh');
                }
            });
        });

    });
    $(document).ready(function() {
        $("#state_name").change(function() {
            var state_name = $(this).val();
            datastr = {
                state_name: state_name
            };
            //alert(datastr)
            $.ajax({
                url: '<?php echo base_url() ?>get-city-by-task',
                type: 'post',
                data: datastr,
                success: function(response) {
                    $("#city").html(response);
                    //$('select').selectpicker('refresh');
                }
            });
        });

    });
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>