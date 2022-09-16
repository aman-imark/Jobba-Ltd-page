<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>heyjobba</title>
    <meta name="title" content="Heyjobba">
    <meta name="description" content="Heyjobba">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/favicon.png" sizes="32x32" type="image/x-icon">
    <link rel="stylesheet" href="https://use.typekit.net/swa7sqq.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/main.css">
</head>
<header id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.svg" alt="">
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
                    <li class="nav-item">
                        <a class="" aria-current="page" href="#">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="#">THE PLATFORM</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="recruiter.php">FOR RECRUITERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="candidates.php">FOR CANDIDATES</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="#">INSIGHTS</a>
                    </li>
                </ul>
                      <div class="sing-btn">
                    <?php
                    if(is_page(14)){
                        ?>
                    <a href="<?php echo get_the_permalink(16); ?>" class="btn">SIGNUP</a>
                    <a href="<?php echo get_the_permalink(12); ?>?r=employee" class="btn">LOGIN</a>
                    <?php
                    }else if(is_page(18)){
                        ?>
                    <a href="<?php echo get_the_permalink(82); ?>" class="btn">SIGNUP</a>
                    <a href="<?php echo get_the_permalink(12); ?>?r=recruiter" class="btn">LOGIN</a>
                    <?php
                    }else if(!is_user_logged_in()){ ?>
                       <a href="<?php echo get_the_permalink(12); ?>" class="btn">LOGIN</a> 
                    <?php }else{ ?>
                        <a href="<?php echo wp_logout_url( home_url()); ?>" class="btn">LOGOUT</a>  
                    <?php }
                    ?>
<!--                    <a href="<?php echo get_the_permalink(16); ?>" class="btn">SIGNUP</a>-->
                    
                </div>
            </div>
        </nav>
    </div>
</header>
    <input type="hidden" id="admin-ajax" value="<?php echo admin_url('admin-ajax.php'); ?>">    
<body>