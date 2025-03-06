<?php


// Count Ajax
function manit_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>

  <span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>

  <?php
  $fragments['span.cart-count'] = ob_get_clean();

  return $fragments;

}
add_filter('woocommerce_add_to_cart_fragments', 'manit_woocommerce_header_add_to_cart_fragment');

// Amount Ajax
function manit_amount_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
  <span class="total-amount"><?php echo wp_kses( WC()->cart->get_cart_total(), array( 'span' => array( 'class' => array() ) ) ); ?></span>
  <?php

  $fragments['span.total-amount'] = ob_get_clean();

  return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'manit_amount_woocommerce_header_add_to_cart_fragment');


remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_filter('woocommerce_show_page_title', '__return_false');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function manit_woocommerce_products_per_page() {
  $manit_product_count = cs_get_option('manit_woo_limit');
  $manit_product_count = $manit_product_count ? $manit_product_count : 8;
  return (int) $manit_product_count;
}
add_filter( 'loop_shop_per_page', 'manit_woocommerce_products_per_page' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 */
function manit_woocommerce_related_products_args( $args ) {
  $manit_releted_count = cs_get_option('woo_related_limit');
  $defaults = array(
    'posts_per_page' => $manit_releted_count,
  );
  $args = wp_parse_args( $defaults, $args );
  return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'manit_woocommerce_related_products_args' );


function manit_wc_theme_setup()  {
  $manit_woo_single_related = cs_get_option('woo_single_related');
  $manit_woo_single_upsell = cs_get_option('woo_single_upsell');
  if ( $manit_woo_single_related == true ) {
     return remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
  }
  if ( $manit_woo_single_upsell == true ) {
     return remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
  }

  if( is_woocommerce_activated() && class_exists( 'YITH_WCWL' ) ) {
    add_action('woocommerce_after_shop_loop_item', 'manit_yith_wcwl_add_to_wishlist_button', 5);
  }

   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
}
add_action('after_setup_theme','manit_wc_theme_setup', 10);


  function manit_yith_wcwl_add_to_wishlist_button() {
    global $product;

    if( ! isset( $product ) ){
      $product = ( isset( $atts['product_id'] ) ) ? wc_get_product( $atts['product_id'] ) : false;
    }

    $label_option = get_option( 'yith_wcwl_add_to_wishlist_text' );
    $label = apply_filters( 'yith_wcwl_button_label', $label_option );
    $browse_wishlist = get_option( 'yith_wcwl_browse_wishlist_text' );

    $default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

    if( ! empty( $default_wishlists ) ){
      $default_wishlist = $default_wishlists[0]['ID'];
    }
    else{
      $default_wishlist = false;
    }
    $wishlist_url = YITH_WCWL()->get_wishlist_url();

  ?>
    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr($product->get_id()); ?>">
      <div class="yith-wcwl-add-button show" style="display:block">
        <a href="<?php echo esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>" rel="nofollow" data-product-id="<?php echo esc_attr($product->get_id()); ?>" data-product-type="simple"  data-toggle="Add to Wishlist"  class="add_to_wishlist"><i class="fa fa-heart"></i></a>
      </div>
      <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
          <span class="feedback"><?php echo esc_html__( 'Product added!', 'manit' ); ?></span>
          <a href="<?php echo esc_url( $wishlist_url ); ?>" class="view-wishlist" rel="nofollow"><?php echo esc_html__( 'View List', 'manit' ); ?></a>
      </div>
        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
            <span class="feedback"><?php echo esc_html__( 'The product is already in the wishlist!', 'manit' ); ?></span>
            <a href="<?php echo esc_url( $wishlist_url ); ?>"  class="wishilist-already-added" rel="nofollow"><i class="fa fa-heart"></i></a>
        </div>
        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    </div>
  <?php
}

update_option( 'woocommerce_thumbnail_cropping', 'custom' );
update_option( 'woocommerce_thumbnail_cropping_custom_width', '4' );
update_option( 'woocommerce_thumbnail_cropping_custom_height', '3' );


if (!function_exists('manit_loop_columns')) {
  function manit_loop_columns() {
  $woo_product_columns = cs_get_option('woo_product_columns');
  $woo_product_columns = $woo_product_columns ? $woo_product_columns : 3;
    return (int) $woo_product_columns;
  }
}
add_filter('loop_shop_columns', 'manit_loop_columns');

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function manit_products_per_page() {
  $manit_product_count = cs_get_option('theme_woo_limit');
  $manit_product_count = $manit_product_count ? $manit_product_count : 9;
  return (int) $manit_product_count;
}
add_filter( 'loop_shop_per_page', 'manit_products_per_page' );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );


