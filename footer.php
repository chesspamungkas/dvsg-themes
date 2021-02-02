        </div><!--  end body -->
        <?php do_action( 'body_div_after' ); ?>
        <div id="footer">
          <?= get_sidebar('footer-cols') ?>
        </div>
    </div>
    <script>
      function initDFP() {
        if( document.getElementById("top-dfp") ) {
          if( isMobile ) {
            document.getElementById("top-dfp").innerHTML = '<div id="<?php echo DFP_MOBILE_TOP; ?>"></div>';
          } else {
            document.getElementById("top-dfp").innerHTML = '<div id="<?php echo DFP_DESKTOP_TOP; ?>"></div>';
          }
        }

        if( document.getElementById("bottom-dfp") ) {
          document.getElementById("bottom-dfp").innerHTML = '<div id="<?php echo DFP_BOTTOM; ?>"></div>';
        }
      }

      initDFP();
    </script>
    <?php 
      wp_footer(); 
    ?>
  </body>
</html>