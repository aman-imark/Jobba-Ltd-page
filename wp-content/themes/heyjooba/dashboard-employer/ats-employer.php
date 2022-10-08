<?php 
/*
Template Name: ats Employer
*/
include(TEMPLATEPATH.'/header-dashboard.php'); 
global $wpdb;
$id = get_current_user_id();

$current_date = date('Y-m-d');
$strCurrentDate = strtotime($current_date);

/***********Jobs with candidates and candidate submission filter**************/

$job_active = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `emp_id` = $id AND `status` IN('active','rearrange-interview','interview-pending','interview-booked','offer-accepted','interview-ongoing')");

foreach($job_active as $job_recv){
    
$job_enddate = get_field('job_closing_date',$job_recv->job_id);
$strJobenddate = strtotime($job_enddate);
    
$when_submit =  get_field('when_you_want_to_recieve_candidates',$job_recv->job_id);
if($when_submit == 'on_close_date' && $strJobenddate <= $strCurrentDate){
    $act_jobs[] = $job_recv->job_id;
}elseif($when_submit == 'recieve_as_submitted'){
    $act_jobs[] = $job_recv->job_id;
}

$act_jobs = array_unique($act_jobs);
}
$shorlist_cand = count($act_jobs);

/*********************Hold Jobs********************/

$hold_jobs =  $wpdb->get_results("SELECT job_id FROM job_status WHERE status LIKE 'hold'");
foreach($hold_jobs as $hld_jobs){
    $final_hold[] = $hld_jobs->job_id;
}
/*****Cand having interview booked,interview-offers,pending offers*********/

 $active_candidates_employer = $wpdb->get_results("SELECT * FROM save_candidate WHERE emp_id = $id AND status IN('interview-pending','interview-booked','offer-pending','interview-ongoing')");

/************Cand having pending offers**************************/

$pending_offers_employer = $wpdb->get_results("SELECT * FROM save_candidate WHERE emp_id = $id AND status IN('offer-pending')");

$interview_ongoing = $wpdb->get_results("SELECT * FROM save_candidate WHERE emp_id = $id AND status IN('interview-ongoing')");

