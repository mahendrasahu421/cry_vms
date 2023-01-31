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
                    <h1 class="page-title">Feedback</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Feedback</li>
                    </ol>
                </div>
            </div>
            <!-- <?php
                    if ($this->session->userdata('data_message')) {
                    ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successfully!</strong> Submission Report Has Been Inserted.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    </button>
                </div>
            <?php $this->session->unset_userdata('data_message');
                    } ?> -->
            <div class="card">
                <form autocomplete="off" method="post" action="insert_feedback" enctype="multipart/form-data">
                    <div class="card-header bg-warning">
                        <h3 class="card-title text-white">Feedback</h3>
                    </div>
                    <div class="mx-5 fs-5 text-center mt-3">Feedback: Rate between 1 to 5, considering 5 the highest/strongly agree and 1the lowest/strongly disagree</div>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6"><b>The pre-internship
                                        correspondence was systematic and clear *</b></label>
                                1:
                                <input type="radio" value="1" name="pre_internship_correspondence">

                                2 :
                                <input type="radio" value="2" name="pre_internship_correspondence">

                                3 :
                                <input type="radio" value="3" name="pre_internship_correspondence">
                                4 :
                                <input type="radio" value="4" name="pre_internship_correspondence">
                                5 :
                                <input type="radio" value="5" name="pre_internship_correspondence">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6 ">The Selection Process was fair
                                    and transparent*</label>
                                1 :
                                <input type="radio" value="1" name="selection_process">

                                2 :
                                <input type="radio" value="2" name="selection_process">

                                3 :
                                <input type="radio" value="3" name="selection_process">
                                4 :
                                <input type="radio" value="4" name="selection_process">
                                5 :
                                <input type="radio" value="5" name="selection_process">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">The orientation at the beginning
                                    of the Internship was clear , useful, and insightful
                                    *</label>
                                1 :
                                <input type="radio" value="1" name="orientation_beginning">

                                2 :
                                <input type="radio" value="2" name="orientation_beginning">

                                3 :
                                <input type="radio" value="3" name="orientation_beginning">
                                4 :
                                <input type="radio" value="4" name="orientation_beginning">
                                5 :
                                <input type="radio" value="5" name="orientation_beginning">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">The mentor clearly defined goals
                                    at the start of the internship*</label>
                                1 :
                                <input type="radio" value="1" name="defined_goals">

                                2 :
                                <input type="radio" value="2" name="defined_goals">

                                3 :
                                <input type="radio" value="3" name="defined_goals">
                                4 :
                                <input type="radio" value="4" name="defined_goals">
                                5 :
                                <input type="radio" value="5" name="defined_goals">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">The assignment planning process
                                    was participatory
                                    *</label>
                                1 :
                                <input type="radio" value="1" name="assignment_planning">

                                2 :
                                <input type="radio" value="2" name="assignment_planning">

                                3 :
                                <input type="radio" value="3" name="assignment_planning">
                                4 :
                                <input type="radio" value="4" name="assignment_planning">
                                5 :
                                <input type="radio" value="5" name="assignment_planning">

                            </div>


                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">The mentor provided me with
                                    constructive feedback
                                    *</label>
                                1 :
                                <input type="radio" value="1" name="constructive_feedback">

                                2 :
                                <input type="radio" value="2" name="constructive_feedback">

                                3 :
                                <input type="radio" value="3" name="constructive_feedback">
                                4 :
                                <input type="radio" value="4" name="constructive_feedback">
                                5 :
                                <input type="radio" value="5" name="constructive_feedback">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">The mentor was available
                                    whenever I needed support
                                    *</label>
                                1 :
                                <input type="radio" value="1" name="needed_support">

                                2 :
                                <input type="radio" value="2" name="needed_support">

                                3 :
                                <input type="radio" value="3" name="needed_support">
                                4 :
                                <input type="radio" value="4" name="needed_support">
                                5 :
                                <input type="radio" value="5" name="needed_support">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">The overall quality of
                                    supervision was appropriate and sufficient
                                    *</label>
                                1 :
                                <input type="radio" value="1" name="appropriate_and_sufficient">

                                2 :
                                <input type="radio" value="2" name="appropriate_and_sufficient">

                                3 :
                                <input type="radio" value="3" name="appropriate_and_sufficient">
                                4 :
                                <input type="radio" value="4" name="appropriate_and_sufficient">
                                5 :
                                <input type="radio" value="5" name="appropriate_and_sufficient">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">I felt well integrated in the
                                    work flow
                                    *</label>
                                1 :
                                <input type="radio" value="1" name="work_flow">

                                2 :
                                <input type="radio" value="2" name="work_flow">

                                3 :
                                <input type="radio" value="3" name="work_flow">
                                4 :
                                <input type="radio" value="4" name="work_flow">
                                5 :
                                <input type="radio" value="5" name="work_flow">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">The working climate was positive
                                    and encouraging
                                    *</label>
                                1 :
                                <input type="radio" value="1" name="encouraging">

                                2 :
                                <input type="radio" value="2" name="encouraging">

                                3 :
                                <input type="radio" value="3" name="encouraging">
                                4 :
                                <input type="radio" value="4" name="encouraging">
                                5 :
                                <input type="radio" value="5" name="encouraging">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">I found this internship to be
                                    challenging and stimulating
                                    *</label>
                                1 :
                                <input type="radio" value="1" name="stimulating">

                                2 :
                                <input type="radio" value="2" name="stimulating">

                                3 :
                                <input type="radio" value="3" name="stimulating">
                                4 :
                                <input type="radio" value="4" name="stimulating">
                                5 :
                                <input type="radio" value="5" name="stimulating">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">I understood how my internship
                                    contributed to the movement for Child Rights and to CRY’s work</label>
                                1 :
                                <input type="radio" value="1" name="contributed_cry_work">

                                2 :
                                <input type="radio" value="2" name="contributed_cry_work">

                                3 :
                                <input type="radio" value="3" name="contributed_cry_work">
                                4 :
                                <input type="radio" value="4" name="contributed_cry_work">
                                5 :
                                <input type="radio" value="5" name="contributed_cry_work">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">The Internship duration helped
                                    in increased conceptual learning/ understanding on child rights issues</label>
                                1 :
                                <input type="radio" value="1" name="increased_conceptual_learning">

                                2 :
                                <input type="radio" value="2" name="increased_conceptual_learning">

                                3 :
                                <input type="radio" value="3" name="increased_conceptual_learning">
                                4 :
                                <input type="radio" value="4" name="increased_conceptual_learning">
                                5 :
                                <input type="radio" value="5" name="increased_conceptual_learning">

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">I would definitely recommend
                                    this internship to another student
                                    *</label>
                                1 :
                                <input type="radio" value="1" name="another_student">

                                2 :
                                <input type="radio" value="2" name="another_student">

                                3 :
                                <input type="radio" value="3" name="another_student">
                                4 :
                                <input type="radio" value="4" name="another_student">
                                5 :
                                <input type="radio" value="5" name="another_student">

                            </div>


                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">Overall, how would you rate this
                                    internship?*</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="overall_internship" required>
                                    <option value="">Overall, how would you rate this internship?</option>
                                    <option value="Poor">Poor</option>
                                    <option value="Adequate">Adequate</option>
                                    <option value="Good">Good</option>
                                    <option value="Very Good"> Very Good</option>
                                    <option value="Excellent">Excellent</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">If you had the choice, would you
                                    do internship with CRY again?*</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="internship_with_cry_again" required>
                                    <option value="">If you had the choice, would you do internship with CRY again?
                                    </option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    <option value="3">May Be</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">If you wish to continue to
                                    partner with CRY in building a movement for Child Rights, these are the following
                                    ways you could do (kindly tick the ones you want to do)</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="continue_partner" required>
                                    <option value="">If you wish to continue to partner with CRY in building a movement
                                        for Child Rights</option>
                                    <option value="Be a volunteer with CRY: Social media champion">Be a volunteer with
                                        CRY: Social media champion</option>
                                    <option value="Be a volunteer with CRY: Community action">Be a volunteer with CRY:
                                        Community action</option>
                                    <option value="Be a volunteer with CRY: Campaign Supporter">Be a volunteer with CRY:
                                        Campaign Supporter</option>
                                    <option value="Start a group of Child Rights supporters in your school/ college">
                                        Start a group of Child Rights supporters in your school/ college</option>
                                    <option value="Start a Public Action Group for Child Rights in my neighborhood">
                                        Start a Public Action Group for Child Rights in my neighborhood</option>
                                    <option value="Cannot commit">Cannot commit</option>
                                </select>

                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">A quote on your overall
                                    experience. What will you like to say to a potential intern about CRY and your
                                    experience? what that you learnt and what sort of memories if you made?</label>
                                <input type="text" class="form-control" name="overall_experience" value="" id="dailyReportTimeIn" placeholder="Name and address of the institutionthe institution" required>
                            </div>

                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label fs-6">Any suggestions to make this
                                    internship program more fruitful?</label>
                                <input type="text" class="form-control" name="any_suggestions" value="" id="dailyReportTimeIn" placeholder="Name and address of the institutionthe institution" required>
                            </div>




                        </div>
                        <div class="col-md-12">
                            <button id="submit" name="submit" value="submit" class="btn btn-warning pull-right mb-3 mt-5">Submit</button>
                        </div>
                    </div>
            </div>
            </form>

        </div>
    </div>
</div>
</div>
</div>