<style>
    #basic-addon2 {
        width: 100px;
        height: 40px;
    }

    .label {
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
                    <h1 class="page-title">Add Daily Report</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </div>
            </div>
            <div class="card">
                <form action="#" method="POST" id="form" name="pForm" onsubmit=" return validate();" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="card-header bg-warning">
                        <h3 class="card-title text-white">Add Daily Report</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Choose Task<sup>*</sup></label>
                                <select class="form-control select2-show-search form-select select2-hidden-accessible" data-placeholder="Choose State" tabindex="-1" aria-hidden="true">

                                    <option value="0">Select Task</option>
                                    <option value="0">Health And Nutrition</option>
                                    <option value="0">Anti Human Trafficking & Safe Migration</option>
                                    <option value="0">Livelihood And Skill Development</option>
                                    <option value="0">Climate Adaptive Agriculture And Food So...</option>
                                    <option value="0">Humanitarian Aid And Disaster Risk Reduc...</option>
                                </select>
                                <div class="valid-feedback">Looks good!</div>
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
                                <input type="date" class="form-control" name="dailyReportTimeIn" onchange="hours(this);" value="00" id="dailyReportTimeIn" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="form-label">Time Out</label>
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
                                <label for="validationCustom01" class="label">How Could it be Improved?<br><small>(300
                                        Characters Allowed)</small></label>
                                <textarea class="form-control" placeholder="How Could it be Improved" required="" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom02" class="label">Challenges Faced<br><small>(300 Characters
                                        Allowed)</small></label>
                                <textarea class="form-control" placeholder="Challenges Faced" required="" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom03" class="label">Activity<small>(Guidline Below)<br> 1-No
                                        of people reached out 2-Testimonies from participants 3-Type of participants
                                        (age, profession..etc) 4-Other detailed information</small></label>
                                <textarea class="form-control" placeholder="Activity" rows="6" required="" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="validationCustom04" class="label">Share your experience in brief
                                    <br><small>(300 Characters Allowed)</small></label>
                                <textarea class="form-control" placeholder="Activity" rows="6" required="" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Add Image</label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" onchange="check_size(this,this.value,'idid');" name="Image[]" id="#img1" accept=".jpg,.jpeg,.png,.gif" multiple />
                                    </div>
                                </div>
                                <input type="number" id="count1" value="1" style="display: none;">
                                <input type="number" id="attachmentTypeID1" name="attachmentTypeID[]" value="1" style="display: none;">
                                <ul id="list1">
                                    <li class="default1" style="display: none;">
                                        <input type="file" class="img-add" name="Image[]" accept=".jpg,.jpeg,.png,.gif" /><span class="add-file" onclick="closeMe(this,'#count1');"><i class="fa fa-trash"></i></span>
                                    </li>
                                </ul>
                                <script>
                                    function closeMe(element, variabls) {
                                        var count_file = $(variabls).val();
                                        $(element).parent().remove();
                                        count_file--;
                                        $(variabls).val(count_file);
                                    }

                                    function addMore(id, class1, variabls) {
                                        //alert(class1);
                                        var count_file = $(variabls).val();
                                        if (count_file < 5) {
                                            var container = $(id);
                                            var item = container.find('.' + class1).clone();
                                            item.removeClass(class1);
                                            //item.attr('name','file[]');
                                            item.appendTo(container).show();
                                            count_file++;
                                            $(variabls).val(count_file);
                                        }
                                    }

                                    function check_size(id, value, display_id) {
                                        var value = $(id).val();
                                        if (value != '') {
                                            var _size = id.files[0].size;
                                            var final_size = (_size / 1024) / 1024;
                                            if (final_size <= 1) {
                                                //alert(final_size);
                                            } else {
                                                $(id).val('');
                                                alert('Please select file less then or equal to 1 MB.');
                                            }
                                        }
                                    }

                                    function check_time(id, msg) {
                                        var intime = $('#dailyReportTimeIn').val();
                                        var outtime = $('#dailyReportTimeOut').val();
                                        if (outtime != '') {
                                            if (intime < outtime) {
                                                $('#' + id).css('border', '');
                                            } else {
                                                var initialDate = intime;
                                                var theAdd = new Date(1900, 0, 1, initialDate.split(":")[0], initialDate
                                                    .split(":")[1]);
                                                theAdd.setMinutes(theAdd.getMinutes() + 01);
                                                var h = theAdd.getHours();
                                                var m = theAdd.getMinutes();
                                                if (h < 10) {
                                                    h = '0' + theAdd.getHours();
                                                }
                                                if (m < 10) {
                                                    m = '0' + theAdd.getMinutes();
                                                }
                                                theAdd = h + ":" + m;
                                                console.log(theAdd);
                                                //alert(theAdd);
                                                $('#dailyReportTimeOut').val(theAdd);
                                                //$('#'+id).css('border','2px solid red');
                                            }
                                        } else {
                                            var initialDate = intime;
                                            var theAdd = new Date(1900, 0, 1, initialDate.split(":")[0], initialDate.split(
                                                ":")[1]);
                                            theAdd.setMinutes(theAdd.getMinutes() + 01);
                                            var h = theAdd.getHours();
                                            var m = theAdd.getMinutes();
                                            if (h < 10) {
                                                h = '0' + theAdd.getHours();
                                            }
                                            if (m < 10) {
                                                m = '0' + theAdd.getMinutes();
                                            }
                                            theAdd = h + ":" + m;
                                            console.log(theAdd);
                                            //alert(theAdd);
                                            $('#dailyReportTimeOut').val(theAdd);
                                        }
                                        //console.log(oldouttime);
                                    }
                                </script>
                            </div>
                            <div class="col-md-2" style="margin-top: 35px;">
                                <button type="submit" name="submit" value="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Today Report List</h2>
                        </div>
                        <div class="card-header">
                            <div class="col-md-1">
                                <label for="validationCustom01" class="form-label">Select Task</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control select2-show-search form-select">
                                    <option value="AZ">Select Task</option>
                                    <option value="AZ">Humanitarian Aid And Disaster Risk Reduc</option>
                                    <option value="CO">Climate Adaptive Agriculture and Food So</option>
                                    <option value="ID">Livelihood and Skill Development</option>
                                    <option value="MT">Anti Human Trafficking & Safe Migration</option>
                                    <option value="NE">Health And Nutrition</option>
                                    <option value="NM">Peace Building</option>
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
                                        <tr>
                                            <td>1</td>
                                            <td>10 AM</td>
                                            <td>1 PM</td>
                                            <td>Documentation, Research and development</td>
                                            <td>
                                               4 Hours
                                            </td>
                                            
                                        </tr>
                                        <!-- <tr>
                                            <td>1</td>
                                            <td>09/11/2020</td>
                                            <td>Support to Resource Mobilisation Desk</td>
                                            <td>Documentation, Research and development</td>
                                            <td>
                                                <button class="btn btn-info  mt-1 mb-1 me-3">Request Send</button>
                                            </td>
                                            <td>
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="view-task-details">View Task</a></li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr> -->

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