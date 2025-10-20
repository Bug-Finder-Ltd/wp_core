<?php
namespace ProtineCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;



use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Box_Shadow;
use ProtineCore\Elementor\Controls\Group_Control_ProtineBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Download_Button extends \Elementor\Widget_Base {

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
		return 'next-download-button';
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
		return __( 'Download Button', 'protinecore' );
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
		return 'protine-icon';
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
		return [ 'protinecore' ];
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
		return [ 'protinecore' ];
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
            'protine_layout',
            [
                'label' => esc_html__('Design Layout', 'protinecore'),
            ]
        );
        $this->add_control(
            'protine_design_style',
            [
                'label' => esc_html__('Select Layout', 'protinecore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'protinecore'),
                    'layout-2' => esc_html__('Layout 2', 'protinecore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'protinecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button1_link',
            [
                'label' => esc_html__( 'Button 1 Link', 'protinecore' ),
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
            'button2_link',
            [
                'label' => esc_html__( 'Button 2 Link', 'protinecore' ),
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
        ?>

		<?php if ( $settings['protine_design_style']  == 'layout-2' ): 
            
            if ( !empty($settings['protine_about_left_image']['url']) ) {
                $protine_about_left_image = !empty($settings['protine_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['protine_about_left_image']['id'], $settings['protine_image_size_size']) : $settings['protine_about_left_image']['url'];
                $protine_about_left_image_alt = get_post_meta($settings["protine_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['protine_about_right_image']['url']) ) {
                $protine_about_right_image = !empty($settings['protine_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['protine_about_right_image']['id'], $settings['protine_image_size_size']) : $settings['protine_about_right_image']['url'];
                $protine_about_right_image_alt = get_post_meta($settings["protine_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>
            <!-- about -->
            <section class="about">
                <div class="container">
                    <div class="common-title">
                        <img src="<?php echo get_template_directory_uri() .  '/assets/img/shape/line-left.png';?>" alt="shape">
                        <?php
                            if ( !empty($settings['protine_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['protine_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    protine_kses( $settings['protine_title' ] )
                                    );
                            endif;
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="about-left-image">
                                <?php if ($settings['protine_about_left_image']['url'] || $settings['protine_about_left_image']['id']) : ?>
                                    <img src="<?php echo esc_url($protine_about_left_image); ?>" alt="<?php echo esc_attr($protine_about_left_image_alt); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="about-right">
                                <div class="about-right-shape">
                                    <div class="shape">
                                        <img src="<?php echo get_template_directory_uri() .  '/assets/img/shape/about-shape.png';?>" alt="shape">
                                    </div>
                                </div>
                                <div class="about-article">
                                    <?php if ( !empty($settings['protine_description']) ) : ?>
                                        <p><?php echo protine_kses( $settings['protine_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="about-right-content">
                                    <div class="about-right-content-round">
                                        <div class="about-round-text">
                                            <div class="round-box-content">
                                                <span class="curved-circle"><?php echo protine_kses($settings['text_inside_circle']); ?> </span>
                                                <div class="round-box-icon">
                                                    <a href="<?php echo esc_url($settings['protine_page_link']); ?>"><img src="<?php echo get_template_directory_uri() .  '/assets/img/icons/arrow-big-black.png';?>" alt="arrow"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="about-right-content-image">
                                        <?php if ($settings['protine_about_right_image']['url'] || $settings['protine_about_right_image']['id']) : ?>
                                            <img src="<?php echo esc_url($protine_about_right_image); ?>" alt="<?php echo esc_attr($protine_about_right_image_alt); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- about -->

		<?php else: ?>

            <?php
                $image_url1 = PROTINE_ADDONS_URL . 'assets/img/google-play.png';
                $image_url2 = PROTINE_ADDONS_URL . 'assets/img/app-store.png';
            ?>

            <div class="app-icon">
                <a href="<?php echo esc_url($settings['button1_link']['url']); ?>"><img src="<?php echo esc_url($image_url1); ?>" alt="icon"></a>
                <a href="<?php echo esc_url($settings['button2_link']['url']); ?>"><img src="<?php echo esc_url($image_url2); ?>" alt="icon"></a>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Protine_Download_Button() );