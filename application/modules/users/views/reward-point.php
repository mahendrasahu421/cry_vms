<style>
.highcharts-credits{display:none!important;}
.knob-icon i {
    top: 10px;
left: 12px;
}
.highcharts-title{display:none!important;}
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
<?php //$phours=0;
	 //$pmint=0;
 //foreach($report as $re){
	//$encoded_id=rtrim(strtr(base64_encode($re['dailyReportID']), '+/', '-_'), '='); 
	//$timeIn= $re['dailyReportTimeIn'];
	//$time = date('h:i A', strtotime($timeIn));
	//$timeOut= $re['dailyReportTimeOut'];
	//$time1 = date('h:i A', strtotime($timeOut));
	
	//$diff = abs(strtotime($time) - strtotime($time1));
	//$tmins = $diff/60;
	//$hours = floor($tmins/60);
	//$mins = $tmins%60;
	//$phours+= $hours+$mi;
	//$pmint+= $mins;
	//$mi = floor($pmint/60);
	//$tmin=$pmint%60;
	
//}
?>
<?php $totaltime=0 .' '.'Hours';
 foreach($reporttotal as $re){
	 $totaltime += $re['admin_time'];
	 
}
$c=1;
$reward_user_count_by_month1 = '0.0';
foreach($reward_user_count_by_month as $revv){
	if(sizeof($reward_user_count_by_month)==$c)
	{
		$reward_user_count_by_month1 = $revv;
	}
	$c++;
	
}
//$reward_user_count_by_month1 = krsort($reward_user_count_by_month);
?>
<?php $time_splt = explode('.',$reward_user_count_by_month1);?> 


<div class="col-lg-3 col-md-6">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-2 knob-icon">
<?php if($time_splt[0]>=100){ ?>
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#f95476" data-thickness=".2" value="500" />
<?php } else {?>
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#f95476" data-thickness=".2" value="<?php  echo $time_splt[0] ;?>" />
<?php } ?>
<i class="fa fa-hdd-o text-danger"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">PLUTO BADGE</h2>
<h6 class="text-muted m-b-0">
<?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?> / 100 Hours</h6>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-3 col-md-6">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-2 knob-icon knob-icon-2">
<?php if($time_splt[0]>=250){ ?>
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#4886ff " data-thickness=".2" value="500" />
<?php } else { ?>
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#4886ff " data-thickness=".2" value="<?php  echo $time_splt[0] ;?>" />
<?php } ?>
<i class="fa fa-spinner f-24 text-primary"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">NEPTUNE BADGE</h2>
<h6 class="text-muted m-b-0"><?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?> / 250 Hours</h6>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-3 col-md-12">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-2 knob-icon knob-icon-2">
    <?php if($time_splt[0]>=500){ ?>
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#8e2c24" data-thickness=".2" value="500" />
<?php } else {?>
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#8e2c24" data-thickness=".2" value="<?php  echo $time_splt[0] ;?>" />
<?php } ?>
<i class="fa fa-repeat f-24 text-warning"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">MARS BADGE</h2>
<h6 class="text-muted m-b-0"><?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?> / 500 Hours</h6>
</div>
</div>
</div>
</div>
</div>

<div class="col-lg-3 col-md-12">
<div class="card">
<div class="card-body">
<div class="d-flex pt-3 pb-2 no-block">
<div class="align-self-center mr-2 knob-icon knob-icon-2">
<input class="dial" data-plugin="knob" data-width="40" data-height="40" data-linecap="round" data-fgColor="#f95476" data-thickness=".2" value="<?php  echo $time_splt[0] ;?>" />
<i class="fa fa-repeat f-24 text-danger"></i> </div>
<div class="align-slef-center mr-auto">
<h2 class="m-b-0 text-uppercase f-18 font-medium lp-5">VENUS BADGE</h2>
<h6 class="text-muted m-b-0"><?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?> / 4000 Hours</h6>
</div>
</div>
</div>
</div>
</div>

</div>




<div class="row">

<div class="col-lg-8 col-md-12">
<?php //print_r($reward_user_count); ?>
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

<div class="card-body">
 <div id="chart-highchart-bar123" style="width: 100%; height: 420px;"></div>
</div>

