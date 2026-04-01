<?php 
	Class Provix_Footer_Social_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('provix-footer-social', 'Provix Footer Social', array(
				'description'	=> 'Footer Social Widget by Provix'
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
						<?php if( !empty($provix_facebook) ): ?>
							<li><a href="<?php print esc_url($provix_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($provix_twitter) ): ?>
							<li><a href="<?php print esc_url($provix_twitter); ?>"><i class="icon-twiter"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($provix_linkedin) ): ?>
							<li><a href="<?php print esc_url($provix_linkedin); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($provix_instagram) ): ?>
							<li><a href="<?php print esc_url($provix_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
					</ul>
                </div>
						</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';

			$provix_facebook  = isset($instance['provix_facebook'])? $instance['provix_facebook']:'';
			$provix_twitter  = isset($instance['provix_twitter'])? $instance['provix_twitter']:'';
			$provix_linkedin  = isset($instance['provix_linkedin'])? $instance['provix_linkedin']:'';
			$provix_instagram  = isset($instance['provix_instagram'])? $instance['provix_instagram']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Facebook:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_facebook')); ?>" value="<?php print esc_attr($provix_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_twitter')); ?>" value="<?php print esc_attr($provix_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_linkedin')); ?>" value="<?php print esc_attr($provix_linkedin); ?>">
			
			<p>
				<label for="title"><?php esc_html_e('Instagram:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_instagram')); ?>" value="<?php print esc_attr($provix_instagram); ?>">

			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['provix_facebook'] = ( ! empty( $new_instance['provix_facebook'] ) ) ? strip_tags( $new_instance['provix_facebook'] ) : '';
			$instance['provix_twitter'] = ( ! empty( $new_instance['provix_twitter'] ) ) ? strip_tags( $new_instance['provix_twitter'] ) : '';
			$instance['provix_linkedin'] = ( ! empty( $new_instance['provix_linkedin'] ) ) ? strip_tags( $new_instance['provix_linkedin'] ) : '';
			$instance['provix_instagram'] = ( ! empty( $new_instance['provix_instagram'] ) ) ? strip_tags( $new_instance['provix_instagram'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Provix_Footer_Social_Widget');
	});