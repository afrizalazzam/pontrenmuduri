<?php
// Metabox
global $post;
$manit_id    = ( isset( $post ) ) ? $post->ID : false;
$manit_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $manit_id;
$manit_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $manit_id;
$manit_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('service') ) ? $manit_id : false;
$manit_meta  = get_post_meta( $manit_id, 'page_type_metabox', true );
// Header Style

$manit_logo = cs_get_option( 'manit_logo' );

$logo_url = wp_get_attachment_url( $manit_logo );
$manit_logo_alt = get_post_meta( $manit_logo, '_wp_attachment_image_alt', true );

if ( $logo_url ) {
  $logo_url = $logo_url;
} else {
 $logo_url = MANIT_IMAGES.'/logo.svg';
}

if ( has_nav_menu( 'primary' ) ) {
  $logo_padding = ' has_menu ';
}
else {
   $logo_padding = ' dont_has_menu ';
}


// Logo Spacings
// Logo Spacings
$manit_brand_logo_top = cs_get_option( 'manit_logo_top' );
$manit_brand_logo_bottom = cs_get_option( 'manit_logo_bottom' );
if ( $manit_brand_logo_top ) {
  $manit_brand_logo_top = 'padding-top:'. manit_check_px( $manit_brand_logo_top ) .';';
} else { $manit_brand_logo_top = ''; }
if ( $manit_brand_logo_bottom ) {
  $manit_brand_logo_bottom = 'padding-bottom:'. manit_check_px( $manit_brand_logo_bottom ) .';';
} else { $manit_brand_logo_bottom = ''; }
?>
<div class="site-logo <?php echo esc_attr( $logo_padding ); ?>"  style="<?php echo esc_attr( $manit_brand_logo_top ); echo esc_attr( $manit_brand_logo_bottom ); ?>">
   <?php if ( $manit_logo ) {
    ?>
      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $logo_url ); ?>" alt=" <?php echo esc_attr( $manit_logo_alt ); ?>">
     </a>
   <?php } elseif( has_custom_logo() ) {
      the_custom_logo();
    } else {
    ?>
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo get_bloginfo('name'); ?>">
     </a>
   <?php
  } ?>
</div>