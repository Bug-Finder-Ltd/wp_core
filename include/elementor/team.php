<?php
namespace RaizenCore\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Raizen Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Raizen_Team extends \Elementor\Widget_Base {

	public function get_name() {
		return 'raizen-team';
	}

	public function get_title() {
		return __( 'Team', 'raizencore' );
	}

	public function get_icon() {
		return 'raizen-icon';
	}

	public function get_categories() {
		return [ 'raizencore' ];
	}

	public function get_script_depends() {
		return [ 'raizencore' ];
	}

	protected function register_controls() {
        /**
         * Layout Section
         */
        $this->start_controls_section(
            'raizen_layout',
            [
                'label' => esc_html__('Design Layout', 'raizencore'),
            ]
        );
        $this->add_control(
            'raizen_design_style',
            [
                'label' => esc_html__('Select Layout', 'raizencore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'raizencore'),
                    'layout-2' => esc_html__('Layout 2', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_section',
            [
                'label' => __( 'Image', 'raizencore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'image',
                [
                    'type' => Controls_Manager::MEDIA,
                    'label' => __( 'Image', 'raizencore' ),
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
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
                'label' => __( 'Name & Designation', 'raizencore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'serial',
                [
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'label' => __( 'Serial', 'raizencore' ),
                    'default' => __( '01', 'raizencore' ),
                    'placeholder' => __( 'Type serial here', 'raizencore' ),
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
                    'label' => __( 'Name', 'raizencore' ),
                    'default' => __( 'Member Name', 'raizencore' ),
                    'placeholder' => __( 'Type name here', 'raizencore' ),
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
                    'label' => __( 'Job Title', 'raizencore' ),
                    'default' => __( 'Raizen Officer', 'raizencore' ),
                    'placeholder' => __( 'Type designation here', 'raizencore' ),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'social_link',
            [
                'label' => __( 'Social Link', 'raizencore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'facebook_link',
                [
                    'label' => esc_html__( 'Facebook', 'raizencore' ),
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
                    'label' => esc_html__( 'X', 'raizencore' ),
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
                    'label' => esc_html__( 'Instagram', 'raizencore' ),
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
                    'label' => esc_html__( 'Linkedin', 'raizencore' ),
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
				'label' => __( 'Style', 'raizencore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'raizencore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'raizencore' ),
					'uppercase' => __( 'UPPERCASE', 'raizencore' ),
					'lowercase' => __( 'lowercase', 'raizencore' ),
					'capitalize' => __( 'Capitalize', 'raizencore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget ouraizenut on the frontend.
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

        <?php if ( $settings['raizen_design_style']  == 'layout-1' ): ?>

        <div class="team-single style-one">
            <div class="team-single-image-box">
                <img src="<?php echo esc_url($image); ?>" alt="photo">
                <div class="overlay-top"></div>
                <div class="overlay-bottom"></div>
            </div>
            <div class="team-single-content">
                <h6 class="name"><?php echo $settings['name']; ?></h6>
                <p class="designation"><?php echo $settings['designation']; ?></p>
            </div>
        </div>

        <?php elseif( $settings['raizen_design_style']  == 'layout-2' ): ?>

        <div class="team-single style-two">
            <div class="team-single-image-box">
                <div class="team-single-image text-center">
                    <img src="<?php echo esc_url($image); ?>" alt="photo">
                </div>
                <div class="social-media">
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
            <div class="team-single-content">
                <h6><?php echo $settings['name']; ?></h6>
                <?php if(!empty($settings['designation'])) : ?>
                    <p><?php echo $settings['designation']; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new Raizen_Team() );