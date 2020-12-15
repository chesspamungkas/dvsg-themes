<?php
namespace DV\core;

class Menu {
  public static function init() {
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'THEMENAME' ),
    ));
    register_nav_menus( array(
      'footer' => __( 'Footer Menu', 'THEMENAME' ),
    ));
  }
  
}