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
            <!-- <form action="<?php echo base_url(); ?>admin-dashboard" method="post">
                <div class="card p-3">
                    <div class="card-status bg-warning br-tr-7 br-tl-7"></div>
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control select2-show-search form-select" name="region_id" id="region_id" required>
                                <option selected disabled value="">Select Region</option>
                                <?php foreach ($regions as $rd) {
                                ?>
                                    <option value="<?php echo $rd['region_id']; ?>" <?php if ($rd['region_id'] == $selectedRegionId) echo "selected='selected'"; ?>><?php echo $rd['region_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control select2-show-search form-select" name="state_name" id="state_name" required multiple>
                                <?php foreach ($states as $sd) { ?>
                                    <option value="<?php echo $sd['state_id']; ?>" <?php if ($sd['state_id'] == $sid) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                        <?php echo $sd['state_name']; ?>
                                    </option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-warning" type="button" name="search" id="searchData">Search</button>
                        </div>
                    </div>
                </div>
            </form> -->

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
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Task Wise Hours</h3>

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
                                            <th style="text-transform: capitalize;"><b>S.no</b></th>
                                            <th style="text-transform: capitalize;"><b>Published Date</b></th>
                                            <th style="text-transform: capitalize;"><b>Task Title</b></th>
                                            <th style="text-transform: capitalize;"><b>Total Volunteer</b></th>
                                            <th style="text-transform: capitalize;"><b>Total Hours</b></th>
                                            <th style="text-transform: capitalize;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>20/07/2021</td>
                                            <td>Volunteer with IT Department</td>
                                            <td>1</td>
                                            <td>468 Hour 5 Mins</td>
                                            <td>
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">

                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="view-task">View Task </a></li>
                                                        <li><a href="view-daily-report">Daily Report </a></li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>28/09/2021</td>
                                            <td>Volunteer with IT Department</td>
                                            <td>1</td>
                                            <td>40 Hour 5 Mins</td>
                                            <td>
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">

                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="view-task">View Task </a></li>
                                                        <li><a href="view-daily-report">Daily Report </a></li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- <?php $i = 1;
                                                foreach ($task as $key => $value) {
                                                    $publishdate = $value['taskPublishedDate'];
                                                    $encode_taskID = rtrim(strtr(base64_encode($value['taskID']), "+/", "-_"), "=");
                                                ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td class="wid-150"><?php echo date("d/m/Y", strtotime($publishdate)); ?></td>
                                                <td><?php echo $value['taskTitle']; ?></td>

                                                <?php $this->load->model('curl/Curl_model');
                                                    $join_data = array(
                                                        array(
                                                            'table' => 'daily_report',
                                                            'fields' => array('dailyReportID'),
                                                            'joinWith' => array('approveddaily_ID', 'left'),
                                                            'where' => array('approveddaily_ID !' => 0, 'taskID' => $value['taskID']),
                                                            'group_by' => array('approveddaily_ID'),
                                                        ),
                                                        array(
                                                            'joined' => 0,
                                                            'table' => 'task',
                                                            'fields' => array('taskID'),
                                                            'joinWith' => array('taskID', 'left'),
                                                        ),
                                                        array(
                                                            'joined' => 0,
                                                            'table' => 'approveddaily_report',
                                                            'fields' => array('admin_time'),
                                                            'joinWith' => array('approveddaily_ID', 'left'),
                                                        ),
                                                    );
                                                    $limit = '';
                                                    $order_by = '';
                                                    $totalReport = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
                                                    //print_r($totalReport);
                                                    $h = 0;
                                                    $s = 0;
                                                    foreach ($totalReport as $key => $value) {
                                                        $splt_admin_time = explode('.', $value['admin_time']);
                                                        $h += $splt_admin_time[0];
                                                        $s += $splt_admin_time[1];
                                                    }
                                                    $sss = $s % 60;
                                                    $h += ($s - $sss) / 60;
                                                    // echo $h.' Hours ';
                                                    // echo $sss.' Mins';
                                                ?>
                                                <td>
                                                    <?php
                                                    $join_data = array(
                                                        array(
                                                            'table' => 'assigning_task',
                                                            'fields' => array('accepted_date', 'rejected_date', 'resionID', 'other_reason', 'assigningTaskID', 'reminder'),
                                                            'joinWith' => array('userID'),
                                                            'where' => array(
                                                                'taskID' => $value['taskID'],
                                                                'status' => 1
                                                            ),
                                                        ),
                                                    );
                                                    $limit = '';
                                                    $order_by = '';
                                                    echo $totalReport = sizeof($this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by));
                                                    ?>
                                                </td>
                                                <td><?php echo "<b>$h</b> Hour <b>$sss</b> Mins</b>";
                                                    //echo $interv;
                                                    ?></td>
                                                <td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu">
                                                        <a href="view-task/<?php echo $encode_taskID; ?>" class="dropdown-item">View Task</a>
                                                        <a href="view-daily-report?taskID=<?php echo $value['taskID']; ?>&asdate=<?php echo date("d-m-Y", strtotime($publishdate)); ?>" class="dropdown-item" href="#">Daily Report</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                                } ?>
                                        <tr> -->

                                        <th></th>
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