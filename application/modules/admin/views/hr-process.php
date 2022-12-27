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
                                <h4 style="margin-top: 17px; font-weight: 600">Mahendra Sahu</h4>
                            </div>
                            <div class="col-md-9">
                                <span><a href="javascript:void(0)" id="job_view">View CV</a></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="ibox-content">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="tdhead">DOB</td>
                                            <td>03/05/1998</td>
                                            <td class="tdhead">State</td>
                                            <td>Uttar Pradesh</td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">Email</td>
                                            <td style="width: 25%">mahi421@gmail.com</td>
                                            <td class="tdhead">City</td>
                                            <td>
                                                Kanpur
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">
                                                Skill</td>
                                            <td style="width: 25%">Programing,devlopment</td>
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
                                    <div class="">
                                        <div class="process">
                                            <div class="process-row nav nav-tabs">
                                                <div class="process-step" style="width: 20%;">
                                                    <button type="button" class="btn btn-success btn-circle" disabled><i class="fa fa-file fa-3x"></i></button>
                                                    <p><small><strong>Submission</strong></small>
                                                        <br> <small>Date: 14/03/2019</small>
                                                        <br> <small>Time: 10:33 AM </small>
                                                    </p>
                                                </div>
                                                <!-- ##################################################      submission div     #####################################################  -->
                                                <div class="process-step" style="width: 20%;">
                                                    <button type="button" class="btn btn-circle process_btn btn-info"><i class="fa fa-check fa-3x"></i></button>
                                                    <p>
                                                        <small><strong>Shortlist</strong></small>
                                                        <br>
                                                        <input type="radio" class="demo4" name="short_radio" value="Shortlisted">Shortlisted
                                                        <input type="radio" class="demo4" name="short_radio" value="Not Shortlisted">Not Shortlisted
                                                    </p>
                                                    <button class="btn btn-info shortlist_email" title="Email"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                </div>
                                                <!-- ##################################################      Shortlisted div     #####################################################  -->
                                                <div class="process-step" style="width: 20%;">
                                                    <button type="button" class="btn btn-default btn-circle process_btn" disabled><i class="fa fa-calendar fa-3x"></i></button>
                                                    <p>
                                                        <strong>Interview</strong>

                                                        <br>
                                                    </p>
                                                    <br>
                                                    <button class="btn btn-info interview_final_mail" title="Email"><i class="fa fa-paper-plane" aria-hidden="true"></i>

                                                </div>

                                                <!-- ##################################################      Interview div     #####################################################  -->
                                                <div class="process-step" style="width: 20%;">
                                                    <button type="button" class="btn btn-default btn-circle process_btn" disabled><i class="fa fa-file-text-o fa-3x"></i></button>
                                                    <p>
                                                        <strong>Offer</strong>
                                                    <form enctype="multipart/form-data" action="" method="post" style="margin-bottom: 10px;">
                                                        <h6 style="font-weight: 600">Upload offer letter here</h6>
                                                        <p style="margin-left: 20%;margin-bottom: 0px !important;">
                                                            <input type="file" name="pdfFile" class="process_btn" accept=".pdf" />
                                                        </p>
                                                    </form>
                                                    <button type="button" class="btn btn-info send_offer_letter" disabled>Send offer letter <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                    <button type="button" class="btn btn-danger send_offer_letter" disabled>Close <i class="fa fa-ban" aria-hidden="true"></i></button>
                                                    </p>
                                                </div>
                                                <!-- ##################################################      Placed  div     #####################################################  -->
                                                <div class="process-step">
                                                    <button type="button" class="btn btn-default btn-circle" disabled><i class="fa fa-industry fa-3x"></i></button>
                                                    <p>
                                                        <strong>Placed</strong>
                                                    </p>
                                                    <input type="radio" name="Join_radio" value="Join">Join
                                                    <input type="radio" name="Join_radio" value="Not Join">Not
                                                    Join
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row row-sm">
                                            <div class="col-lg-12">

                                                <div class="card-body">
                                                    <div class="table-responsive ">
                                                        <table id="example" class="display" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr style="color: #fff;">
                                                                    <th style=" background: #f7b731;">
                                                                    </th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731; color:#000;">Schedule</th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731;"></th>
                                                                    <th style="background: #f7b731; color:#000;">Save & send mail</th>
                                                                    <th style="background: #f7b731;"></th>
                                                                </tr>
                                                                <tr class="bg-gray-light">
                                                                    <th style="color:#000">Round</th>
                                                                    <th style="color:#000">Mode</th>
                                                                    <th style="color:#000">Date</th>
                                                                    <th style="color:#000">Time</th>
                                                                    <th style="color:#000">Venue</th>
                                                                    <th style="color:#000">Status</th>
                                                                    <th style="color:#000">Comment</th>
                                                                    <th style="color:#000">Save & send mail</th>
                                                                    <th style="color:#000"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tdd">

                                                                <tr>
                                                                    <td style="color:#000; line-height: 32px;font-weight: 600;">R1</td>
                                                                    <td style="line-height: 32px;">
                                                                        <select style="color:#000; margin-top: 1%" class="form-control mode">
                                                                            <option value="">Select mode</option>
                                                                            <option value="On Call">On Call</option>
                                                                            <option value="Face to Face">Face to Face</option>
                                                                            <option value="Skype">Video Call</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" data-role="date" style="color:#000" name="schedule_date" class="form-control dob_cafc_interview schedule_date" value="" placeholder="MM/DD/YYYY" id="newid">
                                                                        <span style="display:none;color:red" class="schedule_error">15 or more the 15 interview
                                                                            are Schedule.</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group clockpicker" data-autoclose="true" style="color:#000;">
                                                                            <input type="text" class="form-control schedule_time" placeholder="09:30" name="schedule_time">
                                                                            <!--  <span class="input-group-addon"><span class="fa fa-clock-o"></span></span> -->
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <textarea style="color:#000;" name="venue" class="form-control venue" placeholder="Venue" disabled>   City: Kanpur    State: Uttar Pradesh</textarea>
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>
                                                                        <button class="btn btn-info save_schedule" type="button" title="Save"><i class="fa fa-paste"></i> </button>
                                                                        <button class="btn btn-info mail_schedule" type="button" title="Email"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                                        <button class="btn btn-danger mail_schedule" type="button" title="Email"><i class="fa fa-ban" aria-hidden="true"></i></button>
                                                                        <style>
                                                                            .reject {
                                                                                margin-left: 70%;
                                                                                margin-top: -50%;
                                                                            }
                                                                        </style>

                                                                    </td>
                                                                    <td></td>
                                                                </tr>
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
                                    <div class="modal-header">
                                        <button type="button" class="close cancel_short" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <h2>Are you sure?</h2>
                                        <p style="display: block;">You want to shortlist.</p>
                                        <div class="sa-button-container" style="margin-top: 10%;">
                                            <a class="button cancel_short" data-dismiss="modal" style="box-shadow: none;border: 1px solid red;color: #fff;border-radius: 3px;padding: 10px;background-color: red;">No</a>
                                            <a class="confirm" id="confirm_short" style="background-color: rgb(221, 107, 85);border: 1px solid #009688;color: #fff;padding: 10px; border-radius: 3px;box-shadow: none;">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Model for not sortlisted   -->
                        <div id="myModal1" class="modal fade" role="dialog" data-backdrop="static">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close cancel_short" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <h2>Are you sure?</h2>
                                        <p style="display: block;">You want to reject it.</p>
                                        <div class="sa-button-container" style="margin-top: 10%;">
                                            <a class="button cancel_short" data-dismiss="modal" style="box-shadow: none;border: 1px solid red;color: #fff;border-radius: 3px;padding: 10px;background-color: red;">No</a>
                                            <a class="confirm" id="confirm_reject" style="background-color: rgb(221, 107, 85);border: 1px solid #009688;color: #fff;padding: 10px; border-radius: 3px;box-shadow: none;">Yes</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="job_detail_model" class="modal fade" role="dialog">
                            <div class="modal-dialog" style="width: 70%">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body" style="padding: 0px 30px 30px 30px;"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end  new popup -->
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
                    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

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
                                url: " https://drycoder.com/employer/employer/get_same_day_schedule_user_count",
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
                        // show job detail 
                        $("#job_view").click(function() {
                            $.ajax({
                                type: "post",
                                url: " https://drycoder.com/employer/employer/job_desc_view_ajax",
                                data: {
                                    job_id: "312"
                                },
                                dataType: "html",
                                success: function(datas) {
                                    $("#job_detail_model").modal('show');
                                    $("#job_detail_model").find('.modal-body').html(datas);
                                },
                                error: function() {
                                    alert("Something went wrong");
                                }
                            });
                        });

                        $("#candidate_view").click(function() {
                            $.ajax({
                                type: "post",
                                url: " https://drycoder.com/employer/employer/candidate_full_detail_ajax",
                                data: {
                                    candidate_id: "3928"
                                },
                                dataType: "html",
                                success: function(datas) {
                                    $("#job_detail_model").modal('show');
                                    $("#job_detail_model").find('.modal-body').html(datas);
                                },
                                error: function() {
                                    alert("fail");
                                }
                            });
                        });

                        // conformation of shortlist is cancel 
                        $(".cancel_short").click(function() {
                            $("input[name=short_radio]").each(function() {
                                $(this).removeAttr("checked");
                            });
                        });
                        // conformation of shortlist is confirm
                        $("#confirm_short").click(function() {
                            $.post("https://drycoder.com/employer/employer/shortlist_status_update", {
                                applied_id: "202",
                                status: 0
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
                            $.post("https://drycoder.com/employer/employer/shortlist_status_update", {
                                applied_id: "202",
                                status: 1
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
                            var con = confirm("Are you want to schedule the interview");
                            if (con) {
                                if (mode != '' && schedule_date != '' && schedule_time != '' && venue_cout == 0) {
                                    $.ajax({
                                        method: "post",
                                        url: "https://drycoder.com/employer/employer/save_job_schedule_data",
                                        data: {
                                            'mode': mode,
                                            'schedule_date': schedule_date,
                                            'schedule_time': schedule_time,
                                            'venue': venue,
                                            'round': round + 1,
                                            job_id: "312",
                                            candidate_id: "3928",
                                            schedule_id: schedule_id
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
                            var save_btn_action_object = $(this).parents("tr").find(".save_btn_action");
                            var mail_btn_action_object = $(this).parents("tr").find(".mail_btn_action");
                            switch ($(this).val()) {
                                case '':
                                    disable_round_details(mode_object, schedule_date_object, schedule_time_object,
                                        venue_object);
                                    save_btn_action_object.attr("data-action", "");
                                    mail_btn_action_object.attr("data-action", "");
                                    break;
                                case '1':
                                    disable_round_details(mode_object, schedule_date_object, schedule_time_object,
                                        venue_object);
                                    save_btn_action_object.attr("data-action", "interview_clear");
                                    mail_btn_action_object.attr("data-action", "interview_clear_mail");
                                    break;
                                case '2':
                                    disable_round_details(mode_object, schedule_date_object, schedule_time_object,
                                        venue_object);
                                    save_btn_action_object.attr("data-action", "interview_ongoing");
                                    mail_btn_action_object.attr("data-action", "interview_ongoing_mail");
                                    break;
                                case '3':
                                    disable_round_details(mode_object, schedule_date_object, schedule_time_object,
                                        venue_object);
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
                            venue_object) {
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
                                            applied_id: "202",
                                            "comment": comment_object.val(),
                                            "status": interview_status_object.val(),
                                            "schedule_id": schedule_id
                                        };
                                        var link = 'https://drycoder.com/employer/employer/clear_interview';
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
                                            candidate_id: "3928",
                                            job_id: "312",
                                            'round': round + 1
                                        };
                                        var link = 'https://drycoder.com/employer/employer/ongoing_interview';
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
                                            applied_id: "202",
                                            "comment": comment_object.val(),
                                            "status": interview_status_object.val(),
                                            "schedule_id": schedule_id
                                        };
                                        var link = 'https://drycoder.com/employer/employer/reject_interview';
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
                                                job_id: "312",
                                                candidate_id: "3928",
                                                schedule_id: schedule_id,
                                                comment: comments
                                            };
                                            var link =
                                                'https://drycoder.com/employer/employer/update_job_schedule_data';
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
                                            url: "https://drycoder.com/employer/employer/mail_interview_data",
                                            data: {
                                                'mode': mode,
                                                'schedule_date': schedule_date,
                                                'schedule_time': schedule_time,
                                                'venue': venue,
                                                'round': round + 1,
                                                job_id: "312",
                                                candidate_id: "3928",
                                                schedule_id: schedule_id,
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
                            var datas = new FormData();
                            datas.append('offer_letter', $("input[type=file]")[0].files[0]);
                            datas.append("applied_job_id", '202');
                            datas.append("job_id", '312');
                            datas.append("candidate_id", '3928');
                            if ($("input[type=file]").val() != '') {
                                if ($("input[type=file]")[0].files[0].type == "application/pdf") {
                                    var con = confirm("Are you want to mail");
                                    if (con) {
                                        $.ajax({
                                            method: "post",
                                            url: "https://drycoder.com/employer/employer/send_offer_to_user",
                                            processData: false, // tell jQuery not to process the data
                                            contentType: false, // tell jQuery not to set contentType
                                            data: datas,
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
                                url: "https://drycoder.com/employer/employer/confirm_joining",
                                data: {
                                    "join": join,
                                    "applied_job_id": '202'
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
                                $.post("https://drycoder.com/employer/employer/shortlist_mail", {
                                    job_id: "312",
                                    candidate_id: "3928"
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
                            $.post("https://drycoder.com/employer/employer/interview_final_mail", {
                                job_id: "312",
                                candidate_id: "3928",
                                applied_job_id: "202"
                            }, function(data) {
                                if (data == false) {
                                    alert("Something went wrong");
                                } else {
                                    alert("Mail Send");
                                }
                            }).fail(function(data) {
                                alert("Something went wrong");

                            });
                        });
                        // $.getJSON("https://api.ipify.org/?format=json", function(e) {
                        //     console.log(e.ip);
                        // });
                    </script>
                    <div class="control-sidebar-bg"></div>
                </div>
                <script>
                    $('#usersignup').click(function() {
                        var msgdiv = $('#field_errors');
                        if ($('#firstname').val() == '') {
                            msgdiv.text('Please fill your First Name');
                            $('#firstname').focus();
                            msgdiv.slideDown().delay(2000).slideUp(500);;
                        } else if ($('#lastname').val() == '') {
                            msgdiv.text('Please fill your Last Name');
                            $('#lastname').focus();
                            msgdiv.slideDown().delay(2000).slideUp(500);;
                        } else if ($('#user_email').val() == '') {
                            msgdiv.text('Please fill your Email');
                            $('#user_email').focus();
                            msgdiv.slideDown().delay(2000).slideUp(500);;
                        } else if ($('#user_password').val() == '') {
                            msgdiv.text('Please fill your Password');
                            $('#user_password').focus();
                            msgdiv.slideDown().delay(2000).slideUp(500);;
                        } else {
                            $('#loginform').submit();
                        }
                    });

                    $('#employer_industry_id').editable({
                        pk: 1,
                        source: 'https://drycoder.com/select-industry',
                        sourceCache: true,
                        name: 'employer_industry_id',
                        title: 'Enter industries',
                        url: 'https://drycoder.com/employer-update-editable',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#all_state').editable({
                        pk: 1,
                        source: 'https://drycoder.com/emp-selectstate',
                        sourceCache: true,
                        name: 'state_id',
                        title: 'Enter State',
                        url: 'https://drycoder.com/employer-update-editable',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#all_city').editable({
                        pk: 1,
                        source: 'https://drycoder.com/employer/employer/emp_selectcity_head',
                        sourceCache: true,
                        name: 'employer_city_id',
                        title: 'Enter City',
                        url: 'https://drycoder.com/employer-update-editable',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                </script>
                <script type="text/javascript">
                    $('#contact_person_name').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'employer_contact_person_name',
                        title: 'Enter Name',
                        url: 'https://drycoder.com/employer-data-edit',
                        validate: function(value) {
                            if ($.isNumeric(value) != '') {
                                return 'Enter alphabets only';
                            }
                            if (value.length >= 50) {
                                return 'Only lesss than 50 alphabets are allowed';
                            }
                            if (!value.match(/^[a-zA-Z\s]+$/)) {
                                return 'Enter alphabets only';
                            }

                        },
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function() {
                            alert('Some Error Occurred');
                        }

                    });

                    $('#contact_number').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'employer_mobile',
                        title: 'Enter Contact Number',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#present_addr').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'employer_address',
                        title: 'Enter Address',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $("#contact_number").keypress(function(event) {
                        // Allow: backspace, delete, tab, escape, enter and .
                        // Ensure that it is a number and stop the keypress
                        var key = window.event ? event.keyCode : event.which;
                        if (event.keyCode === 8 || event.keyCode === 46) {
                            return true;
                        } else if (key < 48 || key > 57) {
                            alert('Write only the numbers');
                            return false;
                        } else {
                            return true;
                        }
                    });
                    $('#head_office_pincode').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'pincode',
                        title: 'Enter Pincode',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#reg_pincode').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'reg_pincode',
                        title: 'Enter Pincode',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#reg_address').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'reg_address',
                        title: 'Enter Address',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#phone_no').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'employer_phone',
                        title: 'Enter Phone No.',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#fb_link').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'fb_link',
                        title: 'Facebook Link',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#linkedin_link').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'linkedin_link',
                        title: 'Linked Link',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#tw_link').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'twitter_link',
                        title: 'Twitter Link',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#gp_link').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'google_link',
                        title: 'Google Plus Link',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#web_link').editable({
                        pk: 1,
                        placement: 'right',
                        sourceCache: true,
                        name: 'web_link',
                        title: 'Website Link',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });

                    $('#reg_state').editable({
                        pk: 1,
                        source: 'https://drycoder.com/emp-selectstate',
                        sourceCache: true,
                        name: 'reg_state',
                        title: 'Enter State',
                        url: 'https://drycoder.com/employer-update-editable',
                        success: function(response) {
                            window.location.reload();
                        }
                    });

                    $('#reg_city').editable({
                        pk: 1,
                        source: 'https://drycoder.com/emp-selectcity',
                        sourceCache: true,
                        name: 'reg_city',
                        title: 'Enter City',
                        url: 'https://drycoder.com/employer-update-editable',
                        success: function(response) {
                            window.location.reload();
                        }
                    });

                    $('#employer_description').editable({
                        placeholder: 'Enter Company Description',
                        type: 'textarea',
                        pk: 3,
                        placement: 'top',
                        sourceCache: true,
                        name: 'employer_description',
                        title: 'Enter Description',
                        url: 'https://drycoder.com/employer-data-edit',
                        validate: function(value) {
                            if (value.length >= 1500) {
                                return 'Only lesss than 1500 alphabets are allowed';
                            }
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#designation').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'designation',
                        title: 'Enter Designation',
                        url: 'https://drycoder.com/employer-data-edit',
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                    $('#alternate_email').editable({
                        pk: 1,
                        sourceCache: true,
                        name: 'alternate_email',
                        title: 'Enter Alternate Email',
                        url: 'https://drycoder.com/employer-data-edit',
                        validate: function(value) {
                            var filter =
                                /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                            if (filter.test($.trim(value))) {} else {
                                if ($.trim(value) == "") {} else {
                                    alert('Invalid Email Address');
                                    e.preventDefault();
                                }
                            }
                        },
                        success: function(response) {

                        }
                    });
                </script>
                <!--Added Scripts for tooltip-->

                <div class="modal" id="new_model" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="margin-top: 130px;">
                            <div class="modal-header" style="padding: 25px!important;text-align:center;font-weight:bold;">
                                Alert Message
                            </div>
                            <div class="modal-body">
                                <p style="color:red;text-align: center;font-size: 25px;"> There's no Internet Connection
                                    on your device.</p>
                                <p style="text-align: center;font-size: 20px;">Pop up will disappear once Internet
                                    Connection is available.</p>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- <script>
                    $(document).ready(function() {
                        setInterval(function() {
                            var online = navigator.onLine;
                            if (online == false) {
                                $('#new_model').css('display', 'block');
                            } else {
                                $('#new_model').css('display', 'none');
                            }
                        }, 1000);
                    });
                </script> -->
            </div>
            <style>
                .sidebar-mini.sidebar-collapse .sidebar-menu>li>a>span {
                    padding: 9px !important;
                }

                .main-sidebar strong {
                    color: #fff;
                }

                .skin-blue .wrapper,
                .skin-blue .main-sidebar,
                .skin-blue .left-side {
                    box-shadow: none;
                }

                .slidehover li a:hover,
                .slidehover li.active a {
                    background-color: #293846 !important;
                }

                .skin-blue .sidebar-menu>li>a {
                    border-left: none !important;
                }

                .fafa {
                    color: #fff;
                }
            </style>
            <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        </div>
    </div>
</div>
</div>