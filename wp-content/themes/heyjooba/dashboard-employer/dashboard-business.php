<?php
/*
Template Name:Dashboard Employer
*/
include(TEMPLATEPATH . '/header-dashboard.php');
  
$id = get_current_user_id();
$name = get_user_meta($id, 'first_name', true);
$job_cand = array();
$act_jobs = array();
$show_offered = array();
$candidates_booked = array();
$candidates_feedback = array();
$live_job_check_arr = array();
$job_new_act = array();
$current_date = date('Y-m-d');
$strCurrentDate = strtotime($current_date);

/*****All jobs that are posted(live)*********/

$live_posts_count = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_author` = $id AND `post_status` LIKE 'publish' AND `post_type` LIKE 'jobs'");

$job_hv_cand = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `emp_id` = $id");

foreach ($live_posts_count as $live_jobs_check) {
    $live_job_check_arr[] = $live_jobs_check->ID;
}

foreach ($job_hv_cand as $job_act_candidates) {
    $job_new_act[] = $job_act_candidates->job_id;
}
$activ_new_dis = array_diff($live_job_check_arr, $job_new_act);

/***********Jobs with candidates and candidate submission filter**************/

$job_active = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `emp_id` = $id AND `status` IN('active','rearrange-interview','interview-pending','rejected')");

foreach ($job_active as $job_recv) {

    $job_enddate = get_field('job_closing_date', $job_recv->job_id);
    $strJobenddate = strtotime($job_enddate);

    $when_submit =  get_field('when_you_want_to_recieve_candidates', $job_recv->job_id);
    if ($when_submit == 'on_close_date' && $strJobenddate <= $strCurrentDate) {
        $act_jobs[] = $job_recv->job_id;
    } elseif ($when_submit == 'recieve_as_submitted') {
        $act_jobs[] = $job_recv->job_id;
    }

    $act_jobs = array_unique($act_jobs);
}
$shorlist_cand = count($act_jobs);

/*********************Candidates booked for interview****************************/

$booked_interview_cand = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `emp_id` = $id AND `status` LIKE 'interview-booked'");

/**********ALL offers**************/

$all_offers = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_author` = $id AND `post_status` LIKE 'publish' AND `post_type` LIKE 'offers'");
foreach ($all_offers as $dis_offers) {
    $offer_status = get_post_meta($dis_offers->ID, 'accept_reject', 'true');
    $candidate_offered_id = get_field('offer_candidate_id', $dis_offers->ID);
    $offered_candiadtes_data = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$candidate_offered_id");
    $offered_candidate_status = $offered_candiadtes_data[0]->status;
    if ($offered_candidate_status == 'offer-accepted' || $offered_candidate_status == 'offer-rejected' || $offered_candidate_status == 'offer-pending' || $offered_candidate_status == 'contract-signed') {
        $show_offered[] = $dis_offers->ID;
    }
}

/*************Candidate having pending Feedback***********************/

$booked = $wpdb->get_results("SELECT * FROM save_candidate WHERE emp_id = $id AND status IN('interview-booked')");

foreach ($booked as $pend_feed) {
    $candidates_booked[] = $pend_feed->ID;
}

$feedback_submitted = $wpdb->get_results("SELECT * FROM `interview-feedback`");
foreach ($feedback_submitted as $feed_submit) {
    $candidates_feedback[] = $feed_submit->candidate_row_id;
}

$result_pending_feeds = array_diff($candidates_booked, $candidates_feedback);

?>

