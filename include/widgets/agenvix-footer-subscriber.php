<?php
class Provix_Footer_Subscriber extends WP_Widget {

    public function __construct() {
        parent::__construct('provix-footer-subscriber', 'Provix Footer Subscriber', array(
			'description'	=> 'Footer subscriber by Provix'
		));
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        $widget_id =  $args['widget_id'];

        print $before_widget;
        ?>

        <div class="footer-newsletter">
            <div class="sabscribe-content">
                <?php
                    if ( ! empty( $title ) ) {
                        echo '<h4 class="sabscribe-title">' . esc_html( $title ) . '</h4>';
                    }

                    if ( ! empty( $description ) ) {
                        echo '<p class="description">' . esc_html( $description ) . '</p>';
                    }
                ?>
                
                <?php
                    if( function_exists('nd_render_newsletter_form') ){
                        echo nd_render_newsletter_form();
                    }
                ?>
            </div>
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

        $mailchimp_text = isset( $instance['mailchimp_text'] ) ? $instance['mailchimp_text'] : '';
        ?>
			<p><label for="title"><?php esc_html_e( 'Title:', 'agenvix-core' );?></label></p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'title' ) );?>"  class="widefat" name="<?php print esc_attr( $this->get_field_name( 'title' ) );?>" value="<?php print esc_attr( $title );?>">
            
			<p>
				<label for="title"><?php esc_html_e('Description:','agenvix-core'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('description')); ?>"  name="<?php print esc_attr($this->get_field_name('description')); ?>" class="widefat" value="<?php print esc_attr($description); ?>">
		<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

        return $instance;
    }
}

add_action('widgets_init', function(){
	register_widget('Provix_Footer_Subscriber');
});
