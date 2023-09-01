<?php
global $parent;
?>

<section id="<?php echo $parent['term_slug'];  ?>">
  <div class="container-fluid <?php echo $parent['term_slug'];  ?>-container pb-4">
    <div class="row g-0 m-0">
      <div class="col p-0">
        <div class="container px-0">
          <div class="row g-0 m-0 align-items-center">
            <div class="col-7 pt-3 pb-2 px-md-5 py-md-4 px-2">
              <h2><a href="<?php echo get_term_link($parent['term_id']); ?>" class="eb-garamond-regular home-cat-link" target="_blank"><?php echo $parent['term_name'];  ?></a></h2>
            </div>
            <div class="col-5 pt-3 pb-2 px-md-5 py-md-4 slide-button-container">
              <button type="button" class="alt-slick-prev slick-disabled"><i class="fas fa-chevron-left"></i></button>
              <button type="button" class="alt-slick-next"><i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
          <div class="row g-0 m-0">
            <div class="col cat-products <?php echo $parent['term_slug'];  ?> p-0">
              <?php echo do_shortcode('[display-products term_id="' . $parent['term_id'] . '" posts_per_page="11" view_all="1"]'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>