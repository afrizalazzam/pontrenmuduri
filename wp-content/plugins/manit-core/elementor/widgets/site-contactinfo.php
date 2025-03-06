<?php
/*
 * Elementor Manit Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manit_Contactinfo extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-manit_contactinfo';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Contact Info', 'manit-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Contactinfo widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-manit_contactinfo'];
	}
	
	/**
	 * Register Manit Contactinfo widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_contactinfo',
			[
				'label' => esc_html__( 'Contactinfo Options', 'manit-core' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'contactinfo_icon',
			[
				'label' => __( 'Icon', 'manit-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fi flaticon-place',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'contactinfo_title',
			[
				'label' => esc_html__( 'Title Text', 'manit-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '24/7 customer support.', 'manit-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'manit-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'contactinfo_content',
			[
				'label' => esc_html__( 'Content', 'manit-core' ),
				'default' => esc_html__( 'your content text', 'manit-core' ),
				'placeholder' => esc_html__( 'Type your content here', 'manit-core' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$this->add_control(
			'contactinfoItems_groups',
			[
				'label' => esc_html__( 'Contactinfo Icons', 'manit-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'contactinfo_title' => esc_html__( 'Contactinfo', 'manit-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ contactinfo_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
		

		$this->start_controls_section(
			'section_contactinfo_section_style',
			[
				'label' => esc_html__( 'Info Box', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'contactinfo_item_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .office-info .office-info-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'contactinfo_item_border_color',
			[
				'label' => esc_html__( 'Border Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .office-info .office-info-item' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section


		// Contactinfo Icons
		$this->start_controls_section(
			'section_contactinfo_icon_section_style',
			[
				'label' => esc_html__( 'Icon BG', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'contactinfo_item_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-info-section .office-info .office-info-item .office-info-icon .icon .fi:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		
		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'manit-core' ),
				'name' => 'manit_title_typography',
				'selector' => '{{WRAPPER}} .office-info .office-info-item .office-info-text span',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .office-info .office-info-item .office-info-text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => __( 'Title Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .office-info .office-info-item .office-info-text span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'manit-core' ),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .office-info .office-info-item .office-info-text p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .office-info .office-info-item .office-info-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Active
		$this->start_controls_section(
			'section_content_active_style',
			[
				'label' => esc_html__( 'Active', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'active_bg_color',
			[
				'label' => esc_html__( 'Active Background', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-info-section .office-info .office-info-item.active' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'active_border_color',
			[
				'label' => esc_html__( 'Active Border', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-info-section .office-info .office-info-item.active' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'active_color',
			[
				'label' => esc_html__( 'Text Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-info-section .office-info .office-info-item .office-info-text p, .contact-info-section .office-info .office-info-item.active .office-info-text span, .contact-info-section .office-info .office-info-item.active .office-info-icon .icon .fi:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
	}

	/**
	 * Render Contactinfo widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$contactinfoItems_groups = !empty( $settings['contactinfoItems_groups'] ) ? $settings['contactinfoItems_groups'] : [];
		// Turn output buffer on
	
		ob_start(); ?>
		<div class="contact-info-section">
	    <div class="container">
	        <div class="office-info">
	            <div class="row">
               <?php
               $id = 0;
		        		// Group Param Output
								if( is_array( $contactinfoItems_groups ) && !empty( $contactinfoItems_groups ) ){
								foreach ( $contactinfoItems_groups as $each_item ) { 	
									$id++;
								$contactinfo_title = !empty( $each_item['contactinfo_title'] ) ? $each_item['contactinfo_title'] : '';
								$contactinfo_content = !empty( $each_item['contactinfo_content'] ) ? $each_item['contactinfo_content'] : '';
								$contactinfo_icon = !empty( $each_item['contactinfo_icon']['value'] ) ? $each_item['contactinfo_icon']['value'] : '';
								$contactinfo_svg_url = !empty( $each_item['contactinfo_icon']['value']['url'] ) ? $each_item['contactinfo_icon']['value']['url'] : '';
								$svg_alt = get_post_meta( $contactinfo_svg_url , '_wp_attachment_image_alt', true);

								if ( $id == '2' ) {
								 	$active_class = 'active';
								} else {
									$active_class = '';
								}

								?>
                <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                    <div class="office-info-item <?php echo esc_attr( $active_class ); ?>">
                        <div class="office-info-icon">
                            <div class="icon">
                            <?php
		                         	if ( $contactinfo_svg_url ) { 
						            			 echo '<img class="default-icon"  src="'.esc_url( $contactinfo_svg_url ).'" alt="'.esc_url( $svg_alt ).'">';
							            		} else {
							            			echo '<i class="'.esc_attr( $contactinfo_icon ).'"></i>';
							            		} 
		                        ?>
                            </div>
                        </div>
                        <div class="office-info-text">
                        	 <?php 
							            	if( $contactinfo_title ) { echo '<span>'.esc_html( $contactinfo_title ).'</span>'; }
							            	if( $contactinfo_content ) { echo wp_kses_post( $contactinfo_content ); }
							             ?>
                        </div>
                    </div>
                </div>
               <?php }
							} ?>
	        </div>
	      </div>
	    </div> <!-- end contianer -->
		</div>
		<?php
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Contactinfo widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register_widget_type( new Manit_Contactinfo() );