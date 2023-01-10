<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Template Master</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page">Template Master</li>
                    </ol>
                </div>
                <div class="ms-auto pageheader-btn">
                    <a href="<?php echo base_url(); ?>create-template" class="btn btn-warning btn-icon text-white me-2">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span> Template Master
                    </a>

                </div>
            </div>
            <?php echo $this->session->userdata('master_insert_message'); ?>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <div class="table-responsive ">
                                    <table id="example" class="display nowrap" style="width:100%">
                                        <thead>
                                            <tr class="bg-gray-light">
                                                <th>Sr.no</th>
                                                <th>Template Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       
                                            <?php $i = 1;
                                            
                                            foreach ($email_template as $et) {
                                                $email_templates_id = $et['email_templates_id'];
                                                $encoded_id = rtrim(strtr(base64_encode($email_templates_id), '+/', '-_'), '=');
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $et['template_name']; ?></td>
                                                  

                                                    <?php if ($et['status'] == 1) { ?>
                                                        <td><span class="badge rounded-pill bg-warning me-1 mb-1 mt-1">Active</span></td>
                                                    <?php } else { ?>
                                                        <td><span class="badge rounded-pill bg-secondary me-1 mb-1 mt-1">Deactive</span></td>
                                                    <?php } ?>
                                                    <td>
                                                        <a href="<?php echo base_url() ?>edit-email-template/<?php echo $encoded_id; ?>" onClick="javascript:if(confirm('Do You Want to Edit Template Master ?')){return true;}else{return false}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </td>

                                                </tr>

                                            <?php } ?>

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