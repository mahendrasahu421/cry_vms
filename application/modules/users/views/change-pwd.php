<style>
.hidden {
    display: none;
}
</style>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Dashboard Analytics</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard'; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard Analytics</li>
                    </ol>
                </div>
            </div>


<div class="row">

<div class="col-md-2"></div>
<div class="col-md-8">
<?php
if($this->session->userdata('success'))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> <?php echo $this->session->userdata('success'); ?>
</div>
<?php $this->session->unset_userdata('success'); } ?>
<?php
if($this->session->userdata('error'))
{
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Successfull!</strong> <?php echo $this->session->userdata('error'); ?>
</div>
<?php $this->session->unset_userdata('error'); } ?>
<div class="card">
<div class="card-body">
<div class="text-center">
<h4 class="mb-4 f-w-400">Reset your password</h4>
<style>
	.error
	{
		width:100%;
		text-align:left;
		color:red;
	}
</style>
<span id="succ_msg"></span>
<?php
if($this->session->flashdata('data_message')){
  echo $this->session->flashdata('data_message');
}
?>
</div>
 <form role="form" method="post" >
<div class="input-group mb-2">
<input type="password" class="form-control" placeholder="Current Password" id="oldpassword"  name='oldpassword' value="<?php echo set_value('oldpassword'); ?>">
<?php echo form_error('oldpassword', '<div class="error">', '</div>'); ?>
</div>
<div class="input-group mb-2">
<input type="password" class="form-control" placeholder="New Password" id="newpassword"  name='newpassword' value="<?php echo set_value('newpassword'); ?>">
<?php echo form_error('newpassword', '<div class="error">', '</div>'); ?>
</div>
<div class="input-group mb-4">
<input type="password" class="form-control" placeholder="Re-Type New Password" id="confirmnewpassword"  name='confirmnewpassword' value="<?php echo set_value('confirmnewpassword'); ?>">
<?php echo form_error('confirmnewpassword', '<div class="error">', '</div>'); ?>
</div>
<button class="btn btn-block btn-primary mb-1 rounded-pill" id="submit">Change Password</button>

</form>


</div>
</div>
</div>

<div class="col-md-2"></div>
</div>

</div>
</div>

</div>



