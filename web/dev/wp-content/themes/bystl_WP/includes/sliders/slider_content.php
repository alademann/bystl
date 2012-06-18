<div class="container-fluid" id="slider">
    <div id="content-slider" class="carousel slide">
        <div class="carousel-inner">

            <?php if ( function_exists( 'get_option_tree' ) ) {
                $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
                foreach( $slides as $slide ) {
                echo '<div class="item"><div class="span-two-thirds"><img width="940" height="500" src="'.$slide['image'].'" alt="'.$slide['title'].'" /></div><div class="span-one-third"><p><strong class="h1">'.$slide['title2'].'</strong></p><p>'.$slide[''].'</p></div></div>';
                }
            } ?>

        </div>
    </div>
</div>

<!-- <a class="small-btn blue rounded-1" href="'.$slide['btnlink'].'">'.$slide['btntext'].'</a> -->