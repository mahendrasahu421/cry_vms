<style>
	.card {
		position: relative;
		margin-bottom: 1.5rem;
		width: 100%;
	}
</style>
<style>
	#success_msg {
		color: black;
		margin-bottom: 15px;
		font-size: 25px;
	}

	#p1 {
		font-size: 15px;
	}
</style>



<div class="main-content app-content mt-0">
	<div class="side-app">
		<!-- CONTAINER -->
		<div class="main-container container-fluid">
			<!-- PAGE-HEADER -->
			<div class="page-header">
				<div>
					<h1 class="page-title"> Share Link</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Share Link</li>
					</ol>
				</div>

			</div>
			<?php echo $this->session->flashdata('master_insert_message'); ?>
			<div class="row mt-3">
				<div class="col-lg-12 col-md-12">
					<div class="card" id="panel">
						<div class="card-body">
							<form class="needs-validation" novalidate method="POST" id="form" action="">
								<div class="form-row">
									<div class="col-md-6">
										<label for="validationCustom01" class="form-label">Select Program</label>
									</div>
									<div class="col-md-6">
										<select class="form-control select2-show-search form-select" name="programName" id="programName" required>
											<option value="0">Select Program</option>
											<?php foreach ($program as $programData) { ?>
												<option value="<?php echo $programData['program_id']; ?>">
													<?php echo $programData['program_name'] . " (" . date('M-Y', strtotime($programData['programstart_date'])) . ")"; ?>
												</option>

											<?php } ?>
										</select>
									</div>
									<div class="col-md-6 mt-5 registration">
										<label for="validationCustom02" class="form-label">Registration Link</label>
									</div>
									<div class="col-md-6 mt-5">
										<p id="p1"></p>

									</div>


									<div class="col-md-2 mt-5 registration">
										<a target="_blank" href="" id="whatsaapp"><span class="badge rounded-pill bg-success me-1 mb-1 mt-1">Share Link With Whats App</span>
										</a>
									</div>
									<div class="form-group col-md-4 mt-5 registration">
										<a href="" target="_blank" id="facebook"><span class="badge rounded-pill bg-success me-1 mb-1 mt-1">Share Link With Facebook</span></i>
										</a>
									</div>
									<div class="col-md-2 mt-3 registration">
										<p onclick="copyToClipboard('#p1')" class="btn btn-default  mt-1 mb-1 me-3">Copy Link</p>
									</div>
									<div class="col-md-4 mt-3">

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
</div>
<script>
	$("#programLink").hide();
	$(".registration").hide();
	$(document).ready(function() {
		$('#programName').change(function() {
			var progrmValue = $("#programName").val();
			var encodedString = btoa(progrmValue);
			var encodeLast = encodedString.slice(0, 2);

			var link = "https://mgracesolution.com/cryvms/volunteer-programs/" + encodeLast;
			$("#programLink").show();
			$(".registration").show();
			$("#p1").html(link);
			$("#whatsaapp").attr("href", "https://api.whatsapp.com/send?text=Fill Your Basic Details ,follow this link " + link);
			$("#facebook").attr("href", "https://www.facebook.com/sharer/sharer.php?u=Fill Your Basic Details ,follow this link " + link);

		});
	});
</script>
<script>
	function copyToClipboard(element) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}
</script>