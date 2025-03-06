<?php
/*
 * Elementor Manit Video Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Video extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_video';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Video', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-video-camera';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Video widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_video'];
	}

	/**
	 * Register Manit Video widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_video',
			[
				'label' => esc_html__('Video Options', 'manit-core'),
			]
		);

		$this->add_control(
			'video_image',
			[
				'label' => esc_html__('Video Image', 'manit-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);
		$this->add_control(
			'video_link',
			[
				'label' => esc_html__('Video Link', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'manit-core'),
				'placeholder' => esc_html__('Type video link here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->end_controls_section(); // end: Section


		// Title
		$this->start_controls_section(
			'section_video_style',
			[
				'label' => esc_html__('Video Button', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'video_bg_color',
			[
				'label' => esc_html__('Background', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .videos-section .image .video' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_button_color',
			[
				'label' => esc_html__('button Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .videos-section .image .video .video-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'video_button_border_radius',
			[
				'label' => __( 'Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .videos-section .image .video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // end: Section	

		// Title
		$this->start_controls_section(
			'section_shape_style',
			[
				'label' => esc_html__('Shape Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'shape1_color',
			[
				'label' => esc_html__('Shape1 Bg', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .videos-section .image .circle-shape-1' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'shape2_color',
			[
				'label' => esc_html__('Shape2 Bg', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .videos-section .image .circle-shape-2' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'shape3_color',
			[
				'label' => esc_html__('Shape3 Bg', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .videos-section .image .circle-shape-3' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'shape4_color',
			[
				'label' => esc_html__('Shape4 Bg', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .videos-section .image .circle-shape-4' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section	

	}

	/**
	 * Render Video widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$bg_image = !empty($settings['video_image']['id']) ? $settings['video_image']['id'] : '';
		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		$video_link = !empty($settings['video_link']) ? $settings['video_link'] : '';
		// Turn output buffer on
		ob_start();

		if ($video_link) { ?>
			<div class="videos-section">
				<div class="container">
					<div class="image">
						<?php if ($image_url) {
							echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
						}  ?>
						<div class="video">
							<a href="<?php echo esc_url($video_link); ?>" class="video-btn" data-type="iframe">
								<div class="play-btn"></div>
							</a>
						</div>
						<div class="circle-shape-1"></div>
						<div class="circle-shape-2"></div>
						<div class="circle-shape-3"></div>
						<div class="circle-shape-4"></div>
					</div>
				</div>
			</div>
<?php }
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Video widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Site_Video());
