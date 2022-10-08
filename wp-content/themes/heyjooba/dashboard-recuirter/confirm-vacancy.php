<?php 
/*
Template Name:Confirm-vacancy
*/
?>
<!-- <!doctype html> -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>! Heyjobba !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" sizes="32x32" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-recuirter/css/main.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-recuirter/css/custom.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <input type="hidden" id="admin-ajax" value="<?php echo admin_url('admin-ajax.php'); ?>">
</head>

<body class="bg-white-grey">
<?php
if(!empty($_GET['enrl'])){
    $job_id = $_GET['ji'];
   update_candidate_status($_GET['enrl'],$job_id);
    
}


$author_id= get_post_field ('post_author', $job_id);

$company_logo = get_field('company_logo','user_'.$author_id);
$company_name = get_field('business_name','user_'.$author_id);

$job_title = get_the_title($job_id);
$location = get_field('jobs_job_location',$job_id);
$emp_type = get_field('employement_type',$job_id);
$job_closing_date = get_field('job_closing_date',$job_id);
$job_type = get_field('job_type',$job_id);
$seniority = get_field('seniority',$job_id);
$salary = get_field('salary_required',$job_id);
$equity = get_field('equity',$job_id);
$holidays = get_field('holidays',$job_id);
$bonus = get_field('bonus_available',$job_id);
$health = get_field('healthcare',$job_id);
$benifits = get_field('other_benifits',$job_id);
$sponsorship = get_field('offer_sponsorship',$job_id);
$ir35_status = get_field('ir35_status',$job_id);
$uni_int = get_field('university_of_interest',$job_id);
$trvl = get_field('travel_required',$job_id);
   
/***********Soft Skills*****************/
    
$soft_skills = get_field('job_soft_skill',$job_id);
    
/****************Technical skills******************/

$skills = get_field('skills',$job_id);

/*********************Experiences***********************/

$exper = get_field('experience_added',$job_id);
    
$what = get_field('what_will_you_do',$job_id);
$stand = get_field('what_will_make_someone_stand_out',$job_id);
$avoid = get_field('what_we_want_to_avoid',$job_id);
$fee =  get_field('fee_level',$job_id);

?> 
<section class="dashboard-section confirm">
    <div class="container">
        <div class="">
            <?php
            $current_date = date('Y-m-d');
            $current_timestamp = strtotime($current_date);

            $job_closing_date = get_field('job_closing_date',$job_id);
            $close_timestamp = strtotime($job_closing_date);

            if($current_timestamp <= $close_timestamp){
            ?>
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>View Job Post</h4>
                </div>
            
            </div>
            <div class="submit-candidate-wrap my-form">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="submit-wrap form-heading cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="flex-heading mb-4">
                                    <h4><?php echo $job_title; ?> - <?php echo $location; ?> - <?php echo $company_name; ?></h4>
                                    <button type="button" class="my-btn my-btn-1" >Fee <?php echo $fee; ?></button>
                                    <figure class="company-logo">
                                        <?php
                                        if(!empty($company_logo)){ ?>
                                          <img src="<?php echo $company_logo; ?>" class="comp_logo">  
                                        <?php }else{ ?>
                                            <img src="<?php echo get_template_directory_uri();?>/images/dummy.jpg" alt="company-logo"> 
                                        <?php }
                                        ?>
                                        
                                    </figure>
                                </div>
                                <div class="submit-content">
                                    <div class="row">
                                        <div class="form-group d-flex col-md-4">
                                            <label>JOB TITLE: </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $job_title; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>EMPLOYEMENT TYPE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $emp_type; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>JOB CLOSING DATE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                            value="<?php echo date('d M,Y',strtotime($job_closing_date)); ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>LOCATION : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $location; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>ONSITE/REMOTE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $job_type; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>SENIORITY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $seniority; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>SALARY BRACKET : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $salary; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>EQUITY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $equity; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>HOLIDAYS : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $holidays; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>BONUS AVAILABALE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $bonus; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>PRIVATE HEALTHCARE/DENTAL : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $health; ?>">
                                        </div>
                                          <div class="form-group d-flex col-md-4">
                                            <label>ANY OTHER BENIFITS : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $benifits; ?>">
                                        </div>
                                          <div class="form-group d-flex col-md-4">
                                            <label>OFFER SPONSORSHIP : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $sponsorship; ?>">
                                        </div>
                                          <div class="form-group d-flex col-md-4">
                                            <label>IR35 STATUS : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $ir35_status; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>UNIVERSITY OF INTEREST : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $uni_int; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-4">
                                            <label>TRAVEL REQUIRED : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $trvl; ?>">
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
                                    foreach($skills as $skill){ 
                                    if($skill['job_skill_name'] != ''){
                                    ?>
                                    <div class="form-group col-md-6">
                                   <input type="text" value="<?php echo $skill['job_skill_name']; ?>" class="form-control" readonly >
                                    </div>
                                    <div class="form-group col-md-6">
                                    <input type="text" value="<?php echo $skill['job_skill_rating']; ?>" class="form-control" readonly >
                                    </div>
                                    <?php }
                                    }
                                    ?>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-6">
                            <h5>Desired areas of Experiences</h5>
                            <div class="submit-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row add-skills">
                                    
                                    <?php
                                    foreach($exper as $expe){ 
                                    if($expe['exp_field_name'] != ''){
                                    ?>
                                    <div class="form-group col-md-6">
                                    <input type="text" value="<?php echo $expe['exp_field_name']; ?>" class="form-control" readonly >
                                     </div>
                                    <div class="form-group col-md-6">
                                    <input type="text" value="<?php echo $expe['years_of_experience']; ?>" class="form-control" readonly >
                                    </div>
                                    <?php }
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
                                    foreach($soft_skills as $soft_skill_name){ 
                                    if($soft_skill_name['job_soft_skill_name'] != ''){
                                    ?>
                                     <div class="form-group col-md-6">
                                    <input type="text" value="<?php echo $soft_skill_name['job_soft_skill_name']; ?>" class="form-control" readonly >
                                    </div>
                                    <div class="form-group col-md-6">
                                    <input type="text" value="<?php echo $soft_skill_name['job_soft_skill_level']; ?>" class="form-control" readonly >
                                    </div>   
                                    <?php }
                                    }
                                    ?>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="submit-wrap form-heading col-md-12">
                       
                         <div class="row">
                           <div class="offer-wrap form-heading col-md-12">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>What the candidates will do...</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="what_wil_you_do">Something</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="offer-wrap form-heading col-md-12">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>What will you do...</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="what_wil_you_do"><?php echo $what; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="offer-wrap form-heading col-md-6">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>What will make the candidates stand out...</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="what_wil_you_do"><?php echo $stand; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="offer-wrap form-heading col-md-6">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>What we want to avoid...</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="what_wil_you_do"><?php echo $avoid; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                    </div>
                </form>
            </div>
            <?php
            }else{ ?>
               <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>Sorry! This job has been expired.</h4>
                </div>
            
            </div> 
           <?php }
            ?>
        </div>
    </div>
    </section>
<!-- jQuery first, then Bootstrap JS. -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <script src="<?php echo get_template_directory_uri();?>/dashboard-recuirter/js/bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script src="<?php echo get_template_directory_uri();?>/dashboard-recuirter/js/custom.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/dashboard-recuirter/js/recruiter-custom-data.js"></script>
    <?php// wp_footer(); ?>
</body>

</html>
