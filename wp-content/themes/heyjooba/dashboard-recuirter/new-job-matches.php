<?php 
/*
Template Name:New job matches
*/
include(TEMPLATEPATH.'/header-recruiter.php');
$id = get_current_user_id();
global $wpdb;

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
        if(in_array($technical_skill_array,$expert_area_rec)){
            $dis_active_jobs[] = $job->ID;
        }
    }
}

$all_job = count($dis_active_jobs);

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
                                <h4 class="cmn-job-heading">New job matches!</h4>
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
                                                View Job
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($dis_active_jobs as $all_job){
                                       ?>
                                        <tr>
                                            <td><?php echo get_the_title($all_job); ?></td>
                                            <td><?php echo get_field('jobs_job_location',$all_job); ?></td>
                                            <td>£ <?php echo get_field('salary_required',$all_job); ?></td>
                                            <td><?php echo get_the_date(); ?></td>
                                            <td><a href="<?php echo get_the_permalink($all_job);?>">View</a></td>
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
