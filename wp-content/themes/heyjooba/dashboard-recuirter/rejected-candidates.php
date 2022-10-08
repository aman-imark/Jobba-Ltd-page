<?php 
/*
Template Name:Rejected Candidates
*/
include(TEMPLATEPATH.'/header-recruiter.php'); 
global $wpdb;
$id = get_current_user_id();
$rejected_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` LIKE 'rejected' AND `shared_status` = 0");

$act_candidate_data = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` LIKE 'active' AND `shared_status` = 0");

$saved_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` LIKE 'save' AND `shared_status` = 0");
?> 
<section class="dashboard-section">
        <div class="dashboard-main-content">
     <?php include(TEMPLATEPATH.'/dashboard-recuirter/rating-section.php'); ?>
            <div class="counter-wrap cmn-mg-btm five-items">
                <div class="my-row">
                    <div class="counter-content bg-white-shadow">
                        <h3><?php echo count($act_candidate_data); ?></h3>
                        <h6>Active Candidates</h6>
                    </div>

                    <div class="counter-content bg-white-shadow">
                        <h3><?php echo count($candidate_data); ?></h3>
                        <h6>Rejected Candidates</h6>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <a href="<?php echo get_the_permalink(611); ?>">
                        <h3><?php echo count($saved_candidates); ?></h3>
                        <h6>Saved Candidates</h6>
                        </a>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <h3>6</h3>
                        <h6>
                            Placed Candidates in 2021
                        </h6>
                    </div>
                </div>
            </div>
            <div class="cmn-jobs cmn-mg-btm bg-white-shadow">
                <div class="your-candidate cmn-job-table-wrap">
                    <table class="csm-job-table">
                        <thead>
                            <tr>
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
                                    View Candidate
                                </th>
                                <th>
                                    Update Candidate
                                </th>
                                <th>
                                    Add notes to profile
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($rejected_candidates as $candidate_dt){
                                $candi_dt = $candidate_dt->candidate_data;
                                $row_id = $candidate_dt->ID;
                            $candidate_detail_data = unserialize($candi_dt);
                             ?>
                            <tr>
                                <td>
                                    <span class="table-applicant">
                                        <?php
                          $candidate_profile_image = $candidate_detail_data['candidate_profile_image'];
                                if(!empty($candidate_profile_image)){ ?>
                                    <img src="<?php echo wp_get_attachment_url($candidate_detail_data['candidate_profile_image']);?>" alt="Candidate-img">
                                        <?php }else{ ?>
                                          
                                        <img src="<?php echo get_template_directory_uri();?>/images/dummy.jpg" alt="Candidate-img">
                                        <?php }
                                        ?>
                                    </span>
                                    <?php echo $candidate_detail_data['name']; ?>
                                </td>
                                <td><?php echo $candidate_detail_data['current_employer']; ?></td>
                                <td><?php echo $candidate_detail_data['current_position']; ?></td>
                                <td><?php echo $candidate_detail_data['current_salary']; ?></td>
                                <td><?php echo $candidate_detail_data['availablity']; ?></td>
                                <td><a href="<?php echo get_the_permalink(505);?>?r=<?php echo $row_id; ?>">View</a></td>
                                <td><a href="<?php echo get_the_permalink(500);?>?r=<?php echo $row_id; ?>">Update Profile</a></td>
                                <td><a href="<?php echo get_the_permalink(500);?>?r=<?php echo $row_id; ?>">Add notes to profile</a></td>
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
<?php include(TEMPLATEPATH.'/footer-recruiter.php');  ?>
