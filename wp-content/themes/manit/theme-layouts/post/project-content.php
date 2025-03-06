<?php
/**
 * Single Project.
 */
$manit_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$manit_large_image = $manit_large_image ? $manit_large_image[0] : '';
$image_alt = get_post_meta( $manit_large_image, '_wp_attachment_image_alt', true);
$project_options = get_post_meta( get_the_ID(), 'project_options', true );
$project_page_options = get_post_meta( get_the_ID(), 'project_page_options', true );

$manit_prev_pro = cs_get_option('prev_service');
$manit_next_pro = cs_get_option('next_servic');
$manit_prev_pro = ($manit_prev_pro) ? $manit_prev_pro : esc_html__('Previous project', 'manit');
$manit_next_pro = ($manit_next_pro) ? $manit_next_pro : esc_html__('Next project', 'manit');
$manit_prev_post = get_previous_post( '', false);
$manit_next_post = get_next_post( '', false);

?>        
<div class="content-area">
			<div class="project-article">
     		<?php the_content(); ?>
     </div>
</div> 

 