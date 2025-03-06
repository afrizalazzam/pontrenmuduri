<?php
/*
 * Elementor Manit Funfact Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Manit_Funfact extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_funfact';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Funfact', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-counter';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Funfact widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_funfact'];
	}

	/**
	 * Register Manit Funfact widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'section_funfact',
			[
				'label' => esc_html__('Funfact Options', 'manit-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'funfact_title',
			[
				'label' => esc_html__('Title Text', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'manit-core'),
				'placeholder' => esc_html__('Type title text here', 'manit-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'funfact_number',
			[
				'label' => esc_html__('Funfact Number', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('250', 'manit-core'),
				'placeholder' => esc_html__('Type funfact Number here', 'manit-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'funfact_plus',
			[
				'label' => esc_html__('Funfact Plus/Percentage', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('+', 'manit-core'),
				'placeholder' => esc_html__('Type funfact Plus/Percentage here', 'manit-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'funfactItems_groups',
			[
				'label' => esc_html__('Funfact Items', 'manit-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'funfact_title' => esc_html__('Funfact', 'manit-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ funfact_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section



		// Funfact Number
		$this->start_controls_section(
			'funfact_number_style',
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
				'selector' => '{{WRAPPER}} .funfact-section .item h3',
			]
		);
		$this->add_control(
			'funfact_item_number_color',
			[
				'label' => esc_html__('Number Color All', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact-section .item h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_item_number_color2',
			[
				'label' => esc_html__('Number 2 Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact-section .col:nth-child(2) .item h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_item_number_color3',
			[
				'label' => esc_html__('Number 3 Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact-section .col:nth-child(3) .item h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_item_number_color4',
			[
				'label' => esc_html__('Number 4 Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact-section .col:nth-child(4) .item h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .funfact-section .item h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Funfact Title
		$this->start_controls_section(
			'funfact_title_style',
			[
				'label' => esc_html__('Funfact Title', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_funfact_title_typography',
				'selector' => '{{WRAPPER}} .funfact-section .item h4',
			]
		);
		$this->add_control(
			'funfact_title',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact-section .item h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_title_padding',
			[
				'label' => __('Number Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .funfact-section .item h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Funfact widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$funfactItems_groups = !empty($settings['funfactItems_groups']) ? $settings['funfactItems_groups'] : [];

		$btn_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';

		$btn_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$btn_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty($btn_link) ?  $btn_external . ' ' . $btn_nofollow : '';

		$button = $btn_link ? '<a href="' . esc_url($btn_link) . '" ' . esc_attr($btn_link_attr) . ' class="theme-btn" >' . esc_html($btn_text) . '</a>' : '';

		// Turn output buffer on
		ob_start(); ?>
		<div class="funfact-section">
			<div class="container">
				<div class="row">
					<?php 	// Group Param Output
					if (is_array($funfactItems_groups) && !empty($funfactItems_groups)) {
						foreach ($funfactItems_groups as $each_item) {
							$funfact_title = !empty($each_item['funfact_title']) ? $each_item['funfact_title'] : '';
							$funfact_number = !empty($each_item['funfact_number']) ? $each_item['funfact_number'] : '';
							$funfact_plus = !empty($each_item['funfact_plus']) ? $each_item['funfact_plus'] : '';
					?>
							<div class="col col-lg-3 col-md-6 col-12">
								<div class="item">
									<?php
									if ($funfact_number) {
										echo '<h3><span class="odometer" data-count="' . esc_attr($funfact_number) . '">' . esc_html__('00', 'manit-core') . '</span>' . esc_html($funfact_plus) . '</h3>';
									}
									if ($funfact_title) {
										echo '<h4>' . esc_html__($funfact_title) . '</h4>';
									}
									?>
								</div>

							</div>
					<?php
						}
					}
					?>

				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Funfact widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Manit_Funfact());
