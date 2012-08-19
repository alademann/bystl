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

                    //moveActiveToTop();

                }


                index = index + 1;
            });
        }


    } // END function autoActivateLinks()



    // find all <ul> elems with class "autoActivate" and compare the url to the hrefs of the links inside
    autoActivateLinks();


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
        interval: 6000
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