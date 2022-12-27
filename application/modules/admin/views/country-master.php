<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Country Master</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page">Country Master</li>
                    </ol>
                </div>
                <div class="ms-auto pageheader-btn">
                    <a href="add-country" class="btn btn-warning btn-icon text-white me-2">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span> Add Country
                    </a>

                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                        <thead>
                                            <tr class="bg-gray-light">
                                                <th>Sr.no</th>
                                                <th>Country Name</th>
                                                <th>Abbreviation</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($countries as $ct) {
                                                $country_id  = $ct['country_id '];
                                                $encoded_id = rtrim(strtr(base64_encode($country_id), '+/', '-_'), '=');
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $ct['Name']; ?></td>
                                                    <td><?php echo $ct['short_name']; ?></td>
                                                    <?php if ($ct['status'] == 1) { ?>
                                                        <td><span class="badge rounded-pill bg-warning me-1 mb-1 mt-1">Active</span></td>
                                                    <?php } else { ?>
                                                        <td><span class="badge rounded-pill bg-secondary me-1 mb-1 mt-1">Deactive</span></td>
                                                    <?php } ?>
                                                    <td><a href="<?php echo base_url() ?>edit-country/<?php echo $encoded_id; ?>" onClick="javascript:if(confirm('Do You Want to Edit Country ?')){return true;}else{return false}"><i class="fa fa-edit"></i></a></td>
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