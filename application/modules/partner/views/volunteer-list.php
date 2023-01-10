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
<h5 class="m-b-10">Volunteers</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Volunteer List</a></li>
</ul>
</div>
</div>
</div>
</div>


<!---Profile View Model Popup----->
<div class="modal fade profile-details" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-header">
		<h4 class="modal-title text-uppercase font-weight-bold">Profile Details</h4>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<div class="modal-body row" id="profile_details">
		
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
	</div>
	</div>
</div>
<!---Profile View Model Popup----->



<div class="row">

<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Volunteer List</h5>
</div><hr>
<form action="#" method="post">
<div class="row ml-3">
	
	<div class="col-md-6">
		<div class="card-header">
			<h5>Theme</h5>
		</div>
		<div class="card-body">
			<select class="form-control" name="cause">
				<option value="">Select Theme</option>
				<?php foreach ($causes as $key => $value) {?>
				<option <?php if($causesID==$value['causesID']){ echo "selected"; } ?> value="<?php echo $value['causesID']; ?>"><?php echo ucwords($value['causesName']); ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="col-md-2" style="padding-top:8px;">
		<br>
		<input type="submit" value="Search" class="btn btn-primary" name="submit">
	</div>
</div>
</form>
<hr>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="dom-table" class="table table-striped table-bordered pre-line">
<thead>
<tr>
<th>S.no</th>
<th>Volunteer ID</th>
<th>Name</th>
<th>Mobile</th>
<th>Email</th>
<th>Reg. Date</th>
<th>Location</th>
</tr>
</thead>
<tbody>
<?php 
	$count = 1;
	foreach ($volunteerDetails as $key => $value) {
		$location = '';
		if($value['correspontenceAddress']!='')
		{
			//$location.=$value['correspontenceAddress'].',';
		}
		if($value['cityName']!=''){
			$location.=$value['cityName'].',';
		}
		if($value['stateName']!='')
		{
			$location.=$value['stateName'];
		}
		//$location = $value['correspontenceAddress'].', '.$value['cityName'].', '.$value['stateName'];
		$encode_userID = rtrim(strtr(base64_encode($value['userID']), "+/", "-_"), "=");
?>
<tr <?php if($value['verify']==1){ echo 'class="td-white"';}?>>
	<td><?php echo $count++; ?></td>
	<td><?php echo $value['volunteerID']; ?></td>
	<td><?php echo ucwords($value['firstName'].' '.$value['lastName']); ?> <br><a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encode_userID; ?>','profile_details');"><small class="text-primary">(View Profile)</small></a></td>
	<td><?php echo $value['mobile']; ?></td>
	<td><?php echo $value['email']; ?></td>
	<td><?php echo date("d/m/Y", strtotime($value['usersCreationDate'])); ?></td>
	<td><?php echo $location; ?></td>
</tr>
<?php
	}
?>

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
<script>
	function fetch_details(id,display_id)
	{
		//alert(id);
		$('#'+display_id).html('<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>');
		var request = $.ajax({
        url: '<?php echo base_url("fetch-partner-user-info"); ?>',
        method: "POST",
        data: {userID : id},
        success: function(results)
            {
                //console.log(results);
				//alert(results);
				$('#'+display_id).html(results);
                
            }
        });
	}
</script>