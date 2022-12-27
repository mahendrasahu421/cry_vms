<div class="content-main  container">
<nav class="pcoded-navbar menupos-fixed menu-light ">
<div class="navbar-wrapper content-main  container">
<div class="navbar-content scroll-div ">
<ul class="nav pcoded-inner-navbar ">
<li class="nav-item pcoded-menu-caption">
<label>Mainmenu</label>
</li>
<li class="nav-item"><a href="<?php echo base_url('dashboard');?>" class="nav-link "><span class="pcoded-micon"><i class="fa fa-server"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>

<li class="nav-item">
<a href="<?php echo base_url('task');?>" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user-o"></i></span><span class="pcoded-mtext">My Task</span><span class="pcoded-badge badge badge-success"><?php echo $totaltask; ?></span></a></li>

<li class="nav-item pcoded-hasmenu"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-trello"></i></span><span class="pcoded-mtext">Daily Report</span></a>
<ul class="pcoded-submenu">
<li><a href="<?php echo base_url('add-daily-report');?>">Add Daily Report</a></li>
<li><a href="<?php echo base_url('daily-report');?>">View Daily Report</a></li>
</ul>

</li>


<li class="nav-item">
<a href="<?php echo base_url('find-task');?>" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user-o"></i></span><span class="pcoded-mtext">Find Task</span></a></li>

<li class="nav-item">
<a href="<?php echo base_url('reward-point');?>" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user-o"></i></span><span class="pcoded-mtext">Reward Points</span></a></li>

<!-- <li class="nav-item"><a href="<?php echo base_url('timeline');?>" class="nav-link "><span class="pcoded-micon"><i class="fa fa-trello"></i></span><span class="pcoded-mtext">Timeline Activity </span></a></li> -->

<li class="nav-item pcoded-hasmenu"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa fa-trello"></i></span><span class="pcoded-mtext">Reports</span></a>
<ul class="pcoded-submenu">
<li><a href="<?php echo base_url('task-report');?>">Task</a></li>
<li><a href="<?php echo base_url('reward-report');?>">Reward Point</a></li>
<li><a href="<?php echo base_url('final-daily-report');?>">Daily Report</a></li>
</ul>

</li>



</ul>
</div>
</div>
</nav>
