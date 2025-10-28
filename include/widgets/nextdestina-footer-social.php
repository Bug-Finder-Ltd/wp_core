<?php 
	Class Nextdestina_Footer_Social_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('nextdestina-footer-social', 'Nextdestina Footer Social', array(
				'description'	=> 'Footer Social Widget by Nextdestina'
			));
		}

		public function widget($args, $instance){
			extract($args);
			extract($instance);
			

			print $before_widget; 
                                 
			if ( ! empty( $title ) ) {
				print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
			}
			?>          
			<div class="footer-two-media"> 
                <div class="media-content">
                    <ul>
						<?php if( !empty($nextdestina_facebook) ): ?>
							<li><a href="<?php print esc_url($nextdestina_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($nextdestina_twitter) ): ?>
							<li><a href="<?php print esc_url($nextdestina_twitter); ?>"><i class="icon-twiter"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($nextdestina_linkedin) ): ?>
							<li><a href="<?php print esc_url($nextdestina_linkedin); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($nextdestina_instagram) ): ?>
							<li><a href="<?php print esc_url($nextdestina_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
					</ul>
                </div>
						</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';

			$nextdestina_facebook  = isset($instance['nextdestina_facebook'])? $instance['nextdestina_facebook']:'';
			$nextdestina_twitter  = isset($instance['nextdestina_twitter'])? $instance['nextdestina_twitter']:'';
			$nextdestina_linkedin  = isset($instance['nextdestina_linkedin'])? $instance['nextdestina_linkedin']:'';
			$nextdestina_instagram  = isset($instance['nextdestina_instagram'])? $instance['nextdestina_instagram']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Facebook:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_facebook')); ?>" value="<?php print esc_attr($nextdestina_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_twitter')); ?>" value="<?php print esc_attr($nextdestina_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_linkedin')); ?>" value="<?php print esc_attr($nextdestina_linkedin); ?>">
			
			<p>
				<label for="title"><?php esc_html_e('Instagram:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_instagram')); ?>" value="<?php print esc_attr($nextdestina_instagram); ?>">

			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['nextdestina_facebook'] = ( ! empty( $new_instance['nextdestina_facebook'] ) ) ? strip_tags( $new_instance['nextdestina_facebook'] ) : '';
			$instance['nextdestina_twitter'] = ( ! empty( $new_instance['nextdestina_twitter'] ) ) ? strip_tags( $new_instance['nextdestina_twitter'] ) : '';
			$instance['nextdestina_linkedin'] = ( ! empty( $new_instance['nextdestina_linkedin'] ) ) ? strip_tags( $new_instance['nextdestina_linkedin'] ) : '';
			$instance['nextdestina_instagram'] = ( ! empty( $new_instance['nextdestina_instagram'] ) ) ? strip_tags( $new_instance['nextdestina_instagram'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Nextdestina_Footer_Social_Widget');
	});