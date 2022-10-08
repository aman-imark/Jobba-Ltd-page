<?php
$id = get_current_user_id();
$profile_image = get_field('profile_image', 'user_' . $id);
$name = get_user_meta($id, 'first_name', true);
?>

<!-- <!doctype html> -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>! Heyjobba !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" sizes="32x32" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-recuirter/css/main.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-recuirter/css/custom.css">
    
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <input type="hidden" id="admin-ajax" value="<?php echo admin_url('admin-ajax.php'); ?>">
    <input type="hidden" id="theme_url" value="<?php echo get_template_directory_uri(); ?>">
</head>

<body class="bg-white-grey">
    <section class="dashboard-section">
        <div class="ipad-screen d-lg-none">
            <div class="container">
                <div class="ipad-logo">
                    <a href="javascript:void(0);" class="icon-bar"><i class="fa fa-bars"></i></a>
                    <a href="#" class="ipad-img">
                        <img src="<?php echo get_template_directory_uri();?>/images/recut-logo.png">
<!--                        Jobba-->
                    </a>
                </div>
            </div>
        </div>
        <div class="sidebar-wrapper">
            <div class="sidebar-wrap">
                <div class="sidebar-brand-wrap d-none d-lg-block">
                    <a href="#" class="sidebar-logo">
                        <img src="<?php echo get_template_directory_uri();?>/images/recut-logo.png">
<!--                        Jobba-->
                    </a>
                </div>
                <div class="sidebar-profile-details">
                    <figure>
                        <?php
                        if (empty($profile_image)) { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/dummy.jpg" alt="profile-img">
                        <?php } else { ?>
                            <img src="<?php echo $profile_image; ?>">
                        <?php
                        }
                        ?>
                    </figure>
                    <div class="sidebar-profile-content">
                        <div class="profile-name-wrap">
                            <h6 href="#" class="sidebar-profile-name">
                                <?php echo $name; ?>
                                <button type="button" class="profile-name-arrow"></button>
                                <ul>
                                    <li><a href="#">Option 1</a></li>
                                    <li><a href="#">Option 2</a></li>
                                </ul>
                            </h6>
                        </div>
                        <a href="<?php echo get_the_permalink(249); ?>">
                            <p><small>Recruiter</small></p>
                        </a>
                    </div>
                </div>
                <ul>
                    <li class="active">
                        <a href="<?php echo get_the_permalink(52); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/db-1.png" alt="">
                            </figure>
                            <span> Dashboard</span>
                        </a>
                        <a href="#" class="drop-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        <ul class="submenu">
                            <li><a href="#">Link 1</a></li>
                            <li><a href="#">Link 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(68); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/jobserch-1.png" alt="">
                            </figure>
                            <span> Job Search</span>
                        </a>
                        <a href="#" class="drop-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        <ul class="submenu">
<!--                            <li><a href="<?php //echo get_the_permalink(62); ?>">Job Offer</a></li>-->
                            <li><a href="<?php echo get_the_permalink(242); ?>">New Job Matches</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(98); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/candidate.png" alt="images">
                            </figure>
                            <span> Your Candidates</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(66); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/invite-1.png" alt="images">
                            </figure>
                            <span> ATS</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(60); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/flag-1.png" alt="images">
                            </figure>
                            <span> Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(64); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/mg-1.png" alt="images">
                            </figure>
                            <span> Messenger</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(84); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/st-1.png" alt="images">
                            </figure>
                            <span>Settings</span>
                        </a>
                    </li>
<!--
                    <li>
                        <a href="javascript:void(0);">
                            <figure>
                                <img src="<?php //echo get_template_directory_uri(); ?>/images/join-1.png" alt="images">
                            </figure>
                            <span>Invite Friends</span>
                        </a>
                    </li>
-->
                    <?php if (is_user_logged_in()) { ?>
                        <li>
                            <a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>