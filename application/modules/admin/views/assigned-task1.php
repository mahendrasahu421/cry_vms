<style>
table td{white-space:initial !important;}
.tk{margin-bottom:0px !important;} 
.card .card-block, .card .card-body {
    padding: 1px 25px !important;
}
.ck{height:180px;}
input.largerCheckbox { 
            width: 21px; 
            height:21px; 
        } 
</style>
<section class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10">Assign Task</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Assign Task</a></li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">

<div class="col-sm-12">
<?php 
if($this->session->userdata('valunteers_size')>0)
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> You have assigned task to <?php echo $this->session->userdata('valunteers_size'); ?> valunteers.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('valunteers_size'); } ?>
<div class="card">
<div class="card-header">
<h5>Assign Task</h5>
</div><hr>

<div class="modal fade project-details" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-header">
		<h4 class="modal-title text-uppercase font-weight-bold">Project Details</h4>
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
			<div class="col-md-9">
				4 Days
			</div>
		</div>
	<div class="row form-group m-b-20">
		<div class="col-md-3">
			<h4 class="f-16  m-0 p-0 font-weight-bold">Start Working Date</h4>
		</div>
		<div class="col-md-9">
				15/01/2020
		</div>
	</div>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-rounded  btn-secondary" data-dismiss="modal" aria-hidden="true">Cancel</button>
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
<form method="post">
<div class="card-body">
<div class="row">

<div class="col-md-6">

	<div class="form-group row">
		<label for="taskID" class="col-sm-4 col-form-label">Choose Task</label>
		<div class="col-sm-8">
			<select class="form-control" id="taskID" required name="taskID" onchange="fetch_details('tbl_div');">
				<option value="">Select Task</option>
				<?php
					foreach ($task as $key => $value) {
						?>
						<option value="<?php echo $value['taskID']; ?>"><?php echo ucwords($value['taskTitle']); ?></option>
						<?php
					}
					?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-4 col-form-label">Assigned Date</label>
		<div class="col-sm-8">
			<input type="text" name="birthday" required value="" class="form-control" />
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group row">
		<label for="state" class="col-sm-4 col-form-label">Task State</label>
		<div class="col-sm-8">
			<select class="form-control" disabled id="state" name="state" required onchange="fetch_details('tbl_div');" >
				<option value="">Select State</option>
				<?php 
				foreach ($state as $key => $value) {
				?>
				<option value="<?php echo $value['stateID']; ?>"><?php echo $value['stateName']; ?> </option>
				<?php } ?>
			</select>
			<select class="form-control" disabled id="state1" name="state1" style="display:none;">
				<option value="">Select State</option>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="cities" class="col-sm-4 col-form-label">Task City</label>
		<div class="col-sm-8">
			<select class="form-control" id="cities" disabled name="cities" required onchange="fetch_details('tbl_div');">
				<option>Select City</option>
			</select>
		</div>
	</div>
	
	
