<?php

use DV\core\DVBA;
use DVChild\microsites\dvba\twenty_two\DVBA_2022;
do_action('get_header');
echo get_template_part('src/microsites/dvba/twenty_two/templates/_header');

$page = get_queried_object();

$brands = '';
$awards = '';
$prices = '';

$term_id = $page->term_id;
$name = $page->name;
$slug = $page->slug;

if( $page->parent == 0 ) {
    $parent_id = 0;
    $parent_name = '';
    $parent_slug = '';
} else {
    $parent = get_term( $page->parent );

    $parent_id = $parent->term_id;
    $parent_name = $parent->name;
    $parent_slug = $parent->slug;
}
global $wp_query;
$totalPages = $wp_query->found_posts;
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
?>

<div class="container-fluid p-0" id="category-topbar-container">
  <div class="row g-0 m-0">
    <dic class="col p-0">
      <div class="container p-0 py-md-5" id="category-topbar-wrapper">
        <div class="row g-0 m-0">
          <div class="col px-0 py-5 text-center">
            <?php
            if ($parent_id) :
              $menu_name = 'dvba-2022-' . $parent_slug . '-menu';
            else :
              $menu_name = 'dvba-2022-' . $page->slug . '-menu';
            endif;

            if (wp_get_nav_menu_items($menu_name)) :
              $args = [
                'category_term_id' => $term_id,
                'category_name' => $name,
                'category_slug' => $slug,
                'parent_term_id' => $parent_id,
                'parent_name' => $parent_name,
                'parent_slug' => $parent_slug,
                'menu_items' => wp_get_nav_menu_items($menu_name)
              ];
              get_template_part('/src/microsites/dvba/twenty_two/listing/templates/CategoryTopBar', null, $args);
            endif;
            ?>
          </div>
        </div>
      </div>
  </div>
</div>
</div>
<div class="container-fluid p-0 <?php echo $parent_slug ? $parent_slug . '-product-container' : $slug . '-product-container'; ?>">
  <div class="row g-0 m-0">
    <dic class="col p-0">
      <div class="container px-0 pb-5">
        <div class="row g-0 m-0 align-items-center">
          <div class="col-12 col-md-7 pt-3 pb-2 px-md-5 py-md-4 px-2">
            <h2 class="eb-garamond-regular"><?php echo $parent_id != 0 ? $name : '';  ?></h2>
          </div>
          <div class="col-12 col-md-5 pt-3 pb-2 px-md-5 py-md-4 text-center">
            <div class="row g-0 m-0">
              <div class="col-12 col-md-6 mb-2">
                <form method="GET" action="" id="sortingForm">
                  <div class="btn-group">
                    <button type="button" class="sort-btn poppins-bold box-shadow py-2 px-5 mx-0 mx-md-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Sort By
                    </button>
                    <ul class="dropdown-menu box-shadow sort-dropdown">
                      <li class="py-1"><a class="dropdown-item sort-by" href="<?php echo DVBA_2022::getInstance()->getOrderByLinks('alphabetical', 'ASC') ?>" id="alphabetical-asc-order">Alphabetical (A-Z)</a></li>
                      <li class="py-1"><a class="dropdown-item sort-by" href="<?php echo DVBA_2022::getInstance()->getOrderByLinks('alphabetical', 'DESC') ?>" id="alphabetical-desc-order">Alphabetical (Z-A)</a></li>
                      <li class="py-1"><a class="dropdown-item sort-by" href="<?php echo DVBA_2022::getInstance()->getOrderByLinks('featured', 'DESC') ?>" id="featured-order">Featured</a></li>
                    </ul>
                    </ul>
                  </div>
                </form>
              </div>
              <div class="col-12 col-md-6">
                <?php echo do_shortcode('[taxonomy-filter-list]'); ?>
              </div>
            </div>
          </div>
        </div>
        <?php echo get_template_part('src/microsites/dvba/twenty_two/templates/_displayFilteredItems') ?>
        <div class="row g-0 m-0">
          <div class="col px-2">
            <div class="container p-0" id="product-container" >
              <div class="row g-0 m-0 product-list">
                <?php echo DVBA_2022::getInstance()->getProductList(); ?>
              </div>
            </div>
          </div>
        </div>
        <?php if ($totalPages > 1) : ?>
          <div class="row g-0 m-0">
            <div class="col text-center">
              <?php echo get_next_posts_link('Load More'); ?>              
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