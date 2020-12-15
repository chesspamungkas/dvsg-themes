<?php
namespace DV\shortcodes\SearchBar;
use DV\base\ShortCode;

class SearchBar extends ShortCode {
  public static function init( $args ) {
    $model = new SearchBar();
    $model->args = shortcode_atts( array(
    //   'header' => "Header",
    //   'subheader'=>''
    ), $args );
    $model->generate();
  }

  public function generate() {
    echo $this->render('SearchBar/display', $this->args);
  }
}