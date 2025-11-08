<?php
namespace ZupetCore\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Adoption_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'adoption-box';
	}

	public function get_title() {
		return __( 'Adoption Box', 'zupetcore' );
	}

	public function get_icon() {
		return 'zupet-icon';
	}

	public function get_categories() {
		return [ 'zupetcore' ];
	}

	public function get_script_depends() {
		return [ 'zupetcore' ];
	}

	protected function register_controls() {
		/**
         * Layout Section
         */
        $this->start_controls_section(
            'zupet_layout',
            [
                'label' => esc_html__('Design Layout', 'zupetcore'),
            ]
        );
        $this->add_control(
            'zupet_design_style',
            [
                'label' => esc_html__('Select Layout', 'zupetcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'zupetcore'),
                    'layout-2' => esc_html__('Layout 2', 'zupetcore'),
                    'layout-3' => esc_html__('Layout 3', 'zupetcore'),
                    'layout-4' => esc_html__('Layout 4', 'zupetcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
		
		$this->start_controls_section(
            'image_section',
            [
                'label' => __( 'Image', 'zupetcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'text_section',
			[
				'label' => esc_html__( 'Text', 'zupetcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'name',
			[
				'label' => esc_html__( 'Name', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Tommy', 'zupetcore' ),
				'placeholder' => esc_html__( 'Type name here', 'zupetcore' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'designation',
			[
				'label' => esc_html__( 'Designation', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Cocker Spaniel', 'zupetcore' ),
				'placeholder' => esc_html__( 'Type designation here', 'zupetcore' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Meet Tommy, a loving and playful dog ready for his forever home. With his gentle heart and he’s the perfect companion.', 'zupetcore' ),
				'placeholder' => esc_html__( 'Type description here', 'zupetcore' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__( 'Button', 'zupetcore' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_control(
				'button_text',
				[
					'label' => esc_html__( 'Button text', 'zupetcore' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Click Here', 'zupetcore' ),
					'placeholder' => esc_html__( 'Type your text here', 'zupetcore' ),
				]
			);
			$this->add_control(
				'button_link',
				[
					'label' => esc_html__( 'Link', 'zupetcore' ),
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

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'general_style',
			[
				'label' => __( 'General', 'zupetcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .adoption-box',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'zupetcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .adoption-box .name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .adoption-box .name',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'zupetcore' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .adoption-box .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render the widget ouzupetut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();?>

		<?php if ( $settings['zupet_design_style']  == 'layout-1' ):
			if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
                $image_alt = get_post_meta($settings["image"]["id"], "_wp_attachment_image_alt", true);
            }
			?>

			<div class="adoption-box style-one">
				<div class="image">
					<div class="img-wrap">
						<img class="wow slideInLeft" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
					</div>
				</div>
				<div class="content">
					<?php if(!empty($settings['name'])) : ?>
						<h4 class="name"><?php echo $settings['name']; ?></h4>
					<?php endif; ?>
					<?php if(!empty($settings['designation'])) : ?>
						<p class="designation"><?php echo $settings['designation']; ?></p>
					<?php endif; ?>
					<?php if(!empty($settings['description'])) : ?>
						<p class="description"><?php echo $settings['description']; ?></p>
					<?php endif; ?>
					<?php if(!empty($settings['button_text'])) : ?>
						<a class="button" href="<?php echo esc_url($settings['button_link']['url']); ?>">
							<?php echo $settings['button_text']; ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

		<?php elseif ( $settings['zupet_design_style']  == 'layout-2' ):
			if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
                $image_alt = get_post_meta($settings["image"]["id"], "_wp_attachment_image_alt", true);
            }
			?>

			<div class="adoption-box style-two">
				<div class="image">
					<div class="img-wrap">
						<img class="wow slideInRight" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
					</div>
				</div>
				<div class="content">
					<?php if(!empty($settings['name'])) : ?>
						<h4 class="name"><?php echo $settings['name']; ?></h4>
					<?php endif; ?>
					<?php if(!empty($settings['designation'])) : ?>
						<p class="designation"><?php echo $settings['designation']; ?></p>
					<?php endif; ?>
					<?php if(!empty($settings['description'])) : ?>
						<p class="description"><?php echo $settings['description']; ?></p>
					<?php endif; ?>
					<?php if(!empty($settings['button_text'])) : ?>
						<a class="button" href="<?php echo esc_url($settings['button_link']['url']); ?>">
							<?php echo $settings['button_text']; ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

		<?php elseif ( $settings['zupet_design_style']  == 'layout-3' ):
			if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
                $image_alt = get_post_meta($settings["image"]["id"], "_wp_attachment_image_alt", true);
            }
			?>
			<div class="adoption-box style-three">
				<div class="image">
					<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
				</div>
				<div class="content">
					<div class="text">
						<?php if(!empty($settings['name'])) : ?>
							<h4 class="name"><?php echo $settings['name']; ?></h4>
						<?php endif; ?>
						<?php if(!empty($settings['designation'])) : ?>
							<p class="designation"><?php echo $settings['designation']; ?></p>
						<?php endif; ?>
					</div>
					<div class="icon">
						<a href="#"><i class="fa-light fa-arrow-up-right"></i></a>
					</div>
				</div>
			</div>
			
		<?php elseif ( $settings['zupet_design_style']  == 'layout-4' ):
			if ( !empty($settings['image']['url']) ) {
                $image = !empty($settings['image']['id']) ? wp_get_attachment_image_url( $settings['image']['id'], '') : $settings['image']['url'];
                $image_alt = get_post_meta($settings["image"]["id"], "_wp_attachment_image_alt", true);
            }
			?>
            
            <div class="adoption-box style-four">
				<div class="image">
					<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
				</div>
				<div class="content">
					<?php if(!empty($settings['name'])) : ?>
						<h4 class="name"><?php echo $settings['name']; ?></h4>
					<?php endif; ?>
					<?php if(!empty($settings['designation'])) : ?>
						<p class="designation"><?php echo $settings['designation']; ?></p>
					<?php endif; ?>
					<?php if(!empty($settings['description'])) : ?>
						<p class="description"><?php echo $settings['description']; ?></p>
					<?php endif; ?>
					<?php if(!empty($settings['button_text'])) : ?>
						<a class="button" href="<?php echo esc_url($settings['button_link']['url']); ?>">
							<?php echo $settings['button_text']; ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
			
		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Adoption_Box() );