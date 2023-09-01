jQuery( document ).ready( function() {

    jQuery( '.dropdown-item' ).on( 'click', function() {
        var value = jQuery( this ).text();
        var id = jQuery( '.dropdown-main-btn' ).attr( 'id' );
        console.log( id );

        jQuery( '#' + id + '-field' ).val( value );
        jQuery( '.dropdown-main-btn' ).text( value );
        jQuery( '.dropdown-main-btn' ).css( 'color', '#495057' );
    } );

    if( !jQuery( '.tags-container' ).length && jQuery( '#novaly_media_ads_wordpress' ).length ) {
        jQuery( '#novaly_media_ads_wordpress' ).css( 'border-top', '2px solid #e8d9d9' );
        jQuery( '#novaly_media_ads_wordpress' ).css( 'max-width', '1140px' );
        jQuery( '#novaly_media_ads_wordpress' ).css( 'margin', '48px auto 0 auto' );
        // jQuery( '#novaly_media_ads_wordpress' ).css( 'padding-top', '48px' );
    }

} );