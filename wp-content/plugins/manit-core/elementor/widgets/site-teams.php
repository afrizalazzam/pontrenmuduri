<?php
/*
 * Elementor Manit Team Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Manit_Teams extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-manit_teams';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Team Single', 'manit-core' );
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
		return ['wpo-manit_teams'];
	}
	
	/**
	 * Register Manit Team widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){


		$posts = get_posts( 'post_type="team"&numberposts=-1' );
    $PostID = array();
    if ( $posts ) {
      foreach ( $posts as $post ) {
        $PostID[ $post->ID ] = $post->ID;
      }
    } else {
      $PostID[ __( 'No ID\'s found', 'manit' ) ] = 0;
    }

		$this->start_controls_section(
			'section_team_listing',
			[
				'label' => esc_html__( 'Team Options', 'manit-core' ),
			]
		);
		$this->add_control(
			'team_limit',
			[
				'label' => esc_html__( 'Team Limit', 'manit-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__( 'Enter the number of items to show.', 'manit-core' ),
			]
		);
		$this->add_control(
			'team_order',
			[
				'label' => __( 'Order', 'manit-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__( 'Asending', 'manit-core' ),
					'DESC' => esc_html__( 'Desending', 'manit-core' ),
				],
				'default' => 'DESC',
			]
		);
		$this->add_control(
			'team_orderby',
			[
				'label' => __( 'Order By', 'manit-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'manit-core' ),
					'ID' => esc_html__( 'ID', 'manit-core' ),
					'author' => esc_html__( 'Author', 'manit-core' ),
					'title' => esc_html__( 'Title', 'manit-core' ),
					'date' => esc_html__( 'Date', 'manit-core' ),
					'menu_order' => esc_html__( 'Menu Order', 'manit-core' ),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'team_show_category',
			[
				'label' => __( 'Certain Categories?', 'manit-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names( 'team_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'team_show_id',
			[
				'label' => __( 'Certain ID\'s?', 'manit-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
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

		$team_limit = !empty( $settings['team_limit'] ) ? $settings['team_limit'] : '';
		$team_order = !empty( $settings['team_order'] ) ? $settings['team_order'] : '';
		$team_orderby = !empty( $settings['team_orderby'] ) ? $settings['team_orderby'] : '';
		$team_show_category = !empty( $settings['team_show_category'] ) ? $settings['team_show_category'] : [];
		$team_show_id = !empty( $settings['team_show_id'] ) ? $settings['team_show_id'] : [];


		// Turn output buffer on
		ob_start();

		// Pagination
		global $paged;
		if( get_query_var( 'paged' ) )
		  $my_page = get_query_var( 'paged' );
		else {
		  if( get_query_var( 'page' ) )
			$my_page = get_query_var( 'page' );
		  else
			$my_page = 1;
		  set_query_var( 'paged', $my_page );
		  $paged = $my_page;
		}

    if ($team_show_id) {
			$team_show_id = json_encode( $team_show_id );
			$team_show_id = str_replace(array( '[', ']' ), '', $team_show_id);
			$team_show_id = str_replace(array( '"', '"' ), '', $team_show_id);
      $team_show_id = explode(',',$team_show_id);
    } else {
      $team_show_id = '';
    }

		$args = array(
		  // other query params here,
		  'paged' => $my_page,
		  'post_type' => 'team',
		  'posts_per_page' => (int)$team_limit,
		  'team_category' => implode(',', $team_show_category),
		  'orderby' => $team_orderby,
		  'order' => $team_order,
      'post__in' => $team_show_id,
		);

		$manit_team = new \WP_Query( $args );

		?>
		<div class="wpo-volunteer-section">
    	<div class="container">
        <div class="volunteer-wraper">
            <div class="row">
	            	<?php 
									if ( $manit_team->have_posts()) : while ( $manit_team->have_posts()) : $manit_team->the_post();
									
										$team_options = get_post_meta( get_the_ID(), 'team_options', true );
										$team_subtitle = isset( $team_options['team_subtitle']) ? $team_options['team_subtitle'] : '';
										$team_image = isset( $team_options['team_image']) ? $team_options['team_image'] : '';
										$team_socials = isset($team_options['team_socials']) ? $team_options['team_socials'] : '';
										global $post;
										$image_url = wp_get_attachment_url( $team_image );
										$image_alt = get_post_meta( $team_image , '_wp_attachment_image_alt', true);
										?>

										<div class="col-lg-3 col-md-6 col-sm-6 col-12">
	                    <div class="volunteer-single">
	                        <div class="image">
	                            <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_attr( $image_alt ).'">'; } ?>
	                        </div>
	                        <div class="content">
	                            <h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_the_title(); ?></a></h2>
	                           	<?php if( $team_subtitle ) { echo '<span>'.esc_html( $team_subtitle ).'</span>'; } ?>
	                            <ul>
	                               <?php if ( $team_socials ) {
		                                	foreach ( $team_socials as $key => $team_social ) {
																	    echo'<li class="on"><a href="'.esc_url( $team_social['social_link'] ).'"><i class="'.esc_attr( $team_social['social_icon']  ).'" ></i></a></li>';
																	  } 
		                                } 
		                               ?>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	                <?php 
								  endwhile;
								  endif;
								  wp_reset_postdata();
								 ?>
	            </div>
	        </div>
	    	</div> <!-- end container -->
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
Plugin::instance()->widgets_manager->register( new Manit_Teams() );