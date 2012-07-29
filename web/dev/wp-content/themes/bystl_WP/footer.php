        <?php if(function_exists('bcn_display') && !is_home()) { ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div id="crumbs" class="span16">
                    <ul class="breadcrumb">
                        <?php bcn_display(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>

        <div id="alternate">
            <div class="container-fluid">
                <div class="row-fluid clearfix">
                    <ul class="span16">
                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Dark Footer")); ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: #alternate -->

        <div class="footer">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span16">
                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Light Footer")); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: #footer -->

        <div class="small-footer">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="footer-left span8">
                        Copyright &copy; Bikram Yoga St. Louis <?php echo date("Y"); ?>
                        <?php echo get_option_tree('footer_left_content'); ?>
                    </div>

                    <div class="footer-right span8">
                        <ul class="breadcrumb pull-right">
                            <li><a href="about/contact-us/">Contact</a></li>
                            <?php wp_list_pages('post_status=publish&title_li=&depth=1'); ?>
                        </ul>
                        <?php echo get_option_tree('footer_right_content'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!--- END: .small-footer -->

    </div>
    <!-- END: #pageWrapper -->

<!-- SCRIPTS GO HERE -->
<script type="text/javascript">
    head.js(
            {jquery: "https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"}
        );

    head.ready("jquery", function(){

        head.js(
            {iosOrientation:"<?php echo get_bloginfo('template_url').'/js/ios-orientationchange-fix.js'; ?>" },
            {cycle:         "<?php echo get_bloginfo('template_url').'/js/jquery.cycle.all.js'; ?>"},
            {easing:        "<?php echo get_bloginfo('template_url').'/js/jquery.easing.1.3.js'; ?>"},
            {bootstrap:     "<?php echo get_bloginfo('template_url').'/js/bootstrap/bootstrap.min.js'; ?>"},
            {twitter:       "<?php echo get_bloginfo('template_url').'/js/twitter.js'; ?>"},
            {synapse:       "<?php echo get_bloginfo('template_url').'/js/script.js'; ?>"},
            {prettyphoto:   "<?php echo get_bloginfo('template_url').'/js/jquery.prettyPhoto.js'; ?>"},
            {isotope:       "<?php echo get_bloginfo('template_url').'/js/jquery.isotope.min.js'; ?>"},
            {backstretch:   "<?php echo get_bloginfo('template_url').'/js/jquery.backstretch.min.js'; ?>"},
            {prettifyCode:  "<?php echo get_bloginfo('template_url').'/js/prettify/prettify.js'; ?>"}
        );

        
        var wp_active = $(".nav li[class*='current']");
        $.each(wp_active, function(){
            $(this).addClass("active");
        });

    }); // END head.ready(jquery)
    
</script>
<script type="text/javascript">

head.ready("bootstrap", function() {

    <?php if (get_option_tree('auto') == 'Yes') {  $timeout = 6000; } else { $timeout = 0; } ?>

    //var prepHeight = $('#large-slider').find(".item:first-child > img").height();
    //$('#large-slider').css("min-height", prepHeight);

    // make the overlay content the same size as the image
    var itemContent = $('.carousel .content');
    findEmptyCaptions();
    //setTimeout(matchSize, 2000);
    matchSize();
    

    window.onresize = function(event) {
        matchSize();
    }

    function findEmptyCaptions(){
        $.each(itemContent, function(){
            $(this).find("p:empty",".h1:empty").hide();
        });
    }

    function matchSize(){
        var carouselImg = $('.carousel .item:visible > img');
        var imgHeight = $(carouselImg).height();
        var imgWidth = $(carouselImg).width();
        var singleContainer = $(".carousel .itemOverlay > .content");
        var singleTitle = $(".carousel .itemOverlay > .content > .h1");
        var singleCaption = $(".carousel .itemOverlay > .content > p");
        var singleTitleHeight = $(singleTitle).height() + $(singleCaption).height();

        console.log("singleTitleH: " + $(singleTitle).height());
        console.log("singleCaptionH: " + $(singleCaption).height());

        $(singleContainer).css({
            width: imgWidth,
            // top: imgHeight - singleTitleHeight
        });

        $.each(itemContent, function(){
            $(this).css("height", imgHeight);
        });

        $(singleContainer).css({
            // width: imgWidth,
            top: imgHeight - singleTitleHeight - 20,
            height: singleTitleHeight
        });
        
    }

    $('.carousel').carousel({
        interval: <?php echo $timeout; ?>
    });
    // $('.carousel').bind('slide', function(){
    //     $(".carousel-control.left, .carousel-control.right", this).delay(500).show();
    // });


}); // END head.ready

</script>

<?php if (get_post_meta(get_the_id(), 'ddportfolioBG', true) != '') {

    $portfolioBG = ddListGet('portfolioBG', get_the_ID());
    
    ?>
                            
    <script type="text/javascript">
        head.ready(function(){
            jQuery.backstretch("<?php echo $portfolioBG[0]['img_url']; ?>");
        }); // END head.ready
     </script>
         
<?php } ?>

  </body>

</html>

