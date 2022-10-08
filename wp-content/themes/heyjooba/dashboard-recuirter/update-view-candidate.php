<?php 
/*
Template Name:Update Candidate
*/
include(TEMPLATEPATH.'/header-recruiter.php');
$row_id = $_GET['r'];
$id = get_current_user_id();
global $wpdb;
$candidate_data = $wpdb->get_results("SELECT candidate_data FROM save_candidate WHERE ID=$row_id");
$cand_data = $candidate_data[0]->candidate_data;
$dis_can_data = unserialize($cand_data);

$name = $dis_can_data['name'];
$lives = $dis_can_data['lives'];
$email = $dis_can_data['email'];
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

$soft_skills = $dis_can_data['soft_skills_name'];
$soft_skills_level = $dis_can_data['soft_skills_level'];

/************Technical Skills*****************/

$skills = $dis_can_data['skill'];
$techskills_levels = $dis_can_data['skill_level'];

$note = $dis_can_data['note_from_recruiter'];
$cv = wp_get_attachment_url($dis_can_data['cv']);
$video_attach = wp_get_attachment_url($dis_can_data['video_atachment']);
$intro_video_atachment = wp_get_attachment_url($dis_can_data['intro_video_atachment']);
$add_info_atachment = wp_get_attachment_url($dis_can_data['add_info_atachment']);
$profile_image = wp_get_attachment_url($dis_can_data['candidate_profile_image']);

$recruiter_fname = get_user_meta($dis_can_data['recruiter_id'],'first_name',true);
$recruiter_lastname = get_user_meta($dis_can_data['recruiter_id'],'last_name',true);
$rec_name = $recruiter_fname.' '.$recruiter_lastname;
$job_id = $dis_can_data['job_id'];
$emp_id = get_post_field ('post_author', $job_id);
$time_stamp = $dis_can_data['time_stamp'];


$soft_skills_choose = get_field('soft_skills', 'options');
$soft_skill_count = count($soft_skills_choose);

?>

