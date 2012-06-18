<?php
/*
 * Plugin Name: DD Latest Tweets
 * Plugin URI: http://themeforest.net/user/DDStudios/portfolio
 * Description: A widget that displays tweets based on a query
 * Version: 1.0
 * Author: Dany Duchaine
 * Author URI: http://themeforest.net/user/DDStudios/
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'dd_posts_widgets' );

/*
 * Register widget.
 */
function dd_posts_widgets() {
	register_widget( 'DD_Post_Widget' );
}

/*
 * Widget class.
 */
class dd_post_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	function DD_Post_Widget() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'post-widget', 'description' => __('A widget that displays your latest posts.', 'localization') );

                /* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dd_post_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'dd_post_widget', __('DD Latest Posts','localization'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$postcount = $instance['postcount'];
                $blogcategory = $instance['blogcategory'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display Widget */

		/* Display Latest Posts */
		 ?>


<div class="blog-slider blog-widget">

        <?php
        global $post;

        $category_id = get_cat_ID($blogcategory);

        $arguments = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'showposts' => $postcount,
            'paged' => $paged,
            'cat' => $category_id,
        );

        $blog_query = new WP_Query($arguments);

        dd_set_query($blog_query);
        $i = 0;
        ?>

<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>

<?php if ($i == 0 || ($i % 3 == 0)) {
                    echo '<ul class="blog-widget-articles">';
                } //// IN THE BEGINNING OF THE FIRST OR EVERY OTHER 4TH, 7TH ETC SHOWS THE UL  ?>

                <li class="blog-widget-article">        

            <?php if (get_post_meta(get_the_id(), 'ddblogImg', true) != '') :

                    $blogImg = ddListGet('blogImg', get_the_ID()); ?>

                    <a href="<?php the_permalink(); ?>"><img width="45" height="45" src="<?php echo $blogImg[0]['img_url']; ?>" alt="" /></a>

                    <?php endif; ?>
                    
                    <div class="blog-widget-info">

                        <a class="blog-widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                        <div class="blog-widget-meta">

                            <a href="#"><?php the_time( get_option( 'date_format' ) ); ?></a>

                        </div>

                    </div>

                </li>

<?php if ((($i + 1) % 3 == 0) || (($i + 1) == $portfolio_query->found_posts)) {
                        echo '</ul>';
                    } //// CLOSES THE UL IF IT's THE LAST OF A SET OF LIs OR THE LAST ITEMS OF ALL (AVOIDS HAVING A FLOATING LI WITHOUT A CLOSE UL)  ?>

<?php $i++; ?>

<?php endwhile; ?>

<?php dd_restore_query(); ?>

<?php endif; ?>

                </div>
    


<?php if($i >= 4) { ?>

    <div class="blog-pager">

        <div id="blog-pager"></div>

    </div>

<?php } ?>

<?php

                /* After widget (defined by themes). */
		echo $after_widget;
                
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		$numposts = esc_attr($instance['numposts']);
		$blogcategory = esc_attr($instance['blogcategory']);

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

        <p>
            <label for="<?php echo $this->get_field_id('blogcategory'); ?>"><?php _e('Blog Category:','localization'); ?></label>
            <?php
            //Access the WordPress Categories via an Array
			$dd_categories = array();
			$dd_categories_obj = get_categories('hide_empty=0');
			foreach ($dd_categories_obj as $dd_cat) {
    			$dd_categories[$dd_cat->cat_ID] = $dd_cat->cat_name;}
			$categories_tmp = array_unshift($dd_categories, "Select a category:");
            ?>
            <select id="<?php echo $this->get_field_id('blogcategory'); ?>" name="<?php echo $this->get_field_name('blogcategory'); ?>">
			<?php
			//DISPLAY SELECT OPTIONS
			foreach ($dd_categories as $dd_category) {
				if ($blogcategory == $dd_category) {
					$selected_option = 'selected="selected"';
				} else {
					$selected_option = '';
				} ?>
				<option value="<?php echo $dd_category; ?>" <?php echo $selected_option; ?>><?php echo $dd_category; ?></option>
				<?php
			} ?>
			</select>
        </p>

        <p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of posts', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>

        <?php
	}
	
}
?>