<!--<ul class="list-inline m-b-30 text-uppercase lp-5 font-medium font-12">
<li class="list-inline-item"><i class="fa fa-square m-r-5 text-warning"></i> Total</li>
<li class="list-inline-item"><i class="fa fa-square m-r-5 text-danger"></i> Used</li>
<li class="list-inline-item"><i class="fa fa-square m-r-5 text-primary"></i> Free</li>
</ul>
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
			{ label: "VENUS BADGE",  y: 4000  },
		]
	}
	]
});
chart.render();
}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>

<div id="memory_usage" style="height:260px; width:100%;"></div>-->
</div>
</div>
</div>


<div class="col-lg-4 col-md-12">
<div class="card">
<div class="card-body p-b-30">
<div class="d-flex pt-3 p-b-20 no-block">
<div class="align-self-center mr-auto">
<h2 class="m-b-0 text-uppercase f-16 font-medium lp-5">Total Working Hours</h2>
<h6 class="text-muted m-b-0 text-center mt-2"><i class="fa fa-clock"></i> <?php $time_splt = explode('.',$reward_user_count_by_month1)	; echo $time_splt[0].' Hours '.$time_splt[1].' Mins' ;?></h6>
</div>
</div>
</div>
</div>
<!--<div class="card">
<div class="card-body p-b-30">
<div class="p-t-20">
<h2 class="m-b-0 text-uppercase f-16 font-medium lp-5  float-left">Download Certificate</h2>
<h6 class="m-b-0 float-right text-center" data-toggle="tooltip" data-placement="bottom" title="Certificate Download">
   <style>
       a.disabled {
  pointer-events: none;
  cursor: default;
}
.image {
   position: relative;
}

.text {
   position: absolute;
       top: 69px;
    left: 0;
    width: 100%;
    margin: 0 auto;
    width: 200px;
    height: 35px;
}
.text1 {
   position: absolute;
    top: 8px;
    left: 7;
    width: 100%;
    margin: 0 auto;
    width: 200px;
    height: 35px;}
   </style> 
<?php  $userDetails[0]['firstName'];
$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;

if($time_splt[0]==100){ 
    echo "<div class='image'>";
    echo '<img src="users/Caritas Samaritan certificate.jpg" alt="Certificate"  width="200px" height="150px"/>';
    echo '<div class="text" style="position:absolute">'. $userDetails[0]['firstName'] .' '. $userDetails[0]['lastName'] .'</div>';
    echo '<div class="text1">'. $time_splt[0] .'</div>';
   
    echo "<div><a href='users/Caritas Samaritan certificate.jpg' target='_blank'/><i class='fa fa-download'></i></a></div>";
    '</div>';
?> 
<a href="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" />
<img src="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" alt="Certificate" value="<?php echo $userDetails[0]['firstName'];?>" width="200px" height="150px"/><i class="fa fa-download"></i></a> 
<?php } else { echo '<b style="color:#f00;">your working hour is not complete</b>'; }?>
   
<?php ?>    
    
    </h6>
<div class="clearfix"></div>
</div>
</div>
</div>-->
</div>

</div>

	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!--<script src="//files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-alpha1/html2canvas.js">
</script>



<div class="col-md-12">
<div class="card">
<div class="card-body p-b-30">
<div class="p-t-20">
<h2 class="m-b-0 text-uppercase f-16 font-medium lp-5 w-100 float-left">Download Certificate</h2><br>
<h5 style="color:#f00">*Step 1- Click to Preview Button <br>
                        Step 2- Click Download the Certificate</h5>
<input id="btn-Preview-Image" type="button" class="btn btn-danger pull-right float-left" value="Preview" />
          
    <a id="btn-Convert-Html2Image" class="btn btn-danger  pull-right" href="#"> 
        Download 
    </a> 
  
    <br/> <br>
<?php
$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;

if($time_splt[0]>=100){ ?>
<h4>Pluto Badge Certificate</h4> 
 <h4>Preview Certificate :</h4> 
      
    <div id="previewImage"></div>
<hr><br>  <?php
    echo "<div class='image' id='printMe'>";
    echo '<img src="users/Caritas Samaritan certificate.jpg" alt="Certificate"  width="800px" height="550px"/>';
    echo '<div class="texta" style="position:absolute">'. $userDetails[0]['firstName'] .' '. $userDetails[0]['lastName'] .'</div>';
    echo '<div class="textb">100</div>';
    '</div>';
?> 

<!--<a href="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" />
<img src="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" alt="Certificate" value="<?php //echo $userDetails[0]['firstName'];?>" width="200px" height="150px"/><i class="fa fa-download"></i></a> -->
<?php } else { echo '<b style="color:#f00;">your working hour is not complete</b>'; }?>
  
