<?php
namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Service_List extends \Elementor\Widget_Base {

    public function get_name() {
        return 'service-list';
    }

    public function get_title() {
        return __( 'Service List', 'agenvix-core' );
    }

    public function get_icon() {
        return 'provix-icon';
    }

    public function get_categories() {
        return [ 'agenvix-core' ];
    }

    public function get_script_depends() {
        return [ 'agenvix-core' ];
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
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__( 'Layout 1', 'agenvix-core' ),
                    'layout-2' => esc_html__( 'Layout 2', 'agenvix-core' ),
                    'layout-3' => esc_html__( 'Layout 3', 'agenvix-core' ),
                    'layout-4' => esc_html__( 'Layout 4', 'agenvix-core' ),
                    'layout-5' => esc_html__( 'Layout 5', 'agenvix-core' ),
                    'layout-6' => esc_html__( 'Layout 6', 'agenvix-core' ),
                ],
                'default' => 'layout-1',
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('Title', 'agenvix-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'list_title',
            [
                'label' => esc_html__( 'Title', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'agenvix-core' ),
                'placeholder' => esc_html__( 'Type your title here', 'agenvix-core' ),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
        
        /**
         * Service section
         */
         
        $this->start_controls_section(
            'provix_services',
            [
                'label' => esc_html__('Service List', 'agenvix-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'agenvix-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'service_category',
			[
				'label' => esc_html__('Service Category', 'agenvix-core'),
				'type' => Controls_Manager::TEXTAREA,
				'description' => 'One feature per line',
			]
		);

        $repeater->add_control(
            'provix_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'agenvix-core'),
                    'icon' => esc_html__('Icon', 'agenvix-core'),
                ],
            ]
        );

        $repeater->add_control(
            'icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'agenvix-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'provix_service_icon_type' => 'image'
                ]

            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'show_label' => false,
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'far fa-star',
                    'library' => 'regular',
                ],
                'condition' => [
                    'provix_service_icon_type' => 'icon'
                ]
            ]
        );
        
        $repeater->add_control(
            'provix_image',
            [
                'label' => esc_html__('Upload Image', 'agenvix-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $repeater->add_control(
            'service_title', [
                'label' => esc_html__('Title', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'agenvix-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'service_description',
            [
                'label' => esc_html__('Description', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'provix_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'agenvix-core' ),
                'label_off' => esc_html__( 'No', 'agenvix-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'service_btn_text',
            [
                'label' => esc_html__('Button Text', 'agenvix-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'agenvix-core'),
                'title' => esc_html__('Enter button text', 'agenvix-core'),
                'label_block' => true,
                'condition' => [
                    'provix_services_link_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'provix_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'provix_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'provix_service_link',
            [
                'label' => esc_html__( 'Service Link link', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'agenvix-core' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'provix_services_link_type' => '1',
                    'provix_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'provix_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => provix_get_all_pages(),
                'condition' => [
                    'provix_services_link_type' => '2',
                    'provix_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'provix_service_list',
            [
                'label' => esc_html__('Services - List', 'agenvix-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_title' => esc_html__('Agricultural consulting', 'agenvix-core'),
                    ],
                    [
                        'service_title' => esc_html__('Agricultural financing', 'agenvix-core')
                    ],
                    [
                        'service_title' => esc_html__('Agricultural technology', 'agenvix-core')
                    ]
                ],
                'title_field' => '{{{ service_title }}}',
            ]
        );
        $this->end_controls_section();

        /**
         * Style section
         */
        $this->start_controls_section(
            'genral_style',
            [
                'label' => __( 'General', 'agenvix-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label' => __( 'Text Transform', 'agenvix-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'None', 'agenvix-core' ),
                    'uppercase' => __( 'UPPERCASE', 'agenvix-core' ),
                    'lowercase' => __( 'lowercase', 'agenvix-core' ),
                    'capitalize' => __( 'Capitalize', 'agenvix-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-list .left-column .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .service-list .left-column .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'item_style',
			[
				'label' => esc_html__( 'Service Item', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'item_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .service-list .service-item',
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
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <?php if ( $settings['provix_design_style']  == 'layout-1' ): ?>

            <div class="service-list style-one">
                <?php foreach (  $settings['provix_service_list'] as $item ) :
                    if ( !empty($item['provix_image']['url']) ) {
                        $provix_image = !empty($item['provix_image']['id']) ? wp_get_attachment_image_url( $item['provix_image']['id'], '') : $item['provix_image']['url'];
                        $provix_image_alt = get_post_meta($item["provix_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    if ( !empty($item['icon_image']['url']) ) {
                        $icon_image = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                        $provix_image_alt = get_post_meta($item["icon_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    $icon_url = PROTINE_ADDONS_URL . 'assets/img/icons/footprint.png';
                    ?>
                <div class="service-item">
                    <div class="service-item-frontend">
                        <div class="frontend-icon">
                            <img src="<?php echo esc_url($icon_image); ?>" alt="icon">
                        </div>
                        <h4 class="frontend-title"><?php echo $item['service_title']; ?></h4>
                        <div class="service-border"></div>
                    </div>
                    <div class="service-item-backend">
                        <div class="service-backend-title">
                            <img class="icon" src="<?php echo esc_url($icon_image); ?>" alt="icon">
                            <a href="<?php echo esc_url($item['provix_service_link']['url']); ?>"><?php echo $item['service_title']; ?></a>
                            <div class="service-border"></div>
                        </div>
                        <p><?php echo $item['service_description']; ?></p>
                        <div class="service-btn">
                            <a href="<?php echo esc_url($item['provix_service_link']['url']); ?>" class="button">
                                <span class="button-text">
                                    <span class="main-text"><?php echo $item['service_btn_text']; ?></span>
                                    <span class="hover-text"><?php echo $item['service_btn_text']; ?></span>
                                </span>
                                <span class="button-icon">
                                    <span class="main-text">
                                        <img decoding="async" src="<?php echo esc_url($icon_url); ?>" alt="icon">
                                    </span>
                                    <span class="hover-text">
                                        <img decoding="async" src="<?php echo esc_url($icon_url); ?>" alt="icon">
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="backend-image">
                            <img src="<?php echo esc_url($provix_image); ?>" alt="image">
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
      
            </div>

        <?php elseif ( $settings['provix_design_style']  == 'layout-2' ): ?>

            <div class="service-list style-two">
                <div class="left-column">
                    <?php if( !empty($settings['list_title']) ) : ?>
                        <h2 class="title"><?php echo $settings['list_title']; ?></h2>
                    <?php endif; ?>
                </div>
                <div class="right-column">
                    <?php
                    foreach (  $settings['provix_service_list'] as $item ) :
                        if ( !empty($item['icon_image']['url']) ) {
                            $icon = !empty($item['icon_image']['id']) ? wp_get_attachment_image_url( $item['icon_image']['id'], '') : $item['icon_image']['url'];
                            $icon_alt = get_post_meta($item["icon_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        ?>
                        <div class="service-item">
                            <?php if( !empty( $icon ) ) : ?>
                                <div class="icon">
                                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <h2 class="title"><?php echo esc_html( $item['service_title'] ); ?></h2>
                                <p class="description"><?php echo esc_html( $item['service_description'] ); ?></p>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>

		<?php elseif ( $settings['provix_design_style']  == 'layout-3' ): ?>

			<div class="service-list style-three">
                <div class="accordion" id="accordionExample">
                    <?php
                    $count = 1;
                    foreach ( $settings['provix_service_list'] as $faq ) :
                        if ( !empty($faq['provix_image']['url']) ) {
                            $provix_image = !empty($faq['provix_image']['id']) ? wp_get_attachment_image_url( $faq['provix_image']['id'], '') : $faq['provix_image']['url'];
                            $provix_image_alt = get_post_meta($faq["provix_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        $collapse_id = 'collapse' . $count;
                        $show_class  = ( 1 === $count ) ? 'show' : '';
                        $collapsed   = ( 1 === $count ) ? '' : 'collapsed';
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="d-flex justify-content-between accordion-button <?php echo esc_attr( $collapsed ); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>" aria-expanded="<?php echo ( 1 === $count ) ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $collapse_id ); ?>">
									<div class="d-flex align-items-center flex-wrap">
										<div class="number"><?php echo sprintf('%02d', $count); ?></div>
										<h2 class="title"><?php echo esc_html( $faq['service_title'] ); ?></h2>
									</div>
									<div class="icon">
                                        <a href="<?php echo esc_url($faq['provix_service_link']['url']); ?>"><i class="fa-solid fa-arrow-right-long"></i></a>
                                    </div>
                                    <?php if( !empty( $provix_image ) ) : ?>
                                        <div class="image">
                                            <img class="service-three-image" src="<?php echo esc_url($provix_image); ?>" alt="image">
                                        </div>
                                    <?php endif; ?>
                                </button>
                            </h2>
                            <div id="<?php echo esc_attr( $collapse_id ); ?>" class="accordion-collapse collapse <?php echo esc_attr( $show_class ); ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p><?php echo esc_html( $faq['service_description'] ); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        $count++;
                    endforeach;
                    ?>
                </div>
            </div>

        <?php elseif ( $settings['provix_design_style']  == 'layout-4' ): ?>

            <div class="service-list style-four">
                <?php
                $count = 1;
                foreach (  $settings['provix_service_list'] as $item ) :
                    if ( !empty($item['provix_image']['url']) ) {
                        $provix_image = !empty($item['provix_image']['id']) ? wp_get_attachment_image_url( $item['provix_image']['id'], '') : $item['provix_image']['url'];
                        $provix_image_alt = get_post_meta($item["provix_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    ?>
                    <div class="service-item">
                        <div class="content">
                            <div class="number"><?php echo sprintf('%02d', $count); ?></div>
                            <h2 class="title"><?php echo esc_html( $item['service_title'] ); ?></h2>
							<?php
							if( !empty( $item['service_category'] ) ) :
								$categories = explode("\n", $item['service_category']);

								echo '<ul class="categories">';
								foreach ($categories as $category) {
									echo '<li>' . esc_html($category) . '</li>';
								}
								echo '</ul>';
							endif;
							?>
                            <p class="description"><?php echo esc_html( $item['service_description'] ); ?></p>
							<a href="<?php echo esc_url($item['provix_service_link']['url']); ?>" class="button">
								<?php echo $item['service_btn_text']; ?>
                            </a>
                        </div>
                        <?php if( !empty( $provix_image ) ) : ?>
                            <div class="image">
                                <img src="<?php echo esc_url($provix_image); ?>" alt="image">
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    $count++;
                endforeach;
                ?>
            </div>

        <?php elseif ( $settings['provix_design_style']  == 'layout-5' ): ?>

            <div class="service-list style-five">
                <?php
                $count = 1;
                foreach (  $settings['provix_service_list'] as $item ) :
                    if ( !empty($item['provix_image']['url']) ) {
                        $provix_image = !empty($item['provix_image']['id']) ? wp_get_attachment_image_url( $item['provix_image']['id'], '') : $item['provix_image']['url'];
                        $provix_image_alt = get_post_meta($item["provix_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    ?>
                    <div class="service-item">
                        <div class="row">
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="number"><?php echo sprintf('%02d', $count); ?></div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="service-content">
                                    <h2 class="title"><?php echo $item['service_title']; ?></h2>
                                    <p class="description"><?php echo esc_html( $item['service_description'] ); ?></p>
                                    <a class="button" href="<?php echo esc_url($item['provix_service_link']['url']); ?>">
                                        <?php echo $item['service_btn_text']; ?>
                                        <i class="fa-solid fa-circle-arrow-right"></i>
                                    </a>
                                    <?php
										if( !empty( $item['service_category'] ) ) :
											$categories = explode("\n", $item['service_category']);

											echo '<ul class="categories">';
											foreach ($categories as $category) {
												echo '<li>' . esc_html($category) . '</li>';
											}
											echo '</ul>';
										endif;
										?>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-4">
                                <?php if( !empty( $provix_image ) ) : ?>
                                    <div class="image">
                                        <img src="<?php echo esc_url($provix_image); ?>" alt="image">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                endforeach;
                ?>
            </div>

        <?php elseif ( 'layout-6' === $settings['provix_design_style'] ): ?>

            <div class="service-list style-six">
                <?php
                $count = 1;
                foreach (  $settings['provix_service_list'] as $item ) :
                    if ( !empty($item['provix_image']['url']) ) {
                        $provix_image = !empty($item['provix_image']['id']) ? wp_get_attachment_image_url( $item['provix_image']['id'], '') : $item['provix_image']['url'];
                        $provix_image_alt = get_post_meta($item["provix_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    ?>
                    <div class="service-item">
                        <div class="row">
                            <div class="col-md-12 col-lg-7 col-xl-6">
								<div class="text-wrapper">
									<div class="number"><?php echo sprintf('%02d', $count); ?></div>
									<div class="service-content">
										<h2 class="title"><?php echo $item['service_title']; ?></h2>
										<p class="description"><?php echo esc_html( $item['service_description'] ); ?></p>
										<a class="button" href="<?php echo esc_url($item['provix_service_link']['url']); ?>">
											<?php echo $item['service_btn_text']; ?>
											<i class="fa-solid fa-circle-arrow-right"></i>
										</a>
										<?php
											if( !empty( $item['service_category'] ) ) :
												$categories = explode("\n", $item['service_category']);

												echo '<ul class="categories">';
												foreach ($categories as $category) {
													echo '<li>' . esc_html($category) . '</li>';
												}
												echo '</ul>';
											endif;
											?>
									</div>
								</div>
                            </div>
                            <div class="col-md-12 col-lg-5 col-xl-6">
                                <?php if( !empty( $provix_image ) ) : ?>
                                    <div class="image">
                                        <img src="<?php echo esc_url($provix_image); ?>" alt="image">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                endforeach;
                ?>
            </div>

        <?php endif; ?>
        <?php 
    }
}

$widgets_manager->register( new Service_List() );