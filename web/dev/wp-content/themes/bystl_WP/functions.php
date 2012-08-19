<?php

add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-thumbnails', array( 'staff-bios' ) );

add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

  function bootstrap_setup(){

    add_action( 'init', 'register_menu' );

    function register_menu(){
      register_nav_menu( 'top_menu', 'Bootstrap Top Menu' );
    }

    class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


      function start_lvl( &$output, $depth ) {

        $indent = str_repeat( "\t", $depth );
        $output    .= "\n$indent<ul class=\"dropdown-menu\">\n";

      }

      function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = ($args->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;


        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ($args->has_children)      ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }

      function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        if ( !$element )
          return;

        $id_field = $this->db_fields['id'];

        //display this element
        if ( is_array( $args[0] ) )
          $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
        else if ( is_object( $args[0] ) )
          $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

          foreach( $children_elements[ $id ] as $child ){

            if ( !isset($newlevel) ) {
              $newlevel = true;
              //start the child delimiter
              $cb_args = array_merge( array(&$output, $depth), $args);
              call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
            }
            $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
          }
            unset( $children_elements[ $id ] );
        }

        if ( isset($newlevel) && $newlevel ){
          //end the child delimiter
          $cb_args = array_merge( array(&$output, $depth), $args);
          call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);

      }

    }

  }

endif;
?>
<?php

 add_theme_support( 'automatic-feed-links' );
   // Ready for theme localisation
load_theme_textdomain ('localization');

$metaboxes = TEMPLATEPATH . '/includes/metaboxes/metaboxes.php';
include($metaboxes);
require TEMPLATEPATH . '/option-tree/index.php';
require_once TEMPLATEPATH . '/includes/comment-list.php';

	/* ==OTHER FUNCTION === */

	function ddTimthumb($img, $width, $height) {

		return get_bloginfo('template_url').'/includes/timthumb.php?q=100&amp;zc=1&amp;src='.$img.'&amp;w='.$width.'&amp;h='.$height;

	}

// Register our custom image sizes
// add_image_size( $name, $width, $height, $crop );
if ( function_exists( 'add_image_size' ) ) {
  add_image_size('full-screen', 980, 652, false);
	add_image_size('slider-wide', 940, 500, true ); // was 330 originally
	add_image_size('slider-thumb', 45, 45, true );
}

// Register our menues

add_theme_support('nav-menus');

//register_nav_menu('top_menu', 'Top Menu');
register_nav_menu('main_menu', 'Main Menu');



function display_home2() {
    echo '<ul id="main-nav" class="sf-menu sf-js-enabled sf-shadow">
		<li class="home-link"><a href="' . get_bloginfo('url') . '">Home</a></li>';
    wp_list_pages('title_li=&depth=3');
    echo '</ul>';
}

// Registering our sidebar

if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Pages',
'before_widget' => '<li class="widget">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}

if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Home Page',
'before_widget' => '<li class="widget">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}

if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Single Portfolio Post',
'before_widget' => '<li class="widget %2$s" id="%1$s">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}
if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Blog',
'before_widget' => '<li class="widget %2$s" id="%1$s">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}
if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Single Blog Post',
'before_widget' => '<li class="widget %2$s" id="%1$s">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}
if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Dark Footer',
'before_widget' => '<li class="span-one-third %2$s" id="%1$s">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}
if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Light Footer',
'before_widget' => '<div class="span-one-third %2$s" id="%1$s">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}

//Save image via AJAX
add_action('wp_ajax_ddpanel_ajax_upload', 'ddpanel_ajax_upload'); //Add support for AJAX save

function ddpanel_ajax_upload(){

	global $wpdb; //Now WP database can be accessed


	$image_id=$_POST['data'];
	$image_filename=$_FILES[$image_id];
	$override['test_form']=false; //see http://wordpress.org/support/topic/269518?replies=6
	$override['action']='wp_handle_upload';

	$uploaded_image = wp_handle_upload($image_filename,$override);

	if(!empty($uploaded_image['error'])){
		echo 'Error: ' . $uploaded_image['error'];
	}
	else{
		update_option($image_id, $uploaded_image['url']);
		echo $uploaded_image['url'];
	}

	die();

}

// Set custom query + Take it off + Related Post

function dd_set_query($custom_query=null) { global $wp_query, $wp_query_old, $post, $orig_post;

	$wp_query_old = $wp_query;

	$wp_query = $custom_query;

	$orig_post = $post;

}

function dd_restore_query() {  global $wp_query, $wp_query_old, $post, $orig_post;

	$wp_query = $wp_query_old;

	$post = $orig_post;

	setup_postdata($post);

}

// Page Navigation

function kriesi_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

//$portfolioInclude = TEMPLATEPATH . '/includes/functions/portfolio/portfolio.php';
//$testimonialsInclude = TEMPLATEPATH . '/includes/functions/testimonials/testimonials.php';
//include($testimonialsInclude);
//include($portfolioInclude);


$metaFields = array(

		array(

			'type' => 'img',
			'name' => 'img_url',
			'title' => 'Image URL'

		),

		array(

			'type' => 'text',
			'name' => 'field_name',
			'title' => 'Field Title'

		)

	);

$metaFields2 = array(

		array(

			'type' => 'img',
			'name' => 'img_url',
			'title' => 'Image URL'

		)

	);

// $metaFields3 = array(

