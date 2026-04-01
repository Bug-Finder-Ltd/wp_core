<?php
namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Gallery extends \Elementor\Widget_Base {

	public function get_name() {
		return 'agenvix-gallery';
	}

	public function get_title() {
		return __( 'Gallery', 'agenvix-core' );
	}

	public function get_icon() {
		return 'provix-icon';
	}

	public function get_categories() {
		return [ 'agenvix-core' ];
	}

	public function get_script_depends() {
		return [ 'agenvix-core' ];
	}

	protected function register_controls() {
		/**
         * Layout Section
         */
        $this->start_controls_section(
            'provix_layout',
            [
                'label' => esc_html__('Design Layout', 'agenvix-core'),
            ]
        );
        $this->add_control(
            'provix_design_style',
            [
                'label' => esc_html__('Select Layout', 'agenvix-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
                    'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'gallery_title',
			[
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'circle_image1',
			[
				'label' => esc_html__( 'Circle Image 1', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'circle_image2',
			[
				'label' => esc_html__( 'Circle Image 2', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();




		/**
		 * Repeater
		 */
		$this->start_controls_section(
            'provix_gallery_section',
            [
                'label' => __( 'Gallery', 'agenvix-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'gallery_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'agenvix-core' ),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
		);
		
		$repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

		$repeater->add_control(
			'image_url',
			[
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'label' => __( 'URL', 'agenvix-core' ),
				'default' => __( '#', 'agenvix-core' ),
				'placeholder' => __( 'Type url here', 'agenvix-core' ),
			]
		);

        $this->add_control(
            'gallery_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Gallery Item', 'agenvix-core' ),
                'default' => [
                    [
                        'gallery_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'gallery_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'gallery_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
					[
                        'gallery_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->end_controls_section();


		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'agenvix-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'agenvix-core' ),
					'uppercase' => __( 'UPPERCASE', 'agenvix-core' ),
					'lowercase' => __( 'lowercase', 'agenvix-core' ),
					'capitalize' => __( 'Capitalize', 'agenvix-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
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
	protected function render() {
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['provix_design_style']  == 'layout-1' ) :
			if ( !empty($settings['circle_image1']['url']) ) {
				$circle_image1 = !empty($settings['circle_image1']['id']) ? wp_get_attachment_image_url( $settings['circle_image1']['id'], '') : $settings['circle_image1']['url'];
				$circle_image1_alt = get_post_meta($settings["circle_image1"]["id"], "_wp_attachment_image_alt", true);
			}
			if ( !empty($settings['circle_image2']['url']) ) {
				$circle_image2 = !empty($settings['circle_image2']['id']) ? wp_get_attachment_image_url( $settings['circle_image2']['id'], '') : $settings['circle_image2']['url'];
				$circle_image2_alt = get_post_meta($settings["circle_image2"]["id"], "_wp_attachment_image_alt", true);
			}
			?>
			
		<div class="gallery style-one">
			<div class="gallery-list">
				<?php foreach ($settings['gallery_list'] as $item) : 
					if ( !empty($item['gallery_image']['url']) ) {
						$image_url = !empty($item['gallery_image']['id']) ? wp_get_attachment_image_url( $item['gallery_image']['id'], '') : $item['gallery_image']['url'];
						$image_alt = get_post_meta($item["gallery_image"]["id"], "_wp_attachment_image_alt", true);
					}
					?>
					<div class="item">
						<img src="<?php echo esc_url($image_url); ?>" alt="">
						<div class="overlay"></div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="content">
				<div class="rotating-image">
					<?php if( !empty($circle_image1) ) : ?>
						<div class="circle-image1">
							<img decoding="async" src="<?php echo esc_url($circle_image1); ?>" alt="image">
						</div>
					<?php endif; ?>

					<?php if( !empty($circle_image2) ) : ?>
						<div class="circle-image2 rotate15">
							<img decoding="async" src="<?php echo esc_url($circle_image2); ?>" alt="image">
						</div>
					<?php endif; ?>
				</div>
				<h2 class="title"><?php echo $settings['gallery_title']; ?></h2>
			</div>
		</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-2' ) :
			$shape_url = PROTINE_ADDONS_URL . 'assets/img/brand-shape.png';
			?>

		<div class="gallery style-two brand style-two">
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['gallery_list'] as $item) : 
						if ( !empty($item['gallery_image']['url']) ) {
							$provix_brand_image_url = !empty($item['gallery_image']['id']) ? wp_get_attachment_image_url( $item['gallery_image']['id'], '') : $item['gallery_image']['url'];
							$provix_brand_image_alt = get_post_meta($item["gallery_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($provix_brand_image_url); ?>" alt="<?php echo esc_url($provix_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ($settings['gallery_list'] as $item) : 
						if ( !empty($item['gallery_image']['url']) ) {
							$provix_brand_image_url = !empty($item['gallery_image']['id']) ? wp_get_attachment_image_url( $item['gallery_image']['id'], '') : $item['gallery_image']['url'];
							$provix_brand_image_alt = get_post_meta($item["gallery_image"]["id"], "_wp_attachment_image_alt", true);
						}
						?>
						<div class="brand-item">
							<img src="<?php echo esc_url($provix_brand_image_url); ?>" alt="<?php echo esc_url($provix_brand_image_alt); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
			
		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Gallery() );