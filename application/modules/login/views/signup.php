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
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon-2.png" />

  <!-- TITLE -->
  <title>CRY : VMS</title>

  <!-- BOOTSTRAP CSS -->
  <link id="style" href="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

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
              <span class="login100-form-title"> Registration</span>
            </div>
            <div class="card-body">
              <form class="login100-form validate-form">

                <div class="row">
                  <div class="form-group col-md-6 mb-0">
                    <label class="form-label fw-bold"> First Name </label>
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                  </div>
                  <div class="form-group col-md-6 mb-0">
                    <label class="form-label fw-bold">Last Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
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
                    <select class="form-control select2 form-select" name="gender" data-placeholder="Select Gender">
                      <option label="Select Gender">
                      </option>
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                      <option value="3">Transgender</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6 mb-0">
                    <label class="form-label fw-bold">Enter Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group col-md-6 mb-0">
                    <label class="form-label fw-bold">Enter Mobile Number </label>
                    <input type="text" class="form-control" name="mobile_number" placeholder="Mobile number" required>
                  </div>

                  <div class="form-group col-md-6 mb-0">
                    <label class="form-label fw-bold"> country </label>
                    <select class="form-control select2-show-search" name="state" data-placeholder="">

                      <option value="Ahraura">india</option>
                    
                     
                    </select>
                  </div>
                  <div class="form-group col-md-6 mb-0">
                    <label class="form-label fw-bold"> State </label>
                    <select class="form-control select2-show-search" name="state" data-placeholder="">

                      <option value="Ahraura">Delhi</option>
                      <option value="Ajodhya">Lucknow</option>
                     
                    </select>
                  </div>
                  <div class="form-group col-md-6 mb-0">
                    <label class="form-label fw-bold">City</label>
                    <select class="form-control select2-show-search" name="city" data-placeholder="">
                      <option value="">Select City</option>
                      <option value="Achhnera">Achhnera</option>
                      <option value="Afzalgarh">Afzalgarh</option>
                      <option value="Agra">Agra</option>
                      <option value="Ahraura">Ahraura</option>
                      <option value="Ajodhya">Ajodhya</option>
                      <option value="Akbarpur">Akbarpur</option>
                      <option value="Aliganj">Aliganj</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6 mb-0">
                    <label class="form-label fw-bold">Occupation</label>
                    <select class="form-control select2-show-search" name="occupation" data-placeholder="">
                      <option selected> Select Occupation... </option>
                      <option>School student </option>
                      <option> College/university student</option>
                      <option> working professional </option>
                      <option> Retired</option>
                      <option>home maker</option>
                      <option>personal business </option>
                      <option> others</option>
                    </select>
                  </div>

                  <div class="form-group col-md-12 mb-0">
                    <label class="form-label fw-bold">Looking for</label>
                    <select id="single" class="form-control select2-show-search" name="looking_for" required>
                      <option selected>Select Type Of...</option>
                      <option value="Volunteering">Volunteering</option>
                      <option value="Internship">Internship</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12 mb-0 select-dropdown">
                    <label class="form-label fw-bold">Type Of Volunteering</label>
                    <select id="inputState" class="form-control select2 form-select" name="volunteering_type" required>
                      <option selected>Select Type Of...</option>
                      <option>Online</option>
                      <option>On-Ground Volunteering</option>
                    </select>
                  </div>

                  <div class="form-group col-md-12 mb-0 select-dropdown">
                    <label class="form-label fw-bold">Where did you get to know about this Opportunity</label>
                    <select class="form-control select2" name="where_know_opportunity" data-placeholder="" multiple>
                      <option value="CRY website">CRY website</option>
                      <option value="social media sites">social media sites </option>
                      <option value="hoardings"> hoardings </option>
                      <option value="Family/Friend"> Family/Friend</option>
                      <option value="CRY volunteers/interns"> CRY volunteers/interns</option>
                      <option value="CRY staff"> CRY staff </option>
                      <option value="Online ads and posts"> Online ads and posts </option>
                      <option>Others</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12 mb-0" id="select-dropdown1">

                    <label class="form-label fw-bold">Internship</label>
                    <select class="form-control select2" name="internship" data-placeholder="" multiple>
                      <option value="Designing posters">Designing posters </option>
                      <option value="documents">documents</option>
                      <option value="ppts">ppts</option>
                      <option value="etc">etc</option>
                      <option value="Video making">Video making</option>
                      <option value="Video editing">Video editing </option>
                      <option value="Content Writing & Editing">Content Writing & Editing</option>
                      <option value="Ms Excel">Ms Excel </option>
                      <option value="Research software (like SPSS, R etc)">Research software (like SPSS, R etc)</option>
                      <option value="Research software (like SPSS, R etc)">Research software (like SPSS, R etc) </option>
                      <option value="Research and documentation">Research and documentation</option>
                      <option value="Others">Others</option>
                    </select>
                    <div class="form-group">
                      <label class="form-label fw-bold">Upload Your CV</label>
                      <input class="form-control btn-warning" type="file" required name="Uploda_file">
                    </div>
                  </div>
                  <div class="col-lg-12 mb-0" id="textarea1">
                    <div class="">
                      <label class="form-label fw-bold">Mention past volunteering and Internships
                        you may have done?</label>
                      <textarea class="form-control mb-4" name="mention_past" required id="textarea1" placeholder="Mention past volunteering and Internships you may have done?" rows="3" maxlength="300"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-12 mb-0" id="textarea2">
                    <label class="form-label fw-bold">What you aim to value add on if chosen for an
                      Internship with CRY ?</label>
                    <div class="">
                      <textarea class="form-control mb-4" name="whatyou aim" required placeholder="What you aim to value add on if chosen for an Internship with CRY ?" rows="3" maxlength="300"></textarea>
                    </div>
                  </div>
                </div>


                <div class="container-login100-form-btn">
                  <a href="dashboard" class="login100-form-btn btn-warning">
                    Register
                  </a>
                </div>
                <div class="text-center pt-3">
                  <p class="text-dark mb-0">Already have account?<a href="login" class="text-warning ms-1">Sign In</a></p>
                </div>
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

  <!-- INTERNAL Data tables js-->
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/js/jszip.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/js/buttons.colVis.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/js/table-data.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/echarts/echarts.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/sidemenu/sidemenu.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/js/sticky.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/js/tooltip&popover.js"></script>
  <!-- <script src="<?php echo base_url('admin/'); ?>assets/plugins/select2/select2.full.min.js"></script> -->
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/sidebar/sidebar.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/p-scroll/pscroll.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/p-scroll/pscroll-1.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/wysiwyag/jquery.richtext.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/wysiwyag/wysiwyag.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/quill/quill.min.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/js/form-editor2.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/js/apexcharts.js"></script>
  <script src="<?php echo base_url('admin/'); ?>assets/js/index1.js"></script>
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


  <!-- INTERNAL jquery transfer js-->
  <script src="<?php echo base_url('admin/'); ?>assets/plugins/jQuerytransfer/jquery.transfer.js"></script>

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
  <script>
    $("document").ready(function() {
      $('.select-dropdown').hide();
      $('#select-dropdown1').hide();
      $('#textarea1').hide();
      $('#textarea2').hide();
      $('#single').change(function() {
        if ($('#single').val() == 'Volunteering') {

          $('.select-dropdown').show();
          $('#select-dropdown1').hide();
          $('#textarea1').hide();
          $('#textarea2').hide();

        } else if ($('#single').val() == 'Internship') {

          if (confirm(
              'In Internship we expect minimum of 5-6 hours of work daily through minimum of 4 weeks Are you sure you will like to apply? '
            )) {
            // Save it!
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


</body>

</html>