<?php 
/*
Template Name:Submit Candidate
*/
include(TEMPLATEPATH.'/header-recruiter.php');
$id = get_current_user_id();
$job_id = $_GET['job_id'];
$emp_id = get_post_field ('post_author', $job_id);
$company_name = get_field('business_name','user_'.$emp_id);
$company_logo = get_field('company_logo','user_'.$emp_id);
if(empty($company_logo)){
    $company_logo = get_template_directory_uri().'/images/dummy.jpg';   
}

/**********Soft skills***********/

$soft_skills_choose = get_field('soft_skills', 'options');
$soft_skill_count = count($soft_skills_choose);

$current_time_stamp = strtotime(date('Y-m-d h:i:s'));
?> 

<section class="dashboard-section">
        <div class="dashboard-main-content">
       <?php include(TEMPLATEPATH.'/dashboard-recuirter/rating-section.php'); ?>
            <div class="submit-candidate-wrap my-form">
                <form id="submit_candidate">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="submit-wrap form-heading cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="flex-heading mb-4">
                                    <h4><?php echo get_the_title($job_id); ?> - <?php echo get_field('jobs_job_location',$job_id); ?> - <?php echo $company_name; ?></h4>
                                    <figure class="company-logo">
                                        <img src="<?php echo $company_logo; ?>" alt="company-logo">
                                    </figure>
                                </div>
                            <div class="submit-content">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>NAME:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>LIVES:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="lives">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>EMAIL:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="email">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label>EMPLOYEMENT STATUS:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="emp_status">
                                    </div>
                                        <div class="form-group col-md-4">
                                        <label>AVAILABILITY:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="availablity">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label>CURRENT SALARY:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="current_salary">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>CURRENT POSITION:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="current_position">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>CURRENT EMPLOYER:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="current_employer">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>SALARY EXPECTATIONS:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="salary_expectation">
                                    </div>
                                  <div class="form-group col-md-4">
                                        <label>WORKING PREFERENCES:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="working_perference">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label>QUALIFICATION:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="qualification">
                                    </div>
                                   <div class="form-group col-md-4">
                                        <label>UNIVERSITY:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="university">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>ADDITIONAL QUALIFICATION:</label>
                                        <input type="text" class="form-control" placeholder="Robert" name="additional_qualification">
                                    </div>
                                    <div class="form-group col-md-4">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="candidate_profile_image" onchange="loadFile(event);">
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url('<?php  echo get_template_directory_uri(); ?>/images/dummy.jpg');">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-6">
                            <h5>Desired technology skill strengths (None 0 to 10 Excellent)</h5>
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm equal-fields">
                                <div class="row add-skills">
                                    <div class="col-md-6">
                                        <div class="tech_skil_input form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6 tech_skl_level">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add_skil">
                                    </div>
                                    <button class="btn btn-red" type="button" onclick="add_more_technical_skills();">Click to add more skills</button>
                                </div>
                            </div>
                        </div>
                            <div class="Submit-wrap form-heading col-md-6">
                            <h5>
                                <span>Add Soft Skills</span>
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </h5>
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="col-md-6 soft_skils" id="soft_skills_name">
                                        <div class="form-group">
                                            <select class="form-control skill_count" placeholder="Add Skills" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils" id="soft_skills_level">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 soft_skils">
                                        <div class="form-group">
                                            <select class="form-control skill_count" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                        foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>"><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="soft_skills_level[]">
                                                <option value="">Choose any option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="medium">Medium</option>
                                                <option value="poor">Poor</option>
                                                <option value="very_bad">Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add_soft_skil">
                                    </div>
                                </div>
                                <button class="btn btn-red" type="button" onclick="add_soft_skills_level(<?php echo $soft_skill_count; ?>);">Click to add more skills</button>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control"
                                            placeholder="In your own words, please note why you think this candidate is a great fit for this vacancy…" name="note_from_recruiter"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="upload-files-wrapper">
                                <div class="upload-files-wrap">
                                    <div class="upload-btn-wrap">
                                        <label>
                                            <input type="file" class="files" name="cv" accept="application/pdf">
                                            <span class="upload-content">
                                                <span class="upload-icon">
                                                    <img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/upload-1.png" alt="upload-icon">
                                                </span>
                                                <span class="upload-text">Upload Candidates CV</span>
                                            </span>
                                            <p class="file-upload-filename"></p>
                                        </label>
                                    </div>
                                </div>
                                <div class="upload-files-wrap">
                                    <div class="upload-btn-wrap">
                                        <label>
                                            <input type="file" class="files" name="video_letter" accept="video/mp4,video/x-m4v,video/">
                                            <span class="upload-content">
                                                <span class="upload-icon">
                                                    <img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/upload-2.png" alt="upload-icon">
                                                </span>
                                                <span class="upload-text">Upload Candidate Cover Letter/Video</span>
                                            </span>
                                            <p class="file-upload-filename"></p>
                                        </label>
                                    </div>
                                </div>
                                <div class="upload-files-wrap">
                                    <div class="upload-btn-wrap">
                                        <label>
                                            <input type="file" class="files" name="intro_video" accept="video/mp4,video/x-m4v,video/">
                                            <span class="upload-content">
                                                <span class="upload-icon">
                                                    <img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/upload-3.png" alt="upload-icon">
                                                </span>
                                                <span class="upload-text">Upload Recruiters Candidate Intro
                                                    Video/Letter</span>
                                            </span>
                                            <p class="file-upload-filename"></p>
                                        </label>
                                    </div>
                                </div>
                                <div class="upload-files-wrap">
                                    <div class="upload-btn-wrap">
                                        <label>
                                            <input type="file" class="files" name="additional_info">
                                            <span class="upload-content">
                                                <span class="upload-icon">
                                                    <img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/upload-4.png" alt="upload-icon">
                                                </span>
                                                <span class="upload-text">Upload Any Additional Info</span>
                                            </span>
                                            <p class="file-upload-filename"></p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group cmn-mg-btm col-md-12">
                            <div class="form-btn-wrap">
                                <button type="button" class="my-btn my-btn-2" data-bs-toggle="modal"
                                    data-bs-target="#SubmitCandidate">Submit Candidate</button>
                                <input type="hidden" name="job_id" value="<?php echo $_GET['job_id']; ?> ">
                                <input type="hidden" name="emp_id" value="<?php echo $emp_id;  ?> ">
                                <input type="hidden" name="recruiter_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="time_stamp" value="<?php echo $current_time_stamp; ?>">
                                <input type="hidden" name="action" value="submit_candidate">
                                <input type="submit" value="submit my form" id="submit_my_form" style="display:none">
                                <button type="button" class="my-btn my-btn-2" id="save-application" onclick="save_application();">Save Application</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade my-modal" id="SubmitCandidate" tabindex="-1" aria-labelledby="SubmitCandidateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <div class="success-icon"></div>
                        <h4>Thanks for your submission</h4>
                        <p>
                            By pressing ‘Submit Candidate’ an authentication email will be emailed to your candidate in
                            the next 2 hours. They will need to click a link I that email confirming that they are aware
                            they are being put forward for this job
                        </p>
                        <div class="form-btn-wrap">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" id="sub_cand">Submit Candidate</button>
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include(TEMPLATEPATH.'/footer-recruiter.php');  ?>
