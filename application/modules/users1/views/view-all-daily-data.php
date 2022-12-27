<div class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-4">
<div class="page-header-title">
<h5 class="m-b-10">Daily Report Data</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item">View Data</li>
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
<h5 class="card-title float-left align-self-center tasks statistics text-uppercase">Daily Report details</h5>

<div class="clearfix"></div>
<div class="m-t-20 no-block">
<div class="row f-16">

<div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Time In</span> </div>
<div class="col-lg-8 col-md-9 col-sm-12">
<?php $time1= $report['dailyReportTimeIn'];?>
<p> <?php echo date("H:i a", strtotime($time1)); ?></p>
</div>

<div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Time Out</span> </div>
<div class="col-lg-8 col-md-9 col-sm-12">
<?php $time= $report['dailyReportTimeOut'];?>
<p> <?php echo date("H:i a", strtotime($time)); ?></p>
</div>

<div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Task Activity</span> </div>
<div class="col-lg-8 col-md-9 col-sm-12">
<p> <?php echo $report['dailyReportActivity']; ?></p>
</div>

<div class="clearfix"></div>
<div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">How Could it be Improved </span> </div>
<div class="col-lg-8 col-md-9 col-sm-12">
<p> <?php echo $report['improved_msg']; ?></p>
</div>

<div class="clearfix"></div>
<div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Challenges Faced</span> </div>
<div class="col-lg-8 col-md-9 col-sm-12">
<p> <?php echo $report['challeges_face']; ?></p>
</div>

<div class="clearfix"></div>
<div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Experience Sharing</span> </div>
<div class="col-lg-8 col-md-9 col-sm-12">
<p> <?php echo $report['experrience_any']; ?></p>
</div>

<div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Report date</span> </div>
<div class="col-lg-8 col-md-9 col-sm-12">
<?php $publishdate= $report['dailyReportDate'];?>
<p> <?php echo date("d-m-Y", strtotime($publishdate)); ?> </p>
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
<h5 class="card-title float-left  m-b-40  align-self-center text-uppercase f-w-700">Attachments</h5>
<div class="clearfix"></div>
<div class="table-responsive">
<table class="table color-table primary-table">
<thead>
<tr>
<th>S.no</th>
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
    <td><?php echo $value['firstName'].' '.$value['lastName'];?></td>
    <td><?php echo date("d-m-Y", strtotime($value['attachmentDate']));?></td>
    <td><?php echo $value['attachmentSize']; ?></td>
    <td class="icon-color op-5"><i class="fa fa-download" aria-hidden="true"></i></td>
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

