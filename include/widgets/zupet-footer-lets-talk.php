<?php 
	Class Zupet_Footer_Lets_Talk_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('zupet-footer-lets-talk', 'Zupet Footer Lets Talk', array(
				'description'	=> 'Footer Lets Talk by Zupet'
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
					<?php if( !empty($zupet_heading_big_text) ): ?>
						<h2><?php print esc_html($zupet_heading_big_text); ?> <span><?php print esc_html($zupet_heading_small_text); ?></span></h2>
					<?php endif;?>
					<?php if( !empty($zupet_heading_link) ): ?>
						<a href="<?php print esc_url($zupet_heading_link); ?>"><img src="<?php echo get_template_directory_uri(). '/assets/img/icons/arrow-big.png';?>" alt="icon"></a>
					<?php endif;?>
				</div>
				<div class="footer-bottom-right-content">
					<?php if( !empty($zupet_phone) ): ?>
						<div class="tel"> 
							<a href="tel:<?php print esc_url($zupet_phone); ?>"><?php print esc_html($zupet_phone); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($zupet_email) ): ?>
						<div class="mail"> 
							<a href="mailto:<?php print esc_url($zupet_email); ?>"><?php print esc_html($zupet_email); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($zupet_website) ): ?>
						<div class="web"> 
							<a href="<?php print esc_url($zupet_website); ?>"><?php print esc_html($zupet_website); ?></a> 
						</div>
					<?php endif;?>
				</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$zupet_heading_big_text  = isset($instance['zupet_heading_big_text'])? $instance['zupet_heading_big_text']:'';
			$zupet_heading_small_text  = isset($instance['zupet_heading_small_text'])? $instance['zupet_heading_small_text']:'';
			$zupet_heading_link  = isset($instance['zupet_heading_link'])? $instance['zupet_heading_link']:'';
			$zupet_phone  = isset($instance['zupet_phone'])? $instance['zupet_phone']:'';
			$zupet_email  = isset($instance['zupet_email'])? $instance['zupet_email']:'';
			$zupet_website  = isset($instance['zupet_website'])? $instance['zupet_website']:'';

			?>

			<p>
				<label for="title"><?php esc_html_e('Heading Big Text:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_heading_big_text')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_heading_big_text')); ?>" value="<?php print esc_attr($zupet_heading_big_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Small Text:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_heading_small_text')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_heading_small_text')); ?>" value="<?php print esc_attr($zupet_heading_small_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Link:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_heading_link')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_heading_link')); ?>" value="<?php print esc_attr($zupet_heading_link); ?>">

			<p>
				<label for="title"><?php esc_html_e('Phone:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_phone')); ?>" value="<?php print esc_attr($zupet_phone); ?>">

			<p>
				<label for="title"><?php esc_html_e('Email:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_email')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_email')); ?>" value="<?php print esc_attr($zupet_email); ?>">

			<p>
				<label for="title"><?php esc_html_e('Website:','zupetcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('zupet_website')); ?>"  name="<?php print esc_attr($this->get_field_name('zupet_website')); ?>" value="<?php print esc_attr($zupet_website); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['zupet_heading_big_text'] = ( ! empty( $new_instance['zupet_heading_big_text'] ) ) ? strip_tags( $new_instance['zupet_heading_big_text'] ) : '';
			$instance['zupet_heading_small_text'] = ( ! empty( $new_instance['zupet_heading_small_text'] ) ) ? strip_tags( $new_instance['zupet_heading_small_text'] ) : '';
			$instance['zupet_heading_link'] = ( ! empty( $new_instance['zupet_heading_link'] ) ) ? strip_tags( $new_instance['zupet_heading_link'] ) : '';
			$instance['zupet_phone'] = ( ! empty( $new_instance['zupet_phone'] ) ) ? strip_tags( $new_instance['zupet_phone'] ) : '';
			$instance['zupet_email'] = ( ! empty( $new_instance['zupet_email'] ) ) ? strip_tags( $new_instance['zupet_email'] ) : '';
			$instance['zupet_website'] = ( ! empty( $new_instance['zupet_website'] ) ) ? strip_tags( $new_instance['zupet_website'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Zupet_Footer_Lets_Talk_Widget');
	});