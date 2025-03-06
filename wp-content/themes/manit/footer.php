<?php
/*
 * The template for displaying the footer.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

$manit_id    = ( isset( $post ) ) ? $post->ID : 0;
$manit_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $manit_id;
$manit_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $manit_id;
$manit_meta  = get_post_meta( $manit_id, 'page_type_metabox', true );
$manit_ft_bg = cs_get_option('manit_ft_bg');
$manit_attachment = wp_get_attachment_image_src( $manit_ft_bg , 'full' );
$manit_attachment = $manit_attachment ? $manit_attachment[0] : '';
if ( $manit_meta ) {
	$manit_footer_design  = $manit_meta['select_footer_design'];
	if ($manit_footer_design != 'theme') {
	  $manit_footer_design = $manit_footer_design;
	} else {
	  $manit_footer_design = cs_get_option( 'select_footer_design' );
	}
} else {
	$manit_footer_design  = cs_get_option( 'select_footer_design' );
}

if (is_numeric($manit_footer_design)) {
	$footer_class = 'footer-builder';
} else {
	$footer_class = 'wpo-site-footer clearfix';
}

if ( $manit_attachment && !is_numeric($manit_footer_design) ) {
	$bg_url = ' style="';
	$bg_url .= ( $manit_attachment ) ? 'background-image: url( '. esc_url( $manit_attachment ) .' );' : '';
	$bg_url .= '"';
} else {
	$bg_url = '';
}

if ( $manit_meta ) {
	$manit_hide_footer  = $manit_meta['hide_footer'];
} else { $manit_hide_footer = ''; }
if ( !$manit_hide_footer ) { // Hide Footer Metabox
	$hide_copyright = cs_get_option('hide_copyright');
	
?>
	<!-- Footer -->
	<footer class="<?php echo esc_attr($footer_class); ?>"  <?php echo wp_kses( $bg_url, array('img' => array('src' => array(), 'alt' => array()),) ); ?>>
      <?php  if (is_numeric($manit_footer_design)) {
        $footer_builder = new WP_Query(
          array(
            'post_type' => 'footerbuilder',
            'posts_per_page' => 1,
            'p' => $manit_footer_design,
            'orderby' => 'none',
            'order' => 'DESC'
          )
        );

        if ($footer_builder->have_posts()) {
          while ($footer_builder->have_posts()) {
            $footer_builder->the_post();
            the_content();
          }
        }
        wp_reset_postdata();
      } else { 
		$footer_widget_block = cs_get_option( 'footer_widget_block' );
		if ( $footer_widget_block ) {
	      	get_template_part( 'theme-layouts/footer/footer', 'widgets' );
	    }
		if ( !$hide_copyright ) {
      		get_template_part( 'theme-layouts/footer/footer', 'copyright' );
	    }
      } ?>
	</footer>
	<!-- Footer -->
<?php } // Hide Footer Metabox ?>
</div><!--manit-theme-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
