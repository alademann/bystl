<?php get_header(); ?>

   <div class="page-container container clearfix">

            <div class="row">
                
                <div class="blog-page span12">

                <div class="page-content span12">

                    <ul class="blog-articles-list">
 <?php
            if (have_posts ()) {

                while (have_posts ()) {

                    (the_post());
            ?>


                    <li class="blog-article clearfix">

                             <?php if (get_post_meta(get_the_id(), 'ddblogImg', true) != '') :

                    $blogImg = ddListGet('blogImg', get_the_ID()); ?>
                        

                            <div class="article-thumb">


                                 <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/includes/timthumb.php?q=100&amp;w=575&amp;h=405&amp;zc=1&amp;src=<?php echo $blogImg[0]['img_url']; ?>" alt="" /></a>


                                <a class="article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                
                            </div>
                        
                                        <?php else : ?>
                                
                                <a class="title-no-img" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                
                                <?php endif; ?>

                             <div class="article-meta clearfix">

                                <span class="article-comments"><a class="article-comment" href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'localization'), __('One Comment', 'localization'), __('% Comments', 'localization') );?></a></span>
                                <span class="article-date"><?php _e('By', 'localization'); ?> <?php the_author(); ?> |  <?php _e('on', 'localization'); ?> <?php the_time( get_option( 'date_format' ) ); ?></span>

                            </div>

                            <div class="article-excerpt">

                               <?php the_content(); ?>
                               
                            </div>

                        </li>
                    
                     <?php }
            } else { ?>

                <div class="post box">
                    <h3><?php _e('There is no post available.', 'localization'); ?></h3>

                </div>

<?php } ?>

                    </ul>
                    
                </div>
                

                <?php comments_template(); ?>    

                    </div>


                <div class="span4 sidebar">

                <ul class="widgets">

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Blog Post")); ?>

                    </ul>
                
            </div>

            </div>
   </div>

<?php get_footer(); ?>