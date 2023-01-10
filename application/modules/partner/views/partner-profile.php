<div class="pcoded-main-container">
<div class="pcoded-content">
<style>
#profileImage {
    background: #f9f9f9;
    border: 5px solid #88c;
    padding: 15px;
    border-radius: 5px;
    margin: 10px;
    cursor: pointer;
}
.fa-camera{color:#fff;}
.icon-add{background: #8f281f;
    padding: 6px;
    border-radius: 50%;
    width: 30px;
	margin-top: -18px;
    margin-right: -27px;}
</style>
<div class="row">
<div class="col-lg-12 col-md-12" id="profile">
<div class="card">
<div class="card-body card2 pt-3">
<div class="row">
<div class="col-lg-6 col-md-9 f-18 font-weight-bold text-uppercase">Profile</div>
</div>
</div>
<div class="card-body">
<div class="row">

<div class="col-md-4 m-b-20 text-center">
<form id="profileImageForm" name="profileImageForm">
<span id="result"></span>
 <?php 
if($partner_profile[0]['profile_img']!=''){
	?>
<img src='<?php $image = $partner_profile[0]['profile_img']; echo base_url("partner_profile/$image"); ?>' width="100%" class="img-fluid border p-1" id="profileImage" style="height:100%">
<?php 
  }
else{?>
 <img src="<?php echo base_url('partner_profile/');?>crop.jpg" class="img-fluid border p-1" style="height:100%" width="100%" id="profileImage" > 
   <?php
}
?> 
<input type="file" name="profile" id="my_file" style="display:none"/>
<div class="icon-add pull-right"><i class="fa fa-camera"></i></div>

</form>
</div>


<script>
document.getElementById('profileImage').onclick = function() {
    document.getElementById('my_file').click();
};
</script>


<div class="col-md-8">
<h2 class="f-24 font-medium"><?php echo ucwords($partner_profile[0]['name']);?> </h2>
<p class="m-b-20">Online</p>
<div class="row mb-2">
	<div class="col-2 font-weight-bold text-dark">User ID</div>
	<div class="col"><?php echo ucwords($partner_profile[0]['user_id']); ?></div>
</div>
<div class="row mb-2">
	<div class="col-2 font-weight-bold text-dark">Phone</div>
	<div class="col"><?php echo ucwords($partner_profile[0]['mobile']); ?></div>
</div>
<div class="row mb-2">
	<div class="col-2 font-weight-bold text-dark">Email</div>
	<div class="col"><a href="#" class="text-inverse"><span class="__cf_email__" data-cfemail="<?php echo $partner_profile[0]['email']; ?>"><?php echo $partner_profile[0]['email']; ?></span></a></div>
</div>

<div class="row mb-2">
	<div class="col-2 font-weight-bold text-dark">Reg. Date</div>
	<div class="col"><?php echo date("d/m/Y", strtotime($partner_profile[0]['creation_date'])); ?></div>
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
