<script>
	var count_img = 1;
	var count_file = 1;
</script>
<style>
table td{white-space:initial !important;}
.tk{margin-bottom:0px !important;} 
.card .card-block, .card .card-body {padding: 1px 25px !important;}
.col-sm-2{top: 7px;}
.col-sm-7{padding-right: 5px;}
.tt{padding-right:3px !important;}
/*.calendar-table{Display:none !important;}*/
.error
{
	width:100%;
	text-align:left;
	color:red;
}
#list1{
	list-style: none;
}
</style>
<section class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10">Add Daily Report</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Report</a></li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">

<div class="col-sm-12">

<?php
if($this->session->userdata('data_message'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> Daily Report Has Been Inserted.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php $this->session->unset_userdata('data_message'); } ?>


<div class="card">
<div class="card-header">
<h5>Add Daily Report</h5>
</div><hr>
<div class="card-body">
<div class="row">
<div class="col-md-6">
<form autocomplete="off" method="post" action="#" enctype="multipart/form-data" >
<div class="form-group row">
<label for="inputEmail3" class="col-sm-4 col-form-label">Choose Task</label>
<div class="col-sm-8">
	<select class="form-control" id="exampleFormControlSelect1" name="tasktitle" required >
		<option value="">Select Task</option>
		<?php foreach($task as $tsk){?>
		<option value="<?php echo $tsk['taskID']?>" ><?php echo $tsk['taskTitle']?></option>
		<?php } ?>
	</select>
	<?php echo form_error('tasktitle', '<div class="error">', '</div>'); ?>
</div>
</div>
<div class="form-group row">
<label for="inputEmail3" class="col-sm-4 col-form-label">Date</label>
<div class="col-sm-8">
<input type="text"  name="birthday1" value=""id="dob_caf" class="form-control" required placeholder="Select Date" />
<?php echo form_error('birthday1', '<div class="error">', '</div>'); ?>
</div>
</div>


	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-4 col-form-label">How Could it be Improved? <small>(300 Characters Allowed)</small></label>
		<div class="col-sm-8">
		<textarea class="form-control " rows="3" placeholder="How Could it be Improved?" name="improved_msg" maxlength="300" ></textarea>
		<?php echo form_error('improved_msg', '<div class="error">', '</div>'); ?>
		</div>
	</div>

<div class="form-group row">
<label for="inputEmail3" class="col-sm-4 col-form-label tt">Activity <small>(Guidline Below)<br/>
1-No of people reached out <br>2-Testimonies from participants<br> 3-Type of participants (age, profession..etc)<br>4-Other detailed information</small></label>
<div class="col-sm-8">
<textarea class="form-control" rows="8" placeholder="Activity" name="dailyActivity" maxlength="300" required ></textarea>
<?php echo form_error('dailyActivity', '<div class="error">', '</div>'); ?>
</div>
</div>

	

</div>
<div class="col-md-6">
		
		<div class="form-group row">
		<label for="inputEmail3" class="col-sm-3 col-form-label">Time In</label>
		<div class="col-sm-9">
		<input type="time" class="form-control" name="dailyReportTimeIn" id="dailyReportTimeIn" onkeyup="check_time('dailyReportTimeIn','plz');" value="00:00" required />
		<?php echo form_error('dailyReportTimeIn', '<div class="error">', '</div>'); ?>
		</div>
		</div>
		
		<div class="form-group row">
		<label for="inputEmail3" class="col-sm-3 col-form-label">Time out</label>
		<div class="col-sm-9">
		<input type="time" class="form-control" name="dailyReportTimeOut" id="dailyReportTimeOut" onkeyup="check_time('dailyReportTimeOut','plz');" required /><!--datetimes-->
		<?php echo form_error('dailyReportTimeOut', '<div class="error">', '</div>'); ?>
		</div>
		</div>

	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-3 col-form-label">Challenges Faced <small>(300 Characters Allowed)</small></label>
		<div class="col-sm-9">
		<textarea class="form-control" rows="3" placeholder="Challenges Faced" name="challeges_face"maxlength="300" /></textarea>
		</div>
	</div>
	
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-3 col-form-label">Experience Sharing For Task?<small>(300 Characters Allowed)</small></label>
		<div class="col-sm-9">
		<textarea class="form-control"  rows="4" placeholder="Experience Sharing For Task?" name="experrience_any" maxlength="300"/></textarea>
		</div>
	</div>

	<div class="form-group">		
		
	<?php foreach ($attachment_type as $key => $value) { ?>
		<div class="form-group row">
			<label for="inputEmail3" class="col-sm-3 col-form-label">Add <?php echo $value['attachmentTypeName']; ?></label>
			<div class="col-sm-7">
				<input type="file" class="form-control" onchange="check_size(this,this.value,'idid');" name="<?php echo $value['attachmentTypeName']; ?>[]" id="#img<?php echo $value['attachmentTypeID'];?>" accept="<?php echo $value['attachmentFileType']; ?>" />
			</div>
			<div class="col-sm-2">
				<button type="button" class="btn btn-primary" onclick="addMore('#list<?php echo $value['attachmentTypeID']; ?>','default<?php echo $value['attachmentTypeID']; ?>','#count<?php echo $value['attachmentTypeID']; ?>');"><i class="fa fa-plus"></i></button>
			</div>
		</div>
		<input type="number" id="count<?php echo $value['attachmentTypeID']; ?>" value="1" style="display: none;">
		<input type="number" id="attachmentTypeID<?php echo $value['attachmentTypeID']; ?>" name="attachmentTypeID[]" value="<?php echo $value['attachmentTypeID']; ?>" style="display: none;">
		<ul id="list<?php echo $value['attachmentTypeID']; ?>">
			<li class="default<?php echo $value['attachmentTypeID']; ?>" style="display: none;">
			<input type="file" class="img-add" name="<?php echo $value['attachmentTypeName']; ?>[]" accept="<?php echo $value['attachmentFileType']; ?>" /><span class="add-file" onclick="closeMe(this,'#count<?php echo $value['attachmentTypeID']; ?>');"><i class="fa fa-trash"></i></span>
			
			<!--<span class="add-file" onclick="addMore('#list<?php //echo $value['attachmentTypeID']; ?>','default<?php //echo $value['attachmentTypeID']; ?>','#count<?php //echo $value['attachmentTypeID']; ?>');"><i class="fa fa-plus"></i></span>-->
			</li>
			
		</ul>
		<?php
		}
		?>

		<script>
			
			function closeMe(element,variabls){

				var count_file = $(variabls).val();
				 $(element).parent().remove();
				 count_file--;
				 $(variabls).val(count_file);
				
			}
			function addMore(id,class1,variabls){
				//alert(class1);
				var count_file = $(variabls).val();
				if(count_file<5)
				{
				  var container = $(id);
				  var item = container.find('.'+class1).clone();
				  item.removeClass(class1);
				  //item.attr('name','file[]');
				  item.appendTo(container).show();
				  count_file++;
				  $(variabls).val(count_file);
				}
				
			}
			function check_size(id,value,display_id)
			{
				var value = $(id).val();
				if(value!='')
				{
					var _size = id.files[0].size;
					var final_size = (_size/1024)/1024;
					if(final_size<=1)
					{
						//alert(final_size);
					}
					else{
						$(id).val('');
						alert('Please select file less then or equal to 1 MB.');
					}
				}
			}
			function check_time(id,msg)
			{
				var intime = $('#dailyReportTimeIn').val();
				var outtime = $('#dailyReportTimeOut').val();
				if(outtime!='')
				{
					if(intime<outtime)
					{
						$('#'+id).css('border','');
					}
					else{
						var initialDate = intime;
						var theAdd = new Date(1900,0,1,initialDate.split(":")[0],initialDate.split(":")[1]);
						theAdd.setMinutes(theAdd.getMinutes() + 01);
						var h = theAdd.getHours();
						var m = theAdd.getMinutes();
						if(h<10)
						{
							h = '0'+theAdd.getHours();
						}
						if(m<10)
						{
							m = '0'+theAdd.getMinutes();
						}
						theAdd = h+":"+m;
						console.log(theAdd);
						//alert(theAdd);
						$('#dailyReportTimeOut').val(theAdd);
						//$('#'+id).css('border','2px solid red');
					}
				}
				else{

					var initialDate = intime;
					var theAdd = new Date(1900,0,1,initialDate.split(":")[0],initialDate.split(":")[1]);
					theAdd.setMinutes(theAdd.getMinutes() + 01);
					var h = theAdd.getHours();
					var m = theAdd.getMinutes();
					if(h<10)
					{
						h = '0'+theAdd.getHours();
					}
					if(m<10)
					{
						m = '0'+theAdd.getMinutes();
					}
					theAdd = h+":"+m;
					console.log(theAdd);
					//alert(theAdd);
					$('#dailyReportTimeOut').val(theAdd);
				}
				//console.log(oldouttime);
				
			}
		</script>
		
		<video id="video" width="250" height="280" autoplay></video>
		<button id="snap" class="btn btn-primary">Take Photo</button>
		<!--<canvas id="canvas" width="250" height="280"></canvas>-->
		
	</div>
<button type="submit" class="btn btn-primary pull-right mb-5" name="submit" value="submit">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>




</div>

<div class="row">

<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Today Report List</h5>
</div><hr>
<form action="<?php echo base_url()?>add-report-task-lists" method="post" id="filtercheck">
<div class="row ml-3">
<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="form-group row tk">
			<label for="inputEmail3" class="col-sm-4 col-form-label ">Choose Task</label>
			<div class="col-sm-8">
				<select class="form-control" id="task" name="task">
					<?php foreach($task as $key => $value){
						$allasid = $value['taskID'];
						$tv=$task_value;
						if($allasid==$letest_taskID){
							$tk = 'selected';
						}else{
							$tk = '';
						}
					?>
					<option value="<?php echo $value['taskID']?>" <?php echo $tk; ?>><?php echo $value['taskTitle']?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	
		
	</div>
<div class="col-md-1"></div>
</div>
</form>
<hr>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="dom-table" class="table table-striped table-bordered pre-line">
	<thead>
		<tr>
			<th>Sr.no</th>
			<th>Time In</th>
			<th>Time Out</th>
			<th>Task Activity</th>
			<th>Total Time</th>
			<th>Attachment</th>
		</tr>
	
	</thead>
<tbody>
<?php $i=1; foreach($report as $key => $value){
	$timeIn= $value['dailyReportTimeIn'];
	$time = date('h:i A', strtotime($timeIn));
	$timeOut= $value['dailyReportTimeOut'];
	$time1 = date('h:i A', strtotime($timeOut));
	
	$diff = abs(strtotime($time) - strtotime($time1));
	$tmins = $diff/60;
	$hours = floor($tmins/60);
	$mins = $tmins%60;
	?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $time ;?></td>
<td><?php echo $time1 ;?></td>
<td><?php echo $value['dailyReportActivity'];?></td>
<td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?> Hours</td>
<td><?php 
if(sizeof($attachment)>0)
{
foreach ($attachment as $key => $value) {
?>
	<ul>
		<a href="#"><li><?php echo $value['attachmentName']; ?></li></a>
	</ul>
	<?php }}else { ?>
	<p>Not available</p>
	<?php } ?>
</td>

</tr>
<?php $i++; } ?>

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
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        //video.src = window.URL.createObjectURL(stream);
        video.srcObject = stream;
        video.play();
    });
}

// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
//var context = canvas.getContext('2d');
var video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
	context.drawImage(video, 0, 0, 250, 280);
});
</script>