<?php /*
  Template Name: Page Full Width
 */ ?>

<?php get_header(); ?>

   <div class="page-container container clearfix">

            <div class="row">

                <div class="page-content full span12">
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

            </div>
   </div>

<?php get_footer(); ?>