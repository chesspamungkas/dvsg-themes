<?php
namespace DV;

class DailyVanity {
  static function init() {
    $own = new DailyVanity();
    $own->_init();
    define('DV_SHORTCODE_PATH', __DIR__.'/shortcodes/');
  }
  private function _init() {
    add_action( 'wp_enqueue_scripts', ['\DV\core\BaseStyle', 'init'] );
    core\Menu::init();
    core\ShortCode::init();
    core\ImageSize::init();
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