<?php
namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Provix Core
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
		return __( 'Experience Box', 'agenvix-core' );
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
                    'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
                    'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
                    'layout-3' => esc_html__('Layout 3', 'agenvix-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
        
        /**
         * Title and content section
         */
        $this->start_controls_section(
            'provix_section_title',
            [
                'label' => esc_html__('Title & Content', 'agenvix-core'),
            ]
        );
        
        $this->add_control(
            'years_experience',
            [
                'label' => esc_html__('Years of Experience', 'agenvix-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('18', 'agenvix-core'),
                'placeholder' => esc_html__('Type number', 'agenvix-core'),
            ]
        );

        $this->add_control(
            'provix_description',
            [
                'label' => esc_html__('Description', 'agenvix-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('18+ YEARS OF EXPERIENCE *', 'agenvix-core'),
                'placeholder' => esc_html__('Type section description here', 'agenvix-core'),
            ]
        );

        $this->end_controls_section();

        /**
         * Style section
         */
		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General', 'agenvix-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'agenvix-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'agenvix-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'agenvix-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'agenvix-core' ),
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

		<?php if($settings['provix_design_style'] == "layout-1" ){ ?>

           <div class="experience-box style-one">
                <div class="round-box-content">
                    <span class="curved-circle">
                        <?php echo $settings['provix_description']; ?>
                        <?php echo $settings['provix_description']; ?>
                    </span>
                    <div class="round-box-icon">
                        <?php echo $settings['years_experience']; ?>
                    </div>
                </div>
            </div>

		<?php }elseif($settings['provix_design_style'] == "layout-2" ){ ?>

            <div class="box-icon style-two">
                <div class="icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <a href="#"><?php echo $settings['provix_title']; ?></a>
                <?php if(!empty($settings['provix_description'])) : ?>
                    <p><?php echo $settings['provix_description']; ?></p>
                <?php endif; ?>
            </div>

        <?php }elseif($settings['provix_design_style'] == "layout-3" ){ ?>
            
            <div class="box-icon style-three">
                <div class="icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                </div>
                <div class="content">
                    <h4 class="title"><?php echo $settings['provix_title']; ?></h4>
                    <?php if(!empty($settings['provix_description'])) : ?>
                        <p><?php echo $settings['provix_description']; ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php } ?>

        <?php 
	}
}

$widgets_manager->register( new Experience_Box() );