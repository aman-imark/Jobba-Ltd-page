<?php
/*
Template Name: Share Candidate Profile
*/

$row_id = base64_decode($_GET['r']);

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

/******************Technical Skills****************************/

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
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>! Heyjobba !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" sizes="32x32" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-employer/css/custom.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-employer/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <input type="hidden" id="admin-ajax" value="<?php echo admin_url('admin-ajax.php'); ?>">

</head>
    <section class="dashboard-section">
        <div class="container">
        <div class="view-candidate">
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>View Candidate</h4>
                </div>
                <div class="rating-wrap">
                    <div class="rating-wrap-inner">
                        <h6>RECRUITER:</h6>
                        <a href="#"><h6><?php echo $rec_name; ?></h6></a>
                    </div>
                    
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
                                        <div class="form-group d-flex col-md-4">
                                            <label>NAME : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $name; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>LIVES : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $lives; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>EMPLOYMENT STATUS : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $emp_status; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>AVAILABILITY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $avail; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>CURRENT SALARY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="£ <?php echo $c_salary; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>CURRENT POSITION : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $c_pos; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>CURRENT EMPLOYER : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $c_emp; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>SALARY EXPECTATION : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="£ <?php echo $sal_expec?> per annum">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>WORKING PREFERANCE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $work_pref; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>QUALIFICATION : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $qual; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>UNIVERSITY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $univers; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>ADDITIONAL QUALIFICATIONS : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $add_qual; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-6">
                            <h5>Candidates technology skill levels (None 0 to 10 Excellent)</h5>
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
                                <div class="documents-btn-wrap">
                                    <?php
                                    if(!empty($cv)){ ?>
                                        <embed src="<?php echo $cv; ?>#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf"   height="1000px" width="100%">
                                        <a href="<?php echo $cv; ?>" class="my-btn doc-btn employer-doc" download>Download CV</a> 
                                    <?php }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>

        <!-- jQuery first, then Bootstrap JS. -->
<script src="<?php echo get_template_directory_uri();?>/dashboard-employer/js/bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/dashboard-employer/js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/dashboard-employer/js/employer-custom-data.js"></script>