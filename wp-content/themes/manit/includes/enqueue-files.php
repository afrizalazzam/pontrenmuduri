<?php
/*
 * All CSS and JS files are enqueued from this file
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Enqueue Files for FrontEnd
 */
function manit_google_font_url() {
    $font_url = '';
    if ( 'off' !== esc_html__( 'on', 'manit' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Inter:wght@400;500;600;700&display=swap' ), "//fonts.googleapis.com/css2" );
    }
     return str_replace( array("%3A","%40", "%3B", "%26", "%3D"), array(":", "@", ";", "&", "="), $font_url );
}

function manit_heading_google_font_url() {
    $font_url = '';
    if ( 'off' !== esc_html__( 'on', 'manit' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'DM Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap' ), "//fonts.googleapis.com/css2" );
    }
     return str_replace( array("%3A","%40", "%3B", "%26", "%3D"), array(":", "@", ";", "&", "="), $font_url );
}

if ( ! function_exists( 'manit_scripts_styles' ) ) {
  function manit_scripts_styles() {

    // Styles
    wp_enqueue_style( 'themify-icons', MANIT_CSS .'/themify-icons.css', array(), '4.6.3', 'all' );
    wp_enqueue_style( 'flaticon', MANIT_CSS .'/flaticon.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'bootstrap', MANIT_CSS .'/bootstrap.min.css', array(), '5.0.1', 'all' );
    wp_enqueue_style( 'animate', MANIT_CSS .'/animate.css', array(), '3.5.1', 'all' );
    wp_enqueue_style( 'odometer', MANIT_CSS .'/odometer.css', array(), '0.4.8', 'all' );
    wp_enqueue_style( 'progresscircle', MANIT_CSS .'/progresscircle.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'owl-carousel', MANIT_CSS .'/owl.carousel.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'owl-theme', MANIT_CSS .'/owl.theme.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'slick', MANIT_CSS .'/slick.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'swiper', MANIT_CSS .'/swiper.min.css', array(), '4.0.7', 'all' );
    wp_enqueue_style( 'slick-theme', MANIT_CSS .'/slick-theme.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'owl-transitions', MANIT_CSS .'/owl.transitions.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'fancybox', MANIT_CSS .'/fancybox.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'manit-style', MANIT_CSS .'/styles.css', array(), MANIT_VERSION, 'all' );
    wp_enqueue_style( 'element', MANIT_CSS .'/elements.css', array(), MANIT_VERSION, 'all' );
    if ( !function_exists('cs_framework_init') ) {
      wp_enqueue_style('manit-default-style', get_template_directory_uri() . '/style.css', array(),  MANIT_VERSION, 'all' );
    }
    wp_enqueue_style( 'consoel-google-fonts', esc_url( manit_google_font_url() ), array(), MANIT_VERSION, 'all' );
    wp_enqueue_style( 'consoel-heading-google-fonts', esc_url( manit_heading_google_font_url() ), array(), MANIT_VERSION, 'all' );
    // Scripts
    wp_enqueue_script( 'bootstrap', MANIT_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), '5.0.1', true );
    wp_enqueue_script( 'imagesloaded');
    wp_enqueue_script( 'isotope', MANIT_SCRIPTS . '/isotope.min.js', array( 'jquery' ), '2.2.2', true );
    wp_enqueue_script( 'fancybox', MANIT_SCRIPTS . '/fancybox.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'instafeed', MANIT_SCRIPTS . '/instafeed.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'circle-progress', MANIT_SCRIPTS . '/progresscircle.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'masonry');
    wp_enqueue_script( 'owl-carousel', MANIT_SCRIPTS . '/owl-carousel.js', array( 'jquery' ), '2.0.0', true );
    wp_enqueue_script( 'jquery-easing', MANIT_SCRIPTS . '/jquery-easing.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'wow', MANIT_SCRIPTS . '/wow.min.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'odometer', MANIT_SCRIPTS . '/odometer.min.js', array( 'jquery' ), '0.4.8', true );
    wp_enqueue_script( 'magnific-popup', MANIT_SCRIPTS . '/magnific-popup.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'slick-slider', MANIT_SCRIPTS . '/slick-slider.js', array( 'jquery' ), '1.6.0', true );
    wp_enqueue_script( 'moving-animation', MANIT_SCRIPTS . '/moving-animation.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'swiper', MANIT_SCRIPTS . '/swiper.min.js', array( 'jquery' ), '4.0.7', true );
    wp_enqueue_script( 'wc-quantity-increment', MANIT_SCRIPTS . '/wc-quantity-increment.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'manit-scripts', MANIT_SCRIPTS . '/scripts.js', array( 'jquery' ), MANIT_VERSION, true );
    // Comments
    wp_enqueue_script( 'manit-inline-validate', MANIT_SCRIPTS . '/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
    wp_add_inline_script( 'manit-validate', 'jQuery(document).ready(function($) {$("#commentform").validate({rules: {author: {required: true,minlength: 2},email: {required: true,email: true},comment: {required: true,minlength: 10}}});});' );

    // Responsive Active
    $manit_viewport = cs_get_option('theme_responsive');
    if( !$manit_viewport ) {
      wp_enqueue_style( 'manit-responsive', MANIT_CSS .'/responsive.css', array(), MANIT_VERSION, 'all' );
    }

    // Adds support for pages with threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'manit_scripts_styles' );
}

/**
 * Enqueue Files for BackEnd
 */
if ( ! function_exists( 'manit_admin_scripts_styles' ) ) {
  function manit_admin_scripts_styles() {

    wp_enqueue_style( 'manit-admin-main', MANIT_CSS . '/admin-styles.css', true );
    wp_enqueue_style( 'flaticon', MANIT_CSS . '/flaticon.css', true );
    wp_enqueue_style( 'themify-icons', MANIT_CSS . '/themify-icons.css', true );
    wp_enqueue_script( 'manit-admin-scripts', MANIT_SCRIPTS . '/admin-scripts.js', true );

  }
  add_action( 'admin_enqueue_scripts', 'manit_admin_scripts_styles' );
}
