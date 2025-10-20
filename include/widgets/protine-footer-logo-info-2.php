<?php 
	Class Protine_Logo_Info_Footer_Widget_2 extends WP_Widget{

		public function __construct(){
			parent::__construct('protine-logo-info-footer-2', 'Protine Footer Logo Info 2', array(
				'description'	=> 'Logo Info Widget 2 by Protine'
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
						<?php if( !empty($protine_location) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-location-dot"></i>
								</div>
								<p class="description"><?php echo esc_html__($protine_location, 'protinecore'); ?></p>
							</div>
						<?php endif; ?>
						<?php if( !empty($protine_phone) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-phone"></i>
								</div>
								<p class="description"><?php echo esc_html__($protine_phone, 'protinecore'); ?></p>
							</div>
						<?php endif; ?>
					</div>
                    
                    <ul class="social">
						<?php if( !empty($protine_facebook) ): ?>
							<li><a href="<?php print esc_url($protine_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($protine_instagram) ): ?>
							<li><a href="<?php print esc_url($protine_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($protine_twitter) ): ?>
							<li><a href="<?php print esc_url($protine_twitter); ?>"><span class="fa-solid fa-xmark"></span></a></li>
						<?php endif; ?>
						<?php if( !empty($protine_linkedin) ): ?>
							<li><a href="<?php print esc_url($protine_linkedin); ?>"><span class="fa-brands fa-linkedin-in"></span></a></li>
						<?php endif; ?>
					</ul>
                    
                </div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$author_img  = isset($instance['image_box_image'])? $instance['image_box_image']:'';

			$protine_location  = isset($instance['protine_location'])? $instance['protine_location']:'';
			$protine_phone  = isset($instance['protine_phone'])? $instance['protine_phone']:'';

			$protine_twitter  = isset($instance['protine_twitter'])? $instance['protine_twitter']:'';
			$protine_facebook  = isset($instance['protine_facebook'])? $instance['protine_facebook']:'';
			$protine_instagram  = isset($instance['protine_instagram'])? $instance['protine_instagram']:'';
			$protine_linkedin  = isset($instance['protine_linkedin'])? $instance['protine_linkedin']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','protinecore'); ?></label>
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
				<label for="title"><?php esc_html_e('Location','protinecore'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('protine_location')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_location')); ?>" value="<?php print esc_attr($protine_location); ?>" class="widefat">
			</p>
			<p>
				<label for="title"><?php esc_html_e('Phone','protinecore'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('protine_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_phone')); ?>" value="<?php print esc_attr($protine_phone); ?>" class="widefat">
			</p>

			<p>
				<label for="title"><?php esc_html_e('Facebook:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_facebook')); ?>" value="<?php print esc_attr($protine_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_twitter')); ?>" value="<?php print esc_attr($protine_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('Instagram:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_instagram')); ?>" value="<?php print esc_attr($protine_instagram); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_linkedin')); ?>" value="<?php print esc_attr($protine_linkedin); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['protine_location'] = ( ! empty( $new_instance['protine_location'] ) ) ? strip_tags( $new_instance['protine_location'] ) : '';
			$instance['protine_phone'] = ( ! empty( $new_instance['protine_phone'] ) ) ? strip_tags( $new_instance['protine_phone'] ) : '';

			$instance['protine_facebook'] = ( ! empty( $new_instance['protine_facebook'] ) ) ? strip_tags( $new_instance['protine_facebook'] ) : '';
			$instance['protine_twitter'] = ( ! empty( $new_instance['protine_twitter'] ) ) ? strip_tags( $new_instance['protine_twitter'] ) : '';
			$instance['protine_instagram'] = ( ! empty( $new_instance['protine_instagram'] ) ) ? strip_tags( $new_instance['protine_instagram'] ) : '';
			$instance['protine_linkedin'] = ( ! empty( $new_instance['protine_linkedin'] ) ) ? strip_tags( $new_instance['protine_linkedin'] ) : '';

			$instance['image_box_image'] = ( ! empty( $new_instance['image_box_image'] ) ) ? strip_tags( $new_instance['image_box_image'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Protine_Logo_Info_Footer_Widget_2');
	});