<?php
namespace DV\shortcodes\AuthorSection;
use DV\base\ShortCode;

class AuthorSection extends ShortCode {
  private $search_args = null;
  public static function init($args) {
    $model = new AuthorSection();
    $model->search_args = shortcode_atts(array(
      'additional_class' => "",      
    ),$args);
    $model->generate();
  }

  public function generate() {
    echo $this->render('AuthorSection/display', $this->search_args);
  }
}