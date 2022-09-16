<?php
/*
Template Name: Freelancer
*/
get_header();
global $post;
?>
<style>
    body{
        background-color: #1DD3B0;
    }
    .freelancer-pop a {
        display: none;
    }
</style>

<header class="freelancer-header">
    <div class="container">
        <a class="navbar-brand" href="<?php echo site_url(); ?>">
            <img src="<?php echo get_field('freelancer_logo',$post->ID); ?>" alt="">
            <svg width="228" height="228">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#bg-logo"></use>
            </svg>
        </a>
    </div>
</header>
<section class="freelancer uSpace">
    <div class="container">
        <div class="common-heading">
            <h2 class="text-dark"><?php echo get_field('freelancer_heading',$post->ID); ?></h2>
        </div>
        <div class="free-text">
            <?php
            $points = get_field('freelancer_points',$post->ID);
            foreach($points as $point){ ?>
            <div class="how">
                <h3><?php echo $point['freelancer_point_heading']; ?></h3>
                <?php echo $point['freelancer_point_content']; ?>
            </div> 
            <?php }
            ?>
       </div>
    </div>
</section>

<?php get_footer(); ?>