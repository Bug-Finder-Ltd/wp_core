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
class Provix_Team_List extends \Elementor\Widget_Base {


	public function get_name() {
		return 'provix-team-list';
	}

	public function get_title() {
		return __( 'Team List', 'agenvix-core' );
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
			'section_title',
			[
				'label' => esc_html__( 'Section Title', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 6,
				'default' => esc_html__( 'Default description', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your text here', 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'team_member_section',
			array(
				'label' => __( 'Team Member', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			array(
				'type'    => Controls_Manager::MEDIA,
				'label'   => __( 'Image', 'agenvix-core' ),
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'name',
			array(
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'label'       => __( 'Name', 'agenvix-core' ),
				'default'     => __( 'Member Name', 'agenvix-core' ),
				'placeholder' => __( 'Type name here', 'agenvix-core' ),
			)
		);
		$repeater->add_control(
			'designation',
			array(
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'show_label'  => true,
				'label'       => __( 'Job Title', 'agenvix-core' ),
				'default'     => __( 'Agenvix Officer', 'agenvix-core' ),
				'placeholder' => __( 'Type designation here', 'agenvix-core' ),
			)
		);
		$repeater->add_control(
			'facebook_link',
			[
				'label' => esc_html__( 'Facebook', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'linkedin_link',
			[
				'label' => esc_html__( 'Linkedin', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'x_link',
			[
				'label' => esc_html__( 'X', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'instagram_link',
			[
				'label' => esc_html__( 'Instagram', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'member_list',
			[
				'label' => esc_html__( 'Member List', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => esc_html__( 'Alexandar Rivers', 'agenvix-core' ),
						'designation' => esc_html__( 'Creative Director', 'agenvix-core' ),
					],
					[
						'name' => esc_html__( 'Marcus Chen', 'agenvix-core' ),
						'designation' => esc_html__( 'Lead Designer', 'agenvix-core' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
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
		?>

		<?php if ( $settings['provix_design_style'] == 'layout-1' ) : ?>

			<div class="team-list style-one">
				<div class="row">
					<div class="col-lg-6">
						<div class="section-title">
							<?php if( !empty($settings['title']) ) : ?>
								<h2 class="title"><?php echo $settings['title']; ?></h2>
							<?php endif; ?>

							<?php if( !empty($settings['description']) ) : ?>
								<p class="description"><?php echo $settings['description']; ?></p>
							<?php endif; ?>
							
							<?php if( !empty($settings['button_text']) ) : ?>
								<a href="<?php echo esc_url($settings['button_link']['url']); ?>">
									<?php echo $settings['button_text']; ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="team-list-wrap">
							<?php foreach (  $settings['member_list'] as $item ) :
								if ( ! empty( $item['image']['url'] ) ) {
									$image = ! empty( $item['image']['id'] ) ? wp_get_attachment_image_url( $item['image']['id'], '' ) : $item['image']['url'];
								}
								?>
								<div class="team-item">
									<div class="team-image">
										<img src="<?php echo esc_url( $image ); ?>" alt="photo">
										<img src="<?php echo esc_url( $image ); ?>" alt="photo">
									</div>
									<div class="team-single-content">
										<h6 class="name"><?php echo $item['name']; ?></h6>
										<p class="designation"><?php echo $item['designation']; ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style'] == 'layout-2' ) : ?>

			<div class="team-list style-two">
				<div class="team-list-wrap">
					<?php foreach (  $settings['member_list'] as $item ) :
						if ( ! empty( $item['image']['url'] ) ) {
							$image = ! empty( $item['image']['id'] ) ? wp_get_attachment_image_url( $item['image']['id'], '' ) : $item['image']['url'];
						}
						?>
						<div class="team-item">
							<div class="team-image">
								<img src="<?php echo esc_url( $image ); ?>" alt="photo">
							</div>
							<div class="team-single-content">
								<h6 class="name"><?php echo $item['name']; ?></h6>
								<p class="designation"><?php echo $item['designation']; ?></p>
								<div class="social-link">
									<?php if( !empty($item['facebook_link']['url']) ) : ?>
										<a href="<?php echo esc_url($item['facebook_link']['url']); ?>">
											<i class="fa-brands fa-facebook-f"></i>
										</a>
									<?php endif; ?>

									<?php if( !empty($item['linkedin_link']['url']) ) : ?>
										<a href="<?php echo esc_url($item['linkedin_link']['url']); ?>">
											<i class="fa-brands fa-linkedin-in"></i>
										</a>
									<?php endif; ?>

									<?php if( !empty($item['x_link']['url']) ) : ?>
										<a href="<?php echo esc_url($item['x_link']['url']); ?>">X</a>
									<?php endif; ?>

									<?php if( !empty($item['instagram_link']['url']) ) : ?>
										<a href="<?php echo esc_url($item['instagram_link']['url']); ?>">
											<i class="fa-brands fa-instagram"></i>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
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

$widgets_manager->register( new Provix_Team_List() );
