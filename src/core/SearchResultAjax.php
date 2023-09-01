<?php

namespace DV\core;

class SearchResultAjax
{
    public static function init()
    {

        echo do_shortcode('[search-results paged=' . $_POST['pageno'] . ' s="' . $_POST['keyword'] . '"]');

        wp_die();
    }
}
