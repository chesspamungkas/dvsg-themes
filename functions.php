<?php
DV\DailyVanity::init();

include_once( __DIR__ . '/inc/Mobile_Detect.php' );

$detect = new Mobile_Detect;

define( 'BASE_PATH', home_url() );
define( 'S3_PATH', 'https://uploads.dailyvanity.sg' );
define( 'SEARCH_PLACEHOLDER', 'TYPE SEARCH TERM(S) AND PRESS ENTER...' );
define( 'DAILY_BEAUTY_TIP_CAPTION', 'COME BACK EVERYDAY FOR A DIFFERENT TIP!' );
define( 'MORE_STORIES_BUTTON_TEXT', 'MORE STORIES' );
define( 'READ_MORE', 'READ MORE' );

if( $detect->isMobile() || $detect->isTablet() ) {
    $fb = 'fb://profile/103966130960487';
    $ig = 'instagram://user?username=dailyvanitymy';
} else {
    $fb = 'https://facebook.com/dailyvanitymy';
    $ig = 'https://instagram.com/dailyvanitymy';
}

define( 'FB_LINK', $fb );
define( 'IG_LINK', $ig );
define( 'GTM_ID', 'GTM-WTML7X9' );


if( !is_admin() ) {
    function add_asyncdefer_attribute( $tag, $handle ) {
        $param = '';
        if ( strpos($handle, 'async') !== false ) $param = 'async ';
        if ( strpos($handle, 'defer') !== false ) $param .= 'defer ';
        if ( $param )
            return str_replace('<script ', '<script ' . $param, $tag);
        else
            return $tag;
    }
    add_filter( 'script_loader_tag', 'add_asyncdefer_attribute', 10, 2 );
}

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1200, 9999 );

// insert title tag
add_theme_support( 'title-tag' );

// change the browser navigation bar color theme on mobile view
add_action( 'wp_head', function() {
    // Chrome, Firefox OS and Opera
    echo '<meta name="theme-color" content="#f04084" />';
    // Windows Phone
    echo '<meta name="msapplication-navbutton-color" content="#4285f4">';
    // iOS Safari
    echo '<meta name="apple-mobile-web-app-status-bar-style" content="#4285f4">';
    // viewport
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
} );

// insert custom css and js
function wpdocs_dailyvanity_main_scripts() {
    // google tag
    // wp_enqueue_script( 'ga-async', 'https://www.googletagmanager.com/gtag/js?id=UA-145339205-1', '', 2, false );
    wp_register_script( 'ga-script', get_template_directory_uri() . '/src/js/ga.js' );
    wp_localize_script( 'ga-script', 'ga_object', [ 'gtm_id' => GTM_ID ] );
    wp_enqueue_script( 'ga-script' );

    // custom
    wp_enqueue_style( 'font-style', get_template_directory_uri() . '/src/css/font.css?v=' . DEPLOY_VERSION );
    wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/src/css/custom.css?v=' . DEPLOY_VERSION );
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/src/js/custom.js', array(), DEPLOY_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_dailyvanity_main_scripts' );

// change og:locale to en_MY
add_filter( "rank_math/opengraph/facebook/og_locale", function( $content ) {
    $content = 'en_MY';
    return $content;
});

function SearchFilter( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', 'post' );
    }
    return $query;
}
add_filter( 'pre_get_posts', 'SearchFilter' );

function googleTagManagerBodyScript() {
    echo '<!-- Google Tag Manager (noscript) -->';
    echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . GTM_ID . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
    echo '<!-- End Google Tag Manager (noscript) -->';
}

add_filter( 'rank_math/frontend/breadcrumb/html', function( $html, $crumbs, $class ) {
	$html = str_replace('<span class="separator"> - </span>', '<span class="separator">&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>&nbsp;&nbsp;&nbsp;</span>', $html);
	return $html;
}, 10, 3);
