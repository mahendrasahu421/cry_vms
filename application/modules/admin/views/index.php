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
                                                    <i
                                                        class="fa fa-female fs-40 female-count"><?php echo $totalfemale[0]['COUNT(*)']; ?></i>

                                                </h2>
                                                <h5 class="fw-normal mb-0">Total Volunteer</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-4">
                                            <h2 class="mb-2 fw-normal mt-2 ">
                                                <i
                                                    class="fa fa-male fs-40 male-count"><?php echo $totalmale[0]['COUNT(*)']; ?></i>
                                            </h2>
                                            <h5 class="fw-normal mb-0">Total Volunteer</h5>
                                        </div>

                                    </div>



                                </div>
                            </td>
                            <th class="fs-17">Active</th>
                            <th class="magic fs-17">Inactive<span class="magictext">Self Blocked & By admin Block</span>
                            </th>
                            <th class="magic fs-17">Sleepy <span class="magictext">Last Login Before One Month</span>
                            </th>
                            <th class="fs-17">Male</th>
                            <th class="fs-17">Female</th>
                        </tr>
                        <tr>
                            <td class="totalvol fs-30"><?php echo count($totalvolunteer); ?></td>
                            <td class="totalvolinactive fs-30"><?php echo $totalvolinactive; ?></td>
                            <td class="sleepyvol fs-30"><?php echo $sleepyvol; ?></td>
                            <td class="male-count fs-30"><?php echo $totalmale[0]['COUNT(*)']; ?></td>
                            <td class="female-count fs-30"><?php echo $totalfemale[0]['COUNT(*)']; ?></td>
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

                            <td><?php echo $row->bronze_count;?></td>
                            <td><?php echo $row->silver_count;?></td>
                            <td><?php echo $row->gold_count;?></td>
                            <td><?php echo $row->platinum_count;?></td>
                        </tr>
                    </table>

                    <table id="example" class="display bg-white mt-4" cellspacing="0" width="100%">
                        <th colspan="6" class="fs-20 mx-5 mt-5">Interns
                            <hr>
                        </th>
                        <th colspan="6" class="fs-20"></th>


                        <tr>
                            <td rowspan="9" colspan="6">
                                <div class="">
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="card-body p-4">

                                                <h2 class="mb-2 fw-normal mt-2 totalintactive">
                                                    <?php echo $totalintinactive; ?></h2>
                                                <h5 class="fw-normal mb-0">Total Interns</h5>
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
                                                    <i
                                                        class="fa fa-female fs-40 female_countintrn"><?php echo $female_countintrn; ?></i>

                                                </h2>
                                                <h5 class="fw-normal mb-0">Total Interns</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-4">
                                            <h2 class="mb-2 fw-normal mt-2 ">
                                                <i
                                                    class="fa fa-male fs-40 male_countintern"><?php echo $male_countintern; ?></i>
                                            </h2>
                                            <h5 class="fw-normal mb-0">Total Interns</h5>
                                        </div>

                                    </div>



                                </div>
                            </td>
                            <th class="fs-17">Active
                                <hr>
                            </th>
                            <th class="magic fs-17">Inactive
                                <hr><span class="magictext">Self Blocked & By admin Block</span>
                            </th>
                            <th class="magic fs-17">Sleepy
                                <hr><span class="magictext">Last Login Before One Month</span>
                            </th>
                            <th class="fs-17">Male
                                <hr>
                            </th>
                            <th class="fs-17">Female
                                <hr>
                            </th>
                        </tr>
                        <tr>
                            <td class="totalintactive fs-30"><?php echo $totalintinactive; ?>
                                <hr>
                            </td>
                            <td class="totalvolinactive fs-30"><?php echo $totalvolinactive; ?>
                                <hr>
                            </td>
                            <td class="sleepyintern fs-30"><?php echo $sleepyintern; ?>
                                <hr>
                            </td>
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

                            <th class="certificate_status fs-30"><?php echo $certificate_status; ?>
                                <hr>
                            </th>
                        </tr>
                    </table>

                    <div class="row mt-5">
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
                                            <td><a href="<?php echo base_url(); ?>enquiry"><span
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
                $(".sleepyintern").html(data.sleepyintern);
                $(".male_countintern").html(data.male_countintern);
                $(".totalintactive").html(data.totalintactive);
                $(".female_countintrn").html(data.female_countintrn);
                $(".certificate_status").html(data.certificate_status);
                $(".countCertificate").html(data.countCertificate);
            }
        });
    });
});
</script>