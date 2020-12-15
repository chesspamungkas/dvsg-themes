jQuery( document ).ready( function() {
    
    if( isCategory ) {
        var urlParams = new URLSearchParams( window.location.search );

        console.log( urlParams.has( 'pageno' ) );

        if( urlParams.has( 'pageno' ) ) {
            var parent = jQuery( '.list-post-wrapper' ).parent();
            jQuery.ajax( {
                'type': 'post',
                // 'dataType': 'json',
                'url': ajaxUrl,
                'data': { 
                    'action': 'ajaxCallListPosts', 
                    'pageno': urlParams.get( 'pageno' ),
                    'isCategory': isCategory,
                    'categoryID': categoryID,
                    'isAuthor': isAuthor,
                    'authorID': authorID
                },
                success: function( response ) {
                    
                    // console.log( jQuery( '#list-post-content' ).parent() );
                    parent.html( response );
    
                    if( isCategory ) {
                        var newurl = homeBase + '/' + categorySlug + '/?pageno=' + urlParams.get( 'pageno' );
                        window.history.pushState( { path:newurl }, '', newurl ); 
                    }
                }
            } );
        }
    }

    jQuery( 'body' ).on( 'click', '.listposts-paginav-prev, .listposts-paginav-next', function( e ) {
      e.preventDefault();
      var pageno = this.id.split( '-' );
      var parent = jQuery( '.list-post-wrapper' ).parent();

      console.log( pageno[2] );
      if( !jQuery( this ).hasClass( 'active' ) ) {
        jQuery( '#list-post-content' ).html( '<div class="container"><div class="row"><div class="col" style="text-align:center;"><div class="spinner-border text-danger" role="status"><span class="sr-only">Loading...</span></div></div></div></div>' );
        jQuery( '.listposts-paginav' ).removeClass( 'active' );
        jQuery( this ).addClass( 'active' );

        //ajaxCallListPosts
        jQuery.ajax( {
            'type': 'post',
            // 'dataType': 'json',
            'url': ajaxUrl,
            'data': { 
                'action': 'ajaxCallListPosts', 
                'pageno': pageno[2],
                'isCategory': isCategory,
                'categoryID': categoryID,
                'isAuthor': isAuthor,
                'authorID': authorID
            },
            success: function( response ) {
                
                // console.log( jQuery( '#list-post-content' ).parent() );
                parent.html( response );

                if( isCategory ) {
                    var newurl = homeBase + '/' + categorySlug + '/?pageno=' + pageno[2];
                    window.history.pushState( { path:newurl }, '', newurl ); 
                }
            }
        } );
      }
    } );

    jQuery( 'body' ).on( 'click', '.listposts-paginav', function( e ) {
      e.preventDefault();
      var pageno = this.id.split( '-' );
      var parent = jQuery( '.list-post-wrapper' ).parent();

      console.log( pageno[2] );
      if( !jQuery( this ).hasClass( 'active' ) ) {
        jQuery( '#list-post-content' ).html( '<div class="container"><div class="row"><div class="col" style="text-align:center;"><div class="spinner-border text-danger" role="status"><span class="sr-only">Loading...</span></div></div></div></div>' );
        jQuery( '.listposts-paginav' ).removeClass( 'active' );
        jQuery( this ).addClass( 'active' );

        //ajaxCallListPosts
        jQuery.ajax( {
            'type': 'post',
            // 'dataType': 'json',
            'url': ajaxUrl,
            'data': { 
                'action': 'ajaxCallListPosts', 
                'pageno': pageno[2],
                'isCategory': isCategory,
                'categoryID': categoryID,
                'isAuthor': isAuthor,
                'authorID': authorID
            },
            success: function( response ) {
                
                // console.log( jQuery( '#list-post-content' ).parent() );
                parent.html( response );

                if( isCategory ) {
                    var newurl = homeBase + '/' + categorySlug + '/?pageno=' + pageno[2];
                    window.history.pushState( { path:newurl }, '', newurl ); 
                }
            }
        } );
      }
    } );

    // var keywords = [ "remove blackheads", "oily skin moisturiser", "long lasting lipstick", "face wash", "micellar water" ];

    // jQuery( "#s" ).autocomplete( {
    //     source: function( request, response ) {
    //         console.log( request );
    //         jQuery.ajax( {
    //             'type': 'post',
    //             'dataType': 'json',
    //             'url': ajaxUrl,
    //             'data': { 
    //                 'action': 'ajaxGetSearchTerms', 
    //                 'keyword': request.term,
    //             },
    //             success: function( data ) {
    //                 console.log( data );
    //                 response( data );
    //             }
    //         } );
    //     },
    //     // source: keywords,
    //     minLength: 3,
    //     open: function() {
    //         jQuery( "#ui-id-1" ).css( "display", "block" );
    //         jQuery( "#ui-id-1" ).css( "z-index", "99999" );
    //     },
    //     close: function() {
    //         jQuery( "#ui-id-1" ).css( "display", "none" );
    //         jQuery( "#ui-id-1" ).css( "z-index", "0" );
    //     }
    // });


    jQuery( 'body' ).on( 'click', '.searchresults-paginav', function( e ) {
        e.preventDefault();
        var pageno = this.id.split( '-' );
        var parent = jQuery( '.list-post-wrapper' ).parent();
  
        console.log( pageno[2] );
        if( !jQuery( this ).hasClass( 'active' ) ) {
          jQuery( '#list-post-content' ).html( '<div class="container"><div class="row"><div class="col" style="text-align:center;"><div class="spinner-border text-danger" role="status"><span class="sr-only">Loading...</span></div></div></div></div>' );
          jQuery( '.searchresults-paginav' ).removeClass( 'active' );
          jQuery( this ).addClass( 'active' );
  
          //ajaxCallListPosts
          jQuery.ajax( {
              'type': 'post',
              // 'dataType': 'json',
              'url': ajaxUrl,
              'data': { 
                  'action': 'ajaxCallSearchResults', 
                  'pageno': pageno[2],
                  'keyword': keyword
              },
              success: function( response ) {
                  
                  // console.log( jQuery( '#list-post-content' ).parent() );
                  parent.html( response );
  
                var newurl = homeBase + '/?s=' + s + '&pageno=' + pageno[2];
                window.history.pushState( { path:newurl }, '', newurl ); 
              }
          } );
        }
    } );
} );