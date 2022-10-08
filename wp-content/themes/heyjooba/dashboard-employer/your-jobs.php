<?php 
/*
Template Name:Your Jobs
*/
include(TEMPLATEPATH.'/header-dashboard.php'); 
$user_id = get_current_user_id();
global $wpdb;
$current_year_posts = array();
$current_date = date('Y-m-d');

$live_posts_count = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_author` = $user_id AND `post_status` LIKE 'publish' AND `post_type` LIKE 'jobs'");
$lp_c = count($live_posts_count);

$draft_posts_count = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_author` = $user_id AND `post_status` LIKE 'draft' AND `post_type` LIKE 'jobs'");
$dp_c = count($draft_posts_count);

$hold_jobs = $wpdb->get_results("SELECT * FROM job_status WHERE status LIKE 'hold'");
foreach($hold_jobs as $hld_jb){
  $hld_dis_jobs[] = $hld_jb->job_id;
}

$curent_year = date('Y');

foreach($live_posts_count as $live_post){
   $post_date_year = date('Y',strtotime($live_post->post_date));
if($post_date_year == $curent_year){
    $current_year_posts[] = $live_post->ID;
}
}
$current_posts = count($current_year_posts);

?>
<section class="dashboard-section">
        <div class="dashboard-main-content">
         <?php include(TEMPLATEPATH.'/dashboard-employer/employer-rating-section.php');  ?>
            <div class="counter-wrap cmn-mg-btm three-items">
                <div class="my-row">
                    <div class="counter-content bg-white-shadow">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#livejobpostModal">
                        <h3><?php echo $lp_c; ?></h3>
                        <h6>Live Jobs</h6>
                        </a>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#jobpostModal">
                        <h3><?php echo $dp_c; ?></h3>
                        <h6>Job Drafts</h6>
                        </a>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <h3><?php echo $current_posts; ?></h3>
                        <h6>Jobs Filled in <?php echo $curent_year; ?></h6>
                    </div>
                </div>
            </div>
            
            <div class="different-job-wrap">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                            <div class="my-flex-heading">
                                <h4 class="cmn-job-heading">Live Jobs</h4>
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
                                                Posted Date
                                            </th>
                                            
                                            <th>
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                       foreach($live_posts_count as $live_posts){
                                           $live_post_id = $live_posts->ID;
                                          $job_end_date =  get_field('job_closing_date',$live_post_id);
                                           if(in_array($live_post_id,$hld_dis_jobs)){
                                               $status = 'Hold';
                                           }else if($current_date >= $job_end_date){
                                                $status = 'Expired'; 
                                            }else{
                                              $status = 'Live';  
                                           }
                                        ?>
                                        <tr data-bs-toggle="modal" data-bs-target="#Hold_deleteJob_<?php echo $i; ?>">
                                            <td><?php echo get_the_title($live_post_id); ?></td>
                                            <td><?php echo get_field('jobs_job_location',$live_post_id); ?></td>
                                            <td>£ <?php echo get_field('salary_required',$live_post_id); ?></td>
                                            <td><?php echo get_the_date('d M,Y',$live_post_id); ?></td>
                                            <td><?php echo $status; ?></td>
                                        </tr>
                                            <!-- Modal -->
                                        <div class="modal fade my-modal" id="Hold_deleteJob_<?php echo $i;?>" tabindex="-1" aria-labelledby="SubmitCandidateLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        <div class="candidate-submission-wrap">
                                                         <div class="form-btn-wrap">
                                                                <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" id="" onclick="hold_job(<?php echo $id; ?>,<?php echo $live_post_id; ?>)">Hold Job</button>
                                                                <button class="my-btn my-btn-2" data-bs-dismiss="modal" aria-label="Close" onclick="delete_job(<?php echo $id;?>,<?php echo $live_post_id; ?>)" >Delete</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                       }
                                        ?>
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                            <div class="my-flex-heading">
                                <h4 class="cmn-job-heading">Job Drafts</h4>
                            </div>
                            <div class="cmn-job-table-wrap">
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
                                                Posted Date
                                            </th>
                                            <th>
                                                Edit
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($draft_posts_count as $draft_posts){
                                           $draft_ids = $draft_posts->ID 
                                     ?>
                                        <tr>
                                            <td><?php echo get_the_title($draft_ids); ?></td>
                                            <td><?php echo get_field('jobs_job_location',$draft_ids); ?></td>
                                            <td>£ <?php echo get_field('salary_required',$draft_ids); ?></td>
                                            <td><?php echo get_the_date('d M,Y',$draft_ids); ?></td>
                                            <td><a href="<?php echo get_the_permalink(48);?>?job_id=<?php echo $draft_ids; ?>">Edit</a></td>
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
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                            <div class="my-flex-heading">
                                <h4 class="cmn-job-heading">Jobs Filled</h4>
                            </div>
                            <div class="cmn-job-table-wrap">
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
                                                Posted Date
                                            </th>
                                            <th>
                                                View
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($current_year_posts as $year_posts){
                                      ?>
                                        <tr>
                                            <td><?php echo get_the_title($year_posts); ?></td>
                                            <td><?php echo get_field('jobs_job_location',$year_posts); ?></td>
                                            <td>£ <?php echo get_field('salary_required',$year_posts); ?></td>
                                            <td><?php echo get_the_date('d M,Y',$year_posts); ?></td>
                                           <td><a href="<?php echo get_the_permalink(606);?>?job_id=<?php echo $year_posts; ?>">View</a></td>
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


<?php include(TEMPLATEPATH.'/footer-dashboard.php');  ?>
