jQuery( document ).ready( function() {
    console.log( 'Browser width: ' + jQuery( window ).width() );
    //fix for admin bar
    /*if ( jQuery( '#wpadminbar' )[0] ) {
        console.log( 'fix wpadminbar' );
        // jQuery( 'div#page-container' ).css( { 'margin-top': '32px' } );
        if( jQuery( window ).width() > 480 ) {
            jQuery( '.fixed-top' ).css( { 'top': '32px' } );
            jQuery( '#main-menu-container, #top-search-container' ).css( { 'margin-top': '32px' } );

            if( jQuery( 'body' ).hasClass( 'home' ) ) {
                // jQuery( '#content-area' ).css( { 'margin-top': '32px' } );
            } else {
                jQuery( '#content-area' ).css( { 'margin-top': '50px' } );
            }
        } else {
            jQuery( '#wpadminbar' ).css( 'position', 'fixed' );
            jQuery( '.fixed-top' ).css( { 'top': '45px' } );
            jQuery( '#main-menu-container, #top-search-container' ).css( { 'margin-top': '45px' } );

            if( jQuery( 'body' ).hasClass( 'home' ) ) {
                // jQuery( '#content-area' ).css( { 'margin-top': '32px' } );
            } else {
                jQuery( '#content-area' ).css( { 'margin-top': '50px' } );
            }
        }
        // console.log( jQuery( '#main-header-container' ).css( 'top' ) );
    } else {
        if( jQuery( 'body' ).hasClass( 'home' ) ) {
            // jQuery( '#content-area' ).css( { 'margin-top': '32px' } );
        } else {
            jQuery( '#content-area' ).css( { 'margin-top': '50px' } );
        }
    }*/

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
        console.log( value );
        // jQuery( '#subject-matter' ).val( value );
        jQuery( 'input[type="hidden"]' ).each( function() {
            var id = jQuery( this ).attr(id);
            // if( id.indexOf( "input_" ) != -1 ) {
            //     jQuery( '#' + id ).val( value );
            // }
            console.log( id );
        } );
        jQuery( '.subject-matter-btn' ).text( value );
        jQuery( '.subject-matter-btn' ).css( 'color', '#495057' );
    } );
});