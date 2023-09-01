jQuery( document ).ready( function( $ ) {
    var pageNumber = 1;

    function load_posts( id, status, totalPages, postsPerPage ){
        pageNumber++;
        var str = '&pageno=' + pageNumber + '&posts_per_page=' + postsPerPage + '&post_status=' + status + '&load_more_perks_nonce=' + nonce + '&action=ajaxLoadMorePerks';
        var old_scroll = $( window ).scrollTop();

        console.log( str );

        jQuery.ajax({
            type: "POST",
            // dataType: "html",
            url: ajaxUrl,
            data: str,
            success: function( data ){
                var $data = $( data );

                console.log( data );

                if( $data.length ){
                    jQuery( '.perks-' + status + '-content' ).append( $data );

                    if( pageNumber >= totalPages ) {
                        jQuery( '#' + id ).fadeOut( 'slow' );
                    } else {
                        if( status == 'publish' ) {
                            jQuery( '.see-more-perks-btn' ).html( 'SEE MORE PERKS' );
                        } else {
                            jQuery( '.see-more-perks-btn' ).html( 'LOAD MORE' );
                        }
                    }

                    jQuery( window ).scrollTop( old_scroll );
                } else{
                    jQuery( '#' + id ).fadeOut( 'slow' );
                }
            },
            error : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
    
        });
        return false;
    }

    $( 'body' ).on( 'click', '.see-more-perks-btn', function( e ) {
        e.preventDefault();

        var totalPages = 0;

        var id = this.id.split( '-' );
        status = id[0];
        totalPages = id[1];
        postsPerPage = id[2];

        console.log( id );
        
        // jQuery( '.more-stories-btn' ).fadeOut( 'slow' );
        jQuery( '#' + this.id ).html( '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...' );
        console.log( 'load more ' + status + ' perks' );
        load_posts( this.id, status, totalPages, postsPerPage );
    });
});