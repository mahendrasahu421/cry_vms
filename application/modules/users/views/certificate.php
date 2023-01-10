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
						<?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?> / 60 Hours</h6>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-2 col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="align-slef-center mr-auto">
						<h5 class="m-b-0 text-uppercase f-18 font-medium lp-5">Silver </h5>
						<h6 class="text-muted m-b-0"><?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?> / 100 Hours</h6>
						</div>
					</div>
				</div>
			</div>


			<div class="col-lg-2 col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="align-slef-center mr-auto">
						<h5 class="m-b-0 text-uppercase f-18 font-medium lp-5">Gold </h5>
						<h6 class="text-muted m-b-0"><?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?> / 200 Hours</h6>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-2 col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="align-slef-center mr-auto">
						<h5 class="m-b-0 text-uppercase f-18 font-medium lp-5">Platinum </h5>
						<h6 class="text-muted m-b-0"><?php $time_splt = explode('.',$reward_user_count_by_month1); echo $time_splt[0] ;?> / 350 Hours</h6>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-12">
				<div class="card">
					<div class="card-body p-b-30">
						<div class="align-self-center mr-auto">
							<h5 class="m-b-0 text-uppercase f-16 font-medium lp-5">Total Working Hours</h5>
							<h6 class="text-muted m-b-0 mt-2"><i class="fa fa-clock"></i> <?php $time_splt = explode('.',$reward_user_count_by_month1)	; echo $time_splt[0].' Hours '.$time_splt[1].' Mins' ;?></h6>
						</div>
					</div>
				</div>
			</div>

			</div>

			
            <div class="row row-sm">
                <div class="col-lg-12">
					<!--<div class="card col-md-3">
						<div class="card-body p-b-30">
							<div class="align-self-center mr-auto">
								<h5 class="m-b-0 text-uppercase f-16 font-medium lp-5">Total Working Hours</h5>
								<h6 class="text-muted m-b-0 mt-2"><i class="fa fa-clock"></i> <?php $time_splt = explode('.',$reward_user_count_by_month1)	; echo $time_splt[0].' Hours '.$time_splt[1].' Mins' ;?></h6>
							</div>
						</div>
					</div>-->
                    <div class="card">

                        <!--<div class="card-header">
                            <div class=" col-md-3">
                                <label for="validationCustom01" class="form-label">Select Task</label>
                                <select class="form-control form-select" name="tasktitle" required>
                                    <option value="0">Select Task</option>
                                    <?php foreach($task as $tsk){?>
									<option value="<?php echo $tsk['task_id']?>" ><?php echo $tsk['task_title']?></option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Start Date</label>
                                <p style="font-size: 18px; font-weight:500;"><?php echo $date1; ?></p>
                            </div>
                            <div class="col-md-3 me-2">
                                <label for="validationCustom01" class="form-label">End Date</label>
                                <p style="font-size: 18px; font-weight:500;"><?php echo $date2; ?></p>
                            </div>
                            <div class="col-md-3 me-2">
                                <label for="validationCustom01" class="form-label">Total Hours</label>
                                <p style="font-size: 20px; font-weight:500;">40:20 </p>
                            </div>
                        </div>-->
                        <!--<div class="card-body">
                            <div>
                                <ul id="menu" class="list-inline ml-3 lp-5 font-medium font-12">
                                    <li><i class="fa fa-circle m-r-5 f-10 text-info"></i> New</li>
                                    <li><i class="fa fa-circle m-r-5 f-10 text-warning"></i> In process</li>

                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="bg-gray-light">Sr.no</th>
                                            <th class="bg-gray-light">Date</th>
                                            <th class="bg-gray-light">Working Time</th>
                                            <th class="bg-gray-light">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>11/5/2022</td>
                                            <td>4:30 Min.</td>
                                            <td>Documentation, Research and development</td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>-->
						
						<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
						<!--<script src="//files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>-->
						<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-alpha1/html2canvas.js"></script>
						
						<div class="col-md-12">
							<div class="">
							<div class="p-3 ">
							<h4 class="text-uppercase">Download Certificate</h4><br>
							<h5 style="color:#f00">*Step 1- Click to Preview Button <br>
											        Step 2- Click Download the Certificate</h5>
							<input id="btn-Preview-Image" type="button" class="btn btn-danger pull-right float-left" value="Preview" />
							<a id="btn-Convert-Html2Image" class="btn btn-danger me-2 pull-right" href="#">  Download </a>
							<br/>
							<?php
							$time_splt = explode('.',$reward_user_count_by_month1);  $time_splt[0] ;

							if($time_splt[0]>=60){ ?> 
							<h4>Preview Certificate :</h4> 

							<div id="previewImage"></div>
							<hr><br>  <?php
							echo "<div class='image' id='printMe'>";
							echo '<img src="users/cry-certificate.jpg" alt="Certificate"  width="800px" height="550px"/>';
							echo '<div class="texta" style="position:absolute;top: 250px; left: 305px; font-size: 30px;color: #8d8838;">'. $volunteerDetails[0]['first_name'] .' '. $volunteerDetails[0]['last_name'] .'</div>';
							//echo '<div class="textb">60 Hours (Silver)</div> ';
							'</div>';
							?> 

							<?php } else { echo '<b style="color:#f7b731 ;">your working hour is not complete</b>'; }?>

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
						
                    </div>
                </div>
            </div>


            <!--<div class="row row-sm">
                <div class="col-lg-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title text-white">Notes</h3>
                        </div>
                        <form>
                            <div class="card-body pb-2">
                                <div class="row row-sm">
                                    <div class="col-lg ">
                                        <textarea class="form-control mb-4" placeholder="Comments" rows="3"></textarea>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-warning">Claim Certificate</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>-->

        </div>

    </div>

</div>



</div>