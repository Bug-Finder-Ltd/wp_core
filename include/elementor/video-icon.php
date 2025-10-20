<?php
namespace ProtineCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Video_Icon extends \Elementor\Widget_Base {

	public function get_name() {
		return 'video-icon';
	}

	public function get_title() {
		return __( 'Video Icon', 'protinecore' );
	}

	public function get_icon() {
		return 'protine-icon';
	}

	public function get_categories() {
		return [ 'protinecore' ];
	}

	public function get_script_depends() {
		return [ 'protinecore' ];
	}

	protected function register_controls() {

        /**
         * Layout section
         */
        
        $this->start_controls_section(
            'protine_layout',
            [
                'label' => esc_html__('Design Layout', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_design_style',
            [
                'label' => esc_html__('Select Layout', 'protinecore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'protinecore'),
                    'layout-2' => esc_html__('Layout 2', 'protinecore'),
                    'layout-3' => esc_html__('Layout 3', 'protinecore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__('Image', 'protinecore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();

        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'protine_icon_link',
            [
                'label' => esc_html__('Icon & Link', 'protinecore'),
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'protinecore' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'video_link',
            [
                'label' => esc_html__( 'Link', 'protinecore' ),
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

        $this->end_controls_section();

        /**
         * Style section
         */

        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__( 'General', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'protinecore' ),
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
                    '{{WRAPPER}} .video-icon' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

	}

	/**
	 * Render the widget ouprotineut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

        if ( ! empty( $settings['video_link']['url'] ) ) {
            $this->add_link_attributes( 'video_link', $settings['video_link'] );
        }
        ?>

		<?php if ( $settings['protine_design_style']  == 'layout-1' ):

            if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
            }
            ?>
            
            <div class="video-icon style-one">
                <div class="video-btn">
                    <a <?php $this->print_render_attribute_string( 'video_link' ); ?> class="hv-popup-link">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </a>
                    <span></span>
                </div>
            </div>

		<?php elseif ( $settings['protine_design_style']  == 'layout-2' ): 

            if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
            }
        ?>

            <div class="video-icon style-two">
                <div class="wrapper">
                    <img src="<?php echo esc_url($image); ?>" alt="image">
                    <div class="video-btn">
                        <div class="missiom-video-btn">
                            <a <?php $this->print_render_attribute_string( 'video_link' ); ?> class="hv-popup-link">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ( $settings['protine_design_style']  == 'layout-3' ): 

            if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
            }
        ?>

            <div class="video-icon style-three">
                <img src="<?php echo esc_url($image); ?>" alt="image">
                <div class="video-btn">
                    <div class="missiom-video-btn">
                        <a <?php $this->print_render_attribute_string( 'video_link' ); ?> class="hv-popup-link">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Protine_Video_Icon() );