<?php
namespace ProvixCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_CTA_Area extends \Elementor\Widget_Base {

	public function get_name() {
		return 'provix-cta-area';
	}

	public function get_title() {
		return __( 'CTA Area', 'agenvix-core' );
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
                'type' => \Elementor\Controls_Manager::SELECT,
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
            'provix_image_section',
            [
                'label' => esc_html__('Image', 'agenvix-core'),
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' => esc_html__( 'Add Images', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'show_label' => false,
                'default' => [],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'provix_text_section',
            [
                'label' => esc_html__('Text', 'agenvix-core'),
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label' => esc_html__('Title', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Text Here', 'agenvix-core'),
                'placeholder' => esc_html__('Type text', 'agenvix-core'),
                'label_block' => true
            ]
        );
        $this->add_control(
            'desctiption_text',
            [
                'label' => esc_html__( 'Description', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Text Here', 'agenvix-core'),
                'placeholder' => esc_html__('Type text', 'agenvix-core'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__('Button', 'agenvix-core'),
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Text', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'agenvix-core'),
                'placeholder' => esc_html__('Type text', 'agenvix-core'),
                'label_block' => true
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        /**
         * Style section
         */

        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__( 'General', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Left', 'agenvix-core' ),
                    'center'  => esc_html__( 'Center', 'agenvix-core' ),
                    'right' => esc_html__( 'Right', 'agenvix-core' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .heading-text' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .heading-text .heading' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typography',
                    'selector' => '{{WRAPPER}} .heading-text .heading',
                ]
            );
            $this->add_control(
                'heading_margin',
                [
                    'label' => esc_html__( 'Margin', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .heading-text .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_render_attribute( 'heading_text', 'id', 'split-type-text' );

        ?>

		<?php if ( $settings['provix_design_style']  == 'layout-1' ):
            $icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/footprint.png';
            ?>

            <div class="cta-container">
               <div class="cta-container-inner">
                  <div class="cta-image-box">
                    <?php
                    $i = 0;
                    foreach ( $settings['gallery'] as $image ){
                        $i++;
                        echo '<img class="cta-image-'.$i.'" src="' . esc_attr( $image['url'] ) . '">';
                    } ?>
                  </div>
                  <div class="content">
                     <h3 class="title"><?php echo $settings['title_text']; ?></h3>
                     <p class="description"><?php echo $settings['desctiption_text']; ?></p>
                     <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
                        <span class="button-text">
                            <span class="main-text"><?php echo $settings['button_text']; ?></span>
                            <span class="hover-text"><?php echo $settings['button_text']; ?></span>
                        </span>
                        <span class="button-icon">
                            <span class="main-text">
                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php esc_html_e('icon', 'agenvix-core'); ?>">
                            </span>
                            <span class="hover-text">
                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php esc_html_e('icon', 'agenvix-core'); ?>">
                            </span>
                        </span>
                     </a>
                  </div>
               </div>
            </div>

		<?php elseif( $settings['provix_design_style']  == 'layout-2' ): ?>

            <div class="section-subtitle style-one <?php echo $settings['text_alignment']; ?>">
                <h2 class="subtitle">
                    <span><?php echo $settings['provix_subtitle']; ?></span>
                </h2>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Provix_CTA_Area() );