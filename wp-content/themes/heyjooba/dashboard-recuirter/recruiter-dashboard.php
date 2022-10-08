<?php
/*
Template Name:Recruiter Dashboard
*/
include(TEMPLATEPATH . '/header-recruiter.php');
global $wpdb;
$current_date = date('Y-m-d');
$current_timestamp =  strtotime($current_date);  
$user_id = get_current_user_id();
$name = get_user_meta($user_id, 'first_name', true);
$dis_active_jobs = array();
$dis_active_jobs_n = array();
$all_jobs = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_status` LIKE 'publish' AND `post_type` LIKE 'jobs'");

/*********For new job matches(as per client)*********************/

$expertise_area = get_field('expertise_area','user_'.$user_id);

/** rec experties start **/
foreach($expertise_area as $expert_ara){
    $expert_area_rec[] = $expert_ara['rec_expertise_area'];
}
/** rec experties end **/

/** all jobs skills start **/
$dis_active_jobs = array();
foreach($all_jobs as $job){
    $technical_skills = get_field('skills',$job->ID);
    $job_end_date = strtotime(get_field('job_closing_date',$job->ID));
    foreach($technical_skills as $technical_skill){
        $technical_skill_array = $technical_skill['job_skill_name'];
        if(in_array($technical_skill_array,$expert_area_rec) && $job_end_date >= $current_timestamp){
            $dis_active_jobs[] = $job->ID;
        }
    }
}
$dis_active_jobs_n = array_unique($dis_active_jobs);

/****************Active jobs(In which candidates are active)************************/

$live_jobs = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` ='" . $user_id . "' AND status NOT IN('save','rejected','offer-accepted','contract-signed','pending')");

foreach($live_jobs as $live_jb){
    $final_array_jobs[] = $live_jb->job_id;  
}
$final_array_jobs = array_unique($final_array_jobs);

/***********Active Candidates(in process of interview schedule)**************/

