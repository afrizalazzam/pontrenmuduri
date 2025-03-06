<?php
/*
 * Elementor Manit Causes Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_Causes extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-manit_causes';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Causes', 'manit-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'ti-briefcase';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Causes widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-manit_causes'];
	}

	/**
	 * Register Manit Causes widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){


		$posts = get_posts( 'post_type="give_forms"&numberposts=-1' );
    $PostID = array();
    if ( $posts ) {
      foreach ( $posts as $post ) {
        $PostID[ $post->ID ] = $post->ID;
      }
    } else {
      $PostID[ __( 'No ID\'s found', 'manit' ) ] = 0;
    }


		$this->start_controls_section(
			'section_causes_listing',
			[
				'label' => esc_html__( 'Causes Options', 'manit-core' ),
			]
		);
		$this->add_control(
			'causes_style',
			[
				'label' => esc_html__('Causes Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'manit-core'),
					'style-two' => esc_html__('Style two', 'manit-core'),
					'style-three' => esc_html__('Style Three', 'manit-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your causes style.', 'manit-core'),
			]
		);
		$this->add_control(
			'shape_image',
			[
				'label' => esc_html__( 'Shape Image', 'manit-core' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'causes_style' => array('style-two'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'shape_image2',
			[
				'label' => esc_html__( 'Shape Image 2', 'manit-core' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'causes_style' => array('style-two'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'causes_limit',
			[
				'label' => esc_html__( 'Causes Limit', 'manit-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__( 'Enter the number of items to show.', 'manit-core' ),
			]
		);
		$this->add_control(
			'causes_order',
			[
				'label' => __( 'Order', 'manit-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__( 'Asending', 'manit-core' ),
					'DESC' => esc_html__( 'Desending', 'manit-core' ),
				],
				'default' => 'DESC',
			]
		);
		$this->add_control(
			'causes_orderby',
			[
				'label' => __( 'Order By', 'manit-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'manit-core' ),
					'ID' => esc_html__( 'ID', 'manit-core' ),
					'author' => esc_html__( 'Author', 'manit-core' ),
					'title' => esc_html__( 'Title', 'manit-core' ),
					'date' => esc_html__( 'Date', 'manit-core' ),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'causes_show_id',
			[
				'label' => __( 'Certain ID\'s?', 'manit-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->end_controls_section();// end: Section

		// Sub Title
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__( 'Sub Title', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'manit_subtitle_typography',
				'selector' => '{{WRAPPER}} .manit-causes .wpo-campaign-item .wpo-campaign-content small',
			]
		);
		$this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-causes .wpo-campaign-item .wpo-campaign-content small' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'subtitle_padding',
			[
				'label' => __( 'Title Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .manit-causes .wpo-campaign-item .wpo-campaign-content small' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
	
		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'manit_title_typography',
				'selector' => '{{WRAPPER}} .causes-item .content h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .causes-item .content h2 a' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'title_padding',
			[
				'label' => __( 'Title Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .causes-item .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Meta', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'manit-core' ),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .causes-item .content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .causes-item .content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
	
		// Prograss
		$this->start_controls_section(
			'section_prograss_style',
			[
				'label' => esc_html__( 'Prograss', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'prograss_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .causes-item .content .progress-item .progress .bar' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'prograss_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .causes-item .content .progress-item .progress' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
	


	}

	/**
	 * Render Causes widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$causes_style = !empty($settings['causes_style']) ? $settings['causes_style'] : '';

		$causes_limit = !empty( $settings['causes_limit'] ) ? $settings['causes_limit'] : '';
		$causes_order = !empty( $settings['causes_order'] ) ? $settings['causes_order'] : '';
		$causes_orderby = !empty( $settings['causes_orderby'] ) ? $settings['causes_orderby'] : '';
		$causes_show_id = !empty( $settings['causes_show_id'] ) ? $settings['causes_show_id'] : [];


		if ( $causes_style == 'style-one' ) {
			$container_class = 'container';
		} else {
			$container_class = 'container-fluid';
		}

		// Turn output buffer on
		ob_start();

		// Pagination
		global $paged;
		if( get_query_var( 'paged' ) )
		  $my_page = get_query_var( 'paged' );
		else {
		  if( get_query_var( 'page' ) )
			$my_page = get_query_var( 'page' );
		  else
			$my_page = 1;
		  set_query_var( 'paged', $my_page );
		  $paged = $my_page;
		}

    if ($causes_show_id) {
			$causes_show_id = json_encode( $causes_show_id );
			$causes_show_id = str_replace(array( '[', ']' ), '', $causes_show_id);
			$causes_show_id = str_replace(array( '"', '"' ), '', $causes_show_id);
      $causes_show_id = explode(',',$causes_show_id);
    } else {
      $causes_show_id = '';
    }

		$args = array(
		  // other query params here,
		  'paged' => $my_page,
		  'post_type' => 'give_forms',
		  'posts_per_page' => (int)$causes_limit,
		  'orderby' => $causes_orderby,
		  'order' => $causes_order,
      'post__in' => $causes_show_id,
		);

		$manit_causes = new \WP_Query( $args );

	 	?>

		<div class="wpo-causes-section-s2">
    	<div class="causes-wrap">
        <div class="<?php echo esc_attr( $container_class ); ?>">
          <div class="row g-0 align-items-center">
    				<?php 
    				$unique_id = 0;
						if ( $manit_causes->have_posts()) : while ( $manit_causes->have_posts()) : $manit_causes->the_post();
							$unique_id ++;
						$causes_options = get_post_meta( get_the_ID(), 'causes_options', true );
	          $causes_image = isset( $causes_options['causes_image']) ? $causes_options['causes_image'] : '';
	          $causes_slide_image = isset( $causes_options['causes_slide_image']) ? $causes_options['causes_slide_image'] : '';
	          $case_type = isset( $causes_options['case_type']) ? $causes_options['case_type'] : '';
	          $case_date_time = isset( $causes_options['case_date_time']) ? $causes_options['case_date_time'] : '';
	          $case_location = isset( $causes_options['case_location']) ? $causes_options['case_location'] : '';
	          global $post;

	          $image_url = wp_get_attachment_url( $causes_image );
	          $image_alt = get_post_meta( $causes_image , '_wp_attachment_image_alt', true);

	          
	          $slide_image_url = wp_get_attachment_url( $causes_slide_image );
	          $slide_image_alt = get_post_meta( $causes_slide_image , '_wp_attachment_image_alt', true);

						$form        = new \Give_Donate_Form( get_the_ID() );
						$goal_option = get_post_meta( get_the_ID(), '_give_goal_option', true );
						$goal        = $form->goal;
						$goal        = (int) $goal;
						$goal_format = get_post_meta( get_the_ID(), '_give_goal_format', true );
						$income      = $form->get_earnings();
						$color       = get_post_meta( get_the_ID(), '_give_goal_color', true );
					
						if ( $goal > 0 ) {
							$progress = round( ( $income / $goal ) * 100, 2 );
							if ( $income >= $goal ) {
							  $progress = 100;
							}
						}

						$customer_id = give_get_payment_donor_id( get_the_ID() );
						$income = give_human_format_large_amount( give_format_amount( $income ) );
						$goal = give_human_format_large_amount( give_format_amount( $goal ) );
						$payment_mode = give_get_chosen_gateway( get_the_ID() );
						$form_action = add_query_arg( apply_filters( 'give_form_action_args', array( 'payment-mode' => $payment_mode, ) ),  give_get_current_page_url() );

						// remaining date
						$dead_line = get_post_meta( get_the_ID(), '_donation_form_metabox', true );
						$donation_deadline = isset( $dead_line['donation_deadline'] ) ? $dead_line['donation_deadline'] : '';
						$deadline = str_replace('/', '-', $donation_deadline);
						$deadline = date('F d, Y', strtotime($deadline));

						$date = strtotime($deadline);
						$remaining = $date - time();

						$days_remaining = floor($remaining / 86400);
						$hours_remaining = floor(($remaining % 86400) / 3600);
						$display_label_field = get_post_meta( get_the_ID(), '_give_checkout_label', true );
						$display_label       = ( ! empty( $display_label_field ) ? $display_label_field : esc_html__( 'Donate Now', 'groppe' ) );
					 ?>

					 <?php if ( $causes_style == 'style-one' && $unique_id == '1' ) { ?>
					 	<div class="col col-lg-6 col-md-12 col-12">
					 <?php } elseif( $causes_style == 'style-one' && $unique_id == '2' ) { ?>
						<div class="col col-lg-6 col-md-12 col-12">
					  <?php } else {

					 	} 

					 	if ( $causes_style == 'style-one' ) {

					 		if ( $unique_id == '1') {
						 		$extra_class = 's1';
						 	} elseif( $unique_id == '2' ) {
						 		$extra_class = 's2';
						 	} else {
						 		$extra_class = 's2 s3';
						 	}

					 	}
					 

					 	if ( $causes_style == 'style-two') {
					  	echo '<div class="col col-lg-4 col-md-12 col-12">';
					  }

					 ?>

              <div class="causes-item <?php echo esc_attr( $extra_class ); ?>">
                  <div class="image">
                    <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_attr( $image_alt ).'">'; } ?>
                  </div>
                  <div class="content">
                      <h2>
                      	<a href="<?php echo esc_url( get_permalink() ); ?>">
                      		<?php echo esc_html(get_the_title()); ?>
                      	</a>
                      </h2>
                      <p><?php echo get_the_excerpt(); ?></p>
                      <div class="progress-item">
                          <div class="progress">
                              <div class="bar wow fadeInLeft" style="width: <?php echo $progress; ?>%; visibility: visible; animation-name: fadeInLeft;">
                              </div>
                          </div>
                          <span class="cssProgress-label"><?php echo $progress; ?>%</span>
                          <div class="progres-label">
                              <div class="label-on">
                                  <p>
                                  	<?php echo esc_html__( 'Raised:','manit-core' ); ?>
                                  	<span>
                                  	<?php echo apply_filters( 'give_goal_amount_raised_output', give_currency_filter( $income ) ); ?>
                                  	</span>
                                  </p>
                              </div>
                              <div class="label-two">
                                  <p><?php echo esc_html__( 'Goal:','manit-core' ); ?><span><?php echo apply_filters( 'give_goal_amount_target_output', give_currency_filter( $goal ) ); ?></span></p>
                              </div>
                          </div>
                      </div>
                  </div>
              	</div>

             	<?php 

             	if ( $causes_style == 'style-two') {
						  	echo '</div>';
						  }

             	if ( $causes_style == 'style-one' && $unique_id == '1') { ?>
          		</div>
					 		<?php } ?>

						<?php
						  endwhile;
						  endif;
						  wp_reset_postdata();

						  if ( $causes_style == 'style-one') {
						  	echo '</div>';
						  }
						 ?>
						 
		    		</div>
		    	</div>
		    </div>
			</div>
	 		<?php 
			// Return outbut buffer
			echo ob_get_clean();
		}
	/**
	 * Render Causes widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register( new Site_Causes() );