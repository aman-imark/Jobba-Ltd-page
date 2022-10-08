<?php 
/*
Template Name:Candidate Shortlist
*/
include(TEMPLATEPATH.'/header-dashboard.php');
global $wpdb;
$id = get_current_user_id();
$final_array = array();

$current_date = date('Y-m-d');

/**************Jobs on basis of candidates recieved and date filter********************/

$job_recv_cand = $wpdb->get_results("SELECT job_id FROM `save_candidate` WHERE `emp_id` = $id AND `status` IN('active','interview-pending','rearrange-interview','rejected')");
foreach($job_recv_cand as $job_recv){
$job_enddate = get_field('job_closing_date',$job_recv->job_id);
$when_submit =  get_field('when_you_want_to_recieve_candidates',$job_recv->job_id);
    
if($when_submit == 'on_close_date' && $job_enddate <= $current_date){
    $final_array[] = $job_recv->job_id;  
}elseif($when_submit == 'recieve_as_submitted'){
    $final_array[] = $job_recv->job_id;
}
}
$final_array = array_unique($final_array);

/*************Hold Jobs***************************/

$hold_jobs =  $wpdb->get_results("SELECT job_id FROM job_status WHERE status LIKE 'hold'");
foreach($hold_jobs as $hld_jobs){
    $final_hold[] = $hld_jobs->job_id;
}
?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
       <?php include(TEMPLATEPATH.'/dashboard-employer/employer-rating-section.php');  ?>
            <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                <div class="my-flex-heading">
                    <h4 class="cmn-job-heading">Select Candidate Shortlist</h4>
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
                                    Job close date
                                </th>
                                <th>
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($final_array as $final_job_id){
                             if(in_array($final_job_id,$final_hold)){
                                $status = 'Hold';
                             } else{
                               $status = 'Live';  
                             }
                            ?>
                            <tr id="cad_<?php echo $final_job_id;?>" onclick="candidate_list(<?php echo $final_job_id;?>,<?php echo $id; ?>);" class="row_highlighted_<?php echo $final_job_id; ?>">
                                <td><?php echo get_the_title($final_job_id); ?></td>
                                <td><?php echo get_field('jobs_job_location',$final_job_id); ?></td>
                                <td>£ <?php echo get_field('salary_required',$final_job_id); ?></td>
                                <td><?php echo get_the_time('d M,Y', $final_job_id); ?></td>
                                <td>
                       <?php echo date('d M,Y',strtotime(get_field('job_closing_date',$final_job_id))); ?></td>
                                <td><?php echo $status;  ?></td>
<!--                                <td><a href="javascript:void(0); " class="my-btn my-btn-1" id="cad_<?php //echo $final_job_id;?>" onclick="candidate_list(<?php //echo $final_job_id;?>,<?php //echo $id; ?>);">View Candidates</a></td>-->
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <button type="button" class="my-btn my-btn-3" id="request_more_info">Action</button>
            <div class="my-flex-heading">
                    <div class="form-btn-wrap">
                    <div class="form-btn-wrap">
                    <button type="button" class="my-btn my-btn-2" data-bs-toggle="modal"
                        data-bs-target="#ShareCandidate" style="display:none" id="share_cv">Share Profile</button>
                    <button type="button" class="my-btn my-btn-2" data-bs-toggle="modal"
                        data-bs-target="#RejectCandidate" style="display:none" id="rj_cn">Reject Candidate</button>
<!--                    <button type="button" class="my-btn my-btn-3" style="display:none" id="make_offer">Make Offer</button>-->
                    <button type="button" class="my-btn my-btn-2" data-bs-toggle="modal"
                        data-bs-target="#ShareShortlist" style="display:none" id="share_shortlist">Share Shortlist</button>
                    
                </div>
                    </div>
                </div>
            <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                <div class="your-candidate cmn-job-table-wrap">
                    <table class="csm-job-table">
                        <thead>
                            <tr>
                                <th>
                                    <label class="select-check select-all-check">
                                        <input type="checkbox">
                                        <span class="check-box"></span>
                                    </label>
                                </th>
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
                        <h4 class="cmn-job-heading">Candidates Recieved</h4>
                        </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Reject Candidate -->
    <div class="modal fade my-modal" id="RejectCandidate" tabindex="-1" aria-labelledby="RejectCandidateLabel"
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
                            <input type="hidden" name="action" value="reject_candidate">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Share Candidate -->
    <div class="modal fade my-modal" id="ShareCandidate" tabindex="-1" aria-labelledby="ShareCandidateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <h4>Share Candidate Profile</h4>
                        <form id="share_candidate">
                        <div class="form-group col-md-12">
                          <label>Enter Email</label>
                             <input type="email" class="form-control" name="share_email" placeholder="Please enter email..." required>
                         </div>
                        <div class="form-btn-wrap">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" id="share_cand">Send</button>
                            <input type="submit" value="share_candidate" id="share_candidate" style="display:none">
                            <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="action" value="share_candidate">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Share Shortlist -->
    <div class="modal fade my-modal" id="ShareShortlist" tabindex="-1" aria-labelledby="ShareCandidateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="candidate-submission-wrap">
                        <h4>Share Shortlist</h4>
                        <form id="share_shortlist_form">
                        <div class="form-group col-md-12">
                          <label>Enter Email</label>
                             <input type="email" class="form-control" name="share_shortlist_email" placeholder="Please enter email..." required>
                         </div>
                        <div class="form-btn-wrap">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" id="share_cand_colab">Send</button>
                            <input type="submit" value="share_shortlist" id="share_shortlist_collab" style="display:none">
                            <input type="hidden" name="emp_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="action" value="share_shortlist_collab">
                            <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include(TEMPLATEPATH.'/footer-dashboard.php');  ?>

<?php if(isset($_GET['id']) && $_GET['id'] != ''){?>
<script>
jQuery(document).ready(function(){
  var cid = '<?php echo $_GET['id']; ?>';
   jQuery("#cad_"+cid).click();
});
</script>

<?php }?>