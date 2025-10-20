<?php 
	Class Protine_Footer_Social_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('protine-footer-social', 'Protine Footer Social', array(
				'description'	=> 'Footer Social Widget by Protine'
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
						<?php if( !empty($protine_facebook) ): ?>
							<li><a href="<?php print esc_url($protine_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($protine_twitter) ): ?>
							<li><a href="<?php print esc_url($protine_twitter); ?>"><i class="icon-twiter"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($protine_linkedin) ): ?>
							<li><a href="<?php print esc_url($protine_linkedin); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($protine_instagram) ): ?>
							<li><a href="<?php print esc_url($protine_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
					</ul>
                </div>
						</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';

			$protine_facebook  = isset($instance['protine_facebook'])? $instance['protine_facebook']:'';
			$protine_twitter  = isset($instance['protine_twitter'])? $instance['protine_twitter']:'';
			$protine_linkedin  = isset($instance['protine_linkedin'])? $instance['protine_linkedin']:'';
			$protine_instagram  = isset($instance['protine_instagram'])? $instance['protine_instagram']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Facebook:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_facebook')); ?>" value="<?php print esc_attr($protine_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_twitter')); ?>" value="<?php print esc_attr($protine_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_linkedin')); ?>" value="<?php print esc_attr($protine_linkedin); ?>">
			
			<p>
				<label for="title"><?php esc_html_e('Instagram:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_instagram')); ?>" value="<?php print esc_attr($protine_instagram); ?>">

			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['protine_facebook'] = ( ! empty( $new_instance['protine_facebook'] ) ) ? strip_tags( $new_instance['protine_facebook'] ) : '';
			$instance['protine_twitter'] = ( ! empty( $new_instance['protine_twitter'] ) ) ? strip_tags( $new_instance['protine_twitter'] ) : '';
			$instance['protine_linkedin'] = ( ! empty( $new_instance['protine_linkedin'] ) ) ? strip_tags( $new_instance['protine_linkedin'] ) : '';
			$instance['protine_instagram'] = ( ! empty( $new_instance['protine_instagram'] ) ) ? strip_tags( $new_instance['protine_instagram'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Protine_Footer_Social_Widget');
	});