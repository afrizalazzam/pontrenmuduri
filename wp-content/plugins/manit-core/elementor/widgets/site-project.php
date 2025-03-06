<?php
/*
 * Elementor Manit project Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Project extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_project';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Project', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-folder-o';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit project widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_project'];
	}

	/**
	 * Register Manit project widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{


		$posts = get_posts('post_type="project"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'manit')] = 0;
		}


		$this->start_controls_section(
			'section_project_listing',
			[
				'label' => esc_html__('Listing Options', 'manit-core'),
			]
		);
		$this->add_control(
			'project_style',
			[
				'label' => esc_html__('project Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'manit-core'),
					'style-two' => esc_html__('Style two', 'manit-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your project style.', 'manit-core'),
			]
		);
		$this->add_control(
			'project_limit',
			[
				'label' => esc_html__('project Limit', 'manit-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'manit-core'),
			]
		);
		$this->add_control(
			'project_order',
			[
				'label' => __('Order', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__('Asending', 'manit-core'),
					'DESC' => esc_html__('Desending', 'manit-core'),
				],
				'default' => 'DESC',
			]
		);
		$this->add_control(
			'project_orderby',
			[
				'label' => __('Order By', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'manit-core'),
					'ID' => esc_html__('ID', 'manit-core'),
					'author' => esc_html__('Author', 'manit-core'),
					'title' => esc_html__('Title', 'manit-core'),
					'date' => esc_html__('Date', 'manit-core'),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'project_show_category',
			[
				'label' => __('Certain Categories?', 'manit-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('project_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'project_show_id',
			[
				'label' => __('Certain ID\'s?', 'manit-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->add_control(
			'btn_image',
			[
				'label' => esc_html__('button bg', 'manit-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'btn_icon',
			[
				'label' => __('Icon', 'manit-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'ti-arrow-right',
					'library' => 'solid',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// project Sub Title
		$this->start_controls_section(
			'section_project_sub_title_style',
			[
				'label' => esc_html__('Sub Title', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_project_sub_title_typography',
				'selector' => '{{WRAPPER}} .manit-project .project-card .content span',
			]
		);
		$this->add_control(
			'project_sub_title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-project .project-card .content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'project_sub_title_padding',
			[
				'label' => esc_html__('Title Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-project .project-card .content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// project Title
		$this->start_controls_section(
			'section_project_title_style',
			[
				'label' => esc_html__('Title', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_project_title_typography',
				'selector' => '{{WRAPPER}} .manit-project .project-card .content h2',
			]
		);
		$this->add_control(
			'project_title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-project .project-card .content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'project_title_padding',
			[
				'label' => esc_html__('Title Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-project .project-card .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render project widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$project_style = !empty($settings['project_style']) ? $settings['project_style'] : '';
		$project_limit = !empty($settings['project_limit']) ? $settings['project_limit'] : '';
		$project_order = !empty($settings['project_order']) ? $settings['project_order'] : '';
		$project_orderby = !empty($settings['project_orderby']) ? $settings['project_orderby'] : '';
		$project_show_category = !empty($settings['project_show_category']) ? $settings['project_show_category'] : [];
		$project_show_id = !empty($settings['project_show_id']) ? $settings['project_show_id'] : [];

		$btn_image = !empty($settings['btn_image']['id']) ? $settings['btn_image']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($btn_image);
		$image_alt = get_post_meta($btn_image, '_wp_attachment_image_alt', true);


		$btn_icon = !empty($settings['btn_icon']['value']) ? $settings['btn_icon']['value'] : '';
		$btn_svg_url = !empty($settings['btn_icon']['value']['url']) ? $settings['btn_icon']['value']['url'] : '';
		$svg_alt = get_post_meta($btn_svg_url, '_wp_attachment_image_alt', true);

		// Turn output buffer on
		ob_start();

		// Pagination
		global $paged;
		if (get_query_var('paged'))
			$my_page = get_query_var('paged');
		else {
			if (get_query_var('page'))
				$my_page = get_query_var('page');
			else
				$my_page = 1;
			set_query_var('paged', $my_page);
			$paged = $my_page;
		}

		if ($project_show_id) {
			$project_show_id = json_encode($project_show_id);
			$project_show_id = str_replace(array('[', ']'), '', $project_show_id);
			$project_show_id = str_replace(array('"', '"'), '', $project_show_id);
			$project_show_id = explode(',', $project_show_id);
		} else {
			$project_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'project',
			'posts_per_page' => (int)$project_limit,
			'project_category' => implode(',', $project_show_category),
			'orderby' => $project_orderby,
			'order' => $project_order,
			'post__in' => $project_show_id,
		);

		$manit_project = new \WP_Query($args);


		if ($project_style == 'style-one') {
			$class_name = 'project-section';
			$slide_class = 'project-slider';
		} else {
			$class_name = 'project-section-s2';
			$slide_class = 'project-slider-s2';
		}

?>

		<?php if ($project_style == 'style-one' || $project_style == 'style-two') { ?>
			<section class="manit-project <?php echo esc_attr($class_name); ?>">
				<div class="<?php echo esc_attr($slide_class); ?>">
					<?php
					if ($manit_project->have_posts()) : while ($manit_project->have_posts()) : $manit_project->the_post();
							global $post;
							$project_options = get_post_meta(get_the_ID(), 'project_options', true);
							$project_subtitle = isset($project_options['project_subtitle']) ? $project_options['project_subtitle'] : '';

							$large_image =  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '');



					?>

							<div class="project-card">
								<div class="image">
									<?php if ($large_image) {
										echo '<img src="' . esc_url($large_image['0']) . '" alt="dg">';
									} ?>
								</div>
								<div class="content">
									<span><?php echo esc_html($project_subtitle) ?></span>
									<h2 class="title">
										<a href="<?php echo esc_url(get_permalink()); ?>">
											<?php echo get_the_title(); ?>
										</a>
									</h2>
									<a href="<?php echo esc_url(get_permalink()); ?>" class="project-link">
										<div class="icon">
											<?php
											if ($btn_svg_url) {
												echo '<img class="default-icon"  src="' . esc_url($btn_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
											} else {
												echo '<i class="' . esc_attr($btn_icon) . '"></i>';
											}
											?>
										</div>
										<div class="shape">
											<?php if ($image_url) {
												echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
											}  ?>
										</div>
									</a>
								</div>
							</div>
					<?php
						endwhile;
					endif;
					wp_reset_postdata();
					?>

				</div>
			</section>
		<?php } else {


		?>

<?php }
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render project widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Project());