<section class="dashboard-section">

    <div class="dashboard-main-content">
        <?php include(TEMPLATEPATH . '/dashboard-employer/employer-rating-section.php');  ?>

        <div class="counter-wrap cmn-mg-btm">
            <div class="my-row">
                <div class="counter-content bg-white-shadow" data-bs-toggle="modal" data-bs-target="#businessModal">
                    <h3><?php echo $shorlist_cand; ?></h3>
                    <h6>Active Candidates Shortlists</h6>
                </div>
                <div class="counter-content bg-white-shadow" data-bs-toggle="modal" data-bs-target="#interview_bookedModal">
                    <h3><?php echo count($booked_interview_cand); ?></h3>
                    <h6>Interviews Booked</h6>
                </div>
                <div class="counter-content bg-white-shadow" data-bs-toggle="modal" data-bs-target="#pending_feedback">
                    <h3><?php echo count($result_pending_feeds); ?></h3>
                    <h6>Interviews Pending Feedback</h6>
                </div>
                <div class="counter-content bg-white-shadow" data-bs-toggle="modal" data-bs-target="#activeofferModal">
                    <h3><?php echo count($show_offered); ?></h3>
                    <h6>Offers</h6>
                </div>
                <div class="counter-content bg-white-shadow">
                    <h3>4</h3>
                    <h6>Placements made in 2021</h6>
                </div>
                <div class="counter-content bg-white-shadow">
                    <h3><?php echo count($activ_new_dis); ?></h3>
                    <h6>Active Jobs</h6>
                </div>
            </div>
        </div>
        <div class="different-job-wrap">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">New Candidate Shortlists</h4>
                        </div>
                        <div class="your-candidate cmn-job-table-wrap">
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
                                            Job Posted
                                        </th>
                                        <th>
                                            Shortlist Received
                                        </th>
                                        <th>
                                            Job Salary
                                        </th>
                                        <th>
                                            View Shortlist
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($act_jobs as $job_can_shortlisted) {
                                        $data_candidate_display = $wpdb->get_row("SELECT time_stamp FROM save_candidate WHERE job_id =$job_can_shortlisted AND emp_id=$id");
                                        $shotlist_recvd_dis = $data_candidate_display->time_stamp;
                                        $s_time_dis = date('d M , Y', $shotlist_recvd_dis);
                                    ?>
                                        <tr>
                                            <td><?php echo get_the_title($job_can_shortlisted); ?></td>
                                            <td><?php echo get_field('jobs_job_location', $job_can_shortlisted); ?></td>
                                            <td><?php echo get_the_date(); ?></td>
                                            <td><?php echo $s_time_dis; ?></td>
                                            <td>£ <?php echo get_field('salary_required', $job_can_shortlisted); ?></td>
                                            <td><a href="<?php echo get_the_permalink(30) ?>?id=<?php echo $job_can_shortlisted; ?>">View Candidates</a></td>


                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="cmn-jobs bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">Active Jobs</h4>
                        </div>
                        <div class="your-candidate cmn-job-table-wrap">
                            <table class="csm-job-table">
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Job Location</th>
                                        <th>Job posted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    /*********Jobs having candidates with date filter*******/

                                    foreach ($activ_new_dis as $job_rec) {
                                    ?>
                                        <tr>
                                            <td>
                                                <p>
                                                    <?php echo get_the_title($job_rec); ?>
                                                </p>
                                            </td>
                                            <td><?php echo get_field('jobs_job_location', $job_rec) ?></td>
                                            <td><?php echo get_the_date('d M,Y', $job_rec); ?></td>
                                        </tr>
                                    <?php
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
</section>

<?php
/*******************Candidate shortlist Modal***************************/
?>
<div class="modal fade employer-modal" id="businessModal" tabindex="-1" aria-labelledby="businessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="cmn-jobs bg-white-shadow">
                    <div class="my-flex-heading">
                        <h4 class="cmn-job-heading"><?php echo $shorlist_cand; ?> Vacancies Shortlist</h4>
                        <a href="<?php echo get_the_permalink(30); ?>" class="my-btn my-btn-3">Go to Page</a>
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
                                        Job Posted
                                    </th>
                                    <th>
                                        Shortlist Received
                                    </th>
                                    <th>
                                        Job Salary
                                    </th>
                                    <th>
                                        View Shortlist
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($act_jobs as $job_can) {
                                    $job_id = $job_can;
                                    $data_candidate = $wpdb->get_row("SELECT time_stamp FROM save_candidate WHERE job_id =$job_id AND emp_id=$id");
                                    $shotlist_recvd = $data_candidate->time_stamp;
                                    $s_time = date('d M , Y', $shotlist_recvd);
                                ?>
                                    <tr>
                                        <td><?php echo get_the_title($job_id); ?></td>
                                        <td><?php echo get_field('jobs_job_location', $job_id); ?></td>
                                        <td><?php echo get_the_date(); ?></td>
                                        <td><?php echo $s_time; ?></td>
                                        <td>£ <?php echo get_field('salary_required', $job_id); ?></td>
                                        <td><a href="<?php echo get_the_permalink(30) ?>?id=<?php echo $job_id; ?>">View Candidates</a></td>


                                    </tr>
                                <?php
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
<?php
/*************************Interview Booked****************************/
?>
<div class="modal fade employer-modal" id="interview_bookedModal" tabindex="-1" aria-labelledby="interview_bookedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="cmn-jobs bg-white-shadow">
                    <div class="my-flex-heading">
                        <h4 class="cmn-job-heading">Interviews Booked</h4>
                    </div>
                    <div class="cmn-job-table-wrap">
                        <table class="csm-job-table">
                            <thead>
                                <tr>
                                    <th>
                                        Candidate Name
                                    </th>
                                    <th>
                                        Job Role
                                    </th>
                                    <th>
                                        Shortlist Received
                                    </th>
                                    <th>
                                        Interview Date Time
                                    </th>
                                    <th>
                                        View Candidate
                                    </th>
                                    <th>
                                        View in Calender
                                    </th>
                                    <th>
                                        Edit Date and Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $intrview_booked_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `emp_id` = $id AND `status` LIKE 'interview-booked'");
                                foreach ($intrview_booked_candidates as $inter_booked) {
                                    $inter_booked_data = $inter_booked->candidate_data;
                                    $candidate_booked_data = unserialize($inter_booked_data);
                                    $candidate_name = $candidate_booked_data['name'];
                                    $booked_row_id = $inter_booked->ID;
                                    $job_id = $inter_booked->job_id;
                                    $timestamp = $inter_booked->time_stamp;
                                    $shortlist_recv = date('d M,Y', $timestamp);
                                    $interview_time = $wpdb->get_results("SELECT * FROM `interview_timing` WHERE `candidate_row_id` = $booked_row_id AND `emp_id` = $id");
                                    $timings = $interview_time[0]->interview_time;
                                    $dis_time = date('d M,Y  g:i a.', strtotime($timings));
                                ?>
                                    <tr>
                                        <td><?php echo $candidate_name; ?></td>
                                        <td><?php echo get_the_title($job_id); ?></td>
                                        <td><?php echo $shortlist_recv; ?></td>
                                        <td><?php echo $dis_time; ?></td>
                                        <td><a href="<?php echo get_the_permalink(498) ?>?r=<?php echo $booked_row_id; ?>">View</a></td>
                                        <td><a href="#">View in calender</a></td>
                                        <td><a href="<?php echo get_the_permalink(627) ?>?r=<?php echo $booked_row_id; ?>">Edit Interview Timings</a></td>
                                    </tr>
                                <?php
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

<?php
/*************************Interview Pending Feedback****************************/
?>
<div class="modal fade employer-modal" id="pending_feedback" tabindex="-1" aria-labelledby="interview_bookedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="cmn-jobs bg-white-shadow">
                    <div class="my-flex-heading">
                        <h4 class="cmn-job-heading">Interviews Pending Feedback</h4>
                    </div>
                    <div class="cmn-job-table-wrap">
                        <table class="csm-job-table">
                            <thead>
                                <tr>
                                    <th>
                                        Candidate Name
                                    </th>
                                    <th>
                                        Job Role
                                    </th>
                                    <th>
                                        Stage
                                    </th>
                                    <th>
                                        View Candidate
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result_pending_feeds as $candidate_pending_feeds) {
                                    $feed_data = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE ID=$candidate_pending_feeds");
                                    $feed_pending_data = unserialize($feed_data[0]->candidate_data);
                                ?>
                                    <tr>
                                        <td><?php echo $feed_pending_data['name']; ?></td>
                                        <td><?php echo get_the_title($feed_data[0]->job_id); ?></td>
                                        <td><?php echo $feed_data[0]->stage; ?></td>
                                        <td><a href="<?php echo get_the_permalink(498) ?>?r=<?php echo $feed_data[0]->ID; ?>">View</a></td>
                                    </tr>
                                <?php
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
<?php
/****************offer Modal***********************/
?>
<div class="modal fade employer-modal" id="activeofferModal" tabindex="-1" aria-labelledby="interview_bookedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="cmn-jobs bg-white-shadow">
                    <div class="my-flex-heading">
                        <h4 class="cmn-job-heading">Offers</h4>
                    </div>
                    <div class="cmn-job-table-wrap">
                        <table class="csm-job-table">
                            <thead>
                                <tr>
                                    <th>
                                        Offer Name
                                    </th>
                                    <th>
                                        Offer Recieved
                                    </th>
                                    <th>
                                        Candidate Name
                                    </th>
                                    <th>
                                        Job Role
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Message to recruiter
                                    </th>
                                    <th>
                                        Send Employment Contract
                                    </th>
                                    <th>
                                        Send Employment Contract
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($show_offered as $act_offer) {
                                   
                                    $active_offer_cand_id = get_field('offer_candidate_id', $act_offer);
                                    $active_offer_job_id =  get_field('offer_job_id', $act_offer);
                                    $active_offer_rec_id = get_field('offer_recruiter_id', $act_offer);
                                    
                                    $active_offer_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE ID=$active_offer_cand_id");
                                    
                                    $show_status = $active_offer_candidates[0]->status;
                                    $candidate_act_offer_data = unserialize($active_offer_candidates[0]->candidate_data);
                                    if ($show_status == 'offer-accepted') {
                                        $show_sta = 'Offer Accepted';
                                    } else if ($show_status == 'offer-rejected') {
                                        $show_sta = 'Offer Rejected';
                                    } else if ($show_status == 'offer-pending') {
                                        $show_sta = 'Offer Pending';
                                    } else if ($show_status == 'contract-signed') {
                                        $show_sta = 'Contract Signed';
                                    }
                                    
                                    $can_rowid = $active_offer_candidates[0]->ID;
                                    $offer_id = $act_offer;
                                ?>
                                    <tr>
                                        <td><?php echo get_the_title($act_offer); ?></td>
                                        <td><?php echo get_the_date('d M,Y', $act_offer); ?></td>
                                        <td><?php echo $candidate_act_offer_data['name']; ?></td>
                                        <td><?php echo get_the_title($active_offer_job_id); ?></td>
                                        <td><?php echo $show_sta; ?></td>
                                        <td><a href="<?php echo get_the_permalink(32) ?>?r_id=<?php echo $active_offer_rec_id; ?>">Message to recruiter</a></td>
                                        <?php
                                        if ($show_status == 'offer-accepted') { ?>
                                            <td><a href="javascript:void(0)" onclick="contract_to_candidate(<?php echo $active_offer_cand_id; ?>,<?php echo $id; ?>)">Direct to recruiter</a></td>
                                        <td>
                                            <form id="contract-form" class="contract_form" enctype="multipart/form-data">
                                                <input type="file" name="contract" required>
                                                <input type="submit" value="Submit">
                                                <input type="hidden" name="candidate_row_id" value="<?php echo $can_rowid; ?>">
                                                <input type="hidden" name="offer_id" value="<?php echo $offer_id; ?>">
                                            </form>
<!--                                                <a href="javascript:void(0)" onclick="create_doc('<?php //echo $can_rowid; ?>','<?php //echo $offer_id; ?>');">DocuSign api</a>-->
                                        </td>
                                        <?php }
                                        ?>
                                    </tr>
                                <?php
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
<?php
/*****************************Edit Interview Timings*************************************/
?>

<div class="modal fade my-modal" id="edit_interview" tabindex="-1" aria-labelledby="edtt_interviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="candidate-submission-wrap">
                    <h4>Choose three schedules for interview:</h4>
                    <form id="edit_interview_timings">
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label>Date 1</label>
                                <input id="picker1" class="form-control" size="30" style="width: 150px" type="text" value="" name="timing1" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Date 2</label>
                                <input id="picker2" class="form-control" size="30" style="width: 150px" type="text" value="" name="timing2" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Date 3</label>
                                <input id="picker3" class="form-control" size="30" style="width: 150px" type="text" value="" name="timing3" required>
                            </div>
                        </div>
                        <div class="form-btn-wrap">
                            <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="action" value="edit_interview_timings">
                            <input type="submit" id="submit_timimgs" value="Submit" class="my-btn my-btn-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(TEMPLATEPATH . '/footer-dashboard.php');  ?>