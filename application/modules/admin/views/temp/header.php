<style>
	.header .dropdown-menu {
		margin-top: 0px;
		margin-left: -144px;
	}
</style>

<body class="app sidebar-mini ltr light-mode">

	<!-- GLOBAL-LOADER -->
	<div id="global-loader">
		<img src="<?php echo base_url('admin/'); ?>assets/images/loader.svg" class="loader-img" alt="Loader">
	</div>
	<!-- /GLOBAL-LOADER -->

	<!-- PAGE -->
	<div class="page">
		<div class="page-main">

			<!-- app-Header -->
			<div class="app-header header sticky">
				<div class="container-fluid main-container">
					<div class="d-flex align-items-center">
						<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0);"></a>
						<div class="responsive-logo">
							<a href="<?php echo base_url('admin-dashboard')?>" class="header-logo">
								<img src="<?php echo base_url('admin/'); ?>assets/images/brand/logo-3.png" class="mobile-logo logo-1" alt="logo">
								<img src="<?php echo base_url('admin/'); ?>assets/images/brand/logo.png" class="mobile-logo dark-logo-1" alt="logo">
							</a>
						</div>
						<!-- sidebar-toggle-->
						<a class="logo-horizontal " href="<?php echo base_url('admin-dashboard')?>">
							<img src="<?php echo base_url('admin/'); ?>assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
							<img src="<?php echo base_url('admin/'); ?>assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo">
						</a>
						<!-- LOGO -->
						
						<div class="d-flex order-lg-2 ms-auto header-right-icons">
							
							<?php
							if ($this->session->userdata('region_id') == 0) {
								echo "";
							} else {
								$statesID = $rname['state_id'];
								$stateCode  = $this->Admin_model->get_all_region_data($statesID);
								$resultCode = array_column($stateCode, 'code');
								$resultSname = array_column($stateCode, 'state_name');
								$Sname = "";
								for ($i = 0; $i < count($resultCode); $i++) {
									$Sname .= '<span style="cursor:pointer;" title="' . $resultSname[$i] . '">' . $resultCode[$i] . '</span>,';
								}
								echo '<strong style="font-weight: 900;">'.$rname['region_name'].'</strong>'.":" . $Sname;
							}
							?>
							<div class="navbar navbar-collapse responsive-navbar p-0">
								<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
									<div class="d-flex order-lg-2">
										
										<div class="dropdown d-md-flex">
											<a class="nav-link icon theme-layout nav-link-bg layout-setting">
												<span class="dark-layout"><i class="fe fe-moon"></i></span>
												<span class="light-layout"><i class="fe fe-sun"></i></span>
											</a>
										</div>
										<!-- Theme-Layout -->
										<div class="dropdown d-md-flex">
											<a class="nav-link icon full-screen-link nav-link-bg">
												<i class="fe fe-minimize fullscreen-button"></i>
											</a>
										</div>

										<!-- FULL-SCREEN -->
										
									
									
										<!-- MESSAGE-BOX -->
										<div class="dropdown d-md-flex profile-1">
											<a href="javascript:void(0);" data-bs-toggle="dropdown" class="nav-link leading-none d-flex px-1">
												<span>
													<img src="<?php echo base_url('admin/'); ?>assets/images/users/8.jpg" alt="profile-user" class="avatar  profile-user brround cover-image">
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
												<div class="drop-heading">
													<div class="text-center">
														<h5 class="text-dark mb-0"><?php echo ucfirst($this->session->userdata('emp_name')); ?></h5>
														<small class="text-muted"><?php echo ucfirst($this->session->userdata('region_name')); ?></small>
													</div>
												</div>
												<div class="dropdown-divider m-0"></div>
												<a class="dropdown-item" href="admin-user-profile">
													<i class="dropdown-icon fe fe-user"></i> Profile
												</a>
												<a class="dropdown-item" href="<?php echo base_url('login');?>">
													<i class="dropdown-icon fe fe-alert-circle"></i> Sign out
												</a>
											</div>
										</div>
										
										<!-- SIDE-MENU -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /app-Header -->