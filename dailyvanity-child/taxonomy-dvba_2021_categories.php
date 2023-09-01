<?php 

get_header( 'dvba2021listing' ); 

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

$posts_per_page = 8;

if( $_GET['st'] ):
    $skinTypes = $_GET['st'];
endif;

if( $_GET['sc'] ):
    $skinConcerns = $_GET['sc'];
endif;

if( $_GET['htc'] ):
    $hairConcerns = $_GET['htc'];
endif;

if( $_GET['br'] ):
    $brands = $_GET['br'];
endif;

if( $_GET['aw'] ):
    $awards = $_GET['aw'];
endif;

if( $_GET['pr'] ):
    $prices = $_GET['pr'];
endif;

if( $_GET['orderby'] ):
    $orderby = $_GET['orderby'];
endif;

$totalPages = get_total_pages( $posts_per_page, $term_id, $skinTypes, $skinConcerns, $hairConcerns, $brands, $awards, $prices );

?>

<div class="container-fluid p-0" id="category-topbar-container">
    <div class="row g-0 m-0">
        <dic class="col p-0">
            <div class="container p-0 py-md-5" id="category-topbar-wrapper">
                <div class="row g-0 m-0">
                    <div class="col px-0 py-5 text-center">
                    <?php
                        if( $parent_id ):
                            $menu_name = 'dvba-2021-' . $parent_slug . '-menu'; 
                        else:
                            $menu_name = 'dvba-2021-' . $page->slug . '-menu';
                        endif;

                        if ( wp_get_nav_menu_items( $menu_name ) ): 
                            $args = [ 
                                'category_term_id' => $term_id, 
                                'category_name' => $name, 
                                'category_slug' => $slug, 
                                'parent_term_id' => $parent_id, 
                                'parent_name' => $parent_name, 
                                'parent_slug' => $parent_slug, 
                                'menu_items' => wp_get_nav_menu_items( $menu_name ) 
                            ];

                            get_template_part( '/microsite/DVBA2021Listing/templates/CategoryTopBar', null, $args );
                        endif;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid p-0 <?php echo $parent_slug?$parent_slug.'-product-container':$slug.'-product-container'; ?>">
    <div class="row g-0 m-0">
        <dic class="col p-0">
            <div class="container px-0 pb-5">
                <div class="row g-0 m-0 align-items-center">
                    <div class="col-12 col-md-7 pt-3 pb-2 px-md-5 py-md-4 px-2">
                        <h2 class="eb-garamond-regular"><?php echo $parent_id!=0?$name:'';  ?></h2>
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
                                            <li class="py-1"><span class="dropdown-item sort-by" id="alphabetical-asc-order">Alphabetical (A-Z)</span></li>
                                            <li class="py-1"><span class="dropdown-item sort-by" href="#" id="alphabetical-desc-order">Alphabetical (Z-A)</span></li>
                                            <li class="py-1"><span class="dropdown-item sort-by" href="#" id="featured-order">Featured</span></li>
                                            <!--li class="py-1"><span class="dropdown-item sort-by" href="#" id="price-asc-order">Price (lowest to highest)</span></li>
                                            <li class="py-1"><span class="dropdown-item sort-by" href="#" id="price-desc-order">Price (highest to lowest)</span></li-->
                                        </ul>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-md-6">
                                <form method="GET" action="" id="filterForm">
                                    <div class="btn-group">
                                        <button type="button" class="sort-btn poppins-bold box-shadow py-2 px-5 ms-0 ms-md-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Filter
                                        </button>
                                        <div class="container dropdown-menu dropdown-menu-end">
                                            <div class="row g-0 m-0">
                                                <div class="col-6">
                                                    <ul class="filter-dropdown">
                                                        <?php if( ( $parent_id == 0 && ( $slug == 'skincare' || $slug == 'body-care' ) ) || ( $parent_slug == 'skincare' || $parent_slug == 'body-care' ) ): ?>
                                                        <li class="skin-type-header">
                                                            <h6 class="dropdown-header">Skin Types</h6>
                                                        </li>
                                                        <li class="skin-type-container">
                                                            <div class="filter-wrapper">
                                                                <?php echo do_shortcode('[display-filter taxonomy="dvba_2021_skin_types" name="skin-types" checked="' . $skinTypes . '"]'); ?>
                                                            </div>
                                                        </li>
                                                        <li class="skin-concern-header">
                                                            <h6 class="dropdown-header">Skin Concerns</h6>
                                                        </li>
                                                        <li class="skin-concern-container">
                                                            <div class="filter-wrapper">
                                                                <?php echo do_shortcode('[display-filter taxonomy="dvba_2021_skin_concerns" name="skin-concerns" checked="' . $skinConcerns . '"]'); ?>
                                                            </div>
                                                        </li>
                                                        <li class="brand-header">
                                                            <h6 class="dropdown-header">Brands</h6>
                                                        </li>
                                                        <li class="brand-container">
                                                            <div class="filter-wrapper">
                                                                <?php echo do_shortcode('[display-filter taxonomy="dvba_2021_brands" name="brands" checked="' . $brands . '"]'); ?>
                                                            </div>
                                                        </li>
                                                        <?php endif; ?>
                                                        <?php if( ( $parent_id == 0 && $slug == 'hair-care' ) || $parent_slug == 'hair-care' ): ?>
                                                        <li class="hair-concern-header">
                                                            <h6 class="dropdown-header">Hair Types / Concerns <!--span style="font-size:12px; color:#999;">(scroll for more)</span--></h6>
                                                        </li>
                                                        <li class="hair-concern-container">
                                                            <div class="filter-wrapper">
                                                                <?php echo do_shortcode('[display-filter taxonomy="dvba_2021_hair_types_concerns" name="hair-concerns" checked="' . $hairConcerns . '"]'); ?>
                                                            </div>
                                                        </li>
                                                        <li class="brand-header">
                                                            <h6 class="dropdown-header">Brands</h6>
                                                        </li>
                                                        <li class="brand-container">
                                                            <div class="filter-wrapper">
                                                                <?php echo do_shortcode('[display-filter taxonomy="dvba_2021_brands" name="brands" checked="' . $brands . '"]'); ?>
                                                            </div>
                                                        </li>
                                                        <?php endif; ?>
                                                        <?php if( ( $parent_id == 0 && $slug == 'makeup' ) || $parent_slug == 'makeup' ): ?>
                                                        <li class="brand-header">
                                                            <h6 class="dropdown-header">Brands</h6>
                                                        </li>
                                                        <li class="brand-container">
                                                            <div class="filter-wrapper">
                                                            <?php echo do_shortcode('[display-filter taxonomy="dvba_2021_brands" name="brands" checked="' . $brands . '"]'); ?>
                                                            </div>
                                                        </li>
                                                        <li class="award-header">
                                                            <h6 class="dropdown-header">Award Tiers</h6>
                                                        </li>
                                                        <li class="award-container">
                                                            <div class="filter-wrapper">
                                                                <?php echo do_shortcode('[display-filter taxonomy="dvba_2021_award_tiers" name="award-tiers" checked="' . $awards . '"]'); ?>
                                                            </div>
                                                        </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="filter-dropdown">
                                                        <?php if( $slug != 'makeup' && $parent_slug != 'makeup' ): ?>
                                                        <li class="award-header">
                                                            <h6 class="dropdown-header">Award Tiers</h6>
                                                        </li>
                                                        <li class="award-container">
                                                            <div class="filter-wrapper">
                                                                <?php echo do_shortcode('[display-filter taxonomy="dvba_2021_award_tiers" name="award-tiers" checked="' . $awards . '"]'); ?>
                                                            </div>
                                                        </li>
                                                        <?php endif; ?>
                                                        <li class="price-header">
                                                            <h6 class="dropdown-header">Price Ranges</h6>
                                                        </li>
                                                        <li class="price-container">
                                                            <div class="filter-wrapper">
                                                                <?php echo do_shortcode('[display-filter taxonomy="dvba_2021_price_range" name="price-ranges" checked="' . $prices . '"]'); ?>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row g-0 m-0 justify-content-center">
                                                <div class="col text-center py-3">
                                                    <button type="button" class="apply-btn poppins-bold box-shadow py-1 px-4 me-1">Apply</button>
                                                    <input type="reset" value="Reset" class="reset-btn poppins-bold box-shadow py-1 px-4 ms-1" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo do_shortcode( '[display-filter-list skinTypes="' . $skinTypes . '" skinConcerns="' . $skinConcerns . '" hairConcerns="' . $hairConcerns . '" brands="' . $brands . '" awards="' . $awards . '" prices="' . $prices . '"]' ); ?>
                <div class="row g-0 m-0">
                    <div class="col px-2">
                        <div class="container p-0">
                            <div class="row g-0 m-0 product-list">
                                <?php echo do_shortcode( '[display-products term_id="' . $term_id . '" posts_per_page="' . $posts_per_page . '" column="col-6 col-md-3" spacing="px-2 py-2 px-md-4 py-md-3" skinTypes="' . $skinTypes . '" skinConcerns="' . $skinConcerns . '" hairConcerns="' . $hairConcerns . '" brands="' . $brands . '" awards="' . $awards . '" prices="' . $prices . '" orderby="' . $orderby . '"]' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if( $totalPages > 1 ): ?>
                <div class="row g-0 m-0">
                    <div class="col text-center">
                        <button type="button" class="box-shadow py-2 px-5 poppins-bold more-products-btn" id="<?php echo $term_id; ?>-<?php echo $totalPages>0?$totalPages:0; ?>-0-<?php echo $posts_per_page; ?>">Load More</button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
    get_footer( 'dvba2021listing' ); 
?>