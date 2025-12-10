<?php 
	Class Raizen_Footer_Lets_Talk_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('raizen-footer-lets-talk', 'Raizen Footer Lets Talk', array(
				'description'	=> 'Footer Lets Talk by Raizen'
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
					<?php if( !empty($raizen_heading_big_text) ): ?>
						<h2><?php print esc_html($raizen_heading_big_text); ?> <span><?php print esc_html($raizen_heading_small_text); ?></span></h2>
					<?php endif;?>
					<?php if( !empty($raizen_heading_link) ): ?>
						<a href="<?php print esc_url($raizen_heading_link); ?>"><img src="<?php echo get_template_directory_uri(). '/assets/img/icons/arrow-big.png';?>" alt="icon"></a>
					<?php endif;?>
				</div>
				<div class="footer-bottom-right-content">
					<?php if( !empty($raizen_phone) ): ?>
						<div class="tel"> 
							<a href="tel:<?php print esc_url($raizen_phone); ?>"><?php print esc_html($raizen_phone); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($raizen_email) ): ?>
						<div class="mail"> 
							<a href="mailto:<?php print esc_url($raizen_email); ?>"><?php print esc_html($raizen_email); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($raizen_website) ): ?>
						<div class="web"> 
							<a href="<?php print esc_url($raizen_website); ?>"><?php print esc_html($raizen_website); ?></a> 
						</div>
					<?php endif;?>
				</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$raizen_heading_big_text  = isset($instance['raizen_heading_big_text'])? $instance['raizen_heading_big_text']:'';
			$raizen_heading_small_text  = isset($instance['raizen_heading_small_text'])? $instance['raizen_heading_small_text']:'';
			$raizen_heading_link  = isset($instance['raizen_heading_link'])? $instance['raizen_heading_link']:'';
			$raizen_phone  = isset($instance['raizen_phone'])? $instance['raizen_phone']:'';
			$raizen_email  = isset($instance['raizen_email'])? $instance['raizen_email']:'';
			$raizen_website  = isset($instance['raizen_website'])? $instance['raizen_website']:'';

			?>

			<p>
				<label for="title"><?php esc_html_e('Heading Big Text:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_heading_big_text')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_heading_big_text')); ?>" value="<?php print esc_attr($raizen_heading_big_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Small Text:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_heading_small_text')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_heading_small_text')); ?>" value="<?php print esc_attr($raizen_heading_small_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Link:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_heading_link')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_heading_link')); ?>" value="<?php print esc_attr($raizen_heading_link); ?>">

			<p>
				<label for="title"><?php esc_html_e('Phone:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_phone')); ?>" value="<?php print esc_attr($raizen_phone); ?>">

			<p>
				<label for="title"><?php esc_html_e('Email:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_email')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_email')); ?>" value="<?php print esc_attr($raizen_email); ?>">

			<p>
				<label for="title"><?php esc_html_e('Website:','raizencore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('raizen_website')); ?>"  name="<?php print esc_attr($this->get_field_name('raizen_website')); ?>" value="<?php print esc_attr($raizen_website); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['raizen_heading_big_text'] = ( ! empty( $new_instance['raizen_heading_big_text'] ) ) ? strip_tags( $new_instance['raizen_heading_big_text'] ) : '';
			$instance['raizen_heading_small_text'] = ( ! empty( $new_instance['raizen_heading_small_text'] ) ) ? strip_tags( $new_instance['raizen_heading_small_text'] ) : '';
			$instance['raizen_heading_link'] = ( ! empty( $new_instance['raizen_heading_link'] ) ) ? strip_tags( $new_instance['raizen_heading_link'] ) : '';
			$instance['raizen_phone'] = ( ! empty( $new_instance['raizen_phone'] ) ) ? strip_tags( $new_instance['raizen_phone'] ) : '';
			$instance['raizen_email'] = ( ! empty( $new_instance['raizen_email'] ) ) ? strip_tags( $new_instance['raizen_email'] ) : '';
			$instance['raizen_website'] = ( ! empty( $new_instance['raizen_website'] ) ) ? strip_tags( $new_instance['raizen_website'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Raizen_Footer_Lets_Talk_Widget');
	});