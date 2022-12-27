<style>
    .card-text-weight {
        font-size: 16px;
        font-weight: 500;
    }
</style>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title"> Task Details</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page"> Task Details</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title float-left align-self-center tasks statistics text-uppercase">Task details</h5>
                            <div class="clearfix"></div>
                            <div class="m-t-20 no-block">
                                <div class="row f-16">
                                    <div class="col-lg-2 col-md-3 col-sm-12">
                                        <span class="card-text-weight text-dark">Task</span>
                                    </div>

                                    <div class="col-lg-10 col-md-9 col-sm-12">
                                        <p><?php echo $task['task_title']; ?></p>
                                    </div>

                                    <div class="col-lg-2 col-md-3 col-sm-12 mt-3">
                                        <span class="card-text-weight text-dark ">Description</span>
                                    </div>

                                    <div class="col-lg-10 col-md-9 col-sm-12">
                                        <p> <?php echo $task['task_brief']; ?></p>
                                    </div>
                                </div>

                                <div class="d-flex f-16">
                                    <div class="col-lg-6 p-0 row col-md-12">
                                        <div class="col-lg-4 col-md-3 col-sm-12">
                                            <span class="card-text-weight text-dark">Publish Date</span>
                                        </div>

                                        <div class="col-lg-8 col-md-4 col-sm-12 p-l-20 ">
                                            <?php $publishdate= $task['creation_date'];?>
											<p> <?php echo date("d-m-Y", strtotime($publishdate)); ?> </p>
                                        </div>



                                        <div class="col-lg-4 col-md-3 col-sm-12">
                                            <span class="card-text-weight text-dark">Start Date</span>
                                        </div>

                                        <div class="col-lg-8 col-md-4 col-sm-12 p-l-20 ">
                                            <?php $startDate= $task['start_date'];?>
											<p> <?php echo date("d-m-Y", strtotime($startDate)); ?> </p>
                                        </div>



                                        <div class="col-lg-4 col-md-3 col-sm-12">
                                            <span class="card-text-weight text-dark">End Date</span>
                                        </div>
                                        <div class="col-lg-8 col-md-4 col-sm-12 p-l-20">
										<?php $endDate= $task['expected_end_date'];?>
										<?php if($endDate==NULL){
										     echo 'NA';} else{ ?>
											 <p> <?php echo date("d-m-Y", strtotime($endDate)); ?> </p>
											 <?php } ?>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <span class="card-text-weight text-dark">Volunteers</span>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-12 p-l-20">
                                            <ul class="members-list">
                                                <li><?php echo $task['volunteer_required']; ?></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-lg-6 row block col-md-12 members-projects"> </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
