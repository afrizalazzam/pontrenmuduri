<?php
/*
 * Elementor Manit FooterNavmenu Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manit_FooterNavmenu extends Widget_Base{

	protected $nav_menu_index = 1;

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-manit_footernavmenu';
	}

	/**
	 * Retrieve the widget footernavmenu.
	*/
	public function get_title(){
		return esc_html__( 'Footer Menu', 'manit-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	public function get_keywords() {
		return [ 'menu', 'nav', 'footer menu' ];
	}

	public function on_export( $element ) {
		unset( $element['settings']['menu'] );

		return $element;
	}

	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	/**
	 * Retrieve the list of scripts the Manit FooterNavmenu widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-manit_footernavmenu'];
	}
	
	
	/**
	 * Register Manit FooterNavmenu widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_FooterNavmenu',
			[
				'label' => esc_html__( 'FooterNavmenu Options', 'manit-core' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label' => __( 'Menu', 'manit' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'save_default' => true,
					'separator' => 'after',
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'manit' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'There are no menus in your site.', 'manit' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'manit' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'manit-panel-alert manit-panel-alert-info',
				]
			);
		}

		$this->end_controls_section();// end: Section
		
		$this->start_controls_section(
			'manit_section_style_main-menu',
			[
				'label' => __( 'Main Menu', 'manit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'manit_footer_menu_typography',
				'selector' => '{{WRAPPER}} .footer-menu.link-widget ul li a',
			]
		);
		$this->add_control(
			'footer_menu_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer-menu.link-widget ul li a' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'footer_menu_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer-menu.link-widget ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'footer_menu_dot_color',
			[
				'label' => esc_html__( 'Dot Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer-menu.link-widget ul li:before' => 'background-color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_section();// end: Section

		
	}

	/**
	 * Render FooterNavmenu widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$available_menus = $this->get_available_menus();

		if ( ! $available_menus ) {
			return;
		}

		$settings = $this->get_active_settings();

		$args = [
			'echo' => false,
			'menu' => $settings['menu'],
			'menu_class' => 'nav navbar-nav mb-2 mb-lg-0',
			'menu_id' => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container' => '',
		];

		// General Menu.
		$menu_html = wp_nav_menu( $args );


		if ( empty( $menu_html ) ) {
			return;
		}


		// Turn output buffer on

		ob_start(); ?>

		<div <?php echo $this->get_render_attribute_string( 'main-menu' ); ?> class="footer-menu link-widget">
			 <?php echo $menu_html; ?>
		</div>
		<?php // Return outbut buffer
		echo ob_get_clean();
		
	}

	/**
	 * Render FooterNavmenu widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Manit_FooterNavmenu() );