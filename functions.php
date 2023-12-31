<?php
DV\DailyVanity::init();

DV\core\Constants::Define('BASE_PATH', home_url());
DV\core\Constants::Define('S3_PATH', 'https://uploads.dailyvanity.sg');
DV\core\Constants::Define('SEARCH_PLACEHOLDER', 'TYPE SEARCH TERM(S) AND PRESS ENTER...');
DV\core\Constants::Define('DAILY_BEAUTY_TIP_CAPTION', 'COME BACK EVERYDAY FOR A DIFFERENT TIP!');
DV\core\Constants::Define('MORE_STORIES_BUTTON_TEXT', 'MORE STORIES');
DV\core\Constants::Define('READ_MORE', 'READ MORE');
DV\core\Constants::Define('SF_LINK', 'https://salonfinder.dailyvanity.sg');
DV\core\Constants::Define('DFP_INGORE', []);
DV\core\Constants::Define('FB_LINK', 'https://facebook.com/' . FB_PAGE_NAME);
DV\core\Constants::Define('IG_LINK', 'https://instagram.com/' . IG_USERNAME);

if (!is_admin()) {
    function add_asyncdefer_attribute($tag, $handle)
    {
        $param = '';
        if (strpos($handle, 'async') !== false) $param = 'async ';
        if (strpos($handle, 'defer') !== false) $param .= 'defer ';
        if ($param)
            return str_replace('<script ', '<script ' . $param, $tag);
        else
            return $tag;
    }
    add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
}

add_theme_support('post-thumbnails');
set_post_thumbnail_size(1200, 9999);

// insert title tag
add_theme_support('title-tag');

// change the browser navigation bar color theme on mobile view
add_action('wp_head', function () {
    // Chrome, Firefox OS and Opera
    echo '<meta name="theme-color" content="#f04084" />';
    // Windows Phone
    echo '<meta name="msapplication-navbutton-color" content="#4285f4">';
    // iOS Safari
    echo '<meta name="apple-mobile-web-app-status-bar-style" content="#4285f4">';
    // viewport
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
});

// change og:locale to en_MY
add_filter("rank_math/opengraph/facebook/og_locale", function ($content) {
    $content = 'en_MY';
    return $content;
});

