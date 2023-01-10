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
                                        <section style="" id="section2">
                                            <b>
                                                <div style="text-align: center; margin-top:-30px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                                            </b>
                                            <div class="card">
                                                <form id="documentdetails" name="pForm" enctype="multipart/form-data">
                                                    <h3>Document Details</h3>
                                                    <div class="row">
                                                        <input type="text" name="ProgramId" value="<?php echo $this->session->userdata('programVolunteerid'); ?>">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">ID proof<span class="text-red">*</span>
                                                                <input type="file" id="id_proof_attach" name="id_proof_attach" class="form-control" required accept=".pdf">
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Address proof
                                                            </label>
                                                            <input type="file" id="add_proof_attach" name="add_proof_attach" accept=".pdf" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="control-group form-group col-md-6 mb-0 letter_parents_attach">
                                                            <label class="form-label fw-bold">consent letter from your
                                                                parents<span class="text-red">*</span> </label>
                                                            <input type="file" accept=".pdf" id="letter_parents_attach" name="letter_parents_attach" class="form-control" required>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Upload a close up photo
                                                            </label>
                                                            <input type="file" accept=".pdf" id="close_up_photo" name="close_up_photo" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Upload your CV
                                                            </label>
                                                            <input type="file" accept=".pdf" id="cv_attach" name="cv_attach" class="form-control" required>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Reference Letter
                                                            </label>
                                                            <input type="file" accept=".pdf" id="ref_attach" name="ref_attach" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="submitbtnleft">
                                                        <div class="control-group form-group col-md-12 mb-0 ">
                                                            <input class="btn btn-warning mt-5" id="step2" type="button" value="Save & Next ">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>

                                        <section style="display:none;" id="section3">
                                            <div class="card">
                                                <form method="post" action="" id="occupationDetails" name="pForm">
                                                    <h3>Occupation Details</h3>
                                                    <input name="volunteer_id" type="hidden" class="form-control" value="<?php echo $allvolunteersData['volunteer_id']; ?>">
                                                    <div class="row">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Emergency Contact
                                                                <span class="col-auto align-self-center">
                                                                    <span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="(any letter from your professional circle, teachers, professors, or any person in some power who can vouch for you)" data-bs-original-title="" title="" aria-describedby="popover10908">?</span>
                                                                </span>
                                                            </label>
                                                            <input maxlength="10" type="text" value="<?php echo $allvolunteersData['emergency_contact']; ?>" name="emergency_contact" class="form-control" required placeholder="Emergency Contact">
                                                        </div>

                                                        <div class="control-group form-group col-md-6 mb-0" id="occupation_input_box">
                                                            <label class="form-label fw-bold">Other Occupation</label>
                                                            <input type="text" value="<?php echo $allvolunteersData['first_name']; ?>" name="otherOccupation" placeholder="Other Occupation" class="form-control" required>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">School/College/University/Organization/Company</label>
                                                            <input type="text" value="<?php echo $allvolunteersData['name_of_school']; ?>" name="name_of_school" class="form-control" placeholder="Name of your school/ college" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Designation if
                                                                working</label>
                                                            <input type="text" value="<?php echo $allvolunteersData['designation']; ?>" name="designation" class="form-control" placeholder="Designation if working" required>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Languages known</label>
                                                            <select class="form-control select2 form-select" name="language" id="language" data-placeholder="Select Languages" required>
                                                                <option value=""></option>
                                                                <option value="1">English</option>
                                                                <option value="2">Hindi</option>
                                                                <option value="3">Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0" id="lang_input_box">
                                                            <label class="form-label fw-bold">Languages known</label>
                                                            <input type="text" value="<?php echo $allvolunteersData['Otherlanguages']; ?>" class="form-control" name="otherlanguage" required>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Which kind of programs interests you?
                                                                *</label>
                                                            <select class="form-control select2 form-select" name="programsInterests" id="interestsyouBox" data-placeholder="Select Languages" required>
                                                                <option value=""></option>
                                                                <option value="1">Research and Documentation</option>
                                                                <option value="2">Working with Communities and Children</option>
                                                                <option value="3">Designing posters and pamphlets</option>
                                                                <option value="4">Media related work/ Publishing articles</option>
                                                                <option value="5">Initiating a campaign</option>
                                                                <option value="6">Fundraising</option>
                                                                <option value="7">Video editing, photography etc</option>
                                                                <option value="8">Preparing professional PPT's/documents</option>
                                                                <option value="9">Data Analysis</option>
                                                                <option value="10">Event planning and execution</option>
                                                                <option value="11">Othere</option>

                                                            </select>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0" id="interestsBox">
                                                            <label class="form-label fw-bold">Which kind of programs interests you?</label>
                                                            <input type="text" value="<?php echo $allvolunteersData['first_name']; ?>" class="form-control" name="otherprogramsInterests" required>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">What is the time commitment that you can offer with CRY?
                                                            </label>
                                                            <select class="form-control select2 form-select" name="commitment" data-placeholder=" Your Answer" required>
                                                                <option value="">Select commitment</option>
                                                                <option value="1">3 months</option>
                                                                <option value="2">3 to 6 months</option>
                                                                <option value="3">More then 6 months</option>
                                                                <option value="4">More then 1 year</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">How did you came to know about CRY?</label>
                                                            <select class="form-control select2" name="where_know_opportunity" data-placeholder="" id="where_know_opportunity" required>
                                                                <?php foreach ($opportunity as $opportunityData) { ?>
                                                                    <option value="<?php echo $opportunityData['opportunity_id']; ?>"><?php echo $opportunityData['opportunity_name']; ?></option><?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0" id="where_know_opportunityBox">
                                                            <label class="form-label fw-bold">How did you came to know about CRY?</label>
                                                            <input type="text" value="<?php echo $allvolunteersData['knowaboutCRY']; ?>" class="form-control" required>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <h5><strong>Read the below 3 Documents Properly</strong></h5>
                                                    <div class="row">

                                                        <div class="col-md-6 mb-0">
                                                            <a href="https://drive.google.com/drive/folders/1OA4CvaYcoVowDUMYyUbmnMvwKKhhiVpt" target="_blank">
                                                                <h5><span>&nbsp;</span><input type="checkbox" value="<?php echo $allvolunteersData['first_name']; ?>" required> &nbsp;CRY's
                                                                    Child Protection
                                                                    Policy</h5>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 mb-0">
                                                            <a href="https://docs.google.com/document/d/14G9qJjqgCFiapxChbbMRW2dsLPnK8WpVxyZo05qSWsk/edit?usp=sharing" target="_blank">
                                                                <h5><span>&nbsp;</span><input type="checkbox" value="<?php echo $allvolunteersData['first_name']; ?>" required> &nbsp;CRY's
                                                                    Code of Conduct
                                                                </h5>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-0">
                                                            <a href="https://drive.google.com/file/d/119ksoFAzQ7gE8uuvRol0EaCfjbwGL6sz/viewusp=sharing" target="_blank">
                                                                <h5><span>&nbsp;</span><input type="checkbox" value="<?php echo $allvolunteersData['first_name']; ?>" required> &nbsp;CRY's
                                                                    Online sessions
                                                                    SOP</h5>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 mb-0"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Signature</label>
                                                            <input type="text" value="<?php echo $allvolunteersData['signature']; ?>" name="signature" class="form-control" placeholder="Signature" required>
                                                        </div>
                                                    </div>
                                                    <div class="submitbtnleft">
                                                        <div class="control-group form-group col-md-12 mb-0 ">
                                                            <input class="btn btn-warning mt-5 mb-5" id="step_3_submit" type="button" value="Finish ">

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />


    <script>
        $('.feedback').hide();
        $("#step_1_submit1").click(function(ev) {
            var form = $("#basicDetails");
            var url = '<?php echo base_url() . 'program_volunteerbasicData' ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {},
                error: function(data) {}
            });


        });
    </script>
    <script>
        $('#step2').click(function(e) {
            //  alert('working');
            let id_proof_attach = $('#id_proof_attach').val();
            //  alert(id_proof_attach);
            let add_proof_attach = $('#add_proof_attach').val();
            // let letter_parents_attach = $('#letter_parents_attach').val();
            let close_up_photo = $('#close_up_photo').val();
            let letter_parents_attach = $('#letter_parents_attach').val();
            let cv_attach = $('#cv_attach').val();
            let ref_attach = $('#ref_attach').val();
            e.preventDefault();
            var form = document.getElementById('documentdetails');
            var fdata = new FormData(form);
            var url = '<?php echo base_url() . 'program_volunteersecondinsertBasicdata' ?>';

            $.ajax({
                type: "POST",
                url: url,
                data: fdata,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {}
            });
        });
    </script>
    <script>
        $('document').ready(function() {
            $('#step_1_submit1').click(function() {
                $("#section1").css("display", "none");
                $("#section2").css("display", "block");
                $("#section3").css("display", "none");
            });
        });
    </script>
    <script>
        $('document').ready(function() {
            $('#step2').click(function() {
                $("#section1").css("display", "none");
                $("#section2").css("display", "none");
                $("#section3").css("display", "block");


            });
        });
    </script>


    <script>
        $("#step_3_submit").click(function(ev) {
            var form = $("#occupationDetails");
            var url = '<?php echo base_url() . 'insertoccupationDetails' ?>';

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    window.location.href = "<?php echo base_url('/thank-you') ?>";
                },
                error: function(data) {}
            });
        });
    </script>


    <script>
        $('#where_know_opportunityBox').hide();
        jQuery('#where_know_opportunity').change(function() {
            if ($('#where_know_opportunity').val() == "8") {
                $('#where_know_opportunityBox').show();
            } else {
                $('#where_know_opportunityBox').hide();
            }

        });
    </script>
    <script>
        $('#interestsBox').hide();
        jQuery('#interestsyouBox').change(function() {
            if ($('#interestsyouBox').val() == "11") {
                $('#interestsBox').show();
            } else {
                $('#lang_input_box').hide();
            }

        });
    </script>
    <script>
        $('#lang_input_box').hide();
        jQuery('#language').change(function() {
            if ($('#language').val() == "3") {
                $('#lang_input_box').show();
            } else {
                $('#lang_input_box').hide();
            }

        });
    </script>
    <script>
        $('#occupation_input_box').hide();
        jQuery('#occupation').change(function() {
            if ($('#occupation').val() == "8") {
                $('#occupation_input_box').show();
            } else {
                $('#occupation_input_box').hide();
            }

        });
    </script>
    <script>
        $('#how_did_input_box').hide();
        jQuery('#where_know_opportunity').change(function() {
            if ($('#where_know_opportunity').val() == '8') {
                $('#how_did_input_box').show();
            } else {
                $('#how_did_input_box').hide();
            }

        });
    </script>
    <script>
        $('document').ready(function() {
            var dob = $('#dob').val();
            //alert(dob);
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            let newAge = $('#age').val(age);
            if (newAge <= 13) {
                $('#letter_parents_attach').hide();
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