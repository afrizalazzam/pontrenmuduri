<?php
/*
 * Elementor Manit Hero Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Hero extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_hero';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Hero', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'ti-panel';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Hero widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_hero'];
	}

	/**
	 * Register Manit Hero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_hero',
			[
				'label' => esc_html__('Hero Options', 'manit-core'),
			]
		);
		$this->add_control(
			'hero_style',
			[
				'label' => esc_html__('Hero Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'manit-core'),
					'style-two' => esc_html__('Style two', 'manit-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your hero style.', 'manit-core'),
			]
		);
		$this->add_control(
			'topbar_logo',
			[
				'label' => esc_html__('Topbar Icon', 'manit-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'hero_top_title',
			[
				'label' => esc_html__('Top Title', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Create Your Dream Project With Us', 'manit-core'),
				'placeholder' => esc_html__('Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_title',
			[
				'label' => esc_html__('Title Text', 'manit-core'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__('Best It Solution For Your Business', 'manit-core'),
				'placeholder' => esc_html__('Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_content',
			[
				'label' => esc_html__('Content', 'manit-core'),
				'default' => esc_html__('your content text', 'manit-core'),
				'placeholder' => esc_html__('Type your content here', 'manit-core'),
				'type' => Controls_Manager::TEXTAREA,
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
		$this->add_control(
			'hero_image',
			[
				'label' => esc_html__('Add Images', 'habibi-core'),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);
		$this->add_control(
			'client_images',
			[
				'label' => esc_html__('Client Images', 'habibi-core'),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_hero_experience',
			[
				'label' => esc_html__('Experience Options', 'manit-core'),
			]
		);
		$this->add_control(
			'exp_title',
			[
				'label' => esc_html__('Experience Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Years Of Experience', 'manit-core'),
				'placeholder' => esc_html__('Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'exp_number',
			[
				'label' => esc_html__('Experience number', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('25+', 'manit-core'),
				'placeholder' => esc_html__('Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'exp_icon',
			[
				'label' => esc_html__('Experience Icon', 'manit-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'manit-core'),
			]
		);
		$this->end_controls_section(); // end: Section

		// Body Style
		$this->start_controls_section(
			'section_body_style',
			[
				'label' => esc_html__('Body Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'section_body_bg_color',
			[
				'label' => esc_html__('Background', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-hero' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Back Shape Style
		$this->start_controls_section(
			'man_back_style',
			[
				'label' => esc_html__('Man Back Shape Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'man_back_bg_color',
			[
				'label' => esc_html__('Background', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .image .bg-shape svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// SubTitle
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
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_subtitle_typography',
				'selector' => '{{WRAPPER}} .static-hero .content .title span',
			]
		);
		$this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .content .title span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_bg_color',
			[
				'label' => esc_html__('Background Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .content .title' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_icon_color',
			[
				'label' => esc_html__('Icon Background', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .content .title .icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .static-hero .content .sub-title h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .content .sub-title h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_highlight_color',
			[
				'label' => esc_html__('Highlight  Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .content .sub-title h2 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .content .sub-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .static-hero .content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__('Content Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Button
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_one_typography',
				'label' => esc_html__('Typography', 'manit-core'),
				'selector' => '{{WRAPPER}} .manit-hero .theme-btn',
			]
		);
		$this->start_controls_tabs('button_one_style');
		$this->start_controls_tab(
			'button_one_normal',
			[
				'label' => esc_html__('Normal', 'manit-core'),
			]
		);
		$this->add_control(
			'button_one_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-hero .theme-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_one_bg_color',
			[
				'label' => esc_html__('Background', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-hero .theme-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-hero .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();  // end:Normal tab

		$this->start_controls_tab(
			'button_one_hover',
			[
				'label' => esc_html__('Hover', 'manit-core'),
			]
		);
		$this->add_control(
			'button_one_hover_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-hero .theme-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_one_bg_hover_color',
			[
				'label' => esc_html__('Background Hover', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-hero .theme-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section(); // end: Section


		// Exp
		$this->start_controls_section(
			'section_exp_style',
			[
				'label' => esc_html__('Experience', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'award_icon_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .award .icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'award_icon_border_color',
			[
				'label' => esc_html__('Border Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .award .icon' => 'outline-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Exp
		$this->start_controls_section(
			'section_exp_icon_style',
			[
				'label' => esc_html__('Experience', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'exp_icon_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .award .icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'exp_icon_border_color',
			[
				'label' => esc_html__('Border Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .award .icon' => 'outline-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Exp Number
		$this->start_controls_section(
			'section_exp_number_style',
			[
				'label' => esc_html__('Experience Number', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exp_number_typography',
				'label' => esc_html__('Typography', 'manit-core'),
				'selector' => '{{WRAPPER}} .award .text h3, .award .text h3 span',
			]
		);
		$this->add_control(
			'exp_number_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .award .text h3, .award .text h3 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Exp desc
		$this->start_controls_section(
			'section_exp_text_style',
			[
				'label' => esc_html__('Experience Text', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exp_text_typography',
				'label' => esc_html__('Typography', 'manit-core'),
				'selector' => '{{WRAPPER}} .award .text span',
			]
		);
		$this->add_control(
			'exp_text_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .award .text span' => 'color: {{VALUE}};',
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
					'hero_style' => array('style-one'),
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
		$this->add_control(
			'backdrop_color3',
			[
				'label' => esc_html__('backdrop Color 3', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shape-3 svg radialGradient stop:first-child' => 'stop-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section



	}

	/**
	 * Render Hero widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$hero_style = !empty($settings['hero_style']) ? $settings['hero_style'] : '';

		$hero_top_title = !empty($settings['hero_top_title']) ? $settings['hero_top_title'] : '';
		$hero_title = !empty($settings['hero_title']) ? $settings['hero_title'] : '';
		$hero_content = !empty($settings['hero_content']) ? $settings['hero_content'] : '';

		$exp_title = !empty($settings['exp_title']) ? $settings['exp_title'] : '';
		$exp_number = !empty($settings['exp_number']) ? $settings['exp_number'] : '';

		$hero_image = !empty($settings['hero_image']) ? $settings['hero_image'] : '';
		$client_images = !empty($settings['client_images']) ? $settings['client_images'] : '';

		$bg_image2 = !empty($settings['topbar_logo']['id']) ? $settings['topbar_logo']['id'] : '';
		$bg_image3 = !empty($settings['exp_icon']['id']) ? $settings['exp_icon']['id'] : '';

		$button_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';
		$button_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$button_link_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$button_link_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$button_link_attr = !empty($button_link) ?  $button_link_external . ' ' . $button_link_nofollow : '';

		$image2_url = wp_get_attachment_url($bg_image2);
		$image2_alt = get_post_meta($bg_image2, '_wp_attachment_image_alt', true);

		$image3_url = wp_get_attachment_url($bg_image3);
		$image3_alt = get_post_meta($bg_image3, '_wp_attachment_image_alt', true);


		$manit_button = $button_link ? '<a href="' . esc_url($button_link) . '" ' . $button_link_attr . ' class="btn theme-btn">' . esc_html($button_text) . '<i class="ti-arrow-right"></i></a>' : '';

		// Turn output buffer on
		ob_start(); ?>

		<?php if ($hero_style == 'style-one') { ?>
			<div class="manit-hero static-hero">
				<div class="container-fluid">
					<div class="content">
						<div class="title">
							<?php if ($image2_url) {
								echo '<div class="icon"><img src="' . esc_attr($image2_url) . '" alt="' . esc_url($image2_alt) . '"></div>';
							}  ?>

							<?php if ($hero_top_title) {
								echo '<span>' . esc_html($hero_top_title) . '</span>';
							} ?>
						</div>
						<div class="sub-title">
							<?php if ($hero_title) {
								echo '<h2>' . wp_kses_post($hero_title) . '</h2>';
							} ?>
						</div>
						<?php
						if ($hero_content) {
							echo '<p>' . esc_html($hero_content) . '</p>';
						} ?>
						<div class="hero-btn">
							<?php echo $manit_button; ?>
						</div>
					</div>
				</div>
				<div class="image">
					<?php
					$id = 0;
					if (is_array($hero_image) && !empty($hero_image)) {
						foreach ($hero_image as $each_item) {
							$id++;
							$image_url = !empty($each_item['url']) ? $each_item['url'] : '';
							$image_alt = get_post_meta($each_item['url'], '_wp_attachment_image_alt', true);

							if ($id == '1') { ?>

								<div class="item">
									<?php if ($image_url) {
										echo '<img src="' . esc_attr($image_url) . '" alt="' . esc_url($image_alt) . '">';
									}  ?>
								</div>

					<?php }
						}
					}
					?>
					<div class="bg-shape">
						<svg width="652" height="668" viewBox="0 0 652 668" fill="none">
							<path d="M0 367.646C0 360.448 3.86838 353.805 10.129 350.252L622.129 2.95135C635.462 -4.6148 652 5.01565 652 20.3457V648C652 659.046 643.046 668 632 668H20C8.95432 668 0 659.046 0 648V367.646Z" />
						</svg>
					</div>
				</div>
				<div class="hero-slider">

					<?php
					$id = 0;
					if (is_array($client_images) && !empty($client_images)) {
						foreach ($client_images as $each_item) {
							$id++;
							$client_url = !empty($each_item['url']) ? $each_item['url'] : '';
							$client_alt = get_post_meta($each_item['url'], '_wp_attachment_image_alt', true);

					?>

							<div class="item">
								<?php if ($client_url) {
									echo '<img src="' . esc_attr($client_url) . '" alt="' . esc_url($client_alt) . '">';
								}  ?>
							</div>

					<?php
						}
					}
					?>
				</div>

				<?php if ($exp_number || $exp_title || $image3_url) { ?>
					<div class="award">

						<?php if ($image3_url) {
							echo '<div class="icon"><img src="' . esc_attr($image3_url) . '" alt="' . esc_url($image3_alt) . '"> </div>';
						}  ?>

						<div class="text">
							<?php if ($exp_number) {
								echo '<h3><span class="odometer" data-count="' . esc_html($exp_number) . '"></span>+</h3>';
							} ?>

							<?php if ($exp_title) {
								echo '<span>' . esc_html($exp_title) . '</span>';
							} ?>
						</div>
					</div>
				<?php } ?>


				<div class="shape-1">
					<svg width="362" height="481" viewBox="0 0 362 481" fill="none">
						<circle cx="121.5" cy="240.5" r="240.5" fill="url(#paint_505)" />
						<defs>
							<radialGradient id="paint_505" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(121.5 240.5) rotate(90) scale(240.5)">
								<stop offset="0" stop-color="#CED0FF" />
								<stop offset="1" stop-color="white" stop-opacity="0" />
							</radialGradient>
						</defs>
					</svg>
				</div>

				<div class="shape-2">
					<svg width="593" height="593" viewBox="0 0 593 593" fill="none">
						<circle cx="296.5" cy="296.5" r="296.5" fill="url(#paint0_318)" />
						<defs>
							<radialGradient id="paint0_318" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(296.5 296.5) rotate(90) scale(296.5)">
								<stop offset="0" stop-color="#CED0FF" />
								<stop offset="1" stop-color="white" stop-opacity="0" />
							</radialGradient>
						</defs>
					</svg>
				</div>

				<div class="shape-3">
					<svg width="358" height="484" viewBox="0 0 358 484" fill="none">
						<circle cx="296.5" cy="187.5" r="296.5" fill="url(#paint0_rad)" />
						<defs>
							<radialGradient id="paint0_rad" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(296.5 187.5) rotate(90) scale(296.5)">
								<stop offset="0" stop-color="#FBB132" stop-opacity="0.2" />
								<stop offset="1" stop-color="white" stop-opacity="0" />
							</radialGradient>
						</defs>
					</svg>
				</div>
			</div>
		<?php } else { ?>

			<div class="static-hero-s2">
				<div class="container-fluid">
					<div class="content">
						<?php if ($hero_title) {
							echo '<h2 class="title">' . wp_kses_post($hero_title) . '</h2>';
						} ?>
						<?php
						if ($hero_content) {
							echo '<p>' . esc_html($hero_content) . '</p>';
						} ?>
						<div class="hero-bottom">
							<div class="hero-btn">
								<?php echo $manit_button; ?>
							</div>
							<div class="hero-slider">

								<?php
								$id = 0;
								if (is_array($client_images) && !empty($client_images)) {
									foreach ($client_images as $each_item) {
										$id++;
										$client_url = !empty($each_item['url']) ? $each_item['url'] : '';
										$client_alt = get_post_meta($each_item['url'], '_wp_attachment_image_alt', true);

								?>

										<div class="item">
											<?php if ($client_url) {
												echo '<img src="' . esc_attr($client_url) . '" alt="' . esc_url($client_alt) . '">';
											}  ?>
										</div>

								<?php
									}
								}
								?>

							</div>
						</div>
					</div>
					<div class="hero-image">
						<?php
						$id = 0;
						if (is_array($hero_image) && !empty($hero_image)) {
							foreach ($hero_image as $each_item) {
								$id++;
								$image_url = !empty($each_item['url']) ? $each_item['url'] : '';
								$image_alt = get_post_meta($each_item['url'], '_wp_attachment_image_alt', true);

								if ($id == '1') {
									$class_name = 'image-one';
								} elseif ($id == '2') {
									$class_name = 'image-two';
								} else {
									$class_name = 'image-three';
								}

								if ($id) { ?>

									<div class="<?php echo esc_attr($class_name); ?>">
										<?php if ($image_url) {
											echo '<img src="' . esc_attr($image_url) . '" alt="' . esc_url($image_alt) . '">';
										}  ?>
									</div>

						<?php }
							}
						}
						?>
					</div>
				</div>
			</div>
<?php }
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Hero widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Hero());
