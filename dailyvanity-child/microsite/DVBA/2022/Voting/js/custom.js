jQuery( document ).ready( function( $ ) {
    var width = $( window ).width();
    var marginTop = 32;
    console.log( isAdminBar );

    if( isAdminBar ) {
        if( width <= 480 ) {
            marginTop = 46;
            $( '#navbarSupportedContent' ).css( 'margin-top', marginTop + 'px' );
        } else {
            $( '.navbar' ).css( 'top', marginTop + 'px' );
        }

        $( '#content-body' ).css( 'margin-top', marginTop + 'px' );
    }
} );