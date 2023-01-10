<style>
table td{white-space:initial !important;}
.col-md-6 .card-header {
padding: 6px 25px !important;} 
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
<h5 class="m-b-10">Daily Report</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
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
<h5>Daily Report List</h5>
</div><hr>
<form action="#" method="post">
<div class="row ml-3">

	<div class="col-md-5">
		<div class="card-header">
			<h5>Search By Task</h5>
		</div>
		<div class="card-body">
			<select class="form-control" name="taskID">
			<?php
			foreach ($task as $key => $value) {
				?>
				<option value="<?php echo $value['taskID']; ?>" <?php if($taskID==$value['taskID']){echo "selected"; } ?>><?php echo ucwords($value['taskTitle']); ?></option>
				<?php
			}
			?>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card-header">
			<h5>Search By Date</h5>
		</div>
		<div class="card-body">
			<input type="text" name="birthday" class="form-control" value="<?php if(isset($birthday)){echo date("m/d/Y", strtotime($birthday)); } ?>" />
		</div>
	</div>
	<div class="col-md-2">
	<div class="card-header">
	<br>
	<br>
		<button type="submit" class="btn btn-info btn-sm">Search</button>
	</div>
	</div>

</div>
</form>
<hr>

<!--- Reject Model Popup----->
<div class="modal fade project-details" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-header">
		<h4 class="modal-title text-uppercase font-weight-bold">Daily Report Reject</h4>
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
				<h4 class="f-16 m-0 p-0 font-weight-bold">Working Hours</h4>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control" value="4 Days" />
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
	</div>
	</div>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-rounded btn-primary">Save</button>
	<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
	</div>
	</div>
</div>
<!------ End Model Reject popup ----->


<!--- Daily Report Details Model Popup----->
<div class="modal fade daily-report" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-header">
		<h4 class="modal-title text-uppercase font-weight-bold">Daily Report Details</h4>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<div class="modal-body">
		<div class="row form-group m-b-20">
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
			<td>4 Hour</td>
			<td>
				<ul>
					<a href="#"><li>galley.jpg</li></a>
					<a href="#"><li>galley.jpg</li></a>
					<a href="#"><li>galley.pdf</li></a>
				</ul>
			</td>

			</tr>
			<tr>
			<td>2</td>
			<td>11:30 am</td>
			<td>1:30 pm </td>
			<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
			<td>2 Hour</td>
			<td>
				<ul>
					<li>galley.jpg</li>
					<li>galley.jpg</li>
					<li>galley.jpg</li>
				</ul>
			</td>

			</tr>
			<tr>
			<td>3</td>
			<td>11:30 am</td>
			<td>1:30 pm </td>
			<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
			<td>2 Hour</td>
			<td>
				<ul>
					<li>galley.jpg</li>
					<li>galley.jpg</li>
					<li>galley.jpg</li>
				</ul>
			</td>

			</tr>
			<tr>
			<td>4</td>
			<td>11:30 am</td>
			<td>12:30 pm </td>
			<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td>
			<td>1 Hour</td>
			<td>
				<ul>
					<li>galley.jpg</li>
					<li>galley.jpg</li>
					<li>galley.jpg</li>
				</ul>
			</td>
			</tr>

			</tbody>
			</table>

		</div>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
	</div>
	</div>
</div>
<!------ End Model Daily Report View popup ----->


<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="dom-table" class="table table-striped table-bordered pre-line">
	<thead>
		<tr>
			<th>S.no</th>
			<th>Volunteer Name</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>Total Time</th>
			<th></th>
		</tr>
	</thead>
<tbody>
<?php
	$count=1;
	foreach ($daily_report as $key => $value) {
		$time1 = strtotime($value['dailyReportTimeIn']);
		$time2 = strtotime($value['dailyReportTimeOut']);
		$total_time = round(abs($time2 - $time1) / 3600,0);
	
?>
<tr>
<td><?php echo $count++; ?></td>
<td><?php if($value['gender']==1){ echo "Mr."; }else{ echo "Mrs.";}?> <?php echo ucwords($value['firstName'].' '.$value['lastName']); ?> <br><a href="#" data-toggle="modal" data-target=".daily-report"><small class="text-primary">(View details)</small></a></td>
<td><?php echo $value['mobile']; ?></td>
<td><?php echo $value['email']; ?></td>
<td><?php echo $total_time.' Hour';if($total_time>1){echo 's'; }?> </td>
<td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu">
 <a href="#" class="dropdown-item" href="#">Approved</a>
 <a href="#" data-toggle="modal" data-target=".project-details" class="dropdown-item">DisApproved</a>
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
</section>

</div>