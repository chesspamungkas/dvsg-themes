// Featured Articles javascript
jQuery( document ).ready( function() {
    var sWidth = jQuery( window ).width();
    var left = 185;

    if( sWidth > 350 && sWidth <= 375 ) {
        left = 165;
    } else if( sWidth > 320 && sWidth <= 350 ) {
        left = 155;
    } else if( sWidth <= 320 ) {
        left = 145;
    }

    console.log( "Featured Articles Child JS" );
    jQuery( ".btn-on" ).click( function() {
        console.log( "Watch Us" );
        if( !jQuery( this ).hasClass( "active" ) ) {
            jQuery( ".slide-btn" ).animate( { "left": "5px" }, "fast" );
            if( jQuery( ".watch-us" ).hasClass( "hidden" ) ) {
                jQuery( ".watch-us" ).removeClass( "hidden" );
                jQuery( ".trending" ).addClass( "hidden" );
            }
        }
    } );

    jQuery( ".btn-off" ).click( function() {
        console.log( "Trending" );
        if( !jQuery( this ).hasClass( "active" ) ) {
            jQuery( ".slide-btn" ).animate( { "left": left+"px" }, "fast" );
            if( jQuery( ".trending" ).hasClass( "hidden" ) ) {
                jQuery( ".trending" ).removeClass( "hidden" );
                jQuery( ".watch-us" ).addClass( "hidden" );
            }
        }
    } );
});  