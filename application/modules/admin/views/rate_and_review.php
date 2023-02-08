<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <table>TASK REPORT STATUS</table>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="modal-body">

                        <div class="row form-group m-b-20">
                            <!-- <div class="col-md-3">
												<h4 class="f-16  m-0 p-0 font-weight-bold">Choose Status</h4>
											</div> -->
                            <div class="col-md-12">

                                <h4 class="f-16  m-0 p-0 font-weight-bold">Choose Status</h4>

                            </div>
                        </div>
                        <div class="row form-group m-b-20">

                            <div class="col-md-12">
                                <input type="number" name="taskID" id="taskID" value="0" style="display:none;">
                                <select class="form-control custom-select" name="taskStatus" required data-placeholder="Choose a Category" tabindex="1" id="mylist" onchange="yesnoCheck(this);">
                                    <option value="">Select Status</option>
                                    <option id="ts0" value="0">Pending</option>
                                    <option id="ts2" value="2">In-working</option>
                                    <option id="ts1" value="1">Complete</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-rounded btn-primary">Save</button>
                        <button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php
if ($this->session->userdata('task_add')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successfull!</strong> <?php echo ucwords($this->session->userdata('task_add')); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php $this->session->unset_userdata('task_add');
} ?>
<?php
if ($this->session->userdata('task_status')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successfull!</strong> <?php echo ucwords($this->session->userdata('task_status')); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php $this->session->unset_userdata('task_status');
} ?>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- AGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                    Rate And Review</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page">Rate And Review</li>
                    </ol>
                </div>
                
            </div>
            <?php echo $this->session->userdata('master_insert_message'); ?>
            <style>
                ul#menu li {
                    display: inline;
                }
            </style>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">

                        <form action="rate_and_review" method="post">
                            <div class="card-header">
                                <div class="col-md-2">
                                    <input type="hidden" name="regionId" value="<?php $regionId = $this->session->userdata('region_id'); ?>">
                                    <?php $regionId = $this->session->userdata('region_id'); ?>
                                    <select class="form-control select2-show-search form-select" name="region_id" id="region_id">
                                        <option selected disabled value="">Select Region</option>
                                        <?php foreach ($regions as $rd) {
                                        ?>
                                            <option value="<?php echo $rd['region_id']; ?>" <?php echo $region_id == $rd['region_id'] ?
                                                                                                'selected' : '';
                                                                                            ?>><?php echo $rd['region_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3 state">
                                    <select class="form-control select2-show-search form-select" name="state_name" id="state_name">
                                        <option value="">Select State</option>
                                        <?php foreach ($states as $sd) { ?>
                                            <option value="<?php echo $sd['state_id']; ?>" <?php echo $states == $sd['state_id'] ? 'selected' : ''; ?>>
                                                <?php echo $sd['state_name']; ?>
                                            </option>

                                        <?php } ?>
                                    </select>
                                </div>


                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="start_new" value="<?php echo date("m/d/Y", strtotime($date_from)) ?>" required placeholder="To" id="toDate" type="text">
                                    </div>
                                </div>
                                <strong style="font-size: 15px; font:900">To</strong>
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="end_new" value="<?php echo date("m/d/Y", strtotime($date_to)) ?>" required placeholder="From" id="fromDate" type="text">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group  p-0">
                                        <button type="submit" name="submit" id="searchData" class="input-group-text btn btn-warning">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card-body">
                           
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr class="bg-gray-light">
                                           
                                            <th>Sr.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>View Rating</th>
                                          

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($rateingData as $rateAndReviewData) {
                                            $intern_id = $rateAndReviewData['intern_id'];
                                            $encode_taskID = rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
                                        ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $rateAndReviewData['first_name']." ".$rateAndReviewData['last_name']; ?></td>
                                                <td>
                                                    <?php echo$rateAndReviewData['email']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rateAndReviewData['mobile']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rateAndReviewData['city_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rateAndReviewData['state_name']; ?>
                                                </td>
                                                <td>
                                                <span class="badge bg-warning  me-1 mb-1 mt-1"> <a href="<?php echo base_url() ?>view_rating/<?php echo $encode_taskID;?>">View FeedBack</a></span>
                                                   
                                                </td>
                                             
                                                

                                            </tr>
                                        <?php
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
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script>
    $(document).ready(function() {
        let region_id = $('#region_id').val();
        if (region_id == null) {
            $('#region_id option:not(:selected)').attr('disabled', true);
        }

    });
</script> -->
<script>
    $(document).ready(function() {

    });
</script>
<script>
    $(document).ready(function() {
        $('#taskType').change(function() {
            var taskType = $('#taskType').val();
            //alert(taskType);
            if (taskType == 1) {
                $('.state').hide();
            } else {
                $('.state').show();

            }
        });
    });
</script>
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
    });
</script>
<script>
    function add_edit_cause(taskStatus, taskID) {
        // alert(title);
        // $('#modal_title').html(title);
        // $('#cause').val(causeName);
        // $('#oldimage').val(causeImage);
        $('#taskID').val(taskID);
        $('#ts0').removeAttr('selected');
        $('#ts1').removeAttr('selected');
        $('#ts1').removeAttr('selected');
        $('#ts' + taskStatus).attr('selected', 'selected');
    }
</script>