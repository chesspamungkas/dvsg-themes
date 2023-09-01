<?php

namespace DV\core;

class Ajax
{
  public static function init()
  {
    if ($_POST['isCategory']) {
      echo do_shortcode('[list-posts paged=' . $_POST['pageno'] . ' cat="' . $_POST['categoryID'] . '" title="0"]');
    } elseif ($_POST['isAuthor']) {
      echo do_shortcode('[list-posts paged=' . $_POST['pageno'] . ' author="' . $_POST['authorID'] . '" title="0"]');
    } else {
      echo do_shortcode('[list-posts paged=' . $_POST['pageno'] . ' title="1"]');
    }
    wp_die();
  }
}
