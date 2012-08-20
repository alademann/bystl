<?php get_header();
// ends indented one... indent all children two
?>

        <div class="page-container row-fluid clearfix">

            <div class="page-content span12">
                <?php
                if (have_posts ()) {
                    while (have_posts ()) {
                        the_post();


                ?>

                <h1 class="postureEnglishName"><?php print_custom_field('posture_name_en'); ?></h1>
                <h2 class="postureSanskritName" lang="sa"><?php print_custom_field('posture_name'); ?></h2>

                <div class="carousel" id="postures">
                    <div class="carousel-inner">
                    <?php
                            $posture_imageIDs = get_custom_field('posture_img');
                            $i = 0;
                            $initClass = "";

                            foreach($posture_imageIDs as $img_id) {
                                $posture_img = wp_get_attachment_image_src( $img_id, 'full' ); // returns an array

                                if($i == 0){
                                    $initClass = "active";
                                } else {
                                    $initClass = "";
                                }

                                echo '<div class="item '.$initClass.'"><img src="'.$posture_img[0].'" width="'.$posture_img[1].'" height="'.$posture_img[2].'" /></div>';
                                $i = $i + 1;


                            } // END foreach

                    ?>
                    </div>
                </div>
                <!-- END .carousel -->


                <div class="postureDescription">
                    <?php print_custom_field('posturedescription:do_shortcode'); ?>
                </div>




                <?php
                    } // END while()
                } else { ?>

                <div class="post box">
                    <h3><?php _e('There is no posture available.', 'localization'); ?></h3>
                </div>

                <?php
                } // END if()
                ?>

            </div>
            <!-- END: .page-content (left column) -->
            <div class="span4 sidebar menu-container autoActivate">
                <h2 class="title"><a href="../">Bikram Postures</a></h2>
                <ul class="nav nav-pills nav-stacked">
                    <?php $args = array (
                            'post_type' => 'postures',
                            'title_li' => ''
                        );
                    ?>

                    <?php wp_list_pages($args); ?>

                </ul>
            </div>
            <!-- END: .sidebar (right column) -->
        </div>
        <!-- END: .page-container -->

<?php get_footer(); ?>