<style>
    #basic-addon2 {
        width: 100px;
        height: 40px;

    }

    .col-form-label {
        padding-top: calc(0.375rem + 1px);
        padding-bottom: calc(0.375rem + 1px);
        margin-bottom: 0;
        font-size: inherit;
        line-height: 1.5;
        font-weight: 700;
    }
</style>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title"> Daily Report Data</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Data</li>
                    </ol>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="tab-content">
                        <div class="p-0">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title float-left align-self-center tasks statistics text-uppercase">Daily Report details</h5>

                                            <div class="clearfix"></div>
                                            <div class="m-t-20 no-block">
                                                <div class="row f-16">

                                                    <div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Time In</span> </div>
                                                    <div class="col-lg-8 col-md-9 col-sm-12">
                                                        <p> 06:00 am</p>
                                                    </div>

                                                    <div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Time Out</span> </div>
                                                    <div class="col-lg-8 col-md-9 col-sm-12">
                                                        <p> 10:00 am</p>
                                                    </div>

                                                    <div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Task Activity</span> </div>
                                                    <div class="col-lg-8 col-md-9 col-sm-12">
                                                        <p> Writing should be clear enough so others can understand it properly</p>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">How Could it be Improved </span> </div>
                                                    <div class="col-lg-8 col-md-9 col-sm-12">
                                                        <p> Writing should be clear enough so others can understand it properly</p>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Challenges Faced</span> </div>
                                                    <div class="col-lg-8 col-md-9 col-sm-12">
                                                        <p> Since Writing was not clear enough, I was not able...</p>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Experience Sharing</span> </div>
                                                    <div class="col-lg-8 col-md-9 col-sm-12">
                                                        <p> Writing should be clear enough so others can understand it properly</p>
                                                    </div>

                                                    <div class="col-lg-4 col-md-8 col-sm-12"> <span class="weight-500 f-w-700 text-dark">Report date</span> </div>
                                                    <div class="col-lg-8 col-md-9 col-sm-12">
                                                        <p> 30-09-2021 </p>
                                                    </div>



                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title float-left  m-b-40  align-self-center text-uppercase f-w-700">Attachments</h5>
                                        <div class="clearfix"></div>
                                        <div class="table-responsive">
                                            <table class="table color-table primary-table">
                                                <thead>
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th>Document Name </th>
                                                        <th>Attached by</th>
                                                        <!-- <th>Date</th> -->
                                                        <th>Size</th>
                                                        <th class="icon-color"><i class="fa fa-download" aria-hidden="true"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="5">
                                                            <center style="color:red;">Not available</center>
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
</div>
</div>
<script>
    $('.show').click(function() {
        $(this).css('display', 'none');
        var id = $(this).attr('showid');
        $('#' + id).removeAttr('style');
        //alert(id);
    });
    $('.hide').click(function() {
        var showid = $(this).attr('showid');
        $('#' + showid).css('display', 'block');
        var id = $(this).attr('hideid');
        $('#' + id).css('display', 'none');
    });
</script>