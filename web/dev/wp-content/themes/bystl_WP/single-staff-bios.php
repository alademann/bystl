<?php get_header();
// ends indented one... indent all children two
?>

        <div class="page-container row-fluid clearfix">

            <div class="page-content span11">
                <?php
                if (have_posts ()) {
                    while (have_posts ()) {
                        the_post();

                        echo '<h1>'.get_the_title().'</h1>';
                        echo '<div class="bio-entry">';
                            if ( has_post_thumbnail()) {
                                echo "<div class='bioImg'>";
                                echo get_the_post_thumbnail($post->ID, 'full');
                                echo "</div>";
                             }
                            the_content();
                        echo '</div>';

                        //echo '<ul class="pager">';
                        //previous_link();
                        //next_link();
                        //echo '</ul>';
                    } // END while()
                } else { ?>

                <div class="post box">
                    <h3><?php _e('There is no bio available.', 'localization'); ?></h3>
                </div>

                <?php
                } // END if()
                ?>

            </div>
            <!-- END: .page-content (left column) -->
            <div class="span5 sidebar">
                <ul class="blog-widget-articles">
                    <?php $args = array (
                            'post_type' => 'staff-bios',
                            'title_li' => __('Staff Bios')
                        );
                    ?>
                    <?php wp_list_pages($args); ?>
                </ul>
            </div>
            <!-- END: .sidebar (right column) -->
        </div>
        <!-- END: .page-container -->

<?php get_footer(); ?>