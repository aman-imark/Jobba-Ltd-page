<footer class="footer bg-primary">
    <div class="container">
        <div class="logo-footer" data-aos="fade-up" data-aos-duration="1000">
            <a href="<?php echo site_url(); ?>">
                <figure>
                    <img src="<?php echo get_field('footer_logo','options'); ?>" alt="">
                </figure>
            </a>
        </div>
        <div class="logo-option">
            <div class="row">
                <div class="col-md-6 col-12">
                    <ul class="option-1" data-aos="fade-right" data-aos-duration="1500">
                        <!--                        <li><a href="javascript:void(0)">ABOUT JOBBA</a></li>-->
                        <!--                        <li><a href="javascript:void(0)">THE PLATFORM</a></li>-->
                        <li><a href="<?php echo get_the_permalink(18); ?>">FOR RECRUITERS</a></li>
                        <li><a href="<?php echo get_the_permalink(14); ?>">FOR EMPLOYERS</a></li>
                        <!--                        <li><a href="javascript:void(0)">SCHOOLS</a></li>-->
                        <li><a href="javascript:void(0)">SOCIAL</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-12">
                    <div class="option-1" data-aos="fade-left" data-aos-duration="1500">
                        <ul>
                            <li><a href="javascript:void(0)">PRIVACY</a></li>
                        </ul>
                        <ul>
                            <li><a href="javascript:void(0)">ACCESSIBILITY</a></li>
                            <li><a href="javascript:void(0)">SITEMAP</a></li>
                        </ul>
                        <ul>
                            <li><a href="javascript:void(0)">CONTACT US</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-social">
            <a href="javascript:void(0)">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="javascript:void(0)">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="javascript:void(0)">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="javascript:void(0)">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
        <div class="copyright">
            <p>© 2022 JOBBA</p>
        </div>
    </div>
</footer>
 <div class="freelancer-pop">
    <a href="<?php echo get_the_permalink(629); ?>">HOW DO I WORK FREELANCE?</a>
</div> 

<?php include(TEMPLATEPATH . "/svg-symbols.php"); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>

<!-- For Developer use -->
<script src="<?php echo get_template_directory_uri(); ?>/js/developer.js"></script>

</body>

</html>