<?php 
/*
Template Name:View Candidate
*/
include(TEMPLATEPATH.'/header-dashboard.php');
$id = get_current_user_id();
$row_id = $_GET['r'];
global $wpdb;

$candidate_data = $wpdb->get_results("SELECT candidate_data FROM save_candidate WHERE ID=$row_id");
$cand_data = $candidate_data[0]->candidate_data;
$dis_can_data = unserialize($cand_data);

$name = $dis_can_data['name'];
$lives = $dis_can_data['lives'];
$emp_status = $dis_can_data['emp_status'];
$avail = $dis_can_data['availablity'];
$c_salary = $dis_can_data['current_salary'];
$c_pos = $dis_can_data['current_position'];
$c_emp = $dis_can_data['current_employer'];
$sal_expec = $dis_can_data['salary_expectation'];

$work_pref = $dis_can_data['working_perference'];
$qual = $dis_can_data['qualification'];
$univers = $dis_can_data['university'];
$add_qual = $dis_can_data['additional_qualification'];
/*************Soft Skills*********************/

$soft_skills = array_filter($dis_can_data['soft_skills_name']);
$soft_skills_level = array_filter($dis_can_data['soft_skills_level']);

/**********Technical Skills************/

$skills = array_filter($dis_can_data['skill']);
$techskills_levels = array_filter($dis_can_data['skill_level']);

$note = $dis_can_data['note_from_recruiter'];
$cv = wp_get_attachment_url($dis_can_data['cv']);
$video_attach = wp_get_attachment_url($dis_can_data['video_atachment']);
$intro_video_atachment = wp_get_attachment_url($dis_can_data['intro_video_atachment']);
$add_info_atachment = wp_get_attachment_url($dis_can_data['add_info_atachment']);

$recruiter_id = $dis_can_data['recruiter_id'];
$recruiter_fname = get_user_meta($dis_can_data['recruiter_id'],'first_name',true);
$recruiter_lastname = get_user_meta($dis_can_data['recruiter_id'],'last_name',true);
$rec_name = $recruiter_fname.' '.$recruiter_lastname;
?>

