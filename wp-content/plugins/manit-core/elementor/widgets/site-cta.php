<?php
/*
 * Elementor Manit CTA Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_CTA extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-manit_cta';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'CTA', 'manit-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-call-to-action';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit CTA widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	/*
	public function get_script_depends() {
		return ['wpo-manit_cta'];
	}
	*/
	
	/**
	 * Register Manit CTA widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_CTA',
			[
				'label' => esc_html__( 'CTA Options', 'manit-core' ),
			]
		);
		$this->add_control(
			'cta_style',
			[
				'label' => esc_html__('CTA Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'manit-core'),
					'style-two' => esc_html__('Style two', 'manit-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your about style.', 'manit-core'),
			]
		);
		$this->add_control(
			'cta_subtitle',
			[
				'label' => esc_html__( 'Sub Title Text', 'manit-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'manit-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'manit-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'subtitle_shape',
			[
				'label' => esc_html__( 'Subtitle Image', 'manit-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'cta_title',
			[
				'label' => esc_html__( 'Title Text', 'manit-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'manit-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'manit-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button/Link Text', 'manit-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'manit-core' ),
				'placeholder' => esc_html__( 'Type btn text here', 'manit-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Button Link', 'manit-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'cta_image',
			[
				'label' => esc_html__( 'CTA Image', 'manit-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'shape_left',
			[
				'label' => esc_html__( 'Left Image', 'manit-core' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'cta_style' => array('style-two'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'shape_right',
			[
				'label' => esc_html__( 'Right Image', 'manit-core' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'cta_style' => array('style-two'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'manit-core'),
			]
		);
		$this->end_controls_section();// end: Section


		// CTA Background
		$this->start_controls_section(
			'cta_section_background_style',
			[
				'label' => esc_html__( 'Background', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'cta_background_color',
				'label' => esc_html__('Background', 'manit-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .manit-cta .bg-overlay:before',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background Color', 'manit-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section();// end: Section


		// SubTitle
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__( 'SubTitle', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'manit_subtitle_typography',
				'selector' => '{{WRAPPER}}  .manit-cta .cta-wrap span',
			]
		);
		$this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-cta .cta-wrap span' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .manit-cta .cta-wrap span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}}  .manit-cta .cta-wrap h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-cta .cta-wrap h2' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .manit-cta .cta-wrap h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section


		// Button
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'btn_style' => array('style-one'),
				],
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .manit-cta .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'button_style' );
			$this->start_controls_tab(
				'button_normal',
				[
					'label' => esc_html__( 'Normal', 'manit-core' ),
				]
			);
			$this->add_control(
				'button_color',
				[
					'label' => esc_html__( 'Color', 'manit-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .manit-cta .theme-btn, 
						{{WRAPPER}} .manit-cta .theme-btn' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'button_bg_color',
					'label' => esc_html__('Background', 'manit-core'),
					'types' => ['gradient'],
					'exclude' => ['image'],
					'selector' => '{{WRAPPER}} .manit-cta .theme-btn:after',
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background Color', 'manit-core'),
							'default' => 'gradient',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'manit-core' ),
					'selector' => '{{WRAPPER}} .manit-cta .theme-btn',
				]
			);
			$this->end_controls_tab();  // end:Normal tab
			
			$this->start_controls_tab(
				'button_hover',
				[
					'label' => esc_html__( 'Hover', 'manit-core' ),
				]
			);
			$this->add_control(
				'button_hover_color',
				[
					'label' => esc_html__( 'Color', 'manit-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .manit-cta .theme-btn:hover,
						{{WRAPPER}} .manit-cta .theme-btn:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'button_bg_hover_color',
					'label' => esc_html__('Hover Background', 'manit-core'),
					'types' => ['gradient'],
					'exclude' => ['image'],
					'selector' => '{{WRAPPER}} .manit-cta .theme-btn:hover',
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background Color', 'manit-core'),
							'default' => 'gradient',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_hover_border',
					'label' => esc_html__( 'Border', 'manit-core' ),
					'selector' => '{{WRAPPER}} .manit-cta .theme-btn:hover ',
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs
		
		$this->end_controls_section();// end: Section

	}

	/**
	 * Render CTA widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$cta_style = !empty($settings['cta_style']) ? $settings['cta_style'] : '';

		$cta_subtitle = !empty( $settings['cta_subtitle'] ) ? $settings['cta_subtitle'] : '';
		$cta_title = !empty( $settings['cta_title'] ) ? $settings['cta_title'] : '';

		$btn_text = !empty( $settings['btn_text'] ) ? $settings['btn_text'] : '';

		$btn_link = !empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty( $settings['btn_link']['is_external'] ) ? 'target="_blank"' : '';
		$btn_nofollow = !empty( $settings['btn_link']['nofollow'] ) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty( $btn_link ) ?  $btn_external.' '.$btn_nofollow : '';

		$button = $btn_link ? '<a href="'.esc_url($btn_link).'" '.esc_attr( $btn_link_attr ).' class="theme-btn" >'.esc_html( $btn_text ).'</a>' : '';

		$bg_image = !empty( $settings['cta_image']['id'] ) ? $settings['cta_image']['id'] : '';
		$bg_image2 = !empty( $settings['subtitle_shape']['id'] ) ? $settings['subtitle_shape']['id'] : '';
		$bg_image3 = !empty( $settings['shape_left']['id'] ) ? $settings['shape_left']['id'] : '';
		$bg_image4 = !empty( $settings['shape_right']['id'] ) ? $settings['shape_right']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $bg_image , '_wp_attachment_image_alt', true);
		// Image
		$image2_url = wp_get_attachment_url( $bg_image2 );
		$image2_alt = get_post_meta( $bg_image2 , '_wp_attachment_image_alt', true);
		// Image
		$image3_url = wp_get_attachment_url( $bg_image3 );
		$image3_alt = get_post_meta( $bg_image3 , '_wp_attachment_image_alt', true);
		// Image
		$image4_url = wp_get_attachment_url( $bg_image4 );
		$image4_alt = get_post_meta( $bg_image4 , '_wp_attachment_image_alt', true);

		if ( $image_url ) {
			$bg_url = ' style="';
			$bg_url .= ( $image_url ) ? 'background-image: url( '. esc_url( $image_url ) .' );' : '';
			$bg_url .= '"';
		} else {
			$bg_url = '';
		}

		// Turn output buffer on
		ob_start(); ?>


		<?php if ( $cta_style == 'style-one') { ?>
		<div class="manit-cta wpo-cta-section" <?php echo $bg_url; ?>>
		    <div class="shape-1">
		      <?php if( $image3_url ) { echo '<img src="'.esc_url( $image3_url ).'" alt="'.esc_url( $image3_alt ).'">'; }  ?>
		    </div>
		    <div class="bg-overlay">
		        <div class="container">
		            <div class="row justify-content-center">
		                <div class="col-lg-8">
		                    <div class="cta-wrap">
		                        <div class="icon">
		                          <?php if( $image2_url ) { echo '<img src="'.esc_url( $image2_url ).'" alt="'.esc_url( $image2_alt ).'">'; }  ?>
		                        </div>
		                         <?php 
		                         if( $cta_subtitle) { echo '<span>'.esc_html( $cta_subtitle ).'</span>'; }
		                         if( $cta_title) { echo '<h2>'.esc_html( $cta_title ).'</h2>'; }
		                         echo $button;
		                         ?>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="shape-2">
		       <?php if( $image4_url ) { echo '<img src="'.esc_url( $image4_url ).'" alt="'.esc_url( $image4_alt ).'">'; }  ?>
		    </div>
		</div>
		<?php } else { ?>	
		<div class="wpo-cta-section-s3" <?php echo $bg_url; ?>>
		    <div class="bg-color">
		        <div class="row justify-content-center">
		            <div class="col-lg-8">
		                <div class="cta-wrap">
		                    <div class="icon">
		                     <?php if( $image2_url ) { echo '<img src="'.esc_url( $image2_url ).'" alt="'.esc_url( $image2_alt ).'">'; }  ?>
		                    </div>
		                    <?php 
	                         if( $cta_subtitle) { echo '<span>'.esc_html( $cta_subtitle ).'</span>'; }
	                         if( $cta_title) { echo '<h2>'.esc_html( $cta_title ).'</h2>'; }
	                         echo $button;
	                         ?>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<?php }
		 // Return outbut buffer
		echo ob_get_clean();
		
	}
	/**
	 * Render CTA widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Site_CTA() );