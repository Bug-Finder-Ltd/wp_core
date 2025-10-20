<?php 
	Class Bwall_Footer_Lets_Talk_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('bwall-footer-lets-talk', 'Bwall Footer Lets Talk', array(
				'description'	=> 'Footer Lets Talk by Bwall'
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
					<?php if( !empty($bwall_heading_big_text) ): ?>
						<h2><?php print esc_html($bwall_heading_big_text); ?> <span><?php print esc_html($bwall_heading_small_text); ?></span></h2>
					<?php endif;?>
					<?php if( !empty($bwall_heading_link) ): ?>
						<a href="<?php print esc_url($bwall_heading_link); ?>"><img src="<?php echo get_template_directory_uri(). '/assets/img/icons/arrow-big.png';?>" alt="icon"></a>
					<?php endif;?>
				</div>
				<div class="footer-bottom-right-content">
					<?php if( !empty($bwall_phone) ): ?>
						<div class="tel"> 
							<a href="tel:<?php print esc_url($bwall_phone); ?>"><?php print esc_html($bwall_phone); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($bwall_email) ): ?>
						<div class="mail"> 
							<a href="mailto:<?php print esc_url($bwall_email); ?>"><?php print esc_html($bwall_email); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($bwall_website) ): ?>
						<div class="web"> 
							<a href="<?php print esc_url($bwall_website); ?>"><?php print esc_html($bwall_website); ?></a> 
						</div>
					<?php endif;?>
				</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$bwall_heading_big_text  = isset($instance['bwall_heading_big_text'])? $instance['bwall_heading_big_text']:'';
			$bwall_heading_small_text  = isset($instance['bwall_heading_small_text'])? $instance['bwall_heading_small_text']:'';
			$bwall_heading_link  = isset($instance['bwall_heading_link'])? $instance['bwall_heading_link']:'';
			$bwall_phone  = isset($instance['bwall_phone'])? $instance['bwall_phone']:'';
			$bwall_email  = isset($instance['bwall_email'])? $instance['bwall_email']:'';
			$bwall_website  = isset($instance['bwall_website'])? $instance['bwall_website']:'';

			?>

			<p>
				<label for="title"><?php esc_html_e('Heading Big Text:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_heading_big_text')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_heading_big_text')); ?>" value="<?php print esc_attr($bwall_heading_big_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Small Text:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_heading_small_text')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_heading_small_text')); ?>" value="<?php print esc_attr($bwall_heading_small_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Link:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_heading_link')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_heading_link')); ?>" value="<?php print esc_attr($bwall_heading_link); ?>">

			<p>
				<label for="title"><?php esc_html_e('Phone:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_phone')); ?>" value="<?php print esc_attr($bwall_phone); ?>">

			<p>
				<label for="title"><?php esc_html_e('Email:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_email')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_email')); ?>" value="<?php print esc_attr($bwall_email); ?>">

			<p>
				<label for="title"><?php esc_html_e('Website:','bwallcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('bwall_website')); ?>"  name="<?php print esc_attr($this->get_field_name('bwall_website')); ?>" value="<?php print esc_attr($bwall_website); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['bwall_heading_big_text'] = ( ! empty( $new_instance['bwall_heading_big_text'] ) ) ? strip_tags( $new_instance['bwall_heading_big_text'] ) : '';
			$instance['bwall_heading_small_text'] = ( ! empty( $new_instance['bwall_heading_small_text'] ) ) ? strip_tags( $new_instance['bwall_heading_small_text'] ) : '';
			$instance['bwall_heading_link'] = ( ! empty( $new_instance['bwall_heading_link'] ) ) ? strip_tags( $new_instance['bwall_heading_link'] ) : '';
			$instance['bwall_phone'] = ( ! empty( $new_instance['bwall_phone'] ) ) ? strip_tags( $new_instance['bwall_phone'] ) : '';
			$instance['bwall_email'] = ( ! empty( $new_instance['bwall_email'] ) ) ? strip_tags( $new_instance['bwall_email'] ) : '';
			$instance['bwall_website'] = ( ! empty( $new_instance['bwall_website'] ) ) ? strip_tags( $new_instance['bwall_website'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Bwall_Footer_Lets_Talk_Widget');
	});