// create custom post type for Daily Beauty Tips
function register_daily_beauty_tips()
{
    $labels = [
        "name" => __("Daily Beauty Tips", "dailyvanity-child"),
        "singular_name" => __("Daily Beauty Tip", "dailyvanity-child"),
    ];

    $args = [
        "label" => __("Daily Beauty Tips", "dailyvanity-child"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "rewrite" => ["slug" => "daily_beauty_tips", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "editor", "thumbnail"],
    ];

    register_post_type("daily_beauty_tips", $args);
}

add_action('init', 'register_daily_beauty_tips');

// function SearchFilter( $query ) {
//     if ( $query->is_search ) {
//         $query->set( 'post_type', 'post' );
//     }
//     return $query;
// }
// add_filter( 'pre_get_posts', 'SearchFilter' );

function googleTagManagerBodyScript()
{
    echo '<!-- Google Tag Manager (noscript) -->';
    echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . GTM_ID . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
    echo '<!-- End Google Tag Manager (noscript) -->';
}

add_filter('rank_math/frontend/breadcrumb/html', function ($html, $crumbs, $class) {
    $html = str_replace('<span class="separator"> - </span>', '<span class="separator">&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>&nbsp;&nbsp;&nbsp;</span>', $html);
    return $html;
}, 10, 3);

function wpb_popular_searches_menu()
{
    register_nav_menu('popular-searches-menu', __('Popular Searches Menu'));
}
add_action('init', 'wpb_popular_searches_menu');


function register_dfp_bottom()
{
    echo "<script>\n";
    echo "\tif( isMobile ) {\n";
    echo "\t\tdocument.write('<div id=\"" . DFP_300x250_B . "\" class=\"dfp-div mobileAdBanner\" style=\"width: 300px; height: 250px;\"></div>');\n";
    echo "\t} else {\n";
    echo "\t\tdocument.write('<div id=\"" . DFP_728x90_B . "\" class=\"dfp-div\" style=\"width: 780px; height: 90px;\"></div>');\n";
    echo "\t}\n";
    echo "</script>";
}

add_action('body_div_after', 'register_dfp_bottom');


function register_dfp_top()
{
    echo "<script>\n";
    echo "\tif( isMobile ) {\n";
    echo "\t\tdocument.write('<div id=\"" . DFP_300x250_A . "\" class=\"dfp-div mobileAdBanner\" style=\"width: 300px; height: 250px;\"></div>');\n";
    echo "\t} else {\n";
    echo "\t\tdocument.write('<div id=\"" . DFP_728x90_A . "\" class=\"dfp-div\" style=\"width: 780px; height: 90px;\"></div>');\n";
    echo "\t}\n";
    echo "</script>";
}

add_action('top_dfp_ad', 'register_dfp_top');

// rewrite wp_review json to add in the aggragateRating for google search result
function add_aggreagate_rating($args, $review)
{
    global $post;

    $args['itemReviewed']['aggregateRating'] = array(
        'type' => 'AggregateRating',
        'ratingValue' => $review['total'],
        'reviewCount' => intval(get_field('total_reviewers', $post->ID))
    );

    return $args;
}
add_filter('wp_review_get_schema_review_rating_args', 'add_aggreagate_rating', 10, 2);

function register_video_ad()
{
    global $post;

    if (get_field('disable_ads_injection', $post->ID) === false || !get_field('disable_ads_injection', $post->ID)) {
        echo '<div class="container"><div class="row p-0 m-0"><div class="col-12 poppins-light"><div id="' . VIDEO_ADS_1X1 . '" class="dfp-div loadedads" style="width: 1px; height: 1px; margin: 0 auto;"></div></div></div></div>';
    }
}

add_action('video_ad', 'register_video_ad');

/**
 * Content Filter 
 */

add_filter('the_content', 'prefix_insert_post_ads');

function prefix_insert_post_ads($content)
{
    global $post;

    if (!in_array($post->post_type, DFP_INGORE)) {
        $insertion = '<div id="' . DFP_300x250_C . '" class="dfp-div" style="width: 300px; height: 250px; margin-bottom: 40px;"></div>';
    }

    if (is_single() && !is_admin() && (get_field('disable_ads_injection', $post->ID) === false || !get_field('disable_ads_injection', $post->ID))) {
        return prefix_insert_after_paragraphs($content, $insertion, array(2));
    }

    return $content;
}

// Function that makes the magic happen correctly

function prefix_insert_after_paragraphs($content, $insertion, $paragraph_indexes)
{

    // find all paragraph ending offsets

    preg_match_all('#</p>#i', $content, $matches, PREG_SET_ORDER + PREG_OFFSET_CAPTURE);

    // reduce matches to offset positions

    $matches = array_map(function ($match) {
        return $match[0][1] + 4; // return string offset + length of </p> Tag
    }, $matches);

    // reverse sort indexes: plain text insertion just works nicely in reverse order

    rsort($paragraph_indexes);

    // cycle through and insert on demand

    foreach ($paragraph_indexes as $paragraph_index) {
        if ($paragraph_index <= count($matches)) {
            $offset_position = $matches[$paragraph_index - 1];
            $content = substr($content, 0, $offset_position) . $insertion . substr($content, $offset_position);
        }
    }

    return $content;
}

// content protection functions
function content_protection()
{
    /* If user not login then enable content protection */
    if (!is_user_logged_in()) {
?>
        <script>
            jQuery(document).ready(function() {
                /* Disable right click */
                jQuery(document).bind("contextmenu", function(e) {
                    return false;
                });
                /* Disable copy cut */
                jQuery(document).bind('copy cut', function(e) {
                    return false;
                });
                /* Disable text selection */
                jQuery("body").css({
                    '-webkit-touch-callout': 'none',
                    /* iOS Safari */
                    '-webkit-user-select': 'none',
                    /* Safari */
                    '-moz-user-select': 'none',
                    /* Konqueror HTML */
                    '-khtml-user-callout': 'none',
                    /* Old versions of Firefox */
                    '-ms-user-select': 'none',
                    /* Internet Explorer/Edge */
                    'user-select': 'none' /* Non-prefixed version, currently supported by Chrome, Opera and Firefox */
                })
            });
        </script>
<?php
    }
}
add_action('wp_footer', 'content_protection');
