<?php 
/*
Template Name:Signup Recruiter
*/
include(TEMPLATEPATH.'/header-login.php');
if(!empty($_GET)){
    activate_account($_GET['key']);
}

?>

<style>
  .login-page .login-header {
    display: none;
  }
</style>

  <div class="login" style="background-image: url('<?php echo get_template_directory_uri();?>/images/login-banner.jpg');">
    <div class="container">
      <div class="log-ctnt employer-account">
        <figure>
            <img src="<?php echo get_template_directory_uri();?>/images/recut-logo.png" alt="Login-logo">
        </figure>
        <div class="login-bg">
            <h4>Create Recruiter Account</h4>
            <form id="recruiter_signup">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Robert" name="name">
              </div>
              <div class="form-group">
                <label>Surname</label>
                <input type="text" class="form-control" placeholder="Pattinson" name="surname">
              </div>
              <div class="form-group">
                <label>Employment Status</label>
                <input type="text" class="form-control" placeholder="Employment Status" name="empolyment_status">
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" class="form-control" placeholder="robert@info.com" name="email">
              </div>
              <div class="form-group">
                <label>Linkedin Profile URL</label>
                <input type="text" class="form-control" placeholder="https://in.linkedin.com/peter" name="linkedin_profile">
              </div>
              <div class="form-group">
                <label>Nearest City</label>
                <input type="text" class="form-control" placeholder="New york" name="city">
              </div>
                <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="password" name="password" id="password">
                </div>
                <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" placeholder="password" name="c_password">
              </div>
              <div class="login-ctnt">
                <input type="submit" class="btn" value="Next">
                <input type="hidden" name="role" value="recruiter">
                <input type="hidden" name="action" value="recruiter_signup">
                
              </div>
            </form>

        </div>
      </div>
    </div>
  </div>
<?php include(TEMPLATEPATH.'/footer-login.php');  ?>