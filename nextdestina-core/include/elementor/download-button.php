<?php
namespace NextdestinaCore\Widgets;

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
use NextdestinaCore\Elementor\Controls\Group_Control_NextdestinaBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Download_Button extends \Elementor\Widget_Base {

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
		return __( 'Download Button', 'nextdestinacore' );
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nextdestinacore'),
                    'layout-2' => esc_html__('Layout 2', 'nextdestinacore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button1_link',
            [
                'label' => esc_html__( 'Button 1 Link', 'nextdestinacore' ),
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
                'label' => esc_html__( 'Button 2 Link', 'nextdestinacore' ),
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
        ?>

		<?php if ( $settings['nextdestina_design_style']  == 'layout-2' ): 
            
            if ( !empty($settings['nextdestina_about_left_image']['url']) ) {
                $nextdestina_about_left_image = !empty($settings['nextdestina_about_left_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_left_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_left_image']['url'];
                $nextdestina_about_left_image_alt = get_post_meta($settings["nextdestina_about_left_image"]["id"], "_wp_attachment_image_alt", true);
            } 
            if ( !empty($settings['nextdestina_about_right_image']['url']) ) {
                $nextdestina_about_right_image = !empty($settings['nextdestina_about_right_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_about_right_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_about_right_image']['url'];
                $nextdestina_about_right_image_alt = get_post_meta($settings["nextdestina_about_right_image"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>
            <!-- about -->
            <section class="about">
                <div class="container">
                    <div class="common-title">
                        <img src="<?php echo get_template_directory_uri() .  '/assets/img/shape/line-left.png';?>" alt="shape">
                        <?php
                            if ( !empty($settings['nextdestina_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['nextdestina_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    nextdestina_kses( $settings['nextdestina_title' ] )
                                    );
                            endif;
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="about-left-image">
                                <?php if ($settings['nextdestina_about_left_image']['url'] || $settings['nextdestina_about_left_image']['id']) : ?>
                                    <img src="<?php echo esc_url($nextdestina_about_left_image); ?>" alt="<?php echo esc_attr($nextdestina_about_left_image_alt); ?>">
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
                                    <?php if ( !empty($settings['nextdestina_description']) ) : ?>
                                        <p><?php echo nextdestina_kses( $settings['nextdestina_description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="about-right-content">
                                    <div class="about-right-content-round">
                                        <div class="about-round-text">
                                            <div class="round-box-content">
                                                <span class="curved-circle"><?php echo nextdestina_kses($settings['text_inside_circle']); ?> </span>
                                                <div class="round-box-icon">
                                                    <a href="<?php echo esc_url($settings['nextdestina_page_link']); ?>"><img src="<?php echo get_template_directory_uri() .  '/assets/img/icons/arrow-big-black.png';?>" alt="arrow"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="about-right-content-image">
                                        <?php if ($settings['nextdestina_about_right_image']['url'] || $settings['nextdestina_about_right_image']['id']) : ?>
                                            <img src="<?php echo esc_url($nextdestina_about_right_image); ?>" alt="<?php echo esc_attr($nextdestina_about_right_image_alt); ?>">
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
                $image_url1 = NEXTDESTINA_ADDONS_URL . 'assets/img/google-play.png';
                $image_url2 = NEXTDESTINA_ADDONS_URL . 'assets/img/app-store.png';
            ?>

            <div class="app-icon">
                <a href="<?php echo esc_url($settings['button1_link']['url']); ?>"><img src="<?php echo esc_url($image_url1); ?>" alt="icon"></a>
                <a href="<?php echo esc_url($settings['button2_link']['url']); ?>"><img src="<?php echo esc_url($image_url2); ?>" alt="icon"></a>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new Nextdestina_Download_Button() );