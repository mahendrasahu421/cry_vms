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
                    <form action="#" method="GET">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <select class="form-control select2-show-search form-select" name="region_id"
                                            id="region_id">
                                            <option selected disabled value="">Select Region</option>
                                            <?php foreach ($regions as $rd) {
										?>
                                            <option value="<?php echo $rd['region_id']; ?>" <?php if ($regionId == $rd['region_id']) {
																								echo "selected";
																							} ?>><?php echo $rd['region_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- COL END -->
                            <div class="col-sm-12 col-md-3 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <select class="form-control select2-show-search form-select" id="state_name"
                                            name="state_name">
                                            <option selected> Select States</option>

                                        </select>
                                    </div>
                                </div>
                            </div><!-- COL END -->
                        </div>
                    </form>



                    <table id="example" class="display bg-white" cellspacing="0" width="100%">
                        <th colspan="6" class="fs-20">Volunteer</th>

                        <tr>
                            <td rowspan="9" colspan="6">
                                <div class="">
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h2 class="mb-2 fw-normal mt-2 totalvol">
                                                    <?php echo count($totalvolunteer); ?></h2>
                                                <h5 class="fw-normal mb-0">Total Volunteer</h5>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div
                                                class="circle-icon bg-warning text-center align-self-center box-warning-shadow">
                                                <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg"
                                                    alt="img" class="card-img-absolute">
                                                <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h2 class="mb-2 fw-normal mt-2 ">
                                                    <i class="fa fa-female fs-40 female-count"><?php echo $female_count;?></i>

                                                </h2>
                                                <h5 class="fw-normal mb-0">Total Volunteer</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-4">
                                            <h2 class="mb-2 fw-normal mt-2 ">
                                                <i class="fa fa-male fs-40 male-count"><?php echo $male_count;?></i>
                                            </h2>
                                            <h5 class="fw-normal mb-0">Total Volunteer</h5>
                                        </div>

                                    </div>



                                </div>
                            </td>
                            <th class="fs-17">Active</th>
                            <th class="fs-17">Inactive</th>
                            <th class="fs-17">Sleepy</th>
                            <th class="fs-17">Male</th>
                            <th class="fs-17">Female</th>
                        </tr>
                        <tr>
                            <td class="totalvol fs-17"><?php echo count($totalvolunteer); ?></td>
                            <td class="totalvolinactive fs-17"><?php echo $totalvolinactive; ?></td>
                            <td class="sleepyvol fs-17"><?php echo $sleepyvol; ?></td>
                            <td class="male-count fs-17"><?php echo $male_count; ?></td>
                            <td class="female-count fs-17"><?php echo $female_count; ?></td>
                        </tr>

                        <th class="fs-20">Issue Certificate</th>
                        <tr>

                            <th class="fs-17">Bronze</th>
                            <th class="fs-17">Silver</th>
                            <th class="fs-17">Gold</th>
                            <th class="fs-17">platinum</th>


                        </tr>
                        <tr>

                            <td>214</td>
                            <td>25</td>
                            <td>563</td>
                            <td> 634</td>

                        </tr>
                    </table>
                    <table style="margin-top: 20px;" class="table table-bordered bg-white">
                                <th colspan="3">Interns</th>
                                <th colspan="9">Onboarding Status</th>
                                <tr>
                                    <td rowspan="11" colspan="6">
                                        <div class="card">
                                            <div class="row">

                                                <div class="col-md-8">
                                                    <div class="card-body p-4">

                                                        <h2 class="mb-2 fw-normal mt-2">
                                                            <?php echo count($totalvolunteer); ?></h2>
                                                        <h5 class="fw-normal mb-0">Total Interns</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div
                                                        class="circle-icon bg-primary text-center align-self-center box-primary-shadow">
                                                        <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg"
                                                            alt="img" class="card-img-absolute">
                                                        <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-8">
                                                <div class="card-body">

                                                    <div
                                                        class="circle-icon bg-primary text-center align-self-center box-primary-shadow">
                                                        <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg"
                                                            alt="img" class="card-img-absolute">
                                                        <i class="fa fa-male fs-20  text-white mt-4"><br>40</i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div style="margin-top:37px;"
                                                    class="circle-icon bg-primary text-center align-self-center box-primary-shadow">
                                                    <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg"
                                                        alt="img" class="card-img-absolute">
                                                    <i class="fa fa-female fs-20  text-white mt-4"><br>33</i>
                                                </div>
                                            </div>
                                        </div>




                                    </td>
                                    <th>Proccess</th>
                                    <td>State 1</td>
                                    <td>State 2</td>
                                    <td>State 3</td>
                                    <td>State 4</td>
                                    <td>State 5</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>900</td>
                                    <td>800</td>
                                    <td>700</td>
                                    <td>554</td>
                                    <td>752</td>
                                </tr>
                                <tr>
                                    <th>Applied</th>
                                    <td>411</td>
                                    <td>525</td>
                                    <td>411</td>
                                    <td>522</td>
                                    <td>585</td>
                                </tr>
                                <tr>
                                    <th>ShortListed</th>
                                    <td>588</td>
                                    <td>585</td>
                                    <td>555</td>
                                    <td>856</td>
                                    <td>536</td>
                                </tr>
                                <tr>
                                    <th>interview</th>
                                    <td>758</td>
                                    <td>555</td>
                                    <td>856</td>
                                    <td>963</td>
                                    <td>369</td>
                                </tr>
                                <tr>
                                    <th>Offer</th>
                                    <td>654</td>
                                    <td>456</td>
                                    <td>857</td>
                                    <td>785</td>
                                    <td>230</td>
                                </tr>
                                <tr>
                                    <th>joined</th>
                                    <td>589</td>
                                    <td>985</td>
                                    <td>758</td>
                                    <td>857</td>
                                    <td>855</td>
                                </tr>

                                <tr>

                                    <th>Engaged User</th>
                                    <td>854</td>
                                    <td>526</td>
                                    <td>563</td>
                                    <td>852</td>
                                    <td>869</td>

                                </tr>
                                <tr>

                                    <th>Non - engadeg User</th>
                                    <td>856</td>
                                    <td>582</td>
                                    <td>369</td>
                                    <td>563</td>
                                    <td>563</td>
                                </tr>
                                <tr>

                                    <th>Submission Reports</th>
                                    <td>555</td>
                                    <td>236</td>
                                    <td>321</td>
                                    <td>232</td>
                                    <td>365</td>
                                </tr>
                                <tr>

                                    <th>certificate issuee</th>
                                    <td>210</td>
                                    <td>120</td>
                                    <td>240</td>
                                    <td>236</td>
                                    <td>365</td>
                                </tr>


                            </table>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-6 col-xl-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4">
                                        <div
                                            class="circle-icon bg-primary text-center align-self-center box-primary-shadow">
                                            <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg"
                                                alt="img" class="card-img-absolute">
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
                                        <div
                                            class="circle-icon bg-secondary text-center align-self-center box-primary-shadow">
                                            <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg"
                                                alt="img" class="card-img-absolute">
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
                                        <div
                                            class="circle-icon bg-primary text-center align-self-center box-primary-shadow">
                                            <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg"
                                                alt="img" class="card-img-absolute">
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
                                        <div
                                            class="circle-icon bg-secondary text-center align-self-center box-primary-shadow">
                                            <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg"
                                                alt="img" class="card-img-absolute">
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
                                            <td><a href="<?php echo base_url();?>enquiry"><span
                                                        class="badge bg-warning  me-1 mb-1 mt-1">Enquiry
                                                        Volunteer</span></a></td>


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
            url: '<?php echo base_url() ?>get_admin_dashboard_state',
            type: 'post',
            data: datastr,
            success: function(response) {
                $("#state_name").html(response);
                // $('select').selectpicker('refresh');
            }
        });
    });
    $(document).on('click', '#searchData', function() {
        var region_id = $("#region_id").val();
        alert(region_id);
        var state_name = $("#state_name").val();
        if (region_id && state_name) {
            window.location.href = "<?php echo base_url("admin-dashboard?region=") ?>" + region_id +
                "&state=" + state_name

        }
    })

});
</script>
<script>
$(document).ready(function(e) {
    $('#state_name').change(function(e) {
        let state_name = $('#state_name').val();
        datastr = {
            state_name: state_name
        };
        $.ajax({
            url: "<?php echo base_url(); ?>get_gender_count",
            type: "POST",
            dataType: "json",
            data: datastr,
            success: function(data) {
                $(".male-count").html(data.male_count);
                $(".female-count").html(data.female_count);
                $(".totalvol").html(data.totalvol);
                $(".totalvolinactive").html(data.totalvolinactive);
                $(".sleepyvol").html(data.sleepyvol);
            }
        });
    });
});
</script>