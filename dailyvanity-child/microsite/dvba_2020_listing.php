<?php
// Template Name: DVBA Listing 2020 Template
get_header();

// global $wp_query;
// print_r($wp_query->query_vars['cat']);<?php

function getCatLinks( $slug ) {
    $terms = get_term_by( 'slug', $slug, 'dvba_2020_categories');

    $categories = get_terms( 'dvba_2020_categories', array(
        'parent' => $terms->term_id,
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC',
        'show_count' => true,
    ) );

    $numTerms = wp_count_terms( 'dvba_2020_categories', array(
        'parent' => $terms->term_id,
        'hide_empty' => false,
    ) );

    if( $numTerms % 2 == 0 ) {
        $break = $numTerms / 2;
    } else {
        $break = ( $numTerms + ( $numTerms % 2 ) ) / 2;
    }

    foreach( $categories as $category ) {
        echo '<li>';
        echo '<a href="' . get_term_link( $category->term_id ) . '">' . $category->name . '</a>';
        echo '</li>';
    }
}

function get_terms_ordered( $taxonomy = '', $args = [], $term_order = '', $sort_by = 'slug' )
{
    // Check if we have a taxonomy set and if the taxonomy is valid. Return false on failure
    if ( !$taxonomy )
        return false;

    if ( !taxonomy_exists( $taxonomy ) )
        return false;

    // Get our terms    
    $terms = get_terms( $taxonomy, $args ); 

    // Check if we have terms to display. If not, return false
    if ( empty( $terms ) || is_wp_error( $terms ) )
        return false;

    /** 
     * We have made it to here, lets continue to output our terms
     * Lets first check if we have a custom sort order. If not, return our
     * object of terms as is
     */
    if ( !$term_order )
        return $terms;

    // Check if $term_order is an array, if not, convert the string to an array
    if ( !is_array( $term_order ) ) {
        // Remove white spaces before and after the comma and convert string to an array
        $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $term_order, FILTER_SANITIZE_STRING ) );
        $term_order = explode( ',', $no_whitespaces );
    }

    // Remove the set of terms from the $terms array so we can move them to the front in our custom order
    $array_a = [];
    $array_b = [];

    foreach ( $terms as $term ) {
        if ( in_array( $term->$sort_by, $term_order ) ) {
            $array_a[] = $term;
        } else {
            $array_b[] = $term;
        }
    }

    /**
     * If we have a custom term order, lets sort our array of terms
     * $term_order can be a comma separated string of slugs or names or an array
     */
    usort( $array_a, function ( $a, $b ) use( $term_order, $sort_by )
    {
        // Flip the array
        $term_order = array_flip( $term_order );

        return $term_order[$a->$sort_by] - $term_order[$b->$sort_by];
    });

    return array_merge( $array_a, $array_b );
}   
?>

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvba-listing-2020/css/custom.css?v=<?php echo DEPLOY_VERSION; ?>">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script type="text/javascript">
var jQuery_3_3_1 = $.noConflict(true);
</script> -->

<script type="text/javascript">
    var homeUrl = '<?php echo home_url(); ?>';
</script>

<!-- content start -->

<!-- start navigation bar -->
<?php 
$active = 'intro';
include( get_stylesheet_directory() . "/microsite/dvba-listing-2020/navigation_bar.php" ); ?>
<!-- end navigation bar -->

<!-- start introduction -->
<div class="container montserrat full-width" id="intro">
    <div class="row">
        <!--div class="col-12 logo-container">
            <div id="dvba-logo">
                <img src="<?php //echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvba-listing-2020/img/logo.png" alt="best popular skincare makeup hair beauty products singapore 2020" />
            </div>
        </div>
        <div class="col-12 text-center" id="intro-body">
            <p class="font-weight-bold montserrat text-center">Our esteemed panel of Editor and Judges, and over 1,800 readers have voted for their favourite beauty products!</p>
            <p class="font-weight-normal montserrat text-center">Browse through the site to see what products have emerged as winners and check out their exclusive offers!</p>
        </div-->
    </div>
</div>
<!-- end introduction -->

