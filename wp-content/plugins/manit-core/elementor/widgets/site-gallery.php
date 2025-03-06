<?php
/*
 * Elementor Manit Gallery Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Gallery extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_gallery';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Gallery', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-gallery-justified';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Gallery widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_gallery'];
	}

	/**
	 * Register Manit Gallery widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_gallery',
			[
				'label' => esc_html__('Gallery Options', 'manit-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'gallery_image',
			[
				'label' => esc_html__('Gallery Image', 'manit-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);
		$repeater->add_control(
			'gallery_title',
			[
				'label' => esc_html__('Title', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title', 'manit-core'),
				'placeholder' => esc_html__('Type Title here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'galleryItems_groups',
			[
				'label' => esc_html__('Gallery Items', 'manit-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'gallery_title' => esc_html__('Gallery', 'manit-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ gallery_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section

		// Overly
		$this->start_controls_section(
			'section_project_overly_style',
			[
				'label' => esc_html__('Overly', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'overly_color',
			[
				'label' => esc_html__('Overly Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-project-single-area .wpo-project-single-wrap .wpo-project-single-item .sortable-gallery .img-holder .hover-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		//Icon
		$this->start_controls_section(
			'gallery_icon_style',
			[
				'label' => esc_html__('Icon', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .wpo-project-single-area .wpo-project-single-wrap .wpo-project-single-item .sortable-gallery .img-holder .hover-content i:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section
	}

	/**
	 * Render Gallery widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$galleryItems_groups = !empty($settings['galleryItems_groups']) ? $settings['galleryItems_groups'] : [];

		// Turn output buffer on
		ob_start();
?>

		<div class="project-single-main-img owl-carousel">

			<?php 	// Group Param Output
			if (is_array($galleryItems_groups) && !empty($galleryItems_groups)) {
				foreach ($galleryItems_groups as $each_item) {

					$gallery_image_url = !empty($each_item['gallery_image']['id']) ? $each_item['gallery_image']['id'] : '';
					$image_url = wp_get_attachment_url($gallery_image_url);
					$image_alt = get_post_meta($each_item['gallery_image']['id'], '_wp_attachment_image_alt', true);

			?>
					<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="img img-responsive">
			<?php
				}
			}
			?>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Gallery widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Site_Gallery());
