<!-- <!doctype html> -->
<?php
$id = get_current_user_id();
$name = get_user_meta($id, 'first_name', true) . ' ' . get_user_meta($id, 'last_name', true);
?>
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
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-employer/css/custom.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dashboard-employer/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
    <input type="hidden" id="theme_url" value="<?php echo get_template_directory_uri(); ?>">
    <input type="hidden" id="admin-ajax" value="<?php echo admin_url('admin-ajax.php'); ?>">

</head>

<body class="bg-white-grey employer-dashboard">
    <section class="dashboard-section">
        <div class="ipad-screen d-lg-none">
            <div class="container">
                <div class="ipad-logo">
                    <a href="javascript:void(0);" class="icon-bar"><i class="fa fa-bars"></i></a>
                    <a href="#" class="ipad-img">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/employer-logo.png">
                    </a>
                </div>
            </div>
        </div>
        <div class="sidebar-wrapper">
            <div class="sidebar-wrap">
                <div class="sidebar-brand-wrap d-none d-lg-block">
                    <a href="#" class="sidebar-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/employer-logo.png">
                    </a>
                </div>
                <div class="sidebar-profile-details">
                    <figure>
                        <?php
                        if (!empty(get_field('company_logo', 'user_' . $id))) { ?>
                            <img src="<?php echo get_field('company_logo', 'user_' . $id); ?>" alt="profile-img">
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/dummy.jpg" alt="profile-img">
                        <?php }
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
                        <p><small><?php echo get_field('job_title', 'user_' . $id); ?></small></p>
                        <a href="<?php echo get_the_permalink(100) ?>">
                            <p><small><?php echo get_field('business_name', 'user_' . $id); ?></small></p>
                        </a>
                    </div>
                </div>
                <ul>
                    <li class="active">
                        <a href="<?php echo get_the_permalink(26); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/dashboard-employer/images/db-1.png" alt="">
                            </figure>
                            <span> Dashboard</span>
                        </a>
                        <a href="#" class="drop-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        <ul class="submenu">
                            <li><a href="<?php echo get_the_permalink(30); ?>">Candidate Shortlists</a></li>
                            <!--                            <li><a href="<?php //echo get_the_permalink(36); 
                                                                            ?>">View Candidate</a></li>-->
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(38); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/dashboard-employer/images/jobserch-1.png" alt="">
                            </figure>
                            <span> Your Jobs</span>
                        </a>
                        <a href="#" class="drop-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        <ul class="submenu">
                            <li><a href="<?php echo get_the_permalink(48); ?>">Your Jobs</a></li>
                            <li><a href="<?php echo get_the_permalink(44); ?>">Make an Offer</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(50); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/dashboard-employer/images/invite-1.png" alt="images">
                            </figure>
                            <span> ATS</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(28); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/dashboard-employer/images/flag-1.png" alt="images">
                            </figure>
                            <span> Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(32); ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/dashboard-employer/images/mg-1.png" alt="images">
                            </figure>
                            <span> Messenger</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo get_the_permalink(40) ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/dashboard-employer/images/st-1.png" alt="images">
                            </figure>
                            <span>Settings</span>
                        </a>
                    </li>
                    <!--
                    <li>
                        <a href="<?php //echo get_the_permalink(40) 
                                    ?>">
                            <figure>
                                <img src="<?php echo get_template_directory_uri(); ?>/dashboard-employer/images/join-1.png" alt="images">
                            </figure>
                            <span>Invite colleagues</span>
                        </a>
                    </li>
-->
                    <?php
                    if (is_user_logged_in()) { ?>
                        <li>
                            <a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>