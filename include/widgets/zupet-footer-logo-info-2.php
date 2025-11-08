<?php 
	Class Zupet_Logo_Info_Footer_Widget_2 extends WP_Widget{

		public function __construct(){
			parent::__construct('zupet-logo-info-footer-2', 'Zupet Footer Logo Info 2', array(
				'description'	=> 'Logo Info Widget 2 by Zupet'
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

					<div class="footer-icon-box">
						<?php if( !empty($zupet_location) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-location-dot"></i>
								</div>
								<p class="description"><?php echo esc_html__($zupet_location, 'zupetcore'); ?></p>
							</div>
						<?php endif; ?>
						<?php if( !empty($zupet_phone) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-phone"></i>
								</div>
								<p class="description"><?php echo esc_html__($zupet_phone, 'zupetcore'); ?></p>
							</div>
						<?php endif; ?>
					</div>
                    
                    <ul class="social">
						<?php if( !empty($zupet_facebook) ): ?>
							<li><a href="<?php print esc_url($zupet_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($zupet_instagram) ): ?>
							<li><a href="<?php print esc_url($zupet_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($zupet_twitter) ): ?>
							<li><a href="<?php print esc_url($zupet_twitter); ?>"><span class="fa-solid fa-xmark"></span></a></li>
						<?php endif; ?>
						<?php if( !empty($zupet_linkedin) ): ?>
							<li><a href="<?php print esc_url($zupet_linkedin); ?>"><span class="fa-brands fa-linkedin-in"></span></a></li>
						<?php endif; ?>
					</ul>
                    
                </div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$author_img  = isset($instance['image_box_image'])? $instance['image_box_image']:'';

			$zupet_location  = isset($instance['zupet_location'])? $instance['zupet_location']:'';
			$zupet_phone  = isset($instance['zupet_phone'])? $instance['zupet_phone']:'';

			$zupet_twitter  = isset($instance['zupet_twitter'])? $instance['zupet_twitter']:'';
			$zupet_facebook  = isset($instance['zupet_facebook'])? $instance['zupet_facebook']:'';
			$zupet_instagram  = isset($instance['zupet_instagram'])? $instance['zupet_instagram']:'';
			$zupet_linkedin  = isset($instance['zupet_linkedin'])? $instance['zupet_linkedin']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

			<p>
				<button type="submit" class="button button-secondary" id="author_info_image">Upload Media</button>
				<input type="hidden" name="<?php print esc_attr($this->get_field_name('image_box_image')); ?>" class="image_er_link" value="<?php print $author_img ; ?>">
				<div class="author-image-show">
					<img src="<?php print $author_img ; ?>" alt="" width="150" height="auto">
				</div>	
			</p>

			<p>
				<label for="title"><?php esc_html_e('Location','zupetcore'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_location')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_location')); ?>" value="<?php print esc_attr($zupet_location); ?>" class="widefat">
			</p>
			<p>
				<label for="title"><?php esc_html_e('Phone','zupetcore'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_phone')); ?>" value="<?php print esc_attr($zupet_phone); ?>" class="widefat">
			</p>

			<p>
				<label for="title"><?php esc_html_e('Facebook:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_facebook')); ?>" value="<?php print esc_attr($zupet_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_twitter')); ?>" value="<?php print esc_attr($zupet_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('Instagram:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_instagram')); ?>" value="<?php print esc_attr($zupet_instagram); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_linkedin')); ?>" value="<?php print esc_attr($zupet_linkedin); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['zupet_location'] = ( ! empty( $new_instance['zupet_location'] ) ) ? strip_tags( $new_instance['zupet_location'] ) : '';
			$instance['zupet_phone'] = ( ! empty( $new_instance['zupet_phone'] ) ) ? strip_tags( $new_instance['zupet_phone'] ) : '';

			$instance['zupet_facebook'] = ( ! empty( $new_instance['zupet_facebook'] ) ) ? strip_tags( $new_instance['zupet_facebook'] ) : '';
			$instance['zupet_twitter'] = ( ! empty( $new_instance['zupet_twitter'] ) ) ? strip_tags( $new_instance['zupet_twitter'] ) : '';
			$instance['zupet_instagram'] = ( ! empty( $new_instance['zupet_instagram'] ) ) ? strip_tags( $new_instance['zupet_instagram'] ) : '';
			$instance['zupet_linkedin'] = ( ! empty( $new_instance['zupet_linkedin'] ) ) ? strip_tags( $new_instance['zupet_linkedin'] ) : '';

			$instance['image_box_image'] = ( ! empty( $new_instance['image_box_image'] ) ) ? strip_tags( $new_instance['image_box_image'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Zupet_Logo_Info_Footer_Widget_2');
	});