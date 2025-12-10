<?php 
	Class Raizen_Footer_Social_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('raizen-footer-social', 'Raizen Footer Social', array(
				'description'	=> 'Footer Social Widget by Raizen'
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
						<?php if( !empty($raizen_facebook) ): ?>
							<li><a href="<?php print esc_url($raizen_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($raizen_twitter) ): ?>
							<li><a href="<?php print esc_url($raizen_twitter); ?>"><i class="icon-twiter"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($raizen_linkedin) ): ?>
							<li><a href="<?php print esc_url($raizen_linkedin); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($raizen_instagram) ): ?>
							<li><a href="<?php print esc_url($raizen_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
					</ul>
                </div>
						</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';

			$raizen_facebook  = isset($instance['raizen_facebook'])? $instance['raizen_facebook']:'';
			$raizen_twitter  = isset($instance['raizen_twitter'])? $instance['raizen_twitter']:'';
			$raizen_linkedin  = isset($instance['raizen_linkedin'])? $instance['raizen_linkedin']:'';
			$raizen_instagram  = isset($instance['raizen_instagram'])? $instance['raizen_instagram']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Facebook:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_facebook')); ?>" value="<?php print esc_attr($raizen_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_twitter')); ?>" value="<?php print esc_attr($raizen_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_linkedin')); ?>" value="<?php print esc_attr($raizen_linkedin); ?>">
			
			<p>
				<label for="title"><?php esc_html_e('Instagram:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_instagram')); ?>" value="<?php print esc_attr($raizen_instagram); ?>">

			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['raizen_facebook'] = ( ! empty( $new_instance['raizen_facebook'] ) ) ? strip_tags( $new_instance['raizen_facebook'] ) : '';
			$instance['raizen_twitter'] = ( ! empty( $new_instance['raizen_twitter'] ) ) ? strip_tags( $new_instance['raizen_twitter'] ) : '';
			$instance['raizen_linkedin'] = ( ! empty( $new_instance['raizen_linkedin'] ) ) ? strip_tags( $new_instance['raizen_linkedin'] ) : '';
			$instance['raizen_instagram'] = ( ! empty( $new_instance['raizen_instagram'] ) ) ? strip_tags( $new_instance['raizen_instagram'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Raizen_Footer_Social_Widget');
	});