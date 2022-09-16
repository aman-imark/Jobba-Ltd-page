<?php 

/* Plugin name: Custom Plugin 
Description: A simple plugin to add extra info to posts. 
Author: imark
*/
if( !function_exists("custom") ) { 
    function custom($content) {
        $extra_info = "EXTRA INFO";   
        return $content . $extra_info; 
    }
    add_filter('the_content', 'custom');
}

add_action( 'admin_menu', 'menu_custom' );  
function menu_custom(){    
    $page_title = 'Custom';   
    $menu_title = 'Custom';   
    $capability = 'administrator';   
    $menu_slug  = 'custom';   
    $function   = 'dispaly_custom';   
    $icon_url   = '';   
    $position   = 4;    
    add_menu_page( $page_title,$menu_title,$capability,$menu_slug,$function,$icon_url,$position); 
} 

if( !function_exists("dispaly_custom") ) { 
    function dispaly_custom(){ ?>
        <h1>WordPress Extra Post Info</h1>
        <form method="post" action="options.php">
<?php settings_fields( 'custom-settings' ); ?>
<?php do_settings_sections( 'custom-settings' ); ?>
            
    <table class="form-table"><tr valign="top"><th scope="row">Name:</th>
    <td>
        <input type="text" name="custom_data" value="<?php echo get_option( 'custom_data' ); ?>"/>
    </td></tr>
    </table>
            <?php submit_button(); ?>
</form>

    <?php }
        }

add_action( 'admin_init', 'update_custom' );

if( !function_exists("update_custom") ) { 
function update_custom() {   
    register_setting('custom-settings', 'custom_data'); 
} 
}



