<?php

namespace ProvixCore\Widgets;

if (! defined('ABSPATH')) exit;
/**
 * Provix Core
 *
 * Elementor widget for heading.
 *
 * @since 1.0.0
 */
class Provix_Tabs extends \Elementor\Widget_Base {

	public function get_name()
	{
		return 'provix-tabs';
	}

	public function get_title()
	{
		return __('Tabs', 'agenvix-core');
	}

	public function get_icon()
	{
		return 'provix-icon';
	}

	public function get_categories()
	{
		return ['agenvix-core'];
	}

	public function get_script_depends()
	{
		return ['agenvix-core'];
	}

	protected function register_controls()
	{

		/**
		 * Layout section
		 */

		$this->start_controls_section(
			'provix_layout',
			[
				'label' => esc_html__('Design Layout', 'agenvix-core'),
			]
		);
		$this->add_control(
			'provix_design_style',
			[
				'label' => esc_html__('Select Layout', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
					'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		/**
		 * Title and content section
		 */
		$this->start_controls_section(
			'tab_list',
			[
				'label' => esc_html__('Tab List', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_image',
			[
				'label' => esc_html__( 'Choose Image', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'list_title',
			[
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_content',
			[
				'label' => esc_html__( 'Content', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'List Content' , 'agenvix-core' ),
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here' , 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Button Link', 'agenvix-core' ),
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
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'agenvix-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'agenvix-core' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'agenvix-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'agenvix-core' ),
					],
					[
						'list_title' => esc_html__( 'Title #3', 'agenvix-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'agenvix-core' ),
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
			'general_section',
			[
				'label' => esc_html__('General', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_alignment',
			[
				'label' => esc_html__('Alignment', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Left', 'agenvix-core'),
					'center'  => esc_html__('Center', 'agenvix-core'),
					'right' => esc_html__('Right', 'agenvix-core'),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'nav_button_style',
			[
				'label' => esc_html__('Nav Button', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'selector' => '{{WRAPPER}} .provix-tabs .nav-tabs .nav-link',
				]
			);
			$this->add_responsive_control(
				'button_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .provix-tabs .nav-tabs .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'button_number',
				[
					'label'     => esc_html__( 'Button Number', 'agenvix-core' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'button_number_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .provix-tabs .nav-tabs .nav-link span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'tab_content_style',
			[
				'label' => esc_html__('Tab Content', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'tab_content_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .provix-tabs .service-two-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'content_image',
				[
					'label'     => esc_html__( 'Image', 'agenvix-core' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'image_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .provix-tabs .service-two-container-left img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$widget_id = $this->get_id(); // ensures unique tab IDs

		?>

		<?php if ($settings['provix_design_style']  == 'layout-1'): ?>

		<div class="provix-tabs style-one">
			<nav>
				<div class="nav nav-tabs" id="nav-tab-<?php echo esc_attr( $widget_id ); ?>" role="tablist">

					<?php foreach ( $settings['list'] as $index => $item ) :
						$tab_count   = str_pad( $index + 1, 2, '0', STR_PAD_LEFT );
						$is_active   = ( $index === 0 ) ? 'active' : '';
						$is_selected = ( $index === 0 ) ? 'true' : 'false';

						$tab_id      = 'nav-tab-' . $widget_id . '-' . $index;
						$pane_id     = 'nav-pane-' . $widget_id . '-' . $index;
					?>
						<button
							class="nav-link <?php echo esc_attr( $is_active ); ?>"
							id="<?php echo esc_attr( $tab_id ); ?>"
							data-bs-toggle="tab"
							data-bs-target="#<?php echo esc_attr( $pane_id ); ?>"
							type="button"
							role="tab"
							aria-controls="<?php echo esc_attr( $pane_id ); ?>"
							aria-selected="<?php echo esc_attr( $is_selected ); ?>"
						>
							<span><?php echo esc_html( $tab_count ); ?></span>
							<?php echo esc_html( $item['list_title'] ); ?>
						</button>
					<?php endforeach; ?>

				</div>
			</nav>

			<div class="tab-content" id="nav-tabContent-<?php echo esc_attr( $widget_id ); ?>">

				<?php foreach ( $settings['list'] as $index => $item ) :
					$tab_count = str_pad( $index + 1, 2, '0', STR_PAD_LEFT );
					$is_active = ( $index === 0 ) ? 'show active' : '';

					$tab_id  = 'nav-tab-' . $widget_id . '-' . $index;
					$pane_id = 'nav-pane-' . $widget_id . '-' . $index;
				?>

					<div
						class="tab-pane fade <?php echo esc_attr( $is_active ); ?>"
						id="<?php echo esc_attr( $pane_id ); ?>"
						role="tabpanel"
						aria-labelledby="<?php echo esc_attr( $tab_id ); ?>"
					>
						<div class="service-two-container">

							<?php if ( ! empty( $item['list_image']['url'] ) ) : ?>
								<div class="service-two-container-left">
									<img src="<?php echo esc_url( $item['list_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['list_title'] ); ?>">
								</div>
							<?php endif; ?>

							<div class="service-two-container-content">
								<h6 class="service-two-content-number">
									<?php echo esc_html( $tab_count ); ?>
								</h6>

								<h3 class="title"><?php echo esc_html( $item['list_title'] ); ?></h3>

								<div class="service-two-content-text">
									<?php echo wp_kses_post( $item['list_content'] ); ?>
								</div>

								<?php if ( ! empty( $item['button_text'] ) && ! empty( $item['button_link']['url'] ) ) :
									$this->add_link_attributes( 'button_link_' . $index, $item['button_link'] );
								?>
									<div class="service-two-btn">
										<a <?php echo $this->get_render_attribute_string( 'button_link_' . $index ); ?> class="button">
											<?php echo esc_html( $item['button_text'] ); ?>
											<div class="btn-icon">
												<span class="icon-first"><i class="fa-light fa-arrow-right"></i></span>
												<span class="icon-second"><i class="fa-light fa-arrow-right"></i></span>
											</div>
										</a>
									</div>
								<?php endif; ?>

							</div>
						</div>
					</div>

				<?php endforeach; ?>

			</div>
		</div>

		<?php elseif ($settings['provix_design_style']  == 'layout-2'): ?>

			<div class="section-subtitle style-one <?php echo $settings['text_alignment']; ?>">
				<h2 class="subtitle">
					<span><?php echo $settings['provix_subtitle']; ?></span>
				</h2>
			</div>

		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new Provix_Tabs());
