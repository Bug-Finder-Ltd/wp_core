<?php
	
	class Protine_Footer_Info  extends WP_Widget{
		
		public function __construct(){
			parent::__construct('protine_footer_info',esc_html__('Protine Footer Info', 'protinecore'),array(
				'description' => esc_html__('Protine Footer Info', 'protinecore'),
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
					<?php if($text_content): ?>
						<p><?php print esc_html($text_content); ?></p>
					<?php endif; ?>
				</div>

            <?php print $after_widget; ?>
			<?php 
		}
		
		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$text_content  = isset($instance['text_content'])? $instance['text_content']:'';
			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" class="widefat" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Text Content:','protinecore'); ?></label>
			</p>
			<textarea id="<?php print esc_attr($this->get_field_id('text_content')); ?>" name="<?php print esc_attr($this->get_field_name('text_content')); ?>" class="widefat"><?php print esc_attr($text_content); ?></textarea>
			<?php
		}
				
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['text_content'] = ( ! empty( $new_instance['text_content'] ) ) ? strip_tags( $new_instance['text_content'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Protine_Footer_Info');
	});