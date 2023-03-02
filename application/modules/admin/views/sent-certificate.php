<style>
.card {
    position: relative;
    margin-bottom: 1.5rem;
    width: 100%;
}
</style>
<!-- <?php print_r(
			$_POST['ids']
		); ?> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css"
    integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="modal fade profile-details" id="exampleModal1" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Profile Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body row" id="profile_details">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Sent Certificate</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sent Certificate</li>
                    </ol>
                </div>
                <div class="ms-auto pageheader-btn" id="flip">
                    <a href="javascript:void(0);">
                        <!-- <span>
							<i class="fe fe-plus"></i>
						</span> View Filters -->
                    </a>
                    <div class="count-checkboxes-wrapper fs-6">
                        <span id="count-checked-checkboxes">0</span> checked
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class=""><strong>Email Template Content</strong></div>
                            </div>

                            <div class="col-md-12 mt-3"><textarea class="content" id="emialcontent"
                                    name="example"><?php echo $final_offerdata; ?></textarea></div>
                            <div class="modal-footer">

                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" id="saveOfferLatter" data-dismiss="modal">
                            Save
                        </button>
                    </div>
                </div>
            </div>
            <style>
            #success_msg {
                color: black;
                margin-bottom: 15px;
                font-size: 20px;
            }
            </style>
            <input type="hidden" value="<?php echo $feedbackCertifecate[0]['email'];?>" id="interncertificateEmail">
            <p id="success_msg"></p>
            <!-- <?php echo $this->session->flashdata('master_insert_message'); ?> -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="sent-certificate" method="post" id="form">
                            <div class="card-header">
                                <div class="col-md-3">
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
																							} ?>><?php echo $rd['region_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control select2-show-search form-select" name="state_name"
                                        id="state_name">
                                        <option value="">Select State</option>
                                        <?php foreach ($states as $sd) { ?>
                                        <option value="<?php echo $sd['state_id']; ?>"
                                            <?php echo $state == $sd['state_id'] ? "selected" : ""; ?>>
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
                        <div class="col-md-2 mt-5">

                        </div>
                        <form method="post" action="send_orientation_emails" id="id-form">
                            <input type="hidden" value="" id="ids" name="ids">

                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example" class="display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="bg-gray-light">
                                                <th><input class="che" id="chkParent" name="numchec[]" value="1"
                                                        type="checkbox"></th>
                                                <th>Reg. Date</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>State</th>
                                                <th>Districts</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$count = 1;
											foreach ($feedbackCertifecate as $internData) {
												$intern_id = $internData['intern_id'];
												$internEmail = $internData['email'];
												$encoded_id = rtrim(strtr(base64_encode($intern_id), '+/', '-_'), '=');
											?>
                                            <tr>
                                                <td>
                                                    <input class="che" id="intern_id" name="numchec"
                                                        value="<?php echo $intern_id; ?>" type="checkbox">
                                                </td>
                                                <td>
                                                    <?php echo date("d-m-Y", strtotime($internData['creation_date'])); ?>
                                                </td>
                                                <td>
                                                    <?php echo ucwords($internData['first_name'] . ' ' . $internData['last_name']); ?>
                                                    <br>
                                                    <a href="#" data-toggle="modal" data-target=".profile-details"
                                                        onclick="fetch_details('<?php echo $encoded_id; ?>','profile_details');">
                                                        <small class="text-primary">(View Profile)</small></a>
                                                </td>
                                                <td><?php echo $internData['mobile']; ?>
                                                </td>
                                                <td><?php echo $internData['state_name']; ?></td>
                                                <td><?php echo $internData['city_name']; ?></td>
                                                <td><?php echo $internEmail; ?></td>
                                                <td>
                                                <button type="button" class="btn btn-primary"
                                                        data-toggle="modal" data-target=".bd-example-modal-lg"
                                                        style="padding: 1% 2% 1% 2%;">Edit And
                                                        Update</button>
                                                    <button type="button" class="btn btn-warning" id="preview">
                                                        <a href="<?php echo base_url() ?>view_certificate/<?php echo $encoded_id; ?>"
                                                            target="_blank">Preview </a>
                                                    </button>
                                                  
                                                    <?php if ($internData['status'] == 3) { ?>
                                                    <button type='button' class='badge bg-warning '> <a
                                                            href="<?php echo base_url() ?>send_certificate_on_mail/<?php echo $encoded_id; ?>">Already
                                                            Send Certificate
                                                        </a></button>
                                                    <?php } else { ?>
                                                    <button type='button' class='badge bg-info'><a
                                                            href="<?php echo base_url() ?>send_certificate_on_mail/<?php echo $encoded_id; ?>">Send
                                                            Certificate
                                                        </a>
                                                    </button>

                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
											} ?>
                                        </tbody>
                                    </table>


                                    <input type="hidden" name="emailContentValue" id="emailContentValue">



                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<script>
$('#saveOfferLatter').click(function() {
    var intern_id = $('#intern_id').val();
    var intern_email = $('#interncertificateEmail').val();
    var emialcontent = $('#emialcontent').val();
    //alert(emialcontent);

    datastr = {
        intern_id: intern_id,
        intern_email: intern_email,
        emialcontent: emialcontent
    };

    $.ajax({
        url: '<?php echo base_url() ?>update_certificate_data',
        type: 'post',
        data: datastr,
        success: function(response) {

            alert('Update Success');
            // $('#success_msg').html(
            //     'Orientation Mail Sent Successfully');

        }
    });

});
</script>
<!-- <script>
$(document).ready(function() {
    let region_id = $('#region_id').val();
    if (region_id == null) {

    } else {
        $('#region_id option:not(:selected)').attr('disabled', true);
    }

});
</script> -->


<script>
function getId_sendmail(internEmail) {
    var intern_sendId = internEmail;
    var emailContentValue = $('#emailContentValue').val();

    if (emailContentValue == "") {
        alert('Please Check Mail Format');
        return false;
    }
    datastr = {
        intern_sendId: internEmail,
        emailContentValue: emailContentValue
    };

    $.ajax({
        url: '<?php echo base_url() ?>send_orientation_emails',
        type: 'post',
        data: datastr,
        success: function(response) {
            $('#success_msg').html('Orientation Mail Sent Successfully');

        }
    });

}
</script>

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
            // console.log(results);
            //alert(results);
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
                // $('select').selectpicker('refresh');
            }
        });
    });

});
</script>



