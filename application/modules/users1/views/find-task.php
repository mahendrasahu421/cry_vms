<style>
table td{white-space:initial !important;}
.col-md-4 .card-header {
padding: 6px 25px !important;}
.col-md-3 .card-header {
padding: 6px 25px !important;}
.card .card-block, .card .card-body {
    padding: 1px 25px !important;
}
.col-md-1{
padding-left: 0px !important;
top:8px;}
</style>
<section class="pcoded-main-container">
<div class="pcoded-content">
<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10">Find Task List</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item">Find Task</li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12">
<?php
if($this->session->userdata('request_send'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> User Request Send For This Task.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('request_send'); } ?>

<div class="card">
<div class="card-header">
<h5> Find Task List</h5>
</div><hr>
<form method="GET" action="<?php echo base_url(); ?>search-find-task">
<div class="row ml-2">
	<div class="col-md-4">
		<div class="card-header">
			<h5>By State</h5>
		</div>
		<div class="card-body">
			<select class="form-control" id="state" name="state"  onchange="fetch_state_city(this.value,'cities','state')" >
				<option value="">Select State</option>
				<?php 
				foreach ($state as $key => $value) {
				?>
				<option <?php if($states==$value['stateID']){echo "selected"; } ?> value="<?php echo $value['stateID']; ?>"><?php echo $value['stateName']; ?> </option>
				<?php } ?>
			</select>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card-header">
			<h5>By City</h5>
		</div>
		<div class="card-body">
			<select class="form-control"id="cities" name="cities"  onchange="fetch_state_city(this.value,'tbl_div','cities');">
				<option>Select City</option>
				
				<?php 
				foreach ($city as $key => $value) {
				?>
				<option <?php if($cities==$value['cityID']){echo "selected"; } ?> value="<?php echo $value['cityID']; ?>"><?php echo $value['cityName']; ?> </option>
				<?php } ?>
				
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card-header">
			<h5>By Theam</h5>
		</div>
		<?php 
		//print_r($cause);
		?>
		<div class="card-body">
			<select class="form-control" name="causes">
				<option value="">Select Theam</option>
				<?php foreach($causes as $c){?>
				<option <?php if($cause==$c['causesID']){echo "selected"; } ?> value="<?php echo $c['causesID']?>"><?php echo $c['causesName']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	
	<div class="col-md-1 mt-4">
	<button class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
	</div>
</div>
</form>
<hr>
<div class="clearfix"></div>
<div class="mt-3">
<ul class="list-inline ml-3 text-uppercase lp-5 font-medium font-12">
<li><i class="fa fa-circle m-r-5 f-10 text-primary"></i> New</li>
<li><i class="fa fa-circle m-r-5 f-10 text-warning"></i> In process</li>
</ul>
</div>

<div class="clearfix"></div>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="dom-table" class="table table-striped table-bordered pre-line">
<thead>
<tr>
<th class="w-20"></th>
<th>Published Date</th>
<th>Task</th>
<th>Description</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php foreach($task as $tsk){
 $publishdate= $tsk['taskPublishedDate'];
?>

<tr>
<td>
<ul class="list-inline  text-uppercase m-0   font-medium font-12">
<li><i class="fa fa-circle f-10  text-primary"></i></li>
</ul>
</td>
<td><?php echo date("d-m-Y", strtotime($publishdate)); ?></td>
<td><?php echo $tsk['taskTitle'];?></td>
<td><?php echo $tsk['taskDescription']; ?></td>
<?php $encoded_id=rtrim(strtr(base64_encode($tsk['taskID']), '+/', '-_'), '='); ?>
<?php $this->load->model('curl/Curl_model');
		$userID = $this->session->userdata('userID');
		$fields = array(
            'taskID',
            'userID',
        );
        $where = array('userID'=>$userID,
						'taskID'=>$tsk['taskID'] );
        $limit = '';
        $order_by = array('userID','ASC');
        $send_status = $this->Curl_model->fetch_data_in_many_array('send_requiest',$fields,$where,$limit,$order_by);
		?>
<?php if(sizeof($send_status)==0){	?>
<td><a href="<?php echo base_url().'send-request/'.$encoded_id;?>" onclick="return confirm('Are you sure, you want to Send Request?')" ><button class="btn btn-outline-success" data-toggle="tooltip" data-placement="bottom" title="Send Request">Send Request </button></a></td>
<?php }else{ ?>
<td><button class="btn btn-danger">Request Send</button></td>
<?php } ?>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>


<script>
	function fetch_state_city(stateID,display_id,state_city)
	{
		if(state_city=='state')
		{
			var url= '<?php echo base_url("all-city"); ?>';
		}
		var request = $.ajax({
        url: url,
        method: "POST",
        data: {stateId : stateID,state_city : state_city},
        success: function(results)
            {
                console.log(results);
				$('#'+display_id).html(results);  
            }
        });
	}
</script>


</div>
</div>
</section>

</div>
