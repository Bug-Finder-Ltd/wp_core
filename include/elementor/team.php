<?php

namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Team extends \Elementor\Widget_Base {


	public function get_name() {
		return 'provix-team';
	}

	public function get_title() {
		return __( 'Team', 'agenvix-core' );
	}

	public function get_icon() {
		return 'provix-icon';
	}

	public function get_categories() {
		return array( 'agenvix-core' );
	}

	public function get_script_depends() {
		return array( 'agenvix-core' );
	}

	protected function register_controls() {
		/**
		 * Layout Section
		 */
		$this->start_controls_section(
			'provix_layout',
			array(
				'label' => esc_html__( 'Design Layout', 'agenvix-core' ),
			)
		);
		$this->add_control(
			'provix_design_style',
			array(
				'label'   => esc_html__( 'Select Layout', 'agenvix-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
				),
				'default' => 'layout-1',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_section',
			array(
				'label' => __( 'Image', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'image',
			array(
				'type'    => Controls_Manager::MEDIA,
				'label'   => __( 'Image', 'agenvix-core' ),
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'name_designation',
			array(
				'label' => __( 'Name & Designation', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'serial',
			array(
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'label'       => __( 'Serial', 'agenvix-core' ),
				'default'     => __( '01', 'agenvix-core' ),
				'placeholder' => __( 'Type serial here', 'agenvix-core' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'name',
			array(
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'label'       => __( 'Name', 'agenvix-core' ),
				'default'     => __( 'Member Name', 'agenvix-core' ),
				'placeholder' => __( 'Type name here', 'agenvix-core' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'designation',
			array(
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'show_label'  => true,
				'label'       => __( 'Job Title', 'agenvix-core' ),
				'default'     => __( 'Provix Officer', 'agenvix-core' ),
				'placeholder' => __( 'Type designation here', 'agenvix-core' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'social_link',
			array(
				'label' => __( 'Social Link', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'facebook_link',
			array(
				'label'       => esc_html__( 'Facebook', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => 'https://www.facebook.com/',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$this->add_control(
			'x_link',
			array(
				'label'       => esc_html__( 'X', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => 'https://x.com/',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$this->add_control(
			'instagram_link',
			array(
				'label'       => esc_html__( 'Instagram', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => 'https://www.instagram.com/',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$this->add_control(
			'linkedin_link',
			array(
				'label'       => esc_html__( 'Linkedin', 'agenvix-core' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => 'https://www.linkedin.com/',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Style', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_transform',
			array(
				'label'     => __( 'Text Transform', 'agenvix-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''           => __( 'None', 'agenvix-core' ),
					'uppercase'  => __( 'UPPERCASE', 'agenvix-core' ),
					'lowercase'  => __( 'lowercase', 'agenvix-core' ),
					'capitalize' => __( 'Capitalize', 'agenvix-core' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				),
			)
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

		if ( ! empty( $settings['image']['url'] ) ) {
			$image = ! empty( $settings['image']['id'] ) ? wp_get_attachment_image_url( $settings['image']['id'], '' ) : $settings['image']['url'];
		}
		?>

		<?php if ( $settings['provix_design_style'] == 'layout-1' ) : ?>

			<div class="team-single style-one">
				<div class="team-single-image-box">
					<img src="<?php echo esc_url( $image ); ?>" alt="photo">
				</div>
				<div class="team-single-content">
					<h6 class="name"><?php echo $settings['name']; ?></h6>
					<div class="bottom-area">
						<p class="designation"><?php echo $settings['designation']; ?></p>
						<div class="social-icons">
							<button>
								<i class="fa-regular fa-arrow-turn-right"></i>
							</button>
							<ul>
								<?php if ( ! empty( $settings['facebook_link']['url'] ) ) { ?>
									<li><a href="<?php echo esc_url( $settings['facebook_link']['url'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
								<?php } ?>

								<?php if ( ! empty( $settings['x_link']['url'] ) ) { ?>
									<li><a href="<?php echo esc_url( $settings['x_link']['url'] ); ?>"><?php echo esc_html( 'x' ); ?></a></li>
								<?php } ?>

								<?php if ( ! empty( $settings['instagram_link']['url'] ) ) { ?>
									<li><a href="<?php echo esc_url( $settings['instagram_link']['url'] ); ?>"><i class="fa-brands fa-instagram"></i></a></li>
								<?php } ?>

								<?php if ( ! empty( $settings['linkedin_link']['url'] ) ) { ?>
									<li><a href="<?php echo esc_url( $settings['linkedin_link']['url'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style'] == 'layout-2' ) : ?>

			<div class="team-single style-two">
				<div class="team-single-image-box">
					<div class="team-single-image text-center">
						<img src="<?php echo esc_url( $image ); ?>" alt="photo">
					</div>
					<div class="team-single-overlay">
						<div class="footer-media">
							<ul>
								<?php if ( ! empty( $settings['facebook_link']['url'] ) ) { ?>
									<li><a href="<?php echo esc_url( $settings['facebook_link']['url'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
								<?php } ?>

								<?php if ( ! empty( $settings['x_link']['url'] ) ) { ?>
									<li><a href="<?php echo esc_url( $settings['x_link']['url'] ); ?>"><?php echo esc_html( 'x' ); ?></a></li>
								<?php } ?>

								<?php if ( ! empty( $settings['instagram_link']['url'] ) ) { ?>
									<li><a href="<?php echo esc_url( $settings['instagram_link']['url'] ); ?>"><i class="fa-brands fa-instagram"></i></a></li>
								<?php } ?>

								<?php if ( ! empty( $settings['linkedin_link']['url'] ) ) { ?>
									<li><a href="<?php echo esc_url( $settings['linkedin_link']['url'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="team-single-number">
					<p><?php echo $settings['serial']; ?></p>
				</div>
				<div class="team-single-content">
					<h6><?php echo $settings['name']; ?></h6>
					<p><?php echo $settings['designation']; ?></p>
				</div>
			</div>

		<?php elseif ( 'layout-3' === $settings['provix_design_style'] ) : ?>

			<div class="team-single style-three">
				<div class="team-single-image-box">
					<img src="<?php echo esc_url( $image ); ?>" alt="photo">
					<div class="overlay-top"></div>
					<div class="overlay-bottom"></div>
				</div>
				<div class="team-single-content">
					<h6 class="name"><?php echo $settings['name']; ?></h6>
					<p class="designation"><?php echo $settings['designation']; ?></p>
				</div>
			</div>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Team() );
