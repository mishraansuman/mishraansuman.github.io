<?php
/**
 * This file adds functions to the Greenshift theme for WordPress.
 *
 * @package Greenshift
 * @author  Wpsoul
 * @license GNU General Public License v2 or later
 * @link    https://greenshiftwp.com/
 */

if ( !defined( 'GREENSHIFT_THEME_VERSION' ) ) {
	define('GREENSHIFT_THEME_VERSION', '0.1');
}
if ( !defined( 'GREENSHIFT_THEME_DIR' ) ) {
	define('GREENSHIFT_THEME_DIR', get_template_directory_uri());
}
if ( !defined( 'GREENSHIFT_THEME_PATH' ) ) {
	define('GREENSHIFT_THEME_PATH', get_template_directory());
}
add_filter( 'should_load_separate_core_block_assets', '__return_true' );


//////////////////////////////////////////////////////////////////
// Register assets
//////////////////////////////////////////////////////////////////

add_action('init', 'greenshift_theme_register_assets');
function greenshift_theme_register_assets(){

	//Main styles
	wp_register_style( 'greenshift-style', GREENSHIFT_THEME_DIR . '/assets/style.min.css', array(), GREENSHIFT_THEME_VERSION );

	//Conditional scripts

	//Sticky header
	wp_register_style('greenshift-stickyheader', GREENSHIFT_THEME_DIR . '/assets/sticky/style.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_script('greenshift-stickyheader', GREENSHIFT_THEME_DIR . '/assets/sticky/index.min.js', array(), GREENSHIFT_THEME_VERSION, true);

	//Floating search
	wp_register_script('greenshift-floating-search', GREENSHIFT_THEME_DIR . '/assets/floatingsearch/index.min.js', array(), GREENSHIFT_THEME_VERSION, true);
	wp_register_style('greenshift-floating-search', GREENSHIFT_THEME_DIR . '/assets/floatingsearch/style.css', array(), GREENSHIFT_THEME_VERSION);

	//menu
	wp_register_script('greenshift-mega-menu', GREENSHIFT_THEME_DIR . '/assets/menu/index.min.js', array(), GREENSHIFT_THEME_VERSION, true);

	//Page progressbar
	wp_register_script('greenshift-progressbar', GREENSHIFT_THEME_DIR . '/assets/progressbar/index.min.js', array(), GREENSHIFT_THEME_VERSION, true);

	//TO TOP
	wp_register_script('greenshift-totop-init', GREENSHIFT_THEME_DIR . '/assets/totop/index.min.js', array(), GREENSHIFT_THEME_VERSION, true);

	//Core styles
	wp_register_style('greenshift_core_separator', GREENSHIFT_THEME_DIR . '/assets/coreblocks/separator.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_button', GREENSHIFT_THEME_DIR . '/assets/coreblocks/button.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_author', GREENSHIFT_THEME_DIR . '/assets/coreblocks/author.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_code', GREENSHIFT_THEME_DIR . '/assets/coreblocks/code.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_comments', GREENSHIFT_THEME_DIR . '/assets/coreblocks/comments.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift-comment-query', GREENSHIFT_THEME_DIR . '/assets/coreblocks/commentquery.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift-minicart', GREENSHIFT_THEME_DIR . '/assets/coreblocks/minicart.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_navigation', GREENSHIFT_THEME_DIR . '/assets/coreblocks/navigation.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_pullquote', GREENSHIFT_THEME_DIR . '/assets/coreblocks/pullquote.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_quote', GREENSHIFT_THEME_DIR . '/assets/coreblocks/quote.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_table', GREENSHIFT_THEME_DIR . '/assets/coreblocks/table.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_query', GREENSHIFT_THEME_DIR . '/assets/coreblocks/query.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_search', GREENSHIFT_THEME_DIR . '/assets/coreblocks/search.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_querypagination', GREENSHIFT_THEME_DIR . '/assets/coreblocks/querypagination.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift_core_postnavigation', GREENSHIFT_THEME_DIR . '/assets/coreblocks/postnavigation.css', array(), GREENSHIFT_THEME_VERSION);
	wp_register_style('greenshift-mega-menu', GREENSHIFT_THEME_DIR . '/assets/coreblocks/megamenu.css', array(), GREENSHIFT_THEME_VERSION);

}


//////////////////////////////////////////////////////////////////
// Register theme support functions
//////////////////////////////////////////////////////////////////

add_action( 'after_setup_theme', 'greenshift_theme_setuphooks' );
if ( ! function_exists( 'greenshift_theme_setuphooks' ) ) {
	function greenshift_theme_setuphooks() {

		// Make theme available for translation.
		load_theme_textdomain( 'greenshift', GREENSHIFT_THEME_PATH . '/languages' );

		//responsive iframes
		add_theme_support( 'responsive-embeds' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles and fonts.
		add_editor_style(
			array(
				'./assets/editor.css'
			)
		);

		//WP supports
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
			]
		);

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

		//add conditional assets to core blocks
		wp_enqueue_block_style( 'core/separator', array('handle'=>'greenshift_core_separator', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/separator.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/button', array('handle'=>'greenshift_core_button', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/button.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/post-author', array('handle'=>'greenshift_core_author', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/author.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/code', array('handle'=>'greenshift_core_code', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/code.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/preformatted', array('handle'=>'greenshift_core_code', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/code.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/comments', array('handle'=>'greenshift_core_comments', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/comments.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/comments-query-loop', array('handle'=>'greenshift-comment-query', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/commentquery.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/navigation', array('handle'=>'greenshift_core_navigation', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/navigation.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/pullquote', array('handle'=>'greenshift_core_pullquote', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/pullquote.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/quote', array('handle'=>'greenshift_core_quote', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/quote.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/table', array('handle'=>'greenshift_core_table', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/table.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/query', array('handle'=>'greenshift_core_query', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/query.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/search', array('handle'=>'greenshift_core_search', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/search.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/query-pagination-numbers', array('handle'=>'greenshift_core_querypagination', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/querypagination.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'core/post-navigation-link', array('handle'=>'greenshift_core_postnavigation', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/postnavigation.css', 'version'=> GREENSHIFT_THEME_VERSION) );
		wp_enqueue_block_style( 'woocommerce/mini-cart-contents', array('handle'=>'greenshift-minicart', 'path'=>GREENSHIFT_THEME_PATH .'/assets/coreblocks/minicart.css', 'version'=> GREENSHIFT_THEME_VERSION) );

	}
}


//////////////////////////////////////////////////////////////////
//Assets Render
//////////////////////////////////////////////////////////////////

// Frontend assets
add_action( 'wp_enqueue_scripts', 'greenshift_theme_enqueue_style_sheet' );
function greenshift_theme_enqueue_style_sheet() {

	//global styles
	wp_enqueue_style( 'greenshift-style');

}

// Editor assets
add_action('enqueue_block_editor_assets', 'greenshift_theme_editor_assets');
function greenshift_theme_editor_assets()
{

	$index_asset_file = include(GREENSHIFT_THEME_PATH . '/build/index.asset.php');

	// Gutenberg Sidebar plugin
	wp_enqueue_script(
		'greenshifttheme-editor-js', // Handle.
		GREENSHIFT_THEME_DIR . '/build/index.js',
		$index_asset_file['dependencies'],
		$index_asset_file['version'],
		true
	);

}


//////////////////////////////////////////////////////////////////
//Includes
//////////////////////////////////////////////////////////////////

// Include block styles.
require GREENSHIFT_THEME_PATH . '/inc/block-styles.php';

// Include block patterns.
require GREENSHIFT_THEME_PATH . '/inc/block-patterns.php';

// Include Woocommerce
if (class_exists('Woocommerce')) {
require GREENSHIFT_THEME_PATH . '/inc/woocommerce/functions.php';
}


//////////////////////////////////////////////////////////////////
// Filters
//////////////////////////////////////////////////////////////////

//Default blank template
add_filter( 'block_editor_settings_all', function( $settings ) {
    $settings['defaultBlockTemplate'] = '
	<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"50px","bottom":"50px","right":"0","left":"0"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"contrastcolor","textColor":"basecolor","className":"site-content"} -->
<main class="wp-block-group site-content has-basecolor-color has-contrastcolor-background-color has-text-color has-background" style="margin-top:0;margin-bottom:0;padding-top:50px;padding-right:0;padding-bottom:50px;padding-left:0">
		<!-- wp:group {"layout":{"inherit":true}} -->
		<div class="wp-block-group">
			<!-- wp:post-title {"level":1,"fontSize":"x-large"} /-->
		</div>
		<!-- /wp:group -->
		<!-- wp:post-content {"align":"full","layout":{"inherit":true}} /-->
	</main>
	<!-- /wp:group -->
';
	return $settings;
});


//////////////////////////////////////////////////////////////////
// Recommended plugins
//////////////////////////////////////////////////////////////////

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'greenshift_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
if( !function_exists('greenshift_register_required_plugins') ) {
function greenshift_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
		array(
			'name' => 'Greenshift - page builder',
			'slug' => 'greenshift-animation-and-page-builder-blocks',
			'required' => false,
			'description' => 'Page builder for Gutenberg',
		), 
    );         

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'greenshift',            // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'greenshift' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'greenshift' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'greenshift' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'greenshift' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'greenshift' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s. Please, activate only those plug-ins which are necessary to you', 'greenshift' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'greenshift' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'greenshift' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'greenshift' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'greenshift' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'greenshift' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'greenshift' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'greenshift' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'greenshift' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer and Activate plugins', 'greenshift' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'greenshift' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'greenshift' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
}

/**
 * Include theme menu.
 */
require_once dirname( __FILE__ ) . '/inc/admin_menu/index.php';