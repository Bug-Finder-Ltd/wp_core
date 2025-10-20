<?php 
	Class Bwall_Logo_Info_Footer_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('bwall-logo-info-footer', 'Bwall Footer Logo Info', array(
				'description'	=> 'Logo Info Widget by Bwall'
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
                
                	<?php if( !empty($image_box_image) ): ?>
						<div class="footer-logo">
							<a href="<?php  print home_url(); ?>"><img src="<?php print $image_box_image; ?>" alt="Footer Logo"></a>
						</div>
					<?php endif; ?>
					
                    <?php if( !empty($description) ): ?>
						<div class="footer-top-time">
                    		<p><span><?php print $description; ?></span></p>
						</div>
					<?php endif; ?>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$title  = isset($instance['title'])? $instance['title']:'';
			$description  = isset($instance['description'])? $instance['description']:'';
			$author_img  = isset($instance['image_box_image'])? $instance['image_box_image']:'';

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
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
			$instance['image_box_image'] = ( ! empty( $new_instance['image_box_image'] ) ) ? strip_tags( $new_instance['image_box_image'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Bwall_Logo_Info_Footer_Widget');
	});