<?php
namespace RaizenCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

class Experience_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'experience_box';
	}

	public function get_title() {
		return __( 'Experience Box', 'raizencore' );
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
         * Layout section
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
                    'layout-3' => esc_html__('Layout 3', 'raizencore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'raizen_section_title',
            [
                'label' => esc_html__('Title & Content', 'raizencore'),
            ]
        );
        
        $this->add_control(
            'years_experience',
            [
                'label' => esc_html__('Years of Experience', 'raizencore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('18', 'raizencore'),
                'placeholder' => esc_html__('Type number', 'raizencore'),
            ]
        );

        $this->add_control(
            'raizen_description',
            [
                'label' => esc_html__('Description', 'raizencore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('18+ YEARS OF EXPERIENCE *', 'raizencore'),
                'placeholder' => esc_html__('Type section description here', 'raizencore'),
            ]
        );

        $this->end_controls_section();

        /**
         * Style section
         */
		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General', 'raizencore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'raizencore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'raizencore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'raizencore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .experience-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();


        $this->start_controls_section(
            'year_style',
            [
                'label' => esc_html__( 'Year', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'year_color',
            [
                'label' => esc_html__( 'Text Color', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .experience-box .exp-year' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'year_typography',
                'selector' => '{{WRAPPER}} .experience-box .exp-year',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'raizencore' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Text Color', 'raizencore' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .experience-box .exp-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .experience-box .exp-text',
            ]
        );
        $this->end_controls_section();



	}

	protected function render() {
		$settings = $this->get_settings_for_display();

            if ( !empty($settings['icon_image']['url']) ) {
                $icon = !empty($settings['icon_image']['id']) ? wp_get_attachment_image_url( $settings['icon_image']['id'], '') : $settings['icon_image']['url'];
            }
        ?>

		<?php if($settings['raizen_design_style'] == "layout-1" ){ ?>

            <div class="experience-box style-one">
                <div class="round-box-content">
                    <span class="curved-circle">
                        <?php echo $settings['raizen_description']; ?>
                        <?php echo $settings['raizen_description']; ?>
                    </span>
                    <div class="round-box-icon">
                        <?php echo $settings['years_experience']; ?>
                    </div>
                </div>
            </div>

		<?php }elseif($settings['raizen_design_style'] == "layout-2" ){ ?>

            <div class="experience-box style-two">
                <div class="exp-year">
                    <?php echo $settings['years_experience']; ?>
                </div>
                <?php if(!empty($settings['raizen_description'])): ?>
                    <div class="exp-text">
                        <?php echo $settings['raizen_description']; ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php }elseif($settings['raizen_design_style'] == "layout-3" ){ ?>
            
            <div class="experience-box style-three">
                <div class="exp-year">
                    <?php echo $settings['years_experience']; ?>
                </div>
                <?php if(!empty($settings['raizen_description'])): ?>
                    <div class="exp-text">
                        <?php echo $settings['raizen_description']; ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php } ?>

        <?php 
	}
}

$widgets_manager->register( new Experience_Box() );