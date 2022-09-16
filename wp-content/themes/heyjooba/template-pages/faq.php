<?php
/*
Template Name: Faq
*/
get_header();
global $post;
?>
<div class="style3">
    <?php include(TEMPLATEPATH . '/header-content.php'); ?>
</div>
<main class="content">
    <section class="intro bg-primary">
        <div class="container">
            <div class="common-heading">
                <h2 class="text-white"><?php echo get_field('faq_heading',$post->ID); ?></h2>
            </div>
            <div class="faq">
                <div class="accordion jobba-faq" id="accordionPanelsStayOpenExample">
                    <?php
                    $faqs = get_field('faqs',$post->ID);
                    $i = 1;
                    foreach($faqs as $faq){ ?>
                        <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-heading<?php echo $i; ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapse<?php echo $i; ?>">
                                <?php echo $faq['faq_question']; ?>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapse<?php echo $i; ?>" class="accordion-collapse collapse <?php if($i == 1){ echo 'show'; }?>" aria-labelledby="panelsStayOpen-heading<?php echo $i; ?>">
                            <div class="accordion-body">
                                <?php echo $faq['faq_answer']; ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                    $i++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-secondary uSpace">
        <div class="container">
            <div class="common-heading">
                <h2><?php echo get_field('faq_recruiter_heading',$post->ID); ?></h2>
            </div>
            <div class="faq rec">
                <div class="accordion jobba-faq" id="accordionPanelsStayOpenExample">
                    <?php
                    $faqs_rec = get_field('recruiter_faqs',$post->ID);
                    $j = 1;
                    foreach($faqs_rec as $faq_rec){ ?>
                        <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-heading<?php echo $j; ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $j; ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapse<?php echo $j; ?>">
                                <?php echo $faq_rec['recruiter_faq_question']; ?>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapse<?php echo $j; ?>" class="accordion-collapse collapse <?php if($j == 1){ echo 'show'; }?>" aria-labelledby="panelsStayOpen-heading<?php echo $j; ?>">
                            <div class="accordion-body">
                                <?php echo $faq_rec['recruiter_faq_answer']; ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                    $j++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>