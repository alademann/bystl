
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
                        <span class="copyright">Copyright &copy; <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>&nbsp;<?php echo date("Y"); ?></span>
                        <?php echo get_option_tree('footer_left_content'); ?>
                    </div>

                    <div class="footer-right span8">

                        <?php wp_nav_menu( 
                            array( 
                                'container' => false,
                                'theme_location' => 'my-footer-menu',
                                'menu_class' => 'breadcrumb pull-right',
                                'depth' => -1,
                                'walker' => new Bootstrap_Walker_Nav_Menu()
                                ) 
                            ); 
                        ?>

                        <?php echo get_option_tree('footer_right_content'); ?>

                    </div>
                </div>
            </div>
        </div>
        <!--- END: .small-footer -->

    </div>
    <!-- END: #pageWrapper -->

    <div id="mbolModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Sign up for Bikram Yoga!</h3>
      </div>
      <div class="modal-body">
        <p>Loading&hellip;</p>
      </div>
      <div class="modal-footer hide">
        <a href="#" class="btn">Close</a>
      </div>
    </div>

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
                {prettifyCode:  "<?php echo get_bloginfo('template_url').'/js/prettify/prettify.js'; ?>"},
                {mbolPopup:     "<?php echo get_bloginfo('template_url').'/js/mbol_wsLaunch.js'; ?>"}
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