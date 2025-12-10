<?php 
	Class Raizen_Logo_Info_Footer_Widget_2 extends WP_Widget{

		public function __construct(){
			parent::__construct('raizen-logo-info-footer-2', 'Raizen Footer Logo Info 2', array(
				'description'	=> 'Logo Info Widget 2 by Raizen'
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
						<?php if( !empty($raizen_location) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-location-dot"></i>
								</div>
								<p class="description"><?php echo esc_html__($raizen_location, 'raizencore'); ?></p>
							</div>
						<?php endif; ?>
						<?php if( !empty($raizen_phone) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-phone"></i>
								</div>
								<p class="description"><?php echo esc_html__($raizen_phone, 'raizencore'); ?></p>
							</div>
						<?php endif; ?>
					</div>
                    
                    <ul class="social">
						<?php if( !empty($raizen_facebook) ): ?>
							<li><a href="<?php print esc_url($raizen_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($raizen_instagram) ): ?>
							<li><a href="<?php print esc_url($raizen_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($raizen_twitter) ): ?>
							<li><a href="<?php print esc_url($raizen_twitter); ?>"><span class="fa-solid fa-xmark"></span></a></li>
						<?php endif; ?>
						<?php if( !empty($raizen_linkedin) ): ?>
							<li><a href="<?php print esc_url($raizen_linkedin); ?>"><span class="fa-brands fa-linkedin-in"></span></a></li>
						<?php endif; ?>
					</ul>
                    
                </div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$author_img  = isset($instance['image_box_image'])? $instance['image_box_image']:'';

			$raizen_location  = isset($instance['raizen_location'])? $instance['raizen_location']:'';
			$raizen_phone  = isset($instance['raizen_phone'])? $instance['raizen_phone']:'';

			$raizen_twitter  = isset($instance['raizen_twitter'])? $instance['raizen_twitter']:'';
			$raizen_facebook  = isset($instance['raizen_facebook'])? $instance['raizen_facebook']:'';
			$raizen_instagram  = isset($instance['raizen_instagram'])? $instance['raizen_instagram']:'';
			$raizen_linkedin  = isset($instance['raizen_linkedin'])? $instance['raizen_linkedin']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','raizencore'); ?></label>
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
				<label for="title"><?php esc_html_e('Location','raizencore'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_location')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_location')); ?>" value="<?php print esc_attr($raizen_location); ?>" class="widefat">
			</p>
			<p>
				<label for="title"><?php esc_html_e('Phone','raizencore'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_phone')); ?>" value="<?php print esc_attr($raizen_phone); ?>" class="widefat">
			</p>

			<p>
				<label for="title"><?php esc_html_e('Facebook:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_facebook')); ?>" value="<?php print esc_attr($raizen_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_twitter')); ?>" value="<?php print esc_attr($raizen_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('Instagram:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_instagram')); ?>" value="<?php print esc_attr($raizen_instagram); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_linkedin')); ?>" value="<?php print esc_attr($raizen_linkedin); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['raizen_location'] = ( ! empty( $new_instance['raizen_location'] ) ) ? strip_tags( $new_instance['raizen_location'] ) : '';
			$instance['raizen_phone'] = ( ! empty( $new_instance['raizen_phone'] ) ) ? strip_tags( $new_instance['raizen_phone'] ) : '';

			$instance['raizen_facebook'] = ( ! empty( $new_instance['raizen_facebook'] ) ) ? strip_tags( $new_instance['raizen_facebook'] ) : '';
			$instance['raizen_twitter'] = ( ! empty( $new_instance['raizen_twitter'] ) ) ? strip_tags( $new_instance['raizen_twitter'] ) : '';
			$instance['raizen_instagram'] = ( ! empty( $new_instance['raizen_instagram'] ) ) ? strip_tags( $new_instance['raizen_instagram'] ) : '';
			$instance['raizen_linkedin'] = ( ! empty( $new_instance['raizen_linkedin'] ) ) ? strip_tags( $new_instance['raizen_linkedin'] ) : '';

			$instance['image_box_image'] = ( ! empty( $new_instance['image_box_image'] ) ) ? strip_tags( $new_instance['image_box_image'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Raizen_Logo_Info_Footer_Widget_2');
	});