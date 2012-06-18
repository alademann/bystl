<div class="container-fluid" id="slider">
  <div id="large-slider" class="carousel slide">
    <div class="carousel-inner">

      <?php if ( function_exists( 'get_option_tree' ) ) {
        $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
        $i = 0;
        $initClass = "";
        foreach( $slides as $slide ) {
          if($i == 0){ $initClass = "active"; } else { $initClass = ""; }
          echo '<div class="item '.$initClass.'"><img src="'.$slide['image'].'" alt="'.$slide['title'].'" /></div>';
          $i = $i + 1;
        }
      } ?>

    </div>
    <a class="carousel-control left" href="#large-slider" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#large-slider" data-slide="next">&rsaquo;</a>
  </div>
</div>