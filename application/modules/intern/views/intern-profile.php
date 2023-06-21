<style>
    #profileImage {
        background: #f9f9f9;
        border: 5px solid #88c;
        padding: 15px;
        border-radius: 5px;
        margin: 10px;
        cursor: pointer;
    }

    .fa-camera {
        color: #fff;
    }

    .icon-add {
        background: #8f281f;
        padding: 6px;
        border-radius: 50%;
        width: 30px;
        margin-top: -20px;
        margin-right: -11px;
    }

    .icon-add:before {
        content: none;
    }
</style>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Profile</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                    </ol>
                </div>
                <div class="ms-auto pageheader-btn">
                    <a href="intern-edit-profile" class="btn btn-primary btn-icon text-white me-2">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span> Edit Profile
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-12 col-sm-12">
                    <div class="card">
                    </div>
                </div>
                <div class="col-xl-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 m-b-20 text-center">
                                    <form id="profileImageForm" name="profileImageForm">
                                        <span id="result"></span>
                                        <img src='<?php echo base_url(); ?>user_profile/crop.jpg' class="img-fluid border p-1" id="profileImage" style=" width: 340px;height: 257px;" />
                                        <input type="file" name="profile" id="my_file" style="display:none" />
                                        <div class="icon-add pull-right"><i class="fa fa-camera "></i></div>
                                        <button type="submit" name="submit" value="submit" class="btn btn-danger" disabled style="display:none">Save</button>
                                    </form>
                                </div>
                                <script>
                                    document.getElementById('profileImage').onclick = function() {
                                        document.getElementById('my_file').click();
                                    };
                                </script>
                                <div class="col-md-8">
                                    <h2 class="f-24 font-medium">
                                        <?php echo $internDetails[0]['first_name'] . ' ' . $internDetails[0]['last_name']; ?>
                                    </h2>
                                    <!-- <p class="m-b-20">Online</p> -->
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-bold text-dark">Intern ID</div>
                                        <div class="col"><?php echo $internDetails[0]['intern_id']; ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-bold text-dark">Phone</div>
                                        <div class="col"><?php echo $internDetails[0]['mobile']; ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-bold text-dark">Email</div>
                                        <div class="col"><span class="text-inverse"><span class="__cf_email__" data-cfemail="<?php echo $internDetails[0]['email']; ?>"><?php echo $internDetails[0]['email']; ?></span></span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-bold text-dark">Date of Birth</div>
                                        <div class="col"><?php echo $internDetails[0]['date_of_birth']; ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-bold text-dark"><b>Account Status</b></div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-check form-switch mx-5">
                                            <?php if ($internDetails[0]['status'] == 8) { ?>
                                                <input class="form-check-input" type="checkbox" role="switch" id="activeValue" checked value="<?php echo $internDetails[0]['status']; ?>" name="chkOrgRow">

                                            <?php } else { ?>
                                                <input class="form-check-input" id="accountActive" type="checkbox" role="switch" id="activeValue" name="chkOrgRow" <?php echo $internDetails[0]['status']; ?>>

                                            <?php } ?>
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
</div>
</div>
</div>
<div class="modal fade" id="ModalConfirmSettled">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                <h4 class="modal-title">Deactive Account</h4>

            </div>
            <div class="modal-body">
                <p><b>Are you sure you want to deactive your account?</b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="buttons btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="buttons btn btn-primary" value="1" id="confirm">Yes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(function() {
        var checkbox_one = '';
        $("[name='chkOrgRow']").change(function(e) {
            checkbox_one = $(this);
            openmodal();
        });

        $('.buttons').on('click', function() {
            var activeValue = $('#activeValue').val();
            var yes = $(this).val();
            //alert(yes);

            if (yes == '1') {
                datastr = {
                    yes: yes,
                    intern_id: '<?php echo $internDetails[0]['intern_id']; ?>',
                    intern_email: '<?php echo $internDetails[0]['email']; ?>',
                };
                $.ajax({
                    url: '<?php echo base_url(); ?>deactive_account',
                    type: 'post',
                    data: datastr,
                    success: function(data) {
                        alert(data);
                        if (data == 1) {
                            window.location.href = "<?php echo base_url('intern-login') ?>";
                        }
                        // alert(querry);
                    }
                });
                $("#ModalConfirmSettled").modal('hide');
                checkbox_one.parents('tr').toggleClass('highlight');
            } else {
                console.log('close');
            }
            $('.highlight').css("background-color") ? $('input[name=chkOrgRow]').prop('checked', true) :
                $('input[name=chkOrgRow]').prop('checked', false);
        });
    });

    function openmodal() {
        $('#ModalConfirmSettled').modal('show', function(data) {
            console.log('data:' + data);
        });

    }
</script>