<?php
	// Logo Image
	// Metabox - Header Transparent
	$manit_id    = ( isset( $post ) ) ? $post->ID : 0;
	$manit_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $manit_id;
	$manit_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $manit_id;
	$manit_meta  = get_post_meta( $manit_id, 'page_type_metabox'. true );
    $manit_preloader_image  = cs_get_option( 'preloader_image' );

    $manit_preloader_url = wp_get_attachment_url( $manit_preloader_image );
    $manit_preloader_alt = get_post_meta( $manit_preloader_image, '_wp_attachment_image_alt', true );

    if ( $manit_preloader_url ) {
        $manit_preloader_url = $manit_preloader_url;
    } else {
        $manit_preloader_url = MANIT_IMAGES.'/preloader.png';
    }

?>
<!-- start preloader -->
<div class="preloader">
    <div class="vertical-centered-box">
        <div class="content">
            <div class="loader-circle"></div>
            <div class="loader-line-mask">
                <div class="loader-line"></div>
            </div>
           <img src="<?php echo esc_url( $manit_preloader_url ); ?>" alt="<?php echo esc_attr( $manit_preloader_alt ); ?>">
        </div>
    </div>
</div>
<!-- end preloader -->