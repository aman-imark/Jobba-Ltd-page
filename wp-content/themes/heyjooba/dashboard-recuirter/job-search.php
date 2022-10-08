<?php
session_start();
/*
Template Name:Job Search
*/
global $wpdb;
include(TEMPLATEPATH . '/header-recruiter.php');
$id = get_current_user_id();
$serached_job_ids = array();
$hold_jobs = $wpdb->get_results("SELECT * FROM `job_status` WHERE `recruiter_id` LIKE '".$id."' AND `status` LIKE 'hold'");
foreach($hold_jobs as $hld_jobs){
   $hl_jb[] = $hld_jobs->job_id;
}
?>
<section class="dashboard-section">
    <div class="dashboard-main-content">
 <?php include(TEMPLATEPATH.'/dashboard-recuirter/rating-section.php'); ?>
        <div class="search-form-wrapper my-form cmn-padding bg-white-shadow cmn-mg-btm">
            <form id="job_search">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Keywords</label>
                        <input type="text" class="form-control" placeholder="Job title" name="keyword">
                    </div>
                    <div class="form-group col-md-4">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="London" name="city">
                        <a href="#" class="navigation-icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/dashboard-employer/images/navigation.png" alt="navigation-image">
                        </a>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Date Posted</label>
                        <select class="form-control" name="date_posted">
                            <option value="">Select any option</option>
                            <option value="last_month">Last Month</option>
                            <option value="last_week">Last Week</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Salary Expectation</label>
                        <input type="text" class="form-control" placeholder="80000" name="salary_expectation">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Experience Level</label>
                        <select class="form-control" name="experience">
                            <option value="">Select any option</option>
                            <option value="1">1 year</option>
                            <option value="2">2 years</option>
                            <option value="3">3 years</option>
                            <option value="4">4 years</option>
                            <option value="5">5 years</option>
                            <option value="6">6 years</option>
                            <option value="7">7 years</option>
                            <option value="8">8 years</option>
                            <option value="9">9 years</option>
                            <option value="10">10 years</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Onsite/Remote</label>
                        <select class="form-control" name="onsite_remote">
                            <option value="">Select any option</option>
                            <option value="remote">Remote</option>
                            <option value="onsite">Onsite</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 mb-0">
                        <div class="form-btn-wrap">
                            <input type="submit" class="my-btn my-btn-2" value="Search">
                            <?php
                            if(!empty($_SESSION)){ ?>
                            <button type="button" class="my-btn my-btn-2" onclick="clear_filter();">Clear</button> 
                            
                            <button type="button" class="my-btn my-btn-2" onclick="save_search_criteria('<?php echo $_SESSION['keyword']?>',<?php echo $id; ?>);">Save Criteria</button>
                            
                            <?php
                            /*** check if alert is already active ***/
                            $alert = $wpdb->get_results("SELECT * FROM job_alerts WHERE user_id=$id"); if(empty($alert)){       
                            ?>
                            <button type="button" class="my-btn my-btn-2" id="create_job_alt" data-userid="<?php echo $id; ?>">Create Job alert</button>
                            <?php }else{ ?>
                            <button type="button" class="my-btn my-btn-2" id="stop_job_alt" data-rowid="<?php echo $alert[0]->ID; ?>">Stop Job alert</button>
                            <?php } ?>
                            
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="filter-tag-wrap cmn-padding bg-white-shadow cmn-mg-btm">
            <div class="tag-heading">
                <h6>Keywords tagged:</h6>
                <ul>
                    <?php
                    $keywords = $wpdb->get_results("SELECT search_criteria FROM save_search_criteria WHERE recruiter_id=$id");
                    foreach($keywords as $keyword){
                      $search = $keyword->search_criteria;
                    ?>
                    <li>
                        <a href="javascript:void(0)" class="my-btn my-btn-2"><?php echo $search; ?></a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="form-group col-md-4">
                        <label>Change Order</label>
                        <select class="form-control" id="order" onchange="sort_jobs();">
                            <option value="">Select any option</option>
                            <option value="date_posted">Date Posted</option>
                            <option value="closing_date">Job Closing date</option>
                        </select>
            </div>
            <?php
            /************For keyword*******************/
            
            if(isset($_SESSION['keyword']) && $_SESSION['keyword'] !=""){
                $keyword = $_SESSION['keyword'];
                $titles = $wpdb->get_results("SELECT ID FROM `wp_posts` WHERE `post_title` LIKE '%".$keyword."%' AND `post_status` LIKE 'publish' AND `post_type` LIKE 'jobs'");
                
                foreach($titles as $title){
                  $serached_job_ids[] = $title->ID;
                }
                
                if(empty($titles)){
                  $titl_location = $wpdb->get_results("SELECT post_id FROM `wp_postmeta` WHERE `meta_key` LIKE 'jobs_job_location' AND `meta_value` LIKE '%".$keyword."%'"); 
                    foreach($titl_location as $titl_locations){
                    if(get_post_status($titl_locations->post_id) == 'publish'){
                  $serached_job_ids[] = $titl_locations->post_id;
                        }
                    }
                }
                if(empty($titl_locations)){
                  $title_job_cats = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE 'job_category' AND `meta_value` LIKE '%data science%'"); 
                foreach($title_job_cats as $title_job_cat){
                    if(get_post_status($title_job_cat->post_id) == 'publish'){
                  $serached_job_ids[] = $title_job_cat->post_id;
                    }
                }
            }
         }
            /***************For city**************************/
            
              if(isset($_SESSION['city']) && $_SESSION['city'] !=""){
                $city = $_SESSION['city'];
                $cities = $wpdb->get_results("SELECT post_id FROM `wp_postmeta` WHERE `meta_key` LIKE 'jobs_job_location' AND `meta_value` LIKE '%".$city."%'");
                  
                foreach($cities as $citi){
                    if(get_post_status($citi->post_id) == 'publish'){
                       $serached_job_ids[] = $citi->post_id;  
                    }
                }
            }
             /***************For salary**************************/
            
            if(isset($_SESSION['salary_expectation']) && $_SESSION['salary_expectation'] !=""){
                $salary = $_SESSION['salary_expectation'];
                $sal_job_ids = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE 'salary_required' AND `meta_value` LIKE '%".$salary."%'");
                  
                foreach($sal_job_ids as $sal_job_id){
                    if(get_post_status($sal_job_id->post_id) == 'publish'){
                       $serached_job_ids[] = $sal_job_id->post_id;  
                    }
                }
            }
            
            /********************Job Type**************************/
            
            if(isset($_SESSION['onsite_remote']) && $_SESSION['onsite_remote'] !=""){
                $job_type = $_SESSION['onsite_remote'];
                $type_job_ids = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE 'job_type' AND `meta_value` LIKE '%".$job_type."%'");
                  
                foreach($type_job_ids as $type_job_id){
                    if(get_post_status($type_job_id->post_id) == 'publish'){
                       $serached_job_ids[] = $type_job_id->post_id;  
                    }
                }
            }
            
            /************For Experience********************/
            
            if(isset($_SESSION['experience']) && $_SESSION['experience'] !=""){
                $experience = $_SESSION['experience'];
                $experience_job_ids = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE '%years_of_experience%' AND `meta_value` = '".$experience."'");
                  
                foreach($experience_job_ids as $exp_job_ids){
                    if(get_post_status($exp_job_ids->post_id) == 'publish'){
                       $serached_job_ids[] = $exp_job_ids->post_id;  
                    }
                }
            }
            
//            $date_current = date("Y-m-d h:i:s");// current date
//            $date_old = date("Y-m-d h:i:s", strtotime("-1 week"));
////            $date_old = date("Y-m-d", strtotime($date_old));
//            
//            $years = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_date >= $date_old  AND post_date <= $date_current AND post_status LIKE 'publish'");
//            
//            echo $wpdb->last_query;
//            print_r($years);
            
            $serached_job_ids = array_unique($serached_job_ids);
            ?>
            <div class="filter-result-wrap" id="show_jobs">
                <p><small>1 - 8 of 8662 Web Developer Jobs</small></p>
                <?php
                foreach($serached_job_ids as $serach_result){
                    $employer_id = get_field('employer_id',$serach_result);
                    $compay_name = get_field('business_name','user_'.$employer_id);
                ?>
                <a href="<?php echo get_the_permalink($serach_result); ?>">
                    <article class="job-infor-wrapper">
                        <h4><?php echo get_the_title($serach_result); ?></h4>
                        <?php
                            if(in_array($serach_result,$hl_jb)){ ?>
                        <ul class="job-post-details">
                        <li><?php echo "JOB ON HOLD"; ?></li>
                        </ul>
                            <?php }
                            ?>
                        <p><?php echo $compay_name; ?></p>
                        <ul class="job-details">
                            <li>
                                <span><img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/job-description-1.png" alt="img"></span>
                                <?php
                                $exp = get_field('experience_added',$serach_result);
                                foreach($exp as $exp_fields){
                                   echo $exp_fields['exp_field_name'].' ';
                                }
                                ?>
                            </li>
                            <li>
                                <span>£</span>
                                <?php echo get_field('salary_required',$serach_result); ?>
                            </li>
                            <li>
                                <span><img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/job-description-2.png" alt="img"></span>
                                <?php echo get_field('jobs_job_location',$serach_result); ?>/<?php echo get_field('job_type',$serach_result); ?>
                            </li>
                            <li>
                                <span><img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/job-description-3.png" alt="img"></span>
                                <?php 
                                $skills = get_field('skills',$serach_result);
                                foreach($skills as $skil)
                                {
                                  echo $skil['job_skill_name'].' . '; 
                                }
                                ?>
                            </li>
                        </ul>
                        <ul class="job-post-details">
                            <li>
                                Posted 1 day ago
                            </li>
                            <li>
                                <?php
                                $close_date = get_field('job_closing_date',$serach_result); ?>
                                Closes <?php echo date('d.m.Y',strtotime($close_date)); ?>
                           </li>
                        </ul>
                    </article>
                </a>
                <input type="hidden" name="searched_ids" id="searched_ids" value="<?php echo implode(',',$serached_job_ids); ?>">
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php include(TEMPLATEPATH . '/footer-recruiter.php');  ?>