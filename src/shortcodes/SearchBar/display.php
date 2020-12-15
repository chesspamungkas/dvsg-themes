<!--style>
  #ui-id-1 {
    position: fixed;
  }
  
  .ui-autocomplete {
    max-height: 300px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 300px;
  }
</style-->
<form method="get" id="searchform" action="<?php bloginfo( 'url' ); ?>/">
    <div>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php echo SEARCH_PLACEHOLDER; ?>" class="poppins-light" />
        <!--input type="submit" id="searchsubmit" value="Search" /-->
    </div>
</form>