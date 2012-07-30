$( document ).ready( function ( ) {
    if( typeof( tbtestimonial_settings ) != 'undefined' )
    {
        if( tbtestimonial_settings.animate == 1 )
        {
            if( tbtestimonial_settings.preloader == 1 )
            {
                $('#tbtestimonials-widget').css({display:'block'}).hide();

                $( '.ajax-loader' ).delay(1800).fadeOut( 'slow', function(){
                    $('#tbtestimonials-widget').fadeIn('slow');
                    $('#tbtestimonials-widget').show().delay(800).cycle({
                        fx: tbtestimonial_settings.transition,
                        timeout: tbtestimonial_settings.timer_interval * 1000,
                        speed: tbtestimonial_settings.transition_interval * 1000
                    });
                });
            }
            else
            {
                $('#tbtestimonials-widget').cycle({
                    fx: tbtestimonial_settings.transition,
                    timeout: tbtestimonial_settings.timer_interval * 1000,
                    speed: tbtestimonial_settings.transition_interval * 1000
                });
            }
        }
        else
        {
            if( tbtestimonial_settings.preloader == 1 )
            {
                $('#tbtestimonials-widget').css({display:'block'}).hide();
                $( '.ajax-loader' ).delay(1800).fadeOut( 'slow', function(){
                    $('#tbtestimonials-widget').fadeIn('slow');
                    $('#tbtestimonials-widget').show();
                });
            }
        }
    }
} );