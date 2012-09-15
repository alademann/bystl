<html>
<?php /*
  Template Name: Mindbody Online Frame
 */ ?>

<?php get_header(); 
// ends indented one... indent all children two
?>

        <div class="page-container row-fluid clearfix">

            <div class="page-content full span16">
                
                <iframe src="http://clients.mindbodyonline.com/ws.asp?studioid=2448&stype=-7&sTG=30&sVT=7&sView=week" width="100%" height="900"></iframe>

                <?php if (have_posts()) { 
                    while (have_posts()) {
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
            <!-- END: .page-content.full -->
        </div>
        <!-- END: .page-container -->

<?php get_footer(); ?>