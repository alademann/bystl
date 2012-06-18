<?php /*
  Template Name: Portfolio
 */ ?>

<?php get_header(); ?>

     <?php
                global $paged;

                $arguments = array(
                    'post_type' => 'portfolio_posts',
                    'post_status' => 'publish',
                    'paged' => $paged,

                );

                $portfolio_query = new WP_Query($arguments);

                dd_set_query($portfolio_query);
?>

<div class="page-container row-fluid clearfix">
    
    <ul id="filters" class="span16 clearfix">
        
        <li><a class="active" href="#" data-filter="span-one-third"><?php _e('Show All', 'localization'); ?></a></li>
                
                <?php 
                
                $terms = get_terms("portfolio_categories");
                
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
    


        <div class="portfolio-full span16">
            
           
            <ul class="row portfolio-items">
     

                <?php if ($portfolio_query->have_posts()) : while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>

          
                        <li class="span-one-third  <?php echo custom_taxonomies_terms_text(); ?>">

                            <div class="portfolio-item">

                                <div class="portfolio-img">

                                    <div class="portfolio-hover">

                                        <a class="zoom" href="<?php echo get_post_meta($post->ID, 'portfolioImg', true) ?>" rel="prettyPhoto[gallery1]" title="<?php the_title(); ?>"><?php _e('Zoom', 'localization'); ?></a>
                                        <a class="goto" href="<?php the_permalink(); ?>"><?php _e('Go To', 'localization'); ?></a>

                                    </div>

                                 <img width="258" height="250" src="<?php echo get_post_meta($post->ID, 'portfolioImg', true) ?>" alt="" />
                  
                                </div>

                                <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

                            </div>

                        </li>


    <?php endwhile; ?>

<?php endif; ?>

            </ul>

        </div>

    </div>



<?php get_footer(); ?>