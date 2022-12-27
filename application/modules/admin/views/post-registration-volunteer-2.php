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
                    <div class="text-center">
                        <img src="assets/images/brand/logo.png" class="header-brand-img" alt="">
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-0">
                        <div class="card-header">
                            <span class="login100-form-title">Post Registration</span>
                        </div>
                        <?php echo $this->session->flashdata('master_insert_message'); ?>
                        <div class="card-body">
                            <form class="login100-form validate-form" method="post" action="#" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="first_name" class="form-control" placeholder="Name" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Email id
                                        </label>
                                        <input type="email" name="last_name" class="form-control" placeholder="Email id" required>
                                    </div>
                                 
                                    <div class="form-group col-md-6 mb-0">
                                        
                                        <label class="form-label fw-bold">Phone number

                                        </label>
                                        <input type="email" name="last_name" onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)" minlength="10" maxlength="10" required class="form-control" placeholder="Phone number
" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Date of Birth </label>
                                        <div class="input-group mb-4">
                                            <input type="text" class="form-control" placeholder="Date of Birth" name="dob" id="dob" required autocomplete="off">
                                        </div>
                                        <span id="lblError" style="color:Red"><?php echo $this->session->flashdata('dob_error'); ?></span>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Age
                                        </label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Age" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Gender</label>
                                        <select class="form-control select2 form-select" name="gender" data-placeholder="Select Gender">
                                            <option label="Select Gender">
                                            </option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Transgender</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">Permanent Address
                                        </label>
                                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-0">
                                        <label class="form-label fw-bold">City of Residence
                                        </label>
                                        <input type="tel" class="form-control" name="mobile_number" placeholder="City of Residence
" required id="number">
                                    </div>
                                    
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">ID proof (Please attach a scan copy of your PAN Card, aadhar card, passport, driving license, voter id card, ration card)</label>
                                        <input type="file" class="form-control" name="mobile_number" placeholder="City of Residence
" required id="number">
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">Attach a consent letter from your parents(only if you are below 18 years)</label>
                                        <input type="file" class="form-control" name="mobile_number" placeholder="City of Residence
" required id="number">
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">Upload a close up photo
                                            *</label>
                                        <input type="file" class="form-control" name="mobile_number" placeholder="City of Residence
" required id="number">
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">Upload your CV
                                            *</label>
                                        <input type="file" class="form-control" name="mobile_number" placeholder="City of Residence
" required id="number">
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">Please share emergency contact details (Name, Address, and phone number)
                                            *
                                        </label>
                                        <input type="text" class="form-control" name="mobile_number" placeholder="Your Answer
" required id="number">
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">Add a reference letter (any letter from your professional circle, teachers, professors, or any person in some power who can vouch for you)
                                            *
                                        </label>
                                        <input type="file" class="form-control" name="mobile_number" placeholder="Your Answer
" required id="number">
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">Please share the contact details: full name, designation, phone and email ID of the person who has written the recommendation letter
                                            *
                                        </label>
                                        <input type="text" class="form-control" name="mobile_number" placeholder="Your Answer