<script>
$(document).on('click', '#submit3', function() {
    var matches = [];
    var table = $('#file-datatable').dataTable();
    var checkedcollection = table.$(".che:checked", {
        "page": "all"
    });
    checkedcollection.each(function(index, elem) {
        matches.push($(elem).val());
    });
    var AccountsJsonString = JSON.stringify(matches);
    console.log(AccountsJsonString);
    alert(AccountsJsonString);
    $('#ids').val(AccountsJsonString);
    $('#id-form').submit();
});
</script>

<script>
$(document).ready(function() {
    $('#chkParent').click(function() {
        var isChecked = $(this).prop("checked");
        $('#example tr:has(td)').find('input[type="checkbox"]').prop('checked', isChecked);
    });

    $('#example tr:has(td)').find('input[type="checkbox"]').click(function() {
        var isChecked = $(this).prop("checked");
        var isHeaderChecked = $("#chkParent").prop("checked");
        if (isChecked == false && isHeaderChecked)
            $("#chkParent").prop('checked', isChecked);
        else {
            $('#example tr:has(td)').find('input[type="checkbox"]').each(function() {
                if ($(this).prop("checked") == false)
                    isChecked = false;
            });
            console.log(isChecked);
            $("#chkParent").prop('checked', isChecked);
        }
    });
});


$(document).ready(function() {
    var $checkboxes = $('#id-form td input[type="checkbox"]');
    $checkboxes.change(function() {
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        $('#count-checked-checkboxes').text(countCheckedCheckboxes);
        $('#edit-count-checked-checkboxes').val(countCheckedCheckboxes);
    });
});
</script>