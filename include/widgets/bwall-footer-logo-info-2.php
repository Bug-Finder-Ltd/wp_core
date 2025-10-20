<?php 
	Class Bwall_Logo_Info_Footer_Widget_2 extends WP_Widget{

		public function __construct(){
			parent::__construct('bwall-logo-info-footer-2', 'Bwall Footer Logo Info 2', array(
				'description'	=> 'Logo Info Widget 2 by Bwall'
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
                <div class="footer__widget-content">
                	<?php if( !empty($image_box_image) ): ?>
                	<div class="footer-logo">
                        <a href="<?php  print home_url(); ?>"><img src="<?php print $image_box_image; ?>" alt="Footer Logo"></a>
                    </div>
					<?php endif; ?>
					
                    <?php if( !empty($description) ): ?>
                    <p><?php print $description; ?></p>
                    <?php endif; ?>
                    
                    <ul class="social">
						<?php if( !empty($bwall_facebook) ): ?>
							<li><a href="<?php print esc_url($bwall_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($bwall_instagram) ): ?>
							<li><a href="<?php print esc_url($bwall_instagram); ?>"><i class="icon-twiter"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($bwall_twitter) ): ?>
							<li><a href="<?php print esc_url($bwall_twitter); ?>"><span class="my-icon icon-twitter"></span></a></li>
						<?php endif; ?>
						<?php if( !empty($bwall_linkedin) ): ?>
							<li><a href="<?php print esc_url($bwall_linkedin); ?>"><span class="my-icon icon-linkedin-in"></span></a></li>
						<?php endif; ?>
					</ul>
                    
                </div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$description  = isset($instance['description'])? $instance['description']:'';
			$author_img  = isset($instance['image_box_image'])? $instance['image_box_image']:'';

			$bwall_twitter  = isset($instance['bwall_twitter'])? $instance['bwall_twitter']:'';
			$bwall_facebook  = isset($instance['bwall_facebook'])? $instance['bwall_facebook']:'';
			$bwall_instagram  = isset($instance['bwall_instagram'])? $instance['bwall_instagram']:'';
			$bwall_linkedin  = isset($instance['bwall_linkedin'])? $instance['bwall_linkedin']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">
			<p>
				<label for="title"><?php esc_html_e('Short Description:','bwallcore'); ?></label>
			</p>

			<textarea class="widefat" rows="7" cols="15" id="<?php print esc_attr($this->get_field_id('description')); ?>" value="<?php print esc_attr($description); ?>" name="<?php print esc_attr($this->get_field_name('description')); ?>"><?php print esc_attr($description); ?></textarea>

			<p>
				<button type="submit" class="button button-secondary" id="author_info_image">Upload Media</button>
				<input type="hidden" name="<?php print esc_attr($this->get_field_name('image_box_image')); ?>" class="image_er_link" value="<?php print $author_img ; ?>">
				<div class="author-image-show">
					<img src="<?php print $author_img ; ?>" alt="" width="150" height="auto">
				</div>	
			</p>

			<p>
				<label for="title"><?php esc_html_e('Facebook:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_facebook')); ?>" value="<?php print esc_attr($bwall_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_twitter')); ?>" value="<?php print esc_attr($bwall_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('Instagram:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_instagram')); ?>" value="<?php print esc_attr($bwall_instagram); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_linkedin')); ?>" value="<?php print esc_attr($bwall_linkedin); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

			$instance['bwall_facebook'] = ( ! empty( $new_instance['bwall_facebook'] ) ) ? strip_tags( $new_instance['bwall_facebook'] ) : '';
			$instance['bwall_twitter'] = ( ! empty( $new_instance['bwall_twitter'] ) ) ? strip_tags( $new_instance['bwall_twitter'] ) : '';
			$instance['bwall_instagram'] = ( ! empty( $new_instance['bwall_instagram'] ) ) ? strip_tags( $new_instance['bwall_instagram'] ) : '';
			$instance['bwall_linkedin'] = ( ! empty( $new_instance['bwall_linkedin'] ) ) ? strip_tags( $new_instance['bwall_linkedin'] ) : '';

			$instance['image_box_image'] = ( ! empty( $new_instance['image_box_image'] ) ) ? strip_tags( $new_instance['image_box_image'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Bwall_Logo_Info_Footer_Widget_2');
	});