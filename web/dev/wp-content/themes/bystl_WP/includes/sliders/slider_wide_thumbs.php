<div class="slider clearfix">

            <div class="container-fluid">

                <div class="row-fluid">

                    <div class="large-slider">

                        <div id="slider-thumbs">

                            <ul class="images-wide-thumb">

                                <?php
if ( function_exists( 'get_option_tree' ) ) {
  $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
  foreach( $slides as $slide ) {
    echo '
    <li><a href="'.$slide['link'].'"><img width="940" height="500" src="'.$slide['image'].'" alt="'.$slide['title'].'" /></a></li>';

  }
}
?>

                            </ul>

                            <ul class="slider-nav-thumbs slider-nav-wide-thumbs clearfix">

                                <?php
if ( function_exists( 'get_option_tree' ) ) {
  $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
  foreach( $slides as $slide ) {
   echo '<li><a href="#"><img width="45" height="45" src="'.$slide['image'].'" /></a></li>';

  }
}
?>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>