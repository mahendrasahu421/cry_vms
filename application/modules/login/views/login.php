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
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon.png" />

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

    <style>
        .dt-buttons {
            display: none;
        }
    </style>
    <style>
        ul#menu li {
            display: inline;
        }

        .page-header {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            /* margin: 1.5rem 0rem 1.5rem; */
            margin-top: 5px;
            -ms-flex-wrap: wrap;
            justify-content: space-between;
            padding: 0;
            /* border-radius: 7px; */
            position: relative;
            min-height: 50px;
            border: 1px solid transparent;
            border-radius: 5px;
        }
    </style>

</head>

<body>
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
                    <div class="text-center">
                        <img src="<?php echo base_url('users/'); ?>assets/images/brand/ezgif.com-gif-maker.gif" class="" alt="">
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-0">
                        <div class="card-body">
                            <?php
                            if ($this->session->userdata('error')) {
                            ?>
                                <center>
                                    <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
                                        <strong>Error!</strong> <?php echo $this->session->userdata('error'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </center>
                            <?php $this->session->unset_userdata('error');
                            } ?>
                         
                            <form class="login100-form validate-form" action="#" method="post">
                                <span class="login100-form-title">
                                    Login
                                </span>
                                <div class="wrap-input100 validate-input" data-bs-validate="Valid email is required: ex@abc.xyz">
                                    <input class="input100" type="text" name="email" value="" placeholder="Email">

                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                    <input class="input100" type="password" name="password" value="" placeholder="Password">

                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="mb-0">
                                        <a href="reset-password" class="text-warning ms-1">Forgot Password?</a>
                                    </p>
                                </div>
                                <button class="btn btn-block btn-warning mb-4 rounded-pill" type="submit" name="signin" value="signin">Login</button>
                               
                            </form>

                        </div>
                        
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->
    <!--<footer>
<p class="text-center mt-3">Copyright 2020 All Rights Reserved | Developed By <a href="http://www.neuralinfo.in/" target="_blank">Neural Info Solutions Pvt. Ltd.</a></p>
</footer>-->
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
        $('#feel-the-wave').wavify({
            height: 100,
            bones: 3,
            amplitude: 90,
            color: 'rgba(146, 43, 33 , 4)',
            speed: .25
        });
        $('#feel-the-wave-two').wavify({
            height: 70,
            bones: 5,
            amplitude: 60,
            color: 'rgba(169, 50, 38 , .3)',
            speed: .35
        });
        $('#feel-the-wave-three').wavify({
            height: 50,
            bones: 4,
            amplitude: 50,
            color: 'rgba(192, 57, 43 , .2)',
            speed: .45
        });
    </script>
</body>

</html>