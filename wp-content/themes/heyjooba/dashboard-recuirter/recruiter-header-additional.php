<?php
global $post;
$id = get_current_user_id();
$job_ids_s = array();
$current_date = date('Y-m-d');
$current_timestamp =  strtotime($current_date);  

/**********Jobs having candidates *******************/

$active_jobs = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` ='" . $id . "' AND  `shared_status` = 0 AND status NOT IN('save','rejected','offer-accepted','contract-signed','pending')");

foreach($active_jobs as $sv_j){
  $job_ids[] = $sv_j->job_id;
} 
$job_ids = array_unique($job_ids);

/************Jobs saved by recruiter***************************/

$saved_jobs_s = $wpdb->get_results("SELECT job_id FROM job_status WHERE recruiter_id='".$id."' AND status LIKE 'saved'");

foreach($saved_jobs_s as $sv_j_s){
$post_statys = get_post_status($sv_j_s->job_id);
    if($post_statys == 'publish'){
        $job_ids_s[] = $sv_j_s->job_id;
    }
}
$sv_job = count($job_ids_s);

/**********All jobs that matches the expertise area of recruiter*************/

$all_jobs = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_status` LIKE 'publish' AND `post_type` LIKE 'jobs'");


$expertise_area = get_field('expertise_area','user_'.$id);

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
        $job_end_date = strtotime(get_field('job_closing_date',$job->ID));
        if(in_array($technical_skill_array,$expert_area_rec) && $job_end_date >= $current_timestamp){
            $dis_active_jobs[] = $job->ID;
        }
    }
}

/*******Active Candidates*********/

$act_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status`NOT IN ('save','rejected','offer-accepted','pending','contract-signed') AND `shared_status` = 0");

/**********Pending Offers**********************/

$pending_offers = array();
$offered_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` IN ('offer-pending','offer-accepted') AND `shared_status` = 0");
foreach($offered_candidates as $pending_offers_cand){
   $candidate_pending_offer_ID =  $pending_offers_cand->ID;
    $offers = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE 'offer_candidate_id' AND `meta_value` LIKE '$candidate_pending_offer_ID'");
     if(get_post_status($offers[0]->post_id == 'publish')){
       $pending_offers[] = $offers[0]->post_id; 
    }
}

?>
<?php include(TEMPLATEPATH.'/dashboard-recuirter/rating-section.php'); ?>
  <div class="counter-wrap cmn-mg-btm">
                <div class="my-row">
                    <div class="counter-content bg-white-shadow">
                        <a href="<?php echo get_the_permalink(242);?>">
                        <h3><?php echo count($dis_active_jobs); ?></h3>
                        <h6>New Job Matches</h6>
                        </a>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <a href="<?php echo get_the_permalink(238);?>">
                        <h3><?php echo count($job_ids); ?></h3>
                        <h6>Your Active Jobs</h6>
                        </a>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <a href="<?php echo get_the_permalink(240);?>">
                        <h3><?php echo $sv_job; ?></h3>
                        <h6>Your Saved Jobs</h6>
                        </a>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <a href="<?php echo get_the_permalink(98); ?>">
                        <h3><?php echo count($act_candidates); ?></h3>
                        <h6>Active Candidates</h6>
                        </a>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <a href="<?php echo get_the_permalink(699); ?>">
                        <h3><?php echo count($pending_offers); ?></h3>
                        <h6>All Offers</h6>
                        </a>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <h3>£ 36,250.00</h3>
                        <h6>Earnings in 2021</h6>
                    </div>
                </div>
</div>