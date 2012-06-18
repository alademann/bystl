<?php

///////////////////////////////
// ADDS OUR testimonials POST TYPE
///////////////////////////////


add_action('init', 'synapsetestimonialsPosts');
add_action('init', 'synapsetestimonialsTaxonomy');

function synapsetestimonialsPosts() {
    register_post_type('testimonials_posts',
            array(
                'labels' => array(
                    'name' => __('Testimonials'),
                    'singular_name' => __('Testimonial')
                ),
                'menu_position' => 5,
                'supports' => array('title', 'author', 'thumbnail', 'editor', 'categories', 'comments'),
                'public' => true,
            )
    );
}

//ADDS OUR testimonials CATEGORIES

	function synapsetestimonialsTaxonomy() {

		//testimonials Categories
		register_taxonomy(

			'testimonials_cats',
			'testimonials_posts',
			array(

				'hierarchical' => true,
				'label' => 'Testimonials Categories'

			)

		);

	}

 ////////////////////////////////////////
	// LETS START BY ADDING OUR METABOXES
	// IN THE testimonials POSTS PANEL
	////////////////////////////////////////

	add_action('admin_menu', 'synapsetestimonialsMeta');
	add_action('save_post', 'synapseSavetestimonialsMeta');

	//OUR testimonials METABOXES
	function synapsetestimonialsMeta() {

		add_meta_box( 'synapsetestimonials', 'testimonials posts options', 'synapseCreatetestimonialsMeta', 'testimonials_posts', 'side', 'high' );

	}

	//CREATES OUR METABOX INPUT
	function synapseCreatetestimonialsMeta() {

		global $post;
		wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_testimonialsImg', false, true );
                wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_testimonials_prettyPhoto', false, true );
                wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_testimonials_prettyUrl', false, true );
                wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_testimonials_galleryName', false, true );
				wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_testimonials_article', false, true );
		include('testimonials_meta.php');

	}

	//SAVES OUR METABOX
	function synapseSavetestimonialsMeta($post_id) {

		global $post;

		 if ( !wp_verify_nonce( $_POST['wp_nonce_testimonialsImg'], plugin_basename(__FILE__) )) { return $post_id; }
                 if ( !wp_verify_nonce( $_POST['wp_nonce_testimonials_prettyPhoto'], plugin_basename(__FILE__) )) { return $post_id; }
                 if ( !wp_verify_nonce( $_POST['wp_nonce_testimonials_prettyUrl'], plugin_basename(__FILE__) )) { return $post_id; }
                 if ( !wp_verify_nonce( $_POST['wp_nonce_testimonials_galleryName'], plugin_basename(__FILE__) )) { return $post_id; }
				 if ( !wp_verify_nonce( $_POST['wp_nonce_testimonials_article'], plugin_basename(__FILE__) )) { return $post_id; }

		//verify if it's autosave
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) { return $post_id; }

		  // Check permissions
		  if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) )
			  return $post_id;
		  } else {
			if ( !current_user_can( 'edit_post', $post_id ) )
			  return $post_id;
		  }

		update_post_meta($post_id, 'testimonialsImg', htmlspecialchars($_POST['testimonialsImg']));
                update_post_meta($post_id, 'testimonials_prettyPhoto', htmlspecialchars($_POST['testimonials_prettyPhoto']));
                update_post_meta($post_id, 'testimonials_prettyUrl', htmlspecialchars($_POST['testimonials_prettyUrl']));
                update_post_meta($post_id, 'testimonials_galleryName', htmlspecialchars($_POST['testimonials_galleryName']));
				update_post_meta($post_id, 'testimonials_article', htmlspecialchars($_POST['testimonials_article']));


	}

?>