</div>
<div class="col-md-12">
	<div id="tbl_div">
    <!-- <div id="tb1">
        <table class="table table-striped table-bordered pre-line">
		<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>Address</th>
			<th>Status</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><input type="checkbox" class="largerCheckbox" name="c[]" /></td>
			<td>Mr. XYZ<br><a href="#" data-toggle="modal" data-target=".profile-details"><small class="text-primary">(View Profile)</small></a></td>
			<td>9856412365</td>
			<td>dummy@gmail.com</td>
			<td>Kanpur</td>
			<td><span class="badge badge-success">Assigned</span><br>
			<small data-toggle="modal" data-target=".project-details" class="text-primary">View Task</small></td>
		</tr>
		<tr>
			<td><input type="checkbox" class="largerCheckbox" name="c[]" /></td>
			<td>Mr. XYZ<br><a href="#" data-toggle="modal" data-target=".profile-details"><small class="text-primary">(View Profile)</small></a></td>
			<td>9856412365</td>
			<td>dummy@gmail.com</td>
			<td>Kanpur</td>
			<td><span class="badge badge-danger">Not Assigned</span></td>
		</tr>
		<tr>
			<td><input type="checkbox" class="largerCheckbox" name="c[]" /></td>
			<td>Mr. XYZ<br><a href="#" data-toggle="modal" data-target=".profile-details"><small class="text-primary">(View Profile)</small></a></td>
			<td>9856412365</td>
			<td>dummy@gmail.com</td>
			<td>Kanpur</td>
			<td><span class="badge badge-success">Assigned</span><br>
			<small data-toggle="modal" data-target=".project-details" class="text-primary">View Task</small></td>
		</tr>
		<tr>
			<td><input type="checkbox" class="largerCheckbox" name="c[]" /></td>
			<td>Mr. XYZ<br><a href="#" data-toggle="modal" data-target=".profile-details"><small class="text-primary">(View Profile)</small></a></td>
			<td>9856412365</td>
			<td>dummy@gmail.com</td>
			<td>Kanpur</td>
			<td><span class="badge badge-success">Assigned</span><br>
			<small data-toggle="modal" data-target=".project-details" class="text-primary">View Task</small></td>
		</tr>
		</tbody>
		</table>
    </div>
    <div id="tb2">
        <table class="table table-striped table-bordered pre-line">
		<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>Address</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><input type="checkbox" class="largerCheckbox" name="c[]" /></td>
			<td>Mr. XYZ<br><a href="#" data-toggle="modal" data-target=".profile-details"><small class="text-primary">(View Profile)</small></a></td>
			<td>9856412365</td>
			<td>dummy@gmail.com</td>
			<td>Delhi</td>
			<td><span class="badge badge-success">Assigned</span><br>
			<small data-toggle="modal" data-target=".project-details" class="text-primary">View Task</small></td>
		</tr>
		<tr>
			<td><input type="checkbox" class="largerCheckbox" name="c[]" /></td>
			<td>Mr. XYZ<br><a href="#" data-toggle="modal" data-target=".profile-details"><small class="text-primary">(View Profile)</small></a></td>
			<td>9856412365</td>
			<td>dummy@gmail.com</td>
			<td>Delhi</td>
			<td><span class="badge badge-success">Assigned</span><br><small data-toggle="modal" data-target=".project-details" class="text-primary">View Task</small></td>
		</tr>
		</tbody>
		</table>
    </div> -->
</div>

	
<button type="submit" class="btn btn-primary pull-right mb-5">Submit</button>

</div>


</div>

</div>
</form>
</div>
</div>
</div>

</div>
</section>

</div>
<script>
	function fetch_state_city(stateID,display_id,state_city)
	{
		//alert(state_city);
		if(state_city=='state')
		{
			var url= '<?php echo base_url("all-state"); ?>';
		}
		else{
			var url = '<?php echo base_url("all-valunteers"); ?>';
		}
		var request = $.ajax({
        url: url,
        method: "POST",
        data: {stateId : stateID,state_city : state_city},
        success: function(results)
            {
                console.log(results);
				//alert(results);
				$('#'+display_id).html(results);
                
            }
        });
	}
</script>
<script>
	function chech_v(id,display_id)
	{
		//alert(id);
		$('#'+display_id).html('<div class="text-center" style="color:red;margin:10 auto;"><i class="fa fa-spinner fa-pulse fa-4x"></i><p>Fetching Data</p></div>');
		var request = $.ajax({
        url: '<?php echo base_url("all-valunteers"); ?>',
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
<script>
var globle_state = "";
var globle_city = "";
	function fetch_details(display_id)
	{
		var task = $('#taskID').val();
		var state = $('#state').val();
		var city = $('#cities').val();
		if(task!='')
		{
			$('#state').removeAttr('disabled');
			if(state!='')
			{
				$('#cities').removeAttr('disabled');
				
				
				if(city!='')
				{
					
					var request = $.ajax({
						url: '<?php echo base_url("all-valunteers"); ?>',
						method: "POST",
						data: {stateId : state,cityID:city},
						success: function(results)
							{
								//console.log(results);
								//alert(results);
								$('#'+display_id).html(results);
								
							}
						});
				}
				else{
					$('#'+display_id).html('');
					var request = $.ajax({
					url: '<?php echo base_url("all-state"); ?>',
					method: "POST",
					data: {stateId : state,state_city:city},
					success: function(results)
						{
							console.log(results);
							//alert(results);
							$('#cities').html(results);
							
						}
					});
				}
				

			}
			else{
				$('#cities').attr('disabled','');
				$('#cities').html('<option value="">Select City</option>');
				$('#'+display_id).html('');
				// var request = $.ajax({
				// 	url: '<?php //echo base_url("all-state"); ?>',
				// 	method: "POST",
				// 	data: {stateId : state,state_city:city},
				// 	success: function(results)
				// 		{
				// 			console.log(results);
				// 			//alert(results);
				// 			$('#cities').html(results);
							
				// 		}
				// 	});
			}
		}
		else{
			$('#state').attr('disabled','');
			$('#cities').attr('disabled','');
			$('#'+display_id).html('');
		}
	}
	</script>