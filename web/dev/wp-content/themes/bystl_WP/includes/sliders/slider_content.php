<div class="slider container clearfix">

            <a id="prev-arrow" href="#">Previous</a>
            <a id="next-arrow" href="#">Next</a>

            <ul class="content-slider clearfix">



                <?php
if ( function_exists( 'get_option_tree' ) ) {
  $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
  foreach( $slides as $slide ) {
    echo '
    <li class="container">

        <div class="row">


            <div class="span-one-third slider-intro-left">

                <h1>'.$slide['title2'].'</h1>

                <p>'.$slide['description'].'</p>

    <a class="small-btn blue rounded-1" href="'.$slide['btnlink'].'">'.$slide['btntext'].'</a>
       
            </div>
            
            <div class="span-two-thirds img-container">

                <a href="'.$slide['link'].'"><img src="'.get_bloginfo('template_url').'/includes/timthumb.php?q=100&amp;w=620&amp;h=330&amp;zc=1&amp;src='.$slide['image'].'" alt="'.$slide['title'].'" /></a>

            </div>

        </div>

    </li>

';

  }
}
?>

            </ul>

            <div class="container content-slider-pager">


                <div id="content-slider-pager"></div>



            </div>

        </div>