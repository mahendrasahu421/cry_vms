<style>
    #basic-addon2 {
        width: 100px;
        height: 40px;
    }
</style>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Add Daily Report</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </div>
            </div>
			<?php
			if($this->session->userdata('data_message'))
			{
			?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Successfull!</strong> Daily Report Has Been Inserted.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php $this->session->unset_userdata('data_message'); } ?>
            <div class="card">
                <form autocomplete="off" method="post" action="#" enctype="multipart/form-data" >
                    <div class="card-header bg-warning">
                        <h3 class="card-title text-white">Add Daily Report</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Choose Task<sup>*</sup></label>
                                <select class="form-control" id="exampleFormControlSelect1" name="tasktitle" required >
									<option value="">Select Task</option>
									<?php foreach($task as $tsk){?>
									<option value="<?php echo $tsk['task_id']?>" ><?php echo $tsk['task_title']?></option>
									<?php } ?>
								</select>
                                <div class="valid-feedback"><?php echo form_error('tasktitle', '<div class="error">', '</div>'); ?></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="form-label">Time In</label>
                                    <div class="col-sm-12">
                                        <div class="input-group ">
                                            <input type="number" class="form-control" name="dailyReportTimeIn" onchange="hours(this);" value="00" id="dailyReportTimeIn" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Hours</span>
                                            </div>
                                            <input type="number" class="form-control" name="dailyReportTimeIn1" onchange="mins(this);" value="00" id="dailyReportTimeIn1" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Min</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Date</label>
                                <input type="date" class="form-control" name="birthday1" onchange="hours(this);" value="00" id="dailyReportTimeIn" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="form-label">Time Out</label>
                                    <div class="col-sm-12">
                                        <div class="input-group ">
                                            <input type="number" class="form-control" name="dailyReportTimeOut" onchange="hours(this);" value="00" id="dailyReportTimeIn" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Hours</span>
                                            </div>
                                            <input type="number" class="form-control" name="dailyReportTimeOut1" onchange="mins(this);" value="00" id="dailyReportTimeIn1" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Min</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">How Could it be Improved?<br><small>(300
                                        Characters Allowed)</small></label>
                                <textarea class="form-control" placeholder="How Could it be Improved" rows="2" name="improved_msg"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Challenges Faced<br><small>(300 Characters
                                        Allowed)</small></label>
                                <textarea class="form-control" placeholder="Challenges Faced" name="challeges_face" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Activity<small>(Guidline Below)<br> 1-No
                                        of people reached out 2-Testimonies from participants 3-Other detailed information</small></label>
                                <textarea class="form-control" placeholder="Activity" rows="2"  name="dailyActivity"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Share your Work URL
                                    <br><small>(300 Characters Allowed)</small></label>
                                <textarea class="form-control" placeholder="Share your Work URL" rows="2" name="experrience_any"></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label form-label">Add Image</label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control"  name="attachment" id="#img1"  multiple />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
						<div class="col-md-12">
							<button type="submit" name="submit" value="submit" class="btn btn-warning pull-right mb-3">Submit</button>
						</div>
                    </div>
            </div>
            </form>
            <!--<div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-warning">
							<h3 class="card-title text-white">Today Daily Report</h3>
						</div>
                        <div class="card-header">
                            <div class="col-md-2">
                                <label for="validationCustom01" class="form-label">Select Task</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" id="task" name="task">
									<?php foreach($task as $key => $value){
										$allasid = $value['task_id'];
										$tv=$task_value;
										if($allasid==$letest_taskID){
											$tk = 'selected';
										}else{
											$tk = '';
										}
									?>
									<option value="<?php echo $value['task_id']?>" <?php echo $tk; ?>><?php echo $value['task_title']?></option>
									<?php } ?>
								</select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group  p-0">
                                    <span class="input-group-text btn btn-warning">Search</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <ul id="menu" class="list-inline ml-3 lp-5 font-medium font-12">
                                    <li><i class="fa fa-circle m-r-5 f-10 text-info"></i> New</li>
                                    <li><i class="fa fa-circle m-r-5 f-10 text-warning"></i> In process</li>

                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr class="bg-gray-light">
                                            <th class="w-5">SNo.</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Task Activity</th>
                                            <th>Total Time</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $i=1; foreach($report as $key => $value){
											$timeIn= $value['dr_time_in'];
											$time = date('h:i A', strtotime($timeIn));
											$timeOut= $value['dr_time_out'];
											$time1 = date('h:i A', strtotime($timeOut));
											
											$diff = abs(strtotime($time) - strtotime($time1));
											$tmins = $diff/60;
											$hours = floor($tmins/60);
											$mins = $tmins%60;
											?>
										<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $time ;?></td>
										<td><?php echo $time1 ;?></td>
										<td><?php echo $value['dr_activity'];?></td>
										<td><?php echo "<b>$hours</b> hour <b>$mins</b> mins</b>" ?> Hours</td>
										</tr>
										<?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>
</div>
</div>