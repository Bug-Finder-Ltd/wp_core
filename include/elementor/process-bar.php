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
class Provix_Process_Bar extends \Elementor\Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'provix-process-bar';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Process Bar', 'agenvix-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'provix-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'agenvix-core' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'agenvix-core' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

		/**
		 * Layout section
		 */
		$this->start_controls_section(
			'provix_layout',
			[
				'label' => esc_html__( 'Design Layout', 'agenvix-core' ),
			]
		);
		$this->add_control(
			'provix_design_style',
			[
				'label' => esc_html__('Select Layout', 'agenvix-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		/**
		 * Progress list
		 */
		$this->start_controls_section(
			'provix_progress',
			[
				'label' => esc_html__('Progress List', 'agenvix-core'),
				'description' => esc_html__( 'Control all the style settings from Style tab', 'agenvix-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		// Progress step.
		$repeater->add_control(
			'skill_name', [
				'label' => esc_html__('Skill Name', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Web Design', 'agenvix-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'progress_percent',
			[
				'label' => esc_html__( 'Progress Percent', 'agenvix-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 50,
			]
		);

		$this->add_control(
			'skill_list',
			[
				'label' => esc_html__('Skill - List', 'agenvix-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'skill_name' => esc_html__( 'Branding', 'agenvix-core' ),
					],
					[
						'skill_name' => esc_html__( 'Designing', 'agenvix-core' )
					],
				],
				'title_field' => '{{{ skill_name }}}',
			]
		);

		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'agenvix-core' ),
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
			<div class="skill-list style-one">
				<?php foreach (  $settings['skill_list'] as $item ) { ?>
					<div class="skill-item">
						<h5 class="name"><?php echo $item['skill_name']; ?></h5>
						<div class="progress">
							<div class="progress-bar" data-progress="<?php echo esc_attr( $item['progress_percent'] ); ?>">
								<span><?php echo $item['progress_percent']; ?></span>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

		<?php
	}
}

$widgets_manager->register( new Provix_Process_Bar() );