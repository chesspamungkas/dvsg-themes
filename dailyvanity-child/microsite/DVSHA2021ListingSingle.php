<?php
// Template Name: DVSHA 2021 Listing Single Template

    $pageID = get_queried_object()->ID;
    $customCss = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Listing/css/style.css?v=' . DEPLOY_VERSION;
    $customJs = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Listing/js/script.js?v=' . DEPLOY_VERSION;
    $slickCss = '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css';
    $slickThemeCss = 'https://kenwheeler.github.io/slick/slick/slick-theme.css';
    $slickJs = '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js';
    $home = home_url() . '/best-spa-hair-facials-treatments-singapore/2021/';
    $fb = 'https://www.facebook.com/dailyvanity/';
    $ig = 'https://www.instagram.com/dailyvanity/?hl=en';
    $tw = 'https://twitter.com/dailyvanitysg?lang=en';
    $ytb = 'https://www.youtube.com/dailyvanity?sub_confirmation=1';

    // $introImg = get_field( 'header_image', $pageID );
    // $dvshaLogo = get_field( 'logo', $pageID );
    // $winnersHeaderText = get_field( 'winners_section_header', $pageID );
    // $winnersHeaderImg = get_field( 'winners_section_header_image', $pageID );
    // $winnersBgColor = get_field( 'winners_section_background_color', $pageID );

    include_once( __DIR__ . '/DVSHA/header.php' );
    include_once( __DIR__ . '/DVSHA/top-bar.php' );

?>
<div class="container-fluid p-0 m-0" id="search-result">
    <div class="row p-0 m-0">
        <div class="col p-0">
        <?php
            if( $_REQUEST['k'] ) {
                echo do_shortcode( '[dvsha-2021-search s="' . $_REQUEST['k'] . '"]' );
            } else {
                echo '<h2 class="text-center">No Results Found!</h2>';
            }
        ?>
        </div>
    </div>
</div>
<?php
    include_once(__DIR__ . '/DVSHA/footer-bar.php');
    include_once(__DIR__ . '/DVSHA/footer.php');
?>