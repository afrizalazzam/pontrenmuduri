<?php
/*
 * Elementor Manit Feature Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Feature extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_feature';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Feature', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-icon-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Feature widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_feature'];
	}

	/**
	 * Register Manit Feature widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_feature',
			[
				'label' => esc_html__('Feature Options', 'manit-core'),
			]
		);
		$this->add_control(
			'feature_style',
			[
				'label' => esc_html__('Feature Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'manit-core'),
					'style-two' => esc_html__('Style two', 'manit-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your hero style.', 'manit-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'feature_icon',
			[
				'label' => __('Icon', 'manit-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fi flaticon-charity',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'feature_title',
			[
				'label' => esc_html__('Title Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Make Donation', 'manit-core'),
				'placeholder' => esc_html__('Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'feature_content',
			[
				'label' => esc_html__('Content Text', 'manit-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Donate now to help those in need! Make a difference by taking action with your donation.', 'manit-core'),
				'placeholder' => esc_html__('Type Content text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'feature_link',
			[
				'label' => esc_html__('link', 'manit-core'),
				'default' => esc_html__('#', 'manit-core'),
				'placeholder' => esc_html__('Type your link here', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'featureItems_groups',
			[
				'label' => esc_html__('Feature', 'manit-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'feature_title' => esc_html__('Feature', 'manit-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ feature_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		$this->start_controls_section(
			'section_feature_section_style',
			[
				'label' => esc_html__('Body Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'feature_item_bg_color',
			[
				'label' => esc_html__('Background Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-feature .features-wrap .feature-item, .wpo-service-section .service-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	
		// Icon
		$this->start_controls_section(
			'feature_icon_style',
			[
				'label' => esc_html__('Icon Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-feature .feature-item i:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_br_color',
			[
				'label' => esc_html__('Border Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'feature_style' => array('style-two'),
				],
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-item .icon' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_br_bg_color',
			[
				'label' => esc_html__('Background', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'feature_style' => array('style-two'),
				],
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-item .icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_gradient_color',
				'label' => esc_html__('Color', 'manit-core'),
				'types' => ['gradient'],
				'condition' => [
					'feature_style' => array('style-one'),
				],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .manit-feature .features-wrap .feature-item-wrap .feature-item .icon',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'manit-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section



		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_title_typography',
				'selector' => '{{WRAPPER}} .wpo-features-area .features-wrap .feature-item h2, .wpo-service-section .service-item .text h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-features-area .features-wrap .feature-item h2 a, .wpo-features-area .features-wrap .feature-item h2, .wpo-service-section .service-item .text h2 a, .wpo-service-section .service-item .text h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => __('Title Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-features-area .features-wrap .feature-item h2, .wpo-service-section .service-item .text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__('Content', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .wpo-features-area .features-wrap .feature-item p, .wpo-service-section .service-item .text p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-features-area .features-wrap .feature-item p, .wpo-service-section .service-item .text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-features-area .features-wrap .feature-item p, .wpo-service-section .service-item .text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Feature widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$featureItems_groups = !empty($settings['featureItems_groups']) ? $settings['featureItems_groups'] : [];
		// Turn output buffer on
		$feature_style = !empty($settings['feature_style']) ? $settings['feature_style'] : '';

		ob_start(); ?>


		<?php if ($feature_style == 'style-one') { ?>
			<div class="manit-feature wpo-features-area">
			    <div class="container">
			        <div class="features-wrap">
			            <div class="row">
			            		<?php

										// Group Param Output
										if (is_array($featureItems_groups) && !empty($featureItems_groups)) {
											foreach ($featureItems_groups as $each_item) {

												$feature_title = !empty($each_item['feature_title']) ? $each_item['feature_title'] : '';
												$feature_content = !empty($each_item['feature_content']) ? $each_item['feature_content'] : '';
												$feature_link = !empty($each_item['feature_link']) ? $each_item['feature_link'] : '';

												$feature_icon = !empty( $each_item['feature_icon']['value'] ) ? $each_item['feature_icon']['value'] : '';
												$feature_svg_url = !empty( $each_item['feature_icon']['value']['url'] ) ? $each_item['feature_icon']['value']['url'] : '';
												$svg_alt = get_post_meta( $feature_svg_url , '_wp_attachment_image_alt', true);


												if ($feature_link) {
													$link_o = '<a href="' . $feature_link . '" class="more">';
													$link_c = '</a>';
												} else {
													$link_o = '';
													$link_c = '';
												}

										?>
			                <div class="col col-lg-4 col-md-6 col-12">
			                    <div class="feature-item-wrap">
			                        <div class="feature-item">
			                            <div class="feature-icon">
			                                <div class="icon">
			                                 <?php
							                         	if ( $feature_svg_url ) { 
											            			 echo '<img class="default-icon"  src="'.esc_url( $feature_svg_url ).'" alt="'.esc_url( $svg_alt ).'">';
												            		} else {
												            			echo '<i class="'.esc_attr( $feature_icon ).'"></i>';
												            		} 
							                        ?>
			                                </div>
			                            </div>
			                            <div class="feature-text">
			                               <?php
																			if ($feature_title) {
																				echo '<h2>'.$link_o.'' . esc_html($feature_title) . ''.$link_c.'</h2>';
																			}
																			if ($feature_content) {
																				echo '<p>' . esc_html($feature_content) . '</p>';
																			}
																			?>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			                <?php
												}
											}
										?>
			            </div>
			        </div>
			    </div>
			</div>
		<?php } else { ?>
		<div class="manit-feature wpo-service-section">
		    <div class="container">
		        <div class="service-wrap">
		            <div class="row">
		            	<?php

										// Group Param Output
										if (is_array($featureItems_groups) && !empty($featureItems_groups)) {
											foreach ($featureItems_groups as $each_item) {

												$feature_title = !empty($each_item['feature_title']) ? $each_item['feature_title'] : '';
												$feature_content = !empty($each_item['feature_content']) ? $each_item['feature_content'] : '';
												$feature_link = !empty($each_item['feature_link']) ? $each_item['feature_link'] : '';

												$feature_icon = !empty( $each_item['feature_icon']['value'] ) ? $each_item['feature_icon']['value'] : '';
												$feature_svg_url = !empty( $each_item['feature_icon']['value']['url'] ) ? $each_item['feature_icon']['value']['url'] : '';
												$svg_alt = get_post_meta( $feature_svg_url , '_wp_attachment_image_alt', true);


												if ($feature_link) {
													$link_o = '<a href="' . $feature_link . '" class="more">';
													$link_c = '</a>';
												} else {
													$link_o = '';
													$link_c = '';
												}

										?>
		                <div class="col col-lg-3 col-md-6 col-sm-6 col-12">
		                    <div class="service-item">
		                        <div class="icon">
		                         <?php
			                         	if ( $feature_svg_url ) { 
							            			 echo '<img class="default-icon"  src="'.esc_url( $feature_svg_url ).'" alt="'.esc_url( $svg_alt ).'">';
								            		} else {
								            			echo '<i class="'.esc_attr( $feature_icon ).'"></i>';
								            		} 
			                        ?>
		                        </div>
		                        <div class="text">
		                            <?php
																	if ($feature_title) {
																		echo '<h2>'.$link_o.'' . esc_html($feature_title) . ''.$link_c.'</h2>';
																	}
																	if ($feature_content) {
																		echo '<p>' . esc_html($feature_content) . '</p>';
																	}
																	?>
		                        </div>
		                    </div>
		                </div>
		                <?php }
									} ?>
		            </div>
		        </div>
		    </div>
		</div>
<?php }
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Feature widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Feature());
