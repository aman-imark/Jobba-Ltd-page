<?php
/*
 * WPIDE CUSTOM AJAX HANDLER
 * admin-ajax.php is usually slower depending on the number of registered ajax functions
 * This is a custom ajax handler that will mimic the actual admin-ajax
*/

define('DOING_AJAX', true);
if ( ! defined( 'WP_ADMIN' ) ) {
    define( 'WP_ADMIN', true );
}

// Fix to avoid notice in wp-includes/vars.php on line 32
$_SERVER['PHP_SELF'] = '/wp-admin/';

/** Load WordPress Bootstrap */
require_once realpath(__DIR__.'/../../../') . '/wp-load.php';

/** Allow for cross-domain requests (from the front end). */
send_origin_headers();

header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
header( 'X-Robots-Tag: noindex' );

// Require a valid action parameter.
if ( empty( $_REQUEST['action'] ) || ! is_scalar( $_REQUEST['action'] ) ) {
    wp_die( '0', 400 );
}

/** Load WordPress Administration APIs */
require_once ABSPATH . 'wp-admin/includes/admin.php';

send_nosniff_header();
nocache_headers();

/** This action is documented in wp-admin/admin.php */
do_action( 'admin_init' );

$action = sanitize_text_field($_REQUEST['action']);

if ( is_user_logged_in() ) {

    // If no action is registered, return a Bad Request response.
    if ( ! has_action( "wpide_ajax_{$action}" ) ) {
        wp_die( '0', 400 );
    }

    /**
     * Fires authenticated Ajax actions for logged-in users.
     *
     * The dynamic portion of the hook name, `$action`, refers
     * to the name of the Ajax action callback being fired.
     *
     * @since 2.1.0
     */
    do_action( "wpide_ajax_{$action}" );

} else {

    // If no action is registered, return a Bad Request response.
    if ( ! has_action( "wpide_ajax_nopriv_{$action}" ) ) {
        wp_die( '0', 400 );
    }

    /**
     * Fires non-authenticated Ajax actions for logged-out users.
     *
     * The dynamic portion of the hook name, `$action`, refers
     * to the name of the Ajax action callback being fired.
     *
     * @since 2.8.0
     */
    do_action( "wpide_ajax_nopriv_{$action}" );
}

// Default status.
wp_die( '0' );