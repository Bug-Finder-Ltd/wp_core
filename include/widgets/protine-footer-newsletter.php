<?php 
	Class Protine_Footer_Lets_Talk_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('protine-footer-lets-talk', 'Protine Footer Lets Talk', array(
				'description'	=> 'Footer Lets Talk by Protine'
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
					<?php if( !empty($protine_heading_big_text) ): ?>
						<h2><?php print esc_html($protine_heading_big_text); ?> <span><?php print esc_html($protine_heading_small_text); ?></span></h2>
					<?php endif;?>
					<?php if( !empty($protine_heading_link) ): ?>
						<a href="<?php print esc_url($protine_heading_link); ?>"><img src="<?php echo get_template_directory_uri(). '/assets/img/icons/arrow-big.png';?>" alt="icon"></a>
					<?php endif;?>
				</div>
				<div class="footer-bottom-right-content">
					<?php if( !empty($protine_phone) ): ?>
						<div class="tel"> 
							<a href="tel:<?php print esc_url($protine_phone); ?>"><?php print esc_html($protine_phone); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($protine_email) ): ?>
						<div class="mail"> 
							<a href="mailto:<?php print esc_url($protine_email); ?>"><?php print esc_html($protine_email); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($protine_website) ): ?>
						<div class="web"> 
							<a href="<?php print esc_url($protine_website); ?>"><?php print esc_html($protine_website); ?></a> 
						</div>
					<?php endif;?>
				</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$protine_heading_big_text  = isset($instance['protine_heading_big_text'])? $instance['protine_heading_big_text']:'';
			$protine_heading_small_text  = isset($instance['protine_heading_small_text'])? $instance['protine_heading_small_text']:'';
			$protine_heading_link  = isset($instance['protine_heading_link'])? $instance['protine_heading_link']:'';
			$protine_phone  = isset($instance['protine_phone'])? $instance['protine_phone']:'';
			$protine_email  = isset($instance['protine_email'])? $instance['protine_email']:'';
			$protine_website  = isset($instance['protine_website'])? $instance['protine_website']:'';

			?>

			<p>
				<label for="title"><?php esc_html_e('Heading Big Text:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_heading_big_text')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_heading_big_text')); ?>" value="<?php print esc_attr($protine_heading_big_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Small Text:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_heading_small_text')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_heading_small_text')); ?>" value="<?php print esc_attr($protine_heading_small_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Link:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_heading_link')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_heading_link')); ?>" value="<?php print esc_attr($protine_heading_link); ?>">

			<p>
				<label for="title"><?php esc_html_e('Phone:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_phone')); ?>" value="<?php print esc_attr($protine_phone); ?>">

			<p>
				<label for="title"><?php esc_html_e('Email:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_email')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_email')); ?>" value="<?php print esc_attr($protine_email); ?>">

			<p>
				<label for="title"><?php esc_html_e('Website:','protinecore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('protine_website')); ?>"  name="<?php print esc_attr($this->get_field_name('protine_website')); ?>" value="<?php print esc_attr($protine_website); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['protine_heading_big_text'] = ( ! empty( $new_instance['protine_heading_big_text'] ) ) ? strip_tags( $new_instance['protine_heading_big_text'] ) : '';
			$instance['protine_heading_small_text'] = ( ! empty( $new_instance['protine_heading_small_text'] ) ) ? strip_tags( $new_instance['protine_heading_small_text'] ) : '';
			$instance['protine_heading_link'] = ( ! empty( $new_instance['protine_heading_link'] ) ) ? strip_tags( $new_instance['protine_heading_link'] ) : '';
			$instance['protine_phone'] = ( ! empty( $new_instance['protine_phone'] ) ) ? strip_tags( $new_instance['protine_phone'] ) : '';
			$instance['protine_email'] = ( ! empty( $new_instance['protine_email'] ) ) ? strip_tags( $new_instance['protine_email'] ) : '';
			$instance['protine_website'] = ( ! empty( $new_instance['protine_website'] ) ) ? strip_tags( $new_instance['protine_website'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Protine_Footer_Lets_Talk_Widget');
	});