<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Region Master</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Region Master
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Add Region</h3>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="<?php echo base_url(); ?>insert-region" method="post" novalidate>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom02">Region Name</label>
                                        <input type="text" name="region_name" class="form-control" id="validationCustom02" value="" placeholder="Region Name " required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label class="form-label">States</label>
                                        <select class="form-control select2" name="states[]" data-placeholder="Select Statess" multiple>
                                            <?php foreach ($state as $st) { ?>
                                                <option value="<?php echo $st['state_id']; ?>"><?php echo $st['state_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom04">Status</label>
                                        <select class="form-control select2 form-select" name="status" id="" required>
                                            <option selected disabled value="">Select status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-warning">Submit </button>

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
</div>
</div>