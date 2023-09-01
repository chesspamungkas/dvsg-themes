<?php
/* Template Name: DVBA 2021 Search Results */

get_header( 'dvba2021listing' ); 

$s = $_GET['k'];

$args = array( 
    'post_type' => 'dvba_2021_listing',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    's' => $s,
);

remove_filter('posts_request', 'relevanssi_prevent_default_request'); 
remove_filter('the_posts', 'relevanssi_query', 99);

$products = new WP_Query( $args );
?>

<div class="container-fluid px-0 pt-0 pb-5" id="search-result-container">
    <div class="row g-0 pt-md-5 m-0">
        <div class="col-12 col-sm-12 col-md-8 pt-5 pt-md-4 mx-auto px-4 text-center">
            <h1 class="eb-garamond-regular">Search Results for: <?php echo $s; ?></h1>
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
                                <?php echo do_shortcode( '[display-products term_id="0" posts_per_page="4" column="col-6 col-md-3" spacing="px-2 py-2 px-md-4 py-md-3" ids="" s="' . $s . '"]' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if( $products->found_posts > 4 ): ?>
                <div class="row g-0 m-0">
                    <div class="col text-center">
                        <button type="button" class="box-shadow py-2 px-5 poppins-bold more-products-btn" id="<?php echo $parent_id; ?>-<?php echo $products->max_num_pages>0?$products->max_num_pages:0; ?>-<?php echo $postID; ?>-4">Load More</button>
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
