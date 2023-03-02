<?php
$date1 = date("d/m/Y");
$date2 = date("20/7/Y");
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
?>
<?php $time_splt = explode('.',$reward_user_count_by_month1);?>
<?php   $volunteer_id = $this->session->userdata('volunteer_id');?>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Claim Certificate</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . 'dashboard'; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Claim Certificate</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-slef-center mr-auto">
                                <h5 class="m-b-0 text-uppercase f-18 font-medium lp-5">Bronze certificate</h5>
                                <h6 class="text-muted m-b-0">
                                    <?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?>
                                    / 60 Hours</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-slef-center mr-auto">
                                <h5 class="m-b-0 text-uppercase f-18 font-medium lp-5">Silver </h5>
                                <h6 class="text-muted m-b-0">
                                    <?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?>
                                    / 100 Hours</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-slef-center mr-auto">
                                <h5 class="m-b-0 text-uppercase f-18 font-medium lp-5">Gold </h5>
                                <h6 class="text-muted m-b-0">
                                    <?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?>
                                    / 200 Hours</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-slef-center mr-auto">
                                <h5 class="m-b-0 text-uppercase f-18 font-medium lp-5">Platinum </h5>
                                <h6 class="text-muted m-b-0">
                                    <?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?>
                                    / 350 Hours</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="card">
                        <div class="card-body p-b-30">
                            <div class="align-self-center mr-auto">
                                <h5 class="m-b-0 text-uppercase f-16 font-medium lp-5">Total Working Hours</h5>
                                <h6 class="text-muted m-b-0 mt-2"><i class="fa fa-clock"></i>
                                    <?php $time_splt = explode('.',$reward_user_count_by_month1)	; echo $time_splt[0].' Hours '.$time_splt[1].' Mins' ;?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-3">
                    <div class="card">
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                        <!--<script src="//files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>-->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-alpha1/html2canvas.js">
                        </script>
                        <div class="col-md-12">
                            <div class="">
                                <div class="p-3 ">
                                    <h4 class="text-uppercase">BRONZE Certificate</h4>
                                    <button type="button" class="btn btn-warning">
                                        <a href="<?php echo base_url() ?>view_bronze_certificate/<?php echo $volunteer_id; ?>"
                                            target="_blank">Preview </a>
                                    </button>
                                    <a id="btn-Convert-Html2Image" class="btn-sm btn-primary me-2 pull-right" href="">
                                        Download </a>
                                    <br />
                                    <?php
							$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;
							if($time_splt[0]>=60){ ?>
                                    <div id="previewImage"></div>
                                    <hr>
                                    <?php
							echo "<div class='image' id='printMe'>";
							echo '<img src="users/cry-certificate.jpg" alt="Certificate" />';
							echo '<div class="texta" style="position:absolute;top: 72px; left: 75px; font-size: 10px;color: #8d8838;">'. $volunteerDetails[0]['first_name'] .' '. $volunteerDetails[0]['last_name'] .'</div>';
							//echo '<div class="textb">60 Hours (Silver)</div> ';
							'</div>';
							?>
                                    <?php } else { echo '<b style="color:#f7b731 ;">your working hour is not complete</b>'; }?>
                                    <br>
                                    <script>
                                    function printDiv(printMe) {
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
                                            $("#btn-Convert-Html2Image").attr("download",
                                                "Pluto Badge Certificate.png").attr("href", newData);
                                        });
                                    });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="col-md-12">
                        <div class="">
                            <div class="p-3 ">
                                <h4 class="text-uppercase">SILVER Certificate</h4>
                                <input id="btn-Preview-Image" type="button"
                                    class="btn-sm btn-warning pull-right float-left" value="Preview" />
                                <a id="btn-Convert-Html2Image" class="btn-sm btn-primary me-2 pull-right" href="#">
                                    Download </a>
                                <br>
                                <?php
							$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;
							if($time_splt[0]>=100){ ?>
                                <div id="previewImage1"></div>
                                <hr>
                                <?php
							echo "<div class='image' id='printMe'>";
							echo '<img src="users/silver_cer.jpg" alt="Certificate"/>';
							echo '<div class="texta" style="position:absolute;top: 72px; left: 80px; font-size: 10px;color: #8d8838;">'. $volunteerDetails[0]['first_name'] .' '. $volunteerDetails[0]['last_name'] .'</div>';
							//echo '<div class="textb">60 Hours (Silver)</div> ';
							'</div>';
							?>
                                <?php } else { echo '<b style="color:#f7b731 ;">your working hour is not complete</b>'; }?>
                                <br>
                                <script>
                                function printDiv(printMe) {
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
                                                $("#previewImage1").append(canvas);
                                                getCanvas = canvas;
                                            }
                                        });
                                    });
                                    $("#btn-Convert-Html2Image").on('click', function() {
                                        var imgageData =
                                            getCanvas.toDataURL("image/png");
                                        var newData = imgageData.replace(
                                            /^data:image\/png/, "data:application/octet-stream");
                                        $("#btn-Convert-Html2Image").attr("download",
                                            "Pluto Badge Certificate.png").attr("href", newData);
                                    });

                                });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="col-md-12">
                    <div class="">
                        <div class="p-3 ">
                            <h4 class="text-uppercase">GOLD Certificate</h4>
                            <input id="btn-Preview-Image" type="button" class="btn-sm btn-warning pull-right float-left"
                                value="Preview" />
                            <a id="btn-Convert-Html2Image" class="btn-sm btn-primary me-2 pull-right" href="#"> Download
                            </a>
                            <br>
                            <?php
							$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;
							if($time_splt[0]>=200){ ?>
                            <div id="previewImage2"></div>
                            <hr>
                            <?php
							echo "<div class='image' id='printMe'>";
							echo '<img src="users/gold-cer.jpg" alt="Certificate" />';
							echo '<div class="texta" style="position:absolute;top: 72px; left: 105px; font-size: 10px;color: #8d8838;">'. $volunteerDetails[0]['first_name'] .' '. $volunteerDetails[0]['last_name'] .'</div>';
							//echo '<div class="textb">60 Hours (Silver)</div> ';
							'</div>';
							?>
                            <?php } else { echo '<b style="color:#f7b731 ;">your working hour is not complete</b>'; }?>
                            <br>
                            <script>
                            function printDiv(printMe) {
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
                                            $("#previewImage2").append(canvas);
                                            getCanvas = canvas;
                                        }
                                    });

                                });
                                $("#btn-Convert-Html2Image").on('click', function() {
                                    var imgageData =
                                        getCanvas.toDataURL("image/png");
                                    var newData = imgageData.replace(
                                        /^data:image\/png/, "data:application/octet-stream");
                                    $("#btn-Convert-Html2Image").attr("download",
                                        "Pluto Badge Certificate.png").attr("href", newData);
                                });
                            });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="col-md-12">
                    <div class="">
                        <div class="p-3 ">
                            <h4 class="text-uppercase">PLATINUM Certificate</h4>
                            <input id="btn-Preview-Image" type="button" class="btn-sm btn-warning pull-right float-left"
                                value="Preview" />
                            <a id="btn-Convert-Html2Image" class="btn-sm btn-primary me-2 pull-right" href="#"> Download
                            </a>
                            <?php
							$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;
							if($time_splt[0]>=350){ ?>
                            <div id="previewImage3"></div>
                            <hr>
                            <?php
							echo "<div class='image' id='printMe'>";
							echo '<img src="users/plati-cer.jpg" alt="Certificate"/>';
							echo '<div class="texta" style="position:absolute;top: 72px; left: 75px; font-size: 10px;color: #8d8838;">'. $volunteerDetails[0]['first_name'] .' '. $volunteerDetails[0]['last_name'] .'</div>';
							//echo '<div class="textb">60 Hours (Silver)</div> ';
							'</div>';
							?>
                            <?php } else { echo '<b style="color:#f7b731 ;">your working hour is not complete</b>'; }?>
                            <br>
                            <script>
                            function printDiv(printMe) {
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
                                            $("#previewImage3").append(canvas);
                                            getCanvas = canvas;
                                        }
                                    });
                                });
                                $("#btn-Convert-Html2Image").on('click', function() {
                                    var imgageData =
                                        getCanvas.toDataURL("image/png");
                                    var newData = imgageData.replace(
                                        /^data:image\/png/, "data:application/octet-stream");
                                    $("#btn-Convert-Html2Image").attr("download",
                                        "Pluto Badge Certificate.png").attr("href", newData);

                                });

                            });
                            </script>
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