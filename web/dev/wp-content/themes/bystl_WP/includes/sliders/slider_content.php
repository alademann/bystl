<div class="container-fluid">
    <div id="content-slider" class="carousel slide">
        <div class="carousel-inner">

            <?php if ( function_exists( 'get_option_tree' ) ) {
                $slides = get_option_tree( 'slides', $option_tree, false, true, -1 );
                foreach( $slides as $slide ) {
                echo '<div class="item"><div class="span-two-thirds"><img src="'.get_bloginfo('template_url').'/includes/timthumb.php?q=100&amp;w=940&amp;h=500&amp;zc=1&amp;src='.$slide['image'].'" alt="'.$slide['title'].'" /></div><div class="span-one-third"><p><strong class="h1">'.$slide['title2'].'</strong></p><p>'.$slide[''].'</p></div></div>';
                }
            } ?>

        </div>
    </div>
</div>

<!-- <a class="small-btn blue rounded-1" href="'.$slide['btnlink'].'">'.$slide['btntext'].'</a> -->