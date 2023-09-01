( function( $ ) {
    'use strict';

    $( document ).ready( function() {
        // if adminbar exist (should check for visible?) then add margin to our navbar
        var $wpAdminBar = $( '#wpadminbar' );
        if ( $wpAdminBar.length ) {
            var barHeight = $wpAdminBar.height() - 2;
            if( $( window ).width() > 480 ) {
                $( '#content-body' ).css( 'margin-top', barHeight+'px' );
            } else {
                $( '#content-body' ).css( 'margin-top', (barHeight+30)+'px' );
            }
            $( '#top-bar' ).css( 'margin-top', barHeight+'px' );
        } else {
            if( $( window ).width() > 480 ) {
                $( '#content-body' ).css( 'margin-top', '40px' );
            } else {
                $( '#content-body' ).css( 'margin-top', '70px' );
            }
        }

        var shrinkHeader = 30;
        $( window ).scroll( function() {
            var scroll = getCurrentScroll();
            console.log( scroll );
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

        $( '#winners-dropdown-btn' ).on( 'click', function() {
            if( $( '#winners-navbar-dropdown' ).is( ':visible' ) ) {
                $( '#winners-navbar-dropdown' ).hide();

                if( !$( '#winners-dropdown-btn' ).find( 'i.fas' ).hasClass( 'fa-plus' ) ) {
                    $( '#winners-dropdown-btn' ).find( 'i.fas' ).addClass( 'fa-plus' );
                    $( '#winners-dropdown-btn' ).find( 'i.fas' ).removeClass( 'fa-minus' );
                    $( '#winners-dropdown-btn' ).find( 'i.fas' ).css( 'top', '6px' );
                }
            } else {
                $( '#winners-navbar-dropdown' ).show();

                if( $( '#winners-dropdown-btn' ).find( 'i.fas' ).hasClass( 'fa-plus' ) ) {
                    $( '#winners-dropdown-btn' ).find( 'i.fas' ).addClass( 'fa-minus' );
                    $( '#winners-dropdown-btn' ).find( 'i.fas' ).removeClass( 'fa-plus' );
                    $( '#winners-dropdown-btn' ).find( 'i.fas' ).css( 'top', '6px' );
                }
            }
        } );

        var pageno = 1;

        //load more ajax call
        /*$( 'body' ).on( 'click', '.load-more-result-btn', function( e ) {
            e.preventDefault();

            var termID = 0;
            var totalPages = 0;
    
            var id = this.id.split( '-' );
            termID = id[0];
            totalPages = id[1];

            var searchParams = new URLSearchParams(window.location.search);
            var keyword = '';
    
            if( searchParams.has( 'k' ) ) {
                keyword = searchParams.get( 'k' );
            }

            pageno++;

            $( '.load-more-result-btn' ).html( '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...' );

            var str = '&pageno=' + pageno + '&k=' + keyword + '&action=ajaxDVSHALoadMoreProducts';

            jQuery.ajax({
                type: "POST",
                // dataType: "html",
                url: ajaxUrl,
                data: str,
                success: function(data){
                    var $data = jQuery( data );

                    console.log( $data );
    
                    if( $data.length ){
                        jQuery( '.search-result-list-container' ).append( $data );
    
                        if( pageno >= totalPages ) {
                            jQuery( '.load-more-result-btn' ).fadeOut( 'slow' );
                        } else {
                            jQuery( '.load-more-result-btn' ).html( 'LOAD MORE' );
                        }
    
                        // jQuery( window ).scrollTop( old_scroll );
                    } else{
                        jQuery( '.load-more-result-btn' ).fadeOut( 'slow' );
                    }
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    // console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
        
            });

        } );*/
    } );
} )( jQuery );