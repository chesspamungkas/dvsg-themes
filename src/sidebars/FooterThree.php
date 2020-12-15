<?php 
namespace DV\sidebars;

use DV\core\SideBar;

class FooterThree {
  public static function init() {
    return array_merge(
      SideBar::$commonArgs,
      [
        'name'        => "Footer #3",
        'id'          => 'footer-3',
        'description' => "One Column Footer #3",
      ]
    );
  }
}