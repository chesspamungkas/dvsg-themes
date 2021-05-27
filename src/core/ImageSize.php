<?php
namespace DV\core;

class ImageSize {

  private static $_registeredImageSize = [
    'list-post'=>[340, 190, true],
    'full-size'=>[900, 467, true],
    'article-page-image'=>[ 760, 394, true],
    'article-thumbnail'=>[ 506, 262, true],
    'article-thumbnail-mobile'=>[ 189, 98, true],
    'article-thumbnail-segment-mobile'=>[ 454, 236, true],
    'related-article-thumbnail'=>[ 244, 127, true],
    'related-article-thumbnail-mobile'=>[ 358, 186, true],
    'daily-tips-thumbnail'=>[ 439, 553, true],
    'daily-tips-thumbnail-mobile'=>[ 450, 567, true],
    'dv-splash-image'=>[ 400, 520, true],
    'dv-splash-image-mobile'=>[ 320, 416, true],
    'article-featured'=>[506, 262, true],
    'shopable-image'=>[409, 522, true],
    'sml_size'=>[300, 0, false],
    'mid_size'=>[600, 0, false],
    'lrg_size'=>[1200, 0, false],
    'sup_size'=>[2400, 0, false]
  ];
  public static function Add($key, $width=0, $height=0, $crop=false) {
    self::$_registeredImageSize = array_merge(self::$_registerCode, [$key=>[$width, $height, $crop]]);
  }

  public static function Del($key) {
    if(isset(self::$_registeredImageSize[$key])) {
      unset(self::$_registeredImageSize[$key]);
    }
  }

  public static function init() {
    foreach(self::$_registeredImageSize as $key=>$imageSize) {
      add_image_size( $key, $imageSize[0], $imageSize[1], $imageSize[2] );
    }
  }
}