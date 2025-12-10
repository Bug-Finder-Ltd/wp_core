<?php 
Class Latest_Sidebar_Cat_List_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('raizen-sidebar-cats-list', 'Raizen Sidebar Category List', array(
			'description'	=> 'Raizen sidebar category list'
		));
	}

	public function widget($args, $instance){

		extract($args);
		echo $before_widget; 
		 
	 	if($instance['title']):
			echo $before_title; ?> 
			<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
			<?php echo $after_title; ?>
     	<?php endif; ?>

		 <div class="sidebar-category">
            <div class="sidebar-category-list">
				<ul>
					<?php 
					$categories = get_terms( array(
						'taxonomy' => 'category',
						'hide_empty' => true,
					) );
					?>
					<?php if ( !empty($categories) ) : ?>
						<?php foreach ( $categories as $category ) : ?>
							<li>
								<a href="<?php echo esc_url( get_category_link( $category->term_id)); ?>">
									<span><?php echo esc_html($category->name); ?></span><i class="fa-regular fa-angle-right"></i>
								</a>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		 </div>
		
		<?php echo $after_widget; ?>

		<?php
	}

	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '5', 'raizencores' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'raizencores' );
	?>	
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>>ASC</option>
				<option value="DESC" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>>DESC</option>
			</select>
		</p>

	<?php }
}

add_action('widgets_init', function(){
	register_widget('Latest_Sidebar_Cat_List_Widget');
});