<br>

<script>
	function printDiv(printMe){
		var printContents = document.getElementById(printMe).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>

<script> 
        $(document).ready(function() { 
            // Global variable 
            var element = $("#printMe");  
            // Global variable 
            var getCanvas;  
           $("#btn-Preview-Image").on('click', function() { 
                html2canvas(element, { 
                    onrendered: function(canvas) { 
                        $("#previewImage").append(canvas); 
                        getCanvas = canvas; 
                    } 
                }); 
            }); 

            $("#btn-Convert-Html2Image").on('click', function() { 
                var imgageData =  
                    getCanvas.toDataURL("image/png"); 
                var newData = imgageData.replace( 
                /^data:image\/png/, "data:application/octet-stream"); 
              
                $("#btn-Convert-Html2Image").attr("download", "Pluto Badge Certificate.png").attr("href", newData); 
            }); 
        }); 
    </script> 
 </div>
 </div>
 </div>
 </div></div>
 
 <div class="clearfix"></div>
 
 <?php
$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;

if($time_splt[0]>=250){ ?>
<div class="col-md-12">
<div class="card">
<div class="card-body p-b-30">
<div class="p-t-20">
    <input id="btn-Preview-Image1" type="button" class="btn btn-danger pull-right float-left" value="Preview" />
          
    <a id="btn-Convert-Html2Image1" class="btn btn-danger  pull-right" href="#"> 
        Download 
    </a> 
  
    <br/> <br>

<h3>Neptune Badge Certificate</h3>   
 <h3>Preview Certificate :</h3> 
      
    <div id="previewImage1"></div>
<hr><br>  <?php
    echo "<div class='image' id='printMe1'>";
    echo '<img src="users/Caritas Samaritan certificate.jpg" alt="Certificate"  width="800px" height="550px"/>';
    echo '<div class="texta" style="position:absolute">'. $userDetails[0]['firstName'] .' '. $userDetails[0]['lastName'] .'</div>';
    echo '<div class="textb">250</div>';
    '</div>';
?> 

<!--<a href="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" />
<img src="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" alt="Certificate" value="<?php //echo $userDetails[0]['firstName'];?>" width="200px" height="150px"/><i class="fa fa-download"></i></a> -->


<script>
	function printDiv(printMe1){
		var printContents = document.getElementById(printMe1).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>

<script> 
        $(document).ready(function() { 
            // Global variable 
            var element = $("#printMe1");  
            // Global variable 
            var getCanvas;  
           $("#btn-Preview-Image1").on('click', function() { 
                html2canvas(element, { 
                    onrendered: function(canvas) { 
                        $("#previewImage1").append(canvas); 
                        getCanvas = canvas; 
                    } 
                }); 
            }); 

            $("#btn-Convert-Html2Image1").on('click', function() { 
                var imgageData =  
                    getCanvas.toDataURL("image/png"); 
                var newData = imgageData.replace( 
                /^data:image\/png/, "data:application/octet-stream"); 
              
                $("#btn-Convert-Html2Image1").attr("download", "Neptune Badge Certificate.png").attr("href", newData); 
            }); 
        }); 
    </script> 

</div>
</div>
</div>
</div>
<?php } else { echo '<b style="color:#f00;"></b>'; }?>  



<?php
$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;

if($time_splt[0]>=500){ ?>
<div class="col-md-12">
<div class="card">
<div class="card-body p-b-30">
<div class="p-t-20">
    <input id="btn-Preview-Image2" type="button" class="btn btn-danger pull-right float-left" value="Preview" />
          
    <a id="btn-Convert-Html2Image2" class="btn btn-danger  pull-right" href="#"> 
        Download 
    </a> 
  
    <br/> <br>

<h3>Marse Badge Certificate</h3>   
 <h3>Preview Certificate :</h3> 
      
    <div id="previewImage2"></div>
<hr><br>  <?php
    echo "<div class='image' id='printMe2'>";
    echo '<img src="users/Caritas Samaritan certificate.jpg" alt="Certificate"  width="800px" height="550px"/>';
    echo '<div class="texta" style="position:absolute">'. $userDetails[0]['firstName'] .' '. $userDetails[0]['lastName'] .'</div>';
    echo '<div class="textb">500</div>';
    '</div>';
?> 

<!--<a href="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" />
<img src="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" alt="Certificate" value="<?php //echo $userDetails[0]['firstName'];?>" width="200px" height="150px"/><i class="fa fa-download"></i></a> -->




<script>
	function printDiv(printMe2){
		var printContents = document.getElementById(printMe2).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>

<script> 
        $(document).ready(function() { 
            // Global variable 
            var element = $("#printMe2");  
            // Global variable 
            var getCanvas;  
           $("#btn-Preview-Image2").on('click', function() { 
                html2canvas(element, { 
                    onrendered: function(canvas) { 
                        $("#previewImage2").append(canvas); 
                        getCanvas = canvas; 
                    } 
                }); 
            }); 

            $("#btn-Convert-Html2Image2").on('click', function() { 
                var imgageData =  
                    getCanvas.toDataURL("image/png"); 
                var newData = imgageData.replace( 
                /^data:image\/png/, "data:application/octet-stream"); 
              
                $("#btn-Convert-Html2Image2").attr("download", "Marse Badge Certificate.png").attr("href", newData); 
            }); 
        }); 
    </script> 

</div>
</div>
</div>
</div>
<?php } else { echo '<b style="color:#f00;"></b>'; }?> 


<?php
$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;

if($time_splt[0]>=4000){ ?>

<div class="col-md-12">
<div class="card">
<div class="card-body p-b-30">
<div class="p-t-20">
    <input id="btn-Preview-Image3" type="button" class="btn btn-danger pull-right float-left" value="Preview" />
          
    <a id="btn-Convert-Html2Image3" class="btn btn-danger  pull-right" href="#"> 
        Download 
    </a> 
  
    <br/> <br>

<h3>Marse Badge Certificate</h3>   
 <h3>Preview Certificate :</h3> 
      
    <div id="previewImage3"></div>
<hr><br>  <?php
    echo "<div class='image' id='printMe3'>";
    echo '<img src="users/Caritas Samaritan certificate.jpg" alt="Certificate"  width="800px" height="550px"/>';
    echo '<div class="texta" style="position:absolute">'. $userDetails[0]['firstName'] .' '. $userDetails[0]['lastName'] .'</div>';
    echo '<div class="textb">4000</div>';
    '</div>';
?> 

<!--<a href="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" />
<img src="<?php echo base_url(); ?>users/Caritas Samaritan certificate.jpg" alt="Certificate" value="<?php //echo $userDetails[0]['firstName'];?>" width="200px" height="150px"/><i class="fa fa-download"></i></a> -->



<script>
	function printDiv(printMe3){
		var printContents = document.getElementById(printMe3).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>

<script> 
        $(document).ready(function() { 
            // Global variable 
            var element = $("#printMe3");  
            // Global variable 
            var getCanvas;  
           $("#btn-Preview-Image3").on('click', function() { 
                html2canvas(element, { 
                    onrendered: function(canvas) { 
                        $("#previewImage3").append(canvas); 
                        getCanvas = canvas; 
                    } 
                }); 
            }); 

            $("#btn-Convert-Html2Image3").on('click', function() { 
                var imgageData =  
                    getCanvas.toDataURL("image/png"); 
                var newData = imgageData.replace( 
                /^data:image\/png/, "data:application/octet-stream"); 
              
                $("#btn-Convert-Html2Image3").attr("download", "Marse Badge Certificate.png").attr("href", newData); 
            }); 
        }); 
    </script> 

</div>
</div>
</div>
</div>
<?php } else { echo '<b style="color:#f00;"></b>'; }?> 


   
<div class="clearfix"></div>
</div>
</div>
</div>
    
</div>



</div>
</div>

  
   <style>
       a.disabled {
  pointer-events: none;
  cursor: default;
}
.image {
   position: relative;
}

.text {
   position: absolute;
       top: 69px;
    left: 0;
    width: 100%;
    margin: 0 auto;
    width: 200px;
    height: 35px;
}
.text1 {
   position: absolute;
    top: 8px;
    left: 7;
    width: 100%;
    margin: 0 auto;
    width: 200px;
    height: 35px;}
    
    .texta {
   position: absolute;
    top: 292px;
    left: 290px;
    width: 100%;
    margin: 0 auto;
    width: 355px;
    height: 35px;
    font-size: large;
    color: #8e2c24;
        font-weight: 600;
}
.textb {
   position: absolute;
       top: 324px;
    left: 405px;
    width: 100%;
    margin: 0 auto;
    width: 200px;
    height: 35px;
    color: #8e2c24;
    font-size: x-large;
        font-weight: 600;
}
   </style> 
