<?php
/*
 * Elementor Manit Search Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manit_Search extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-search_title';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Search', 'search-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-search';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Search widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	/*
	public function get_script_depends() {
		return ['wpo-search_title'];
	}
	*/
	
	/**
	 * Register Manit Search widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_Search',
			[
				'label' => esc_html__( 'Search Options', 'search-core' ),
			]
		);
		$this->add_control(
			'search_icon',
			[
				'label' => __( 'Icon', 'manit-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fi eicon-search',
					'library' => 'solid',
				],
			]
		);
		$this->end_controls_section();// end: Section

	

		// Content
		$this->start_controls_section(
			'search_icon_content_style',
			[
				'label' => esc_html__( 'Icon', 'search-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'search-core' ),
				'name' => 'section_search_icon_typography',
				'selector' => '{{WRAPPER}} .global-header__search .global-search__toggle-btn i',
			]
		);
		$this->add_control(
			'search_icon_color',
			[
				'label' => esc_html__( 'Color', 'search-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .global-header__search .global-search__toggle-btn i:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'search_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'search-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .global-header__search .global-search__toggle-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
	
		
		
	}

	/**
	 * Render Search widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$section_subtitle = !empty( $settings['section_subtitle'] ) ? $settings['section_subtitle'] : '';

		$search_icon = !empty( $settings['search_icon']['value'] ) ? $settings['search_icon']['value'] : '';
		$search_svg_url = !empty( $settings['search_icon']['value']['url'] ) ? $settings['search_icon']['value']['url'] : '';
		$svg_alt = get_post_meta( $search_svg_url , '_wp_attachment_image_alt', true);

		// Turn output buffer on

		ob_start(); ?>
		 <div class="global-header__search">
		    <div class="global-header__search-wrapper">
		        <div class="global-header__search-contact">
		            <button class="global-search__toggle-btn">

		            	<?php
                     	if ( $search_svg_url ) { 
		            			 echo '<img search-icon"  src="'.esc_url( $search_svg_url ).'" alt="'.esc_url( $svg_alt ).'">';
			            		} else {
			            			echo '<i class="'.esc_attr( $search_icon ).'"></i>';
			            		} 
                    ?>

		            </button>
		            <div class="global_header__search-form">
		                <form method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="form" >
		                    <div>
		                        <input type="text" name="s" class="form-control" placeholder="<?php echo esc_attr__( 'Search here','manit' ); ?>">
		                        <button type="submit"><i class="fi flaticon-loupe"></i></button>
		                    </div>
		                </form>
		            </div>
		        </div>
		    </div>
			</div>
		 	<?php 
		// Return outbut buffer
		echo ob_get_clean();
		
	}
	/**
	 * Render Search widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Manit_Search() );