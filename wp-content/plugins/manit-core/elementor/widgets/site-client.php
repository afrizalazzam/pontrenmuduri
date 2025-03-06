<?php
/*
 * Elementor Manit Client Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_Client extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-manit_client';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Client', 'manit-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-photo-library';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Client widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-manit_client'];
	}
	
	/**
	 * Register Manit Client widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_client',
			[
				'label' => esc_html__( 'Client Options', 'manit-core' ),
			]
		);
		$this->add_control(
			'client_style',
			[
				'label' => esc_html__( 'Client Style', 'manit-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__( 'Style One', 'manit-core' ),
					'style-two' => esc_html__( 'Style Two', 'manit-core' ),
				],
				'default' => 'style-one',
				'description' => esc_html__( 'Select your Client style.', 'manit-core' ),
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Title Text', 'manit-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'condition' => [
					'client_style' => array('style-two'),
				],
				'default' => esc_html__( 'Title Text', 'manit-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'manit-core' ),
				'label_block' => true,
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'client_title',
			[
				'label' => esc_html__( 'Title Text', 'manit-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'manit-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'manit-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'client_logo',
			[
				'label' => esc_html__( 'Logo Image', 'manit-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				
			]
		);
		$repeater->add_control(
			'client_link',
			[
				'label' => esc_html__( 'Link', 'manit-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'manit-core' ),
				'label_block' => true,
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$this->add_control(
			'clientLogos_groups',
			[
				'label' => esc_html__( 'Client Logos', 'manit-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'client_title' => esc_html__( 'Client', 'manit-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ client_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
		

		// Background
		$this->start_controls_section(
			'section_client_bg_style',
			[
				'label' => esc_html__( 'Background', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'client_bg_padding',
			[
				'label' => __( 'Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .partners-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' => 'manit_title_typography',
				'selector' => '{{WRAPPER}} .partners-section h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .partners-section h3, .partners-section h3 span' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'title_padding',
			[
				'label' => __( 'Title Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .partners-section h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section	
		
	}

	/**
	 * Render Client widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$clientLogos_groups = !empty( $settings['clientLogos_groups'] ) ? $settings['clientLogos_groups'] : [];
		$section_title = !empty( $settings['section_title'] ) ? $settings['section_title'] : '';
		$client_style = !empty( $settings['client_style'] ) ? $settings['client_style'] : '';

		if ( $client_style == 'style-one' ) {
			$client_col = 'col col-xs-12';
			$client_row = '';
		} else {
			$client_col = 'col col-lg-10 col-xs-12';
			$client_row = 'align-items-center';
		}
		
		// Turn output buffer on
		ob_start();
		 ?>
		 <div class="partners-section">
		    <div class="container">
		        <div class="row <?php echo esc_attr( $client_row ); ?>">
		        	<?php if ( $client_style == 'style-two' ) { ?>
		        	<div class="col-lg-2 col-12">
                <?php if( $section_title ) { echo '<h3>'.wp_kses_post( $section_title ).'</h3>'; } ?>
            	</div>
		        	<?php } ?>
		            <div class="<?php echo esc_attr( $client_col ); ?>">
		                <div class="partner-grids partners-slider owl-carousel">
		                   	<?php 	// Group Param Output
											if( is_array( $clientLogos_groups ) && !empty( $clientLogos_groups ) ){
												foreach ( $clientLogos_groups as $each_logo ) { 

												$image_url = wp_get_attachment_url( $each_logo['client_logo']['id'] );
												$image_alt = get_post_meta( $each_logo['client_logo']['id'], '_wp_attachment_image_alt', true);

												$image_link = !empty( $each_logo['client_link']['url'] ) ? $each_logo['client_link']['url'] : '';
												$image_link_external = !empty( $each_logo['client_link']['is_external'] ) ? 'target="_blank"' : '';
												$image_link_nofollow = !empty( $each_logo['client_link']['nofollow'] ) ? 'rel="nofollow"' : '';
												$image_link_attr = !empty( $image_link ) ?  $image_link_external.' '.$image_link_nofollow : '';

												?>
		                    <div class="grid">
		                        <?php if( $image_link ) { echo '<a href="'.esc_url( $image_link ).'" '.esc_attr( $image_link_attr ).'>'; } ?>
						                   <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
						                <?php if( $image_link ) { echo '</a>'; } ?>
		                    </div>
		                     <?php }
												} ?>
		                </div>
		            </div>
		        </div>
		    </div> <!-- end container -->
		</div>
		<?php
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Client widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Site_Client() );