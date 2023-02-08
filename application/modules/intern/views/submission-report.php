<style>
#basic-addon2 {
    width: 100px;
    height: 40px;
}
</style>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Final Submission Report</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Final Submission Report</li>
                    </ol>
                </div>
            </div>
            <?php
            if ($this->session->userdata('data_message')) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successfull!</strong> Submission Report Has Been Inserted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $this->session->unset_userdata('data_message');
            } ?>
            <div class="card">
                <form autocomplete="off" method="post" action="insert_submission_report" enctype="multipart/form-data">
                    <div class="card-header bg-warning">
                        <h3 class="card-title text-white">Add Submission Report</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label"> Task</label>
                                <?php foreach ($assign_taskIntern as $task) { ?>
                                <span class="badge bg-info  me-1 mb-1 mt-1" name="submissionassign_task[]"
                                    value="<?php echo $task['intern_assigned_task_id'] ?>"
                                    id="submissionassign_task"><?php echo $task['task_title'] ?></span>
                                <?php } ?>

                                <div class="valid-feedback">
                                    <?php echo form_error('tasktitle', '<div class="error">', '</div>'); ?></div>
                            </div>



                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Write Project
                                    Description</small></label>
                                <textarea class="form-control" placeholder="How Could it be Improved" rows="3"
                                    name="projectDescription"></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Add Images
                                    </label>
                                    <div class="col-sm-7 field_wrapper">
                                        <input type="file" class="form-control img profileImageFormForTask"
                                            name="attecment[]" id="#img" accept=".pdf" multiple/>
                                        <label for="#"></label>

                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-primary add_button"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>

                            </div>


                        </div>

                        <br>
                        <div class="col-md-12">
                            <h2>Submit Feedback</h2>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Name of the Department you interned in
                                (mark the primary one in terms of time spent if you worked with more than
                                one)</small></label>
                            <select class="form-control" id="exampleFormControlSelect1" name="name_of_theDepartment"
                                required>
                                <option value="">Name of the Department you interned in (mark the primary one in terms
                                    of time spent if you worked with more than one)</option>
                                <option value="VA">VA</option>
                                <option value="DS">DS</option>
                                <option value="RG">RG</option>
                                <option value="Comm">Comm</option>
                                <option value="BZ/Admin">BZ/ Admin</option>
                                <option value="HR">HR</option>
                                <option value="Finance">Finance</option>
                                <option value="IT">IT</option>
                                <option value="PRAD/ MA">PRAD/ MA</option>
                                <option value="Planning/ GRM">Planning/ GRM</option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Name and address of the institution
                                *</label>
                            <input type="text" class="form-control" name="intern_institution" value=""
                                id="dailyReportTimeIn" placeholder="Name and address of the institutionthe institution"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">City of Internship (choose online if you
                                worked from remote)
                                *</small></label>
                            <select class="form-control" id="exampleFormControlSelect1" name="cityInternship" required>
                                <option value="">City of Internship</option>
                                <option value="Delhi">Delhi</option>
                                <option value="mumbai">mumbai</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="banglore">banglore</option>
                                <option value="Channai">Channai</option>
                                <option value="hydrabad">Hydrabad</option>
                                <option value="Online">Online</option>


                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Nature of assignment (choose the primary
                                theme if you handled more than one)
                                *</small></label>
                            <select class="form-control" id="exampleFormControlSelect1" name="natureofAssignment"
                                required>
                                <option value="">Nature of assignment</option>
                                <option value="Primary/ secondary research">Primary/ secondary research</option>
                                <option value="data analysis">data analysis</option>
                                <option value="Documentation (report writing/ photo essays, presentations/ modules..)">
                                    Documentation (report writing/ photo essays, presentations/ modules..)</option>
                                <option value="Campaign/ fund raising">Campaign/ fund raising</option>
                                <option value="layout/ design">layout/ design</option>
                                <option value="Programme evaluations/ mapping">Programme evaluations/ mapping</option>
                                <option value="event coordination">event coordination</option>
                                <option value="stakeholder management">stakeholder management</option>
                                <option value="other">other</option>


                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button id="submit" name="submit" value="submit"
                            class="btn btn-warning pull-right mb-3 mt-5">Submit</button>
                    </div>
            </div>
        </div>
        </form>

    </div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML =
        '<div class="addblockclick"><br>  <input type="file" name="attecment[]" value="" placeholder="Phone"/> <a href="javascript:void(0);" class="remove_button">X</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function() {

        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>