<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                    Districts Master</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Districts Master
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
                            <h3 class="card-title text-white">Add Districts</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>insert_city" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom04" class="form-label">State Name</label>
                                        <select class="form-control select2-show-search form-select" data-placeholder="Select State" required>
                                        <option label="Select State"></option>
                                            <?php foreach ($state as $st) { ?>
                                                <option value="<?php echo $st['state_id']; ?>"><?php echo $st['state_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        </select>
                                        <div class="invalid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom04" class="form-label">Districts Name</label>
                                        <input type="text" name="city_name" class="form-control" id="validationCustom02" value="" placeholder="City Name " required>
                                        <div class="invalid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom04" class="form-label">Abbreviation Name</label>
                                        <input type="text" name="code" class="form-control" id="validationCustom02" value="" placeholder="Abbreviation Name" required>
                                        <div class="invalid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 mb-3">
                                        <label for="validationCustom04" class="form-label">Status</label>
                                        <select name="status" class="form-select select2 form-control" id="validationCustom04" required>
                                            <option selected disabled value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">Looks good!</div>

                                    </div>
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