<?php

namespace DV\sidebars;

use DV\core\SideBar;

class FooterOne
{
  public static function init()
  {
    return array_merge(
      SideBar::$commonArgs,
      [
        'name'        => "Footer #1",
        'id'          => 'footer-1',
        'description' => "One Column Footer #1",
      ]
    );
  }
}
