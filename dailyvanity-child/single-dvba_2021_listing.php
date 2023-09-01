<?php 

global $post;
get_header( 'dvba2021listing' ); 

$categories = get_the_terms( $post->ID, 'dvba_2021_categories' );

$awards = [];
$catName = '';

foreach( $categories as $cat ):
    if( $cat->parent == 0 ):
        $parent_id = $cat->term_id;
        $parent_slug = $cat->slug;
    endif;

    if( count( get_term_children( $cat->term_id, 'dvba_2021_categories' ) ) == 0 ):
        $awards[] .= $cat->name;
    elseif( count( get_term_children( $cat->term_id, 'dvba_2021_categories' ) ) == 4 ):
        $catName = $cat->name; 
    endif;
endforeach;

$arr = [ 'awards' => $awards, 'category' => $catName ];

$postID = $post->ID;

$posts_per_page = 4;

$totalPages = get_similar_products_total_pages( $posts_per_page, $postID );

// print_r( $totalPages );
?>

<div class="container-fluid px-0 pt-0 pb-5" id="single-product-container">
    <div class="row g-0 m-0">
        <div class="col">
        </div>
    </div>
    <div class="row g-0 pt-md-5 m-0">
        <div class="col-12 col-sm-12 col-md-8 mt-5 mt-md-5 mx-auto px-4">
            <div class="container" id="product-details-container">
                <?php echo get_template_part( 'microsite/DVBA2021Listing/templates/DisplayProduct', null, $arr ); ?>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid p-0 <?php echo $parent_slug?$parent_slug.'-product-container':$slug.'-product-container'; ?>">
    <div class="row g-0 m-0">
        <dic class="col p-0">
            <div class="container px-0 pb-5">
                <div class="row g-0 m-0 align-items-center">
                    <div class="col pt-3 pb-2 px-md-5 py-md-4 px-2 similar-products-title">
                        <h2 class="eb-garamond-regular">Similar Products</h2>
                    </div>
                </div>
                <div class="row g-0 m-0">
                    <div class="col px-2 px-md-5">
                        <div class="container p-0">
                            <div class="row g-0 m-0 product-list">
                                <?php echo do_shortcode( '[display-similar-products post_id="' . $postID . '" posts_per_page="' . $posts_per_page . '" column="col-6 col-md-3" spacing="px-2 py-2 px-md-4 py-md-3" ids="' . $postID . '" parent_id="' . $parent_id . '" parent_slug="' . $parent_slug . '"]' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if( $totalPages > 1 ): ?>
                <div class="row g-0 m-0">
                    <div class="col text-center">
                        <button type="button" class="box-shadow py-2 px-5 poppins-bold more-products-btn" id="<?php echo $parent_id; ?>-<?php echo $totalPages>0?$totalPages:0; ?>-<?php echo $postID; ?>-<?php echo $posts_per_page; ?>">Load More</button>
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