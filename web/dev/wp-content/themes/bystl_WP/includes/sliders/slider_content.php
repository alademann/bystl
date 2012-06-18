<div class="slider container-fluid clearfix">

            <!--<a id="prev-arrow" href="#">Previous</a>
            <a id="next-arrow" href="#">Next</a>-->

    <ul class="content-slider clearfix">

                <?php
if ( function_exists( 'get_option_tree' ) ) {
  $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
  foreach( $slides as $slide ) {
    echo '
        <li class="row-fluid">

        
            <div class="span-two-thirds img-container">

                <a href="'.$slide['link'].'"><img src="'.get_bloginfo('template_url').'/includes/timthumb.php?q=100&amp;w=620&amp;h=330&amp;zc=1&amp;src='.$slide['image'].'" alt="'.$slide['title'].'" /></a>

            </div>

            <div class="span-one-third slider-intro-right">

                <p><strong class="h1">'.$slide['title2'].'</strong></p>

                <p>'.$slide['description'].'</p>

    <a class="small-btn blue rounded-1" href="'.$slide['btnlink'].'">'.$slide['btntext'].'</a>
       
            </div>
            
        

        </li>

';

  }
}
?>

    </ul>

    <div class="content-slider-pager">

        <div id="content-slider-pager"></div>

    </div>

</div>