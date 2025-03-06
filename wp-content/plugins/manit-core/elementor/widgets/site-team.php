<?php
/*
 * Elementor Manit Team Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manit_Team extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-manit_team';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Team', 'manit-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Team widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-manit_team'];
	}
	
	/**
	 * Register Manit Team widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_team',
			[
				'label' => esc_html__( 'Team Options', 'manit-core' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'team_title',
			[
				'label' => esc_html__( 'Title Text', 'manit-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'manit-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'manit-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'team_subtitle',
			[
				'label' => esc_html__( 'Sub Title Text', 'manit-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sub Title Text', 'manit-core' ),
				'placeholder' => esc_html__( 'Type sub title text here', 'manit-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'bg_image',
			[
				'label' => esc_html__( 'Team Image', 'manit-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'manit-core'),
			]
		);
		$this->add_control(
			'teamItems_groups',
			[
				'label' => esc_html__( 'Team Items', 'manit-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'team_title' => esc_html__( 'Team', 'manit-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ team_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
	

		
		// Team Image
		$this->start_controls_section(
			'team_section_image_style',
			[
				'label' => esc_html__( 'Image', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_image_border_color',
				'label' => esc_html__('Border', 'manit-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-img:before',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Border Color', 'manit-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section();// end: Section

		
		
		// Title
		$this->start_controls_section(
			'team_section_title_style',
			[
				'label' => esc_html__( 'Title', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'manit-core' ),
				'name' => 'team_manit_title_typography',
				'selector' => '{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text h2',
			]
		);
		$this->add_control(
			'team_title_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text h2 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section


		// Subtitle
		$this->start_controls_section(
			'team_section_subtitle_style',
			[
				'label' => esc_html__( 'Subtitle', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_subtitle_color',
				'label' => esc_html__('Color', 'manit-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text span',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Color', 'manit-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->add_control(
			'team_subtitle_padding',
			[
				'label' => esc_html__( 'Subtitle Padding', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		// Icon
		$this->start_controls_section(
			'section_content_icon_style',
			[
				'label' => esc_html__( 'Icon', 'manit-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'team_icon_color',
			[
				'label' => esc_html__( 'Color', 'manit-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-item .wpo-team-img .wpo-team-img-box ul li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_icon_bg_color',
				'label' => esc_html__('Background', 'manit-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-img .wpo-team-img-box ul li a',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background Color', 'manit-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section();// end: Section
		
	}

	/**
	 * Render Team widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$teamItems_groups = !empty( $settings['teamItems_groups'] ) ? $settings['teamItems_groups'] : [];

		// Turn output buffer on
		ob_start();
		?>
		<div class="wpo-team-section">
    	<div class="container">
        <div class="wpo-team-wrap">
            <div class="row">
             	<?php 	// Group Param Output
							if( is_array( $teamItems_groups ) && !empty( $teamItems_groups ) ){
							foreach ( $teamItems_groups as $each_items) { 

							$team_title = !empty( $each_items['team_title'] ) ? $each_items['team_title'] : '';
							$team_subtitle = !empty( $each_items['team_subtitle'] ) ? $each_items['team_subtitle'] : '';
							$bg_image = !empty( $each_items['bg_image']['id'] ) ? $each_items['bg_image']['id'] : '';
							$image_url = wp_get_attachment_url( $each_items['bg_image']['id'] );
							$image_alt = get_post_meta( $each_items['bg_image']['id'], '_wp_attachment_image_alt', true);

							?>

              <div class="col col-lg-3 col-md-6 col-12">
                  <div class="wpo-team-item item">
                      <div class="wpo-team-img">
                          <div class="wpo-team-img-box">
                             <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_attr( $image_alt ).'">'; } ?>
                          </div>
                      </div>
                      <div class="wpo-team-text">
                      	 <?php 
						              	if( $team_title ) { echo '<h2>'.esc_html( $team_title ).'</h2>'; } 
						              	if( $team_subtitle ) { echo '<span>'.esc_html( $team_subtitle ).'</span>'; }
						              ?>
                      </div>
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
	 * Render Team widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Manit_Team() );