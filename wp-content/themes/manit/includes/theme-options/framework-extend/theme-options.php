<?php
/*
 * All Theme Options for Manit theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function manit_settings( $settings ) {

  $settings           = array(
    'menu_title'      => MANIT_NAME . esc_html__(' Options', 'manit'),
    'menu_slug'       => sanitize_title(MANIT_NAME) . '_options',
    'menu_type'       => 'theme',
    'menu_icon'       => 'dashicons-awards',
    'menu_position'   => '4',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => MANIT_NAME .' <small>V-'. MANIT_VERSION .' by <a href="'. MANIT_BRAND_URL .'" target="_blank">'. MANIT_BRAND_NAME .'</a></small>',
  );

  return $settings;

}
add_filter( 'cs_framework_settings', 'manit_settings' );

// Theme Framework Options
function manit_options( $options ) {

  $header = get_posts( 'post_type="headerbuilder"&numberposts=-1' );
  $headers = array( 'default' => esc_html__( 'Default', 'manit' ) );
  if ( $header ) {
    foreach ( $header as $head ) {
      $headers[ $head->ID ] = $head->post_title;
    }
  }
  $footer = get_posts( 'post_type="footerbuilder"&numberposts=-1' );
  $footers = array( 'default' => esc_html__( 'Default', 'manit' ));
  if ( $footer ) {
    foreach ( $footer as $foot ) {
      $footers[ $foot->ID ] = $foot->post_title;
    }
  }

  $options      = array(); // remove old options

  // ------------------------------
  // Branding
  // ------------------------------
  $options[]   = array(
    'name'     => 'manit_theme_branding',
    'title'    => esc_html__('Site Brand', 'manit'),
    'icon'     => 'fa fa-address-book-o',
    'sections' => array(

      // brand logo tab
      array(
        'name'     => 'brand_logo',
        'title'    => esc_html__('Logo', 'manit'),
        'icon'     => 'fa fa-picture-o',
        'fields'   => array(

          // Site Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Site Logo', 'manit')
          ),
          array(
            'id'    => 'manit_logo',
            'type'  => 'image',
            'title' => esc_html__('Default Logo', 'manit'),
            'info'  => esc_html__('Upload your default logo here. If you not upload, then site title will load in this logo location.', 'manit'),
            'add_title' => esc_html__('Add Logo', 'manit'),
          ),
          array(
            'id'          => 'manit_logo_top',
            'type'        => 'number',
            'title'       => esc_html__('Logo Top Space', 'manit'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'manit_logo_bottom',
            'type'        => 'number',
            'title'       => esc_html__('Logo Bottom Space', 'manit'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          // WordPress Admin Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('WordPress Admin Logo', 'manit')
          ),
          array(
            'id'    => 'brand_logo_wp',
            'type'  => 'image',
            'title' => esc_html__('Login logo', 'manit'),
            'info'  => esc_html__('Upload your WordPress login page logo here.', 'manit'),
            'add_title' => esc_html__('Add Login Logo', 'manit'),
          ),
        ) // end: fields
      ), // end: section
    ),
  );

  // ------------------------------
  // Layout
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_layout',
    'title'  => esc_html__('Theme Layout', 'manit'),
    'icon'   => 'fa fa-th-large'
  );

  $options[]      = array(
    'name'        => 'theme_general',
    'title'       => esc_html__('General Settings', 'manit'),
    'icon'        => 'fa fa-cog',

    // begin: fields
    'fields'      => array(

      // -----------------------------
      // Begin: Responsive
      // -----------------------------
       array(
        'id'    => 'theme_responsive',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Responsive', 'manit'),
        'info' => esc_html__('Turn on if you don\'t want your site to be responsive.', 'manit'),
        'default' => false,
      ),
      array(
        'id'    => 'theme_preloder',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Preloder', 'manit'),
        'info' => esc_html__('Turn off if you don\'t want your site to be Preloder.', 'manit'),
        'default' => true,
      ),
       array(
        'id'    => 'preloader_image',
        'type'  => 'image',
        'title' => esc_html__('Preloader Logo', 'manit'),
        'info'  => esc_html__('Upload your preoader logo here. If you not upload, then site preoader will load in this preloader location.', 'manit'),
        'add_title' => esc_html__('Add Logo', 'manit'),
        'dependency' => array( 'theme_preloder', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_width',
        'type'  => 'image_select',
        'title' => esc_html__('Full Width & Extra Width', 'manit'),
        'info' => esc_html__('Boxed or Fullwidth? Choose your site layout width. Default : Full Width', 'manit'),
        'options'      => array(
          'container'    => MANIT_CS_IMAGES .'/boxed-width.jpg',
          'container-fluid'    => MANIT_CS_IMAGES .'/full-width.jpg',
        ),
        'default'      => 'container-fluid',
        'radio'      => true,
      ),
       array(
        'id'    => 'theme_page_comments',
        'type'  => 'switcher',
        'title' => esc_html__('Hide Page Comments?', 'manit'),
        'label' => esc_html__('Yes! Hide Page Comments.', 'manit'),
        'on_text' => esc_html__('Yes', 'manit'),
        'off_text' => esc_html__('No', 'manit'),
        'default' => false,
      ),
      array(
        'type'    => 'notice',
        'class'   => 'info cs-manit-heading',
        'content' => esc_html__('Background Options', 'manit'),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'             => 'theme_layout_bg_type',
        'type'           => 'select',
        'title'          => esc_html__('Background Type', 'manit'),
        'options'        => array(
          'bg-image' => esc_html__('Image', 'manit'),
          'bg-pattern' => esc_html__('Pattern', 'manit'),
        ),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_bg_pattern',
        'type'  => 'image_select',
        'title' => esc_html__('Background Pattern', 'manit'),
        'info' => esc_html__('Select background pattern', 'manit'),
        'options'      => array(
          'pattern-1'    => MANIT_CS_IMAGES . '/pattern-1.png',
          'pattern-2'    => MANIT_CS_IMAGES . '/pattern-2.png',
          'pattern-3'    => MANIT_CS_IMAGES . '/pattern-3.png',
          'pattern-4'    => MANIT_CS_IMAGES . '/pattern-4.png',
          'custom-pattern'  => MANIT_CS_IMAGES . '/pattern-5.png',
        ),
        'default'      => 'pattern-1',
        'radio'      => true,
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-pattern' ),
      ),
      array(
        'id'      => 'custom_bg_pattern',
        'type'    => 'upload',
        'title'   => esc_html__('Custom Pattern', 'manit'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type|theme_layout_bg_pattern_custom-pattern', '==|==|==', 'true|bg-pattern|true' ),
        'info' => __('Select your custom background pattern. <br />Note, background pattern image will be repeat in all x and y axis. So, please consider all repeatable area will perfectly fit your custom patterns.', 'manit'),
      ),
      array(
        'id'      => 'theme_layout_bg',
        'type'    => 'background',
        'title'   => esc_html__('Background', 'manit'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-image' ),
      ),

    ), // end: fields

  );

  // ------------------------------
  // Header Sections
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_header_tab',
    'title'    => esc_html__('Header Settings', 'manit'),
    'icon'     => 'fa fa-header',
    'sections' => array(

      // header design tab
      array(
        'name'     => 'header_design_tab',
        'title'    => esc_html__('Design', 'manit'),
        'icon'     => 'fa fa-magic',
        'fields'   => array(

          // Header Select
          array(
            'id'           => 'select_header_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Header Design', 'manit'),
            'options'      => $headers,
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'        => true,
            'default'   => 'default',
            'info' => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'manit'),
          ),
          // Header Select

          // Extra's
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Extra\'s', 'manit'),
          ),
          array(
            'id'    => 'sticky_header',
            'type'  => 'switcher',
            'title' => esc_html__('Sticky Header', 'manit'),
            'info' => esc_html__('Turn On if you want your naviagtion bar on sticky.', 'manit'),
            'default' => true,
          ),
          array(
            'id'    => 'manit_cart_widget',
            'type'  => 'switcher',
            'title' => esc_html__('Header Cart', 'manit'),
            'info' => esc_html__('Turn On if you want to Show Header Cart .', 'manit'),
            'default' => false,
          ),
          array(
            'id'    => 'manit_header_search',
            'type'  => 'switcher',
            'title' => esc_html__('Header Search', 'manit'),
            'info' => esc_html__('Turn On if you want to Hide Header Search .', 'manit'),
            'default' => false,
          ),
          array(
            'id'    => 'manit_menu_cta',
            'type'  => 'switcher',
            'title' => esc_html__('Header CTA', 'manit'),
            'info' => esc_html__('Turn On if you want to Show Header CTA .', 'manit'),
            'default' => false,
          ),
          array(
            'id'    => 'header_cta_text',
            'type'  => 'text',
            'title' => esc_html__('Header CTA Text', 'manit'),
            'info' => esc_html__('Write Header CTA Text here.', 'manit'),
            'type'        => 'text',
            'default' => 'Free Consulting',
            'dependency'  => array('manit_menu_cta', '==', true),
          ),
          array(
            'id'    => 'header_cta_link',
            'type'  => 'text',
            'title' => esc_html__('Header CTA Link', 'manit'),
            'info' => esc_html__('Write Header CTA Link here.', 'manit'),
            'type'        => 'text',
            'default' => '#',
            'dependency'  => array('manit_menu_cta', '==', true),
          ),
        )
      ),

      // header top bar
      array(
        'name'     => 'header_top_bar_tab',
        'title'    => esc_html__('Top Bar', 'manit'),
        'icon'     => 'fa fa-minus',
        'fields'   => array(

          array(
            'id'          => 'top_bar',
            'type'        => 'switcher',
            'title'       => esc_html__('Hide Top Bar', 'manit'),
            'on_text'     => esc_html__('Yes', 'manit'),
            'off_text'    => esc_html__('No', 'manit'),
            'default'     => true,
          ),
          array(
            'id'          => 'top_left',
            'title'       => esc_html__('Top left Block', 'manit'),
            'desc'        => esc_html__('Top bar left block.', 'manit'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
          array(
            'id'          => 'top_right',
            'title'       => esc_html__('Top Right Block', 'manit'),
            'desc'        => esc_html__('Top bar right block.', 'manit'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
        )
      ),

      // header banner
      array(
        'name'     => 'header_banner_tab',
        'title'    => esc_html__('Title Bar (or) Banner', 'manit'),
        'icon'     => 'fa fa-bullhorn',
        'fields'   => array(

          // Title Area
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Title Area', 'manit')
          ),
          array(
            'id'      => 'need_title_bar',
            'type'    => 'switcher',
            'title'   => esc_html__('Title Bar ?', 'manit'),
            'label'   => esc_html__('If you want to Hide title bar in your sub-pages, please turn this ON.', 'manit'),
            'default'    => false,
          ),
          array(
            'id'             => 'title_bar_padding',
            'type'           => 'select',
            'title'          => esc_html__('Padding Spaces Top & Bottom', 'manit'),
            'options'        => array(
              'padding-default' => esc_html__('Default Spacing', 'manit'),
              'padding-custom' => esc_html__('Custom Padding', 'manit'),
            ),
            'dependency'   => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'             => 'titlebar_top_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Top', 'manit'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),
          array(
            'id'             => 'titlebar_bottom_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Bottom', 'manit'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Background Options', 'manit'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'      => 'titlebar_bg_overlay_color',
            'type'    => 'color_picker',
            'title'   => esc_html__('Overlay Color', 'manit'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'manit'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Breadcrumbs', 'manit'),
          ),
         array(
            'id'      => 'need_breadcrumbs',
            'type'    => 'switcher',
            'title'   => esc_html__('Hide Breadcrumbs', 'manit'),
            'label'   => esc_html__('If you want to hide breadcrumbs in your banner, please turn this ON.', 'manit'),
            'default'    => false,
          ),
        )
      ),

    ),
  );

  // ------------------------------
  // Footer Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'footer_section',
    'title'    => esc_html__('Footer Settings', 'manit'),
    'icon'     => 'fa fa-tasks',
    'sections' => array(

      // footer widgets
      array(
        'name'     => 'footer_widgets_tab',
        'title'    => esc_html__('Widget Area', 'manit'),
        'icon'     => 'fa fa-th',
        'fields'   => array(
          array(
            'id'           => 'select_footer_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Footer Design', 'manit'),
            'options'      => $footers,
            'attributes' => array(
              'data-depend-id' => 'footer_design',
            ),
            'radio'        => true,
            'default'   => 'default',
            'info' => esc_html__('Select your footer design, following options will may differ based on your selection of footer design.', 'manit'),
          ),
          // Footer Widget Block
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Footer Widget Block', 'manit')
          ),
          array(
            'id'    => 'footer_widget_block',
            'type'  => 'switcher',
            'title' => esc_html__('Enable Widget Block', 'manit'),
            'info' => __('If you turn this ON, then Goto : Appearance > Widgets. There you can see <strong>Footer Widget 1,2,3 or 4</strong> Widget Area, add your widgets there.', 'manit'),
            'default' => true,
          ),
          array(
            'id'    => 'footer_widget_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Widget Layouts', 'manit'),
            'info' => esc_html__('Choose your footer widget theme-layouts.', 'manit'),
            'default' => 4,
            'options' => array(
              1   => MANIT_CS_IMAGES . '/footer/footer-1.png',
              2   => MANIT_CS_IMAGES . '/footer/footer-2.png',
              3   => MANIT_CS_IMAGES . '/footer/footer-3.png',
              4   => MANIT_CS_IMAGES . '/footer/footer-4.png',
              5   => MANIT_CS_IMAGES . '/footer/footer-5.png',
              6   => MANIT_CS_IMAGES . '/footer/footer-6.png',
              7   => MANIT_CS_IMAGES . '/footer/footer-7.png',
              8   => MANIT_CS_IMAGES . '/footer/footer-8.png',
              9   => MANIT_CS_IMAGES . '/footer/footer-9.png',
            ),
            'radio'       => true,
            'dependency'  => array('footer_widget_block', '==', true),
          ),
           array(
            'id'    => 'manit_ft_bg',
            'type'  => 'image',
            'title' => esc_html__('Footer Background', 'manit'),
            'info'  => esc_html__('Upload your footer background.', 'manit'),
            'add_title' => esc_html__('footer background', 'manit'),
            'dependency'  => array('footer_widget_block', '==', true),
          ),

        )
      ),

      // footer copyright
      array(
        'name'     => 'footer_copyright_tab',
        'title'    => esc_html__('Copyright Bar', 'manit'),
        'icon'     => 'fa fa-copyright',
        'fields'   => array(

          // Copyright
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Copyright Layout', 'manit'),
          ),
         array(
            'id'    => 'hide_copyright',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Copyright?', 'manit'),
            'default' => false,
            'on_text' => esc_html__('Yes', 'manit'),
            'off_text' => esc_html__('No', 'manit'),
            'label' => esc_html__('Yes, do it!', 'manit'),
          ),
          array(
            'id'    => 'footer_copyright_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Select Copyright Layout', 'manit'),
            'info' => esc_html__('In above image, blue box is copyright text and yellow box is secondary text.', 'manit'),
            'default'      => 'copyright-3',
            'options'      => array(
              'copyright-1'    => MANIT_CS_IMAGES .'/footer/copyright-1.png',
              ),
            'radio'        => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'copyright_text',
            'type'  => 'textarea',
            'title' => esc_html__('Copyright Text', 'manit'),
            'shortcode' => true,
            'dependency' => array('hide_copyright', '!=', true),
            'after'       => 'Helpful shortcodes: [current_year] [home_url] or any shortcode.',
          ),

          // Copyright Another Text
          array(
            'type'    => 'notice',
            'class'   => 'warning cs-manit-heading',
            'content' => esc_html__('Copyright Secondary Text', 'manit'),
             'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'secondary_text',
            'type'  => 'textarea',
            'title' => esc_html__('Secondary Text', 'manit'),
            'shortcode' => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),

        )
      ),

    ),
  );

  // ------------------------------
  // Design
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_design',
    'title'  => esc_html__('Theme Design', 'manit'),
    'icon'   => 'fa fa-sliders'
  );

  // ------------------------------
  // color section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_color_section',
    'title'    => esc_html__('Colors', 'manit'),
    'icon'     => 'fa fa-eyedropper',
    'fields' => array(

      array(
        'type'    => 'heading',
        'content' => esc_html__('Color Options', 'manit'),
      ),
      array(
        'type'    => 'subheading',
        'wrap_class' => 'color-tab-content',
        'content' => esc_html__('All color options are available in our theme customizer. The reason of we used customizer options for color section is because, you can choose each part of color from there and see the changes instantly using customizer. Highly customizable colors are in Appearance > Customize', 'manit'),
      ),

    ),
  );

  // ------------------------------
  // Typography section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_typo_section',
    'title'    => esc_html__('Typography', 'manit'),
    'icon'     => 'fa fa-header',
    'fields' => array(

      // Start fields
      array(
        'id'                  => 'typography',
        'type'                => 'group',
        'fields'              => array(
          array(
            'id'              => 'title',
            'type'            => 'text',
            'title'           => esc_html__('Title', 'manit'),
          ),
          array(
            'id'              => 'selector',
            'type'            => 'textarea',
            'title'           => esc_html__('Selector', 'manit'),
            'info'           => wp_kses( __('Enter css selectors like : <strong>body, .custom-class</strong>', 'manit'), array( 'strong' => array() ) ),
          ),
          array(
            'id'              => 'font',
            'type'            => 'typography',
            'title'           => esc_html__('Font Family', 'manit'),
          ),
          array(
            'id'              => 'size',
            'type'            => 'text',
            'title'           => esc_html__('Font Size', 'manit'),
          ),
          array(
            'id'              => 'line_height',
            'type'            => 'text',
            'title'           => esc_html__('Line-Height', 'manit'),
          ),
          array(
            'id'              => 'css',
            'type'            => 'textarea',
            'title'           => esc_html__('Custom CSS', 'manit'),
          ),
        ),
        'button_title'        => esc_html__('Add New Typography', 'manit'),
        'accordion_title'     => esc_html__('New Typography', 'manit'),
      ),

      // Subset
      array(
        'id'                  => 'subsets',
        'type'                => 'select',
        'title'               => esc_html__('Subsets', 'manit'),
        'class'               => 'chosen',
        'options'             => array(
          'latin'             => 'latin',
          'latin-ext'         => 'latin-ext',
          'cyrillic'          => 'cyrillic',
          'cyrillic-ext'      => 'cyrillic-ext',
          'greek'             => 'greek',
          'greek-ext'         => 'greek-ext',
          'vietnamese'        => 'vietnamese',
          'devanagari'        => 'devanagari',
          'khmer'             => 'khmer',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Subsets',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( 'latin' ),
      ),

      array(
        'id'                  => 'font_weight',
        'type'                => 'select',
        'title'               => esc_html__('Font Weights', 'manit'),
        'class'               => 'chosen',
        'options'             => array(
          '100'   => esc_html__('Thin 100', 'manit'),
          '100i'  => esc_html__('Thin 100 Italic', 'manit'),
          '200'   => esc_html__('Extra Light 200', 'manit'),
          '200i'  => esc_html__('Extra Light 200 Italic', 'manit'),
          '300'   => esc_html__('Light 300', 'manit'),
          '300i'  => esc_html__('Light 300 Italic', 'manit'),
          '400'   => esc_html__('Regular 400', 'manit'),
          '400i'  => esc_html__('Regular 400 Italic', 'manit'),
          '500'   => esc_html__('Medium 500', 'manit'),
          '500i'  => esc_html__('Medium 500 Italic', 'manit'),
          '600'   => esc_html__('Semi Bold 600', 'manit'),
          '600i'  => esc_html__('Semi Bold 600 Italic', 'manit'),
          '700'   => esc_html__('Bold 700', 'manit'),
          '700i'  => esc_html__('Bold 700 Italic', 'manit'),
          '800'   => esc_html__('Extra Bold 800', 'manit'),
          '800i'  => esc_html__('Extra Bold 800 Italic', 'manit'),
          '900'   => esc_html__('Black 900', 'manit'),
          '900i'  => esc_html__('Black 900 Italic', 'manit'),
        ),
        'attributes'         => array(
          'data-placeholder' => esc_html__('Font Weight', 'manit'),
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( '400' ),
      ),

      // Custom Fonts Upload
      array(
        'id'                 => 'font_family',
        'type'               => 'group',
        'title'              => esc_html__('Upload Custom Fonts', 'manit'),
        'button_title'       => esc_html__('Add New Custom Font', 'manit'),
        'accordion_title'    => esc_html__('Adding New Font', 'manit'),
        'accordion'          => true,
        'desc'               => esc_html__('It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!', 'manit'),
        'fields'             => array(

          array(
            'id'             => 'name',
            'type'           => 'text',
            'title'          => esc_html__('Font-Family Name', 'manit'),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. Arial', 'manit')
            ),
          ),

          array(
            'id'             => 'ttf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .ttf <small><i>(optional)</i></small>', 'manit'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'manit'),
              'button_title' => wp_kses(__('Upload <i>.ttf</i>', 'manit'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'eot',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .eot <small><i>(optional)</i></small>', 'manit'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'manit'),
              'button_title' => wp_kses(__('Upload <i>.eot</i>', 'manit'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'otf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .otf <small><i>(optional)</i></small>', 'manit'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'manit'),
              'button_title' => wp_kses(__('Upload <i>.otf</i>', 'manit'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'woff',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .woff <small><i>(optional)</i></small>', 'manit'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'manit'),
              'button_title' =>wp_kses(__('Upload <i>.woff</i>', 'manit'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'css',
            'type'           => 'textarea',
            'title'          => wp_kses(__('Extra CSS Style <small><i>(optional)</i></small>', 'manit'), array( 'small' => array(), 'i' => array() )),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. font-weight: normal;', 'manit'),
            ),
          ),

        ),
      ),
      // End All field

    ),
  );

  // ------------------------------
  // Pages
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_pages',
    'title'  => esc_html__('Custom Pages', 'manit'),
    'icon'   => 'fa fa-folder-open-o'
  );


  // ------------------------------
  // Service Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'service_section',
    'title'    => esc_html__('Service Settings', 'manit'),
    'icon'     => 'fa fa-server',
    'fields' => array(

      // service name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'manit')
      ),
      array(
        'id'      => 'theme_service_name',
        'type'    => 'text',
        'title'   => esc_html__('Service Name', 'manit'),
        'attributes'     => array(
          'placeholder'  => 'Service'
        ),
      ),
      array(
        'id'      => 'theme_service_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Slug', 'manit'),
        'attributes'     => array(
          'placeholder'  => 'service-item'
        ),
      ),
      array(
        'id'      => 'theme_service_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Category Slug', 'manit'),
        'attributes'     => array(
          'placeholder'  => 'service-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set service slug and page slug as same. It\'ll not work.', 'manit')
      ),
      // Service Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-manit-heading',
        'content' => esc_html__('Service Single', 'manit')
      ),
      array(
          'id'             => 'service_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'manit'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'manit'),
            'sidebar-left' => esc_html__('Left', 'manit'),
            'sidebar-hide' => esc_html__('Hide', 'manit'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'manit'),
        ),
        array(
          'id'             => 'single_service_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'manit'),
          'options'        => manit_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'manit'),
          'dependency'     => array('service_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'manit'),
        ),
        array(
          'id'    => 'service_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'manit'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'manit'),
          'default' => true,
        ),
    ),
  );

  
  // ------------------------------
  // Project Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'event_section',
    'title'    => esc_html__('Project Settings', 'manit'),
    'icon'     => 'fa fa-medkit',
    'fields' => array(

      // project name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'manit')
      ),
      array(
        'id'      => 'theme_event_name',
        'type'    => 'text',
        'title'   => esc_html__('Project Name', 'manit'),
        'attributes'     => array(
          'placeholder'  => 'Project'
        ),
      ),
      array(
        'id'      => 'theme_event_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Slug', 'manit'),
        'attributes'     => array(
          'placeholder'  => 'project-item'
        ),
      ),
      array(
        'id'      => 'theme_event_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Category Slug', 'manit'),
        'attributes'     => array(
          'placeholder'  => 'project-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set project slug and page slug as same. It\'ll not work.', 'manit')
      ),

      // Project Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-manit-heading',
        'content' => esc_html__('Project Single', 'manit')
      ),
      array(
          'id'             => 'event_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'manit'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'manit'),
            'sidebar-left' => esc_html__('Left', 'manit'),
            'sidebar-hide' => esc_html__('Hide', 'manit'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'manit'),
        ),
        array(
          'id'             => 'single_event_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'manit'),
          'options'        => manit_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'manit'),
          'dependency'     => array('event_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'manit'),
        ),
        array(
          'id'    => 'event_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'manit'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'manit'),
          'default' => true,
        ),
    ),
  );

  // ------------------------------
  // Blog Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'blog_section',
    'title'    => esc_html__('Blog Settings', 'manit'),
    'icon'     => 'fa fa-newspaper-o',
    'sections' => array(

      // blog general section
      array(
        'name'     => 'blog_general_tab',
        'title'    => esc_html__('General', 'manit'),
        'icon'     => 'fa fa-cog',
        'fields'   => array(

          // Layout
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Layout', 'manit')
          ),
          array(
            'id'             => 'blog_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'manit'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'manit'),
              'sidebar-left' => esc_html__('Left', 'manit'),
              'sidebar-hide' => esc_html__('Hide', 'manit'),
            ),
            'default_option' => 'Select sidebar position',
            'help'          => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'manit'),
            'info'          => esc_html__('Default option : Right', 'manit'),
          ),
          array(
            'id'             => 'blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'manit'),
            'options'        => manit_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'manit'),
            'dependency'     => array('blog_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'manit'),
          ),
          // Layout
          // Global Options
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Global Options', 'manit')
          ),
          array(
            'id'         => 'theme_exclude_categories',
            'type'       => 'checkbox',
            'title'      => esc_html__('Exclude Categories', 'manit'),
            'info'      => esc_html__('Select categories you want to exclude from blog page.', 'manit'),
            'options'    => 'categories',
          ),
          array(
            'id'      => 'theme_blog_excerpt',
            'type'    => 'text',
            'title'   => esc_html__('Excerpt Length', 'manit'),
            'info'   => esc_html__('Blog short content length, in blog listing pages.', 'manit'),
            'default' => '55',
          ),
          array(
            'id'      => 'theme_metas_hide',
            'type'    => 'checkbox',
            'title'   => esc_html__('Meta\'s to hide', 'manit'),
            'info'    => esc_html__('Check items you want to hide from blog/post meta field.', 'manit'),
            'class'      => 'horizontal',
            'options'    => array(
              'category'   => esc_html__('Category', 'manit'),
              'date'    => esc_html__('Date', 'manit'),
              'author'     => esc_html__('Author', 'manit'),
              'comments'      => esc_html__('Comments', 'manit'),
              'Tag'      => esc_html__('Tag', 'manit'),
            ),
            // 'default' => '30',
          ),
          // End fields

        )
      ),

      // blog single section
      array(
        'name'     => 'blog_single_tab',
        'title'    => esc_html__('Single', 'manit'),
        'icon'     => 'fa fa-sticky-note',
        'fields'   => array(

          // Start fields
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Enable / Disable', 'manit')
          ),
          array(
            'id'    => 'single_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Featured Image', 'manit'),
            'info' => esc_html__('If need to hide featured image from single blog post page, please turn this OFF.', 'manit'),
            'default' => true,
          ),
           array(
            'id'    => 'single_author_info',
            'type'  => 'switcher',
            'title' => esc_html__('Author Info', 'manit'),
            'info' => esc_html__('If need to hide author info on single blog page, please turn this On.', 'manit'),
            'default' => false,
          ),
          array(
            'id'    => 'single_share_option',
            'type'  => 'switcher',
            'title' => esc_html__('Share Option', 'manit'),
            'info' => esc_html__('If need to hide share option on single blog page, please turn this OFF.', 'manit'),
            'default' => true,
          ),
          array(
            'id'    => 'single_comment_form',
            'type'  => 'switcher',
            'title' => esc_html__('Comment Area/Form ?', 'manit'),
            'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this On.', 'manit'),
            'default' => false,
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Sidebar', 'manit')
          ),
          array(
            'id'             => 'single_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'manit'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'manit'),
              'sidebar-left' => esc_html__('Left', 'manit'),
              'sidebar-hide' => esc_html__('Hide', 'manit'),
            ),
            'default_option' => 'Select sidebar position',
            'info'          => esc_html__('Default option : Right', 'manit'),
          ),
          array(
            'id'             => 'single_blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'manit'),
            'options'        => manit_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'manit'),
            'dependency'     => array('single_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'manit'),
          ),
          // End fields

        )
      ),

    ),
  );

if (class_exists( 'WooCommerce' )){
  // ------------------------------
  // WooCommerce Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'woocommerce_section',
    'title'    => esc_html__('WooCommerce', 'manit'),
    'icon'     => 'fa fa-shopping-basket',
    'fields' => array(

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-manit-heading',
        'content' => esc_html__('Layout', 'manit')
      ),
     array(
        'id'             => 'woo_product_columns',
        'type'           => 'select',
        'title'          => esc_html__('Product Column', 'manit'),
        'options'        => array(
          2 => esc_html__('Two Column', 'manit'),
          3 => esc_html__('Three Column', 'manit'),
          4 => esc_html__('Four Column', 'manit'),
        ),
        'default_option' => esc_html__('Select Product Columns', 'manit'),
        'help'          => esc_html__('This style will apply, default woocommerce shop and archive pages.', 'manit'),
      ),
      array(
        'id'             => 'woo_sidebar_position',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Position', 'manit'),
        'options'        => array(
          'right-sidebar' => esc_html__('Right', 'manit'),
          'left-sidebar' => esc_html__('Left', 'manit'),
          'sidebar-hide' => esc_html__('Hide', 'manit'),
        ),
        'default_option' => esc_html__('Select sidebar position', 'manit'),
        'info'          => esc_html__('Default option : Right', 'manit'),
      ),
      array(
        'id'             => 'woo_widget',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Widget', 'manit'),
        'options'        => manit_registered_sidebars(),
        'default_option' => esc_html__('Select Widget', 'manit'),
        'dependency'     => array('woo_sidebar_position', '!=', 'sidebar-hide'),
        'info'          => esc_html__('Default option : Shop Page', 'manit'),
      ),

      array(
        'type'    => 'notice',
        'class'   => 'info cs-manit-heading',
        'content' => esc_html__('Listing', 'manit')
      ),
      array(
        'id'      => 'theme_woo_limit',
        'type'    => 'text',
        'title'   => esc_html__('Product Limit', 'manit'),
        'info'   => esc_html__('Enter the number value for per page products limit.', 'manit'),
      ),
      // End fields

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-manit-heading',
        'content' => esc_html__('Single Product', 'manit')
      ),
      array(
        'id'             => 'woo_related_limit',
        'type'           => 'text',
        'title'          => esc_html__('Related Products Limit', 'manit'),
      ),
      array(
        'id'    => 'woo_single_upsell',
        'type'  => 'switcher',
        'title' => esc_html__('You May Also Like', 'manit'),
        'info' => esc_html__('If you don\'t want \'You May Also Like\' products in single product page, please turn this ON.', 'manit'),
        'default' => false,
      ),
      array(
        'id'    => 'woo_single_related',
        'type'  => 'switcher',
        'title' => esc_html__('Related Products', 'manit'),
        'info' => esc_html__('If you don\'t want \'Related Products\' in single product page, please turn this ON.', 'manit'),
        'default' => false,
      ),
      // End fields

    ),
  );
}

  // ------------------------------
  // Extra Pages
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_extra_pages',
    'title'    => esc_html__('404 & Maintenance', 'manit'),
    'icon'     => 'fa fa-cogs',
    'sections' => array(

      // error 404 page
      array(
        'name'     => 'error_page_section',
        'title'    => esc_html__('404 Page', 'manit'),
        'icon'     => 'fa fa-exclamation-triangle',
        'fields'   => array(

          // Start 404 Page
          array(
            'id'    => 'error_heading',
            'type'  => 'text',
            'title' => esc_html__('404 Page Heading', 'manit'),
            'info'  => esc_html__('Enter 404 page heading.', 'manit'),
          ),
          array(
            'id'    => 'error_subheading',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Sub Heading', 'manit'),
            'info'  => esc_html__('Enter 404 page Sub heading.', 'manit'),
          ),
          array(
            'id'    => 'error_page_content',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Content', 'manit'),
            'info'  => esc_html__('Enter 404 page content.', 'manit'),
            'shortcode' => true,
          ),
          array(
            'id'    => 'error_btn_text',
            'type'  => 'text',
            'title' => esc_html__('Button Text', 'manit'),
            'info'  => esc_html__('Enter BACK TO HOME button text. If you want to change it.', 'manit'),
          ),
          // End 404 Page

        ) // end: fields
      ), // end: fields section

      // maintenance mode page
      array(
        'name'     => 'maintenance_mode_section',
        'title'    => esc_html__('Maintenance Mode', 'manit'),
        'icon'     => 'fa fa-hourglass-half',
        'fields'   => array(

          // Start Maintenance Mode
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('If you turn this ON : Only Logged in users will see your pages. All other visiters will see, selected page of : <strong>Maintenance Mode Page</strong>', 'manit')
          ),
          array(
            'id'             => 'enable_maintenance_mode',
            'type'           => 'switcher',
            'title'          => esc_html__('Maintenance Mode', 'manit'),
            'default'        => false,
          ),
          array(
            'id'             => 'maintenance_mode_page',
            'type'           => 'select',
            'title'          => esc_html__('Maintenance Mode Page', 'manit'),
            'options'        => 'pages',
            'default_option' => esc_html__('Select a page', 'manit'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_title',
            'type'           => 'text',
            'title'          => esc_html__('Maintenance Mode Text', 'manit'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_text',
            'type'           => 'textarea',
            'title'          => esc_html__('Maintenance Mode Text', 'manit'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_bg',
            'type'           => 'background',
            'title'          => esc_html__('Page Background', 'manit'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          // End Maintenance Mode

        ) // end: fields
      ), // end: fields section

    )
  );

  // ------------------------------
  // Advanced
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_advanced',
    'title'  => esc_html__('Advanced Settings', 'manit'),
    'icon'   => 'fa fa-cog'
  );

  // ------------------------------
  // Misc Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'misc_section',
    'title'    => esc_html__('Extra Settings', 'manit'),
    'icon'     => 'fa fa-reorder',
    'sections' => array(

      // custom sidebar section
      array(
        'name'     => 'custom_sidebar_section',
        'title'    => esc_html__('Custom Sidebar', 'manit'),
        'icon'     => 'fa fa-reorder',
        'fields'   => array(

          // start fields
          array(
            'id'              => 'custom_sidebar',
            'title'           => esc_html__('Sidebars', 'manit'),
            'desc'            => esc_html__('Go to Appearance -> Widgets after create sidebars', 'manit'),
            'type'            => 'group',
            'fields'          => array(
              array(
                'id'          => 'sidebar_name',
                'type'        => 'text',
                'title'       => esc_html__('Sidebar Name', 'manit'),
              ),
              array(
                'id'          => 'sidebar_desc',
                'type'        => 'text',
                'title'       => esc_html__('Custom Description', 'manit'),
              )
            ),
            'accordion'       => true,
            'button_title'    => esc_html__('Add New Sidebar', 'manit'),
            'accordion_title' => esc_html__('New Sidebar', 'manit'),
          ),
          // end fields

        )
      ),
      // custom sidebar section

      // Custom CSS/JS
      array(
        'name'        => 'custom_css_js_section',
        'title'       => esc_html__('Custom Codes', 'manit'),
        'icon'        => 'fa fa-code',

        // begin: fields
        'fields'      => array(
          // Start Custom CSS/JS
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Custom JS', 'manit')
          ),
          array(
            'id'             => 'theme_custom_js',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'     => 10,
              'placeholder'     => esc_html__('Enter your JS code here...', 'manit'),
            ),
          ),
          // End Custom CSS/JS

        ) // end: fields
      ),

      // Translation
      array(
        'name'        => 'theme_translation_section',
        'title'       => esc_html__('Translation', 'manit'),
        'icon'        => 'fa fa-language',

        // begin: fields
        'fields'      => array(

          // Start Translation
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Common Texts', 'manit')
          ),
          array(
            'id'          => 'read_more_text',
            'type'        => 'text',
            'title'       => esc_html__('Read More Text', 'manit'),
          ),
          array(
            'id'          => 'view_more_text',
            'type'        => 'text',
            'title'       => esc_html__('View More Text', 'manit'),
          ),
          array(
            'id'          => 'share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'manit'),
          ),
          array(
            'id'          => 'share_on_text',
            'type'        => 'text',
            'title'       => esc_html__('Share On Tooltip Text', 'manit'),
          ),
          array(
            'id'          => 'author_text',
            'type'        => 'text',
            'title'       => esc_html__('Author Text', 'manit'),
          ),
          array(
            'id'          => 'post_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Post Comment Text [Submit Button]', 'manit'),
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('WooCommerce', 'manit')
          ),
          array(
            'id'          => 'add_to_cart_text',
            'type'        => 'text',
            'title'       => esc_html__('Add to Cart Text', 'manit'),
          ),
          array(
            'id'          => 'details_text',
            'type'        => 'text',
            'title'       => esc_html__('Details Text', 'manit'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Pagination', 'manit')
          ),
          array(
            'id'          => 'older_post',
            'type'        => 'text',
            'title'       => esc_html__('Older Posts Text', 'manit'),
          ),
          array(
            'id'          => 'newer_post',
            'type'        => 'text',
            'title'       => esc_html__('Newer Posts Text', 'manit'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-manit-heading',
            'content' => esc_html__('Single Portfolio Pagination', 'manit')
          ),
          array(
            'id'          => 'prev_port',
            'type'        => 'text',
            'title'       => esc_html__('Prev Case Text', 'manit'),
          ),
          array(
            'id'          => 'next_port',
            'type'        => 'text',
            'title'       => esc_html__('Next Case Text', 'manit'),
          ),
          // End Translation

        ) // end: fields
      ),

    ),
  );

  
  // ------------------------------
  // backup                       -
  // ------------------------------
  $options[]   = array(
    'name'     => 'backup_section',
    'title'    => 'Backup',
    'icon'     => 'fa fa-shield',
    'fields'   => array(

      array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'manit'),
      ),

      array(
        'type'    => 'backup',
      ),

    )
  );

  return $options;

}
add_filter( 'cs_framework_options', 'manit_options' );