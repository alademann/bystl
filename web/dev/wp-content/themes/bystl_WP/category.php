<?php get_header(); ?>

   <div class="page-container row-fluid clearfix">


                <div class="page-content span12">

                    <ul class="blog-articles-list">

                <?php if (have_posts ()) : while (have_posts ()) : (the_post()); ?>

                    <li class="blog-article clearfix">
                        
                        
                                 <?php if (get_post_meta(get_the_id(), 'ddblogImg', true) != '') {

                    $blogImg = ddListGet('blogImg', get_the_ID()); ?>
                        

                            <div class="article-thumb">


                                 <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/includes/timthumb.php?q=100&amp;w=575&amp;h=405&amp;zc=1&amp;src=<?php echo $blogImg[0]['img_url']; ?>" alt="" /></a>


                                <a class="article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                
                            </div>

                                        <?php } else { ?>
                                
                                <a class="title-no-img" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                
                                <?php }  ?>

                           <div class="article-meta clearfix">

                                <span class="article-comments"><a class="article-comment" href="<?php comments_link(); ?>">
                                    
                                    <?php comments_number(__('No Comments', 'localization'), __('One Comment', 'localization'), __('% Comments', 'localization') );?>
 
                                    </a></span>
                                <span class="article-date"><?php _e('By', 'localization'); ?> <?php the_author(); ?> |  <?php _e('on', 'localization'); ?> <?php the_time( get_option( 'date_format' ) ); ?> <?php _e('in', 'localization'); ?> <?php the_category(', '); ?></span>

                            </div>

                            <div class="article-excerpt">

                               <?php the_excerpt(); ?>
                                  <a class="small-btn blue rounded-1" href="single-blog.html"><?php _e('Continue Reading', 'localization'); ?></a>
                                  
                                
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

                <div class="span4 sidebar">

                <ul class="widgets">

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog")); ?>

                    </ul>
                
            </div>

            </div>


<?php get_footer(); ?>