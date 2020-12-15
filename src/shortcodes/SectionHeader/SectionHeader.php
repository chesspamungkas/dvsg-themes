<?php
namespace DV\shortcodes\SectionHeader;
use DV\base\ShortCode;

class SectionHeader extends ShortCode {
  private $search_args = null;
  public static function init($args) {
    $model = new SectionHeader();
    $model->search_args = shortcode_atts(array(
      'header' => "Header",
      'subheader'=>''
    ),$args);
    $model->generate();
  }

  public function generate() {
    echo $this->render('SectionHeader/display', $this->search_args);
  }
}