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
<script type="text/javascript">

head.ready("bootstrap", function() {

    var tabs = $(".nav-tabs");
    var tabsHere = $(tabs).length;
    //console.log("found " + tabsHere + "tab sections");
    if(tabsHere > 0) {
        $(tabs).each(function(){
            var tabBtn = $(this).find(" > li a");
            $(tabBtn).click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // activate first tab
            $(tabBtn).filter(":first").tab("show");

        });

    } // end if(tabsHere)

    // END TAB ACTIVATION


    function moveActiveToTop(){
        // move active sidebar link to the top of the list so it's visible

        var sideBarMenuLists = $(".sidebar.menu-container .nav");

        if(sideBarMenuLists.length > 0) {
            //console.log("I found " + sideBarMenuLists.length + " sideBarMenus");

            $(sideBarMenuLists).each(function(index){
                if(index == 0){ index = 1};

                var firstLI = $(this).find("li:first");
                var activeLI = $(this).find("li.active");

                activeLI.insertBefore(firstLI);

                index = index + 1;
            })

        }


        $('#list').delegate('input[type="button"]', 'click', function() {
            var parent = $(this).parent();

            if(this.value === 'higher'){
                parent.insertBefore(parent.prev());
            } else {
                parent.insertAfter(parent.next());
            }

            return false;
        });
    } // END function moveActiveToTop()

    function autoActivateLinks() {
        // system to activate an item in a list of links if it's href matches the URL string
        // Select an a element that has the matching href and apply a class of 'active'. Also prepend a - to the content of the link
        var url = window.location;
        var linkLists = $(".autoActivate");

        if(linkLists.length > 0){
            //console.log("I found " + linkLists.length + " linkLists");

            $(linkLists).each(function(index){
                if(index == 0){ index = 1};

                //console.info("iteration: " + index);
                $(this).find('a[href="'+url+'"]').closest("li").addClass('active');

                if(index == linkLists.length) {
                    //console.log("end of the line... index(" + index + ") == this.length(" + linkLists.length + ")");

                    moveActiveToTop();

                }


                index = index + 1;
            });
        }


    } // END function autoActivateLinks()



    // find all <ul> elems with class "autoActivate" and compare the url to the hrefs of the links inside
    autoActivateLinks();


    <?php if (get_option_tree('auto') == 'Yes') {  $timeout = 6000; } else { $timeout = 0; } ?>

    //var prepHeight = $('#large-slider').find(".item:first-child > img").height();
    //$('#large-slider').css("min-height", prepHeight);

    $(".carousel").hover(
      function () {
        $(this).addClass("hover");
      },
      function () {
        $(this).removeClass("hover");
      }
    );

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

        //console.log("singleTitleH: " + $(singleTitle).height());
        //console.log("singleCaptionH: " + $(singleCaption).height());

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

    var sidebarTestimonialWidget = $(".sidebar .testimonials");
    var footerTestimonialWidget  = $("#alternate .testimonials")
    //console.log("found " + sidebarTestimonialWidget.length);

    launchTestimonialsPager(sidebarTestimonialWidget);
    launchTestimonialsPager(footerTestimonialWidget);

    function launchTestimonialsPager(widget){
        var thisPager = $(widget).find(" + .testimonial-pager");
        $(widget).cycle({
            fx: 'scrollRight',
            speed: 900,
            timeout: 7000,
            pager: thisPager
            // pagerAnchorBuilder: function(idx, slide){
            //     return '#testimonial-pager li:eq(' + idx + ') a';
            // }

            //speed: tbtestimonial_settings.transition_interval * 1000
        });
    }

    //$.each(testimonialsWidgets, function(){

    //});

    // $('.carousel').bind('slide', function(){
    //     $(".carousel-control.left, .carousel-control.right", this).delay(500).show();
    // });


}); // END head.ready

</script>

  </body>

</html>

