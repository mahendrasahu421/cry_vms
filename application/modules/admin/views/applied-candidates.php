<div class="modal fade profile-details" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title " id="exampleModalLabel">
                    Profile Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body row" id="profile_details" style="height:480px; overflow:scroll">
            </div>
            <div class="modal-footer bg-default">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Applied Candidates</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page">Applied Candidates</li>
                    </ol>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="applied-candidates" method="post" id="form">
                            <div class="card-header">
                                <div class="col-md-3">
                                    <input type="hidden" name="regionId" value="<?php $regionId = $this->session->userdata('region_id'); ?>">
                                    <?php $regionId = $this->session->userdata('region_id'); ?>
                                    <lable>Select Region</lable> &nbsp;<i class="fa fa-info magic"><span class="magictext">Use this tab only if you wish to see region specific candidates</span></i> 
                                    <select class="form-control select2-show-search form-select" name="region_id" id="region_id">
                                        <option value="99">All</option>
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
                                    <lable>Select State</lable> &nbsp;<i class="fa fa-info magic"><span class="magictext">Use this tab only if you wish to see state specific candidates</span></i> <select class="form-control select2-show-search form-select" name="state_name" id="state_name">
                                        <option value="">Select State</option>
                                        <?php foreach ($states as $sd) { ?>
                                            <option value="<?php echo $sd['state_id']; ?>" <?php echo $state == $sd['state_id'] ? "selected" : ""; ?>>
                                                <?php echo $sd['state_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <lable>Select Status</lable> &nbsp;<i class="fa fa-info magic"><span class="magictext">Select Status</span></i> <select class="form-control select2-show-search form-select" name="candidate_staus" id="candidate_staus">
                                        <option value="">Select Status</option>
                                        <option value="1">Onboarding-Candidate</option>
                                        <option value="2">Shortlisted</option>
                                        <option value="3">Interview Scheduled</option>
                                        <option value="4">Interview Ongoing</option>
                                        <option value="5">Interview Cleared</option>
                                        <option value="6">Sent Offer Letter</option>
                                        <option value="7">Registraion Completed</option>
                                        <option value="8">CRY intern</option>
                                        <option value="0">Candidate Rejected</option>

                                    </select>
                                </div>

                                <div class="col-lg-2">
                                    <lable>Select start date</lable> &nbsp;<i class="fa fa-info magic"><span class="magictext">Select start date</span></i>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="start_new" value="<?php echo date("m/d/Y", strtotime($date_from)) ?>" required placeholder="To" id="toDate" type="text">
                                    </div>
                                </div>
                                <strong style="font-size: 15px; font:900">To</strong>
                                <div class="col-lg-2">
                                    <lable>Select end date</lable> &nbsp;<i class="fa fa-info magic"><span class="magictext">Select end date</span></i>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="end_new" value="<?php echo date("m/d/Y", strtotime($date_to)) ?>" required placeholder="From" id="fromDate" type="text">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group  p-0">
                                        <button type="submit" name="submit" id="searchData" class="input-group-text btn btn-warning">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead class="bg-gray-light">
                                        <tr>
                                            <th>Sr. No</th>
                                            <th>Request Date</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Skill</th>
                                            <th>View CV</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($intern as $internData) {
                                            $intern_id = $internData['intern_id'];
                                            $internEmail = $internData['email'];
                                            $encoded_id = rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $count++; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d-m-Y', strtotime($internData['creation_date'])); ?>
                                                </td>
                                                <td>
                                                    <?php echo ucwords($internData['first_name'] . ' ' . $internData['last_name']); ?>
                                                    <br>
                                                    <a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encoded_id; ?>','profile_details');">
                                                        <small class="text-primary">(View Profile)</small></a>
                                                </td>
                                                <td><?php echo $internEmail; ?></td>
                                                <td><?php echo $internData['mobile']; ?>
                                                <td><?php echo $internData['skill_name']; ?></td>
                                                <td> <?php if ($internData['cv_file'] == NULL) { ?>
                                                        <span><a href="#">NA</a></span>
                                                    <?php } else { ?>
                                                        <span><a href="<?php echo base_url(); ?>uploads/<?php echo $internData['cv_file']; ?>" target="_blank">View CV</a></span>
                                                    <?php } ?>
                                                </td>

                                                <td>

                                                    <a href="<?php echo base_url(); ?>hr-process/<?php echo $encoded_id; ?>" class="badge rounded-pill bg-info me-1 mb-1 mt-1">
                                                        <?php echo $this->Admin_model->check_status($internData['status']); ?>

                                                    </a>

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

<!-- <script>
    $(document).ready(function() {
        let region_id = $('#region_id').val();
        if (region_id != null) {
            $('#region_id option:not(:selected)').attr('disabled', true);
        }
    });
</script> -->
<script>
    function fetch_details(id, display_id) {
        //alert(id);
        $('#' + display_id).html(
            '<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>'
        );
        var request = $.ajax({
            url: '<?php echo base_url("fetch-user-info-intern"); ?>',
            method: "POST",
            data: {
                intern_id: id
            },
            success: function(results) {
                $('#' + display_id).html(results);
            }
        });
    }
</script>
<script>
    let example = $('#example').DataTable({
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        order: [
            [1, 'asc']
        ]
    });
    example.on("click", "th.select-checkbox", function() {
        if ($("th.select-checkbox").hasClass("selected")) {
            example.rows().deselect();
            $("th.select-checkbox").removeClass("selected");
        } else {
            example.rows().select();
            $("th.select-checkbox").addClass("selected");
        }
    }).on("select deselect", function() {
        ("Some selection or deselection going on")
        if (example.rows({
                selected: true
            }).count() !== example.rows().count()) {
            $("th.select-checkbox").removeClass("selected");
        } else {
            $("th.select-checkbox").addClass("selected");
        }

    });
</script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

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