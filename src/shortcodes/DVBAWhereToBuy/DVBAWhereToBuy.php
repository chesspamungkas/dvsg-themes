<?php
namespace DV\shortcodes\DVBAWhereToBuy;
use DV\base\ShortCode;
use DV\core\BaseStyle;

class DVBAWhereToBuy extends ShortCode {

  public $attributes = [];

  public static $DVBA_WHERE_TO_BUY_TITLE = "DVBA_WHERE_TO_BUY_TITLE";
  public static $DVBA_WHERE_TO_BUY_BUTTON_CLASS = "DVBA_WHERE_TO_BUY_BUTTON_CLASS";

  public static function init($args) {
    $model = new DVBAWhereToBuy();

    $model->attributes = shortcode_atts( array(
      'post_id'=>0
    ), $args );
    return $model->generate();
  }

  public static function registerLibaray() {
    // BaseStyle::AddScript('scrollableListScript', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
    // BaseStyle::AddStyle('scrollableListStyle', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
  }

  public function generate() {
    $external_links = get_field('external_links', $this->attributes['id']);
    return $this->render('DVBAWhereToBuy/display', [
      'external_links' => $external_links,
    ]);
  }
}