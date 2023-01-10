<style>
	ul#menu li {
		display: inline;
	}
</style>
<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Task List</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Task List</li>
					</ol>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<div class="col-md-3">
								<select class="form-control select2-show-search form-select">
									<option value="">Select State</option>
									<option value="AN">Andaman and Nicobar Islands</option>
									<option value="AP">Andhra Pradesh</option>
									<option value="AR">Arunachal Pradesh</option>
									<option value="AS">Assam</option>
									<option value="BR">Bihar</option>
									<option value="CH">Chandigarh</option>
								</select>
							</div>
							<div class="col-md-3">
								<select class="form-control select2-show-search form-select">
									<option value="Achhnera">City</option>
									<option value="Afzalgarh">Afzalgarh</option>
									<option value="Agra">Agra</option>
									<option value="Ahraura">Ahraura</option>
									<option value="Ajodhya">Ajodhya</option>
									<option value="Akbarpur">Akbarpur</option>
									<option value="Aliganj">Aliganj</option>
									<option value="Aligarh">Aligarh</option>
									<option value="Allahabad">Allahabad</option>

								</select>
							</div>
							<!-- <div class="col-md-3">
								<input class="form-control" placeholder="Input box (success state)" required type="date" value="This is input">
							</div> -->


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
											<th>Publish Date</th>
											<th>Task</th>
											<th>Description</th>
											<th>Action</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>09/11/2020</td>
											<td>Support to Resource Mobilisation Desk</td>
											<td>Documentation, Research and development</td>
											<td>
												<button class="btn btn-secondary  mt-1 mb-1 me-3">Send Request</button>
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
										<tr>
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