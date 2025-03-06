<?php
/*
 * Elementor Manit Service Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Manit_Service extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_service';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Service', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-kit-details';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Service widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_service'];
	}

	/**
	 * Register Manit Service widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls()
	{


		$posts = get_posts('post_type="service"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'manit')] = 0;
		}


		$this->start_controls_section(
			'section_service_listing',
			[
				'label' => esc_html__('Listing Options', 'manit-core'),
			]
		);
		$this->add_control(
			'service_style',
			[
				'label' => esc_html__('Service Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'manit-core'),
					'style-two' => esc_html__('Style two', 'manit-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your service style.', 'manit-core'),
			]
		);
		$this->add_control(
			'service_limit',
			[
				'label' => esc_html__('Service Limit', 'manit-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'manit-core'),
			]
		);
		$this->add_control(
			'service_order',
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
			'service_orderby',
			[
				'label' => __('Order By', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'manit-core'),
					'ID' => esc_html__('ID', 'manit-core'),
					'author' => esc_html__('Author', 'manit-core'),
					'title' => esc_html__('Title', 'manit-core'),
					'date' => esc_html__('Date', 'manit-core'),
					'menu_order' => esc_html__('Menu Order', 'manit-core'),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'service_show_category',
			[
				'label' => __('Certain Categories?', 'manit-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('service_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'service_show_id',
			[
				'label' => __('Certain ID\'s?', 'manit-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->add_control(
			'short_content',
			[
				'label' => esc_html__('Excerpt Length', 'manit-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 16,
				'description' => esc_html__('How many words you want in short content paragraph.', 'manit-core'),
			]
		);
		$this->add_control(
			'read_more_txt',
			[
				'label' => esc_html__('Read More', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__('Type your Read More text here', 'manit-core'),
			]
		);
		$this->end_controls_section(); // end: Section



		// Service Item
		$this->start_controls_section(
			'section_service_item_style',
			[
				'label' => esc_html__('Service', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'section_service_box_color',
			[
				'label' => esc_html__('Bg Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .services-card ' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'section_service_box_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-service .services-card ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'section_service_box_border',
				'label' => esc_html__( 'Border', 'manit-core' ),
				'selector' => '{{WRAPPER}} .manit-service .services-card',
			]
		);
		$this->add_control(
			'section_service_box_border_radius',
			[
				'label' => __( 'Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .manit-service .services-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Service Number
		$this->start_controls_section(
			'service_number_style',
			[
				'label' => esc_html__('Number', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_number_typography',
				'selector' => '{{WRAPPER}} .manit-service .services-card .number-shape span',
			]
		);
		$this->add_control(
			'service_item_number_color',
			[
				'label' => esc_html__('Number Bg All', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .services-card .number-shape .shape svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_item_number_color2',
			[
				'label' => esc_html__('Number 2 Bg', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .col:nth-child(2) .services-card .number-shape .shape svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_item_number_color3',
			[
				'label' => esc_html__('Number 3 Bg', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .col:nth-child(3) .services-card .number-shape .shape svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_item_number_color4',
			[
				'label' => esc_html__('Number 4 Bg', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .col:nth-child(4) .services-card .number-shape .shape svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'service_section_title_style',
			[
				'label' => esc_html__('Title', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'service_manit_title_typography',
				'selector' => '{{WRAPPER}} .manit-service .services-card h2',
			]
		);
		$this->add_control(
			'service_title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .services-card h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_title_padding',
			[
				'label' => esc_html__('Title Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-service .services-card h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'service_section_content_style',
			[
				'label' => esc_html__('Content', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'service_section_content_typography',
				'selector' => '{{WRAPPER}} .manit-service .services-card p',
			]
		);
		$this->add_control(
			'service_content_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .services-card p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Learn More
		$this->start_controls_section(
			'service_learn_more_style',
			[
				'label' => esc_html__('Learn More', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'service_learn_more_typography',
				'selector' => '{{WRAPPER}} .manit-service .col .services-card h3 a span, .manit-service .col .services-card h3 a',
			]
		);
		$this->add_control(
			'service_learn_more_color',
			[
				'label' => esc_html__('Learn more color All', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .services-card h3 a span, .manit-service .services-card h3 a i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_learn_more_color2',
			[
				'label' => esc_html__('Learn more 2 color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .col:nth-child(2) .services-card h3 a span, .manit-service .col:nth-child(2) .services-card h3 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_learn_more_color3',
			[
				'label' => esc_html__('Learn more 3 color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .col:nth-child(3) .services-card h3 a span, .manit-service .col:nth-child(3) .services-card h3 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_learn_more_color4',
			[
				'label' => esc_html__('Learn more 4 color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-service .col:nth-child(4) .services-card h3 a span, .manit-service .col:nth-child(4) .services-card h3 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Service widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$service_style = !empty($settings['service_style']) ? $settings['service_style'] : '';
		$read_more_txt = !empty($settings['read_more_txt']) ? $settings['read_more_txt'] : '';
		$service_limit = !empty($settings['service_limit']) ? $settings['service_limit'] : '';
		$service_order = !empty($settings['service_order']) ? $settings['service_order'] : '';
		$service_orderby = !empty($settings['service_orderby']) ? $settings['service_orderby'] : '';
		$service_show_category = !empty($settings['service_show_category']) ? $settings['service_show_category'] : [];
		$service_show_id = !empty($settings['service_show_id']) ? $settings['service_show_id'] : [];
		$short_content = !empty($settings['short_content']) ? $settings['short_content'] : '';
		$excerpt_length = $short_content ? $short_content : '16';

		$read_more_txt = $read_more_txt ? $read_more_txt : esc_html__('Learn More', 'manit-core');


		if ($service_style == 'style-two') {
			$service_wrapper = 'services-section-s2';
		} else {
			$service_wrapper = 'services-section';
		}

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

		if ($service_show_id) {
			$service_show_id = json_encode($service_show_id);
			$service_show_id = str_replace(array('[', ']'), '', $service_show_id);
			$service_show_id = str_replace(array('"', '"'), '', $service_show_id);
			$service_show_id = explode(',', $service_show_id);
		} else {
			$service_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'service',
			'posts_per_page' => (int)$service_limit,
			'service_category' => implode(',', $service_show_category),
			'orderby' => $service_orderby,
			'order' => $service_order,
			'post__in' => $service_show_id,
		);

		$manit_service = new \WP_Query($args);
		if ($manit_service->have_posts()) :
?>

			<section class="manit-service <?php echo esc_attr($service_wrapper); ?>">
				<div class="container">
					<div class="services-wrap">
						<div class="row">
							<?php
							$unique_id = 0;
							while ($manit_service->have_posts()) : $manit_service->the_post();
								$unique_id++;
								$service_options = get_post_meta(get_the_ID(), 'service_options', true);
								$service_icon = isset($service_options['service_icon']) ? $service_options['service_icon'] : '';

								$icon_url = wp_get_attachment_url($service_icon);
								$icon_alt = get_post_meta($service_icon, '_wp_attachment_image_alt', true);

								global $post;

							?>
								<div class="col col-xl-3 col-lg-6 col-md-6 col-12">
									<div class="services-card">
										<div class="number-shape">
											<span>0<?php echo esc_html($unique_id); ?></span>
											<div class="shape">
												<svg viewBox="0 0 112 107" fill="none">
													<path d="M67.9706 0.555039C89.2118 -0.484865 110.489 16.3952 111.529 37.6365C112.568 58.8777 92.9541 105.645 71.7129 106.685C50.4716 107.725 1.72311 63.4921 0.683209 42.2509C-0.356694 21.0097 46.7293 1.59494 67.9706 0.555039Z" />
												</svg>

											</div>
										</div>
										<div class="icon">
											<?php if ($icon_url) { ?>
												<img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>">
											<?php } ?>
										</div>
										<h2><?php echo esc_html(get_the_title()); ?></h2>
										<p><?php echo wp_trim_words(get_the_excerpt(), $excerpt_length, ' '); ?></p>
										<h3>
											<?php if ($read_more_txt) { ?>
												<a href="<?php echo esc_url(get_permalink()); ?>">
													<span><?php echo esc_html($read_more_txt); ?></span>
													<i class="ti-arrow-right"></i>
												</a>
											<?php } ?>
										</h3>
									</div>
								</div>
							<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</section>
<?php
		endif;
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Service widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Manit_Service());
