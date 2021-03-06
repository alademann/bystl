<?php /*
  Template Name: testimonial
 */ ?>

<?php get_header();
// ends indented one... indent all children two
?>

        <div class="page-container row-fluid clearfix">

            <div class="page-content span12">
                <?php
                if (have_posts ()) {
                    while (have_posts ()) {
                        the_post();

                        echo '<h1>'.get_the_title().'</h1>';
                        echo '<div class="testimonial-content">';
                            the_content();
                        echo '</div>';
                        echo '<div class="testimonial-author">&mdash; ' . get_post_meta( get_the_id(), 'tbtestimonial_author', true );
                        if( get_post_meta( get_the_id(), 'tbtestimonial_company', true ) ){
                        echo ', <span class="testimonial-company">'. get_post_meta( get_the_id(), 'tbtestimonial_company', true ) .'</span>';
                        }
                        echo '</div>';
                        //echo '<ul class="pager">';
                        //previous_link();
                        //next_link();
                        //echo '</ul>';
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
            <div class="span4 sidebar menu-container autoActivate">
                <h3 class="title"><a href="../">Testimonials</a></h3>
                <ul class="nav nav-pills nav-stacked">
                    <?php $args = array (
                            'post_type' => 'testimonial',
                            'title_li'  => ''
                        );
                    ?>
                    <?php wp_list_pages($args); ?>
                </ul>
            </div>
            <!-- END: .sidebar (right column) -->
        </div>
        <!-- END: .page-container -->

<?php get_footer(); ?>