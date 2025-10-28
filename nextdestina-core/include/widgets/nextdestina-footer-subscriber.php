<?php
class Nextdestina_Footer_Subscriber extends WP_Widget {

    public function __construct() {
        parent::__construct('nextdestina-footer-subscriber', 'Nextdestina Footer Subscriber', array(
			'description'	=> 'Footer subscriber by Nextdestina'
		));
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        $widget_id =  $args['widget_id'];

        print $before_widget;
        ?>

            <?php
            if ( !empty( $title ) ) {
                print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
            }
            ?>

            <?php if($description): ?>
                <p><?php print esc_html($description); ?></p>
            <?php endif; ?>

            <div class="footer-form">
                <?php if ( !empty( $mailchimp_shortcode ) ): ?>
                    <?php print do_shortcode( $mailchimp_shortcode );?>
                <?php endif; ?>
            </div>

	    <?php print $after_widget;?>

		<?php
}

    /**
     * widget function.
     *
     * @see WP_Widget
     * @access public
     * @param array $instance
     * @return void
     */
    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $description  = isset($instance['description'])? $instance['description']:'';
        $mailchimp_shortcode = isset( $instance['mailchimp_shortcode'] ) ? $instance['mailchimp_shortcode'] : '';

        $mailchimp_text = isset( $instance['mailchimp_text'] ) ? $instance['mailchimp_text'] : '';
        ?>
			<p><label for="title"><?php esc_html_e( 'Title:', 'nextdestinacore' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'title' ) );?>"  class="widefat" name="<?php print esc_attr( $this->get_field_name( 'title' ) );?>" value="<?php print esc_attr( $title );?>">

			<p><label for="title"><?php esc_html_e( 'Subscribe Form Shortcode:', 'nextdestinacore' );?></label></p>
            <input type="text" id="<?php print esc_attr( $this->get_field_id( 'mailchimp_shortcode' ) );?>" class="widefat" name="<?php print esc_attr( $this->get_field_name( 'mailchimp_shortcode' ) );?>" value="<?php print esc_attr( $mailchimp_shortcode );?>">
            
			<p>
				<label for="title"><?php esc_html_e('Description:','nextdestinacore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('description')); ?>"  name="<?php print esc_attr($this->get_field_name('description')); ?>" class="widefat" value="<?php print esc_attr($description); ?>">
		<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['mailchimp_shortcode'] = ( !empty( $new_instance['mailchimp_shortcode'] ) ) ? strip_tags( $new_instance['mailchimp_shortcode'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

        return $instance;
    }
}

add_action('widgets_init', function(){
	register_widget('Nextdestina_Footer_Subscriber');
});
