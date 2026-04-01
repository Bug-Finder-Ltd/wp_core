<?php
class Provix_Footer_Subscriber_2 extends WP_Widget {

    public function __construct() {
        parent::__construct('provix-footer-subscriber-2', 'Provix Footer Subscriber 2', array(
			'description'	=> 'Footer subscriber 2 by Provix'
		));
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        $widget_id =  $args['widget_id'];

        print $before_widget;
        ?>

            <?php if ( !empty( $mailchimp_shortcode ) ): ?>
                <?php print do_shortcode( $mailchimp_shortcode );?>
            <?php endif; ?>

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

        $mailchimp_shortcode = isset( $instance['mailchimp_shortcode'] ) ? $instance['mailchimp_shortcode'] : '';

        $mailchimp_text = isset( $instance['mailchimp_text'] ) ? $instance['mailchimp_text'] : '';
        ?>
			<p><label for="title"><?php esc_html_e( 'Subscribe Form Shortcode:', 'agenvix-core' );?></label></p>
            <input type="text" id="<?php print esc_attr( $this->get_field_id( 'mailchimp_shortcode' ) );?>" class="widefat" name="<?php print esc_attr( $this->get_field_name( 'mailchimp_shortcode' ) );?>" value="<?php print esc_attr( $mailchimp_shortcode );?>">
		<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['mailchimp_shortcode'] = ( !empty( $new_instance['mailchimp_shortcode'] ) ) ? strip_tags( $new_instance['mailchimp_shortcode'] ) : '';

        return $instance;
    }
}

add_action('widgets_init', function(){
	register_widget('Provix_Footer_Subscriber_2');
});
