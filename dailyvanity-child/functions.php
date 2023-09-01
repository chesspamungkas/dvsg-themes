<?php

use DV\core\Constants;

if ( ! defined( 'ABSPATH' ) ) {
	die();
}
flush_rewrite_rules();
$useragent = $_SERVER['HTTP_USER_AGENT'];
$isMobile = false;
$isIOS = false;
// $device = 'desktop';

if( preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$useragent) ) {
  $isMobile = true;
  $device = 'mobile';
  $isIOS = false;

  if( stripos( $useragent, 'iphone' ) !== false || stripos( $useragent, 'ipad' ) !== false ) {
    // $isIOS = true;
    $isIOS = true;
  }
}

define('DFP_MOBILE_TOP', 'div-gpt-ad-1617264575479-0'); // DFP Ad Size 320 x 50 
define('DFP_DESKTOP_TOP', 'div-gpt-ad-1617264662069-0'); // DFP Ad Size 728 x 90
define('DFP_BOTTOM', 'div-gpt-ad-1611720294096-0'); // DFP Ad Size 300 x 250
define('VIDEO_ADS_1X1', 'div-gpt-ad-1622611465687-0'); // TEads/Unruly Ad Size 1 x 1

/* New Banners Sizes */
define('DFP_728x90_A', 'div-gpt-ad-1617264662069-0');
define('DFP_728x90_B', 'div-gpt-ad-1628128704047-0');
define('DFP_728x90_C', 'div-gpt-ad-1628128770448-0');
define('DFP_300x250_A', 'div-gpt-ad-1611720294096-0');
define('DFP_300x250_B', 'div-gpt-ad-1628128950154-0');
define('DFP_300x250_C', 'div-gpt-ad-1628128971182-0');

define( 'COUNTRY', 'Singapore' );
define( 'TOP_HEADER_LOGO', 'https://uploads.dailyvanity.sg/wp-content/uploads/svg/beauty-magazine-singapore-daily-vanity-logo.svg' );
define( 'S3_PATH', 'https://uploads.dailyvanity.sg');
define( 'BASE_PATH', home_url() );
define( 'SEE_MORE_PERKS', 'SEE MORE PERKS' );
define( 'LOAD_MORE_PERKS', 'LOAD MORE' );
define( 'FB_APP_ID', '383819251700743' );
define( 'FB_PAGE_NAME', 'dailyvanity' );
define( 'IG_USERNAME', 'dailyvanity' );
define( 'TW_LINK', 'https://twitter.com/dailyvanitysg?lang=en' );
define( 'YTB_LINK', 'https://www.youtube.com/dailyvanity?sub_confirmation=1' );
define( 'TG_LINK', 'https://t.me/dailyvanity' );

define( 'ADS_ID', '4661079907622282' );

define( 'PERKS', 'Perks' );
define( 'SALON_FINDER', 'Salon Finder' );
define( 'SF_LINK', 'https://salonfinder.dailyvanity.sg' );

define( 'GENERAL_CONTENT_UPGRADE', 'c6ddb36d-35da-407e-92d0-6bb6dd961fa2' );

define('DFP_INGORE', ['listicle']);


include_once(__DIR__ . '/src/core/ShortCode.php');

// Adding Style and Script
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   wp_enqueue_script( 'parent-mobiledetect-script', get_template_directory_uri() . '/src/js/mobile-detect.js' );
}

// Adding Style and Script
\DV\core\BaseStyle::AddStyle('fonts-philosopher', 'https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
\DV\core\BaseStyle::AddStyle('child-style', get_stylesheet_directory_uri() . '/style.css');
\DV\core\BaseStyle::AddStyle('child-index-style', get_stylesheet_directory_uri() . '/src/.dist/index.ts.css');
\DV\core\BaseStyle::AddStyle('zuckmin-style', get_stylesheet_directory_uri() . '/src/css/IGstory/zuck.min.css');
\DV\core\BaseStyle::AddScript('child-script', get_stylesheet_directory_uri() . '/src/.dist/index.ts.js');
\DV\core\BaseStyle::AddScript('child-cookie', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js');
// \DV\core\BaseStyle::AddScript('clipboard-script', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js');

\DV\core\BaseStyle::AddScript('clipboard-script', get_stylesheet_directory_uri() . '/src/js/clipboard.min.js');

// Adding components
// \DVChild\components\IGStory::init();
\DVChild\components\NovalyMedia::init();
\DVChild\microsites\dvba\twenty_two\DVBA_2022::init();

function registerSocialFilters() {
	add_filter(Constants::$DV_LINK_FB, function ($value) {
    return "https://www.facebook.com/dailyvanity/";
  });
  add_filter(Constants::$DV_LINK_TWITTER, function ($value) {
    return "https://twitter.com/dailyvanitysg?lang=en";
  });
  add_filter(Constants::$DV_LINK_YOUTUBE, function ($value) {
    return "https://www.youtube.com/dailyvanity?sub_confirmation=1";
  });
  add_filter(Constants::$DV_LINK_TELEGRAM, function ($value) {
    return "https://t.me/dailyvanity";
  });
}

add_action('init', 'registerSocialFilters');

// A custom function that calls register_post_type
add_post_type_support( 'sf_promotions', 'thumbnail' );
function register_sf_promotions_post_type() {
	register_post_type( 'sf_promotions',
	// CPT Options
	array(
		'labels' => array(
			'name' => __( 'Salon Finder Promotions', 'plural' ),
			'singular_name' => __( 'Salon Finder Promotion', 'singular' ),
			'all_items'	=> __( 'All Salon Finder Promotions', 'textdomain' )
		),
		'public' => true,
		'rewrite' => array('slug' => 'sf_promotions'),
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' =>true,
		'delete_with_user' => true,
		'show_in_rest' => true,
		'has_archive' => true,
		'query_var' => true,
		'exclude_from_search' => false,
		'hierarchical' => false,
		)
	);
}
// The custom function MUST be hooked to the init action hook
add_action( 'init', 'register_sf_promotions_post_type' );

// A custom function that calls register_post_type
// add_post_type_support( 'deal', 'thumbnail' );
// function register_deal_post_type() {
// 	register_post_type( 'deal',
// 	// CPT Options
// 	array(
// 		'labels' => array(
// 			'name' => __( 'Perk', 'plural' ),
// 			'singular_name' => __( 'Perk', 'singular' ),
// 			'all_items'	=> __( 'All Perks', 'textdomain' )
// 		),
// 		'public' => true,
// 		'rewrite' => array('slug' => 'deal'),
// 		'publicly_queryable' => true,
// 		'show_ui' => true,
// 		'show_in_menu' =>true,
// 		'delete_with_user' => true,
// 		'show_in_rest' => true,
// 		'has_archive' => true,
// 		'query_var' => true,
// 		'exclude_from_search' => false,
// 		'hierarchical' => false,
// 		)
// 	);
// }
// The custom function MUST be hooked to the init action hook
// add_action( 'init', 'register_deal_post_type' );

// top_header_bar_after
function top_header_bar_after() {
	echo '<div class="igstory-container">';
	echo do_shortcode( '[igstory photo="yes" topheaderbarafter="yes" ]' );
	echo '</div>';
}
add_action( 'top-header-bar-after', 'top_header_bar_after' );

// top_header_after_menu
function top_header_story_section() {
	echo do_shortcode( '[igstory photo="yes"]' );
}
add_action( 'top_header_story_section', 'top_header_story_section' );

// top_header_after_menu
function top_header_after_menu() {
	echo do_shortcode( '[igstory photo="no"]' );
}
add_action( 'top_header_after_menu', 'top_header_after_menu' );

// top_header_social_section
function top_header_social_section( $html ) {
	$html = '<div class="col-xs-12 col-sm-12 col-md-2">';
	if (is_user_logged_in()):
		$html .= '<p id="myaccount-title" class="poppins-semibold"><a href="'. SF_LINK. '/profile" target="_blank" rel="noopener noreferrer"><i class="fas fa-user mr-3"></i> MY ACCOUNT</a></p>';
    else:
    	$html .= '<p id="myaccount-title" class="poppins-semibold"><a href="'. SF_LINK. '/login" target="_blank" rel="noopener noreferrer"><i class="fas fa-user mr-3"></i> MY ACCOUNT</a></p>';
    endif;

	$html .= '<p id="salon-finder-title"><a href="'. SF_LINK. '" target="_blank" rel="noopener noreferrer">SALON FINDER ></a></p>'
    		. '<p id="follow-us-title" class="poppins-semibold">FOLLOW US</p>'
		. '<ul class="justify-content-center" id="header-social-icon">'
     		. '<li class="social-icon mr-3"><a href="'. FB_LINK .'" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>'
		. '<li class="social-icon mr-3"><a href="' . IG_LINK .'" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a></li>'
     		. '<li class="social-icon mr-3"><a href="'. TG_LINK .'" target="_blank" rel="noopener noreferrer"><i class="fab fa-telegram-plane"></i></a></li>'
     		. '<li class="social-icon mr-3"><a href="' . TW_LINK .'" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a></li>'
		. '<li class="social-icon mr-3"><a href="' . YTB_LINK .'" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a></li>'
		. '</ul>'
		. '</div>';

	echo $html;
}
add_action( 'top_header_social_section', 'top_header_social_section');

// register Expired status
function expired_status_registration(){
	register_post_status( 'expired', array(
	'label'                     => _x( 'Expired', 'post' ),
	'label_count'               => _n_noop( 'Expired <span class="count">(%s)</span>', 'Expired <span class="count">(%s)</span>'),
	'public'                    => true,
	'exclude_from_search'       => false,
	'show_in_admin_all_list'    => true,
	'show_in_admin_status_list' => true
	));
}
add_action( 'init', 'expired_status_registration' );

if(isset($_GET['sto'])) {
	add_action('wp_footer', 'scroll_to_section_script');
}


function scroll_to_section_script(){
	$script = "<script> \n";
	$script .= "\tjQuery( document ).ready( function( $ ) { \n";
	$script .= "\t\t$('html, body').animate({ scrollTop: $('[name=\"" . $_GET['sto'] . "\"]').offset().top}, 1000);";
	$script .= "\t} ); \n";
	$script .= "</script>";
	
	if( $_GET['sto'] ) {
		echo $script;
	}
}

// Adding Expired status in the dropdown
function add_to_post_status_dropdown()
{
    global $post;
	if($post->post_type != 'deal')
	return false;

	wp_enqueue_script('post_submitbox_misc_actions',get_stylesheet_directory_uri().'/src/js/Expired/add_to_post_status_dropdown.js',array('jquery'), null, false);
};
add_action( 'post_submitbox_misc_actions', 'add_to_post_status_dropdown');

// When user edit the post
add_action('admin_footer-post.php',function(){
    global $post;
    $complete = '';
    $label = '';

    if($post->post_type == 'deal') {
        if ( $post->post_status == 'expired' ) {
            $complete = ' selected=\"selected\"';
            $label    = 'Expired';
        }

        $script = <<<SD
       	jQuery(document).ready(function($){          
           if( "{$post->post_status}" == "expired" ){
			   
				$("#post_status").append("<option value=\"expired\" '.$complete.'>Expired</option>");
				$("#expirationdate_expiretype").append("<option value=\"expired\" '.$complete.'>Expired</option>");
				$("#save-post").val("Save Expired");
				$("#post-status-display").html("Expired");
				$("#post_status").val("expired");
           	}
        
		   	$('#enable-expirationdate').click (function ()
			{
				var thisCheck = $(this);
				if (thisCheck.is (':checked'))
				{
					$('[id=expirationdate_expiretype] option').filter(function() { 
						return ($(this).text() == 'Expired'); 
					}).prop('selected', true);
				}
				else
				{
					$("#post_status option[value='expired']").remove();
					$("#expirationdate_expiretype option[value='expired']").remove();
				}
			});
      });
SD;

        echo '<script type="text/javascript">' . $script . '</script>';
    }
});

// Display & Update status to Expired in List of Posts
add_filter( 'display_post_states', function( $status ) {
    global $post;

	$posts = new \WP_Query( array(      
	'orderby'          => 'date',
	'order'            => 'DESC',       
	'meta_query'  => array(
		array(
		'key'     => '_expiration-date',
		'value'   => time(),  // value for comparison
		'compare' => '<'  // method of comparison  
		)            
	),
	'post_type'        => 'deal', //your post type
	'post_status'      => 'publish',
	'post__not_in' => [],
	));

	if( $posts->post_count ) {
		foreach($posts->posts as $post) {
			// change post status to expired.
			$update = wp_update_post( array( 
				"ID" => $post->ID,
				"post_status" => "expired"
			) );
		} // endforeach
	} // endif

    if( $post->post_type == 'deal') {
        if ( get_query_var( 'post_status' ) != 'expired' ) {
            if ( $post->post_status == 'expired' ) {
                return array( 'Expired' );
            }
        }
    }
    return $status;
});

// Change BeautyNewsfeed
add_filter( 'beauty_newsfeed_filters', 'add_post', 10, 2);
function add_post($posts, $additional_args) {
	if( is_home() || is_front_page() ) {
		$additional_args['title'] = '';

		$current_page = $additional_args['paged'];
		$per_page = 1;
		$offset_start = 0;
		$offset = ( $current_page - 1 ) * $per_page + $offset_start;
		$count = 12;
		// $ids1 = array();
		$postarray = array();
		$perksarray = array();
		// $sfpromotionsarray = array();

		// $ids1 = array();
		// if( $posts->have_posts() ):
		// 	while ( $posts->have_posts() ):
		// 		$posts->the_post();
		// 		array_push($ids1, get_the_ID());
		// 	endwhile;
		// endif;
		// wp_reset_postdata();

		$perks_args = array(
			'posts_per_page' => $per_page,
			'paged' => $current_page,
			'offset' => $offset,
			'post_type' => 'deal',
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC'
		);

		// $sfpromotions_args = array(
		// 	'posts_per_page' => $per_page,
		// 	'paged' => $current_page,
		// 	'offset' => $offset,
		// 	'post_type' => 'sf_promotions',
		// 	'post_status' => 'publish',
		// 	'orderby' => 'date',
		// 	'order' => 'DESC'
		// );

		$perksPosts = new \WP_Query( $perks_args );
		if($perksPosts->have_posts()) {
			// array_pop($ids1);
			$count = $count-1;
			foreach($perksPosts->posts as $key => $perkspost) {
				setup_postdata( $perkspost );
				array_push($perksarray,$perkspost);
			}
		}

		// $sfpromotionsPosts = new \WP_Query( $sfpromotions_args );
		// if($sfpromotionsPosts->have_posts()) {
		// 	array_pop($ids1);
		// 	$count = $count-1;
		// 	foreach($sfpromotionsPosts->posts as $key => $sfpromotionspost) {
		// 		setup_postdata( $sfpromotionspost );
		// 		array_push($sfpromotionsarray,$sfpromotionspost);
		// 	}
		// }
		
		$additional_args['posts_per_page'] = $count;
		$postnew = new \WP_Query( $additional_args );
		if($postnew->have_posts()) {
			foreach($postnew->posts as $key => $post) {
				setup_postdata( $post );
				array_push($postarray,$post);
			}
		}

		array_splice($postarray,3,0,$perksarray);
		// array_splice($postarray,7,0,$sfpromotionsarray);

		$posts->posts = $postarray;
	}

	return $posts;
}

// featured-daily-tip-after
function featured_daily_tip_after() {
	get_template_part('templates/featured-daily-tip-after');
}
add_action( 'featured-daily-tip-after', 'featured_daily_tip_after');

function wpb_highlights_menu() {
    register_nav_menu('highlights-menu',__( 'Highlights Menu' ));
}
add_action( 'init', 'wpb_highlights_menu' );

function beauty_newsfeed_mid_callback( $args ) {
	// $content = '';

	if( $args[ 'page' ] == 1 ) {
		echo '<div class="featured-toggle-btn default">';
		echo '<div class="btn-group" id="status" data-toggle="buttons">';
		echo '<label class="btn btn-default btn-on active"><input type="radio" value="1" name="multifeatured_module[module_id][status]" checked="checked">WATCH US</label>';
		echo '<label class="btn btn-default btn-off"><input type="radio" value="2" name="multifeatured_module[module_id][status]">TRENDING</label>';
		echo '<div class="slide-btn"></div>';
		echo '</div>';
		echo '</div>';
		echo '<div class="col-md-12 col-sm-12 col-xs-12 pb-3 listItem featured-wrapper trending hidden">';
		echo do_shortcode( '[featured-articles]' );
		echo '</div>';
		echo '<div class="col-md-12 col-sm-12 col-xs-12 pb-3 listItem featured-wrapper watch-us">';
		echo do_shortcode( '[featured-articles pagename="featured-videos-configure"]' );
		echo '<div id="watch-us-more-btn">';
		echo '<a href="' . home_url() . '/video-tutorial" class="inter-bold" target="_blank">WATCH MORE</a>';
		echo '</div>';
		echo '</div>';
	}

	// echo $content;
}
 
add_action( 'beauty_newsfeed_mid', 'beauty_newsfeed_mid_callback' );

function wpb_mobile_docking_menu() {
    register_nav_menu('mobile-docking-menu',__( 'Mobile Docking Menu' ));
}
add_action( 'init', 'wpb_mobile_docking_menu' );


//add docking menu
function footer_docking_menu() {
	$menu_name = 'mobile-docking-menu'; // specify custom menu slug
    // $menu_list = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="docking-menu">' ."\n";
	// $menu_list .= '<div class="container-fluid justify-content-center">' ."\n";
	$menu_list = '<div id="docking-menu">' ."\n";
	$menu_list .= '<ul class="nav justify-content-center">' ."\n";

    if ( $menu_items = wp_get_nav_menu_items( $menu_name ) ) { 
        $count = 0;
        $submenu = false;
        $parent_id = 0;
        $previous_item_has_submenu = false;

        foreach ( (array)$menu_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$icon = get_field( 'icon', $menu_item->ID );

			switch ( strtolower( $menu_item->title ) ) {
				case 'facebook': $url = FB_LINK;
								 break;
				case 'instagram': $url = IG_LINK;
								 break;
			}

            // check if it's a top-level item
            if ( $menu_item->menu_item_parent == 0 ) {
				$parent_id = $menu_item->ID;
				// write the item but DON'T close the A or LI until we know if it has children!
				
				if ($title=='Discover') {
					$alt = "Discover more beauty articles";
				} elseif ($title=='Follow') {
					$alt = "Follow Daily Vanity";
				} elseif ($title=='Salon Finder') {
					$alt = "Salon Finder - Beauty Services";
				} else {
					$alt = $title;
				}
				
				$menu_list .= "\t". '<li class="nav-item"><a href="'. $url .'" class="nav-link parent-nav-link ' . strtolower( str_replace( ' ', '-', $title ) ) . '-btn" id="menu-' . $parent_id . '" target="_blank" title="' . $title . '" rel="noopener noreferrer"><img alt="'. $alt . '" src="' . $icon . '?v=' . DEPLOY_VERSION . '" class="parent-icon" id="' . strtolower( str_replace( ' ', '-', $title ) ) . '-icon" /><br/>'. $title;
				echo "<script>";
				echo "\tjQuery( document ).ready( function( $ ) { \n";
				echo "$('.cart-totals').text(Cookies.get('CARTCOUNT'))";
				echo '})' . "\n";
				echo "</script>";

				if( strtolower( $menu_item->title ) == 'cart' ) {
					$menu_list .= '<span class="cart-totals count">0</span></a>';
				} else {
					$menu_list .= '</a>';
				}
            }

            // if this item has a (nonzero) parent ID, it's a second-level (child) item
            else {
                if ( !$submenu ) { // first item
                    // add the dropdown arrow to the parent
                    // $menu_list .= '<span class="arrow-down"></span></a>' . "\n";
                    // start the child list
                    $submenu = true;
                    $previous_item_has_submenu = true;
                    $menu_list .= "\t\t" . '<ul id="submenu-' . $menu_item->menu_item_parent . '" class="submenu">' ."\n";
               }

                $menu_list .= "\t\t\t" . '<li>';

                $menu_list .= '<a href="'.$url.'" target="_blank" title="' . $title . '" rel="noopener noreferrer"><i class="'.$icon.'"></i></a>';

                $menu_list .= '</li>' ."\n";

                // if it's the last child, close the submenu code
                if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                    $menu_list .= "\t\t" . '</ul></li>' ."\n";
                    $submenu = false;
                }
            }

            // close the parent (top-level) item
            if (empty($menu_items[$count + 1]) || $menu_items[ $count + 1 ]->menu_item_parent != $parent_id )
            {
               if ($previous_item_has_submenu)
                {
                    // the a link and list item were already closed
                    $previous_item_has_submenu = false; //reset
                }
                else {
                    // close a link and list item
                    $menu_list .= "\t" . '</a></li>' . "\n";
                }
            }

            $count++;
        }
    } else {
         $menu_list .= '<!-- no list defined -->';
    }
    $menu_list .= "\t". '</ul>' ."\n";
    $menu_list .= "\t". '</div>' ."\n";
	// $menu_list .= "\t". '</nav>' ."\n";

	$menu_list .= <<<SD
		<script>
			jQuery( document ).ready( function( $ ) {
				$( ".follow-btn" ).on( "click", function( e ) {
					e.preventDefault();
					var thisID = this.id.split( '-' );
					var parentID = thisID[1];
					var childMenuID = 'submenu-' + parentID;
					
					if( $( "#" + childMenuID ).length ) {
						if( $( "#" + childMenuID ).is( ":hidden" ) ) {
							$( "#" + childMenuID ).fadeIn( "slow" );
							$( "#" + this.id ).css( 'background-color', '#333333' );
						} else {
							$( "#" + childMenuID ).fadeOut( "fast" );
							$( "#" + this.id ).css( 'background-color', '#707070' );
						}
					}
				} );
			} );
		</script>
	SD;

    echo $menu_list;
}
add_action('body_div_after', 'footer_docking_menu', 20);

if(!defined( 'DOING_CRON' )) {
	//add_action('init', 'start_session', 1);
}

function start_session() {
	if(!session_id()) {
		session_start();
	}
}

function end_session() {
	session_destroy ();
}

add_action("wp_ajax_ajaxLoadMorePerks", "load_more_perks");
add_action("wp_ajax_nopriv_ajaxLoadMorePerks", "load_more_perks");

function load_more_perks() {
	// if ( !wp_verify_nonce( $_POST['load_more_perks_nonce'], "wp_nonce" ) ) {
	// 	exit( "Something Went Wrong!" );
	// }
	echo do_shortcode( '[perks post_status="' . $_POST['post_status'] . '" title="0" posts_per_page="' . $_POST['posts_per_page'] . '" paged="' . $_POST['pageno'] . '"]' );

	die();
}

function featured_daily_tips_before_caption_callback() {
	$content = '';

	$content .= '<div class="row no-gutters">';
	$content .= '<div class="col more-beauty-tips">';
	// $content .= '<div id="more-beauty-tips" class="inter-bold">';
	$content .= '<a href="' . home_url() . '/beauty-tips/" target="_blank" class="inter-bold more-beauty-tips-border">MORE BEAUTY TIPS &#8594;</a>';
	// $content .= '</div>';
	$content .= '</div>';
	$content .= '</div>';

	echo $content;
}

add_action( 'featured-daily-tips-before-caption', 'featured_daily_tips_before_caption_callback' );

// create menu for top header black bar

function wpb_top_header_bk_bar_menu() {
    register_nav_menu('top-header-bk-bar-menu',__( 'Top Header Black Bar Menu' ));
}
add_action( 'init', 'wpb_top_header_bk_bar_menu' );

function top_header_bar_before_callback() {
	$content = '';

	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations[ 'top-header-bk-bar-menu' ] );
	$menu_items = wp_get_nav_menu_items( $menu->term_id );

	// print_r( wp_get_nav_menu_object( $locations[ 'top-header-bk-bar-menu' ] ) );

	$content .= "<div class='container-fluid fixed-top top-header-bk-bar'>\n";
	$content .= "\t<div class='row no-gutters'>\n";
	$content .= "\t\t<div class='col'>\n";
	$content .= "\t\t\t<div class='container'>\n";
	$content .= "\t\t\t\t<div class='row no-gutters'>\n";
	$content .= "\t\t\t\t\t<div class='col'>\n";

    if ( $menu_items ) { 
		$content .= "\t\t\t\t\t\t<ul class='nav justify-content-end align-items-center'>\n";

        foreach ( (array)$menu_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;

			$content .= "\t\t\t\t\t\t\t" . '<li class="nav-item"><a href="'. $url .'" class="nav-link ' . strtolower( str_replace( ' ', '-', $title ) ) . '" target="_blank" rel="noopener noreferrer">' . $title . '</a></li>' . "\n";
        }
		
		$content .= "\t\t\t\t\t\t</ul>\n";
    }

	$content .= "\t\t\t\t\t</div>\n";
	$content .= "\t\t\t\t</div>\n";
	$content .= "\t\t\t</div>\n";
	$content .= "\t\t</div>\n";
	$content .= "\t</div>\n";
	$content .= "</div>\n";

	echo $content;
}

