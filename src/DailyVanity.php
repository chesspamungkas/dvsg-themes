<?php
namespace DV;

class DailyVanity {
  static function init() {
    $own = new DailyVanity();
    $own->_init();
    define('DV_SHORTCODE_PATH', __DIR__.'/shortcodes/');
  }
  private function _init() {
    add_action( 'wp_enqueue_scripts', ['\DV\scripts\BaseStyle', 'init'] );
    core\Menu::init();
    core\ShortCode::init();
    add_image_size( 'list-post', '340', '190', true );
    add_image_size( 'full-size', '900', '467', true );
    add_image_size( 'article-thumbnail', '506', '262', true );
    add_image_size( 'article-featured', '760', '394', true );
    add_image_size( 'sml_size', 300 ); 
    add_image_size( 'mid_size', 600 ); 
    add_image_size( 'lrg_size', 1200 ); 
    add_image_size( 'sup_size', 2400 );
    add_action( 'widgets_init', ['\DV\core\Widget', 'init'] );
    add_action( 'widgets_init', ['\DV\core\SideBar', 'init'] );
    add_action( 'wp_ajax_ajaxCallListPosts', ['\DV\core\Ajax', 'init'] );
    add_action( 'wp_ajax_nopriv_ajaxCallListPosts', ['\DV\core\Ajax', 'init'] );
    add_action( 'wp_ajax_ajaxLoadMoreStories', ['\DV\core\NewsfeedAjax', 'init'] );
    add_action( 'wp_ajax_nopriv_ajaxLoadMoreStories', ['\DV\core\NewsfeedAjax', 'init'] );
    add_action( 'wp_ajax_ajaxCallSearchResults', ['\DV\core\SearchResultAjax', 'init'] );
    add_action( 'wp_ajax_nopriv_ajaxCallSearchResults', ['\DV\core\SearchResultAjax', 'init'] );
  }
}