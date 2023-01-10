<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel" style="font-size: 24px;">PROFILE DETAILS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body row" id="profile_details">
				<div class="col-md-3 m-b-20 text-center">
					<img src="<?php echo base_url('admin/'); ?>assets/images/crop.jpg" class="img-fluid" alt="" title="">
				</div>
				<div class="col-md-8">
					<h2 class="">Mahendra sahu</h2>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold text-dark">Volunteer ID</div>
						<div class="col">CS/DL/21/79</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold text-dark">Phone</div>
						<div class="col">9871191543</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold text-dark">Email</div>
						<div class="col"><a href="#" class="text-inverse"><span class="_cf_email_">Mahi421@gmail.com</span></a></div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold text-dark">Date of Birth</div>
						<div class="col">25-11-2000</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold text-dark">State</div>
						<div class="col">Delhi</div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold text-dark">City</div>
						<div class="col"></div>
					</div>
					<div class="row mb-2">
						<div class="col-4 font-weight-bold text-dark">Address</div>
						<div class="col"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">intern List</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">intern List</li>
					</ol>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<div class="col-md-3">
								<select class="form-control select2-show-search form-select">
									<option value="">Select Region</option>
									<option value="AN">Region 1</option>
									<option value="AP">Region 2</option>
									<option value="AR">Region 3</option>
									<option value="AS">Region 4</option>

								</select>
							</div>
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
							<div class="col-md-4">
								<div class="input-group  p-0">
									<span class="input-group-text btn btn-warning">Search</span>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th>S.no</th>
											<th>Reg. Date</th>
											<th>Intren ID </th>
											<th>Name</th>
											<th>Mobile</th>
											<th>Email</th>
											
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>20/07/2022 </td>
											<td> CS/AS/22/98
											</td>
											<td>
												Mahendra Sahu
												<br>
												<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">(View Profile)</a>
											</td>
											<td>6003153463</td>
											<td>Mahi421@gmail.com</td>
											
											<td>
												<div class="btn-group dropstart">
													<button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
													</button>
													<ul class="dropdown-menu">
														<li><a href="#">Block</a></li>
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
</div>
</div>