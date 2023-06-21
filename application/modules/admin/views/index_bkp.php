<style>
    .magic {
        position: relative;
        /* display: inline-block; */
        /* border-bottom: 1px dotted black; */
    }

    .magic .magictext {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -60px;
        font-size: 10px;
    }

    .magic .magictext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: black transparent transparent transparent;
    }

    .magic:hover .magictext {
        visibility: visible;
    }
</style>
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
                    <form action="<?php echo base_url() ?>data_state_city_datewise" method="post" id="dashboard-from">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <select class="form-control select2-show-search form-select" name="region_id" id="region_id">
                                            <option selected disabled value="">Select Region</option>
                                            <?php foreach ($regions as $rd) {
                                            ?>
                                                <option value="<?php echo $rd['region_id']; ?>" <?php if ($regionId == $rd['region_id']) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                                    <?php echo $rd['region_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- COL END -->
                            <div class="col-sm-12 col-md-3 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <select class="form-control select2-show-search form-select" id="state_name" name="state_name">
                                            <option> Select States</option>

                                        </select>
                                    </div>
                                </div>
                            </div><!-- COL END -->
                            <div class="col-sm-12 col-md-3 col-lg-6 col-xl-2">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <select class="form-control select2-show-search form-select" id="city_name" name="city_name">
                                            <option value=""> Select City</option>

                                        </select>
                                    </div>
                                </div>
                            </div><!-- COL END -->
                            <div class="col-sm-12 col-md-3 col-lg-6 col-xl-2">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <input class="form-control hasDatepicker" name="monthDate" id="datepickerNoOfMonths" placeholder="MM/DD/YYYY" type="month">
                                    </div>
                                </div>
                            </div><!-- COL END -->


                        </div>
                    </form>

                    <table id="example" class="display bg-white" cellspacing="0" width="100%">
                        <th colspan="6" class="fs-20">Volunteer
                        </th>

                        <tr>
                            <td rowspan="9" colspan="6">
                                <div class="">
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h2 class="mb-2 fw-normal mt-2 totalvol">
                                                    <?php echo count($totalvolunteer); ?></h2>
                                                <h5 class="fw-normal mb-0">Total Volunteer <i class="fa fa-info magic"><span class="magictext">Onboarded
                                                            Volunteer</span></i></h5>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="circle-icon bg-warning text-center align-self-center box-warning-shadow">
                                                <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                                <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h2 class="mb-2 fw-normal mt-2 ">
                                                    <i class="fa fa-male fs-40 female-count"> <?php echo $male_count; ?>
                                                    </i>

                                                </h2>
                                                <h5 class="fw-normal mb-0">Total Volunteer <i class="fa fa-info magic"><span class="magictext">Onboarded
                                                            male volunteer</span></i></h5>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-4">
                                            <h2 class="mb-2 fw-normal mt-2 ">
                                                <i class="fa fa-female fs-40 male-count">
                                                    <?php echo $female_count; ?></i>
                                            </h2>
                                            <h5 class="fw-normal mb-0">Total Volunteer <i class="fa fa-info magic"><span class="magictext">Onboarded
                                                        female volunteer</span></i></h5>
                                        </div>

                                    </div>



                                </div>
                            </td>
                            <th class="fs-17 magic">Total Application <span class="magictext">Applications received
                                    (till date)</span></th>
                            <th class="fs-17 magic">Pending Application <span class="magictext">Pending Application
                                    (till date)</span></th>
                            <th class="fs-17 magic">Active<span class="magictext">Onborded Volunteer</span></th>
                            <th class="magic fs-17">Inactive<span class="magictext">Self Blocked & By admin Block</span>
                            </th>
                            <th class="magic fs-17">Sleepy <span class="magictext">Last Login Before One Month</span>
                            </th>
                            <th class="fs-17 magic">Male <span class="magictext">Onborded male</span></th>
                            <th class="fs-17 magic">Female <span class="magictext">Onborded female</span></th>
                        </tr>
                        <tr>
                            <td class="datatotalapplication fs-30"><?php echo $totalapplication_vol; ?></td>
                            <td class="totalapplication_pending_vol fs-30"><?php echo $totalapplication_pending_vol; ?>
                            </td>
                            <td class="totalvol fs-30"><?php echo count($totalvolunteer); ?></td>
                            <td class="totalvolinactive fs-30"><?php echo $totalvolinactive; ?></td>
                            <td class="sleepyvol fs-30"><?php echo $sleepyvol; ?></td>
                            <td class="male-count fs-30"><?php echo $male_count; ?> </td>
                            <td class="female-count fs-30"><?php echo $female_count; ?></td>
                        </tr>
                        <?php $query = $this->db->query("
                                    SELECT 
                                        COUNT(CASE WHEN total_time >= 40 AND total_time < 60 THEN 1 END) AS bronze_count,
                                        COUNT(CASE WHEN total_time >= 60 AND total_time < 80 THEN 1 END) AS silver_count,
                                        COUNT(CASE WHEN total_time >= 80 AND total_time < 100 THEN 1 END) AS gold_count,
                                        COUNT(CASE WHEN total_time >= 100 THEN 1 END) AS platinum_count
                                    FROM (
                                        SELECT volunteer_id, SUM(admin_time) AS total_time
                                        FROM approveddaily_report
                                        GROUP BY volunteer_id
                                    ) t
                                    ");
                        if ($query->num_rows() > 0) {
                            $row = $query->row();
                        } else {
                            echo 'No certificate counts found.';
                        }
                        ?>

                        <th class="fs-20">Issue Certificate</th>
                        <tr>

                            <th class="fs-17">Bronze</th>
                            <th class="fs-17 countCertificate">Silver</th>
                            <th class="fs-17 countCertificate">Gold</th>
                            <th class="fs-17 countCertificate">platinum</th>


                        </tr>
                        <tr class="fs-20">

                            <td><?php echo $row->bronze_count; ?></td>
                            <td><?php echo $row->silver_count; ?></td>
                            <td><?php echo $row->gold_count; ?></td>
                            <td><?php echo $row->platinum_count; ?></td>
                        </tr>
                    </table>

                    <table id="example" class="display bg-white mt-4" cellspacing="0" width="100%">
                        <th colspan="6" class="fs-20 mx-5 mt-5 ">Interns
                            <hr>
                        </th>
                        <th colspan="6" class="fs-20"></th>


                        <tr>
                            <td rowspan="9" colspan="6">
                                <div class="">
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h2 class="mb-2 fw-normal mt-2 internsstatewise internsstatecitywise internsdatehwise  internsmonthwise">
                                                    <?php echo $totalintinactive; ?></h2>
                                                <h5 class="fw-normal mb-0">Total Interns</h5>
                                            </div>
                                        </div>
                                        <!-- <div class="col-4">
                                            <div class="circle-icon bg-warning text-center align-self-center box-warning-shadow">
                                                <img src="<?php echo base_url(); ?>admin/assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                                <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                            </div>
                                        </div> -->

                                    </div>
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h2 class="mb-2 fw-normal mt-2 ">
                                                    <i class="fa fa-female fs-40 female_countintrn"><?php echo $female_countintrn; ?></i>

                                                </h2>
                                                <h5 class="fw-normal mb-0">Total Interns</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-4">
                                            <h2 class="mb-2 fw-normal mt-2 ">
                                                <i class="fa fa-male fs-40 male_countintern"><?php echo $male_countintern; ?></i>
                                            </h2>
                                            <h5 class="fw-normal mb-0">Total Interns</h5>
                                        </div>

                                    </div>



                                </div>
                            </td>
                            <th class="fs-17 magic">Total Application
                                <hr><span class="magictext">Interns Applications received (till date)</span>
                            </th>
                            <th class="fs-17 magic">Pending Application
                                <hr><span class="magictext">Interns Pending Application (till date)</span>
                            </th>
                            <th class="fs-17 magic">Active
                                <hr><span class="magictext">Onborded Interns</span>
                            </th>
                            <th class="magic fs-17">Inactive
                                <hr><span class="magictext">Interns Self Blocked & By admin Block</span>
                            </th>
                            <!-- <th class="magic fs-17">Sleepy
                                <hr><span class="magictext">Interns Last Login Before One Month</span>
                            </th> -->
                            <th class="fs-17 magic">Male
                                <hr><span class="magictext">Interns Onborded male</span>
                            </th>
                            <th class="fs-17 magic">Female
                                <hr><span class="magictext">Interns Onborded female</span>
                            </th>
                            <hr>
                            </th>
                        </tr>
                        <tr>
                            <td class="totalapplication_int fs-30"><?php echo $totalapplication; ?>
                                <hr>
                            <td class="totalapplication_pending_int fs-30">
                                <?php echo $totalapplication_pending_interns; ?>
                                <hr>

                            </td>
                            <td class="internsstatewise internsstatecitywise internsdatehwise  internsmonthwise fs-30"><?php echo $totalintinactive; ?>
                                <hr>
                            </td>
                            <td class="inactiveInterns fs-30"><?php echo $totalvolinactive; ?>
                                <hr>
                            </td>
                            <!-- <td class="sleepyintern fs-30"><?php echo $sleepyintern; ?>
                                <hr>
                            </td> -->
                            <td class="male_countintern fs-30"><?php echo $male_countintern; ?>
                                <hr>
                            </td>
                            <td class="female_countintrn fs-30"><?php echo $female_countintrn; ?>
                                <hr>
                            </td>
                        </tr>

                        <th class="fs-20">Issue Certificate
                            <hr>
                        </th>
                        <tr>

                            <th class="count_intern_send_certificate fs-30"><?php echo $certificate_status; ?>
                                <hr>
                            </th>
                        </tr>
                    </table>

                    <div class="row mt-5">
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
                                            <h2 class="mb-2 fw-normal mt-2 internsmonthwise internsstatewise internsstatecitywise"><?php echo count($totalintern); ?></h2>
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
                                                <td><a href="<?php echo base_url(); ?>enquiry"><span class="badge bg-warning  me-1 mb-1 mt-1">Enquiry
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
