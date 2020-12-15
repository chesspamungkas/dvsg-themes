<?php 

namespace DV\core;

class Widget {
  private static $_registerWidget = [
    'oneCol'=>'\DV\widgets\FooterOneWidget'
  ];

  public static function Add($key, $widget) {
    self::$_registerWidget = array_merge(self::$_registerWidget, [$key=>$widget]);
  }

  public static function Del($key) {
    if(isset(self::$_registerWidget[$key])) {
      unset(self::$_registerWidget[$key]);
    }
  }

  public static function init() {
    foreach(self::$_registerWidget as $key=>$widget) {
      register_widget(new $widget());
    }
  }
}