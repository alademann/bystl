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

        <div class="footer">

            <div class="container-fluid">

            <div class="row-fluid">

                
                    <div class="span16">

 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Light Footer")); ?>
                    </div>

                

            </div>
        </div>
    </div>

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

    </div>
    <!-- END: container-fluid -->

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
            {twitter:       "<?php echo get_bloginfo('template_url').'/js/twitter.js'; ?>"},
            {synapse:       "<?php echo get_bloginfo('template_url').'/js/script.js'; ?>"},
            {prettyphoto:   "<?php echo get_bloginfo('template_url').'/js/jquery.prettyPhoto.js'; ?>"},
            {isotope:       "<?php echo get_bloginfo('template_url').'/js/jquery.isotope.min.js'; ?>"},
            {backstretch:   "<?php echo get_bloginfo('template_url').'/js/jquery.backstretch.min.js'; ?>"},
            {prettifyCode:  "<?php echo get_bloginfo('template_url').'/js/prettify/prettify.js'; ?>"},
            {bootstrap:     "<?php echo get_bloginfo('template_url').'/js/bootstrap/bootstrap.min.js'; ?>"}
        );

        
        var wp_active = $(".nav li[class*='current']");
        $.each(wp_active, function(){
            $(this).addClass("active");
        });

    }); // END head.ready(jquery)
    
</script>
<script type="text/javascript">

head.ready(function() {

    <?php if (get_option_tree('auto') == 'Yes') {  $timeout = 4000; } else { $timeout = 0; } ?>

    //var prepHeight = $('#large-slider').find(".item:first-child > img").height();
    //$('#large-slider').css("min-height", prepHeight);


    $('.carousel').carousel({
        interval: <?php echo $timeout; ?>
    }).bind("slid", function(){
        $img = $(".active img", this);
        $img.attr("src", $img.data("lazy-load-src"));
    });

/*
    jQuery('.images').cycle({
                fx:     'fade',
                speed:    1500,
                timeout:  <?php echo $timeout; ?>,
                pager:  '.slider-nav',
                pagerAnchorBuilder: function(idx, slide) {
                    // return selector string for existing anchor
                    return '.slider-nav li:eq(' + idx + ') a';}
            });

              jQuery('.images-thumb').cycle({
                fx:     'fade',
                speed:    1500,
                timeout:  <?php echo $timeout; ?>,
                pager:  '.slider-nav-thumbs',
                pagerAnchorBuilder: function(idx, slide) {
                    // return selector string for existing anchor
                    return '.slider-nav-thumbs li:eq(' + idx + ') a';}
            });

             jQuery('.images-wide').cycle({
                fx:     'fade',
                speed:    1500,
                timeout:  <?php echo $timeout; ?>,
                pager:  '.slider-nav-wide',
                pagerAnchorBuilder: function(idx, slide) {
                    // return selector string for existing anchor
                    return '.slider-nav-wide li:eq(' + idx + ') a';}
            });

              jQuery('.images-wide-thumb').cycle({
                fx:     'fade',
                speed:    1500,
                timeout:  <?php echo $timeout; ?>,
                pager:  '.slider-nav-thumbs',
                pagerAnchorBuilder: function(idx, slide) {
                    // return selector string for existing anchor
                    return '.slider-nav-thumbs li:eq(' + idx + ') a';}
            });

        jQuery('.content-slider').cycle({
                'fx' : 'fade',
                'timeout' : <?php echo $timeout; ?>,
                'pager' : '#content-slider-pager',
                'next':   '#next-arrow',
                'pause':   1,
                'prev':   '#prev-arrow'
             });
*/


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

