<?php
/*
Template Name: Recuriter
*/
get_header();
global $post;
?>
<div class="style2">
    <?php include(TEMPLATEPATH . '/header-content.php'); ?>
</div>

<main class="content">
    <section class="intro bg-secondary">
        <div class="container">
            <div class="freelancer-pop">
                <a href="<?php echo esc_url(home_url('/freelancer')); ?>">HOW DO I WORK FREELANCE?</a>
            </div>
            <div class="intro-head">
                <h1><?php echo get_field('recruiter_banner_heading', $post->ID); ?></h1>
                <h2><?php echo get_field('recruiter_banner_subheading', $post->ID); ?></h2>
            </div>
            <div class="dashboard-img big-img-1">
                <figure>
                    <img src="<?php echo get_field('recruiter_banner_image', $post->ID); ?>" alt="images">
                </figure>
            </div>
        </div>
    </section>

    <section class="sign uSpace bg-secondary">
        <div class="container">
            <div class="freelancer-pop">
                <a href="<?php echo esc_url(home_url('/freelancer')); ?>">HOW DO I WORK FREELANCE?</a>
            </div>
            <div class="sign-inner" data-aos="fade-down" data-aos-duration="3000">
                <h2><?php echo get_field('recruiter_free_heading', $post->ID); ?></h2>
                <h2><span><?php echo get_field('post_job_heading', $post->ID); ?></span></h2>
                <h2 class="d-none"><?php echo get_field('recruiter_pay_heading', $post->ID); ?></h2>
            </div>
            <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                <a href="<?php echo get_the_permalink(502); ?>" class="btn btn-primary">GET REGISTERED</a>
            </div>
        </div>
    </section>

    <section class="offer uSpace bg-purple">
        <div class="container">
            <div class="freelancer-pop">
                <a href="<?php echo esc_url(home_url('/freelancer')); ?>">HOW DO I WORK FREELANCE?</a>
            </div>
            <div class="common-heading aos-init aos-animate" data-aos="fade-down" data-aos-duration="2000">
                <h2 class="text-white"><?php echo get_field('recruiter_supporters_heading', $post->ID); ?></h2>
            </div>
            <div class="support row row-cols-lg-4 row-cols-md-3 row-cols-2">
                <?php
                $rec_supporters = get_field('recruiter_supporter_logos', $post->ID);
                foreach ($rec_supporters as $rec_supporter) { ?>
                    <div class="col">
                        <figure>
                            <img src="<?php echo $rec_supporter['recruiter_supporter_logo']; ?>">
                        </figure>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </section>

    <!-- <section class="owner uSpace">
        <div class="container">
            <div class="owner-inner">
                <figure data-aos="fade-right" data-aos-duration="3000">
                    <img src="<?php echo get_field('recruiter_profile_homepage', $post->ID); ?>" alt="images">
                </figure>
                <div class="about" data-aos="fade-left" data-aos-duration="3000">
                    <p><?php echo get_field('recruiter_profile_content', $post->ID); ?></p>
                    <p><span><?php echo get_field('recruiter_profile_author', $post->ID); ?></span></p>
                </div>
            </div>
        </div>
    </section> -->

    <section class="free-join uSpace bg-purple">
        <div class="container-fluid">
            <div class="freelancer-pop">
                <a href="<?php echo esc_url(home_url('/freelancer')); ?>">HOW DO I WORK FREELANCE?</a>
            </div>
            <div class="common-heading" data-aos="fade-down" data-aos-duration="3000">
                <h2 class="text-white"><?php echo get_field('recruiter_why_jobba', $post->ID); ?></h2>
            </div>
            <ul class="whyjobba row">
                <?php
                $reasons = get_field('recruiter_reasons', $post->ID);
                $b = 1;
                foreach ($reasons as $reason) {
                    $count = count($reasons);
                    if ($b == 1) {
                        $anim = 'data-aos="fade-right" data-aos-duration="2000"';
                    } else if ($b == $count) {
                        $anim = 'data-aos="fade-left" data-aos-duration="2000"';
                    } else {
                        $anim = '';
                    }
                ?>
                    <li <?php echo $anim; ?>>
                        <div class="txt">
                            <div class="txt-inner">
                                <h6><?php echo $reason['recruiter_reason_heading']; ?></h6>
                                <p><?php echo $reason['recruiter_reason_content']; ?></p>
                            </div>
                        </div>
                    </li>
                <?php
                    $b++;
                }
                ?>
            </ul>
            <!-- <div class="postit">
                <a href="javascript:void(0)" class="btn btn-primary">POST A JOB FOR FREE TODAY!</a>
            </div> -->
        </div>
    </section>

    <section class="it-works uSpace bg-purple">
        <div class="container">
            <div class="freelancer-pop">
                <a href="<?php echo esc_url(home_url('/freelancer')); ?>">HOW DO I WORK FREELANCE?</a>
            </div>
            <div class="common-heading" data-aos="fade-down" data-aos-duration="2000">
                <h2 class="text-white"><?php echo get_field('recruiter_works_hedaing', $post->ID); ?></h2>
            </div>
            <ul class="work row" data-aos="fade-up" data-aos-duration="2000">
                <?php
                $works = get_field('recruiter_works', $post->ID);
                $f = 1;
                foreach ($works as $work) { ?>
                    <li>
                        <div class="working">
                            <div class="working-inner">
                                <p><?php echo $f; ?>. <?php echo $work['recruiter_works_points']; ?></p>
                            </div>
                        </div>
                    </li>
                <?php
                    $f++;
                }
                ?>
            </ul>
            <!-- <div class="postit">
                    <a href="javascript:void(0)" class="btn btn-primary">POST A JOB FOR FREE</a>
                </div> -->
        </div>
    </section>

    <section class="recruitment uSpace bg-purple">
        <div class="container">
            <div class="freelancer-pop">
                <a href="<?php echo esc_url(home_url('/freelancer')); ?>">HOW DO I WORK FREELANCE?</a>
            </div>
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('recruiter_chnage_heading', $post->ID); ?></h2>
                <div class="readit" style="display: none;">
                    <?php echo get_field('recruiter_change_content', $post->ID); ?>
                </div>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-primary clickable">FIND OUT MORE</a>
                </div>
            </div>
        </div>
    </section>

    <section class="recruitment right uSpace bg-primary">
        <div class="container">
            <div class="freelancer-pop">
                <a href="<?php echo esc_url(home_url('/freelancer')); ?>">HOW DO I WORK FREELANCE?</a>
            </div>
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('recruiter_control_heading', $post->ID); ?></h2>
                <div class="readit" style="display: none;">
                    <?php echo get_field('recruiter_control_content', $post->ID); ?>
                </div>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-secondary clickable">FIND OUT MORE</a>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="recruitment uSpace bg-secondary">
        <div class="container">
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"> <?php echo get_field('recruitment_search_heading', $post->ID); ?></h2>
                <div class="readit" style="display: none;">
                     <?php echo get_field('recruitment_search_content', $post->ID); ?>
                </div>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-purple clickable">FIND OUT MORE</a>
                </div>
            </div>
        </div>
    </section> -->

    <section class="key uSpace">
        <div class="container">
            <div class="freelancer-pop">
                <a href="<?php echo esc_url(home_url('/freelancer')); ?>">HOW DO I WORK FREELANCE?</a>
            </div>
            <div class="common-heading">
                <h2><?php echo get_field('recruiter_key_features_heading', $post->ID); ?></h2>
            </div>

            <div class="key-option">
                <div class="row row-cols-lg-5 row-cols-md-2 row-cols-1">
                    <?php
                    $key_features = get_field('recruiter_key_features', $post->ID);
                    foreach ($key_features as $key_feature) { ?>
                        <div class="col">
                            <div class="keyone">
                                <figure>
                                    <img src="<?php echo $key_feature['recruiter_key_image']; ?>" alt="">
                                </figure>
                                <h6><?php echo $key_feature['recruiter_key_heading']; ?></h6>
                                <p><?php echo $key_feature['recruiter_key_content']; ?></p>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>

            <div class="swiper key-option d-none">

                <div class="swiper-wrapper">
                    <?php
                    $keys = get_field('recruiter_key_features', $post->ID);
                    foreach ($keys as $key) {
                    ?>
                        <div class="swiper-slide">
                            <div class="keyone">
                                <!-- <h3>UP TO DATE</h3> -->
                                <p><?php echo $key['recruiter_key_content']; ?></p>
                                <figure>
                                    <img src="<?php echo $key['recruiter_key_image']; ?>" alt="">
                                </figure>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>

        </div>
    </section>

    <!-- <section class="price uSpace bg-secondary">
        <div class="container">
            <div class="common-heading" data-aos="fade-down" data-aos-duration="3000">
                <h2><?php echo get_field('recruiter_pricing_heading', $post->ID); ?></h2>
            </div>
            <div class="pricing-inner" data-aos="fade-up" data-aos-duration="3000">
              <?php echo get_field('recruiter_pricing_content', $post->ID); ?>
            </div>
        </div>
    </section> -->

    <section class="recruitment uSpace bg-purple">
        <div class="container">
            <div class="freelancer-pop">
                <a href="<?php echo esc_url(home_url('/freelancer')); ?>">HOW DO I WORK FREELANCE?</a>
            </div>
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('recruiter_flexible_heading', $post->ID); ?></h2>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="<?php echo get_the_permalink(502); ?>" class="btn btn-primary">GET REGISTERED</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>