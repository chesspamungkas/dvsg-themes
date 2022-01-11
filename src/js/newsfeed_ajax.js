jQuery(function() {
    var ppp = 2; // Post per page
    var pageNumber = 1;

    function load_posts( totalPages, cat, author, tag, s ){
        pageNumber++;
        var str = '&pageno=' + pageNumber + '&posts_per_page=' + ppp + '&cat=' + cat + '&author=' + author + '&tag_id=' + tag + '&s=' + s + '&action=ajaxLoadMoreStories';
        var old_scroll = jQuery(window).scrollTop();

        jQuery.ajax({
            type: "POST",
            // dataType: "html",
            url: ajaxUrl,
            data: str,
            success: function(data){
                var $data = jQuery( data );

                if( $data.length ){
                    jQuery( '.newsfeed-content' ).append( $data );

                    if( pageNumber >= totalPages ) {
                        jQuery( '.more-stories-btn' ).fadeOut( 'slow' );
                    } else {
                        jQuery( '.more-stories-btn' ).html( 'MORE STORIES' );
                    }

                    jQuery( window ).scrollTop( old_scroll );
                } else{
                    jQuery( '.more-stories-btn' ).fadeOut( 'slow' );
                }
            },
            error : function(jqXHR, textStatus, errorThrown) {
                // console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
    
        });
        return false;
    }

    jQuery( 'body' ).on( 'click', '.more-stories-btn', function( e ) {
        e.preventDefault();

        var totalPages = 0;
        var cat = 0;
        var author = 0;
        var tag = 0;
        var s = '';

        var id = this.id.split( '-' );
        totalPages = id[0];
        cat = id[1];
        author = id[2];
        tag = id[3];
        s = id[4];

        console.log( id );
        
        // jQuery( '.more-stories-btn' ).fadeOut( 'slow' );
        jQuery( '.more-stories-btn' ).html( '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...' );
        console.log( 'more stories' );
        load_posts( totalPages, cat, author, tag, s );
    });

} );