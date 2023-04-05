<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="index.html">
                <img src="assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                <img src="assets/images/brand/logo-1.png" class="header-brand-img toggle-logo" alt="logo">
                <img src="assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
                <img src="assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="<?php echo base_url(); ?>dashboard"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="sub-category">
                    <h3>Widgets</h3>
                </li>
                <li>
                    <a class="side-menu__item" href="<?php echo base_url(); ?>task"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">My Task</span></a>
                </li>
                <li>
                    <a class="side-menu__item" href="<?php echo base_url(); ?>find-task"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Find Task</span></a>
                </li>
                <li class="sub-category">
                    <h3>Elements</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                            class="side-menu__icon fe fe-database"></i><span class="side-menu__label">Daily
                            Report</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Daily Report</a></li>
                        <li><a href="<?php echo base_url(); ?>add-daily-report" class="slide-item"> Add Daily Report</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>self-task-daily-report" class="slide-item"> Self Task
                                Daily Report</a></li>
                        <li><a href="<?php echo base_url(); ?>daily-report" class="slide-item"> View Daily Report</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>self-task-view-daily-report" class="slide-item"> View Self
                                Task Daily Report</a></li>
                    </ul>
                </li>

                <li>
                    <a class="side-menu__item" href="<?php echo base_url(); ?>certificatenew"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">
                            Certificate</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                            class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Transfer
                            Request</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Transfer Request</a></li>
                        <li><a href="<?php echo base_url(); ?>transfer-form" class="slide-item">Send Request For Tranfer</a></li>
                        <li><a href="<?php echo base_url(); ?>transfer-report" class="slide-item">Transfer Request
                                Report</a></li>
                    </ul>
                </li>


    </aside>
</div>
<!--/APP-SIDEBAR-->