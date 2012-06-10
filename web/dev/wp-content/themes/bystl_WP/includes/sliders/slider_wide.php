 <div class="slider clearfix">

            <div class="container-fluid">

                <div class="row-fluid">

                    <div class="large-slider span-two-thirds">

                        <div id="slider">

                            <ul class="images-wide">

                                <?php
if ( function_exists( 'get_option_tree' ) ) {
  $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
  foreach( $slides as $slide ) {
    echo '
    <li><a href="'.$slide['link'].'"><img src="'.get_bloginfo('template_url').'/includes/timthumb.php?q=100&amp;w=940&amp;h=330&amp;zc=1&amp;src='.$slide['image'].'" alt="'.$slide['title'].'" /></a></li>';

  }
}
?>
                            </ul>

                            <ul class="slider-nav-wide clearfix">

                                     <?php

if ( function_exists( 'get_option_tree' ) ) {
  $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
  foreach( $slides as $slide ) {
    echo '
    <li><a href="'.$slide['link'].'">'.$slide['title'].'</a></li>';
  }
}
?>
                           </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>