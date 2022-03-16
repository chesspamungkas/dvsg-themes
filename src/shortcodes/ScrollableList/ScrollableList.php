<?php
namespace DV\shortcodes\ScrollableList;
use DV\base\ShortCode;
use DV\core\BaseStyle;

class ScrollableList extends ShortCode {

  public $attributes = [];

  public static $SCROLLABLE_LIST_BEFORE_ITEM_TITLE = "SCROLLABLE_LIST_BEFORE_ITEM_TITLE";
  public static $SCROLLABLE_LIST_AFTER_ITEM_TITLE = "SCROLLABLE_LIST_AFTER_ITEM_TITLE";
  public static $SCROLLABLE_LIST_TITLE_FILTER = "SCROLLABLE_LIST_TITLE_FILTER";

  public static $SCROLLABLE_LIST_BEFORE_ITEM_LINK = "SCROLLABLE_LIST_BEFORE_ITEM_LINK";
  public static $SCROLLABLE_LIST_AFTER_ITEM_LINK = "SCROLLABLE_LIST_AFTER_ITEM_LINK";


  public static $SCROLLABLE_LIST_QUERY_FILTER = "SCROLLABLE_LIST_QUERY_FILTER";
  public static $SCROLLABLE_ITEM_VIEW_MORE_BTN_TEXT = "SCROLLABLE_ITEM_VIEW_MORE_BTN_TEXT";

  public static function init($args) {
    $model = new ScrollableList();

    $model->attributes = shortcode_atts( array(
      'paged'=> 1,
      'filter'=>null,
      'order'=>'rand',
      'order_by'=>null,
      'posts_per_page'=>11,
      'id'=>'SCROLLABLE_LIST',
      'title'=>'',
      'title_link'=>'',
      'identifier'=>null,
      'item_show'=>5
    ), $args );
    return $model->generate();
  }

  public static function registerLibaray() {
    BaseStyle::AddScript('scrollableListScript', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
    BaseStyle::AddStyle('scrollableListStyle', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
  }


  public function makeQuery() {    
    $query = [
      'tax_query'=> [],  
      'posts_per_page' => $this->attributes['posts_per_page'],
      'post_status' => 'publish',
      'paged' => $this->attributes['paged'],
      'orderby'=>$this->attributes['order']
    ];

    if($this->attributes['filter']) {
      $query['s'] = $this->attributes['filter'];
    }

    if( $this->attributes['order_by'] ) {      
      $query['orderby'] = $this->attributes['order_by'];
      $query['order'] = $this->attributes['order'];
    }

    $query = apply_filters(self::$SCROLLABLE_LIST_QUERY_FILTER, $query, $this->attributes);
    return new \WP_Query($query);
  }

  public function generate() {
    $query = $this->makeQuery();
    return $this->render('ScrollableList/display', [
      'query' => $query,
      'id'=>$this->attributes['id'],
      'title'=>$this->attributes['title'],
      'titleLink'=>$this->attributes['title_link'],
      'item_show'=>$this->attributes['item_show']
    ]);
  }
}