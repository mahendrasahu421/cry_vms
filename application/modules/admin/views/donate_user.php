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
<h5 class="m-b-10">Donation User List</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item">Donation User</li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">
<h5>Donation User List</h5>
</div>
<hr>

<div class="clearfix"></div>
<div class="card-body">
<div class="dt-responsive table-responsive">
<table id="dom-table" class="table table-striped table-bordered pre-line">
<thead>
<tr>
<th></th>
<th>Name</th>
<th>Mobile</th>
<th>E-mail</th>
<th>Donation</th>
<th>Amount</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($report as $key => $value){ ?>

<tr>
<td><?php echo $i; ?></td>
<td><?php echo $value['first_name']; ?></td>
<td><?php echo $value['mobile']; ?></td>
<td><?php echo $value['email']; ?></td>
<td><?php echo $value['my_donation']; ?></td>
<td><?php echo $value['amount']; ?></td>
<td><?php echo $value['status']; ?></td>
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
