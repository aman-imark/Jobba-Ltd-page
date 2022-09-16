<?php
/*
Template Name: Employer
*/
get_header();
global $post;
?>
<style>
    .freelancer-pop {
        display: none;
    }
</style>

<div class="style3">
    <?php include(TEMPLATEPATH . '/header-content.php'); ?>
</div>

<main class="content">
    <section class="intro bg-primary">
        <div class="container">
            <div class="intro-head">
                <h1><?php echo get_field('banner_platform_heading', $post->ID); ?></h1>
                <h2><?php echo get_field('banner_platform_subheading', $post->ID); ?></h2>
            </div>
            <div class="dashboard-img big-img-1">
                <figure>
                    <img src="<?php echo get_field('banner_platform_image', $post->ID); ?>" alt="images">
                </figure>
            </div>
        </div>
    </section>

    <section class="register uSpace bg-purple">
        <div class="container">
            <div class="register-inner" data-aos="fade-down" data-aos-duration="3000">
                <h2><?php echo get_field('free_heading', $post->ID); ?></h2>
                <h2><span><?php echo get_field('free_subheading', $post->ID); ?></span></h2>
                <h2><?php echo get_field('pay_hedaing', $post->ID); ?></h2>
            </div>
            <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                <a href="<?php echo get_the_permalink(502); ?>" class="btn btn-primary">GET REGISTERED</a>
            </div>
        </div>
    </section>

    <!-- <section class="offer uSpace bg-purple">
        <div class="container-fluid">
            <div class="row">
                <?php
                $employer_tes = get_field('employers_testimonials', $post->ID);
                $a = 1;
                foreach ($employer_tes as $emp_tes) {
                    if ($a == 1) {
                        $animate = "fade-right";
                    } else if ($a == 2) {
                        $animate = "fade-down";
                        $sec_animate = 'data-aos="fade-up" data-aos-duration="3000"';
                    } else if ($a == 3) {
                        $animate = "fade-left";
                        $sec_animate = '';
                    }
                ?>
                    <div class="col-xl-4 col-12">
                        <div class="city-intro" data-aos="<?php echo $animate; ?>" data-aos-duration="3000">
                            <p><?php echo $emp_tes['employer_testimonial_content']; ?></p>
                            <p <?php echo $sec_animate; ?>><?php echo $emp_tes['employer_testimonial_heading']; ?></p>
                        </div>
                    </div>
                <?php
                    $a++;
                }
                ?>
            </div>
        </div>
    </section> -->

    <section class="offer uSpace bg-purple">
        <div class="container">
            <div class="common-heading aos-init aos-animate" data-aos="fade-down" data-aos-duration="2000">
                <h2 class="text-white"><?php echo get_field('supporters_heading',$post->ID); ?></h2>
            </div>
            <div class="support row row-cols-lg-4 row-cols-md-3 row-cols-2">
                <?php
                $supporters = get_field('supporters',$post->ID);
                foreach($supporters as $supporter){ ?>
                <div class="col">
                    <figure>
                        <img src="<?php echo $supporter['supporter_logos']; ?>">
                    </figure>
                </div>
                <?php }
                ?>
            </div>
        </div>
    </section>

    <section class="free-join uSpace bg-secondary">
        <div class="container-fluid">
            <div class="common-heading" data-aos="fade-down" data-aos-duration="3000">
                <h2 class="text-dark"><?php echo get_field('why_jobba_heading', $post->ID); ?></h2>
            </div>
            <ul class="whyjobba row">
                <?php
                $reasons = get_field('reasons', $post->ID);
                $i = 1;
                foreach ($reasons as $reason) {
                    $count = count($reasons);
                    if ($i == 1) {
                        $anim = 'data-aos="fade-right" data-aos-duration="2000"';
                    } else if ($i == $count) {
                        $anim = 'data-aos="fade-left" data-aos-duration="2000"';
                    } else {
                        $anim = '';
                    }
                ?>
                    <li <?php echo $anim; ?>>
                        <div class="txt">
                            <div class="txt-inner">
                                <h6><?php echo $reason['reason_heading']; ?></h6>
                                <p><?php echo $reason['reason_content']; ?></p>
                            </div>
                        </div>
                    </li>
                <?php
                    $i++;
                }
                ?>
            </ul>
            <!-- <div class="postit">
                <a href="javascript:void(0)" class="btn btn-primary">POST A JOB FOR FREE TODAY!</a>
            </div> -->
        </div>
    </section>

    <section class="it-works uSpace bg-secondary">
        <div class="container">
            <div class="common-heading" data-aos="fade-down" data-aos-duration="3000">
                <h2 class="text-dark"><?php echo get_field('employer_how_it_works_heading', $post->ID); ?></h2>
            </div>
            <ul class="work row" data-aos="fade-up" data-aos-duration="3000">
                <?php
                $works = get_field('employer_how_it_works_points', $post->ID);
                $b = 1;
                foreach ($works as $work) { ?>
                    <li>
                        <div class="working">
                            <div class="working-inner">
                                <p><span><?php echo $b; ?>. </span><?php echo $work['employer_works_points']; ?></p>
                            </div>
                        </div>
                    </li>
                <?php
                    $b++;
                }
                ?>
            </ul>
            <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                <a href="javascript:void(0)" class="btn btn-primary">POST A JOB FOR FREE</a>
            </div>
        </div>
    </section>

    <section class="recruitment uSpace bg-purple">
        <div class="container">
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('employer_change_heading', $post->ID); ?></h2>
                <div class="readit row" style="display: none;">
                    <?php echo get_field('employer_change_content', $post->ID); ?>
                </div>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-primary clickable">FIND OUT MORE</a>
                </div>
            </div>
        </div>
    </section>

    <section class="recruitment right uSpace bg-primary">
        <div class="container">
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('employer_control_heading', $post->ID); ?></h2>
                <div class="readit" style="display: none;">
                    <?php echo get_field('employer_control_content', $post->ID); ?>
                </div>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-secondary clickable">FIND OUT MORE</a>
                </div>
            </div>
        </div>
    </section>

    <section class="recruitment uSpace bg-secondary">
        <div class="container">
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('employer_ultimate_heading', $post->ID); ?></h2>
                <div class="readit" style="display: none;">
                    <?php echo get_field('employer_heading_content', $post->ID); ?>
                </div>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="javascript:void(0)" class="btn btn-purple clickable">FIND OUT MORE</a>
                </div>
            </div>
        </div>
    </section>

    <section class="key uSpace">
        <div class="container">
            <div class="common-heading">
                <h2><?php echo get_field('employer_key_heading', $post->ID); ?></h2>
            </div>
            <div class="key-option">
                <div class="row row-cols-lg-5 row-cols-md-2 row-cols-1">
                    <?php
                    $keys = get_field('employer_keys', $post->ID);
                    foreach ($keys as $key) { ?>
                        <div class="col">
                            <div class="keyone">
                                <figure>
                                    <img src="<?php echo $key['emp_heading_image']; ?>" alt="">
                                </figure>
                                <h6><?php echo $key['emp_key_heading']; ?></h6>
                                <p><?php echo $key['emp_content_keys']; ?></p>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>

            <div class="swiper key-option d-none">

                <div class="swiper-wrapper">
                    <?php
                    $emp_keys = get_field('employer_keys', $post->ID);
                    foreach ($emp_keys as $emp_key) { ?>
                        <div class="swiper-slide">
                            <div class="keyone">
                                <!-- <h3>UP TO DATE</h3> -->
                                <p><?php echo $emp_key['emp_key_heading']; ?></p>
                                <figure>
                                    <img src="<?php echo $emp_key['emp_heading_image']; ?>" alt="">
                                </figure>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>

        </div>
    </section>

    <section class="payment uSpace bg-secondary">
        <div class="container">
            <div class="common-heading">
                <h2><?php echo get_field('employer_payment_heading', $post->ID); ?></h2>
                <p><?php echo get_field('employer_payment_content', $post->ID); ?></p>
            </div>
            <div class="p-bar">
                <ul>
                    <li>5%</li>
                    <li>10%</li>
                    <li>15%</li>
                    <li>20%</li>
                    <li>25%</li>
                    <li>30%</li>
                    <li>35%</li>
                    <li>40%</li>
                    <li>45%</li>
                    <li>50%</li>
                </ul>
                <div class="ongoing-bar">
                    <div class="progress">
                        <input type="range" class="form-range" id="customRange1" min="0" max="30" type="range" value="<?php echo get_field('employer_payment_value', $post->ID); ?>" step="0.25">
                    </div>
                    <!-- <figure>
                        <img src="images/p-arrow.png" alt="">
                    </figure> -->
                </div>
            </div>
        </div>
    </section>

    <section class="recruitment uSpace bg-purple">
        <div class="container">
            <div class="find-out">
                <h2 data-aos="fade-down" data-aos-duration="3000"><?php echo get_field('employer_best_heading', $post->ID); ?></h2>
                <div class="postit" data-aos="fade-up" data-aos-duration="3000">
                    <a href="<?php echo get_the_permalink(502); ?>" class="btn btn-primary">GET SIGNED UP</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>