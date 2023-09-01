jQuery( document ).ready( function( $ ) {
    if ( $( '#wpadminbar' )[0] ) {
        console.log( 'fix wpadminbar' );
        // jQuery( 'div#page-container' ).css( { 'margin-top': '32px' } );
        if( $( window ).width() > 480 ) {
            $( '.top-header-bk-bar' ).css( { 'top': '32px' } );
            $( '#main-header-container' ).css( { 'top': '72px' } );
            $( '.igstory-container' ).css( { 'top' : '70px' } );

            if( !$( 'body' ).hasClass( 'home' ) ) {
                $( '#content-area' ).css( { 'margin-top': '30px' } );
            }
        } else {
            $( '#wpadminbar' ).css( 'position', 'fixed' );
            $( '.fixed-top' ).css( { 'top': '45px' } );
            $( '#main-menu-container, #top-search-container' ).css( { 'margin-top': '45px' } );
            $( '.igstory-container' ).css( { 'top' : '50px' } );

            if( $( 'body' ).hasClass( 'home' ) ) {
                // jQuery( '#content-area' ).css( { 'margin-top': '32px' } );
            } else {
                $( '#content-area' ).css( { 'margin-top': '30px' } );
            }
        }
        // console.log( jQuery( '#main-header-container' ).css( 'top' ) );
    } else {
        if( $( 'body' ).hasClass( 'home' ) ) {
            // jQuery( '#content-area' ).css( { 'margin-top': '32px' } );
        } else {
            $( '#content-area' ).css( { 'margin-top': '30px' } );
        }
    }

    if ( document.cookie.search(/\wordpress_logged_in-\S*=/) < 0 ) {
        // console.log( $( '.my-account' ).attr( 'href' ) );
        // $( '.my-account' ).text( 'LOGIN/REGISTER' );
        $( '.my-account' ).attr( 'href', sfLink + '/login' );
        $( '.account-btn' ).attr( 'href', sfLink + '/login' );
    }
} );
