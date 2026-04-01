<?php
namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Provix_Awards extends \Elementor\Widget_Base {

	public function get_name() {
		return 'provix-awards';
	}

	public function get_title() {
		return __( 'Awards', 'agenvix-core' );
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
         * Layout section
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
         * Title and content section
         */
        $this->start_controls_section(
            'provix_section_title',
            [
                'label' => esc_html__('Title & Content', 'agenvix-core'),
                'condition' => [
                    'provix_design_style' => 'layout-2'
                ],
            ]
        );
        
        $this->add_control(
            'provix_title',
            [
                'label' => esc_html__('Title', 'agenvix-core'),
                'description' => provix_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Provix Title Here', 'agenvix-core'),
                'placeholder' => esc_html__('Type Heading Text', 'agenvix-core'),
                'label_block' => true,
                'condition' => [
                    'provix_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'provix_title_color',
            [
                'label' => __( 'Title Color', 'agenvix-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .common-title h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'provix_design_style' => 'layout-2'
                ],
            ]
        );
 
        $this->add_control(
            'provix_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'agenvix-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'agenvix-core'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'agenvix-core'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'agenvix-core'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'agenvix-core'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'agenvix-core'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'agenvix-core'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
                'condition' => [
                    'provix_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_responsive_control(
            'provix_align',
            [
                'label' => esc_html__('Alignment', 'agenvix-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'agenvix-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'agenvix-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'agenvix-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'condition' => [
                    'provix_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_control(
            'provix_client_box_text',
            [
                'label' => esc_html__('Client Box Text', 'agenvix-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('100+ Happy Clients  ', 'agenvix-core'),
                'title' => esc_html__('Enter client box text', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'awards_section1',
			[
				'label' => esc_html__( 'Awards 1', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'image_1',
				[
					'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'awards_section2',
			[
				'label' => esc_html__( 'Awards 2', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'image_2',
				[
					'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'awards_section3',
			[
				'label' => esc_html__( 'Awards 3', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'image_3',
				[
					'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'awards_section4',
			[
				'label' => esc_html__( 'Awards 4', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'image_4',
				[
					'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'awards_section5',
			[
				'label' => esc_html__( 'Awards 5', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'image_5',
				[
					'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'awards_section6',
			[
				'label' => esc_html__( 'Awards 6', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'image_6',
				[
					'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
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
        $settings = $this->get_settings_for_display();
        ?>

		<?php if ( $settings['provix_design_style']  == 'layout-1' ) :
			if (! empty($settings['image_1']['url'])) {
				$image_1     = ! empty($settings['image_1']['id']) ? wp_get_attachment_image_url($settings['image_1']['id'], '') : $settings['image_1']['url'];
				$image_1_alt = get_post_meta($settings['image_1']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['image_2']['url'])) {
				$image_2     = ! empty($settings['image_2']['id']) ? wp_get_attachment_image_url($settings['image_2']['id'], '') : $settings['image_2']['url'];
				$image_2_alt = get_post_meta($settings['image_2']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['image_3']['url'])) {
				$image_3     = ! empty($settings['image_3']['id']) ? wp_get_attachment_image_url($settings['image_3']['id'], '') : $settings['image_3']['url'];
				$image_3_alt = get_post_meta($settings['image_3']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['image_4']['url'])) {
				$image_4     = ! empty($settings['image_4']['id']) ? wp_get_attachment_image_url($settings['image_4']['id'], '') : $settings['image_4']['url'];
				$image_4_alt = get_post_meta($settings['image_4']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['image_5']['url'])) {
				$image_5     = ! empty($settings['image_5']['id']) ? wp_get_attachment_image_url($settings['image_5']['id'], '') : $settings['image_5']['url'];
				$image_5_alt = get_post_meta($settings['image_5']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['image_6']['url'])) {
				$image_6     = ! empty($settings['image_6']['id']) ? wp_get_attachment_image_url($settings['image_6']['id'], '') : $settings['image_6']['url'];
				$image_6_alt = get_post_meta($settings['image_6']['id'], '_wp_attachment_image_alt', true);
			}
			?>
            
            <div id="awards" class="awards-area style-one">
               <div class="tp-awards-vp-move-thumbs-wrapper">
                  <div class="start-thumbs-wrapper">
                     <div class="tp-awards-vp-start-move-thumb" data-start="top 120%" data-stop="600%">
                        <div class="tp-awards-vp-move-thumb-inner">
                           <div class="tp-awards-vp-section-image">
                              <img src="<?php echo esc_url($image_1); ?>" class="item-image" alt="">
                           </div>
                        </div>
                     </div>
                     <div class="tp-awards-vp-start-move-thumb" data-start="top 90%" data-stop="1100%">
                        <div class="tp-awards-vp-move-thumb-inner">
                           <div class="tp-awards-vp-section-image">
                              <img src="<?php echo esc_url($image_2); ?>" class="item-image" alt="">
                           </div>
                        </div>
                     </div>
                     <div class="tp-awards-vp-start-move-thumb" data-start="top 90%" data-stop="400%">
                        <div class="tp-awards-vp-move-thumb-inner">                                                    
                           <div class="tp-awards-vp-section-image">
                              <img src="<?php echo esc_url($image_3); ?>" class="item-image" alt="">
                           </div>
                        </div>
                     </div>
                     <div class="tp-awards-vp-start-move-thumb" data-start="top 120%" data-stop="600%">
                        <div class="tp-awards-vp-move-thumb-inner">                                                    
                           <div class="tp-awards-vp-section-image">
                              <img src="<?php echo esc_url($image_4); ?>" class="item-image" alt="">
                           </div>
                        </div>
                     </div>                                        
                     <div class="tp-awards-vp-start-move-thumb" data-start="top 100%" data-stop="750%">
                        <div class="tp-awards-vp-move-thumb-inner">                                                    
                           <div class="tp-awards-vp-section-image">
                              <img src="<?php echo esc_url($image_5); ?>" class="item-image" alt="">
                           </div>
                        </div>
                     </div>                                     
                     <div class="tp-awards-vp-start-move-thumb" data-start="top 40%" data-stop="300%">
                        <div class="tp-awards-vp-move-thumb-inner">                                                    
                           <div class="tp-awards-vp-section-image">
                              <img src="<?php echo esc_url($image_6); ?>" class="item-image" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tp-awards-vp-end-thumbs-wrapper">
                     <div class="tp-awards-vp-end-move-thumb"></div>
                     <div class="tp-awards-vp-end-move-thumb"></div>
                     <div class="tp-awards-vp-end-move-thumb"></div>
                     <div class="tp-awards-vp-end-move-thumb"></div>
                     <div class="tp-awards-vp-end-move-thumb"></div>
                     <div class="tp-awards-vp-end-move-thumb"></div>
                  </div>
               </div>
            </div> 

        <?php elseif ( $settings['provix_design_style']  == 'layout-2' ): ?>
            
            <div class="accordion-wrap">
                <ul class="accordion-box acc_style_h4">
                    <?php foreach ($settings['accordions'] as $index => $item) : ?>
                    <li class="accordion block <?php echo $index === 0 ? 'active-block' : ''; ?>">
                        <div class="acc-btn <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="icon-box">
                                <div class="icon icon_1">                                            
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="icon icon_2">
                                    <i class="fas fa-minus"></i>
                                </div>
                            </div>
                            <h4><?php echo esc_html($item['accordion_title']); ?></h4>
                        </div>
                        <div class="acc-content <?php echo $index === 0 ? 'current' : ''; ?>">
                            <p class="text"><?php echo provix_kses($item['accordion_description']); ?></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Provix_Awards() );