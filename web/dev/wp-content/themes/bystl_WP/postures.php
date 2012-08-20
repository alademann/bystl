<?php /*
  Template Name: Postures
 */ ?>

<?php get_header(); ?>

<?php
  global $paged;

  $arguments = array(
      'post_type' => 'postures',
      'post_status' => 'publish',
      'orderby' => 'menu_order',
      'order' => 'asc',
      'posts_per_page' => '-1',
      'paged' => 0,

  );

  $postures_query = new WP_Query($arguments);

  dd_set_query($postures_query);

  global $more;
  $more = 0;

  //$terms = get_terms("testimonial_categories");
  //$count = count($terms);

?>

        <div class="page-container row-fluid clearfix">

          <div class="page-content full span16 postures">

          <?php the_content(); ?>

          <?php if ($postures_query->have_posts()) :
            while ($postures_query->have_posts()) : $postures_query->the_post();

          ?>

              <div class="posture">

                <?php

                   //$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
                   //echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
                    $postureThumbs = get_custom_field('posture_img_thumb');
                    foreach($postureThumbs as $thumbID) {
                      $postureThumb = wp_get_attachment_image_src( $thumbID, 'thumbnail' );
                    }

                    echo "<div class='postureImg'>";
                    echo "<img src='".$postureThumb[0]."' width='".$postureThumb[1]."' height='".$postureThumb[2]."' />";
                    echo "</div>";
                    echo "<div class='en'>".get_custom_field('posture_name_en')."</div>";
                    echo "<div class='sa' lang='sa'>".get_custom_field('posture_name')."</div>";
                   //echo '</a>';

                ?>

              </div>


          <?php endwhile; ?>

          <?php
              kriesi_pagination();
              dd_restore_query();
          ?>

          <?php endif; ?>

          </div>
          <!-- END: .testimonial-items -->

        </div>
        <!-- END: .page-container -->

<?php get_footer(); ?>

