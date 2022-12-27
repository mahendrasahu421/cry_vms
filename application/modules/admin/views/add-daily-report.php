<style>
	table td {
		white-space: initial !important;
	}

	.tk {
		margin-bottom: 0px !important;
	}

	.card .card-block,
	.card .card-body {
		padding: 1px 25px !important;
	}
</style>
<section class="pcoded-main-container">
	<div class="pcoded-content">

		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Add Daily Report</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="admin-dashboard"><i class="fa fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Report</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5>Add Daily Report</h5>
					</div>
					<hr>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<form>
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Choose Task</label>
										<div class="col-sm-8">
											<select class="form-control" id="exampleFormControlSelect1">
												<option>Select Task</option>
												<option>Select One</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Date</label>
										<div class="col-sm-8">
											<input type="text" name="birthday" value="04/08/2020" class="form-control" />
										</div>
									</div>
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Time In-out</label>
										<div class="col-sm-4">
											<input type="time" class="form-control">
										</div>
										<div class="col-sm-4">
											<input type="time" class="form-control">
										</div>
									</div>

									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Activity</label>
										<div class="col-sm-8">
											<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Activity"></textarea>
										</div>
									</div>

							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Attachment</label>
										<div class="col-sm-8">
											<button type="button" class="btn btn-primary" onclick="addMore();"><i class="fa fa-plus"></i> Add File</button>
										</div>
									</div>

									<ul id="list">
										<li class="default" style="display: none;">
											<input type="file" class="img-add" /><span class="add-file" onclick="closeMe(this);"><i class="fa fa-trash"></i></span>
										</li>
									</ul>
									<hr>
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-4 col-form-label">Attachment</label>
										<div class="col-sm-8">

											<button type="button" class="btn btn-primary" onclick="addMoreimage();"><i class="fa fa-plus"></i> Add Image</button>
										</div>
									</div>

									<ul id="list1">
										<li class="default1" style="display: none;">
											<input type="file" class="img-add" /><span class="add-img" onclick="closeMe(this);"><i class="fa fa-trash"></i></span>
										</li>
									</ul>

									<script>
										function closeMe(element) {
											$(element).parent().remove();
										}

										function addMore() {
											var container = $('#list');
											var item = container.find('.default').clone();
											item.removeClass('default');
											//add anything you like to item, ex: item.addClass('abc')....
											item.appendTo(container).show();
										}

										function addMoreimage() {
											var container = $('#list1');
											var item = container.find('.default1').clone();
											item.removeClass('default1');
											//add anything you like to item, ex: item.addClass('abc')....
											item.appendTo(container).show();
										}
									</script>

									<video id="video" width="250" height="280" autoplay></video>
									<button id="snap" class="btn btn-primary">Take Photo</button>
									<!--<canvas id="canvas" width="250" height="280"></canvas>-->

								</div>
								<button type="submit" class="btn btn-primary pull-right mb-5">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="row">

				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<h5>Today Report List</h5>
						</div>
						<hr>
						<div class="row ml-3">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<div class="form-group row tk">
									<label for="inputEmail3" class="col-sm-4 col-form-label ">Choose Task</label>
									<div class="col-sm-8">
										<select class="form-control">
											<option>Select Task</option>
											<option>Select One</option>
										</select>
									</div>
								</div>


							</div>
							<div class="col-md-1"></div>
						</div>
						<hr>
						<div class="card-body">
							<div class="dt-responsive table-responsive">
								<table id="dom-table" class="table table-striped table-bordered pre-line">
									<thead>
										<tr>
											<th rowspan="2">Sr.no</th>
											<th colspan="2">Time Duration</th>
											<th rowspan="2">Task</th>
											<th rowspan="2">Total Time</th>
											<th rowspan="2">Attachment</th>
										</tr>
										<tr>
											<th>Time In</th>
											<th>Time Out</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>9:30am</td>
											<td>1:30pm </td>
											<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
											<td>10 Hour</td>
											<td>
												<ul>
													<a href="#">
														<li>galley.jpg</li>
													</a>
													<a href="#">
														<li>galley.jpg</li>
													</a>
													<a href="#">
														<li>galley.pdf</li>
													</a>
												</ul>
											</td>

										</tr>
										<tr>
											<td>2</td>
											<td>3 Hour</td>
											<td>1 Hour </td>
											<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
											<td>10 Hour</td>
											<td>
												<ul>
													<li>galley.jpg</li>
													<li>galley.jpg</li>
													<li>galley.jpg</li>
												</ul>
											</td>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>

</div>

<script>
	var video = document.getElementById('video');

	// Get access to the camera!
	if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
		// Not adding `{ audio: true }` since we only want video now
		navigator.mediaDevices.getUserMedia({
			video: true
		}).then(function(stream) {
			//video.src = window.URL.createObjectURL(stream);
			video.srcObject = stream;
			video.play();
		});
	}

	// Elements for taking the snapshot
	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');
	var video = document.getElementById('video');

	// Trigger photo take
	document.getElementById("snap").addEventListener("click", function() {
		context.drawImage(video, 0, 0, 250, 280);
	});
</script>