<?php get_header(); ?>

   <div class="page-container row-fluid clearfix">
                
                <div class="blog-page">

                <div class="page-content span11">

              
 <?php
 

            if (have_posts ()) {

                while (have_posts ()) {

                    (the_post());
            ?>

                    
                      <?php  if(get_post_meta($post->ID, 'ddportfolioSlider', true) != '') { ?>
                    
                     <ul class="simple-slider">
                         
                   <?php $my_retrieved_array = ddListGet('portfolioSlider', $post->ID);

                foreach ($my_retrieved_array as $item) { ?>
                    
       
                         <li> <a href="<?php echo $item['img_url']; ?>" rel="prettyPhoto[gallery2]" title="<?php echo $item['field_name']; ?>"><img src="<?php echo $item['img_url']; ?>" alt="" /></a>
</li>
                    
                    
                                    <?php  } ?>
       

                            
                        </ul>

                        <div class="container-fluid slider-pager">

                            <div class="slider-pagers"></div>

                        </div>
                    
                                <?php } else { ?>
                    
                    
                       <img class="portfolio-single-img" src="<?php echo get_post_meta($post->ID, 'portfolioImg', true) ?>" alt="" />
                    
                    
                                <?php } ?>
                    
                             <div class="article-meta clearfix">

                                <span class="article-comments"><a class="article-comment" href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'localization'), __('One Comment', 'localization'), __('% Comments', 'localization') );?></a></span>
                                <span class="article-date"><?php _e('By', 'localization'); ?> <?php the_author(); ?> |  <?php _e('on', 'localization'); ?> <?php the_time( get_option( 'date_format' ) ); ?></span>

                            </div>

                                 <div class="portfolio-item-content clearfix">

                            <div class="portfolio-item-meta">

                                <div class="portfolio-span"><span><?php _e('Title', 'localization'); ?> :</span><span class="portfolio-span-desc"><?php the_title(); ?></span></div>
                         
                                <div class="portfolio-span"><span><?php _e('Category', 'localization'); ?> :</span><span class="portfolio-span-desc"><?php echo custom_taxonomies_terms_text2(); ?></span></div>


                            </div>

                            <div class="portfolio-item-description">

						            <?php the_content(); ?>
							
                            </div>

                        </div>
         
                    
                     <?php }
            } else { ?>

                <div class="post box">
                    <h3><?php _e('There is no post available.', 'localization'); ?></h3>

                </div>

<?php } ?>

    
                </div>
                

                <?php comments_template(); ?>    

                    </div>


                <div class="span5 sidebar">

                <ul class="widgets">

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Portfolio Post")); ?>

                    </ul>
                
            </div>

            </div>

<?php get_footer(); ?>