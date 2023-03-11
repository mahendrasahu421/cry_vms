<?php $base_url = base_url() . 'admin/'; ?>
<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon"
        href="<?php echo base_url('admin/'); ?>assets/images/brand/favicon.png" />

  <!-- TITLE -->
  <title>CRY : VMS</title>

  <!-- BOOTSTRAP CSS -->
  <link id=" style" href="<?php echo base_url('admin/'); ?>assets/plugins/bootstrap/css/bootstrap.min.css"
        rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="<?php echo base_url('admin/'); ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/dark-style.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/skin-modes.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/transparent-style.css" rel="stylesheet" />
    <link href="<?php echo base_url('admin/'); ?>assets/css/animated.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="<?php echo base_url('admin/'); ?>assets/css/icons.css" rel="stylesheet" />
    <link type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"
        rel="stylesheet">

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="<?php echo base_url('admin/'); ?>assets/colors/color1.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

</head>
<style>
select.form-control:not([size]):not([multiple]) {
    height: 3.375rem;
}

.login100-form {
    width: 573px;

}

@media (max-width: 992px) {
    .login100-form {
        width: 100%;
    }
}

.login100-form {
    /* width: 320px; */
}


.form-label {
    display: block;
    margin-bottom: 0.375rem;
    font-weight: 500;
    font-size: 1.40rem;
    margin-top: 9px;
}

.error {
    width: 100%;
    text-align: left;
    color: red;
}

#calendar_details_b2c,
#calendar_details_b2b {
    display: none;
}

.select2-container .select2-selection--single {
    height: 3.375rem !important;
}
</style>

