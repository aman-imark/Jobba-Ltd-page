<?php 
/*
Template Name:Forgot password
*/
include(TEMPLATEPATH.'/header-login.php'); 

?>
  <div class="login" style="background-image: url('<?php echo get_template_directory_uri();?>/dashboard-employer/images/login-banner.jpg');">
    <div class="container">
      <div class="log-ctnt employer-account">
        <figure>
          <img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/login-logo.png" alt="Login-logo">
        </figure>
        <div class="login-bg">
            <h4>Forgot Password</h4>
            <form id="forgot_password">
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Robert" name="email">
             </div>
              <div class="login-ctnt">
                <input type="submit" class="btn" value="Submit">
                <input type="hidden" name="action" value="forgot_password">
              </div>
                
            </form>

        </div>
      </div>
    </div>
  </div>
<?php include(TEMPLATEPATH.'/footer-login.php');  ?>