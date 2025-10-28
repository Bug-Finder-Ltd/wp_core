<?php
	
	class Nextdestina_Footer_Email  extends WP_Widget{
		
		public function __construct(){
			parent::__construct('nextdestina_footer_email',esc_html__('Nextdestina Footer Email', 'nextdestinacore'),array(
				'description' => esc_html__('Nextdestina Footer Email', 'nextdestinacore'),
			));
		}
		
		public function widget($args, $instance){
			extract($args);
			extract($instance);
			

			print $before_widget; 
                                 
		        if ( ! empty( $title ) ) {
					print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
				} ?>

				<div class="call-widget-inner">
					<?php if($footer_email): ?>
						<a class="footer-mail" href="mailto:<?php print esc_url($footer_email); ?>"><?php print esc_html($footer_email); ?></a>
					<?php endif; ?>
				</div>

            <?php print $after_widget; ?>
			<?php 
		}
		
		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$footer_email  = isset($instance['footer_email'])? $instance['footer_email']:'';
			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" class="widefat" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Email:','nextdestinacore'); ?></label>
			</p>
			<input type="email" id="<?php print esc_attr($this->get_field_id('footer_email')); ?>" name="<?php print esc_attr($this->get_field_name('footer_email')); ?>" class="widefat" value="<?php print esc_attr($footer_email); ?>">
			<?php
		}
				
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['footer_email'] = ( ! empty( $new_instance['footer_email'] ) ) ? strip_tags( $new_instance['footer_email'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Nextdestina_Footer_Email');
	});