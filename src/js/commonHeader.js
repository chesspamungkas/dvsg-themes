jQuery( document ).ready( function() {

    console.log( 'Browser width: ' + jQuery( window ).width() );
    

    if( jQuery( '#menu-footer-one' )[0] ) {
        jQuery( '#menu-footer-one' ).addClass( 'justify-content-center' );
    }

    jQuery( 'body' ).on( 'click', '.main-menu-btn', function() {
        if( jQuery( '#main-menu-container' ).is( ':hidden' ) ) {
            jQuery( '#main-menu-container' ).fadeIn();

            if( jQuery( '#top-search-container' ).is( ':visible' ) ) {
                jQuery( '#top-search-container' ).fadeOut();
            }
        } else if( jQuery( '#main-menu-container' ).is( ':visible' ) ) {
            jQuery( '#main-menu-container' ).fadeOut();
        }
    } );

    jQuery( 'body' ).on( 'click', '.main-search-btn', function() {
        if( jQuery( '#top-search-container' ).is( ':hidden' ) ) {
            jQuery( '#top-search-container' ).fadeIn();
        }
        jQuery("#s").focus();
    } );

    jQuery( 'body' ).on( 'click', '.close-search-btn', function() {
        if( jQuery( '#top-search-container' ).is( ':visible' ) ) {
            jQuery( '#top-search-container' ).fadeOut();

            if( jQuery( '#main-menu-container' ).is( ':visible' ) ) {
                jQuery( '#main-menu-container' ).fadeOut();
            }
        }
    } );

    jQuery( '.subject-matter' ).on( 'click', function() {
        var value = jQuery( this ).text();
        jQuery( "input[type='hidden'][name^='input_']" ).val( value );
        console.log( jQuery( "input[type='hidden'][name^='input_']" ).id );
        jQuery( '.subject-matter-btn' ).text( value );
        jQuery( '.subject-matter-btn' ).css( 'color', '#495057' );
    } );

    jQuery( '.subject-matter-old' ).on( 'click', function() {
        var value = jQuery( this ).text();
        console.log( value );
        jQuery( '#subject-matter' ).val( value );
        jQuery( '.subject-matter-btn' ).text( value );
        jQuery( '.subject-matter-btn' ).css( 'color', '#495057' );
    } );
});