<?php /*
  Template Name: Page Sidebar Right
 */ ?>

<?php get_header(); 
// ends indented one... indent all children two
?>

        <div class="page-container row-fluid clearfix">
            <?php if (function_exists('dynamic_sidebar')) { ?>
            <div class="page-content span11">
            <?php } else { ?>
            <div class="page-content full span16">
            <?php } ?>
                <?php
                if (have_posts ()) { 
                    while (have_posts ()) {
                        the_post();
                        the_content(); 
                    } // END while()
                } else { ?>

                <div class="post box">
                    <h3><?php _e('There is not post available.', 'localization'); ?></h3>
                </div>

                <?php 
                } // END if()
                ?>

            </div>
            <!-- END: .page-content (left column) -->
            <?php if (function_exists('dynamic_sidebar')) { ?>
            <div class="span5 sidebar">
                <ul class="widgets">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Pages")); ?>
                </ul>
            </div>
            <!-- END: .sidebar (right column) -->
            <?php } ?>
        </div>
        <!-- END: .page-container -->

<?php get_footer(); ?>