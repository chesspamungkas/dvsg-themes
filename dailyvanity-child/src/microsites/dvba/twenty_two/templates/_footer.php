    </div>
    <footer id="main-footer" class="container-fluid px-md-5 pb-md-3 pt-md-4 px-3 py-4">
        <div class="row m-0 justify-content-md-between justify-content-center">
            <div class="col-12 col-sm-12 col-md-3 mb-1 mb-md-0 px-0 pt-0 pb-1 pb-md-0" id="copyright-address">
                <p class="no-margin text-shadow">&copy; DAILY VANITY PTE LTD, <?php echo date('Y') ?><br/>
                201 Henderson Road, Apex @ Henderson,<br/>
                #06-13/14, Singapore 159545</p>
            </div>
            <div class="col-12 col-sm-12 col-md-2 d-flex align-self-center" id="social-icon">
                <ul class="nav mx-auto">
                    <li class="nav-item"><a href="https://www.facebook.com/dailyvanity/" class="nav-link" target="_blank"><i class="fab fa-lg fa-facebook-f"></i></a></li>
                    <li class="nav-item"><a href="https://www.instagram.com/dailyvanity/?hl=en" class="nav-link" target="_blank"><i class="fab fa-lg fa-instagram"></i></a></li>
                    <li class="nav-item"><a href="https://twitter.com/dailyvanitysg?lang=en" class="nav-link" target="_blank"><i class="fab fa-lg fa-twitter"></i></a></li>
                    <li class="nav-item"><a href="https://www.youtube.com/dailyvanity?sub_confirmation=1" class="nav-link" target="_blank"><i class="fab fa-lg fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </footer> <!-- #main-footer -->
  </div> <!-- #et-main-area -->

</div> <!-- #page-container -->

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/src/microsites/dvba/twenty_two/listing/js/DVBA2022Listing.js?v=<?php echo current_time( 'timestamp' ); ?>"></script>
<?php wp_footer(); ?>
<script>

jQuery( document ).ready( function() {
    console.log( 'Browser width: ' + jQuery(window).width() );
    // console.log( jQuery( '#wpadminbar' )[0] );
    //fix for admin bar
    if ( jQuery('#wpadminbar')[0] ) {
        if( jQuery(window).width() > 480 ) {
            jQuery( '#top-bar' ).css( 'top', '32px' );
            jQuery( '.body-container' ).css( 'margin-top', '142px' );
        } else {
            jQuery( '#top-bar' ).css( 'top', '45px' );
            jQuery( '.body-container' ).css( 'margin-top', '60px' );
        }
    }
});

</script>
</body>
</html>
