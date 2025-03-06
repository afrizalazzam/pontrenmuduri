<?php
/*
 * Recent Post Widget
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
class manit_recent_posts extends WP_Widget {

  /**
   * Specifies the widget name, description, class name and instatiates it
   */
  public function __construct() {
    parent::__construct(
      '-recent-blog',
      MANIT_THEME_NAME_PLUGIN . esc_html__( ': Recent Posts', 'manit' ),
      array(
        'classname'   => 'recent-post-widget',
        'description' => MANIT_THEME_NAME_PLUGIN . esc_html__( ' widget that displays recent posts.', 'manit' )
      )
    );
  }

  /**
   * Generates the back-end layout for the widget
   */
  public function form( $instance ) {
    // Default Values
    $instance   = wp_parse_args( $instance, array(
      'title'    => esc_html__( 'Recent Posts', 'manit' ),
      'ptypes'   => 'post',
      'limit'    => '3',
      'date'     => true,
      'category' => '',
      'order' => '',
      'orderby' => '',
    ));

    // Title
    $title_value = esc_attr( $instance['title'] );
    $title_field = array(
      'id'    => $this->get_field_name('title'),
      'name'  => $this->get_field_name('title'),
      'type'  => 'text',
      'title' => esc_html__( 'Title :', 'manit' ),
      'wrap_class' => 'cs-widget-fields',
    );
    echo cs_add_element( $title_field, $title_value );

    // Post Type
    $ptypes_value = esc_attr( $instance['ptypes'] );
    $ptypes_field = array(
      'id'    => $this->get_field_name('ptypes'),
      'name'  => $this->get_field_name('ptypes'),
      'type' => 'select',
      'options' => 'post_types',
      'default_option' => esc_html__( 'Select Post Type', 'manit' ),
      'title' => esc_html__( 'Post Type :', 'manit' ),
    );
    echo cs_add_element( $ptypes_field, $ptypes_value );

    // Limit
    $limit_value = esc_attr( $instance['limit'] );
    $limit_field = array(
      'id'    => $this->get_field_name('limit'),
      'name'  => $this->get_field_name('limit'),
      'type'  => 'text',
      'title' => esc_html__( 'Limit :', 'manit' ),
      'help' => esc_html__( 'How many posts want to show?', 'manit' ),
    );
    echo cs_add_element( $limit_field, $limit_value );

    // Date
    $date_value = esc_attr( $instance['date'] );
    $date_field = array(
      'id'    => $this->get_field_name('date'),
      'name'  => $this->get_field_name('date'),
      'type'  => 'switcher',
      'on_text'  => esc_html__( 'Yes', 'manit' ),
      'off_text'  => esc_html__( 'No', 'manit' ),
      'title' => esc_html__( 'Display Date :', 'manit' ),
    );
    echo cs_add_element( $date_field, $date_value );

    // Category
    $category_value = esc_attr( $instance['category'] );
    $category_field = array(
      'id'    => $this->get_field_name('category'),
      'name'  => $this->get_field_name('category'),
      'type'  => 'text',
      'title' => esc_html__( 'Category :', 'manit' ),
      'help' => esc_html__( 'Enter category slugs with comma(,) for multiple items', 'manit' ),
    );
    echo cs_add_element( $category_field, $category_value );

    // Order
    $order_value = esc_attr( $instance['order'] );
    $order_field = array(
      'id'    => $this->get_field_name('order'),
      'name'  => $this->get_field_name('order'),
      'type' => 'select',
      'options'   => array(
        'ASC' => 'Ascending',
        'DESC' => 'Descending',
      ),
      'default_option' => esc_html__( 'Select Order', 'manit' ),
      'title' => esc_html__( 'Order :', 'manit' ),
    );
    echo cs_add_element( $order_field, $order_value );

    // Orderby
    $orderby_value = esc_attr( $instance['orderby'] );
    $orderby_field = array(
      'id'    => $this->get_field_name('orderby'),
      'name'  => $this->get_field_name('orderby'),
      'type' => 'select',
      'options'   => array(
        'none' => esc_html__('None', 'manit'),
        'ID' => esc_html__('ID', 'manit'),
        'author' => esc_html__('Author', 'manit'),
        'title' => esc_html__('Title', 'manit'),
        'name' => esc_html__('Name', 'manit'),
        'type' => esc_html__('Type', 'manit'),
        'date' => esc_html__('Date', 'manit'),
        'modified' => esc_html__('Modified', 'manit'),
        'rand' => esc_html__('Random', 'manit'),
      ),
      'default_option' => esc_html__( 'Select OrderBy', 'manit' ),
      'title' => esc_html__( 'OrderBy :', 'manit' ),
    );
    echo cs_add_element( $orderby_field, $orderby_value );

  }

  /**
   * Processes the widget's values
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    // Update values
    $instance['title']        = strip_tags( stripslashes( $new_instance['title'] ) );
    $instance['ptypes']       = strip_tags( stripslashes( $new_instance['ptypes'] ) );
    $instance['limit']        = strip_tags( stripslashes( $new_instance['limit'] ) );
    $instance['date']         = strip_tags( stripslashes( $new_instance['date'] ) );
    $instance['category']     = strip_tags( stripslashes( $new_instance['category'] ) );
    $instance['order']        = strip_tags( stripslashes( $new_instance['order'] ) );
    $instance['orderby']      = strip_tags( stripslashes( $new_instance['orderby'] ) );

    return $instance;
  }

  /**
   * Output the contents of the widget
   */
  public function widget( $args, $instance ) {
    // Extract the arguments
    extract( $args );

    $title          = apply_filters( 'widget_title', $instance['title'] );
    $ptypes         = $instance['ptypes'];
    $limit          = $instance['limit'];
    $display_date   = $instance['date'];
    $category       = $instance['category'];
    $order          = $instance['order'];
    $orderby        = $instance['orderby'];

    $args = array(
      // other query params here,
      'post_type' => esc_attr($ptypes),
      'posts_per_page' => (int)$limit,
      'orderby' => esc_attr($orderby),
      'order' => esc_attr($order),
      'category_name' => esc_attr($category),
      'ignore_sticky_posts' => 1,
     );

     $manit_rpw = new WP_Query( $args );
     global $post;

    // Display the markup before the widget
    echo $before_widget;

    if ( $title ) {
      echo $before_title . $title . $after_title;
    }
    echo '<div class="posts">';
    if ($manit_rpw->have_posts()) : while ($manit_rpw->have_posts()) : $manit_rpw->the_post();
      $post_options = get_post_meta( get_the_ID(), 'post_options', true );
      $grid_image = isset( $post_options['grid_image'] ) ? $post_options['grid_image'] : '';
      $widget_post_title = isset( $post_options['widget_post_title'] ) ? $post_options['widget_post_title'] : '';

      $image_url = wp_get_attachment_url( $grid_image );
      $image_alt = get_post_meta( $grid_image , '_wp_attachment_image_alt', true);
      ?>
    <div class="post">
      <div class="img-holder">
          <a href="<?php echo esc_url( get_permalink() ); ?>">
            <img src="<?php echo esc_url(  $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
          </a>
      </div>
      <div class="details">
         <h4><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( $widget_post_title ); ?></a></h4>
          <?php if ($display_date === '1') { ?>
             <span class="date">
              <i class="ti-timer"></i>
              <?php  echo get_the_date('d M Y'); ?>
            </span>
           <?php } ?>
      </div>
   </div>
  <?php
    endwhile; endif;
    echo '</div>';
    wp_reset_postdata();
    // Display the markup after the widget
    echo $after_widget;
  }
}

// Register the widget using an annonymous function
add_action( 'widgets_init', function() { register_widget( "manit_recent_posts" ); } );