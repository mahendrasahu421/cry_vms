<div class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-4">
<div class="page-header-title">
<h5 class="m-b-10">Volunteers List</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">View Volunteers List</a></li>
</ul>
 </div>
<div class="col-md-8 text-right">
<ul class="nav nav-tabs customtab pro-customtab">
<li class="nav-item"> <a class="nav-link" href="<?php echo base_url().'view-task-details/'.$encode_taskID; ?>"> <span>Details</span></a> </li>
<li class="nav-item"> <a class="nav-link active" href="#"><span>Volunteers</span></a> </li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12">
<div class="tab-content">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-sm-3 col-md-3 col-lg-3">
<h5 class="card-title float-left align-self-center text-uppercase">Volunteers</h5>
</div>
<div class="col-sm-9 col-md-9 col-lg-9 mb-4">
<div class="float-right d-none d-xl-inline-block d-lg-inline-block">
<div class="search"> <span class="fa fa-search"></span>
<input placeholder="Search..">
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="table-responsive">
<table class="table color-table primary-table">
<thead>
<tr>
<th>Volunteers</th>
<th>Volunteer Name</th>
<th>Email address</th>
<th>Phone</th>
</tr>
</thead>
<tbody>
<?php foreach ($valunteers as $key => $value) { ?>
<tr>
    <td style="white-space:inherit;">
    <?php
    if($value['profile']=="")
    {
    ?>
    <img src="<?php echo base_url('user_profile/crop.jpg');?>" alt="user" class="img-radius" style="height:30px;">
    <?php }else{ ?>
    <img src="<?php echo base_url('user_profile/').$value['profile']; ?>" alt="user" class="img-radius" style="height:30px;">
    <?php } ?>
    </td>
    <td class="font-bold"> <?php echo $value['firstName'].' '.$value['lastName'];?> </td>
    <td><a href="#" class="__cf_email__"><?php echo $value['email'];?></a></td>
    <td><?php echo $value['mobile'];?></td>
</tr>
<?php } ?>

</tbody>
</table>

</div>
<div class="row">
<div class="col-md-6 page-n">Show: <a href="#" class="active">10</a> <a href="#">20</a> <a href="#">50</a></div>
<div class="col-md-6 text-right page-n">Prev <a href="#" class="active">1</a> <a href="#">2</a> <a href="#">3</a> ... <a href="#">10</a> <a href="#">11</a> <a href="#">12</a> <a href="#">Next</a></div>
</div>
</div>
</div>

</div>
</div>
</div>

</div>
</div>

</div>