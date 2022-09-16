<?php 
/*
Template Name:Signup
*/
include(TEMPLATEPATH.'/header-login.php'); 

?>
  <div class="login">  <!-- style="background-image: url('<?php echo get_template_directory_uri();?>/dashboard-employer/images/login-banner.jpg');" -->
    <div class="container">
      <div class="log-ctnt employer-account">
        <figure>
          <img src="<?php echo get_template_directory_uri();?>/dashboard-employer/images/employer-logo.png" alt="Login-logo">
        </figure>
        <div class="login-bg">
            <h4>Create Employer Account</h4>
            <form id="signup">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Robert" name="first_name">
              </div>
              <div class="form-group">
                <label>Surname</label>
                <input type="text" class="form-control" placeholder="Pattinson" name="surname">
              </div>
              <div class="form-group">
                <label>Job Title</label>
                <input type="text" class="form-control" placeholder="UX Designer" name="job_title">
              </div>
              <div class="form-group">
                <label>Work Email Address</label>
                <input type="text" class="form-control" placeholder="robert@info.com" name="email">
              </div>
              <div class="form-group">
                <label>Business Name</label>
                <input type="text" class="form-control" placeholder="Lorem ipsum" name="business_name">
              </div>
              <div class="form-group">
                <label>Office Location</label>
                <input type="text" class="form-control" placeholder="Lorem ipsum" name="office_location">
              </div>
                <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Robert" name="password" id="password">
              </div>
                <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" placeholder="Robert" name="c_password">
              </div>
              <div class="login-ctnt">
                <input type="submit" class="btn" value="Sign Up">
                  <input type="hidden" name="role" value="employee">
                  <input type="hidden" name="action" value="signup">
              </div>
            </form>

        </div>
      </div>
    </div>
  </div>
<?php include(TEMPLATEPATH.'/footer-login.php');  ?>