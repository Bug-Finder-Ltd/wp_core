<?php
	
	class Protine_Footer_Phone  extends WP_Widget{
		
		public function __construct(){
			parent::__construct('protine_footer_phone',esc_html__('Protine Footer Phone', 'protinecore'),array(
				'description' => esc_html__('Protine Footer Phone', 'protinecore'),
			));
		}
		
		public function widget($args, $instance){
			extract($args);
			extract($instance);
			

			print $before_widget; 
                                 
		        if ( ! empty( $title ) ) {
					print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
				} ?>

				<ul class="footer-widget-list">
					<li>
						<?php if($phone_1): ?>
							<a href="tel:<?php print esc_url($phone_1); ?>"><?php print esc_html($phone_1); ?></a>
						<?php endif;?>
					</li>
					<li>
						<?php if($phone_1): ?>
							<a href="tel:<?php print esc_url($phone_2); ?>"><?php print esc_html($phone_2); ?></a>
						<?php endif;?>
					</li>
				</ul>

            <?php print $after_widget; ?>
			<?php 
		}
		
		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$phone_1  = isset($instance['phone_1'])? $instance['phone_1']:'';
			$phone_2  = isset($instance['phone_2'])? $instance['phone_2']:'';
			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" class="widefat" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="Phone 1"><?php esc_html_e('Phone Number 1:','protinecore'); ?></label>
			</p>
			<input type="tel" id="<?php print esc_attr($this->get_field_id('phone_1')); ?>" name="<?php print esc_attr($this->get_field_name('phone_1')); ?>" class="widefat" value="<?php print esc_attr($phone_1); ?>">
			
			<p>
				<label for="Phone 2"><?php esc_html_e('Phone Number 2:','protinecore'); ?></label>
			</p>
			<input type="tel" id="<?php print esc_attr($this->get_field_id('phone_2')); ?>" name="<?php print esc_attr($this->get_field_name('phone_2')); ?>" class="widefat" value="<?php print esc_attr($phone_2); ?>">
			
			<?php
		}
				
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['phone_1'] = ( ! empty( $new_instance['phone_1'] ) ) ? strip_tags( $new_instance['phone_1'] ) : '';
			$instance['phone_2'] = ( ! empty( $new_instance['phone_2'] ) ) ? strip_tags( $new_instance['phone_2'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Protine_Footer_Phone');
	});