<?php
/*
 * Elementor Manit Testimonial Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Manit_Testimonial extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_testimonial';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Testimonial', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-testimonial';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Testimonial widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_testimonial'];
	}

	/**
	 * Register Manit Testimonial widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'testimonial_style_option',
			[
				'label' => esc_html__('Testimonial Options', 'manit-core'),
			]
		);
		$this->add_control(
			'testimonial_style',
			[
				'label' => esc_html__('Testimonial Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'manit-core'),
					'style-two' => esc_html__('Style two', 'manit-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your Testimonial style.', 'manit-core'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_Title',
			[
				'label' => esc_html__('Left Text Options', 'manit-core'),
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => esc_html__('Title Style', 'manit-core'),
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
			'section_subtitle',
			[
				'label' => esc_html__('Sub Title Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'title_style' => array('style-one'),
				],
				'default' => esc_html__('Sub Title Text', 'manit-core'),
				'placeholder' => esc_html__('Type subtitle text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' => esc_html__('Title Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'manit-core'),
				'placeholder' => esc_html__('Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'section_content',
			[
				'label' => esc_html__('Content Text', 'manit-core'),
				'type' => Controls_Manager::TEXTAREA,
				'condition' => [
					'title_style' => array('style-one'),
				],
				'default' => esc_html__('Content Text', 'manit-core'),
				'placeholder' => esc_html__('Type Content text here', 'manit-core'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'manit-core'),
				'default' => esc_html__('button text', 'manit-core'),
				'placeholder' => esc_html__('Type button Text here', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__('Button Link', 'manit-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => esc_html__('Testimonial Options', 'manit-core'),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'testimonial_title',
			[
				'label' => esc_html__('Testimonial Title Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'manit-core'),
				'placeholder' => esc_html__('Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_subtitle',
			[
				'label' => esc_html__('Testimonial Sub Title', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Testimonial Sub Title', 'manit-core'),
				'placeholder' => esc_html__('Type testimonial Sub title here', 'manit-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_content',
			[
				'label' => esc_html__('Testimonial Content', 'manit-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Testimonial Content', 'manit-core'),
				'placeholder' => esc_html__('Type testimonial Content here', 'manit-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'bg_image',
			[
				'label' => esc_html__('Testimonial Image', 'manit-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);
		$repeater->add_control(
			'rating_style',
			[
				'label' => esc_html__('Rating Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'one-star' => esc_html__('Rating One Star', 'manit-core'),
					'two-star' => esc_html__('Rating two Star', 'manit-core'),
					'three-star' => esc_html__('Rating three Star', 'manit-core'),
					'four-star' => esc_html__('Rating four Star', 'manit-core'),
					'five-star' => esc_html__('Rating five Star', 'manit-core'),
				],
				'default' => 'four-star',
				'description' => esc_html__('Select your about style.', 'manit-core'),
			]
		);
		$repeater->add_control(
			'quote_image',
			[
				'label' => esc_html__('Quot Image', 'manit-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);
		$this->add_control(
			'testimonialItems_groups',
			[
				'label' => esc_html__('Testimonial Items', 'manit-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'testimonial_title' => esc_html__('Testimonial', 'manit-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ testimonial_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section

			// Sub Title
			$this->start_controls_section(
				'section_subtitle_style',
				[
					'label' => esc_html__('Sub Title', 'manit-core'),
					'condition' => [
						'title_style' => array('style-one'),
					],
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'manit_subtitle_typography',
					'selector' => '{{WRAPPER}} .section-title span',
				]
			);
			$this->add_control(
				'sub_title_color',
				[
					'label' => esc_html__('Color', 'manit-core'),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .section-title span' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'subtitle_padding',
				[
					'label' => __('Title Padding', 'manit-core'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} .section-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section(); // end: Section
	
			// Title
			$this->start_controls_section(
				'section_title_style',
				[
					'label' => esc_html__('Title', 'manit-core'),
					'condition' => [
						'title_style' => array('style-one'),
					],
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'manit_title_typography',
					'selector' => '{{WRAPPER}} .section-title h2',
				]
			);
			$this->add_control(
				'title_color',
				[
					'label' => esc_html__('Color', 'manit-core'),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .section-title h2' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'title_padding',
				[
					'label' => __('Title Padding', 'manit-core'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} .section-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section(); // end: Section
	
			// Content
			$this->start_controls_section(
				'section_content_style',
				[
					'label' => esc_html__('Content', 'manit-core'),
					'condition' => [
						'title_style' => array('style-one'),
					],
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => esc_html__('Typography', 'manit-core'),
					'name' => 'section_content_typography',
					'selector' => '{{WRAPPER}} .section-title p',
				]
			);
			$this->add_control(
				'content_color',
				[
					'label' => esc_html__('Color', 'manit-core'),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .section-title p' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section(); // end: Section

			// Button
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'manit-core' ),
				'condition' => [
					'title_style' => array('style-one'),
				],
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn',
			]
		);
		$this->add_responsive_control(
			'button_min_width',
			[
				'label' => esc_html__( 'Width', 'manit-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 700,
						'step' => 1,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'btn_style' => array('style-one'),
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'manit-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'link_border_color',
				[
					'label' => esc_html__( 'Link Border Color', 'manit-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn, {{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'manit-core' ),
					'selector' => '{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn',
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
						'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_hover_color',
				[
					'label' => esc_html__( 'Background Color', 'manit-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'link_border_hover_color',
				[
					'label' => esc_html__( 'Link Border Color', 'manit-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_hover_border',
					'label' => esc_html__( 'Border', 'manit-core' ),
					'selector' => '{{WRAPPER}} .testimonial-section .section-title .testimonial-btn .theme-btn:hover ',
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs
		
		$this->end_controls_section();// end: Section

		// Testimonial box Text
		$this->start_controls_section(
			'section_testimonial_box_style',
			[
				'label' => esc_html__('Testimonial Box Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'testimonial_box_color',
			[
				'label' => esc_html__('Bg Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-section .testimonial-slider .item ' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonial_box_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-section .testimonial-slider .item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'testimonial_box_border',
				'label' => esc_html__( 'Border', 'manit-core' ),
				'selector' => '{{WRAPPER}} .testimonial-section .testimonial-slider .item',
			]
		);
		$this->add_control(
			'testimonial_box_border_radius',
			[
				'label' => __( 'Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-section .testimonial-slider .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Testimonial Name Style 
		$this->start_controls_section(
			'testimonials_section_name_style',
			[
				'label' => esc_html__('Testimonial Name', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'testimonials_manit_name_typography',
				'selector' => '{{WRAPPER}}  .testimonial-section .testimonial-slider .item .client .text h2',
			]
		);
		$this->add_control(
			'testimonials_name_color',
			[
				'label' => esc_html__('Name Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-section .testimonial-slider .item .client .text h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Testimonial Title Style 
		$this->start_controls_section(
			'testimonials_section_title_style',
			[
				'label' => esc_html__('Testimonial Title', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'testimonials_manit_title_typography',
				'selector' => '{{WRAPPER}} .testimonial-section .testimonial-slider .item .client .text span',
			]
		);
		$this->add_control(
			'testimonials_title_color',
			[
				'label' => esc_html__('Name Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .testimonial-section .testimonial-slider .item .client .text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'testimonial_content_style',
			[
				'label' => esc_html__('Testimonial Content', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'testimonial_content_typography',
				'selector' => '{{WRAPPER}} .testimonial-section .testimonial-slider .item p',
			]
		);
		$this->add_control(
			'testimonial_content_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-section .testimonial-slider .item p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Testimonial widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$testimonialItems_groups = !empty($settings['testimonialItems_groups']) ? $settings['testimonialItems_groups'] : [];

		$testimonial_style = !empty($settings['testimonial_style']) ? $settings['testimonial_style'] : '';

		$section_subtitle = !empty($settings['section_subtitle']) ? $settings['section_subtitle'] : '';
		$section_title = !empty($settings['section_title']) ? $settings['section_title'] : '';
		$section_content = !empty($settings['section_content']) ? $settings['section_content'] : '';

		$section_title = preg_replace('~\s*<br ?/?>\s*~', " <br/>", $section_title);
		$section_title = nl2br($section_title);

		$button_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';
		$button_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$button_link_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$button_link_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$button_link_attr = !empty($button_link) ?  $button_link_external . ' ' . $button_link_nofollow : '';

		$manit_button = $button_link ? '<a href="' . esc_url($button_link) . '" ' . $button_link_attr . ' class="theme-btn">' . esc_html($button_text) . '<i class="ti-arrow-right"></i></a>' : '';

		if ($testimonial_style == 'style-one') {
			$col = 'col-xl-8 col-12';
			$slider = 'testimonial-active';
			$sClass = '';
		} else {
			$col = 'col-xl-12 col-12';
			$slider = 'testimonial-active-s2';
			$sClass = 'style-2';
		}


		// Turn output buffer on
		ob_start(); ?>
		<div class="testimonial-section <?php echo esc_attr($sClass); ?>">
			<div class="container">
				<div class="row align-content-center">
					<?php if ($testimonial_style == 'style-one') { ?>
						<div class="col-xl-4 col-12">
							<div class="section-title">
								<?php
								if ($section_subtitle) {
									echo '<span>' . esc_html($section_subtitle) . '</span>';
								}
								if ($section_title) {
									echo '<h2>' . esc_html($section_title) . '</h2>';
								}
								if ($section_content) {
									echo '<p>' . esc_html($section_content) . '</p>';
								}
								?>
								<div class="testimonial-btn">
									<?php echo $manit_button; ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<div class="<?php echo esc_attr($col); ?>">
						<div class="testimonial-slider <?php echo esc_attr($slider); ?>">
							<?php 	// Group Param Output
							if (is_array($testimonialItems_groups) && !empty($testimonialItems_groups)) {
								foreach ($testimonialItems_groups as $each_items) {

									$testimonial_title = !empty($each_items['testimonial_title']) ? $each_items['testimonial_title'] : '';
									$testimonial_subtitle = !empty($each_items['testimonial_subtitle']) ? $each_items['testimonial_subtitle'] : '';
									$testimonial_content = !empty($each_items['testimonial_content']) ? $each_items['testimonial_content'] : '';
									$rating_style = !empty($each_items['rating_style']) ? $each_items['rating_style'] : '';

									$image_url = wp_get_attachment_url($each_items['bg_image']['id']);
									$image_alt = get_post_meta($each_items['bg_image']['id'], '_wp_attachment_image_alt', true);

									$quote_url = wp_get_attachment_url($each_items['quote_image']['id']);
									$quote_alt = get_post_meta($each_items['quote_image']['id'], '_wp_attachment_image_alt', true);

							?>
							        <div class="testimonial-item">
										<div class="item">
											<div class="client">
												<div class="image">
													<?php if ($image_url) {
														echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
													} ?>
												</div>
												<div class="text">
													<?php
													if ($testimonial_title) {
														echo '<h2>' . esc_html($testimonial_title) . '</h2>';
													}
													if ($testimonial_subtitle) {
														echo '<span>' . esc_html($testimonial_subtitle) . '</span>';
													}
													?>
												</div>
											</div>
											<div class="reting">
												<ul>
													<?php if ($rating_style == 'one-star') { ?>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
													<?php } elseif ($rating_style == 'two-star') { ?>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
													<?php } elseif ($rating_style == 'three-star') { ?>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
													<?php } elseif ($rating_style == 'four-star') { ?>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
													<?php } else { ?>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
														<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<?php } ?>
												</ul>
												<span>(4.0)</span>
											</div>
											<?php if ($testimonial_content) {
												echo '<p class="text">' . esc_html($testimonial_content) . '</p>';
											} ?>
	
											<div class="icon">
												<?php if ($quote_url) {
													echo '<img src="' . esc_url($quote_url) . '" alt="' . esc_attr($quote_alt) . '">';
												} ?>
											</div>
										</div>
									</div>

							<?php }
							} ?>

						</div>
					</div>
				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Testimonial widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Manit_Testimonial());
