
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
                            <div class="col-sm-12 col-md-3 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <select class="form-control select2-show-search form-select" id="city_name" name="city_name">
                                            <option value=""> Select City</option>

                                        </select>
                                    </div>
                                </div>
                            </div><!-- COL END -->
                            <div class="col-sm-12 col-md-3 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <input class="form-control hasDatepicker" name="monthDate" id="datepickerNoOfMonths" placeholder="MM/DD/YYYY" type="month">
                                    </div>
                                </div>
                            </div><!-- COL END -->


                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="mb-2 number-font">Total Volunteer</h5>
                                                    <h3 class="mb-2 number-font active_volunteers"><?php echo count($totalvolunteer); ?></h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-primary"><i class="fa fa-chevron-circle-up text-primary me-1"></i>
                                                        </span> Till Date
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
                                                        <i class="fe fe-trending-up text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="mb-2 number-font">Total Interns</h5>
                                                    <h3 class="mb-2 number-font internsmonthwise internsstatewise internsstatecitywise"><?php echo count($totalintern); ?></h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-secondary"><i class="fa fa-chevron-circle-up text-secondary me-1"></i>
                                                        </span> Till Date
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
                                                        <i class="icon icon-rocket text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="mb-2 number-font">Volunteer Task</h5>
                                                    <h3 class="mb-2 number-font"><?php echo $volunteerTaskcount; ?></h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-success"><i class="fa fa-chevron-circle-down text-success me-1"></i>
                                                            </span> Till Date
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto">
                                                        <i class="fe fe-dollar-sign text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="mb-2 number-font">Interns Task</h5>
                                                    <h3 class="mb-2 number-font"><?php echo $totaltaskintern; ?></h3>
                                                    <p class="text-muted mb-0">
                                                        <span class="text-danger"><i class="fa fa-chevron-circle-down text-danger me-1"></i>
                                                            </span> Till Date
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div class="counter-icon bg-success-gradient box-shadow-success brround  ms-auto">
                                                        <i class="fe fe-briefcase text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="example" class="display bg-white " cellspacing="0" width="100%">
                        <tr>
                            <th colspan="15" style="background-color: #FBC434;">Volunteer
                            </th>
                        </tr>



                        <tr class="" style="background-color: #e6fff2;">
                            <td rowspan="12" colspan="4" class="">
                                <div class="">
                                    <div class="row ">
                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h3 class="mb-2 fw-normal mt-2 active_volunteers">
                                                    <?php echo count($totalvolunteer); ?></h3>
                                                <h5 class="fw-normal mb-0">Total Volunteer <i class="fa fa-info magic"><span class="magictext">Onboarded
                                                            Volunteer</span></i></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-8">
                                            <div class="card-body p-4">
                                                <h3 class="mb-2 fw-normal mt-2 ">
                                                    <i class="fa fa-male volunteer_male_count"> <?php echo $male_count; ?>
                                                    </i>
                                                </h3>
                                                <h5 class="fw-normal mb-0 ">Total Volunteer <i class="fa fa-info magic"><span class="magictext">Onboarded
                                                            male volunteer</span></i></h5>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-4">
                                            <h3 class="mb-2 fw-normal mt-2 ">
                                                <i class="fa fa-female volunteer_female_count">
                                                    <?php echo $female_count; ?></i>
                                            </h3>
                                            <h5 class="fw-normal mb-0 ">Total Volunteer <i class="fa fa-info magic"><span class="magictext">Onboarded
                                                        female volunteer</span></i></h5>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <th class=" magic ">Total Application <span class="magictext">Applications received
                                    (till date)</span></th>
                            <th class=" magic">Pending Application <span class="magictext">Pending Application
                                    (till date)</span></th>
                            <th class=" magic">Active<span class="magictext">Onborded Volunteer</span></th>

                            <th class=" magic">Male <span class="magictext">Onborded male</span></th>
                            <th class=" magic">Female <span class="magictext">Onborded female</span></th>
                            <th class=" magic"></th>
                            <th class=" magic"></span></th>
                        </tr>
                        <tr style="background-color: #e6fff2;">
                            <td class="total_application"><?php echo $totalapplication_vol; ?></td>
                            <td class="pending_volunteers"><?php echo $totalapplication_pending_vol; ?>
                            </td>
                            <td class="active_volunteers"><?php echo count($totalvolunteer); ?></td>

                            <td class="male-count volunteer_male_count"><?php echo $male_count; ?> </td>
                            <td class="female-count volunteer_female_count"><?php echo $female_count; ?></td>
                            <td class="female-count"></td>
                            <td class="female-count"></td>
                        </tr>

                        <th class="" colspan="7" style="background-color: #e6fff2;">Issue Certificate</th>
                        <tr style="background-color: #e6fff2;">

                            <th class="">Bronze</th>
                            <th class=" countCertificate">Silver</th>
                            <th class=" countCertificate">Gold</th>
                            <th class="countCertificate">Platinum</th>
                            <th class=" countCertificate"></th>
                            <th class=" countCertificate"></th>
                            <th class=" countCertificate"></th>


                        </tr>
                        <tr class="" style="background-color: #e6fff2;">

                            <td><?php echo $row->bronze_count; ?></td>
                            <td><?php echo $row->silver_count; ?></td>
                            <td><?php echo $row->gold_count; ?></td>
                            <td><?php echo $row->platinum_count; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                    <table id="example" class="display bg-whit" cellspacing="0" width="100%">

                        <th colspan="15" class="" style="background-color: #FBC434; padding:12px;">Interns

                        </th>
                        <tr style="background-color: #ffffe6; ">
                            <td rowspan="9" colspan="6">
                                <div class="">
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h3 class="mb-2 fw-normal mt-2 internsstatewise internsstatecitywise internsdatehwise  internsmonthwise">
                                                    <?php echo $totalintinactive; ?></h3>
                                                <h5 class="fw-normal mb-0">Total Interns</h5>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h3 class="mb-2 fw-normal mt-2 ">
                                                    <i class="fa fa-female female_countintrn"><?php echo $female_countintrn; ?></i>

                                                </h3>
                                                <h5 class="fw-normal mb-0">Total Interns</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-4">
                                            <h3 class="mb-2 fw-normal mt-2 ">
                                                <i class="fa fa-male male_countintern"><?php echo $male_countintern; ?></i>
                                            </h3>
                                            <h5 class="fw-normal mb-0">Total Interns</h5>
                                        </div>

                                    </div>



                                </div>
                            </td>

                            <th class=" magic">Total Application
                                <hr><span class="magictext">Interns Applications received (till date)</span>
                            </th>
                            <th class=" magic">Pending Application
                                <hr><span class="magictext">Interns Pending Application (till date)</span>
                            </th>
                            <th class=" magic">Active
                                <hr><span class="magictext">Onborded Interns</span>
                            </th>
                            <!-- <th class="magic ">Inactive
                                <hr><span class="magictext">Interns Self Blocked & By admin Block</span>
                            </th> -->
                            <!-- <th class="magic ">Sleepy
                                <hr><span class="magictext">Interns Last Login Before One Month</span>
                            </th> -->
                            <th class=" magic">Male
                                <hr><span class="magictext">Interns Onborded male</span>
                            </th>
                            <th class=" magic">Female
                                <hr><span class="magictext">Interns Onborded female</span>
                            </th>
                            <hr>
                            </th>
                        </tr>
                        <tr style="background-color: #ffffe6;">
                            <td class="totalapplication_int"><?php echo $totalapplication; ?>
                                <hr>
                            <td class="totalapplication_pending_int">
                                <?php echo $totalapplication_pending_interns; ?>
                                <hr>

                            </td>
                            <td class="internsstatewise internsstatecitywise internsdatehwise  internsmonthwise">
                                <?php echo $totalintinactive; ?>
                                <hr>
                            </td>
                            <!-- <td class="inactiveInterns"><?php echo $totalvolinactive; ?>
                                <hr>
                            </td> -->
                            <!-- <td class="sleepyintern"><?php echo $sleepyintern; ?>
                                <hr>
                            </td> -->
                            <td class="male_countintern"><?php echo $male_countintern; ?>
                                <hr>
                            </td>
                            <td class="female_countintrn"><?php echo $female_countintrn; ?>
                                <hr>
                            </td>
                        </tr>

                        <th class="" style="background-color: #ffffe6;" colspan="6">Issue Certificate
                            <hr>
                        </th>
                        <tr style="background-color: #ffffe6;">

                            <th class="count_intern_send_certificate" colspan="9">
                                <?php echo $certificate_status; ?>
                                <hr>
                            </th>
                        </tr>
                    </table>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // function to retrieve data from server
        function getData() {
            let stateId = $('#state_name').val();
            let cityId = $('#city_name').val();
            // alert(cityId);
            // return false;
            let monthDate = $('#datepickerNoOfMonths').val();
            let datastr = {
                stateId: stateId,
                cityId: cityId,
                monthDate: monthDate
            };
            $.ajax({
                url: '<?php echo base_url() ?>data_state_city_datewise',
                type: 'post',
                dataType: "json",
                data: datastr,
                success: function(data) {
                    //              <---------------interns value start-------------------->
                    $(".count_intern_send_certificate").html(data.count_intern_send_certificate);
                    $(".inactiveInterns").html(data.inactiveInterns);
                    $(".sleepyintern").html(data.sleepyintern);
                    $(".male_countintern").html(data.male_countintern);
                    $(".female_countintrn").html(data.female_countintrn);
                    $(".totalapplication_pending_int").html(data.totalapplication_pending_int);
                    $(".totalapplication_int").html(data.totalapplication_int);
                    $(".internsmonthwise").html(data.internsmonthwise);
                    $('.internsstatewise').html(data.internsstatewise);
                    $('.internsdatehwise').html(data.internsdatehwise);
                    $('.internsstatecitywise').html(data.internsstatecitywise);

                    //   <---------------interns value End-------------------->

                    //   <---------------volunteers value Statrt-------------------->
                    // $(".count_intern_send_certificate").html(data.count_intern_send_certificate);
                    $(".active_volunteers").html(data.active_volunteers);
                    $(".pending_volunteers").html(data.pending_volunteers);
                    $(".volunteer_male_count").html(data.volunteer_male_count);
                    $(".volunteer_female_count").html(data.volunteer_female_count);
                   
                    //   <---------------volunteers value end-------------------->
                }
            });
        }

        // event listener for state change
        $('#state_name').on('change', function() {
            getData(); // call function to retrieve data
        });

        // event listener for city change
        $('#city_name').on('change', function() {
            getData(); // call function to retrieve data
        });

        // event listener for datepicker change
        $('#datepickerNoOfMonths').on('change', function() {
            getData(); // call function to retrieve data
        });

        // $(".internsmonthwise").html(data.internsmonthwise);
    });
</script>
<script>
    $(document).ready(function() {
        $("#region_id").change(function() {
            var region_id = $(this).val();
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
        $("#state_name").change(function() {
            var state_name = $(this).val();
            //alert(region_id);
            datastr = {
                state_name: state_name
            };

            $.ajax({
                url: '<?php echo base_url() ?>get-city-by-task',
                type: 'post',
                data: datastr,
                success: function(response) {
                    $("#city_name").html(response);
                    // $('select').selectpicker('refresh');
                }
            });
        });

    });
</script>