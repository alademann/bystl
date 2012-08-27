
        <?php if(
                function_exists('bcn_display') &&
                !is_only_home()
                ) {
        ?>
        <div class="container-fluid" id="siteBreadcrumbs">
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
                            <?php wp_list_pages('post_status=publish&title_li=&depth=1&exclude=148'); ?>
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
                {masonry:     "<?php echo get_bloginfo('template_url').'/js/jquery.masonry.min.js'; ?>"},
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
    <script type="text/javascript" src="<?php echo get_bloginfo('template_url').'/js/footer-onload.js'; ?>"></script>
    <script type="text/javascript">
    head.ready(function(){

        var homePageSlider = $(".homeSlider #slider");
        <?php
            if (get_option_tree('auto') == 'Yes') {
                $defaultSpeed = 1500;
                if(get_option_tree('auto_speed') != ''){
                    $timeout = get_option_tree('auto_speed') * 1000;
                } else {
                    $timeout = $defaultSpeed;
                }
            } else {
                $timeout = 0;
            }
        ?>
        if(homePageSlider) {
            $('.homeSlider .carousel').carousel({
                interval: <?php echo $timeout; ?>
            });
        }

    });
    </script>
    <?php if(is_ios() == "true"){ ?>
    <script type="text/javascript" id="iOSscripts">
        head.ready("jquery", function(){
            head.js(
                {iosOrientation:"<?php echo get_bloginfo('template_url').'/js/ios-orientationchange-fix.js'; ?>" }
            );
        });
    </script>

        <?php if(is_iphone() == "true"){ ?>
        <script type="text/javascript" id="iPhoneScripts">
            //alert("iphone");
            if(!pageYOffset && !location.hash){
                setTimeout(function () {
                  window.scrollTo(0, 1);
                }, 2000);
            }

        </script>

        <?php } ?>

    <?php } ?>
  </body>

</html>