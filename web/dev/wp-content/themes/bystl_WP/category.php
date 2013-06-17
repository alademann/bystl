<?php get_header(); ?>

   <div class="page-container row-fluid clearfix">


                <div class="page-content span11">

                    <ul class="blog-articles-list">

                <?php if (have_posts ()) : while (have_posts ()) : (the_post()); ?>

                    <li class="blog-article clearfix">
                        
                        
                                 <?php if (get_post_meta(get_the_id(), 'ddblogImg', true) != '') {

                    $blogImg = ddListGet('blogImg', get_the_ID()); ?>
                        

                            <div class="article-thumb">


                                 <a href="<?php the_permalink(); ?>"><img src="<?php echo $blogImg[0]['img_url']; ?>" alt="" /></a>


                                <h4 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                
                            </div>

                                        <?php } else { ?>
                                
                                <h4 class="article-title title-no-img"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                
                                <?php }  ?>

                           <div class="article-meta clearfix" style="display: none;">

                                <span class="article-comments"><a class="article-comment" href="<?php comments_link(); ?>">
                                    
                                    <?php comments_number(__('No Comments', 'localization'), __('One Comment', 'localization'), __('% Comments', 'localization') );?>
 
                                    </a></span>
                                <span class="article-date"><?php _e('By', 'localization'); ?> <?php the_author(); ?> |  <?php _e('on', 'localization'); ?> <?php the_time( get_option( 'date_format' ) ); ?> <?php _e('in', 'localization'); ?> <?php the_category(', '); ?></span>

                            </div>

                            <div class="article-excerpt">

                               <p><?php the_excerpt(); ?>&nbsp;&nbsp;<a class="btn small-btn btn-primary" href="<?php the_permalink(); ?>" rel="nofollow"><?php _e('Continue Reading', 'localization'); ?></a></p>
                                  
                                
                            </div>

                        </li>
                    
           


                          <!-- Custom pagination -->
                  <!-- Custom pagination -->
                <?php endwhile; ?>

                <?php kriesi_pagination();
                ?>

                <?php endif; ?>

                    




                    </ul>
                    
                </div>

                <div class="span5 sidebar">

                <ul class="widgets">

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog")); ?>

                    </ul>
                
            </div>

            </div>


<?php get_footer(); ?>