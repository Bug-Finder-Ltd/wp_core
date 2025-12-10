<?php
namespace RaizenCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Instagram_Feed extends \Elementor\Widget_Base {

	public function get_name() {
		return 'instagram-feed';
	}

	public function get_title() {
		return __( 'Instagram Feed', 'raizencore' );
	}

	public function get_icon() {
		return 'raizen-icon';
	}

	public function get_categories() {
		return [ 'raizencore' ];
	}

	public function get_script_depends() {
		return [ 'raizencore' ];
	}

	protected function register_controls() {

        /**
         * Layout section
         */
        
        $this->start_controls_section(
            'raizen_layout',
            [
                'label' => esc_html__('Design Layout', 'raizencore'),
            ]
        );
        $this->add_control(
            'raizen_design_style',
            [
                'label' => esc_html__('Select Layout', 'raizencore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_list_section',
            [
                'label' => esc_html__( 'Image List', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'image_title',
			[
				'label' => esc_html__( 'Title', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'raizencore' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'image_link',
			[
				'label' => esc_html__( 'Link', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'image_title' => esc_html__( 'Title #1', 'raizencore' ),
					],
					[
						'image_title' => esc_html__( 'Title #2', 'raizencore' ),
					],
				],
				'title_field' => '{{{ image_title }}}',
			]
		);
        
        $this->end_controls_section();

        /*============
		 Style
        ==============*/

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'raizencore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Alignment', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'raizencore' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'raizencore' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'raizencore' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .single-btn' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Button', 'raizencore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'button_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single-btn .button .button-text' => 'color: {{VALUE}}',
                    ],
                ]
            );
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'button_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .single-btn .button .button-text',
				]
			);
			$this->add_control(
                'button_margin',
                [
                    'label' => esc_html__( 'Margin', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .single-btn .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();

		$this->start_controls_section(
			'button_icon_style',
			[
				'label' => esc_html__( 'Button Icon', 'raizencore' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Color', 'raizencore' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .single-btn .button i' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'icon_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .single-btn .button i',
				]
			);
		$this->end_controls_section();


	}

	/**
	 * Render the widget ouraizenut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>

		<?php if ( $settings['raizen_design_style']  == 'layout-1' ): ?>

			<div class="instagram-feed style-one">
				<div class="image-grid">
					<?php foreach (  $settings['list'] as $item ) :
						if ( !empty($item['image']['url']) ) {
		                    $image = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], '') : $item['image']['url'];
		                }
						?>
						<a href="<?php echo esc_url($item['image_link']['url']); ?>">
							<div class="image">
								<img src="<?php echo esc_url($image); ?>" alt="<?php esc_html_e('image', 'raizencore'); ?>">
								<div class="icon">
									<i class="fa-brands fa-instagram"></i>
								</div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-2' ): ?>



        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Instagram_Feed() );