<body>

    <!-- BACKGROUND-IMAGE -->
    <div class="bg-warning">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="<?php echo base_url('users/'); ?>assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <!-- <?php echo $this->session->userdata('master_insert_message'); ?> -->

        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">

                    <div class="text-center mt-5">
                        <img src="<?php echo base_url('users/'); ?>
                        assets/images/brand/ezgif.com-gif-maker.gif" style="border-radius:10px;" class="" alt="">
                    </div>
                </div>
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="assets/images/brand/logo.png" class="header-brand-img" alt="">
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-0">
                        <div class="card-header">
                            <span class="login100-form-title">Post Registration Intern</span>
                        </div>
                        <style>
                        #success_msg {
                            text-align: center;
                        }
                        </style>
                        <p id="success_msg"></p>
                        <?php echo $this->session->flashdata('master_insert_message'); ?>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="card-body">
                                        <div class="card">
                                            <section style="display:block;" id="section1">
                                                <form id="basicDetails" name="pForm">
                                                    <h3>Personal Information</h3>
                                                    <div>
                                                        <input name="intern_id" type="hidden" class="form-control"
                                                            value="<?php echo $allinternData['intern_id']; ?>">
                                                        <div class="row">
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">First Name</label>
                                                                <input type="text"
                                                                    value="<?php echo $allinternData['first_name']; ?>"
                                                                    id="firstName" name="firstName" class="form-control"
                                                                    placeholder="Name" required readonly>
                                                            </div>
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Last Name</label>
                                                                <input type="text"
                                                                    value="<?php echo $allinternData['last_name']; ?>"
                                                                    id="lastName" name="lastName" class="form-control"
                                                                    placeholder="Name" required readonly>
                                                            </div>
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Email id
                                                                </label>
                                                                <input type="email" name="email"
                                                                    value="<?php echo $allinternData['email']; ?>"
                                                                    class="form-control" id="email"
                                                                    placeholder="Email id" required readonly>
                                                            </div>
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Phone No.</label>
                                                                <input type="text"
                                                                    value="<?php echo $allinternData['mobile']; ?>"
                                                                    name="mobile" id="mobile" class="form-control"
                                                                    placeholder="Phone No." required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Date of Birth</label>
                                                                <input type="text"
                                                                    value="<?php echo $allinternData['date_of_birth']; ?>"
                                                                    class="form-control" placeholder="Date of Birth"
                                                                    name="dob" id="dob" required autocomplete="off"
                                                                    readonly>
                                                                <span id="lblError"
                                                                    style="color:green;"><?php echo $this->session->flashdata('dob_error'); ?></span>
                                                            </div>
                                                            <div class="control-group form-group col-md-6 mb-0">
                                                                <label class="form-label fw-bold">Age</label>
                                                                <input type="text" id="age" name="age"
                                                                    class="form-control" placeholder="Age" required
                                                                    readonly value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="control-group form-group col-md- mb-0">
                                                                <label class="form-label fw-bold">Gender</label>
                                                                <select class="form-select select2 form-control"
                                                                    id="gender" name="gender" id="validationCustom04"
                                                                    required aria-readonly="">
                                                                    <option selected value="">Select Gender
                                                                    </option>
                                                                    <option value="1" <?php if ($allinternData['gender'] == '1') {
                                                                                            echo  "selected";
                                                                                        } ?>>
                                                                        Male
                                                                    </option>

                                                                    <option value="2" <?php if ($allinternData['gender'] == '2') {
                                                                                            echo  "selected";
                                                                                        } ?>>
                                                                        Female
                                                                    </option>
                                                                    <option value="3" <?php if ($allinternData['gender'] == '3') {
                                                                                            echo  "selected";
                                                                                        } ?>>
                                                                        Transgender
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="control-group form-group col-md-12 mb-0">
                                                                <label class="form-label fw-bold">Present Address
                                                                </label>
                                                                <input type="text" name="present_address"
                                                                    id="present_address" class="form-control"
                                                                    placeholder="Permanent Address" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="control-group form-group col-md-12 mb-0">
                                                                <label class="form-label fw-bold">Permanent
                                                                    Address</label>
                                                                <input type="text" name="permanent_address"
                                                                    id="permanent_address" class="form-control"
                                                                    placeholder="Permanent Address" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="control-group form-group col-md-12 mb-0">
                                                                <label class="form-label fw-bold">City Resindence
                                                                </label>
                                                                <input type="text" name="cityResindence"
                                                                    <?php echo $allinternData['city_name']; ?>
                                                                    id="permanent_address" class="form-control"
                                                                    placeholder="City Resindence" required>
                                                            </div>
                                                        </div>
                                                        <style>
                                                        .submitbtnleft {
                                                            margin-left: 80%;
                                                            margin-top: 10px;

                                                        }
                                                        </style>
                                                        <div class="submitbtnleft" id="step_1_submit">
                                                            <div class="control-group form-group col-md-12 mb-0 ">
                                                                <input class="btn btn-warning mt-5 clickMe"
                                                                    id="step_1_submit1" type="button"
                                                                    value="Save and Next ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                        </div>
                                        </section>

                                        <section style="display:none;" id="section2">
                                            <b>
                                                <div style="text-align: center; margin-top:-30px;">Lorem Ipsum is simply
                                                    dummy text of the printing and typesetting industry.<br> Lorem Ipsum
                                                    has been the industry's standard dummy text ever since the 1500s,
                                                </div>
                                            </b>
                                            <div class="card">
                                                <form id="documentdetails" name="pForm" enctype="multipart/form-data">
                                                    <h3>Document Details</h3>
                                                    <div class="row">
                                                        <input name="intern_id" type="hidden" class="form-control"
                                                            value="<?php echo $allinternData['intern_id']; ?>"
                                                            id="internID">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">ID proof <span
                                                                    class="text-red">*</span>
                                                                <input type="file" class="form-control"
                                                                    id="id_proof_attach1" name="id_proof_attach1"
                                                                    class="form-control" required accept=".pdf"
                                                                    value="">
                                                                <p id="id_proof_attach1msg" style="color:green;"></p>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Address proof <sum
                                                                    class="text-red"> *</sum>
                                                            </label>
                                                            <input type="file" class="form-control"
                                                                id="add_proof_attach" name="add_proof" accept=".pdf"
                                                                class="form-control" required value="">
                                                            <p id="add_proof_attachmsg" style="color:green;"></p>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Upload your CV <sum
                                                                    class="text-red">*</sum>
                                                            </label>
                                                            <input type="file" class="form-control" accept=".pdf"
                                                                id="cv_attach" name="cv_attach" class="form-control"
                                                                required value="">
                                                            <p id="cv_attachmsg" style="color:green;"></p>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Reference Letter
                                                            </label>
                                                            <input type="file" class="form-control" accept=".pdf"
                                                                id="ref_attach" name="ref_attach" class="form-control"
                                                                value="">
                                                            <p id="ref_attachmsg" style="color:green;"></p>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div id="paraent_letter"
                                                            class="control-group form-group col-md-6 mb-0 letter_parents_attach">
                                                            <label class="form-label fw-bold">consent letter from your
                                                                <sum class="text-red">*</sum>
                                                                parents<span class="text-red">*</span>
                                                            </label>
                                                            <input type="file" class="form-control" accept=".pdf"
                                                                id="letter_parents_attach" name="letter_parents_attach"
                                                                class="form-control" value="">
                                                            <p id="letter_parents_attachmsg" style="color:green;"></p>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Upload a close up photo
                                                                <sum class="text-red">*</sum>
                                                            </label>
                                                            <input type="file" class="form-control" accept=".jpg"
                                                                id="close_up_photo" name="close_up_photo"
                                                                class="form-control" required value="">
                                                                <small>Upload Jpg Image</small>
                                                            <p id="close_up_photomsg" style="color:green;"></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="submitbtnleft">
                                                        <div class="control-group form-group col-md-12 mb-0 ">

                                                            <input class="btn btn-warning mt-5" id="step2" type="button"
                                                                value="Save & Next ">

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>

                                        <section style="display:none;" id="section3">
                                            <div class="card">
                                                <form method="post" action="" id="occupationDetails" name="pForm"
                                                    enctype="multipart/form-data">
                                                    <h3>Occupation Details</h3>
                                                    <input name="intern_id" type="hidden" class="form-control"
                                                        value="<?php echo $allinternData['intern_id']; ?>">
                                                    <div class="row">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Emergency Contact
                                                                <span class="col-auto align-self-center">
                                                                    <span class="form-help" data-bs-toggle="popover"
                                                                        data-bs-placement="top"
                                                                        data-bs-content="(any letter from your professional circle, teachers, professors, or any person in some power who can vouch for you)"
                                                                        data-bs-original-title="" title=""
                                                                        aria-describedby="popover10908">?</span>
                                                                </span>
                                                            </label>
                                                            <input maxlength="10" type="text"
                                                                value="<?php echo $allinternData['emergency_contact']; ?>"
                                                                name="emergency_contact" class="form-control" required
                                                                placeholder="Emergency Contact" id="emergency_contact">
                                                        </div>

                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label
                                                                class="form-label fw-bold">School/College/University/Organization/Company/House
                                                                Wife</label>
                                                            <input type="text"
                                                                value="<?php echo $allinternData['name_of_school']; ?>"
                                                                id="name_of_school" name="name_of_school"
                                                                class="form-control"
                                                                placeholder="Name of your school/ college" required>
                                                        </div>
                                                        <div class="form-group col-md-6 mb-0 select-dropdown">
                                                            <label class="form-label fw-bold">Where did you get to know
                                                                about this
                                                                Opportunity</label>
                                                            <select class="form-control select2 form-select"
                                                                name="where_know_opportunity[]" data-placeholder="Where did you get to know about this
                                            Opportunity" multiple required id="where_know_opportunity">
                                                                <option value="">Where did you get to know about this
                                                                    Opportunity</option>
                                                                <?php foreach ($opportunity as $opportunityData) { ?>
                                                                <option
                                                                    value="<?php echo $opportunityData['opportunity_id']; ?>">
                                                                    <?php echo $opportunityData['opportunity_name']; ?>
                                                                </option><?php } ?>
                                                            </select>
                                                            <div class="invalid-feedback">Please select Opportunity
                                                            </div>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Designation if
                                                                working</label>
                                                            <input type="text"
                                                                value="<?php echo $allinternData['designation']; ?>"
                                                                name="designation" class="form-control"
                                                                placeholder="Designation if working" required
                                                                id="designation">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Languages known</label>
                                                            <select class="form-control select2 form-select"
                                                                name="language[]" id="language" data-placeholder=""
                                                                required multiple>
                                                                <option value=""> Select Languages known</option>
                                                                <option value="1">English</option>
                                                                <option value="2">Hindi</option>

                                                            </select>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0"
                                                            id="lang_input_box">
                                                            <label class="form-label fw-bold">Other Languages
                                                                known</label>
                                                            <input type="text"
                                                                value="<?php echo $allinternData['Otherlanguages']; ?>"
                                                                class="form-control" name="otherlanguage">
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Who was the CRY
                                                                representative you interacted with?
                                                                *</label>
                                                            <input type="text"
                                                                placeholder="Who was the CRY representative you interacted with?"
                                                                value="" class="form-control" name="representative"
                                                                id="representative">
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Which CRY office you had
                                                                communicated with/ written to?
                                                                *</label>
                                                            <select class="form-control select2 form-select"
                                                                name="communicatedWith" id="interestsyouBox"
                                                                data-placeholder="Select " required>
                                                                <option value="">Which CRY office you had communicated
                                                                    with/ written to?
                                                                    *</option>
                                                                <option value="1">Delhi</option>
                                                                <option value="2">Mumbai</option>
                                                                <option value="3">Kolkata</option>
                                                                <option value="4">Media related work/ Publishing
                                                                    articles</option>
                                                                <option value="5">Bengaluru</option>
                                                                <option value="6">Others</option>

                                                            </select>
                                                        </div>
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Profile of project you
                                                                will be involved in
                                                                *</label>
                                                            <select class="form-control select2 form-select"
                                                                name="project_profile" id="project_profile"
                                                                data-placeholder="Profile of project you will be involved
                                                                    in" required>
                                                                <option value="">Profile of project you will be involved
                                                                    in
                                                                    *</option>
                                                                <option value="1">Research and Documentation</option>
                                                                <option value="2">Working with Communities and Children
                                                                </option>
                                                                <option value="3">Designing posters and pamphlets
                                                                </option>
                                                                <option value="4">Media related work/ Publishing
                                                                    articles</option>
                                                                <option value="5">Initiating a campaign</option>
                                                                <option value="6">Fundraising</option>
                                                                <option value="7">Video editing, photography etc
                                                                </option>
                                                                <option value="8">Preparing professional PPT's/documents
                                                                </option>
                                                                <option value="9">Data Analysis</option>
                                                                <option value="10">Event planning and execution</option>
                                                                <option value="11">Others</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                    <h5><strong>Read the below 3 Documents Properly</strong></h5>
                                                    <div class="row">

                                                        <div class="col-md-6 mb-0">
                                                            <a href="https://drive.google.com/drive/folders/1OA4CvaYcoVowDUMYyUbmnMvwKKhhiVpt"
                                                                target="_blank">
                                                                <h5><span>&nbsp;</span><input type="checkbox"
                                                                        value="childProtection" id="">
                                                                    &nbsp;CRY's
                                                                    Child Protection
                                                                    Policy</h5>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 mb-0">
                                                            <a href="https://docs.google.com/document/d/14G9qJjqgCFiapxChbbMRW2dsLPnK8WpVxyZo05qSWsk/edit?usp=sharing"
                                                                target="_blank">
                                                                <h5><span>&nbsp;</span><input type="checkbox" value=" ">
                                                                    &nbsp;CRY's
                                                                    Code of Conduct
                                                                </h5>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-0">
                                                            <a href="https://drive.google.com/file/d/119ksoFAzQ7gE8uuvRol0EaCfjbwGL6sz/view?usp=sharing"
                                                                target="_blank">
                                                                <h5><span>&nbsp;</span><input type="checkbox" value=" ">
                                                                    &nbsp;CRY's
                                                                    Online sessions
                                                                    SOP</h5>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 mb-0"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="control-group form-group col-md-6 mb-0">
                                                            <label class="form-label fw-bold">Signature</label>
                                                            <input type="text"
                                                                value="<?php echo $allinternData['signature']; ?>"
                                                                name="signature" class="form-control"
                                                                placeholder="Signature" required>
                                                        </div>

                                                    </div>
                                                    <div class="submitbtnleft">
                                                        <div class="control-group form-group col-md-12 mb-0 ">

                                                            <input class="btn btn-warning mt-5 mb-5" id="step_3_submit"
                                                                type="button" value="Finish ">

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script>
    $("#step_3_submit").click(function(ev) {
        ev.preventDefault();
        let emergency_contact = $('#emergency_contact').val();
        let name_of_school = $('#name_of_school').val();
        //alert(name_of_school);
        let occupation = $('#occupation').val();
        let designation = $('#designation').val();
        let language = $('#language').val();
        let representative = $('#representative').val();
        let communicatedWith = $('#communicatedWith').val();
        let project_profile = $('#project_profile').val();
        let where_know_opportunity = $('#where_know_opportunity').val();
        let signature = $('#signature').val();
        if (emergency_contact == "" || occupation == "" ||
            name_of_school == "" || designation == "" || language == "" || representative == "" ||
            communicatedWith == "" || project_profile == "" ||
            signature == "") {
            alert('Please Fill All Details');
            //  return false;
        } else {

            var form = $("#occupationDetails");
            var url = '<?php echo base_url() . 'intern-insertoccupationDetails' ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    // return false;
                    window.location.href = "<?php echo base_url('/thank-you') ?>";
                },
                error: function(data) {}
            });

        }


    });
    </script>
    <script>
    $('#step2').click(function(e) {
        let id_proof_attach = $('#id_proof_attach').val();
        let add_proof_attach = $('#add_proof_attach').val();
        //   alert(add_proof_attach);
        let letter_parents_attach = $('#letter_parents_attach').val();
        let close_up_photo = $('#close_up_photo').val();
        let cv_attach = $('#cv_attach').val();
        let ref_attach = $('#ref_attach').val();
        if (id_proof_attach == "" || add_proof_attach == "" || close_up_photo ==
            "" || cv_attach == "") {
            alert('Please Upload Document');
            return false;
        } else {
            //return false;
            $("#section1").css("display", "none");
            $("#section2").css("display", "none");
            $("#section3").css("display", "block");

        }
    });
    </script>
    <script>
    $('#close_up_photo').change(function(e) {
        e.preventDefault();
        let close_up_photo = document.getElementById("close_up_photo").files[0];
        var datas = new FormData();
        datas.append('close_up_photo', close_up_photo);
        datas.append("intern_id", '<?php echo $allinternData['intern_id'] ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() . 'upload_close_up_photo' ?>',
            data: datas,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result)

            {
                if (result == 1) {
                    $('#close_up_photomsg').html('Uploaded Successfully');
                    setTimeout(function() {
                        $('#close_up_photomsg').hide();
                    }, 2000);
                } else {
                    alert('something went wrong');
                }
            }
        });

    });
    </script>

    <script>
    $('#letter_parents_attach').change(function(e) {
        e.preventDefault();
        let letter_parents_attach = document.getElementById("letter_parents_attach").files[0];
        var datas = new FormData();
        datas.append('letter_parents_attach', letter_parents_attach);
        datas.append("intern_id", '<?php echo $allinternData['intern_id'] ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() . 'upload_letter_parents_attach' ?>',
            data: datas,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result)

            {
                if (result == 1) {
                    $('#letter_parents_attachmsg').html('Uploaded Successfully');
                    setTimeout(function() {
                        $('#letter_parents_attachmsg').hide();
                    }, 2000);
                } else {
                    alert('something went wrong');
                }
            }
        });

    });
    </script>

    <script>
    $('#ref_attach').change(function(e) {
        e.preventDefault();
        let ref_attach = document.getElementById("ref_attach").files[0];
        var datas = new FormData();
        datas.append('ref_attach', ref_attach);
        datas.append("intern_id", '<?php echo $allinternData['intern_id'] ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() . 'upload_ref_attach' ?>',
            data: datas,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result)

            {
                if (result == 1) {
                    $('#ref_attachmsg').html('Uploaded Successfully');
                    setTimeout(function() {
                        $('#ref_attachmsg').hide();
                    }, 2000);
                } else {
                    alert('something went wrong');
                }
            }
        });

    });
    </script>

    <script>
    $('#cv_attach').change(function(e) {
        e.preventDefault();
        let cv_attach = document.getElementById("cv_attach").files[0];
        var datas = new FormData();
        datas.append('cv_attach', cv_attach);
        datas.append("intern_id", '<?php echo $allinternData['intern_id'] ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() . 'upload_cv_attach' ?>',
            data: datas,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result)

            {
                if (result == 1) {
                    $('#cv_attachmsg').html('Uploaded Successfully');
                    setTimeout(function() {
                        $('#cv_attachmsg').hide();
                    }, 2000);
                } else {
                    alert('something went wrong');
                }
            }
        });

    });
    </script>

    <script>
    $('#add_proof_attach').change(function(e) {
        e.preventDefault();
        let add_proof_attach = document.getElementById("add_proof_attach").files[0];
        var datas = new FormData();
        datas.append('add_proof_attach', add_proof_attach);
        datas.append("intern_id", '<?php echo $allinternData['intern_id'] ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() . 'upload_add_proof_attach' ?>',
            data: datas,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result)

            {
                if (result == 1) {
                    $('#add_proof_attachmsg').html('Uploaded Successfully');
                    setTimeout(function() {
                        $('#add_proof_attachmsg').hide();
                    }, 2000);
                } else {
                    alert('something went wrong');
                }
            }
        });

    });
    </script>

    <script>
    $('#id_proof_attach1').change(function(e) {
        e.preventDefault();
        let id_proof_attach1 = document.getElementById("id_proof_attach1").files[0];
        var datas = new FormData();
        datas.append('id_proof_attach1', id_proof_attach1);
        datas.append("intern_id", '<?php echo $allinternData['intern_id'] ?>');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() . 'upload_id_proff' ?>',
            data: datas,

            contentType: false,
            cache: false,
            processData: false,
            success: function(result)

            {
                if (result == 1) {
                    $('#id_proof_attach1msg').html('Uploaded Successfully');
                    setTimeout(function() {
                        $('#id_proof_attach1msg').hide();
                    }, 2000);
                } else {
                    alert('something went wrong');
                }
            }
        });

    });
    </script>


    <script>
    $(document).ready(function() {

        $('#step_1_submit').click(function() {
            var newage = $('#age').val();
            if (newage >= 18) {
                $('#paraent_letter').css('visibility', 'hidden');

            }
        });

    });
    </script>



    <script>
    $('.feedback').hide();
    $("#step_1_submit1").click(function(ev) {
        let present_address = $('#present_address').val();
        let permanent_address = $('#permanent_address').val();
        let cityResindence = $('#cityResindence').val();
        if (present_address == "" || permanent_address == "" || cityResindence == "") {
            alert('Please Fill All Details')
            return false
        } else {
            var form = $("#basicDetails");
            var url = '<?php echo base_url() . 'intern-insertBasicdata' ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {},
                error: function(data) {}
            });
        }

    });
    </script>

    <script>
    $('#where_know_opportunityBox').hide();
    jQuery('#where_know_opportunity').change(function() {
        if ($('#where_know_opportunity').val() == "8") {
            $('#where_know_opportunityBox').show();
        } else {
            $('#where_know_opportunityBox').hide();
        }

    });
    </script>
    <script>
    $('#interestsBox').hide();
    jQuery('#interestsyouBox').change(function() {
        if ($('#interestsyouBox').val() == "11") {
            $('#interestsBox').show();
        } else {
            //$('#lang_input_box').hide();
        }

    });
    </script>

    <script>
    $('#occupation_input_box').hide();
    jQuery('#occupation').change(function() {
        if ($('#occupation').val() == "8") {
            $('#occupation_input_box').show();
        } else {
            $('#occupation_input_box').hide();
        }

    });
    </script>
    <script>
    $('#how_did_input_box').hide();
    jQuery('#where_know_opportunity').change(function() {
        if ($('#where_know_opportunity').val() == '8') {
            $('#how_did_input_box').show();
        } else {
            $('#how_did_input_box').hide();
        }

    });
    </script>


    <script>
    $('document').ready(function() {
        $('#step_1_submit').click(function() {
            $("#section1").css("display", "none");
            $("#section2").css("display", "block");
            $("#section3").css("display", "none");
            // alert('123456789');

        });
    });
    </script>

    <script>
    $('document').ready(function() {
        var dob = $('#dob').val();
        //alert(dob);
        dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#age').val(age);
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#country_id").change(function() {
            var country_id = $(this).val();
            // alert(country_id);
            datastr = {
                country_id: country_id
            };

            $.ajax({
                url: '<?php echo base_url() ?>get-states',
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
    $(document).ready(function() {
        $("#state_name").change(function() {

            var state_id = $(this).val();
            // alert(state_id);
            datastr = {
                state_id: state_id
            };

            $.ajax({
                url: '<?php echo base_url() ?>get-city',
                type: 'post',
                data: datastr,
                success: function(response) {
                    $("#city_name").html(response);
                    $('select').selectpicker('refresh');
                }
            });
        });

    });
    </script>

    <script>
    $(function() {
        $("#dob").datepicker({
            changeMonth: true,
            changeYear: true,
            // showOn: 'button',
            buttonImageOnly: false,
            buttonImage: '<?php echo base_url() ?>web/images/calendar.gif',
            dateFormat: 'dd-mm-yy',
            yearRange: '1900:+0',
            onSelect: function(dateString, txtDate) {
                ValidateDOB(dateString);
            }
        });
    });

    function ValidateDOB(dateString) {
        var lblError = $("#lblError");
        var parts = dateString.split("-");
        var dtDOB = new Date(parts[1] + "-" + parts[0] + "-" + parts[2]);
        var dtCurrent = new Date();
        lblError.html("Eligibility 13 years ONLY.")
        if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 13) {
            $('#dob').val('');
            return false;
        }

        if (dtCurrent.getFullYear() - dtDOB.getFullYear() == 13) {
            if (dtCurrent.getMonth() < dtDOB.getMonth()) {
                $('#dob').val('');
                return false;
            }
            if (dtCurrent.getMonth() == dtDOB.getMonth()) {
                if (dtCurrent.getDate() < dtDOB.getDate()) {
                    $('#dob').val('');
                    return false;
                }
            }
        }
        lblError.html("");
        return true;
    }
    </script>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



    <script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        // Button that triggered the modal
        var li = $(event.relatedTarget)
        // Extract info from data attributes 
        var recipient = li.data('whatever')
        // Updating the modal content using 
        // jQuery query selectors
        var modal = $(this)
        modal.find('.modal-title')
            .text('New message to ' + recipient)

        modal.find('.modal-body p')
            .text('Welcome to ' + recipient)
    });
    </script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>

    <!-- <script src="https://mgracesolution.com/cryvms/admin/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- JQUERY JS -->

    <!-- BOOTSTRAP JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/jquery.sparkline.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/circle-progress.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/charts-c3/d3.v5.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/charts-c3/c3-chart.js"></script>

    <!-- INPUT MASK JS-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/input-mask/jquery.mask.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/chart/Chart.bundle.js"></script>

    <!-- SIDE-MENU JS-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sticky js -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/sticky.js"></script>

    <!-- SIDEBAR JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/sidebar/sidebar.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/p-scroll/pscroll.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/p-scroll/pscroll-1.js"></script>

    <!-- FILE UPLOADES JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/fileuploads/js/file-upload.js"></script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js">
    </script>
    <!--<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>-->


    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            order: [
                //  [3, 'desc']
            ],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    </script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/jquery-3.5.1.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/dataTables.buttons.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/jszip.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/pdfmake.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/vfs_fonts.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/buttons.html5.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/buttons.print.min.js"></script>

    <!-- INTERNAL File-Uploads Js-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/fancyuploder/jquery.iframe-transport.js">
    </script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/fancyuploder/jquery.fancy-fileupload.js">
    </script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/fancyuploder/fancy-uploader.js"></script>

    <!-- SELECT2 JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/select2/select2.full.min.js"></script>

    <!-- BOOTSTRAP-DATERANGEPICKER JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/bootstrap-daterangepicker/moment.min.js">
    </script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js">
    </script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js">
    </script>

    <!-- INTERNAL Sumoselect js-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/sumoselect/jquery.sumoselect.js"></script>

    <!-- TIMEPICKER JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/time-picker/jquery.timepicker.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/time-picker/toggles.min.js"></script>

    <!-- INTERNAL intlTelInput js-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/intl-tel-input-master/intlTelInput.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/intl-tel-input-master/country-select.js">
    </script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/intl-tel-input-master/utils.js"></script>

    <!-- INTERNAL jquery transfer js-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/jQuerytransfer/jquery.transfer.js"></script>

    <!-- INTERNAL multi js-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/multi/multi.min.js"></script>

    <!-- DATEPICKER JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/date-picker/date-picker.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/date-picker/jquery-ui.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!-- MULTI SELECT JS-->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/multipleselect/multiple-select.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/multipleselect/multi-select.js"></script>

    <!-- FORMELEMENTS JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/formelementadvnced.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/form-elements.js"></script>

    <!-- Color Theme js -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/custom.js"></script>

    <!----------matching editor js------------>


    <!-- WYSIWYG Editor JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/wysiwyag/jquery.richtext.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/wysiwyag/wysiwyag.js"></script>

    <!-- FORMEDITOR JS -->
    <script src="https://mgracesolution.com/cryvms/admin/assets/plugins/quill/quill.min.js"></script>
    <script src="https://mgracesolution.com/cryvms/admin/assets/js/form-editor2.js"></script>
</body>

</html>