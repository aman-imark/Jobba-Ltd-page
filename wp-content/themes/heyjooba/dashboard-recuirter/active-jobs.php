<?php 
/*
Template Name:Active Jobs
*/
include(TEMPLATEPATH.'/header-recruiter.php');
$id = get_current_user_id();
$current_date = date('Y-m-d');
global $wpdb;

$active_jobs = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` ='" . $id . "' AND status NOT IN('save','rejected','offer-accepted','contract-signed','pending)");

foreach($active_jobs as $sv_j){
  $job_ids[] = $sv_j->job_id;
} 
$job_ids = array_unique($job_ids);


$hold_jobs = $wpdb->get_results("SELECT job_id FROM job_status WHERE recruiter_id=$id AND status='hold'");
foreach($hold_jobs as $hld_job){
  $hl_jb[] = $hld_job->job_id; 
}

?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
            <?php
            include(TEMPLATEPATH.'/dashboard-recuirter/recruiter-header-additional.php');
            ?>
            <div class="different-job-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                            <div class="my-flex-heading">
                                <h4 class="cmn-job-heading">Active Jobs</h4>
                            </div>
                            <div class="cmn-job-table-wrap equal-tables">
                                <table class="csm-job-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Job Title
                                            </th>
                                            <th>
                                                Location
                                            </th>
                                            <th>
                                                Salary
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                View Job
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($job_ids as $active_job){
                                $job_end_date = strtotime(get_field('job_closing_date',$active_job));
                                          $current_timestamp =  strtotime($current_date);  
                                        if(in_array($active_job,$results_hold)){
                                                $actistatus = 'Hold';
                                            }elseif($job_end_date <= $current_timestamp){
                                              $actistatus = 'Expired';  
                                            }else{
                                               $actistatus = 'Live';    
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo get_the_title($active_job); ?></td>
                                            <td><?php echo get_field('jobs_job_location',$active_job); ?></td>
                                            <td>£ <?php echo get_field('salary_required',$active_job); ?></td>
                                            <td><?php echo get_the_date('d M,Y',$active_job); ?></td>
                                            <td><?php echo $actistatus; ?></td>
                                            <td><a href="<?php echo get_the_permalink($active_job);?>">View</a></td>
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


<?php include(TEMPLATEPATH.'/footer-recruiter.php');  ?>