<section class="dashboard-section">
        <div class="dashboard-main-content">
        <?php include(TEMPLATEPATH.'/dashboard-employer/employer-rating-section.php');  ?>
            <button type="button" class="my-btn my-btn-2 d-block ms-auto" id="request_more_info">Action</button>
            <div class="form-group cmn-mg-btm col-md-12">
                <div class="form-btn-wrap">
                    <button type="button" class="my-btn my-btn-2" data-bs-toggle="modal"
                    data-bs-target="#Req_interview" style="display:none" id="request_interview">Request Interview</button>
                    <button type="button" class="my-btn my-btn-2" data-bs-toggle="modal"
                        data-bs-target="#ShareCandidate" style="display:none" id="share_cv">Share CV</button>
                    <button type="button" class="my-btn my-btn-2" data-bs-toggle="modal"
                        data-bs-target="#RejectCandidate" style="display:none" id="rj_cn">Reject Candidate</button>
                    <a href="<?php echo get_the_permalink(32); ?>" class="my-btn my-btn-2" style="display:none" id="req_info">Request More Info</a>
                </div>
            </div>
            <div class="submit-candidate-wrap my-form">
                <form>
                    <div class="row">
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="flex-heading mb-4">
                                </div>
                                <div class="submit-content">
                                    <div class="row">
                                        <div class="form-group d-flex col-md-6">
                                            <label>NAME : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $name; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>LIVES : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $lives; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>EMPLOYMENT STATUS : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $emp_status; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>AVAILABILITY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $avail; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>CURRENT SALARY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="£ <?php echo $c_salary; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>CURRENT POSITION : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $c_pos; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>CURRENT EMPLOYER : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $c_emp; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>SALARY EXPECTATION : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="£ <?php echo $sal_expec?> per annum">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>WORKING PREFERANCE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $work_pref; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>QUALIFICATION : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $qual; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>UNIVERSITY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $univers; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>ADDITIONAL QUALIFICATIONS : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $add_qual; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-6">
                            <h5>Desired technology skill strengths (None 0 to 10 Excellent)</h5>
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row add-skills">
                                    
                                    <?php
                                    foreach($skills as $skill){ ?>
                                    <div class="form-group col-md-6">
                                   <input type="text" value="<?php echo $skill; ?>" class="form-control" readonly >
                                    </div>
                                    <?php }
                                    ?>
                                    
                                    
                                    <?php
                                    foreach($techskills_levels as $skill_level){
                                    ?>
                                    <div class="form-group col-md-6">
                                    <input type="text" value="<?php echo $skill_level; ?>" class="form-control" readonly >
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="Submit-wrap form-heading col-md-6">
                            <h5>Soft skills required</h5>
                                <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row add-skills">
                                  
                                    <?php
                                    foreach($soft_skills as $soft_skill_name){?>
                                    <div class="form-group col-md-6">
                                    <input type="text" value="<?php echo $soft_skill_name; ?>" class="form-control" readonly >
                                    </div>
                                    <?php }
                                    ?>
                                    
                                    
                                    <?php
                                    foreach($soft_skills_level as $soft_skills_levels){ ?>
                                    <div class="form-group col-md-6">
                                    <input type="text" value="<?php echo $soft_skills_levels ?>" class="form-control" readonly >
                                    </div>  
                                    <?php }
                                    ?>
                                     
                                </div>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Additional candidate notes</label>
                                        <textarea class="form-control" placeholder="Russell has worked with a number of current AT&T employees previously and is confident they would highly recommend him. Has recently worked on very similar projects to the projects he would be working on if chosen for the AT&T job.
                                            "><?php echo $note; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm pt-0">
                                    <embed src="<?php echo $cv; ?>#toolbar=0" height="1000px" width="100%" type="application/pdf">
                                <div class="documents-btn-wrap">
                                    <a href="<?php echo $cv; ?>" target="_blank" class="my-btn doc-btn employer-doc">CV</a>
                                    <a href="<?php echo $video_attach; ?>" target="_blank" class="my-btn doc-btn employer-doc">Video Attachment</a>
                                    <a href="<?php echo $intro_video_atachment; ?>" target="_blank" class="my-btn doc-btn employer-doc">Intro Video</a>
                                    <a href="<?php echo $add_info_atachment; ?>" target="_blank" class="my-btn doc-btn employer-doc">Additional Info</a>
                                </div>
                            </div>
                        </div>
                   
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Modal Reject Candidate -->
    <div class="modal fade my-modal" id="RejectCandidate" tabindex="-1" aria-labelledby="RejectCandidateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <h4>Reject Candidate</h4>
                        <form id="reject_candidate">
                        <div class="form-group col-md-12">
<!--                          <label>Additional candidate notes</label>-->
                             <textarea class="form-control" placeholder="Submit your reason" name="rejection_reason"></textarea>
                         </div>
                        <div class="form-btn-wrap">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" id="reject_cand">Submit</button>
                            <input type="submit" value="reject_candidate" id="reject_candidate" style="display:none">
                            <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                            <input type="hidden" id="scand" class="candidates" value="<?php echo $row_id; ?>" data-rc-id="<?php echo $recruiter_id; ?>">
                            <input type="hidden" name="action" value="reject_candidate">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Share Candidate -->
    <div class="modal fade my-modal" id="ShareCandidate" tabindex="-1" aria-labelledby="ShareCandidateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <h4>Share Candidate Profile</h4>
                        <form id="share_candidate">
                        <div class="form-group col-md-12">
                          <label>Enter Email</label>
                             <input type="email" class="form-control" name="share_email" placeholder="Please enter email...">
                         </div>
                        <div class="form-btn-wrap">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" id="share_cand">Send</button>
                            <input type="submit" value="share_candidate" id="share_candidate" style="display:none">
                            <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                            <input type="hidden" id="shcand" class="candidates" value="<?php echo $row_id; ?>" data-rc-id="<?php echo $recruiter_id; ?>">
                            <input type="hidden" name="action" value="share_candidate">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
/*************************Interview Timings****************************/
?>
    <div class="modal fade my-modal" id="Req_interview" tabindex="-1" aria-labelledby="Req_interviewLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <h4>Choose three schedules for interview:</h4>
                        <form id="choose_interview_timings">
                        <div class="row">
                           
                        <div class="form-group col-md-4">
                             <label>Date 1</label>
                            <input id="picker1"  size="30" style="width: 150px" class="form-control" type="text" value="" name="timing1" required>
                         </div>
                            
                        <div class="form-group col-md-4">
                            <label>Date 2</label>
                             <input id="picker2"  class="form-control" size="30" style="width: 150px" type="text" value="" name="timing2" required>
                         </div>
                            
                        <div class="form-group col-md-4">
                            <label>Date 3</label>
                             <input id="picker3"  class="form-control" size="30" style="width: 150px" type="text" value="" name="timing3" required>
                         </div>
                        </div>
                        <div class="form-btn-wrap">
                            <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="row_id" value="<?php echo $row_id; ?>">
                            <input type="hidden" name="recruiter_id" value="<?php echo $recruiter_id; ?>">
                            <input type="hidden" name="action" value="submit_interview_timimgs">
                            <input type="submit" id="submit_timimgs" value="Submit" class="my-btn my-btn-2">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
?>



<?php include(TEMPLATEPATH.'/footer-dashboard.php');  ?>