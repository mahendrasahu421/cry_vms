<!doctype html>
<html lang="en" dir="ltr">
<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon.png" />

    <!-- TITLE -->
    <title>CRY : VMS</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- STYLE CSS -->
    <link href="<?php echo base_url('admin/'); ?>assets/css/style.css" rel="stylesheet" />
	<!--- FONT-ICONS CSS -->
    <link href="<?php echo base_url('admin/'); ?>assets/css/icons.css" rel="stylesheet" />
    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('admin/'); ?>assets/colors/color1.css" />
</head>

<body>
    <div class="bg-warning">
        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="<?php echo base_url('admin/'); ?>assets/images/brand/ezgif.com-gif-maker.gif" class="" alt="">
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
                                        <a href="#" class="text-warning ms-1">Forgot Password?</a>
                                    </p>
                                </div>
                                <button class="btn btn-block btn-warning mb-4 rounded-pill" type="submit" name="signin" value="signin">Login</button>
                                <!--<div class="text-center pt-3">
                                    <p class="text-dark mb-0">Volunteer Login<a href="signup" class="text-warning ms-1"></a></p>
                                </div>-->
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
    <script src="<?php echo base_url('admin/'); ?>assets/js/jquery.min.js"></script>
</body>

</html>