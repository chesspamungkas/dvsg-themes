( function( $ ) {
    'use strict';

    $( document ).ready( function() {
        // if adminbar exist (should check for visible?) then add margin to our navbar
        var $wpAdminBar = $( '#wpadminbar' );
        if ( $wpAdminBar.length ) {
            var barHeight = $wpAdminBar.height() - 2;
            $( '#content-body' ).css( 'margin-top', barHeight+'px' );
            $( '#top-bar' ).css( 'margin-top', barHeight+'px' );
        }

        var shrinkHeader = 70;
        $( window ).scroll( function() {
            var scroll = getCurrentScroll();
            if( $( window ).width() > 480 ) {
                if ( scroll >= shrinkHeader ) {
                    $( '#top-logo' ).addClass( 'shrink-logo' );
                    $( '.navbar-brand' ).addClass( 'shrink-navbar' );
                } else {
                    $( '#top-logo' ).removeClass( 'shrink-logo' );
                    $( '.navbar-brand' ).removeClass( 'shrink-navbar' );
                }
            }
        });

        function getCurrentScroll() {
            return window.pageYOffset || document.documentElement.scrollTop;
        }

        var hashname = window.location.hash.replace( '#', '' );
        var elem = $( '#' + hashname );

        if( elem.length ) {
            $( 'html, body' ).animate( { scrollTop: elem.offset().top - 60 }, 300 );
            return false;
        }

        $( '.top-nav-link' ).on( 'click', function() {  
            $( 'html, body' ).animate( { scrollTop: $( this.hash ).offset().top - 60 }, 300 );
            return false;
        } );

        $( '.navbar-toggler' ).on( 'click', function() {
            console.log( $( this ).hasClass( 'collapsed' ) );
            if( !$( this ).hasClass( 'collapsed' ) ) {
                $( '.navbar-toggler-icon' ).css( 'background-image', 'url( "data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'30\' height=\'30\' viewBox=\'0 0 30 30\'%3e%3cpath stroke=\'rgba%280,0,0,0.5%29\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' stroke-width=\'2\' d=\'M4 7h22M4 15h22M4 23h22\'/%3e%3c/svg%3e" )' );
                $( '.navbar-toggler-icon' ).css( 'width', '1.5em' );
                $( '.navbar-toggler-icon' ).css( 'height', '1.5em' );
                $( '.navbar-toggler-icon' ).css( 'margin-left', '0' );
                $( '.navbar-toggler-icon' ).css( 'margin-right', '0' );
            } else {
                $( '.navbar-toggler-icon' ).css( 'background-image', 'url( "https://uploads.dailyvanity.sg/wp-content/uploads/svg/close.svg" )' );
                $( '.navbar-toggler-icon' ).css( 'width', '1.3em' );
                $( '.navbar-toggler-icon' ).css( 'height', '1.3em' );
                $( '.navbar-toggler-icon' ).css( 'margin-left', '.1em' );
                $( '.navbar-toggler-icon' ).css( 'margin-right', '.1em' );
            }
        } );
    } );
} )( jQuery );