<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- AGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title"> Intern Task Report</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page"> Intern Task Report</li>
                    </ol>
                </div>

            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">

                        <form action="#" method="post">
                            <div class="card-header">
                                <div class="col-md-2">
                                    <input type="hidden" name="regionId"
                                        value="<?php $regionId = $this->session->userdata('region_id'); ?>">
                                    <?php $regionId = $this->session->userdata('region_id'); ?>
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

                                <div class="col-md-2">
                                    <select class="form-control select2-show-search form-select" name="taskType"
                                        id="taskType" required>
                                        <option value="">Select Task Type</option>
                                        <?php foreach ($taskType as $tt) {
                                        ?>
                                        <option value="<?php echo $tt['task_type_id']; ?>"
                                            <?php echo $StaskType == $tt['task_type_id'] ? 'selected' : ''; ?>>
                                            <?php echo $tt['task_type'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-3 state">
                                    <select class="form-control select2-show-search form-select" name="state_name"
                                        id="state_name">
                                        <option value="">Select State</option>
                                        <?php foreach ($states as $sd) { ?>
                                        <option value="<?php echo $sd['state_id']; ?>"
                                            <?php echo $Tstate_name == $sd['state_id'] ? 'selected' : ''; ?>>
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
                                        <input class="form-control fc-datepicker" name="start_new"
                                            value="<?php echo date("m/d/Y", strtotime($date_from)) ?>" required
                                            placeholder="To" id="toDate" type="text">
                                    </div>
                                </div>
                                <strong style="font-size: 15px; font:900">To</strong>
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="end_new"
                                            value="<?php echo date("m/d/Y", strtotime($date_to)) ?>" required
                                            placeholder="From" id="fromDate" type="text">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group  p-0">
                                        <button type="submit" name="submit" id="searchData"
                                            class="input-group-text btn btn-warning">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="intern_task_exportToexcel" method="POST">
                                        <button class="btn btn-warning mt-3 mx-5">Export To Excel</button>
                        </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr class="bg-gray-light">
                                            <th></th>
                                            <th>Published Date</th>
                                            <th>keyword</th>
                                            <th>Task Name</th>
                                            <th>Task Brif</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($interntaskData as $taskdataBydate) {
                                            $value = $taskdataBydate['task_status'];
                                            $task_id = $taskdataBydate['task_id'];
                                            $encode_taskID = rtrim(strtr(base64_encode($task_id), '+/', '-_'), '=');
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $taskdataBydate['creation_date']; ?></td>
                                            <td>
                                                <?php echo wordwrap(ucwords($taskdataBydate['keyword']), 30, "<br>\n"); ?>
                                            </td>
                                            <td>
                                                <?php echo wordwrap(ucwords($taskdataBydate['task_title']), 30, "<br>\n"); ?>
                                            </td>
                                            <td>
                                                <?php echo wordwrap(ucwords($taskdataBydate['task_brief']), 30, "<br>\n"); ?>
                                            </td>
                                            <?php if ($taskdataBydate['status'] == 1) { ?>
                                            <td><span class="badge rounded-pill bg-info me-1 mb-1 mt-1">Published</span>
                                            </td>
                                            <?php } else { ?>
                                            <td><span
                                                    class="badge rounded-pill bg-danger me-1 mb-1 mt-1">Unpublished</span>
                                            </td>
                                            <?php } ?>
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
<script>
$(document).ready(function() {
    let region_id = $('#region_id').val();
    if (region_id != null) {
        $('#region_id option:not(:selected)').attr('disabled', true);
    }

});
</script>
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