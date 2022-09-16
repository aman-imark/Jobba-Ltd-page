<?php
/*
Template Name:Home
*/
get_header();
global $post;
//print_r($_GET);
if (!empty($_GET)) {
    //    echo "kkkk";
    activate_account($_GET['key']);
}
?>


<style>
    .freelancer-pop {
        display: none;
    }
</style>

<div class="style1">
    <?php include(TEMPLATEPATH . '/header-content.php'); ?>
</div>

<main class="content">
    <section class="intro bg-purple">
        <div class="container">
            <div class="intro-head">
                <h1><?php echo get_field('banner_heading', $post->ID); ?></h1>
                <h2><?php echo get_field('banner_subheading', $post->ID); ?></h2>
            </div>
            <div class="chooseing">
                <a href="<?php echo get_the_permalink(14); ?>" class="btn h66 btn-primary">EMPLOYERS ENTER HERE</a>
                <a href="<?php echo get_the_permalink(18); ?>" class="btn h66 btn-secondary">RECRUITERS ENTER HERE</a>
            </div>
            <div class="dashboard-img">
                <figure>
                    <img src="<?php echo get_field('dashboard_image', $post->ID); ?>" alt="images">
                </figure>
            </div>
        </div>
    </section>

    <!-- <section class="platform uSpace bg-secondary">
        <div class="container">
            <div class="expert" data-aos="fade-up" data-aos-duration="3000">
                <h2>ONE PLATFORM.<br> HUNDREDS OF EXPERT TECH RECRUITERS.<br> YOU’RE IN CONTROL.</h2>
                <p>Sign up, post jobs for free, then let 100s of the UK’s best TECH & IT recruiters look for your perfect candidate.<br> You don’t pay a penny until you hire someone. And even then, it’s on your own terms.</p>
            </div>
        </div>
    </section> -->

    <!-- <section class="offer uSpace bg-purple">
        <div class="container">
            <div class="row gx-50">
                <?php
                $test_home = get_field('testimonials', $post->ID);
                $d = 1;
                foreach ($test_home as $test_h) {
                    if ($d == 1) {
                        $home_animate = "fade-right";
                    } else if ($d == 2) {
                        $home_animate = "fade-down";
                        $sec_home_anim = 'data-aos="fade-up" data-aos-duration="3000"';
                    } else if ($d == 3) {
                        $home_animate = "fade-left";
                        $sec_home_anim = '';
                    } ?>
                <div class="col-xl-4 col-12">
                    <div class="city-intro" data-aos="<?php echo $home_animate; ?>" data-aos-duration="3000">
                        <p><?php echo $test_h['testimonial_content']; ?></p>
                        <p <?php echo $sec_home_anim; ?>><?php echo $test_h['client_name']; ?></p>
                    </div>
                </div>
                <?php
                    $d++;
                }
                ?>
     
            </div>
        </div>
    </section> -->

    <section class="offer uSpace bg-purple">
        <div class="container">
            <div class="common-heading aos-init aos-animate" data-aos="fade-down" data-aos-duration="2000">
                <h2 class="text-white"><?php echo get_field('homepage_supporters_heading',$post->ID); ?></h2>
            </div>
            <div class="support row row-cols-lg-4 row-cols-md-3 row-cols-2">
                <?php
                $supporters = get_field('homepage_supporters',$post->ID);
                foreach($supporters as $supporter){ ?>
                <div class="col">
                    <figure>
                        <img src="<?php echo $supporter['home_suporters_logos']; ?>">
                    </figure>
                </div> 
                <?php }
                ?>
            </div>
        </div>
    </section>

    <!--
    <section class="free-join uSpace">
        <div class="container">
            <div class="common-heading" data-aos="fade-down" data-aos-duration="3000">
                <h2><?php echo get_field('facility_heading', $post->ID); ?></h2>
            </div>
            <div class="multiple-posts">
                <div class="row gy-2 gy-md-2">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="posts" data-aos="fade-right" data-aos-duration="2000">
                            <p><?php echo get_field('facility_1_heading', $post->ID); ?></p>
                            <p><?php echo get_field('facility_content_1', $post->ID); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="posts">
                            <p><?php echo get_field('facility_2', $post->ID); ?></p>
                            <p><?php echo get_field('facility_2_content', $post->ID); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="posts">
                            <p><?php echo get_field('facilility_heading_3', $post->ID); ?></p>
                            <p><?php echo get_field('facility_content_3', $post->ID); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="posts" data-aos="fade-left" data-aos-duration="2000">
                            <p><?php echo get_field('facility_heading_4', $post->ID); ?></p>
                            <p><?php echo get_field('facility_content_4', $post->ID); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                <a href="<?php echo get_the_permalink(82); ?>" class="btn btn-primary">POST A JOB FOR FREE TODAY!</a>
            </div>
        </div>
    </section>
