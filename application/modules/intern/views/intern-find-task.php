<div class="main-content app-content mt-0">
	<div class="side-app">
		<div class="main-container container-fluid">
			<div class="page-header">
				<div>
					<h1 class="page-title">Find Task List</h1>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
						<li class="breadcrumb-item active text-warning" aria-current="page">Task List</li>
					</ol>
				</div>
			</div>
			<div class="row row-sm">
				<div class="col-lg-12">
				<?php
if($this->session->userdata('request_send'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> Volunteer Request Send For This Task.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('request_send'); } ?>
					<div class="card">
					<!--<form method="GET" action="<?php echo base_url(); ?>search-find-task">
						<div class="card-header bg-warning">
							<div class="col-md-3">
								<select class="form-control form-select" id="state" name="state" onchange="fetch_state_city(this.value,'cities','state')">
								<option value="">Select State</option>
								<?php 
								foreach ($state as $key => $value) {
								?>
								<option <?php if($states==$value['state_id']){echo "selected"; } ?> value="<?php echo $value['state_id']; ?>"><?php echo $value['state_name']; ?> </option>
								<?php } ?>
							</div>
							<div class="col-md-3">
								<select class="form-control form-select" id="cities" name="cities"  onchange="fetch_state_city(this.value,'tbl_div','cities');">
								<option value="0">Select City</option>
									<?php 
									foreach ($city as $key => $value) {
									?>
									<option <?php if($cities==$value['cityID']){echo "selected"; } ?> value="<?php echo $value['cityID']; ?>"><?php echo $value['cityName']; ?> </option>
									<?php } ?>

								</select>
							</div>

							<div class="col-md-3">
								<button class="btn btn-dark"><i class="fa fa-search me-1"></i>Search</button>
							</div>
						</div>
						</form>-->
						<div class="p-2">
							<div class="table-responsive">
								<table id="example" class="display nowrap" style="width:100%">
									<thead>
										<tr class="bg-gray-light">
											<th class="w-5">SNo.</th>
											<th class="w-5">Publish Date</th>
											<th class="w-15">Task</th>
											<th>Description</th>
											<th class="w-5">Task Type</th>
											<th class="w-5">Request Process</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php $i=1; foreach($interntask as $tsk){
									 $publishdate= $tsk['creation_date'];
									 $encoded_id=rtrim(strtr(base64_encode($tsk['intern_task_id']), '+/', '-_'), '=');
									?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo date("d-m-Y", strtotime($publishdate)); ?></td>
											<td class="text-wrap"><?php echo $tsk['task_title'];?></td>
											<td class="text-wrap"><?php echo $tsk['task_brief']; ?></td>
											<td class="text-wrap"><?php echo $tsk['task_type']; ?></td>

											 <?php //$encoded_id=rtrim(strtr(base64_encode($tsk['intern_task_id ']), '+/', '-_'), '='); ?>
												<?php $this->load->model('curl/Curl_model');
														$intern_id = $this->session->userdata('intern_id');
														$fields = array(
															'intern_task_id ',
															'intern_id',
														);
														$where = array('intern_id'=>$intern_id,
																		'intern_task_id '=>$tsk['intern_task_id'] );
														$limit = '';
														$order_by = array('intern_id','ASC');
														$send_status = $this->Curl_model->fetch_data_in_many_array('intern_send_request',$fields,$where,$limit,$order_by);
														?>
												<?php if(sizeof($send_status)==0){	?>
												<td><a href="<?php echo base_url().'intern-send-request/'.$encoded_id;?>" onclick="return confirm('Are you sure, you want to Send Request?')" ><button class="btn btn-outline-success" data-toggle="tooltip" data-placement="bottom" title="Send Request">Send Request </button></a></td>
												<?php }else{ ?>
												<td><button class="btn btn-danger">Request Sent</button></td>
												<?php } ?> 
											<td>
												<div class="btn-group dropstart">
													<button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
													</button>
													<ul class="dropdown-menu">
														<li><a href="<?php echo base_url().'view-intern-task-details/'.$encoded_id;?>">View Task</a></li>
													</ul>
												</div>
											</td>
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

<script>
	function fetch_state_city(state_id,display_id,state_city)
	{
		//alert"jbfjef";
		if(state_city=='state')
		{
			var url= '<?php echo base_url("all-city-vol"); ?>';
		}
		var request = $.ajax({
        url: url,
        method: "POST",
        data: {state_id : state_id,state_city : state_city},
        success: function(results)
            {
                console.log(results);
				$('#'+display_id).html(results);  
            }
        });
	}
</script>