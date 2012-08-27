<div id="slider">
  <div id="content-slider" class="carousel slide row-fluid">
    <div class="carousel-inner">

      <?php if ( function_exists( 'get_option_tree' ) ) {
        $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
        $i = 0;
        $initClass = "";

        foreach( $slides as $slide ) {
          if($i == 0){
            $initClass = "active";
          } else {
            $initClass = "";
          }
        ?>
        <div class="item <?php echo $initClass; ?>">
          <div class="span6">
            <div class="content">
              <span class="h1"><?php echo $slide['title']; ?></span>
              <p><?php echo $slide['description']; ?></p>
            </div>
          </div>
          <!-- END left column -->

          <div class="span10">
            <img src="<?php echo $slide['image']; ?>" alt="<?php echo $slide['title2'] ?>" />
            <a class="fade carousel-control left" href="#large-slider" data-slide="prev">&lsaquo;</a>
            <a class="fade carousel-control right" href="#large-slider" data-slide="next">&rsaquo;</a>
          </div>
          <!-- END right column -->
        </div>
        <?php
          $i = $i + 1;
        } // END foreach
      } // END if
        ?>


    </div>
  </div>
</div>