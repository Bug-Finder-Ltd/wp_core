<?php

namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;

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
class Provix_Newsletter extends \Elementor\Widget_Base {


	public function get_name() {
		return 'provix-newsletter';
	}

	public function get_title() {
		return __( 'Newsletter', 'agenvix-core' );
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

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'button_style',
			array(
				'label' => __( 'Button', 'agenvix-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->start_controls_tabs(
			'btn_style_tabs'
		);
		
		$this->start_controls_tab(
			'btn_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'agenvix-core' ),
			]
		);
		
        $this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .newsletter button' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .newsletter button',
			]
		);
		
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'btn_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'agenvix-core' ),
			]
		);
		
		$this->add_control(
			'text_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .newsletter button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .newsletter button:hover',
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
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
		$settings = $this->get_settings_for_display(); ?>

		<?php if ( 'layout-1' === $settings['provix_design_style'] ) : ?>

			<div class="newsletter style-one">
				<form method="post" class="provix-newsletter-form">
                    <input type="email" name="nd_newsletter_email" id="nd_newsletter_email" required placeholder="<?php esc_attr_e( 'Enter your email', 'agenvix-core' ); ?>">
                    <?php wp_nonce_field( 'nd_newsletter_subscribe', 'nd_newsletter_nonce' ); ?>
                    <button type="submit" name="nd_newsletter_submit">
                        <i class="fa-regular fa-arrow-right"></i>
                    </button>
                </form>
			</div>
        
        <?php elseif ( 'layout-2' === $settings['provix_design_style'] ) : ?>
            
            <div class="newsletter style-two">
                
				<?php
					if( function_exists('nd_render_newsletter_form') ){
						echo nd_render_newsletter_form();
					}
				?>
				
			</div>
			
		<?php elseif ( 'layout-3' === $settings['provix_design_style'] ) : ?>

			<div class="newsletter style-three">
                <form method="post" class="provix-newsletter-form">
                    <input type="email" name="nd_newsletter_email" id="nd_newsletter_email" required placeholder="<?php esc_attr_e( 'Enter your email', 'agenvix-core' ); ?>">
                    <?php wp_nonce_field( 'nd_newsletter_subscribe', 'nd_newsletter_nonce' ); ?>
                    <button type="submit" name="nd_newsletter_submit">
                        <?php echo esc_html_e('Subscribe', 'agenvix-core'); ?>
                    </button>
                </form>
			</div>

		<?php endif; ?>

		<?php
	}
}

$widgets_manager->register( new Provix_Newsletter() );
