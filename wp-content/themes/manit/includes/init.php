<?php
/*
 * All Manit Theme Related Functions Files are Linked here
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/* Theme All Manit Setup */
require_once( MANIT_FRAMEWORK . '/theme-support.php' );
require_once( MANIT_FRAMEWORK . '/backend-functions.php' );
require_once( MANIT_FRAMEWORK . '/frontend-functions.php' );
require_once( MANIT_FRAMEWORK . '/enqueue-files.php' );
require_once( MANIT_CS_FRAMEWORK . '/custom-style.php' );
require_once( MANIT_CS_FRAMEWORK . '/config.php' );

/* Install Plugins */
require_once( MANIT_FRAMEWORK . '/theme-options/plugins/activation.php' );

/* Breadcrumbs */
require_once( MANIT_FRAMEWORK . '/theme-options/plugins/breadcrumb-trail.php' );

/* Aqua Resizer */
require_once( MANIT_FRAMEWORK . '/theme-options/plugins/aq_resizer.php' );

/* Bootstrap Menu Walker */
require_once( MANIT_FRAMEWORK . '/core/wp_bootstrap_navwalker.php' );

/* Sidebars */
require_once( MANIT_FRAMEWORK . '/core/sidebars.php' );

if ( class_exists( 'WooCommerce' ) ) :
	require_once( MANIT_FRAMEWORK . '/woocommerce-extend.php' );
endif;