<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Caritas India - Volunteer Management System</title>

	<meta name="description" content="Caritas India is a leading humanitarian aid organization particularly in the sectoral areas of community managed disaster risk reduction and natural resource management with community mobilization as its overarching strategy.">

	<meta name="keywords" content="Caritas India">

	<meta name="author" content="CodexCoder">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

	<!-- Modernizr js -->
	<script src="<?php echo base_url('web/'); ?>assets/js/modernizr-2.8.0.min.js"></script>

	<!-- Bootstrap  -->
	<link href="<?php echo base_url('web/'); ?>assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- icon fonts font Awesome -->
	<link href="<?php echo base_url('web/'); ?>assets/css/font-awesome.min.css" rel="stylesheet">

	<!-- icon fonts linecons -->
	<link href="<?php echo base_url('web/'); ?>assets/css/linecons-font-style.css" rel="stylesheet">

	<!-- Custom Styles -->
	<link href="<?php echo base_url('web/'); ?>assets/css/style.css" rel="stylesheet">

	<!-- Responsive Styles -->
	<link href="<?php echo base_url('web/'); ?>assets/css/responsive.css" rel="stylesheet">

	<!-- Important owl stylesheet -->
	<link rel="stylesheet" href="<?php echo base_url('web/'); ?>assets/css/owl.carousel.css">

	<!-- Important prettyPhoto stylesheet -->
	<link rel="stylesheet" href="<?php echo base_url('web/'); ?>assets/css/prettyPhoto.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- favicon -->
	<link rel="shortcut icon" href="https://www.caritasindia.org/wp-content/themes/wisdom-responsive/images/favicon.ico">

	<script type="text/javascript">
		function googleTranslateElementInit() {
			new google.translate.TranslateElement({
				pageLanguage: 'en'
			}, 'google_translate_element');
		}
	</script>

	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
	<header>

		<div id="google_translate_element" class="pull-right" style=" margin-right: 114px;"></div>
		<i class="fa fa-globe" style="color: #fff;float: right;font-size: 25px; padding: 4px 6px; "></i>
	</header>
	<!-- Main Menu -->
	<div class="main-menu-container navbar-fixed-top" style="background-color: #f4f4f4 !important;">
		<div id="main-menu" class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<!-- responsive navigation -->

					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<i class="fa fa-bars"></i>
					</button>

					<!-- /.navbar-toggle -->
					<!-- Logo -->
					<h1>
						<a class="navbar-brand" href="<?php echo base_url(); ?>" style="margin-bottom: 10px;">
							<img class="logo" src="<?php echo base_url('web/'); ?>assets/images/logo.png" alt="Logo" rel="hoome">
							<!-- <span style="color: #f39c12;">Caritasindia</span> -->
						</a><!-- /.navbar-brand -->
					</h1>
				</div> <!-- /.navbar-header -->

				<nav class="collapse navbar-collapse">
					<style>
						.effect {
							margin-top: 25px;
							color: #8e2c24 !important;
							border: 2px solid #977774;
							line-height: 30px;
							height: 35px;
						}

						.effect:hover {
							color: #fff !important;
						}

						header {
							height: 36px;
							background: #8e2c24;
							z-index: 9999999999;
							position: relative;
						}

						.navbar-fixed-top {
							top: 36px !important;
							border-width: 0 0 1px;
						}

						.goog-logo-link {
							display: none;
						}

						.goog-te-gadget-icon {
							background: none !important;
						}

						.goog-te-gadget-simple {
							border-radius: 12px;
							border: 1px solid #b1b1b1;
							padding: 3px;
						}

						.goog-te-gadget {
							color: #191919;
							font-size: 1px;
						}

						.goog-te-gadget .goog-te-combo {
							margin: 2px 0 !important;
							padding: 5px !important;
							border: 1px solid #fff !important;
						}

						iframe.goog-te-banner-frame {
							display: none !important;
						}

						body {
							position: static !important;
							top: 0px !important;
							-webkit-user-select: none !important;
							-moz-user-select: -moz-none !important;
							-ms-user-select: none !important;
							user-select: none !important;
						}
					</style>
					<!-- Main navigation -->
					<!--<a href="signup" class="btn custom-btn angle-effect pull-right effect">Sign Up <i class="fa fa-user"></i></a>
						<a href="login" class="btn custom-btn angle-effect pull-right effect">Log In <i class="fa fa-sign-in"></i></a>-->
					<ul class="nav navbar-nav pull-right" style="margin-top: 10px;">
						<!-- <li class="active1"><a href="#top-section">Home</a></li> -->
						<li class="active1"><a href="#Inspired">Get Inspired</a></li>
						<li class="active1"><a href="#Causes">Themes</a></li>
						<li class="active1"><a href="#Expert">Expert Area</a></li>
						<li class="active1"><a href="#Guidelines">Guidelines</a></li>
						<li class="active1"><a href="#Badges">Badges</a></li>

						<a href="/vms/signup" class="btn custom-btn angle-effect pull-right effect">Sign Up <i class="fa fa-user"></i></a>
						<a href="/vms/login" class="btn custom-btn angle-effect pull-right effect">Log In <i class="fa fa-sign-in"></i></a>
						<!--http://caritasindia.org/vms/login-->
						<!-- <li class="active1"><a href="#contact">Contact</a></li> -->
						<!-- <li class="active1"><a href="http://caritasindia.org/volunteer/admin/signup.php">Sign up</a></li> -->
					</ul> <!-- /.nav .navbar-nav -->
				</nav> <!-- /.navbar-collapse  -->
			</div> <!-- /.container -->
		</div><!-- /#main-menu -->
	</div><!-- /.main-menu-container -->
	<!-- Main Menu End -->




	<!-- Top Slider -->
	<section id="top-section" style="padding-top: 50px;">
		<div class="top-section parallax-style">
			<div class="parallax-overlay">
				<div class="slider-txt-container">
					<div id="top-carousel" class="carousel slide" data-ride="carousel">

						<ol class="carousel-indicators">
							<li data-target="#top-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#top-carousel" data-slide-to="1"></li>
							<li data-target="#top-carousel" data-slide-to="2"></li>
						</ol><!-- /.carousel-indicators -->
						<div class="carousel-inner">

							<div class="item active">
								<h2 class="thin-txt">
									Volunteerism is at
								</h2>
								<p class="bold-txt">
									the heart of
								</p><!-- /.thin-text -->
								<p class="thin-txt">
									Caritas India
								</p>
								<!-- /.thin-text -->

								<!-- <p class="link">
										<a href="#" class="btn custom-btn angle-effect">Learn More</a>
									</p> 				 -->
							</div><!-- /.item -->

							<div class="item">
								<h2 class="thin-txt">
									Become
								</h2>
								<!-- /.thin-text -->
								<p class="bold-txt">
									a Caritas
								</p><!-- /.thin-text -->
								<p class="thin-txt">
									Samaritan
								</p>
								<!-- /.thin-text -->

								<!--<p class="link">
										<a href="#" class="btn custom-btn angle-effect">Learn More</a>
									</p>-->
							</div><!-- /.item -->

							<div class="item">
								<h2 class="thin-txt">
									Join us
								</h2><!-- /.thin-text -->
								<p class="bold-txt">
									in this journey of
								</p><!-- /.thin-text -->
								<p class="thin-txt">
									Transformation
								</p><!-- /.thin-text -->

								<!-- <p class="link">
										<a href="#" class="btn custom-btn angle-effect">Learn More</a>
									</p>  -->
							</div><!-- /.item -->
						</div><!-- /.carousel-inner -->
						<a class="slide-nav left" href="#top-carousel" data-slide="prev"><span></span></a>
						<a class="slide-nav right" href="#top-carousel" data-slide="next"><span></span></a>
					</div><!-- /#top-carousel -->
				</div><!-- /.slider-txt-container -->
			</div><!-- /.parallax-overlay -->
		</div><!-- /.top-section -->
	</section><!-- /#top-section -->
	<!-- Top Slider End-->



	<!-- About Section -->
	<section>
		<div class="about-section">
			<div class="white-bg angular section-padding" style="margin-bottom: 30px;">
				<div class="top-angle" id="Inspired">
				</div><!-- /.top-angle -->
				<div class="container">
					<div class="section-head">
						<h2 class="section-title" style="font-size:2.35em">Volunteering with Caritas India</h2>
						<p class="section-description">
							Volunteers with Caritas India are known as Caritas Samaritan. We believe in the power of volunteerism.
							It has believed volunteers are people who work in a joint effort; coexist in solidarity, seeking unity,
							respecting, and valuing differences; dialogue and goodwill. Volunteers act as a driving force as animators
							of process of organisation and mobilisation towards social transformation.

						</p><!-- /.section-description -->
						<p class="section-description">
							Caritas India is a leading humanitarian aid organization particularly in the sectoral areas of community
							managed disaster risk reduction and natural resource management with community mobilization as its
							overarching strategy. We welcome you on board on this journey.

						</p>
					</div><!-- /.section-head -->

					<div class="section-content">
						<div class="row">
							<div class="content-box col-md-8 from-bottom delay-200">
								<div class="hex content-icon-hex pull-left">
									<div class="content-icon">
										<span aria-hidden="true" class="li_bulb"></span>
									</div>
								</div><!-- /.content-icon-hex -->
								<h3 class="content-title">Get Inspired: Why Should I Join?</h3>
								<p>
									<strong>Volunteers are engaged and celebrated in Caritas India since its inception in 1962. We ensure
										every Caritas Samaritan goes through a holistic development while substantially contributing
										as a change maker.</strong>
								</p>
								<p>
									<strong>Caritas Samaritans will have access to</strong>
									<style>
										.ul>li {
											list-style: outside;
										}

										ul {
											padding-left: 40px;
										}
									</style>
								<ul class="ul">
									<li>Build and engage with National &amp; International Network</li>
									<li>Capacity building programs</li>
									<li>Diverse scope of work</li>
									<li>Skill building</li>
								</ul>
								</p>

							</div><!-- /.content-box -->

							<div class="media-content media-right col-md-4 from-bottom delay-600">
								<div class="meida-container">
									<div id="about-img-carousel" class="about-img-carousel carousel slide" data-ride="carousel">
										<ol class="carousel-indicators">
											<li data-target="#about-img-carousel" data-slide-to="0" class="active"></li>
											<li data-target="#about-img-carousel" data-slide-to="1"></li>
											<li data-target="#about-img-carousel" data-slide-to="2"></li>
										</ol><!-- /.carousel-indicators -->
										<div class="carousel-inner">

											<div class="item active">
												<img src="<?php echo base_url('web/'); ?>images/about-carousel/01.jpg" alt="carousel image">
											</div><!-- /.item -->
											<div class="item">
												<img src="<?php echo base_url('web/'); ?>images/about-carousel/02.jpg" alt="carousel image">
											</div><!-- /.item -->
											<div class="item">
												<img src="<?php echo base_url('web/'); ?>images/about-carousel/03.jpg" alt="carousel image">
											</div><!-- /.item -->
										</div><!-- /.carousel-inner -->
									</div><!-- /#about-img-carousel -->
								</div><!-- /.meida-container -->
							</div><!-- /.media-content -->
						</div><!-- row -->
					</div><!-- /.section-content -->
				</div><!-- /.container -->
			</div><!-- /.white-bg -->

			<div class="gray-bg angular section-padding" style="padding-top: 0px;">
				<div class="top-angle"></div>
				<div class="container" style="margin-bottom:20px;">
					<div class="row">
						<div class="section-content">
							<div class="content-box col-md-8 from-bottom delay-600">
								<div class="hex content-icon-hex pull-left" style="margin: 70px 30px 40px 0;">
									<div class="content-icon">
										<span aria-hidden="true" class="li_params"></span>
									</div>
								</div>
								<h3 class="content-title">Become a Caritas Samaritan – 3 Easy Steps!</h3>
								<p>
									<strong>
										1. Sign Up <br>
										2. Complete your Profile<br>
										3. Get Ready to Receive Task <br>
									</strong>
								</p>

								<!-- <p>
										Together, we're going to make the future of the children where we are able to fulfill all of their requirements to keep them safe from withered world. We have already stepped out and start changing the world. Keeping safe them from war, inhumanity, Child labor, child abuse and more what we feel harmful for them.
									</p> -->
							</div><!-- /.content-box -->
							<div class="media-content media-left col-md-4 from-bottom delay-200">
								<div class="meida-container">
									<img src="<?php echo base_url('web/'); ?>images/volunteer.jpg" alt="volunteer">
								</div>
								<!-- /.meida-container -->
							</div><!-- /.media-content -->
						</div><!-- /.section-content -->
					</div><!-- /.row -->
				</div><!-- /.container -->

				<div class="bottom-angle111">
				</div><!-- /.bottom-angle -->

			</div><!-- ./gray-bg -->
		</div><!-- /.about-section -->
	</section><!-- /#about-->
	<!-- About Section End -->


	<!-- About Parallax Section -->
	<section id="about-parallax">
		<div class="about-parallax parallax-style">
			<div class="parallax-overlay section-padding">
				<div class="container">
					<h3 class="parallax-title">
						We are very Thankful
					</h3><!-- /.parallax-title -->
					<p class="parallax-description">
						A Strong Dedicated team of <br><span class="amount" style="color:#e12444;"><?php echo $tvol; ?></span> volunteers so far
					</p><!-- /.parallax-description -->
					<div class="progress-bar-container">
						<div class="progress">
							<div class="progress-bar progress-bar-warning" style="background-color: #e12444; width:<?php echo $ptvol; ?>%" role="progressbar" aria-valuenow="<?php echo $tvol; ?>" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">60% Complete (warning)</span>
							</div><!-- /.progress-bar -->
						</div><!-- /.progress -->
					</div><!-- /.progress-bar-container -->
					<p>
						<a href="<?php echo base_url(); ?>signup" class="btn donate-btn">Join Us <i class="fa fa-heart"></i></a>
					</p>
				</div><!-- /.container -->
			</div><!-- /.parallax-overlay -->
		</div><!-- /.about-parallax -->
	</section><!-- /#about-parallax -->
	<!-- About Parallax Section End -->

	<!-- Services Section -->
	<section>
		<div class="services-section section-padding">
			<!--white-bg angular-->
			<div class="top-angle" id="Causes">
			</div><!-- /.top-angle -->
			<div class="container">
				<div class="section-head">
					<h2 class="section-title">
						Themes
					</h2>
					<!-- <p class="section-description">
							ALL OF OUR SERVICES IS CENTRALIZED TO THE WELFARE OF THE CHILDREN. WE SERVE THE CHILD WITH FOOD, EDUCATION, HABITATION, SAFETY AND EVERYTHING THE NEED. 
						</p> -->
				</div><!-- /.section-head -->
				<div class="clearfix"></div>
				<div class="section-content">
					<div class="row">
						<style>
							.service-box {
								padding: 10px;

							}

							.service-box>center>img {
								width: 50%;

							}

							.cause-heading {
								padding-top: 20px;
								height: 100px !important;

							}
						</style>
						<div class="col-md-4 col-sm-4 col-xs-6 from-bottom delay-200 mb-20">
							<div class="service-box">
								<center><img src="<?php echo base_url('web/'); ?>assets/images/Humanitarian-Aid-Disaster-Risk-Reduction-300x300.png" alt=""></center>
								<a href="https://www.caritasindia.org/humanitarian-aid-and-disaster-risk-reduction/" target="_blank">
									<h3 class="service-title content-title cause-heading mob-title">
										Humanitarian Aid and Disaster Risk Reduction
									</h3>
								</a>


							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->

						<div class="col-md-4 col-sm-4 col-xs-6 from-bottom delay-600 mb-20">
							<div class="service-box">
								<center><img src="<?php echo base_url('web/'); ?>assets/images/natural_resource_management.jpg" alt=""></center>
								<a href="https://www.caritasindia.org/climate-adaptive-agriculture-and-food-sovereignty/" target="_blank">
									<h3 class="service-title content-title cause-heading mob-title">
										Climate Adaptive Agriculture and Food Sovereignty
									</h3>
								</a>


							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->

						<div class="col-md-4 col-sm-4 col-xs-6 from-bottom delay-1000 mb-20">
							<div class="service-box">
								<center><img src="<?php echo base_url('web/'); ?>assets/images/Livelihood-and-skill-develo.png" alt=""></center>
								<a href="https://www.caritasindia.org/livelihood-skill-development/" target="_blank">
									<h3 class="service-title content-title cause-heading mob-title">
										Livelihood and Skill Development
									</h3>
								</a>


							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-4 col-sm-4 col-xs-6 from-bottom delay-1000 mb-20">
							<div class="service-box">
								<center><img src="<?php echo base_url('web/'); ?>assets/images/Anti-Human-trafficking-and-safe-migration-300x300.png" alt=""></center>

								<a href="https://www.caritasindia.org/anti-human/" target="_blank">
									<h3 class="service-title content-title cause-heading mob-title">
										Anti Human Trafficking & Safe Migration
									</h3>
								</a>


							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-4 col-sm-4 col-xs-6 from-bottom delay-1000 mb-20">
							<center>
								<div class="service-box">
									<center><img src="<?php echo base_url('web/'); ?>assets/images/Health-and-Nutrition-300x300.png" alt=""></center>
									<a href="https://www.caritasindia.org/health-and-nutrition/" target="_blank">
										<h3 class="service-title content-title cause-heading mob-title">
											Health and Nutrition
										</h3>
									</a>


								</div>
							</center>
							<!-- /.service-box -->
						</div><!-- /.col-md-4 -->

						<div class="col-md-4 col-sm-4 col-xs-6 from-bottom delay-1000">
							<div class="service-box">
								<center><img src="<?php echo base_url('web/'); ?>assets/images/Peace-Building-150x150.png" alt=""></center>
								<a href="https://www.caritasindia.org/peacebuilding/" target="_blank">
									<h3 class="service-title content-title cause-heading mob-title">
										Peace Building
									</h3>
								</a>
							</div>
						</div>

						<!-- /.col-md-4 -->
					</div><!-- /.row -->
				</div><!-- /.section-content -->
			</div><!-- /.container-->
		</div><!-- /.services-section -->
	</section><!-- /#services -->
	<!--Services Section End-->
	<!-- Next Event -->
	<section id="next-event">
		<div class="next-event  parallax-style">
			<div class="parallax-overlay section-padding">
				<div class="container">
					<h3 class="parallax-title">
						Volunteer Dashboard
					</h3>
					<div class="row">
						<div id="event_time_countdown1" class="next-event-container">

							<div class="col-sm-2 col-md-2"></div>
							<div class="col-xs-6 col-sm-4 col-md-4 from-bottom delay-200">
								<div class="time-circle dash days_dash animated" data-animation="rollIn" data-animation-delay="300">
									<span class="time-number">
										<span class="digit"><?php echo $tvol; ?></span>
									</span>
									<span class="time-name">Total Volunteers</span>
								</div><!-- /.time-circle -->
							</div><!-- /.col-md-3 -->

							<!-- <div class="col-xs-6 col-sm-4 col-md-4 from-bottom delay-600">
									<div class="time-circle dash hours_dash animated" data-animation="rollIn" data-animation-delay="600">
										<span class="time-number">
											<span class="digit">2</span><span class="digit">00</span>
										</span>
										<span class="time-name">Success Projects</span>
									</div>
								</div> -->
							<?php
							$h = 0;
							$m = 0;
							foreach ($reporttotal as $re) {

								$splt_admin_time = explode('.', $re['admin_time']);
								$h += $splt_admin_time[0];
								$m += $splt_admin_time[1];
							}
							$sss = $m % 60;
							$h += ($m - $sss) / 60;
							$totaltime = $h;
							$m = $sss . '';
							?>
							<div class="col-xs-6 col-sm-4 col-md-4 from-bottom delay-1000">
								<div class="time-circle dash minutes_dash animated" data-animation="rollIn" data-animation-delay="900">
									<span class="time-number">
										<span class="digit"><?php echo $totaltime; ?></span>
									</span>
									<span class="time-name">TOTAL HOURS</span>
								</div><!-- /.time-circle -->
							</div><!-- /.col-md-3 -->
							<div class="col-sm-2 col-md-2"></div>

						</div><!-- /.next-event-container -->

						<p class="event-btn-container">
							<a class="btn custom-btn angle-effect mt-2" href="<?php echo base_url(); ?>signup" style="color:#fff">Join Us</a>
							<a class="btn custom-btn angle-effect mt-2" href="#" data-toggle="modal" data-target="#myModal" style="color:#fff">List of Partners</a>
						</p>

						<!-- The Modal -->
						<div id="myModal" class="modal fade">
							<div class="modal-dialog modal-lg">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" style="text-align: center;"><b>List of Partners</b></h4>
									</div>
									<div class="modal-body">
										<table id="customers" class="table-responsive">
											<tr>
												<th style="text-align: center;">Sr.No</th>
												<th style="text-align: center;">Title</th>
												<!--<th style="text-align: center;">Email</th>
										<th style="text-align: center;">Contact</th>-->
												<th style="text-align: center;">Total Volunteers</th>
											</tr>
											<?php $count = 1;
											foreach ($dioceses as $key => $value1) {
											?>
												<tr>
													<td><?php echo $count++; ?></td>
													<td><?php echo $value1['name']; ?></td>
													<!--<td><?php echo $value1['email']; ?></td>
										<td><?php if ($value1['mobile'] != '') { ?>
										<?php echo $value1['mobile']; ?>
										<?php } else {
													echo 'N/A';
												} ?>
										</td>-->
													<td style="text-align:center"><?php echo $value1['tv']; ?></td>
												</tr>
											<?php $last =  $value1['dioceses_id'];
											} ?>

											<input type="text" style="display:none;" id="last" value="1" name="last" />


										</table>
										<center><button class="btn btn-primary" style="margin-top:2%;" type="button" onclick=" previous()"><i class="fa fa-refresh"></i> Previous</button><button class="btn btn-primary" style="margin-top:2%;" type="button" onclick="next()"><i class="fa fa-refresh"></i> Next</button></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>



					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.bg-parallax-overlay -->
		</div><!-- /.parallax-style -->
	</section><!-- /#next-event -->
	<!-- Next Event End -->



	<!-- Pricing Section -->
	<section>
		<div class="pricing-section" style="padding-bottom:30px;">
			<div class="gray-bg angular section-padding">
				<div class="top-angle" id="Guidelines">
				</div><!-- /.top-angle -->
				<div class="container">
					<h3 class="parallax-title content-title">
						Top Volunteers
					</h3>
					<div class="row">
						<div id="event_time_countdown1" class="next-event-container">
							<?php foreach ($rewardDetails as $key1 => $value1) {
								$userID =  $value1['userID'];
								$join_data = array(
									array(
										'table' => 'users',
										'fields' => array('firstName', 'lastName', 'mobile', 'email', 'userID'),
										'joinWith' => array('userID'),
										'where' => array(
											'userID' => $userID
										),
									),
								);
								$where = array();
								$limit = '';
								$order_by = '';
								$userDetails = $this->Curl_model->fetch_data_with_joining($join_data, $limit, $order_by);
							?>
								<div class="col-xs-6 col-sm-4 col-md-4 from-bottom delay-200">
									<div class="time-circle dash days_dash animated" data-animation="rollIn" data-animation-delay="300">
										<span class="time-number">
											<span class="digit"><img src="<?php echo base_url('web/'); ?>images/user.png" alt=""></span>
										</span>
										<span class="time-name content-title"><?php echo ucwords($userDetails[0]['firstName'] . ' ' . $userDetails[0]['lastName']); ?></span>
									</div>
								</div><!-- /.col-md-3 -->
							<?php  } ?>
						</div><!-- /.next-event-container -->
					</div><!-- /.row -->

				</div><!-- /.container -->
				<!-- /.bottom-angle -->
			</div><!-- ./gray-bg -->
		</div><!-- /.pricing-section -->
	</section><!-- /#pricing -->






	<!-- Services Section -->
	<section>
		<div class="services-section white-bg angular section-padding">
			<div class="top-angle" id="Expert">
			</div><!-- /.top-angle -->
			<div class="container">
				<div class="section-head" style="margin-bottom: 55px;">
					<h2 class="section-title1" style="color:#af0101; font-weight:bold;text-transform: capitalize;">
						Volunteering opportunities
					</h2>
					<!-- <p class="section-description">
							ALL OF OUR SERVICES IS CENTRALIZED TO THE WELFARE OF THE CHILDREN. WE SERVE THE CHILD WITH FOOD, EDUCATION, HABITATION, SAFETY AND EVERYTHING THE NEED. 
						</p> -->
				</div><!-- /.section-head -->

				<div class="section-content">
					<div class="row">
						<div class="col-md-4 from-bottom delay-200">
							<div class="service-box">
								<div class="hex service-icon-hex">
									<div class="service-icon">
										<span aria-hidden="true" class="li_star"></span>
									</div><!-- /.service-icon -->
								</div><!-- /.hex -->
								<h3 class="service-title content-title" title="<?php echo $recent_opp[0]['taskTitle'] ?>">
									<?php echo substr($recent_opp[0]['taskTitle'], 0, 40) . '...' ?>
								</h3><!-- /.service-title content-title -->
								<p class="service-description" title="<?php echo $recent_opp[0]['taskDescription'] ?>">
									<?php echo substr($recent_opp[0]['taskDescription'], 0, 100) . '...' ?>
								</p><!-- /.service-description -->


							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->

						<div class="col-md-4 from-bottom delay-600">
							<div class="service-box">
								<div class="hex service-icon-hex">
									<div class="service-icon">
										<span aria-hidden="true" class="li_lab"></span>
									</div><!-- /.service-icon -->
								</div><!-- /.hex -->
								<h3 class="service-title content-title" title="<?php echo $recent_opp[1]['taskTitle'] ?>">
									<?php echo substr($recent_opp[1]['taskTitle'], 0, 40) . '...' ?>
								</h3><!-- /.service-title content-title -->
								<p class="service-description" title="<?php echo $recent_opp[1]['taskDescription'] ?>">
									<?php echo substr($recent_opp[1]['taskDescription'], 0, 100) . '...' ?>
								</p><!-- /.service-description -->


							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->

						<div class="col-md-4 from-bottom delay-1000">
							<div class="service-box">
								<div class="hex service-icon-hex">
									<div class="service-icon">
										<span aria-hidden="true" class="li_world"></span>
									</div><!-- /.service-icon -->
								</div><!-- /.hex -->
								<h3 class="service-title content-title" title="<?php echo $recent_opp[2]['taskTitle'] ?>">
									<?php echo substr($recent_opp[2]['taskTitle'], 0, 40) . '...' ?>
								</h3><!-- /.service-title content-title -->
								<p class="service-description" title="<?php echo $recent_opp[2]['taskDescription'] ?>">
									<?php echo substr($recent_opp[2]['taskDescription'], 0, 100) . '...' ?>
								</p><!-- /.service-description -->


							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->
					</div><!-- /.row -->
				</div><!-- /.section-content -->
			</div><!-- /.container-->
		</div><!-- /.services-section -->
	</section><!-- /#services -->
	<!--Services Section End-->

	<!-- Pricing Section -->
	<section>
		<div class="pricing-section" style="padding-bottom:30px;">
			<div class="gray-bg angular section-padding">
				<div class="top-angle" id="Guidelines">
				</div><!-- /.top-angle -->
				<div class="container">
					<div class="row">
						<div class="section-content">
							<div class="col-md-3 from-bottom delay-200">
								<div class="content-box">
									<div class="hex content-icon-hex hex-margin" style="margin: 30px auto;margin-bottom:60px;">
										<div class="content-icon">
											<span aria-hidden="true" class="li_banknote"></span>
										</div>
									</div><!-- /.content-icon-hex -->
									<style>
										@media (min-width:320px) {

											.navbar-fixed-top,
											.navbar-fixed-bottom {
												position: absolute;
											}

											.btn {
												color: #000;
											}

											.mob-title {
												font-size: 1em;
											}

											.section-head {
												margin-bottom: 20px;
											}
										}

										@media (min-width:420px) {

											.navbar-fixed-top,
											.navbar-fixed-bottom {
												position: absolute;
											}

											.btn {
												color: #000;
											}

											.mob-title {
												font-size: 1em;
											}

											.section-head {
												margin-bottom: 20px;
											}
										}

										// Small devices (landscape phones, 576px and up)
										@media (min-width: 576px) {
											#content-title {
												text-align: left !important;
											}

											#item-footer {
												text-align: left !important;
											}

											.navbar-fixed-top,
											.navbar-fixed-bottom {
												position: absolute;
											}

											.mob-title {
												font-size: 1em;
											}

											.section-head {
												margin-bottom: 20px;
											}
										}

										// Medium devices (tablets, 768px and up)
										@media (min-width: 768px) {
											#content_title {
												text-align: left !important;
											}

											#item_footer {
												text-align: left !important;
											}

											.mob-title {
												font-size: 1em;
											}

											.section-head {
												margin-bottom: 20px;
											}
										}

										// Large devices (desktops, 992px and up)
										@media (min-width: 992px) {
											#content_title {
												text-align: left !important;
											}

											#item_footer {
												text-align: left !important;
											}

											.mob-title {
												font-size: 1em;
											}

											.section-head {
												margin-bottom: 20px;
											}
										}

										// Extra large devices (large desktops, 1200px and up)
										@media (min-width: 1200px) {
											#content_title {
												text-align: left !important;
											}

											#item_footer {
												text-align: left !important;
											}

										}
									</style>
									<center>
										<h3 class="content-title" id="content_title">
											Volunteering Opportunities
										</h3><!-- /.content-title -->
										<div class="item-footer" id="item_footer">
											<a href="<?php echo base_url(); ?>signup" class="btn custom-btn angle-effect">Sign Up</a>
										</div>
									</center>
								</div><!-- /.content-box -->
							</div><!-- /.col-md-4 -->

							<div class="col-md-9 from-right delay-200">
								<div class="pricing-table">

									<div class="pricing-item" style="width: 100% !important;padding:10px;">
										<div class="item-head">
											<span class="item-name">Guidelines</span>
											<!-- <span class="item-currency">$</span><span class="item-price">35</span>  -->
										</div><!-- /.item-head -->
										<p>
											Volunteers are expected to support the vision, mission, values, and ethics as specified in the volunteer guidebook of Caritas India in delivering of services.
										</p>
										<p>
											Volunteers are expected to participate in training and development opportunities provided by Caritas India.
										</p>
										<p>
											Volunteers are expected not to use their role within the organization to receive preferential treatment when seeking services for themselves, family, or friends..
										</p>
										<p>
											Depending upon the need of the organization and nature of involvement of the volunteer, separate agreement will be made with specific terms and conditions.
										</p>
										<!-- <ul class="item-description">
												<li>First Description</li>
												<li>Second Description</li>
												<li>Third Description</li>
												<li>Fourth Description</li>
											</ul> -->

									</div><!-- /.pricing-item -->

								</div><!-- /.pricing-table -->
							</div><!-- /.col-md-8 -->
						</div><!-- /.section-content -->
					</div><!-- /.row -->

				</div><!-- /.container -->
				<!-- /.bottom-angle -->
			</div><!-- ./gray-bg -->
		</div><!-- /.pricing-section -->
	</section><!-- /#pricing -->
	<!-- Pricing Section End -->
	<!-- Pricing Section -->

	<!-- Pricing Section End -->

	<section>
		<div class="services-section white-bg angular section-padding">
			<div class="top-angle" id="Badges">
			</div><!-- /.top-angle -->
			<div class="container">
				<div class="section-head" style="margin-bottom: 55px;">
					<h2 class="section-title1" style="color:#af0101; font-weight:bold;text-transform: capitalize;">
						Volunteer Badges
					</h2>
					<!-- <p class="section-description">
					ALL OF OUR SERVICES IS CENTRALIZED TO THE WELFARE OF THE CHILDREN. WE SERVE THE CHILD WITH FOOD, EDUCATION, HABITATION, SAFETY AND EVERYTHING THE NEED. 
				</p> -->
				</div><!-- /.section-head -->

				<div class="section-content">
					<div class="row">
						<style>
							.service-description {
								text-transform: capitalize;
							}
						</style>
						<div class="col-md-3 from-bottom delay-200">
							<div class="service-box">
								<div class="hex service-icon-hex">
									<div class="service-icon">
										<!-- <span aria-hidden="true" class="li_star"></span> -->
										<i class="fa fa-certificate" style="font-size: 50px;"></i>
									</div><!-- /.service-icon -->
								</div><!-- /.hex -->
								<h3 class="service-title content-title">
									Pluto Badge
								</h3><!-- /.service-title content-title -->
								<p class="service-description">
									<center>
										<h5 style="color: #8e2c24; font-weight: bold;" title="Completion of 100 volunteering hours with Caritas India">
											Completion of 100 volunteering hours with Caritas India
										</h5>
									</center>
								<table class="table table1">
									<tr>
										<td>-</td>
										<td>
											Digital certificate of Appreciation
										</td>
									</tr>

								</table>
								</p><!-- /.service-description -->

							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->

						<div class="col-md-3 from-bottom delay-200">
							<div class="service-box">
								<div class="hex service-icon-hex">
									<div class="service-icon">
										<i class="fa fa-certificate" style="font-size: 50px;"></i>
									</div><!-- /.service-icon -->
								</div><!-- /.hex -->
								<h3 class="service-title content-title">
									Neptune Badge
								</h3><!-- /.service-title content-title -->
								<p class="service-description">
									<center>
										<h5 style="color: #8e2c24; font-weight: bold;" title="Completion of 250 volunteering hours with Caritas India">
											Completion of 250 volunteering hours with Caritas India
										</h5>
									</center>
								<table class="table table1">
									<tr>
										<td>-</td>
										<td>
											Digital certificate of Appreciation
										</td>
									</tr>
									<tr>
										<td>-</td>
										<td>
											Featuring in Caritas India Newsletter
											<a id="s_show_a" onclick="show_table('s_table','s_show_a');">Show More</a>
										</td>
									</tr>
								</table>
								<table class="table table1" id="s_table" style="margin-top: -20px; display:none;">
									<tr>
										<td>-</td>
										<td>
											Social Media feature on Caritas India Social media platforms
											<a id="s_hide_a" onclick="hide_table('s_table','s_show_a');">Show Less</a>
										</td>
									</tr>

								</table>
								</p><!-- /.service-description -->

							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-3 from-bottom delay-200">
							<div class="service-box">
								<div class="hex service-icon-hex">
									<div class="service-icon">
										<i class="fa fa-certificate" style="font-size: 50px;"></i>
									</div><!-- /.service-icon -->
								</div><!-- /.hex -->
								<h3 class="service-title content-title">
									Mars Badge
								</h3><!-- /.service-title content-title -->
								<p class="service-description">
									<center>
										<h5 style="color: #8e2c24; font-weight: bold;" title="Completion of 500 volunteering hours with Caritas India">
											Completion of 500 volunteering hours with...
										</h5>
									</center>
									<style>
										.table1>tbody>tr>td {
											padding: 5px;
											border-top: 0px solid #ddd !important;
										}
									</style>
								<table class="table table1">
									<tr>
										<td>-</td>
										<td>
											Digital certificate of Appreciation
										</td>
									</tr>
									<tr>
										<td>-</td>
										<td>
											Featuring in Caritas India Newsletter
											<a id="g_show_a" onclick="show_table('g_table','g_show_a');">Show More</a>
										</td>
									</tr>
								</table>
								<table class="table table1" id="g_table" style="margin-top: -20px; display:none;">
									<tr>
										<td>-</td>
										<td>
											Social Media feature on Caritas India Social media platforms
										</td>
									</tr>
									<tr>
										<td>-</td>
										<td>
											Feature on Caritas India’s website as a star volunteer
											<a id="g_hide_a" onclick="hide_table('g_table','g_show_a');">Show Less</a>
										</td>
									</tr>
								</table>

								</p><!-- /.service-description -->

							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-3 from-bottom delay-200">
							<div class="service-box">
								<div class="hex service-icon-hex">
									<div class="service-icon">
										<i class="fa fa-certificate" style="font-size: 50px;"></i>
									</div><!-- /.service-icon -->
								</div><!-- /.hex -->
								<h3 class="service-title content-title">
									Venus Badge
								</h3><!-- /.service-title content-title -->
								<p class="service-description">
									<center>
										<h5 style="color: #8e2c24; font-weight: bold;" title="Completion of 4000 volunteering hours with Caritas India">
											Completion of 4000 volunteering hours with...
										</h5>
									</center>
								<table class="table table1">
									<tr>
										<td>-</td>
										<td>
											Digital certificate of Appreciation
										</td>
									</tr>
									<tr>
										<td>-</td>
										<td>
											Featuring in Caritas India Newsletter
											<a id="p_show_a" onclick="show_table('p_table','p_show_a');">Show More</a>
										</td>
									</tr>
								</table>
								<table class="table table1" id="p_table" style="margin-top: -20px; display:none;">
									<tr>
										<td>-</td>
										<td>
											Social Media feature on Caritas India Social media platforms
										</td>
									</tr>
									<tr>
										<td>-</td>
										<td>
											Feature on Caritas India’s website as a star volunteer
										</td>
									</tr>
									<tr>
										<td>-</td>
										<td>
											Endorsement from Celebrity Volunteer
											<a id="p_hide_a" onclick="hide_table('p_table','p_show_a');">Show Less</a>
										</td>
									</tr>
								</table>
								</p><!-- /.service-description -->

							</div><!-- /.service-box -->
						</div><!-- /.col-md-4 -->
					</div><!-- /.row -->
				</div><!-- /.section-content -->
			</div><!-- /.container-->
		</div><!-- /.services-section -->
	</section><!-- /#services -->



	<section id="contact">
		<div class="contact-section angular gray-bg section-padding">
			<div class="top-angle" id="">
			</div><!-- /.top-angle -->
			<div class="container">
				<div class="section-head">
					<h2 class="section-title">
						Contact
					</h2>
					<p class="section-description">
						For further query reach us at.
					</p>
				</div><!-- /.section-head -->
			</div><!-- /.container -->

			<div class="container">
				<div class="row">
					<!--<div class="col-md-4">
							<div class="contact-form-container">
								<h3 class="content-title">
									Quick Contact
								</h3>

								<form class="contact-form" id="" action="<?php echo base_url('inquiry'); ?>" method="post">
									<div id="name_error" class="error">
										<img src="<?php echo base_url('web/'); ?>assets/images/email/error.png" alt="Error!">
										Please enter your name.
									</div>
									<div class="input-container li_user">
										<input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
									</div>

									<div id="email_error" class="error">
										<img src="<?php echo base_url('web/'); ?>assets/images/email/error.png" alt="Error!">
										Please enter your valid E-mail ID.
									</div>
									<div class="input-container li_mail">
										<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
									</div>

									<div id="message_error" class="error">
										<img src="<?php echo base_url('web/'); ?>assets/images/email/error.png" alt="Error!">
										Please enter your message.
									</div>
									<div class="input-container li_pen">
										<textarea class="form-control" id="message" name="message" required cols="45" placeholder="Message" rows="4"></textarea>
									</div>
									<div class="row">
										<div class="col-md-6">
										<div class="input-container">
										<input type="text" class="form-control" name="captcha" id="captcha" value="<?php echo rand(1000, 9999) ?>" readonly>
										</div>
										</div>
										<div class="col-md-6">
										<div class="input-container">
										<input type="text" class="form-control" name="rcaptcha" id="rcaptcha" placeholder="Enter Captcha" required>
										</div>
										</div>
									</div>
									<div id="mail_success" class="success">
										<img src="<?php echo base_url('web/'); ?>assets/images/email/success.png" alt="Success!">
										Your message has been sent successfully.
									</div>

									<div id='mail_fail' class='error'>
										<img src="<?php echo base_url('web/'); ?>assets/images/email/error.png" alt="Error!"> Sorry, error occured this time sending your message.
									</div>

									<button type="submit" id="submit_btn" class="btn custom-btn angle-effect" onclick=" check_captcha()">Submit</button>
									<?php echo $this->session->flashdata('sendmsg'); ?>
								</form>

							</div>
						</div> -->

					<div class="col-md-12">
						<div class="col-md-6">
							<div class="contact-info">
								<h3 class="content-title">
									Contact Info
								</h3>
								<!-- <p class="content-description">
									If you need more charity website templates or this charity website template contact with us. We will help you to make successful any of your charity works. Feel free to contact with us through mail address.
								</p> -->
								<address>
									<ul class="contact-address">
										<li class="fa-map-marker">
											Caritas India Headquarter: Caritas India, CBCI Centre,<br> Ashok Place, Opposite to Goledakkhana, <br>New Delhi - 11 00 01, India
										</li>
										<li class="fa-phone">
											91 -11 - 2336 3390 / 2374 23 39
										</li>
										<li class="fa-envelope">
											volunteer@caritasindia.org
										</li>
									</ul><!-- /.contact-address -->
								</address>
							</div><!-- /.contact-info -->
						</div>
						<div class="col-md-6">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.0603503840675!2d77.20377221455949!3d28.627953291040136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd4dffce1a87%3A0xcc69c33d619fb12a!2sCaritas%20India!5e0!3m2!1sen!2sin!4v1601284919797!5m2!1sen!2sin" width="100%" height="350" frameborder="0" tabindex="0"></iframe>
						</div>
					</div><!-- /.col-md-6 -->

				</div><!-- /.row -->
			</div><!-- /.container -->
			<div class="bottom-angle">
			</div>
			<!-- /.bottom-angle -->
		</div><!-- /.contact-section -->
	</section><!-- /#contact -->
	<!-- Contact Section End -->




	<!-- Google Map Section -->
	<div id="google-map">
		<div class="map-container" style="margin-bottom: 70px;">
			<!-- <div id="googleMaps" class="google-map-container"></div> -->
		</div>
	</div><!-- /#google-map-->
	<!-- Google Map Section End -->




	<!-- Scroll to Top -->
	<div id="scroll-to-top">
		<div class="hex scroll-top">
			<span><i class="fa fa-chevron-up"></i></span>
		</div>
	</div><!-- /#scroll-to-top -->
	<!-- Scroll to Top End-->




	<!-- Footer Section -->
	<footer id="footer-section">
		<div class="footer-section">
			<div class="container">
				<div class="footer-social-btn pull-right">
					<a href="https://twitter.com/Caritas_India" class="twitter-btn"><i class="fa fa-twitter"></i></a>
					<a href="https://www.facebook.com/CaritasIndia" class="facebook-btn"><i class="fa fa-facebook"></i></a>
					<!-- <a href="#" class="github-btn"><i class="fa fa-github-alt"></i></a>
						<a href="#" class="vimeo-btn"><i class="fa fa-vimeo-square"></i></a>
						<a href="#" class="pinterest-btn"><i class="fa fa-pinterest"></i></a> 
						<a href="#" class="google-plus-btn"><i class="fa fa-google-plus"></i></a>-->
					<a href="https://www.youtube.com/user/CaritasIndia1962" class="youtube-btn"><i class="fa fa-youtube"></i></a>
					<!-- <a href="#" class="dribbble-btn"><i class="fa fa-dribbble"></i></a> -->
					<a href="#" class="linkedin-btn"><i class="fa fa-linkedin"></i></a>
				</div><!-- /.footer-social-btn -->
				<div class="copyrights pull-left">
					&copy; <a href="#">Caritas India</a> 2019 - <?php echo date('Y'); ?>, All Rights Reserved, Developed by <a href="https://www.neuralinfo.in/">Neural Info Solutions Pvt. Ltd.</a>
				</div><!-- /.copyrights -->


			</div><!-- /.container -->
		</div><!-- /.footer-section -->
	</footer><!-- /#footer-section -->
	<!-- Footer Section End -->



	<!-- Include jquery.min.js plugin -->
	<script src="<?php echo base_url('web/'); ?>assets/js/jquery-2.1.0.min.js"></script>

	<!-- Include email-validation.js Email Validator -->
	<script src="<?php echo base_url('web/'); ?>assets/js/email-validation.js"></script>

	<script src="<?php echo base_url('web/'); ?>assets/js/jquery.visible.min.js"></script>

	<!-- included plugins inside  plugins.js -->
	<script src="<?php echo base_url('web/'); ?>assets/js/plugins.js"></script>

	<!-- included plugins inside  plugins.js -->
	<script src="<?php echo base_url('web/'); ?>assets/js/jquery.parallax.js"></script>

	<!-- Include functions.js -->
	<script src="<?php echo base_url('web/'); ?>assets/js/functions.js"></script>

	<!-- Google Maps Script  -->
	<script src="https://maps.google.com/maps/api/js?sensor=true"></script>

	<!-- Gmap3.js For Static Maps -->
	<script src="<?php echo base_url('web/'); ?>assets/js/gmap3.js"></script>

	<script type="text/javascript">
		/*---------------------- Current Menu Item -------------------------*/
		jQuery(document).ready(function($) {
			"use strict";

			$('#main-menu #headernavigation').onePageNav({
				currentClass: 'active',
				changeHash: false,
				scrollSpeed: 750,
				scrollThreshold: 0.5,
				scrollOffset: 60,
				filter: '',
				easing: 'swing'
			});

			$('#event_time_countdown').countDown({
				targetDate: {
					'day': 23,
					'month': 9,
					'year': 2020,
					'hour': 0,
					'min': 0,
					'sec': 0
				},
				omitWeeks: true
			});


			/*----------- Google Map - with support of gmaps.js ----------------*/
			function isMobile() {
				return ('ontouchstart' in document.documentElement);
			}

			function init_gmap() {
				if (typeof google == 'undefined') return;
				var options = {
					center: [23.709921, 90.407143],
					zoom: 15,
					mapTypeControl: true,
					mapTypeControlOptions: {
						style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
					},
					navigationControl: true,
					scrollwheel: false,
					streetViewControl: true
				}

				if (isMobile()) {
					options.draggable = false;
				}

				$('#googleMaps').gmap3({
					map: {
						options: options
					},
					marker: {
						latLng: [23.709921, 90.407143],
						options: {
							icon: '<?php echo base_url('web/'); ?>assets/images/mapicon.png'
						}
					}
				});
			}

			init_gmap();

		});

		function show_table(table_id, anchor_id) {
			document.getElementById(table_id).style.display = "block";
			document.getElementById(anchor_id).style.display = "none";
		}

		function hide_table(table_id, anchor_id) {
			document.getElementById(table_id).style.display = "none";
			document.getElementById(anchor_id).style.display = "inline";
		}
	</script>


	<script type="text/javascript">
		function next() {
			var HiddenFiledID;
			HiddenFiledID = document.getElementById('last').value;
			document.getElementById("last").value = parseInt(HiddenFiledID) + 10;
			HiddenFiledID = document.getElementById('last').value;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					document.getElementById("customers").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "dioceses-load/" + HiddenFiledID, true);
			xhttp.send();
		}

		function previous() {
			var HiddenFiledID;
			HiddenFiledID = document.getElementById('last').value;
			document.getElementById("last").value = parseInt(HiddenFiledID) - 10;
			HiddenFiledID = document.getElementById('last').value;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("customers").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "dioceses-load/" + HiddenFiledID, true);
			xhttp.send();
		}

		function check_captcha() {
			var captch = document.getElementById('captcha').value;
			var rcaptch = document.getElementById('rcaptcha').value;
			if (captch !== rcaptch) {
				return false;
			}

		}
	</script>
</body>

</html>