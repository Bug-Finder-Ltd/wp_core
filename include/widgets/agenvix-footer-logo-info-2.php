<?php 
	Class Provix_Logo_Info_Footer_Widget_2 extends WP_Widget{

		public function __construct(){
			parent::__construct('provix-logo-info-footer-2', 'Provix Footer Logo Info 2', array(
				'description'	=> 'Logo Info Widget 2 by Provix'
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
						<?php if( !empty($provix_location) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-location-dot"></i>
								</div>
								<p class="description"><?php echo esc_html__($provix_location, 'agenvix-core'); ?></p>
							</div>
						<?php endif; ?>
						<?php if( !empty($provix_phone) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-phone"></i>
								</div>
								<p class="description"><?php echo esc_html__($provix_phone, 'agenvix-core'); ?></p>
							</div>
						<?php endif; ?>
					</div>
                    
                    <ul class="social">
						<?php if( !empty($provix_facebook) ): ?>
							<li><a href="<?php print esc_url($provix_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($provix_instagram) ): ?>
							<li><a href="<?php print esc_url($provix_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($provix_twitter) ): ?>
							<li><a href="<?php print esc_url($provix_twitter); ?>"><span class="fa-solid fa-xmark"></span></a></li>
						<?php endif; ?>
						<?php if( !empty($provix_linkedin) ): ?>
							<li><a href="<?php print esc_url($provix_linkedin); ?>"><span class="fa-brands fa-linkedin-in"></span></a></li>
						<?php endif; ?>
					</ul>
                    
                </div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$author_img  = isset($instance['image_box_image'])? $instance['image_box_image']:'';

			$provix_location  = isset($instance['provix_location'])? $instance['provix_location']:'';
			$provix_phone  = isset($instance['provix_phone'])? $instance['provix_phone']:'';

			$provix_twitter  = isset($instance['provix_twitter'])? $instance['provix_twitter']:'';
			$provix_facebook  = isset($instance['provix_facebook'])? $instance['provix_facebook']:'';
			$provix_instagram  = isset($instance['provix_instagram'])? $instance['provix_instagram']:'';
			$provix_linkedin  = isset($instance['provix_linkedin'])? $instance['provix_linkedin']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','agenvix-core'); ?></label>
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
				<label for="title"><?php esc_html_e('Location','agenvix-core'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('provix_location')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_location')); ?>" value="<?php print esc_attr($provix_location); ?>" class="widefat">
			</p>
			<p>
				<label for="title"><?php esc_html_e('Phone','agenvix-core'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('provix_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_phone')); ?>" value="<?php print esc_attr($provix_phone); ?>" class="widefat">
			</p>

			<p>
				<label for="title"><?php esc_html_e('Facebook:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_facebook')); ?>" value="<?php print esc_attr($provix_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_twitter')); ?>" value="<?php print esc_attr($provix_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('Instagram:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_instagram')); ?>" value="<?php print esc_attr($provix_instagram); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_linkedin')); ?>" value="<?php print esc_attr($provix_linkedin); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['provix_location'] = ( ! empty( $new_instance['provix_location'] ) ) ? strip_tags( $new_instance['provix_location'] ) : '';
			$instance['provix_phone'] = ( ! empty( $new_instance['provix_phone'] ) ) ? strip_tags( $new_instance['provix_phone'] ) : '';

			$instance['provix_facebook'] = ( ! empty( $new_instance['provix_facebook'] ) ) ? strip_tags( $new_instance['provix_facebook'] ) : '';
			$instance['provix_twitter'] = ( ! empty( $new_instance['provix_twitter'] ) ) ? strip_tags( $new_instance['provix_twitter'] ) : '';
			$instance['provix_instagram'] = ( ! empty( $new_instance['provix_instagram'] ) ) ? strip_tags( $new_instance['provix_instagram'] ) : '';
			$instance['provix_linkedin'] = ( ! empty( $new_instance['provix_linkedin'] ) ) ? strip_tags( $new_instance['provix_linkedin'] ) : '';

			$instance['image_box_image'] = ( ! empty( $new_instance['image_box_image'] ) ) ? strip_tags( $new_instance['image_box_image'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Provix_Logo_Info_Footer_Widget_2');
	});