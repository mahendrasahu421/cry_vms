<!----new sidebar--->
<?php $base_url = base_url() . 'admin/'; ?>
<?php
$this->load->helper('sidebardata_helper');
$alldata = get_permission();
$mapping_role_data = $alldata[0];
$master_menu = $alldata[1];
$master_sub_menu = $alldata[2];
$master_sub_sub_menu = $alldata[3];
$rid = $this->session->userdata('admin_role');
?>
<style>
	.side-menu__item.active {
		text-decoration: none;
		color: #ffffff;
		background: #fbc434;
		border-radius: 0 60px 60px 0;
		box-shadow: 0 7px 12px 0 var(--primary02);
	}
</style>
<div class="sticky">
	<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
	<aside class="app-sidebar">
		<div class="side-header">
			<a class="header-brand1" href="index.php">
				<img src="<?php echo base_url('admin/'); ?>assets\images\brand\cry-yellowlogo.gif" class="header-brand-img desktop-logo" alt="logo">
				<img src="<?php echo base_url('admin/'); ?>assets\images\brand\cry-yellowlogo.gif" class="header-brand-img toggle-logo" alt="logo">
				<img src="<?php echo base_url('admin/'); ?>assets\images\brand\cry-yellowlogo.gif" class="header-brand-img light-logo" alt="logo">
				<img src="<?php echo base_url('admin/'); ?>assets\images\brand\cry-yellowlogo.gif" class="header-brand-img light-logo1" alt="logo">
			</a>
			<!-- LOGO -->
		</div>
		<div class="main-sidemenu">
			<div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
					<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
				</svg></div>
			<ul class="side-menu">
				<li class="sub-category">
					<h3>Main</h3>
				</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="admin-dashboard">
						<i class="side-menu__icon fe fe-home"></i>
						<span class="side-menu__label">Dashboard</span>
					</a>
				</li>
				<?php
				foreach ($mapping_role_data as $menudata) {
					$menu = explode('&&', $menudata['menu_master_id']);
					$roleid = $menudata['role_id'];

					for ($i = 0; $i <= count($menu) - 1; $i++) {
						$menu_data = explode('|', $menu[$i]);
						for ($j = 1; $j <= count($menu_data) - 1; $j++) {
							$sub = explode('$', $menu_data[$j]);
							if ($sub[0] != "" && $sub[1] != "" && $sub[2] == "") {
								$submenu[] = $menu_data[$j];
							} else {
								$subsubmenu[] = $menu_data[$j];
							}
							for ($k = 0; $k <= count($sub) - 1; $k++) {
							}
						}
						$menuid[] = $menu_data[0];
					}
				}
				?>
				<?php for ($m = 0; $m <= count($menuid) - 1; $m++) { ?>

					<li class="slide">
						<?php
						$mid = $menuid[$m];
						$menu_detail = $this->Crud_modal->all_data_select('menu_description,menu_route_name', 'master_menu', "menu_id = '$mid'", 'menu_id ASC');  ?>
						<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo ($menu_detail[0]['menu_route_name'] == "#" ? "#" : base_url() . $menu_detail[0]['menu_route_name']); ?>"><i class="side-menu__icon fe fe-database"></i><span class="side-menu__label"><?php echo $menu_detail[0]['menu_description']; ?></span><i class="angle fa fa-angle-right"></i></a>
						<ul class="slide-menu">
							<?php for ($n = 0; $n <= count($submenu) - 1; $n++) {
								$submenuid = explode('$', $submenu[$n]);
								if ($submenuid[0] == $menuid[$m]) {
									$mid = $menuid[$m];
									$sid = $submenuid[1];
									$sub_menu_detail = $this->Crud_modal->all_data_select('sub_menu_route,sub_menu_description', 'master_sub_menu', "sub_menu_id = '$sid' and menu_id = '$mid'", 'sub_menu_id ASC');
							?>



									<li>
										<a href="<?php echo ($sub_menu_detail[0]['sub_menu_route'] == "#"  ? "#" : base_url() . $sub_menu_detail[0]['sub_menu_route']); ?>" class="slide-item">
											<?php echo $sub_menu_detail[0]['sub_menu_description']; ?>
										</a>
									</li>
							<?php }
							} ?>
						</ul>
					</li>
				<?php } ?>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon fe fe-package"></i><span class="side-menu__label">Program Volunteer</span><i class="angle fa fa-angle-right"></i></a>
					<ul class="slide-menu">
						<li class="side-menu-label1"><a href="javascript:void(0)">Settings</a></li>
						<li>
							<a href="<?php echo base_url(); ?>program-volunteer-list" class="slide-item">
								Add Program
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>share-link" class="slide-item">
								Share Link
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>volunteer-list" class="slide-item">
								Volunteer List
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>issue-certificate" class="slide-item">
								Issue Certificate
							</a>
						</li>
					</ul>
				</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon fe fe-package"></i><span class="side-menu__label">Transfer Request</span><i class="angle fa fa-angle-right"></i></a>
					<ul class="slide-menu">
						<li class="side-menu-label1"><a href="javascript:void(0)">Settings</a></li>
						<li>
							<a href="<?php echo base_url(); ?>transfer-table" class="slide-item">
								Intern Transfer Request
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>voleentur-transfer-table" class="slide-item">
								Voleentur Transfer Request
							</a>
						</li>

					</ul>
				</li>
				<li class="slide">
				<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon fe fe-package"></i><span class="side-menu__label">Volunteer Section Report</span><i class="angle fa fa-angle-right"></i></a>
				<ul class="slide-menu">
						<li class="side-menu-label1"><a href="javascript:void(0)">Settings</a></li>
						<li>
							<a href="<?php echo base_url();?>pre-registration-volunteer-report" class="slide-item">
							Pre Registration Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>post-registration-volunteer-report" class="slide-item">
							Post Registration Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>onboard-volunteer" class="slide-item">
							All On Board Volunteer Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>tast-report" class="slide-item">
							Task Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>volunteer-assign-task" class="slide-item">
							Assign Task Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>volunteer-certificate-report" class="slide-item">
							Send Certificate Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>volunteer-self-task-daily-report" class="slide-item">
							Self Task Report 
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>volunteer-transfer-report" class="slide-item">
							Transfer Report
							</a>
						</li>

					</ul>
				</li>
				<li class="slide">
				<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon fe fe-package"></i><span class="side-menu__label">Intern Section Report</span><i class="angle fa fa-angle-right"></i></a>
				<ul class="slide-menu">
						
						<li>
							<a href="<?php echo base_url(); ?>pre-registration-intern-report" class="slide-item">
							Pre Registration Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>post-registration-intern-report" class="slide-item">
							Post Registration Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>co-volunteer-report" class="slide-item">
							All On Board Intern Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>intern-tast-report" class="slide-item">
							Task Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>intern-assign-task-report" class="slide-item">
							Assign Task Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>intern-certificate-report" class="slide-item">
							Send Certificate Report
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>intern-self-task-daily-report" class="slide-item">
							Self Task Report 
							</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>intern-transfer-report" class="slide-item">
							Transfer Report
							</a>
						</li>
						

					</ul>
				</li>

			</ul>
			<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
					<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
				</svg></div>
		</div>
	</aside>
</div>