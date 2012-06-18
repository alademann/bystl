<?php
/*
 * Plugin Name: DD Testimonials Widget
 * Plugin URI: http://themeforest.net/user/DDStudios/portfolio
 * Description: A widget that displays testimonials in sidebar
 * Version: 1.0
 * Author: Dany Duchaine
 * Author URI: http://themeforest.net/user/DanyDuchaine/
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'dd_testimonials_sidebar_widget' );

/*
 * Register widget.
 */
function dd_testimonials_sidebar_widget() {
	register_widget( 'dd_testimonials_sidebar_widget' );
}

/*
 * Widget class.
 */
class dd_testimonials_sidebar_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	function dd_testimonials_sidebar_widget() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'dd_testimonials_sidebar_widget', 'description' => __('A widget that displays testimonials in the widgets.', 'localization') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dd_testimonials_sidebar_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'dd_testimonials_sidebar_widget', __('DD Sidebar Testimonials Widget', 'localization'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
	

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display Widget */
		?>

                 <ul class="sidebar-testimonials clearfix">


                      <?php
        global $paged;

        $arguments = array(
            'post_type' => 'testimonials_posts',
            'post_status' => 'publish',
            'paged' => $paged
        );

        $testimonials_query = new WP_Query($arguments);

        dd_set_query($testimonials_query);
		$i = 0;
        ?>

        <?php if ($testimonials_query->have_posts()) : while ($testimonials_query->have_posts()) : $testimonials_query->the_post();


        	//STARTS OUR ITEM
						

        ?>
                     
                            <li class="testimonial">


                            
                                
                                <div class="testimonial-widget-info">

                                        <?php if(get_post_meta(get_the_id(), 'ddtestimonials', true) != '') : //IF IT HAS AT LEAST ONE THUMB

							//OUR AUTHOR AVATAR THUMBNAIL
							$testimonials = ddListGet('testimonials', get_the_ID());?>

                                  <img src="<?php echo $testimonials[0]['testimonials_avatar']; ?>" alt="" />


                                   <?php endif; ?>

                                  
                                    <div class="testimonial-widget-meta">

                                        <span class="testimonialTitle"><?php the_title(); ?></span>
                                        <span class="testimonialAuthor"><?php echo $testimonials[0]['testimonials_link']?></span>
                                        

                                    </div>

                                </div>

                                
                                <blockquote class="testimonialQuote"><p><?php the_content(); ?></p></blockquote>

                            </li>

                         
                            
                            <?php endwhile; ?>

        <?php endif; ?>   

                        </ul>



                        <div class="sidebar-testimonial-pager">

                            <div id="sidebar-testimonial-pager"></div>

                        </div>


		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
                $instance['title'] = strip_tags( $new_instance['title'] );
	
		

		/* No need to strip tags for.. */

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
                'title' => 'What Clients Says About Us'
				);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	
                <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<!-- Username: Text Input -->
		
		
		<!-- Postcount: Text Input -->
		
		
		<!-- Tweettext: Text Input -->
				
	<?php
	}
}
?>