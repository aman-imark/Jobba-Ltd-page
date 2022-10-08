<?php 
/*
Template Name:Saved Jobs
*/
include(TEMPLATEPATH.'/header-recruiter.php');
$id = get_current_user_id();
global $wpdb;

$valid_jobs_ids = array();
$job_ids = array();
$svd_jobs = $wpdb->get_results("SELECT * FROM job_status WHERE recruiter_id='".$id."' AND status LIKE 'saved'");
foreach($svd_jobs as $sv_j){
  $job_ids[] = $sv_j->job_id;
    $valid_jobs = check_date($sv_j->job_id);
    if(in_array($valid_jobs,$job_ids)){
      $valid_jobs_ids[] = $valid_jobs;  
    }
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
                                <h4 class="cmn-job-heading">Saved Jobs</h4>
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
                                                Move Job
                                            </th>
                                            <th>
                                                Remove Job
                                            </th>
                                            <th>
                                                View Job
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($valid_jobs_ids as $save_job){
                                            
                                        $get_row_id = $wpdb->get_results("SELECT ID FROM job_status WHERE job_id=$save_job");
                                        ?>
                                        <tr>
                                            <td><?php echo get_the_title($save_job); ?></td>
                                            <td><?php echo get_field('jobs_job_location',$save_job); ?></td>
                                            <td>£ <?php echo get_field('salary_required',$save_job); ?></td>
                                            <td><?php echo get_the_date(); ?></td>
                                            <td><a href="javascript:void(0);" onclick="move_to_active(<?php echo $get_row_id[0]->ID; ?>)">Move to Active</a></td>
                                            <td><a href="javascript:void(0);" onclick="remove_saved_job(<?php echo $get_row_id[0]->ID; ?>)">Remove</a></td>
                                            <td><a href="<?php echo get_the_permalink($save_job);?>">View</a></td>
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
