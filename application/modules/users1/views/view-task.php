<div class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-4">
<div class="page-header-title">
<h5 class="m-b-10">Cause Task List</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item">View Task</li>
</ul>
</div>
<div class="col-md-8 text-right">
<ul class="nav nav-tabs customtab pro-customtab">
<li class="nav-item"> <a class="nav-link active" href="#"> <span>Details</span></a> </li>
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url().'task-members/'.$encode_taskID; ?>"><span>Volunteers</span></a></li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12">
<div class="tab-content">

<div class="p-0">
<div class="row">
<div class="col-lg-12 col-md-12">
<div class="card">
<div class="card-body">
<h5 class="card-title float-left align-self-center tasks statistics text-uppercase">Task details</h5>
<?php $encoded_id=rtrim(strtr(base64_encode($task['taskID']), '+/', '-_'), '='); ?>
<?php if($task['status']==0){	?>
<!--<a href="<?php echo base_url().'task-accept/'.$encoded_id;?>" onclick="return confirm('Are you sure, you want to Accept it?')" title="Accept"><button class="btn btn-primary pull-right ml-1">Accept</button></a>
<a href="<?php echo base_url().'task-reject/'.$encoded_id;?>"><button class="btn btn-primary pull-right">Reject</button></a>-->
<?php }else if($task['status']==1){ ?>
<!--<a href="<?php echo base_url().'task-reject/'.$encoded_id;?>"><button class="btn btn-primary pull-right">Reject</button></a>
<button class="btn btn-info pull-right">Accepted</button>-->
<?php } else if($task['status']==2){ ?>
<!--<a href="<?php echo base_url().'task-accept/'.$encoded_id;?>" onclick="return confirm('Are you sure, you want to Accept it?')" title="Accept"><button class="btn btn-primary pull-right ml-1">Accept</button></a>
<button class="btn btn-danger pull-right">Rejected</button>-->
<?php } ?>

<div class="clearfix"></div>
<div class="m-t-20 no-block">
<div class="row f-16">
<div class="col-lg-2 col-md-3 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Task</span> </div>
<div class="col-lg-10 col-md-9 col-sm-12">
<p><?php echo $task['taskTitle']; ?></p>
</div>
<div class="clearfix"></div>
<div class="col-lg-2 col-md-3 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Description</span> </div>
<div class="col-lg-10 col-md-9 col-sm-12">
<p> <?php echo $task['taskDescription']; ?></p>
</div>
<div class="col-lg-2 col-md-3 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Theam</span> </div>
<div class="col-lg-10 col-md-9 col-sm-12">
<?php $cause = $task['causesID'];
$where = "causesID='$cause'";
$rval = $this->Curl_model->fetch_single_data('causesName','causes',$where); ?>
<p> <?php echo $rval['causesName'] ?> </p>
</div>

<div class="col-lg-2 col-md-3 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Publish date</span> </div>
<div class="col-lg-10 col-md-9 col-sm-12">
<?php $publishdate= $task['taskPublishedDate'];?>
<p> <?php echo date("d-m-Y", strtotime($publishdate)); ?> </p>
</div>

<div class="col-lg-2 col-md-3 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Status</span> </div>
<div class="col-lg-10 col-md-9 col-sm-12">
<p><?php if($task['status']==1){echo "Accepted";}elseif ($task['status']==2) {echo "Rejected";}?> </p>
</div>

<div class="col-lg-2 col-md-3 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Volunteers</span> </div>
<div class="col-lg-10 col-md-9 col-sm-12">
<ul class="members-list">
<?php 
if(sizeof($valunteers)<5)
{
$size = sizeof($valunteers);
$remain = 0;
}
else{
    $size = 5;
    $remain = (sizeof($valunteers)-$size);
}
for($i=0;$i<$size;$i++)
{
if($valunteers[$i]['profile']=="")
{
?>
<li><img src="<?php echo base_url('user_profile/crop.jpg'); ?>" alt="user" class="img-radius" width="30" height="30"></li>
<?php }else{ ?>
<img src="<?php echo base_url('user_profile/').$userDetails[$i]['profile']; ?>" alt="user" class="img-radius" width="30" height="30">
<?php }} ?>
<li>
<?php if($remain>0){ ?>
<div class="circle-div">+<?php echo $remain; ?></div>
<?php } ?>
</li>
</ul>
</div>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12">
<div class="card">
<div class="card-body">
<h5 class="card-title float-left align-self-center text-uppercase f-w-700">Task Brief</h5>
<div class="clearfix"></div>
<div class="m-t-10 no-block">
<div class="col-lg-12 col-md-9 col-sm-12">
<p> <?php echo $task['taskBrief']; ?> </p>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<h5 class="card-title float-left  m-b-40  align-self-center text-uppercase f-w-700">Attachments</h5>
<div class="clearfix"></div>
<div class="table-responsive">
<table class="table color-table primary-table">
<thead>
<tr>
<th>S.no</th>
<th>Document Name </th>
<!--<th>Attached by</th>-->
<th>Date</th>
<th>Size</th>
<th class="icon-color"><i class="fa fa-download" aria-hidden="true"></i></th>
</tr>
</thead>
<tbody>
<?php 
if(sizeof($attachment)>0)
{
$i=1; foreach ($attachment as $key => $value) {
?>
<?php if ($value['attachmentSize'] >= 1048576)
        {
         $value['attachmentSize'] = number_format($value['attachmentSize'] / 1048576, 2) . ' MB';
        }
        elseif ($value['attachmentSize'] >= 1024)
        {
            $value['attachmentSize'] = number_format($value['attachmentSize'] / 1024, 2) . ' KB';
        }
        elseif ($value['attachmentSize'] > 1)
        {
            $value['attachmentSize'] = $value['attachmentSize'] . ' bytes';
        }
        elseif ($value['attachmentSize'] == 1)
        {
            $value['attachmentSize'] = $value['attachmentSize'] . ' byte';
        }
        else
        {
            $value['attachmentSize'] = '0 bytes';
        } ?>
<tr>
	<td><?php echo $i; ?></td>
    <td class="font-bold"><?php echo $value['attachmentName'];?></td>
    <!--<td><?php echo $value['firstName'].' '.$value['lastName'];?></td>-->
    <td><?php echo date("d-m-Y", strtotime($value['attachmentDate']));?></td>
    <td><?php echo $value['attachmentSize']; ?></td>
    <td class="icon-color op-1"><a href="<?php echo base_url(); ?>user_profile/task/<?php echo $value['attachmentName'];?>" download title="Download" data-toggle="tooltip" data-placement="bottom" ><i class="fa fa-download" aria-hidden="true"></i></a></td>
</tr>
<?php $i++; }}else { ?>
<tr>
<td colspan="5"><center style="color:red;">Not available</center></td>
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

</div>
