<style>
table td{white-space:initial !important;}
.tk{margin-bottom:0px !important;} 
.card .card-block, .card .card-body {padding: 1px 25px !important;}
.ck{height:180px;}
.col-sm-2{top: 7px;}
.col-sm-7{padding-right: 5px;}
.col-form-label{padding-right:5px;}
</style>
<section class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-12">
<div class="page-header-title">
<h5 class="m-b-10">Add Partners</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="admin-dashboard"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Partners</a></li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Add Partners</h5>
</div><hr>
<form action="#" method="post" id="form" name="pForm" enctype="multipart/form-data">
<div class="card-body">
<div class="row">
<div class="col-md-6">
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-4 col-form-label">Choose Region *</label>
		<div class="col-sm-8">
		<select name="region" id="region" class="form-control">
			<option value="0"> Choose Region</option>
			<?php foreach($region as $key => $value){?>
			<option value="<?php echo $value['region_id']; ?>"><?php echo $value['region_name']; ?></option>
			<?php } ?>
		</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-4 col-form-label">Title *</label>
		<div class="col-sm-8">
		 <input type="text" class="form-control" id="name" required name="name" />
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-4 col-form-label">Email *</label>
		<div class="col-sm-8">
		 <input type="email" class="form-control" id="email" required name="email" />
		</div>
	</div>

	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-4 col-form-label">Mobile No *</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="mobile" required name="mobile" />
		
		</div>
	</div>
	
</div>
<div class="col-md-6">
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-3 col-form-label">User ID *</label>
		<div class="col-sm-9">
		 <input type="email" class="form-control" id="user_id" required name="user_id" />
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-3 col-form-label">Password</label>
		<div class="col-sm-9">
			<input type="text" name="password" id="password" class="form-control" />
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-3 col-form-label">Status</label>
		<div class="col-sm-9">
			<select name="status" id="status" class="form-control" required >
				<option value="null">Select Status</option>
				<option value="1">Active</option>
				<option value="0">Deactive</option>
			</select>
		</div>
	</div>
</div>

<div class="col-md-12">
	<button type="submit" class="btn btn-primary pull-right mb-5" name="submit" value="submit">Submit</button>
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
