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
class Team_Carousel extends \Elementor\Widget_Base {

	public function get_name() {
		return 'team-carousel';
	}

	public function get_title() {
		return __( 'Team Carousel', 'raizencore' );
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
            'team_section',
            [
                'label' => __( 'Team', 'raizencore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__( 'Name', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Lucas Park', 'raizencore' ),
                'placeholder' => esc_html__( 'Type your name here', 'raizencore' ),
            ]
        );
        $repeater->add_control(
            'designation',
            [
                'label' => esc_html__( 'Designation', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Interaction Designer', 'raizencore' ),
                'placeholder' => esc_html__( 'Type your designation here', 'raizencore' ),
            ]
        );
        $repeater->add_control(
            'team_image',
            [
                'label' => esc_html__( 'Choose Image', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
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
        $repeater->add_control(
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
        $repeater->add_control(
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
        $repeater->add_control(
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

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Repeater List', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => esc_html__( 'Title #1', 'raizencore' ),
                    ],
                    [
                        'name' => esc_html__( 'Title #2', 'raizencore' ),
                    ],
                ],
                'title_field' => '{{{ name }}}',
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

            <div class="team-list style-one">
                <div class="team-bio">
                    <?php
                    $i = 1;
                    foreach (  $settings['list'] as $item ) : ?>
                        <div class="title item<?php echo $i; ?>-title">
                            <h5 class="name"><?php echo $item['name']; ?></h5>
                            <h6 class="designation"><?php echo $item['designation']; ?></h6>
                            <div class="social-links">
                                <?php if( !empty($item['facebook_link']['url']) ) : ?>
                                    <a href="<?php echo esc_url($item['facebook_link']['url']); ?>">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if( !empty($item['x_link']['url']) ) : ?>
                                    <a href="<?php echo esc_url($item['x_link']['url']); ?>">
                                        <i class="fa-solid fa-x"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if( !empty($item['instagram_link']['url']) ) : ?>
                                    <a href="<?php echo esc_url($item['instagram_link']['url']); ?>">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if( !empty($item['linkedin_link']['url']) ) : ?>
                                    <a href="<?php echo esc_url($item['linkedin_link']['url']); ?>">
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    $i++;
                    endforeach;
                    ?>
                </div>
                <div class="frame">
                    <div class="circle-2"></div>
                    <div class="circle-3"></div>
                    <?php
                    $i = 1;
                    $angle = 0;
                    foreach (  $settings['list'] as $item ) : ?>
                        <label class="item item<?php echo $i; ?>" data-angle="<?php echo $angle; ?>">
                            <div class="rotator">
                                <div class="team-image">
                                    <img src="<?php echo esc_url($item['team_image']['url']); ?>" alt="">
                                </div>
                            </div>
                            <div class="team-info">
                                <div class="title item<?php echo $i; ?>-title">
                                    <h5 class="name"><?php echo $item['name']; ?></h5>
                                    <h6 class="designation"><?php echo $item['designation']; ?></h6>
                                    <div class="social-links">
                                        <?php if( !empty($item['facebook_link']['url']) ) : ?>
                                            <a href="<?php echo esc_url($item['facebook_link']['url']); ?>">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if( !empty($item['x_link']['url']) ) : ?>
                                            <a href="<?php echo esc_url($item['x_link']['url']); ?>">
                                                <i class="fa-solid fa-x"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if( !empty($item['instagram_link']['url']) ) : ?>
                                            <a href="<?php echo esc_url($item['instagram_link']['url']); ?>">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if( !empty($item['linkedin_link']['url']) ) : ?>
                                            <a href="<?php echo esc_url($item['linkedin_link']['url']); ?>">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </label>
                    <?php
                    $i++;
                    $angle = $angle + 90;
                    endforeach;
                    ?>
                </div>
            </div>

        <?php elseif( $settings['raizen_design_style']  == 'layout-2' ): ?>

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

$widgets_manager->register( new Team_Carousel() );