<?php
/*
 * Elementor Manit Contact Form 7 Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Contact_Form extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_contact_form';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Contact Form', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-form-horizontal';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Contact Form widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
	public function get_script_depends() {
		return ['wpo-manit_contact_form'];
	}
	 */

	/**
	 * Register Manit Contact Form widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_contact_form',
			[
				'label' => esc_html__('Form Options', 'manit-core'),
			]
		);
		$this->add_control(
			'contact_style',
			[
				'label' => esc_html__('Contact Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'manit-core'),
					'style-two' => esc_html__('Style two', 'manit-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your Contact style.', 'manit-core'),
			]
		);
		$this->add_control(
			'form_title',
			[
				'label' => esc_html__('Title', 'manit-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Default title', 'manit-core'),
				'placeholder' => esc_html__('Type your title here', 'manit-core'),
			]
		);
		$this->add_control(
			'form_content',
			[
				'label' => esc_html__('Content', 'manit-core'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Default content', 'manit-core'),
				'placeholder' => esc_html__('Type your content here', 'manit-core'),
			]
		);
		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Select contact form', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => Controls_Helper_Output::get_posts('wpcf7_contact_form'),
			]
		);
		$this->end_controls_section(); // end: Section

		// consultancey Text
		$this->start_controls_section(
			'section_consultancey_box_style',
			[
				'label' => esc_html__('Consultancey Box Style', 'manit-core'),
				'condition' => [
					'contact_style' => array('style-one'),
				],
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'consultancey_box_color',
			[
				'label' => esc_html__('Bg Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section .cta-wrap ' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'consultancey_box_padding',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section .cta-wrap ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'consultancey_box_border',
				'label' => esc_html__( 'Border', 'manit-core' ),
				'selector' => '{{WRAPPER}} .manit-contact-section .cta-wrap',
			]
		);
		$this->add_control(
			'consultancey_box_border_radius',
			[
				'label' => __( 'Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section .cta-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title Style
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
				'selector' => '{{WRAPPER}} .wpo-contact-pg-section .wpo-contact-title h2, .manit-contact-section .cta-wrap .content h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} wpo-contact-pg-section .wpo-contact-title h2, .manit-contact-section .cta-wrap .content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_pad',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} wpo-contact-pg-section .wpo-contact-title h2, .manit-contact-section .cta-wrap .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content Style

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
				'name' => 'manit_content_typography',
				'selector' => '{{WRAPPER}} wpo-contact-pg-section .wpo-contact-title p, .manit-contact-section .cta-wrap .content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} wpo-contact-pg-section .wpo-contact-title p, .manit-contact-section .cta-wrap .content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_pad',
			[
				'label' => __('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} wpo-contact-pg-section .wpo-contact-title p, .manit-contact-section .cta-wrap .content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_form_style',
			[
				'label' => esc_html__('Form', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'selector' => '{{WRAPPER}} .manit-contact-section form input[type="text"], 
				{{WRAPPER}} .manit-contact-section form input[type="email"], 
				{{WRAPPER}} .manit-contact-section form input[type="date"], 
				{{WRAPPER}} .manit-contact-section form input[type="time"], 
				{{WRAPPER}} .manit-contact-section form input[type="number"], 
				{{WRAPPER}} .manit-contact-section form textarea, 
				{{WRAPPER}} .manit-contact-section form select, 
				{{WRAPPER}} .manit-contact-section form .form-control, 
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'label' => esc_html__('Border', 'manit-core'),
				'selector' => '{{WRAPPER}} .manit-contact-section form input[type="text"], 
				{{WRAPPER}} .manit-contact-section form input[type="email"], 
				{{WRAPPER}} .manit-contact-section forminput[type="date"], 
				{{WRAPPER}} .manit-contact-section form input[type="time"], 
				{{WRAPPER}} .manit-contact-section form input[type="number"], 
				{{WRAPPER}} .manit-contact-section form textarea, 
				{{WRAPPER}} .manit-contact-section form select, 
				{{WRAPPER}} .manit-contact-section form .form-control, 
				{{WRAPPER}} .manit-contact-section form .nice-select,
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',

			]
		);
		$this->add_control(
			'placeholder_text_color',
			[
				'label' => __('Placeholder Text Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form input:not([type="submit"])::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .manit-contact-section form input:not([type="submit"])::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .manit-contact-section form input:not([type="submit"])::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .manit-contact-section form input:not([type="submit"])::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .manit-contact-section form textarea::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .manit-contact-section form textarea::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .manit-contact-section form textarea::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .manit-contact-section form textarea::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace input::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace select::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'label_color',
			[
				'label' => __('Label Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form label' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form input[type="text"], 
					{{WRAPPER}} .manit-contact-section form input[type="email"], 
					{{WRAPPER}} .manit-contact-section form input[type="date"], 
					{{WRAPPER}} .manit-contact-section form input[type="time"], 
					{{WRAPPER}} .manit-contact-section form input[type="number"], 
					{{WRAPPER}} .manit-contact-section form textarea, 
					{{WRAPPER}} .manit-contact-section form select, 
					{{WRAPPER}} .manit-contact-section form .form-control, 
					{{WRAPPER}} .track-contact .track-trace input, 
					{{WRAPPER}} .manit-contact-section form .nice-select' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->end_controls_section(); // end: Section

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
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit',
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__('Width', 'manit-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'btn_margin',
			[
				'label' => __('Margin', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => __('Border Radius', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs('button_style');
		$this->start_controls_tab(
			'button_normal',
			[
				'label' => esc_html__('Normal', 'manit-core'),
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__('Background Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__('Border', 'manit-core'),
				'selector' => '{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit',
			]
		);
		$this->end_controls_tab();  // end:Normal tab

		$this->start_controls_tab(
			'button_hover',
			[
				'label' => esc_html__('Hover', 'manit-core'),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_hover_color',
			[
				'label' => esc_html__('Background Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'label' => esc_html__('Border', 'manit-core'),
				'selector' => '{{WRAPPER}} .manit-contact-section form .wpcf7-form-control.wpcf7-submit:hover',
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Contact Form widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$contact_style = !empty($settings['contact_style']) ? $settings['contact_style'] : '';
		$form_id = !empty($settings['form_id']) ? $settings['form_id'] : '';
		$form_title = !empty($settings['form_title']) ? $settings['form_title'] : '';
		$form_content = !empty($settings['form_content']) ? $settings['form_content'] : '';

		// Turn output buffer on
		ob_start(); ?>
		<?php if ($contact_style == 'style-one') { ?>
			<div class="manit-contact-section cta-section">
				<div class="container">
					<div class="cta-wrap">
						<div class="content">
							<?php
							if ($form_title) {
								echo '<h2>' . esc_html($form_title) . '</h2>';
							}
							if ($form_content) {
								echo '<p>' . esc_html($form_content) . '</p>';
							}
							?>
						</div>
						<?php echo do_shortcode('[contact-form-7 id="' . $form_id . '"]'); ?>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<div class="wpo-contact-pg-section">
				<div class="wpo-contact-title">
					<?php
					if ($form_title) {
						echo '<h2>' . esc_html($form_title) . '</h2>';
					}
					if ($form_content) {
						echo '<p>' . esc_html($form_content) . '</p>';
					}
					?>
				</div>
				<div class="wpo-contact-form-area">
					<?php echo do_shortcode('[contact-form-7 id="' . $form_id . '"]'); ?>
				</div>
			</div>
<?php }
		// Return outbut buffer
		echo ob_get_clean();
	}



	/**
	 * Render Contact Form widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Contact_Form());
