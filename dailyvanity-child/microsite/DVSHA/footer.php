        </div>
      </div>
    </div>
    <?php 
      wp_footer(); 
    ?>
    <script>
      jQuery( window ).load( function() {
        console.log( 'loaded' );
        setTimeout( function() {
          console.log( 'after 1sec' );
          jQuery( "#loading" ).addClass( 'hidden' );
        }, 1000 ); // after page loaded 1sec
      } );
    </script>
  </body>
</html>