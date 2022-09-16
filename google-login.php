<?php
include('wp-config.php');
require_once 'vendor/autoload.php';
  
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

$role = $_GET['state'];

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
   
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
   
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
    
  $first_name = $google_account_info['givenName'];
  $last_name = $google_account_info['familyName'];
  $site_url = site_url();
    if(!email_exists($email)){
      $username = substr($email,0,strpos($email,'@'));
      $password = '12345678';
      $user_id = wp_create_user($username, $password,$email);

      $u = new WP_User($user_id);

            // Remove role
      $u->remove_role( 'subscriber' );

            // Add role
      $u->add_role($role);

      update_user_meta($user_id,'first_name',$first_name);
      update_user_meta($user_id,'last_name',$last_name);
      update_user_meta($user_id,'account_activated',1);

       wp_set_auth_cookie( $user_id, is_ssl() );

       if(isset($cookies)){
          wp_set_auth_cookie( $user_id, true );  
       }
       if($role == 'employee'){
            $login_value = get_user_meta($user->ID,'login_value',true);
                if($login_value == ''){
                  header("Location: ".get_the_permalink(100)); 
                  update_user_meta($user->ID,'login_value',1);
                }else{
                  header("Location: ".get_the_permalink(26)); 
                }
       }else if($role == 'recruiter'){
           $login_value = get_user_meta($user->ID,'login_value',true);
                if($login_value == ''){
                  header("Location: ".get_the_permalink(249)); 
                  update_user_meta($user->ID,'login_value',1);
                }else{
                  header("Location: ".get_the_permalink(52));  
                }
         
        }
      $html = ' <head>
       <title>Registration</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$site_url.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hi, '.$first_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    You have successfully registered for the role of '.$role.' at heyjobba.
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Thanks for signing up!
                                    </p>
                               </td>
                           </tr>

                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <info@heyjooba.customerdevsites.com/>' . "\r\n";
            mail($email,'Registration',$html,$headers);

    }else if(email_exists($email)){

       $user = get_user_by( 'email', $email );
       $roles= $user->roles;
       $role= $roles[0];
       $password = '12345678';

       $result = wp_check_password($password, $user->user_pass, $user->ID);
       $user_meta=get_userdata($user->ID);

       if ( $user && $result ){
        $name = get_user_meta($user->ID,'first_name',true);
        wp_set_auth_cookie( $user->ID, is_ssl() );

            if(isset($cookies)){
                wp_set_auth_cookie( $user->ID, true );  
            }

            $userdata = get_userdata($user->ID);
            $user_roles = $userdata->roles[0];

            if($user_roles == 'employee'){
                header("Location: ".get_the_permalink(26));

            }else if($user_roles == 'recruiter'){
                header("Location: ".get_the_permalink(52));;
            }

        }
    }

  // now you can use this profile info to create account in your website and make user logged in.
} else {
   
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}
?> 