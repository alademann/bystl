<?php /*
  Template Name: Testimonials   
 */ ?>

<?php get_header(); ?>

     <?php
                global $paged;

                $arguments = array(
                    'post_type' => 'testimonial',
                    'post_status' => 'publish',
                    'paged' => $paged,

                );

                $testimonial_query = new WP_Query($arguments);

                dd_set_query($testimonial_query);
?>

<div class="page-container row-fluid clearfix">
    
    <ul id="filters" class="span16 clearfix">
        
        <li><a class="active" href="#" data-filter="span-one-third"><?php _e('Show All', 'localization'); ?></a></li>
                
                <?php 
                
                $terms = get_terms("testimonial_categories");
                
 $count = count($terms);
 if ( $count > 0 ){
     echo "<ul>";
     foreach ( $terms as $term ) {
       echo '<li><a href="" data-filter="' . $term->name . '">' . $term->name . '</li></a>';
        
     }
     echo "</ul>";
 }
                
                ?>
            
    </ul>
    


        <div class="testimonial-full span16">
            
           
            <ul class="row testimonial-items">
     

                <?php if ($testimonial_query->have_posts()) : while ($testimonial_query->have_posts()) : $testimonial_query->the_post(); ?>

          
                        <li class="span-one-third  <?php echo custom_taxonomies_terms_text(); ?>">

                            <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

                        </li>



    <?php endwhile; ?>

<?php endif; ?>

            </ul>

        </div>

    </div>



<?php get_footer(); ?>