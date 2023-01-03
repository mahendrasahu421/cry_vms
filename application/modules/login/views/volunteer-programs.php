<?php $base_url = base_url() . 'admin/'; ?>
<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon.png" />

    <!-- TITLE -->
    <title>CRY : VMS</title>

    <!-- BOOTSTRAP CSS -->
    <link id=" style" href="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="<?php echo base_url('admin/'); ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/dark-style.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/skin-modes.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/transparent-style.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/animated.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="<?php echo base_url('admin/'); ?>assets/css/icons.css" rel="stylesheet" />
    <link type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('admin/'); ?>assets/colors/color1.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

</head>
<style>
    select.form-control:not([size]):not([multiple]) {
        height: 3.375rem;
    }

    .login100-form {
        width: 573px;

    }

    @media (max-width: 992px) {
        .login100-form {
            width: 100%;
        }
    }

    .login100-form {
        /* width: 320px; */
    }


    .form-label {
        display: block;
        margin-bottom: 0.375rem;
        font-weight: 500;
        font-size: 1.40rem;
        margin-top: 9px;
    }

    .error {
        width: 100%;
        text-align: left;
        color: red;
    }

    #calendar_details_b2c,
    #calendar_details_b2b {
        display: none;
    }

    .select2-container .select2-selection--single {
        height: 3.375rem !important;
    }
</style>
<style>
    .feedback {
        color: red;
    }
</style>

