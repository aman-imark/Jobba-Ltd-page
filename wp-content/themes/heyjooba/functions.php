<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwenty' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new TwentyTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';


/**
 * Register and Enqueue Styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty 1.0
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages() {
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twentytwenty-style', $custom_css );
	}
}

add_action( 'wp_enqueue_scripts', 'twentytwenty_non_latin_languages' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );

/**
 * Get the information about the logo.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 * @return string
 */
function twentytwenty_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'twentytwenty_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 *
	 * @since Twenty Twenty 1.0
	 */
	function wp_body_open() {
		/** This action is documented in wp-includes/general-template.php */
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'twentytwenty' ) . '</a>';
}

add_action( 'wp_body_open', 'twentytwenty_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @since Twenty Twenty 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);

}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_block_editor_styles() {

	// Enqueue the editor styles.
	wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'twentytwenty-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'twentytwenty_classic_editor_styles' );

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @since Twenty Twenty 1.0
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = twentytwenty_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles' );

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => _x( 'Primary', 'color', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => _x( 'Secondary', 'color', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'twentytwenty' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	add_theme_support( 'editor-styles' );

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}

}

add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 * @return string
 */
function twentytwenty_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'twentytwenty_read_more_tag' );

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add main customizer js file.
	wp_enqueue_script( 'twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );

	// Add script for color calculations.
	wp_enqueue_script( 'twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );

	// Add script for controls.
	wp_enqueue_script( 'twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
}

add_action( 'customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts' );

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'twentytwenty-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );

	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( twentytwenty_customize_opacity_range() )
		)
	);
}

add_action( 'customize_preview_init', 'twentytwenty_customize_preview_init' );

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area    The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content'       => array(
			'accent'     => array(
				'color'            => array( '.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a' ),
				'border-color'     => array( 'blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus' ),
				'background-color' => array( 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link' ),
				'fill'             => array( '.fill-children-accent', '.fill-children-accent *' ),
			),
			'background' => array(
				'color'            => array( ':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)' ),
				'background-color' => array( ':root .has-background-background-color' ),
			),
			'text'       => array(
				'color'            => array( 'body', '.entry-title a', ':root .has-primary-color' ),
				'background-color' => array( ':root .has-primary-background-color' ),
			),
			'secondary'  => array(
				'color'            => array( 'cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color' ),
				'background-color' => array( ':root .has-secondary-background-color' ),
			),
			'borders'    => array(
				'border-color'        => array( 'pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr' ),
				'background-color'    => array( 'caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color' ),
				'border-bottom-color' => array( '.wp-block-table.is-style-stripes' ),
				'border-top-color'    => array( '.wp-block-latest-posts.is-grid li' ),
				'color'               => array( ':root .has-subtle-background-color' ),
			),
		),
		'header-footer' => array(
			'accent'     => array(
				'color'            => array( 'body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover' ),
				'background-color' => array( '.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]' ),
			),
			'background' => array(
				'color'            => array( '.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]' ),
				'background-color' => array( '#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before' ),
			),
			'text'       => array(
				'color'               => array( '.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle' ),
				'background-color'    => array( 'body:not(.overlay-header) .primary-menu ul' ),
				'border-bottom-color' => array( 'body:not(.overlay-header) .primary-menu > li > ul:after' ),
				'border-left-color'   => array( 'body:not(.overlay-header) .primary-menu ul ul:after' ),
			),
			'secondary'  => array(
				'color' => array( '.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a' ),
			),
			'borders'    => array(
				'border-color'     => array( '.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top' ),
				'background-color' => array( '.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before' ),
			),
		),
	);

	/**
	 * Filters Twenty Twenty theme elements.
	 *
	 * @since Twenty Twenty 1.0
	 *
	 * @param array Array of elements.
	 */
	return apply_filters( 'twentytwenty_get_elements_array', $elements );
}

function ui_new_role() {  
 
//add the new user role
add_role(
    'employee',
    'Employee',
    array(
        'read'         => true,
        'delete_posts' => false
    )
);
 
}
add_action('admin_init', 'ui_new_role');

function ui_new_role_2() {  
 
//add the new user role
add_role(
    'recruiter',
    'Recruiter',
    array(
        'read'         => true,
        'delete_posts' => false
    )
);
 
}
add_action('admin_init', 'ui_new_role_2');

