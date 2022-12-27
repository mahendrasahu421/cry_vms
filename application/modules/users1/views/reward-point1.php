<style>
.canvasjs-chart-credit{display:none!important;}
.knob-icon i {
    top: 10px;
left: 12px;}
</style>

<div class="pcoded-main-container">
<div class="pcoded-content">

<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-header-title">
<h5 class="m-b-10">Rewards Points</h5>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><i class="fa fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#!">Rewards Points</a></li>
</ul>
</div>
</div>
</div>
</div>


<div class="row">
<?php $phours=0;
	  $pmint=0;
 foreach($report as $re){
	$encoded_id=rtrim(strtr(base64_encode($re['dailyReportID']), '+/', '-_'), '='); 
	$timeIn= $re['dailyReportTimeIn'];
	$time = date('h:i A', strtotime($timeIn));
	$timeOut= $re['dailyReportTimeOut'];
	$time1 = date('h:i A', strtotime($timeOut));
	
	$diff = abs(strtotime($time) - strtotime($time1));
	$tmins = $diff/60;
	$hours = floor($tmins/60);
	$mins = $tmins%60;
	$phours+= $hours+$mi;
	$pmint+= $mins;
	$mi = floor($pmint/60);
	$tmin=$pmint%60;
	
}?>
<div class="col-lg-4 col-md-6">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#f95476" data-thickness=".2" value="85" />
<i class="fa fa-hdd-o text-danger"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">BRONZE BADGE</h2>
<h6 class="text-muted m-b-0"><?php echo "$phours Hours";?> / 100 Hours</h6>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-4 col-md-6">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#4886ff " data-thickness=".2" value="40" />
<i class="fa fa-spinner f-24 text-primary"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">SILVER BADGE</h2>
<h6 class="text-muted m-b-0"><?php echo "$phours Hours";?> / 250 Hours</h6>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-4 col-md-12">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-3 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#8e2c24" data-thickness=".2" value="89" />
<i class="fa fa-repeat f-24 text-warning"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">GOLD BADGE</h2>
<h6 class="text-muted m-b-0"><?php echo "$phours Hours";?> / 500 Hours</h6>
</div>
</div>
</div>
</div>
</div>

</div>




<div class="row">

<div class="col-lg-8 col-md-12">
<div class="card panel-main o-income panel-refresh">
<div class="refresh-container">
<div class="preloader">
<div class="loader">
</div>
</div>
</div>
<div class="card-body panel-wrapper">
<div class="d-flex m-b-10 no-block">
<h5 class="card-title m-b-0 align-self-center">Working Hours</h5>
</div>
<!--<ul class="list-inline m-b-30 text-uppercase lp-5 font-medium font-12">
<li class="list-inline-item"><i class="fa fa-square m-r-5 text-warning"></i> Total</li>
<li class="list-inline-item"><i class="fa fa-square m-r-5 text-danger"></i> Used</li>
<li class="list-inline-item"><i class="fa fa-square m-r-5 text-primary"></i> Free</li>
</ul>-->
<script type="text/javascript">
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1", // "light2", "dark1", "dark2"
	animationEnabled: false, // change to true		
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "column",
		dataPoints: [
			{ label: "BRONZE BADGE",  y: 100  },
			{ label: "SILVER BADGE", y: 250  },
			{ label: "GOLD BADGE", y: 500  },
			{ label: "PLATINUM BADGE",  y: 4000  },
		]
	}
	]
});
chart.render();
}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>

<!--<div id="memory_usage" style="height:260px; width:100%;"></div>-->
</div>
</div>
</div>


<div class="col-lg-4 col-md-12">
<div class="card">
<div class="card-body p-b-30">
<div class="d-flex pt-3 p-b-20 no-block">
<div class="align-self-center mr-auto">
<h2 class="m-b-0 text-uppercase f-16 font-medium lp-5">Average Working Hours</h2>
<h6 class="text-muted m-b-0 text-center mt-2"><i class="fa fa-clock"></i> <?php echo "$phours Hours $tmin mins";?></h6>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body p-b-30">
<div class="p-t-20">
<h2 class="m-b-0 text-uppercase f-16 font-medium lp-5  float-left">Downlod Certificate</h2>
<h6 class="m-b-0 float-right text-center" data-toggle="tooltip" data-placement="bottom" title="Certificate Download"><i class="fa fa-download"></i></h6>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>

</div>



</div>
</div>