<body>

    <!-- BACKGROUND-IMAGE -->
    <div class="bg-warning">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="<?php echo base_url('users/'); ?>assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <!-- <?php echo $this->session->userdata('master_insert_message'); ?> -->

        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">

                    <div class="text-center mt-5">
                        <img src="<?php echo base_url('users/'); ?>assets/images/brand/ezgif.com-gif-maker.gif" style="border-radius: 10px;" class="" alt="">
                    </div>
                </div>
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="assets/images/brand/logo.png" class="header-brand-img" alt="">
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-0">
                        <div class="card-header">
                            <span class="login100-form-title">Program Volunteer Registration </span>
                        </div>
                        <style>
                            #success_msg {
                                text-align: center;
                            }
                        </style>
                        <p id="success_msg"></p>
                        <?php echo $this->session->flashdata('master_insert_message'); ?>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="card-body">
                                        <div class="card">
                                            <section style="display:block;" id="section1">
                                                <form class="login100-form validate-form needs-validation" id="basicDetails" novalidate>
                                                    <h3>Personal Information</h3>
                                                    <div>
                                                        <input type="hidden" name="ProgramId" value="<?php echo $program[0]['program_id']; ?>">
                                                        <div class="row">
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">First Name</label>
                                                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" required>
                                                            </div>
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Last Name</label>
                                                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" required>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Email id
                                                                </label>
                                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                                                            </div>
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Phone No.</label>
                                                                <input type="tel" class="form-control" onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)" minlength="10" maxlength="10" required name="mobile_number" placeholder="Mobile number" required id="number">
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="control-group form-group col-md-6 mb-0 genderAge">
                                                                <label class="form-label fw-bold">Age</label>
                                                                <input type="tel" class="form-control" placeholder="Age" name="age" id="age" required autocomplete="off">
                                                            </div>
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Gender</label>
                                                                <select class="form-control select2 form-select" id="gender" name="gender" data-placeholder="Select Gender" required>
                                                                    <option value="">Select Gender
                                                                    </option>
                                                                    <option value="1">Male</option>
                                                                    <option value="2">Female</option>
                                                                    <option value="3">Transgender</option>
                                                                    <option value="4">Prefer not to say</option>
                                                                </select>
                                                                <div class="invalid-feedback">Please select One</div>
                                                            </div>
                                                            <div class="form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Choose Country</label>
                                                                <select class="form-control select2-show-search" name="country" id="country_id" data-placeholder="Choose Country" required>
                                                                    <option selected disabled value="">Choose Countries</option>
                                                                    <?php foreach ($countries as $countrydata) { ?>
                                                                        <option value="<?php echo $countrydata['country_id']; ?>"><?php echo $countrydata['Name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Current State</label>
                                                                <select class="form-control select2-show-search" name="state_id" id="state_name" data-placeholder="Current State" required>
                                                                    <option value="">Current State</option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Current City (Resident/Studying/Work)</label>
                                                                <select class="form-control select2-show-search" name="city_name" id="city_name" data-placeholder="Current  City" required>
                                                                    <option value="">Current City </option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6 mb-0 select-dropdown">
                                                                <label class="form-label fw-bold">Volunteerhip Programs</label>
                                                                <select class="form-control select2 form-select" id="volunteer_programs" name="volunteer_programs" data-placeholder="" required>
                                                                    <?php foreach ($program as $volunteer_programsData) { ?>
                                                                        <option value="<?php echo $volunteer_programsData['program_id']; ?>"><?php echo $volunteer_programsData['program_name']; ?></option>

                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Occupation</label>
                                                                <select class="form-control select2-show-search" id="occupation" name="occupation" data-placeholder="Choose Occupation...">
                                                                    <option selected disabled value="">Choose Occupation...</option>
                                                                    <?php foreach ($occupation as $occupationData) { ?>
                                                                        <option value="<?php echo $occupationData['occupation_id']; ?>" <?php if ($occupationData['occupation_id'] == $allvolunteersData['occupation_id']) {
                                                                                                                                            echo "selected";
                                                                                                                                        } ?>><?php echo $occupationData['occupation_name']; ?></option>

                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Permanent Address</label>
                                                                <input type="text" name="present_address" id="present_address" class="form-control" value="" placeholder="Permanent Address" required maxlength="150">
                                                            </div>
                                                        </div>
                                                        <style>
                                                            .submitbtnleft {
                                                                margin-left: 80%;
                                                                margin-top: 10px;

                                                            }
                                                        </style>
                                                        <div class="submitbtnleft" id="step_1_submit">
                                                            <div class="control-group form-group col-md-12 mb-0 ">
                                                                <input class="btn btn-warning mt-5 clickMe" id="step_1_submit1" type="button" value="Save">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </section>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
    <script>
        $(document).ready(function() {
            $('#step_1_submit').click(function() {

            });

        });
    </script>

    <script>
        $('.feedback').hide();
        $("#step_1_submit1").click(function(ev) {
            var form = $("#basicDetails");
            let fName = $('#first_name').val();
            let lName = $('#last_name').val();
            let email = $('#email').val();
            let number = $('#number').val();
            let age = $('#age').val();
            let gender = $('#gender').val();
            let country_id = $('#country_id').val();
            let state_name = $('#state_name').val();
            let city_name = $('#city_name').val();
            let volunteer_programs = $('#volunteer_programs').val();
            let occupation = $('#occupation').val();
            let present_address = $('#present_address').val();
            if (fName == "" || lName == "" || email == "" || number == "" || age == "" || gender == "" || country_id == "" || state_name == "" || city_name == "" || volunteer_programs == "" || occupation == "" || present_address == "") {
                alert('Please fill all Fields First');
            } else {
                var url = '<?php echo base_url() . 'program_volunteerbasicData' ?>';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function(data) {
                        window.location.href = "<?php echo base_url()."progrmaVolunteer-thankYou/" ?>"+data.trim();
                    },
                    error: function(data) {}
                });

            }
        });
    </script>


    <script>
        $(document).ready(function() {
            $("#country_id").change(function() {
                var country_id = $(this).val();
                // alert(country_id);
                datastr = {
                    country_id: country_id
                };

                $.ajax({
                    url: '<?php echo base_url() ?>get-states',
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
    <script>
        $(document).ready(function() {
            $("#state_name").change(function() {

                var state_id = $(this).val();
                // alert(state_id);
                datastr = {
                    state_id: state_id
                };

                $.ajax({
                    url: '<?php echo base_url() ?>get-city',
                    type: 'post',
                    data: datastr,
                    success: function(response) {
                        $("#city_name").html(response);
                        $('select').selectpicker('refresh');
                    }
                });
            });

        });
    </script>


    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="<?php echo $base_url; ?>assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="<?php echo $base_url; ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo $base_url; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SIDE-MENU JS-->
    <script src="<?php echo $base_url; ?>assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sticky js -->
    <script src="<?php echo $base_url; ?>assets/js/sticky.js"></script>

    <!-- SIDEBAR JS -->
    <script src="<?php echo $base_url; ?>assets/plugins/sidebar/sidebar.js"></script>

    <script src="<?php echo $base_url; ?>assets/plugins/date-picker/jquery-ui.js"></script>
    <script src="<?php echo $base_url; ?>assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!-- FORM WIZARD JS-->
    <script src="<?php echo $base_url; ?>assets/plugins/formwizard/jquery.smartWizard.js"></script>
    <script src="<?php echo $base_url; ?>assets/plugins/formwizard/fromwizard.js"></script>

    <!-- INTERNAl Jquery.steps js -->
    <script src="<?php echo $base_url; ?>assets/plugins/jquery-steps/jquery.steps.min.js"></script>
    <script src="<?php echo $base_url; ?>assets/plugins/parsleyjs/parsley.min.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="<?php echo $base_url; ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="<?php echo $base_url; ?>assets/plugins/p-scroll/pscroll.js"></script>
    <script src="<?php echo $base_url; ?>assets/plugins/p-scroll/pscroll-1.js"></script>

    <!-- INTERNAL Accordion-Wizard-Form js-->
    <script src="<?php echo $base_url; ?>assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script>
    <script src="<?php echo $base_url; ?>assets/js/form-wizard.js"></script>

    <!-- Color Theme js -->
    <script src="<?php echo $base_url; ?>assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="<?php echo $base_url; ?>assets/js/custom.js"></script>

</body>

</html>