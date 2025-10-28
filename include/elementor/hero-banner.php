<?php
namespace NextdestinaCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Hero_Banner extends \Elementor\Widget_Base {

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
		return 'hero-banner';
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
		return __( 'Hero Banner', 'nextdestinacore' );
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
            'slider_section',
            [
                'label' => esc_html__( 'Slider', 'nextdestinacore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'list_subtitle',
                [
                    'label' => esc_html__( 'Subtitle', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'List Subtitle' , 'nextdestinacore' ),
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'list_title',
                [
                    'label' => esc_html__( 'Title', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'List Title' , 'nextdestinacore' ),
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'list_description',
                [
                    'label' => esc_html__( 'Description', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( 'Default description', 'nextdestinacore' ),
                    'placeholder' => esc_html__( 'Type your description here', 'nextdestinacore' ),
                ]
            );
            $repeater->add_control(
                'bg_image',
                [
                    'label' => esc_html__( 'Background Image', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_control(
                'list',
                [
                    'label' => esc_html__( 'Repeater List', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => esc_html__( 'Title #1', 'nextdestinacore' ),
                            'list_description' => esc_html__( 'Item content. Click the edit button to change this text.', 'nextdestinacore' ),
                        ],
                        [
                            'list_title' => esc_html__( 'Title #2', 'nextdestinacore' ),
                            'list_description' => esc_html__( 'Item content. Click the edit button to change this text.', 'nextdestinacore' ),
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
			'section_style',
			[
				'label' => __( 'Style', 'nextdestinacore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'nextdestinacore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'nextdestinacore' ),
					'uppercase' => __( 'UPPERCASE', 'nextdestinacore' ),
					'lowercase' => __( 'lowercase', 'nextdestinacore' ),
					'capitalize' => __( 'Capitalize', 'nextdestinacore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
        ?>

        <?php if ( $settings['nextdestina_design_style']  == 'layout-2' ): 

            if ( !empty($settings['nextdestina_hero_image']['url']) ) {
                $nextdestina_hero_image = !empty($settings['nextdestina_hero_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_hero_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_hero_image']['url'];
                $nextdestina_hero_image_alt = get_post_meta($settings["nextdestina_hero_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['nextdestina_video_bg_image']['url']) ) {
                $nextdestina_video_bg_image = !empty($settings['nextdestina_video_bg_image']['id']) ? wp_get_attachment_image_url( $settings['nextdestina_video_bg_image']['id'], $settings['nextdestina_image_size_size']) : $settings['nextdestina_video_bg_image']['url'];
            }
            // Link
            if ('2' == $settings['nextdestina_btn_link_type']) {
                $this->add_render_attribute('nextdestina-button-arg', 'href', get_permalink($settings['nextdestina_btn_page_link']));
                $this->add_render_attribute('nextdestina-button-arg', 'target', '_self');
                $this->add_render_attribute('nextdestina-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('nextdestina-button-arg', 'class', 'round-btn');
            } else {
                if ( ! empty( $settings['nextdestina_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'nextdestina-button-arg', $settings['nextdestina_btn_link'] );
                    $this->add_render_attribute('nextdestina-button-arg', 'class', 'round-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'banner-title');

        ?>


            <!-- banner-section -->
            <section class="banner-section banner-one">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-content-box">
                                <?php if ( !empty($settings['nextdestina_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['nextdestina_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        nextdestina_kses( $settings['nextdestina_title' ] )
                                        );
                                endif; ?> <img src="<?php echo get_template_directory_uri() . '/assets/img/shape/line-right.png';?>'" alt="shape">
                                <div class="banner-content-box-wrapper">
                                    <div class="banner-video-content">
                                        <div class="banner-video-image">
                                            <?php if ($settings['nextdestina_video_bg_image']['url'] || $settings['nextdestina_video_bg_image']['id']) : ?>
                                                <img src="<?php echo esc_url($nextdestina_video_bg_image); ?>" alt="<?php echo esc_attr($nextdestina_video_bg_image_alt); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="banner-video-btn">
                                            <?php if ( !empty($settings['nextdestina_video_url']) ) : ?>
                                                <a class="play_btn hv-popup-link"
                                                    href="<?php echo esc_url($settings['nextdestina_video_url']); ?>">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="banner-video-title">
                                        <div class="animate-loading-bar">
                                            <h2 class="ah-headline zoom">
                                                <?php echo nextdestina_kses($settings['headline_pre_text']); ?>
                                                <span class="ah-words-wrapper">
                                                    <?php foreach ($settings['headlines'] as $index => $item) :
                                                        $vissible_hidden = ($index == '0' ) ? "is-visible" : "is-hidden";
                                                        ?>
                                                        <b class="<?php echo $vissible_hidden;?>"><?php echo nextdestina_kses($item['headline_text']); ?></b>
                                                    <?php endforeach; ?>
                                                </span>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="round-btn-box">
                                        <?php if (!empty($settings['nextdestina_btn_text'])) : ?>
                                            <a <?php echo $this->get_render_attribute_string( 'nextdestina-button-arg' ); ?>>
                                                <p><?php echo $settings['nextdestina_btn_text']; ?></p> <i class="icon-arrow-1"></i> <span></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="banner-image">
                                    <?php if ($settings['nextdestina_hero_image']['url'] || $settings['nextdestina_hero_image']['id']) : ?>
                                        <img src="<?php echo esc_url($nextdestina_hero_image); ?>" alt="<?php echo esc_attr($nextdestina_hero_image_alt); ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="client">
                    <div class="client-slid">
                        <div class="three-item-carousel swiper-container">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['nextdestina_counter_list'] as $item) : ?>
                                    <div class="swiper-slide">
                                        <div class="client-content">
                                            <div class="client-content-icon">
                                                <?php if($item['nextdestina_counter_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['icon']) || !empty($item['selected_icon']['value'])) : ?>
                                                        <?php nextdestina_render_icon($item, 'icon', 'selected_icon'); ?>
                                                    <?php endif; ?>   
                                                <?php else : ?>                                
                                                    <?php if (!empty($item['nextdestina_icon_image']['url'])): ?>  
                                                        <img src="<?php echo $item['nextdestina_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['nextdestina_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?> 
                                                <?php endif; ?> 
                                            </div>
                                            <div class="client-content-title">
                                                <h3><?php echo nextdestina_kses($item['nextdestina_counter_title' ]); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-section end -->

        <?php else: ?>
        
        <section class="banner-section-two">
            <div class="swiper-container banner-slider-1">
                <div class="swiper-wrapper">
                    <?php foreach (  $settings['list'] as $item ) {
                        if ( !empty($item['bg_image']['url']) ) {
                            $bg_image = !empty($item['bg_image']['id']) ? wp_get_attachment_image_url( $item['bg_image']['id'], '') : $item['bg_image']['url'];
                        }
                    ?>
                        <div class="swiper-slide">
                            <div class="bg-layer" style="background-image: url(<?php echo esc_url($bg_image); ?>);"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-9 col-md-8">
                                        <div class="content-box">
                                            <?php if(!empty($item['list_subtitle'])) : ?>
                                                <h6 class="subtitle">
                                                    <?php echo esc_html($item['list_subtitle']); ?>
                                                    <i class="fa-thin fa-plane"></i>
                                                </h6>
                                            <?php endif; ?>
                                            <h3 class="title"><?php echo $item['list_title']; ?></h3>
                                            <p class="description"><?php echo esc_html($item['list_description']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Nextdestina_Hero_Banner() );