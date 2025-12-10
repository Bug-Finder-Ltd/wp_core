<?php
namespace RaizenCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Achievement_List extends \Elementor\Widget_Base {

	public function get_name() {
		return 'achievement-list';
	}

	public function get_title() {
		return __( 'Achievement List', 'raizencore' );
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
         * Layout Section
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                    'layout-3' => esc_html__('Layout 3', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		/**
		 * Repeater
		 */
		$this->start_controls_section(
            'raizen_list_section',
            [
                'label' => __( 'Achievement Item', 'raizencore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

		$repeater->add_control(
			'list_year',
			[
				'label' => esc_html__( 'Year', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '2000', 'raizencore' ),
				'placeholder' => esc_html__( 'Enter year here', 'raizencore' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_title',
			[
				'label' => esc_html__( 'Title', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'raizencore' ),
				'placeholder' => esc_html__( 'Type your title here', 'raizencore' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_type',
			[
				'label' => esc_html__( 'Type', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Awards', 'raizencore' ),
				'placeholder' => esc_html__( 'Type your type here', 'raizencore' ),
				'label_block' => true,
			]
		);
		
        $repeater->add_control(
            'list_item_url',
            [
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'label' => __( 'URL', 'raizencore' ),
                'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
                'placeholder' => __( 'Type url here', 'raizencore' ),
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
        $this->add_control(
            'raizen_list_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Github Winner', 'raizencore' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Design Awards', 'raizencore' ),
					],
					[
                        'list_title' => esc_html__( 'Web Development', 'raizencore' ),
					],
					[
                        'list_title' => esc_html__( 'Behance Winner', 'raizencore' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();


		/**
		 * Style section
		 */
		$this->start_controls_section(
			'general_style',
			[
				'label' => __( 'General', 'raizencore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'raizencore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'raizencore' ),
					'uppercase' => __( 'UPPERCASE', 'raizencore' ),
					'lowercase' => __( 'lowercase', 'raizencore' ),
					'capitalize' => __( 'Capitalize', 'raizencore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'raizencore' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .lists' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__( 'Title', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lists li' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .lists li',
                ]
            );
            $this->add_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'raizencore' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .lists li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
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
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['raizen_design_style']  == 'layout-1' ):
			$arrow_icon = PROTINE_ADDONS_URL . 'assets/img/icons/arrow-1.png';
			?>

			<div class="achievement-list style-1">
				<?php
				$delay = 0;
				foreach (  $settings['raizen_list_slides'] as $item ) :
					$ms_delay = 100 + ($delay * 100);
					?>
					<div class="list-item wow fadeInRight" data-wow-delay="<?php echo $ms_delay; ?>ms">
						<h6 class="year"><?php echo $item['list_year']; ?></h6>
						<h6 class="title"><?php echo $item['list_title']; ?></h6>
						<div class="image">
							<img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr('icon'); ?>">
						</div>
						<h6 class="type"><?php echo $item['list_type']; ?></h6>
						<?php if( !empty($item['list_item_url']['url']) ) : ?>
							<a class="arrow" href="<?php echo esc_url($item['list_item_url']['url']); ?>">
								<img src="<?php echo esc_url($arrow_icon); ?>" alt="<?php echo esc_attr('icon'); ?>">
							</a>
						<?php endif; ?>
					</div>
				<?php
				$delay++;
				endforeach; ?>
			</div>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-2' ): ?>

			<ul class="lists style-2">
				<?php foreach (  $settings['raizen_list_slides'] as $item ) { ?>
					<li>
						<?php echo $item['list_title']; ?>
						<i class="pi-arrow-right"></i>
					</li>
				<?php } ?>
			</ul>

		<?php elseif ( $settings['raizen_design_style']  == 'layout-3' ): ?>

			<ul class="lists style-3">
				<?php foreach (  $settings['raizen_list_slides'] as $item ) { ?>
					<li>
						<div class="icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
							  <path d="M5.20674 9.50898H5.20229C5.17358 9.50839 5.14528 9.502 5.1191 9.4902C5.09292 9.4784 5.0694 9.46143 5.04994 9.4403L1.03135 5.07062C0.997929 5.03429 0.978161 4.98748 0.975425 4.93819C0.972689 4.8889 0.987155 4.84019 1.01635 4.80038C1.04555 4.76058 1.08766 4.73215 1.13549 4.71993C1.18331 4.7077 1.2339 4.71245 1.27862 4.73335L4.95666 6.45554C4.9876 6.47007 5.02416 6.46304 5.04783 6.43843L10.6583 0.574601C10.7342 0.495148 10.8585 0.486476 10.9447 0.554913C11.031 0.623351 11.0509 0.746163 10.9906 0.838273L5.40971 9.3878C5.40174 9.40023 5.39237 9.41148 5.38205 9.42202L5.35744 9.44663C5.31739 9.48647 5.26323 9.50887 5.20674 9.50898Z" fill="#9C9C9C"/>
							</svg>
						</div>
						<?php echo $item['list_title']; ?>
					</li>
				<?php } ?>
			</ul>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Achievement_List() );