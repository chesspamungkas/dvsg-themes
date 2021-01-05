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
      wp_nav_menu( array(
          'theme_location'    => 'popular-searches-menu',
          'depth'             => 1,
          'container'         => 'nav',
          'container_class'   => 'nav flex-column',
          'container_id'      => '',
          'menu_class'        => 'list-style-none',
          'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
          'walker'            => new WP_Bootstrap_Navwalker(),
      ) );
    ?>
    </div>
  </div>
</div>