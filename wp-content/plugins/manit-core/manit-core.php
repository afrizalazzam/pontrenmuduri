<?php
/*
Plugin Name: Manit Core
Plugin URI: http://themeforest.net/user/wpoceans
Description: Plugin to contain shortcodes and custom post types of the manit theme.
Author: wpoceans
Author URI: http://themeforest.net/user/wpoceans/portfolio
Version: 1.0
Text Domain: manit-core
*/

if( ! function_exists( 'manit_block_direct_access' ) ) {
	function manit_block_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Forbidden' );
		}
	}
}

// Plugin URL
define( 'MANIT_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

// Plugin PATH
define( 'MANIT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'MANIT_PLUGIN_ASTS', MANIT_PLUGIN_URL . 'assets' );
define( 'MANIT_PLUGIN_IMGS', MANIT_PLUGIN_ASTS . '/images' );
define( 'MANIT_PLUGIN_INC', MANIT_PLUGIN_PATH . 'include' );

// DIRECTORY SEPARATOR
define ( 'DS' , DIRECTORY_SEPARATOR );

// Manit Elementor Shortcode Path
define( 'MANIT_EM_SHORTCODE_BASE_PATH', MANIT_PLUGIN_PATH . 'elementor/' );
define( 'MANIT_EM_SHORTCODE_PATH', MANIT_EM_SHORTCODE_BASE_PATH . 'widgets/' );

/**
 * Check if Codestar Framework is Active or Not!
 */
function manit_framework_active() {
  return ( defined( 'CS_VERSION' ) ) ? true : false;
}

/* MANIT_THEME_NAME_PLUGIN */
define('MANIT_THEME_NAME_PLUGIN', 'Manit' );

// Initial File
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('manit-core/manit-core.php')) {

	// Custom Post Type
  require_once( MANIT_PLUGIN_INC . '/custom-post-type.php' );

  if ( is_plugin_active('kingcomposer/kingcomposer.php') ) {

    define( 'MANIT_KC_SHORTCODE_BASE_PATH', MANIT_PLUGIN_PATH . 'kc/' );
    define( 'MANIT_KC_SHORTCODE_PATH', MANIT_KC_SHORTCODE_BASE_PATH . 'shortcodes/' );
    // Shortcodes
    require_once( MANIT_KC_SHORTCODE_BASE_PATH . '/kc-setup.php' );
    require_once( MANIT_KC_SHORTCODE_BASE_PATH . '/library.php' );
  }

  // Theme Custom Shortcode
  require_once( MANIT_PLUGIN_INC . '/custom-shortcodes/theme-shortcodes.php' );
  require_once( MANIT_PLUGIN_INC . '/custom-shortcodes/custom-shortcodes.php' );

  // Importer
  require_once( MANIT_PLUGIN_INC . '/demo/importer.php' );


  if (class_exists('WP_Widget') && is_plugin_active('codestar-framework/cs-framework.php') ) {
    // Widgets

    require_once( MANIT_PLUGIN_INC . '/widgets/nav-widget.php' );
    require_once( MANIT_PLUGIN_INC . '/widgets/recent-posts.php' );
    require_once( MANIT_PLUGIN_INC . '/widgets/recent-case.php' );
    require_once( MANIT_PLUGIN_INC . '/widgets/text-widget.php' );
    require_once( MANIT_PLUGIN_INC . '/widgets/widget-extra-fields.php' );

    // Elementor
    if(file_exists( MANIT_EM_SHORTCODE_BASE_PATH . '/em-setup.php' ) ){
      require_once( MANIT_EM_SHORTCODE_BASE_PATH . '/em-setup.php' );
      require_once( MANIT_EM_SHORTCODE_BASE_PATH . 'lib/fields/icons.php' );
      require_once( MANIT_EM_SHORTCODE_BASE_PATH . 'lib/icons-manager/icons-manager.php' );
    }
  }

  add_action('wp_enqueue_scripts', 'manit_plugin_enqueue_scripts');
  function manit_plugin_enqueue_scripts() {
    wp_enqueue_script('plugin-scripts', MANIT_PLUGIN_ASTS.'/plugin-scripts.js', array('jquery'), '', true);
  }

}

// Extra functions
require_once( MANIT_PLUGIN_INC . '/theme-functions.php' );