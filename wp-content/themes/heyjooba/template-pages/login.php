<?php 
/*
Template Name:Login
*/
include(TEMPLATEPATH.'/header-login.php'); 

require_once 'vendor/autoload.php';
  
$role = $_GET['r'];
// init configuration
$clientID = '186327179073-67qn25hd3rhfjifuci8cvnuat9aivrp6.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = site_url().'/google-login.php';
   
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
$client->setState($role);

?>
  <div class="login" style="background-image: url('<?php echo get_template_directory_uri();?>/dashboard employer/images/login-banner.jpg');">
    <div class="container">
      <div class="log-ctnt">
<!--        <figure>-->
<!--          <img src="<?php //echo get_template_directory_uri();?>/dashboard-employer/images/login-logo.png" alt="Login-logo">-->
<!--       </figure>-->
        <div class="login-bg">
            <h4>Create your account</h4>
            <?php
            if(empty($_GET)){ ?>
            <a href="javascript:void(0);" class="google-btn" onclick="check_role();" data-url="<?php echo site_url(); ?>" id="redirection">
              <svg viewBox="0 0 48 48"><path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
              Sign in with Google
            </a>
            <?php }else{
            ?>
            <a href="<?php echo $client->createAuthUrl(); ?>" class="google-btn">
              <svg viewBox="0 0 48 48"><path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
              Sign in with Google
            </a>
            <?php
            }
            ?>
            <div class="or">
              <span><small>or Sign in with Email</small></span>
            </div>
            <form id="login" method="post">
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="mail@website.com" name="email" required>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Min. 8 Character" name="password" min-length="8" required>
              </div>
              <div class="form-group for-pass">
                <a href="<?php echo get_the_permalink(76); ?>" class="forgot">Forgot password?</a>
              </div>
              <div class="login-ctnt">
                <input type="submit" class="btn" value="Login">
                  <input type="hidden" name="action" value="user_login">
              </div>
              <div class="registered">
                <p>Not registered yet? <a href="#">Create an Account</a></p>
              </div>
            </form>

        </div>
      </div>
    </div>
  </div>
  <?php include(TEMPLATEPATH.'/footer-login.php');  ?>