<?php
$date1 = date("d/m/Y");
$date2 = date("20/7/Y");
?>
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
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <div class=" col-md-3">
                                <label for="validationCustom01" class="form-label">Select Task</label>
                                <select class="form-control select2-show-search form-select">
                                    <option value="0">Select Task</option>
                                    <option value="0">Health And Nutrition</option>
                                    <option value="0">Anti Human Trafficking & Safe Migration</option>
                                    <option value="0">Livelihood And Skill Development</option>
                                    <option value="0">Climate Adaptive Agriculture And Food So...</option>
                                    <option value="0">Humanitarian Aid And Disaster Risk Reduc...</option>
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
                                        <?php
                                        $count = 1;
                                        foreach ($volunteerDetails as $key => $value) {
                                            $location = '';
                                            if ($value['correspontenceAddress'] != '') {
                                                //$location.=$value['correspontenceAddress'].',';
                                            }
                                            if ($value['cityName'] != '') {
                                                $location .= $value['cityName'] . ',';
                                            }
                                            if ($value['stateName'] != '') {
                                                $location .= $value['stateName'];
                                            }
                                            //$location = $value['correspontenceAddress'].', '.$value['cityName'].', '.$value['stateName'];
                                            $encode_userID = rtrim(strtr(base64_encode($value['userID']), "+/", "-_"), "=");
                                        ?>
                                            <tr <?php if ($value['verify'] == 1) {
                                                    echo 'class="bg-info td-white"';
                                                } ?>>

                                                <td><?php echo $count++; ?></td>

                                                <td><?php echo $value['volunteerID']; ?></td>

                                                <td><?php echo ucwords($value['firstName'] . ' ' . $value['lastName']); ?> <br><a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encode_userID; ?>','profile_details');"><small class="text-primary">(View Profile)</small></a></td>

                                                <td><?php echo $value['mobile']; ?></td>

                                                <td><?php echo $value['email']; ?></td>

                                                <td><?php echo date("d/m/Y", strtotime($value['usersCreationDate'])); ?></td>

                                                <td><?php echo $location; ?></td>

                                                <?php

                                                if ($value['verify'] == 0) {

                                                ?>

                                                    <td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

                                                        <div class="dropdown-menu">

                                                            <a class="dropdown-item" onclick="return confirm('Are you want to verify');" href="<?php echo base_url(); ?>volenteership-verify/<?php echo $encode_userID; ?>">Verify</a>

                                                            <a href="<?php echo base_url(); ?>volenteership-block/<?php echo $encode_userID; ?>" onclick="return confirm('Are you want to block');" class="dropdown-item">Block</a>

                                                        </div>

                                                    </td>

                                                <?php } else { ?>

                                                    <td class="text-light-blue"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

                                                        <div class="dropdown-menu">

                                                            <a href="volenteership-block/<?php echo $encode_userID; ?>" class="dropdown-item">Block</a>

                                                        </div>

                                                    </td>

                                                <?php } ?>

                                            </tr>

                                        <?php

                                        }

                                        ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row row-sm">

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



            </div>

        </div>

    </div>

</div>



</div>