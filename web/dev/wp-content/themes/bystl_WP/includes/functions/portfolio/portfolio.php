<?php

///////////////////////////////
// ADDS OUR PORTFOLIO POST TYPE
///////////////////////////////


add_action('init', 'synergiePortfolioPosts');


function synergiePortfolioPosts() {
    register_post_type('portfolio_posts',
            array(
                'labels' => array(
                    'name' => __('Portfolio Posts'),
                    'singular_name' => __('Portfolio Posts')
                ),
                'menu_position' => 5,
                'supports' => array('title', 'author', 'thumbnail', 'editor', 'categories', 'comments'),
                'public' => true,
            )
    );
}

//ADDS OUR PORTFOLIO CATEGORIES



 ////////////////////////////////////////
	// LETS START BY ADDING OUR METABOXES
	// IN THE PORTFOLIO POSTS PANEL
	////////////////////////////////////////

	add_action('admin_menu', 'synergiePortfolioMeta');
	add_action('save_post', 'synergieSavePortfolioMeta');

	//OUR SLIDER METABOXES
	function synergiePortfolioMeta() {

		add_meta_box( 'synergiePortfolio', 'Portfolio posts options', 'synergieCreatePortfolioMeta', 'portfolio_posts', 'side', 'high' );

	}

	//CREATES OUR METABOX INPUT
	function synergieCreatePortfolioMeta() {

		global $post;
		wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_portfolioImg', false, true );
                wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_portfolio_prettyPhoto', false, true );
                wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_portfolio_prettyUrl', false, true );
                wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_portfolio_galleryName', false, true );
				wp_nonce_field( plugin_basename( __FILE__ ), 'wp_nonce_portfolio_article', false, true );
		include('portfolio_meta.php');

	}

	//SAVES OUR METABOX
	function synergieSavePortfolioMeta($post_id) {

		global $post;

		 if ( !wp_verify_nonce( $_POST['wp_nonce_portfolioImg'], plugin_basename(__FILE__) )) { return $post_id; }
                 if ( !wp_verify_nonce( $_POST['wp_nonce_portfolio_prettyPhoto'], plugin_basename(__FILE__) )) { return $post_id; }
                 if ( !wp_verify_nonce( $_POST['wp_nonce_portfolio_prettyUrl'], plugin_basename(__FILE__) )) { return $post_id; }
                 if ( !wp_verify_nonce( $_POST['wp_nonce_portfolio_galleryName'], plugin_basename(__FILE__) )) { return $post_id; }
				 if ( !wp_verify_nonce( $_POST['wp_nonce_portfolio_article'], plugin_basename(__FILE__) )) { return $post_id; }

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

		update_post_meta($post_id, 'portfolioImg', htmlspecialchars($_POST['portfolioImg']));
                update_post_meta($post_id, 'portfolio_prettyPhoto', htmlspecialchars($_POST['portfolio_prettyPhoto']));
                update_post_meta($post_id, 'portfolio_prettyUrl', htmlspecialchars($_POST['portfolio_prettyUrl']));
                update_post_meta($post_id, 'portfolio_galleryName', htmlspecialchars($_POST['portfolio_galleryName']));
				update_post_meta($post_id, 'portfolio_article', htmlspecialchars($_POST['portfolio_article']));


	}

?>
