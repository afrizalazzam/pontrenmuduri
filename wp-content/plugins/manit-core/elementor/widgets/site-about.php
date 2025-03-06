<?php
/*
 * Elementor Manit About Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_About extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_about';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('About', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-site-identity';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit About widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_about'];
	}

	/**
	 * Register Manit About widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_about',
			[
				'label' => esc_html__('About Options', 'manit-core'),
			]
		);
		$this->add_control(
			'about_style',
			[
				'label' => esc_html__('About Style', 'manit-core'),
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
			'about_image',
			[
				'label' => esc_html__('About Image', 'manit-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'about_image2',
			[
				'label' => esc_html__('About Image 2', 'manit-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'about_style' => array('style-two'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'about_icon',
			[
				'label' => __('Icon', 'manit-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'about_style' => array('style-one'),
				],
				'default' => [
					'value' => 'fi flaticon-phone-call',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'award_title',
			[
				'label' => esc_html__('Award Title', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Award Winning', 'manit-core'),
				'placeholder' => esc_html__('Sub Type Award Title text here', 'manit-core'),
				'condition' => [
					'about_style' => array('style-one'),
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'award_text',
			[
				'label' => esc_html__('Number Title', 'manit-core'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__('Call Us:', 'manit-core'),
				'placeholder' => esc_html__('Sub Type about Number title here', 'manit-core'),
				'condition' => [
					'about_style' => array('style-one'),
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'about_subtitle',
			[
				'label' => esc_html__('Sub Title Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('ABOUT COMPANY', 'manit-core'),
				'placeholder' => esc_html__('Sub Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_title',
			[
				'label' => esc_html__('Title Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Our approach ensures flexibility, adaptability, & rapid response.', 'manit-core'),
				'placeholder' => esc_html__('Sub Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_content',
			[
				'label' => esc_html__('Content', 'manit-core'),
				'default' => esc_html__('your content text', 'manit-core'),
				'placeholder' => esc_html__('Type your content here', 'manit-core'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);

		$this->add_control(
			'about_info_name',
			[
				'label' => esc_html__('Info Name Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Annette Black', 'manit-core'),
				'placeholder' => esc_html__('Sub Type Info Name text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_info_title',
			[
				'label' => esc_html__('Info Title Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('CEO & Founder of Manit', 'manit-core'),
				'placeholder' => esc_html__('Sub Type Info title text here', 'manit-core'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'about_sign',
			[
				'label' => esc_html__('Sign Image', 'manit-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your Sign.', 'manit-core'),
			]
		);

		$this->end_controls_section(); // end: Section

		// About Image Style
		$this->start_controls_section(
			'about_image_style',
			[
				'label' => esc_html__('About Image Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'about_image_border_radius',
			[
				'label' => __( 'Image Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'condition' => [
					'about_style' => array('style-one'),
				],
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'about_image1_border_radius',
			[
				'label' => __( 'Image1 Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'condition' => [
					'about_style' => array('style-two'),
				],
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .image-1 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'about_image2_border_radius',
			[
				'label' => __( 'Image2 Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'condition' => [
					'about_style' => array('style-two'),
				],
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .image-2 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Award box Text
		$this->start_controls_section(
			'section_award_box_style',
			[
				'label' => esc_html__('Award Box Style', 'manit-core'),
				'condition' => [
					'about_style' => array('style-one'),
				],
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'award_box_color',
			[
				'label' => esc_html__('Bg Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .award-content ' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'award_box_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .award-content ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'award_box_border',
				'label' => esc_html__( 'Border', 'manit-core' ),
				'selector' => '{{WRAPPER}} .manit-about .about-left-content .award-content',
			]
		);
		$this->add_control(
			'award_box_border_radius',
			[
				'label' => __( 'Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .award-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Award Text
		$this->start_controls_section(
			'section_award_style',
			[
				'label' => esc_html__('Award Title Style', 'manit-core'),
				'condition' => [
					'about_style' => array('style-one'),
				],
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'section_award_typography',
				'selector' => '{{WRAPPER}} .manit-about .about-left-content .award-content h2',
			]
		);
		$this->add_control(
			'award_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .award-content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'award_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .award-content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Award Text
		$this->start_controls_section(
			'section_award_description_style',
			[
				'label' => esc_html__('Award description Style', 'manit-core'),
				'condition' => [
					'about_style' => array('style-one'),
				],
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'section_description_typography',
				'selector' => '{{WRAPPER}} .manit-about .about-left-content .award-content p',
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .award-content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'description_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-left-content .award-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Sub Title
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__('SubTitle', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'manit_subtitle_typography',
				'selector' => '{{WRAPPER}} .manit-about .about-right-content h2',
			]
		);
		$this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-right-content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => esc_html__('Title Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-right-content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' => 'manit_title_typography',
				'selector' => '{{WRAPPER}} .manit-about .about-right-content h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-right-content h3' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .manit-about .about-right-content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .manit-about .about-right-content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-right-content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => __('Content Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-about .about-right-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Info Title Text
		$this->start_controls_section(
			'section_info_style',
			[
				'label' => esc_html__('Info Title Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'section_info_typography',
				'selector' => '{{WRAPPER}} .about-section .about-right-content .ceo-content h2',
			]
		);
		$this->add_control(
			'info_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-section .about-right-content .ceo-content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'info_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .about-section .about-right-content .ceo-content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Info sub Text
		$this->start_controls_section(
			'section_info_sub_style',
			[
				'label' => esc_html__('Info Sub Title Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'section_sub_info_typography',
				'selector' => '{{WRAPPER}} .about-section .about-right-content .ceo-content span',
			]
		);
		$this->add_control(
			'sub_info_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-section .about-right-content .ceo-content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sub_info_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .about-section .about-right-content .ceo-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// backdrop style
		$this->start_controls_section(
			'section_backdrop_style',
			[
				'label' => esc_html__('backdrop color', 'manit-core'),
				'condition' => [
					'about_style' => array('style-one'),
				],
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'backdrop_color1',
			[
				'label' => esc_html__('backdrop Color 1', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shape-1 svg radialGradient stop:first-child' => 'stop-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'backdrop_color2',
			[
				'label' => esc_html__('backdrop Color 2', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shape-2 svg radialGradient stop:first-child' => 'stop-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render About widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$about_style = !empty($settings['about_style']) ? $settings['about_style'] : '';
		$about_subtitle = !empty($settings['about_subtitle']) ? $settings['about_subtitle'] : '';
		$about_title = !empty($settings['about_title']) ? $settings['about_title'] : '';
		$about_content = !empty($settings['about_content']) ? $settings['about_content'] : '';

		$btn_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';

		$btn_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$btn_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty($btn_link) ?  $btn_external . ' ' . $btn_nofollow : '';

		$button = $btn_link ? '<a href="' . esc_url($btn_link) . '" ' . esc_attr($btn_link_attr) . ' class="theme-btn" >' . esc_html($btn_text) . '</a>' : '';

		$award_title = !empty($settings['award_title']) ? $settings['award_title'] : '';
		$award_text = !empty($settings['award_text']) ? $settings['award_text'] : '';

		$about_info_name = !empty($settings['about_info_name']) ? $settings['about_info_name'] : '';
		$about_info_title = !empty($settings['about_info_title']) ? $settings['about_info_title'] : '';

		$bg_image = !empty($settings['about_image']['id']) ? $settings['about_image']['id'] : '';
		$bg_image2 = !empty($settings['about_image2']['id']) ? $settings['about_image2']['id'] : '';
		$about_sign = !empty($settings['about_sign']['id']) ? $settings['about_sign']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		// Image
		$image2_url = wp_get_attachment_url($bg_image2);
		$image2_alt = get_post_meta($bg_image2, '_wp_attachment_image_alt', true);

		// Image
		$sign_url = wp_get_attachment_url($about_sign);
		$sign_alt = get_post_meta($about_sign, '_wp_attachment_image_alt', true);

		$about_icon = !empty($settings['about_icon']['value']) ? $settings['about_icon']['value'] : '';
		$about_svg_url = !empty($settings['about_icon']['value']['url']) ? $settings['about_icon']['value']['url'] : '';
		$svg_alt = get_post_meta($about_svg_url, '_wp_attachment_image_alt', true);

		// Turn output buffer on
		ob_start(); ?>

		<?php if ($about_style == 'style-one') { ?>
			<div class="manit-about about-section">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-xl-6 col-12">
							<div class="about-left-content">
								<div class="image">
									<?php if ($image_url) {
										echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
									}  ?>
								</div>
								<div class="award-content">
									<div class="icon">
										<?php
										if ($about_svg_url) {
											echo '<img class="default-icon"  src="' . esc_url($about_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
										} else {
											echo '<i class="' . esc_attr($about_icon) . '"></i>';
										}
										?>
									</div>
									<?php
									if ($award_title) {
										echo '<h2>' . esc_html($award_title) . '</h2>';
									}
									if ($award_text) {
										echo '<p>' . wp_kses_post($award_text) . '</p>';
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-12">
							<div class="about-right-content">
								<?php
								if ($about_subtitle) {
									echo '<h2 class="title">' . esc_html($about_subtitle) . '</h2>';
								}
								if ($about_title) {
									echo '<h3 class="sub-title">' . esc_html($about_title) . '</h3>';
								}
								if ($about_content) {
									echo wp_kses_post($about_content);
								}
								?>
								<div class="ceo-content">
									<?php
									if ($about_info_name) {
										echo '<h2>' . esc_html($about_info_name) . '</h2>';
									}
									if ($about_info_title) {
										echo '<span>' . esc_html($about_info_title) . '</span>';
									}
									?>
									<div class="signeture">
										<?php if ($sign_url) {
											echo '<img src="' . esc_url($sign_url) . '" alt="' . esc_url($sign_alt) . '">';
										}  ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="shape-1">
					<svg width="429" height="593" viewBox="0 0 429 593" fill="none">
						<circle cx="296.5" cy="296.5" r="296.5" fill="url(#cc318_1506)" />
						<defs>
							<radialGradient id="cc318_1506" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(296.5 296.5) rotate(90) scale(296.5)">
								<stop offset="0" stop-color="#CED0FF" />
								<stop offset="1" stop-color="white" stop-opacity="0" />
							</radialGradient>
						</defs>
					</svg>
				</div>
				<div class="shape-2">
					<svg width="529" height="529" viewBox="0 0 529 529" fill="none">
						<circle cx="264.5" cy="264.5" r="264.5" fill="url(#oo1508)" />
						<defs>
							<radialGradient id="oo1508" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(264.5 264.5) rotate(90) scale(264.5)">
								<stop offset="0" stop-color="#FBB132" stop-opacity="0.2" />
								<stop offset="1" stop-color="white" stop-opacity="0" />
							</radialGradient>
						</defs>
					</svg>
				</div>
			</div>
		<?php } else  { ($about_style == 'style-two') ?>
			<div class="manit-about about-section-s2 section-padding">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-xl-6 col-12">
							<div class="about-left-content">
								<div class="image-1">
									<?php if ($image_url) {
										echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
									}  ?>
								</div>
								<div class="image-2">
									<?php if ($image2_url) {
										echo '<img src="' . esc_url($image2_url) . '" alt="' . esc_url($image2_alt) . '">';
									}  ?>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-12">
							<div class="about-right-content">
								<?php
								if ($about_subtitle) {
									echo '<h2 class="title">' . esc_html($about_subtitle) . '</h2>';
								}
								if ($about_title) {
									echo '<h3 class="sub-title">' . esc_html($about_title) . '</h3>';
								}
								if ($about_content) {
									echo wp_kses_post($about_content);
								}
								?>
								<div class="ceo-content">
									<?php
									if ($about_info_name) {
										echo '<h2>' . esc_html($about_info_name) . '</h2>';
									}
									if ($about_info_title) {
										echo '<span>' . esc_html($about_info_title) . '</span>';
									}
									?>
									<div class="signeture">
										<?php if ($sign_url) {
											echo '<img src="' . esc_url($sign_url) . '" alt="' . esc_url($sign_alt) . '">';
										}  ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php }
		echo ob_get_clean();
	}
	/**
	 * Render About widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_About());