<section class="dashboard-section">
        <div class="dashboard-main-content">
       <?php include(TEMPLATEPATH.'/dashboard-recuirter/rating-section.php'); ?>
            <div class="submit-candidate-wrap my-form">
                <form id="update_candidate_profile">
                    <div class="row">
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="flex-heading mb-4">
                                </div>
                                <div class="submit-content">
                                    <div class="row">
                                        <div class="form-group d-flex col-md-6">
                                            <label>NAME : </label>
                                            <input type="text" class="form-control blank-field "
                                                name="name" value="<?php echo $name; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>LIVES : </label>
                                            <input type="text" class="form-control blank-field "
                                              name="lives"  value="<?php echo $lives; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>EMAIL : </label>
                                            <input type="email" class="form-control blank-field " name="email" value="<?php echo $email; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>EMPLOYMENT STATUS : </label>
                                            <input type="text" class="form-control blank-field "
                                               name="emp_status" value="<?php echo $emp_status; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>AVAILABILITY : </label>
                                            <input type="text" class="form-control blank-field "
                                             name="availablity"   value="<?php echo $avail; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>CURRENT SALARY : </label>
                                            <input type="text" class="form-control blank-field "
                                              name="current_salary"  value="<?php echo $c_salary; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>CURRENT POSITION : </label>
                                            <input type="text" class="form-control blank-field "
                                              name="current_position"  value="<?php echo $c_pos; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>CURRENT EMPLOYER : </label>
                                            <input type="text" class="form-control blank-field "
                                              name="current_employer"  value="<?php echo $c_emp; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>SALARY EXPECTATION : </label>
                                            <input type="text" class="form-control blank-field "
                                              name="salary_expectation"  value="<?php echo $sal_expec?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>WORKING PREFERANCE : </label>
                                            <input type="text" class="form-control blank-field "
                                               name="working_perference" value="<?php echo $work_pref; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>QUALIFICATION : </label>
                                            <input type="text" class="form-control blank-field "
                                              name="qualification"  value="<?php echo $qual; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>UNIVERSITY : </label>
                                            <input type="text" class="form-control blank-field "
                                               name="university" value="<?php echo $univers; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>ADDITIONAL QUALIFICATIONS : </label>
                                            <input type="text" class="form-control blank-field " name="additional_qualification" value="<?php echo $add_qual; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="update_candidate_profile_image" onchange="loadFile(event);">
                                                <label for="imageUpload"></label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url('<?php if(!empty($profile_image)){echo $profile_image;  }else{ echo get_template_directory_uri(); ?>/images/dummy.jpg <?php }?>');">
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
                                    <?php
                                    if(!empty($skills)){
                                        $var = 0;
                                        foreach ($skills as $tech_skl) { ?>
                                    <div class="col-md-6">
                                        <div class="tech_skil_input form-group">
                                            <input type="text" name="skill[]" value="<?php echo $tech_skl; ?>" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6 tech_skl_level">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Please choose any option</option>
                                                <option value="novoice" <?php if ($techskills_levels[$var] == 'novoice') {
                                            echo 'selected';
                                        } ?>>Novoice</option>
                                                <option value="beginner" <?php if ($techskills_levels[$var] == 'beginner') {
                                            echo 'selected';
                                        } ?>>Beginner</option>
                                                <option value="competent" <?php if ($techskills_levels[$var] == 'competent') {
                                            echo 'selected';
                                        } ?>>Competent</option>
                                                <option value="proficient" <?php if ($techskills_levels[$var] == 'proficient') {
                                            echo 'selected';
                                        } ?>>Proficient</option>
                                                <option value="expert" <?php if ($techskills_levels[$var] == 'expert') {
                                            echo 'selected';
                                        } ?>>Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    $var++;
                                    }
                                    }else{ ?>
                                    <div class="col-md-6">
                                        <div class="tech_skil_input form-group">
                                            <input type="text" name="skill[]" value="" class="form-control job_skill" placeholder="Add Technology">
                                        </div>
                                    </div>
                                    <div class="col-md-6 tech_skl_level">
                                        <div class="form-group">
                                            <select class="form-control" name="skill_level[]">
                                                <option value="">Please choose any option</option>
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
                                                <option value="">Please choose any option</option>
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
                                                <option value="">Please choose any option</option>
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
                                                <option value="">Please choose any option</option>
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
                                                <option value="">Please choose any option</option>
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
                                                <option value="">Please choose any option</option>
                                                <option value="novoice">Novoice</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="competent">Competent</option>
                                                <option value="proficient">Proficient</option>
                                                <option value="expert">Expert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="add_skil">
                                    </div>
                                    <button class="btn btn-red" type="button" onclick="add_more_technical_skills();">Click to add more skills</button>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="Submit-wrap form-heading col-md-6">
                            <h5>Soft skills required</h5>
                                <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row add-skills">
                                
                                    <?php
                                      if(!empty($soft_skills)){
                                          $dy = 0;
                                          foreach($soft_skills as $job_soft_skl) {
                                    ?>
                                    <div class="col-md-6 soft_skils" id="soft_skills_name">
                                        <div class="form-group">
                                            <select class="form-control skill_count" placeholder="Add Skills" name="soft_skills_name[]">
                                                <option value="">Choose any option</option>
                                                <?php
                                            foreach ($soft_skills_choose as $soft_skill_chose) { ?>
                                                <option value="<?php echo $soft_skill_chose['soft_skills_name']; ?>" <?php if ($job_soft_skl == $soft_skill_chose['soft_skills_name']) {
                                                echo 'selected';
                                            } ?>><?php echo $soft_skill_chose['soft_skills_name']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                     
                                    <div class="col-md-6" id="soft_skills_level">
                                        <div class="form-group"><select class="form-control" name="soft_skills_level[]">
                                            <option value="">Choose any option</option>
                                            <option value="excellent" <?php if ($soft_skills_level[$dy] == 'excellent') {
                                                    echo 'selected';
                                                } ?>>Excellent</option>
                                            <option value="good" <?php if ($soft_skills_level[$dy] == 'good') {
                                                    echo 'selected';
                                                } ?>>Good</option>
                                            <option value="medium" <?php if ($soft_skills_level[$dy] == 'medium') {
                                                    echo 'selected';
                                                } ?>>Medium</option>
                                            <option value="poor" <?php if ($soft_skills_level[$dy] == 'poor') {
                                                    echo 'selected';
                                                } ?>>Poor</option>
                                            <option value="very_bad" <?php if ($soft_skills_level[$dy] == 'very_bad') {
                                                    echo 'selected';
                                                } ?>>Very bad</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php  
                                          $dy++;
                                          }   
                                      }else{ ?>
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
                                        <textarea class="form-control" placeholder="Russell has worked with a number of current AT&T employees previously and is confident they would highly recommend him. Has recently worked on very similar projects to the projects he would be working on if chosen for the AT&T job." name="note_from_recruiter"><?php echo $note; ?></textarea>
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
                        <div class="submit-wrap form-heading col-md-12">
                            <div class="upload-files-wrapper">
                                <div class="upload-files-wrap">
                                    <div class="upload-btn-wrap">
                                        <label>
                                            <input type="file" class="files" name="update_cv" accept="application/pdf">
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
                                            <input type="file" class="files" name="update_video_atachment">
                                            <span class="upload-content" accept="video/mp4,video/x-m4v,video/">
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
                                            <input type="file" class="files" name="update_intro_video_atachment" accept="video/mp4,video/x-m4v,video/">
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
                                            <input type="file" class="files" name="update_add_info_atachment">
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
                        <div class="form-group mb-btn cmn-mg-btm col-md-12">
                                <div class="form-btn-wrap">
                                    <a href="<?php echo $cv; ?>" class="my-btn doc-btn employer-doc">View CV</a>
                                    <a href="<?php echo $video_attach; ?>" class="my-btn doc-btn employer-doc">Video Attachment</a>
                                    <a href="<?php echo $intro_video_atachment; ?>" class="my-btn doc-btn employer-doc">Intro Video</a>
                                    <a href="<?php echo $add_info_atachment; ?>" class="my-btn doc-btn employer-doc">Additional Info</a>
                                </div>
                            <input type="hidden" name="row_id" value="<?php echo $row_id; ?>">
                            <input type="hidden" name="recruiter_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                            <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">
                            <input type="hidden" name="time_stamp" value="<?php echo $time_stamp; ?>">
                            
                            <input type="hidden" name="cv" value="<?php echo $dis_can_data['cv']; ?>">
                            <input type="hidden" name="video_atachment" value="<?php echo $dis_can_data['video_atachment']; ?>">
                            <input type="hidden" name="intro_video_atachment" value="<?php echo $dis_can_data['intro_video_atachment']; ?>">
                            <input type="hidden" name="add_info_atachment" value="<?php echo $dis_can_data['add_info_atachment']; ?>">
                            <input type="hidden" name="candidate_profile_image" value="<?php echo $dis_can_data['candidate_profile_image']; ?>">
                            
                            <input type="hidden" name="action" value="update_candidate_profile">
                            <input type="submit" value="Update candidate" class="my-btn doc-btn employer-doc">
                            </div>
                           
                      
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </section>



<?php include(TEMPLATEPATH.'/footer-recruiter.php');  ?>