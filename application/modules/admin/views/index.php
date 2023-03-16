<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Dashboard Analytics</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page">Dashboard Analytics</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <?php
                    if ($this->session->userdata('volenteership_verify')) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Successfull!</strong> Volunteer has been verified.<?php //echo $this->session->userdata('volenteership_verify'); 
                                                                                        ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php $this->session->unset_userdata('volenteership_verify');
                    } ?>
                    <?php
                    if ($this->session->userdata('volenteership_block')) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Successfull!</strong> Volunteer has been blocked.<?php //echo $this->session->userdata('volenteership_block'); 
                                                                                        ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php $this->session->unset_userdata('volenteership_block');
                    } ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="circle-icon bg-primary text-center align-self-center box-primary-shadow">
                                            <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                            <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body p-4">

                                            <h2 class="mb-2 fw-normal mt-2"><?php echo count($totalvolunteer); ?></h2>
                                            <h5 class="fw-normal mb-0">Total Volunteer</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="circle-icon bg-secondary text-center align-self-center box-primary-shadow">
                                            <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                            <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 fw-normal mt-2"><?php echo count($totalintern); ?></h2>
                                            <h5 class="fw-normal mb-0">Total Intern</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="circle-icon bg-primary text-center align-self-center box-primary-shadow">
                                            <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                            <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 fw-normal mt-2"><?php echo $volunteerTaskcount; ?></h2>
                                            <h5 class="fw-normal mb-0">Volunteer Task</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="circle-icon bg-secondary text-center align-self-center box-primary-shadow">
                                            <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                            <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body p-4">
                                            <h2 class="mb-2 fw-normal mt-2"><?php echo $totaltaskintern; ?></h2>
                                            <h5 class="fw-normal mb-0">Intern Task</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Pending Volunteer Registration</h3>
                        </div>
                        <div class="mb-0 bg-default">
                            <div class="card-header bg-danger-light">
                                <h4 class="card-title col-md-8"><i class="fa fa-filter me-2"></i> Search Filters</h4>
                                <div class="input-group col-md-4 p-0">
                                    <input type="text" class="form-control " placeholder="Search for...">
                                    <span class="input-group-text btn btn-warning">Go!</span>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="table-responsive ">
                                <table class="table table-bordered text-nowrap border-bottom  w-100">
                                    <thead>
                                        <tr class="bg-gray-light">
                                            <th>Sn. No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Date of Birth</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($volunteer as $key => $value) {
                                            $encode_userID = rtrim(strtr(base64_encode($value['volunteer_id']), "+/", "-_"), "=");
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value['first_name'] . ' ' . $value['last_name']; ?></td>
                                                <td><?php echo $value['email']; ?></td>
                                                <td><?php echo $value['mobile']; ?></td>
                                                <td><?php echo $value['date_of_birth']; ?></td>
                                                <td><a href="<?php echo base_url();?>enquiry"><span class="badge bg-warning  me-1 mb-1 mt-1">Enquiry Volunteer</span></a></td>
                                                
                                                
                                            </tr>
                                        <?php $i++;
                                        } ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- CONTAINER END -->
    </div>
</div>
<!--app-content end-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#region_id").change(function() {
            var region_id = $(this).val();
            //alert(region_id);
            datastr = {
                region_id: region_id
            };

            $.ajax({
                url: '<?php echo base_url() ?>get-states-admin',
                type: 'post',
                data: datastr,
                success: function(response) {
                    $("#state_name").html(response);
                    $('select').selectpicker('refresh');
                }
            });
        });

        $(document).on('click', '#searchData', function() {
            var region_id = $("#region_id").val();
            alert(region_id);
            var state_name = $("#state_name").val();
            if (region_id && state_name) {
                window.location.href = "<?php echo base_url("admin-dashboard?region=") ?>" + region_id + "&state=" + state_name

            }
        })

    });
</script>