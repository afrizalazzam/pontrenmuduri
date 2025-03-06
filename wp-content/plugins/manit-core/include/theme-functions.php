<?php

/**
 * Plugin language
 */
function manit_plugin_language_setup() {
  load_plugin_textdomain( 'manit-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'manit_plugin_language_setup' );

/* WPAUTOP for shortcode output */
if( ! function_exists( 'manit_set_wpautop' ) ) {
  function manit_set_wpautop( $content, $force = true ) {
    if ( $force ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
}

/* Use shortcodes in text widgets */
add_filter('widget_text', 'do_shortcode');

/* Shortcodes enable in the_excerpt */
add_filter('the_excerpt', 'do_shortcode');

/* Remove p tag and add by our self in the_excerpt */
remove_filter('the_excerpt', 'wpautop');


/* Add Extra Social Fields in Admin User Profile */
function manit_add_twitter_facebook( $contactmethods ) {
  $contactmethods['twitter']    = 'Twitter';
  $contactmethods['facebook']   = 'Facebook';
  $contactmethods['instagram']  = 'Instagram';
  $contactmethods['pinterest']   = 'Pinterest';
  return $contactmethods;
}
add_filter('user_contactmethods','manit_add_twitter_facebook',10,1);

/**
 *
 * Encode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_encode_string' ) ) {
  function cs_encode_string( $string ) {
    return rtrim( strtr( call_user_func( 'base'. '64' .'_encode', addslashes( gzcompress( serialize( $string ), 9 ) ) ), '+/', '-_' ), '=' );
  }
}

/**
 *
 * Decode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_decode_string' ) ) {
  function cs_decode_string( $string ) {
    return unserialize( gzuncompress( stripslashes( call_user_func( 'base'. '64' .'_decode', rtrim( strtr( $string, '-_', '+/' ), '=' ) ) ) ) );
  }
}


/* Inline Style */
global $all_inline_styles;
$all_inline_styles = array();
if( ! function_exists( 'add_inline_style' ) ) {
  function add_inline_style( $style ) {
    global $all_inline_styles;
    array_push( $all_inline_styles, $style );
  }
}

/* Enqueue Inline Styles */
if ( ! function_exists( 'manit_enqueue_inline_styles' ) ) {
  function manit_enqueue_inline_styles() {

    global $all_inline_styles;

    if ( ! empty( array_filter($all_inline_styles) ) ) {
      echo '<style id="manit-inline-style" type="text/css">'. manit_compress_css_lines( join( '', $all_inline_styles ) ) .'</style>';
    }

  }
  add_action( 'wp_footer', 'manit_enqueue_inline_styles' );
}

/* Validate px entered in field */
if( ! function_exists( 'manit_core_check_px' ) ) {
  function manit_core_check_px( $num ) {
    return ( is_numeric( $num ) ) ? $num . 'px' : $num;
  }
}


/* Share Options */
if ( ! function_exists( 'manit_wp_share_option' ) ) {
  function manit_wp_share_option() {

    global $post;
    $page_url = get_permalink($post->ID );
    $title = $post->post_title;
    $share_text = cs_get_option('share_text');
    $share_text = $share_text ? $share_text : esc_html__( 'Share', 'manit' );
    $share_on_text = cs_get_option('share_on_text');
    $share_on_text = $share_on_text ? $share_on_text : esc_html__( 'Share On', 'manit' );
    ?>
     <div class="share tag">
      <?php  echo '<span>'.esc_html__('Share:','manit').'</span>'; ?>
      <ul>
        <li>
          <a href="//www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($page_url)); ?>&amp;t=<?php print(urlencode($title)); ?>" class="facebook" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Facebook', 'manit'); ?>" target="_blank"><i class="ti-facebook"></i></a>
        </li>
        <li>
          <a href="//twitter.com/home?status=<?php print(urlencode($title)); ?>+<?php print(urlencode($page_url)); ?>" class="twitter" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Twitter', 'manit'); ?>" target="_blank"><i class="ti-twitter-alt"></i></a>
        </li>
        <li>
          <a href="//linkedin.com/shareArticle?mini=true&amp;url=<?php print(urlencode($page_url)); ?>&amp;title=<?php print(urlencode($title)); ?>" class="linkedin" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Linkedin', 'manit'); ?>" target="_blank"><i class="ti-linkedin"></i></a>
        </li>
        <li>
          <a href="//pinterest.com/pin/create/button/?url=<?php print(urlencode($page_url)); ?>" class="pinterest" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Pinterest', 'manit'); ?>" target="_blank"><i class="ti-pinterest"></i></a>
        </li>
      </ul>
    </div>
<?php
  }
}


/* Maintenance Mode */
if( ! function_exists( 'manit_maintenance_mode' ) ) {
  function manit_maintenance_mode(){
    if( function_exists( 'cs_get_option' ) ) {
       $maintenance_mode_page = cs_get_option( 'maintenance_mode_page' ) && cs_get_option( 'enable_maintenance_mode' );
    }
    if ( ! empty( $maintenance_mode_page ) && ! is_user_logged_in() ) {
      get_template_part('theme-layouts/post/content', 'maintenance');
      exit;
    }

  }
  add_action( 'wp', 'manit_maintenance_mode', 1 );
}

/* Yoast Plugin Metabox Low */
if( ! function_exists( 'manit_yoast_metabox' ) ) {
  function manit_yoast_metabox() {
    return 'low';
  }
  add_filter( 'wpseo_metabox_prio', 'manit_yoast_metabox' );
}


/* Compress CSS */
if ( ! function_exists( 'manit_compress_css_lines' ) ) {
  function manit_compress_css_lines( $css ) {
    $css  = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
    $css  = str_replace( ': ', ':', $css );
    $css  = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
    return $css;
  }
}

// get_cart_product_count

function woo_get_cart_product_count(){
  $count = 0;

  if( WC()->cart ){
    $count = WC()->cart->get_cart_contents_count();
  }

  return $count;
}

