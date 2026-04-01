<?php 
	Class Provix_Nav_Menu_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('provix-nav-menu', 'Provix Nav Menu', array(
				'description'	=> 'Nav Menu Widget by Provix'
			));
		}


		public function widget($args, $instance){
			
			extract($args);
			extract($instance);

			echo $before_widget; 
				if($instance['title']):
				echo $before_title; ?> 
					<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
				<?php echo $after_title; ?>
				<?php endif; ?>

				<?php
					if (!empty($instance['nav_menu'])) {
						wp_nav_menu(array(
							'menu' => $instance['nav_menu'],
							'container' => 'div',
							'container_class' => 'provix-nav-menu-container',
							'menu_class' => 'provix-nav-menu',
							'fallback_cb' => ''
						));
					} else {
						echo '<p>' . esc_html__('Please select a menu.', 'agenvix-core') . '</p>';
					}
				?>

			<?php echo $after_widget; ?>

			<?php
		}

		public function form($instance){
			$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$nav_menu = !empty($instance['nav_menu']) ? $instance['nav_menu'] : '';

			// Get all nav menus
			$menus = wp_get_nav_menus();
		?>	
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo esc_html__('Title', 'agenvix-core'); ?></label>
				<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php echo esc_html__( 'Select Menu:', 'agenvix-core' ); ?></label>
				<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>" class="widefat">
					<option value=""><?php echo esc_html__( '-- Select --', 'agenvix-core' ); ?></option>
					<?php foreach ($menus as $menu): ?>
						<option value="<?php echo esc_attr($menu->term_id); ?>" <?php selected($nav_menu, $menu->term_id); ?>>
							<?php echo esc_html($menu->name); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

		<?php }
	}

	add_action('widgets_init', function(){
		register_widget('Provix_Nav_Menu_Widget');
	});