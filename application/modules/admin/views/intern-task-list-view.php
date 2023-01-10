<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PROFILE DETAILS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- AGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Intern Task List</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard">Home</a></li>
                        <li class="breadcrumb-item active text-warning" aria-current="page">Intern Task</li>
                    </ol>
                </div>
            </div>
            <style>
                ul#menu li {
                    display: inline;
                }
            </style>

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
                                <input type="date" class="form-control " placeholder="Search for...">

                            </div>
                            <div class="input-group col-md-3 p-5">

                                <span class="input-group-text btn btn-warning">Go!</span>
                            </div>

                        </div>



                        <div class="card-body">
                            <div>
                                <ul id="menu" class="list-inline ml-3 lp-5 font-medium font-12">
                                    <li><i class="fa fa-circle m-r-5 f-10 text-info"></i> New</li>
                                    <li><i class="fa fa-circle m-r-5 f-10 text-warning"></i> In process</li>
                                    <li><i class="fa fa-circle m-r-5 f-10 text-success"></i> Done</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr class="bg-gray-light">
                                            <th>Sn .No</th>
                                            <th>Published Date</th>
                                            <th>Task Name</th>
                                            <!-- <th>End Date</th> -->
                                            <th>Region</th>
                                            <th>State</th>
                                            <th>Status</th>
                                            <th>Task Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="fa fa-circle m-r-5 f-10 text-info"></i></td>
                                            <td>05/07/2022</td>
                                            <td>Amelia A Nicholas
                                            </td>

                                            <td>Region 1</td>
                                            <!-- <td>12</td> -->
                                            <td>
                                                DL,UP,UK
                                            </td>
                                            <td>
                                                <span class="badge rounded-pill bg-info me-1 mb-1 mt-1">Published</span>
                                            </td>
                                            <td>
                                                <span class="badge rounded-pill bg-info me-1 mb-1 mt-1">In-working</span>
                                            </td>
                                            <td>
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="view-task">View Task</a></li>
                                                        <li><a href="edit-task">Edit Task</a></li>
                                                    </ul>
                                                </div>
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
</div>
</div>