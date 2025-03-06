<?php
/*
 * The header for our theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
?><!DOCTYPE html>
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php
$manit_viewport = cs_get_option( 'theme_responsive' );
if( !$manit_viewport ) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php } $manit_all_element_color  = cs_get_customize_option( 'all_element_colors' ); ?>
<meta name="msapplication-TileColor" content="<?php echo esc_attr( $manit_all_element_color ); ?>">
<meta name="theme-color" content="<?php echo esc_attr( $manit_all_element_color ); ?>">
<link rel="profile" href="//gmpg.org/xfn/11">
<?php
 echo manit_header_function();