//     array(

// 			'type' => 'img',
// 			'name' => 'testimonials_avatar',
// 			'title' => 'Author Avatar'

// 		),
// 		array(

// 			'type' => 'text',
// 			'name' => 'testimonials_link',
// 			'title' => 'Testimonial Author'

// 		)
//     ,


//     array(

// 			'type' => 'text',
// 			'name' => 'testimonials_url',
// 			'title' => 'Link URL'

// 		)

// 	);

$metaFields4 = array(

		array(

			'type' => 'img',
			'name' => 'img_url',
			'title' => 'Image URL'

		)

	);

ddCreateNewListMetabox('portfolioSlider', $metaFields, 'portfolio_posts', 'high', 'Item Slider');
ddCreateNewListMetabox('portfolioBG', $metaFields4, 'portfolio_posts', 'high', 'Custom Portfolio BG');
ddCreateNewListMetabox('blogImg', $metaFields2, 'post', 'high', 'Blog Image');
//ddCreateNewListMetabox('testimonials', $metaFields3, 'testimonials', 'high', 'Testimonial Info');


add_filter( 'image_slider_fields', 'new_slider_fields', 10, 2 );

function new_slider_fields( $image_slider_fields, $id ) {
  if ( $id == 'slides' ) {
    $image_slider_fields = array(
      array(
        'name'  => 'image',
        'type'  => 'text',
        'label' => 'Post Image URL',
        'class' => ''
      ),
      array(
        'name'  => 'link',
        'type'  => 'text',
        'label' => 'Post URL',
        'class' => ''
      ),
      array(
        'name'  => 'title2',
        'type'  => 'text',
        'label' => 'Post Title #2 (If content slider)',
        'class' => ''
      ),
      array(
        'name'  => 'description',
        'type'  => 'textarea',
        'label' => 'Post Description (If content slider)',
        'class' => ''
      ),
        array(
        'name'  => 'btnlink',
        'type'  => 'text',
        'label' => 'Button Link (If content slider)',
        'class' => ''
      ),
        array(
        'name'  => 'btntext',
        'type'  => 'text',
        'label' => 'Button Text (If content slider)',
        'class' => ''
      )

    );
  }
  return $image_slider_fields;
}


//function synapseScripts() {

		//mousewheel js
		//wp_register_script( 'script', get_bloginfo('template_url').'/js/script.js');

                //wp_register_script( 'superfish', get_bloginfo('template_url').'/js/superfish.js');

                //wp_register_script( 'twitter', get_bloginfo('template_url').'/js/twitter.js');

                //wp_register_script( 'cycle', get_bloginfo('template_url').'/js/jquery.cycle.all.js');

                //wp_register_script( 'easing', get_bloginfo('template_url').'/js/jquery.easing.1.3.js');

                //wp_register_script( 'prettyphoto', get_bloginfo('template_url').'/js/jquery.prettyPhoto.js');

                //wp_register_script( 'isotope', get_bloginfo('template_url').'/js/jquery.isotope.min.js');

                //wp_register_script( 'backstretch', get_bloginfo('template_url').'/js/jquery.backstretch.min.js');

                //wp_register_script( 'hoverintent', get_bloginfo('template_url').'/js/hoverIntent.js');

                //wp_register_script( 'tabs', get_bloginfo('template_url').'/js/bootstrap-tabs.js');

                //wp_register_script( 'alerts', get_bloginfo('template_url').'/js/bootstrap-alerts.js');

                //wp_register_script( 'prettify', get_bloginfo('template_url').'/js/prettify/prettify.js');

		//enqueues our scripts. let's enqueue jquery first to just make sure its loaded first in any case

                //wp_enqueue_script('jquery');
    // wp_enqueue_script('cycle');
    // wp_enqueue_script('easing');
    // wp_enqueue_script('twitter');
    // wp_enqueue_script('hoverintent');
    // wp_enqueue_script('superfish');
     //wp_enqueue_script('script');


    // wp_enqueue_script('prettyphoto');
    // wp_enqueue_script('isotope');


    // wp_enqueue_script('backstretch');

    // wp_enqueue_script('tabs');
    // wp_enqueue_script('alerts');
    // wp_enqueue_script('prettify');
//}

//add_action('wp_enqueue_scripts', 'synapseScripts');



include(TEMPLATEPATH . "/includes/widget-twitter.php");
include(TEMPLATEPATH . "/includes/widget-sidebar-twitter.php");
include(TEMPLATEPATH . "/includes/widget-video.php");
include(TEMPLATEPATH . "/includes/widget-flickr.php");
include(TEMPLATEPATH . "/includes/widget-testimonials.php");
include(TEMPLATEPATH . "/includes/widget-testimonials-sidebar.php");
include(TEMPLATEPATH . "/includes/widget-recentposts.php");

function people_init() {
	// create a new taxonomy
	register_taxonomy(
		'portfolio_categories',
		'portfolio_posts',
		array(
			'label' => __( 'Portfolio Categories' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'portfolio' )
		)
	);
}
add_action( 'init', 'people_init' );

function custom_taxonomies_terms_text() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = ''.$term->name.'';
			$return = join( ' ', $out );
		}
		return $return;
	}
}

function custom_taxonomies_terms_text2() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = ''.$term->name.'';
			$return = join( ', ', $out );
		}
		return $return;
	}
}