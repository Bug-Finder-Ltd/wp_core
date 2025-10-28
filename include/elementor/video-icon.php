<?php
namespace NextdestinaCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Video_Icon extends \Elementor\Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'video-icon';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Video Icon', 'nextdestinacore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'nextdestina-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'nextdestinacore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'nextdestinacore' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

        /**
         * Layout section
         */
        
        $this->start_controls_section(
            'nextdestina_layout',
            [
                'label' => esc_html__('Design Layout', 'nextdestinacore'),
            ]
        );
        $this->add_control(
            'nextdestina_design_style',
            [
                'label' => esc_html__('Select Layout', 'nextdestinacore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nextdestinacore'),
                    'layout-2' => esc_html__('Layout 2', 'nextdestinacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__('Image', 'nextdestinacore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'nextdestinacore' ),
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
            'nextdestina_icon_link',
            [
                'label' => esc_html__('Icon & Link', 'nextdestinacore'),
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'nextdestinacore' ),
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
                'label' => esc_html__( 'Link', 'nextdestinacore' ),
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
                'label' => esc_html__( 'General', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'nextdestinacore' ),
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
	 * Render the widget ounextdestinaut on the frontend.
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

		<?php if ( $settings['nextdestina_design_style']  == 'layout-1' ):
            if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
            }
            ?>
            
            <div class="video-icon style-one">
                <img src="<?php echo esc_url($image); ?>" alt="image">
                <div class="video-btn">
                    <div class="missiom-video-btn">
                        <a <?php $this->print_render_attribute_string( 'video_link' ); ?> class="hv-popup-link">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </a>
                    </div>
                </div>
            </div>

		<?php elseif ( $settings['nextdestina_design_style']  == 'layout-2' ): 
            if ( !empty($settings['nextdestina_about_left_image']['url']) ) {
                $nextdestina_about_left_image = !empty($settings['nextdestina_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_left_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_left_image']['url'];
                $nextdestina_about_left_image_alt = get_post_meta($settings["nextdestina_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['nextdestina_about_right_image']['url']) ) {
                $nextdestina_about_right_image = !empty($settings['nextdestina_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_right_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_right_image']['url'];
                $nextdestina_about_right_image_alt = get_post_meta($settings["nextdestina_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['nextdestina_about_right_image_2']['url']) ) {
                $nextdestina_about_right_image_2 = !empty($settings['nextdestina_about_right_image_2']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_right_image_2']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_right_image_2']['url'];
                $nextdestina_about_right_image_2_alt = get_post_meta($settings["nextdestina_about_right_image_2"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>


            <?php
                $image_url = NEXTDESTINA_ADDONS_URL . 'assets/img/common-title-shape-1.png';
            ?>
            <div class="section-title style-one <?php echo $settings['text_alignment']; ?>">
                <h2><?php echo $settings['nextdestina_title']; ?></h2>
                <?php if(!empty($settings['nextdestina_description'])) : ?>
                    <p><?php echo $settings['nextdestina_description']; ?></p>
                <?php endif ?>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Nextdestina_Video_Icon() );