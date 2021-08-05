        </div><!--  end body -->
        <?php 
          if( ( is_single() && !is_admin() && ( get_field( 'disable_ads_injection', $post->ID ) === false || !get_field( 'disable_ads_injection', $post->ID ) ) ) || !is_single() ):
            do_action( 'body_div_after' ); 
          endif;
        ?>
        <div id="footer">
          <?= get_sidebar('footer-cols') ?>
        </div>
    </div>
    <?php 
      wp_footer(); 
    ?>
  </body>
</html>