<?php
namespace NextdestinaCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Nextdestina Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nextdestina_Team extends \Elementor\Widget_Base {

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
		return 'team';
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
		return __( 'Team', 'nextdestinacore' );
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
         * Layout Section
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_section',
            [
                'label' => __( 'Image', 'nextdestinacore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'image',
                [
                    'type' => Controls_Manager::MEDIA,
                    'label' => __( 'Image', 'nextdestinacore' ),
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'name_designation',
            [
                'label' => __( 'Name & Designation', 'nextdestinacore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'serial',
                [
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'label' => __( 'Serial', 'nextdestinacore' ),
                    'default' => __( '01', 'nextdestinacore' ),
                    'placeholder' => __( 'Type serial here', 'nextdestinacore' ),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
            $this->add_control(
                'name',
                [
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'label' => __( 'Name', 'nextdestinacore' ),
                    'default' => __( 'Member Name', 'nextdestinacore' ),
                    'placeholder' => __( 'Type name here', 'nextdestinacore' ),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
            $this->add_control(
                'designation',
                [
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'show_label' => true,
                    'label' => __( 'Job Title', 'nextdestinacore' ),
                    'default' => __( 'Nextdestina Officer', 'nextdestinacore' ),
                    'placeholder' => __( 'Type designation here', 'nextdestinacore' ),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'social_link',
            [
                'label' => __( 'Social Link', 'nextdestinacore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'facebook_link',
                [
                    'label' => esc_html__( 'Facebook', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'options' => [ 'url', 'is_external', 'nofollow' ],
                    'default' => [
                        'url' => 'https://www.facebook.com/',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'x_link',
                [
                    'label' => esc_html__( 'X', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'options' => [ 'url', 'is_external', 'nofollow' ],
                    'default' => [
                        'url' => 'https://x.com/',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'instagram_link',
                [
                    'label' => esc_html__( 'Instagram', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'options' => [ 'url', 'is_external', 'nofollow' ],
                    'default' => [
                        'url' => 'https://www.instagram.com/',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'linkedin_link',
                [
                    'label' => esc_html__( 'Linkedin', 'nextdestinacore' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'options' => [ 'url', 'is_external', 'nofollow' ],
                    'default' => [
                        'url' => 'https://www.linkedin.com/',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'label_block' => true,
                ]
            );
        $this->end_controls_section();
        
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

        if ( !empty($settings['image']['url']) ) {
            $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
        }
        ?>

        <div class="team-single wow fadeInUp" data-wow-delay="100ms">
            <div class="team-single-image-box">
                <div class="team-single-image text-center">
                    <img src="<?php echo esc_url($image); ?>" alt="photo">
                </div>
                <div class="team-single-overlay">
                    <div class="footer-media">
                        <ul>
                            <?php if(!empty($settings['facebook_link']['url'])){ ?>
                                <li><a href="<?php echo esc_url($settings['facebook_link']['url']); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <?php } ?>

                            <?php if(!empty($settings['x_link']['url'])){ ?>
                                <li><a href="<?php echo esc_url($settings['x_link']['url']); ?>"><?php echo esc_html('x'); ?></a></li>
                            <?php } ?>

                            <?php if(!empty($settings['instagram_link']['url'])){ ?>
                                <li><a href="<?php echo esc_url($settings['instagram_link']['url']); ?>"><i class="fa-brands fa-instagram"></i></a></li>
                            <?php } ?>

                            <?php if(!empty($settings['linkedin_link']['url'])){ ?>
                                <li><a href="<?php echo esc_url($settings['linkedin_link']['url']); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="team-single-number"><p><?php echo $settings['serial']; ?></p></div>
            <div class="team-single-content">
                <h6><?php echo $settings['name']; ?></h6>
                <p><?php echo $settings['designation']; ?></p>
            </div>
        </div>

        <?php
	}
}

$widgets_manager->register( new Nextdestina_Team() );