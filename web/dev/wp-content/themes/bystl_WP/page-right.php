<?php /*
  Template Name: Page Sidebar Right
 */ ?>

<?php get_header(); ?>

   <div class="page-container container clearfix">

            <div class="row">

                <div class="page-content span12">
    <?php
        if (have_posts ()) {

            while (have_posts ()) {

                (the_post());
        ?>



<?php the_content(); ?>


<?php }
        } else { ?>

            <div class="post box">
                <h3><?php _e('There is not post available.', 'localization'); ?></h3>

            </div>

<?php } ?>

                </div>

                <div class="span4 sidebar">

                <ul class="widgets">

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Pages")); ?>

                    </ul>
                
            </div>

            </div>
   </div>

<?php get_footer(); ?>