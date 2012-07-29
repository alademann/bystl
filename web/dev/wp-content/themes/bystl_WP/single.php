<?php get_header(); 
// ends indented one... indent all children two
?>

        <div class="page-container row-fluid clearfix blog-page">

            <div class="span11">

                <div class="page-content">

                    <ul class="blog-articles-list">
                        <?php
                        if (have_posts ()) {
                            while (have_posts ()) {
                                the_post();
                        ?>
                        <li class="blog-article clearfix">
                            <?php 
                            if (get_post_meta(get_the_id(), 'ddblogImg', true) != '') {
                                $blogImg = ddListGet('blogImg', get_the_ID());
                            ?>
                            <div class="article-thumb">
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo $blogImg[0]['img_url']; ?>" alt="" /></a>
                                <h1><a class="article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            </div>
                            <!-- END: .article-thumb -->
                            <?php 
                            } else { 
                            ?>
                            <h1><a class="title-no-img" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <?php 
                            } // END if(ddblogImg) 
                            ?>

                            <div class="article-meta clearfix">

                                <span class="article-comments"><a class="article-comment" href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'localization'), __('One Comment', 'localization'), __('% Comments', 'localization') );?></a></span>
                                <span class="article-date"><?php _e('By', 'localization'); ?> <?php the_author(); ?> |  <?php _e('on', 'localization'); ?> <?php the_time( get_option( 'date_format' ) ); ?></span>

                            </div>
                            <!-- END: .article-meta -->
                            <div class="article-excerpt">

                               <?php the_content(); ?>
                               
                            </div>
                            <!-- END: .article-excerpt (post content) -->

                        </li>
                        <!-- END: .blog-article -->
                        
                        <?php 
                            } // END while()
                        } else { 
                        ?>

                        <li class="blog-article clearfix">
                            <div class="post box">
                                <h3><?php _e('There is no post available.', 'localization'); ?></h3>
                            </div>
                        </li>
                        <!-- END .blog-article -->
                        <?php 
                        } // END if() 
                        ?>

                    </ul>
                    <!-- END: .blog-articles -->                    

                </div>
                <!-- END .page-content -->
                
                <?php comments_template(); ?>

            </div>
            <!-- END .span11 (left column) -->

            <div class="span5 sidebar">
                <ul class="widgets">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Blog Post")); ?>
                </ul>
            </div>
            <!-- END: .sidebar (right column) -->

        </div>
        <!-- END: .page-container -->

<?php get_footer(); ?>