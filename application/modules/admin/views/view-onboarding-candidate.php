<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 24px;">PROFILE DETAILS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row" id="profile_details">
                <div class="col-md-3 m-b-20 text-center">
                    <img src="<?php echo base_url('admin/'); ?>assets/images/crop.jpg" class="img-fluid" alt="" title="">
                </div>
                <div class="col-md-8">
                    <h2 class="">Mahendra sahu</h2>
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold text-dark">Volunteer ID</div>
                        <div class="col">CS/DL/21/79</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold text-dark">Phone</div>
                        <div class="col">9871191543</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold text-dark">Email</div>
                        <div class="col"><a href="#" class="text-inverse"><span class="_cf_email_">thejasjohn12@gmail.com</span></a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold text-dark">Date of Birth</div>
                        <div class="col">25-11-2000</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold text-dark">State</div>
                        <div class="col">Delhi</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold text-dark">City</div>
                        <div class="col"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold text-dark">Address</div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Applied Candidates</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page">Applied Candidates</li>
                    </ol>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <select class="form-control select2-show-search form-select col-md-3">
                                <option value="">Select Region</option>
                                <option value="6">Region 1</option>
                                <option value="5">Region 2</option>
                                <option value="4">Region 3</option>
                                <option value="3">Region 4</option>
                                <option value="2">Region 5</option>
                            </select>
                            <div class="input-group col-md-3 ">
                                <select class="form-control select2-show-search form-select col-md-3">
                                    <option value="">Select State</option>
                                    <option value="6">Uttar Pradesh</option>
                                    <option value="5">Dihar</option>
                                    <option value="4">uttrakhand</option>
                                    <option value="3">AndraPradesh</option>
                                </select>
                            </div>
                            <div class="input-group col-md-3 ">
                            <select class="form-control select2-show-search form-select col-md-3">
                                    <option value="">OnBord Status</option>
                                    <option value="6">OnBord</option>
                                    <option value="5">Rejected</option>
                                    <option value="4">Pending</option>
                                   
                                </select>
                            </div>
                            <div class="input-group col-md-3 p-5">
                                <span class="input-group-text btn btn-warning">Search</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead class="bg-gray-light">
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Skill</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <td>1</td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Mr.
                                                    Allan Anderson</a>
                                            </td>
                                           
                                            <td>mahi1234@gmail.com</td>
                                            <td>88747572747</td>
                                            <td>Programing , Development</td>
                                            <td>
                                                <a class="badge rounded-pill bg-info me-1 mb-1 mt-1">

                                                   OnBord
                                                </a>
                                            </td>
                                        </tr>

                                     
                                      
                                        </td>
                                        </tr> 
                                    </tbody>
                                </table>
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