<?php
namespace DV\shortcodes\DVBAAwardsList;
use DV\base\ShortCode;
use DV\core\BaseStyle;

class DVBAAwardsList extends ShortCode {

  public $attributes = [];

  public static $DVBA_AWARDS_CONTAINER_CLASS = "DVBA_AWARDS_CONTAINER_CLASS";

  public static function init($args) {
    $model = new DVBAAwardsList();

    $model->attributes = shortcode_atts( array(
      'taxonomy'=> '',
      'post_id'=>0
    ), $args );
    return $model->generate();
  }

  public static function registerLibaray() {
    // BaseStyle::AddScript('scrollableListScript', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
    // BaseStyle::AddStyle('scrollableListStyle', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
  }

  public function generate() {
    $terms = get_the_terms($this->attributes['post_id'], $this->attributes['taxonomy']);
    if(!$terms or $terms instanceof \WP_Error) {
      return "";
    }
    return $this->render('DVBAAwardsList/display', [
      'terms' => $terms,
      'post_id'=>$this->attributes['post_id']
    ]);
  }
}