update_option( 'woocommerce_thumbnail_cropping_custom_height', '4.25' );

// Count Ajax
function manit_cart_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
     <div class="mini-cart-content">
        <button class="mini-cart-close"><i class="ti-close"></i></button>
        <?php if ( ! WC()->cart->is_empty() ) : ?>
          <div class="mini-cart-items">
             <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
              $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
              $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

              if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-item-image">
                    <?php
                      $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                      if ( ! $product_permalink ) {
                        echo wp_kses(  $thumbnail ), array( 'img' => array( 'src' => array(), 'alt' => array() ) );
                      } else {
                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                      }
                    ?>
                </div>
                <div class="mini-cart-item-des">
                     <?php
                      if ( ! $product_permalink ) {
                        echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
                      } else {
                        echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
                      }
                    ?>
                    <span class="mini-cart-item-price">
                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                      <span class="mini-cart-item-quantity">
                        <i class="ti-close"></i>
                        <?php echo esc_html( $cart_item['quantity'] ); ?>
                      </span>
                    </span>
                    <?php
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                          '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="ti-close"></i></a>',
                          esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                          esc_html__( 'Remove this item', 'manit' ),
                          esc_attr( $product_id ),
                          esc_attr( $_product->get_sku() )
                        ), $cart_item_key );
                      ?>
                </div>
            </div>
            <?php
              }
             }
            ?>
        </div>
        <?php else : 
           $mini_shop_url = wc_get_page_permalink( 'shop' );
          ?>
          <div class="mini-cart-empty">
            <p class="no-products"><?php echo esc_html__('Your basket is empty!.','manit' ); ?></p>
            <div class="cart-emty-icon">
              <i class="fi flaticon-shopping-cart-1"></i>
            </div>
            <a href="<?php  echo esc_url( $mini_shop_url ) ?>" class="view-cart-btn s2">
                <?php echo esc_html__('Start Shopping','manit' ); ?>
            </a>
          </div>
        <?php endif; ?>
        <div class="mini-cart-action clearfix">
            <?php 
            if (! WC()->cart->is_empty() ) {
              $checkout_url = wc_get_page_permalink( 'checkout' );
              $mini_cart_url = wc_get_page_permalink( 'cart' ); 
             ?>
              <span class="mini-checkout-price">
              <?php echo esc_html__('Subtotal: ','manit' ); ?>
              <span><?php echo WC()->cart->get_cart_total(); ?></span>
              </span>
            
              <a href="<?php echo esc_url( $checkout_url ); ?>" class="view-cart-btn s1">
                <?php echo esc_html__(' Checkout','manit' ); ?>
              </a>
              <a href="<?php  echo esc_url( $mini_cart_url ) ?>" class="view-cart-btn">
                <?php echo esc_html__('View Cart','manit' ); ?>
              </a>
            <?php } ?>
        </div>
    </div>

  <?php
  $fragments['div.mini-cart-content'] = ob_get_clean();

  return $fragments;

}
add_filter('woocommerce_add_to_cart_fragments', 'manit_cart_woocommerce_header_add_to_cart_fragment');




remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary', 'woocommerce_manit_single_title',5);

if ( ! function_exists( 'woocommerce_manit_single_title' ) ) {
   function woocommerce_manit_single_title() {
     global $product;
     $manit_woocommerce_section = get_post_meta( get_the_ID(), 'manit_woocommerce_section', true );
     $manit_product_title = isset( $manit_woocommerce_section['manit_product_title'] ) ? $manit_woocommerce_section['manit_product_title'] : '';

?>
    <h2 itemprop="name" class="product_title entry-title"><?php echo esc_html( $manit_product_title ) ?></h2>
<?php
    }
}


add_filter( 'woocommerce_pagination_args',  'manit_woo_pagination' );
function manit_woo_pagination( $args ) {

  $args['prev_text'] = '<i class="fi ti-arrow-left"></i>';
  $args['next_text'] = '<i class="fi ti-arrow-right"></i>';

  return $args;
}


add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 150,
        'height' => 150,
        'crop' => 0,
    );
} );