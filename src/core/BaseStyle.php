<?php

namespace DV\core;

class BaseStyle
{
  private static $_registeredStyle = [
    // 'fontawesome-css'=>['https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css'],
    'fonts' => ['https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap'],
    'jquery-ui-css' => ['https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css']
  ];

  private static $_registeredScript = [
    'boot2' => ['https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 'jquery', true],
    'boot3' => ['https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', 'jquery', true],
    'jquery-ui' => ['https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', 'jquery', true]
  ];
  static function init()
  {
    self::AddScript('DV_coreScript', get_template_directory_uri() . '/src/.dist/index.js', 'jquery', true);
    self::AddStyle('DV_coreStyle', get_template_directory_uri() . '/src/.dist/index.css');
    add_action('wp_enqueue_scripts', [__CLASS__, 'registerScript']);
    add_action('wp_enqueue_scripts', [__CLASS__, 'registerStyle']);
  }

  public static function registerScript()
  {
    foreach (self::$_registeredScript as $key => $script) {
      wp_enqueue_script($key, $script[0], array_key_exists(1, $script) ? $script[1] : [], DEPLOY_VERSION, array_key_exists(2, $script) ? $script[2] : false);
    }
  }

  public static function registerStyle()
  {
    foreach (self::$_registeredStyle as $key => $style) {
      wp_enqueue_style($key, $style[0], array_key_exists(1, $style) ? $style[1] : [], DEPLOY_VERSION, array_key_exists(2, $style) ? $style[2] : false);
    }
  }

  public static function AddStyle($key, $link, $dependency = [], $footer = false)
  {
    self::$_registeredStyle = array_merge(self::$_registeredStyle, [$key => [$link, $dependency, $footer]]);
  }

  public static function DelStyle($key)
  {
    if (isset(self::$_registeredStyle[$key])) {
      unset(self::$_registeredStyle[$key]);
    }
  }

  public static function AddScript($key, $link, $dependency = [], $footer = false)
  {
    self::$_registeredScript = array_merge(self::$_registeredScript, [$key => [$link, $dependency, $footer]]);
  }

  public static function DelScript($key)
  {
    if (isset(self::$_registeredScript[$key])) {
      unset(self::$_registeredScript[$key]);
    }
  }
}
