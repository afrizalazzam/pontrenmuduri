<?php
/*
 * The template for displaying all single posts.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
get_header();
	// Metabox
	$team_id    = ( isset( $post ) ) ? $post->ID : 0;
	$team_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $team_id;
	$team_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $team_id;
	$team_meta  = get_post_meta( $team_id, 'page_type_metabox', true );
	if ( $team_meta ) {
		$team_content_padding = $team_meta['content_spacings'];
	} else { $team_content_padding = ''; }
	// Padding - Metabox
	if ( $team_content_padding && $team_content_padding !== 'padding-default' ) {
		$team_content_top_spacings = $team_meta['content_top_spacings'];
		$team_content_bottom_spacings = $team_meta['content_bottom_spacings'];
		if ( $team_content_padding === 'padding-custom' ) {
			$team_content_top_spacings = $team_content_top_spacings ? 'padding-top:'. team_check_px($team_content_top_spacings) .';' : '';
			$team_content_bottom_spacings = $team_content_bottom_spacings ? 'padding-bottom:'. team_check_px($team_content_bottom_spacings) .';' : '';
			$team_custom_padding = $team_content_top_spacings . $team_content_bottom_spacings;
		} else {
			$team_custom_padding = '';
		}
	} else {
		$team_custom_padding = '';
	}
	// Theme Options
	$team_sidebar_position = cs_get_option( 'team_sidebar_position' );
	$team_single_comment = cs_get_option( 'team_comment_form' );
	$team_sidebar_position = $team_sidebar_position ? $team_sidebar_position : 'sidebar-hide';
	// Sidebar Position
	if ( $team_sidebar_position === 'sidebar-hide' ) {
		$team_layout_class = 'col col-lg-12';
		$team_sidebar_class = 'hide-sidebar';
	} elseif ( $team_sidebar_position === 'sidebar-left' ) {
		$team_layout_class = 'col col-lg-8 order-lg-2';
		$team_sidebar_class = 'left-sidebar';
	} else {
		$team_layout_class = 'col-lg-8';
		$team_sidebar_class = 'right-sidebar';
	} ?>
<div class="team-pg-area section-padding <?php echo esc_attr( $team_content_padding .' '. $team_sidebar_class ); ?>" style="<?php echo esc_attr( $team_custom_padding ); ?>">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr( $team_layout_class ); ?>">
				<div class="team-single-wrap-area">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							if ( post_password_required() ) {
									echo '<div class="password-form">'.get_the_password_form().'</div>';
								} else {
									get_template_part( 'theme-layouts/post/team', 'content' );

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
				if ( $team_sidebar_position !== 'sidebar-hide' ) {
					get_sidebar(); // Sidebar
				} ?>
		</div>
	</div>
</div>
<?php
get_footer();