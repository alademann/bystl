$(document).ready(function() {

    /* initiate core bootstrap functions -------------------------------------*/

    // dropdowns
    $('.dropdown-toggle').dropdown();

    // alerts
    $(".alert-message, .alert").alert();

    // tabs
    $('.nav-tabs li > a, .tabs li > a').click(function(e){
        e.preventDefault();
        $(this).tab("show");
    }); // END .tabs

    // END BOOTSTRAP FUNCTIONS

$('.portfolio-hover').css({opacity: 0});

$('.portfolio-hover').hover(function(){

    $(this).addClass('current_project');
    $('.current_project').stop().animate({opacity: 1}, 400);

}, function(){

     $('.current_project').stop().animate({opacity: 0}, 300);
     $('.current_project').removeClass('current_project');

});

/* Isotope -------------------------------------*/

	  if( $().isotope ) {

	    $(function() {

            var container = $('.portfolio-items'),
                optionFilter = $('#filters'),
                optionFilterLinks = optionFilter.find('a');

            optionFilterLinks.attr('href', '#');

            optionFilterLinks.click(function(){
                var selector = $(this).attr('data-filter');
                container.isotope({
                    filter : '.' + selector,
                    itemSelector : '.span-one-third',
                    layoutMode : 'masonry',
                    animationEngine : 'best-available'
                });

                // Highlight the correct filter
                optionFilterLinks.removeClass('active');
                $(this).addClass('active');
                return false;
            });

	    });

	}

    $('.blog-slider').cycle({
            'fx' : 'fade',
            before: before_cycle,
            speed:   400,
            timeout: 0,
            pause:   1,
            'pager' : '#blog-pager'

        });

        $('.sidebar-blog-slider').cycle({
            'fx' : 'fade',
            before: before_cycle,
            speed:   400,
            timeout: 0,
            pause:   1,
            'pager' : '#sidebar-blog-pager'

        });

        // Submenues

                //$('ul.sf-menu').superfish();

        //$('ul.sf-menu2').superfish();
        
// Sliders



// Portfolio Slider

        $('.home-portfolio').cycle({
            'fx' : 'scrollHorz',
            'timeout' : 0,
            'pager' : '#portfolio-pager'
        });


  
// Widgets

   //       $('.testimonials').cycle({
   //          'fx' : 'fade',
   //          before: before_cycle,
   //          speed:   400,
			// timeout: 0,
			// pause:   1,
   //          'pager' : '#testimonial-pager'

   //      });

   //       $('.sidebar-testimonials').cycle({
   //          'fx' : 'fade',
   //          before: before_cycle,
   //          speed:   400,
			// timeout: 0,
			// pause:   1,
   //          'pager' : '#sidebar-testimonial-pager'

   //      });

        $('.simple-slider').cycle({
            'before' : before_cycle_simple_slider,
            'fx' : 'fade',

            speed:   600,
            timeout: 4000,
            pause:   1,

            'pager' : '.slider-pagers'
        });


        function before_cycle_simple_slider(curr, next, opts, fwd) {

            var index = opts.currSlide;
            var jQueryht = $(this).outerHeight();
            $(this).parent().animate({
                height: jQueryht
            }, 200);

        }

        function before_cycle(curr, next, opts, fwd) {

            var index = opts.currSlide;
            var jQueryht = $(this).outerHeight();
            $(this).parent().animate({
                height: jQueryht
            }, 200);


        }

//$("a[rel^='prettyPhoto']").prettyPhoto();



        
    }); // END document.ready()
