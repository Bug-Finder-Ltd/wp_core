<?php 
	Class Nextdestina_Logo_Info_Footer_Widget_2 extends WP_Widget{

		public function __construct(){
			parent::__construct('nextdestina-logo-info-footer-2', 'Nextdestina Footer Logo Info 2', array(
				'description'	=> 'Logo Info Widget 2 by Nextdestina'
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
						<?php if( !empty($nextdestina_location) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-location-dot"></i>
								</div>
								<p class="description"><?php echo esc_html__($nextdestina_location, 'nextdestinacore'); ?></p>
							</div>
						<?php endif; ?>
						<?php if( !empty($nextdestina_phone) ): ?>
							<div class="box">
								<div class="icon">
									<i class="fa-light fa-phone"></i>
								</div>
								<p class="description"><?php echo esc_html__($nextdestina_phone, 'nextdestinacore'); ?></p>
							</div>
						<?php endif; ?>
					</div>
                    
                    <ul class="social">
						<?php if( !empty($nextdestina_facebook) ): ?>
							<li><a href="<?php print esc_url($nextdestina_facebook); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($nextdestina_instagram) ): ?>
							<li><a href="<?php print esc_url($nextdestina_instagram); ?>"><i class="fa-brands fa-instagram"></i></a></li>
						<?php endif; ?>
						<?php if( !empty($nextdestina_twitter) ): ?>
							<li><a href="<?php print esc_url($nextdestina_twitter); ?>"><span class="fa-solid fa-xmark"></span></a></li>
						<?php endif; ?>
						<?php if( !empty($nextdestina_linkedin) ): ?>
							<li><a href="<?php print esc_url($nextdestina_linkedin); ?>"><span class="fa-brands fa-linkedin-in"></span></a></li>
						<?php endif; ?>
					</ul>
                    
                </div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$author_img  = isset($instance['image_box_image'])? $instance['image_box_image']:'';

			$nextdestina_location  = isset($instance['nextdestina_location'])? $instance['nextdestina_location']:'';
			$nextdestina_phone  = isset($instance['nextdestina_phone'])? $instance['nextdestina_phone']:'';

			$nextdestina_twitter  = isset($instance['nextdestina_twitter'])? $instance['nextdestina_twitter']:'';
			$nextdestina_facebook  = isset($instance['nextdestina_facebook'])? $instance['nextdestina_facebook']:'';
			$nextdestina_instagram  = isset($instance['nextdestina_instagram'])? $instance['nextdestina_instagram']:'';
			$nextdestina_linkedin  = isset($instance['nextdestina_linkedin'])? $instance['nextdestina_linkedin']:'';

			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','nextdestinacore'); ?></label>
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
				<label for="title"><?php esc_html_e('Location','nextdestinacore'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_location')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_location')); ?>" value="<?php print esc_attr($nextdestina_location); ?>" class="widefat">
			</p>
			<p>
				<label for="title"><?php esc_html_e('Phone','nextdestinacore'); ?></label>
				<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_phone')); ?>" value="<?php print esc_attr($nextdestina_phone); ?>" class="widefat">
			</p>

			<p>
				<label for="title"><?php esc_html_e('Facebook:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_facebook')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_facebook')); ?>" value="<?php print esc_attr($nextdestina_facebook); ?>">


			<p>
				<label for="title"><?php esc_html_e('Twitter:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_twitter')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_twitter')); ?>" value="<?php print esc_attr($nextdestina_twitter); ?>">

			<p>
				<label for="title"><?php esc_html_e('Instagram:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_instagram')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_instagram')); ?>" value="<?php print esc_attr($nextdestina_instagram); ?>">

			<p>
				<label for="title"><?php esc_html_e('linkedin:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_linkedin')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_linkedin')); ?>" value="<?php print esc_attr($nextdestina_linkedin); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			$instance['nextdestina_location'] = ( ! empty( $new_instance['nextdestina_location'] ) ) ? strip_tags( $new_instance['nextdestina_location'] ) : '';
			$instance['nextdestina_phone'] = ( ! empty( $new_instance['nextdestina_phone'] ) ) ? strip_tags( $new_instance['nextdestina_phone'] ) : '';

			$instance['nextdestina_facebook'] = ( ! empty( $new_instance['nextdestina_facebook'] ) ) ? strip_tags( $new_instance['nextdestina_facebook'] ) : '';
			$instance['nextdestina_twitter'] = ( ! empty( $new_instance['nextdestina_twitter'] ) ) ? strip_tags( $new_instance['nextdestina_twitter'] ) : '';
			$instance['nextdestina_instagram'] = ( ! empty( $new_instance['nextdestina_instagram'] ) ) ? strip_tags( $new_instance['nextdestina_instagram'] ) : '';
			$instance['nextdestina_linkedin'] = ( ! empty( $new_instance['nextdestina_linkedin'] ) ) ? strip_tags( $new_instance['nextdestina_linkedin'] ) : '';

			$instance['image_box_image'] = ( ! empty( $new_instance['image_box_image'] ) ) ? strip_tags( $new_instance['image_box_image'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Nextdestina_Logo_Info_Footer_Widget_2');
	});