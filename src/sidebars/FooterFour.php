<?php

namespace DV\sidebars;

use DV\core\SideBar;

class FooterFour
{
  public static function init()
  {
    return array_merge(
      SideBar::$commonArgs,
      [
        'name'        => "Footer #4",
        'id'          => 'footer-4',
        'description' => "One Column Footer #4",
      ]
    );
  }
}
