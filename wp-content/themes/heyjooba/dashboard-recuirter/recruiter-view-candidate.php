<?php 
/*
Template Name:Recruiter View Candidate
*/
include(TEMPLATEPATH.'/header-recruiter.php');
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
$recruiter_fname = get_user_meta($dis_can_data['recruiter_id'],'first_name',true);
$recruiter_lastname = get_user_meta($dis_can_data['recruiter_id'],'last_name',true);
$rec_name = $recruiter_fname.' '.$recruiter_lastname;
?>

<section class="dashboard-section">
        <div class="dashboard-main-content">
      <?php include(TEMPLATEPATH.'/dashboard-recuirter/rating-section.php'); ?>
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
<!--
                                    <div class="form-group col-md-12">
                                        <div class="attach-file-wrap">
                                            <label>
                                                <input type="file">
                                                <span class="my-btn my-btn-3">
                                                    <span class="attach-icon">
                                                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                                                    </span>
                                                    Attach FIle
                                                </span>
                                            </label>
                                            <p class="attach-file-name"></p>
                                        </div>
                                    </div>
-->
                                </div>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm pt-0">
                                <div class="documents-btn-wrap">
                                    <a href="<?php echo $cv; ?>" class="my-btn doc-btn employer-doc">CV</a>
                                    <a href="<?php echo $video_attach; ?>" class="my-btn doc-btn employer-doc">Video Attachment</a>
                                    <a href="<?php echo $intro_video_atachment; ?>" class="my-btn doc-btn employer-doc">Intro Video</a>
                                    <a href="<?php echo $add_info_atachment; ?>" class="my-btn doc-btn employer-doc">Additional Info</a>
                                </div>
                            </div>
                        </div>
<!--
                        <div class="form-group cmn-mg-btm col-md-12">
                            <div class="form-btn-wrap">
                                <button type="button" class="my-btn my-btn-3" data-bs-toggle="modal"
                                    data-bs-target="#SubmitCandidate">View CV</button>
                                <button type="button" class="my-btn my-btn-3">Share CV</button>
                                <button type="button" class="my-btn my-btn-3">Arrange Interview</button>
                                <button type="button" class="my-btn my-btn-3">Reject Candidate</button>
                            </div>
                        </div>
-->
                    </div>
                </form>
            </div>
        </div>
    </section>



<?php include(TEMPLATEPATH.'/footer-recruiter.php');  ?>