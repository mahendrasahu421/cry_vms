<div class="content-main  container">
<nav class="pcoded-navbar menupos-fixed menu-light ">
<div class="navbar-wrapper content-main  container">
<div class="navbar-content scroll-div ">
<ul class="nav pcoded-inner-navbar ">
<li class="nav-item pcoded-menu-caption">
<label>Mainmenu</label>
</li>
<li class="nav-item">
    <a href="<?php echo base_url('admin-dashboard');?>" class="nav-link "><span class="pcoded-micon"><i class="fa fa-dashboard"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>

<!--<li class="nav-item">
<a href="<?php echo base_url();?>volenteer-leader" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user-o"></i></span><span class="pcoded-mtext">Volunteer Leader</span></a></li>-->

<!-- <li class="nav-item pcoded-hasmenu"><a href="#" class="nav-link"><span class="pcoded-micon"><i class="fa fa-cogs"></i></span><span class="pcoded-mtext">Master Setting</span></a>
<ul class="pcoded-submenu">
	<li class="pcoded-hasmenu">
	<a href="#">Register Menu</a>
		<ul class="pcoded-submenu">
		<li><a href="<?php echo base_url();?>master-menu">Master Menu</a></li>
		<li><a href="<?php echo base_url();?>sub-menu-list">Sub Menu</a></li>
		</ul>
	</li>
	<li><a href="<?php echo base_url();?>create-permission">Create Permission</a></li>
	<li><a href="<?php echo base_url();?>create-role">Create Role </a></li>
	<li><a href="<?php echo base_url();?>role-permission">Role & Permission</a></li>
</ul>
</li> -->

<li class="nav-item pcoded-hasmenu"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-cog"></i></span><span class="pcoded-mtext"> Settings</span></a>
<ul class="pcoded-submenu">
<li><a href="<?php echo base_url();?>cause-list">Theme List</a></li>
<li><a href="<?php echo base_url();?>region-list">Region List</a></li>
</ul>
</li>

<li class="nav-item">
<a href="<?php echo base_url();?>volenteership" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Volunteer List</span></a></li>

<li class="nav-item">
<a href="<?php echo base_url();?>patners" class="nav-link "><span class="pcoded-micon"><i class="fa fa-product-hunt"></i></span><span class="pcoded-mtext">Partners List</span></a></li>

<li class="nav-item pcoded-hasmenu"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-tasks"></i></span><span class="pcoded-mtext">Task</span></a>
<ul class="pcoded-submenu">
<li><a href="<?php echo base_url();?>add-task">Add Task</a></li>
<li><a href="<?php echo base_url();?>task-list">View Task </a></li>
</ul>
</li>

<li class="nav-item pcoded-hasmenu"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-tasks"></i></span><span class="pcoded-mtext"> Assigned Task</span></a>
<ul class="pcoded-submenu">
<li><a href="<?php echo base_url();?>assigned-task">Assign Task</a></li>
<li><a href="<?php echo base_url();?>view-assigned-task">View Assigned List </a></li>
</ul>
</li>

<li class="nav-item pcoded-hasmenu"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-retweet"></i></span><span class="pcoded-mtext">Approve Report</span></a>
<ul class="pcoded-submenu">
<li><a href="<?php echo base_url();?>view-daily-report">Approve Report</a></li>
<li><a href="<?php echo base_url();?>view-self-task-report">Self Task Report</a></li>
</ul>
</li>

<!--<li class="nav-item">
<a href="<?php //echo base_url();?>view-daily-report" class="nav-link "><span class="pcoded-micon"><i class="fa fa-retweet"></i></span><span class="pcoded-mtext">Approve Report</span></a></li>-->

<li class="nav-item">
<a href="<?php echo base_url();?>admin-reward-point" class="nav-link "><span class="pcoded-micon"><i class="fa fa-flag-o"></i></span><span class="pcoded-mtext">Reward Points</span></a></li>

<li class="nav-item">
<a href="<?php echo base_url();?>requested-task" class="nav-link "><span class="pcoded-micon"><i class="fa fa-bars"></i></span><span class="pcoded-mtext">Requested Task</span></a></li>

<li class="nav-item pcoded-hasmenu">
<a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-retweet"></i></span><span class="pcoded-mtext">Activity Report</span></a>
<ul class="pcoded-submenu">
<li class="pcoded-hasmenu">
<a href="#">Volunteer Report</a>
<ul class="pcoded-submenu">
<li><a href="<?php echo base_url();?>volunteer">Basic Report</a></li>
<li><a href="<?php echo base_url();?>co-volunteer-report">Adv. Report</a></li>
<li><a href="<?php echo base_url();?>patner-wise-report">Partner Wise Report</a></li>

</ul>
</li>
<li><a href="<?php echo base_url();?>tast-report">Task Report</a></li>
<li><a href="<?php echo base_url();?>admin-final-daily-report">Daily Report</a></li>
<li><a href="<?php echo base_url();?>admin-self-task-daily-report">Self Task Daily Report</a></li>
<li><a href="<?php echo base_url();?>admin-users-daily-report">Users Daily Report</a></li>
<li><a href="<?php echo base_url();?>admin-users-donation-report">Users Donation Report</a></li>
</ul>
</li>


<li class="nav-item pcoded-hasmenu"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-tasks"></i></span><span class="pcoded-mtext"> All Reports</span></a>
<ul class="pcoded-submenu">
<li><a href="#" id="partnercsv">Partner List</a></li>
</ul>
</li>

<!--<li class="nav-item pcoded-hasmenu"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-trello"></i></span><span class="pcoded-mtext">Reports Activity </span></a>
<ul class="pcoded-submenu">
<li><a href="<?php echo base_url();?>volunteer">Volunteer Report</a></li>
<li><a href="<?php echo base_url();?>tast-report">Task Report</a></li>
<li><a href="<?php echo base_url();?>final-daily-report">Daily Report</a></li>
</ul>

</li>-->



</ul>
</div>
</div>
</nav>
