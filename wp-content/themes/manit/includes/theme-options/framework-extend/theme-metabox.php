<?php
/*
 * All Metabox related options for Manit theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function manit_metabox_options( $options ) {


  $header = get_posts( 'post_type="headerbuilder"&numberposts=-1' );
  $headers = array( 'theme' => esc_html__( 'Default', 'manit' ) );
  if ( $header ) {
    foreach ( $header as $head ) {
      $headers[ $head->ID ] = $head->post_title;
    }
  }
  $footer = get_posts( 'post_type="footerbuilder"&numberposts=-1' );
  $footers = array( 'theme' => esc_html__( 'Default', 'manit' ));
  if ( $footer ) {
    foreach ( $footer as $foot ) {
      $footers[ $foot->ID ] = $foot->post_title;
    }
  }


  $options      = array();

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_type_metabox',
    'title'     => esc_html__('Post Options', 'manit'),
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_post_formats',
        'fields' => array(

          // Standard, Image
          array(
            'title' => 'Standard Image',
            'type'  => 'subheading',
            'content' => esc_html__('There is no Extra Option for this Post Format!', 'manit'),
            'wrap_class' => 'manit-minimal-heading hide-title',
          ),
          // Standard, Image

          // Gallery
          array(
            'type'    => 'notice',
            'title'   => 'Gallery Format',
            'wrap_class' => 'hide-title',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Gallery Format', 'manit')
          ),
          array(
            'id'          => 'gallery_post_format',
            'type'        => 'gallery',
            'title'       => esc_html__('Add Gallery', 'manit'),
            'add_title'   => esc_html__('Add Image(s)', 'manit'),
            'edit_title'  => esc_html__('Edit Image(s)', 'manit'),
            'clear_title' => esc_html__('Clear Image(s)', 'manit'),
          ),
          array(
            'type'    => 'text',
            'title'   => esc_html__('Add Video URL', 'manit' ),
            'id'   => 'video_post_format',
            'desc' => esc_html__('Add youtube or vimeo video link', 'manit' ),
            'wrap_class' => 'video_post_format',
          ),
          array(
            'type'    => 'icon',
            'title'   => esc_html__('Add Quote Icon', 'manit' ),
            'id'   => 'quote_post_format',
            'desc' => esc_html__('Add Quote Icon here', 'manit' ),
            'wrap_class' => 'quote_post_format',
          ),
          // Gallery

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Page Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_type_metabox',
    'title'     => esc_html__('Page Custom Options', 'manit'),
    'post_type' => array('post', 'page'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Title Section
      array(
        'name'  => 'page_topbar_section',
        'title' => esc_html__('Top Bar', 'manit'),
        'icon'  => 'fa fa-minus',

        // Fields Start
        'fields' => array(

          array(
            'id'           => 'topbar_options',
            'type'         => 'image_select',
            'title'        => esc_html__('Topbar', 'manit'),
            'options'      => array(
              'default'     => MANIT_CS_IMAGES .'/topbar-default.png',
              'custom'      => MANIT_CS_IMAGES .'/topbar-custom.png',
              'hide_topbar' => MANIT_CS_IMAGES .'/topbar-hide.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'hide_topbar_select',
            ),
            'radio'     => true,
            'default'   => 'default',
          ),
          array(
            'id'          => 'top_left',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Left', 'manit'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'          => 'top_right',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Right', 'manit'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'    => 'topbar_bg',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Background Color', 'manit'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),
          array(
            'id'    => 'topbar_border',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Border Color', 'manit'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),

        ), // End : Fields

      ), // Title Section

      // Header
      array(
        'name'  => 'header_section',
        'title' => esc_html__('Header & Footer', 'manit'),
        'icon'  => 'fa fa-bars',
        'fields' => array(
          array(
            'id'           => 'select_header_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Header Design', 'manit'),
            'options'      => $headers,
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'     => true,
            'default'   => 'default',
            'info'      => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'manit'),
          ),
          array(
            'id'           => 'select_footer_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Footer Design', 'manit'),
            'options'      => $footers,
            'attributes' => array(
              'data-depend-id' => 'footer_design',
            ),
            'radio'     => true,
            'default'   => 'default',
            'info'      => esc_html__('Select your footer design, following options will may differ based on your selection of footer design.', 'manit'),
          ),
        ),
      ),
      // Header

      // Banner & Title Area
      array(
        'name'  => 'banner_title_section',
        'title' => esc_html__('Banner & Title Area', 'manit'),
        'icon'  => 'fa fa-bullhorn',
        'fields' => array(

          array(
            'id'        => 'banner_type',
            'type'      => 'select',
            'title'     => esc_html__('Choose Banner Type', 'manit'),
            'options'   => array(
              'default-title'    => 'Default Title',
              'revolution-slider' => 'Shortcode [Rev Slider]',
              'hide-title-area'   => 'Hide Title/Banner Area',
            ),
          ),
          array(
            'id'    => 'page_revslider',
            'type'  => 'textarea',
            'title' => esc_html__('Revolution Slider or Any Shortcodes', 'manit'),
            'desc' => __('Enter any shortcodes that you want to show in this page title area. <br />Eg : Revolution Slider shortcode.', 'manit'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your shortcode...', 'manit'),
            ),
            'dependency'   => array('banner_type', '==', 'revolution-slider'),
          ),
          array(
            'id'    => 'page_custom_title',
            'type'  => 'text',
            'title' => esc_html__('Custom Title', 'manit'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your custom title...', 'manit'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'        => 'title_area_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Title Area Spacings', 'manit'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'manit'),
              'padding-custom' => esc_html__('Custom Padding', 'manit'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'manit'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'manit'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_area_bg',
            'type'  => 'background',
            'title' => esc_html__('Background', 'manit'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'titlebar_bg_overlay_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Overlay Color', 'manit'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'manit'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

        ),
      ),
      // Banner & Title Area

      // Content Section
      array(
        'name'  => 'page_content_options',
        'title' => esc_html__('Content Options', 'manit'),
        'icon'  => 'fa fa-file',

        'fields' => array(

          array(
            'id'        => 'content_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Content Spacings', 'manit'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'manit'),
              'padding-custom' => esc_html__('Custom Padding', 'manit'),
            ),
            'desc' => esc_html__('Content area top and bottom spacings.', 'manit'),
          ),
          array(
            'id'    => 'content_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'manit'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'content_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'manit'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
        ), // End Fields
      ), // Content Section

      // Enable & Disable
      array(
        'name'  => 'hide_show_section',
        'title' => esc_html__('Enable & Disable', 'manit'),
        'icon'  => 'fa fa-toggle-on',
        'fields' => array(

          array(
            'id'    => 'hide_header',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Header', 'manit'),
            'label' => esc_html__('Yes, Please do it.', 'manit'),
          ),
          array(
            'id'    => 'hide_breadcrumbs',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Breadcrumbs', 'manit'),
            'label' => esc_html__('Yes, Please do it.', 'manit'),
          ),
          array(
            'id'    => 'hide_footer',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Footer', 'manit'),
            'label' => esc_html__('Yes, Please do it.', 'manit'),
          ),
       
        ),
      ),
      // Enable & Disable

    ),
  );

  // -----------------------------------------
  // Page Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_layout_options',
    'title'     => esc_html__('Page Layout', 'manit'),
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'page_layout_section',
        'fields' => array(

          array(
            'id'        => 'page_layout',
            'type'      => 'image_select',
            'options'   => array(
              'full-width'    => MANIT_CS_IMAGES . '/page-1.png',
              'extra-width'   => MANIT_CS_IMAGES . '/page-2.png',
              'left-sidebar'  => MANIT_CS_IMAGES . '/page-3.png',
              'right-sidebar' => MANIT_CS_IMAGES . '/page-4.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'page_layout',
            ),
            'default'    => 'full-width',
            'radio'      => true,
            'wrap_class' => 'text-center',
          ),
          array(
            'id'            => 'page_sidebar_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'manit'),
            'options'        => manit_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'manit'),
            'dependency'   => array('page_layout', 'any', 'left-sidebar,right-sidebar'),
          ),

        ),
      ),

    ),
  );


// -----------------------------------------
  // Project
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'project_options',
    'title'     => esc_html__('Project Extra Options', 'manit'),
    'post_type' => 'project',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'project_option_section',
        'fields' => array(
          array(
            'id'           => 'project_subtitle',
            'type'         => 'text',
            'title'        => esc_html__('Project subtitle', 'manit'),
            'add_title' => esc_html__('Add Project title', 'manit'),
            'attributes' => array(
              'placeholder' => esc_html__('Development / Idea', 'manit'),
            ),
            'info'    => esc_html__('Write Project Title.', 'manit'),
          ),   
           // Start fields
        ),
      ),

    ),
  );



 // -----------------------------------------
  // Service
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'service_options',
    'title'     => esc_html__('Service Meta', 'manit'),
    'post_type' => 'service',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'service_infos',
        'fields' => array(
         array(
            'id'           => 'service_icon',
            'type'         => 'image',
            'title'        => esc_html__('Service Icon', 'manit'),
            'add_title' => esc_html__('Service Icon', 'manit'),
            'info'    => esc_html__('Attached Icon.', 'manit'),
          ), 
         array(
            'id'           => 'service_image',
            'type'         => 'image',
            'title'        => esc_html__('Service Image', 'manit'),
            'add_title' => esc_html__('Service Image', 'manit'),
            'info'    => esc_html__('Attached Image.', 'manit'),
          ),

        ),
      ),
    ),
  );


if (class_exists( 'WooCommerce' )){ 
   // -----------------------------------------
    // Product
    // -----------------------------------------
    $options[]    = array(
      'id'        => 'manit_woocommerce_section',
      'title'     => esc_html__('Product Title', 'manit'),
      'post_type' => 'product',
      'context'   => 'normal',
      'priority'  => 'high',
      'sections'  => array(

        // All Post Formats
        array(
          'name'   => 'manit_single_title',
          'fields' => array(
            array(
              'id'          => 'manit_product_title',
              'type'        => 'text',
              'title'       => esc_html__('Single Title', 'manit'),
              'attributes' => array(
                'placeholder' => 'The Title Gose Here'
              ),
            ),

          ),
        ),

      ),
    );
}
// -----------------------------------------
  // Donation Forms
  // -----------------------------------------
  $options[]    = array(
    'id'        => '_donation_form_metabox',
    'title'     => esc_html__('Donation Deadline', 'manit'),
    'post_type' => 'give_forms',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_deadline',
        'fields' => array(
          array(
            'id'          => 'donation_deadline',
            'type'        => 'text',
            'title'       => esc_html__('Deadline Date', 'manit'),
            'attributes' => array(
              'placeholder' => 'DD/MM/YYYY'
            ),
          ),
          // Gallery

        ),
      ),

    ),
  );
  

   // -----------------------------------------
  // Team
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'team_options',
    'title'     => esc_html__('Team Meta', 'manit'),
    'post_type' => 'team',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'team_infos',
        'fields' => array(
          array(
            'title'   => esc_html__('Team Sub Title', 'manit'),
            'id'      => 'team_subtitle',
            'type'    => 'text',
            'attributes' => array(
              'placeholder' => esc_html__('Volunteer', 'manit'),
            ),
            'info'    => esc_html__('Write Team Subtitle.', 'manit'),
          ),
          // Start fields
          array(
            'id'                  => 'team_socials',
            'title'   => esc_html__('Team Social', 'manit'),
            'type'                => 'group',
            'fields'              => array(
              array(
                'id'              => 'social_icon',
                'type'            => 'icon',
                'attributes' => array(
                    'placeholder' => esc_html__('Facebook', 'manit'),
                  ),
                'title'           => esc_html__('Social Icon', 'manit'),
              ),
              array(
                'id'              => 'social_link',
                'type'            => 'text',
                'attributes' => array(
                    'placeholder' => esc_html__('#', 'manit'),
                  ),
                'title'           => esc_html__('Socail Link', 'manit'),
              ),
            ),
            'button_title'        => esc_html__('Add Social', 'manit'),
            'accordion_title'     => esc_html__('Team Social ', 'manit'),
          ),
         array(
            'id'           => 'team_image',
            'type'         => 'image',
            'title'        => esc_html__('Team Grid', 'manit'),
            'add_title' => esc_html__('Team Image', 'manit'),
            'info'    => esc_html__('Attached Team Grid Image.', 'manit'),
          ),

        ),
      ),
    ),
  );


  // -----------------------------------------
  // Causes
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'causes_options',
    'title'     => esc_html__('Causes Extra Options', 'manit'),
    'post_type' => 'give_forms',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'causes_option_section',
        'fields' => array(
         array(
            'id'           => 'causes_image',
            'type'         => 'image',
            'title'        => esc_html__('Causes Image', 'manit'),
            'add_title' => esc_html__('Add Causes Image', 'manit'),
          ),
         array(
            'id'           => 'causes_slide_image',
            'type'         => 'image',
            'title'        => esc_html__('Grid Image', 'manit'),
            'add_title' => esc_html__('Add Carousel Image', 'manit'),
          ),
        ),
      ),

    ),
  );

  // -----------------------------------------
  // post options
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_options',
    'title'     => esc_html__('Grid Image', 'manit'),
    'post_type' => 'post',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'post_option_section',
        'fields' => array(
          array(
            'id'           => 'grid_image',
            'type'         => 'image',
            'title'        => esc_html__('Grid Image', 'manit'),
            'add_title' => esc_html__('Add Grid Image', 'manit'),
          ),
          array(
            'id'           => 'widget_post_title',
            'type'         => 'text',
            'title'        => esc_html__('Widget Post Title', 'manit'),
            'add_title' => esc_html__('Add Widget Post Title here', 'manit'),
          ),
        ),
      ),

    ),
  );


  return $options;

}
add_filter( 'cs_metabox_options', 'manit_metabox_options' );