add_action( 'top_header_bar_before', 'top_header_bar_before_callback', 20 );


/* 
 * -------------------------------------------------------------------
 * 
 * 						Migrated from old themes
 * 
 * -------------------------------------------------------------------
*/


/*  Custom Post Types  */

function cptui_register_my_cpts() {

	/**
	 * Post Type: Perks.
	 */

	$labels = [
		"name" => __( "Perks" ),
		"singular_name" => __( "Perk" ),
	];

	$args = [
		"label" => __( "Perks" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "deal", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "deal", $args );

	/**
	 * Post Type: Beauty Tips.
	 */

	$labels = [
		"name" => __( "Beauty Tips" ),
		"singular_name" => __( "Beauty Tip" ),
	];

	$args = [
		"label" => __( "Beauty Tips" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "beautytips",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "beautytips", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title" ],
	];

	register_post_type( "beautytips", $args );

	/**
	 * Post Type: Ads Banners.
	 */

// 	$labels = [
// 		"name" => __( "Ads Banners" ),
// 		"singular_name" => __( "Ads Banner" ),
// 	];

// 	$args = [
// 		"label" => __( "Ads Banners" ),
// 		"labels" => $labels,
// 		"description" => "",
// 		"public" => true,
// 		"publicly_queryable" => false,
// 		"show_ui" => true,
// 		"show_in_rest" => false,
// 		"rest_base" => "",
// 		"rest_controller_class" => "WP_REST_Posts_Controller",
// 		"has_archive" => false,
// 		"show_in_menu" => true,
// 		"show_in_nav_menus" => true,
// 		"delete_with_user" => false,
// 		"exclude_from_search" => true,
// 		"capability_type" => "post",
// 		"map_meta_cap" => true,
// 		"hierarchical" => false,
// 		"rewrite" => [ "slug" => "ad_banners", "with_front" => true ],
// 		"query_var" => true,
// 	];

// 	register_post_type( "ad_banners", $args );

	/**
	 * Post Type: Radiant Skin.
	 */

// 	$labels = [
// 		"name" => __( "Radiant Skin" ),
// 		"singular_name" => __( "Radiant Skins" ),
// 	];

// 	$args = [
// 		"label" => __( "Radiant Skin" ),
// 		"labels" => $labels,
// 		"description" => "",
// 		"public" => true,
// 		"publicly_queryable" => true,
// 		"show_ui" => true,
// 		"show_in_rest" => true,
// 		"rest_base" => "",
// 		"rest_controller_class" => "WP_REST_Posts_Controller",
// 		"has_archive" => true,
// 		"show_in_menu" => true,
// 		"show_in_nav_menus" => true,
// 		"delete_with_user" => false,
// 		"exclude_from_search" => true,
// 		"capability_type" => "post",
// 		"map_meta_cap" => true,
// 		"hierarchical" => false,
// 		"rewrite" => [ "slug" => "get-radiant-skin", "with_front" => true ],
// 		"query_var" => true,
// 		"supports" => [ "title", "editor", "thumbnail" ],
// 	];

// 	register_post_type( "get_radiant_skin", $args );

	/**
	 * Post Type: K-Makeup Tips.
	 */

// 	$labels = [
// 		"name" => __( "K-Makeup Tips" ),
// 		"singular_name" => __( "K-Makeup Tip" ),
// 		"menu_name" => __( "K-Makeup" ),
// 		"all_items" => __( "All K-Makeup Tips" ),
// 		"add_new_item" => __( "Add New K-Makeup Tip" ),
// 	];

// 	$args = [
// 		"label" => __( "K-Makeup Tips" ),
// 		"labels" => $labels,
// 		"description" => "",
// 		"public" => true,
// 		"publicly_queryable" => true,
// 		"show_ui" => true,
// 		"show_in_rest" => true,
// 		"rest_base" => "k-makeup-tips",
// 		"rest_controller_class" => "WP_REST_Posts_Controller",
// 		"has_archive" => true,
// 		"show_in_menu" => true,
// 		"show_in_nav_menus" => true,
// 		"delete_with_user" => false,
// 		"exclude_from_search" => true,
// 		"capability_type" => "post",
// 		"map_meta_cap" => true,
// 		"hierarchical" => false,
// 		"rewrite" => [ "slug" => "k-makeup-tips", "with_front" => true ],
// 		"query_var" => true,
// 		"supports" => [ "title", "editor", "thumbnail", "excerpt", "revisions", "author", "page-attributes", "post-formats" ],
// 		"taxonomies" => [ "tips" ],
// 	];

// 	register_post_type( "k_makeup_tips", $args );

	/**
	 * Post Type: Article Insertions.
	 */

	$labels = [
		"name" => __( "Article Insertions" ),
		"singular_name" => __( "Article Insertion" ),
	];

	$args = [
		"label" => __( "Article Insertions" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "article_insertion", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "article_insertion", $args );

	/**
	 * Post Type: Top 10s.
	 */

// 	$labels = [
// 		"name" => __( "Top 10s" ),
// 		"singular_name" => __( "Top 10" ),
// 	];

// 	$args = [
// 		"label" => __( "Top 10s" ),
// 		"labels" => $labels,
// 		"description" => "",
// 		"public" => true,
// 		"publicly_queryable" => true,
// 		"show_ui" => true,
// 		"show_in_rest" => true,
// 		"rest_base" => "",
// 		"rest_controller_class" => "WP_REST_Posts_Controller",
// 		"has_archive" => true,
// 		"show_in_menu" => true,
// 		"show_in_nav_menus" => true,
// 		"delete_with_user" => false,
// 		"exclude_from_search" => true,
// 		"capability_type" => "page",
// 		"map_meta_cap" => true,
// 		"hierarchical" => true,
// 		"rewrite" => [ "slug" => "top10best", "with_front" => true ],
// 		"query_var" => true,
// 		"supports" => [ "title", "editor", "thumbnail" ],
// 	];

// 	register_post_type( "top10best", $args );

	/**
	 * Post Type: Advertiser  Services.
	 */

// 	$labels = [
// 		"name" => __( "Advertiser  Services" ),
// 		"singular_name" => __( "advertiser service" ),
// 	];

// 	$args = [
// 		"label" => __( "Advertiser  Services" ),
// 		"labels" => $labels,
// 		"description" => "",
// 		"public" => true,
// 		"publicly_queryable" => true,
// 		"show_ui" => true,
// 		"show_in_rest" => true,
// 		"rest_base" => "",
// 		"rest_controller_class" => "WP_REST_Posts_Controller",
// 		"has_archive" => true,
// 		"show_in_menu" => true,
// 		"show_in_nav_menus" => true,
// 		"delete_with_user" => false,
// 		"exclude_from_search" => false,
// 		"capability_type" => "post",
// 		"map_meta_cap" => true,
// 		"hierarchical" => true,
// 		"rewrite" => [ "slug" => "advertiser_services", "with_front" => true ],
// 		"query_var" => true,
// 		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
// 		"taxonomies" => [ "post_tag" ],
// 	];

// 	register_post_type( "advertiser_services", $args );

	/**
	 * Post Type: Products.
	 */

// 	$labels = [
// 		"name" => __( "Products" ),
// 		"singular_name" => __( "Product" ),
// 	];

// 	$args = [
// 		"label" => __( "Products" ),
// 		"labels" => $labels,
// 		"description" => "",
// 		"public" => true,
// 		"publicly_queryable" => true,
// 		"show_ui" => true,
// 		"show_in_rest" => false,
// 		"rest_base" => "",
// 		"rest_controller_class" => "WP_REST_Posts_Controller",
// 		"has_archive" => false,
// 		"show_in_menu" => true,
// 		"show_in_nav_menus" => true,
// 		"delete_with_user" => false,
// 		"exclude_from_search" => false,
// 		"capability_type" => "post",
// 		"map_meta_cap" => true,
// 		"hierarchical" => false,
// 		"rewrite" => [ "slug" => "products", "with_front" => true ],
// 		"query_var" => true,
// 		"supports" => [ "title", "editor", "thumbnail" ],
// 	];

// 	register_post_type( "products", $args );

	/**
	 * Post Type: Galleries.
	 */

	$labels = [
		"name" => __( "Galleries" ),
		"singular_name" => __( "gallery" ),
	];

	$args = [
		"label" => __( "Galleries" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "galleries", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "galleries", $args );

	/**
	 * Post Type: Listicle Random Contents.
	 */

	$labels = [
		"name" => __( "Listicle Random Contents" ),
		"singular_name" => __( "Listicle Random Contents" ),
	];

	$args = [
		"label" => __( "Listicle Random Contents" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
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
		"rewrite" => [ "slug" => "listicle", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "listicle", $args );

	/**
	 * Post Type: DVBA 2020 Winners.
	 */

	$labels = [
		"name" => __( "DVBA 2020 Winners" ),
		"singular_name" => __( "DVBA 2020 Winner" ),
	];

	$args = [
		"label" => __( "DVBA 2020 Winners" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "dvba_2020_winners", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "dvba_2020_winners", $args );

	/**
	 * Post Type: Spa And Hair Awards 2020.
	 */

	$labels = [
		"name" => __( "Spa And Hair Awards 2020" ),
		"singular_name" => __( "Spa And Hair Awards 2020" ),
	];

	$args = [
		"label" => __( "Spa And Hair Awards 2020" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
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
		"rewrite" => [ "slug" => "dvsha_2020_listing", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
	];

	register_post_type( "dvsha_2020_listing", $args );


	/**
	 * Post Type: DVBA 2021 Winners.
	 */

	$labels = [
		"name" => __( "DVBA 2021 Winners" ),
		"singular_name" => __( "DVBA 2021 Winner" ),
	];

	$args = [
		"label" => __( "DVBA 2021 Winners" ),
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
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "dvba_2021_listing", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "dvba_2021_listing", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Tips.
	 */

	$labels = [
		"name" => __( "Tips" ),
		"singular_name" => __( "Tip" ),
		"menu_name" => __( "Tips" ),
		"all_items" => __( "All Tips" ),
		"edit_item" => __( "Edit Tip" ),
		"view_item" => __( "View Tip" ),
		"update_item" => __( "Update Tip" ),
		"add_new_item" => __( "Add New Tip" ),
		"new_item_name" => __( "Add Tip" ),
	];

	$args = [
		"label" => __( "Tips" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => false,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'tips', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "tips",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		];
	register_taxonomy( "tips", [ "k-makeup-tips" ], $args );

	/**
	 * Taxonomy: Brands.
	 */

	$labels = [
		"name" => __( "Brands" ),
		"singular_name" => __( "Brand" ),
	];

	$args = [
		"label" => __( "Brands" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'brands', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "brands",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "brands", [ "product" ], $args );

	/**
	 * Taxonomy: For Who.
	 */

	$labels = [
		"name" => __( "For Who" ),
		"singular_name" => __( "For Who" ),
	];

	$args = [
		"label" => __( "For Who" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'who', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "who",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "who", [ "alliwantforxmas" ], $args );

	/**
	 * Taxonomy: Categories.
	 */

	$labels = [
		"name" => __( "Categories" ),
		"singular_name" => __( "Category" ),
	];

	$args = [
		"label" => __( "Categories" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'radiant_skin_category', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "radiant_skin_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "radiant_skin_category", [ "get_radiant_skin" ], $args );

	/**
	 * Taxonomy: Best Categories.
	 */

	$labels = [
		"name" => __( "Best Categories" ),
		"singular_name" => __( "Best Category" ),
	];

	$args = [
		"label" => __( "Best Categories" ),
		"labels" => $labels,
		"public" => false,
		"publicly_queryable" => false,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'bestcategories', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "bestcategories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "bestcategories", [ "top10best" ], $args );

	/**
	 * Taxonomy: Categories.
	 */

	$labels = [
		"name" => __( "Categories" ),
		"singular_name" => __( "Category" ),
	];

	$args = [
		"label" => __( "Categories" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvsha_2018_categories', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "dvsha_2018_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvsha_2018_categories", [ "spa_and_hair_awards" ], $args );

	/**
	 * Taxonomy: Brands.
	 */

	$labels = [
		"name" => __( "Brands" ),
		"singular_name" => __( "Brand" ),
	];

	$args = [
		"label" => __( "Brands" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'gift_finder_brand', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "gift_finder_brand",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "gift_finder_brand", [ "gift_finder_2018", "gift_finder_2019" ], $args );

	/**
	 * Taxonomy: Types.
	 */

	$labels = [
		"name" => __( "Types" ),
		"singular_name" => __( "Type" ),
	];

	$args = [
		"label" => __( "Types" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'gift_finder_type', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "gift_finder_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "gift_finder_type", [ "gift_finder_2018", "gift_finder_2019" ], $args );

	/**
	 * Taxonomy: For Who.
	 */

	$labels = [
		"name" => __( "For Who" ),
		"singular_name" => __( "For Who" ),
	];

	$args = [
		"label" => __( "For Who" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'gift_finder_for_who', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "gift_finder_for_who",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "gift_finder_for_who", [ "gift_finder_2018", "gift_finder_2019" ], $args );

	/**
	 * Taxonomy: Listicle Groups.
	 */

	$labels = [
		"name" => __( "Listicle Groups" ),
		"singular_name" => __( "Listicle Group" ),
	];

	$args = [
		"label" => __( "Listicle Groups" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'listicle_group', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "listicle_group",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "listicle_group", [ "listicle" ], $args );

	/**
	 * Taxonomy: DVBA 2019 Categories.
	 */

	$labels = [
		"name" => __( "DVBA 2019 Categories" ),
		"singular_name" => __( "DVBA 2019 Category" ),
	];

	$args = [
		"label" => __( "DVBA 2019 Categories" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvba_2019_categories', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "dvba_2019_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvba_2019_categories", [ "dvba_2019_winners" ], $args );

	/**
	 * Taxonomy: Spa And Hair Awards 2019 Categories.
	 */

	$labels = [
		"name" => __( "Spa And Hair Awards 2019 Categories" ),
		"singular_name" => __( "Spa And Hair Awards 2019 Category" ),
	];

	$args = [
		"label" => __( "Spa And Hair Awards 2019 Categories" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvsha_2019_categories', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "dvsha_2019_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvsha_2019_categories", [ "dvsha_2019" ], $args );

	/**
	 * Taxonomy: Price Ranges.
	 */

	$labels = [
		"name" => __( "Price Ranges" ),
		"singular_name" => __( "Price Range" ),
	];

	$args = [
		"label" => __( "Price Ranges" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'gift_finder_price_range', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "gift_finder_price_range",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "gift_finder_price_range", [ "gift_finder_2019" ], $args );

/**
	 * Taxonomy: DVBA 2020 Categories.
	 */

	$labels = [
		"name" => __( "DVBA 2020 Categories" ),
		"singular_name" => __( "DVBA 2020 Category" ),
	];

	$args = [
		"label" => __( "DVBA 2020 Categories" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvba_2020_categories', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "dvba_2020_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvba_2020_categories", [ "dvba_2020_winners" ], $args );

	/**
	 * Taxonomy: DVSHA 2020 Categories.
	 */

	$labels = [
		"name" => __( "DVSHA 2020 Categories" ),
		"singular_name" => __( "DVSHA 2020 Category" ),
	];

	$args = [
		"label" => __( "DVSHA 2020 Categories" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvsha_2020_categories', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "dvsha_2020_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvsha_2020_categories", [ "dvsha_2020_listing" ], $args );

	/**
	 * Taxonomy: DVSHA 2020 Brands.
	 */

	$labels = [
		"name" => __( "DVSHA 2020 Brands" ),
		"singular_name" => __( "DVSHA 2020 Brand" ),
	];

	$args = [
		"label" => __( "DVSHA 2020 Brands" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvsha_2020_brands', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "dvsha_2020_brands",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvsha_2020_brands", [ "dvsha_2020_listing" ], $args );

	/**
	 * Taxonomy: DVBA 2021 Brands.
	 */

	$labels = [
		"name" => __( "DVBA 2021 Brands" ),
		"singular_name" => __( "DVBA 2021 Brand" ),
	];

	$args = [
		"label" => __( "DVBA 2021 Brands" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvba_2021_brands', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvba_2021_brands",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvba_2021_brands", [ "dvba_2021_listing" ], $args );

	/**
	 * Taxonomy: DVBA 2021 Categories.
	 */

	$labels = [
		"name" => __( "DVBA 2021 Categories" ),
		"singular_name" => __( "DVBA 2021 Category" ),
	];

	$args = [
		"label" => __( "DVBA 2021 Categories" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvba_2021_categories', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvba_2021_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvba_2021_categories", [ "dvba_2021_listing" ], $args );

	/**
	 * Taxonomy: DVBA 2021 Price Ranges.
	 */

	$labels = [
		"name" => __( "DVBA 2021 Price Ranges" ),
		"singular_name" => __( "DVBA 2021 Price Range" ),
	];

	$args = [
		"label" => __( "DVBA 2021 Price Ranges" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvba_2021_price_range', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvba_2021_price_range",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvba_2021_price_range", [ "dvba_2021_listing" ], $args );

	/**
	 * Taxonomy: DVBA 2021 Award Tiers.
	 */

	$labels = [
		"name" => __( "DVBA 2021 Award Tiers" ),
		"singular_name" => __( "DVBA 2021 Award Tier" ),
	];

	$args = [
		"label" => __( "DVBA 2021 Award Tiers" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvba_2021_award_tiers', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvba_2021_award_tiers",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		];
	register_taxonomy( "dvba_2021_award_tiers", [ "dvba_2021_listing" ], $args );

	/**
	 * Taxonomy: DVBA 2021 Skin Types.
	 */

	$labels = [
		"name" => __( "DVBA 2021 Skin Types" ),
		"singular_name" => __( "DVBA 2021 Skin Type" ),
	];

	$args = [
		"label" => __( "DVBA 2021 Skin Types" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvba_2021_skin_types', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvba_2021_skin_types",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvba_2021_skin_types", [ "dvba_2021_listing" ], $args );

	/**
	 * Taxonomy: DVBA 2021 Skin Concerns.
	 */

	$labels = [
		"name" => __( "DVBA 2021 Skin Concerns" ),
		"singular_name" => __( "DVBA 2021 Skin Concern" ),
	];

	$args = [
		"label" => __( "DVBA 2021 Skin Concerns" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvba_2021_skin_concerns', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvba_2021_skin_concerns",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvba_2021_skin_concerns", [ "dvba_2021_listing" ], $args );

	/**
	 * Taxonomy: DVBA 2021 Hair Types & Concerns.
	 */

	$labels = [
		"name" => __( "DVBA 2021 Hair Types & Concerns" ),
		"singular_name" => __( "DVBA 2021 Hair Type & Concern" ),
	];

	$args = [
		"label" => __( "DVBA 2021 Hair Types & Concerns" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dvba_2021_hair_types_concerns', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvba_2021_hair_types_concerns",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "dvba_2021_hair_types_concerns", [ "dvba_2021_listing" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );

/*  Functions  */



/**
 * Adds a submenu page under a custom post type parent.
 */
function dvsha_2020_promo_signup_admin_add_submenus(){
    add_submenu_page('edit.php?post_type=dvsha_2020_listing', 'DVSHA 2020 Promotion Signup Entries', 'DVSHA 2020 Promotion Signup', 'manage_options', 'dvsha_2020_promo_signup', 'dvsha_2020_promo_signup_page_callback');
}
add_action('admin_menu', 'dvsha_2020_promo_signup_admin_add_submenus');

function am_enqueue_admin_styles(){

    wp_register_style( 'am_admin_bootstrap', home_url() . '/wp-admin/css/bootstrap.min.css' );
    wp_enqueue_style( 'am_admin_bootstrap');

}

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

add_action( 'admin_enqueue_scripts', 'am_enqueue_admin_styles' );

if ( !function_exists( 'paginate_links' ) ) { 
    require_once ABSPATH . WPINC . '/general-template.php'; 
} 
 
/**
 * Display callback for the submenu page.
 */
function dvsha_2020_promo_signup_page_callback() { 
	global $wpdb;

	echo '<h1>DVSHA 2020 Promotion Signup</h1>';

	$pageNo = 1;

	if ( isset( $_GET['pageno'] ) ) {
		$pageNo = $_GET['pageno'];
	}

	$perpage = 10;

	$offset = ( $pageNo - 1 ) * $perpage;

	$dbTbl = 'wp_dvsha_2020_promo_subscriber';

	$totalRec = get_record_count( $dbTbl );

	$totalPages = ceil( $totalRec / $perpage );
	
	echo '<style>';
	echo '.table { ';
	echo 'width: 99%; ';
	// echo 'margin-top: 20px; ';
	// echo 'border-top: 1px solid #000; ';
	// echo 'border-left: 1px solid #000; ';
	echo '} ';
	echo '.table th { ';
	echo 'font-size: 0.9rem;' ;
	echo 'text-align: center; ';
	echo '} ';
	echo '.table td { ';
	echo 'font-size: 0.75rem;' ;
	echo '} ';
	echo '</style>';

	echo '<p><a href="#" id="export-data" class="button button-primary">Download Excel</a></p>';

	echo '<script> ';
	echo 'jQuery( "#export-data" ).click( function( e ) { ';
	echo 'e.preventDefault(); ';
	// echo 'jQuery( ".loader_slh" ).show(); ';
	echo 'var d = new Date(); ';
	echo 'var month = d.getMonth()+1; ';
	echo 'var day = d.getDate(); ';
	echo 'var today = d.getFullYear() + "_" + ( ( ""+month ).length<2 ? "0" : "" ) + month + "_" + ( ( ""+day ).length<2 ? "0" : "" ) + day; ';
	echo 'var filename = "DVSHA_2020_promo_entry_list_" + today + ".csv"; ';
	echo 'jQuery.ajax( { ';
	echo 'type : "post", ';
	echo 'dataType : "json", ';
	echo 'url : "admin-ajax.php", ';
	echo 'data : { action: "export_dvsha_2020_promo_list_to_xls", filename: filename }, ';
	echo 'success: function( response ) { ';
	// echo 'console.log( response ); ';
	// echo 'jQuery( ".loader_slh" ).hide(); ';
	echo 'window.open( "' . get_admin_url() . '" + filename, "_blank"); ';
	echo '} ';
	echo '} ); ';
	echo '} ); ';
	echo '</script>';

	$page_links = paginate_links( array(
		'base' => add_query_arg( 'pageno', '%#%' ),
		'format' => '',
		'show_all' => true,
		'prev_text' => __('&laquo; Prev'),
		'next_text' => __('Next &raquo;'),
		'total' => $totalPages,
		'current' => $pageNo
	) );

	$cnt = $offset;
	$start = $cnt+1;
	$end = $cnt+$perpage;

	if ( $page_links ) {
		echo '<div class="tablenav" style="width: 99%;"><div class="tablenav-pages" style="margin: 1em 0;">Total Entries ' . $totalRec . ', Page ' . $pageNo . ' of ' . $totalPages . ' | ' . $page_links . '</div></div>';
	}
	
	echo '<div class="table-responsive"> ';
	echo '<table class="table table-bordered table-striped">';
	echo '<tr>';
	echo '<th>No.</th>';
	echo '<th style="width:14%;">Full Name</th>';
	echo '<th style="width:19%;">Email</th>';
	echo '<th style="width:9%;">Mobile No.</th>';
	echo '<th style="width:5%;">Gender</th>';
	echo '<th style="width:20%;">Service</th>';
	echo '<th style="width:17%;">Outlet(s)</th>';
	echo '<th style="width:15%;">Preferred Method Of Contact</th>';
	echo '<th>Submitted On</th>';
	echo '</tr>';

	$results = get_promo_entry( $dbTbl, $offset, $perpage );

	$item = $offset+1;

	if( $results ) {
		foreach( $results as $result ) {
			// print_r( get_post( $data['term_id'] ) );
			echo '<tr>';
			echo '<td>' . $item . '</td>';
			echo $result->fullName?'<td>' . $result->fullName . '</td>':'<td>-</td>';
			echo $result->email?'<td>' . $result->email . '</td>':'<td>-</td>';
			echo $result->contact?'<td>' . $result->contact . '</td>':'<td>-</td>';
			echo $result->gender?'<td>' . ucfirst( $result->gender ) . '</td>':'<td>-</td>';

			$service = get_post( $result->term_id );
			echo $result->term_id?'<td>' . $service->post_title . '</td>':'<td>-</td>';
			echo $result->outlets?'<td>' . $result->outlets . '</td>':'<td>-</td>';
			echo $result->preferredContact?'<td>' . $result->preferredContact . '</td>':'<td>Any of the method</td>';
			echo $result->createdAt?'<td>' . date_i18n( get_option( 'date_format' ), $result->createdAt ) . '</td>':'<td>-</td>';
			echo '</tr>';

			$item++;
		}
	}

	echo '</table>';
	echo '</div>';

	if ( $page_links ) {
		echo '<div class="tablenav" style="width: 99%;"><div class="tablenav-pages" style="margin: 1em 0;">Total Entries ' . $totalRec . ', Page ' . $pageNo . ' of ' . $totalPages . ' | ' . $page_links . '</div></div>';
	}
}

function get_record_count( $dbTbl ) {
	global $wpdb;

	$query = $wpdb->prepare( "SELECT COUNT(*) FROM `" . $dbTbl . "` WHERE term_id > 0 AND fullName <> ''" );
	$totalRec = $wpdb->get_var( $query );

	return $totalRec;
}

function get_promo_entry( $dbTbl, $offset, $perpage ) {
	global $wpdb;

	$query = $wpdb->prepare( "SELECT * FROM `" . $dbTbl . "` WHERE term_id > 0 AND fullName <> '' ORDER BY `createdAt` DESC LIMIT " . $offset . ", " . $perpage );
	$results = $wpdb->get_results( $query );

	// print_r( $wpdb->last_result );

	return $results;
}

add_action( 'wp_ajax_export_dvsha_2020_promo_list_to_xls', 'export_dvsha_2020_promo_list_to_xls' );
add_action( 'wp_ajax_nopriv_export_dvsha_2020_promo_list_to_xls', 'export_dvsha_2020_promo_list_to_xls' );

function export_dvsha_2020_promo_list_to_xls() {
	global $wpdb;

	// $filename = "DVSHA_2020_nomination_" . date( "Y_m_d", time() ) . ".csv";
	$filename = $_POST[ 'filename' ];

	$fp = fopen( $filename, 'w' );

	$dbTbl = 'wp_dvsha_2020_promo_subscriber';

	$query = $wpdb->prepare( "SELECT * FROM `" . $dbTbl . "`" );
	$results = $wpdb->get_results( $query );

	$count = 1;

	if( $results ) {

		$header = ["#","Full Name","Email","Mobile No.","Gender","Service","Outlets","Preferred Method Of Contact","Submitted On"];

		fputcsv($fp, $header);	

		foreach( $results as $result ) {
			$body = [];
			$body[] = $count;
			$body[] = str_replace( "\\", "", $result->fullName );

			if( $result->email ) {
				$body[] = $result->email;
			} else {
				$body[] = '-';
			}

			if( $result->contact ) {
				$body[] = $result->contact;
			} else {
				$body[] = '-';
			}

			if( $result->gender ) {
				$body[] = ucfirst( $result->gender );
			} else {
				$body[] = '-';
			}

			$service = get_post( $result->term_id );

			if( $result->term_id ) {
				$body[] = $service->post_title;
			} else {
				$body[] = '-';
			}

			if( $result->outlets ) {
				$body[] = $result->outlets;
			} else {
				$body[] = '-';
			}

			if( $result->preferredContact ) {
				$body[] = $result->preferredContact;
			} else {
				$body[] = 'Any of the method';
			}

			$body[] = date( 'd/m/y H:i:s', $result->createdAt ) . "\r\n";

			$count++;

			fputcsv( $fp, $body );
		}
	}
	
	$body = [];
	$body[] = "";
	$body[] = "";
	$body[] = "";
	$body[] = "";
	
	fputcsv( $fp, $body );
	
	fclose( $fp );

	// fputcsv( $fp, $body );
	// fclose( $fp );
	// header("Content-Type: text/csv; charset=UTF-8");
	// header( 'Content-Description: File Transfer' );
	// header( 'Content-Type: application/octet-stream' );
	// header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
	// header( 'Expires: 0' );
	// header( 'Cache-Control: must-revalidate' );
	// header( 'Pragma: public' );
	// header( 'Content-Length: ' . filesize( $filename ) );
	// flush(); // Flush system output buffer
	// readfile( $filename );
	// wp_die();

	$response = array();

	$response[ 'status' ] = '200';
	$response[ 'filename' ] = $filename;

    echo json_encode( $response );
	wp_die();
}



function form_function( $atts = array(), $content = null ) {
	extract( shortcode_atts( array(
		'name' => 'dvsha_2020_form',
		'method' => 'POST',
		'action' => get_home_url().'/best-spa-hair-facials-treatments/thankyou'
	), $atts ) );

	// $formBody = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> ';
	// $formBody .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script> ';
	// $formBody .= '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> ';

	$formBody .= '<form method="' . $method . '" action="' . $action . '" name="' . $name . '" id="' . $name . '">';
	$formBody .= do_shortcode( $content );
	$formBody .= '<input type="hidden" name="term_id" value="' . $_REQUEST[ 'term_id' ] . '" />';
	$formBody .= '<button type="submit" class="btn btn-primary pink-btn">Submit</button><br/>';
	$formBody .= '</form>';

	return $formBody;
}

add_shortcode( 'form', 'form_function' );

function fullname_function() {

	   $fullnameBody = '<div class="form-group">';
	   $fullnameBody .= '<label for="fullname" class="main-label" id="fullname-label">FULL NAME <span class="required-field"><sup>*</sup></span></label>';
	   $fullnameBody .= '<input type="text" class="form-control" id="fullname" name="fullname">';
	   $fullnameBody .= '</div>';

	return $fullnameBody;
}

add_shortcode( 'fullname', 'fullname_function' );

function email_function() {

	   $emailBody = '<div class="form-group">';
	   $emailBody .= '<label for="email" class="main-label" id="email-label">EMAIL <span class="required-field"><sup>*</sup></span></label>';
	   $emailBody .= '<input type="text" class="form-control" id="email" name="email">';
	   $emailBody .= '</div>';

	return $emailBody;
}

add_shortcode( 'email', 'email_function' );

function contact_function() {

	   $contactBody = '<div class="form-group">';
	   $contactBody .= '<label for="contact" class="main-label" id="contact-label">CONTACT NUMBER <span class="required-field"><sup>*</sup></span></label>';
	   $contactBody .= '<input type="text" class="form-control" id="contact" name="contact">';
	   $contactBody .= '</div>';

	return $contactBody;
}

add_shortcode( 'contact', 'contact_function' );

function gender_function() {

	$genderBody = '<div class="form-group">';
	$genderBody .= '<label for="gender" class="main-label" id="gender-label">GENDER <span class="required-field"><sup>*</sup></span></label> ';
	$genderBody .= '<div class="form-check">';
	$genderBody .= '<input class="form-check-input" type="radio" name="gender[]" id="gender_male" value="male" checked>';
	$genderBody .= '<label class="form-check-label" for="gender_male">Male</label>';
	$genderBody .= '</div>';
	$genderBody .= '<div class="form-check">';
	$genderBody .= '<input class="form-check-input" type="radio" name="gender[]" id="gender_female" value="female">';
	$genderBody .= '<label class="form-check-label" for="gender_female">Female</label>';
	$genderBody .= '</div>';
    $genderBody .= '</div>';

	return $genderBody;
}

add_shortcode( 'gender', 'gender_function' );

function outlet_function( $atts = array() ) {
	extract( shortcode_atts( array(
		'lists' => 'No Outlet',
	), $atts ) );

	// print_r( $atts );

	$outletArr = explode( ',', $lists );

	$outletBody = '<div class="form-group">';
	$outletBody .= '<label for="outlet" class="main-label" id="outlet-label">OUTLETS <span class="required-field"><sup>*</sup></span></label>';

	foreach( $outletArr as $outlet ) {
		$outletBody .= '<div class="form-check">';
		$outletBody .= '<input class="form-check-input" type="checkbox" value="' . $outlet . '" name="outlets[]" id="' . preg_replace('/\s+/', '-', strtolower( $outlet ) ) . '">';
		$outletBody .= '<label class="form-check-label" for="' . preg_replace('/\s+/', '-', strtolower( $outlet ) ) . '">' . $outlet . '</label>';
		$outletBody .= '</div>';
	}

	$outletBody .= '</div>';

	return $outletBody;
}

add_shortcode( 'outlet', 'outlet_function' );

function preferred_contact_function() {
	// extract( shortcode_atts( array(
	// 	'lists' => 'No Outlet',
	// ), $atts ) );

	// print_r( $atts );

	$preferredContactArr = [ 'Any of the method', 'SMS', 'WhatsApp', 'Call', 'Email' ];

	$preferredContactBody = '<div class="form-group">';
	$preferredContactBody .= '<label for="preferred-call" class="main-label" id="preferred-call-label">PREFERRED METHOD OF CONTACT <span class="required-field"><sup>*</sup></span></label>';

	foreach( $preferredContactArr as $k => $v ) {
		if( $k == 0 ) {
			$default = 'checked';
		} else {
			$default = '';
		}

		$preferredContactBody .= '<div class="form-check">';
		$preferredContactBody .= '<input class="form-check-input" type="checkbox" value="' . $k . '" name="preferredContact[]" id="method-' . strtolower( $v ) . '" ' . $default . '>';
		$preferredContactBody .= '<label class="form-check-label" for="' . strtolower( $v ) . '">' . $v . '</label>';
		$preferredContactBody .= '</div>';
	}

	$preferredContactBody .= '</div>';

	return $preferredContactBody;
}

add_shortcode( 'preferredcontact', 'preferred_contact_function' );

function check_dvsha_email_callback() {
    global $wpdb;

	$email = $_POST[ 'email' ];
	$term_id = $_POST['term_id'];
	
	$exist = $wpdb->get_var( "SELECT * FROM wp_dvsha_2020_promo_subscriber WHERE email='" . $email . "' AND term_id=" . $term_id );

	if( $exist ) {
		echo 'true';
	} else {
		echo 'false';
	}

    die(); // this is required to return a proper result
}

add_action('wp_ajax_check_dvsha_email', 'check_dvsha_email_callback');
add_action('wp_ajax_nopriv_check_dvsha_email', 'check_dvsha_email_callback');

function check_dvsha_contact_callback() {
    global $wpdb;

	$contact = str_replace( '+65', '', $_POST[ 'contact' ] );
	$term_id = $_POST['term_id'];
	
	$exist = $wpdb->get_var( "SELECT * FROM wp_dvsha_2020_promo_subscriber WHERE contact='" . $contact . "' AND term_id=" . $term_id );

	if( $exist ) {
		echo 'true';
	} else {
		echo 'false';
	}

    die(); // this is required to return a proper result
}

add_action('wp_ajax_check_dvsha_contact', 'check_dvsha_contact_callback');
add_action('wp_ajax_nopriv_check_dvsha_contact', 'check_dvsha_contact_callback');

function save_details() {
	global $wpdb;
	$body = '';

	// begin transaction
	$wpdb->query('START TRANSACTION');

	// print_r( $_POST );

	$data = [
		'term_id'	=> intVal( $_POST['term_id'] ),
		'fullName' 	=> wp_strip_all_tags( $_POST['fullname'] ),
		'email' 	=> wp_strip_all_tags( $_POST['email'] ),
		'contact' 	=> wp_strip_all_tags( str_replace( '+65', '', $_POST[ 'contact' ] ) ),
		'gender' 	=> wp_strip_all_tags( $_POST['gender'][0] ),
	];
	
	foreach( $_POST as $key => $value ) {
		if( $key == 'fullname' || $key == 'email' || $key == 'contact' || $key == 'gender' || $key == 'outlets' || $key == 'preferredContact' ) {
			switch ( $key ) {
				case 'fullname': $title = 'Full Name';
					break;
				case 'email': $title = 'Email';
					break;
				case 'contact': $title = 'Contact Number';
					break;
				case 'gender': $title = 'Gender';
					break;
				case 'outlets': $title = 'Outlet[s]';
					break;
				case 'preferredContact': $title = 'Preferred Method Of Contact';
					break;
			}

			$body .= $title . ": ";

			if( $key == 'outlets' ) {
				foreach( $value as $k => $v ) {
					$outlets .= $v;

					if( $v != end( $value ) ) {
						$outlets .= ',';
					}
				}
				$data[ $key ] = $outlets;
				$body .=  $outlets;
			} else if( $key == 'gender' ) {
				$body .= ucfirst( $value[0] );
			} else {
				$body .= $value;
			}

			if( $key == 'preferredContact' ) {
				foreach( $value as $k => $v ) {
					switch ( $v ) {
						case 1: $preferredContact .= 'SMS';
							break;
						case 2: $preferredContact .= 'WhatsApp';
							break;
						case 3: $preferredContact .= 'Call';
							break;
						case 4: $preferredContact .= 'Email';
							break;
						default: $preferredContact .= 'Any of the method';
							break;
					}

					if( $v != end( $value ) ) {
						$preferredContact .= ',';
					}
				}
				$data[ $key ] = $preferredContact;
				$body .=  $preferredContact;
			}

			$body .= "<br/>";
		}
	}

	$exist = $wpdb->get_var( "SELECT * FROM wp_dvsha_2020_promo_subscriber WHERE (contact='" . str_replace( '+65', '', $_POST[ 'contact' ] ) . "' OR email='" . $_POST['email'] . "') AND term_id=" . $_POST['term_id'] );

	if( $exist ) {
		return false;
	} else {
		$data['createdAt'] = strtotime( current_time( 'Y/m/d H:i:s' ) );

		$type = ['%d','%s','%s','%s','%s','%s','%s','%s'];

		$status = $wpdb->insert( 'wp_dvsha_2020_promo_subscriber', $data, $type );

		if( $status ) {
			$wpdb->query('COMMIT');
		} else {
			$wpdb->query('ROLLBACK');
		}

		$post = get_post( $_POST['term_id'] );

		$terms = get_the_terms( $_POST[ 'term_id' ], 'dvsha_2020_brands' );

		$service = $post->post_title;
		$brand = $terms[0]->name;

		// generate content for client email
		$readerSubj = 'Daily Vanity x ' . $brand . ' promo confirmation email';

		$readerContent = 'Dear ' . $_POST['fullname'] . ',<br/><br/>';
		$readerContent .= 'Thank you for signing up for ' . $service . ' through Daily Vanity Spa & Hair Awards 2020! ' . $brand . ' will be getting in touch with you to arrange an appointment soon.<br/><br/>';
		$readerContent .= 'Regards,<br/>Daily Vanity';
		
		$to1 = $_POST['fullname'] . ' <' . $_POST['email'] . '>';
		$subject1 = $readerSubj;
		$body1 = $readerContent;
		$headers1 = array( 'Content-Type: text/html; charset=UTF-8' );
		$headers1[] = 'From: Daily Vanity <no-reply@dailyvanity.sg>';

		wp_mail( $to1, $subject1, $body1, $headers1 );

		// generate content for merchant email
		$merchantPIC = get_field( 'clients_pic', $_POST['term_id'] );
		$merchantEmail = get_field( 'clients_pic_email', $_POST['term_id'] );
		$merchantCcEmail = get_field( 'client_cc_emails', $_POST['term_id'] );

		$merchantSubj = 'Daily Vanity Spa & Hair Awards 2020 - ' . $service . ' Signups';

		$merchantContent = 'Dear ' . $brand . ',<br/><br/>';
		$merchantContent .= 'Please contact the customer to arrange an appointment. It is advisable to contact the signups within 3 hours for better conversion as these are warm leads.<br/><br/>';
		$merchantContent .= $body;
		$merchantContent .= '<br/><br/>Regards,<br/>Daily Vanity';
		
		$to2 = $merchantPIC . ' <' . $merchantEmail . '>';
		$subject2 = $merchantSubj;
		$body2 = $merchantContent;
		$headers2 = array( 'Content-Type: text/html; charset=UTF-8' );
		$headers2[] = 'From: Daily Vanity <no-reply@dailyvanity.sg>';

		if( strpos( $merchantCcEmail, '@' ) > -1 ) {
			$headers2[] = 'Cc: ' . $merchantCcEmail;
		}

		wp_mail( $to2, $subject2, $body2, $headers2 );


		// $to = $merchantEmail;
		// $subject = 'Daily Vanity Spa & Hair Awards 2020 -  Signups';
		// $body = 'The email body content';
		// $headers = array('Content-Type: text/html; charset=UTF-8');

		// wp_mail( $to, $subject, $body, $headers );

		// print_r( $post );

		return true;
	}
}

/**
 * add method to register event to WordPress init
 */
add_action( 'init', 'register_schedule_send_giveaway_reminder_event');

/**
 * this method will register the cron event
 */
function register_schedule_send_giveaway_reminder_event() {
    // make sure this event is not scheduled
    if( !wp_next_scheduled( 'send_dvsha_reminder_email' ) ) {
        // schedule an event
        wp_schedule_event( time(), 'hourly', 'send_dvsha_reminder_email' );
    }
}

/**
 * notify_user_send_email method will be call when the cron is executed
 */
add_action( 'send_dvsha_reminder_email', 'send_dvsha_all_reminder_email' );

/**
 * this method will call when cron executes
 */
function send_dvsha_all_reminder_email() {
    //here you can build logic and email to all users	
	//send email to admin

	global $wpdb;

	$current = current_time( 'timestamp' );
	$targetDate = strtotime( '2020-08-28 21:00:00' );
	$before = strtotime( '2020-08-28 00:00:00' );
						
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	$headers[] = 'From: Daily Vanity <no-reply@dailyvanity.sg>';

	$subject = "Don't miss out: 1-Year worth of award-winning beauty treatments";

	if( $current >= $targetDate ) {
		$query = $wpdb->prepare( "SELECT `fullName`, `email`, `hash`, `createdAt` FROM `kingsumoContestant` WHERE `reminder` = 0" );
		$results = $wpdb->get_results( $query );

		if( $results ) {
			foreach( $results as $result ) {
				if( $result->createdAt < $before ) {
					$body = "Hi " . $result->fullName . ",<br/><br/>";
					$body .= "As our giveaway is ending soon... don't forget to share the love!<br/><br/>";
					$body .= "Share the giveaway: https://dailyvanity.sg/best-spa-hair-facials-treatments/giveaway?referrer=" . $result->hash . " with your friends and families and you'll receive an additional 3 chances for every successful referral.<br/><br/>";
					$body .= "Daily Vanity Spa & Hair Awards 2020's prizes line-up:<br/>";
					$body .= "-&nbsp;&nbsp;&nbsp;1-Year worth of award-winning beauty treatments<br/>";
					$body .= "-&nbsp;&nbsp;&nbsp;6-month worth of award-winning beauty treatments<br/>";
					$body .= "-&nbsp;&nbsp;&nbsp;3-month worth of award-winning beauty treatments <br/><br/>";
					$body .= "Good luck :)<br/><br/>";
					$body .= "Team Daily Vanity,<br/><br/>";
					$body .= "Questions? Email us at <a href='mailto:only@dailyvanity.sg'>only@dailyvanity.sg</a>";
			
					$to = $result->fullName . ' <' . $result->email . '>';
			
					if( wp_mail( $to, $subject, $body, $headers ) ) {
						$query = $wpdb->prepare( "UPDATE `kingsumoContestant` SET `reminder` = 1, `remindedAt` = '" . $current . "' WHERE `hash`='" . $result->hash . "'" );
						$wpdb->query( $query );
					}
				} else {
					$query = $wpdb->prepare( "UPDATE `kingsumoContestant` SET `reminder` = 1, `remindedAt` = '" . $result->createdAt . "' WHERE `hash`='" . $result->hash . "'" );
					$wpdb->query( $query );
				}
			}
		}
	}
}

/*add_shortcode( 'listicle_links', 'listicle_random_link_shortcode' );

function listicle_random_link_shortcode( $atts, $content=null ) {
	$links = '';
	$arr = shortcode_atts( 
		array(
			'slug' => ''
		), 
		$atts 
	);

	$args = array(
		'taxonomy'	=> 'listicle_group',
		'slug' => $arr['slug']
	); 

	$terms = get_terms( $args );

	$links .= '<style>';
	$links .= '.listicle-links span.title { font-weight: bold; text-transform: capitalize; }';
	$links .= '</style>';
	// delete_transient( 'random_listicle_links' );

	if ( false === ( $query = get_transient( 'random_listicle_links_' . $terms[0]->term_id ) ) ) {
		$args = array(
			'post_type'	=> 'listicle',
			'posts_per_page'	=> -1,
			'orderby'   => 'rand',
			'tax_query'	=> array(
				array(
					'taxonomy'	=> $terms[0]->taxonomy,
					'field'		=> 'term_id',
					'terms'		=> $terms[0]->term_id
				)
			)
		);

		$query = new WP_Query( $args );
		set_transient( 'random_listicle_links_' . $terms[0]->term_id, $query, DAY_IN_SECONDS );
	} 
	
	if ( $query->have_posts() ) {
		$links .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> ';
		$links .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script> ';
		$links .= '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> ';
		$links .= '<style> ';
		$links .= '.listicle-links .btn { position: relative; padding: 15px 0; font-family: "PT Sans,Helvetica,Arial,Lucida,sans-serif"; text-transform: uppercase; font-size: 26px; padding-bottom: 10px; background: #fff; color: #333; font-weight: 500; line-height: 1em; width: 100%; border: 0; text-align: left; radius: 0; -moz-border-radius: 0px; -webkit-border-radius: 0px; border-radius: 0px; border-top: 1px solid #999; border-bottom: 1px solid #999; } ';
		$links .= '.listicle-links .btn:active, .listicle-links .btn:focus, .listicle-links .btn.active, .listicle-links .btn:focus:active { background-image: none; outline: 0; -webkit-box-shadow: none; box-shadow: none; } ';
		$links .= '.absolute-align-right { position: absolute; right: 0; top: 45%; } ';
		$links .= '.listicle-links .fa { font-size: 14px !important; } ';
		$links .= '.collapse { padding-top: 10px; }';
		$links .= '.listicle-links .card { border:0; } ';
		$links .= '.listicle-links .card-body a { color: #f04084 !important; }';
		$links .= '.listicle-links .card-body ol { list-style-position: outside !important; }';
		$links .= '</style>';

		$links .= '<div class="listicle-links">';
		$links .= '<button class="btn collapse-btn" type="button" data-toggle="collapse" data-target="#collapse-' . $terms[0]->term_id . '" aria-expanded="false" aria-controls="collapse-' . $terms[0]->term_id . '">' . $terms[0]->name . '<span></span></button>';
		$links .= '<div class="collapse multi-collapse" id="collapse-' . $terms[0]->term_id . '">';
		$links .= '<div class="card card-body">';
		$links .= '<ol>';
		while ( $query->have_posts() ) {
			$query->the_post();
			$links .= '<li>';
			$links .= '<span class="title">' . get_the_title() . '</span> ';
			if( $content != null ) {
				$links .= '<span class="title">: </span><a href="#' . $query->post->ID . '">' . $content . '</a>';
			}
			$links .= '</li>';
		}
		$links .= '</ol>';
		$links .= '</div>';
		$links .= '</div>';
		$links .= '</div>';
		// Restore original Post Data
		wp_reset_postdata();
	} else {
		// no posts found
	}

	return $links;
}
	
add_shortcode( 'listicle_contents', 'listicle_random_content_shortcode' );
 
function listicle_random_content_shortcode( $atts ) {
	 $content = '';
	 $arr = shortcode_atts( 
		 array(
			 'slug' => ''
		 ), 
		 $atts 
	 );
 
	 $args = array(
		 'taxonomy'	=> 'listicle_group',
		 'slug' => $arr['slug']
	 ); 
 
	 $terms = get_terms( $args );
 
	//  $links .= '<style>';
	//  $links .= '.listicle-links span.title { font-weight: bold; text-transform: capitalize; }';
	//  $links .= '</style>';

	// delete_transient( 'random_listicle_contents_' . $terms[0]->term_id );

	if ( false === ( $query = get_transient( 'random_listicle_contents_' . $terms[0]->term_id ) ) ) {
		$args = array(
			'post_type'	=> 'listicle',
			'posts_per_page' => -1,
			'orderby'   => 'rand',
			'tax_query'	=> array(
				array(
					'taxonomy'	=> $terms[0]->taxonomy,
					'field'		=> 'term_id',
					'terms'		=> $terms[0]->term_id
				)
			)
		);
 
		$query = new WP_Query( $args );
		set_transient( 'random_listicle_contents_' . $terms[0]->term_id, $query, DAY_IN_SECONDS );
	}

	$content .= '<style> .listicle-content { margin-top: 20px; } .listicle-content a { text-decoration: none; } </style>';
	 
	 if ( $query->have_posts() ) {
		 $content .= '<div class="listicle-content">';
		//  $links .= '<ol>';
		 while ( $query->have_posts() ) {
			 $query->the_post();
			//  $content .= '<p>' . get_the_title() . '</p>';
			 $content .= '<a name="' . $query->post->ID . '"></a>';
			 $content .= apply_filters( 'the_content', $query->post->post_content );
			 $content .= '<p><a href="#top" style="font-size:10px;">Back To Top</a></p>';
		 }
		//  $links .= '</ol>';
		
		 $content .= '</div>';
		 // Restore original Post Data
		 wp_reset_postdata();
	 } else {
		 // no posts found
	 }
 
	 return $content;
}*/

function product_list_callback( $atts ) {
	global $parent;
	extract(
		shortcode_atts(
			array(
				'term_id' => 0,
				'posts_per_page' => -1,
				'paged' => 1,
				'offset' => 0,
				'column' => '',
				'spacing' => 'px-2 py-2 px-md-5 py-md-2',
				'ids'	=> '',
				's' => '',
				'view_all' => 0,
				'skintypes' => '',
				'skinconcerns' => '',
				'hairconcerns' => '',
				'brands' => '',
				'awards' => '',
				'prices' => '',
				'orderby' => 'rand',
				'order' => ''
	 		), 
	 	$atts )
	);

	if( !empty( $ids ) ) {
		$idArr = explode( ',', $ids ); 
	} else {
		$idArr = [];
	}

	$args = array( 
		'post_type' => 'dvba_2021_listing',
		'posts_per_page' => $posts_per_page,
		'post_status' => 'publish',
		'paged' => $paged,
		'offset' => $offset,
		'post__not_in' => $idArr,
	);

	if( isset( $s ) && !empty( $s ) ) {
		$args['s'] = $s;
	}

	if( $orderby && $orderby != 'rand' ) {
		$orderByArr = explode( '-', $orderby );
		switch( $orderByArr[0] ) {
			case 'alphabetical': 
				$args['orderby'] = 'post_title';
				$args['order'] = strtoupper( $orderByArr[1] );
				break;
			// case 'price': 
			// 	$price_taxonomies = get_terms( 
			// 		array(
			// 			'taxonomy' => 'dvba_2021_price_range',
			// 			'fields' => 'term_id',
			// 			'orderby' => 'term_id',
			// 			'order'	=> strtoupper( $orderByArr[1] ),
			// 			'hide_empty' => false
			// 		)
			// 	);
			// 	add_filter('posts_orderby', 'orderby_price');
			// 	break;
			case 'featured': 
				$args['meta_key'] = 'paid';
				$args['orderby'] = 'meta_value';
				$args['order'] = 'DESC';
				break;
		}
	} else {
		$args['orderby'] = 'rand';
	}

	if( $term_id ) {
		$taxArr = array(
			'taxonomy' => 'dvba_2021_categories',
			'terms' => $term_id,
			'field' => 'term_id',
			'include_children' => false
		);
	
		$args['tax_query'] = array( 
			$taxArr
		);

		$skinTypeArr = array();
		$skinConcernArr = array();
		$hairConcernArr = array();
		$brandArr = array();
		$awardArr = array();
		$priceArr = array();

		if( $skintypes || $skinconcerns || $hairconcerns || $brands || $awards || $prices ) {
			if( $skintypes ) {
				$tempSkinTypeArr = explode( ',', $skintypes );
				$skinTypeArr = array(
					'taxonomy' => 'dvba_2021_skin_types',
					'field'    => 'slug',
					'terms'    => $tempSkinTypeArr,
					'operator' => 'IN',
				);
			}

			if( $skinconcerns ) {
				$tempSkinConcernArr = explode( ',', $skinconcerns );
				$skinConcernArr = array(
					'taxonomy' => 'dvba_2021_skin_concerns',
					'field'    => 'slug',
					'terms'    => $tempSkinConcernArr,
					'operator' => 'IN',
				);
			}

			if( $hairconcerns ) {
				$tempHairConcernArr = explode( ',', $hairconcerns );
				$hairConcernArr = array(
					'taxonomy' => 'dvba_2021_hair_types_concerns',
					'field'    => 'slug',
					'terms'    => $tempHairConcernArr,
					'operator' => 'IN',
				);
			}

			if( $brands ) {
				$tempBrandArr = explode( ',', $brands );
				$brandArr = array(
					'taxonomy' => 'dvba_2021_brands',
					'field'    => 'slug',
					'terms'    => $tempBrandArr,
					'operator' => 'IN',
				);
			}

			if( $awards ) {
				$tempAwardArr = explode( ',', $awards );
				$awardArr = array(
					'taxonomy' => 'dvba_2021_award_tiers',
					'field'    => 'slug',
					'terms'    => $tempAwardArr,
					'operator' => 'IN',
				);

				// array_push( $args['tax_query'], $awardArr );
			}

			if( $prices ) {
				$tempPriceArr = explode( ',', $prices );
				$priceArr = array(
					'taxonomy' => 'dvba_2021_price_range',
					'field'    => 'slug',
					'terms'    => $tempPriceArr,
					'operator' => 'IN',
				);
				// array_push( $args['tax_query'], $priceArr );
			}

			$filterArr = array(
				'relation' => 'OR',
				$skinTypeArr,
				$skinConcernArr,
				$hairConcernArr,
				$brandArr,
				$awardArr,
				$priceArr,
			);

			if( is_array( $orderby ) && in_array( 'price', $orderby ) ) {
				array_push( $filterArr, array(
					'taxonomy'  => 'dvba_2021_price_range',
					'field'     => 'term_id',
					'terms'     => $price_taxonomies
				) );
			}

			array_push( $args['tax_query'], $filterArr );
		}
	}

	// print_r( $args );
	
	$posts = new WP_Query( $args );

	// if( is_array( $orderby ) && in_array( 'price', $orderby ) ) {
	// 	remove_filter('posts_orderby', 'orderby_price');
	// }

	$content = '';

	if( $posts->have_posts() ) {
		while( $posts->have_posts() ) {
			$posts->the_post();

			$awards = [];

			$parent_id = 0;
			$parent_slug = '';
			$panret_name = '';
			$sub_name = '';

			$categories = get_the_terms( get_the_id(), 'dvba_2021_categories' );

			foreach( $categories as $term1 ) {
				if( $term1->parent == 0 ) {
					$parent_id = $term1->term_id;
					$parent_slug = $term1->slug;
					$parent_name = $term1->name;
				}
			}

			foreach( $categories as $term ){
				if( count( get_term_children( $term->term_id, 'dvba_2021_categories' ) ) == 0 ) {
					$awards[] .= $term->name;
				}

				if( $term->parent == $parent_id ) {
					$sub_name = $term->name;
				}
			}

			$img = get_the_post_thumbnail_url( get_the_id(), 'full' );

			if( get_field( 'paid', get_the_id() ) == 'yes' ) {
				$bgColor = 'paid';
			} else {
				$bgColor = 'non-paid';
			}

			$content .= '<div class="card ' . $spacing . ' ' . $column . '" id="' . get_the_id() . '">' . "\n";
			$content .= "\t" . '<a href="' . get_permalink() . '" target="_blank"><img src="' . $img . '" class="card-img-top" alt="Daily Vanity Beauty Awards 2021 Best ' . $sub_name . ' ' . get_the_title() . ' ' . implode( ', ', $awards ) . '"></a>' . "\n";
			$content .= "\t" . '<div class="card-body px-0">' . "\n";

			foreach( $awards as $k => $v ) {
				$content .= "\t\t" . '<div class="award-box poppins-semibold '. $bgColor .' mb-1">' . $v . '</div>' . "\n";
			}

			$content .= "\t\t" . '<h5 class="card-title"><a href="' . get_permalink() . '"  class="poppins-medium" target="_blank">' . get_the_title() . '</a></h5>' . "\n";
			$content .= "\t\t" . '<a href="' . get_permalink() . '"  class="poppins-medium more-details-btn" target="_blank">More Details</a>' . "\n";
			$content .= "\t" . '</div>' . "\n";
			$content .= '</div>' . "\n";
				
		}
	}

	if( $view_all ) {
		if( $parent ) {
			$content .= '<div class="card text-center view-all-card px-2 py-2 px-md-5 py-md-2" style="width: 18rem;">' . "\n";
			$content .= "\t" . '<div class="card-body">' . "\n";
			$content .= "\t\t" . '<a href="' . get_term_link( $parent['term_id'] ) . '" class="poppins-bold view-all-btn">View All</a>' . "\n";
			$content .= "\t" . '</div>' . "\n";
			$content .= '</div>' . "\n";
		}
	}

	if( $content ) {
		return $content;
	} else {
		return '<h4 class="poppins-regular">No Products Found!</h4>';
	}
}

function register_dvba_2021_shortcodes() {
	add_shortcode( 'display-products', 'product_list_callback' );
	add_shortcode( 'display-similar-products', 'similar_product_list_callback' );
	add_shortcode( 'display-filter', 'display_filter_callback' );
	add_shortcode( 'display-filter-list', 'display_filter_list_callback' );
}

add_action( 'init', 'register_dvba_2021_shortcodes');

// register skincare menu
function wpb_dvba_2021_skincare_menu() {
    register_nav_menu('dvba-2021-skincare-menu',__( 'DVBA 2021 Skincare Menu' ));
}

add_action( 'init', 'wpb_dvba_2021_skincare_menu' );

// register makeup menu
function wpb_dvba_2021_makeup_menu() {
    register_nav_menu('dvba-2021-makeup-menu',__( 'DVBA 2021 Makeup Menu' ));
}

add_action( 'init', 'wpb_dvba_2021_makeup_menu' );

// register body-care menu
function wpb_dvba_2021_body_care_menu() {
    register_nav_menu('dvba-2021-body-care-menu',__( 'DVBA 2021 Body Care Menu' ));
}

add_action( 'init', 'wpb_dvba_2021_body_care_menu' );

// register hair-care menu
function wpb_dvba_2021_hair_care_menu() {
    register_nav_menu('dvba-2021-hair-care-menu',__( 'DVBA 2021 Hair Care Menu' ));
}

add_action( 'init', 'wpb_dvba_2021_hair_care_menu' );

/**
 * Register DVBA 2022 menu
 */
// dvba 2022 register category menu
function register_dvba_2022_category_menu() {
	register_nav_menu('dvba-2022-category-menu',__( 'DVBA 2022 Category Menu' ));
}
add_action( 'init', 'register_dvba_2022_category_menu' );

// dvba 2022 register skincare menu
function wpb_dvba_2022_skincare_menu() {
    register_nav_menu('dvba-2022-skincare-menu',__( 'DVBA 2022 Skincare Menu' ));
}

add_action( 'init', 'wpb_dvba_2022_skincare_menu' );

// dvba 2022 register makeup menu
function wpb_dvba_2022_makeup_menu() {
    register_nav_menu('dvba-2022-makeup-menu',__( 'DVBA 2022 Makeup Menu' ));
}

add_action( 'init', 'wpb_dvba_2022_makeup_menu' );

// dvba 2022 register body-care menu
function wpb_dvba_2022_body_care_menu() {
    register_nav_menu('dvba-2022-body-care-menu',__( 'DVBA 2022 Body Care Menu' ));
}

add_action( 'init', 'wpb_dvba_2022_body_care_menu' );

// dvba 2022 register hair-care menu
function wpb_dvba_2022_hair_care_menu() {
    register_nav_menu('dvba-2022-hair-care-menu',__( 'DVBA 2022 Hair Care Menu' ));
}

add_action( 'init', 'wpb_dvba_2022_hair_care_menu' );
/**
 * End register DVBA 2022 menus
 */



function load_more_products_shortcode() {
	if( $_POST['post_id'] ) {
		echo do_shortcode( '[display-similar-products post_id="' . $_POST['post_id'] . '" posts_per_page="' . $_POST['posts_per_page'] . '" column="col-6 col-md-3" spacing="px-2 py-2 px-md-4 py-md-3" ids="' . $_POST['ids'] . '" parent_id="' . $_POST['term_id'] . '"]' );
	} else {
		echo do_shortcode( '[display-products term_id="' . $_POST['term_id'] . '" posts_per_page="' . $_POST['posts_per_page'] . '" paged="' . $_POST['pageno'] . '" ids="' . $_POST['ids'] . '" column="col-6 col-md-3" spacing="px-2 py-2 px-md-3 py-md-3" s="' . $_POST['s'] . '" skinTypes="' . $_POST['st'] . '" skinConcerns="' . $_POST['sc'] . '" hairConcerns="' . $_POST['htc'] . '" brands="' . $_POST['br'] . '" awards="' . $_POST['aw'] . '" prices="' . $_POST['pr'] . '" orderby="' . $_POST['orderby'] . '"]' );
	}

	die();
}

add_action( 'wp_ajax_ajaxLoadMoreProducts', 'load_more_products_shortcode' );
add_action( 'wp_ajax_nopriv_ajaxLoadMoreProducts', 'load_more_products_shortcode' );

function display_filter_callback( $atts ) {
	extract(
		shortcode_atts(
			array(
				'taxonomy' 	=> '',
				'name'		=> '',
				'checked'	=> ''
	 		), 
	 	$atts )
	);

	$args = [
		'taxonomy'		=> $taxonomy,
		'orderby'		=> 'term_id',
		'order'			=> 'ASC',
		'hide_empty'	=> false
	];

	$filters = new WP_Term_Query( $args );
	$checkedArr = explode( ',', $checked );

	$content = '';

	foreach( $filters->terms as $filter ) {
		if( in_array( $filter->slug, $checkedArr ) ) {
			$checked = 'checked';
		} else {
			$checked = '';
		}

		$content .= "\t" . '<div class="form-check">' . "\n";
  		$content .= "\t" . '<input class="form-check-input ' . $taxonomy . '-checkbox" type="checkbox" value="' . $filter->slug . '" id="' . $filter->slug . '" name="' . $name . '[]" ' . $checked . '>' . "\n";
  		$content .= "\t" . '<label class="form-check-label filter-label" for="' . $filter->slug . '">' . "\n";
  		$content .= "\t" . $filter->name . "\n";
  		$content .= "\t" . '</label>' . "\n";
  		$content .= "\t" . '</div>' . "\n";
	}

	return $content;
}

function get_total_pages( $posts_per_page, $term_id, $skinTypes, $skinConcerns, $hairConcerns, $brands, $awards, $prices ) {
	$args = array( 
		'post_type' => 'dvba_2021_listing',
		'posts_per_page' => $posts_per_page,
		'post_status' => 'publish'
	);

	if( $term_id ) {
		$taxArr = array(
			'taxonomy' => 'dvba_2021_categories',
			'terms' => $term_id,
			'field' => 'term_id',
			'include_children' => false
		);

		$skinTypeArr = array();
		$skinConcernArr = array();
		$hairConcernArr = array();
		$brandArr = array();
		$awardArr = array();
		$priceArr = array();
	
		$args['tax_query'] = array( 
			$taxArr
		);

		if( $skinTypes || $skinConcerns || $hairConcerns || $brands || $awards || $prices ) {
			if( $skinTypes ) {
				$tempSkinTypesArr = explode( ',', $skinTypes );
				$skinTypeArr = array(
					'taxonomy' => 'dvba_2021_skin_types',
					'field'    => 'slug',
					'terms'    => $tempSkinTypesArr,
					'operator' => 'IN',
				);
			}

			if( $skinConcerns ) {
				$tempSkinConcernsArr = explode( ',', $skinConcerns );
				$skinConcernArr = array(
					'taxonomy' => 'dvba_2021_skin_concerns',
					'field'    => 'slug',
					'terms'    => $tempSkinConcernsArr,
					'operator' => 'IN',
				);
			}

			if( $hairConcerns ) {
				$tempHairConcernsArr = explode( ',', $hairConcerns );
				$hairConcernArr = array(
					'taxonomy' => 'dvba_2021_hair_types_concerns',
					'field'    => 'slug',
					'terms'    => $tempHairConcernsArr,
					'operator' => 'IN',
				);
			}

			if( $brands ) {
				$tempBrandArr = explode( ',', $brands );
				$brandArr = array(
					'taxonomy' => 'dvba_2021_brands',
					'field'    => 'slug',
					'terms'    => $tempBrandArr,
					'operator' => 'IN',
				);
			}

			if( $awards ) {
				$tempAwardArr = explode( ',', $awards );
				$awardArr = array(
					'taxonomy' => 'dvba_2021_award_tiers',
					'field'    => 'slug',
					'terms'    => $tempAwardArr,
					'operator' => 'IN',
				);
			}

			if( $prices ) {
				$tempPriceArr = explode( ',', $prices );
				$priceArr = array(
					'taxonomy' => 'dvba_2021_price_range',
					'field'    => 'slug',
					'terms'    => $tempPriceArr,
					'operator' => 'IN',
				);
			}

			$filterArr = array(
				'relation' => 'OR',
				$skinTypeArr,
				$skinConcernArr,
				$hairConcernArr,
				$brandArr,
				$awardArr,
				$priceArr,
			);

			array_push( $args['tax_query'], $filterArr );
		}
	}
	
	$posts = new WP_Query( $args );
	
	return $posts->max_num_pages;
}

function display_filter_list_callback( $atts ) {
	extract(
		shortcode_atts(
			array(
				'skintypes' => '',
				'skinconcerns' => '',
				'hairconcerns' => '',
				'brands' => '',
				'awards' => '',
				'prices' => ''
	 		), 
	 	$atts )
	);

	$params = [];

	if( $skintypes ) $params[ "skinTypes" ] = explode( ',', $skintypes );
	if( $skinconcerns ) $params[ "skinConcerns" ] = explode( ',', $skinconcerns );
	if( $hairconcerns ) $params[ "hairConcerns" ] = explode( ',', $hairconcerns );
	if( $brands ) $params[ "brands" ] = explode( ',', $brands );
	if( $awards ) $params[ "awardTiers" ] = explode( ',', $awards );
	if( $prices ) $params[ "priceRange" ] = explode( ',', $prices );

	$filterArr = [ 
		"skinTypes" 	=> "dvba_2021_skin_types", 
		"skinConcerns"	=> "dvba_2021_skin_concerns", 
		"hairConcerns"	=> "dvba_2021_hair_types_concerns", 
		"brands"		=> "dvba_2021_brands", 
		"awardTiers"	=> "dvba_2021_award_tiers", 
		"priceRange"	=> "dvba_2021_price_range" 
	];

	$content = '';

	$content .= "\t" . '<div class="row g-0 mx-0 my-2">' . "\n";
	$content .= "\t\t" . '<div class="col">' . "\n";
	$content .= "\t\t\t" . '<ul class="filter-criteria ps-0">' . "\n";

	foreach( $filterArr as $key => $value ) {
		if( count( (array)$params[$key] ) ) {
			foreach( $params[$key] as $k => $v ) {
				$terms = get_term_by( 'slug', $v, $value );
				$content .= '<li><span class="criteria poppins-medium px-3 py-1 mx-1">' . $terms->name . ' &nbsp;<span class="uncheck-filter-btn" id="' . $terms->slug . '"><i class="fas fa-times"></i></span></span></li>';
			}
		}
	}

	$content .= "\t\t\t" . '</ul>' . "\n";
	$content .= "\t\t\t" . '</div>' . "\n";
	$content .= "\t\t" . '</div>' . "\n";

	return $content;
}

function orderby_price($orderby_statement) {
    $orderby_statement = " term_order ASC, " . $orderby_statement; //keeps the current orderby, but also adds the term_order in front
    return $orderby_statement;
}

function similar_product_list_callback( $atts ) {
	// global $parent;
	extract(
		shortcode_atts(
			array(
				'post_id' => 0,
				'posts_per_page' => -1,
				'paged' => 1,
				'offset' => 0,
				'column' => '',
				'spacing' => 'px-2 py-2 px-md-5 py-md-2',
				'ids'	=> '',
				'orderby' => 'rand',
				'order' => '',
				'parent_id' => '',
				'parent_slug' => ''
	 		), 
	 	$atts )
	);

	if( !empty( $ids ) ) {
		$idArr = explode( ',', $ids ); 
	} else {
		$idArr = [];
	}

	$args = array( 
		'post_type' => 'dvba_2021_listing',
		'posts_per_page' => $posts_per_page,
		'post_status' => 'publish',
		'paged' => $paged,
		'offset' => $offset,
		'post__not_in' => $idArr,
		'orderby' => $orderby
	);

	$parent = get_term_by( 'id', $parent_id, 'dvba_2021_categories' );

	if( empty( $parent_slug ) ) {
		$parent_slug = $parent->slug;
	}

	$taxArr['relation'] = 'OR';

	if( $parent_slug == 'skincare' || $parent_slug == 'body-care' ) {
		$skintypes = get_the_terms( $post_id, 'dvba_2021_skin_types' );
		$skinconcerns = get_the_terms( $post_id, 'dvba_2021_skin_concerns' );

		if( $skintypes && count( $skintypes ) > 0 ) {
			$skinTypeId = array();
			foreach( $skintypes as $skintype ) {
				$skinTypeId[] = $skintype->term_id;
			}

			array_push( $taxArr, array(
				'taxonomy' => 'dvba_2021_skin_types',
				'terms' => $skinTypeId,
				'field' => 'term_id',
				'include_children' => false
			) );
		}

		if( $skinconcerns && count( $skinconcerns ) > 0 ) {
			$skinConcernId = array();
			foreach( $skinconcerns as $skinconcern ) {
				$skinConcernId[] = $skinconcern->term_id;
			}

			array_push( $taxArr, array(
				'taxonomy' => 'dvba_2021_skin_concerns',
				'terms' => $skinConcernId,
				'field' => 'term_id',
				'include_children' => false
			) );
		}
	}

	if( $parent_slug == 'hair-care' ) {
		$hairconcerns = get_the_terms( $post_id, 'dvba_2021_hair_types_concerns' );

		if( $hairconcerns && count( $hairconcerns ) > 0 ) {
			$hairConcernId = array();
			foreach( $hairconcerns as $hairconcern ) {
				$hairConcernId[] = $hairconcern->term_id;
			}

			array_push( $taxArr, array(
				'taxonomy' => 'dvba_2021_hair_types_concerns',
				'terms' => $hairConcernId,
				'field' => 'term_id',
				'include_children' => false
			) );
		}
	}

	if( $parent_slug == 'makeup' ) {
		$makeupTerms = get_the_terms( $post_id, 'dvba_2021_categories' );

		foreach( $makeupTerms as $makeupTerm ) {
			if( $makeupTerm->parent > 0 && $makeupTerm->parent == $parent_id ) {
				$makeupCategoryId[] = $makeupTerm->term_id;
			}
		}

		if( $makeupCategoryId && count( $makeupCategoryId ) > 0 ) {
			array_push( $taxArr, array(
				'taxonomy' => 'dvba_2021_categories',
				'terms' => $makeupCategoryId,
				'field' => 'term_id',
				'include_children' => false
			) );
		}
	}

	$args['tax_query'] = array( $taxArr );
	
	$posts = new WP_Query( $args );

	// print_r( $posts->found_posts );

	$content = '';

	if( $posts->have_posts() ) {
		while( $posts->have_posts() ) {
			$posts->the_post();

			$awards = [];

			// $parent_id = 0;
			// $parent_slug = '';
			// $panret_name = '';
			$sub_name = '';

			$categories = get_the_terms( get_the_id(), 'dvba_2021_categories' );

			foreach( $categories as $term ) {
				if( count( get_term_children( $term->term_id, 'dvba_2021_categories' ) ) == 0 ) {
					$awards[] .= $term->name;
				}

				if( $term->parent == $parent_id ) {
					$sub_name = $term->name;
				}
			}

			$img = get_the_post_thumbnail_url( get_the_id(), 'full' );

			if( get_field( 'paid', get_the_id() ) == 'yes' ):
				$bgColor = 'paid';
			else:
				$bgColor = 'non-paid';
			endif;

			$content .= '<div class="card ' . $spacing . ' ' . $column . '" id="' . get_the_id() . '">' . "\n";
			$content .= "\t" . '<a href="' . get_permalink() . '" target="_blank"><img src="' . $img . '" class="card-img-top" alt="Daily Vanity Beauty Awards 2021 Best ' . $sub_name . ' ' . get_the_title() . ' ' . implode( ', ', $awards ) . '"></a>' . "\n";
			$content .= "\t" . '<div class="card-body px-0">' . "\n";

			foreach( $awards as $k => $v ) {
				$content .= "\t\t" . '<div class="award-box poppins-semibold '. $bgColor .' mb-1">' . $v . '</div>' . "\n";
			}

			$content .= "\t\t" . '<h5 class="card-title"><a href="' . get_permalink() . '"  class="poppins-medium" target="_blank">' . get_the_title() . '</a></h5>' . "\n";
			$content .= "\t\t" . '<a href="' . get_permalink() . '"  class="poppins-medium more-details-btn" target="_blank">More Details</a>' . "\n";
			$content .= "\t" . '</div>' . "\n";
			$content .= '</div>' . "\n";
				
		}
	}

	if( $view_all ) {
		if( $parent ) {
			$content .= '<div class="card text-center view-all-card px-2 py-2 px-md-5 py-md-2" style="width: 18rem;">' . "\n";
			$content .= "\t" . '<div class="card-body">' . "\n";
			$content .= "\t\t" . '<a href="' . get_term_link( $parent['term_id'] ) . '" class="poppins-bold view-all-btn">View All</a>' . "\n";
			$content .= "\t" . '</div>' . "\n";
			$content .= '</div>' . "\n";
		}
	}

	if( $content ) {
		return $content;
	} else {
		return '<h4 class="poppins-regular">No Products Found!</h4>';
	}
}

function get_similar_products_total_pages( $posts_per_page, $post_id ) {
	$args = array( 
		'post_type' => 'dvba_2021_listing',
		'posts_per_page' => $posts_per_page,
		'post_status' => 'publish',
		'post__not_in' => array( $post_id ),
	);

	$terms = get_the_terms( $post_id, 'dvba_2021_categories' );

	$category = [];
	
	foreach( $terms as $term ) {
		if( $term->parent == 0 ) {
			$category['term_id'] = $term->term_id;
			$category['name'] = $term->name;
			$category['slug'] = $term->slug;
		}
	}

	$taxArr['relation'] = 'OR';

	if( $category['slug'] == 'skincare' || $category['slug'] == 'body-care' ) {
		$skintypes = get_the_terms( $post_id, 'dvba_2021_skin_types' );
		$skinconcerns = get_the_terms( $post_id, 'dvba_2021_skin_concerns' );

		if( $skintypes && count( $skintypes ) > 0 ) {
			$skinTypeId = array();
			foreach( $skintypes as $skintype ) {
				$skinTypeId[] = $skintype->term_id;
			}

			array_push( $taxArr, array(
				'taxonomy' => 'dvba_2021_skin_types',
				'terms' => $skinTypeId,
				'field' => 'term_id',
				'include_children' => false
			) );
		}

		if( $skinconcerns && count( $skinconcerns ) > 0 ) {
			$skinConcernId = array();
			foreach( $skinconcerns as $skinconcern ) {
				$skinConcernId[] = $skinconcern->term_id;
			}

			array_push( $taxArr, array(
				'taxonomy' => 'dvba_2021_skin_concerns',
				'terms' => $skinConcernId,
				'field' => 'term_id',
				'include_children' => false
			) );
		}
	}

	if( $category['slug'] == 'hair-care' ) {
		$hairconcerns = get_the_terms( $post_id, 'dvba_2021_hair_types_concerns' );

		if( $hairconcerns && count( $hairconcerns ) > 0 ) {
			$hairConcernId = array();
			foreach( $hairconcerns as $hairconcern ) {
				$hairConcernId[] = $hairconcern->term_id;
			}

			array_push( $taxArr, array(
				'taxonomy' => 'dvba_2021_hair_types_concerns',
				'terms' => $hairConcernId,
				'field' => 'term_id',
				'include_children' => false
			) );
		}
	}

	if( $category['slug'] == 'makeup' ) {
		$makeupTerms = get_the_terms( $post_id, 'dvba_2021_categories' );

		foreach( $makeupTerms as $makeupTerm ) {
			if( $makeupTerm->parent > 0 && $makeupTerm->parent == $category['term_id'] ) {
				$makeupCategoryId[] = $makeupTerm->term_id;
			}
		}

		if( $makeupCategoryId && count( $makeupCategoryId ) > 0 ) {
			array_push( $taxArr, array(
				'taxonomy' => 'dvba_2021_categories',
				'terms' => $makeupCategoryId,
				'field' => 'term_id',
				'include_children' => false
			) );
		}
	}

	$args['tax_query'] = array( $taxArr );
	
	$posts = new WP_Query( $args );
	
	return $posts->max_num_pages;
}

// convert dollar sign $ into HTML code
function convert_dollar_sign( $content ) {
    if ( is_single() ) {
        return str_replace ( '$', '&#36;', $content );
    }
 
    return $content;
}
add_filter( 'the_content', 'convert_dollar_sign');

// create a scheduled event (if it does not exist already)
// function menu_highlights_cron_activation() {
// 	if( !wp_next_scheduled( 'MenuHighlightsCron' ) ) {
// 	   wp_schedule_event( time(), 'daily', 'MenuHighlightsCron' );  
// 	}
// }
// add_action( 'wp', 'menu_highlights_cron_activation' );

// // unschedule event
// function menu_highlights_cron_deactivate() {	
// 	// find out when the last event was scheduled
// 	$timestamp = wp_next_scheduled( 'MenuHighlightsCron' );
// 	// unschedule previous event if any
// 	wp_unschedule_event( $timestamp, 'MenuHighlightsCron' );
// } 
// register_deactivation_hook ( __FILE__, 'menu_highlights_cron_deactivate' );

// hook that function onto our scheduled event:
add_action ('MenuHighlightsCron', 'highlights_menu_transient');

/**
 * menu Highlights
 */
function highlights_menu_transient() {
	$arg_photo = array('no', 'yes');

	if ( true === get_transient( 'zuckjs_highlights_menu_browse_category' ) ) {
		delete_transient( 'zuckjs_highlights_menu_browse_category' );
	}

	if ( true === get_transient( 'zuckjs_highlights_menu' ) ) {
		delete_transient( 'zuckjs_highlights_menu' );
	}
	
	foreach ($arg_photo as $args) {
		$self =  new \DVChild\shortcodes\IGStory\IGStory; // create class object
		$self->generateIGPostArray($args);
	}
}

// relevanssi functions

add_filter( 'relevanssi_block_one_letter_searches', '__return_false' );

add_filter( 'relevanssi_modify_wp_query', 'rlv_force_order' );
function rlv_force_order( $query ) {
	if(!is_category() || !is_tag()) {
		return $query;
	}
    $query->set( 'orderby', array( 'relevance' => 'desc' ) );
    return $query;
}

add_filter( 'relevanssi_results', 'rlv_dynamic_time_weights' );
function rlv_dynamic_time_weights( $results ) {
	if(!is_category() || !is_tag()) {
		return $results;
	}
    array_walk(
        $results,
        function( &$weight, $post_id ) {
            $now       = date_create( 'now' );
            $post_date = date_create( get_the_time( 'Y-m-d', $post_id ) );
            $diff_days = $now->diff( $post_date, true )->format( '%a' );

            if ( $diff_days < 1 ) {
                $diff_days = 1;
            }

            $multiplier = 500 / $diff_days;
            $weight     = $weight * $multiplier;
        }
    );

	return $results;
}

// Gravity Form
/*
* Render the "Field ID" property for Gravity Form fields
* under the "Advanced" tab.
*
* @param int $position The current property position.
*/
function growella_render_field_id_setting( $position ) {
 if ( 50 !== $position ) {
   return;
 }
?>

 <li class="field_id_setting field_setting">
   <label for="field_field_id" class="section_label">
	 <?php echo esc_html_x( 'Field ID', 'label for Gravity Forms field ID input', 'growella' ); ?>
   </label>
   <input id="field_field_id" type="text" onchange="SetFieldProperty('fieldID', this.value);" />
 </li>

<?php
}
add_action( 'gform_field_advanced_settings', 'growella_render_field_id_setting' );

/**
 * Print custom scripting for the "Field ID" property.
 */
function growella_editor_script() {
	?>
	
	  <script type="text/javascript">
		/*
		 * Add .field_id_setting onto the end of each field
		 * type's properties.
		 */
		jQuery.map(fieldSettings, function (el, i) {
		  fieldSettings[i] += ', .field_id_setting';
		});
	
		// Populate field settings on initialization.
		jQuery(document).on('gform_load_field_settings', function(ev, field){
		  jQuery(document.getElementById('field_field_id'))
			.val(field.fieldID || '');
		  });
	  </script>
	
	<?php
}
add_action( 'gform_editor_js', 'growella_editor_script' );

// auto scroll to form after submission
add_filter( 'gform_confirmation_anchor', '__return_true' );

// hide posts with password protected from frontend
function wpb_password_post_filter( $where = '' ) {
    if ( !is_single() && !is_user_logged_in() && !is_admin() ) {
        $where .= " AND post_password = ''";
    }
    return $where;
}
add_filter( 'posts_where', 'wpb_password_post_filter' );

// DVSHA 2021 Voting

// add_action( 'first-nav', 'dvsha_2021_voting_first_nav', 10, 4 );

// function dvsha_2021_voting_first_nav( $fb, $ig, $tw, $ytb ) {
// 	$content = '';
//     $content .= '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
// 	$content .= '<div class="navbar-inner">';
//     $content .= '<a class="navbar-brand" href="' . home_url() . '">';
//     $content .= '<img src="' . S3_PATH . '/wp-content/uploads/svg/beauty-magazine-daily-vanity-logo.svg" alt="" id="top-logo" />';
//     $content .= '</a>';
//     $content .= '<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
//     $content .= '<span class="navbar-toggler-icon"></span>';
//     // $content .= '<span class="navbar-collapse-icon hide"></span>';
//     $content .= '</button>';
// 	$content .= '</div>';
//     $content .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
//     $content .= '<ul class="navbar-nav mr-auto">';
//     $content .= '<li class="nav-item">';
//     $content .= '<a class="nav-link top-nav-link" href="#giveaway">Giveaway</a>';
//     $content .= '</li>';
//     $content .= '<li class="nav-item">';
//     $content .= '<a class="nav-link top-nav-link" href="https://dv.sg/vote-now-dvsha" target="_blank">Vote</a>';
//     $content .= '</li>';
//     $content .= '</ul>';
//     $content .= '<ul class="navbar-nav social-media-nav">';
//     $content .= '<li class="nav-item">';
//     $content .= '<a class="nav-link" href="' . $fb . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
//     $content .= '</li>';
//     $content .= '<li class="nav-item">';
//     $content .= '<a class="nav-link" href="' . $ig . '" target="_blank"><i class="fab fa-instagram"></i></a>';
//     $content .= '</li>';
//     $content .= '<li class="nav-item">';
//     $content .= '<a class="nav-link" href="' . $tw . '" target="_blank"><i class="fab fa-twitter"></i></a>';
//     $content .= '</li>';
//     $content .= '<li class="nav-item">';
//     $content .= '<a class="nav-link" href="' . $ytb . '" target="_blank"><i class="fab fa-youtube"></i></a>';
//     $content .= '</li>';
//     $content .= '</ul>';
//     $content .= '</div>';
//     $content .= '</nav>';
	
// 	echo $content;
// }

add_action( 'footer-nav', 'dvsha_2021_voting_footer_nav' );

function dvsha_2021_voting_footer_nav() {
	$content = '';

	$content .= '<span class="text-muted">';
	$content .= '&copy; DAILY VANITY PTE LTD, 2021<br/>';
	$content .= '201 Henderson Road, Apex @ Henderson,<br/>';
	$content .= '#06-13/14, Singapore 159545';
	$content .= '</span>';

	echo $content;
}

add_action( '404-content-after', 'display_navigation_below_404' );

function display_navigation_below_404() {
	echo do_shortcode( '[igstory photo="no" noresult="yes"]' );
}

add_action( '404-content', 'display_404_content' );

function display_404_content() {
	echo '<h1>Oh no! This page seems to be broken just like the eyeshadows! :(</h1>';
	echo '<p style="font-size: 26px;">You can browse our website via the links below, search for the content you want in the search bar above or report this issue to us at <a href="mailto:only@dailyvanity.sg">only@dailyvanity.sg</a>.</p>';
}

// Article Insertion


//define keys
if ( ! defined("ARTICLE_INSERTION_VIEWS_KEY") ) {
    define("ARTICLE_INSERTION_VIEWS_KEY", "article_insertion_views");
}

// function to get article insertion views by article insertion post type id
function get_article_insertion_views( $post_id ){
    $count = get_post_meta($post_id, ARTICLE_INSERTION_VIEWS_KEY, true);
    if($count==''){
        delete_post_meta($post_id, ARTICLE_INSERTION_VIEWS_KEY);
        add_post_meta($post_id, ARTICLE_INSERTION_VIEWS_KEY, '0');
        return 0;
    }
    return $count;
}

//update article insertion post views by article insertion post type id
function update_article_insertion_views( $post_id ) {
    $count = get_article_insertion_views( $post_id );
    $count++;
    update_post_meta( $post_id, ARTICLE_INSERTION_VIEWS_KEY, $count );
}

add_filter( 'the_content', 'insertSubscribeNewsLetter' );
function insertSubscribeNewsLetter($content) {

  global $post;
  if(!$post) {
    return $content;
  }

  if( ( ( $post->post_type == 'post' && is_single() && is_singular("post") ) || $post->post_type == 'deal' ) && ( get_field( 'disable_ads_injection', $post->ID ) === false || !get_field( 'disable_ads_injection', $post->ID ) ) ) {

    $roles = get_the_author_meta('roles');
    $args = array(
          'posts_per_archive_page'   => 1,
          'post_type'        => 'article_insertion'
      );
    $wp_query = new WP_Query( $args );

    if( $wp_query->have_posts() ) {
      $oldPost = $post;
      $wp_query->the_post();

      //store the article insertion views

      // if(in_the_loop())
      // {
      //   $articleInsertionId = $post->ID;
      //   update_article_insertion_views($articleInsertionId);
      // }

      setup_postdata($post);

      $postContent = $post->post_content;
      $postContent = str_replace("$","&#36;",$postContent);
      
      $infoBox = '<style>' . "\n";
      $infoBox .= '.injectAds { margin-bottom: 30px; }' . "\n";
      $infoBox .= '.injectAds > fieldset { padding: 1rem 1.3rem; position: relative; }' . "\n";
      $infoBox .= '.injectAds > fieldset > legend { position: absolute;top: -12px;left: 50%;margin-left: -75px;background-color: #fff;width: unset !important;padding: 0 10px;text-align: center;font-size: 16px;font-family: "poppins";margin-bottom: 0;color: #ccc; }' . "\n";
      $infoBox .= '</style>' . "\n";
      $infoBox .= '<div class="injectAds"><fieldset><legend>You may like this</legend>'.apply_filters('the_content',$postContent).'</legend></fieldset></div>';
      preg_match_all('/<h2[^>]*>(.*?)<\/h2>/si', $content, $matches);
      if(is_array($matches) && count($matches)>0 && is_array($matches[0]) && count($matches[0])>0) {
        $infoBoxContent = $infoBox.$matches[0][0];
        $pos = strpos($matches[0][0], '<h2');
        if($pos !== false)
          $content = preg_replace('/'.preg_quote($matches[0][0],'/').'/', $infoBoxContent, $content);
      }
      $content.= $infoBox;

      wp_reset_postdata();
    }
  }
  return $content;
}

//update views for article insertion post types
function update_v() {

  $articleInsertionId = $_POST['articleInsertionId'];

  if(isset($articleInsertionId))
  {
    update_article_insertion_views($articleInsertionId);
  }

  die();
}

add_action('wp_ajax_update_v', 'update_v');
add_action('wp_ajax_nopriv_update_v', 'update_v');


add_action( 'single_header_after', 'single_customisation_header_after' );

function single_customisation_header_after() {
	global $post;
	
	$postId = get_the_ID();
	
	echo '<script>' . "\n";
  	echo 'var postID = ' . $postId . "\n";
  	echo 'jQuery( document ).ready( function( $ ) { ' . "\n";
	echo 'var articleInsertionId = 0;' . "\n";

	if( ( ( $post->post_type == 'post' && is_single() && is_singular("post") ) || $post->post_type == 'deal' ) && ( get_field( 'disable_ads_injection', $post->ID ) === false || !get_field( 'disable_ads_injection', $post->ID ) ) ) {
		$roles = get_the_author_meta('roles');
		
		$args = array(
				'posts_per_archive_page'   => 1,
				'post_type'        => 'article_insertion'
		);

		$wp_query_article_insertion = new WP_Query( $args );

		if( $wp_query_article_insertion->have_posts() ) {

			$wp_query_article_insertion->the_post();
			$articleInsertionId = $post->ID;

			wp_reset_postdata();
		
			echo 'articleInsertionId = ' . $articleInsertionId . "\n";
		}
	}
	

	echo 'if( articleInsertionId != 0 ) {' . "\n";
	echo 'jQuery.ajax( { ' . "\n";
	echo 'type: "POST",' . "\n";
	echo 'url: "' . admin_url( 'admin-ajax.php' ) . '",' . "\n";
	echo 'data: {' . "\n";
	echo 'action:"update_v",' . "\n";
	echo 'articleInsertionId: articleInsertionId' . "\n";
	echo '},' . "\n";
	echo 'success: function (result) {' . "\n";
	echo '}' . "\n";
	echo '});' . "\n";
	echo '}' . "\n";
	echo '})' . "\n";
	echo '</script>';

	$colour = "";
	
	if( get_field( "change_border_colour" ) ) {
		$colour = get_field( "change_border_colour" );
	} else if( $iter%3==0 ) {
		$colour = '#ef497f';
		if( get_field( 'first_color', $articleInsertionId ) ) {
			$colour = get_field( 'first_color', $articleInsertionId );
		}
	} else if( $iter%3==1 ) {
		$colour = '#000000';
		if( get_field( 'first_color', $articleInsertionId ) ) {
			$colour = get_field( 'first_color', $articleInsertionId );
		}
	} else {
		$colour = '#FFA500';
		if( get_field( 'first_color', $articleInsertionId ) ) {
			$colour = get_field('first_color',$articleInsertionId);
		}
	}
	
	echo '<style>' . "\n";
	echo 'div.injectAds > fieldset {' . "\n";
	echo 'border: 1px solid ' . $colour . ' !important;' . "\n";
	echo '}' . "\n";
	echo '</style>' . "\n";
}

/*
 *  DVSHA 2021 Listing CPT + Taxonomies starts
 */

function register_dvsha_2021_listing_cpt() {

	/**
	 * Post Type: Spa And Hair Awards 2020.
	 */

	$labels = [
		"name" => __( "Spa And Hair Awards 2021" ),
		"singular_name" => __( "Spa And Hair Awards 2021" ),
	];

	$args = [
		"label" => __( "Spa And Hair Awards 2021" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ 
			"slug" => "best-spa-hair-facials-treatments-singapore/2021/products", 
			"with_front" => false 
		],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "excerpt" ],
	];

	register_post_type( "dvsha_2021_listing", $args );
}

add_action( 'init', 'register_dvsha_2021_listing_cpt' );

function register_dvsha_2021_listing_taxes() {

	/**
	 * Taxonomy: DVSHA 2021 Categories.
	 */

	$labels = [
		"name" => __( "DVSHA 2021 Categories" ),
		"singular_name" => __( "DVSHA 2021 Category" ),
	];

	$args = [
		"label" => __( "DVSHA 2021 Categories" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 
			'slug' => 'best-spa-hair-facials-treatments-singapore/2021/category', 
			'with_front' => false,  
			// 'hierarchical' => true, 
		],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvsha_2021_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
	];
	register_taxonomy( "dvsha_2021_categories", [ "dvsha_2021_listing" ], $args );

	/**
	 * Taxonomy: DVSHA 2021 Brands.
	 */

	$labels = [
		"name" => __( "DVSHA 2021 Brands" ),
		"singular_name" => __( "DVSHA 2021 Brand" ),
	];

	$args = [
		"label" => __( "DVSHA 2021 Brands" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 
			'slug' => 'best-spa-hair-facials-treatments-singapore/2021/brand', 
			'with_front' => false
		],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvsha_2021_brands",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
	];
	register_taxonomy( "dvsha_2021_brands", [ "dvsha_2021_listing" ], $args );

	/**
	 * Taxonomy: DVSHA 2021 Filters.
	 */

	$labels = [
		"name" => __( "DVSHA 2021 Filters" ),
		"singular_name" => __( "DVSHA 2021 Filter" ),
	];

	$args = [
		"label" => __( "DVSHA 2021 Filters" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 
			'slug' => 'best-spa-hair-facials-treatments-singapore/2021', 
			'with_front' => false
		],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "dvsha_2021_filters",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
	];
	register_taxonomy( "dvsha_2021_filters", [ "dvsha_2021_listing" ], $args );
}
add_action( 'init', 'register_dvsha_2021_listing_taxes' );

/*
 *  DVSHA 2021 Listing CPT + Taxonomies ends
 */

function wpb_dvsha_2021_category_menu() {
    register_nav_menu('dvsha-2021-category-menu',__( 'DVSHA 2021 Category Menu' ));
}
add_action( 'init', 'wpb_dvsha_2021_category_menu' );

add_action( 'first-nav', 'dvsha_2021_listing_first_nav', 10, 4 );

function dvsha_2021_listing_first_nav( $fb, $ig, $tw, $ytb ) {
	global $isMobile;
	$prefix = '/best-spa-hair-facials-treatments-singapore/2021/';

	if( !$isMobile ) {
		if( false === ( $content = get_transient( 'dvsha_2021_listing_first_nav' ) ) ) {
			$content = '';
			$content .= '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
			$content .= '<div class="navbar-inner">';
			$content .= '<a class="navbar-brand" href="' . home_url() . '">';
			$content .= '<img src="' . S3_PATH . '/wp-content/uploads/svg/beauty-magazine-daily-vanity-logo.svg" alt="" id="top-logo" />';
			$content .= '</a>';
			$content .= '<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
			$content .= '<span class="navbar-toggler-icon"></span>';
			// $content .= '<span class="navbar-collapse-icon hide"></span>';
			$content .= '</button>';
			$content .= '</div>';
			$content .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
			$content .= '<ul class="navbar-nav mr-auto">';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link top-nav-link" href="' . $prefix . '">Home</a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link top-nav-link" href="' . $prefix . '#winners">Winners</a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link top-nav-link" href="' . $prefix . '#articles">Articles</a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link top-nav-link" href="' . $prefix . '#judges">Judges</a>';
			$content .= '</li>';
			$content .= '</ul>';
			$content .= '</div>';
			$content .= '</nav>';

			set_transient( 'dvsha_2021_listing_first_nav', $content, DAY_IN_SECONDS );
		}
	} else {
		if( false === ( $content = get_transient( 'dvsha_2021_listing_first_nav_mobile' ) ) ) {
			$content = '';
			$content .= '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
			$content .= '<div class="navbar-inner">';
			$content .= '<a class="navbar-brand" href="' . home_url() . '">';
			$content .= '<img src="' . S3_PATH . '/wp-content/uploads/svg/beauty-magazine-daily-vanity-logo.svg" alt="" id="top-logo" />';
			$content .= '</a>';
			$content .= '<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
			$content .= '<span class="navbar-toggler-icon"></span>';
			// $content .= '<span class="navbar-collapse-icon hide"></span>';
			$content .= '</button>';
			$content .= '</div>';
			$content .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
			$content .= '<ul class="navbar-nav mr-auto">';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link top-nav-link" href="' . $prefix . '">Home</a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link" id="winners-dropdown-btn" href="javascript:void(0)">Winners <span class="toggle-icon"><i class="fas fa-plus"></i></span></a>';

			$menu_name = 'dvsha-2021-category-menu'; // specify custom menu slug
		
			if ( $menu_items = wp_get_nav_menu_items( $menu_name ) ) { 	
				$content .= '<ul id="winners-navbar-dropdown">';
				foreach ( (array)$menu_items as $key => $menu_item ) {
					$title = $menu_item->title;
					$url = $menu_item->url;
					$content .= '<li><a href="' . $url . '" target="_blank">' . $title . '</a></li>';
				}
				$content .= '</ul>';
			}

			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link top-nav-link" href="' . $prefix . '#articles">Articles</a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link top-nav-link" href="' . $prefix . '#judges">Judges</a>';
			$content .= '</li>';
			$content .= '</ul>';

			$content .= '<ul class="navbar-nav social-media-nav">';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link" href="' . $fb . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link" href="' . $ig . '" target="_blank"><i class="fab fa-instagram"></i></a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link" href="' . $tw . '" target="_blank"><i class="fab fa-twitter"></i></a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link" href="' . $ytb . '" target="_blank"><i class="fab fa-youtube"></i></a>';
			$content .= '</li>';
			$content .= '</ul>';

			$content .= '</div>';
			$content .= '</nav>';

			set_transient( 'dvsha_2021_listing_first_nav_mobile', $content, DAY_IN_SECONDS );
		}
	}
	
	echo $content;
}

add_action( 'second-nav', 'dvsha_2021_listing_second_nav', 10, 4 );

function dvsha_2021_listing_second_nav( $fb, $ig, $tw, $ytb ) {
	global $isMobile;
	if( !$isMobile ) {
		if( false === ( $content = get_transient( 'dvsha_2021_listing_second_nav' ) ) ) {
			$content = '<div class="container-fluid" style="background-color: #fff;">';
			$content .= '<div class="row m-0 px-0 py-3">';
			$content .= '<div class="col-12 col-md-9 px-4 py-0">';
			$content .= '<div class="input-group input-group-sm search-container">';
			$content .= '<input type="text" class="form-control" aria-label="dvsha search" aria-describedby="dvsha-search" id="dvsha-search-input">';
			$content .= '<span class="input-group-text" id="dvsha-search"><i class="fas fa-search"></i></span>';
			$content .= '</div>';
			$content .= '</div>';
			
			$content .= '<div class="col-md-3 px-3 py-0">';
			$content .= '<ul class="navbar-nav social-media-nav flex-row justify-content-end">';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link" href="' . $fb . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link" href="' . $ig . '" target="_blank"><i class="fab fa-instagram"></i></a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link" href="' . $tw . '" target="_blank"><i class="fab fa-twitter"></i></a>';
			$content .= '</li>';
			$content .= '<li class="nav-item">';
			$content .= '<a class="nav-link" href="' . $ytb . '" target="_blank"><i class="fab fa-youtube"></i></a>';
			$content .= '</li>';
			$content .= '</ul>';
			$content .= '</div>';
				
			$content .= '</div>';
			$content .= '</div>';

			set_transient( 'dvsha_2021_listing_second_nav', $content, DAY_IN_SECONDS );
		}
	} else {
		if( false === ( $content = get_transient( 'dvsha_2021_listing_second_nav_mobile' ) ) ) {
			$content = '<div class="container-fluid" style="background-color: #fff;">';
			$content .= '<div class="row m-0 px-0 py-3">';
			$content .= '<div class="col-12 col-md-9 px-4 py-0">';
			$content .= '<div class="input-group input-group-sm search-container">';
			$content .= '<input type="text" class="form-control" aria-label="dvsha search" aria-describedby="dvsha-search" id="dvsha-search-input">';
			$content .= '<span class="input-group-text" id="dvsha-search"><i class="fas fa-search"></i></span>';
			$content .= '</div>';
			$content .= '</div>';
			$content .= '</div>';
			$content .= '</div>';

			set_transient( 'dvsha_2021_listing_second_nav_mobile', $content, DAY_IN_SECONDS );
		}
	}

	echo $content;
}

function dvsha_load_more_products_shortcode() {
	if( $_POST['k'] ) {
		echo do_shortcode( '[dvsha-2021-search s="' . $_POST['k'] . '" paged="' . $_POST['pageno'] . '"]' );
	} else {
		if( $_POST['brands'] ) {
			$brands = $_POST['brands'];
		} else {
			$brands = '';
		}
	
		if( $_POST['awardtiers'] ) {
			$awards = $_POST['awardtiers'];
		} else {
			$awards = '';
		}
	
		if( $_POST['bodyconcerns'] ) {
			$bodyConcerns = $_POST['bodyconcerns'];
		} else {
			$bodyConcerns = '';
		}
	
		if( $_POST['hairconcerns'] ) {
			$hairConcerns = $_POST['hairconcerns'];
		} else {
			$hairConcerns = '';
		}
	
		if( $_POST['misc'] ) {
			$misc = $_POST['misc'];
		} else {
			$misc = '';
		}
	
		if( $_POST['pricerange'] ) {
			$priceRanges = $_POST['pricerange'];
		} else {
			$priceRanges = '';
		}
	
		if( $_POST['skinconcerns'] ) {
			$skinConcerns = $_POST['skinconcerns'];
		} else {
			$skinConcerns = '';
		}
	
		if( $_POST['skintype'] ) {
			$skinTypes = $_POST['skintype'];
		} else {
			$skinTypes = '';
		}

		echo do_shortcode( '[dvsha-2021-search paged="' . $_POST['pageno'] . '" brands="' . $brands . '" awards="' . $awards . '" bodyconcerns="' . $bodyConcerns . '" hairconcerns="' . $hairConcerns . '" misc="' . $misc . '" priceranges="' . $priceRanges . '" skinconcerns="' . $skinConcerns . '" skintypes="' . $skinTypes . '"]' );
	}

	die();
}

add_action( 'wp_ajax_ajaxDVSHALoadMoreProducts', 'dvsha_load_more_products_shortcode' );
add_action( 'wp_ajax_nopriv_ajaxDVSHALoadMoreProducts', 'dvsha_load_more_products_shortcode' );

function dvsha_2021_register_rest_fields(){
 
    register_rest_field('dvsha_2021_listing',
        'dvsha_2021_listing_image_src',
        array(
            'get_callback'    => 'dvsha_2021_listing_image',
            'update_callback' => null,
            'schema'          => null
        )
    );
 
    register_rest_field('dvsha_2021_listing',
        'dvsha_2021_categories_attr',
        array(
            'get_callback'    => 'dvsha_2021_get_term_callback',
            'update_callback' => null,
            'schema'          => null
        )
    );
 
    register_rest_field('dvsha_2021_listing',
        'dvsha_2021_brands_attr',
        array(
            'get_callback'    => 'dvsha_2021_get_term_callback',
            'update_callback' => null,
            'schema'          => null
        )
    );
 
    register_rest_field('dvsha_2021_listing',
        'dvsha_2021_filters_attr',
        array(
            'get_callback'    => 'dvsha_2021_get_term_callback',
            'update_callback' => null,
            'schema'          => null
        )
    );
 
    register_rest_field('dvsha_2021_listing',
        'custom_field_paid_service',
        array(
            'get_callback'    => 'dvsha_2021_get_field_callback',
            'update_callback' => null,
            'schema'          => null
        )
    );
 
    register_rest_field('dvsha_2021_listing',
        'custom_field_cta_button_text',
        array(
            'get_callback'    => 'dvsha_2021_get_field_callback',
            'update_callback' => null,
            'schema'          => null
        )
    );
 
    register_rest_field('dvsha_2021_listing',
        'custom_field_cta_button_link',
        array(
            'get_callback'    => 'dvsha_2021_get_field_callback',
            'update_callback' => null,
            'schema'          => null
        )
    );
}
add_action('rest_api_init','dvsha_2021_register_rest_fields');
 
function dvsha_2021_listing_image($object,$field_name,$request){
 
    $img = wp_get_attachment_image_src($object['featured_media'],'full');
     
    return $img[0];
}

function dvsha_2021_get_term_callback( $object, $field_name, $request ) {
	$tax = str_replace( '_attr', '', $field_name );
    $terms_result = array();
    $terms =  wp_get_post_terms( $object['id'], $tax );
    foreach ($terms as $term) {
        $terms_result[] = array(
			'id'		=> $term->term_id,
			'name'		=> $term->name,
			'link' 		=> get_term_link($term->term_id),
			'parent'	=> $term->parent
		);
    }
    return $terms_result;
}

function dvsha_2021_get_field_callback( $post, $field_name, $request ) {
	$field = str_replace( 'custom_field_', '', $field_name );
    $fields_result = array();
	$fields_result[] = array(
		'name'		=> $field,
		'value' 	=> get_field( $field, $post['id'] )
	);
    return $fields_result;
}

// insert TG banner

add_action( 'section_before_content', 'section_before_content_callback' );

function section_before_content_callback() {
	$content = '';

	$content .= '<div class="container-fluid p-0">' . "\n";
	$content .= "\t". '<div class="row no-gutters">' . "\n";
	$content .= "\t\t". '<div class="col text-center" style="margin-top: 80px;">' . "\n";
	$content .= "\t\t\t". '<a href="https://dv.sg/telegram-banner" target="_blank" title="We\'re Now On Telegram"><img src="https://uploads.dailyvanity.sg/wp-content/uploads/2021/09/daily-vanity-beauty-magazine-singapore-telegram-Banner-1.jpg?v=' . DEPLOY_VERSION . '" alt="We\'re Now On Telegram" style="width: 100%; height: auto; max-width: 700px;"  /></a>' . "\n";
	$content .= "\t\t". '</div>' . "\n";
	$content .= "\t". '</div>' . "\n";
	$content .= '</div>' . "\n";

	echo $content;
}

// Dyson Outbrain Shortcode
function get_dyson_outbrain_pixel() {
	$content = '';
	$content .= <<<SD
		<script data-obct type = "text/javascript">
			/** DO NOT MODIFY THIS CODE**/
			!function(_window, _document) {
			    var OB_ADV_ID = '0086e074c80e36ded3bca85f100eee8fc2';
			    if (_window.obApi) {
			      var toArray = function(object) {
				return Object.prototype.toString.call(object) === '[object Array]' ? object : [object];
			      };
			      _window.obApi.marketerId = toArray(_window.obApi.marketerId).concat(toArray(OB_ADV_ID));
			      return;
			    }
			    var api = _window.obApi = function() {
			      api.dispatch ? api.dispatch.apply(api, arguments) : api.queue.push(arguments);
			    };
			    api.version = '1.1';
			    api.loaded = true;
			    api.marketerId = OB_ADV_ID;
			    api.queue = [];
			    var tag = _document.createElement('script');
			    tag.async = true;
			    tag.src = '//amplify.outbrain.com/cp/obtp.js';
			    tag.type = 'text/javascript';
			    var script = _document.getElementsByTagName('script')[0];
			    script.parentNode.insertBefore(tag, script);
			  }(window, document);

		  	obApi('track', 'PAGE_VIEW');
		</script>
	SD;
	
	return $content;
}
add_shortcode( 'dyson-outbrain-pixel', 'get_dyson_outbrain_pixel' );

function top_header_bar_cart_callback() {
	echo "<script>";
	echo "\tjQuery( document ).ready( function( $ ) { \n";
	echo "$('#cart_totals').text(Cookies.get('CARTCOUNT'))";
	echo '})' . "\n";
	echo "</script>";
	echo "<div id='et_top_search' class='cart'>\n";
	echo "\t<div class='header-cart-info'>\n";
	echo "\t\t<a href=" . SF_LINK. "/cart title='View your shopping cart' class='et-cart-info header-total-car-count'>\n";
	echo "\t\t\t<span class='cart-count'><span class='count cart_totals' id='cart_totals'>0</span></span>\n";
	echo "\t\t</a>\n"; 
	echo "\t</div>\n";
	echo "</div>\n";
}
add_action( 'top_header_bar_cart', 'top_header_bar_cart_callback', 20 );

add_action( 'section_after_content', 'display_article_content_upgrade' );
function display_article_content_upgrade() {
	echo do_shortcode('[content-upgrade]');
}