<?php 

include(TEMPLATEPATH.'/header-recruiter.php');
global $post;
$rec_id = get_current_user_id();
$li_job = array();

if(!empty($_GET['id'])){
 $job_id = $_GET['id']; 
}else{
 $job_id = $post->ID;   
}   
if(!empty($_GET['enrl'])){
   update_candidate_status($_GET['enrl']); 
}
/**********For disble button o job expiration************/

$job_end_date = strtotime(get_field('job_closing_date',$job_id));
$current_timestamp =  strtotime($current_date);

$author_id= get_post_field ('post_author', $job_id);

$company_logo = get_field('company_logo','user_'.$author_id);
$company_name = get_field('business_name','user_'.$author_id);
$earlist_startdate = get_field('earliest_start_date',$job_id);
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

/*********************Experiences***********************************/

$exper = get_field('experience_added',$job_id);
    
$what = get_field('what_will_you_do',$job_id);
$stand = get_field('what_will_make_someone_stand_out',$job_id);
$avoid = get_field('what_we_want_to_avoid',$job_id);
$fee =  get_field('fee_level',$job_id);

$saved_jobs = $wpdb->get_results("SELECT job_id FROM job_status WHERE job_id='".$job_id."' AND status LIKE 'saved'");

$live_jobs = $wpdb->get_results("SELECT job_id FROM job_status WHERE job_id='".$job_id."' AND status LIKE 'live'");

$chk_live_jobs = $wpdb->get_results("SELECT job_id FROM job_status WHERE status LIKE 'live'");


$all_jobs = $wpdb->get_results("SELECT ID FROM `wp_posts` WHERE `post_status` LIKE 'publish' AND `post_type` LIKE 'jobs'");

$hold_jobs = $wpdb->get_results("SELECT job_id FROM job_status WHERE recruiter_id	 = $rec_id AND status LIKE 'hold'");

foreach($hold_jobs as $hld_job){
    $results_hold[] = $hld_job->job_id;
}

/*** getting similar jobs ***/

$expertise_area = get_field('expertise_area','user_'.$rec_id);
$similar_job_ids = array();

/** rec experties start **/
foreach($expertise_area as $expert_ara){
    $expert_area_rec[] = $expert_ara['rec_expertise_area'];
}
/** rec experties end **/

/** all jobs skills start **/
$dis_active_jobs = array();
foreach($all_jobs as $job){
    $technical_skills = get_field('skills',$job->ID);
    
    foreach($technical_skills as $technical_skill){
        $technical_skill_array = $technical_skill['job_skill_name'];
        if(in_array($technical_skill_array,$expert_area_rec)){
            $similar_job_ids[] = $job->ID;
        }
    }
}