-->

    <!--
    <section class="recruitment uSpace bg-purple">
        <div class="container">
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('change_heading', $post->ID); ?></h2>
                <div class="readit" style="display: none;">
                   <?php echo get_field('change_content', $post->ID); ?>
                </div>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-primary clickable">FIND OUT MORE</a>
                </div>
            </div>
        </div>
    </section>
-->

    <!--
    <section class="recruitment right uSpace bg-primary">
        <div class="container">
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('control_heading', $post->ID); ?></h2>
                <div class="readit" style="display: none;">
                    <?php echo get_field('control_content', $post->ID); ?>
                </div>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-secondary clickable">FIND OUT MORE</a>
                </div>
            </div>
        </div>
    </section>
-->

    <!--
    <section class="recruitment uSpace bg-secondary">
        <div class="container">
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('ultimate_heading', $post->ID); ?></h2>
                <div class="readit" style="display: none;">
                   <?php echo get_field('ultimate_content', $post->ID); ?>
                </div>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-purple clickable">FIND OUT MORE</a>
                </div>
            </div>
        </div>
    </section>
-->

    <!--
    <section class="free-join it-work uSpace">
        <div class="container">
            <div class="common-heading" data-aos="fade-down" data-aos-duration="3000">
                <h2><?php echo get_field('how_it_works_heading', $post->ID); ?></h2>
            </div>
            <div class="multiple-posts">
                <div class="row gy-2 gy-md-2">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="posts job" data-aos="fade-right" data-aos-duration="2000">
                            <p><?php echo get_field('work_points1', $post->ID); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="posts job">
                            <p><?php echo get_field('work_point_2', $post->ID); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="posts job">
                            <p><?php echo get_field('work_point_3', $post->ID); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="posts job" data-aos="fade-left" data-aos-duration="2000">
                            <p><?php echo get_field('work_point_4', $post->ID); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                <a href="javascript:void(0)" class="btn btn-primary">POST A JOB FOR FREE TODAY!</a>
            </div>
        </div>
    </section>
-->

    <!--
    <section class="payment uSpace bg-secondary">
        <div class="container">
            <div class="common-heading">
                <h2><?php echo get_field('payment_heading', $post->ID); ?></h2>
                <p><?php echo get_field('progress_level', $post->ID); ?></p>
            </div>
            <div class="p-bar">
                <ul>
                    <li>5%</li>
                    <li>10%</li>
                    <li>15%</li>
                    <li>20%</li>
                    <li>25%</li>
                    <li>30%</li>
                </ul>
                <div class="ongoing-bar">
                    <div class="progress">
                        <input type="range" class="form-range" id="customRange1" min="0" max="30" type="range" value="<?php echo get_field('progress_value', $post->ID); ?>" step="0.25">
                    </div>
                     <figure>
                        <img src="images/p-arrow.png" alt="">
                    </figure> 
                </div>
            </div>
        </div>
    </section>
-->

    <!--
    <section class="recruitment uSpace bg-purple">
        <div class="container">
            <div class="find-out">
                <h2  data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('best_candidate_heading', $post->ID); ?></h2>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-primary">GET STARTED</a>
                </div>
            </div>
        </div>
    </section>
-->
</main>

<?php get_footer(); ?>