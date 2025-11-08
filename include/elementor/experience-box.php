<?php
namespace ZupetCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Experience_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'experience_box';
	}
	public function get_title() {
		return __( 'Experience Box', 'zupetcore' );
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
         * Layout section
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'zupet_section_title',
            [
                'label' => esc_html__('Title & Content', 'zupetcore'),
            ]
        );
        
        $this->add_control(
            'years_experience',
            [
                'label' => esc_html__('Years of Experience', 'zupetcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('18', 'zupetcore'),
                'placeholder' => esc_html__('Type number', 'zupetcore'),
            ]
        );

        $this->add_control(
            'zupet_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('18+ YEARS OF EXPERIENCE *', 'zupetcore'),
                'placeholder' => esc_html__('Type section description here', 'zupetcore'),
            ]
        );

        $this->end_controls_section();

        /**
         * Style section
         */
		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General', 'zupetcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'zupetcore' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'zupetcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'zupetcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'zupetcore' ),
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

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

            if ( !empty($settings['icon_image']['url']) ) {
                $icon = !empty($settings['icon_image']['id']) ? wp_get_attachment_image_url( $settings['icon_image']['id'], '') : $settings['icon_image']['url'];
            }
        ?>

		<?php if($settings['zupet_design_style'] == "layout-1" ){ ?>

           <div class="experience-box style-one">
                <div class="round-box-content">
                    <span class="curved-circle">
                        <?php echo $settings['zupet_description']; ?>
                        <?php echo $settings['zupet_description']; ?>
                    </span>
                    <div class="round-box-icon">
                        <?php echo $settings['years_experience']; ?>
                    </div>
                </div>
            </div>

		<?php }elseif($settings['zupet_design_style'] == "layout-2" ){ ?>

            <div class="box-icon style-two">
                <div class="icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <a href="#"><?php echo $settings['zupet_title']; ?></a>
                <?php if(!empty($settings['zupet_description'])) : ?>
                    <p><?php echo $settings['zupet_description']; ?></p>
                <?php endif; ?>
            </div>

        <?php }elseif($settings['zupet_design_style'] == "layout-3" ){ ?>
            
            <div class="box-icon style-three">
                <div class="icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $settings['zupet_title']; ?></h4>
                    <?php if(!empty($settings['zupet_description'])) : ?>
                        <p><?php echo $settings['zupet_description']; ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php } ?>

        <?php 
	}
}

$widgets_manager->register( new Experience_Box() );