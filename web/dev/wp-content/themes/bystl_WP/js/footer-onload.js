head.ready("jquery", function(){
    // GLOBAL SCOPE VARS
    mbolModalElem = $("#mbolModal"); 
    mbolModalElemID = '#' + $(mbolModalElem).attr("id");
    launched = false;
});

head.ready("bootstrap", function() {

    /* MINDBODY ONLINE MODAL SYSTEM */
    var mbolLaunchers, mbolLaunchersHere;

    mbolLaunchers = $("a[data-target='#mbolModal']");
    mbolLaunchersHere = $(mbolLaunchers).length;

    if(mbolLaunchersHere > 0 && mbolModalElem != undefined) {

        //console.log("found " + mbolLaunchersHere + " launchers");

        $(mbolLaunchers).each(function(){
            $(this).on("click", function(e) {
                e.preventDefault();
                
                modalURL = $(this).attr("href");
                
                var screenType = modalURL.substring(modalURL.lastIndexOf("&stype=") + 7, modalURL.length);
                    //console.info(screenType);

                switch(screenType) {
                    case '41':
                        screenClass = "prices";
                    break;
                    default:
                        screenClass = "prices";
                } // END switch(screenType)

                // set the size of the modal to fit and launch it!
                initMbolModal();

            });

        });
            
        // bind window resize while modal is being shown
        $(mbolModalElem).on('shown', function () {
            //console.info("showing modal");
            window.addEventListener('resize', initMbolModal, false);
            launched = true;
        });

        // unbind when its hidden to save CPU
        $(mbolModalElem).on('hidden', function () {
            //console.info("hiding modal");
            window.removeEventListener('resize', initMbolModal, false);
            launched = false;
        });

    } else {
        //console.warn("no launchers found (" + mbolLaunchersHere + ")");
    }




    /* TABS */

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


    $('.carousel#postures').carousel({
        interval: 1000
    });

    var sidebarTestimonialWidget, footerTestimonialWidget;
    
    sidebarTestimonialWidget = $(".sidebar .testimonials");
    footerTestimonialWidget  = $("#alternate .testimonials");

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
    } // END launchTestimonialsPager


}); // END head.ready
