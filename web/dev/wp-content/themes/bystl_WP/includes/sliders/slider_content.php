<div class="container-fluid" id="slider">
    <div id="content-slider" class="carousel slide">
        <div class="carousel-inner">

            <?php if ( function_exists( 'get_option_tree' ) ) {
                $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
                $i = 0;
                $initClass = "";
                foreach( $slides as $slide ) {
                  if($i == 0){ $initClass = "active"; } else { $initClass = ""; }
                    echo '<div class="item '.$initClass.'"><div class="span-two-thirds"><img src="'.$slide['image'].'" alt="'.$slide['title'].'" /></div><div class="span-one-third"><p><strong class="h1">'.$slide['title2'].'</strong></p><p>'.$slide[''].'</p></div></div>';
                    $i = $ + 1;
                }
            } ?>

        </div>
    </div>
</div>

<!-- <a class="small-btn blue rounded-1" href="'.$slide['btnlink'].'">'.$slide['btntext'].'</a> -->