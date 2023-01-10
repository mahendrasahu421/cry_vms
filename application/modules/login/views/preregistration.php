<?php $base_url = base_url() . 'admin_assets/'; ?>
<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon.png"" />

  <!-- TITLE -->
  <title>CRY : VMS</title>

  <!-- BOOTSTRAP CSS -->
  <link id=" style" href="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="<?php echo base_url('admin/'); ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/dark-style.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/skin-modes.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/transparent-style.css" rel="stylesheet" />
    <!-- <link href="<?php echo base_url('admin/'); ?>assets/css/animated.css" rel="stylesheet" /> -->

    <!--- FONT-ICONS CSS -->
    <link href="<?php echo base_url('admin/'); ?>assets/css/icons.css" rel="stylesheet" />
    <!-- <link type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <!-- <link type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet"> -->

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

<body>
    <!-- BACKGROUND-IMAGE -->
    <div class="bg-warning">
        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="<?php echo base_url('users/'); ?>assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">

                    <div class="text-center mt-5">
                        <img src="<?php echo base_url('users/'); ?>assets/images/brand/ezgif.com-gif-maker.gif" style="border-radius: 10px;" class="" alt="">
                    </div>
                </div>
                <div class="col col-login mx-auto">
                    <!-- <div class="text-center">
            <img src="<?php echo base_url('admin/') ?>assets/images/brand/logo.png" class="header-brand-img" alt="">
          </div> -->
                </div>
                <style>
                    #resend {
                        margin-top: 23px;
                    }

                    #verifyMail {
                        margin-top: 23px;
                    }
                </style>
                <div class="container-login100">
                    <div class="wrap-login100 p-0">
                        <div class="card-header">
                            <span class="login100-form-title">Pre Registration</span>
                        </div>
                        <!-- <?php echo $this->session->flashdata('master_insert_message'); ?> -->
                        <div class="card-body">
                            <form class="login100-form validate-form needs-validation" id="sform" method="post" action="<?php echo base_url(); ?>insert_preregistration_data" enctype="multipart/form-data" novalidate>
                                <section id="emailSection" style="display:block;">
                                    <div class="row">
                                        <input type="hidden" id="mailotp" name="cotp">
                                        <div class="form-group col-md-12 mb-0" id="lookingFor">
                                            <label for="validationCustom01">Looking for</label>
                                            <select id="single" class="form-select select2 form-control" id="looking_for" name="looking_for" required>
                                                <option value="">Looking for...</option>
                                                <option value="volunteering">Volunteering</option>
                                                <option value="internship">Internship</option>
                                            </select>

                                        </div>
                                        <div class="form-group col-md-12 mb-0">
                                            <label class="form-label fw-bold">Enter Email (OTP Send on your
                                                Mail)</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>

                                        </div>

                                        <div class="col-lg-6 mb-0 Otp">
                                            <label class="form-label fw-bold">Enter OTP</label>
                                            <div class="">
                                                <input class="form-control" id="enterOtp" name="otp" placeholder="Enter OTP" maxlength="4">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-0 Otp" id="verifyMail">
                                            <label class="form-label fw-bold"></label>
                                            <div class="">
                                                <span class="btn btn-info">Verify Mail</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3  Otp">
                                            <label class="form-label fw-bold"></label>
                                            <div class="">
                                                <span id="resend" class="btn btn-info">Resend Otp</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 mt-3">
                                            <button type="button" class="btn btn-warning" id="genrateOTP">Genrate
                                                OTP</button>
                                        </div>
                                    </div>
                                </section>

                                <section id="detailFormsection" style="display:none;">
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">First Name </label>
                                        <input type="text" id="first_name" name="first_name" class="form-control txtNumeric" placeholder="First Name" required>
                                    </div>

                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Last Name</label>
                                        <input type="text" id="last_name" name="last_name" class="form-control txtNumeric" placeholder="Last Name" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Date of Birth </label>
                                        <div class="input-group mb-4">
                                            <input type="text" class="form-control" placeholder="Date of Birth" name="dob" id="dob" required autocomplete="off">
                                        </div>
                                        <span id="lblError" style="color:Red"><?php echo $this->session->flashdata('dob_error'); ?></span>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Gender</label>
                                        <select class="form-control select2 form-select" id="gender" name="gender" data-placeholder="Select Gender" required>
                                            <option value="">Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Transgender</option>
                                        </select>
                                        <div class="invalid-feedback">Please select Gender</div>
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label fw-bold">Enter Mobile Number </label>
                                        <input type="tel" class="form-control" onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)" minlength="10" maxlength="10" required name="mobile_number" placeholder="Mobile number" required id="number">
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Choose Country</label>
                                        <select class="form-control select2-show-search" name="county" id="country_id" data-placeholder="Choose Country" required>
                                            <option selected disabled value="">Choose Countries</option>
                                            <?php foreach ($countries as $countrydata) { ?>
                                                <option value="<?php echo $countrydata['country_id']; ?>">
                                                    <?php echo $countrydata['Name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Please select Country</div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Current State</label>
                                        <select class="form-control select2-show-search" name="state_id" id="state_name" data-placeholder="Current State" required>
                                            <option value="">Current State</option>

                                        </select>
                                        <div class="invalid-feedback">Please select State</div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Current Districts
                                            (Resident/Studying/Work)</label>
                                        <select class="form-control select2-show-search" name="city_name" id="city_name" data-placeholder="Current Districts" required>
                                            <option value="">Current Districts </option>
                                        </select>
                                        <div class="invalid-feedback">Please select Districts</div>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Choose Occupation</label>
                                        <select class="form-control select2-show-search" name="occupation" id="occupation" data-placeholder="Choose Occupation..." required>
                                            <option selected disabled value="">Choose Occupation...</option>
                                            <?php foreach ($occupation as $occupationData) { ?>
                                                <option value="<?php echo $occupationData['occupation_id']; ?>">
                                                    <?php echo $occupationData['occupation_name']; ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Please select Occupation</div>
                                    </div>
                                    <div class="form-group col-md-12 mb-0 select-dropdown">
                                        <label class="form-label fw-bold">Type Of Volunteering</label>
                                        <select id="inputState" class="form-control select2 form-select" name="volunteering_type" required>
                                            <option value="">Select Type Of...</option>
                                            <?php foreach ($taskType as $taskTypedata) { ?>
                                                <option value="<?php echo $taskTypedata['vol_type_id']; ?>">
                                                    <?php echo $taskTypedata['vol_type_name']; ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Please select Volunteering Type</div>
                                    </div>
                                    <div class="form-group col-md-12 mb-0 select-dropdown">

                                        <label class="form-label fw-bold">Volunteership Skills</label>
                                        <select class="form-control select2 form-select" name="skill_id[]" multiple required id="skill_id">
                                            <option value=""> Select Volunteership Skills</option>
                                            <?php foreach ($skills as $skillsData) { ?>
                                                <option value="<?php echo $skillsData['skill_id']; ?>">
                                                    <?php echo $skillsData['skill_name']; ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Please select Volunteership Skills</div>
                                        <div class="form-group" id="cv">
                                            <label class="form-label fw-bold">Upload Your CV</label>
                                            <input class="form-control btn-warning" type="file" name="Uploade_file" id="Uploade_file">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 mb-0 select-dropdown">
                                        <label class="form-label fw-bold">Where did you get to know about this
                                            Opportunity</label>
                                        <select class="form-control select2 form-select" name="where_know_opportunity[]" data-placeholder="Where did you get to know about this
                                            Opportunity" multiple required id="where_know_opportunity">
                                            <option value="">Where did you get to know about this
                                                Opportunity</option>
                                            <?php foreach ($opportunity as $opportunityData) { ?>
                                                <option value="<?php echo $opportunityData['opportunity_id']; ?>">
                                                    <?php echo $opportunityData['opportunity_name']; ?></option><?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Please select Opportunity</div>
                                    </div>
                                    <div class="form-group col-md-12 mb-0" id="select-dropdown1">
                                        <label class="form-label fw-bold">Internship Skills</label>
                                        <select class="form-control select2" name="internskill_id[]" data-placeholder="" multiple id="internSkill_id">
                                            <?php foreach ($skills as $skillsData) { ?>
                                                <option value="">Internship Skills</option>
                                                <option value="<?php echo $skillsData['skill_id']; ?>">
                                                    <?php echo $skillsData['skill_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="form-group" id="cv">
                                            <label class="form-label fw-bold">Upload Your CV</label>
                                            <input class="form-control btn-warning" type="file" name="Uploade_file" id="Uploade_file" accept=".pdf">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-0" id="textarea1">
                                        <div class="">
                                            <label class="form-label fw-bold">Mention past volunteering and Internships
                                                you may have done?</label>
                                            <textarea class="form-control mb-4" name="mention_past" id="pastVolunteering" placeholder="Mention past volunteering and Internships you may have done?" rows="3" maxlength="300"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-0" id="textarea2">
                                        <label class="form-label fw-bold">What you aim to value add on if chosen for an
                                            Internship with CRY ?</label>
                                        <div class="">
                                            <textarea class="form-control mb-4" name="whatyou_aim" id="youAim" placeholder="What you aim to value add on if chosen for an Internship with CRY ?" rows="3" maxlength="300"></textarea>
                                        </div>
                                    </div>
                                    <div class="container-login100-form-btn">
                                        <button type="submit" name="preregistration" id="preregistration" class="login100-form-btn btn-warning">
                                            Register
                                        </button>
                                    </div>
                                </section>
                            </form>
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
            $("#single").change(function() {
                let volunteeringType = $('#single').val();
                if (volunteeringType == 'internship') {
                    $('#skill_id').removeAttr("required");
                    //$('#internSkill_id').addAttr("required");
                    $('#where_know_opportunity').removeAttr("required");
                    $('#inputState').removeAttr("required");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#verifyMail').on('click', function() {
                var otp = $('#mailotp').val();
                var cotp = $('#enterOtp').val();
                if (otp == cotp) {
                    $("#emailSection").css("display", "none");
                    $("#detailFormsection").css("display", "block");
                } else {
                    alert('OTP Not Matched');
                    $('#con_otp').val('');
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.Otp').hide();
            $('#genrateOTP').click(function() {
                let email = $('#email').val();
                var looking_for = $('#single').val();
                if (email == "" || looking_for == "") {
                    alert('Fill All Fields');
                } else {

                    $('.email-verify-error').empty('Please Enter Email');
                    var datastr = {
                        VOLUNTEEREMAIL: email,
                        SINGLE: looking_for,
                    };
                    //alert(datastr);
                    jQuery.ajax({
                        url: '<?php echo base_url(); ?>email-ajax-check',
                        type: 'post',
                        data: datastr,
                        success: function(data) {
                            //alert(data);
                            if (data == 1) {
                                alert('Email Already exits!');
                                $('#email').val('');
                                setTimeout(function() {
                                    $('.email-verify-error').text('');
                                }, 4000);
                                $('#email').focus();
                                return false;

                            } else {
                                $('.Otp').show();
                                $('#genrateOTP').hide();
                                jQuery.ajax({
                                    url: '<?php echo base_url(); ?>create-emailOtp',
                                    type: 'post',
                                    data: datastr,
                                    success: function(data) {
                                        var trimStr = $.trim(data);
                                        //alert(trimStr);
                                        $('#mailotp').val(trimStr);

                                    }
                                });
                            }
                        }
                    });
                }

            });

        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('.txtNumeric').keydown(function(e) {
                if (e.ctrlKey || e.altKey) {
                    e.preventDefault();
                } else {
                    var key = e.keyCode;
                    if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >=
                            65 && key <= 90))) {
                        e.preventDefault();
                    }
                }
            });
        });
    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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

    <script>
        $(document).ready(function() {
            $('#resend').click(function() {
                var email = $('#email').val();
                var datastr = {
                    VOLUNTEEREMAIL: email
                };
                jQuery.ajax({
                    url: '<?php echo base_url(); ?>email-ajax-check',
                    type: 'post',
                    data: datastr,
                    success: function(data) {
                        //alert(data);	
                        if (data == 1) {
                            $('.email-verify-error').text('Email Already exits!');
                            $('#email').val('');
                            setTimeout(function() {
                                $('.email-verify-error').text('');
                            }, 4000);
                            $('#email').focus();
                            return false;

                        } else {
                            $('.enterOtp').show();
                            jQuery.ajax({
                                url: '<?php echo base_url(); ?>create-emailOtp',
                                type: 'post',
                                data: datastr,
                                success: function(data) {
                                    var trimStr = $.trim(data);
                                    //  alert(trimStr);
                                    //console.log(trimStr);
                                    $('#mailotp').val(trimStr);
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>


    <script>
        function reloadThePage() {
            window.location.reload();
        }
    </script>

    <script type='text/javascript'>
        var secondsBeforeExpire = 120;
        var timer = setInterval(function() {
            if (secondsBeforeExpire <= 0) {
                clearInterval(timer);
                $("#resend").prop('disabled', false);
                $("#time-remaining").hide();
            } else {
                secondsBeforeExpire--;
                $("#time-remaining").text(secondsBeforeExpire + "sec.");
            }
        }, 1000);
    </script>

    <!-- JQUERY JS -->
    <script>
        $(document).ready(function() {
            $("#country_id").change(function() {
                var country_id = $(this).val();
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

    <script>
        $(function() {
            $("#dob").datepicker({
                changeMonth: true,
                changeYear: true,
                // showOn: 'button',
                buttonImageOnly: false,
                buttonImage: '<?php echo base_url() ?>web/images/calendar.gif',
                dateFormat: 'dd-mm-yy',
                yearRange: '1900:+0',
                onSelect: function(dateString, txtDate) {
                    ValidateDOB(dateString);
                }
            });
        });

        function ValidateDOB(dateString) {
            var lblError = $("#lblError");
            var parts = dateString.split("-");
            var dtDOB = new Date(parts[1] + "-" + parts[0] + "-" + parts[2]);
            var dtCurrent = new Date();
            lblError.html("Eligibility 13 years ONLY.")
            if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 13) {
                $('#dob').val('');
                return false;
            }

            if (dtCurrent.getFullYear() - dtDOB.getFullYear() == 13) {
                if (dtCurrent.getMonth() < dtDOB.getMonth()) {
                    $('#dob').val('');
                    return false;
                }
                if (dtCurrent.getMonth() == dtDOB.getMonth()) {
                    if (dtCurrent.getDate() < dtDOB.getDate()) {
                        $('#dob').val('');
                        return false;
                    }
                }
            }
            lblError.html("");
            return true;
        }
    </script>

    <script>
        $("document").ready(function() {
            $('#cv').hide();
            $('.select-dropdown').hide();
            $('#select-dropdown1').hide();
            $('#textarea1').hide();
            $('#textarea2').hide();
            $('#single').change(function() {
                let volunteerValue = $('#single').val();
                if (volunteerValue == 'volunteering') {

                    $('.select-dropdown').show();
                    $('#select-dropdown1').hide();

                    //$('#lookingFor').hide();
                    $('#textarea1').hide();

                    $('#textarea2').hide();

                } else if ($('#single').val() == 'internship') {

                    if (confirm(
                            'In Internship we expect minimum of 5-6 hours of work daily through minimum of 4 weeks Are you sure you will like to apply? '
                        )) {
                        // Save it!

                        $('.select-dropdown').hide();
                        $('.select-dropdown').hide();
                        $('#select-dropdown1').show();

                        $('#textarea1').show();
                        $('#textarea2').show();
                    } else {
                        // Do nothing!
                        $(location).attr('href', '#simple');
                        $('.select-dropdown').hide();

                    }

                } else {
                    $('.select-dropdown').hide();
                    $('#select-dropdown1').hide();
                    $('#textarea1').hide();
                    $('#textarea2').hide();
                }
            });
            $(".multiple").select2({
                placeholder: "Select a programming language",
                allowClear: true,
                maximumSelectionLength: 8
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#number').on('change', function() {
                var mob = $('#number').val();
                var datastr = {
                    MIGRANTMOB: mob
                };
                jQuery.ajax({
                    url: '<?php echo base_url(); ?>mobile-ajax-check',
                    type: 'post',
                    data: datastr,
                    success: function(data) {
                        //alert(data);	
                        if (data == 1) {
                            $('.mob-signup-error').text('Mobile Number already exits!');
                            $('#number').val('');
                            setTimeout(function() {
                                $('.mob-signup-error').text('');
                            }, 4000);
                            $('#number').focus();
                            return false;
                        }
                    }
                });
            });
        });
    </script>


    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
    <script src="<?php echo base_url('admin/'); ?>assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SPARKLINE JS-->
    <script src="<?php echo base_url('admin/'); ?>assets/js/jquery.sparkline.min.js"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="<?php echo base_url('admin/'); ?>assets/js/circle-progress.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/charts-c3/d3.v5.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/charts-c3/c3-chart.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/input-mask/jquery.mask.min.js"></script>

    <!-- CHARTJS CHART JS-->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/chart/Chart.bundle.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/chart/utils.js"></script>

    <!-- PIETY CHART JS-->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/peitychart/jquery.peity.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/peitychart/peitychart.init.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/wysiwyag/jquery.richtext.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/wysiwyag/wysiwyag.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/quill/quill.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/js/themeColors.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/js/custom.js"></script>
    <!-----------select js-------------->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/fileuploads/js/file-upload.js"></script>
    <!-- FILE UPLOADES JS -->
    <!-- INTERNAL File-Uploads Js-->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/fancyuploder/fancy-uploader.js"></script>

    <!-- SELECT2 JS -->


    <!-- BOOTSTRAP-DATERANGEPICKER JS -->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

    <!-- INTERNAL Sumoselect js-->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/sumoselect/jquery.sumoselect.js"></script>

    <!-- TIMEPICKER JS -->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/time-picker/jquery.timepicker.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/time-picker/toggles.min.js"></script>

    <!-- INTERNAL intlTelInput js-->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/intl-tel-input-master/intlTelInput.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/intl-tel-input-master/country-select.js"></script>


    <!-- INTERNAL multi js-->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/multi/multi.min.js"></script>

    <!-- DATEPICKER JS -->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/date-picker/date-picker.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/date-picker/jquery-ui.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!-- MULTI SELECT JS-->
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/multipleselect/multiple-select.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/plugins/multipleselect/multi-select.js"></script>

    <!-- FORMELEMENTS JS -->
    <script src="<?php echo base_url('admin/'); ?>assets/js/formelementadvnced.js"></script>
    <script src="<?php echo base_url('admin/'); ?>assets/js/form-elements.js"></script>



</body>

</html>