<!-- start categories -->
<div class="container montserrat full-width" id="categories">
    <div class="row">
        <div class="col text-center">
            <h1>Winners</h1>
            <div class="row justify-content-center desktop-view" id="categories-div">
                <?php 

                $args = array(
                    'taxonomy' => 'dvba_2020_categories',
                    'hide_empty' => false,
                    'parent' => 0,
                );

                // $terms = get_terms( $args );

                $terms = get_terms_ordered( 'dvba_2020_categories', $args, ['makeup', 'skincare', 'body-care', 'hair-care'], 'slug');

                // print_r( $terms );

                foreach( $terms as $term ) {
                    $img = wp_get_attachment_image_src( get_option( 'categoryimage_' . $term->term_id ), 'full' );

                    echo '<div class="col-2 no-padding" style="position:relative;">';
                    echo '<img src="' . $img[0] . '" />';
                    echo '<button type="button" data-toggle="collapse" data-target="#collapse-' . str_replace( "-", "", $term->slug) . '" aria-expanded="false" aria-controls="collapse-' . str_replace( "-", "", $term->slug) . '" style="background-color:unset;">';
                    echo '<img src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvba-listing-2020/img/see_the_winners_btn.png" />';
                    echo '</button>';
                    echo '<div class="col-12 subcat collapse" id="collapse-' . str_replace( "-", "", $term->slug) . '" style="position:absolute; z-index:999999; background-color: #65154d; width: 80%; margin-left: 50%; left: -40%;">';
                    echo '<div class="card card-body">';
                    echo '<ul>';
                    getCatLinks( $term->slug );
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="row justify-content-center mobile-view" id="categories-div-m">
                <?php

                    // $terms2 = get_terms_ordered( 'dvba_2020_categories', $args, ['makeup', 'skincare', 'body-care', 'hair-care'], 'slug');

                    // print_r( $terms );

                    foreach( $terms as $term ) {
                        $img = wp_get_attachment_image_src( get_option( 'categoryimage_' . $term->term_id ), 'full' );

                        echo '<div class="col no-padding">';
                        echo '<button type="button" data-toggle="collapse" data-target="#collapse' . str_replace( "-", "", $term->slug) . '-m" aria-expanded="false" aria-controls="collapse' . str_replace( "-", "", $term->slug) . '-m">';
                        // echo '<img src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvba-listing-2020/img/see_the_winners_btn.png" />';
                        echo '<img src="' . $img[0] . '" alt="Best Beauty ' . $term->name . ' Products 2020" />';
                        echo '</button>';
                        echo '<div class="row">';
                        echo '<div class="col subcat collapse" id="collapse' . str_replace( "-", "", $term->slug) . '-m">';
                        echo '<div class="card card-body">       ';
                        echo '<ul>';
                        getCatLinks( $term->slug );
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                ?>
                <!--div class="col no-padding">
                    <button type="button" data-toggle="collapse" data-target="#collapseMakeup-m" aria-expanded="false" aria-controls="collapseMakeup-m">Makeup</button>
                    <div class="row">
                        <div class="col subcat collapse" id="collapseMakeup-m">
                            <div class="card card-body">                                
                                <ul>
                                    <?php //getCatLinks( 'makeup' ); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col no-padding">
                    <button type="button" data-toggle="collapse" data-target="#collapseSkincare-m" aria-expanded="false" aria-controls="collapseSkincare-m">Skincare</button>
                    <div class="row">
                        <div class="col subcat collapse" id="collapseSkincare-m">
                            <div class="card card-body">
                                <ul>
                                    <?php //getCatLinks( 'skincare' ); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col no-padding">
                    <button type="button" data-toggle="collapse" data-target="#collapseBodycare-m" aria-expanded="false" aria-controls="collapseBodycare-m">Body Care</button>
                    <div class="row">
                        <div class="col subcat collapse" id="collapseBodycare-m">
                            <div class="card card-body">
                                <ul>
                                    <?php //getCatLinks( 'body-care' ); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col no-padding">
                    <button type="button" data-toggle="collapse" data-target="#collapseHaircare-m" aria-expanded="false" aria-controls="collapseHaircare-m">Hair Care</button>
                    <div class="row">
                        <div class="col subcat collapse" id="collapseHaircare-m">
                            <div class="card card-body">
                                <ul>
                                    <?php //getCatLinks( 'hair-care' ); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div-->
            </div>
        </div>
    </div>
</div>
<!-- end categories -->

<!-- start giveaway -->
<div class="container montserrat no-padding no-margin full-width" id="voting">
    <div class="row desktop-view" id="pills-voting">
        <div class="col">
            <div class="container no-padding">
                <div class="row no-margin align-items-center justify-content-center">
                    <div class="col-7">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvba-listing-2020/img/how_to_win.jpg" alt="best popular skincare makeup hair beauty products singapore 2020" />
                    </div>
                    <div class="col-4 text-center">
                        <h1 class="voting-title">We’re giving away 3 mega beauty hampers filled with award-winning products from this year!</h1>
                        <a href="<?php echo get_home_url(); ?>/giveaway/dvba2020?utm_source=dvba2020_giveaway&utm_medium=website&utm_campaign=dvba2020-listing" class="btn btn-purple no-margin" target="_blank">How To Win</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mobile-view" id="pills-voting">
        <div class="col">
            <div class="container no-padding">
                <div class="row no-margin align-items-center justify-content-center">
                    <div class="col-12 text-center no-padding">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvba-listing-2020/img/how_to_win.jpg" alt="best popular skincare makeup hair beauty products singapore 2020" />
                    </div>
                    <div class="col-12 text-center no-padding">
                        <h1 class="voting-title">We’re giving away 3 mega beauty hampers filled with award-winning products from this year!</h1>
                        <a href="<?php echo get_home_url(); ?>/giveaway/dvba2020?utm_source=dvba2020_giveaway&utm_medium=website&utm_campaign=dvba2020-listing" class="btn btn-purple no-margin" target="_blank">How To Win</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end giveaway -->

<!-- start judges -->
<div class="container montserrat" id="judges">
    <div class="row justify-content-center no-margin" id="pills-judges">
        <div class="col-md-12 text-center">
            <h1 class="judges-title">The Judges</h1>
        </div>
        <div class="col-md-12">
            <div class="row no-margin">
                <div class="col-12 judge-desc">
                    <h6>Led by Editorial Director, Kristen Juliet Soh, our panel of judges are made up of the staff members of Daily Vanity.<br/><br/>
                    Working in a top beauty publication like Daily Vanity means we are constantly exposed to the newest beauty products, know the latest trends, and are able to objectively differentiate the good from the bad.<br/><br/>
                    The judges have different skin concerns and lifestyle, across different ages and genders to give a fairer judgement.<br/><br/>
                    On top of that, our commitment to helping our readers make the best purchase decisions guides our approach to sussing out these award-winning products.</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end judges -->
<!-- end content -->

<!-- custom js script here -->
<script src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvba-listing-2020/js/custom.js?v=0.185"></script>

<?php get_footer(); ?>
