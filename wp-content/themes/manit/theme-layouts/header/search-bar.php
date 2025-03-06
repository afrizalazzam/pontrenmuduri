<?php
$manit_id    = ( isset( $post ) ) ? $post->ID : 0;
$manit_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $manit_id;
$manit_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $manit_id;
$manit_meta  = get_post_meta( $manit_id, 'page_type_metabox', true);

// Header Style
if ( $manit_meta ) {
  $manit_header_design  = $manit_meta['select_header_design'];
} else {
  $manit_header_design  = cs_get_option( 'select_header_design' );
}

if ( $manit_header_design === 'default' ) {
  $manit_header_design_actual  = cs_get_option( 'select_header_design' );
} else {
  $manit_header_design_actual = ( $manit_header_design ) ? $manit_header_design : cs_get_option('select_header_design');
}
$manit_header_design_actual = $manit_header_design_actual ? $manit_header_design_actual : 'style_two';

$manit_cart_widget  = cs_get_option( 'manit_cart_widget' );
$manit_search  = cs_get_option( 'manit_header_search' );

$manit_menu_cta  = cs_get_option( 'manit_menu_cta' );
$header_cta_text  = cs_get_option( 'header_cta_text' );
$header_cta_link  = cs_get_option( 'header_cta_link' );

?>
<div class="col-lg-2 col-md-2 col-2">
  <div class="header-search-form-wrapper header-right">
      <?php if ( $manit_menu_cta ) { ?>
        <div class="close-form">
            <a class="theme-btn" href="<?php echo esc_url( $header_cta_link ); ?>">
              <?php echo esc_html( $header_cta_text ) ?>
            </a>
        </div>
      <?php }
      if ( $manit_cart_widget && class_exists( 'WooCommerce' ) ) {
        get_template_part( 'theme-layouts/header/top','cart' );
      }
      if ( !$manit_search ) { ?>
      <div class="cart-search-contact">
          <button class="search-toggle-btn"><i class="fi ti-search"></i></button>
          <div class="header-search-form">
              <form method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="form" >
                  <div>
                      <input type="text" name="s" class="form-control" placeholder="<?php echo esc_attr__( 'Search here','manit' ); ?>">
                      <button type="submit"><i class="fi ti-search"></i></button>
                  </div>
              </form>
          </div>
      </div>
    <?php } ?>
  </div>
</div>
