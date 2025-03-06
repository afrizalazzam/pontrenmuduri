<?php
/*
 * Manit Theme's Functions
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Define - Folder Paths
 */

define( 'MANIT_THEMEROOT_URI', get_template_directory_uri() );
define( 'MANIT_CSS', MANIT_THEMEROOT_URI . '/assets/css' );
define( 'MANIT_IMAGES', MANIT_THEMEROOT_URI . '/assets/images' );
define( 'MANIT_SCRIPTS', MANIT_THEMEROOT_URI . '/assets/js' );
define( 'MANIT_FRAMEWORK', get_template_directory() . '/includes' );
define( 'MANIT_LAYOUT', get_template_directory() . '/theme-layouts' );
define( 'MANIT_CS_IMAGES', MANIT_THEMEROOT_URI . '/includes/theme-options/framework-extend/images' );
define( 'MANIT_CS_FRAMEWORK', get_template_directory() . '/includes/theme-options/framework-extend' ); // Called in Icons field *.json
define( 'MANIT_ADMIN_PATH', get_template_directory() . '/includes/theme-options/cs-framework' ); // Called in Icons field *.json

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$manit_theme_child = wp_get_theme();
	$manit_get_parent = $manit_theme_child->Template;
	$manit_theme = wp_get_theme($manit_get_parent);
} else { // Parent Theme Active
	$manit_theme = wp_get_theme();
}
define('MANIT_NAME', $manit_theme->get( 'Name' ));
define('MANIT_VERSION', $manit_theme->get( 'Version' ));
define('MANIT_BRAND_URL', $manit_theme->get( 'AuthorURI' ));
define('MANIT_BRAND_NAME', $manit_theme->get( 'Author' ));

/**
 * All Main Files Include
 */
require_once( MANIT_FRAMEWORK . '/init.php' );

/**
 * thumbnail size
 */
add_image_size( 'manit-post-image-one', 415, 450, true );