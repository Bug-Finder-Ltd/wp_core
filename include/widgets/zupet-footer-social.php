<?php 
	Class Zupet_Footer_Social_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('zupet-footer-social', 'Zupet Footer Social', array(
				'description'	=> 'Footer Social Widget by Zupet'
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
						<?php if( !empty($zupet_facebook) ): ?>
							<li><a href="<?php print esc_url($zupet_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($zupet_twitter) ): ?>
							<li><a href="<?php print esc_url($zupet_twitter); ?>"><i class="icon-twiter"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($zupet_linkedin) ): ?>
							<li><a href="<?php print esc_url($zupet_linkedin); ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($zupet_instagram) ): ?>
							<li><a href="<?php print esc_url($zupet_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
					</ul>
                </div>
						</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';

			$zupet_facebook  = isset($instance['zupet_facebook'])? $instance['zupet_facebook']:'';
			$zupet_twitter  = isset($instance['zupet_twitter'])? $instance['zupet_twitter']:'';
			$zupet_linkedin  = isset($instance['zupet_linkedin'])? $instance['zupet_linkedin']:'';
			$zupet_instagram  = isset($instance['zupet_instagram'])? $instance['zupet_instagram']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Facebook:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_facebook')); ?>" value="<?php print esc_attr($zupet_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_twitter')); ?>" value="<?php print esc_attr($zupet_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_linkedin')); ?>" value="<?php print esc_attr($zupet_linkedin); ?>">
			
			<p>
				<label for="title"><?php esc_html_e('Instagram:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_instagram')); ?>" value="<?php print esc_attr($zupet_instagram); ?>">

			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['zupet_facebook'] = ( ! empty( $new_instance['zupet_facebook'] ) ) ? strip_tags( $new_instance['zupet_facebook'] ) : '';
			$instance['zupet_twitter'] = ( ! empty( $new_instance['zupet_twitter'] ) ) ? strip_tags( $new_instance['zupet_twitter'] ) : '';
			$instance['zupet_linkedin'] = ( ! empty( $new_instance['zupet_linkedin'] ) ) ? strip_tags( $new_instance['zupet_linkedin'] ) : '';
			$instance['zupet_instagram'] = ( ! empty( $new_instance['zupet_instagram'] ) ) ? strip_tags( $new_instance['zupet_instagram'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Zupet_Footer_Social_Widget');
	});