<?php
/*
 * Plugin Name: Custom Flickr Photostream
 * Plugin URI: http://www.ormanclark.com
 * Description: A widget that displays your Flickr photos
 * Version: 1.0
 * Author: Orman Clark
 * Author URI: http://www.ormanclark.com
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'tz_flickr_widgets' );

/*
 * Register widget.
 */
function tz_flickr_widgets() {
	register_widget( 'TZ_FLICKR_Widget' );
}

/*
 * Widget class.
 */
class tz_flickr_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function TZ_FLICKR_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tz_flickr_widget', 'description' => __('A widget that displays your Flickr photos.', 'localization') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'tz_flickr_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'tz_flickr_widget', __('DD Flickr Photos', 'localization'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$flickrID = $instance['flickrID'];
		$postcount = $instance['postcount'];
		$type = $instance['type'];
		$display = $instance['display'];

                  echo $before_widget;
                  
		/* Display Flickr Photos */
		 ?>

<?php echo $before_title ?><?php echo $title ?><?php echo $after_title ?>

			<div id="flickr_badge_wrapper" class="clearfix">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
			</div>
	
		<?php

                  echo $after_widget;

	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['postcount'] = $new_instance['postcount'];
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];


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
		'title' => 'My Photostream',
		'flickrID' => '52617155@N08',
		'postcount' => '9',
		'type' => 'user',
		'display' => 'random',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

                ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Flickr ID: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'localization') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
		</p>
		
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'localization') ?></label>
			<select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" class="widefat">
				<option <?php if ( '1' == $instance['postcount'] ) echo 'selected="selected"'; ?>>1</option>
                                <option <?php if ( '2' == $instance['postcount'] ) echo 'selected="selected"'; ?>>2</option>
                                <option <?php if ( '3' == $instance['postcount'] ) echo 'selected="selected"'; ?>>3</option>
                                <option <?php if ( '4' == $instance['postcount'] ) echo 'selected="selected"'; ?>>4</option>
                                <option <?php if ( '5' == $instance['postcount'] ) echo 'selected="selected"'; ?>>5</option>
                                <option <?php if ( '6' == $instance['postcount'] ) echo 'selected="selected"'; ?>>6</option>
                                <option <?php if ( '7' == $instance['postcount'] ) echo 'selected="selected"'; ?>>7</option>
                                <option <?php if ( '8' == $instance['postcount'] ) echo 'selected="selected"'; ?>>8</option>
                                <option <?php if ( '9' == $instance['postcount'] ) echo 'selected="selected"'; ?>>9</option>
                                <option <?php if ( '10' == $instance['postcount'] ) echo 'selected="selected"'; ?>>10</option>
			</select>
		</p>
		
		<!-- Type: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type (user or group):', 'localization') ?></label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
				<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
				<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
			</select>
		</p>
		
		<!-- Display: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display (random or latest):', 'localization') ?></label>
			<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
				<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
				<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
			</select>
		</p>
                
		
	<?php
	}
}
?>