$active_candidates = $wpdb->get_results("SELECT * FROM save_candidate WHERE rec_id =$id 
AND status NOT IN('save','rejected','offer-accepted','pending','contract-signed')");

$hold_jobs = $wpdb->get_results("SELECT job_id FROM job_status WHERE recruiter_id = $user_id AND status LIKE 'hold'");

foreach($hold_jobs as $hld_job){
    $results_hold[] = $hld_job->job_id;
}

/**********Pending Offers**********************/

$pending_offers = array();
$pending_offered_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` LIKE 'offer-pending'");
foreach($pending_offered_candidates as $pending_offers_cand){
   $candidate_pending_offer_ID =  $pending_offers_cand->ID;
    $offers = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE 'offer_candidate_id' AND `meta_value` LIKE '$candidate_pending_offer_ID'");
     if(get_post_status($offers[0]->post_id == 'publish')){
       $pending_offers[] = $offers[0]->post_id; 
    }
}

/***********Ats All candidates***************/

$ats_all_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $user_id AND `status` NOT IN('rejected','pending','save','offer-accepted','contract-signed') AND `shared_status` = 0");

?>

<section class="dashboard-section">
    <div class="dashboard-main-content">
        <?php include(TEMPLATEPATH.'/dashboard-recuirter/recruiter-header-additional.php'); ?>
        <div class="cmn-jobs">
            <div class="row">
                <div class="col-md-6">
                    <div class="cmn-mg-btm bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">New Job Matches</h4>
                        </div>
                        <div class="cmn-job-table-wrap">
                            <table class="csm-job-table">
                                <?php
                                foreach($dis_active_jobs_n as $dis_act_job_id){
                     $job_end_date = strtotime(get_field('job_closing_date',$dis_act_job_id));
                                $check_job_status = $wpdb->get_results("SELECT * FROM `job_status` WHERE `job_id` LIKE $dis_act_job_id");
                                $job_status = $check_job_status[0]->status;
                                if(in_array($dis_act_job_id,$results_hold)){
                                        $status = 'Hold';
                                    }else if($job_status == 'saved'){
                                        $status = 'Saved';
                                    }else{
                                       $status = 'Live';    
                                    }
                                ?>
                                        <tr>
                                            <td><?php echo get_the_title($dis_act_job_id); ?></td>
                                            <td><?php echo get_field('jobs_job_location', $dis_act_job_id); ?></td>
                                            <td>£ <?php echo get_field('salary_required', $dis_act_job_id); ?></td>
                                            <td>
                        <?php echo date('d M,Y',strtotime(get_field('job_closing_date',$dis_act_job_id))); ?>
                                            </td>
                                            <td><?php echo $status; ?></td>
                                            <td><a href="<?php echo get_the_permalink($dis_act_job_id); ?>?id=<?php echo $dis_act_job_id; ?>" class="my-btn my-btn-2">View</a></td>
                                        </tr>
                                <?php 
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cmn-mg-btm bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">Your Active Jobs</h4>
                        </div>
                        <div class="cmn-job-table-wrap">
                            <table class="csm-job-table">
                                <?php
                                foreach ($final_array_jobs as $live_job) {
                                    $job_end_date = strtotime(get_field('job_closing_date',$live_job));
                                  $current_timestamp =  strtotime($current_date);  
                                if(in_array($live_job,$results_hold)){
                                        $actistatus = 'Hold';
                                    }elseif($job_end_date <= $current_timestamp){
                                      $actistatus = 'Expired';  
                                    }else{
                                       $actistatus = 'Live';    
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo get_the_title($live_job); ?></td>
                                        <td><?php echo get_field('jobs_job_location', $live_job); ?></td>
                                        <td>£ <?php echo get_field('salary_required', $live_job); ?></td>
                                        <td>
                            <?php echo date('d M,Y',strtotime(get_field('job_closing_date',$live_job))); ?></td>
                                        <td><?php echo $actistatus; ?></td>
                                        <td><a href="<?php echo get_the_permalink($live_job); ?>?id=<?php echo $live_job; ?>" class="my-btn my-btn-2">View</a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cmn-jobs">
            <div class="row">
                <div class="col-md-6">
                    <div class="cmn-mg-btm bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">Active Candidates</h4>
                        </div>
                        <div class="cmn-job-table-wrap">
                            <table class="csm-job-table">
                                
                                <tbody>
                                <?php
                                foreach($active_candidates as $active_can){
                                    if($active_can->shared_status == 0){
                                    $dis_cand_data = unserialize($active_can->candidate_data);
                                    $job_applied_for = get_the_title($active_can->job_id);
                                    $timestamp = $active_can->time_stamp;
                                    $status = $active_can->status;
                                    $stage = $active_can->stage;
                                    if($status == 'active'){
                                        $dis_status = 'Submitted';
                                    }else if($status == 'interview-pending'){
                                      $dis_status = 'Waiting for timing confirmation';  
                                    }else if($status == 'interview-rearrange'){
                                      $dis_status = 'Rearrange Interview';    
                                    }else if($status == 'interview-booked' && $stage == 'stage1'){
                                        $dis_status = 'Interview Booked for Stage 1';      
                                    }else if($status == 'interview-booked' && $stage == 'stage2'){
                                      $dis_status = 'Interview Booked for Stage 2';   
                                    }else if($status == 'interview-booked' && $stage == 'stage3'){
                                      $dis_status = 'Interview Booked for Stage 3';   
                                    }else if($status == 'interview-booked' && $stage == 'stage4'){
                                      $dis_status = 'Interview Booked for Stage 4';   
                                    }else if($status == 'interview-ongoing' && $stage == 'stage1'){
                                        $dis_status = 'Interview Ongoing for Stage 1';      
                                    }else if($status == 'interview-ongoing' && $stage == 'stage2'){
                                        $dis_status = 'Interview Ongoing for Stage 2';      
                                    }else if($status == 'interview-ongoing' && $stage == 'stage3'){
                                        $dis_status = 'Interview Ongoing for Stage 3';      
                                    }else if($status == 'interview-ongoing' && $stage == 'stage4'){
                                        $dis_status = 'Interview Ongoing for Stage 4';      
                                    }else if($status == 'offer-pending'){
                                      $dis_status = 'Offer Pending for confirmation';   
                                    }else if($status == 'offer-accepted'){
                                      $dis_status = 'Contract Pending';   
                                    }else if($status == 'offer-rejected'){
                                      $dis_status = 'Offer Rejected';   
                                    }
                                    $profile_image = wp_get_attachment_url($dis_cand_data['candidate_profile_image']);
                                    if(empty($profile_image)){
                                       $profile_image = get_template_directory_uri().'/images/dummy.jpg'; 
                                    }
                                ?>
                                <tr>
                                    <td>
                                        <span class="table-applicant">
                                            <img src="<?php echo $profile_image; ?>" alt="Candidate-img">
                                        </span>
                                        <p>
                                            <?php echo $dis_cand_data['name']; ?>
                                            <span><?php echo $job_applied_for; ?></span>
                                        </p>
                                    </td>
                                    <td><?php echo $dis_status; ?></td>
                                    <td><?php echo date('d M Y',$timestamp); ?></td>
                                </tr>
                                <?php
                                }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cmn-mg-btm bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">Offers</h4>
                        </div>
                        <div class="cmn-job-table-wrap">
                            <table class="csm-job-table">
                                <?php
                                foreach($pending_offers as $pending_offer){
                                  $candidate_id = get_field('offer_candidate_id',$pending_offer);
                                    $candidate_data = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$candidate_id");
                                    $job_id = $candidate_data[0]->job_id;
                                    $offer_status = $candidate_data[0]->status;
                                    $candidate_dt = unserialize($candidate_data[0]->candidate_data);
                                    $offer_date = get_the_date('d M,Y',$candidate_id);
                                    $profilimage = $candidate_dt['candidate_profile_image'];
                                    if(empty($profilimage)){
                                      $profilimage = get_template_directory_uri().'/images/dummy.jpg';  
                                    }else{
                                      $profilimage = wp_get_attachment_url($profilimage); 
                                    }
                                    if($offer_status == 'offer-pending'){
                                        $offer_status_dis = 'Offer Pending';
                                    }else if($offer_status == 'offer-accepted'){
                                       $offer_status_dis = 'Contract Pending';  
                                    }
                                    ?>
                              <tr>
                                    <td>
                                        <span class="table-applicant">
                                            <img src="<?php echo $profilimage; ?>" alt="Candidate-img">
                                        </span>
                                        <p>
                                            <?php echo $candidate_dt['name']; ?>
                                            <span><?php echo get_the_title($job_id); ?></span>
                                        </p>
                                    </td>
                                    <td>Offer Received</td>
                                    <td><?php echo $offer_date; ?></td>
                                  <td><?php echo $offer_status_dis; ?></td>
                                </tr>
                                <?php 
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
                <div class="tracking-system bg-white-shadow cmn-mg-btm">
            <div class="my-flex-heading">
                <h4 class="cmn-job-heading">Applicant Tracking System</h4>
                <ul>
                    <?php
                    foreach($ats_all_candidates as $all_ats_candidate_image){
                        if($all_ats_candidate_image->shared_status == 0){
                             $ats_candidates = $all_ats_candidate_image->candidate_data;
                            $ats_candidates_data = unserialize($ats_candidates);
                            $ats_can_profile_images = $ats_candidates_data['candidate_profile_image'];
                            if(empty($ats_can_profile_images)){
                                $ats_can_profile_image = get_template_directory_uri().'/images/dummy.jpg';
                            }else{
                              $ats_can_profile_image = wp_get_attachment_url($ats_can_profile_images);  
                            }  
                            }
                    ?>
                    <li>
                        <figure>
                            <img src="<?php echo $ats_can_profile_image; ?>" alt="applicant-img">
                        </figure>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="tracking-table-wrap">
                <table class="tracking-table">
                    <thead>
                        <tr>
                            <th>
                                Submitted
                            </th>
                            <th>
                                1st Stage
                            </th>
                            <th>
                                2nd Stage
                            </th>
                            <th>
                                3rd Stage
                            </th>
                            <th>
                               4th Stage
                            </th>
                            <th>
                                Offer
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            foreach($ats_all_candidates as $ats_candi){
                                if($ats_candi->shared_status == 0){
                               
                                $append_html_booked0 = '';
                                $append_html_booked1 = ''; 
                                $append_html_booked2 = ''; 
                                $append_html_booked3 = ''; 
                                $append_html_booked4 = ''; 
                                $append_html_offer = '';
                                
                                $ats_candi_status = $ats_candi->status;
                                $ats_candi_stage = $ats_candi->stage;
                                $ats_candi_jobname = get_the_title($ats_candi->job_id);
                                $ats_candi_data = unserialize($ats_candi->candidate_data);
                                $ats_candi_name = $ats_candi_data['name'];
                                $ats_candi_image = $ats_candi_data['candidate_profile_image'];
                                $ats_candi_img = wp_get_attachment_url($ats_candi_image);
                                if(empty($ats_candi_img)){
                                  $ats_candi_img = get_template_directory_uri().'/images/dummy.jpg';  
                                }
                                if($ats_candi_status == 'active'){
                                  $disats_status = 'Active';  
                                }else if($ats_candi_status == 'interview-pending'){
                                   $disats_status = 'Interview Pending';  
                                }else if($ats_candi_status == 'interview-rearrange'){
                                   $disats_status = 'Interview Rearrange';  
                                }else if($ats_candi_status == 'interview-booked'){
                                   $disats_status = 'Interview Booked';  
                                }else if($ats_candi_status == 'offer-pending'){
                                   $disats_status = 'Offer Pending';  
                                }else if($ats_candi_status == 'interview-ongoing'){
                                   $disats_status = 'Interview Ongoing';  
                                }
                                if($ats_candi_stage=='stage0' && $ats_candi_status != 'offer-pending'){
                                   $append_html_booked0 = '<div class="applicant-content"><figure>
                                    <img src="'.$ats_candi_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$ats_candi_name.'</h6><p>'.$ats_candi_jobname.'</p><p><span>'.$disats_status.'</span></p></div></div>';  
                                }elseif($ats_candi_stage=='stage1' && $ats_candi_status != 'offer-pending'){
                                   $append_html_booked1 = '<div class="applicant-content"><figure>
                                    <img src="'.$ats_candi_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$ats_candi_name.'</h6><p>'.$ats_candi_jobname.'</p><p><span>'.$disats_status.'</span></p></div></div>';  
                                }elseif($ats_candi_stage=='stage2' && $ats_candi_status != 'offer-pending'){
                                    $append_html_booked2 = '<div class="applicant-content"><figure>
                                    <img src="'.$ats_candi_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$ats_candi_name.'</h6><p>'.$ats_candi_jobname.'</p><p><span>'.$disats_status.'</span></p></div></div>';
                                }elseif($ats_candi_stage=='stage3' && $ats_candi_status != 'offer-pending'){
                                    $append_html_booked3 = '<div class="applicant-content"><figure>
                                    <img src="'.$ats_candi_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$ats_candi_name.'</h6><p>'.$ats_candi_jobname.'</p><p><span>'.$disats_status.'</span></p></div></div>';
                                }elseif($ats_candi_stage=='stage4' && $ats_candi_status != 'offer-pending'){
                                    $append_html_booked4 = '<div class="applicant-content"><figure>
                                    <img src="'.$ats_candi_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$ats_candi_name.'</h6><p>'.$ats_candi_jobname.'</p><p><span>'.$disats_status.'</span></p></div></div>';
                                }
                                
                                if($ats_candi_status == 'offer-pending'){
                                    $append_html_offer = '<div class="applicant-content"><figure>
                                    <img src="'.$ats_candi_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$ats_candi_name.'</h6><p>'.$ats_candi_jobname.'</p><p><span>'.$disats_status.'</span></p></div></div>';
                                }
                            }
                           ?>
                            <tr>
                            <td>
                            <?php echo $append_html_booked0; ?>
                            </td>
                            <td>
                            <?php echo $append_html_booked1; ?>
                            </td>
                            <td>
                            <?php echo $append_html_booked2; ?>
                            </td>
                            <td>
                            <?php echo $append_html_booked3; ?>
                            </td>
                            <td>
                            <?php echo $append_html_booked4; ?>
                            </td>
                            <td>
                            <?php echo $append_html_offer; ?>
                            </td>
                            </tr>
                        <?php
                         }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include(TEMPLATEPATH . '/footer-recruiter.php');  ?>
