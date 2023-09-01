<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" role="search">
  <div>
    <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php echo SEARCH_PLACEHOLDER; ?>" class="poppins-light" />
  </div>
</form>