$strClosing = strtotime($job_closing_date);
$currentDate = strtotime(date('Y-m-d'));
?> 
<section class="dashboard-section">
        <div class="dashboard-main-content">
            <div class="job-search-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="dashboard-heading">
                    <h4>View Job Post</h4>
                    
                    <?php if($currentDate <= $strClosing){ ?>
                <div class="rating-wrap">
                    <?php
                    if(empty($live_jobs)){
                     if(empty($_GET['enrl'])){
                    ?>
                       <a href="javascript:void(0)" class="my-btn my-btn-1" onclick="live_job(<?php echo $job_id; ?>,<?php echo $rec_id; ?>)">Commit to vacancy</a> 
                    <?php
                    }
                    }
                    if($job_id != $live_jobs[0]->job_id){
                    if($job_id != $saved_jobs[0]->job_id){
                     ?>
                    <a href="javascript:void(0)" class="my-btn my-btn-1" onclick="save_later(<?php echo $job_id; ?>,<?php echo $rec_id; ?>)">Save for later</a>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    if($job_id == $live_jobs[0]->job_id){
                    if(empty($_GET['enrl'])){ ?>
                    <a href="<?php echo get_the_permalink(54);?>?job_id=<?php echo $job_id;?>" class="my-btn my-btn-1">Submit Candidate</a> 
                    <?php }
                    }
                    ?>
                    
                </div>
                    <?php } ?>
                </div>
            
            </div>
            <div class="submit-candidate-wrap my-form">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="submit-wrap form-heading cmn-padding bg-white-shadow cmn-mg-btm">
                                <div class="flex-heading mb-4">
                                    <h4><?php echo $job_title; ?> - <?php echo $location; ?> - <?php echo $company_name; ?></h4>
                                    <button type="button" class="my-btn my-btn-1 d-none" >Fee <?php echo $fee; ?></button>
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
                                            <label>EARLIEST START DATE: </label>
                                            <input type="text" class="form-control blank-field" value="<?php echo date('d M,Y',strtotime($earlist_startdate)); ?>" disabled>
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
<!--
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
-->
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
                        <div class="filter-tag-wrap cmn-padding bg-white-shadow cmn-mg-btm">
                <div class="tag-heading">
                    <h6>Similar live vacancies:</h6>
                 
                </div>
                <div class="filter-result-wrap">
                   <?php
                    foreach($similar_job_ids as $similar_jobs){
                        $post_date = strtotime(get_the_date('d-m-Y'));
                        $today_date = strtotime(date('d-m-Y'));
//                        $datediff = abs($today_date - $post_date)/86400;
                        
                        if($similar_jobs != $job_id && get_post_status($similar_jobs) == 'publish'){
                        $employer_id = get_field('employer_id',$similar_jobs);
                        $compay_name = get_field('business_name','user_'.$employer_id);
                        ?>
                    <article class="job-infor-wrapper">
                        <h4><?php echo get_the_title($similar_jobs); ?></h4>
                        <p><?php echo $compay_name; ?></p>
                        <?php
                        if(in_array($similar_jobs,$results_hold)){ ?>
                         <p>Job on Hold</p>   
                        <?php }
                        ?>
                        
                        
                        <ul class="job-details">
                            <li>
                                <span><img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/job-description-1.png" alt="img"></span>
                                <?php $job_exp = get_field('experience_added',$similar_job_id);
                                foreach($job_exp as $job_ex){
                                  echo $job_ex['exp_field_name'].' ';  
                                }
                                ?>
                            </li>
                            <li>
                                <span>£</span>
                                <?php echo get_field('salary_required',$similar_job_id); ?>
                            </li>
                            <li>
                                <span><img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/job-description-2.png" alt="img"></span>
                                <?php echo get_field('jobs_job_location',$similar_job_id); ?>/ <?php echo get_field('job_type',$similar_job_id); ?>
                            </li>
                            <li>
                                <span><img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/job-description-3.png" alt="img"></span>
                                <?php 
                                $skills = get_field('skills',$similar_job_id);
                                foreach($skills as $skil)
                                {
                                  echo $skil['job_skill_name'].' . '; 
                                }
                                ?>
<!--                                JavaScript . NodeJS . Python . Financial Services-->
                            </li>
                        </ul>
                        <ul class="job-post-details">
                            <li>
                                Posted 6 days ago
                            </li>
                            <li>
                                <?php
                                $close_date = get_field('job_closing_date',$similar_job_id); ?>
                                Closes <?php echo date('d.m.Y',strtotime($close_date)); ?>
                             
                            </li>
                        </ul>
                    </article>
                   <?php }
                    }
                  ?>
                </div>
            </div>
            <div class="form-group cmn-mg-btm col-md-12">
                <div class="form-btn-wrap">
                <?php
                    if(empty($live_jobs)){
                     if(empty($_GET['enrl'])){
                    ?>
                       <a href="javascript:void(0)" class="my-btn my-btn-1" onclick="live_job(<?php echo $job_id; ?>,<?php echo $rec_id; ?>)">Commit to vacancy</a> 
                    <?php
                    }
                    }
                    if($job_id != $live_jobs[0]->job_id){
                    if($job_id != $saved_jobs[0]->job_id){
                     ?>
                    <a href="javascript:void(0)" class="my-btn my-btn-1" onclick="save_later(<?php echo $job_id; ?>,<?php echo $rec_id; ?>)">Save for later</a>
                    <?php
                        }
                    }
                    ?>
                </div>
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
                            <button class="my-btn my-btn-2">Submit Candidate</button>
                            <button class="my-btn my-btn-2">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include(TEMPLATEPATH.'/footer-recruiter.php');  ?>
