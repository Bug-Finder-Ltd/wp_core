<?php 
	Class Provix_Footer_Lets_Talk_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('provix-footer-lets-talk', 'Provix Footer Lets Talk', array(
				'description'	=> 'Footer Lets Talk by Provix'
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
				<div class="footer-bottom-right-title">
					<?php if( !empty($provix_heading_big_text) ): ?>
						<h2><?php print esc_html($provix_heading_big_text); ?> <span><?php print esc_html($provix_heading_small_text); ?></span></h2>
					<?php endif;?>
					<?php if( !empty($provix_heading_link) ): ?>
						<a href="<?php print esc_url($provix_heading_link); ?>"><img src="<?php echo get_template_directory_uri(). '/assets/img/icons/arrow-big.png';?>" alt="icon"></a>
					<?php endif;?>
				</div>
				<div class="footer-bottom-right-content">
					<?php if( !empty($provix_phone) ): ?>
						<div class="tel"> 
							<a href="tel:<?php print esc_url($provix_phone); ?>"><?php print esc_html($provix_phone); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($provix_email) ): ?>
						<div class="mail"> 
							<a href="mailto:<?php print esc_url($provix_email); ?>"><?php print esc_html($provix_email); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($provix_website) ): ?>
						<div class="web"> 
							<a href="<?php print esc_url($provix_website); ?>"><?php print esc_html($provix_website); ?></a> 
						</div>
					<?php endif;?>
				</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$provix_heading_big_text  = isset($instance['provix_heading_big_text'])? $instance['provix_heading_big_text']:'';
			$provix_heading_small_text  = isset($instance['provix_heading_small_text'])? $instance['provix_heading_small_text']:'';
			$provix_heading_link  = isset($instance['provix_heading_link'])? $instance['provix_heading_link']:'';
			$provix_phone  = isset($instance['provix_phone'])? $instance['provix_phone']:'';
			$provix_email  = isset($instance['provix_email'])? $instance['provix_email']:'';
			$provix_website  = isset($instance['provix_website'])? $instance['provix_website']:'';

			?>

			<p>
				<label for="title"><?php esc_html_e('Heading Big Text:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_heading_big_text')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_heading_big_text')); ?>" value="<?php print esc_attr($provix_heading_big_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Small Text:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_heading_small_text')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_heading_small_text')); ?>" value="<?php print esc_attr($provix_heading_small_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Link:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_heading_link')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_heading_link')); ?>" value="<?php print esc_attr($provix_heading_link); ?>">

			<p>
				<label for="title"><?php esc_html_e('Phone:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_phone')); ?>" value="<?php print esc_attr($provix_phone); ?>">

			<p>
				<label for="title"><?php esc_html_e('Email:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_email')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_email')); ?>" value="<?php print esc_attr($provix_email); ?>">

			<p>
				<label for="title"><?php esc_html_e('Website:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('provix_website')); ?>"  name="<?php print esc_attr($this->get_field_name('provix_website')); ?>" value="<?php print esc_attr($provix_website); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['provix_heading_big_text'] = ( ! empty( $new_instance['provix_heading_big_text'] ) ) ? strip_tags( $new_instance['provix_heading_big_text'] ) : '';
			$instance['provix_heading_small_text'] = ( ! empty( $new_instance['provix_heading_small_text'] ) ) ? strip_tags( $new_instance['provix_heading_small_text'] ) : '';
			$instance['provix_heading_link'] = ( ! empty( $new_instance['provix_heading_link'] ) ) ? strip_tags( $new_instance['provix_heading_link'] ) : '';
			$instance['provix_phone'] = ( ! empty( $new_instance['provix_phone'] ) ) ? strip_tags( $new_instance['provix_phone'] ) : '';
			$instance['provix_email'] = ( ! empty( $new_instance['provix_email'] ) ) ? strip_tags( $new_instance['provix_email'] ) : '';
			$instance['provix_website'] = ( ! empty( $new_instance['provix_website'] ) ) ? strip_tags( $new_instance['provix_website'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Provix_Footer_Lets_Talk_Widget');
	});