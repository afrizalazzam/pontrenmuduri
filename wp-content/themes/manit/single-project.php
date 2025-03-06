<?php
/*
 * The template for displaying all single posts.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
get_header();
	// Metabox
	$manit_id    = ( isset( $post ) ) ? $post->ID : 0;
	$manit_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $manit_id;
	$manit_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $manit_id;
	$manit_meta  = get_post_meta( $manit_id, 'page_type_metabox', true );
	if ( $manit_meta ) {
		$manit_content_padding = $manit_meta['content_spacings'];
	} else { $manit_content_padding = ''; }
	// Padding - Metabox
	if ( $manit_content_padding && $manit_content_padding !== 'padding-default' ) {
		$manit_content_top_spacings = $manit_meta['content_top_spacings'];
		$manit_content_bottom_spacings = $manit_meta['content_bottom_spacings'];
		if ( $manit_content_padding === 'padding-custom' ) {
			$manit_content_top_spacings = $manit_content_top_spacings ? 'padding-top:'. manit_check_px($manit_content_top_spacings) .';' : '';
			$manit_content_bottom_spacings = $manit_content_bottom_spacings ? 'padding-bottom:'. manit_check_px($manit_content_bottom_spacings) .';' : '';
			$manit_custom_padding = $manit_content_top_spacings . $manit_content_bottom_spacings;
		} else {
			$manit_custom_padding = '';
		}
	} else {
		$manit_custom_padding = '';
	}
	// Theme Options
	$manit_sidebar_position = cs_get_option( 'project_sidebar_position' );
	$manit_single_comment = cs_get_option( 'project_comment_form' );
	$manit_sidebar_position = $manit_sidebar_position ? $manit_sidebar_position : 'sidebar-hide';
	// Sidebar Position
	if ( $manit_sidebar_position === 'sidebar-hide' ) {
		$manit_layout_class = 'col-lg-12';
		$manit_sidebar_class = 'hide-sidebar';
	} elseif ( $manit_sidebar_position === 'sidebar-left' ) {
		$manit_layout_class = 'col col-lg-8 order-lg-2';
		$manit_sidebar_class = 'left-sidebar';
	} else {
		$manit_layout_class = 'col col-lg-8';
		$manit_sidebar_class = 'right-sidebar';
	} ?>
<div class="project-single-section section-padding <?php echo esc_attr( $manit_content_padding .' '. $manit_sidebar_class ); ?>" style="<?php echo esc_attr( $manit_custom_padding ); ?>">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr( $manit_layout_class ); ?>">
				<div class="project-single-content">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							if ( post_password_required() ) {
									echo '<div class="password-form">'.get_the_password_form().'</div>';
								} else {
									get_template_part( 'theme-layouts/post/project', 'content' );
									$manit_single_comment = !$manit_single_comment ? comments_template() : '';

								}
						endwhile;
					else :
						get_template_part( 'theme-layouts/post/content', 'none' );
					endif; ?>
				</div><!-- Blog Div -->
				<?php
		    wp_reset_postdata(); ?>
			</div><!-- Content Area -->
				<?php
				if ( $manit_sidebar_position !== 'sidebar-hide' ) {
					get_sidebar(); // Sidebar
				} ?>
		</div>
	</div>
</div>
<?php
get_footer();