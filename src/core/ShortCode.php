<?php

namespace DV\core;

class ShortCode {
  private static $_registerCode = [
    'list-posts'=>['\DV\shortcodes\ListPosts\ListPosts', 'init'],
    'section-header'=>['\DV\shortcodes\SectionHeader\SectionHeader', 'init'],
    'section-author'=>['\DV\shortcodes\AuthorSection\AuthorSection', 'init'],
    'top-header-bar'=>['\DV\shortcodes\TopHeaderBar\TopHeaderBar', 'init'],
    'search-bar'=>['\DV\shortcodes\SearchBar\SearchBar', 'init'],
    'popular-searches'=>['\DV\shortcodes\PopularSearches\PopularSearches', 'init'],
    'search-results'=>['\DV\shortcodes\SearchResults\SearchResults', 'init'],
    'featured-daily-tips'=>['\DV\shortcodes\FeaturedDailyTips\FeaturedDailyTips', 'init'],
    'beauty-newsfeed'=>['\DV\shortcodes\BeautyNewsfeed\BeautyNewsfeed', 'init'],
    'featured-articles'=>['\DV\shortcodes\FeaturedArticles\FeaturedArticles', 'init']
  ];

  public static function Add($key, $class) {
    self::$_registerCode = array_merge(self::$_registerCode, [$key=>$class]);
  }

  public static function Del($key) {
    if(isset(self::$_registerCode[$key])) {
      unset(self::$_registerCode[$key]);
    }
  }

  public static function init() {
    foreach(self::$_registerCode as $key=>$class) {
      add_shortcode($key, $class);
    }
  }
}