<?php

namespace ProvixCore\Widgets;

if (! defined('ABSPATH')) {
	exit;
}

/**
 * Agenvix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Hero_Banner extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hero-banner';
	}

	public function get_title() {
		return __('Hero Banner', 'agenvix-core');
	}

	public function get_icon() {
		return 'provix-icon';
	}

	public function get_categories() {
		return array('agenvix-core');
	}

	public function get_script_depends() {
		return array('agenvix-core');
	}

	protected function register_controls() {

		/**
		 * Layout section
		 */
		$this->start_controls_section(
			'provix_layout',
			array(
				'label' => esc_html__('Design Layout', 'agenvix-core'),
			)
		);
		$this->add_control(
			'provix_design_style',
			array(
				'label'   => esc_html__( 'Select Layout', 'agenvix-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
					'layout-4' => esc_html__( 'Layout 4', 'agenvix-core' ),
					'layout-5' => esc_html__( 'Layout 5', 'agenvix-core' ),
					'layout-6' => esc_html__( 'Layout 6', 'agenvix-core' ),
					'layout-7' => esc_html__( 'Layout 7', 'agenvix-core' ),
					'layout-8' => esc_html__( 'Layout 8', 'agenvix-core' ),
				),
				'default' => 'layout-1',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'banner_text',
			array(
				'label' => esc_html__('Text', 'agenvix-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

			$this->add_control(
				'subtitle',
				array(
					'label'       => esc_html__('Subtitle', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Default Subtitle', 'agenvix-core'),
					'label_block' => true,
				)
			);
			$this->add_control(
				'title_1',
				array(
					'label'       => esc_html__('Title 1', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Default Title', 'agenvix-core'),
					'label_block' => true,
				)
			);
			$this->add_control(
				'title_2',
				array(
					'label'       => esc_html__('Title 2', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Default Title', 'agenvix-core'),
					'label_block' => true,
				)
			);
			$this->add_control(
				'title_3',
				array(
					'label'       => esc_html__('Title 3', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Default Title', 'agenvix-core'),
					'label_block' => true,
				)
			);
			$this->add_control(
				'description',
				array(
					'label'   => esc_html__('Description', 'agenvix-core'),
					'type'    => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__('Default Description', 'agenvix-core'),
				)
			);
			$this->add_control(
				'highlight_text1',
				array(
					'label'       => esc_html__( 'Highlight Text 1', 'agenvix-core' ),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Financial', 'agenvix-core'),
				)
			);
			$this->add_control(
				'highlight_text2',
				array(
					'label'       => esc_html__( 'Highlight Text 2', 'agenvix-core' ),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Business', 'agenvix-core'),
				)
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'image_section',
			array(
				'label' => esc_html__('Image', 'agenvix-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

			$this->add_control(
				'hero_image1',
				array(
					'label'   => esc_html__( 'Image 1', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);
			$this->add_control(
				'hero_image2',
				array(
					'label'   => esc_html__( 'Image 2', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);
			$this->add_control(
				'hero_image3',
				array(
					'label'   => esc_html__( 'Image 3', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);
			$this->add_control(
				'hero_image4',
				array(
					'label'   => esc_html__( 'Image 4', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);
			$this->add_control(
				'hero_image5',
				array(
					'label'   => esc_html__( 'Image 5', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);
			$this->add_control(
				'hero_image6',
				array(
					'label'   => esc_html__( 'Image 6', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'video_section',
			array(
				'label' => esc_html__('Video', 'agenvix-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'provix_design_style' => array('layout-8'),
				),
			)
		);
		$this->add_control(
			'video_file',
			[
				'label' => esc_html__('Upload Video', 'agenvix-core'),
				'type'  => \Elementor\Controls_Manager::MEDIA,
				'media_types' => ['video'],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'shape_section',
			array(
				'label' => esc_html__('Shape', 'agenvix-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'provix_design_style' => array('layout-5', 'layout-6'),
				),
			)
		);

			$this->add_control(
				'shape_image1',
				array(
					'label'   => esc_html__( 'Shape 1', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);
			$this->add_control(
				'shape_image2',
				array(
					'label'   => esc_html__( 'Shape 2', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);
			$this->add_control(
				'shape_image3',
				array(
					'label'   => esc_html__( 'Shape 3', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'rotating_circle',
			array(
				'label' => esc_html__('Rotating Circle', 'agenvix-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

			$this->add_control(
				'rotating_text',
				array(
					'label'   => esc_html__( 'Roating text', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					),
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'counter_box',
			array(
				'label'     => esc_html__('Counter Box', 'agenvix-core'),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'provix_design_style' => array('layout-1'),
				),
			)
		);

			$this->add_control(
				'counter_number',
				array(
					'label'       => esc_html__('Number', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('12K', 'agenvix-core'),
					'label_block' => true,
				)
			);
			$this->add_control(
				'counter_title',
				array(
					'label'       => esc_html__('Title', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Client Satisfied', 'agenvix-core'),
					'label_block' => true,
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'testi_box',
			array(
				'label'     => esc_html__('Testimonial Box', 'agenvix-core'),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'provix_design_style' => array( 'layout-7' ),
				),
			)
		);

			$this->add_control(
				'hero_quote',
				[
					'label' => esc_html__( 'Quote', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 8,
					'default' => esc_html__( 'Default description', 'agenvix-core' ),
					'placeholder' => esc_html__( 'Type your description here', 'agenvix-core' ),
				]
			);
			$this->add_control(
				'client_image',
				[
					'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
			$this->add_control(
				'client_name',
				[
					'label' => esc_html__( 'Name', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Mildred J. Roth', 'agenvix-core' ),
					'placeholder' => esc_html__( 'Type your title here', 'agenvix-core' ),
				]
			);
			$this->add_control(
				'client_designation',
				[
					'label' => esc_html__( 'Designation', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Director of Strategy', 'agenvix-core' ),
					'placeholder' => esc_html__( 'Type your designation here', 'agenvix-core' ),
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'review_box',
			array(
				'label'     => esc_html__('Review Box', 'agenvix-core'),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'provix_design_style' => array( 'layout-2', 'layout-3', 'layout-4', 'layout-6', 'layout-7' ),
				),
			)
		);

			$this->add_control(
				'client_images',
				array(
					'label'      => esc_html__('Add Images', 'agenvix-core'),
					'type'       => \Elementor\Controls_Manager::GALLERY,
					'show_label' => false,
					'default'    => array(),
				)
			);
			$this->add_control(
				'total_review',
				array(
					'label'       => esc_html__('Total Review', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('24K+', 'agenvix-core'),
					'placeholder' => esc_html__('Type your number here', 'agenvix-core'),
				)
			);
			$this->add_control(
				'review_title',
				array(
					'label'       => esc_html__('Review Title', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Default review title', 'agenvix-core'),
					'placeholder' => esc_html__('Type your title here', 'agenvix-core'),
					'label_block' => true,
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'experience_box',
			array(
				'label'     => esc_html__('Experience Box', 'agenvix-core'),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'provix_design_style' => array('layout-1'),
				),
			)
		);

		$this->add_control(
			'experience_year',
			array(
				'label'       => esc_html__('Years of Experience', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('05', 'agenvix-core'),
				'placeholder' => esc_html__('Type your number here', 'agenvix-core'),
			)
		);
		$this->add_control(
			'experience_title',
			array(
				'label'       => esc_html__('Title', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Years of Experience', 'agenvix-core'),
				'placeholder' => esc_html__('Type your title here', 'agenvix-core'),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'social_icons',
			array(
				'label'     => esc_html__('Social Icons', 'agenvix-core'),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'provix_design_style' => array('layout-2', 'layout-3'),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_media_name',
			array(
				'label'       => esc_html__('Name', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Default title', 'agenvix-core'),
				'placeholder' => esc_html__('Type your title here', 'agenvix-core'),
			)
		);
		$repeater->add_control(
			'social_media_link',
			array(
				'label'       => esc_html__('Link', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::URL,
				'options'     => array('url', 'is_external', 'nofollow'),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
					// 'custom_attributes' => '',
				),
				'label_block' => true,
			)
		);
		$this->add_control(
			'social_media_list',
			array(
				'label'       => esc_html__('Social Media List', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'social_media_name' => esc_html__('FB', 'agenvix-core'),
					),
					array(
						'social_media_name' => esc_html__('TW', 'agenvix-core'),
					),
					array(
						'social_media_name' => esc_html__('LN', 'agenvix-core'),
					),
				),
				'title_field' => '{{{ social_media_name }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			array(
				'label' => esc_html__('Button', 'agenvix-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

			$this->add_control(
				'button1_text',
				array(
					'label'       => esc_html__('Button 1 Text', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Click Here', 'agenvix-core'),
				)
			);
			$this->add_control(
				'button1_link',
				array(
					'label'       => esc_html__('Button 1 Link', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::URL,
					'options'     => array('url', 'is_external', 'nofollow'),
					'default'     => array(
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
						// 'custom_attributes' => '',
					),
					'label_block' => true,
				)
			);
			$this->add_control(
				'button2_text',
				array(
					'label'       => esc_html__('Button 2 Text', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Click Here', 'agenvix-core'),
				)
			);
			$this->add_control(
				'button2_link',
				array(
					'label'       => esc_html__('Button 2 Link', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::URL,
					'options'     => array('url', 'is_external', 'nofollow'),
					'default'     => array(
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
						// 'custom_attributes' => '',
					),
					'label_block' => true,
				)
			);
			$this->add_control(
				'button3_text',
				array(
					'label'       => esc_html__('Button 3 Text', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Click Here', 'agenvix-core'),
				)
			);
			$this->add_control(
				'button3_link',
				array(
					'label'       => esc_html__('Button 3 Link', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::URL,
					'options'     => array('url', 'is_external', 'nofollow'),
					'default'     => array(
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
						// 'custom_attributes' => '',
					),
					'label_block' => true,
				)
			);
			$this->add_control(
				'button4_text',
				array(
					'label'       => esc_html__('Button 4 Text', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::TEXT,
					'default'     => esc_html__('Click Here', 'agenvix-core'),
				)
			);
			$this->add_control(
				'button4_link',
				array(
					'label'       => esc_html__('Button 4 Link', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::URL,
					'options'     => array('url', 'is_external', 'nofollow'),
					'default'     => array(
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
						// 'custom_attributes' => '',
					),
					'label_block' => true,
				)
			);

			$this->add_control(
				'scroll_down_btn_text',
				array(
					'label'   => esc_html__( 'Scroll Down Button Text', 'agenvix-core' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Scroll Down', 'agenvix-core' ),
				)
			);
			$this->add_control(
				'scroll_down_btn_link',
				array(
					'label'       => esc_html__('Scroll Down Button Link', 'agenvix-core'),
					'type'        => \Elementor\Controls_Manager::URL,
					'options'     => array('url', 'is_external', 'nofollow'),
					'default'     => array(
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
						// 'custom_attributes' => '',
					),
					'label_block' => true,
				)
			);

		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'general_style',
			array(
				'label' => __('General', 'agenvix-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'hero_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .banner-area',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ouprovixut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>

		<?php
		if ( 'layout-1' === $settings['provix_design_style'] ) :

			if (! empty($settings['hero_image1']['url'])) {
				$hero_image1     = ! empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url($settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
				$hero_image1_alt = get_post_meta($settings['hero_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['hero_image2']['url'])) {
				$hero_image2     = ! empty($settings['hero_image2']['id']) ? wp_get_attachment_image_url($settings['hero_image2']['id'], '') : $settings['hero_image2']['url'];
				$hero_image2_alt = get_post_meta($settings['hero_image2']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['rotating_text']['url'])) {
				$rotating_text     = ! empty($settings['rotating_text']['id']) ? wp_get_attachment_image_url($settings['rotating_text']['id'], '') : $settings['rotating_text']['url'];
				$rotating_text_alt = get_post_meta($settings['rotating_text']['id'], '_wp_attachment_image_alt', true);
			}

			$this->add_render_attribute('title_args', 'class', 'banner-title');

			$icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/star66.png';

		?>

			<div class="banner-area style-one">
				<div class="banner-one-top">
					<div class="row align-items-center">
						<div class="col-lg-7">
							<div class="banner-one-title">
								<h2 class="text-anim-2"><?php echo $settings['title_1']; ?></h2>
								<div class="banner-icon-1">
									<i class="fa-solid fa-arrow-right-long"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="banner-one-top-right">
								<div class="star">
									<svg xmlns="http://www.w3.org/2000/svg" width="58" height="58" viewBox="0 0 58 58" fill="none">
										<g clip-path="url(#clip0_7007_1807)">
											<path d="M20.3784 0.828571C21.3816 2.56857 21.3816 2.56857 22.2281 4.83886C22.5338 5.65086 22.8473 6.46286 23.1608 7.29971C23.4743 8.15314 23.78 9.00657 24.1014 9.89314C24.4227 10.7466 24.7441 11.5917 25.0811 12.47C27.4324 18.7671 27.4324 18.7671 27.4324 20.7143C29.627 19.8691 30.4343 19.314 31.5708 17.1183C31.853 16.3311 32.1273 15.544 32.4173 14.7237C32.723 13.8703 33.0365 13.0169 33.35 12.1386C33.6635 11.2437 33.9692 10.3489 34.2905 9.42914C34.7765 8.07029 34.7765 8.07029 35.2703 6.69486C36.0619 4.466 36.8457 2.23714 37.6216 0C40.5608 0.563429 42.7241 1.35886 45.3105 2.94971C45.9297 3.33086 46.5489 3.70371 47.1916 4.09314C47.6541 4.38314 48.1165 4.67314 48.5946 4.97143C47.2073 8.43486 44.9735 11.1774 42.7632 14.0857C41.6346 15.5854 40.5059 17.0851 39.3851 18.5849C38.5778 19.662 37.7705 20.7309 36.9554 21.7997C35.9051 23.142 35.9051 23.142 36.0541 24.8571C43.3746 24.3517 50.6873 23.8049 58 23.2C58 27.028 58 30.856 58 34.8C56.5578 34.684 55.1235 34.5597 53.6422 34.4354C47.7795 33.9631 41.9168 33.5489 36.0541 33.1429C37.2376 37.0951 39.3381 39.672 41.8854 42.7211C48.5946 50.8826 48.5946 50.8826 48.5946 53.0286C47.2073 53.8654 45.82 54.694 44.4327 55.5143C43.6568 55.9783 42.8886 56.434 42.0892 56.9146C39.973 58 39.973 58 37.6216 58C33.7419 48.1566 33.7419 48.1566 29.7838 38.1143C29.0078 38.1143 28.2319 38.1143 27.4324 38.1143C24.8459 44.6766 22.2595 51.2389 19.5946 58C15.5973 56.5914 12.9168 55.2574 9.40541 53.0286C10.5419 49.3497 12.47 46.7397 14.8449 43.8646C19.3751 38.6611 19.3751 38.6611 21.9459 32.3143C21.4443 32.3889 20.9505 32.4634 20.4411 32.5463C18.1681 32.886 15.8951 33.2174 13.6222 33.5571C12.8384 33.6731 12.0546 33.7974 11.2473 33.9134C10.103 34.0874 10.103 34.0874 8.93513 34.2531C8.23757 34.3609 7.54 34.4686 6.81892 34.568C4.55378 34.8166 2.27297 34.8 0 34.8C0 30.972 0 27.144 0 23.2C7.37541 23.722 14.6332 24.5837 21.9459 25.6857C20.7389 21.7003 18.5757 18.8914 16.1146 15.6931C14.9859 14.2017 13.8651 12.7186 12.7365 11.2271C11.9292 10.1666 11.0984 9.12257 10.2597 8.07857C9.97757 7.60629 9.69541 7.12571 9.40541 6.62857C10.3538 3.62914 11.0278 3.35571 13.5673 1.86429C14.1786 1.49143 14.79 1.11857 15.4249 0.737429C17.5724 -0.132571 18.2778 -0.124286 20.3784 0.828571Z" fill="#C3DF94" />
										</g>
										<defs>
											<clipPath id="clip0_7007_1807">
												<rect width="58" height="58" fill="white" />
											</clipPath>
										</defs>
									</svg>
								</div>
								<div class="banner-round-text">
									<div class="round-box-content">
										<span class="curved-circl">
											<img src="<?php echo esc_url($rotating_text); ?>" alt="icon">
										</span>
										<div class="round-box-icon">
											<a href="#"><img src="<?php echo esc_url($icon_url); ?>" alt="icon"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="banner-one-bottom">
					<div class="row">
						<div class="col-lg-8">
							<div class="banner-one-bottom-left wow fadeInLeft">
								<div class="banner-one-bottom-image shining">
									<img src="<?php echo esc_url($hero_image1); ?>" alt="image">
								</div>
								<div class="banner-one-left-content">
									<div class="banner-one-left-content-inner tilt">
										<h3><?php echo $settings['counter_number']; ?></h3>
										<h4><?php echo $settings['counter_title']; ?></h4>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="banner-one-bottom-right wow fadeInRight">
								<div class="twenty-four">
									<h4><?php echo $settings['experience_year']; ?></h4>
									<div class="twenty-four-inner"></div>
								</div>
								<h5><?php echo $settings['experience_title']; ?></h5>
								<div class="banner-one-bottom-right-image">
									<img src="<?php echo esc_url($hero_image2); ?>" alt="image">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php
		elseif ( 'layout-2' === $settings['provix_design_style'] ) :

			if (! empty($settings['hero_image1']['url'])) {
				$hero_image1     = ! empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url($settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
				$hero_image1_alt = get_post_meta($settings['hero_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['hero_image2']['url'])) {
				$hero_image2     = ! empty($settings['hero_image2']['id']) ? wp_get_attachment_image_url($settings['hero_image2']['id'], '') : $settings['hero_image2']['url'];
				$hero_image2_alt = get_post_meta($settings['hero_image2']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['hero_image3']['url'])) {
				$hero_image3     = ! empty($settings['hero_image3']['id']) ? wp_get_attachment_image_url($settings['hero_image3']['id'], '') : $settings['hero_image3']['url'];
				$hero_image3_alt = get_post_meta($settings['hero_image3']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['rotating_text']['url'])) {
				$rotating_text     = ! empty($settings['rotating_text']['id']) ? wp_get_attachment_image_url($settings['rotating_text']['id'], '') : $settings['rotating_text']['url'];
				$rotating_text_alt = get_post_meta($settings['rotating_text']['id'], '_wp_attachment_image_alt', true);
			}

			$this->add_render_attribute('title_args', 'class', 'banner-title');

			$star   = PROTINE_ADDONS_URL . 'assets/img/shape/star32.png';
			$shape1 = PROTINE_ADDONS_URL . 'assets/img/shape/hero2-shape1.png';
			$arrow  = PROTINE_ADDONS_URL . 'assets/img/shape/round-arrow.png';
			$line   = PROTINE_ADDONS_URL . 'assets/img/shape/line.png';
			$card   = PROTINE_ADDONS_URL . 'assets/img/icons/master-card.png';

		?>

			<div class="banner-area style-two">
				<div class="banner-media">
					<ul>
						<?php foreach ($settings['social_media_list'] as $item) : ?>
							<li>
								<a href="<?php echo esc_url($item['social_media_link']['url']); ?>">
									<?php echo $item['social_media_name']; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="banner-two-blank"></div>
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="banner-two-left">
								<div class="banner-top-right mr_100">
									<div class="banner-pattern">
										<img src="<?php echo esc_url($shape1); ?>" alt="shape">
									</div>
									<div class="banner-round-text" data-tilt>
										<div class="round-box-content">
											<span class="curved-circle">
												<img src="<?php echo esc_url($rotating_text); ?>" alt="">
											</span>
											<div class="round-box-icon">
												<a href="#">
													<img src="<?php echo esc_url($star); ?>" alt="icon">
												</a>
											</div>
										</div>
									</div>
								</div>

								<h2 class="text__first">
									<span class="text__word"><?php echo $settings['title_1']; ?></span>
									<span class="text__first-bg"></span>
								</h2>
								<br/>
								<h2 class="text__second">
									<span class="text__word"><?php echo $settings['title_2']; ?></span>
									<span class="highlight-text">
										<span><?php echo $settings['highlight_text1']; ?></span>
										<span><?php echo $settings['highlight_text2']; ?></span>
										<span><?php echo $settings['highlight_text1']; ?></span>
										<span><?php echo $settings['highlight_text2']; ?></span>
									</span>
									<span class="text__second-bg"></span>
								</h2>
								<br/>
								<h2 class="text__third">
									<span class="text__word"><?php echo $settings['title_3']; ?></span>
									<span class="text__third-bg"></span>
								</h2>

								<div class="banner-two-btn-box">
									<a href="<?php echo esc_url($settings['button1_link']['url']); ?>" class="button">
										<?php echo $settings['button1_text']; ?>
										<div class="btn-icon">
											<span class="icon-first"><i class="fa-light fa-arrow-right"></i></span>
											<span class="icon-second"><i class="fa-light fa-arrow-right"></i></span>
										</div>
									</a>
									<img src="<?php echo esc_url($arrow); ?>" alt="arrow">
								</div>
								<div class="visitor-box">
									<?php if (! empty($settings['client_images'])) : ?>
										<div class="visitor-list">
											<ul>
												<?php foreach ($settings['client_images'] as $image) : ?>
													<li><a href="javascript:void(0);"><img src="<?php echo esc_attr($image['url']); ?>" alt="image"></a></li>
												<?php endforeach; ?>
												<li><a href="javascript:void(0);"><span><?php echo $settings['total_review']; ?></span></a></li>
											</ul>
										</div>
									<?php endif; ?>
									<div class="visitor-content">
										<p><?php echo $settings['review_title']; ?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="banner-two-right">
								<div class="payment-method" data-tilt>
									<p><span><?php esc_html_e('Payment Method', 'agenvix-core'); ?></span> <i class="fa-sharp fa-solid fa-star"></i></p>
									<div class="banner-payment-card">
										<div class="banner-payment-card-image">
											<img src="<?php echo esc_attr($card); ?>" alt="image">
										</div>
										<h6><?php esc_html_e('****6478', 'agenvix-core'); ?></h6>
									</div>
								</div>

								<div class="swiper-container banner-two-slider wow slideInRight">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											<div class="banner-two-right-image">
												<img src="<?php echo esc_attr($hero_image1); ?>" alt="img">
											</div>
										</div>
										<div class="swiper-slide">
											<div class="banner-two-right-image">
												<img src="<?php echo esc_attr($hero_image2); ?>" alt="img">
											</div>
										</div>
										<div class="swiper-slide">
											<div class="banner-two-right-image">
												<img src="<?php echo esc_attr($hero_image3); ?>" alt="img">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="pagination-container">
								<div class="swiper-pagination"></div>
								<div class="pagination-image">
									<img src="<?php echo esc_attr($line); ?>" alt="shape">
									<img src="<?php echo esc_attr($line); ?>" alt="shape">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ( 'layout-3' === $settings['provix_design_style'] ) :

			if (! empty($settings['hero_image1']['url'])) {
				$hero_image1     = ! empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url($settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
				$hero_image1_alt = get_post_meta($settings['hero_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['rotating_text']['url'])) {
				$rotating_text     = ! empty($settings['rotating_text']['id']) ? wp_get_attachment_image_url($settings['rotating_text']['id'], '') : $settings['rotating_text']['url'];
				$rotating_text_alt = get_post_meta($settings['rotating_text']['id'], '_wp_attachment_image_alt', true);
			}

			$star   = PROTINE_ADDONS_URL . 'assets/img/icons/star16.png';
			$arrow  = PROTINE_ADDONS_URL . 'assets/img/shape/round-arrow.png';
			$finger  = PROTINE_ADDONS_URL . 'assets/img/shape/pointer-finger.png';
			$arrow_2  = PROTINE_ADDONS_URL . 'assets/img/icons/arrow24.png';
			$image_bg  = PROTINE_ADDONS_URL . 'assets/img/hero3-bg-shape.png';
		?>

			<div class="banner-area style-three">
				<div class="banner-media">
					<ul>
						<?php foreach ($settings['social_media_list'] as $item) : ?>
							<li>
								<a href="<?php echo esc_url( $item['social_media_link']['url'] ); ?>">
									<?php echo $item['social_media_name']; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="scroll-down-content" data-tilt>
					<a href="<?php echo esc_url( $settings['scroll_down_btn_link']['url'] ); ?>" class="scroll-down-button">
						<span><?php echo $settings['scroll_down_btn_text']; ?></span>
						<div class="scroll-down-border"></div>
						<div class="scroll-down-mouse" data-tilt></div>
					</a>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="banner-six-container">
								<div class="banner-six-container-inner">
									<div class="banner-six-title">
										<?php if (! empty($settings['subtitle'])) : ?>
											<h6>
												<img src="<?php echo esc_url($star); ?>" alt="icon">
												<?php echo $settings['subtitle']; ?>
											</h6>
										<?php endif; ?>

										<?php if (! empty($settings['title_1'])) : ?>
											<h2 class="text-anim-5"><?php echo $settings['title_1']; ?></h2>
										<?php endif; ?>

										<?php if ( ! empty( $settings['description'] ) ) : ?>
											<p><?php echo $settings['description']; ?></p>
										<?php endif; ?>
									</div>

									<div class="banner-six-btn-box">
										<a href="<?php echo esc_url($settings['button1_link']['url']); ?>" class="button">
											<?php echo $settings['button1_text']; ?>
											<div class="btn-icon">
												<span class="icon-first"><i class="fa-light fa-arrow-right"></i></span>
												<span class="icon-second"><i class="fa-light fa-arrow-right"></i></span>
											</div>
										</a>
										<div class="banner-six-round-text">
											<div class="round-box-content">
												<div class="round-box-icon">
													<a class="play_btn hv-popup-link" href="<?php echo esc_url($settings['button2_link']['url']); ?>">
														<i class="fas fa-play"></i>
													</a>
												</div>

												<span class="curved-circle">
													<img src="<?php echo esc_url($rotating_text); ?>" alt="">
												</span>
												<div class="arrow-icon">
													<img src="<?php echo esc_url($arrow_2); ?>" alt="icon">
												</div>
											</div>
										</div>
										<img class="arrow-icon-2" src="<?php echo esc_url($arrow); ?>" alt="arrow">
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="banner-six-right-container">
								<div class="banner-six-right-bg">
									<img src="<?php echo esc_url( $image_bg ); ?>" alt="image">
									<div class="finger">
										<img src="<?php echo esc_url( $finger ); ?>" alt="image">
									</div>
								</div>
								<div class="banner-six-right-image image-anim-2">
									<img src="<?php echo esc_url( $hero_image1 ); ?>" alt="image">
								</div>
								<div class="banner-six-btn-1">
									<a href="<?php echo esc_url( $settings['button3_link']['url'] ); ?>">
										<div class="text">
											<div class="first-text"><?php echo $settings['button3_text']; ?></div>
											<div class="second-text"><?php echo $settings['button3_text']; ?></div>
										</div>
									</a>
								</div>
								<div class="banner-six-btn-2">
									<a href="<?php echo esc_url( $settings['button4_link']['url'] ); ?>">
										<i class="fa-light fa-arrow-down-left"></i>
									</a>
								</div>
								<div class="banner-six-visitor-list">
									<ul data-tilt>
										<?php foreach ($settings['client_images'] as $image) : ?>
											<li><a href="javascript:void(0);"><img src="<?php echo esc_attr($image['url']); ?>" alt="image"></a></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ( 'layout-4' === $settings['provix_design_style'] ) :
			if (! empty($settings['hero_image1']['url'])) {
				$hero_image1     = ! empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url($settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
				$hero_image1_alt = get_post_meta($settings['hero_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['hero_image2']['url'])) {
				$hero_image2     = ! empty($settings['hero_image2']['id']) ? wp_get_attachment_image_url($settings['hero_image2']['id'], '') : $settings['hero_image2']['url'];
				$hero_image2_alt = get_post_meta($settings['hero_image2']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['hero_image3']['url'])) {
				$hero_image3     = ! empty($settings['hero_image3']['id']) ? wp_get_attachment_image_url($settings['hero_image3']['id'], '') : $settings['hero_image3']['url'];
				$hero_image3_alt = get_post_meta($settings['hero_image3']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['hero_image4']['url'])) {
				$hero_image4     = ! empty($settings['hero_image4']['id']) ? wp_get_attachment_image_url($settings['hero_image4']['id'], '') : $settings['hero_image4']['url'];
				$hero_image4_alt = get_post_meta($settings['hero_image4']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['hero_image5']['url'])) {
				$hero_image5     = ! empty($settings['hero_image5']['id']) ? wp_get_attachment_image_url($settings['hero_image5']['id'], '') : $settings['hero_image5']['url'];
				$hero_image5_alt = get_post_meta($settings['hero_image5']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['hero_image6']['url'])) {
				$hero_image6     = ! empty($settings['hero_image6']['id']) ? wp_get_attachment_image_url($settings['hero_image6']['id'], '') : $settings['hero_image6']['url'];
				$hero_image6_alt = get_post_meta($settings['hero_image6']['id'], '_wp_attachment_image_alt', true);
			}
			?>

			<div class="hero-section style-four">
				<div class="banner-area">
					<div class="content">
						<?php if( !empty($settings['subtitle']) ) : ?>
							<p class="subtitle"><?php echo $settings['subtitle']; ?></p>
						<?php endif; ?>

						<h2 class="title"><?php echo $settings['title_1']; ?></h2>
						<div class="banner-bottom">
							<div class="text-area">
								<ul class="visitor-list">
									<?php foreach ($settings['client_images'] as $image) : ?>
										<li><img src="<?php echo esc_attr($image['url']); ?>" alt="image"></li>
									<?php endforeach; ?>
									<li><a href="#"><i class="fa-solid fa-plus"></i></a></li>
								</ul>

								<?php if( !empty($settings['description']) ) : ?>
									<p class="description"><?php echo $settings['description']; ?></p>
								<?php endif; ?>
							</div>
							<div class="button-area">
								<?php if( !empty($settings['button1_text']) ) : ?>
									<a class="button" href="<?php echo esc_url($settings['button1_link']['url']); ?>"><?php echo $settings['button1_text']; ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="images">
					<?php if( !empty($hero_image1) ) : ?>
						<div class="img1">
							<img src="<?php echo esc_url( $hero_image1 ); ?>" alt="image">
						</div>
					<?php endif; ?>

					<?php if( !empty($hero_image2) ) : ?>
						<div class="img2">
							<img src="<?php echo esc_url( $hero_image2 ); ?>" alt="image">
						</div>
					<?php endif; ?>

					<?php if( !empty($hero_image3) ) : ?>
						<div class="img3">
							<img src="<?php echo esc_url( $hero_image3 ); ?>" alt="image">
						</div>
					<?php endif; ?>

					<?php if( !empty($hero_image1) ) : ?>
						<div class="img4">
							<img src="<?php echo esc_url( $hero_image4 ); ?>" alt="image">
						</div>
					<?php endif; ?>

					<?php if( !empty($hero_image2) ) : ?>
						<div class="img5">
							<img src="<?php echo esc_url( $hero_image5 ); ?>" alt="image">
						</div>
					<?php endif; ?>

					<?php if( !empty($hero_image3) ) : ?>
						<div class="img6">
							<img src="<?php echo esc_url( $hero_image6 ); ?>" alt="image">
						</div>
					<?php endif; ?>
				</div>
			</div>
		
		<?php elseif ( 'layout-5' === $settings['provix_design_style'] ) :
			if (! empty($settings['hero_image1']['url'])) {
				$hero_image1     = ! empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url($settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
				$hero_image1_alt = get_post_meta($settings['hero_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['hero_image2']['url'])) {
				$hero_image2     = ! empty($settings['hero_image2']['id']) ? wp_get_attachment_image_url($settings['hero_image2']['id'], '') : $settings['hero_image2']['url'];
				$hero_image2_alt = get_post_meta($settings['hero_image2']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['shape_image1']['url'])) {
				$shape_image1     = ! empty($settings['shape_image1']['id']) ? wp_get_attachment_image_url($settings['shape_image1']['id'], '') : $settings['shape_image1']['url'];
				$shape_image1_alt = get_post_meta($settings['shape_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['shape_image2']['url'])) {
				$shape_image2     = ! empty($settings['shape_image2']['id']) ? wp_get_attachment_image_url($settings['shape_image2']['id'], '') : $settings['shape_image2']['url'];
				$shape_image2_alt = get_post_meta($settings['shape_image2']['id'], '_wp_attachment_image_alt', true);
			}
			?>

			<div class="banner-area style-five">
				<div class="content">
					<h2 class="title1"><?php echo $settings['title_1']; ?></h2>
					<h2 class="title2"><?php echo $settings['title_2']; ?></h2>
				</div>
				<div class="shapes">
					<?php if( !empty($shape_image1) ) : ?>
						<div class="shape1 rotate15">
							<img src="<?php echo esc_url( $shape_image1 ); ?>" alt="image">
						</div>
					<?php endif; ?>

					<?php if( !empty($shape_image2) ) : ?>
						<div class="shape2 rotate15">
							<img src="<?php echo esc_url( $shape_image2 ); ?>" alt="image">
						</div>
					<?php endif; ?>
				</div>
				<div class="images">
					<?php if( !empty($hero_image1) ) : ?>
						<div class="img1">
							<img src="<?php echo esc_url( $hero_image1 ); ?>" alt="image">
						</div>
					<?php endif; ?>

					<?php if( !empty($hero_image2) ) : ?>
						<div class="img2">
							<img src="<?php echo esc_url( $hero_image2 ); ?>" alt="image">
						</div>
					<?php endif; ?>
				</div>
			</div>

		<?php elseif ( 'layout-6' === $settings['provix_design_style'] ) :
			if (! empty($settings['hero_image1']['url'])) {
				$hero_image1     = ! empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url($settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
				$hero_image1_alt = get_post_meta($settings['hero_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['shape_image1']['url'])) {
				$shape_image1     = ! empty($settings['shape_image1']['id']) ? wp_get_attachment_image_url($settings['shape_image1']['id'], '') : $settings['shape_image1']['url'];
				$shape_image1_alt = get_post_meta($settings['shape_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['shape_image2']['url'])) {
				$shape_image2     = ! empty($settings['shape_image2']['id']) ? wp_get_attachment_image_url($settings['shape_image2']['id'], '') : $settings['shape_image2']['url'];
				$shape_image2_alt = get_post_meta($settings['shape_image2']['id'], '_wp_attachment_image_alt', true);
			}
			$circle_1 = PROTINE_ADDONS_URL . 'assets/img/shape/circle1.png';
			$circle_2 = PROTINE_ADDONS_URL . 'assets/img/shape/circle2.png';
			?>
			<div class="banner-area style-six magnetic_effect_1">
				<div class="hero-wrapper">
					<div class="content">
						<h2 class="title1"><?php echo $settings['title_1']; ?></h2>
						<h2 class="title2"><?php echo $settings['title_2']; ?></h2>
						<div class="bottom-text">
							<div class="left-text">
								<p class="description"><?php echo $settings['description']; ?></p>
							</div>
							<div class="right-text">
								<ul class="visitor-list">
									<?php foreach ($settings['client_images'] as $image) : ?>
										<li><img src="<?php echo esc_attr($image['url']); ?>" alt="image"></li>
									<?php endforeach; ?>
									<li><a href="#">+</a></li>
								</ul>
								<?php if( !empty($settings['review_title']) ) : ?>
									<p><?php echo $settings['review_title']; ?></p>
								<?php endif; ?>
							</div>
						</div>
						<div class="shapes">
							<div class="shape1">
								<img src="<?php echo esc_url($shape_image1); ?>" alt="image">
							</div>
							<div class="shape2">
								<img src="<?php echo esc_url($shape_image2); ?>" alt="image">
							</div>
						</div>
					</div>
					<div class="rotating-circle">
						<div class="circle1">
							<img class="rotate30" src="<?php echo esc_url($circle_1); ?>" alt="image">
						</div>
						<div class="circle2">
							<img class="rotate30" src="<?php echo esc_url($circle_2); ?>" alt="image">
						</div>
					</div>
				</div>
				<div class="image">
					<img src="<?php echo esc_url($hero_image1); ?>" alt="image">
					<img class="magnetic_effect_1_elm" src="<?php echo esc_url($hero_image1); ?>" alt="image">
				</div>
			</div>
			
		<?php elseif ( 'layout-7' === $settings['provix_design_style'] ) :
			if (! empty($settings['hero_image1']['url'])) {
				$hero_image1     = ! empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url($settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
				$hero_image1_alt = get_post_meta($settings['hero_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['shape_image1']['url'])) {
				$shape_image1     = ! empty($settings['shape_image1']['id']) ? wp_get_attachment_image_url($settings['shape_image1']['id'], '') : $settings['shape_image1']['url'];
				$shape_image1_alt = get_post_meta($settings['shape_image1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['shape_image2']['url'])) {
				$shape_image2     = ! empty($settings['shape_image2']['id']) ? wp_get_attachment_image_url($settings['shape_image2']['id'], '') : $settings['shape_image2']['url'];
				$shape_image2_alt = get_post_meta($settings['shape_image2']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['client_image']['url'])) {
				$client_image     = ! empty($settings['client_image']['id']) ? wp_get_attachment_image_url($settings['client_image']['id'], '') : $settings['client_image']['url'];
				$client_image_alt = get_post_meta($settings['client_image']['id'], '_wp_attachment_image_alt', true);
			}
			$line_1 = PROTINE_ADDONS_URL . 'assets/img/shape/line-2.png';
			$img_bg = PROTINE_ADDONS_URL . 'assets/img/shape/hero7-img-bg.png';
			?>
			
			<div class="banner-area style-seven">
                <div class="hero-wrapper">
                    <div class="left-column">
                        <div class="content">
                            <h5 class="subtitle"><?php echo $settings['subtitle']; ?></h5>
                            <h2 class="title"><?php echo $settings['title_1']; ?></h2>
                            <p class="description"><?php echo $settings['description']; ?></p>
                            <div class="button-group">
                                <a class="button" href="<?php echo esc_url($settings['button1_link']['url']); ?>">
                                    <?php echo $settings['button1_text']; ?>
                                </a>
								<a class="play-btn" href="#">
									<i class="fa-solid fa-play"></i>
								</a>
                            </div>
                        </div>
						<div class="box-wrapper">
							<div class="testi-box">
								<p><?php echo $settings['hero_quote']; ?></p>
								<div class="author-info">
									<div class="image">
										<img src="<?php echo esc_url( $client_image ); ?>" alt="<?php echo esc_html( $client_image_alt ); ?>">
									</div>
									<div class="text">
										<h4 class="name"><?php echo $settings['client_name']; ?></h4>
										<p class="designation"><?php echo $settings['client_designation']; ?></p>
									</div>
								</div>
							</div>
							<div class="review-box">
								<img src="<?php echo esc_url( $line_1 ); ?>" alt="line">
								<ul class="visitor-list">
									<?php foreach ($settings['client_images'] as $image) : ?>
										<li><img src="<?php echo esc_attr($image['url']); ?>" alt="image"></li>
									<?php endforeach; ?>
									<li><a href="#">+</a></li>
								</ul>
								<div class="text">
									<span class="number"><?php echo $settings['total_review']; ?></span>
									<?php if( !empty($settings['review_title']) ) : ?>
										<p class="title"><?php echo $settings['review_title']; ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
                    </div>
                    <div class="right-column">
                        <div class="image">
							<img src="<?php echo esc_url( $hero_image1 ); ?>" alt="<?php echo esc_url( $hero_image1_alt ); ?>">
						</div>
                    </div>
			    </div>
			</div>

		<?php elseif ( 'layout-8' === $settings['provix_design_style'] ) :
			if (! empty($settings['hero_image1']['url'])) {
				$hero_image1     = ! empty($settings['hero_image1']['id']) ? wp_get_attachment_image_url($settings['hero_image1']['id'], '') : $settings['hero_image1']['url'];
				$hero_image1_alt = get_post_meta($settings['hero_image1']['id'], '_wp_attachment_image_alt', true);
			}
			?>
			
			<div class="banner-area style-eight">
				<div class="hero-wrapper">
					<div class="content">
						<div class="hero-center">
							<h5 class="subtitle"><?php echo $settings['subtitle']; ?></h5>
							<h2 class="title"><?php echo $settings['title_1']; ?></h2>
						</div>
						<div class="hero-bottom">
							<p class="description"><?php echo $settings['description']; ?></p>
							<div class="small-video">
								<?php
								if ( ! empty( $settings['video_file']['url'] ) ) {
									echo '<video autoplay muted playsinline loop>';
									echo '<source src="' . esc_url( $settings['video_file']['url'] ) . '" type="video/mp4">';
									echo esc_html__('Your browser does not support the video tag.', 'agenvix-core');
									echo '</video>';
								}
								?>
							</div>
						</div>
						<div class="image">
							<img src="<?php echo esc_url( $hero_image1 ); ?>" alt="<?php echo esc_attr( $hero_image1_alt ); ?>">
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Hero_Banner() );
