<style>
table td{white-space:initial !important;}
.col-md-4 .card-header {
padding: 6px 25px !important;}
.card .card-block, .card .card-body {
    padding: 1px 25px !important;
}
.btn-group, .btn-group-vertical {
	position: absolute !important;
}
</style>
<section class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10">Reward Point Report</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item">Reward Report</li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">

<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Reward Point Report</h5>
</div><hr>
<div class="card-body">
<div class="dt-responsive table-responsive">
<?php //print_r($reward_user_count); ?>
<table id="basic-btn" class="table table-striped table-bordered nowrap">
<thead>
<tr>
<th>S.no</th>
<th>Completion Date</th>
<th>Cerificate</th>
<th>Downloaded Date</th>
</tr>
</thead>
<tbody>
<?php
$c=1;
foreach ($reward_user_count as $key => $value) {
?>
<tr>
    <td><?php echo $c++; ?></td>
    <?php 
    foreach ($value as $key1 => $value1) {
    ?>
    <td><?php echo date('d-m-Y',strtotime($key1)); ?></td>
    <?php } ?>
    <td><?php echo $key; ?></td>
    <td><a href="#" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Download"><i class="fa fa-download"></i></a></td>
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

</div>
</section>

</div>