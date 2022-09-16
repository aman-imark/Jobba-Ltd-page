<?php
/*
Template Name:Register-live
*/
include(TEMPLATEPATH . '/header-login.php');
?>


<div class="login" style="background-image: url('<?php echo get_template_directory_uri(); ?>/dashboard employer/images/login-banner.jpg');">
  <div class="container">
    <div class="log-ctnt">
      <div class="login-bg">
        <h3>Be the first to get access</h3>
        <h4>Register Below</h4>
<!--
        <form id="login" method="post">
          <div class="row register">
            <div class="col-md-6 col-12">
              <div class="form-group">
                <input type="text" class="form-control fc-1" placeholder="First name" name="name">
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <input type="text" class="form-control fc-2" placeholder="Last name" name="l_name">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label></label>
                <input type="email" class="form-control fc-3" placeholder="E-mail" name="email">
              </div>
            </div>
          </div>  
          <h4>What are you?</h4>
-->
          <!-- <div class="form-group">
            <label>Employer</label>
            <input type="email" class="form-control" placeholder="info@gmail.com" name="email">
          </div>
          <div class="form-group">
            <label>Recruiter</label>
            <input type="email" class="form-control" placeholder="info@gmail.com" name="email">
          </div> -->
<!--
          <div class="select-one">
              <input type="radio" name="choose_role" value="Employer">
              <input type="radio" name="choose_role" value="recruiter">
-->
<!--
            <a href="javascript:void(0)" class="active">Employer</a>
            <a href="javascript:void(0)">Recruiter</a>
-->
<!--          </div>-->
<!--
          <div class="login-ctnt">
            <button type="submit" class="btn">Signup</button>
          </div>
        </form>
-->
          <?php echo do_shortcode('[contact-form-7 id="504" title="Register-live"]'); ?>
      </div>
    </div>
  </div>
</div>
<?php include(TEMPLATEPATH . '/footer-login.php');  ?>