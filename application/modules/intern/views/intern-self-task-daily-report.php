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
					<h1 class="page-title">Self Task Daily Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Self Task Daily Report</li>
					</ol>
				</div>
			</div>
			<!-- PAGE-HEADER END -->
			
<?php
//print_r($leatest_daily_report);
if($this->session->userdata('data_message'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> Daily Report Has Been Inserted.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('data_message'); } ?>


			<div class="card">
				<div class="card-header bg-warning">
					<h3 class="card-title text-white">Add Self Task</h3>
				</div>
				<div class="card-body">
					<form autocomplete="off" onsubmit=" return validate();" method="post" action="#" enctype="multipart/form-data" >
						<div class="form-row">
							<div class="col-md-6 ">
								<label class="form-label fw-bold">Task</label>
								<textarea class="form-control " rows="3" placeholder="Task Title" name="tasktitle" maxlength="300" required ></textarea>
								<?php echo form_error('tasktitle', '<div class="error">', '</div>'); ?>
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
										<?php echo form_error('dailyReportTimeIn', '<div class="error">', '</div>'); ?>
									</div>
								</div>
							</div>
							<div class="col-md-3 ">
								<label class="form-label fw-bold">Location</label>
								<input type="text" class="form-control" name="location" placeholder="Location" id="location" required>
								<div class="valid-feedback"><?php echo form_error('location', '<div class="error">', '</div>'); ?></div>
							</div>
							<div class="col-md-3">
								<label for="validationCustom01" class="col-form-label">Date</label>
								<input type="date" class="form-control" onkeyup="onlyNumber('dob_caf');" name="birthday1" required>
								<div class="valid-feedback"><?php echo form_error('birthday1', '<div class="error">', '</div>'); ?></div>
							</div>
							<div class="col-md-6 ">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-12 col-form-label">Time Out</label>
									<div class="col-sm-12">
										<div class="input-group ">
											<input type="number" class="form-control" name="dailyReportTimeOut" onchange="hours(this);" placeholder="00" id="dailyReportTimeOut" required>
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">Hours</span>
											</div>
											<input type="number" class="form-control" name="dailyReportTimeOut1" onchange="mins(this);" placeholder="00" id="dailyReportTimeOut1" required>
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">Min</span>
											</div>
										</div>
										<div class="col-md-6" id="exptimeerror"></div>
									</div>
								</div>
							</div>
							
							<div class="col-md-6 ">
								<label for="validationCustom01" class="col-form-label">Challenges Faced<br><small>(300 Characters Allowed)</small></label>
								<textarea class="form-control mb-4" placeholder="Challenges Faced" name="challeges_face" maxlength="300"  rows="2"></textarea>
							</div>
							<div class="col-md-6">
								<label for="validationCustom01" class="col-form-label">Share your experience in brief<br><small>(300 Characters Allowed)</small></label>
								<textarea class="form-control mb-4" placeholder="Share your experience in brief" name="experience_any" maxlength="300" rows="2"></textarea>
							</div>
							<div class="col-md-6 ">
								<label for="validationCustom01" class="col-form-label">Activity<small>(Guidline Below)<br> 1-No of people reached out 2-Type of participants (age, profession..etc) 3-Other detailed information</small></label>
								<textarea class="form-control mb-4" placeholder="Activity" name="dailyActivity" maxlength="300" rows="2" required ></textarea>
								<?php echo form_error('dailyActivity', '<div class="error">', '</div>'); ?>
							</div>
							<div class="col-md-6 ">
								<label for="validationCustom01" class="col-form-label">How Could it be Improved?<br><small>(300 Characters Allowed)</small></label>
								<textarea class="form-control mb-4" placeholder="How Could it be Improved?" name="improved_msg" maxlength="300"  rows="2"></textarea>
							</div>
							<div class="col-md-6 ">
								<label for="validationCustom01" class="col-form-label">Add Image<sup>*</sup></label>
								<input type="file" class="form-control" id="validationCustom02" name="attachment" value="Otto" multiple>
								<div class="valid-feedback">Looks good!</div>
							</div>
							
						</div>
						<button type="submit" class="btn btn-primary pull-right mb-5" name="submit" value="submit">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script>
	//var count_img = 1;
	//var count_file = 1;
	var ldrti = "<?php echo $leatest_daily_report[0]['dailyReportTimeIn']; ?>";
	var ldrto = "<?php echo $leatest_daily_report[0]['dailyReportTimeOut']; ?>";
	var ldrd = "<?php echo date("d-m-Y", strtotime($leatest_daily_report[0]['dailyReportDate'])); ?>";
		ldrti =  str1.split(':');
		ldrto =  str2.split(':');
		leatest_daily_report_date = ldrd.split('-');
	var new_daily_report_date = new Date(leatest_daily_report_date[2],leatest_daily_report_date[1]-1,leatest_daily_report_date[0]);
	var tldrti = parseInt(ldrti[0] * 3600 + ldrti[1] * 60 + ldrti[0]);
	var tldrto = parseInt(ldrto[0] * 3600 + ldrto[1] * 60 + ldrto[0]);
</script>
<script>
function validate(){

	var stimeh = $('#dailyReportTimeIn').val();
	var date = $('#dob_caf').val();
	var expdate = "<?php echo date('d-m-Y'); ?>";
	var stimem = $('#dailyReportTimeIn1').val();
	var exptimeh = $('#dailyReportTimeOut').val();
	var exptimem = $('#dailyReportTimeOut1').val();
	job_start_date = date.split('-');
	job_end_date = expdate.split('-');
	var new_start_date = new Date(job_start_date[2],job_start_date[1]-1,job_start_date[0]);
	var new_end_date = new Date(job_end_date[2],job_end_date[1]-1,job_end_date[0]);
	// alert(new_start_date);
	// alert(new_end_date);
	if(new_end_date >= new_start_date) {
		
		$('#expdateerror').html('');
		// alert(new_start_date);
		// alert(new_end_date);
		var str1 = stimeh+':'+stimem+':00';
		var str2 = exptimeh+':'+exptimem+':00';

		str1 =  str1.split(':');
		str2 =  str2.split(':');

		totalSeconds1 = parseInt(str1[0] * 3600 + str1[1] * 60 + str1[0]);
		totalSeconds2 = parseInt(str2[0] * 3600 + str2[1] * 60 + str2[0]);

		// compare them

		if (totalSeconds1 < totalSeconds2 ) {
			$('#exptimeerror').html('');
			return true;
		}
		else{
			$('#exptimeerror').html('<span style="color:red;">Please choose valid time.</span>');
			return false;
		}
		// your code
	}
	else{
			$('#expdateerror').html('<span style="color:red;">Please choose valid date.</span>');
			return false;
		}
}
function mins(id)
{
	var mins = $(id).val();
	if(mins<0)
	{
		$(id).val('0');
	}
	else if(mins>59)
	{
		$(id).val('59');
	}
	else if(mins<10){
		
		$(id).val('0'+mins);
		
	}
}
function hours(id)
{
	var hours = $(id).val();
	if(hours<0)
	{
		$(id).val('0');
	}
	else if(hours>23)
	{
		$(id).val('23');
	}
	else if(hours<10){
		
		$(id).val('0'+hours);
		
	}
}
</script>
<script>
	function onlyNumber(id) {
        var id_value = $('#' + id).val();
        id_value = id_value.replace(/[^0-9\.]/g, '');
        $('#' + id).val(id_value);

    }
</script>