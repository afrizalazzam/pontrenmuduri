<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
$manit_id    = ( isset( $post ) ) ? $post->ID : 0;
$manit_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $manit_id;
$manit_meta  = get_post_meta( $manit_id, 'page_type_metabox', true );
if ( $manit_meta ) {
	$manit_content_padding = $manit_meta['content_spacings'];
} else { $manit_content_padding = 'section-padding'; }
// Top and Bottom Padding
if ( $manit_content_padding && $manit_content_padding !== 'padding-default' ) {
	$manit_content_top_spacings = isset( $manit_meta['content_top_spacings'] ) ? $manit_meta['content_top_spacings'] : '';
	$manit_content_bottom_spacings = isset( $manit_meta['content_bottom_spacings'] ) ? $manit_meta['content_bottom_spacings'] : '';
	if ( $manit_content_padding === 'padding-custom' ) {
		$manit_content_top_spacings = $manit_content_top_spacings ? 'padding-top:'. manit_check_px( $manit_content_top_spacings ) .';' : '';
		$manit_content_bottom_spacings = $manit_content_bottom_spacings ? 'padding-bottom:'. manit_check_px($manit_content_bottom_spacings) .';' : '';
		$manit_custom_padding = $manit_content_top_spacings . $manit_content_bottom_spacings;
	} else {
		$manit_custom_padding = '';
	}
	$padding_class = '';
} else {
	$manit_custom_padding = '';
	$padding_class = '';
}

// Page Layout
$page_layout_options = get_post_meta( get_the_ID(), 'page_layout_options', true );
if ( $page_layout_options ) {
	$manit_page_layout = $page_layout_options['page_layout'];
	$page_sidebar_widget = $page_layout_options['page_sidebar_widget'];
} else {
	$manit_page_layout = 'right-sidebar';
	$page_sidebar_widget = '';
}
$page_sidebar_widget = $page_sidebar_widget ? $page_sidebar_widget : 'sidebar-1';
if ( $manit_page_layout === 'extra-width' ) {
	$manit_page_column = 'extra-width';
	$manit_page_container = 'container-fluid';
} elseif ( $manit_page_layout === 'full-width' ) {
	$manit_page_column = 'col-md-12';
	$manit_page_container = 'container ';
} elseif( ( $manit_page_layout === 'left-sidebar' || $manit_page_layout === 'right-sidebar' ) && is_active_sidebar( $page_sidebar_widget ) ) {
	if( $manit_page_layout === 'left-sidebar' ){
		$manit_page_column = 'col-md-8 order-12';
	} else {
		$manit_page_column = 'col-md-8';
	}
	$manit_page_container = 'container ';
} else {
	$manit_page_column = 'col-md-12';
	$manit_page_container = 'container ';
}
$manit_theme_page_comments = cs_get_option( 'theme_page_comments' );
get_header();
?>
<div class="page-wrap <?php echo esc_attr( $padding_class.''.$manit_content_padding ); ?>">
	<div class="<?php echo esc_attr( $manit_page_container.''.$manit_page_layout ); ?>" style="<?php echo esc_attr( $manit_custom_padding ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $manit_page_column ); ?>">
				<div class="page-wraper clearfix">
				<?php
				while ( have_posts() ) : the_post();
					the_content();
					if ( !$manit_theme_page_comments && ( comments_open() || get_comments_number() ) ) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				?>
				</div>
				<div class="page-link-wrap">
					<?php manit_wp_link_pages(); ?>
				</div>
			</div>
			<?php
			// Sidebar
			if( ($manit_page_layout === 'left-sidebar' || $manit_page_layout === 'right-sidebar') && is_active_sidebar( $page_sidebar_widget )  ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php
get_footer();