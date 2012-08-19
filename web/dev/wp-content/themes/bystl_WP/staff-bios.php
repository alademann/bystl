<?php /*
  Template Name: Staff Bios
 */ ?>

<?php get_header(); ?>

<?php
  global $paged;

  $arguments = array(
      'post_type' => 'staff-bios',
      'post_status' => 'publish',
      'orderby' => 'menu_order',
      'order' => 'asc',
      'posts_per_page' => '-1',
      'paged' => 0,

  );

  $bios_query = new WP_Query($arguments);

  dd_set_query($bios_query);

  global $more;
  $more = 0;

  //$terms = get_terms("testimonial_categories");
  //$count = count($terms);

?>

        <div class="page-container row-fluid clearfix">

          <div class="page-content full span16 staffBios">

          <?php the_content(); ?>

          <?php if ($bios_query->have_posts()) :
            while ($bios_query->have_posts()) : $bios_query->the_post();

          ?>

              <div class="bio-entry">

                <?php
                 if ( has_post_thumbnail()) {
                   //$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
                   //echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
                    echo "<div class='bioImg'>";
                    echo get_the_post_thumbnail($post->ID, 'full');
                    echo "</div>";
                   //echo '</a>';
                 }
                ?>

                <h4><a class="permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <?php the_content('Read More&hellip;',false,''); ?>

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

