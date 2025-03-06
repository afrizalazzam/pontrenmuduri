<?php
/*
 * Elementor Manit Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manit_Prayer extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-manit_prayer';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Prayer Time', 'manit-core' );
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
	 * Retrieve the list of scripts the Manit Prayer widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-manit_prayer'];
	}
	
	/**
	 * Register Manit Prayer widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_prayer',
			[
				'label' => esc_html__( 'Prayer Options', 'manit-core' ),
			]
		);
		$this->add_control(
			'prayer_style',
			[
				'label' => esc_html__('Prayer Style', 'manit-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'manit-core'),
					'style-two' => esc_html__('Style two', 'manit-core'),
					'style-three' => esc_html__('Style Three', 'manit-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your Prayer style.', 'manit-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'prayer_title',
			[
				'label' => esc_html__( 'Title Text', 'manit-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Fajar', 'manit-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'manit-core' ),
				'label_block' => true,
			]
		);	
		$repeater->add_control(
			'prayer_subtitle',
			[
				'label' => esc_html__( 'SubTitle Text', 'manit-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '5:10 am', 'manit-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'manit-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'prayerItems_groups',
			[
				'label' => esc_html__( 'Prayer', 'manit-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'prayer_title' => esc_html__( 'Prayer', 'manit-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ prayer_title }}}',
			]
		);
		$this->end_controls_section();// end: Section

		
		// Body
		$this->start_controls_section(
			'section_body_style',
			[
				'label' => esc_html__( 'Body', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'body_bg_color',
			[
				'label' => esc_html__( 'Background', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-prayer .prayertine-wrap, .prayertine-section-s3' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'prayer_body_padding',
			[
				'label' => __( 'Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .manit-prayer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .manit-prayer h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-prayer h2' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .manit-prayer h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		
		// SubTitle
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__( 'Sub Title', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'manit-core' ),
				'name' => 'manit_subtitle_typography',
				'selector' => '{{WRAPPER}} .manit-prayer span',
			]
		);
		$this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .manit-prayer span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sub_title_padding',
			[
				'label' => __( 'Title Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .manit-prayer span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		
	}

	/**
	 * Render Prayer widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$prayerItems_groups = !empty( $settings['prayerItems_groups'] ) ? $settings['prayerItems_groups'] : [];
		// Turn output buffer on
		$prayer_style = !empty($settings['prayer_style']) ? $settings['prayer_style'] : '';
			
		if ( $prayer_style == 'style-one') {
			$prayer_wrap	= 'prayertine-section';
		} elseif( $prayer_style == 'style-two') {
			$prayer_wrap	= 'prayertine-section-s2';
		} else {
			$prayer_wrap	= 'prayertine-section-s3';
		}

	
		ob_start(); ?>
		<div class="manit-prayer <?php echo esc_attr( $prayer_wrap ); ?>">
	    <div class="container">
	        <div class="prayertine-wrap">
	            <div class="row g-0">
	                <?php
					    		// Group Param Output
									if( is_array( $prayerItems_groups ) && !empty( $prayerItems_groups ) ){
									foreach ( $prayerItems_groups as $each_item ) { 	

										$prayer_title = !empty( $each_item['prayer_title'] ) ? $each_item['prayer_title'] : '';
										$prayer_subtitle = !empty( $each_item['prayer_subtitle'] ) ? $each_item['prayer_subtitle'] : '';

										?>
	                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
	                    <div class="item">
	                        <?php if( $prayer_title ) { echo '<h2>'.esc_html( $prayer_title ).'</h2>'; } ?>
	                        <?php if( $prayer_subtitle ) { echo '<span>'.esc_html( $prayer_subtitle ).'</span>'; } ?>
	                    </div>
	                </div>
	              <?php }
	            	} ?>
	            </div>
	        </div>
	    </div>
		</div>
		<?php
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Prayer widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register_widget_type( new Manit_Prayer() );