<?php /*
  Template Name: Testimonials
 */ ?>

<?php get_header(); ?>

<?php
  global $paged;

  $arguments = array(
      'post_type' => 'testimonial',
      'post_status' => 'publish',
      'posts_per_page' => '-1',
      'paged' => 0,

  );

  $testimonial_query = new WP_Query($arguments);

  dd_set_query($testimonial_query);

  $terms = get_terms("testimonial_categories");
  $count = count($terms);

?>

        <div class="row-fluid page-container clearfix navWrapper">
          <?php
            if ( $count > 1 ) {
          ?>

            <ul class="nav nav-pills span16 clearfix">

                <li class="active"><a href="#" data-filter="testimonialArchive">Show All</a></li>

                <?php
                  if ( $count > 0 ){
                    echo "<ul>";
                    foreach ( $terms as $term ) {
                      echo '<li><a href="" data-filter="' . $term->name . '">' . $term->name . '</li></a>';

                    }
                    echo "</ul>";
                  }

                ?>

            </ul>
            <!-- END: filters -->

          <?php
            } // END if($count > 0)
          ?>
        </div>

        <div class="page-container row-fluid clearfix">

          <h1>Testimonials</h1>

          <div id="testimonialItems" class="full span16">

          <?php if ($testimonial_query->have_posts()) :
            while ($testimonial_query->have_posts()) : $testimonial_query->the_post();
          ?>

            <div class="box boxWhite testimonialArchive span-one-third <?php echo custom_taxonomies_terms_text(); ?>">
              <div class="wrapper">
                <strong class="h4"><a class="permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong> <br />
                <blockquote>
                  <?php the_excerpt(); ?>
                </blockquote>
                <p class="testimonial-author"><?php echo get_post_meta( get_the_ID(), 'tbtestimonial_author', 1 ); ?></p>
              </div>
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

<script type="text/javascript">
  head.ready("masonry", function(){

    var $container = $("#testimonialItems");

    var testimonials = $container.find(".testimonialArchive");
    //console.log(testimonials.length);

    $(testimonials).each(function(){

      var permalink = $(this).find(".permalink").attr("href");

      $(this).bind("click", function(){
        window.location = permalink;
      });

      $(this).hover(
        function () {
          //console.log("hovering");
          $(this).addClass("hover");
        },
        function () {
          //console.log("hover-out");
          $(this).removeClass("hover");
        }
      );

    });

    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector : '.testimonialArchive',
        gutterWidth  : 10,
        columnWidth  : function( containerWidth ) {
           return containerWidth / 3.2;
        }
      }); // END .masonry()
    }); // END .imagesLoaded()

  }); // END head.ready(masonry)

</script>

<?php get_footer(); ?>

