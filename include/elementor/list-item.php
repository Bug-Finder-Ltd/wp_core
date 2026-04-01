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
class Provix_List extends \Elementor\Widget_Base {

	public function get_name() {
		return 'provix-list';
	}

	public function get_title() {
		return __( 'List', 'agenvix-core' );
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
                    'layout-3' => esc_html__('Layout 3', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		/**
		 * Repeater
		 */
		$this->start_controls_section(
            'provix_list_section',
            [
                'label' => __( 'List Item', 'agenvix-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

		$repeater->add_control(
			'list_icon',
			[
				'label' => esc_html__( 'Icon', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(
			'list_title',
			[
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'agenvix-core' ),
				'label_block' => true,
			]
		);
		
        $repeater->add_control(
            'list_item_url',
            [
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'label' => __( 'URL', 'agenvix-core' ),
                'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'placeholder' => __( 'Type url here', 'agenvix-core' ),
				'label_block' => true,
			]
		);

        $this->add_control(
            'provix_list_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'textdomain' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'textdomain' ),
					],
					[
                        'list_title' => esc_html__( 'Title #3', 'textdomain' ),
					],
					[
                        'list_title' => esc_html__( 'Title #4', 'textdomain' ),
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
				'label' => __( 'General', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_layout',
			[
				'label' => esc_html__( 'Layout', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'column' => [
						'title' => esc_html__( 'Default', 'agenvix-core' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'row' => [
						'title' => esc_html__( 'Inline', 'agenvix-core' ),
						'icon' => 'eicon-ellipsis-h',
					]
				],
				'default' => 'column',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .lists' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_align',
			[
				'label' => esc_html__( 'Alignment', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'agenvix-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'agenvix-core' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'agenvix-core' ),
						'icon' => 'eicon-h-align-right',
					]
				],
				'default' => 'column',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .lists' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Space Between', 'agenvix-core' ),
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
					'{{WRAPPER}} .lists' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
                'icon_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lists li i' => 'color: {{VALUE}}',
                    ],
                ]
            );
			$this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'icon_typography',
                    'selector' => '{{WRAPPER}} .lists li i',
                ]
            );
			$this->add_control(
                'icon_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .lists li i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();

		$this->start_controls_section(
			'title_section',
			[
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs(
			'title_style_tabs'
		);
		
		$this->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'agenvix-core' ),
			]
		);
		
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lists li' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .lists li a' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
        $this->end_controls_tab();
        
        $this->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'agenvix-core' ),
			]
		);
		
		    $this->add_control(
                'title_hover_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lists li:hover' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .lists li a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
		$this->end_controls_tab();
            
        $this->end_controls_tabs();
        
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
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
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

		<?php if ( $settings['provix_design_style']  == 'layout-1' ): ?>

			<ul class="lists style-1">
				<?php foreach (  $settings['provix_list_slides'] as $item ) :
					$item_text = esc_html($item['list_title']);
					$item_url = esc_url($item['list_item_url']['url']);
					?>
					<li>
						<a href="<?php echo $item_url; ?>">
							<?php \Elementor\Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							<?php echo $item_text; ?>
						</a>
					</li>
					
				<?php endforeach; ?>
			</ul>

		<?php elseif ( $settings['provix_design_style']  == 'layout-2' ): ?>

			<ul class="lists style-2">
				<?php foreach (  $settings['provix_list_slides'] as $item ) : ?>
					<li class="">
						<?php echo $item['list_title']; ?>
					</li>
				<?php endforeach; ?>
			</ul>

		<?php elseif ( $settings['provix_design_style']  == 'layout-3' ): ?>

			<ul class="lists style-3">
				<?php foreach (  $settings['provix_list_slides'] as $item ) :
					$item_text = esc_html($item['list_title']);
					$item_url = esc_url($item['list_item_url']['url']);
					?>
					<li>
						<a href="<?php echo $item_url; ?>">
							<?php echo $item_text; ?>
							<i class="fa-light fa-chevron-right"></i>
						</a>
					</li>
					
				<?php endforeach; ?>
			</ul>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Provix_List() );