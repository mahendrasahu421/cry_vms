<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">

                        City Master</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">City Master
                            </a></li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-6">


                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Edit City </h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>update_city" method="POST" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <div class="form-row">
                                    <input name="city_id" type="hidden" class="form-control" value="<?php echo $cities[0]['city_id']; ?>">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom04" class="form-label">State Name</label>
                                            <select name="state_id" class="form-control select2-show-search form-select" id="validationCustom04" required>
                                                <?php foreach ($state as $st) { ?>
                                                    <option value="<?php echo $st['state_id']; ?>"><?php echo $st['state_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            </select>
                                            <div class="invalid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom04" class="form-label">City Name</label>
                                            <input type="text" name="city_name" class="form-control" id="validationCustom02" value="<?php echo $cities[0]['city_name']; ?>" placeholder="City Name " required>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom04" class="form-label">Abbreviation Name</label>
                                            <input type="text" name="code" class="form-control" id="validationCustom02" value="<?php echo $cities[0]['code']; ?>" placeholder="Abbreviation Name" required>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 mb-3">
                                            <label for="validationCustom04" class="form-label">Status</label>
                                            <select name="status" class="form-select select2 form-control" id="validationCustom04" required>
                                                <option selected disabled value="">Choose</option>
                                                <option value="1" <?php if ($cities[0]['status'] == 1) {
                                                                        echo  "selected";
                                                                    } ?>>Active</option>

                                                <option value="2" <?php if ($cities[0]['status'] == 2) {
                                                                        echo  "selected";
                                                                    } ?>>Inactive</option>
                                            </select>

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