" required id="number">
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">Occupation</label>
                                        <select class="form-control select2 form-select" name="gender" data-placeholder="Select Occupation">
                                            <option label="Select Gender">
                                            </option>
                                            <option value="1">School Student</option>
                                            <option value="2">College/university student</option>
                                            <option value="3">Working professional</option>
                                            <option value="3">Retired</option>
                                            <option value="3">Home maker</option>
                                            <option value="3">Personal business</option>
                                            <option value="3">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label fw-bold">Name of your school/ college/ institute/ company(Write NA if not applicable)
                                            *</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Your Answer" required>
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label fw-bold">Designation if working (Write NA if not applicable)
                                            *
                                        </label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Your Answer" required>
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label fw-bold">Languages known
                                            *</label>
                                        <select class="form-control select2 form-select" name="gender" data-placeholder="Select Languages">
                                            <option label="Select Gender">
                                            </option>
                                            <option value="1">English</option>
                                            <option value="2">Hindi</option>
                                            <option value="3">Other</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label fw-bold">Which kind of programs interests you?
                                            *
                                            *</label>
                                        <select class="form-control select2 form-select" name="gender" data-placeholder=" Your Answer">
                                            <option label="Select Gender">
                                            </option>
                                            <option value="1">Research and Documentation</option>
                                            <option value="2">Working with Communities and Children</option>
                                            <option value="3">Designing posters and pamphlets</option>
                                            <option value="3">Media related work/ Publishing articles</option>
                                            <option value="3">Initiating a campaign</option>
                                            <option value="3">Fundraising</option>
                                            <option value="3">Video editing, photography etc</option>
                                            <option value="3">Preparing professional PPT's/documents</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label fw-bold">What is the time commitment that you can offer with CRY?
                                            *</label>
                                        <select class="form-control select2 form-select" name="gender" data-placeholder=" Your Answer">
                                            <option label="Select Gender">
                                            </option>
                                            <option value="2">3 to 6 months</option>
                                            <option value="3">More then 6 months</option>
                                            <option value="3">More then 1 year</option>


                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label fw-bold">How did you came to know about CRY?
                                            *</label>
                                        <select class="form-control select2 form-select" name="gender" data-placeholder=" Your Answer">
                                            <option label="Select Gender">
                                            </option>
                                            <option value="2">CRY's website</option>
                                            <option value="3">Social media sites</option>
                                            <option value="3">Print Ads/ Hoardings</option>
                                            <option value="3">Friends/Family</option>
                                            <option value="3">CRY Volunteers/interns</option>
                                            <option value="3">CRY Staff</option>
                                            <option value="3">Online ads and posts</option>
                                            <option value="3">Other</option>


                                        </select>
                                    </div>
                                 
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label fw-bold">Please read the below 3 documents properly</label>

                                    </div>
                                    
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">CRY's Child Protection Policy:</label>
                                       
                                        <a href="https://drive.google.com/drive/folders/1OA4CvaYcoVowDUMYyUbmnMvwKKhhiVpt">https://drive.google.com/drive/folders/1OA4CvaYcoVowDUMYyUbmnMvwKKhhiVpt</a>

                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">Code of Conduct:</label>
                                        <a href="hhttps://docs.google.com/document/d/14G9qJjqgCFiapxChbbMRW2dsLPnK8WpVxyZo05qSWsk/edit?usp=sharing">https://docs.google.com/document/d/14G9qJjqgCFiapxChbbMRW2dsLPnK8WpVxyZo05qSWsk/edit?usp=sharing</a>

                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">Online sessions SOP:</label>
                                        <a href="https://drive.google.com/file/d/119ksoFAzQ7gE8uuvRol0EaCfjbwGL6sz/view?usp=sharing ">https://drive.google.com/file/d/119ksoFAzQ7gE8uuvRol0EaCfjbwGL6sz/view?usp=sharing </a>

                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                    <hr>
                                        <label class="form-label fw-bold">I have read through the documents pertaining to CRY’s child protection Policy, Code of conduct and online session SoPs and will adhere to the norms and guidelines (please put your full name as signature)</label>
                                        <input type="text" name="first_name" class="form-control" placeholder="Your Answer" required>

                                    </div>
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="form-label fw-bold">Date of submission
                                        </label>
                                        <input type="date" name="first_name" class="form-control" placeholder="Your Answer" required>

                                    </div>

                                </div>
                        </div>
                        <div class="container-login100-form-btn">
                            <button type="submit" name="" id="" class="login100-form-btn btn-warning">
                                Register
                            </button>
                        </div>
                        <!-- <div class="text-center pt-3">
                  <p class="text-dark mb-0">Already have account?<a href="login" class="text-warning ms-1">Sign In</a></p>
                </div> -->
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
    <!-- JQUERY JS -->
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
            lblError.html("Eligibility 18 years ONLY.")
            if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 18) {
                $('#dob').val('');
                return false;
            }

            if (dtCurrent.getFullYear() - dtDOB.getFullYear() == 18) {
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