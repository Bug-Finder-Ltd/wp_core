<?php

namespace ProvixCore\Widgets;

if (! defined('ABSPATH')) exit;

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Navigation_Menu extends \Elementor\Widget_Base {

	public function get_name() {
		return 'navigation-menu';
	}

	public function get_title() {
		return __('Navigation Menu', 'agenvix-core');
	}

	public function get_icon() {
		return 'provix-icon';
	}

	public function get_categories() {
		return ['agenvix-core'];
	}

	public function get_script_depends() {
		return ['agenvix-core'];
	}

	private function get_available_menus() {

		$menus = wp_get_nav_menus();
		$options = [
			'' => esc_html__( 'Default Menu', 'agenvix-core' ),
			'landing_menu' => esc_html__( 'Landing Menu', 'agenvix-core' )
		];

		if ( ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				$options[ $menu->slug ] = $menu->name;
			}
		}

		return $options;
	}

	protected function register_controls() {

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
					'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
					'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
					'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
					'layout-4' => esc_html__( 'Layout 4', 'agenvix-core' ),
					'layout-5' => esc_html__( 'Layout 5', 'agenvix-core' ),
				],
				'default' => 'layout-1',
			]
		);
		$this->add_control(
			'choose_menu',
			[
				'label' => esc_html__( 'Select Menu', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $this->get_available_menus(),
				'default' => '',
				'label_block' => true,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'section_name',
			[
				'label' => esc_html__( 'Section Name', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Home' , 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'section_link',
			[
				'label' => esc_html__( 'Section Link', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#home',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'menu_items',
			[
				'label' => esc_html__( 'Landing Menu Items', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'section_name' => esc_html__( 'Home', 'agenvix-core' ),
						'section_link' => [
							'url' => '#home',
						],
					],
					[
						'section_name' => esc_html__( 'About', 'agenvix-core' ),
						'section_link' => [
							'url' => '#about',
						],
					],
					[
						'section_name' => esc_html__( 'Services', 'agenvix-core' ),
						'section_link' => [
							'url' => '#services',
						],
					],
				],
				'title_field' => '{{{ section_name }}}',
				'condition' => [
					'choose_menu' => 'landing_menu',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'topbar_section',
			[
				'label' => esc_html__( 'Topbar', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'topbar_phone',
			[
				'label' => esc_html__( 'Phone', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '+88 012 (3456) 7890', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your phone number', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'topbar_email',
			[
				'label' => esc_html__( 'Email', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'example@gmail.com', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your email address', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'social_title',
			[
				'label' => esc_html__( 'Social Title', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Follow Us:', 'agenvix-core' ),
				'placeholder' => esc_html__( 'Type your title', 'agenvix-core' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' => esc_html__( 'Icon', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
			]
		);
		$repeater->add_control(
			'social_name',
			[
				'label' => esc_html__( 'Name', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Facebook' , 'agenvix-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'social_link',
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
		$this->add_control(
			'social_list',
			[
				'label' => esc_html__( 'Social List', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_name' => esc_html__( 'Facebook', 'agenvix-core' ),
					],
					[
						'social_name' => esc_html__( 'Linkedin', 'agenvix-core' ),
					],
				],
				'title_field' => '{{{ social_name }}}',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'logo_section',
			[
				'label' => esc_html__('Logo', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'site_logo',
			[
				'label' => esc_html__( 'Main Logo', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'sticky_logo',
			[
				'label' => esc_html__( 'Sticky Logo', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'mobile_logo',
			[
				'label' => esc_html__( 'Mobile Menu Logo', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'logo_link',
			[
				'label' => esc_html__( 'Link', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '/',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__('Button', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Text', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Click Here', 'agenvix-core'),
				'placeholder' => esc_html__('Type your text here', 'agenvix-core'),
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__('Link', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
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

		$this->start_controls_section(
			'offcanvas_section',
			[
				'label' => esc_html__('Offcanvas', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'list_icon',
				[
					'label' => esc_html__( 'Icon', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-circle',
						'library' => 'fa-solid',
					],
				]
			);
			$repeater->add_control(
				'list_title',
				[
					'label' => esc_html__( 'Title', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Default title', 'agenvix-core' ),
					'placeholder' => esc_html__( 'Type your title here', 'agenvix-core' ),
				]
			);
			$repeater->add_control(
				'list_content',
				[
					'label' => esc_html__( 'Description', 'agenvix-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 6,
					'default' => esc_html__( 'Default description', 'agenvix-core' ),
					'placeholder' => esc_html__( 'Type your description here', 'agenvix-core' ),
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
					],
					'title_field' => '{{{ list_title }}}',
				]
			);


		$this->end_controls_section();

		/*============
		 Style
        ==============*/

		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__('General', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'menu_alignment',
			[
				'label' => esc_html__('Alignment', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'agenvix-core'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'agenvix-core'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'agenvix-core'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .navigation-menu' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'menu_items_style',
			[
				'label' => esc_html__('Menu Items', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'items_style_tabs'
		);

			$this->start_controls_tab(
				'items_style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'agenvix-core' ),
				]
			);

			$this->add_control(
				'item_color',
				[
					'label' => esc_html__('Color', 'agenvix-core'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .navigation-menu .navigation > li > a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .site-header .main-menu .navigation > li > a' => 'color: {{VALUE}}',
						'{{WRAPPER}} .navigation-menu .navigation li.dropdown .dropdown-btn' => 'color: {{VALUE}}',
						'{{WRAPPER}} .site-header .main-menu .navigation li.dropdown .dropdown-btn' => 'color: {{VALUE}}',
						'{{WRAPPER}} .site-header .main-menu .navigation > li > a::before' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'items_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'agenvix-core' ),
				]
			);

			$this->add_control(
				'item_hover_color',
				[
					'label' => esc_html__('Color', 'agenvix-core'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .navigation-menu .navigation > li > a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .site-header .main-menu .navigation > li > a:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->add_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .navigation-menu .navigation > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .site-header .main-menu .navigation > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'menu_btn_style',
			[
				'label' => esc_html__('Button', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'style_tabs'
		);
		
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'agenvix-core' ),
			]
		);
		
            $this->add_control(
                'btn_color',
                [
                    'label' => esc_html__( 'Text Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header .btn-area .menu-button' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'btn_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .site-header .btn-area .menu-button',
                ]
            );
		
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);
		
            $this->add_control(
                'btn_hover_color',
                [
                    'label' => esc_html__( 'Text Color', 'agenvix-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .site-header .btn-area .menu-button:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'btn_hover_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .site-header .btn-area .menu-button:hover',
                ]
            );
            
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .site-header .btn-area .menu-button',
			]
		);
		
		$this->add_control(
			'btn_seperator_color',
			[
				'label' => esc_html__( 'Seperator Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .site-header .btn-area .seperator' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_overlay_color',
			[
				'label' => esc_html__( 'Overlay Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .site-header .btn-area .menu-button::before' => 'border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .site-header .btn-area .menu-button::after' => 'border-top-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'sticky_menu_style',
			[
				'label' => esc_html__('Sticky Menu', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'sticky_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sticky-header',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'offcanvas_btn_style',
			[
				'label' => esc_html__('Offcanvas Toggle', 'agenvix-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'offcanvas_btn_color',
			[
				'label' => esc_html__('Color', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .site-header .btn-area .sidebar-toggle' => 'color: {{VALUE}}',
					'{{WRAPPER}} .site-header .btn-area .sidebar-toggle svg' => 'fill: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'offcanvas_btn_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .site-header .btn-area .sidebar-toggle',
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
		?>

		<?php
		if ( $settings['provix_design_style']  == 'layout-1' ) :
			if (! empty($settings['site_logo']['url'])) {
				$logo     = ! empty($settings['site_logo']['id']) ? wp_get_attachment_image_url($settings['site_logo']['id'], '') : $settings['site_logo']['url'];
				$logo_alt = get_post_meta($settings['site_logo']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['sticky_logo']['url'])) {
				$sticky_logo     = ! empty($settings['sticky_logo']['id']) ? wp_get_attachment_image_url($settings['sticky_logo']['id'], '') : $settings['sticky_logo']['url'];
				$sticky_logo_alt = get_post_meta($settings['sticky_logo']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['mobile_logo']['url'])) {
				$mobile_logo     = ! empty($settings['mobile_logo']['id']) ? wp_get_attachment_image_url($settings['mobile_logo']['id'], '') : $settings['mobile_logo']['url'];
				$mobile_logo_alt = get_post_meta($settings['mobile_logo']['id'], '_wp_attachment_image_alt', true);
			}
			?>

			<header class="main-header site-header style-1 header-transparent">
				<!-- Header Lower -->
				<div class="header-wrapper">
					<div class="container">
						<div class="inner-container d-flex align-items-center justify-content-between">
							<div class="left-column">
								<div class="logo-box">
									<div class="logo">
										<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
											<img src="<?php echo esc_url($logo); ?>" alt="logo">
										</a>
									</div>
								</div>
							</div>

							<div class="header-right-column d-flex align-items-center">
								<div class="nav-outer">
									<div class="mobile-nav-toggler"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/icon-bar-two.png' ); ?>" alt="icon"></div>
									<nav class="main-menu navbar-expand-md navbar-light">
										<div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
											
										<?php
										$menu_type = $settings['choose_menu'];

										if ( $menu_type === 'landing_menu' ) {
											if ( ! empty( $settings['menu_items'] ) ) {
												echo '<ul class="navigation">';
												foreach ( $settings['menu_items'] as $item ) {

													$link = $item['section_link']['url'];

													echo '<li>';
													echo '<a href="' . esc_url( $link ) . '">';
													echo esc_html( $item['section_name'] );
													echo '</a>';
													echo '</li>';

												}
												echo '</ul>';
											}
										} elseif ( ! empty( $menu_type ) ) {
											agenvix_header_menu( $menu_type );
										} else {
											agenvix_header_menu();
										}
										?>

										</div>
									</nav>
								</div>
								<div class="header-right-btn-area">
									<?php if ( class_exists( 'WooCommerce' ) ) : ?>
										<div class="menu-cart">
											<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-icon">
												<i class="fa-light fa-cart-shopping"></i>
												<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
											</a>
										</div>
									<?php endif; ?>

									
										<div class="btn-group aa">
											<a class="btn-el btn-circle" href="<?php echo esc_url($settings['button_link']['url']) ?>">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
													<path d="M31,0H15V2H28.59L.29,30.29l1.41,1.41L30,3.41V16h2V1A1,1,0,0,0,31,0Z"></path>
												</svg>
											</a>
											<a class="btn-el btn-primary" href="<?php echo esc_url($settings['button_link']['url']) ?>">
												<?php echo $settings['button_text']; ?>
											</a>
											<a class="btn-el btn-circle" href="<?php echo esc_url($settings['button_link']['url']) ?>">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
													<path d="M31,0H15V2H28.59L.29,30.29l1.41,1.41L30,3.41V16h2V1A1,1,0,0,0,31,0Z"></path>
												</svg>
											</a>
										</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Header Lower -->

				<!-- sticky header -->
				<div class="sticky-header">
					<div class="header-upper">
						<div class="container">
							<div class="inner-container d-flex align-items-center justify-content-between">
								<div class="left-column d-flex align-items-center">
									<div class="logo-box">
										<div class="logo">
											<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
												<img src="<?php echo esc_url($sticky_logo); ?>" alt="logo">
											</a>
										</div>
									</div>
								</div>
								<div class="nav-outer">
									<div class="mobile-nav-toggler">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/icon-bar-two.png' ); ?>" alt="icon">
									</div>
									<nav class="main-menu navbar-expand-md navbar-light"></nav>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- sticky header -->

				<!-- mobile menu -->
				<div class="mobile-menu">
					<div class="menu-backdrop"></div>
					<div class="close-btn">
						<span class="fal fa-times"></span>
					</div>
					<nav class="menu-box">
						<div class="nav-logo">
							<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
								<img src="<?php echo esc_url($mobile_logo); ?>" alt="logo">
							</a>
						</div>
						<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
						<div class="header-right-btn-area">
							<?php if ( !empty($settings['button_text']) ) : ?>
								<div class="sign-up">
									<a href="<?php esc_url($settings['button_link']['url']) ?>" class="menu-button">
										<?php echo $settings['button_text']; ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</nav>
				</div>
			</header>

		<?php elseif ( $settings['provix_design_style']  == 'layout-2' ) :
			if (! empty($settings['site_logo']['url'])) {
				$logo     = ! empty($settings['site_logo']['id']) ? wp_get_attachment_image_url($settings['site_logo']['id'], '') : $settings['site_logo']['url'];
				$logo_alt = get_post_meta($settings['site_logo']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['sticky_logo']['url'])) {
				$sticky_logo     = ! empty($settings['sticky_logo']['id']) ? wp_get_attachment_image_url($settings['sticky_logo']['id'], '') : $settings['sticky_logo']['url'];
				$sticky_logo_alt = get_post_meta($settings['sticky_logo']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['mobile_logo']['url'])) {
				$mobile_logo     = ! empty($settings['mobile_logo']['id']) ? wp_get_attachment_image_url($settings['mobile_logo']['id'], '') : $settings['mobile_logo']['url'];
				$mobile_logo_alt = get_post_meta($settings['mobile_logo']['id'], '_wp_attachment_image_alt', true);
			}
			?>

			<header class="main-header site-header style-2 header-transparent">
				<!-- Header Lower -->
				<div class="header-wrapper">
					<div class="container">
					<div class="inner-container d-flex align-items-center justify-content-between">
						<div class="left-column">
							<div class="logo-box">
								<div class="logo">
									<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
										<img src="<?php echo esc_url($logo); ?>" alt="logo">
									</a>
								</div>
							</div>
						</div>
						<div class="header-right-column d-flex align-items-center">
							<div class="nav-outer">
								<div class="mobile-nav-toggler"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/icon-bar-two.png' ); ?>" alt="icon"></div>
								<nav class="main-menu navbar-expand-md navbar-light">
								<div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
									<?php
										$menu_type = $settings['choose_menu'];

										if ( $menu_type === 'landing_menu' ) {
											if ( ! empty( $settings['menu_items'] ) ) {
												echo '<ul class="navigation">';
												foreach ( $settings['menu_items'] as $item ) {

													$link = $item['section_link']['url'];

													echo '<li>';
													echo '<a href="' . esc_url( $link ) . '">';
													echo esc_html( $item['section_name'] );
													echo '</a>';
													echo '</li>';

												}
												echo '</ul>';
											}
										} elseif ( ! empty( $menu_type ) ) {
											agenvix_header_menu( $menu_type );
										} else {
											agenvix_header_menu();
										}
									?>
								</div>
								</nav>
							</div>
							<div class="btn-area">
								<?php if ( class_exists( 'WooCommerce' ) ) : ?>
									<div class="menu-cart">
										<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-icon">
											<i class="fa-light fa-cart-shopping"></i>
											<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
										</a>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $settings['button_text'] ) ) : ?>
									<a href="tel:<?php echo esc_html( preg_replace( '/[^A-Za-z0-9\+]/', '', $settings['button_text'] ) ); ?>" class="menu-button">
										<i class="fa-light fa-phone-arrow-up-right"></i>
										<span class="button-text">
											<span class="main-text"><?php echo $settings['button_text']; ?></span>
											<span class="hover-text"><?php echo $settings['button_text']; ?></span>
										</span>
									</a>
								<?php endif; ?>

								<div class="sidebar-toggle nd-offcanvas-toggle"  data-target="#ndOffcanvas">
									<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-x-diamond" viewBox="0 0 16 16">
										<path d="M7.987 16a1.53 1.53 0 0 1-1.07-.448L.45 9.082a1.53 1.53 0 0 1 0-2.165L6.917.45a1.53 1.53 0 0 1 2.166 0l6.469 6.468A1.53 1.53 0 0 1 16 8.013a1.53 1.53 0 0 1-.448 1.07l-6.47 6.469A1.53 1.53 0 0 1 7.988 16zM7.639 1.17 4.766 4.044 8 7.278l3.234-3.234L8.361 1.17a.51.51 0 0 0-.722 0M8.722 8l3.234 3.234 2.873-2.873c.2-.2.2-.523 0-.722l-2.873-2.873zM8 8.722l-3.234 3.234 2.873 2.873c.2.2.523.2.722 0l2.873-2.873zM7.278 8 4.044 4.766 1.17 7.639a.51.51 0 0 0 0 .722l2.874 2.873z"/>
									</svg>
								</div>

							</div>
						</div>
					</div>
					</div>
				</div>
				<!-- Header Lower -->

				<!-- sticky header -->
				<div class="sticky-header">
					<div class="header-upper">
					<div class="container">
						<div class="inner-container d-flex align-items-center justify-content-between">
							<div class="left-column d-flex align-items-center">
								<div class="logo-box">
									<div class="logo">
										<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
											<img src="<?php echo esc_url($sticky_logo); ?>" alt="logo">
										</a>
									</div>
								</div>
							</div>
							<div class="nav-outer">
								<div class="mobile-nav-toggler">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/icon-bar-two.png' ); ?>" alt="icon">
								</div>
								<nav class="main-menu navbar-expand-md navbar-light"></nav>
							</div>
						</div>
					</div>
					</div>
				</div>
				<!-- sticky header -->

				<!-- mobile menu -->
				<div class="mobile-menu">
					<div class="menu-backdrop"></div>
					<div class="close-btn">
						<span class="fal fa-times"></span>
					</div>
					<nav class="menu-box">
						<div class="nav-logo">
							<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
								<img src="<?php echo esc_url($mobile_logo); ?>" alt="logo">
							</a>
						</div>
						<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
						<!-- <div class="header-right-btn-area"> -->
						<div class="btn-area">
							<?php if ( class_exists( 'WooCommerce' ) ) : ?>
								<div class="menu-cart">
									<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-icon">
									<i class="fa-light fa-cart-shopping"></i>
									<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
									</a>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $settings['button_text'] ) ) : ?>
								<a href="<?php echo esc_html( preg_replace( '/[^A-Za-z0-9\+]/', '', $settings['button_text'] ) ); ?>" class="menu-button">
									<i class="fa-light fa-phone-arrow-up-right"></i>
									<span class="button-text">
										<span class="main-text"><?php echo $settings['button_text']; ?></span>
										<span class="hover-text"><?php echo $settings['button_text']; ?></span>
									</span>
								</a>
							<?php endif; ?>
						</div>
					</nav>
				</div>

			</header>

			<!-- Offcanvas -->

			<div class="nd-offcanvas-backdrop"></div>

			<div id="ndOffcanvas" class="nd-offcanvas nd-offcanvas-right">
				<div class="offcanvas-header">
					<div class="logo">
						<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
							<img src="<?php echo esc_url($logo); ?>" alt="logo">
						</a>
					</div>
					<button class="nd-offcanvas-close">&times;</button>
				</div>
				<div class="offcanvas-body">
					<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
					<div class="contact-info">
						<?php foreach (  $settings['list'] as $item ) : ?>
							<div class="info-box">
								<div class="icon">
									<?php \Elementor\Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</div>
								<div class="content">
									<p class="title"><?php echo esc_html( $item['list_title'] ); ?></p>
									<h6><?php echo esc_html( $item['list_content'] ); ?></h6>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style'] == 'layout-3' ) :
			if (! empty($settings['site_logo']['url'])) {
				$logo     = ! empty($settings['site_logo']['id']) ? wp_get_attachment_image_url($settings['site_logo']['id'], '') : $settings['site_logo']['url'];
				$logo_alt = get_post_meta($settings['site_logo']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['sticky_logo']['url'])) {
				$sticky_logo     = ! empty($settings['sticky_logo']['id']) ? wp_get_attachment_image_url($settings['sticky_logo']['id'], '') : $settings['sticky_logo']['url'];
				$sticky_logo_alt = get_post_meta($settings['sticky_logo']['id'], '_wp_attachment_image_alt', true);
			}
			?>

			<header class="main-header site-header style-3 header-transparent">
                <div class="container">
				<div class="topbar">
					<div class="row">
						<div class="col-md-6">
							<div class="left-column">
								<?php if ( ! empty( $settings['topbar_phone'] ) ) : ?>
									<a href="tel:<?php echo esc_html( preg_replace( '/[^A-Za-z0-9\+]/', '', $settings['topbar_phone'] ) ); ?>">
										<i class="fa-light fa-phone"></i>
										<?php echo $settings['topbar_phone']; ?>
									</a>
								<?php endif; ?>

								<?php if ( ! empty( $settings['topbar_email'] ) ) : ?>
									<a href="mailto:<?php echo esc_html( $settings['topbar_email'] ); ?>">
										<i class="fa-light fa-envelope"></i>
										<?php echo esc_html( $settings['topbar_email'] ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<?php if ( $settings['social_list'] ) : ?>
								<div class="right-column">
									<p><?php echo $settings['social_title']; ?></p>
									<?php foreach (  $settings['social_list'] as $item ) : ?>
										<a href="<?php echo esc_url( $item['social_link']['url'] ); ?>">
											<?php \Elementor\Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
										</a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				</div>
				
				<!-- Header Lower -->

				<div class="header-wrapper">
					<div class="container">
					<div class="menu-wrap">
						<div class="inner-container d-flex align-items-center justify-content-between">
							<div class="left-column">
								<div class="logo-box">
									<div class="logo">
										<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
											<img src="<?php echo esc_url($logo); ?>" alt="logo">
										</a>
									</div>
								</div>
							</div>

							<div class="header-right-column d-flex align-items-center">
								<div class="nav-outer">
									<div class="mobile-nav-toggler"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/icon-bar-two.png' ); ?>" alt="icon"></div>
									<nav class="main-menu navbar-expand-md navbar-light">
										<div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
											
										<?php
										$menu_type = $settings['choose_menu'];

										if ( $menu_type === 'landing_menu' ) {
											if ( ! empty( $settings['menu_items'] ) ) {
												echo '<ul class="navigation">';
												foreach ( $settings['menu_items'] as $item ) {

													$link = $item['section_link']['url'];

													echo '<li>';
													echo '<a href="' . esc_url( $link ) . '">';
													echo esc_html( $item['section_name'] );
													echo '</a>';
													echo '</li>';

												}
												echo '</ul>';
											}
										} elseif ( ! empty( $menu_type ) ) {
											agenvix_header_menu( $menu_type );
										} else {
											agenvix_header_menu();
										}
										?>

										</div>
									</nav>
								</div>
								<div class="header-right-btn-area">
									<div class="sidebar-toggle nd-offcanvas-toggle"  data-target="#ndOffcanvas">
										<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-x-diamond" viewBox="0 0 16 16">
											<path d="M7.987 16a1.53 1.53 0 0 1-1.07-.448L.45 9.082a1.53 1.53 0 0 1 0-2.165L6.917.45a1.53 1.53 0 0 1 2.166 0l6.469 6.468A1.53 1.53 0 0 1 16 8.013a1.53 1.53 0 0 1-.448 1.07l-6.47 6.469A1.53 1.53 0 0 1 7.988 16zM7.639 1.17 4.766 4.044 8 7.278l3.234-3.234L8.361 1.17a.51.51 0 0 0-.722 0M8.722 8l3.234 3.234 2.873-2.873c.2-.2.2-.523 0-.722l-2.873-2.873zM8 8.722l-3.234 3.234 2.873 2.873c.2.2.523.2.722 0l2.873-2.873zM7.278 8 4.044 4.766 1.17 7.639a.51.51 0 0 0 0 .722l2.874 2.873z"/>
										</svg>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
				<!-- Header Lower -->

				<!-- sticky header -->
				<div class="sticky-header">
					<div class="header-upper">
					<div class="container">
						<div class="inner-container d-flex align-items-center justify-content-between">
							<div class="left-column d-flex align-items-center">
								<div class="logo-box">
								<div class="logo">
									<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
										<img src="<?php echo esc_url($sticky_logo); ?>" alt="logo">
									</a>
								</div>
								</div>
							</div>
							<div class="nav-outer">
								<div class="mobile-nav-toggler">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/icon-bar-two.png' ); ?>" alt="icon">
								</div>
								<nav class="main-menu navbar-expand-md navbar-light"></nav>
							</div>
						</div>
					</div>
					</div>
				</div>
				<!-- sticky header -->

				<!-- mobile menu -->
				<div class="mobile-menu">
					<div class="menu-backdrop"></div>
					<div class="close-btn">
						<span class="fal fa-times"></span>
					</div>
					<nav class="menu-box">
						<div class="nav-logo">
							<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
								<img src="<?php echo esc_url($logo); ?>" alt="logo">
							</a>
						</div>
						<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
					</nav>
				</div>
			</header>

			<!-- Offcanvas -->

			<div class="nd-offcanvas-backdrop"></div>

			<div id="ndOffcanvas" class="nd-offcanvas nd-offcanvas-right">
				<div class="offcanvas-header">
					<div class="logo">
						<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
							<img src="<?php echo esc_url($logo); ?>" alt="logo">
						</a>
					</div>
					<button class="nd-offcanvas-close">
						<span>&times;</span>
					</button>
				</div>
				<div class="offcanvas-body">
					<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
					<div class="contact-info">
						<?php foreach (  $settings['list'] as $item ) : ?>
							<div class="info-box">
								<div class="icon">
									<?php \Elementor\Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</div>
								<div class="content">
									<p class="title"><?php echo esc_html( $item['list_title'] ); ?></p>
									<h6><?php echo esc_html( $item['list_content'] ); ?></h6>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-4' ) :
			if (! empty($settings['site_logo']['url'])) {
				$logo     = ! empty($settings['site_logo']['id']) ? wp_get_attachment_image_url($settings['site_logo']['id'], '') : $settings['site_logo']['url'];
				$logo_alt = get_post_meta($settings['site_logo']['id'], '_wp_attachment_image_alt', true);
			}
			if (! empty($settings['sticky_logo']['url'])) {
				$sticky_logo     = ! empty($settings['sticky_logo']['id']) ? wp_get_attachment_image_url($settings['sticky_logo']['id'], '') : $settings['sticky_logo']['url'];
				$sticky_logo_alt = get_post_meta($settings['sticky_logo']['id'], '_wp_attachment_image_alt', true);
			}
			?>

			<!-- header -->
			<header class="main-header site-header style-4 header-transparent">

				<!-- Header Lower -->
				<div class="header-wrapper">
					<div class="inner-container d-flex align-items-center justify-content-between">
						<div class="left-column">
							<div class="logo-box">
								<div class="logo">
									<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
										<img src="<?php echo esc_url($logo); ?>" alt="logo">
									</a>
								</div>
							</div>
						</div>
						<div class="center-column">
							<div class="nav-outer">
								<div class="mobile-nav-toggler"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/icon-bar-two.png' ); ?>" alt="icon"></div>
								<nav class="main-menu navbar-expand-md navbar-light">
									<div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">

										<?php
										$menu_type = $settings['choose_menu'];

										if ( $menu_type === 'landing_menu' ) {
											if ( ! empty( $settings['menu_items'] ) ) {
												echo '<ul class="navigation">';
												foreach ( $settings['menu_items'] as $item ) {

													$link = $item['section_link']['url'];

													echo '<li>';
													echo '<a href="' . esc_url( $link ) . '">';
													echo esc_html( $item['section_name'] );
													echo '</a>';
													echo '</li>';

												}
												echo '</ul>';
											}
										} elseif ( ! empty( $menu_type ) ) {
											agenvix_header_menu( $menu_type );
										} else {
											agenvix_header_menu();
										}
										?>

									</div>
								</nav>
							</div>
						</div>
						<div class="right-column">
							<div class="btn-area">
								<?php if ( ! empty( $settings['button_text'] ) ) : ?>
									<a href="<?php echo esc_url($settings['button_link']['url']) ?>" class="menu-button">
										<?php echo $settings['button_text']; ?>
									</a>
									<div class="seperator"></div>
								<?php endif; ?>

								<div class="sidebar-toggle nd-offcanvas-toggle"  data-target="#ndOffcanvas">
									<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-x-diamond" viewBox="0 0 16 16">
										<path d="M7.987 16a1.53 1.53 0 0 1-1.07-.448L.45 9.082a1.53 1.53 0 0 1 0-2.165L6.917.45a1.53 1.53 0 0 1 2.166 0l6.469 6.468A1.53 1.53 0 0 1 16 8.013a1.53 1.53 0 0 1-.448 1.07l-6.47 6.469A1.53 1.53 0 0 1 7.988 16zM7.639 1.17 4.766 4.044 8 7.278l3.234-3.234L8.361 1.17a.51.51 0 0 0-.722 0M8.722 8l3.234 3.234 2.873-2.873c.2-.2.2-.523 0-.722l-2.873-2.873zM8 8.722l-3.234 3.234 2.873 2.873c.2.2.523.2.722 0l2.873-2.873zM7.278 8 4.044 4.766 1.17 7.639a.51.51 0 0 0 0 .722l2.874 2.873z"/>
									</svg>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!-- Header Lower -->
				
				<!-- sticky header -->
				<div class="sticky-header">
					<div class="header-upper">
					<div class="container">
						<div class="inner-container d-flex align-items-center justify-content-between">
							<div class="left-column d-flex align-items-center">
								<div class="logo-box">
								<div class="logo">
									<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
										<img src="<?php echo esc_url($sticky_logo); ?>" alt="logo">
									</a>
								</div>
								</div>
							</div>
							<div class="nav-outer">
								<div class="mobile-nav-toggler">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icons/icon-bar-two.png' ); ?>" alt="icon">
								</div>
								<nav class="main-menu navbar-expand-md navbar-light"></nav>
							</div>
						</div>
					</div>
					</div>
				</div>
				<!-- sticky header -->

				<!-- mobile menu -->
				<div class="mobile-menu">
					<div class="menu-backdrop"></div>
					<div class="close-btn">
						<span class="fal fa-times"></span>
					</div>
					<nav class="menu-box">
						<div class="nav-logo">
							<a href="<?php echo esc_url($settings['logo_link']['url']); ?>">
								<img src="<?php echo esc_url($logo); ?>" alt="logo">
							</a>
						</div>
						<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
						<div class="btn-area">
							<?php if ( class_exists( 'WooCommerce' ) ) : ?>
								<div class="menu-cart">
									<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-icon">
									<i class="fa-light fa-cart-shopping"></i>
									<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
									</a>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $topbar_phone ) ) : ?>
								<a href="<?php echo esc_html( preg_replace( '/[^A-Za-z0-9\+]/', '', $topbar_phone ) ); ?>" class="menu-button">
									<i class="fa-light fa-phone-arrow-up-right"></i>
									<span class="button-text">
										<span class="main-text"><?php echo esc_html( $topbar_phone ); ?></span>
										<span class="hover-text"><?php echo esc_html( $topbar_phone ); ?></span>
									</span>
								</a>
							<?php endif; ?>
						</div>
					</nav>
				</div>
				
                <div class="sticky-sidebar-toggle">
                    <div class="sidebar-toggle nd-offcanvas-toggle"  data-target="#ndOffcanvas">
                        <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23 9.66675H1C0.448 9.66675 0 9.21875 0 8.66675C0 8.11475 0.448 7.66675 1 7.66675H23C23.552 7.66675 24 8.11475 24 8.66675C24 9.21875 23.552 9.66675 23 9.66675ZM23 2H1C0.448 2 0 1.552 0 1C0 0.448 0.448 0 1 0H23C23.552 0 24 0.448 24 1C24 1.552 23.552 2 23 2ZM23 17.3333H1C0.448 17.3333 0 16.8853 0 16.3333C0 15.7812 0.448 15.3333 1 15.3333H23C23.552 15.3333 24 15.7812 24 16.3333C24 16.8853 23.552 17.3333 23 17.3333Z" fill="#181B08"/>
                        </svg>
                    </div>
                </div>
			</header>

			<!-- Offcanvas -->

			<div class="nd-offcanvas-backdrop"></div>

			<div id="ndOffcanvas" class="nd-offcanvas nd-offcanvas-right">
				<div class="offcanvas-header">
					<div class="logo">
						<?php agenvix_header_logo(); ?>
					</div>
					<button class="nd-offcanvas-close">&times;</button>
				</div>
				<div class="offcanvas-body">
					<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
					<div class="contact-info">

						<?php foreach (  $settings['list'] as $item ) : ?>
							<div class="info-box">
								<div class="icon">
									<?php \Elementor\Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</div>
								<div class="content">
									<p class="title"><?php echo esc_html( $item['list_title'] ); ?></p>
									<h6><?php echo esc_html( $item['list_content'] ); ?></h6>
								</div>
							</div>
						<?php endforeach; ?>

						<?php if ( ! empty( $email_address ) ) : ?>
							<div class="info-box">
								<div class="icon">
									<i class="fa-light fa-envelope"></i>
								</div>
								<div class="content">
									<p class="title"><?php echo esc_html( $email_title ); ?></p>
									<h6><?php echo esc_html( $email_address ); ?></h6>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $open_hour_time ) ) : ?>
							<div class="info-box">
								<div class="icon">
									<i class="fa-light fa-alarm-clock"></i>
								</div>
								<div class="content">
									<p class="title"><?php echo esc_html( $open_hour_title ); ?></p>
									<h6><?php echo esc_html( $open_hour_time ); ?></h6>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-5' ) :
			$icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/footprint.png';
			?>

			<div class="single-btn style-five">
				<a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
					<span class="button-text">
						<span class="main-text"><?php echo $settings[ 'button_text' ]; ?></span>
						<span class="hover-text"><?php echo $settings['button_text']; ?></span>
					</span>
					<span class="button-icon">
						<span class="main-text">
							<img src="<?php echo esc_url($icon_url); ?>" alt="<?php esc_html_e('icon', 'agenvix-core'); ?>">
						</span>
						<span class="hover-text">
							<img src="<?php echo esc_url($icon_url); ?>" alt="<?php esc_html_e('icon', 'agenvix-core'); ?>">
						</span>
					</span>
				</a>
			</div>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Navigation_Menu() );
