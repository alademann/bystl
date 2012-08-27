<?php if ( function_exists( 'get_option_tree' ) ) {

  $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
  $i = 0;
  $initClass = "";
  $itemLinkShow = "false";
  $itemBtnShow = "false";

?>

<div class="container-fluid" id="slider">
  <div id="content-slider" class="carousel slide">
    <div class="carousel-inner row-fluid">

      <?php
        foreach( $slides as $slide ) {

          //$initClass    = ($i == 0) ? "active", "";
          if($i == 0) {
            $initClass = "active";
          } else {
            $initClass = "";
          }

          // link to post?
          $itemURL      = $slide['link'];
          if($itemURL != "") {
            $itemLinkShow = "true";
          } else {
            $itemLinkShow = "false";
          }

          // content button
          $itemBtnText  = $slide['btntext'];
          $itemBtnURL   = $slide['btnlink'];
          // both fields need to have values if we're going to show a button there.
          if($itemBtnText != "") {
            if($itemBtnURL != "") {
              $itemBtnShow = "true";
            } else {
              $itemBtnShow = "false";
            }
          } else {
            $itemBtnShow = "false";
          }

        ?>

        <div class="item <?php echo $initClass; ?>">
          <div class="span6">
            <div class="content slider-intro slider-intro-left">
              <p class="h1"><?php echo $slide['title2']; ?></p>
              <div class="description"><?php echo $slide['description']; ?></div>
              <?php if($itemBtnShow == "true") { ?>
              <a class="btn btn-primary btn-large" href="<?php echo $itemBtnURL; ?>"><?php echo $itemBtnText; ?></a>
              <?php } ?>
            </div>
          </div>
          <!-- END left column -->

          <div class="span10">
            <?php if($itemLinkShow == "true") { ?>
            <a rel="nofollow" href="<?php echo $itemURL; ?>" title="<?php echo $slide['title']; ?>">
            <?php } ?>
            <img src="<?php echo $slide['image']; ?>" alt="<?php echo $slide['title'] ?>" />
            <?php if($itemLinkShow == "true") { ?>
            </a>
            <?php } ?>
            <div class="controls" style="display: none;">
                <a rel="nofollow" class="fade carousel-control left" href="#prev" data-slide="prev">&lsaquo;</a>
                <a rel="nofollow" class="fade carousel-control right" href="#next" data-slide="next">&rsaquo;</a>
            </div>
          </div>
          <!-- END right column -->
        </div>
        <?php
          $i = $i + 1;
        } // END foreach
        ?>


    </div>
  </div>
</div>
<?php } ?>