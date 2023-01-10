<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Master Menu</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Template Master
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Template Master</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>update_template_data" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <input name="email_templates_id" type="hidden" class="form-control" value="<?php echo $email_tep[0]['email_templates_id']; ?>" required>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for="validationCustom04" class="form-label">Template Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="template_name" class="form-control" id="validationCustom04"  placeholder="Template Name" required value="<?php echo $email_tep[0]['template_name']; ?>">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-3 mt-5">
                                        <label for="validationCustom04" class="form-label">Body Content</label>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <div class="card-body">
                                            <textarea class="content" name="body_content" ><?php echo $email_tep[0]['body_content']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="validationCustom04" class="form-label">Note</label>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <textarea class="form-control mb-4" name="notes" placeholder="" required="" rows="3" spellcheck="false"><?php echo $email_tep[0]['notes']; ?></textarea>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="validationCustom04" class="form-label">Status</label>
                                    </div>
                                    <div class="form-group col-md-9">
                                    <select name="status" class="form-select select2 form-control" id="validationCustom04" required>
                                            <option selected disabled value="">Choose</option>
                                            <option value="1" <?php if ($email_tep[0]['status'] == 1) {
                                                                    echo  "selected";
                                                                } ?>>Active</option>

                                            <option value="2" <?php if ($email_tep[0]['status'] == 2) {
                                                                    echo  "selected";
                                                                } ?>>Inactive</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-warning mt-3" type="submit">Submit</button>
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
</div>
</div>