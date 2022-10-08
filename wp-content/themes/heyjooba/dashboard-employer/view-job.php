<?php 
/*
Template Name:Employer View Job
*/
include(TEMPLATEPATH.'/header-dashboard.php');

$job_id = $_GET['job_id'];
$author_id= get_post_field ('post_author', $job_id);

$company_logo = get_field('company_logo','user_'.$author_id);
$company_name = get_field('business_name','user_'.$author_id);

$job_title = get_the_title($job_id);
$location = get_field('jobs_job_location',$job_id);
$emp_type = get_field('employement_type',$job_id);
$job_closing_date = get_field('job_closing_date',$job_id);
$earlist_date = get_field('earliest_start_date',$job_id);
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
   
/****************Technical skills******************/

$skills = get_field('skills',$job_id);

/*********************Experiences***********************************/

$exper = get_field('experience_added',$job_id);


/**************Soft Skills********************/

$soft_skills = get_field('job_soft_skill',$job_id);

    
$what = get_field('what_will_you_do',$job_id);
$exp = get_field('you_will_have_experience_in',$job_id);
$stand = get_field('what_will_make_someone_stand_out',$job_id);
$avoid = get_field('what_we_want_to_avoid',$job_id);
$fee =  get_field('fee_level',$job_id);
?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>View your Job</h4>
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
                                        <div class="form-group d-flex col-md-6">
                                            <label>JOB TITLE: </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $job_title; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>EMPLOYEMENT TYPE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $emp_type; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>JOB CLOSING DATE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $job_closing_date; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>EARLIEST START DATE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $earlist_date; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>LOCATION : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $location; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>ONSITE/REMOTE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $job_type; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>SENIORITY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $seniority; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>SALARY BRACKET : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $salary; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>EQUITY : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $equity; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>HOLIDAYS : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $holidays; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>BONUS AVAILABALE : </label>
                                            <input type="text" class="form-control blank-field disabled"
                                                value="<?php echo $bonus; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>PRIVATE HEALTHCARE/DENTAL : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $health; ?>">
                                        </div>
                                          <div class="form-group d-flex col-md-6">
                                            <label>ANY OTHER BENIFITS : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $benifits; ?>">
                                        </div>
                                          <div class="form-group d-flex col-md-6">
                                            <label>OFFER SPONSORSHIP : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $sponsorship; ?>">
                                        </div>
                                          <div class="form-group d-flex col-md-6">
                                            <label>IR35 STATUS : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $ir35_status; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
                                            <label>UNIVERSITY OF INTEREST : </label>
                                            <input type="text" class="form-control blank-field disabled" value="<?php echo $uni_int; ?>">
                                        </div>
                                        <div class="form-group d-flex col-md-6">
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
                        <div class="offer-wrap form-heading col-md-12">
                            <div class="offer-content cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-0">
                                        <label>The candidate will have experience in...</label>
                                        <textarea class="form-control" placeholder="Write a here..." name="what_wil_you_do"><?php echo $exp; ?></textarea>
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
        </div>
  </section>

<?php include(TEMPLATEPATH.'/footer-dashboard.php');  ?>
