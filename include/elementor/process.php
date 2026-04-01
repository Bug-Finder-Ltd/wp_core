<?php

namespace ProvixCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 * Provix Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Provix_Process extends \Elementor\Widget_Base
{


	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'process';
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
	public function get_title()
	{
		return __('Process Step', 'agenvix-core');
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
	public function get_icon()
	{
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
	public function get_categories()
	{
		return array('agenvix-core');
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
	public function get_script_depends()
	{
		return array('agenvix-core');
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
	protected function register_controls()
	{

		/**
		 * Layout section
		 */
		$this->start_controls_section(
			'provix_layout',
			array(
				'label' => esc_html__('Design Layout', 'agenvix-core'),
			)
		);
		$this->add_control(
			'provix_design_style',
			array(
				'label'   => esc_html__('Select Layout', 'agenvix-core'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'layout-1' => esc_html__('Layout 1', 'agenvix-core'),
					'layout-2' => esc_html__('Layout 2', 'agenvix-core'),
				),
				'default' => 'layout-1',
			)
		);

		$this->end_controls_section();

		/**
		 * Process list
		 */
		$this->start_controls_section(
			'provix_process',
			array(
				'label'       => esc_html__('Process List', 'agenvix-core'),
				'description' => esc_html__('Control all the style settings from Style tab', 'agenvix-core'),
				'tab'         => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		// process step
		$repeater->add_control(
			'provix_process_step',
			array(
				'label'       => esc_html__('Process Step', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Step - 01', 'agenvix-core'),
			)
		);

		$repeater->add_control(
			'provix_process_title',
			array(
				'label'       => esc_html__('Process Title', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Process title here', 'agenvix-core'),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'provix_process_description',
			array(
				'label'       => esc_html__('Description', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
				'label_block' => true,
			)
		);

		$this->add_control(
			'provix_process_list',
			array(
				'label'       => esc_html__('Process - List', 'agenvix-core'),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'provix_process_title' => esc_html__('Start Framing', 'agenvix-core'),
					),
					array(
						'provix_process_title' => esc_html__('Design Theme', 'agenvix-core'),
					),
					array(
						'provix_process_title' => esc_html__('Well Layer', 'agenvix-core'),
					),
					array(
						'provix_process_title' => esc_html__('Finished Work', 'agenvix-core'),
					),
				),
				'title_field' => '{{{ provix_process_title }}}',
			)
		);
		$this->add_responsive_control(
			'provix_process_align',
			array(
				'label'     => esc_html__('Alignment', 'agenvix-core'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'text-left'   => array(
						'title' => esc_html__('Left', 'agenvix-core'),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => esc_html__('Center', 'agenvix-core'),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => esc_html__('Right', 'agenvix-core'),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'toggle'    => true,
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		/**
		 * Style section
		 */
		$this->start_controls_section(
			'section_style',
			array(
				'label' => __('Style', 'agenvix-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_transform',
			array(
				'label'     => __('Text Transform', 'agenvix-core'),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''           => __('None', 'agenvix-core'),
					'uppercase'  => __('UPPERCASE', 'agenvix-core'),
					'lowercase'  => __('lowercase', 'agenvix-core'),
					'capitalize' => __('Capitalize', 'agenvix-core'),
				),
				'selectors' => array(
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				),
			)
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

		<?php if ('layout-1' === $settings['provix_design_style']) : ?>

			<div class="process-step style-one">
				<div class="item-grid">
					<?php foreach ($settings['provix_process_list'] as $item) : ?>
						<div class="process-box">
							<div class="number">
								<?php echo $item['provix_process_step']; ?>
							</div>
							<h3 class="title">
								<?php echo $item['provix_process_title']; ?>
							</h3>
							<p class="description">
								<?php echo $item['provix_process_description']; ?>
							</p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		<?php elseif ('layout-2' === $settings['provix_design_style']) : ?>

			<div class="process-step style-two">
				<?php foreach ($settings['provix_process_list'] as $item) : ?>
					<div class="process-box wow fadeInLeft">
						<div class="number">
							<?php echo $item['provix_process_step']; ?>
						</div>
						<div class="content">
							<h3 class="title"><?php echo $item['provix_process_title']; ?></h3>
							<p class="description"><?php echo $item['provix_process_description']; ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new Provix_Process());
