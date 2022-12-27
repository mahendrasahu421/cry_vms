<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Edit Region</h3>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" action="<?php echo base_url(); ?>update_region" method="post" novalidate>
                                <input name="region_id" type="hidden" class="form-control" value="<?php echo $region[0]['region_id']; ?>">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom02">Region Name</label>
                                        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $region[0]['region_name']; ?>" placeholder="Region Name " name="region_name" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="form-group col-md-12 mb-0 select-dropdown">
                                        <label class="form-label fw-bold">States</label>
                                        <select name="state_id[]" class="form-control select2-show-search form-select" id="validationCustom04" required multiple>
                                            <?php foreach ($state as $st) {
                                                $result = explode(',', $region[0]['state_id']);
                                            ?>
                                                <option value="<?php echo $st['state_id']; ?>" <?php if (in_array($st['state_id'],  $result)) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $st['state_name']; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold" for="validationCustom04">Status</label>
                                        <select class="form-control select2" name="region_status" id="validationCustom03" required>
                                            <option selected disabled value="">Choose</option>
                                            <option value="1" <?php if ($region[0]['region_status'] == 1) {
                                                                    echo "selected";
                                                                } ?>>Active</option>

                                            <option value="2" <?php if ($region[0]['region_status'] == 2) {
                                                                    echo "selected";
                                                                } ?>>Inactive</option>
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