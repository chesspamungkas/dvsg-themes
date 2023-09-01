<footer class="footer">
    <div class="container">
        <?php do_action( 'footer-nav' ); ?>
    </div>
</footer>

<script>
    jQuery( document ).ready( function( $ ) {
		$( "#dvsha-search" ).on( "click", function() {
            var sValue = $( "#dvsha-search-input" ).val();
            if( sValue ) {
                submit_search( sValue );
            }
		} );

		
        $( "#dvsha-search-input" ).keypress( function( event ) {
            var keycode = ( event.keyCode ? event.keyCode : event.which );
            console.log( keycode == 13 );
            if( keycode == 13 ) {
                submit_search( $( "#dvsha-search-input" ).val() );
            }
            //Stop the event from propogation to other handlers
            //If this line will be removed, then keypress event handler attached 
            //at document level will also be triggered
            event.stopPropagation();
        });
    } );

    function submit_search( s ) {
        if( s ) {
            var url = '<?php echo $home ?>search/?k=' + s;
            window.location.href = url;
        }
    }
</script>