function my_custom_jobs() {
  $labels = array(
    'name'               => _x( 'Jobs', 'post type general name' ),
    'singular_name'      => _x( 'Jobs', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'Job' ),
    'add_new_item'       => __( 'Add New Job' ),
    'edit_item'          => __( 'Edit Job' ),
    'new_item'           => __( 'New Job' ),
    'all_items'          => __( 'All Job' ),
    'view_item'          => __( 'View Job' ),
    'search_items'       => __( 'Search Job' ),
    'not_found'          => __( 'No Jobs found' ),
    'not_found_in_trash' => __( 'No Jobs found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Jobs'
);

$args = array(
    'labels'        => $labels,
    'description'   => 'Jobs',
    'public'        => true,
    'show_ui'        => true,
    'capability_type'  => 'post',
    'menu_position' => 5,
    'supports'      => array( 'title' , 'thumbnail', 'editor', 'page-attributes'),
    'has_archive'   => true,
);   

register_post_type( 'jobs', $args );   
}
add_action( 'init', 'my_custom_jobs' );


function my_custom_offers() {
  $labels = array(
    'name'               => _x( 'Offers', 'post type general name' ),
    'singular_name'      => _x( 'Offers', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'Offer' ),
    'add_new_item'       => __( 'Add New Offer' ),
    'edit_item'          => __( 'Edit Offer' ),
    'new_item'           => __( 'New Offer' ),
    'all_items'          => __( 'All Offer' ),
    'view_item'          => __( 'View Offer' ),
    'search_items'       => __( 'Search Offer' ),
    'not_found'          => __( 'No Offer found' ),
    'not_found_in_trash' => __( 'No Offer found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Offers'
);

$args = array(
    'labels'        => $labels,
    'description'   => 'Offer',
    'public'        => true,
    'show_ui'        => true,
    'capability_type'  => 'post',
    'menu_position' => 5,
    'supports'      => array( 'title' , 'thumbnail', 'editor', 'page-attributes'),
    'has_archive'   => true,
);   

register_post_type( 'offers', $args );   
}
add_action( 'init', 'my_custom_offers' );

/*************** Login *******************/

add_action('wp_ajax_user_login', 'user_login');
add_action('wp_ajax_nopriv_user_login', 'user_login');

function user_login(){
    
    global $wpdb;
     
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if(email_exists($email)){
        
    $user = get_user_by( 'email', $email );
    $roles= $user->roles;
    $role= $roles[0];

    $is_activated = get_user_meta($user->ID,'account_activated',true);
    if($is_activated){
        $result = wp_check_password($password, $user->user_pass, $user->ID);
        $user_meta=get_userdata($user->ID);

        if ( $user && $result ){
            $name = get_user_meta($user->ID,'first_name',true);
            wp_set_auth_cookie( $user->ID, is_ssl() );

            if(isset($cookies)){
                wp_set_auth_cookie( $user->ID, true );  
            }
            $response['status']= 1;
            $response['message']="Welcome ".$name." Log in successful! ";
            
            $userdata = get_userdata($user->ID);
            $user_roles = $userdata->roles[0];
            
            if($user_roles == 'employee'){
                
                $login_value = get_user_meta($user->ID,'login_value',true);
                if($login_value == ''){
                  $response['url']= get_the_permalink(100);
                  update_user_meta($user->ID,'login_value',1);
                }else{
                  $response['url']= get_the_permalink(26);  
                }
           }else if($user_roles == 'recruiter'){
                $login_value = get_user_meta($user->ID,'login_value',true);
                if($login_value == ''){
                  $response['url']= get_the_permalink(249);
                  update_user_meta($user->ID,'login_value',1);
                }else{
                 $response['url']= get_the_permalink(52);   
                }
                
            }

        }else{
            $response['status']= 0;
            $response['message']="Password Incorrect"; 
        }
    }else{
        $response['status']= 0;
        $response['message']="Account not activated. Please check email for activation link.";
    }
 
    }else{
        $response['status']= 0;   
        $response['message']="Email doesn't Exists"; 
    }
    echo json_encode($response);
    
    exit();
}

/****************Employer Signup***************************/

add_action('wp_ajax_signup', 'signup');
add_action('wp_ajax_nopriv_signup', 'signup');

function signup(){
    $response = array();
    global $wpdb;
    $site_url = site_url();
    $username = substr($_POST['email'],0,strpos($_POST['email'],'@'));
    $email = $_POST['email'];
    $fname= $_POST['name'];
    if(!email_exists($_POST['email'])){

        $user_id = wp_create_user($username, $_POST['password'],$_POST['email']);
                
        $u = new WP_User($user_id);

        // Remove role
        $u->remove_role( 'subscriber' );

        // Add role
        $u->add_role($_POST['role']);
        update_user_meta($user_id,'first_name',$_POST['name']);
        update_user_meta($user_id,'last_name',$_POST['surname']);
        update_user_meta($user_id,'email',$_POST['email']);
        update_user_meta($user_id,'job_title',$_POST['job_title']);
        update_user_meta($user_id,'business_name',$_POST['business_name']);
        update_user_meta($user_id,'office_location',$_POST['office_location']);
        
        $code = md5(time());
        $activation_string = array('id'=>$user_id,'code'=>$code);
        $activation_key = site_url().'/?key='.base64_encode(serialize($activation_string));
        update_user_meta($user_id,'activation_code',$code);
        $site_url = site_url();
        $html = ' <head>
   <title>Activation Link</title>
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
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hi, '.$fname.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Thanks for signing up!
                                </p>
                                <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Meanwhile, please verify your email <a href="'.$activation_key.'">(click here)</a> 
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
        if(wp_mail($email,'Account Activation',$html,$headers)){
            $response['status'] = 1;
            $response['message'] = 'Account Created Successfully! Please check your email for activation.';
        }else{
            $response['status'] = 0;
            $response['message'] = 'Something went wrong!';
        }
    }else{
       $response['status'] = 0;
       $response['message'] = 'Email already exists!';
    }
    echo json_encode($response);
 exit();   
}

/********************Activate Account********************************/

function activate_account($key){
    global $wpdb;
    $activation_data = unserialize(base64_decode($key));
     $activation_code = get_user_meta($activation_data['id'],'activation_code',true);
    if($activation_code == $activation_data['code']){
        update_user_meta($activation_data['id'],'account_activated',1); ?>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script>
     toastr.success('Account Activated');
 </script>
<?php 
    }
}

/****************Recruiter Signup***************************/

add_action('wp_ajax_recruiter_signup', 'recruiter_signup');
add_action('wp_ajax_nopriv_recruiter_signup', 'recruiter_signup');

function recruiter_signup(){
    $response = array();
    global $wpdb;
    $site_url = site_url();
    $username = substr($_POST['email'],0,strpos($_POST['email'],'@'));
    $email = $_POST['email'];
    $fname= $_POST['first_name'];
    if(!email_exists($_POST['email'])){

        $user_id = wp_create_user($username, $_POST['password'],$_POST['email']);
                
        $u = new WP_User($user_id);

        // Remove role
        $u->remove_role( 'subscriber' );

        // Add role
        $u->add_role($_POST['role']);
        update_user_meta($user_id,'first_name',$_POST['name']);
        update_user_meta($user_id,'last_name',$_POST['surname']);
        update_user_meta($user_id,'email',$_POST['email']);
        update_user_meta($user_id,'employment_status',$_POST['empolyment_status']);
        update_user_meta($user_id,'linkedin_profile',$_POST['linkedin_profile']);
        update_user_meta($user_id,'city',$_POST['city']);
        
        $code = md5(time());
        $activation_string = array('id'=>$user_id,'code'=>$code);
        $activation_key = site_url().'/?key='.base64_encode(serialize($activation_string));
        update_user_meta($user_id,'activation_code',$code);
        $site_url = site_url();
        $html = ' <head>
   <title>Activation Link</title>
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
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hi, '.$fname.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Thanks for signing up!
                                </p>
                                <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Meanwhile, please verify your email <a href="'.$activation_key.'">(click here)</a> 
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
        if(wp_mail($email,'Account Activation',$html,$headers)){
            $response['status'] = 1;
            $response['message'] = 'Account Created Successfully! Please check your email for activation.';
        }else{
            $response['status'] = 0;
            $response['message'] = 'Something went wrong!';
        }
    }else{
       $response['status'] = 0;
       $response['message'] = 'Email already exists!';
    }
    echo json_encode($response);
 exit();   
}

/*********************Forgot Password******************************/
add_action('wp_ajax_forgot_password', 'forgot_password');
add_action('wp_ajax_nopriv_forgot_password', 'forgot_password');

function forgot_password(){
    
    global $wpdb;
    
    $response = array();
    $forgot_email= $_POST["email"];
    if(email_exists($forgot_email)){
       $new_password= wp_generate_password($length = 12, $special_chars = true, $extra_special_chars = false );
        $user = get_user_by( 'email', $forgot_email );
        $check = $user->ID;
        wp_set_password($new_password,$user->ID);
        $siteurl = site_url();
        
    $html = ' <head>
   <title>Forgot Password</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteurl.'" target="_blank">
                                <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$forgot_email.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Please login with the new autogenerated password - '.$new_password.'
                                </p>
                                <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                You can change your password any time from my profile section
                                </p>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <info@heyjobba.customerdevsites.com/>' . "\r\n";

        if(wp_mail( $forgot_email, 'Forgot Password',$html, $headers)){
            $response['status'] = 1;
            $response['message'] = 'New password has been sent to your mail.Please check.';
            
        }else{
            $response['status'] = 0;
            $response['message'] = 'Please enter valid email address';
        }
         
}
    echo json_encode($response);
         exit();

}

/***********Change recruiter settings*******************/

add_action('wp_ajax_recruiter_settings', 'recruiter_settings');
add_action('wp_ajax_nopriv_recruiter_settings', 'recruiter_settings');

function recruiter_settings(){
    global $wpdb;
    $a = 'false';
    $response=array();
    $user_id =$_POST['id'];
    if( isset($_FILES['profile_image']) ){
        $upload = wp_upload_bits($_FILES["profile_image"]["name"], null, file_get_contents($_FILES["profile_image"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );

            if( ! is_wp_error( $attachment_id )){
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                update_field('field_6299aa80c2f13', $attachment_id, 'user_'.$user_id);
            }

        }
            $response['status'] = 1;
            $a = true;
    }

    update_user_meta($user_id,'first_name',$_POST['name']);    
    update_user_meta($user_id,'email',$_POST['email']);    
    update_user_meta($user_id,'last_name',$_POST['surname']);
    update_user_meta($user_id,'employment_status',$_POST['emp_status']);
    update_user_meta($user_id,'linkedin_profile',$_POST['linkedin_profile']);
    update_user_meta($user_id,'city',$_POST['city']);
    
    $a = true;
    if($a == 'true'){
     $response['status'] = 1;
     $response['message'] = 'Settings updated successfully!';
    }else{
      $response['status'] = 0;
      $response['message'] = 'Something went wrong!';
    }
    echo json_encode($response);
    exit();
}

/********Change recruiter password*****************/

add_action('wp_ajax_change_rec_password', 'change_rec_password');
add_action('wp_ajax_nopriv_change_rec_password', 'change_rec_password');

function change_rec_password(){
    global $wpdb;
    $response= array();
    $id = $_POST['id'];
    $password= $_POST['password'];
    $result = wp_set_password($password,$id);
        $response['status'] = 1;
       $response['message'] = 'Password updated successfully!';
     echo json_encode($response);
    exit();
}

/**********Employer Settings**************/

add_action('wp_ajax_emp_setting', 'emp_setting');
add_action('wp_ajax_nopriv_emp_setting', 'emp_setting');


function emp_setting(){
   global $wpdb;
        $a = 'false';
    $response=array();
    $user_id =$_POST['id'];
    if( isset($_FILES['profile_image']) ){
        $upload = wp_upload_bits($_FILES["profile_image"]["name"], null, file_get_contents($_FILES["profile_image"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );

            if( ! is_wp_error( $attachment_id )){
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                update_field('field_6299d9855aefc', $attachment_id, 'user_'.$user_id);
            }

        }
            $response['status'] = 1;
            $a = true;
    }

    update_user_meta($user_id,'first_name',$_POST['name']);    
    update_user_meta($user_id,'email',$_POST['email']);    
    update_user_meta($user_id,'last_name',$_POST['surname']);
    update_user_meta($user_id,'job_title',$_POST['job_title']);
    update_user_meta($user_id,'business_name',$_POST['business_name']);
    update_user_meta($user_id,'office_location',$_POST['location']);
    
    $a = true;
    if($a == 'true'){
     $response['status'] = 1;
     $response['message'] = 'Settings updated successfully!';
    }else{
      $response['status'] = 0;
      $response['message'] = 'Something went wrong!';
    }
    echo json_encode($response);
    exit();
}

/************Employer Change password******************/

add_action('wp_ajax_emp_chng_password', 'emp_chng_password');
add_action('wp_ajax_nopriv_emp_chng_password', 'emp_chng_password');

function emp_chng_password(){
    global $wpdb;
    $response= array();
    $id = $_POST['id'];
    $password= $_POST['password'];
    $result = wp_set_password($password,$id);
        $response['status'] = 1;
       $response['message'] = 'Password updated successfully!';
     echo json_encode($response);
    exit();  
}

/**********Employer Update business profile(with first login)*******************/

add_action('wp_ajax_update_business_profile', 'update_business_profile');
add_action('wp_ajax_nopriv_update_business_profile', 'update_business_profile');

function update_business_profile(){
    $a = false;
    global $wpdb;
    $user_id = $_POST['id'];
        if(isset($_FILES['company_logo'])){
        $upload = wp_upload_bits($_FILES["company_logo"]["name"], null, file_get_contents($_FILES["company_logo"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );

            if( ! is_wp_error( $attachment_id )){
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                update_field('field_629de0e7401ae', $attachment_id, 'user_'.$user_id);
            }

        }
            $response['status'] = 1;
            $a = true;
    }
    
    update_user_meta($user_id,'business_name',$_POST['business_name']);
    update_user_meta($user_id,'company_registration_no',$_POST['company_registraion_number']);    
    update_user_meta($user_id,'industries',$_POST['industries']);    
    update_user_meta($user_id,'business_website_address',$_POST['business_website_address']);
    update_user_meta($user_id,'company_address',$_POST['address']);
    update_user_meta($user_id,'years_founded',$_POST['year_founded']);
    update_user_meta($user_id,'address_second_line',$_POST['address_second_line']);
    update_user_meta($user_id,'number_of_employees',$_POST['no_of_employee']);
    update_user_meta($user_id,'towncity',$_POST['town_city']);
    update_user_meta($user_id,'annual_turnover',$_POST['annual_turnover']);
    update_user_meta($user_id,'country',$_POST['country']);
    update_user_meta($user_id,'global_presence',$_POST['global_presence']);
    update_user_meta($user_id,'postal_code',$_POST['postal_code']);
    update_user_meta($user_id,'compititors',$_POST['compititors']);
    update_user_meta($user_id,'about_your_business',$_POST['about_business']);
    update_user_meta($user_id,'first_name',$_POST['name']);
    update_user_meta($user_id,'based',$_POST['base']);
    update_user_meta($user_id,'email',$_POST['email']);
    update_user_meta($user_id,'telephone',$_POST['telephone']);
    update_user_meta($user_id,'add_collegue',$_POST['add_collegue']);
    update_user_meta($user_id,'job_title',$_POST['job_title']);
    $a = true;
    if($a == true){
      $response['status'] = 1;
      $response['message'] = "Profile updated successfully!";
        
    }else{
        $response['status'] = 0;
        $response['message'] = "Something went wrong!"; 
    }
    echo json_encode($response);
    exit();
}

/*************Recruiter Profile(On first login)****************************/

add_action('wp_ajax_recruiter_profile', 'recruiter_profile');
add_action('wp_ajax_nopriv_recruiter_profile', 'recruiter_profile');


function recruiter_profile(){
    global $wpdb;
   $response = array();
$rec_id = $_POST['id'];
$expertise_area = $_POST['skill'];
if(!empty($rec_id)){
    
            if( isset($_FILES['profile_image']) ){
        $upload = wp_upload_bits($_FILES["profile_image"]["name"], null, file_get_contents($_FILES["profile_image"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );

            if( ! is_wp_error( $attachment_id )){
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                update_field('field_6299aa80c2f13', $attachment_id, 'user_'.$user_id);
            }

        }
            $response['status'] = 1;
            $a = true;
    }
    
    update_user_meta($rec_id,'first_name',$_POST['name']);
    update_user_meta($rec_id,'recruiter_lives',$_POST['lives']);
    update_user_meta($rec_id,'recruitment_experience',$_POST['rec_experience']);
    update_user_meta($rec_id,'recruiter_qualificiation',$_POST['qualification']);
    update_user_meta($rec_id,'about_recruiter',$_POST['about_me']);
    update_user_meta($rec_id,'linkedin_profile',$_POST['linkedin_profile']);
    update_user_meta($rec_id,'postal_address',$_POST['postal_address']);
    update_user_meta($rec_id,'recruiter_phone',$_POST['phone']);
    
    delete_user_meta($rec_id,'expertise_area');
    delete_user_meta($rec_id,'field_62aad897c1a09');

    $pr = 0;
    for($k=1;$k<=count($expertise_area);$k++){
       $expertise_array = array(
           'rec_expertise_area'=>$expertise_area[$pr]
       );
      add_row('expertise_area',$expertise_array,'user_'.$rec_id);
      $pr++;
    } 
    $response['status'] = 1;
    $response['message'] = 'Profile updated successfully!';
}else{
    $response['status'] = 0;
    $response['message'] = 'Something went wrong!';
}
    
echo json_encode($response);
exit();
}

/*********************Post a job************************/

add_action('wp_ajax_post_jobbbbb', 'post_jobbbbb');
add_action('wp_ajax_nopriv_post_jobbbbb', 'post_jobbbbb');

function post_jobbbbb(){

    $response = array();
    global $wpdb;
    
    $search_criteria = $wpdb->get_results("SELECT * FROM save_search_criteria");
    $siteurl = site_url();
    
    $job_id = $_POST['job_id'];
    $job_title = $_POST['job_title'];
    $job_location = $_POST['job_location'];
    $people = $_POST['people'];
    $job_closing_date = $_POST['job_closing_date'];
    $job_earlist_date = $_POST['job_earliest_date'];
    $salary = $_POST['salary'];
   
    $skillsddddd = $_POST['skill'];
    $skill_rating = $_POST['skill_level'];
    
    $experiences = $_POST['experience'];
    $exper_rating = $_POST['exp_count'];
    
    $job_soft_skills_name = $_POST['soft_skills_name'];
    $job_soft_skills_level = $_POST['soft_skills_level'];
    
    $post_status = $_POST['post_status'];
    
    if(!empty($job_id) && $job_id != 0 && $post_status =='publish'){
         $post_id = wp_update_post(array(
            'post_title'=>$_POST['job_title'],
            'ID'            =>  $job_id,
            'post_status'   =>  'publish',
        ));
         $response['status'] = 1; 
         $response['message'] = 'Job posted suceesfully!';
    }else if($post_status == 'draft' && $job_id !=0){
           $post_id = wp_update_post(array(
            'post_title'=>$_POST['job_title'],
            'ID'            =>  $job_id,
            'post_type'=>'jobs',
            'post_status' => 'draft', 
           ));
        $response['status'] = 1;
        $response['message'] = 'Job drafted successfully!';
        
    }else if($post_status == 'draft'){
           $post_id = wp_insert_post(array(
            'post_title'=>$_POST['job_title'], 
            'post_type'=>'jobs',
            'post_status' => 'draft', 
           ));
        $response['status'] = 1;
        $response['message'] = 'Job drafted successfully!';
        $response['url'] = get_the_permalink(26);
        
    }else{
        $post_id = wp_insert_post(array(
            'post_title'=>$_POST['job_title'], 
            'post_type'=>'jobs',
            'post_status' => 'publish',
        )); 
        $response['status'] = 1;
        $response['message'] = 'Job posted successfully!';
        $response['url'] = get_the_permalink(26);
    }
    
    $link_of_job = get_the_permalink(601).'?job_id='.$post_id;
    
      if($post_id){
          
          send_job_alert($_POST['job_title']);
          
          update_post_meta($post_id,'employer_id',$_POST['emp_id']);
          update_post_meta($post_id,'when_you_want_to_recieve_candidates',$_POST['when_recieve']);
          update_post_meta($post_id,'jobs_job_location',$_POST['job_location']);
          update_post_meta($post_id,'job_category',$_POST['job_cat']);
          update_post_meta($post_id,'how_many_people_do_you_need',$_POST['people']);
          update_post_meta($post_id,'employement_type',$_POST['employement_type']);
          update_post_meta($post_id,'job_closing_date',$_POST['job_closing_date']);
          update_post_meta($post_id,'earliest_start_date',$_POST['job_earliest_date']);
          update_post_meta($post_id,'job_type',$_POST['job_type']);
          update_post_meta($post_id,'seniority',$_POST['seniority']);
          update_post_meta($post_id,'security_clearance',$_POST['security_clearance']);
          update_post_meta($post_id,'salary_required',$_POST['salary']);
          update_post_meta($post_id,'equity',$_POST['equity']);
          update_post_meta($post_id,'holidays',$_POST['holidays']);
          update_post_meta($post_id,'bonus_available',$_POST['bonus_type']);
          update_post_meta($post_id,'healthcare',$_POST['health_type']);
          update_post_meta($post_id,'other_benifits',$_POST['benifits']);
          update_post_meta($post_id,'offer_sponsorship',$_POST['offer_sponsorship']);
          update_post_meta($post_id,'ir35_status',$_POST['ir_status']);
          update_post_meta($post_id,'university_of_interest',$_POST['university_interest']);
          update_post_meta($post_id,'travel_required',$_POST['travel_require']);

        /*************Form Part 2*********************/

        update_post_meta($post_id,'what_will_you_do',$_POST['what_wil_you_do']);
        update_post_meta($post_id,'responsibilities',$_POST['responsibilities']);
        update_post_meta($post_id,'you_will_have_experience_in',$_POST['experience_in']);
        update_post_meta($post_id,'what_will_you_do',$_POST['what_wil_you_do']);
        update_post_meta($post_id,'what_will_make_someone_stand_out',$_POST['what_will_make_stand']);
        update_post_meta($post_id,'what_we_want_to_avoid',$_POST['what_avoid']);
        update_post_meta($post_id,'why_should_someone_come_and_work_with_you',$_POST['why_work']);
        update_post_meta($post_id,'tell_us_more_about_you',$_POST['more_about_you']);
          
        update_post_meta($post_id,'fee_level',$_POST['fee_level_percentage']);
        
          /************Update Technical Skills***********************/
          
        delete_post_meta($post_id,'skills');
        delete_post_meta($post_id,'field_62a82a30a8eb4');
          
        $pr = 0;
        for($k=1;$k<=count($skillsddddd);$k++){
            
           $skills_array = array(
               'job_skill_name'=>$skillsddddd[$pr],
                'job_skill_rating'=>$skill_rating[$pr],
           );
          add_row('skills',$skills_array,$post_id);
          $pr++;
        }
          
          /****************Update Experience*******************/
          
          delete_post_meta($post_id,'experience_added');
          delete_post_meta($post_id,'field_62b02b4b3ddd3');
          
          $f = 0;
          for($m=1;$m<=count($experiences);$m++){
            
           $exp_array = array(
                'exp_field_name'=>$experiences[$f],
                'years_of_experience'=>$exper_rating[$f],
           );
          add_row('experience_added',$exp_array,$post_id);
          $f++;
        }
          
        /*************Update Soft Skills************************/
          
          delete_post_meta($post_id,'job_soft_skill');
          delete_post_meta($post_id,'field_62fb7009204f0');
          
          $l = 0;
          for($q=1;$q<=count($job_soft_skills_name);$q++){
            
           $soft_skills_array = array(
                'job_soft_skill_name'=>$job_soft_skills_name[$l],
                'job_soft_skill_level'=>$job_soft_skills_level[$l],
           );
          add_row('job_soft_skill',$soft_skills_array,$post_id);
          $l++;
        }
          
        
        /*******If job is live(post)************/
          
    $current_post_status = get_post_status($post_id);
    if($current_post_status != 'draft'){
                      
    $args = array(
        'role'    => 'Recruiter',
     );
    $all_recruiters_data = get_users($args);
    $x = array();
    $rec_match_ids = array();
    foreach($all_recruiters_data as $al_recruiters_dat){
        $recID = $al_recruiters_dat->ID;
        $recExpertise = get_field('expertise_area','user_'.$recID);
        
        foreach($recExpertise as $recExp){
            if(in_array($recExp['rec_expertise_area'],$skillsddddd)){
                $x[] = $recID;
            }
        }
        
    }
    foreach($x as $rec_match_id){
        
    $rec_match_data = get_userdata($rec_match_id);
    $rec_match_email =  $rec_match_data->email;
    $rec_first_name = get_user_meta($rec_match_id,'first_name','true');
        
    $rec_match_html = ' <head>
   <title>New Job Posted</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteurl.'" target="_blank">
                                <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$rec_first_name.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                A new job has been posted for the role of "'.$job_title.'".Kindly check and share suitable candidate profiles for the job. <br> Details are mentioned below:<br>
                                
                                </p>
                                   <div>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">Job Details</p>

                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Job Role:</strong> '.$job_title.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Job Location:</strong> '.$job_location.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>How many people need for job:</strong> '.$people.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Job Closing date:</strong> '.$job_closing_date.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Job Earlist date:</strong> '.$job_earlist_date.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Salary Brackets:</strong> '.$salary.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>View Job:</strong> '.$link_of_job.'
                                        </p>

                                    </div>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <info@heyjobba.customerdevsites.com/>' . "\r\n";

        wp_mail($rec_match_email, 'New Job Posted',$rec_match_html, $headers);  
        }   
        }
        }
        echo json_encode($response);
    exit();  
      }

    

/**************************Save for later(Recruiter)********************************/

add_action('wp_ajax_save_later', 'save_later');
add_action('wp_ajax_nopriv_save_later', 'save_later');

function save_later(){
    global $wpdb;
    $response= array();
    if(!empty($_POST['rec_id']) && !empty($_POST['job_id'])){
        $insert = $wpdb->insert('job_status', array(
            'job_id' => (int)$_POST['job_id'],
            'recruiter_id' => (int)$_POST['rec_id'],
            'status'=>'saved',
        ));
    }
    
    if($insert){
        $response['status'] = 1;
        $response['message'] = 'You saved a job for later!';
        $response['url'] = get_the_permalink(240);
    }else{
      $response['status'] = 0;
      $response['message'] = 'Something went wrong!';  
    }
    echo json_encode($response);
    exit();
}

/**********************Live job (Recruiter)*******************************/

add_action('wp_ajax_live_job', 'live_job');
add_action('wp_ajax_nopriv_live_job', 'live_job');

function live_job(){
    global $wpdb;
    $response= array();
    $saved_job_ids = array();
    $rec_id = $_POST['rec_id'];
    $job_id = $_POST['job_id'];
    $jobs_data = $wpdb->get_results("SELECT job_id FROM job_status WHERE recruiter_id=$rec_id AND status='saved'");
    
    foreach($jobs_data as $job_ids){
      $saved_job_ids[] = $job_ids->job_id;  
    }
    if(!empty($_POST['rec_id']) && !empty($_POST['job_id'])){
        if(in_array($_POST['job_id'],$saved_job_ids)){
    $insert = $wpdb->query("UPDATE job_status SET status='live' WHERE recruiter_id=$rec_id AND job_id =$job_id");
        }else{
    $insert = $wpdb->insert('job_status', array(
        'job_id' => $_POST['job_id'],
        'recruiter_id' => $_POST['rec_id'],
        'status' => 'live',
    ));
        }

    }
   if($insert){
        $response['status'] = 1;
        $response['message'] = 'You commit a job for vacancy!';
        $response['url'] = get_the_permalink(238);
    }else{
      $response['status'] = 0;
      $response['message'] = 'Something went wrong!';  
    }
    echo json_encode($response);
    exit();  
}

/******************Move job save to live(Recruiter)************************/

add_action('wp_ajax_move_to_active', 'move_to_active');
add_action('wp_ajax_nopriv_move_to_active', 'move_to_active');


function move_to_active(){
   global $wpdb;
    $response= array();
    $row_id = $_POST['row_id'];
    $update = $wpdb->query("UPDATE job_status SET status='live' WHERE ID=$row_id");
    if($update){
        $response['status'] = 1;
        $response['message'] = 'Job moved to active jobs';
    }else{
        $response['status'] = 0;
        $response['message'] = 'Something went wrong';  
    }
    echo json_encode($response);
    exit();
}

/*********************Remove saved job(Recruiter)*******************************/

add_action('wp_ajax_remove_saved_job', 'remove_saved_job');
add_action('wp_ajax_nopriv_remove_saved_job', 'remove_saved_job');

function remove_saved_job(){
     global $wpdb;
    $response= array();
    $row_id = $_POST['row_id'];
    $delete = $wpdb->query("DELETE FROM job_status WHERE ID=$row_id");
    if($delete){
        $response['status'] = 1;
        $response['message'] = 'Job removed from saved jobs';
    }else{
        $response['status'] = 0;
        $response['message'] = 'Something went wrong';  
    }
    echo json_encode($response);
    exit();
} 

/***********************Submit candidate(Recruiter)*******************************/

add_action('wp_ajax_submit_candidate', 'submit_candidate');
add_action('wp_ajax_nopriv_submit_candidate', 'submit_candidate');

function submit_candidate(){
    global $wpdb;
    $response=array();
    
    $siteurl = site_url();
    $email = $_POST['email'];
    $name = $_POST['name'];
    $emp_id = $_POST['emp_id'];
    $job_link = get_the_permalink(480);
    
    
    $cv = $_FILES['cv'];
    $videoletter = $_FILES['video_letter'];
    $intro_video = $_FILES['intro_video'];
    $additional_info = $_FILES['additional_info'];
    
    
    /******For cv************/
    
     if( isset($_FILES['cv']) ){
        $upload = wp_upload_bits($_FILES["cv"]["name"], null, file_get_contents($_FILES["cv"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename);

            }
         $_POST['cv'] = $attachment_id;
    }
    
    /******For video letter************/
    
        if( isset($_FILES['video_letter']) ){
        $upload = wp_upload_bits($_FILES["video_letter"]["name"], null, file_get_contents($_FILES["video_letter"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $video_attachment_id = wp_insert_attachment( $attachment, $filename);
            }
            $_POST['video_atachment'] = $video_attachment_id;
    }
    
    /*********Intro Video***********/
    
           if( isset($_FILES['intro_video']) ){
        $upload = wp_upload_bits($_FILES["intro_video"]["name"], null, file_get_contents($_FILES["intro_video"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $intro_video_attachment_id = wp_insert_attachment( $attachment, $filename);
            }
            $_POST['intro_video_atachment'] = $intro_video_attachment_id;
    }
    
    /****************Additional info*********************/
    
              if( isset($_FILES['additional_info']) ){
        $upload = wp_upload_bits($_FILES["additional_info"]["name"], null, file_get_contents($_FILES["additional_info"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $addinfo_attachment_id = wp_insert_attachment( $attachment, $filename);
            }
            $_POST['add_info_atachment'] = $addinfo_attachment_id;
    }
    
            if( isset($_FILES['candidate_profile_image']) ){
        $upload = wp_upload_bits($_FILES["candidate_profile_image"]["name"], null, file_get_contents($_FILES["candidate_profile_image"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $candidate_profile_image = wp_insert_attachment( $attachment, $filename);
            }
            $_POST['candidate_profile_image'] = $candidate_profile_image;
    }
    
    
    
   $candidate_data = serialize($_POST);
    $insert = $wpdb->insert('save_candidate',array(
        'job_id'=>$_POST['job_id'],
        'rec_id'=>$_POST['recruiter_id'],
        'emp_id'=>$emp_id,
        'candidate_data'=>$candidate_data,
        'time_stamp'=>$_POST['time_stamp'],
        'status'=>'pending',
        'stage'=>'stage0',
        'shared_status'=>0,
  ));
    $wpdb->last_query;
    $lastid = $wpdb->insert_id;
    $j_id = $_POST['job_id'];
    $confirmation_link = $job_link.'?enrl='.$lastid.'&ji='.$j_id;
    
    if($insert){
        $save_candidatehtml = ' <head>
   <title>New Job Recruitment</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteurl.'" target="_blank">
                                <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$name.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Your profile is selected for a job. Please click on the below link for confirmation to enroll:
                                </p>
                                <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Please click on below link:<br>
                                <a href="'.$confirmation_link.'">Click Here</a>
                                </p>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <info@heyjobba.customerdevsites.com/>' . "\r\n";

    wp_mail( $email, 'Job Alert',$save_candidatehtml, $headers);
      $response['status'] = 1;
      $response['message'] = 'You submit a candidate for this post';
    }else{
       $response['status'] = 0;
        $response['message'] = 'Something went wrong!';
    }
    echo json_encode($response);
    exit();
    
}

/***********Candidate Confirmation(Recruiter)*************************/

function update_candidate_status($row_id,$job_id){
   global $wpdb;
    $current_time = strtotime(date('Y-m-d h:i:s'));
    $current_date = date('Y-m-d');
    $current_timestamp = strtotime($current_date);
    $when_emp_recv = get_field('save_candidate',$job_id);
    $job_closing_date = get_field('job_closing_date',$job_id);
    $close_timestamp = strtotime($job_closing_date);
    
    if($when_emp_recv == 'recieve_as_submitted'){
    if($current_timestamp <= $close_timestamp){
    $update = $wpdb->query("UPDATE save_candidate SET status='active', time_stamp=$current_time WHERE ID=$row_id"); 
    }
    }else if($current_timestamp <= $close_timestamp){
      $update = $wpdb->query("UPDATE save_candidate SET status='active', time_stamp=$current_time WHERE ID=$row_id");
    }
    if($update){
?>
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script>
     toastr.success('You are enrolled for this job!');
 </script>
<?php    }
    }

/**************Check job date(vacancy)***********************/

function check_date($job_id){
    $current_date = date('Y-m-d');
    $current_timestamp = strtotime($current_date);

    $job_closing_date = get_field('job_closing_date',$job_id);
    $close_timestamp = strtotime($job_closing_date);

    if($current_timestamp <= $close_timestamp){
        return $job_id;
    }
}

/**************view Candidate shortlist(Employer)******************************/

add_action('wp_ajax_shortlist_candidates', 'shortlist_candidates');
add_action('wp_ajax_nopriv_shortlist_candidates', 'shortlist_candidates');

function shortlist_candidates(){
    global $wpdb;
    $response = array();
    $emp_id = (int)$_POST['emp_id'];
    $job_id = (int)$_POST['job_id'];
    
    $shorlist_candidates = $wpdb->get_results("SELECT * FROM save_candidate WHERE emp_id=$emp_id AND job_id=$job_id AND status IN ('rearrange-interview', 'active', 'interview-pending','rejected')");

    $a = 1;
    foreach($shorlist_candidates as $short_candiadte){
       $can_data = $short_candiadte->candidate_data;
        $row_id = $short_candiadte->ID;
        $rec_id = $short_candiadte->rec_id;
       $un_can_data = unserialize($can_data);
        
    $candiadte_name = $un_can_data['name'];
    $current_employer = $un_can_data['current_employer'];
    $current_job_title = $un_can_data['current_position'];
    $current_salary = $un_can_data['current_salary'];
    $availability = $un_can_data['availablity'];
    $view_candidate_link = get_the_permalink(498).'?r='.$row_id;
    $profile_img = wp_get_attachment_url($un_can_data['candidate_profile_image']);
     if(empty($profile_img)){
      $profile_img = get_template_directory_uri().'/images/dummy.jpg';     
    }
    
    $candidate_status = $short_candiadte->status;
        if($candidate_status == 'active'){
          $dis_stats = 'Submitted';  
        }else if($candidate_status == 'rearrange-interview'){
           $dis_stats = 'Rearrange-Interview'; 
        }else if($candidate_status == 'interview-pending'){
          $dis_stats = 'Pending for recruiter confirmation';   
        }else if($candidate_status == 'rejected'){
          $dis_stats = 'Rejected';  
        }
        
    $response['html'] .='<tr>';
    $response['html'] .='<td>';
    $response['html'] .='<label class="select-check">';
    $response['html'] .='<input type="checkbox" value="'.$row_id.'" class="candidates" id="row_ids_'.$a.'" data-rc-id="'.$rec_id.'">';
    $response['html'] .='<span class="check-box"></span>';
    $response['html'] .='</label>';
    $response['html'] .='</td>';
    $response['html'] .='<td>';
    $response['html'] .='<span class="table-applicant">';
    $response['html'] .='<img src='.$profile_img.' alt="Candidate-img">';
    $response['html'] .='</span>';
    $response['html'] .= $candiadte_name;
    $response['html'] .='</td>'; 
    $response['html'] .='<td>'.$current_employer.'</td>';
    $response['html'] .='<td>'.$current_job_title.'</td>';
    $response['html'] .='<td>£'.$current_salary.'</td>';
    $response['html'] .='<td>'.$availability.'</td>';
    $response['html'] .='<td>'.$dis_stats.'</td>';
    $response['html'] .='<td><a href='.$view_candidate_link.' class="my-btn my-btn-1">View</a></td>';
    $response['html'] .='</tr>';
    
    $a++;
}
                              
echo json_encode($response);
    exit();
}

/***********************Update candidate profile(Recruiter)********************************/

add_action('wp_ajax_update_candidate_profile', 'update_candidate_profile');
add_action('wp_ajax_nopriv_update_candidate_profile', 'update_candidate_profile');

function update_candidate_profile(){
    $response = array();
    global $wpdb;
    $row_id = $_POST['row_id'];
    
    if($_FILES['update_candidate_profile_image']['name'] != ''){
        $upload = wp_upload_bits($_FILES["update_candidate_profile_image"]["name"], null, file_get_contents($_FILES["update_candidate_profile_image"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename);
        }
         $_POST['candidate_profile_image'] = $attachment_id;
    }
    
    if($_FILES['update_cv']['name'] != ''){
        $upload = wp_upload_bits($_FILES["update_cv"]["name"], null, file_get_contents($_FILES["update_cv"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename);
        }
         $_POST['cv'] = $attachment_id;
    }
    
    if($_FILES['update_video_atachment']['name'] != ''){
        $upload = wp_upload_bits($_FILES["update_video_atachment"]["name"], null, file_get_contents($_FILES["update_video_atachment"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename);
        }
         $_POST['video_atachment'] = $attachment_id;
    }
    
    if($_FILES['update_intro_video_atachment']['name'] != ''){
        $upload = wp_upload_bits($_FILES["update_intro_video_atachment"]["name"], null, file_get_contents($_FILES["update_intro_video_atachment"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename);
        }
         $_POST['intro_video_atachment'] = $attachment_id;
    }
    
    
    if($_FILES['update_add_info_atachment']['name'] != ''){
        $upload = wp_upload_bits($_FILES["update_add_info_atachment"]["name"], null, file_get_contents($_FILES["update_add_info_atachment"]["tmp_name"]));
            if ( ! $upload['error'] ) {
                $post_id = $post_id; //set post id to which you need to set featured image
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

        $attachment_id = wp_insert_attachment( $attachment, $filename);
        }
         $_POST['add_info_atachment'] = $attachment_id;
    }
    
    $new_data = serialize($_POST);
    $update = $wpdb->query("UPDATE save_candidate SET candidate_data='".$new_data."' WHERE ID=$row_id");
//    echo $wpdb->last_query;
    if($update){
       $response['status'] = 1;
       $response['message'] = 'Candidate Profile is updated Successfully!';
       $response['url'] = get_the_permalink(98);
    }else{
       $response['status'] = 0;
       $response['message'] = 'Something went wrong!'; 
    }
    echo json_encode($response);
    exit();
}

/**************Reject Candidate(Employer)***********************/

add_action('wp_ajax_reject_candidate', 'reject_candidate');
add_action('wp_ajax_nopriv_reject_candidate', 'reject_candidate');

function reject_candidate(){
    global $wpdb;
    $response = array();
    $row_id = $_POST['row_id'];
    
    $rejids = explode(",",$row_id);
    
    $rejection_reason = $_POST['rejection_reason'];
    $siteurl = site_url();

    /**** create candidate data ****/
    foreach($rejids as $cids){
        
        $wpdb->query("UPDATE save_candidate SET status='rejected' WHERE ID=$cids");
        
        $reject_candidate_data = $wpdb->get_results("SELECT candidate_data FROM save_candidate WHERE ID=$cids");
    
        $rj_data = unserialize($reject_candidate_data[0]->candidate_data);

        $candidate_name = $rj_data['name'];
        $cand_email = $rj_data['email']; 
        
        $cdata .= '<p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
            <strong>Candidate Name:</strong> '.$candidate_name.'
        </p>
        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
            <strong>Email:</strong> '.$cand_email.'
        </p>';
    }
    
    $recruiter_data = get_userdata($_POST['recruiter_id']);
    $rec_email = $recruiter_data->user_email;
    $rec_first_name = get_user_meta($_POST['recruiter_id'],'first_name',true);
    $employer_data = get_userdata($_POST['emp_id']);
    $emp_mail = $employer_data->user_email;

    $insert = $wpdb->insert('reject_candidate',array(
        'emp_id'=>$_POST['emp_id'],
        'rec_id'=>$_POST['recruiter_id'],
        'rejection_message'=>$_POST['rejection_reason'],
        'candidates'=>$row_id,
    ));

    $rej_can_html = ' <head>
   <title>Candidate Rejected</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteurl.'" target="_blank">
                                <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 100px; height: auto;"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$rec_first_name.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                Candidate has been rejected.<br>
                                
                                </p>
                                   <div>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">Candidate Details</p>

                                        '.$cdata.'
                                        
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Rejection Reason:</strong> '.$rejection_reason.'
                                        </p>
                                    </div>
                            </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <'.$emp_mail.'>' . "\r\n";

    if(wp_mail($rec_email, 'Candidate Rejected',$rej_can_html, $headers)){ 
        $response['status'] = 1;
        $response['message'] = "Candidate rejected!";
//        $response['url'] = get_the_permalink(30);
    
    }else{
        $response['status'] = 0;
        $response['message'] = "Something went wrong!";  
    }
    echo json_encode($response);
    exit();
}

/*******************Share Candidate(Employer)**************************/

add_action('wp_ajax_share_candidate', 'share_candidate');
add_action('wp_ajax_nopriv_share_candidate', 'share_candidate');

function share_candidate(){
    global $wpdb;
    $response = array(); 
    $emp_id = $_POST['emp_id'];
    $employer_data = get_userdata($_POST['emp_id']);
    $emp_mail = $employer_data->user_email;

    $row_id = $_POST['row_id'];
    $rejids = explode(",",$row_id);
    $siteurl = site_url();
    
    $share_with = $_POST['share_email'];
    if(!empty($share_with) && !empty($row_id)){
        
    foreach($rejids as $cids){
        $candidate_id = base64_encode($cids);
        $view_candidate = get_the_permalink(524).'?r='.$candidate_id;
        $share_can_html = ' <head>
   <title>Canadidate Profile</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteurl.'" target="_blank">
                                <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 100px; height: auto;"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$share_with.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                                <div>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">A new candidate profile is shared with you from HeyJobba. Please check details and cv at the below link.</p>

                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;"><a href="'.$view_candidate.'">Click Here</a>
                                        </p>
                                    </div>
                            </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <'.$emp_mail.'>' . "\r\n";

      wp_mail($share_with, 'Candidate Profile',$share_can_html, $headers);
    $response['status'] = 1;
    $response['message'] = "Candidate Profile shared";
    $response['url'] = get_the_permalink(30);
}
}else{
    $response['status'] = 0;
    $response['message'] = "Something went wrong";        
    }
echo json_encode($response);
exit();
}

/**********Hold Job(Employer)*****************/

add_action('wp_ajax_hold_job', 'hold_job');
add_action('wp_ajax_nopriv_hold_job', 'hold_job');

function hold_job(){
   global $wpdb;
$response = array();
$emp_id = $_POST['emp_id'];
$job_id = $_POST['job_id'];

if(!empty($job_id)){ 
    
$wpdb->query("UPDATE job_status SET status='hold' WHERE job_id=$job_id");
    
//$wpdb->query("UPDATE save_candidate SET status='job-hold' WHERE job_id=$job_id AND emp_id=$emp_id");
    
    $response['status'] = 1;
    $response['message'] = 'Your job is now on hold!';
}else{
   $response['status'] = 0;
   $response['message'] = 'Something went wrong!'; 
}    
echo json_encode($response);
exit();
}

/**********Delete Job(Employer)*****************/

add_action('wp_ajax_delete_job', 'delete_job');
add_action('wp_ajax_nopriv_delete_job', 'delete_job');

function delete_job(){
   global $wpdb;
$response = array();
$emp_id = $_POST['emp_id'];
$job_id = $_POST['job_id'];
    
if(!empty($job_id)){

wp_delete_post($job_id, true );

$wpdb->query("DELETE FROM job_status WHERE job_id=$job_id");

$wpdb->query("DELETE FROM save_candidate WHERE job_id=$job_id");
    
$response['status'] = 1;
$response['message'] = 'Job deleted!';

}else{
$response['status'] = 0;
$response['message'] = 'Something went wrong!';  
}
   echo json_encode($response);
   exit();
}

/******************Track-ats(Employer)************************/

add_action('wp_ajax_atstrack_candidates', 'atstrack_candidates');
add_action('wp_ajax_nopriv_atstrack_candidates', 'atstrack_candidates');

function atstrack_candidates(){
   global $wpdb;
    $response = array();
    $emp_id = $_POST['emp_id'];
    $job_id = $_POST['job_id'];
    
    /***********For displaying Ats***********************/
    
    $shorlist_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `job_id` = $job_id AND `emp_id` = $emp_id AND `status` NOT IN ('rejected', 'save','pending')");
    
    $a = 1;
    foreach($shorlist_candidates as $short_candiadte){
        $can_data = $short_candiadte->candidate_data;
        $job_id = $short_candiadte->job_id;
        $job_ats_title = get_the_title($job_id);
        $row_id = $short_candiadte->ID;
        $rec_id = $short_candiadte->rec_id;
        $stage = $short_candiadte->stage;
        $action_img = get_template_directory_uri().'/dashboard-employer/images/dots.png';
        $status = $short_candiadte->status;
        $un_can_data = unserialize($can_data);
        
        $candiadte_name = $un_can_data['name'];
        $current_job_title = $un_can_data['current_position'];
        $profile_img = wp_get_attachment_url($un_can_data['candidate_profile_image']);
        $contact_recruiter = get_the_permalink(32).'?rec_id='.$rec_id;
        $make_offer = get_the_permalink(44).'?rec_id='.$rec_id.'&r_id='.$row_id.'&j_id='.$job_id;
        
        
        if(empty($profile_img)){
          $profile_img = get_template_directory_uri().'/images/dummy.jpg';  
        }
        
        $htmlBooked = '';
        $htmlARP = '';
        $htmlBooked2 = '';
        $htmlBooked3 = '';
        $htmlBooked4 = '';
        $htmloffer = '';
        
        $feedbacks = $wpdb->get_results("SELECT * FROM `interview-feedback` WHERE `candidate_row_id` = $row_id AND `stage` LIKE '$stage'");
        
        if($feedbacks[0]->candidate_row_id){
           $next_stage_html = '<li><a href="javascript:void(0);" onclick="ats_book_interview('.$row_id.','.$rec_id.')">Arrange next stage interview</a></li>';
            $feedback_submit = '';
            
        }else{
          $next_stage_html = '<li><a href="javascript:void(0);" onclick="ats_nofeeds();">Arrange next stage interview</a></li>';
          $feedback_submit = '<li><a href="javascript:void(0);" onclick="give_feedback('.$row_id.','.$rec_id.');">Give Feedback</a></li>';
        }
        
        if($status == 'active'){
            
           $htmlARP = '<div class="applicant-content active"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots" class="dots"></figure><div class="next-options"><ul><li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');">Reject Candidate</a></li><li><a href="'.$make_offer.'">Make offer</a></li></ul></div></div>';
            
        }else if($status == 'rearrange-interview'){
            
           $htmlARP = '<div class="applicant-content rearrange"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');"></a></li><li><a href="'.$make_offer.'">Make offer</a></li></ul></div></div>';  
            
        }else if($status == 'interview-pending'){
            
            $htmlARP = '<div class="applicant-content pending"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');"></a></li><li><a href="'.$make_offer.'">Make offer</a></li></ul></div></div>';
            
        }else if($status == 'interview-booked' && $stage=='stage1'){
           
//            $res1 = $wpdb->get_results("SELECT * FROM 'save_candidate' WHERE ID=$row_id");
            
            $htmlBooked = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul>'.$next_stage_html.'<li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');">Reject Candidate</a></li><li><a href="'.$make_offer.'">Make offer</a></li>'.$feedback_submit.'</ul></div></div>';
            
        }else if($status == 'interview-booked' && $stage=='stage2'){
           
//            $res2 = $wpdb->get_results("SELECT * FROM 'save_candidate' WHERE ID=$row_id");
            
            $htmlBooked2 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul>'.$next_stage_html.'<li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');">Reject Candidate</a></li><li><a href="'.$make_offer.'">Make offer</a></li>'.$feedback_submit.'</ul></div></div>';
            
        }else if($status == 'interview-booked' && $stage=='stage3'){
            $htmlBooked3 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul>'.$next_stage_html.'<li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');">Reject Candidate</a></li><li><a href="'.$make_offer.'">Make offer</a></li>'.$feedback_submit.'</ul></div></div>';
            
        }else if($status == 'interview-booked' && $stage=='stage4'){
            $htmlBooked4 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');">Reject Candidate</a></li><li><a href="'.$make_offer.'">Make offer</a></li>'.$feedback_submit.'</ul></div></div>';
            
        }else if($status == 'interview-ongoing' && $stage=='stage1'){
            $htmlBooked = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');">Reject Candidate</a></li><li><a href="'.$make_offer.'">Make offer</a></li>'.$feedback_submit.'</ul></div></div>';
            
        }else if($status == 'interview-ongoing' && $stage=='stage2'){
            $htmlBooked2 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');">Reject Candidate</a></li><li><a href="'.$make_offer.'">Make offer</a></li>'.$feedback_submit.'</ul></div></div>';
            
        }else if($status == 'interview-ongoing' && $stage=='stage3'){
            $htmlBooked3 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');">Reject Candidate</a></li><li><a href="'.$make_offer.'">Make offer</a></li>'.$feedback_submit.'</ul></div></div>';
            
        }else if($status == 'interview-ongoing' && $stage=='stage4'){
            $htmlBooked4 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$contact_recruiter.'">Request Information from recruiter</a></li><li><a href="javascript:void(0);" onclick="ats_reject('.$row_id.','.$rec_id.');">Reject Candidate</a></li><li><a href="'.$make_offer.'">Make offer</a></li></ul></div></div>';
            
        }else if($status == 'offer-pending'){
            $htmloffer = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure></div>';
        }
        
    $response['ats_html'] .='<tr>';
    $response['ats_html'] .='<td>'.$htmlARP.'</td>';
    $response['ats_html'] .='<td>'.$htmlBooked.'</td>';
    $response['ats_html'] .='<td>'.$htmlBooked2.'</td>';
    $response['ats_html'] .='<td>'.$htmlBooked3.'</td>';
    $response['ats_html'] .='<td>'.$htmlBooked4.'</td>';
    $response['ats_html'] .='<td>'.$htmloffer.'</td>';
    $response['ats_html'] .='</tr>';
 }
        
    /**************For displaying jobs**********************/
        
     $job_shorlist_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `emp_id`=$emp_id AND `job_id`=$job_id AND `status` NOT IN ('rejected', 'save','offer-accepted','pending','contract-accepted','contract-signed','contract-pending')");
        
      foreach($job_shorlist_candidates as $j_short_candiadte){
        $can_dataj = $j_short_candiadte->candidate_data;
        $job_idj = $j_short_candiadte->job_id;
        $job_ats_titlej = get_the_title($job_id);
        $row_idj = $j_short_candiadte->ID;
        $rec_idj = $j_short_candiadte->rec_id;
        $statusj = $j_short_candiadte->status;
        $stagej = $j_short_candiadte->stage;
        $un_can_dataj = unserialize($can_dataj);
          
        if($statusj == 'active'){
          $dis_stats = 'Submitted';  
        }else if($statusj == 'rearrange-interview'){
           $dis_stats = 'Rearrange-Interview'; 
        }else if($statusj == 'interview-pending'){
          $dis_stats = 'Pending for recruiter confirmation';   
        }else if($statusj == 'interview-ongoing' && $stagej == 'stage1'){
            $dis_stats = 'Interview ongoing on stage 1';      
        }else if($statusj == 'interview-ongoing' && $stagej == 'stage2'){
            $dis_stats = 'Interview ongoing on stage 2';      
        }else if($statusj == 'interview-ongoing' && $stagej == 'stage3'){
            $dis_stats = 'Interview ongoing on stage 3';      
        }else if($statusj == 'interview-ongoing' && $stagej == 'stage4'){
            $dis_stats = 'Interview ongoing on stage 4';      
        }else if($statusj == 'interview-booked' && $stagej == 'stage1'){
          $dis_stats = 'Interview Booked for stage 1';     
        }else if($statusj == 'interview-booked' && $stagej == 'stage2'){
           $dis_stats = 'Interview Booked for stage 2';   
        }else if($statusj == 'interview-booked' && $stagej == 'stage3'){
           $dis_stats = 'Interview Booked for stage 3';   
        }else if($statusj == 'interview-booked' && $stagej == 'stage4'){
           $dis_stats = 'Interview Booked for stage 4';   
        }else if($statusj == 'offer-pending'){
           $dis_stats = 'Offer Pending from recruiter';   
        }else if($statusj == 'offer-rejected'){
           $dis_stats = 'Offer Rejected';   
        }
        
        $candiadte_namej = $un_can_dataj['name'];
        $current_employerj = $un_can_dataj['current_employer'];
        $current_job_titlej = $un_can_dataj['current_position'];
        $current_salaryj = $un_can_dataj['current_salary'];
        $availabilityj = $un_can_dataj['availablity'];
        $view_candidate_linkj = get_the_permalink(498).'?r='.$row_idj;
        $profile_imgj = wp_get_attachment_url($un_can_dataj['candidate_profile_image']);
        $contact_recruiterj = get_the_permalink(32).'?rec_id='.$rec_idj;
        $make_offer = get_the_permalink(44).'?rec_id='.$rec_idj.'&r_id='.$row_idj;
        
        if(empty($profile_imgj)){
          $profile_imgj = get_template_directory_uri().'/images/dummy.jpg';  
    }
        
    $response['html'] .='<tr>';
    $response['html'] .='</td>';
    $response['html'] .='<td>';
    $response['html'] .='<span class="table-applicant">';
    $response['html'] .='<img src='.$profile_imgj.' alt="Candidate-img">';
    $response['html'] .='</span>';
    $response['html'] .= $candiadte_namej;
    $response['html'] .='</td>'; 
    $response['html'] .='<td>'.$current_employerj.'</td>';
    $response['html'] .='<td>'.$current_job_titlej.'</td>';
    $response['html'] .='<td>£'.$current_salaryj.'</td>';
    $response['html'] .='<td>'.$availabilityj.'</td>';
    $response['html'] .='<td>'.$dis_stats.'</td>';
    $response['html'] .='<td><a href='.$view_candidate_linkj.' class="my-btn my-btn-1">View</a></td>';
    $response['html'] .='</tr>';
        

        $a++;
}
 $response['ats_job_name'] .='<h6>'.$job_ats_titlej.'</h6>';                                 
 echo json_encode($response);
    exit();
}

/**************Make offer(Employer)********************/

add_action('wp_ajax_make_offer', 'make_offer');
add_action('wp_ajax_nopriv_make_offer', 'make_offer');

function make_offer(){
   global $wpdb;
$offer_status = $_POST['status'];
$job_name = $_POST['job_title'];
$candidate_id = $_POST['row_id'];
$rec_email = $_POST['recruiter_email'];
$rec_name = get_usermeta($_POST['rec_id'],'first_name',true);
$offer_title = $job_name.''.rand();
$site_url = site_url();
if($offer_status == 'publish'){
    
    $offer_id = wp_insert_post(array(
    'post_type' => 'offers',
    'post_title' => $offer_title,
    'post_status' => 'publish',
));
    
    $cndidate_data = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$candidate_id");
    $candidate_details = unserialize($cndidate_data[0]->candidate_data);
    $candidate_name = $candidate_details['name'];
    $candidate_email = $candidate_details['email'];
    
      /***********Update status of candidate**********/

$wpdb->query("UPDATE save_candidate SET status='offer-pending' WHERE ID=$candidate_id");
        
        $rec_mail = ' <head>
   <title>New Offer Recieved</title>
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
                                <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$rec_name.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                A new offer has been made for the role of "'.$job_name.'".Kindly check and  candidate details. <br> Details are mentioned below:<br>
                                
                                </p>
                                   <div>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">Candidate Details:</p>

                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Candidate Name:</strong> '.$candidate_name.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Candidate Email:</strong> '.$candidate_email.'
                                        </p>
                                        
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                        Please check your candidate offer in dashboard and perform suitable action.
                                
                                    </p>
                                        
                                    </div>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <info@heyjobba.customerdevsites.com/>' . "\r\n";

        mail($rec_email, 'New offer Recieved',$rec_mail, $headers);
        
            
    $response['status'] = 1;
    $response['message'] = 'Offer Sent Successfully!';
    
}else if($offer_status == 'draft'){
     $offer_id = wp_insert_post(array(
    'post_type' => 'offers',
    'post_title' => $offer_title,
    'post_status' => 'draft',
)); 
    $response['status'] = 1;
    $response['message'] = 'Offer Drafted Successfully!';
}
    if($offer_id){
        /***********Candidate data for mail*****************/
        update_post_meta($offer_id,'offer_employer_id',$_POST['emp_id']);
        update_post_meta($offer_id,'offer_recruiter_id',$_POST['rec_id']);
        update_post_meta($offer_id,'offer_candidate_id',$_POST['row_id']);
        update_post_meta($offer_id,'offer_job_id',$_POST['job_id']);
        update_post_meta($offer_id,'offer_job_title',$_POST['job_title']);
        update_post_meta($offer_id,'offer_empoyment_type',$_POST['employment_type']);
        update_post_meta($offer_id,'offer_start_date',$_POST['start_date']);
        update_post_meta($offer_id,'offer_end_date',$_POST['end_date']);
        update_post_meta($offer_id,'offer_job_type',$_POST['job_type']);
        update_post_meta($offer_id,'offer_job_location',$_POST['job_location']);
        update_post_meta($offer_id,'offer_ir35_status',$_POST['ir_status']);
        update_post_meta($offer_id,'offer_basic_salary',$_POST['basic_salary']);
        update_post_meta($offer_id,'offer_bonus',$_POST['bonus']);
        update_post_meta($offer_id,'offer_notice_period',$_POST['notice_period']);
        update_post_meta($offer_id,'offer_equity',$_POST['equity']);
        update_post_meta($offer_id,'offer_healthcare',$_POST['health_type']);
        update_post_meta($offer_id,'offer_other_benifits',$_POST['other_benifits']);
        update_post_meta($offer_id,'offer_travel_required',$_POST['travel_require']);
        update_post_meta($offer_id,'offer_notes',$_POST['additonal_notes']);
        update_post_meta($offer_id,'offer_synopsis',$_POST['synopsis']);
        
      
        }else{
        $response['status'] = 0;
        $response['message'] = 'Something went wrong!';
    }
    echo json_encode($response);
    exit();
}

/***************Save Serach Criteria(Recruiter)**************************/

add_action('wp_ajax_save_search_criteria', 'save_search_criteria');
add_action('wp_ajax_nopriv_save_search_criteria', 'save_search_criteria');

function save_search_criteria(){
    global $wpdb;
if($_POST['search_value']){
      $wpdb->insert("save_search_criteria", array(
    'recruiter_id' => $_POST['rec_id'],
    'search_criteria' => $_POST['search_value'],
    )); 
    $response['status'] = 1;
    $response['message'] = 'Search Criteria Saved';
}else{
  $response['status'] = 0;
  $response['message'] = 'Something went wrong';  
}
    echo json_encode($response);
    exit();
}

/*************Sort Searched Jobs(Recruiter)*******************/

add_action('wp_ajax_sort_jobs', 'sort_jobs');
add_action('wp_ajax_nopriv_sort_jobs', 'sort_jobs');

function sort_jobs(){
   global $wpdb;
$post_dates = array();
$job_ids = explode(',',$_POST['searched_ids']);
if($_POST['order_value'] == 'date_posted'){
 
foreach($job_ids as $job_id){
  $post_dates[$job_id] = strtotime(get_the_date('Y-m-d h:i:s',$job_id));
    
}
arsort($post_dates, 1);
}else if($_POST['order_value'] == 'closing_date'){
  foreach($job_ids as $job_id){
      $end_date =  get_field('job_closing_date',$job_id);
      $close_date = date('Y-m-d h:i:s',strtotime($end_date));
  $post_dates[$job_id] = strtotime($end_date);
} 
    arsort($post_dates, 1);
}
foreach($post_dates as $key => $posted_results){
    
        $employer_id = get_field('employer_id',$key);
        $compay_name = get_field('business_name','user_'.$employer_id);
        $skills = get_field('skills',$key);
        $title = get_field('jobs_job_title',$key);
        $image = get_template_directory_uri().'/dashboard-employer/images/job-description-1.png';
        $image2 = get_template_directory_uri().'/dashboard-employer/images/job-description-2.png';
        $image3 = get_template_directory_uri().'/dashboard-employer/images/job-description-3.png';
        $salary = get_field('salary_required',$key);
        $skill = get_field('skills',$key);
        $location = get_field('jobs_job_location',$key);
        $close_date = get_field('job_closing_date',$key);
        $close_date_f = date('d.m.Y',strtotime($close_date));
        $job_cat = get_field('job_type',$key);
        $job_link = get_the_permalink($key);
       
        $response['html'].= '<a href="'.$job_link.'">'; 
        $response['html'].= '<article class="job-infor-wrapper">';
        $response['html'].= '<h4>'.$title.'</h4>';
        $response['html'].= '<p>'.$compay_name.'</p>';
        $response['html'].= '<ul class="job-details">';
        $response['html'].= '<li>';
        $response['html'].= '<span><img src="'.$image.'" alt="img"></span></li>';
        $response['html'].= '<li><span>£</span>'.$salary.'</li>';
        $response['html'].= '<li><span><img src="'.$image2.'" alt="img"></span>'.$location.'/'.$job_cat.'';
        $response['html'].= '</li>';
        $response['html'].= '<span><img src="'.$image3.'" alt="img"></span>'.$ffff;
        $response['html'].= '</li>';
        $response['html'].= '</ul>';
        $response['html'].= '<ul class="job-post-details">';
        $response['html'].= '<li>Posted 1 day ago</li>';
        $response['html'].= '<li>Closes'.$close_date_f.'</li>';
        $response['html'].= '</ul>';
        $response['html'].= '</article>';
        $response['html'].= '</a';
    }
    echo json_encode($response);
    exit();
    
}

/*******************Save Candidate Application(Recruiter)*******************************/

add_action('wp_ajax_save_candidate_application', 'save_candidate_application');
add_action('wp_ajax_nopriv_save_candidate_application', 'save_candidate_application');

function save_candidate_application(){
  global $wpdb;
  $response = array();  
if(!empty($_FILES['cv'])){
    $upload = wp_upload_bits($_FILES["cv"]["name"], null, file_get_contents($_FILES["cv"]["tmp_name"]));
    if ( ! $upload['error'] ) {
        $post_id = $post_id; //set post id to which you need to set featured image
        $filename = $upload['file'];
        $wp_filetype = wp_check_filetype($filename, null);
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

$_POST['cv_attachment_id'] = wp_insert_attachment( $attachment, $filename, $post_id );

}
}
if(!empty($_FILES['video_letter'])){
    $upload = wp_upload_bits($_FILES["video_letter"]["name"], null, file_get_contents($_FILES["video_letter"]["tmp_name"]));
    if ( ! $upload['error'] ) {
        $post_id = $post_id; //set post id to which you need to set featured image
        $filename = $upload['file'];
        $wp_filetype = wp_check_filetype($filename, null);
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

$_POST['video_letter_attachment_id'] = wp_insert_attachment( $attachment, $filename, $post_id );

}
}
if(!empty($_FILES['intro_video'])){
    $upload = wp_upload_bits($_FILES["intro_video"]["name"], null, file_get_contents($_FILES["intro_video"]["tmp_name"]));
    if ( ! $upload['error'] ) {
        $post_id = $post_id; //set post id to which you need to set featured image
        $filename = $upload['file'];
        $wp_filetype = wp_check_filetype($filename, null);
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

$_POST['intro_video_attachment_id'] = wp_insert_attachment( $attachment, $filename, $post_id );

}
}
if(!empty($_FILES['additional_info'])){
    $upload = wp_upload_bits($_FILES["additional_info"]["name"], null, file_get_contents($_FILES["additional_info"]["tmp_name"]));
    if ( ! $upload['error'] ) {
        $post_id = $post_id; //set post id to which you need to set featured image
        $filename = $upload['file'];
        $wp_filetype = wp_check_filetype($filename, null);
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

$_POST['additional_info_attachment_id'] = wp_insert_attachment( $attachment, $filename, $post_id );

}
}
 
$candidatedata = serialize($_POST);
$insert = $wpdb->insert("save_candidate",array(
        'job_id'=>$_POST['job_id'],
        'rec_id'=>$_POST['recruiter_id'],
        'emp_id'=>$_POST['emp_id'],
        'candidate_data'=>$candidatedata,
        'time_stamp'=>$_POST['time_stamp'],
        'status'=>'save',
        'stage'=>'stage0',
        'shared_status'=>0,
    ));
if($insert){
    $response['status'] = 1;
    $response['message'] = 'Candidate application saved!';   
}else{
    $response['status'] = 0;
    $response['message'] = 'Something went wrong!';    
}
    echo json_encode($response);
    exit();
}

/**************Submit Interview Timings(Employer)**************************/

add_action('wp_ajax_submit_interview_timimgs', 'submit_interview_timimgs');
add_action('$security_clearance', 'submit_interview_timimgs');

function submit_interview_timimgs(){
  global $wpdb;
    $response = array();
    $timing1 = $_POST['timing1'];
    $timing2 = $_POST['timing2'];
    $timing3 = $_POST['timing3'];
    
    $emp_id = $_POST['emp_id'];
    $cand_row_id = $_POST['row_id'];
    
    $recruiter_id = $_POST['recruiter_id'];
    
    $rec_first_name = get_user_meta($recruiter_id,'first_name',true);
    $rec_data = get_userdata($recruiter_id);
    $rec_email = $rec_data->data->user_email;
    $siteurl = site_url();
    $emp_data = get_userdata($emp_id);
    $emp_mail = $emp_data->data->user_email;
    
    $candidate_data  = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$cand_row_id");
    foreach($candidate_data as $cand_dt){
        $job_id = $cand_dt->job_id;
        $can_dt = $cand_dt->candidate_data;
        $stage = $cand_dt->stage;
    }
    $job_title = get_the_title($job_id);
    $dis_cand = unserialize($can_dt);
    $candidate_name = $dis_cand['name'];
        
    $timing1_dis = date('d,M Y g:i a',strtotime($timing1));
    $timing2_dis = date('d,M Y g:i a',strtotime($timing2));
    $timing3_dis = date('d,M Y g:i a',strtotime($timing3));
    
    $coded_time1 = base64_encode($timing1);
    $coded_time2 = base64_encode($timing2);
    $coded_time3 = base64_encode($timing3);
    
    $conf_link1 = get_the_permalink(601).'?timings='.$coded_time1.'&jb_id='.$job_id.'&rid='.$cand_row_id;
    $conf_link2 = get_the_permalink(601).'?timings='.$coded_time2.'&jb_id='.$job_id.'&rid='.$cand_row_id;
    $conf_link3 = get_the_permalink(601).'?timings='.$coded_time3.'&jb_id='.$job_id.'&rid='.$cand_row_id;
    $conf_linkno = get_the_permalink(601).'?timings=none&jb_id='.$job_id.'&rid='.$cand_row_id;
    
    $timings = array($timing1,$timing2,$timing3);
    $timing_string = implode(',',$timings);
    
    $wpdb->insert("interview_schedule",array(
        'emp_id'=>$emp_id,
        'rec_id'=>$recruiter_id,
        'interview_timings'=>$timing_string,
        'candidate_row_id'=>$cand_row_id,
    ));
    

    /****Candidates until their status is updated as interview-booked************/
    
    /********Check stage for candidate*********************/
    
    if($stage == stage0){
      $wpdb->query("UPDATE save_candidate SET status='interview-pending' WHERE ID=$cand_row_id");  
    }else{
     $wpdb->query("UPDATE save_candidate SET status='interview-ongoing' WHERE ID=$cand_row_id");    
    }
    
    
    
  $rec_match_html = ' <head>
   <title>Interview Timings</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteurl.'" target="_blank">
                                <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$rec_first_name.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family:Roboto, sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                These are the interview timings for candidate you shared with us.Please check the below details:<br>
                                
                                </p>
                                   <div>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Job Role:</strong> '.$job_title.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Candidate Name:</strong> '.$candidate_name.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Slot1:</strong> '.$timing1_dis.'
                                            <a href="'.$conf_link1.'">Click here to confirm</a>
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Slot2:</strong> '.$timing2_dis.'
                                             <a href="'.$conf_link2.'">Click here to confirm</a>
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Slot3:</strong> '.$timing3_dis.'
                                             <a href="'.$conf_link3.'">Click here to confirm</a>
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Request new interview date and times:</strong> 
                                            <a href="'.$conf_linkno.'">Click here to confirm</a>
                                        </p>
                                    </div>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <'.$emp_mail.'>' . "\r\n";

        if(wp_mail($rec_email, 'Interview Timings',$rec_match_html, $headers)){
            $response['status'] = 1;
            $response['message'] = 'Interview timings sent!';
//            $response['url'] = get_the_permalink(30);
        }else{
           $response['status'] = 0;
           $response['message'] = 'Something went wrong!'; 
        }
 echo json_encode($response);
    exit();
}

/**************Confirm Interview Timing(Recruiter)*********************************/

function selected_time($selected_time,$row_id){
  
    global $wpdb;
     $siteurl = site_url();
    $candidate_data = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$row_id");
    
    /************For last stage interview timing*********/
    
    $previous_timings = $wpdb->get_results("SELECT * FROM `interview_timing` WHERE `candidate_row_id` = $row_id");
    
    $previous_time = $previous_timings[0]->interview_time;
     $previous_stage = $previous_timings[0]->stage;
    
    $rec_id = $candidate_data[0]->rec_id;  
    $emp_id = $candidate_data[0]->emp_id;
    $timestamp = $candidate_data[0]->time_stamp;
    $job_id = $candidate_data[0]->job_id;
    $candidate_da = $candidate_data[0]->candidate_data;
    $candidate_data = unserialize($candidate_da);
    $candidate_name = $candidate_data['name'];
    $emp_name = get_user_meta($emp_id,'first_name',true);
    $emp_data = get_userdata($emp_id);
    $emp_email = $emp_data->data->user_email;
    $recruiter_data = get_userdata($rec_id);
    $rec_email = $recruiter_data->data->user_email;
    $dis_selected_time = date('d M,Y H:i A',strtotime($selected_time));
    
  /***********Check stage for interview 2 booking(Stage1)*****************/
    
    $check_candidate_exists = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$row_id");
     $exist_status = $check_candidate_exists[0]->stage;
//    $feedbacks = $wpdb->get_results("SELECT * FROM `interview-feedback` WHERE `candidate_row_id` =$row_id");
    
    if($exist_status == 'stage1'){
       

/**************Insert previous data to records***********************/
 
   $result =$wpdb->insert("interview-record",array(
        'candidate_row_id'=>$row_id,
        'rec_id'=>$rec_id,
        'emp_id'=>$emp_id,
        'stage'=>$previous_stage,
        'previous_interview_timings'=>$previous_time,
    )); 

/*********Update new timings to interview timing table********************/
        
if($result){
$update = $wpdb->query("UPDATE `interview_timing` SET `interview_time`='".$selected_time."',`stage`='stage2' WHERE `candidate_row_id` =$row_id");
        
/*************Update candidate table to stage 2***************************/   
        
$wpdb->query("UPDATE `save_candidate` SET `status`='interview-booked',`stage`='stage2' WHERE ID=$row_id");  
}

/***********Check stage for interview 3 booking(Stage2)*****************/
        
}elseif($exist_status == 'stage2'){
      
 /**************Insert previous data to records***********************/
 
$result =$wpdb->insert("interview-record",array(
        'candidate_row_id'=>$row_id,
        'rec_id'=>$rec_id,
        'emp_id'=>$emp_id,
        'stage'=>$previous_stage,
        'previous_interview_timings'=>$previous_time,
    )); 

/*********Update new timings to interview timing table********************/
if($result){
   
$update = $wpdb->query("UPDATE `interview_timing` SET `interview_time`='".$selected_time."' ,`stage`='stage3' WHERE `candidate_row_id` =$row_id");
        
/*************Update candidate table to stage 2***************************/   
        
$wpdb->query("UPDATE `save_candidate` SET `status`='interview-booked' ,`stage`='stage3' WHERE ID=$row_id");  
}
         /***********Check stage for interview 4 booking(Stage3)*****************/
        
}elseif($exist_status == 'stage3'){
    
 /**************Insert previous data to records***********************/
 
$result =$wpdb->insert("interview-record",array(
        'candidate_row_id'=>$row_id,
        'rec_id'=>$rec_id,
        'emp_id'=>$emp_id,
        'stage'=>$previous_stage,
        'previous_interview_timings'=>$previous_time,
    )); 
        


/*********Update new timings to interview timing table********************/
        
if($result){
$update = $wpdb->query("UPDATE `interview_timing` SET `interview_time`='".$selected_time."' ,`stage`='stage4' WHERE `candidate_row_id` =$row_id");
        
/*************Update candidate table to stage 4***************************/   
        
$wpdb->query("UPDATE `save_candidate` SET `status`='interview-booked' ,`stage`='stage4' WHERE ID=$row_id");  
}
        
        /**************On first booking(stage 1)****************/ 
        
}else{
        $result = $wpdb->insert("interview_timing",array(
        'candidate_row_id'=>$row_id,
        'candidate_data'=>$candidate_da,
        'rec_id'=>$rec_id,
        'emp_id'=>$emp_id,
        'interview_time'=>$selected_time,
        'stage'=>'stage1',
)); 
    if($result){
      
      $update = $wpdb->query("UPDATE save_candidate SET status='interview-booked', stage='stage1' WHERE ID=$row_id");
    } 
}
    
/*************Mail to employer***************/
    
  $html = '<head>
       <title>Interview Schedule</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$emp_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    We have confirmed the interview timings for candidate '.$candidate_name.'. 
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Timings: '.$dis_selected_time.'.
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <'.$rec_email.'>' . "\r\n";

        mail($emp_email, 'Interview Schedule',$html, $headers);
    
    if($update){ ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <script>
         toastr.success('Interview Booked for candidate!');
     </script>
    <?php    
    }
}

/*********************Request for new timings by recruiter(None)****************/

function rearrange_interview($row_id,$job_id){
   global $wpdb;
    $i = 0;
    echo $i;
    if($i==0){
 
    $result = $wpdb->query("UPDATE save_candidate SET status='rearrange-interview' WHERE ID=$row_id");
    
    $candidate_data = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$row_id");
    $siteurl = site_url();
    $emp_id = $candidate_data[0]->emp_id;
    $emp_name = get_user_meta($emp_id,'first_name',true);
    $emp_data = get_userdata($emp_id);
    $emap_mail = $emp_data->data->user_email;
    $rec_id = $candidate_data[0]->rec_id;
    $rec_data = get_userdata($rec_id);
    $rec_email = $rec_data->data->user_email;
    $candidate_profile_data = $candidate_data[0]->candidate_data;
    $candidate_display_data = unserialize($candidate_profile_data);
    $candidate_name = $candidate_display_data['name'];
    $candidate_email = $candidate_display_data['email'];
    
    $rec_match_html = '<head>
   <title>Rearrange Timings</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteurl.'" target="_blank">
                                <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$emp_name.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                We are not available for any of the timimgs you shared with us!<br>
                                
                                Please share new schedule with us.
                                </p>
                                <div>
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">Candidate Details</p>

                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Candidate Name:</strong> '.$candidate_name.'
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Email:</strong> '.$candidate_email.'
                                    </p>
                                    </div>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <'.$rec_email.'>' . "\r\n";

        wp_mail($emap_mail, 'Rearrange Interview',$rec_match_html, $headers);
        $i++;
}
    if($result){
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <script>
         toastr.success('You requested fo new timings successfully!');
     </script> 
<?php    }
}


/****************Edit Interview Timings(By employer)***************************/

add_action('wp_ajax_edit_interview_timings', 'edit_interview_timings');
add_action('wp_ajax_nopriv_edit_interview_timings', 'edit_interview_timings');

function edit_interview_timings(){
    global $wpdb;
    $response = array();
    $timing1 = $_POST['timing1'];
    $timing2 = $_POST['timing2'];
    $timing3 = $_POST['timing3'];
    
    $emp_id = $_POST['emp_id'];
    $cand_row_id = $_POST['row_id'];
    
    $recruiter_id = $_POST['recruiter_id'];
    $rec_first_name = get_user_meta($recruiter_id,'first_name',true);
    $rec_data = get_userdata($recruiter_id);
    $rec_email = $rec_data->data->user_email;
    $siteurl = site_url();
    $emp_data = get_userdata($emp_id);
    $emp_mail = $emp_data->data->user_email;
    
    $candidate_data  = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$cand_row_id");
    foreach($candidate_data as $cand_dt){
        $job_id = $cand_dt->job_id;
        $can_dt = $cand_dt->candidate_data;
    }
    $job_title = get_the_title($job_id);
    $dis_cand = unserialize($can_dt);
    $candidate_name = $dis_cand['name'];
        
    $timing1_dis = date('d,M Y g:i a',strtotime($timing1));
    $timing2_dis = date('d,M Y g:i a',strtotime($timing2));
    $timing3_dis = date('d,M Y g:i a',strtotime($timing3));
    
    
    $coded_time1 = base64_encode($timing1);
    $coded_time2 = base64_encode($timing2);
    $coded_time3 = base64_encode($timing3);
    
    $conf_link1 = get_the_permalink(601).'?timings='.$coded_time1.'&jid='.$job_id.'&r_id='.$cand_row_id;
    $conf_link2 = get_the_permalink(601).'?timings='.$coded_time2.'&jb_id='.$job_id.'&rid='.$cand_row_id;
    $conf_link3 = get_the_permalink(601).'?timings='.$coded_time3.'&jb_id='.$job_id.'&rid='.$cand_row_id;
    $conf_linkno = get_the_permalink(601).'?timings=none&jb_id='.$job_id.'&rid='.$cand_row_id;
    
    $timings = array($timing1,$timing2,$timing3);
    $timing_string = implode(',',$timings);
    
    $wpdb->query("UPDATE `interview_schedule` SET `interview_timings`='".$timing_string."' WHERE candidate_row_id = $cand_row_id");
    
    
    $wpdb->query("UPDATE save_candidate SET status='interview-pending' WHERE ID=$cand_row_id");
    
    /**** Remove previous interview timing ****/
    
//    $wpdb->query("DELETE FROM interview_timing WHERE candidate_row_id=$cand_row_id");
    
  $rec_match_html = ' <head>
   <title>Updated Interview Timings</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body>
       <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
           <tr>
               <td>
                   <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                       <tr align="center" >
                           <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                <a href="'.$siteurl.'" target="_blank">
                                <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                              </strong></td>
                       </tr>
                   </table>
                   <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                       <tr>
    <td style="padding: 0px 0 15px;">
            <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$rec_first_name.'</h4>
                           </td>
                       </tr>
                       <tr>
                          <td style="padding: 0px 0 15px;">
                               <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                               Due to some reasons,We need to change the schedule of interview.
                               These are updated interview timings for candidate you shared with us.Please check the below details:<br>
                                
                                </p>
                                   <div>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Job Role:</strong> '.$job_title.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Candidate Name:</strong> '.$candidate_name.'
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Slot1:</strong> '.$timing1_dis.'
                                            <a href="'.$conf_link1.'">Click here to confirm</a>
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Slot2:</strong> '.$timing2_dis.'
                                             <a href="'.$conf_link2.'">Click here to confirm</a>
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Slot3:</strong> '.$timing3_dis.'
                                             <a href="'.$conf_link3.'">Click here to confirm</a>
                                        </p>
                                        <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                            <strong>Request new interview date and times:</strong> 
                                            <a href="'.$conf_linkno.'">Click here to confirm</a>
                                        </p>
                                    </div>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>
    </body>';
        
//         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <'.$emp_mail.'>' . "\r\n";

        if(wp_mail($rec_email, 'Interview Timings',$rec_match_html, $headers)){
            $response['status'] = 1;
            $response['message'] = 'New interview timings has been sent.Please wait for recruiter confirmation.';
            $response['url'] = get_the_permalink(26);
        }else{
           $response['status'] = 0;
           $response['message'] = 'Something went wrong!'; 
        }
 echo json_encode($response);
    exit();
    
}

/***************Update Selected Time*************************************/

function update_selected_time($selected_time,$row_id){
    $i=0;
    global $wpdb;
    $siteurl = site_url();
    $candidate_data = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$row_id");
    $rec_id = $candidate_data[0]->rec_id;  
    $emp_id = $candidate_data[0]->emp_id; 
    $candidate_da = $candidate_data[0]->candidate_data;
    $candidate_data = unserialize($candidate_da);
    $candidate_name = $candidate_data['name'];
    $candidate_email = $candidate_data['email'];
    $emp_name = get_user_meta($emp_id,'first_name',true);
    $emp_data = get_userdata($emp_id);
    $emp_email = $emp_data->data->user_email;
    $recruiter_data = get_userdata($rec_id);
    $rec_email = $recruiter_data->data->user_email;
    $dis_selected_time = date('d M,Y',strtotime($selected_time));

    $key = 'booked_'.$row_id.'_'.$rec_id;
    
    if($i==0){
    $result = $wpdb->query("UPDATE interview_timing SET interview_time='".$selected_time."' WHERE 	candidate_row_id=$row_id");
        
        
    if($result){
      $update = $wpdb->query("UPDATE save_candidate SET status='interview-booked' WHERE ID=$row_id");
        $i++;
    }
        /**************Mail from recruiter after confirmation***************************/
        
        $html = ' <head>
       <title>Confirmaton for changed Interview Schedule</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$emp_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    We have confirmed the interview timings for candidate '.$candidate_name.'. 
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Timings: '.$dis_selected_time.'.
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <'.$rec_email.'>' . "\r\n";

        wp_mail($emp_email, 'Confirmaton for changed Interview Schedule',$html, $headers);
        
        /***********Mail to candidate for change in schedule********************/
        
        $candhtml = ' <head>
       <title>Change in Interview Schedule</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$candidate_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Your interview timings has been changed due to some reasons.Please check the new timings below:
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Timings: '.$dis_selected_time.'.
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $cand_headers  = "MIME-Version: 1.0" . "\r\n";
            $cand_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $cand_headers .= 'From: <'.$rec_email.'>' . "\r\n";

        wp_mail($candidate_email, 'Change in Interview Schedule',$candhtml, $cand_headers);
    }
    
    if($update){ ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <script>
         toastr.success('Interview schedule changed successfully!');
     </script>
    <?php    
    }
    
}

/************Trak ats(Recruiter)**************/

add_action('wp_ajax_recruiter_atstrack_candidates', 'recruiter_atstrack_candidates');
add_action('wp_ajax_nopriv_recruiter_atstrack_candidates', 'recruiter_atstrack_candidates');

function recruiter_atstrack_candidates(){
    global $wpdb;
    
    $response = array();
    $rec_id_recv = $_POST['rec_id'];
    $job_id = $_POST['job_id'];
    
    $shorlist_candidates = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `rec_id`=$rec_id_recv AND `job_id`=$job_id AND `status` NOT IN ('rejected', 'save','offer-accepted','contract-signed') AND `shared_status` = 0");
  
    $a = 1;
    foreach($shorlist_candidates as $short_candiadte){
        $can_data = $short_candiadte->candidate_data;
        $job_id = $short_candiadte->job_id;
        $job_ats_title = get_the_title($job_id);
        $row_id = $short_candiadte->ID;
        $rec_id = $short_candiadte->rec_id;
        $emp_id = $short_candiadte->emp_id;
        $stage = $short_candiadte->stage;
        $action_img = get_template_directory_uri().'/dashboard-employer/images/dots.png';
        $status = $short_candiadte->status;
        $un_can_data = unserialize($can_data);
        
        $offers = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE 'offer_candidate_id' AND `meta_value` LIKE '$row_id'");
        $offer_id = $offers[0]->post_id;
        
        $candiadte_name = $un_can_data['name'];
        $current_employer = $un_can_data['current_employer'];
        $current_job_title = $un_can_data['current_position'];
        $current_salary = $un_can_data['current_salary'];
        $availability = $un_can_data['availablity'];
        $view_candidate_link = get_the_permalink(498).'?r='.$row_id;
        $profile_img = wp_get_attachment_url($un_can_data['candidate_profile_image']);
        $candidate_profile_link = get_the_permalink(505).'?r='.$row_id;
        $contact_employer = get_the_permalink(64).'?emp_id='.$emp_id;
        $view_offer = get_the_permalink(62).'?of_d='.$offer_id;
        
        if(empty($profile_img)){
          $profile_img = get_template_directory_uri().'/images/dummy.jpg';  
        }
        
        $htmlBooked = '';
        $htmlBooked2 = '';
        $htmlBooked3 = '';
        $htmlBooked4 = '';
        $htmlARP = '';
        $offer_pending = '';
        
        if($status == 'active'){
            
           $htmlARP = '<div class="applicant-content active"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"><p><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'">View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></p></figure></div>';
            
        }else if($status == 'rearrange-interview'){
            
           $htmlARP = '<div class="applicant-content rearrange"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'">View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';  
            
        }else if($status == 'interview-pending'){
            
            $htmlARP = '<div class="applicant-content pending"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';
            
        }elseif($status == 'interview-booked' && $stage == 'stage1'){
            
            $htmlBooked = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';
            
        }elseif($status == 'interview-booked' && $stage == 'stage2'){
            
            $htmlBooked2 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';
            
        }elseif($status == 'interview-booked' && $stage == 'stage3'){
            
            $htmlBooked3 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';
            
        }elseif($status == 'interview-booked' && $stage == 'stage4'){
            
            $htmlBooked4 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';
            
        }elseif($status == 'interview-ongoing' && $stage == 'stage1'){
            
            $htmlBooked = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';
            
        }elseif($status == 'interview-ongoing' && $stage == 'stage2'){
            
            $htmlBooked2 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';
            
        }elseif($status == 'interview-ongoing' && $stage == 'stage3'){
            
            $htmlBooked3 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';
            
        }elseif($status == 'interview-ongoing' && $stage == 'stage4'){
            
            $htmlBooked4 = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li></ul></div></div>';
            
        }elseif($status == 'offer-pending'){
            
            $offer_pending = '<div class="applicant-content booked"><figure><img src="'.$profile_img.'" alt="applicant-img"></figure><div class="applicant-details"><h6>'.$candiadte_name.'</h6><p>'.$job_ats_title.'</p></div><figure class="no-match-dots"><img src="'.$action_img.'" alt="dots"></figure><div class="next-options"><ul><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$contact_employer.'">Contact Potential Employer</a></li><li><a href="'.$candidate_profile_link.'" >View Profile</a></li><li><a href="'.$view_offer.'">View offer</a></li></ul></div></div>';
            
        }
    $response['ats_html'] .='<tr>';
    $response['ats_html'] .='<td>'.$htmlARP.'</td>';
    $response['ats_html'] .='<td>'.$htmlBooked.'</td>';
    $response['ats_html'] .='<td>'.$htmlBooked2.'</td>';
    $response['ats_html'] .='<td>'.$htmlBooked3.'</td>';
    $response['ats_html'] .='<td>'.$htmlBooked4.'</td>';
    $response['ats_html'] .='<td>'.$offer_pending.'</td>';
    $response['ats_html'] .='</tr>';
        $a++;
}
 $response['ats_job_name'] .='<h6>'.$job_ats_title.'</h6>';  
    
 echo json_encode($response);
  exit();
 }

/**********Send offer to candidate(Recruiter)*********************/

add_action('wp_ajax_send_offer_to_candidate', 'send_offer_to_candidate');
add_action('wp_ajax_nopriv_send_offer_to_candidate', 'send_offer_to_candidate');

function send_offer_to_candidate(){
  global $wpdb;
$siteurl = site_url();
$candidate_id = $_POST['candidate_id'];
$offer_id = $_POST['offer_id'];
$rec_id = $_POST['rec_id'];
$recruiter_data = get_userdata($rec_id);
$rec_email = $recruiter_data->data->user_email;
$view_offer_link = get_the_permalink(703).'?of_d='.$offer_id.'&rec_id='.$rec_id;
$candidate_dt = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$candidate_id");
$candidate_data = unserialize($candidate_dt[0]->candidate_data);
$job_name = get_the_title($candidate_dt[0]->job_id);
$can_name = $candidate_data['name'];
$can_email = $candidate_data['email'];
    
$candhtml = '<head>
       <title>New Offer</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$can_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    You recieved an offer for the job role of '.$job_name.'.
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Click on the link to view offer:<a href="'.$view_offer_link.'">Click here</a>
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $cand_headers  = "MIME-Version: 1.0" . "\r\n";
            $cand_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $cand_headers .= 'From: <'.$rec_email.'>' . "\r\n";

       if(mail($can_email,'New Offer Recieved',$candhtml, $cand_headers)){
           $response['status'] = 1;
           $response['message'] = 'Offer sent Successfully!';
       }else{
          $response['status'] = 0;
           $response['message'] = 'Something went wrong!'; 
       }
    echo json_encode($response);
    exit();
    }

/************Accept Offer by candidate(Recruiter)***************/

add_action('wp_ajax_accept_offer', 'accept_offer');
add_action('wp_ajax_nopriv_accept_offer', 'accept_offer');

function accept_offer(){
  global $wpdb;
$candidate_id = $_POST['candidate_id'];
$offer_id = $_POST['offer_id'];
    
$notify_data = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$candidate_id");
    $candidate_dt = unserialize($notify_data[0]->candidate_data);
    $candidate_name = $candidate_dt['name'];
    $candidate_email = $candidate_dt['email'];
    $emp_id =  $notify_data[0]->emp_id;
    $emp_data = get_userdata($emp_id);
    $emp_mail = $emp_data->data->user_email;
    $emp_name = get_user_meta($emp_id,'first_name',true);
    $rec_id = $notify_data[0]->rec_id;
    $rec_data = get_userdata($rec_id);
    $rec_mail = $rec_data->data->user_email;
    $rec_name = get_user_meta($rec_id,'first_name',true);
    $siteurl = site_url();
    
if(!empty($candidate_id)){
    /*******Update status to contact-pending************/
    
$wpdb->query("UPDATE save_candidate SET status= 'offer-accepted' WHERE ID=$candidate_id");
    
    /*****************Mail to employer************************/
update_post_meta($offer_id,'accept_reject','Accept');   
    $emphtml = '<head>
       <title>Offer Accepted</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$emp_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Your offer has been accepted by the candidate.Please check candidate details:
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Candidate Name: '.$candidate_name.'.<br>
                                    Candidate Email: '.$candidate_email.'.<br>
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $emp_headers  = "MIME-Version: 1.0" . "\r\n";
            $emp_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $emp_headers .= 'From: <info@heyjobba.customerdevsites.com>' . "\r\n";

       wp_mail($emp_mail,'Offer Accepted',$emphtml, $emp_headers);
    
/******************Mail to recruiter****************/
    
    $rechtml = '<head>
       <title>Offer Accepted</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$rec_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    An offer has been accepted by your candidate.Please check the candidate details below:
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Candidate Name: '.$candidate_name.'.<br>
                                    Candidate Email: '.$candidate_email.'.<br>
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $rec_headers  = "MIME-Version: 1.0" . "\r\n";
            $rec_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $rec_headers .= 'From: <info@heyjobba.customerdevsites.com>' . "\r\n";

       wp_mail($rec_mail,'Offer Accepted',$rechtml, $rec_headers); 
    
    $response['status'] = 1;
    $response['message'] = "Offer Accepted!";
}else{
   $response['status'] = 0;
    $response['message'] = "Something went wrong!"; 
}
 echo json_encode($response);
exit();
}


/***************Reject offer(Recruiter)*************/

add_action('wp_ajax_reject_offer', 'reject_offer');
add_action('wp_ajax_nopriv_reject_offer', 'reject_offer');

function reject_offer(){
    global $wpdb;
    $response = array();
    
$candidate_id = $_POST['candidate_id'];
$candidate_data = $wpdb->get_results("SELECT 'candidate_data' FROM 'save_candidate' WHERE ID=$candidate_id");
$candidate_dt = unserialize($candidate_data);
$candidate_name = $candidate_dt['name'];
$rejection_reason = $_POST['offer_rejection_reason'];
$emp_id = $_POST['emp_id'];
$emp_name = get_user_meta($emp_id,'first_name',true);
$emp_data = get_userdata($emp_id);
$emp_email = $emp_data->data->user_email;
$offer_id = $_POST['offer_id'];
$siteurl = site_url();

if(!empty($rejection_reason)){
    /**************update candidate status and insert to reject offer***********************/
    
update_post_meta($offer_id,'accept_reject','reject');

$wpdb->query("UPDATE `save_candidate` SET `status`='offer-rejected' WHERE ID=$candidate_id");
    
    
$wpdb->insert("reject_offer",array(
    'candidate_row_id'=>$candidate_id,
    'emp_id'=>$emp_id,
    'offer_id'=>$offer_id,
));
    /************Mail to employer***************************/

    $html = '<head>
       <title>Offer Rejected</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$emp_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                     Your Offer has been rejected by the candidate.Please check the candidate details below:
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Candidate Name: '.$candidate_name.'.<br>
                                    Rejection Reason: '.$rejection_reason.'.<br>
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <info@heyjobba.customerdevsites.com>' . "\r\n";

       wp_mail($emp_email,'Offer Rejected',$html, $headers); 
        $response['status'] = 1;
        $response['message'] = 'Offer Rejected!';
    
}else{
   $response['status'] = 0;
    $response['message'] = 'Something went wrong!'; 
}
    echo json_encode($response);
    exit();
}

/****************Create job alert for recruiter***********************/

add_action('wp_ajax_create_job_alert', 'create_job_alert');
add_action('wp_ajax_nopriv_create_job_alert', 'create_job_alert');

function create_job_alert(){
    global $wpdb;
    
    $response = array();
    $id = (int)$_POST['id'];
    $date = date('Y-m-d H:i:s');
    
    $result = $wpdb->insert("job_alerts",array(
        'date_time'=>$date,
        'send_alert'=>'true',
        'user_id'=>$id,
    ));
    
    if($result){
        $response['status'] = 1;
        $response['message'] = 'Alert created successfully.';
    }else{
        $response['status'] = 0;
        $response['message'] = 'ERROR: creating alert.';
    }
    
    echo json_encode($response);
    exit();
}


/****************Stop job alert********************/

add_action('wp_ajax_stop_job_alert', 'stop_job_alert');
add_action('wp_ajax_nopriv_stop_job_alert', 'stop_job_alert');

function stop_job_alert(){
    global $wpdb;
    
    $response = array();
    $id = (int)$_POST['id'];
    $date = date('Y-m-d H:i:s');
    
    $result = $wpdb->query("DELETE FROM job_alerts WHERE ID=$id");
    
    if($result){
        $response['status'] = 1;
        $response['message'] = 'Alert stoped successfully.';
    }else{
        $response['status'] = 0;
        $response['message'] = 'ERROR: stop alert.';
    }
    
    echo json_encode($response);
    exit();
}


function send_job_alert($postTitle){
    global $wpdb;
    
    $jobAlerts = $wpdb->get_results("SELECT * FROM job_alerts");
    foreach($jobAlerts as $alerts){
        $keywords = $wpdb->get_results("SELECT * FROM save_search_criteria WHERE search_criteria LIKE '%".$postTitle."%'");

        if(!empty($keywords)){
            $userData = get_userdata($alerts->user_id);
            $userEmail = $userData->user_email;
            $userName = get_user_meta($alerts->user_id,'first_name',true).' '.get_user_meta($alerts->user_id,'last_name',true);
                $html = '<head>
       <title>Offer Rejected</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$userName.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                     New job has been posted by employeer.
                                    </p>
                                    
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

        //Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
        $headers .= 'From: <info@heyjobba.customerdevsites.com>' . "\r\n";

        wp_mail($userEmail,'Job alert',$html, $headers); 
        }
    }
}

/****************Share Shortlist for collabration**********************/

add_action('wp_ajax_share_shortlist_collab', 'share_shortlist_collab');
add_action('wp_ajax_nopriv_share_shortlist_collab', 'share_shortlist_collab');

function share_shortlist_collab(){
  global $wpdb;
    $response = array();
    $shortlisted_shared = $_POST['share_shortlist_email'];
    $shortlisted_candidate_ids = $_POST['row_id'];
    $shortlisted_candidate_ids_array = explode(',',$shortlisted_candidate_ids);
    $siteurl = site_url();
    $tested = 'heemadri.sharma@imarkinfotech.com';
    $emp_id = $_POST['emp_id'];
    $emp_name = get_user_meta($emp_id,'first_name',true);
    
    if(!email_exists($shortlisted_shared)){
        $username = substr($_POST['share_shortlist_email'],0,strpos($_POST['share_shortlist_email'],'@'));
       $password = rand();
        $user_id = wp_create_user( $username, $password, $shortlisted_shared );
        $u = new WP_User($user_id);

        // Remove role
        $u->remove_role( 'subscriber' );
        
        // Add role
        $u->add_role('employee');
        
        $code = md5(time());
        $activation_string = array('id'=>$user_id,'code'=>$code);
        $activation_key = site_url().'/?key='.base64_encode(serialize($activation_string));
        update_user_meta($user_id,'activation_code',$code);

        /***********Get candidate date using listed ids***************/
        
    foreach($shortlisted_candidate_ids_array as $shortlisted_id){
      $shorlisted_candidates_data = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `ID` = $shortlisted_id");
        $shortlisted_candidate_rec_ids = $shorlisted_candidates_data[0]->rec_id;
         $shortlisted_candidate_jbs = $shorlisted_candidates_data[0]->job_id;
         $shortlisted_candidate_data = $shorlisted_candidates_data[0]->candidate_data;
         $shortlisted_candidate_timestamp = $shorlisted_candidates_data[0]->time_stamp;
         $shortlisted_candidate_stage = $shorlisted_candidates_data[0]->stage;
         $shortlisted_candidate_status = $shorlisted_candidates_data[0]->status;
        
        /********Insert all candidates with shared email as employer**********/
        
        $wpdb->insert('save_candidate',array(
            'job_id'=>$shortlisted_candidate_rec_ids,
            'rec_id'=>$user_id,
            'emp_id'=>$user_id,
            'candidate_data'=>$shortlisted_candidate_data,
            'time_stamp'=>$shortlisted_candidate_timestamp,
            'status'=>$shortlisted_candidate_status,
            'stage'=>$shortlisted_candidate_stage,
            'shared_status'=>1,
            
        ));
    }
       $html = '<head>
       <title>Candidates Shortlist</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$username.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Welcome to HeyJobba!<br>
                                    Your friend '.$emp_name.' shared a shortlist of candidates with you. Please check shortlisted candidates on jobba platform by activating your account.<br>
                                    Click here<a href="'.$activation_key.'">to activate your account!<br>
                                    
                                    Login details:<br>
                                    Username: '.$username.'<br>
                                    Password: '.$password.'<br>
                                    
                                    </p>
                                    
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

        //Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
        $headers .= 'From: <info@heyjobba.customerdevsites.com>' . "\r\n";

        wp_mail($shortlisted_shared,'New Shortlist Shared',$html, $headers); 
        $response['status'] = 1;
        $response['meassge'] = "User created!!Email has sent to user with credentials and shortlist candidates.";

    }else{
        $user = get_user_by( 'email',$shortlisted_shared);
        $userId = $user->ID;
        $user_first_name = get_user_meta($userId,'first_name',true);
        $user_meta = get_userdata($userId);
        $user_roles = $user_meta->roles[0];
        
        if($user_roles == 'employee'){
            /***********Get candidate date using listed ids***************/

        foreach($shortlisted_candidate_ids_array as $shortlisted_id){
          $shorlisted_candidates_data = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE `ID` = $shortlisted_id");
            $shortlisted_candidate_rec_ids = $shorlisted_candidates_data[0]->rec_id;
             $shortlisted_candidate_jbs = $shorlisted_candidates_data[0]->job_id;
             $shortlissted_candidate_data = $shorlisted_candidates_data[0]->candidate_data;
             $shortlisted_candidate_timestamp = $shorlisted_candidates_data[0]->time_stamp;
             $shortlisted_candidate_stage = $shorlisted_candidates_data[0]->stage;
             $shortlisted_candidate_status = $shorlisted_candidates_data[0]->status;
            
            $wpdb->insert('save_candidate',array(
            'job_id'=>$shortlisted_candidate_jbs,
            'rec_id'=>$userId,
            'emp_id'=>$userId,
            'candidate_data'=>$shortlissted_candidate_data,
            'time_stamp'=>$shortlisted_candidate_timestamp,
            'status'=>$shortlisted_candidate_status,
            'stage'=>$shortlisted_candidate_stage,
            'shared_status'=>1,
            
        ));
            
        } 
        $html = '<head>
       <title>Candidates Shortlist</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$user_first_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    Your friend '.$emp_name.' shared a shortlist of candidates with you. Please check shortlisted candidates on jobba platform<br>
                                    </p>
                                    
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

        //Always set content-type when sending HTML email
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
        $headers .= 'From: <info@heyjobba.customerdevsites.com>' . "\r\n";

        wp_mail($tested,'New Shortlist Shared',$html, $headers); 
        }else{
            $response['status'] = 0;
            $response['meassge'] = "Invalid User";
        }
        $response['status'] = 1;
        $response['meassge'] = "Shortlist Shared!";
     }
    echo json_encode($response);
    exit();
}

/***********Submit feedback for candidate******************/

add_action('wp_ajax_give_feedback', 'give_feedback');
add_action('wp_ajax_nopriv_give_feedback', 'give_feedback');

function give_feedback(){
  global $wpdb;
    $response = array();
    $candi_id = $_POST['row_id'];
    $stage_for_candidate = $wpdb->get_results("SELECT `stage` FROM `save_candidate` WHERE `ID` = $candi_id");
    $stage_for_feedback_submitted = $stage_for_candidate[0]->stage;
    
    if(!empty($_POST['feedback'])){
      $wpdb->insert("interview-feedback",array(
        'feedback_content'=>$_POST['feedback'],
        'candidate_row_id'=>$_POST['row_id'],
        'stage'=>$stage_for_feedback_submitted,
      )); 
        $response['status'] = 1;
        $response['message'] = "Feedback Submitted!";
    }else{
       $response['status'] = 0;
        $response['message'] = "Something went wrong!"; 
    }
    echo json_encode($response);
    exit();
}

/***********Contract direct to candidate/recruiter*****************/

add_action('wp_ajax_direct_contract', 'direct_contract');
add_action('wp_ajax_nopriv_direct_contract', 'direct_contract');

function direct_contract(){
  global $wpdb;
    $cand_id = $_POST['cand_id'];
    $emp_id = $_POST['emp_id'];
    
    $candidate_data = $wpdb->get_results("SELECT * FROM `save_candidate` WHERE ID=$cand_id");
    $rec_id = $candidate_data[0]->rec_id;

    $siteurl = site_url();
    $confirmation_link = get_the_permalink(771).'/?can_id='.$cand_id.'&emp_id='.$emp_id.'&rec_id='.$rec_id;
    $rec_name = get_user_meta($rec_id,'first_name',true);
    $rec_email = get_user_meta($rec_id,'email',true);
    
    $emp_mail = get_user_meta($emp_id,'email',true);
    
    /*******Insert to contract accept table***************/
    
    $wpdb->insert("contract_accept",array(
        'emp_id'=>$emp_id,
        'candidate_row_id'=>$cand_id,
        'rec_id'=>$rec_id,
        'confirmation_status'=>'not-accepted',
    
    ));
    
    
    /**************Confirmation Mail to recruiter***********************/
    
    $confirmhtml = '<head>
       <title>Contract Confirmation</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$rec_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    This is a confirmation mail regarding accepting the contract by your candidate.Please click the below link and confirm that you have recieved the contract.<br>
                                    </p>
                                    <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    <a href="'.$confirmation_link.'">Click here</a>
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $cand_headers  = "MIME-Version: 1.0" . "\r\n";
            $cand_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $cand_headers .= 'From: <'.$emp_mail.'>' . "\r\n";
    
  if(wp_mail($rec_email,'Confirmation Contract',$confirmhtml,$cand_headers)){
      $response['status'] = 1;
      $response['message'] = "Email sent to recruiter";
  }else{
     $response['status'] = 0;
      $response['message'] = "Something went wrong!"; 
  }
    echo json_encode($response);
    exit();
}

/*************Thankyou for confirmation******************/

function confirm_contract($cand_id,$emp_id,$rec_id){
    global $wpdb;
    
    $emp_name = get_user_meta($emp_id,'first_name',true);
    $emp_email = get_user_meta($emp_id,'email',true);
    
    $rec_name = get_user_meta($rec_id,'first_name',true);
    $rec_email = get_user_meta($rec_id,'email',true);
    
    $siteurl = site_url();
    $wpdb->query("UPDATE `contract_accept` SET `confirmation_status`='accepted' WHERE candidate_row_id=$cand_id");
    
    $wpdb->query("UPDATE `save_candidate` SET `status`='contract-signed' WHERE ID=$cand_id");
    
        $confirmhtml = '<head>
       <title>Contract Accepted Confirmation</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$emp_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    This is confirmation mail that your offer and contract has been signed by the candidate.You have to make the payment within 14 calender days of the candidate starting the job.
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $cand_headers  = "MIME-Version: 1.0" . "\r\n";
            $cand_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $cand_headers .= 'From:<info@heyjobba.customerdevsites.com>' . "\r\n";
    
  wp_mail($emp_email,'Confirmation Contract',$confirmhtml,$cand_headers);
  
    /************Mail to recruiter********************/
    
    $confirmrechtml = '<head>
       <title>Contract Accepted Confirmation</title>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        </head>

        <body>
           <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
               <tr>
                   <td>
                       <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                           <tr align="center" >
                               <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                                    <a href="'.$siteurl.'" target="_blank">
                                    <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                                  </strong></td>
                           </tr>
                       </table>
                       <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                           <tr>
        <td style="padding: 0px 0 15px;">
                <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$rec_name.'</h4>
                               </td>
                           </tr>
                           <tr>
                              <td style="padding: 0px 0 15px;">
                                   <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                    This is confirmation mail that your candidate has accepted the offer and contract has been signed by the.
                                    </p>
                               </td>
                           </tr>
                       </table>
                   </td>
               </tr>
           </table>
        </body>';

    //         Always set content-type when sending HTML email
            $cand_recheaders  = "MIME-Version: 1.0" . "\r\n";
            $cand_recheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $cand_recheaders .= 'From:<info@heyjobba.customerdevsites.com>' . "\r\n";
    
  wp_mail($rec_email,'Confirmation Contract',$confirmrechtml,$cand_recheaders);
    
 ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script>
     setTimeout(function(){
         toastr.success('You have confirmed that candidate have recieved the contract!'); 
     },1000);
    
 </script>
<?php 
    } 

