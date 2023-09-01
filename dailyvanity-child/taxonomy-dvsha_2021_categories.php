<?php
    $post = get_queried_object();

    $term_id = $post->term_id;
    $parent = $post->parent;
    $name = $post->name;

    $lodashJs = 'https://cdn.jsdelivr.net/npm/lodash@4.17.5/lodash.min.js';
    $customCss = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Listing/css/style.css?v=' . DEPLOY_VERSION;
    $customJs = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Listing/js/script.js?v=' . DEPLOY_VERSION;
    // $slickCss = '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css';
    // $slickThemeCss = 'https://kenwheeler.github.io/slick/slick/slick-theme.css';
    // $slickJs = '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js';
    $home = home_url() . '/best-spa-hair-facials-treatments-singapore/2021/';
    $fb = 'https://www.facebook.com/dailyvanity/';
    $ig = 'https://www.instagram.com/dailyvanity/?hl=en';
    $tw = 'https://twitter.com/dailyvanitysg?lang=en';
    $ytb = 'https://www.youtube.com/dailyvanity?sub_confirmation=1';

    include_once( __DIR__ . '/microsite/DVSHA/header.php' );

?>

    <style> 
        #intro > .row:not(:last-child) > .col { 
            min-height: 350px; 
        } 
        
        @media (min-width: 481px) { 
            .dvsha-logo{ 
                top: -250px; 
                width: 350px; 
                height: 350px; 
                margin-left: -175px; 
            } 
        } 

        @supports (-webkit-touch-callout: none) {
            /* CSS specific to iOS devices */ 
            .dvsha-logo{ 
                top: -250px !important; 
            } 
        }

        @supports not (-webkit-touch-callout: none) {
        /* CSS for other than iOS devices */ 
        }
    </style>

<?php

    include_once( __DIR__ . '/microsite/DVSHA/top-bar.php' );

    if( $_GET['brands-checkbox-group'] ) {
        $brands = implode( ',', $_GET['brands-checkbox-group'] );
    } else {
        $brands = '';
    }

    if( $_GET['award-tiers-checkbox-group'] ) {
        $awards = implode( ',', $_GET['award-tiers-checkbox-group'] );
    } else {
        $awards = '';
    }

    if( $_GET['body-concerns-checkbox-group'] ) {
        $bodyConcerns = implode( ',', $_GET['body-concerns-checkbox-group'] );
    } else {
        $bodyConcerns = '';
    }

    if( $_GET['hair-concerns-checkbox-group'] ) {
        $hairConcerns = implode( ',', $_GET['hair-concerns-checkbox-group'] );
    } else {
        $hairConcerns = '';
    }

    if( $_GET['misc-checkbox-group'] ) {
        $misc = implode( ',', $_GET['misc-checkbox-group'] );
    } else {
        $misc = '';
    }

    if( $_GET['price-range-checkbox-group'] ) {
        $priceRanges = implode( ',', $_GET['price-range-checkbox-group'] );
    } else {
        $priceRanges = '';
    }

    if( $_GET['skin-concerns-checkbox-group'] ) {
        $skinConcerns = implode( ',', $_GET['skin-concerns-checkbox-group'] );
    } else {
        $skinConcerns = '';
    }

    if( $_GET['skin-type-checkbox-group'] ) {
        $skinTypes = implode( ',', $_GET['skin-type-checkbox-group'] );
    } else {
        $skinTypes = '';
    }
    
    echo do_shortcode( '[dvsha-2021-category-header id="' . $term_id . '" name="' . $name . '" parent="' . $parent . '"]' );
    
    echo do_shortcode( '[dvsha-2021-filters brands="' . $brands . '" awards="' . $awards . '" bodyconcerns="' . $bodyConcerns . '" hairconcerns="' . $hairConcerns . '" misc="' . $misc . '" priceranges="' . $priceRanges . '" skinconcerns="' . $skinConcerns . '" skintypes="' . $skinTypes . '"]' );

    echo do_shortcode( '[dvsha-2021-search term_id="' . $term_id . '" parent="' . $parent . '" brands="' . $brands . '" awards="' . $awards . '" bodyconcerns="' . $bodyConcerns . '" hairconcerns="' . $hairConcerns . '" misc="' . $misc . '" priceranges="' . $priceRanges . '" skinconcerns="' . $skinConcerns . '" skintypes="' . $skinTypes . '"]' );
?>
<div class="container-fluid" style="background-color: #F9F7F5;">
    <div class="row no-gutters">
        <div class="col text-center p-5">
            <h2 class="other-award-winenrs">Other Award Winners</h2>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col">
            <?php echo do_shortcode( '[dvsha-2021-category term_id="' . $term_id . '" parent="' . $parent . '"]' ); ?>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col text-center p-5">
            <a href="<?php echo $home; ?>#winners" target="_blank" class="view-all-categories-btn">View All Categories</a>
        </div>
    </div>
</div>
<!-- <script>
    jQuery( document ).ready( function( $ ) {
        if( !isAndroid && $( width ).width() <= 480 ) {
            $( ".dvsha-logo" ).css( 'top', '-250px' );
        }
    } );
</script> -->
<?php
    include_once(__DIR__ . '/microsite/DVSHA/footer-bar.php');
    include_once(__DIR__ . '/microsite/DVSHA/footer.php');
?>