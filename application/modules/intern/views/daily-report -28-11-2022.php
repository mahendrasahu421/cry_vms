<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Daily Report</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard'; ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Daily Report</li>
					</ol>
				</div>
				<div class="ms-auto pageheader-btn">
					<a href="add-daily-report" class="btn btn-warning btn-icon text-white me-2">
						<span>
							<i class="fe fe-plus"></i>
						</span> Add Daily Report
					</a>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						
						<div class="card-header">
							<div class="col-md-1">
								<label for="validationCustom01" class="form-label">Select Task</label>
							</div>
							<div class="col-md-3">
								<select class="form-control select2-show-search form-select">
									<option value="AZ">Select Task</option>
									<option value="AZ">Humanitarian Aid And Disaster Risk Reduc</option>
									<option value="CO">Climate Adaptive Agriculture and Food So</option>
									<option value="ID">Livelihood and Skill Development</option>
									<option value="MT">Anti Human Trafficking & Safe Migration</option>
									<option value="NE">Health And Nutrition</option>
									<option value="NM">Peace Building</option>
								</select>
							</div>
							<div class="col-md-3">
								<div class="input-group  p-0">
									<span class="input-group-text btn btn-warning">Search</span>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div>
								<ul id="menu" class="list-inline ml-3 lp-5 font-medium font-12">
									<li><i class="fa fa-circle m-r-5 f-10 text-info"></i> New</li>
									<li><i class="fa fa-circle m-r-5 f-10 text-warning"></i> In process</li>

								</ul>
							</div>
							<div class="table-responsive">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th class="w-5">SNo.</th>
											<th>Date</th>
											<th>Time In</th>
											<th>Time Out</th>
											<th>Task Activity</th>
											<th>Total Time</th>
											<th></th>

										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>30-09-2021</td>
											<td>06:00 AM</td>
											<td>10:00 AM</td>
											<td>Writing should be clear enough so others can understand it properly</td>
											<td>
												4 hour 0 mins
											</td>
											<td>
											<div class="btn-group dropstart">
												<button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
												</button>
												<ul class="dropdown-menu">
													<li><a href="view-task-details">View Task</a></li>

												</ul>
											</div>
											</td>

										</tr>
										<!-- <tr>
                                            <td>1</td>
                                            <td>09/11/2020</td>
                                            <td>Support to Resource Mobilisation Desk</td>
                                            <td>Documentation, Research and development</td>
                                            <td>
                                                <button class="btn btn-info  mt-1 mb-1 me-3">Request Send</button>
                                            </td>
                                            <td>
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="view-task-details">View Task</a></li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr> -->

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