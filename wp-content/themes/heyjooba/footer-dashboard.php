    <!-- jQuery first, then Bootstrap JS. -->
<script src="<?php echo get_template_directory_uri();?>/dashboard-employer/js/bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/dashboard-employer/js/custom.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js">
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/dashboard-employer/js/employer-custom-data.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <div class="modal fade employer-modal" id="jobpostModal" tabindex="-1" aria-labelledby="jobpostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="cmn-jobs bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">Draft Jobs</h4>
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
                                    $draft_posts_count = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_author` = $user_id AND `post_status` LIKE 'draft' AND `post_type` LIKE 'jobs'");
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
        </div>
    </div>
<div class="modal fade employer-modal" id="livejobpostModal" tabindex="-1" aria-labelledby="jobpostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="cmn-jobs bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">Live Jobs</h4>
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
                                    $live_posts_count = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_author`='".$user_id."' AND `post_status` LIKE 'publish' AND `post_type` LIKE 'jobs'");
                                    foreach($live_posts_count as $live_posts){
                                           $live_ids = $live_posts->ID 
                                     ?>
                                        <tr>
                                            <td><?php echo get_the_title($live_ids); ?></td>
                                            <td><?php echo get_field('jobs_job_location',$live_ids); ?></td>
                                            <td>£ <?php echo get_field('salary_required',$live_ids); ?></td>
                                            <td><?php echo get_the_date('d M,Y',$live_ids); ?></td>
                                           <td><a href="<?php echo get_the_permalink(606);?>?job_id=<?php echo $live_ids; ?>">View</a></td>
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
/*************Modal (html)*******************/
?>
<!--
    <div class="modal fade employer-modal" id="jobpostModal" tabindex="-1" aria-labelledby="jobpostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="cmn-jobs bg-white-shadow">
                        <div class="my-flex-heading">
                            <h4 class="cmn-job-heading">8 Jobs Filled In 2021</h4>
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
                                            Date
                                        </th>
                                        <th>
                                            Click for View
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Head of UX</td>
                                        <td>London</td>
                                        <td>TBC</td>
                                        <td>1 Feb, 2021</td>
                                        <td><a href="#" class="my-btn my-btn-3 active">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Junior Developer x4</td>
                                        <td>TBC</td>
                                        <td>TBC</td>
                                        <td>26 Jan, 2021</td>
                                        <td><a href="#" class="my-btn my-btn-3 active">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Solutions Architect</td>
                                        <td>Remote</td>
                                        <td>TBC</td>
                                        <td>15 Dec, 2021</td>
                                        <td><a href="#" class="my-btn my-btn-3 active">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Network Architect</td>
                                        <td>Manchester</td>
                                        <td>TBC</td>
                                        <td>17 Nov, 2021</td>
                                        <td><a href="#" class="my-btn my-btn-3 active">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Firewall Engineer</td>
                                        <td>Manchester</td>
                                        <td>TBC</td>
                                        <td>19 Oct, 2021</td>
                                        <td><a href="#" class="my-btn my-btn-3 active">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Head of UX</td>
                                        <td>London</td>
                                        <td>TBC</td>
                                        <td>10 Sep, 2021</td>
                                        <td><a href="#" class="my-btn my-btn-3 active">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Junior Developer x4</td>
                                        <td>Bristol</td>
                                        <td>TBC</td>
                                        <td>5 August, 2021</td>
                                        <td><a href="#" class="my-btn my-btn-3 active">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Solutions Architect</td>
                                        <td>Remote</td>
                                        <td>TBC</td>
                                        <td>29 Jul, 2021</td>
                                        <td><a href="#" class="my-btn my-btn-3 active">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->

</body>

</html>