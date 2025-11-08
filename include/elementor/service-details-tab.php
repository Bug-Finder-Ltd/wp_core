<?php
namespace ZupetCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Zupet Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Service_Details_Tab extends \Elementor\Widget_Base {

	
	public function get_name() {
		return 'service-details';
	}

	public function get_title() {
		return __( 'Service Details Tab', 'zupetcore' );
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

        $this->start_controls_section(
            'tab_1',
            [
                'label' => esc_html__('Tab 1', 'zupetcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'tab1_title',
            [
                'label' => esc_html__('Title', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('About', 'zupetcore'),
                'placeholder' => esc_html__('Type title', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab1_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Service description here', 'zupetcore'),
                'placeholder' => esc_html__('Type your description here', 'zupetcore'),
            ]
        );

        $this->end_controls_section();

        // Tab 2

        $this->start_controls_section(
            'tab_2',
            [
                'label' => esc_html__('Tab 2', 'zupetcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'tab2_title',
            [
                'label' => esc_html__('Title', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Includes', 'zupetcore'),
                'placeholder' => esc_html__('Type title', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab2_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Service description here', 'zupetcore'),
                'placeholder' => esc_html__('Type your description here', 'zupetcore'),
            ]
        );

        $this->end_controls_section();

        // Tab 3

        $this->start_controls_section(
            'tab_3',
            [
                'label' => esc_html__('Tab 3', 'zupetcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'tab3_title',
            [
                'label' => esc_html__('Title', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Benefits', 'zupetcore'),
                'placeholder' => esc_html__('Type title', 'zupetcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab3_description',
            [
                'label' => esc_html__('Description', 'zupetcore'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Service description here', 'zupetcore'),
                'placeholder' => esc_html__('Type your description here', 'zupetcore'),
            ]
        );

        $this->end_controls_section();
        
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

        ?>
        
        <div class="service-single-tab">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" type="button" role="tab" aria-controls="nav-about" aria-selected="true">
                        <?php echo $settings['tab1_title']; ?>
                    </button>
                    <button class="nav-link" id="nav-includes-tab" data-bs-toggle="tab" data-bs-target="#nav-includes" type="button" role="tab" aria-controls="nav-includes" aria-selected="false">
                        <?php echo $settings['tab2_title']; ?>
                    </button>
                    <button class="nav-link" id="nav-benefits-tab" data-bs-toggle="tab" data-bs-target="#nav-benefits" type="button" role="tab" aria-controls="nav-benefits" aria-selected="false">
                        <?php echo $settings['tab3_title']; ?>
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                    <?php echo $settings['tab1_description']; ?>
                </div>
                <div class="tab-pane fade" id="nav-includes" role="tabpanel" aria-labelledby="nav-includes-tab">
                    <?php echo $settings['tab2_description']; ?>
                </div>
                <div class="tab-pane fade" id="nav-benefits" role="tabpanel" aria-labelledby="nav-benefits-tab">
                    <?php echo $settings['tab3_description']; ?>
                </div>
            </div>
        </div>

		<?php
	}

}

$widgets_manager->register( new Service_Details_Tab() );