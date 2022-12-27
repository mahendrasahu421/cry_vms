<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                    Intern Transfer</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Intern Transfer
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white"> Intern Transfer  </h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>insert_employee" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col-md-6">
                                    <label for="emp_name" class="form-label">Current State </label>
                                        <input type="text" name="emp_name" class="form-control" id="Current_State" value="" placeholder="Current State " required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="region_id" class="form-label">Where to Relocate </label>
                                        <select class="form-control select2-show-search form-select" name="region_id" id="region_id" required>
                                            <option selected disabled value="">Select Where to Relocate</option>
                                            <option value="1">Bihar</option>
                                            <option value="2">Chattishgarh </option>
                                            <option value="2">Arunachal Pradesh </option>
                                            <option value="2">Assam </option>
                                            <option value="2">Bihar </option>
                                            
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-12">
                                       <label for="region_id" class="form-label">Reason </label>
                                         <!-- <textarea id="editor1" name="reason" data-sample-preservewhitespace></textarea>
                                        <div class="invalid-feedback"></div>-->
                                       <textarea class="form-control mb-4 is-valid state-valid" placeholder="Textarea (success state)" required="" rows="3">This is textarea</textarea>
                                              
														
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
<script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
<script>
		var config = {

			extraPlugins: 'codesnippet',

			codeSnippet_theme: 'monokai_sublime',

			height: 200

		};



		CKEDITOR.replace('editor1', config);
	</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#region_id").change(function() {
            var region_id = $(this).val();
            //alert(region_id);
            datastr = {
                region_id: region_id
            };

            $.ajax({
                url: '<?php echo base_url() ?>get-states-admin',
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