<?php $date = date("Y/m/d"); ?>
<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title"> Self Daily Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Self Daily Report</li>
					</ol>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<select class="form-control select2-show-search form-select col-md-3">
								<option value="">Select Region</option>
								<option value="6">Region 1</option>
								<option value="5">Region 2</option>
								<option value="4">Region 3</option>
								<option value="3">Region 4</option>
								<option value="2">Region 5</option>
							</select>
							<div class="input-group col-md-3 ">
								<select class="form-control select2-show-search form-select col-md-3">
									<option value="">Select State</option>
									<option value="6">Uttar Pradesh</option>
									<option value="5">Dihar</option>
									<option value="4">uttrakhand</option>
									<option value="3">AndraPradesh</option>
								</select>
							</div>
							<div class="input-group col-md-3 ">
								<input type="date" class="form-control " placeholder="Search for...">
							</div>
							<div class="input-group col-md-3 p-5">
								<span class="input-group-text btn btn-warning">Go!</span>
							</div>
						</div>
						<div class="card-body">
							<!-- <div>
								<ul id="menu" class="list-inline ml-3 lp-5 font-medium font-12">
									<li><i class="fa fa-circle m-r-5 f-10 text-info"></i> New</li>
									<li><i class="fa fa-circle m-r-5 f-10 text-warning"></i> In process</li>
									<li><i class="fa fa-circle m-r-5 f-10 text-success"></i> Done</li>
								</ul>
							</div> -->
							<div class="table-responsive">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th rowspan="2">Sr.no</th>
											<th rowspan="2">Date</th>
											<th colspan="2" class="text-center">Time Duration</th>
											<th rowspan="2">Task</th>
											<th rowspan="2">Total Time</th>
											<th rowspan="2">Status</th>
										</tr>
										<tr class="bg-gray-light">
											<th>Time In</th>
											<th>Time Out</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>01/09/2020</td>
											<td>10 AM</td>
											<td>2 PM</td>
											<td>Peace Building </td>
											<td>5 Hours</td>

											<td><span class="badge bg-warning  me-1 mb-1 mt-1">Active</span></td>

										</tr>
										<tr>
											<td>2</td>
											<td>10/09/2021</td>
											<td>9 AM</td>
											<td>1 PM</td>
											<td>Health And Nutrition</td>
											<td>5 Hours</td>
											<td><span class="badge bg-warning  me-1 mb-1 mt-1">Active</span></td>
										</tr>
										<tr>
											<td>3</td>
											<td>11/09/2020</td>
											<td>4 PM</td>
											<td>7 PM</td>
											<td>Anti Human Trafficking & Safe Migration</td>
											<td>4 Hours</td>

											<td><span class="badge bg-warning  me-1 mb-1 mt-1">Active</span></td>
										</tr>
									</tbody>
								</table>
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