?> 
<section class="dashboard-section">
        <div class="dashboard-main-content">
        <?php include(TEMPLATEPATH.'/dashboard-employer/employer-rating-section.php');  ?>
            <div class="counter-wrap cmn-mg-btm three-items">
                <div class="my-row">
                    <div class="counter-content bg-white-shadow" data-bs-toggle="modal" data-bs-target="#ats_emp_active_candidates">
                        <h3><?php echo count($active_candidates_employer); ?></h3>
                        <h6>Active Candidates</h6>
                    </div>
                    <div class="counter-content bg-white-shadow" data-bs-toggle="modal" data-bs-target="#ats_emp_ongoing_candidates">
                        <h3><?php echo count($interview_ongoing); ?></h3>
                        <h6>Interviews Ongoing</h6>
                    </div>
                    <div class="counter-content bg-white-shadow" data-bs-toggle="modal" data-bs-target="#pending_offer_candidates">
                        <h3><?php echo count($pending_offers_employer); ?></h3>
                        <h6>Pending Offers</h6>
                    </div>
                </div>
            </div>
            <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                <div class="my-flex-heading">
                    <h4 class="cmn-job-heading">Please select a job to view candidates.</h4>
                </div>
                <div class="cmn-job-table-wrap">
                    <?php
                    /*********Jobs which recieved candidates/active candidates*************/
                    ?>
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
                                    Job Posted
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($act_jobs as $final_ar){
                                if(in_array($final_ar,$final_hold)){
                                    $status = "Hold";
                                }else{
                                  $status = "Live"; 
                                }
                            ?>
                            <tr class="row_high_<?php echo $final_ar; ?>">
                                <td><?php echo get_the_title($final_ar); ?></td>
                                <td><?php echo get_field('jobs_job_location',$final_ar); ?></td>
                                <td>£ <?php echo get_field('salary_required',$final_ar); ?></td>
                                <td><?php echo get_the_time('d M,Y', $final_ar); ?></td>
                                <td><?php echo $status; ?></td>
                                <td><a href="javascript:void(0); " class="my-btn my-btn-1 show_ats" id="cad_<?php echo $final_ar;?>" onclick="track_candidate(<?php echo $final_ar;?>,<?php echo $id; ?>);">View Candidates</a></td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                 </div>
                
            </div>
            <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                            <div class="your-candidate cmn-job-table-wrap">
                    <table class="csm-job-table">
                        <thead>
                            <tr>
<!--
                                <th>
                                    <label class="select-check select-all-check">
                                        <input type="checkbox">
                                        <span class="check-box"></span>
                                    </label>
                                </th>
-->
                                <th>
                                    Candidate Name
                                </th>
                                <th>
                                    Current Employer
                                </th>
                                <th>
                                    Current Job Title
                                </th>
                                <th>
                                    Current Salary
                                </th>
                                <th>
                                    Availability
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    View Candidate
                                </th>
                            </tr>
                        </thead>
                        <tbody id="show_cand">
                        <div class="my-flex-heading">
                        
                        </div>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tracking-system bg-white-shadow cmn-mg-btm">
            
                <div class="my-flex-heading justify-content-between">
                    <h4 class="cmn-job-heading">Applicant Tracking System</h4>
                    <div class="active-candidates-wrap" id="append_job_name">
                       
                    </div>
                </div>
                <div class="tracking-table-wrap">
                    <table class="tracking-table">
                        <thead>
                       <tr>
                           <th>Job Applicants</th>
                           <th>1st Stage</th>
                            <th>2nd Stage</th>
                            <th>3rd Stage</th>
                            <th>4th Stage</th>
                            <th>Offer</th>
                        </tr>
                       </thead>
                       <tbody id="ats_append">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

<!----------Active Candidate Modal----------------->

<div class="modal fade employer-modal" id="ats_emp_active_candidates" tabindex="-1" aria-labelledby="ats_emp_active_candidatesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="cmn-jobs bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">Active Candidates</h4>
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
                                            Status
                                        </th>
                                        <th>
                                            View Candidate
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                /**********Cand having bookings,offers************************/
                                            
                                foreach($active_candidates_employer as $cand_d){
                                    $act_cand = $cand_d->candidate_data;
                                    $act_cand_job = $cand_d->job_id;
                                    $can_status = $cand_d->status;
                                    $can_row = $cand_d->ID;
                                    $active_candidate_data = unserialize($act_cand);
                                    $image = wp_get_attachment_url($active_candidate_data['candidate_profile_image']);
                                    if(empty($image)){
                                      $image = get_template_directory_uri().'/images/dummy.jpg';
                                    }
                                    if($can_status == 'interview-pending'){
                                        $canstatus = "Interview Pending";
                                    }else if($can_status == 'interview-booked'){
                                       $canstatus = "Interview Booked"; 
                                    }else if($can_status == 'offer-pending'){
                                      $canstatus = "Offer Pending";   
                                    }else if($can_status == 'interview-ongoing'){
                                      $canstatus = "Interview Ongoing";   
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $active_candidate_data['name']; ?></td>
                                        <td><?php echo get_the_title($act_cand_job); ?></td>
                                        <td><?php echo $canstatus; ?></td>
                                        <td><a href="<?php echo get_the_permalink(498)?>?r=<?php echo $can_row; ?>">View</a></td>
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

<!----------Interview-ongoing candidates------------------>

<div class="modal fade employer-modal" id="ats_emp_ongoing_candidates" tabindex="-1" aria-labelledby="ats_emp_ongoing_candidatesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="cmn-jobs bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">Ongoing Candidates</h4>
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
                                            Status
                                        </th>
                                        <th>
                                            View Candidate
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                /**********Cand having bookings,offers************************/
                                            
                                foreach($interview_ongoing as $on_cand_d){
                                    $ongoing_cand = $on_cand_d->candidate_data;
                                    $ongoing_cand_job = $on_cand_d->job_id;
                                    $ongoing_can_status = $on_cand_d->status;
                                    $ongoing_can_stage = $on_cand_d->stage;
                                    $ongoing_can_row = $on_cand_d->ID;
                                    $ongoing_candidate_data = unserialize($act_cand);
                                    $image = wp_get_attachment_url($ongoing_candidate_data['candidate_profile_image']);
                                    if(empty($image)){
                                      $image = get_template_directory_uri().'/images/dummy.jpg';
                                    }
                                    if($ongoing_can_stage == 'stage1'){
                                        $ongoing_status_dis = "Interview ongoing for stage 1";
                                    }else if($ongoing_can_stage == 'stage2'){
                                      $ongoing_status_dis = "Interview ongoing for stage 2"; 
                                    }else if($ongoing_status_dis = "Interview ongoing for stage 3"){
                                      $ongoing_status_dis = "Interview ongoing for stage 3";   
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $ongoing_candidate_data['name']; ?></td>
                                        <td><?php echo get_the_title($ongoing_cand_job); ?></td>
                                        <td><?php echo $ongoing_status_dis; ?></td>
                                        <td><a href="<?php echo get_the_permalink(498)?>?r=<?php echo $ongoing_can_row; ?>">View</a></td>
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
    <!-- Modal Reject Candidate -->
    <div class="modal fade my-modal" id="atsRejectCandidate" tabindex="-1" aria-labelledby="RejectCandidateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <h4>Reject Candidate</h4>
                        <form id="reject_candidate">
                        <div class="form-group col-md-12">
<!--                          <label>Additional candidate notes</label>-->
                             <textarea class="form-control" placeholder="Submit your reason" name="rejection_reason" required></textarea>
                         </div>
                        <div class="form-btn-wrap">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" id="reject_cand">Submit</button>
                            <input type="submit" value="reject_candidate" id="reject_candidate" style="display:none">
                            <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                            <input type="hidden" id="scand" value="<?php echo $row_id; ?>" data-rc-id="<?php echo $recruiter_id; ?>">
                            <input type="hidden" name="action" value="reject_candidate">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-- Modal interview book Candidate -->
    <div class="modal fade my-modal" id="atsReq_interview" tabindex="-1" aria-labelledby="Req_interviewLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <h4>Choose three schedules for interview:</h4>
                        <form id="choose_interview_timings">
                        <div class="row">
                           
                        <div class="form-group col-md-4">
                             <label>Date 1</label>
                            <input id="picker1"  size="30" style="width: 150px" class="form-control" type="text" value="" name="timing1" required>
                         </div>
                             
                        <div class="form-group col-md-4">
                            <label>Date 2</label>
                             <input id="picker2"  class="form-control" size="30" style="width: 150px" type="text" value="" name="timing2" required>
                         </div>
                            
                        <div class="form-group col-md-4">
                            <label>Date 3</label>
                             <input id="picker3"  class="form-control" size="30" style="width: 150px" type="text" value="" name="timing3" required>
                         </div>
                        </div>
                        <div class="form-btn-wrap">
                            <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="row_id" value="<?php echo $row_id; ?>">
                            <input type="hidden" name="recruiter_id" value="<?php echo $recruiter_id; ?>">
                            <input type="hidden" name="action" value="submit_interview_timimgs">
                            <input type="submit" id="submit_timimgs" value="Submit" class="my-btn my-btn-2">
                        </div>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-----------Modal Give Feedback---------------------->
    <div class="modal fade my-modal" id="ats_give_feedback" tabindex="-1" aria-labelledby="RejectCandidateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <h4>Give Feedback</h4>
                        <form id="give_feedback">
                        <div class="form-group col-md-12">
<!--                          <label>Additional candidate notes</label>-->
                             <textarea class="form-control" placeholder="Give Feedback" name="feedback" required></textarea>
                         </div>
                        <div class="form-btn-wrap">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" id="reject_cand">Submit</button>
<!--                            <input type="submit" value="reject_candidate" id="reject_candidate" style="display:none">-->
                            <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                            <input type="hidden" id="scand_feedback" value="<?php echo $row_id; ?>" data-rc-id="<?php echo $recruiter_id; ?>">
                            <input type="hidden" name="action" value="give_feedback">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
/*****************Pending Offers*****************************/ ?>

<div class="modal fade employer-modal" id="pending_offer_candidates" tabindex="-1" aria-labelledby="ats_emp_active_candidatesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="cmn-jobs bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">Pending Offers</h4>
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
                                            View Candidate
                                        </th>
                                        <th>
                                           Contact Recruiter
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                               foreach($pending_offers_employer as $pendingcand_d){
                                    $pending_cand = $pendingcand_d->candidate_data;
                                    $pending_cand_job = $pendingcand_d->job_id;
                                    $pending_rec_id = $pendingcand_d->rec_id;
                                    $pendingcan_row = $pendingcand_d->ID;
                                    $pending_candidate_data = unserialize($pending_cand);
                                  ?>
                                    <tr>
                                        <td><?php echo $pending_candidate_data['name']; ?></td>
                                        <td><?php echo get_the_title($pending_cand_job); ?></td>
                                        <td><a href="<?php echo get_the_permalink(498)?>?r=<?php echo $pendingcan_row; ?>">View</a></td>
                                        <td><a href="<?php echo get_the_permalink(32)?>?r_id=<?php echo pending_rec_id; ?>">Contact</a></td>
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

<?php include(TEMPLATEPATH.'/footer-dashboard.php');  ?>