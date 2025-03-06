<?php
/**
 * Single Service.
 */
global $post;
$image_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'large' );
$image_alt = get_post_meta( get_post_thumbnail_id( $post->ID ) , '_wp_attachment_image_alt', true);

?>        
<div class="service-single-content">
    <div class="service-details">
      <?php echo the_content(); ?>
    </div>
</div>