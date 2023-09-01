<?php

namespace DV\sidebars;

use DV\core\SideBar;

class FooterTwo
{
  public static function init()
  {
    return array_merge(
      SideBar::$commonArgs,
      [
        'name'        => "Footer #2",
        'id'          => 'footer-2',
        'description' => "One Column Footer #2",
      ]
    );
  }
}
