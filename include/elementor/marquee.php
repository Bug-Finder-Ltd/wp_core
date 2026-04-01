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
class Provix_Marquee extends \Elementor\Widget_Base {

	public function get_name() {
		return 'marquee';
	}

	public function get_title() {
		return __( 'Marquee', 'agenvix-core' );
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

		/**
		 * Repeater
		 */
		$this->start_controls_section(
			'marquee_list_section',
			[
				'label' => __( 'Marquee List', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'agenvix-core' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
            'icon_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __( 'Image', 'agenvix-core' ),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
		);
		
		$repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'provix_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $repeater->add_control(
            'provix_brand_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'URL', 'agenvix-core' ),
                'default' => __( '#', 'agenvix-core' ),
                'placeholder' => __( 'Type url here', 'agenvix-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

		$this->add_control(
			'provix_brand_slides',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'agenvix-core' ),
					],
					[
						'title' => esc_html__( 'Title #2', 'agenvix-core' ),
					],
					[
						'title' => esc_html__( 'Title #3', 'agenvix-core' ),
					],
					[
						'title' => esc_html__( 'Title #4', 'agenvix-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'text_style',
			[
				'label' => __( 'Text', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee .marquee-item .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .marquee .marquee-item .title',
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

		<?php if ( $settings['provix_design_style']  == 'layout-1' ) : ?>
			
		<div class="marquee style-one">
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ( $settings['provix_brand_slides'] as $item ) : ?>
						<div class="marquee-item">
							<h4 class="title"><?php echo esc_html( $item['title'] ); ?></h4>
							<img src="<?php echo esc_url($item['icon_image']['url']); ?>" alt="<?php esc_attr_e( 'icon', 'agenvix-core' ); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ( $settings['provix_brand_slides'] as $item ) : ?>
						<div class="marquee-item">
							<h4 class="title"><?php echo esc_html( $item['title'] ); ?></h4>
							<img src="<?php echo esc_url($item['icon_image']['url']); ?>" alt="<?php esc_attr_e( 'icon', 'agenvix-core' ); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ( $settings['provix_brand_slides'] as $item ) : ?>
						<div class="marquee-item">
							<h4 class="title"><?php echo esc_html( $item['title'] ); ?></h4>
							<img src="<?php echo esc_url($item['icon_image']['url']); ?>" alt="<?php esc_attr_e( 'icon', 'agenvix-core' ); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-2' ): ?>

		<div class="marquee style-two">
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ( $settings['provix_brand_slides'] as $item ) : ?>
						<div class="marquee-item">
							<h4 class="title"><?php echo esc_html( $item['title'] ); ?></h4>
							<?php if( !empty($item['icon_image']['url']) ) : ?>
								<img src="<?php echo esc_url($item['icon_image']['url']); ?>" alt="<?php esc_attr_e( 'icon', 'agenvix-core' ); ?>">
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ( $settings['provix_brand_slides'] as $item ) : ?>
						<div class="marquee-item">
							<h4 class="title"><?php echo esc_html( $item['title'] ); ?></h4>
							<?php if( !empty($item['icon_image']['url']) ) : ?>
								<img src="<?php echo esc_url($item['icon_image']['url']); ?>" alt="<?php esc_attr_e( 'icon', 'agenvix-core' ); ?>">
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="marquee-item-wrapper">
				<div class="marquee-item-box">
					<?php foreach ( $settings['provix_brand_slides'] as $item ) : ?>
						<div class="marquee-item">
							<h4 class="title"><?php echo esc_html( $item['title'] ); ?></h4>
							<?php if( !empty($item['icon_image']['url']) ) : ?>
								<img src="<?php echo esc_url($item['icon_image']['url']); ?>" alt="<?php esc_attr_e( 'icon', 'agenvix-core' ); ?>">
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
			
		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Marquee() );