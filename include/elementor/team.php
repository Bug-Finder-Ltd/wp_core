<?php
namespace ProtineCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Protine Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Protine_Team extends \Elementor\Widget_Base {

	public function get_name() {
		return 'team';
	}

	public function get_title() {
		return __( 'Team', 'protinecore' );
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
         * Layout Section
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
            'image_section',
            [
                'label' => __( 'Image', 'protinecore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'image',
                [
                    'type' => Controls_Manager::MEDIA,
                    'label' => __( 'Image', 'protinecore' ),
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
                'label' => __( 'Name & Designation', 'protinecore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'serial',
                [
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'label' => __( 'Serial', 'protinecore' ),
                    'default' => __( '01', 'protinecore' ),
                    'placeholder' => __( 'Type serial here', 'protinecore' ),
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
                    'label' => __( 'Name', 'protinecore' ),
                    'default' => __( 'Member Name', 'protinecore' ),
                    'placeholder' => __( 'Type name here', 'protinecore' ),
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
                    'label' => __( 'Job Title', 'protinecore' ),
                    'default' => __( 'Protine Officer', 'protinecore' ),
                    'placeholder' => __( 'Type designation here', 'protinecore' ),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'social_link',
            [
                'label' => __( 'Social Link', 'protinecore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'facebook_link',
                [
                    'label' => esc_html__( 'Facebook', 'protinecore' ),
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
                    'label' => esc_html__( 'X', 'protinecore' ),
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
                    'label' => esc_html__( 'Instagram', 'protinecore' ),
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
                    'label' => esc_html__( 'Linkedin', 'protinecore' ),
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
				'label' => __( 'Style', 'protinecore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'protinecore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'protinecore' ),
					'uppercase' => __( 'UPPERCASE', 'protinecore' ),
					'lowercase' => __( 'lowercase', 'protinecore' ),
					'capitalize' => __( 'Capitalize', 'protinecore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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

        if ( !empty($settings['image']['url']) ) {
            $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
        }
        ?>

        <?php if ( $settings['protine_design_style']  == 'layout-1' ): ?>

        <div class="team-single style-one">
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
            <div class="team-single-content">
                <h6 class="name"><?php echo $settings['name']; ?></h6>
                <p class="designation"><?php echo $settings['designation']; ?></p>
            </div>
        </div>

        <?php elseif( $settings['protine_design_style']  == 'layout-2' ): ?>

        <div class="team-single style-two">
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

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new Protine_Team() );