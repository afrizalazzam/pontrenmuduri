<?php
	// Metabox
	$manit_id    = ( isset( $post ) ) ? $post->ID : 0;
	$manit_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $manit_id;
	$manit_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $manit_id;
	$manit_meta  = get_post_meta( $manit_id, 'page_type_metabox', true );
	if ($manit_meta && is_page()) {
		$manit_title_bar_padding = $manit_meta['title_area_spacings'];
	} else { $manit_title_bar_padding = ''; }
	// Padding - Theme Options
	if ($manit_title_bar_padding && $manit_title_bar_padding !== 'padding-default') {
		$manit_title_top_spacings = $manit_meta['title_top_spacings'];
		$manit_title_bottom_spacings = $manit_meta['title_bottom_spacings'];
		if ($manit_title_bar_padding === 'padding-custom') {
			$manit_title_top_spacings = $manit_title_top_spacings ? 'padding-top:'. manit_check_px($manit_title_top_spacings) .';' : '';
			$manit_title_bottom_spacings = $manit_title_bottom_spacings ? 'padding-bottom:'. manit_check_px($manit_title_bottom_spacings) .';' : '';
			$manit_custom_padding = $manit_title_top_spacings . $manit_title_bottom_spacings;
		} else {
			$manit_custom_padding = '';
		}
	} else {
		$manit_title_bar_padding = cs_get_option('title_bar_padding');
		$manit_titlebar_top_padding = cs_get_option('titlebar_top_padding');
		$manit_titlebar_bottom_padding = cs_get_option('titlebar_bottom_padding');
		if ($manit_title_bar_padding === 'padding-custom') {
			$manit_titlebar_top_padding = $manit_titlebar_top_padding ? 'padding-top:'. manit_check_px($manit_titlebar_top_padding) .';' : '';
			$manit_titlebar_bottom_padding = $manit_titlebar_bottom_padding ? 'padding-bottom:'. manit_check_px($manit_titlebar_bottom_padding) .';' : '';
			$manit_custom_padding = $manit_titlebar_top_padding . $manit_titlebar_bottom_padding;
		} else {
			$manit_custom_padding = '';
		}
	}
	// Banner Type - Meta Box
	if ($manit_meta && is_page()) {
		$manit_banner_type = $manit_meta['banner_type'];
	} else { $manit_banner_type = ''; }
	// Header Style
	if ($manit_meta) {
	  $manit_header_design  = $manit_meta['select_header_design'];
	  $manit_hide_breadcrumbs  = $manit_meta['hide_breadcrumbs'];
	} else {
	  $manit_header_design  = cs_get_option('select_header_design');
	  $manit_hide_breadcrumbs = cs_get_option('need_breadcrumbs');
	}
	if ( $manit_header_design === 'default') {
	  $manit_header_design_actual  = cs_get_option('select_header_design');
	} else {
	  $manit_header_design_actual = ( $manit_header_design ) ? $manit_header_design : cs_get_option('select_header_design');
	}
	if ( $manit_header_design_actual == 'style_two') {
		$overly_class = ' overly';
	} else {
		$overly_class = ' ';
	}
	// Overlay Color - Theme Options
		if ($manit_meta && is_page()) {
			$manit_bg_overlay_color = $manit_meta['titlebar_bg_overlay_color'];
			$title_color = isset($manit_meta['title_color']) ? $manit_meta['title_color'] : '';
		} else { $manit_bg_overlay_color = ''; }
		if (!empty($manit_bg_overlay_color)) {
			$manit_bg_overlay_color = $manit_bg_overlay_color;
			$title_color = $title_color;
		} else {
			$manit_bg_overlay_color = cs_get_option('titlebar_bg_overlay_color');
			$title_color = cs_get_option('title_color');
		}
		$e_uniqid        = uniqid();
		$inline_style  = '';
		if ( $manit_bg_overlay_color ) {
		 $inline_style .= '.page-title-'.$e_uniqid .'.page-title {';
		 $inline_style .= ( $manit_bg_overlay_color ) ? 'background-color:'. $manit_bg_overlay_color.';' : '';
		 $inline_style .= '}';
		}
		if ( $title_color ) {
		 $inline_style .= '.page-title-'.$e_uniqid .'.page-title h2, .page-title-'.$e_uniqid .'.page-title .breadcrumb li, .page-title-'.$e_uniqid .'.page-title .breadcrumbs ul li a {';
		 $inline_style .= ( $title_color ) ? 'color:'. $title_color.';' : '';
		 $inline_style .= '}';
		}
		// add inline style
		add_inline_style( $inline_style );
		$styled_class  = ' page-title-'.$e_uniqid;
	// Background - Type
	if( $manit_meta ) {
		$title_bar_bg = $manit_meta['title_area_bg'];
	} else {
		$title_bar_bg = '';
	}
	$manit_custom_header = get_custom_header();
	$header_text_color = get_theme_mod( 'header_textcolor' );
	$background_color = get_theme_mod( 'background_color' );
	if( isset( $title_bar_bg['image'] ) && ( $title_bar_bg['image'] ||  $title_bar_bg['color'] ) ) {
	  extract( $title_bar_bg );
	  $manit_background_image       = ( ! empty( $image ) ) ? 'background-image: url(' . esc_url($image) . ');' : '';
	  $manit_background_repeat      = ( ! empty( $image ) && ! empty( $repeat ) ) ? ' background-repeat: ' . esc_attr( $repeat) . ';' : '';
	  $manit_background_position    = ( ! empty( $image ) && ! empty( $position ) ) ? ' background-position: ' . esc_attr($position) . ';' : '';
	  $manit_background_size    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-size: ' . esc_attr($size) . ';' : '';
	  $manit_background_attachment    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-attachment: ' . esc_attr( $attachment ) . ';' : '';
	  $manit_background_color       = ( ! empty( $color ) ) ? ' background-color: ' . esc_attr( $color ) . ';' : '';
	  $manit_background_style       = ( ! empty( $image ) ) ? $manit_background_image . $manit_background_repeat . $manit_background_position . $manit_background_size . $manit_background_attachment : '';
	  $manit_title_bg = ( ! empty( $manit_background_style ) || ! empty( $manit_background_color ) ) ? $manit_background_style . $manit_background_color : '';
	} elseif( $manit_custom_header->url ) {
		$manit_title_bg = 'background-image:  url('. esc_url( $manit_custom_header->url ) .');';
	} else {
		$manit_title_bg = '';
	}
	if($manit_banner_type === 'hide-title-area') { // Hide Title Area
	} elseif($manit_meta && $manit_banner_type === 'revolution-slider') { // Hide Title Area
		echo do_shortcode($manit_meta['page_revslider']);
	} else {
	?>
 <!-- start page-title -->

  <!-- end page-title -->
<?php } ?>