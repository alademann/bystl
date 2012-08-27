<?php if ( function_exists( 'get_option_tree' ) ) {

  $sliderTitle    = get_option_tree( 'slider_title', $option_tree, false, false, -1);
  $sliderText     = get_option_tree( 'slider_text', $option_tree, false, false, -1);
  $singleBtnShow  = "false";

  // the main button (not tied to a specific item in the slider)
  if( get_option_tree( 'button_text' ) == "Yes" ) {
    $singleBtnShow = "true";
  } else {
    $singleBtnShow = "false";
  }
  $singleBtnURL   = get_option_tree( 'button_url' );
  $singleBtnText  = get_option_tree( 'button_text_text' );

  $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
  $i = 0;
  $initClass = "";
  $itemLinkShow = "false";
  $itemBtnShow = "false";

?>

<div class="container-fluid" id="slider">
  <div id="content-slider">
    <div class="row-fluid">

          <div class="span6">
            <div class="content slider-intro slider-intro-left">
              <p class="h1"><?php echo $sliderTitle; ?></p>
              <div class="description">
                <?php echo $sliderText; ?>
              </div>
              <?php if($singleBtnShow == "true") { ?>
              <a class="btn btn-primary btn-large" href="<?php echo $singleBtnURL; ?>"><?php echo $singleBtnText; ?></a>
              <?php } ?>
            </div>
          </div>
          <!-- END left column -->

          <div class="span10">

            <div class="carousel slide">
                <div class="carousel-inner">

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

                    ?>

                    <div class="item <?php echo $initClass; ?>">
                        <?php if($itemLinkShow == "true") { ?>
                        <a rel="nofollow" href="<?php echo $itemURL; ?>" title="<?php echo $slide['title']; ?>">
                        <?php } ?>
                        <img src="<?php echo $slide['image']; ?>" alt="<?php echo $slide['title'] ?>" />
                        <?php if($itemLinkShow == "true") { ?>
                        </a>
                        <?php } ?>
                        <div class="controls" style="display: none;">
                            <a class="fade carousel-control left" href="#prev" data-slide="prev">&lsaquo;</a>
                            <a class="fade carousel-control right" href="#next" data-slide="next">&rsaquo;</a>
                        </div>
                    </div>

                    <?php
                      $i = $i + 1;
                    } // END foreach
                    ?>

                </div>
            </div>

          </div>
          <!-- END right column -->


    </div>
  </div>
</div>
<?php } ?>