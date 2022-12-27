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
			
			<?php
			if($this->session->userdata('task_accept'))
			{
			?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Successfull!</strong> This Task has been accepted.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php $this->session->unset_userdata('task_accept'); } ?>

			<?php
			if($this->session->userdata('task_reject'))
			{
			?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>Successfull!</strong> This Task has been Reject.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php $this->session->unset_userdata('task_reject'); } ?>
			
				<div class="col-lg-12">
					<div class="card">
					<!--<form method="GET" action="<?php echo base_url(); ?>search-my-task">
						<div class="card-header bg-warning">
							<div class="col-md-3">
								<select class="form-control form-select" name="state">
								<?php foreach($states as $st){?>
									<option <?php if($state==$st['state_id']){echo "selected"; } ?> value="<?php echo $st['state_id']?>"><?php echo $st['state_name']; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="col-md-3">
								<select class="form-control form-select" name="status">
									<option value="0">Select Status</option>
									<option value="1" <?php if($status==1){echo "selected"; } ?>>Accept</option>
									<option value="2" <?php if($status==2){echo "selected"; } ?>>Reject</option>
								</select>
							</div>
							<div class="col-md-3">
								<input type="date" name="datefilter" class="form-control" placeholder="Select Date" value="<?php echo $datefilter; ?>" />
							</div>
							<div class="col-md-3">
								<div class="input-group  p-0">
									<button class="btn btn-dark" value="Search" type="submit"><i class="fa fa-search me-1"></i>Search</button>
								</div>
							</div>
						</div>
					</form>-->
						<div class="p-2">
							<div class="table-responsive">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th class="w-5">SNo.</th>
											<th>Date</th>
											<th>Task</th>
											<th>Description</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<?php $i=1; foreach($task as $key => $value){
										 $publishdate= $value['creation_date'];
										 $status = $value['task_status'];
										 $encoded_id=rtrim(strtr(base64_encode($value['task_id']), '+/', '-_'), '='); 
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo date("d-m-Y", strtotime($publishdate)); ?></td>
											<td class="text-wrap"><?php echo $value['task_title'];?></td>
											<td class="text-wrap"><?php echo substr($value['task_brief'], 0, 150); ?></td>
											<?php if($value['status']==0){ ?>
											<td><span class="badge bg-warning">On Hold</span></td>
											<?php } else if($value['status']==1){?>
											<td><span class="badge bg-success">Accepted</span></td>
											<?php } else if($value['status']==2){?>
											<td><span class="badge bg-danger">Rejected</span></td>
											<?php } ?>
											<?php if($value['status']==0){	?>
											<td>
												<div class="btn-group dropstart">
													<button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
													</button>
													<ul class="dropdown-menu">
														<li><a href="<?php echo base_url().'view-task-details/'.$encoded_id;?>">View Task</a></li>
														<li><a href="<?php echo base_url().'task-accept/'.$encoded_id;?>" onclick="return confirm('Are you sure, you want to Accept it?')" title="Accept">Accept</a></li>
														<li><a href="<?php echo base_url().'task-reject/'.$encoded_id;?>" onclick="return confirm('Are you sure, you want to Reject it?')" title="Reject">Reject</a></li>
													</ul>
												</div>
											</td>
											<?php }else { ?>
											<td>
												<div class="btn-group dropstart">
													<button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
													</button>
													<ul class="dropdown-menu">
														<li><a href="<?php echo base_url().'view-task-details/'.$encoded_id;?>">View Task</a></li>
													</ul>
												</div>
											</td>
										<?php } ?>
										</tr>
									<?php } ?>
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