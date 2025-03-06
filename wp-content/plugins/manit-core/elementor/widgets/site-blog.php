<?php
/*
 * Elementor Manit Blog Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Blog extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-manit_blog';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Blog', 'manit-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-post-list';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Manit Blog widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-manit_blog'];
	}

	/**
	 * Register Manit Blog widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$posts = get_posts('post_type="post"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'manit')] = 0;
		}


		$this->start_controls_section(
			'section_blog_metas',
			[
				'label' => esc_html__('Meta\'s Options', 'manit-core'),
			]
		);
		$this->add_control(
			'blog_image',
			[
				'label' => esc_html__('Image', 'manit-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'manit-core'),
				'label_off' => esc_html__('Hide', 'manit-core'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->add_control(
			'blog_date',
			[
				'label' => esc_html__('Date', 'manit-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'manit-core'),
				'label_off' => esc_html__('Hide', 'manit-core'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->add_control(
			'blog_author',
			[
				'label' => esc_html__('Author', 'manit-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'manit-core'),
				'label_off' => esc_html__('Hide', 'manit-core'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->end_controls_section(); // end: Section


		$this->start_controls_section(
			'section_blog_listing',
			[
				'label' => esc_html__('Listing Options', 'manit-core'),
			]
		);
		$this->add_control(
			'blog_limit',
			[
				'label' => esc_html__('Blog Limit', 'manit-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'manit-core'),
			]
		);
		$this->add_control(
			'blog_order',
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
			'blog_orderby',
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
			'blog_show_category',
			[
				'label' => __('Certain Categories?', 'manit-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'blog_show_id',
			[
				'label' => __('Certain ID\'s?', 'manit-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->add_control(
			'blog_pagination',
			[
				'label' => esc_html__('Pagination', 'manit-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'manit-core'),
				'label_off' => esc_html__('Hide', 'manit-core'),
				'return_value' => 'true',
				'default' => 'true',
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
				'default' => 'Read More',
				'placeholder' => esc_html__('Type your Read More text here', 'manit-core'),
			]
		);
		$this->end_controls_section(); // end: Section


		// Tag
		$this->start_controls_section(
			'blog_section_tag_style',
			[
				'label' => esc_html__('Tag Style', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_tag_typography',
				'selector' => '{{WRAPPER}} .blog-section .blog-card .image span',
			]
		);
		$this->add_control(
			'tag_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .image span' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'tag_border_radius',
			[
				'label' => __( 'Border Radius', 'manit-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .image span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tag_bg',
			[
				'label' => esc_html__('Tag BG Color All', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .image span' => 'background: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'tag_bg_2',
			[
				'label' => esc_html__('Tag BG Color 2', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .col:nth-child(2) .blog-card .image span' => 'background: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'tag_bg_3',
			[
				'label' => esc_html__('Tag BG Color 3', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .col:nth-child(3) .blog-card .image span' => 'background: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Date
		$this->start_controls_section(
			'blog_section_date_style',
			[
				'label' => esc_html__('Meta', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_date_typography',
				'selector' => '{{WRAPPER}} .blog-card .content .date li',
			]
		);
		$this->add_control(
			'date_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-card .content .date li' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'date_padding',
			[
				'label' => esc_html__('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .blog-card .content .date li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
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
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_title_typography',
				'selector' => '{{WRAPPER}} .blog-section .blog-card .content h2 a',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .content h2 a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__('Title Hover Color All', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .content h2 a:hover' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_hover_color2',
			[
				'label' => esc_html__('Title Hover Color 2', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .col:nth-child(2) .blog-card .content h2 a:hover' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_hover_color3',
			[
				'label' => esc_html__('Title Hover Color 3', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .col:nth-child(3) .blog-card .content h2 a:hover' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .contnet h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Read More
		$this->start_controls_section(
			'section_readmore_style',
			[
				'label' => esc_html__('Read More', 'manit-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'manit-core'),
				'name' => 'manit_readmore_typography',
				'selector' => '{{WRAPPER}} .blog-section .blog-card .content .link a span',
			]
		);
		$this->add_control(
			'readmore_color',
			[
				'label' => esc_html__('Color all', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .content .link a span, .blog-section .blog-card .content .link a i' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'readmore_color2',
			[
				'label' => esc_html__('Color 2', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .col:nth-child(2) .blog-card .content .link a span, .blog-section .col:nth-child(2) .blog-card .content .link a i' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'readmore_color3',
			[
				'label' => esc_html__('Color 3', 'manit-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .col:nth-child(3) .blog-card .content .link a span, .blog-section .col:nth-child(3) .blog-card .content .link a i' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Blog widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$blog_limit = !empty($settings['blog_limit']) ? $settings['blog_limit'] : '';
		$blog_image  = (isset($settings['blog_image']) && ('true' == $settings['blog_image'])) ? true : false;
		$blog_date  = (isset($settings['blog_date']) && ('true' == $settings['blog_date'])) ? true : false;
		$blog_tags  = (isset($settings['blog_tags']) && ('true' == $settings['blog_tags'])) ? true : false;

		$blog_author  = (isset($settings['blog_author']) && ('true' == $settings['blog_author'])) ? true : false;

		$blog_order = !empty($settings['blog_order']) ? $settings['blog_order'] : '';
		$blog_orderby = !empty($settings['blog_orderby']) ? $settings['blog_orderby'] : '';
		$blog_show_category = !empty($settings['blog_show_category']) ? $settings['blog_show_category'] : [];
		$blog_show_id = !empty($settings['blog_show_id']) ? $settings['blog_show_id'] : [];
		$blog_pagination  = (isset($settings['blog_pagination']) && ('true' == $settings['blog_pagination'])) ? true : false;

		$short_content = !empty($settings['short_content']) ? $settings['short_content'] : '';
		$excerpt_length = $short_content ? $short_content : '16';

		$read_more_txt = !empty($settings['read_more_txt']) ? $settings['read_more_txt'] : '';

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

		if ($blog_show_id) {
			$blog_show_id = json_encode($blog_show_id);
			$blog_show_id = str_replace(array('[', ']'), '', $blog_show_id);
			$blog_show_id = str_replace(array('"', '"'), '', $blog_show_id);
			$blog_show_id = explode(',', $blog_show_id);
		} else {
			$blog_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'post',
			'posts_per_page' => (int)$blog_limit,
			'category_name' => implode(',', $blog_show_category),
			'orderby' => $blog_orderby,
			'order' => $blog_order,
			'post__in' => $blog_show_id,
		);

		$manit_post = new \WP_Query($args); ?>

		<div class="blog-section">
			<div class="container">
				<div class="row">
					<?php
					if ($manit_post->have_posts()) : while ($manit_post->have_posts()) : $manit_post->the_post();
							$large_image =  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '');
							$large_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);

							$post_options = get_post_meta(get_the_ID(), 'post_options', true);
							$grid_image = isset($post_options['grid_image']) ? $post_options['grid_image'] : '';
							$image_url = wp_get_attachment_url($grid_image);
							$image_alt = get_post_meta($grid_image, '_wp_attachment_image_alt', true);

							$manit_post_image =  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'manit-post-image-one', false, '');
							$manit_post_alt = get_post_meta($manit_post_image, '_wp_attachment_image_alt', true);
					?>
							<div class="col col-lg-4 col-md-6 col-12">
								<div class="blog-card">
									<div class="image">
										<?php if ($blog_image) { ?>
											<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
										<?php } ?>
										<?php
										$posttags = get_the_tags();
										$count = 0;
										if ($posttags) {
											foreach ($posttags as $tag) {
												$count++;
												echo '<span>' . esc_html($tag->name) . '</span> ';
												if ($count > 0) break;
											}
										}
										?>
									</div>
									<div class="content">
										<ul class="date">
											<?php if ($blog_date) { ?>
												<li><?php the_time('d M Y'); ?></li>
											<?php } ?>
											<?php if ($blog_author) { ?>
												<li><?php echo get_the_author_meta('display_name', get_the_author_meta('ID')); ?></li>
											<?php } ?>
										</ul>
										<h2>
											<a href="<?php echo esc_url(get_permalink()); ?>">
												<?php echo esc_html(get_the_title()); ?>
											</a>
										</h2>
										<div class="link">
											<?php if ($read_more_txt) {
												echo ' <a href="' . esc_url(get_permalink()) . '" class="more"><span>' . esc_html($read_more_txt) . '</span><i class="ti-arrow-right"></i></a>';
											} ?>
										</div>
									</div>
								</div>
							</div>
						<?php
						endwhile;
					endif;
					wp_reset_postdata();
					if ($blog_pagination) { ?>
						<div class="page-pagination-wrap">
							<?php echo '<div class="paginations">';
							$big = 999999999;
							echo paginate_links(array(
								'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
								'format'    => '?paged=%#%',
								'total'     => $manit_post->max_num_pages,
								'show_all'  => false,
								'current'   => max(1, $my_page),
								'prev_text'    => '<div class="fi flaticon-back"></div>',
								'next_text'    => '<div class="fi flaticon-next"></div>',
								'mid_size'  => 1,
								'type'      => 'list'
							));
							echo '</div>'; ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Blog widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Blog());
