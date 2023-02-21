<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Designation Master</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page">Designation Master</li>
                    </ol>
                </div>
                <div class="ms-auto pageheader-btn">
                    <a href="<?php echo base_url()?>add-designation" class="btn btn-warning btn-icon text-white me-2">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span> Add Designation
                    </a>

                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <div class="table-responsive ">
                                    <table id="example" class="display nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr.no</th>
                                                <th>Designation name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach($designation as $pr_des){
							$de_id=$pr_des['des_id']; 
							$encoded_id=rtrim(strtr(base64_encode($de_id), '+/', '-_'), '=');
							?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $pr_des['des_name']; ?></td>
                                                <?php if($pr_des['status']==1){?>
                                                <td><span
                                                        class="badge bg-warning  me-1 mb-1 mt-1">Active</span>
                                                </td>
                                                <?php }else{ ?>
                                                <td><span
                                                        class="badge bg-warning  me-1 mb-1 mt-1">Inactive</span>
                                                </td>
                                                <?php } ?>
                                                <td><a href="<?php echo base_url()?>edit-designation/<?php echo $encoded_id ;?>"
                                                        onClick="javascript:if(confirm('Do You Want to Edit Designation ?')){return true;}else{return false}"><i
                                                            class="fa fa-edit"></i></a></td>
                                            </tr>
                                            <?php } ?>
                                          
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