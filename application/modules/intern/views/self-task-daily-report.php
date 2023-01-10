<style>
	#basic-addon2 {
		width: 100px;
		height: 40px;
	}

	input[type=label] {
		font-weight: bold;

	}

	.col-form-label {
		padding-top: calc(0.375rem + 1px);
		padding-bottom: calc(0.375rem + 1px);
		margin-bottom: 0;
		font-size: inherit;
		line-height: 1.5;
		font-weight: 700;
	}
</style>
<div class="main-content app-content mt-0">
	<div class="side-app">

		<!-- CONTAINER -->
		<div class="main-container container-fluid">

			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title">Task Daily Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Task Daily Report</li>
					</ol>
				</div>

			</div>
			<!-- PAGE-HEADER END -->
			<div class="card">
				<div class="card-header bg-warning">
					<h3 class="card-title text-white">Add Task</h3>
				</div>
				<div class="card-body">
					<form action="#" method="POST" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
						<div class="form-row">
							<div class="col-md-6 ">

								<label class="form-label fw-bold">Task</label>
								<textarea class="form-control mb-4" placeholder="Task Tittle" required="" rows="3"></textarea>
							</div>
							
							<div class="col-md-6 ">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-12 col-form-label">Time In</label>
									<div class="col-sm-12">
										<div class="input-group ">
											<input type="number" class="form-control" name="dailyReportTimeIn" onchange="hours(this);" value="00" id="dailyReportTimeIn" required>
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">Hours</span>
											</div>
											<input type="number" class="form-control" name="dailyReportTimeIn1" onchange="mins(this);" value="00" id="dailyReportTimeIn1" required>
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">Min</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 ">

								<label class="form-label fw-bold">Location</label>
								<input type="text" class="form-control" name="dailyReportTimeIn" value="Location" id="dailyReportTimeIn" required>
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-6 ">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-12 col-form-label">Time Out</label>
									<div class="col-sm-12">
										<div class="input-group ">
											<input type="number" class="form-control" name="dailyReportTimeIn" onchange="hours(this);" value="00" id="dailyReportTimeIn" required>
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">Hours</span>
											</div>
											<input type="number" class="form-control" name="dailyReportTimeIn1" onchange="mins(this);" value="00" id="dailyReportTimeIn1" required>
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">Min</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6  mt-3">
								<label for="validationCustom01" class="col-form-label">Date</label>
								<input type="date" class="form-control" name="dailyReportTimeIn" onchange="hours(this);" value="00" id="dailyReportTimeIn" required>
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="col-md-6 ">
								<label for="validationCustom01" class="col-form-label">Challenges Faced<br><small>(300 Characters Allowed)</small></label>
								<textarea class="form-control mb-4" placeholder="Challenges Faced" required="" rows="3"></textarea>

							</div>
							<div class="col-md-6  mt-3">
								<label for="validationCustom01" class="col-form-label">Share your experience in brief<br><small>(300 Characters Allowed)</small></label>
								<textarea class="form-control mb-4" placeholder="Activity" rows="6" required="" rows="3"></textarea>

							</div>

							<div class="col-md-6 ">
								<label for="validationCustom01" class="col-form-label">Activity<small>(Guidline Below)<br> 1-No of people reached out 2-Testimonies from participants 3-Type of participants (age, profession..etc) 4-Other detailed information</small></label>

								<textarea class="form-control mb-4" placeholder="Activity" rows="6" required="" rows="3"></textarea>

							</div>
							<div class="col-md-6 ">
								<label for="validationCustom01" class="col-form-label">How Could it be Improved?<br><small>(300 Characters Allowed)</small></label>

								<textarea class="form-control mb-4" placeholder="How Could it be Improved?" required="" rows="3"></textarea>

							</div>

							<div class="col-md-6 mt-2 ">
								<label for="validationCustom01" class="col-form-label">Add Image<sup>*</sup></label>
								<label for="validationCustom02" class="col-form-label"></label>
								<input type="file" class="form-control" id="validationCustom02" value="Otto" required multiple>
								<div class="valid-feedback">Looks good!</div>
							</div>
							<div class="card-footer card bg-default mt-7 mb-0">
								<div class="col-md-12">
									<button class="btn btn-default pull-right"><i class="fa fa-times me-1 text-dark"></i>Cancel</button>
									<button class="btn btn-warning fs-14 me-2 pull-right"><i class="fa fa-floppy-o me-1" name="submit" value="submit"></i>Save </button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
</div>
</div>

<script>
    
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>