<?php /*
  Template Name: Page Sidebar Right
 */ ?>

<?php get_header(); ?>

   <div class="page-container row-fluid clearfix">


                <div class="page-content span11">
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

                <div class="span5 sidebar">

                <ul class="widgets">

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Pages")); ?>

                    </ul>
                
            </div>

            </div>


<?php get_footer(); ?>