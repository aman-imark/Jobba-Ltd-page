<?php 
/*
Template Name:Confirmation
*/
include(TEMPLATEPATH.'/header-login.php'); 

?>
  <div class="login" style="background-image: url('<?php echo get_template_directory_uri();?>/dashboard-employer/images/login-banner.jpg');">
    <div class="container">
      <div class="log-ctnt">
        <figure>
          <img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/login-logo.png" alt="Login-logo">
        </figure>
        <div class="login-bg">
            <h4>Check your email!</h4>
           <p>Enter the 6-digit confimation code we sent to <strong>robert@info.com</strong>.</p>
            <form>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="xxxxxxxxxxxxxxxxx">
              </div>

              <div class="registered">
                <p>The code we sent will expire in 5 minutes.</p>
              </div>
            </form>

        </div>
      </div>
    </div>
  </div>
<?php include(TEMPLATEPATH.'/footer-login.php');  ?>