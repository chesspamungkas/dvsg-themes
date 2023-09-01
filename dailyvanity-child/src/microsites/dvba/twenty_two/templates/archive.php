<?php

use DVChild\microsites\dvba\twenty_two\DVBA_2022;

do_action('get_header');
echo get_template_part('src/microsites/dvba/twenty_two/templates/_header');
?>
<div class="container-fluid px-0 pt-0 pb-5" id="search-result-container">
  <div class="row g-0 pt-md-5 m-0">
    <div class="col-12 col-sm-12 col-md-8 pt-5 pt-md-4 mx-auto px-4 text-center">
      <h1 class="eb-garamond-regular">Search Results for: <?php  ?></h1>
    </div>
  </div>
</div>

<div class="container-fluid p-0">
  <div class="row g-0 m-0">
    <dic class="col p-0">
      <div class="container px-0 pb-5">
        <div class="row g-0 m-0">
          <div class="col px-2 px-md-5">
            <div class="container p-0">
              <div class="row g-0 m-0 product-list">
                <?php echo DVBA_2022::getInstance()->getProductList(); ?>
              </div>
            </div>
          </div>
        </div>
        <?php if ($products->found_posts > 4) : ?>
          <div class="row g-0 m-0">
            <div class="col text-center">
              <button type="button" class="box-shadow py-2 px-5 poppins-bold more-products-btn" id="<?php echo $parent_id; ?>-<?php echo $products->max_num_pages > 0 ? $products->max_num_pages : 0; ?>-<?php echo $postID; ?>-4">Load More</button>
            </div>
          </div>
        <?php endif; ?>
      </div>
  </div>
</div>
</div>
<?php
do_action('get_footer');
echo get_template_part('src/microsites/dvba/twenty_two/templates/_footer');

?>