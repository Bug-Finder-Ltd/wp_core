<?php 
	Class Nextdestina_Footer_Lets_Talk_Widget extends WP_Widget{

		public function __construct(){
			parent::__construct('nextdestina-footer-lets-talk', 'Nextdestina Footer Lets Talk', array(
				'description'	=> 'Footer Lets Talk by Nextdestina'
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
					<?php if( !empty($nextdestina_heading_big_text) ): ?>
						<h2><?php print esc_html($nextdestina_heading_big_text); ?> <span><?php print esc_html($nextdestina_heading_small_text); ?></span></h2>
					<?php endif;?>
					<?php if( !empty($nextdestina_heading_link) ): ?>
						<a href="<?php print esc_url($nextdestina_heading_link); ?>"><img src="<?php echo get_template_directory_uri(). '/assets/img/icons/arrow-big.png';?>" alt="icon"></a>
					<?php endif;?>
				</div>
				<div class="footer-bottom-right-content">
					<?php if( !empty($nextdestina_phone) ): ?>
						<div class="tel"> 
							<a href="tel:<?php print esc_url($nextdestina_phone); ?>"><?php print esc_html($nextdestina_phone); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($nextdestina_email) ): ?>
						<div class="mail"> 
							<a href="mailto:<?php print esc_url($nextdestina_email); ?>"><?php print esc_html($nextdestina_email); ?></a> 
						</div>
					<?php endif;?>
					<?php if( !empty($nextdestina_website) ): ?>
						<div class="web"> 
							<a href="<?php print esc_url($nextdestina_website); ?>"><?php print esc_html($nextdestina_website); ?></a> 
						</div>
					<?php endif;?>
				</div>

              	<?php print $after_widget; ?>
			<?php 
		}

		public function form($instance){

			$nextdestina_heading_big_text  = isset($instance['nextdestina_heading_big_text'])? $instance['nextdestina_heading_big_text']:'';
			$nextdestina_heading_small_text  = isset($instance['nextdestina_heading_small_text'])? $instance['nextdestina_heading_small_text']:'';
			$nextdestina_heading_link  = isset($instance['nextdestina_heading_link'])? $instance['nextdestina_heading_link']:'';
			$nextdestina_phone  = isset($instance['nextdestina_phone'])? $instance['nextdestina_phone']:'';
			$nextdestina_email  = isset($instance['nextdestina_email'])? $instance['nextdestina_email']:'';
			$nextdestina_website  = isset($instance['nextdestina_website'])? $instance['nextdestina_website']:'';

			?>

			<p>
				<label for="title"><?php esc_html_e('Heading Big Text:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_heading_big_text')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_heading_big_text')); ?>" value="<?php print esc_attr($nextdestina_heading_big_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Small Text:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_heading_small_text')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_heading_small_text')); ?>" value="<?php print esc_attr($nextdestina_heading_small_text); ?>">

			<p>
				<label for="title"><?php esc_html_e('Heading Link:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_heading_link')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_heading_link')); ?>" value="<?php print esc_attr($nextdestina_heading_link); ?>">

			<p>
				<label for="title"><?php esc_html_e('Phone:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_phone')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_phone')); ?>" value="<?php print esc_attr($nextdestina_phone); ?>">

			<p>
				<label for="title"><?php esc_html_e('Email:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_email')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_email')); ?>" value="<?php print esc_attr($nextdestina_email); ?>">

			<p>
				<label for="title"><?php esc_html_e('Website:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('nextdestina_website')); ?>"  name="<?php print esc_attr($this->get_field_name('nextdestina_website')); ?>" value="<?php print esc_attr($nextdestina_website); ?>">
			
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['nextdestina_heading_big_text'] = ( ! empty( $new_instance['nextdestina_heading_big_text'] ) ) ? strip_tags( $new_instance['nextdestina_heading_big_text'] ) : '';
			$instance['nextdestina_heading_small_text'] = ( ! empty( $new_instance['nextdestina_heading_small_text'] ) ) ? strip_tags( $new_instance['nextdestina_heading_small_text'] ) : '';
			$instance['nextdestina_heading_link'] = ( ! empty( $new_instance['nextdestina_heading_link'] ) ) ? strip_tags( $new_instance['nextdestina_heading_link'] ) : '';
			$instance['nextdestina_phone'] = ( ! empty( $new_instance['nextdestina_phone'] ) ) ? strip_tags( $new_instance['nextdestina_phone'] ) : '';
			$instance['nextdestina_email'] = ( ! empty( $new_instance['nextdestina_email'] ) ) ? strip_tags( $new_instance['nextdestina_email'] ) : '';
			$instance['nextdestina_website'] = ( ! empty( $new_instance['nextdestina_website'] ) ) ? strip_tags( $new_instance['nextdestina_website'] ) : '';

			return $instance;
		}
	}

	add_action('widgets_init', function(){
		register_widget('Nextdestina_Footer_Lets_Talk_Widget');
	});