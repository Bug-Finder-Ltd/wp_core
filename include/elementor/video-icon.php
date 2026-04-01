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
class Provix_Video_Icon extends \Elementor\Widget_Base {

	public function get_name() {
		return 'video-icon';
	}

	public function get_title() {
		return __( 'Video Icon', 'agenvix-core' );
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
                    'layout-3' => esc_html__('Layout 3', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__('Image', 'agenvix-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image',
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
         * Title and content section
         */
        $this->start_controls_section(
            'provix_icon_link',
            [
                'label' => esc_html__('Icon & Link', 'agenvix-core'),
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'agenvix-core' ),
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
                'label' => esc_html__( 'Link', 'agenvix-core' ),
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
                'label' => esc_html__( 'General', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .video-icon' => 'max-width: {{SIZE}}{{UNIT}};',
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

        if ( ! empty( $settings['video_link']['url'] ) ) {
            $this->add_link_attributes( 'video_link', $settings['video_link'] );
        }
        ?>

		<?php if ( $settings['provix_design_style']  == 'layout-1' ):

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

		<?php elseif ( $settings['provix_design_style']  == 'layout-2' ): 

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

        <?php elseif ( $settings['provix_design_style']  == 'layout-3' ): 

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

$widgets_manager->register( new Provix_Video_Icon() );