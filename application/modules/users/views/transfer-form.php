<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                    Volunteer Transfer</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Volunteer Transfer
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
                            <h3 class="card-title text-white"> Volunteer Transfer  </h3>
                        </div>
                        <div class="card-body">
                            <?php
                              $volunteer_id = $this->session->userdata('volunteer_id');
                            ?>
                            <form action="<?php echo base_url(); ?>insert_volunteer_transfer" method="post" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
							<input type="hidden" name="region_id" class="form-control"  value="<?php echo $volunteerDetails[0]['region_id']; ?>" required>
                            <input type="hidden" name="volunteer_id" class="form-control"  value="<?php echo $volunteer_id ; ?>" required>
                                <div class="form-row">
                                    <div class="col-md-4">
                                    <label for="emp_name" class="form-label">Current State </label>
                                        <input type="text" readonly name="current_st" class="form-control" value="<?php echo $volunteerDetails[0]['state_name']; ?>" placeholder="Current State " required> 
                                        <input type="hidden" name="current_State" class="form-control"  value="<?php echo $volunteerDetails[0]['state_id']; ?>" required>
                                        
                                        <div class="invalid-feedback"></div>
                                    </div>  
                                    <div class="col-md-4">
                                        <label for="region_id" class="form-label">Where to Relocate </label>
                                        <select class="form-control select2-show-search form-select" id="state_name" name="relocate_state" data-placeholder="Select State" required>
                                        <option label="Select State">Select State</option>
                                            <?php foreach ($state as $st) { ?>
                                                <option value="<?php echo $st['state_id']; ?>"><?php echo $st['state_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>         
                                    <div class="col-md-4">
                                        <label for="region_id" class="form-label"> Relocate City </label>
                                        <select class="form-control select2-show-search form-select"  name="relocate_city" id="city" data-placeholder="Select State" required>

                                       </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                       <label for="region_id" class="form-label">Reason </label>
                                         
                                       <textarea class="form-control mb-4 is-valid state-valid" name="relocate_resion" placeholder="Reason For Relocated" required="" rows="3"></textarea>
                                              
														
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
		$("#state_name").change(function() {
			var state_name = $(this).val();
			datastr = {
				state_name: state_name
			};
			//alert(datastr)
			$.ajax({
				url: '<?php echo base_url() ?>transfer-intern-city',
				type: 'post',
				data: datastr,
				success: function(response) {
					$("#city").html(response);
					//$('select').selectpicker('refresh');
				}
			});
		});

	});
	(function() {
		'use strict'

		var forms = document.querySelectorAll('.needs-validation')

		
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