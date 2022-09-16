<?php

$id = get_current_user_id();
?>
<header id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?php echo site_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="">
                <svg width="228" height="228">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#bg-logo"></use>
                </svg>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-icon">
                    <i class="fas fa-bars"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="menubar">
                    <!--
                    <li class="nav-item">
                        <a class="" aria-current="page" href="#">ABOUT</a>
                    </li>
-->
                    <li class="nav-item">
                        <a class="" href="<?php echo esc_url(home_url('/')); ?>">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="<?php echo get_the_permalink(14); ?>">FOR EMPLOYERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="<?php echo get_the_permalink(18); ?>">FOR RECRUITERS</a>
                    </li>
<!--
                    <li class="nav-item">
                        <a class="" href="#">SOCIAL</a>
                    </li>
-->
                    <li class="nav-item">
                        <a class="" href="https://heyjooba.customerdevsites.com/faq/">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="mailto:<?php echo get_field('heyjobba_mail','options'); ?>">
                            <i class="la la-envelope"></i>
                        </a>
                    </li>
                </ul>
                <div class="sing-btn">
                    <a href="<?php echo get_the_permalink(502); ?>" class="btn">GET REGISTERED</a>
                </div>
            </div>
        </nav>
    </div>
</header>
<input type="hidden" id="admin-ajax" value="<?php echo admin_url('admin-ajax.php'); ?>">