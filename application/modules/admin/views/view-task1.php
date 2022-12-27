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
<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">View Task</a></li>
</ul>
</div>
<div class="col-md-8 text-right">
<ul class="nav nav-tabs customtab pro-customtab">
<li class="nav-item"> <a class="nav-link active" href="#"> <span>Details</span></a> </li>
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url().'task-member/'.$encode_taskID; ?>"><span>Volunteers</span></a> </li>
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
<div class="clearfix"></div>
<div class="m-t-20 no-block">
<div class="row f-16">
<div class="col-lg-2 col-md-3 col-sm-12"> <span class="weight-500 text-dark">Task</span> </div>
<div class="col-lg-10 col-md-9 col-sm-12">
<p><?php echo $task[0]['taskTitle'];?></p>
</div>
<div class="clearfix"></div>
<div class="col-lg-2 col-md-3 col-sm-12"> <span class="weight-500 text-dark">Description</span> </div>
<div class="col-lg-10 col-md-9 col-sm-12">
<p> <?php echo $task[0]['taskDescription'];?></p>
</div>
</div>
<div class="d-flex f-16">
<div class="col-lg-6 p-0 row col-md-12">
<div class="col-lg-4 col-md-3 col-sm-12"> <span class="weight-500 text-dark">Cause</span> </div>
<div class="col-lg-8 col-md-4 col-sm-12 p-l-20 ">
<p> <?php echo $task[0]['causesName'];?> </p>
</div>
<div class="clearfix"></div>
<div class="col-lg-4 col-md-3 col-sm-12"> <span class="weight-500 text-dark">Publish date</span> </div>
<div class="col-lg-8 col-md-4 col-sm-12 p-l-20 ">
<p> <?php echo $task[0]['taskPublishedDate'];?> </p>
</div>
<div class="clearfix"></div>
<div class="col-lg-4 col-md-3 col-sm-12"> <span class="weight-500 text-dark">Status</span> </div>
<div class="col-lg-8 col-md-4 col-sm-12 p-l-20 ">
<p> <?php if($task[0]['taskStatus']==0){echo "Open";}elseif ($task[0]['taskStatus']==1) {
    echo "Close";
}?> </p>
</div>

<div class="clearfix"></div>
</div>
<div class="col-lg-6 row block col-md-12 members-projects">
<div class="col-lg-12 col-md-12 col-sm-12 p-0 m-b-15"> <span class="weight-500 text-dark">Volunteers</span> </div>
<div class="col-lg-12 col-md-12 col-sm-12 p-0">
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
?>
<li><img src="<?php echo base_url('user_profile/crop.jpg'); ?>" alt="user" class="img-radius" width="30" height="30"></li>
<?php } ?>
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
</div>
<div class="row">
<div class="col-lg-12 col-md-12">
<div class="card">
<div class="card-body">
<h5 class="card-title float-left align-self-center text-uppercase">Task Brief</h5>
<div class="clearfix"></div>
<div class="m-t-10 no-block">
<div class="col-lg-12 col-md-9 col-sm-12">
<p> <?php echo $task[0]['taskBrief'];?> </p>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<h5 class="card-title float-left  m-b-40  align-self-center text-uppercase">Attachments</h5>
<div class="clearfix"></div>
<div class="table-responsive">
<table class="table color-table primary-table">
<thead>
<tr>
<th>Document Name </th>
<th>Attached by</th>
<th>Date</th>
<th>Size</th>
<th class="icon-color"><i class="fa fa-download" aria-hidden="true"></i></th>
</tr>
</thead>
<tbody>
<?php 
if(sizeof($attachment)>0)
{
    $count=1;
foreach ($attachment as $key => $value) {
    //print_r($value);
?>
<tr>
    <td class="font-bold"><?php echo $count++.'. '.$value['attachmentName'];?></td>
    <td><?php echo $value['firstName'].' '.$value['lastName'];?></td>
    <td><?php echo date("d-m-Y h:i:s a", strtotime($value['attachmentCreationDate']));?></td>
    <td><?php echo $value['attachmentSize']; ?></td>
    <td class="icon-color op-5"><i class="fa fa-download" aria-hidden="true"></i></td>
</tr>
<?php }}else { ?>
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