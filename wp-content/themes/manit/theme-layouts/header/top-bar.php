<?php
// Metabox
global $post;
$manit_id    = ( isset( $post ) ) ? $post->ID : false;
$manit_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $manit_id;
$manit_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $manit_id;
$manit_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $manit_id : false;
$manit_meta  = get_post_meta( $manit_id, 'page_type_metabox', true );
  if ($manit_meta) {
    $manit_topbar_options = $manit_meta['topbar_options'];
  } else {
    $manit_topbar_options = '';
  }

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

// Define Theme Options and Metabox varials in right way!
if ($manit_meta) {
  if ($manit_topbar_options === 'custom' && $manit_topbar_options !== 'default') {
    $manit_top_left          = $manit_meta['top_left'];
    $manit_top_right          = $manit_meta['top_right'];
    $manit_hide_topbar        = $manit_topbar_options;
    $manit_topbar_bg          = $manit_meta['topbar_bg'];
    if ($manit_topbar_bg) {
      $manit_topbar_bg = 'background-color: '. $manit_topbar_bg .';';
    } else {$manit_topbar_bg = '';}
  } else {
    $manit_top_left          = cs_get_option('top_left');
    $manit_top_right          = cs_get_option('top_right');
    $manit_hide_topbar        = cs_get_option('top_bar');
    $manit_topbar_bg          = '';
  }
} else {
  // Theme Options fields
  $manit_top_left         = cs_get_option('top_left');
  $manit_top_right          = cs_get_option('top_right');
  $manit_hide_topbar        = cs_get_option('top_bar');
  $manit_topbar_bg          = '';
}
// All options
if ( $manit_meta && $manit_topbar_options === 'custom' && $manit_topbar_options !== 'default' ) {
  $manit_top_right = ( $manit_top_right ) ? $manit_meta['top_right'] : cs_get_option('top_right');
  $manit_top_left = ( $manit_top_left ) ? $manit_meta['top_left'] : cs_get_option('top_left');
} else {
  $manit_top_right = cs_get_option('top_right');
  $manit_top_left = cs_get_option('top_left');
}
if ( $manit_meta && $manit_topbar_options !== 'default' ) {
  if ( $manit_topbar_options === 'hide_topbar' ) {
    $manit_hide_topbar = 'hide';
  } else {
    $manit_hide_topbar = 'show';
  }
} else {
  $manit_hide_topbar_check = cs_get_option( 'top_bar' );
  if ( $manit_hide_topbar_check === true ) {
     $manit_hide_topbar = 'hide';
  } else {
     $manit_hide_topbar = 'show';
  }
}
if ( $manit_meta ) {
  $manit_topbar_bg = ( $manit_topbar_bg ) ? $manit_meta['topbar_bg'] : '';
} else {
  $manit_topbar_bg = '';
}
if ( $manit_topbar_bg ) {
  $manit_topbar_bg = 'background-color: '. $manit_topbar_bg .';';
} else { $manit_topbar_bg = ''; }

if( $manit_hide_topbar === 'show' && ( $manit_top_left || $manit_top_right ) ) {
?>
 <div class="topbar" style="<?php echo esc_attr( $manit_topbar_bg ); ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-7 col-sm-12 col-12">
               <?php echo do_shortcode( $manit_top_left ); ?>
            </div>
            <div class="col col-md-5 col-sm-12 col-12">
                <?php echo do_shortcode( $manit_top_right ); ?>
            </div>
        </div>
    </div>
</div> <!-- end topbar -->
<?php } // Hide Topbar - From Metabox