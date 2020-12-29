<?php
  // print_r( $terms );
?>
<div class="container" id="search-wrapper">
  <div class="row no-gutters" style="flex-grow: 1;">
      <div class="col-12 popular-search-title poppins-regular">Popular Searches</div>
  </div>
  <div class="row no-gutters" style="flex-grow: 1;">
    <div class="col-xs-12 col-sm-12 col-md-4">
    <?php
      $count = 1;
      foreach( $terms as $term ):
        if( $count == 6 ):
    ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4">
    <?php endif; ?>
        <a href="<?php echo BASE_PATH; ?>/?s=<?php echo urlencode( $term->post_title ); ?>" class="search-keyword poppins-semibold"><?php echo $term->post_title ?></a></br>
    <?php
        $count++;
      endforeach;
    ?>
    </div>
  </div>
</div>