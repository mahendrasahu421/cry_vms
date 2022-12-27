<style>
table td{white-space:initial !important;}
.col-md-4 .card-header {
padding: 6px 25px !important;}
.col-md-3 .card-header {
padding: 6px 25px !important;}
.col-md-1{
padding-left: 0px !important;
top:8px;}
.card .card-block, .card .card-body {
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
<h5 class="m-b-10">Task List</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item">User Task</li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">

<div class="col-sm-12">
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

<div class="card">
<div class="card-header">
<h5>Cause Task List</h5>
</div><hr>
<form method="GET" action="<?php echo base_url(); ?>search-my-task">
<div class="row">
	<div class="col-md-4">
		<div class="card-header">
			<h5>By Theam</h5>
		</div>
		<div class="card-body">
			<select class="form-control" name="cause">
				<option value="">Select Theam</option>
				<?php foreach($causes as $c){?>
				<option <?php if($cause==$c['causesID']){echo "selected"; } ?> value="<?php echo $c['causesID']?>"><?php echo $c['causesName']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card-header">
			<h5>By Date</h5>
		</div>
		<?php 
		//print_r($datefilter);
		?>
		<div class="card-body">
			<input type="text" name="datefilter" class="form-control" placeholder="Select Date" value="<?php echo $datefilter; ?>" />
		</div>
	</div>

	<div class="col-md-3">
		<div class="card-header">
			<h5>Status</h5>
		</div>
		<div class="card-body">
			<select class="form-control" name="status">
				<option value="">Status</option>
				<option value="1" <?php if($status==1){echo "selected"; } ?>>Accept</option>
				<option value="2" <?php if($status==2){echo "selected"; } ?>>Reject</option>
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
<li><i class="fa fa-circle m-r-5 f-10 text-success"></i> Rejected</li>
</ul>
</div>
<div class="clearfix"></div>

<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="dom-table" class="table table-striped table-bordered pre-line">
<thead>
<tr>
<th class="w-20"></th>
<th class="wid-90">Date</th>
<th class="wid-150">Task</th>
<th>Description</th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach($task as $key => $value){
 $publishdate= $value['taskPublishedDate'];
 $status = $value['status'];
 $encoded_id=rtrim(strtr(base64_encode($value['taskID']), '+/', '-_'), '='); 
?>


<div class="modal fade project-details" id="myModal_reason" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-header">
		<h4 class="modal-title text-uppercase font-weight-bold">Task Reject</h4>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<div class="modal-body">
		<div class="row form-group m-b-20">
			<div class="col-md-3">
				<h4 class="f-16 m-0 p-0 font-weight-bold">Task Title</h4>
			</div>
			<div class="col-md-9">
				It’s complete shop with opportunity to buy anything anywhere for 2 minutes.
			</div>
		</div>
	<div class="row form-group m-b-20">
		<div class="col-md-3">
			<h4 class="f-16  m-0 p-0 font-weight-bold">Choose Reason</h4>
		</div>
	<div class="col-md-8">
		<select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" id="mylist"  onchange="yesnoCheck(this);">
			<option value="Category 1">Select Reason</option>
			<option value="Category 1">Category 1</option>
			<option value="Category 2">Category 2</option>
			<option value="other">Other</option>
		</select>
		
		<div id="ifYes" style="display: none;">
			<textarea class="form-control mt-3" id="myInput" rows="3"></textarea>
		</div>
		<script> 
		function yesnoCheck(that) {
			if (that.value == "other") {
				document.getElementById("ifYes").style.display = "block";
			} else {
				document.getElementById("ifYes").style.display = "none";
			}
		}
		</script>
		<input type="hidden" id="encoded_id" value="<?php echo $encoded_id; ?>" >
		
	</div>
	
	
	</div>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-rounded btn-primary">Save</button>
	<button type="button" class="btn btn-rounded  btn-secondary" id="submit_reason" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
	</div>
	</div>
</div>

<tr>
<td>
<ul class="list-inline  text-uppercase m-0   font-medium font-12">
<li><i class="fa fa-circle f-10  <?php if($status==0){ echo 'text-primary'; }elseif($status==1){ echo 'text-warning'; }elseif($status==2){ echo 'text-success'; } ?>"></i></li>
</ul>
</td>
<td class="wid-90"><?php echo date("d-m-Y", strtotime($publishdate)); ?></td>
<td class="wid-150"><?php echo $value['taskTitle'];?></td>
<td><?php echo $value['taskDescription']; ?></td>
<?php if($value['status']==0){	?>
	<td><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
	<div class="dropdown-menu">
	 <a href="<?php echo base_url().'view-task-details/'.$encoded_id;?>" class="dropdown-item" href="#">View</a>
	 <a class="dropdown-item" href="<?php echo base_url().'task-accept/'.$encoded_id;?>" onclick="return confirm('Are you sure, you want to Accept it?')" title="Accept">Accept</a>
	 <a href="<?php echo base_url().'task-reject/'.$encoded_id;?>" class="dropdown-item" data-val="2">Reject</a><!-- data-toggle="modal" data-target=".project-details"-->
	</div>
	</td>
	<?php }else if($value['status']==1){ ?>
		<td><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
		<div class="dropdown-menu">
		 <a href="<?php echo base_url().'view-task-details/'.$encoded_id;?>" class="dropdown-item" href="#">View</a>
		 <a class="dropdown-item">Accepted</a><!-- data-toggle="modal" data-target=".project-details"-->
		</div>
		</td>
	<?php } else if($value['status']==2){ ?>
		<td><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
		<div class="dropdown-menu">
		 <a href="<?php echo base_url().'view-task-details/'.$encoded_id;?>" class="dropdown-item" href="#">View</a>
		 <a class="dropdown-item">Rejected</a>
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
</section>

</div>
