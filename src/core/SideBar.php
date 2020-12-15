<?php 

namespace DV\core;

class SideBar {
  private static $_registerSideBar = [
    'FooterOne'=>['\DV\sidebars\FooterOne', 'init'],
    'FooterTwo'=>['\DV\sidebars\FooterTwo', 'init'],
    'FooterThree'=>['\DV\sidebars\FooterThree', 'init'],
    'FooterFour'=>['\DV\sidebars\FooterFour', 'init'],
  ];

  public static $commonArgs = [
    'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
  ];

  public static function Add($key, $SideBar) {
    self::$_registerSideBar = array_merge(self::$_registerSideBar, [$key=>$SideBar]);
  }

  public static function Del($key) {
    if(isset(self::$_registerSideBar[$key])) {
      unset(self::$_registerSideBar[$key]);
    }
  }

  public static function init() {
    foreach(self::$_registerSideBar as $key=>$SideBar) {
      register_sidebar(call_user_func($SideBar[0].'::'.$SideBar[1]));
    }
  }
}