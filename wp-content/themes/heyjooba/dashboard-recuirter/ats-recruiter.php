<?php
/*
Template Name:ats Recruiter
*/
include(TEMPLATEPATH . '/header-recruiter.php');
$id = get_current_user_id();
$current_date = date('Y-m-d');

$active_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `shared_status` = 0 AND `status` NOT IN ('save','rejected','offer-accepted','pending','contract-signed')");

/*************For displaying jobs*******************/

$live_vacancies = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` ='" . $id . "' AND status NOT IN('save','rejected') AND `shared_status` = 0");

foreach($live_vacancies as $live_vacnc){
    $dis_live[] = $live_vacnc->job_id;
}
$dis_live = array_unique($dis_live);

/***For all candidate modal*************/

$all_cand = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` NOT IN ( 'save') AND `shared_status` = 0");

/************Hold Jobs****************/

$hold_jobs = $wpdb->get_results("SELECT job_id FROM job_status WHERE recruiter_id=$id AND status='hold'");
foreach($hold_jobs as $hld_job){
  $hl_jb[] = $hld_job->job_id; 
}
print_r($hl_jb);

/**********Interview-ongoing Candidates*********/

$ongoing_candidate_data = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` IN ('interview-ongoing') AND `shared_status` = 0");


/*************Pending offers********************/

$pending_offers = array();
$pending_offered_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` IN('offer-pending','offer-accepted') AND `shared_status` = 0");
foreach($pending_offered_candidates as $pending_offers_cand){
   $candidate_pending_offer_ID =  $pending_offers_cand->ID;
    $offers = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE 'offer_candidate_id' AND `meta_value` LIKE '$candidate_pending_offer_ID'");
    if(get_post_status($offers[0]->post_id == 'publish')){
       $pending_offers[] = $offers[0]->post_id; 
    }
}
$offer_count = count($pending_offers);
?>

