<?php
  // print_r( $terms );
?>
<div class="container" id="search-wrapper">
  <div class="row no-gutters" style="flex-grow: 1;">
      <div class="col-12 popular-search-title poppins-regular">Popular Searches</div>
  </div>
  <div class="row no-gutters" style="flex-grow: 1;">
    <?php
      $count = 1;
      echo '<div class="col-xs-12 col-sm-12 col-md-4">';
      foreach( $terms as $term ) {
        if( $count == 6 ) {
          echo '</div>';
          echo '<div class="col-xs-12 col-sm-12 col-md-4">';
        }

        echo '<a href="' . BASE_PATH . '/?s=' . urlencode( $term->post_title ) . '" class="search-keyword poppins-semibold">' . $term->post_title . '</a></br>';

        $count++;
      }
      echo '</div>';
    ?>
  </div>
</div>