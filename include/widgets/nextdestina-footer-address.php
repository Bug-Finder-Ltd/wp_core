<?php
	
	class Nextdestina_Footer_Address  extends WP_Widget{
		
		public function __construct(){
			parent::__construct('nextdestina_footer_address',esc_html__('Nextdestina Footer Address', 'nextdestinacore'),array(
				'description' => esc_html__('Nextdestina Footer Address', 'nextdestinacore'),
			));
		}
		
		public function widget($args, $instance){
			extract($args);
			extract($instance);
			

			print $before_widget; 
                                 
		        if ( ! empty( $title ) ) {
					print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
				} ?>

				<div class="widget-header">
					<?php if($address): ?>
						<p><?php print esc_html($address); ?></p>
					<?php endif; ?>
					<?php if($email): ?>
						<p><a href="mail:<?php echo esc_attr($email); ?>"><?php print esc_html($email); ?></a></p>
					<?php endif; ?>
					<?php if($phone_number): ?>
						<p><a href="tel:<?php echo esc_attr(str_replace(' ', '-', $phone_number)); ?>"><?php print esc_html($phone_number); ?></a></p>
					<?php endif; ?>
				</div>

            <?php print $after_widget; ?>
			<?php 
		}
		
		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$address  = isset($instance['address'])? $instance['address']:'';
			$email  = isset($instance['email'])? $instance['email']:'';
			$phone_number  = isset($instance['phone_number'])? $instance['phone_number']:'';
			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" class="widefat" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Address:','nextdestinacore'); ?></label>
			</p>
			<textarea name="<?php print esc_attr($this->get_field_name('address')); ?>" id="<?php print esc_attr($this->get_field_id('address')); ?>" class="widefat"><?php print esc_attr($address); ?></textarea>

			<p>
				<label for="title"><?php esc_html_e('Email Address:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('email')); ?>"  name="<?php print esc_attr($this->get_field_name('email')); ?>" class="widefat" value="<?php print esc_attr($email); ?>">

			<p>
				<label for="title"><?php esc_html_e('Phone Number:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('phone_number')); ?>"  name="<?php print esc_attr($this->get_field_name('phone_number')); ?>" class="widefat" value="<?php print esc_attr($phone_number); ?>">
			<?php
		}
				
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
			$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
			$instance['phone_number'] = ( ! empty( $new_instance['phone_number'] ) ) ? strip_tags( $new_instance['phone_number'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Nextdestina_Footer_Address');
	});