<section class="dashboard-section">
    <div class="dashboard-main-content">
        <?php include(TEMPLATEPATH . '/dashboard-recuirter/rating-section.php'); ?>
        <div class="counter-wrap cmn-mg-btm three-items">
            <div class="my-row">
                <div class="counter-content bg-white-shadow">
                    <a href="<?php echo get_the_permalink(98); ?>">
                        <h3><?php echo count($active_candidates); ?></h3>
                        <h6>Active Candidates</h6>
                    </a>
                </div>
                <div class="counter-content bg-white-shadow">
                    <a href="<?php echo get_the_permalink(766); ?>">
                    <h3><?php echo count($ongoing_candidate_data); ?></h3>
                    <h6>Interviews Ongoing</h6>
                    </a>
                </div>
                <div class="counter-content bg-white-shadow">
                    <a href="<?php echo get_the_permalink(699); ?>">
                    <h3><?php echo $offer_count; ?></h3>
                    <h6>All Offers</h6>
                    </a>
                </div>
            </div>
        </div>
        <button type="button" class="my-btn my-btn-2 mb-2" data-bs-toggle="modal" data-bs-target="#CandidatesModal">View All Candidates</button>

        <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
            <div class="my-flex-heading">
                <h4 class="cmn-job-heading">Live Vacancy Shortlists</h4>
            </div>
            <div class="cmn-job-table-wrap">
                <table class="csm-job-table">
                    <thead>
                        <tr>
                            <th>
                                Job Title
                            </th>
                            <th>
                                Job Location
                            </th>
                            <th>
                                Salary Bracket
                            </th>
                            <th>
                                Job Status
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dis_live as $live_j_id) {
                             $job_end_date = strtotime(get_field('job_closing_date',$live_j_id));
                              $current_timestamp =  strtotime($current_date);  
                            if(in_array($live_j_id,$hl_jb)){
                                    $actistatus = 'Hold';
                                }elseif($job_end_date <= $current_timestamp){
                                  $actistatus = 'Expired';  
                                }else{
                                   $actistatus = 'Live';    
                                }
                      ?>
                            <tr>
                                <td><?php echo get_the_title($live_j_id); ?></td>
                                <td><?php echo get_field('jobs_job_location', $live_j_id); ?></td>
                                <td>£ <?php echo get_field('salary_required', $live_j_id); ?></td>
                                <td><?php echo $actistatus; ?></td>
                                <td><a href="javascript:void(0); " class="my-btn my-btn-2 show_ats" id="cad_<?php echo $final_ar;?>" onclick="recruiter_track_candidate(<?php echo $live_j_id;?>,<?php echo $id; ?>);">View Candidates</a></td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tracking-system bg-white-shadow cmn-mg-btm">
            <div class="my-flex-heading">
                <h4 class="cmn-job-heading">Applicant Tracking System</h4>
                <div class="active-candidates-wrap" id="append_job_name">
                       
                 </div>
                <ul>
                    <?php
                    foreach ($all_cand as $al_images) {
                        $candidate_data = $al_images->candidate_data;
                        $cand_images = unserialize($candidate_data);
                        $profile = $cand_images['candidate_profile_image'];
                        $profile_img = wp_get_attachment_url($profile);
                        if (empty($profile_img)) {
                            $profile_img = get_template_directory_uri() . '/images/dummy.jpg';
                        }
                    ?>
                        <li>
                            <figure>
                                <img src="<?php echo $profile_img; ?>" alt="applicant-img">
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
                                Candidates
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
                    <tbody id="ats_append">
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade employer-modal" id="CandidatesModal" tabindex="-1" aria-labelledby="CandidatesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="cmn-jobs bg-white-shadow">
                    <div class="my-flex-heading">
                        <h4 class="cmn-job-heading">All Candidates</h4>
                        <a href="<?php echo get_the_permalink(98); ?>" class="my-btn my-btn-3">Go to Page</a>
                    </div>
                    <div class="cmn-job-table-wrap">
                        <table class="csm-job-table">
                            <thead>
                                <tr>
                                    <th>
                                        Candidate Name
                                    </th>
                                    <th>
                                        Lives
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Application Received
                                    </th>
                                    <th>
                                        Candidate Status
                                    </th>
                                    <th>
                                        Job Role
                                    </th>
                                    <th>
                                        View Profile
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($all_cand as $al_can) {
                                    if ($al_can->rec_id == $id) {
                                        $row_id = $al_can->ID;
                                        $stage = $al_can->stage;
                                        $candidate = $al_can->candidate_data;
                                        $candidate_data = unserialize($candidate);
                                        $job_title = get_the_title($candidate_data['job_id']);
                                        $cand_time = $candidate_data['time_stamp'];
                                        $status = $al_can->status;
                                        if ($status == 'active') {
                                            $cand_stat = "Submitted";
                                        } else if ($status == 'interview-pending') {
                                            $cand_stat = "Waiting for time confirmation";
                                        }else if ($status == 'interview-rearrange') {
                                            $cand_stat = "Interview Rearrange";
                                        }else if($status == 'rejected'){
                                           $cand_stat = "Rejected"; 
                                        }else if ($status == 'interview-booked' && $stage == 'stage1') {
                                            $cand_stat = "Interview Booked for stage 1";
                                        }else if ($status == 'interview-booked' && $stage == 'stage2') {
                                            $cand_stat = "Interview Booked for stage 2";
                                        }else if ($status == 'interview-booked' && $stage == 'stage3') {
                                            $cand_stat = "Interview Booked for stage 3";
                                        }else if ($status == 'interview-booked' && $stage == 'stage4') {
                                            $cand_stat = "Interview Booked for stage 4";
                                        }else if ($status == 'interview-ongoing' && $stage == 'stage1') {
                                            $cand_stat = "Interview Ongoing for stage 1";
                                        }else if ($status == 'interview-ongoing' && $stage == 'stage2') {
                                            $cand_stat = "Interview Ongoing for stage 2";
                                        }else if ($status == 'interview-ongoing' && $stage == 'stage3') {
                                            $cand_stat = "Interview Ongoing for stage 4";
                                        }else if ($status == 'interview-ongoing' && $stage == 'stage4') {
                                            $cand_stat = "Interview Ongoing for stage 1";
                                        }else if ($status == 'offer-pending') {
                                            $cand_stat = "Offer Pending";
                                        }else if ($status == 'offer-accepted'){
                                            $cand_stat = "Contract Pending";
                                        }else if ($status == 'offer-rejected'){
                                            $cand_stat = "Offer Rejected";
                                        }else if ($status == 'pending'){
                                            $cand_stat = "Confirmation Pending";
                                        }else if ($status == 'contract-signed'){
                                            $cand_stat = "Contract Signed";
                                        }
                                ?>

                                        <tr>
                                            <td><?php echo $candidate_data['name']; ?></td>
                                            <td><?php echo $candidate_data['lives']; ?></td>
                                            <td><?php echo $candidate_data['email']; ?></td>
                                            <td><?php echo date('d M,Y', $cand_time); ?></td>
                                            <td><?php echo $cand_stat; ?></td>
                                            <td><?php echo $job_title; ?></td>
                                            <td><a href="<?php echo get_the_permalink(505) ?>?r=<?php echo $row_id; ?>">View Candidates</a></td>


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
        </div>
    </div>
</div>
<?php include(TEMPLATEPATH . '/footer-recruiter.php');  ?>