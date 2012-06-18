<div class="container-fluid" id="slider">
  <div id="large-slider" class="carousel slide">
    <div class="carousel-inner">

      <?php if ( function_exists( 'get_option_tree' ) ) {
        $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
        foreach( $slides as $slide ) {
        echo '<div class="item"><img src="'.$slide['image'].'" alt="'.$slide['title'].'" /></div>';
        }
      } ?>

    </div>
    <a class="carousel-control left" href="#large-slider" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#large-slider" data-slide="next">&rsaquo;</a>
  </div>
</div>