<?php 
/*
Template Name:Pending Offers
*/
include(TEMPLATEPATH.'/header-recruiter.php'); 
global $wpdb;
$id = get_current_user_id();

$candidate_data = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` NOT IN ('save','rejected')");

$reject_candidate_data = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` LIKE 'rejected'");

$saved_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` LIKE 'save'");

$pending_offers = array();
$pending_offered_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id` = $id AND `status` IN('offer-pending','offer-accepted')");
foreach($pending_offered_candidates as $pending_offers_cand){
   $candidate_pending_offer_ID =  $pending_offers_cand->ID;
    $offers = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE 'offer_candidate_id' AND `meta_value` LIKE '$candidate_pending_offer_ID'");
     if(get_post_status($offers[0]->post_id == 'publish')){
       $pending_offers[] = $offers[0]->post_id; 
    }
}

?> 
<section class="dashboard-section">
        <div class="dashboard-main-content">
     <?php include(TEMPLATEPATH.'/dashboard-recuirter/rating-section.php'); ?>
            <div class="counter-wrap cmn-mg-btm five-items">
                <div class="my-row">
                    <div class="counter-content bg-white-shadow">
                        <a href="<?php echo get_the_permalink(98);?>">
                        <h3><?php echo count($candidate_data); ?></h3>
                        <h6>Active Candidates</h6>
                        </a>
                    </div>
                    <div class="counter-content bg-white-shadow">
                        <a href="<?php echo get_the_permalink(544); ?>">
                        <h3><?php echo count($reject_candidate_data); ?></h3>
                        <h6>Rejected Candidates</h6>
                        </a>
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
                                    Offer Recieved
                                </th>
                                <th>
                                    Job Role
                                </th>
                                <th>
                                    Offer Name
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    View
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($pending_offers as $pending_offer_id){
                                $offer_name = get_the_title($pending_offer_id);
                                $offer_recv_date = get_the_date('d,M Y',$pending_offer_id);
                                $job_name = get_field('offer_job_title',$pending_offer_id);
                                $candidate_id = get_field('offer_candidate_id',$pending_offer_id);
                                $candid_dt = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID = $candidate_id");
                                $candidate_data = unserialize($candid_dt[0]->candidate_data);
                                $status = $candid_dt[0]->status;
                                if($status == 'offer-pending'){
                                  $dis_status = 'Offer Pending'; 
                                }else if($status == 'offer-accepted'){
                                 $dis_status = 'Contract Pending';   
                                }
                            ?>
                            <tr>
                                <td><?php echo $candidate_data['name']; ?></td>
                                <td><?php echo $offer_recv_date; ?></td>
                                <td><?php echo $job_name; ?></td>
                                <td><?php echo $offer_name; ?></td>
                                <td><?php echo $dis_status; ?></td>
                                <td><a href="<?php echo get_the_permalink(62); ?>?of_d=<?php echo $pending_offer_id; ?>">View</a></td>
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
