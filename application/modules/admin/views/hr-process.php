<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">HR Proccess</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">HR Proccess</li>
                    </ol>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12 col-md-12 col-xl-12">
                    <div class="card">

                        <div class="col-md-12 " style="text-align: left;">
                            <div class="col-md-3" style="padding-left: 1%;">
                                <h4 style=" font-weight: 600;margin-top: 20px;">
                                    <?php echo $interuser['first_name'] . $interuser['last_name'] ?></h4>
                            </div>
                            <div class="col-md-9">
                                <?php if ($interuser['cv_file'] == NULL) { ?>
                                <span><a href="#">NA</a></span>
                                <?php } else { ?>
                                <span><a href="<?php echo base_url(); ?>uploads/<?php echo $interuser['cv_file']; ?>"
                                        target="_blank">View CV</a></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="ibox-content">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="tdhead">DOB </td>
                                            <td><?php echo date("d-m-Y", strtotime($interuser['date_of_birth'])); ?>
                                            </td>
                                            <td class="tdhead">State</td>
                                            <td><?php $state_id = $interuser['state_id'];
                                                $statei = $this->Crud_modal->fetch_single_data("state_name", "states", "state_id='$state_id'");
                                                echo $statei['state_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">Email</td>
                                            <td style="width: 25%"><?php echo $interuser['email']; ?></td>
                                            <td class="tdhead">City</td>
                                            <td><?php $city_id = $interuser['city_id'];
                                                $cityi = $this->Crud_modal->fetch_single_data("city_name", "cities", "city_id='$city_id'");
                                                echo $cityi['city_name']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">Skill</td>
                                            <?php
                                            if ($interuser['skill_id'] != '') {
                                                $skill_name = explode(',', $interuser['skill_id']);
                                                for ($i = 0; $i < sizeof($skill_name); $i++) {
                                                    $assig_name = $this->Crud_modal->fetch_single_data("(skill_name) as name", "skills", "skill_id='$skill_name[$i]'"); ?>
                                            <td><?php echo $assig_name['name'] . (($i + 1) < sizeof($skill_name) ? ", " : ""); ?>
                                            </td>
                                            <?php }
                                            } else { ?>
                                            <td style="width: 25%"><?php echo "NA"; ?></td>
                                            <?php }
                                            ?>

                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="hold-transition skin-blue sidebar-mini">
                <div>
                    <script type="text/javascript">
                    var a;
                    $('.demo4').click(function() {
                        a = $(this).parent().parent().attr('data-val');
                        swal({
                            title: "Are you sure?",
                            text: "Do you really want to logout!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            closeOnConfirm: false
                        });

                    });

                    $(".confirm").click(function() {
                        window.location = a;
                    });
                    </script>

                    <script type="text/javascript">
                    $('.submit').click(function() {
                        if ($('#oldpassword').val() == '') {
                            alert('Please enter old password');
                        } else if ($('#newpassword').val() == '') {
                            alert('Please enter new password');

                        } else if ($('#confirmnewpassword').val() == '') {
                            alert('Please enter confirm password');
                        } else {
                            //   alert("OK");
                            $.ajax({
                                method: "POST",
                                dataType: "json",
                                data: {
                                    "oldpassword": $('#oldpassword').val(),
                                    "newpassword": $('#newpassword').val(),
                                    "confirmnewpassword": $('#confirmnewpassword').val()
                                },
                                url: 'https://drycoder.com/employer-password-match',
                                success: function(res) {
                                    alert(res.message);
                                    if (res.status == 1) {
                                        window.location.reload();
                                    }
                                }
                            });
                        }
                    });
                    </script>
                    <style>
                    .skin-blue .wrapper,
                    .skin-blue .main-sidebar,
                    .skin-blue .left-side {
                        background-color: #f4f4f4;
                        webkit-box-shadow: none !important;
                        box-shadow: none !important;
                    }

                    .btn-info {
                        background-color: #009688;
                        border-color: #009688;
                    }

                    .btn-info:hover {
                        background-color: #009688;
                        border-color: #009688;
                    }

                    .btn-backout {
                        background-color: #F44336;
                        border-color: #F44336;
                        color: #fff;
                    }

                    .btn:hover {
                        color: #fff;
                        text-decoration: none;
                    }

                    .process-step .btn:focus {
                        outline: none
                    }

                    .process {
                        display: table;
                        width: 100%;
                        position: relative
                    }

                    .process-row {
                        display: table-row
                    }

                    .process-step button[disabled] {
                        opacity: 1 !important;
                        filter: alpha(opacity=100) !important
                    }

                    .process-row:before {
                        top: 40px;
                        bottom: 0;
                        position: absolute;
                        content: " ";
                        width: 76%;
                        height: 5px;
                        background-color: #ccc;
                        margin-left: 12%;
                    }

                    .process-step {
                        display: table-cell;
                        text-align: center;
                        position: relative
                    }

                    .process-step p {
                        margin-top: 4px
                    }

                    .btn-circle {
                        width: 80px;
                        height: 80px;
                        text-align: center;
                        font-size: 12px;
                        border-radius: 50%
                    }

                    select {
                        margin-top: 2%
                    }

                    .box {
                        color: #fff;
                        padding: 0px;
                        display: none;
                        margin-top: 20px;
                    }

                    .box {
                        position: relative;
                        border-radius: 3px;
                        background: #f4f4f4;
                        border-top: 0px solid #d2d6de;
                        /* margin-bottom: 20px; */
                        /* width: 100%; */
                        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
                    }

                    .input-group .form-control {
                        position: initial;
                        z-index: 2;
                        float: left;
                        width: 100%;
                        margin-bottom: 0;
                    }

                    .modal-dialog {
                        width: 27%;
                    }

                    .sweet-alert button {
                        background-color: #AEDEF4;
                        color: white;
                        border: none;
                        box-shadow: none;
                        font-size: 17px;
                        font-weight: 500;
                        -webkit-border-radius: 4px;
                        border-radius: 5px;
                        padding: 10px 32px;
                        margin: 26px 5px 0 5px;
                        cursor: pointer;
                    }

                    .sweet-alert button.cancel {
                        background-color: #D0D0D0;
                    }

                    .table>tbody+tbody {
                        border-top: 0px solid #ddd;
                    }

                    .table>tbody {
                        border-top: 0px solid #ddd;
                        font-size: 13px;
                    }

                    .table>thead {
                        font-size: 13px;
                    }

                    .add-btn {
                        border: 1px solid #fff;
                        border-radius: 1px solid;
                        border-radius: 4px;
                        color: #fff;
                        background-color: #2f4050;
                        height: 32px;
                        width: 32px;
                    }

                    .form-control,
                    .single-line {
                        font-size: 12px;
                        background-color: #FFFFFF;
                        background-image: none;
                        border: 1px solid #e5e6e7;
                        border-radius: 1px;
                        color: inherit;
                        display: block;
                        padding: 6px 12px;
                        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
                        width: 100%;
                    }

                    small,
                    small {
                        font-size: 12px;
                    }

                    /*@media (min-width: 768px)
   {
   .modal-dialog {
   width: 600px;
   margin: 10% auto;
   }
   }*/
                    .btn-info:hover {
                        background-color: #009688;
                        border-color: #009688;
                    }

                    .profile-content {
                        border-top: 1px solid #f4f4f4 !important;
                    }

                    .tdhead {
                        FONT-WEIGHT: 700;
                    }

                    .ibox-title {
                        -moz-border-bottom-colors: none;
                        -moz-border-left-colors: none;
                        -moz-border-right-colors: none;
                        -moz-border-top-colors: none;
                        background-color: #ffffff;
                        border-color: #e7eaec;
                        border-image: none;
                        border-style: solid solid none;
                        border-width: 2px 0 0;
                        color: inherit;
                        margin-bottom: 0;
                        padding: 9px 2px 7px;
                        min-height: 47px;
                    }

                    .main-sidebar {
                        height: 1100px;
                    }

                    .btn-default.disabled.focus,
                    .btn-default.disabled:focus,
                    .btn-default.disabled:hover,
                    .btn-default[disabled].focus,
                    .btn-default[disabled]:focus,
                    .btn-default[disabled]:hover,
                    fieldset[disabled] .btn-default.focus,
                    fieldset[disabled] .btn-default:focus,
                    fieldset[disabled] .btn-default:hover {
                        background-color: #5bc0de;
                        border-color: #ccc;
                    }

                    .table {
                        margin-bottom: 0px;
                    }
                    </style>
                    <!-- DataTables -->
                    <div class="">
                        <div class="content-wrapper" style="background-color:#f4f4f4; border:none;height: 1000px">
                            <div class="row">
                                <div class="col-lg-12">

                                    <?php $process_step_short = $interuser['status'];
                                    $process_step = $user_schedule['job_process_step']; ?>
                                    <div class="">
                                        <div class="process">
                                            <div class="process-row nav nav-tabs">
                                                <div class="process-step" style="width: 20%;">
                                                    <button type="button" class="btn btn-success btn-circle" disabled><i
                                                            class="fa fa-file fa-3x"></i></button>
                                                    <p><small><strong>Submission</strong></small>
                                                        <br> <small>Date:
                                                            <?php echo $interuser['creation_date']; ?></small>
                                                    </p>
                                                </div>
                                                <!-- ###########    submission div     ###########  -->
                                                <?php $intern_id = $interuser['intern_id']; ?>
                                                <?php
                                                if ($process_step_short[0] <= 1) {
                                                    $bnt_disable = '';
                                                    if ($process_step_short[0] == 0) {
                                                        $bnt_color = ($process_step_short[1] == 0 ? "btn-info" : "");
                                                        $bnt_disable = ($process_step_short[1] == 0 ? "" : "disabled");
                                                    } else {
                                                        $bnt_color = "btn-danger";
                                                        $bnt_disable = "disabled";
                                                    }
                                                } else {
                                                    $bnt_color = "btn-success";
                                                    $bnt_disable = "disabled";
                                                }
                                                ?>
                                                <div class="process-step" style="width: 20%;">
                                                    <button type="button"
                                                        class="btn btn-circle process_btn <?php echo $bnt_color ?>"><i
                                                            class="fa fa-check fa-3x"></i></button>
                                                    <p>
                                                        <small><strong>Shortlist</strong></small>
                                                        <?php $can = $this->Crud_modal->check_numrow("interns", "intern_id='$intern_id'");
                                                        $disabl = '';
                                                        if ($can > 0) {
                                                            $disabl = 'disabled';
                                                        }
                                                        ?>
                                                        <br>
                                                        <input type="radio" class="demo4 me-1" name="short_radio"
                                                            <?php echo ($interuser['status'][0] > 1 ? "checked=checked" : '');  ?>
                                                            value="Shortlisted">Shortlisted
                                                        <input type="radio" class="demo4 me-1" name="short_radio"
                                                            <?php echo ($interuser['status'][0] == 0 ? "checked=checked" : '');  ?>
                                                            value="Not Shortlisted">Not Shortlisted
                                                    </p>
                                                    <button class="btn btn-info shortlist_email" <?php echo ($interuser['status'][0] > 1 ? ($interuser['status'][0] > 1 ? 'disabled' : '') : '');
                                                                                                    echo $disabl; ?>
                                                        title="Email"><i class="fa fa-paper-plane"
                                                            aria-hidden="true"></i></button>
                                                </div>
                                                <!-- ############   End Shortlisted div     ################## -->
                                                <div class="process-step" style="width: 20%;">
                                                    <?php
                                                    if ($process_step[0] <= 3) {
                                                        $bnt_disable = '';
                                                        if ($process_step[0] == 3) {
                                                            $bnt_color = ($process_step[1] == 0 ? "btn-info" : "");
                                                            $bnt_disable = ($process_step[1] == 0 ? "" : "disabled");
                                                        } else {
                                                            $bnt_color = "btn-default";
                                                            $bnt_disable = "disabled";
                                                        }
                                                    } else {
                                                        $bnt_color = "btn-success";
                                                        $bnt_disable = "disabled";
                                                    }
                                                    ?>
                                                    <button type="button"
                                                        class="btn <?php echo $bnt_color ?> btn-circle process_btn"
                                                        <?php echo $bnt_disable ?>><i
                                                            class="fa fa-calendar fa-3x"></i></button>
                                                    <p>
                                                        <strong>Interview</strong>

                                                        <br>
                                                    </p>
                                                    <br>
                                                    <button class="btn btn-info interview_final_mail" title="Email"><i
                                                            class="fa fa-paper-plane" aria-hidden="true"></i></button>

                                                </div>
                                                <?php echo $intern_id = $interuser['intern_id']; 
                                                 $encoded_id = rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
                                                ?>
                                                <!-- ##################################################      Interview div     #####################################################  -->
                                                <div class="process-step" style="width: 20%;">
                                                    <?php
                                                    if ($process_step[0] <= 4) {
                                                        $bnt_disable = '';
                                                        if ($process_step[0] == 4) {
                                                            $bnt_color = ($process_step[1] == 0 ? "btn-info" : "");
                                                            $bnt_disable = ($process_step[1] == 0 ? "" : "disabled");
                                                        } else {
                                                            $bnt_color = "btn-default";
                                                            $bnt_disable = "disabled";
                                                        }
                                                    } else {
                                                        $bnt_color = "btn-success";
                                                        $bnt_disable = "disabled";
                                                    }
                                                    ?>
                                                    <button type="button"
                                                        class="btn <?php echo $bnt_color ?> btn-circle process_btn"
                                                        <?php echo $bnt_disable ?>><i
                                                            class="fa fa-file-text-o fa-3x"></i></button>
                                                    <p>
                                                        <strong>Offer Letter</strong>

                                                    </p>
                                                    <button class="btn btn-info mb-5 mt-5" data-toggle="modal"
                                                        data-target="#exampleModal">Update Offer</button>
                                                    <button class="btn btn-info mb-5 mt-5" data-toggle="modal"
                                                        data-target="#exampleModaleditor">Edit Offer</button>

                                                </div>
                                                <!-- ##################################################      Placed  div     #####################################################  -->
                                                <div class="process-step">
                                                    <?php
                                                    if ($process_step[0] <= 5) {
                                                        $bnt_disable = '';
                                                        if ($process_step[0] == 5) {
                                                            $bnt_color = ($process_step[1] == 0 ? "btn-info" : "");
                                                            $bnt_disable = ($process_step[1] == 0 ? "" : "disabled");
                                                        } else {
                                                            $bnt_color = "btn-default";
                                                            $bnt_disable = "disabled";
                                                        }
                                                    } else {
                                                        $bnt_color = "btn-success";
                                                        $bnt_disable = "disabled";
                                                    }
                                                    $bnt_addtion_disable = '';
                                                    if ($process_step[0] < 5) {
                                                        $bnt_addtion_disable = "disabled";
                                                    }


                                                    ?>
                                                    <button type="button"
                                                        class="btn <?php echo $bnt_color ?> btn-circle"
                                                        <?php echo $bnt_disable ?>><i
                                                            class="fa fa-industry fa-3x"></i></button>
                                                    <p>
                                                        <strong>Placed</strong>
                                                    </p>
                                                    <input type="radio" name="Join_radio" value="Join">Join
                                                    <input type="radio" name="Join_radio" value="Not Join">Not Join
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>

                                        <div class="modal" role="dialog" id="exampleModal">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title">Generate Offer Letter</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="update_offer_latter" method="post">
                                                            <div class="modal-body">
                                                                <div class="col-md-12">
                                                                    <label class="form-label"> Joining
                                                                        Date</label>
                                                                    <input type="date" class="form-control"
                                                                        value="<?php echo $interuser['creation_date']; ?>"
                                                                        id="offerLatter_update_date"
                                                                        name="offerLatter_update_date" />
                                                                </div>
                                                                <input type="hidden"
                                                                    value="<?php echo $interuser['intern_id']; ?>"
                                                                    id="internship_id" name="intern_id" />
                                                                <div class="col-md-12">
                                                                    <label class="form-label"> Interns
                                                                        Type</label>
                                                                    <select class="form-select" id="internshipType"
                                                                        name="internshipType" id="validationCustom04"
                                                                        required>

                                                                        <option value="1" <?php if ($interuser['vol_type_id'] == 1) {
                                                                                                echo  "selected";
                                                                                            } ?>>
                                                                            Online
                                                                        </option>
                                                                        <option value="2" <?php if ($interuser['vol_type_id'] == 2) {
                                                                                                echo  "selected";
                                                                                            } ?>>
                                                                            Offline
                                                                        </option>
                                                                        <option value="3" <?php if ($interuser['vol_type_id'] == 3) {
                                                                                                echo  "selected";
                                                                                            } ?>>
                                                                            Hybrid
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label"> Duration</label>
                                                                    <select class="form-select" name="durations"
                                                                        id="internship_durations" required>

                                                                        <?php for ($i = 4; $i <= 12; $i++) { ?>
                                                                        <option value="<?php echo $i; ?>"
                                                                            <?php echo $i == $interuser['internshipDeruation'] ? 'selected' : ''; ?>>
                                                                            <?php echo $i . " Weeks"; ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" id="update_offer_letter"
                                                                    class="btn btn-primary">Save &
                                                                    Next</button>
                                                                <button type="button" class="btn btn-secondary "
                                                                    id="saveDa" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                        $(document).ready(function() {
                                            $('#update_offer_letter').click(function() {
                                                var intern_id = $('#internship_id').val();
                                                var offerLatter_update_date = $(
                                                    '#offerLatter_update_date').val();
                                                var internshipType = $('#internshipType').val();
                                                var internship_durations = $(
                                                        '#internship_durations')
                                                    .val();
                                                datastr = {
                                                    intern_id: intern_id,
                                                    offerLatter_update_date: offerLatter_update_date,
                                                    internshipType: internshipType,
                                                    internship_durations: internship_durations,
                                                };
                                                jQuery.ajax({
                                                    url: '<?php echo base_url(); ?>update_offer_latter',
                                                    type: 'post',
                                                    data: datastr,
                                                    success: function(response) {
                                                        if (response == 1) {
                                                            $('#saveDa').trigger('click');
                                                            location.reload();
                                                        }
                                                    }
                                                });
                                            });
                                        });
                                        </script>
                                        <script>
                                        $(document).ready(function() {
                                            $('#saveOfferLatter').click(function() {
                                                let emialcontent = $('#emialcontent').val();
                                                if (emialcontent != null) {
                                                    //alert(emialcontent);
                                                    $('#emailContentValue').val(emialcontent);

                                                } else {

                                                }
                                            })

                                        });
                                        </script>

                                        <div class="modal" role="dialog" id="exampleModaleditor">
                                            <div class="modal-dialog" role="document">
                                                <form action="offer_lattersend_orientation_emails" method="">

                                                    <div class="modal-content modal-lg">
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title">Generate Offer Letter</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <div class="modal-body">
                                                                    <div class="col-md-12">
                                                                        <label class="form-label"> Offer Letter</label>
                                                                        <input type="hidden"
                                                                            value="<?php echo $interuser['email']; ?> "
                                                                            id="intern_email">
                                                                        <input type="hidden"
                                                                            value="<?php echo $interuser['intern_id']; ?> "
                                                                            id="intern_id">
                                                                        <div class="col-md-12 mt-3"><textarea
                                                                                class="content" id="emialcontent"
                                                                                name="example"><?php echo $final_offerdata; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-warning">
                                                                <a href="<?php echo base_url()?>view_offer_letter/<?php echo $encoded_id;?>"
                                                                    target="_blank">Preview </a>
                                                            </button>
                                                            <button type="button" id="saveOfferLatter"
                                                                class="btn btn-secondary" data-dismiss="modal">Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <script>
                                        $('#saveOfferLatter').click(function() {
                                            var intern_id = $('#intern_id').val();
                                            var intern_email = $('#intern_email').val();
                                            var emialcontent = $('#emialcontent').val();
                                            //alert(emialcontent);

                                            datastr = {
                                                intern_id: intern_id,
                                                intern_email: intern_email,
                                                emialcontent: emialcontent
                                            };

                                            $.ajax({
                                                url: '<?php echo base_url() ?>offer_lattersend_orientation_emails',
                                                type: 'post',
                                                data: datastr,
                                                success: function(response) {
                                                    alert('Update Success');
                                                    // $('#success_msg').html(
                                                    //     'Orientation Mail Sent Successfully');

                                                }
                                            });

                                        });
                                        </script>
                                        <div class="row row-sm">
                                            <div class="col-lg-12 card">

                                                <div class="">
                                                    <div class="table-responsive ">
                                                        <table id="example" class="display" cellspacing="0"
                                                            width="100%">
                                                            <thead>
                                                                <tr style="color: #fff;">
                                                                    <th style=" background: #f7b731;"> </th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731; color:#000;">
                                                                        Schedule</th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731; color:#000;">Save &
                                                                        send mail</th>
                                                                </tr>
                                                                <tr class="bg-gray-light">
                                                                    <th style="color:#000">Round</th>
                                                                    <th style="color:#000">Mode</th>
                                                                    <th style="color:#000">Date</th>
                                                                    <th style="color:#000">Time</th>
                                                                    <th style="color:#000">Venue</th>
                                                                    <th style="color:#000">Description</th>
                                                                    <th style="color:#000">Status</th>
                                                                    <th style="color:#000">Comment</th>
                                                                    <th class="w-15" style="color:#000">Save & send mail
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tdd">
                                                                <?php if (empty($user_schedule)) {  ?>
                                                                <tr>
                                                                    <td
                                                                        style="color:#000; line-height: 32px;font-weight: 600;">
                                                                        R1</td>
                                                                    <td style="line-height: 32px;">
                                                                        <select style="color:#000; margin-top: 1%"
                                                                            class="form-control mode">
                                                                            <option value="">Select mode</option>
                                                                            <option value="On Call">On Call</option>
                                                                            <option value="Face to Face">Face to Face
                                                                            </option>
                                                                            <option value="Video Call">Video Call
                                                                            </option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" data-role="date"
                                                                            style="color:#000" name="schedule_date"
                                                                            class="form-control dob_cafc_interview schedule_date"
                                                                            value="" placeholder="MM/DD/YYYY"
                                                                            id="newid">
                                                                        <span style="display:none;color:red"
                                                                            class="schedule_error">15 or more the 15
                                                                            interview
                                                                            are Schedule.</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group clockpicker"
                                                                            data-autoclose="true" style="color:#000;">
                                                                            <input type="text"
                                                                                class="form-control schedule_time"
                                                                                placeholder="09:30"
                                                                                name="schedule_time">
                                                                            <!--  <span class="input-group-addon"><span class="fa fa-clock-o"></span></span> -->
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <textarea style="color:#000;" name="venue"
                                                                            class="form-control venue"
                                                                            placeholder="Venue"
                                                                            disabled>  <?php echo "City: " . $cityi['city_name'] . "   State: " . $statei['state_name'] ?></textarea>
                                                                    </td>
                                                                    <td>
                                                                        <textarea name="hr_description"
                                                                            class="form-control hr_description"
                                                                            placeholder="Decription"> </textarea>
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>
                                                                        <button class="btn btn-info save_schedule"
                                                                            type="button" title="Save"><i
                                                                                class="fa fa-paste"></i> </button>
                                                                        <button class="btn btn-info mail_schedule"
                                                                            type="button" title="Email"><i
                                                                                class="fa fa-paper-plane"
                                                                                aria-hidden="true"></i></button>
                                                                        <style>
                                                                        .reject {
                                                                            margin-left: 70%;
                                                                            margin-top: -50%;
                                                                        }
                                                                        </style>

                                                                    </td>

                                                                </tr>
                                                                <?php } else {
                                                                    $i = 1;
                                                                    foreach ($user_schedule as $u_schedule) { ?>
                                                                <tr>
                                                                    <td style="line-height: 32px;font-weight: 600;">
                                                                        R<?php echo $i++; ?></td>
                                                                    <td style="line-height: 32px;">
                                                                        <select style="color:#000; margin-top: 1%"
                                                                            class="form-control mode"
                                                                            <?php echo ($u_schedule['mode'] != "" ? "disabled" : '') ?>>
                                                                            <option value="">Select mode</option>
                                                                            <option value="On Call"
                                                                                <?php echo ($u_schedule['mode'] == "On Call" ? "selected=selected" : '') ?>>
                                                                                On Call</option>
                                                                            <option value="Face to Face"
                                                                                <?php echo ($u_schedule['mode'] == "Face to Face" ? "selected=selected" : '') ?>>
                                                                                Face to Face</option>
                                                                            <option value="Video Call"
                                                                                <?php echo ($u_schedule['mode'] == "Video Call" ? "selected=selected" : '') ?>>
                                                                                Video Call</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" data-role="date"
                                                                            style="color:#000" name="schedule_date"
                                                                            <?php echo ($u_schedule['schedule_date_time'] != "0000-00-00 00:00:00" ? "disabled" : '') ?>
                                                                            class="form-control dob_cafc_interview schedule_date"
                                                                            value="<?php if ($u_schedule['schedule_date_time'] != "0000-00-00 00:00:00") {
                                                                                                                                                                                                                                                                                                                            echo date("m/d/Y", strtotime($u_schedule['schedule_date_time']));
                                                                                                                                                                                                                                                                                                                        } ?>"
                                                                            placeholder="MM/DD/YYYY">
                                                                        <span style="display:none;color:red"
                                                                            class="erorr">Date must be greater then
                                                                            previous schedule date</span>
                                                                        <span style="display:none;color:red"
                                                                            class="schedule_error"></span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group clockpicker"
                                                                            data-autoclose="true" style="color:#000;">
                                                                            <input type="text"
                                                                                class="form-control schedule_time"
                                                                                placeholder="09:30" name="schedule_time"
                                                                                <?php echo ($u_schedule['schedule_date_time'] != "0000-00-00 00:00:00" ? "disabled" : '') ?>
                                                                                value="<?php if ($u_schedule['schedule_date_time'] != "0000-00-00 00:00:00") {
                                                                                                                                                                                                                                                                                            echo date("H:i", strtotime($u_schedule['schedule_date_time']));
                                                                                                                                                                                                                                                                                        } ?>">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <textarea style="color:#000;" name="venue"
                                                                            class="form-control venue"
                                                                            placeholder="Venue"
                                                                            disabled><?php if ($u_schedule['venue'] == '') {
                                                                                                                                                                                        echo "City: " . $cityi['city_name'] . "State: " . $statei['state_name'];
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo $u_schedule['venue'];
                                                                                                                                                                                    }
                                                                                                                                                                                    ?></textarea>
                                                                    </td>
                                                                    <td>

                                                                        <textarea name="hr_description"
                                                                            class="form-control hr_description"
                                                                            placeholder="Decription"
                                                                            <?php echo ($u_schedule['schedule_date_time'] != "0000-00-00 00:00:00" ? "disabled" : '') ?>><?php echo $u_schedule['hr_description'] ?> </textarea>

                                                                    </td>
                                                                    <td>

                                                                        <?php if ($u_schedule['schedule_date_time'] != '0000-00-00 00:00:00') {
                                                                                    $button_disable = '';
                                                                                    if (sizeof($user_schedule) == ($i - 1)) {
                                                                                        if ($process_step[0] > 4) {
                                                                                            $button_disable = "disabled";
                                                                                        }
                                                                                    } else {
                                                                                        $button_disable = "disabled";
                                                                                    }
                                                                                ?>
                                                                        <select style="color:#000;"
                                                                            class="form-control interview_status"
                                                                            name="interview_status"
                                                                            <?php echo $button_disable ?>>
                                                                            <option value="">Select status</option>
                                                                            <?php foreach ($step_name as $step) {
                                                                                            $sel = '';
                                                                                            if ($u_schedule['round_status'] == $step['step_id']) {
                                                                                                $sel = "selected=selected";
                                                                                            }
                                                                                        ?>
                                                                            <option
                                                                                value="<?php echo $step['step_id'] ?>"
                                                                                <?php echo $sel ?>>
                                                                                <?php echo $step['step_name'] ?>
                                                                            </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($u_schedule['schedule_date_time'] != '0000-00-00 00:00:00') { ?>
                                                                        <textarea class="form-control comment"
                                                                            <?php echo $button_disable ?>><?php echo $u_schedule['comment'] ?></textarea>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php $save_mail_button = '';

                                                                                if (sizeof($user_schedule) == ($i - 1)) {
                                                                                    if ($process_step[0] == 3) {
                                                                                        $save_mail_button = "";
                                                                                    }
                                                                                } else {
                                                                                    $save_mail_button = "disabled";
                                                                                } ?>
                                                                        <input type="hidden"
                                                                            value="<?php echo $u_schedule['schedule_id'] ?>">

                                                                        <button
                                                                            class="btn btn-info <?php echo ($u_schedule['schedule_date_time'] == '0000-00-00 00:00:00' ? "save_schedule" : "save_btn_action") ?> "
                                                                            title="Save" data-action=""
                                                                            <?php echo $save_mail_button;
                                                                                                                                                                                                                                                            echo ($process_step[0] > 4 ? "disabled" : '') ?>><i
                                                                                class="fa fa-paste"></i> </button>
                                                                        <?php
                                                                                $resudule_data_aciton = '';
                                                                                $disabl_mail = '';
                                                                                if ($u_schedule['round_status'] == 0 && $u_schedule['comment'] != '') {
                                                                                    $resudule_data_aciton = 'interview_reschedule_mail';
                                                                                } else {
                                                                                    $disabl_mail = 'disabled';
                                                                                }
                                                                                ?>
                                                                        <button class="btn btn-info mail_btn_action"
                                                                            data-action="<?php echo $resudule_data_aciton ?>"
                                                                            title="Email"
                                                                            <?php echo $save_mail_button . ' ' . ($process_step[0] > 4 ? "disabled" : ''); //echo $disabl_mail;  
                                                                                                                                                                                                ?>><i
                                                                                class="fa fa-paper-plane"
                                                                                aria-hidden="true"></i></button>
                                                                    </td>
                                                                    <td>
                                                                        <!-- <input type="button" class="add-row add-btn" value="+"> -->
                                                                    </td>
                                                                </tr>
                                                                <?php   }
                                                                } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Model for sortlisted   -->
                        <div id="myModal" class="modal fade" role="dialog" data-backdrop="static">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5>Shortlisted</h5>
                                        <button type="button" class="close cancel_short pull-right"
                                            data-bs-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <h2>Are you sure?</h2>
                                        <p style="display: block;">You want to shortlist.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="text-center confirm" id="confirm_short"><button type="button"
                                                class="btn btn-primary fs-14" data-bs-dismiss="modal">Yes</button></div>
                                        <div class="text-center cancel_short"><button type="button"
                                                class="btn btn-default fs-14" data-bs-dismiss="modal">NO</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Model for not sortlisted   -->
                        <div id="myModal1" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5>Not Shortlisted</h5>
                                        <button type="button" class="close cancel_short"
                                            data-bs-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <h2>Are you sure?</h2>
                                        <p style="display: block;">You want to reject it.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="text-center confirm" id="confirm_reject"><button type="button"
                                                class="btn btn-primary fs-14" data-bs-dismiss="modal">Yes</button></div>
                                        <div class="text-center cancel_short"><button type="button"
                                                class="btn btn-default fs-14" data-bs-dismiss="modal">NO</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end  new popup -->

                    <!-- <script>
                        var $j = $.noConflict(true);
                        $j('.clockpicker').clockpicker();
                    </script> -->
                    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    <script type="text/javascript">
                    var date = $.noConflict(true);
                    date(".dob_cafc_interview").datepicker({
                        minDate: 0
                    });

                    // next button toltip close and prev
                    date(document).on('mouseleave', '.ui-datepicker-header', function() {
                        $(".ui-tooltip").css("display", "none");
                    });

                    date('.schedule_date').change(function() {
                        var date_picker_object = date(this);
                        var date_value = date_picker_object.val();
                        $.ajax({
                            type: "post",
                            url: " <?php echo base_url(); ?>get_same_day_schedule_user_count",
                            data: {
                                date_value: date_value
                            },
                            success: function(datas) {
                                date_picker_object.parents('tr').find('.schedule_error').text(
                                    "Schedule interview" + datas).fadeIn().fadeOut(8000);
                            },
                            error: function() {
                                alert("Something went wrong");
                            }
                        });
                    });
                    </script>

                    <script type="text/javascript">
                    // conformation of shortlist is cancel 
                    $(".cancel_short").click(function() {
                        $("input[name=short_radio]").each(function() {
                            $(this).removeAttr("checked");
                        });
                    });
                    // conformation of shortlist is confirm
                    $("#confirm_short").click(function() {
                        $.post("<?php echo base_url(); ?>shortlist_status_update", {
                            intern_id: "<?php echo $interuser['intern_id'] ?>",
                            status: 2
                        }, function(data) {
                            if (data == false) {
                                alert("Something went wrong");
                            } else {
                                window.location.reload();
                            }
                            $('#myModal').modal('hide');
                        }).fail(function(data) {
                            $('#myModal').modal('hide');
                            alert("Something went wrong");

                        });
                    });
                    $("#confirm_reject").click(function() {
                        $.post("<?php echo base_url(); ?>shortlist_status_update", {
                            intern_id: "<?php echo $interuser['intern_id'] ?>",
                            status: 0
                        }, function(data) {
                            if (data == false) {
                                alert("Something went wrong");
                            } else {
                                window.location.reload();
                            }
                        }).fail(function() {
                            $('#myModal1').modal('hide');
                            alert("Something went wrong");
                        });
                    });
                    // select mode in 
                    $(document).on('change', ".mode", function() {
                        if ($(this).val() == "Face to Face") {
                            $(this).parents('tr').find(".venue").removeAttr("disabled");
                        } else {
                            $(this).parents('tr').find(".venue").attr("disabled", "disabled");
                        }
                    });
                    // save schedule data in database
                    $(document).on("click", ".save_schedule", function() {
                        var parentid = $(this).parents("tr");
                        var mode_id = parentid.find(".mode");
                        var mode = parentid.find(".mode").val();
                        var schedule_date_id = parentid.find(".schedule_date");
                        var schedule_date = parentid.find(".schedule_date").val();
                        var schedule_time_id = parentid.find(".schedule_time");
                        var schedule_time = parentid.find(".schedule_time").val();
                        var venue_id = parentid.find(".venue");
                        var hr_description_id = parentid.find(".hr_description");
                        var hr_description = parentid.find(".hr_description").val();
                        var venue = parentid.find(".venue").val();
                        var schedule_id = $(this).prev().val();
                        var round = "0";
                        round = parseInt(round);
                        var previous_date_value = $(this).parents("tr").prev("tr").find(".schedule_date").val();
                        if (mode == '') {
                            mode_id.focus();
                            mode_id.css("border-color", "red");
                        }
                        if (schedule_date == '') {
                            schedule_date_id.css("border-color", "red");
                        }
                        if (schedule_time == '') {
                            schedule_time_id.css("border-color", "red");
                        }
                        if (hr_description == '') {
                            hr_description_id.css("border-color", "red");
                        }
                        var attr = venue_id.attr('disabled');
                        var venue_cout = 0;
                        if (typeof attr === typeof undefined) {
                            if (venue == '') {
                                venue_id.css("border-color", "red");
                                venue_cout = 1;
                            }
                        }
                        var date1 = Date.parse(schedule_date);
                        var date2 = Date.parse(previous_date_value);
                        if (date1 <= date2) {
                            parentid.find('.erorr').fadeIn().fadeOut(8000);
                            schedule_date_id.css("border-color", "red");
                            hr_description_id.css("border-color", "red");
                            venue_cout = 1;
                            return false;
                        }
                        var con = confirm("Are you want to schedule the interview");
                        if (con) {
                            if (mode != '' && schedule_date != '' && schedule_time != '' && hr_description !=
                                '' && venue_cout == 0) {
                                //alert('hello');
                                $.ajax({
                                    method: "post",
                                    url: "<?php echo base_url(); ?>save_interview_schedule_data",
                                    data: {
                                        'mode': mode,
                                        'schedule_date': schedule_date,
                                        'schedule_time': schedule_time,
                                        'venue': venue,
                                        'hr_description': hr_description,
                                        'round': round + 1,
                                        'intern_id': <?php echo $interuser['intern_id'] ?>,
                                        'schedule_id': schedule_id
                                    },
                                    success: function(datas) {
                                        window.location.reload();

                                    },
                                    error: function() {
                                        alert("Something went wrong");
                                    }
                                })
                            }
                        }

                    });
                    // interview status 
                    $(document).on("change", ".interview_status", function() {
                        //console.log($(this).val());
                        var mode_object = $(this).parents("tr").find(".mode");
                        $(this).parents("tr").find(".comment").val('');
                        var schedule_date_object = $(this).parents("tr").find(".schedule_date");
                        var schedule_time_object = $(this).parents("tr").find(".schedule_time");
                        var venue_object = $(this).parents("tr").find(".venue");
                        var hr_description_object = $(this).parents("tr").find(".hr_description");
                        var save_btn_action_object = $(this).parents("tr").find(".save_btn_action");
                        var mail_btn_action_object = $(this).parents("tr").find(".mail_btn_action");
                        switch ($(this).val()) {
                            case '':
                                disable_round_details(mode_object, schedule_date_object, schedule_time_object,
                                    venue_object, hr_description_object);
                                save_btn_action_object.attr("data-action", "");
                                mail_btn_action_object.attr("data-action", "");
                                break;
                            case '1':
                                disable_round_details(mode_object, schedule_date_object, schedule_time_object,
                                    venue_object, hr_description_object);
                                save_btn_action_object.attr("data-action", "interview_clear");
                                mail_btn_action_object.attr("data-action", "interview_clear_mail");
                                break;
                            case '2':
                                disable_round_details(mode_object, schedule_date_object, schedule_time_object,
                                    venue_object, hr_description_object);
                                save_btn_action_object.attr("data-action", "interview_ongoing");
                                mail_btn_action_object.attr("data-action", "interview_ongoing_mail");
                                break;
                            case '3':
                                disable_round_details(mode_object, schedule_date_object, schedule_time_object,
                                    venue_object, hr_description_object);
                                save_btn_action_object.attr("data-action", "interview_rejected");
                                mail_btn_action_object.attr("data-action", "interview_rejected_mail");
                                break;
                            case '4':
                                mode_object.removeAttr("disabled");
                                schedule_date_object.removeAttr("disabled");
                                schedule_time_object.removeAttr("disabled");
                                if (mode_object.val() == "Face to Face") {
                                    venue_object.removeAttr("disabled");
                                }
                                save_btn_action_object.attr("data-action", "interview_reschedule");
                                mail_btn_action_object.attr("data-action", "interview_reschedule_mail");
                                break;

                        }
                    });

                    function disable_round_details(mode_object, schedule_date_object, schedule_time_object,
                        venue_object, hr_description_object) {
                        mode_object.attr("disabled", true);
                        schedule_date_object.attr("disabled", true);
                        schedule_time_object.attr("disabled", true);
                        venue_object.attr("disabled", true);
                    }
                    // action on interview status button 
                    $(document).on("click", ".save_btn_action", function() {
                        var interview_status_object = $(this).parents("tr").find(".interview_status");
                        var comment_object = $(this).parents("tr").find(".comment");
                        interview_status_object.css("border-color", "#ccc");
                        comment_object.css("border-color", "#ccc");
                        var schedule_id = $(this).prev().val();
                        switch ($(this).attr("data-action")) {
                            case '':
                                interview_status_object.focus();
                                interview_status_object.css("border-color", "red");
                                break;
                            case 'interview_clear':

                                if (comment_object.val() != '') {
                                    var in_data = {
                                        "comment": comment_object.val(),
                                        "status": interview_status_object.val(),
                                        "schedule_id": schedule_id
                                    };
                                    var link = '<?php echo base_url(); ?>clear_interview';
                                    ajax_function(in_data, link);
                                } else {
                                    comment_object.focus();
                                    comment_object.css("border-color", "red");
                                    return false;
                                }
                                break;
                            case 'interview_ongoing':
                                if (comment_object.val() != '') {
                                    var round = "0";
                                    round = parseInt(round);
                                    var in_data = {
                                        "comment": comment_object.val(),
                                        "status": interview_status_object.val(),
                                        "schedule_id": schedule_id,
                                        'intern_id': <?php echo $interuser['intern_id'] ?>,
                                        'round': round + 1
                                    };
                                    var link = '<?php echo base_url(); ?>ongoing_interview';
                                    ajax_function(in_data, link);
                                } else {
                                    comment_object.focus();
                                    comment_object.css("border-color", "red");
                                    return false;
                                }
                                break;
                            case 'interview_rejected':
                                if (comment_object.val() != '') {
                                    var in_data = {
                                        "comment": comment_object.val(),
                                        "status": interview_status_object.val(),
                                        "schedule_id": schedule_id
                                    };
                                    var link = '<?php echo base_url(); ?>reject_interview';
                                    ajax_function(in_data, link);
                                } else {
                                    comment_object.focus();
                                    comment_object.css("border-color", "red");
                                    return false;
                                }
                                break;
                            case 'interview_reschedule':
                                if (comment_object.val() != '') {
                                    var parentid = $(this).parents("tr");
                                    var mode_id = parentid.find(".mode");
                                    var mode = parentid.find(".mode").val();
                                    var schedule_date_id = parentid.find(".schedule_date");
                                    var schedule_date = parentid.find(".schedule_date").val();
                                    var schedule_time_id = parentid.find(".schedule_time");
                                    var schedule_time = parentid.find(".schedule_time").val();
                                    var venue_id = parentid.find(".venue");
                                    var comments = parentid.find(".comment").val();
                                    var venue = parentid.find(".venue").val();
                                    var schedule_id = $(this).prev().val();
                                    var round = "0";
                                    round = parseInt(round);
                                    var previous_date_value = $(this).parents("tr").prev("tr").find(
                                        ".schedule_date").val();
                                    if (mode == '') {
                                        mode_id.focus();
                                        mode_id.css("border-color", "red");
                                    }
                                    if (schedule_date == '') {
                                        schedule_date_id.css("border-color", "red");
                                    }
                                    if (schedule_time == '') {
                                        schedule_time_id.css("border-color", "red");
                                    }
                                    var attr = venue_id.attr('disabled');
                                    var venue_cout = 0;
                                    if (typeof attr === typeof undefined) {
                                        if (venue == '') {
                                            venue_id.css("border-color", "red");
                                            venue_cout = 1;
                                        }
                                    }
                                    var date1 = Date.parse(schedule_date);
                                    var date2 = Date.parse(previous_date_value);
                                    if (date1 <= date2) {
                                        parentid.find('.erorr').fadeIn().fadeOut(8000);
                                        schedule_date_id.css("border-color", "red");
                                        venue_cout = 1;
                                        return false;
                                    }
                                    if (mode != '' && schedule_date != '' && schedule_time != '' &&
                                        venue_cout == 0) {
                                        var in_data = {
                                            'mode': mode,
                                            'schedule_date': schedule_date,
                                            'schedule_time': schedule_time,
                                            'venue': venue,
                                            'round': round + 1,
                                            'intern_id': <?php echo $interuser['intern_id'] ?>,
                                            'schedule_id': schedule_id,
                                            'comment': comments
                                        };
                                        var link =
                                            '<?php echo base_url(); ?>update_job_schedule_data';
                                        ajax_function(in_data, link);
                                    }
                                } else {
                                    comment_object.focus();
                                    comment_object.css("border-color", "red");
                                    return false;
                                }
                                break;

                        }
                    });

                    function ajax_function(in_data, link) {
                        var con = confirm("Are you want to schedule the interview");
                        if (con) {
                            $.ajax({
                                method: "post",
                                url: link,
                                data: in_data,
                                success: function(datas) {
                                    if (datas) {
                                        window.location.reload();
                                    } else {
                                        alert("fail");
                                    }
                                },
                                error: function() {
                                    alert("Something went wrong");
                                }
                            });
                        }
                    }
                    // mail send functionality
                    $(document).on("click", ".mail_btn_action", function(event) {
                        var parentid = $(this).parents("tr");
                        if (parentid.find(".interview_status").val() != 1 && parentid.find(".interview_status")
                            .val() != 3) {
                            var mode_id = parentid.find(".mode");
                            var attr = mode_id.attr('disabled');
                            if (typeof attr !== typeof undefined && attr !== false) {
                                var mode = parentid.find(".mode").val();
                                var schedule_date_id = parentid.find(".schedule_date");
                                var schedule_date = parentid.find(".schedule_date").val();
                                var schedule_time_id = parentid.find(".schedule_time");
                                var schedule_time = parentid.find(".schedule_time").val();
                                var venue_id = parentid.find(".venue");
                                var venue = parentid.find(".venue").val();
                                var schedule_id = $(this).prev().prev().val();
                                var round = "0";
                                round = parseInt(round);
                                var previous_date_value = $(this).parents("tr").prev("tr").find(
                                    ".schedule_date").val();
                                var data_action = $(this).attr("data-action");
                                var con = confirm("Are you want to mail");
                                if (con) {
                                    $.ajax({
                                        method: "post",
                                        url: "<?php echo base_url(); ?>mail_interview_data",
                                        data: {
                                            'mode': mode,
                                            'schedule_date': schedule_date,
                                            'schedule_time': schedule_time,
                                            'venue': venue,
                                            'round': round + 1,
                                            'intern_id': <?php echo $interuser['intern_id'] ?>,
                                            'schedule_id': schedule_id,
                                            "data_action": data_action
                                        },
                                        success: function(datas) {
                                            if (datas) {
                                                alert("Mail send");
                                            } else {
                                                alert("Something went wrong");
                                            }
                                        },
                                        error: function() {
                                            alert("Something went wrong");
                                        }
                                    });
                                }
                            } else {
                                alert("Please save the schedule and then send mail");
                            }
                        } else {
                            alert("Error in status");
                        }
                    });

                    // send offer letter to user  
                    $(document).on("click", ".send_offer_letter", function() {
                        let offer = document.getElementById("offer_letter").files[0];
                        var datas = new FormData();
                        datas.append('offer_letter', offer);
                        datas.append("intern_id", '<?php echo $interuser['intern_id'] ?>');
                        if ($("input[type=file]").val() != '') {
                            if ($("input[type=file]")[0].files[0].type == "application/pdf") {
                                var con = confirm("Are you want to mail?");
                                if (con) {
                                    $.ajax({
                                        method: "post",
                                        url: "<?php echo base_url(); ?>send_offer_to_user",
                                        processData: false, // tell jQuery not to process the data
                                        contentType: false, // tell jQuery not to set contentType
                                        data: datas,
                                        success: function(datas) {
                                            //alert(datas)
                                            if (datas) {
                                                alert("Mail send");
                                                window.location.reload();
                                            } else {
                                                alert("Something went wrong");
                                            }
                                        },
                                        error: function() {
                                            alert("Something went wrong");
                                        }
                                    });
                                }
                            } else {
                                alert("Please select only pdf");
                            }
                        } else {
                            alert("Please select file");
                        }



                    });
                    // open popup for Shortlisted  and Not Shortlisted
                    $("input:radio[name=Join_radio]").change(function() {
                        if ($(this).val() == "Join") {
                            if (confirm("Confirm Join")) {
                                join_function("join");
                            } else {
                                $(this).removeAttr("checked");
                            }
                        } else if ($(this).val() == "Not Join") {
                            if (confirm("Confirm not join")) {
                                join_function("not join");
                            } else {
                                $(this).removeAttr("checked");
                            }
                        }
                    });

                    function join_function(join) {
                        $.ajax({
                            method: "post",
                            url: "<?php echo base_url(); ?>confirm_joining",
                            data: {
                                "join": join,
                                'creation_date': <?php echo $interuser['creation_date'] ?>,
                                'intern_id': <?php echo $interuser['intern_id'] ?>,
                            },
                            success: function(datas) {
                                if (datas) {
                                    window.location.reload();
                                } else {
                                    alert("Something went wrong");
                                }
                            },
                            error: function() {
                                alert("Something went wrong");
                            }
                        });
                    }
                    // open popup for Shortlisted  and Not Shortlisted
                    $("input:radio[name=short_radio]").change(function() {
                        if ($(this).val() == "Shortlisted") {
                            $('#myModal').modal('show');
                        } else if ($(this).val() == "Not Shortlisted") {
                            $('#myModal1').modal('show');
                        }
                    });
                    $(document).keyup(function(e) {
                        if (e.keyCode === 27) $('.close').click(); // esc
                    });

                    $(".shortlist_email").click(function() {
                        if ($("input[name=short_radio][value='Shortlisted']").prop("checked")) {
                            $.post("<?php echo base_url(); ?>shortlist_mail", {
                                'intern_id': <?php echo $interuser['intern_id'] ?>,
                            }, function(data) {
                                if (data == false) {
                                    alert("Something went wrong");
                                } else {
                                    alert("Mail Send");
                                }
                            }).fail(function(data) {
                                alert("Something went wrong");

                            });
                        } else {
                            alert('Please sortlist the candidate.');
                        }
                    })
                    // interview result mail
                    $(".interview_final_mail").click(function() {
                        $.post("<?php echo base_url() . 'interview_final_mail' ?>", {
                            intern_id: "<?php echo $interuser['intern_id'] ?>"
                        }, function(data) {
                            if (data == false) {
                                alert("11Something went wrong");
                            } else {
                                alert("Mail Send");
                            }
                        }).fail(function(data) {
                            alert("22Something went wrong");

                        });
                    });
                    </script>
                    <div class="control-sidebar-bg"></div>
                </div>

            </div>

        </div>
    </div>
</div>
</div>