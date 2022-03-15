<?php
namespace DV\shortcodes\CommonListPosts;
use DV\base\ShortCode;
use DV\core\BaseStyle;

class CommonListPosts extends ShortCode {

  public $attributes = [];

  public static $COMMON_LIST_POST_BEFORE_ITEM_TITLE = "COMMON_LIST_POST_BEFORE_ITEM_TITLE";
  public static $COMMON_LIST_POST_AFTER_ITEM_TITLE = "COMMON_LIST_POST_AFTER_ITEM_TITLE";

  public static $COMMON_LIST_POST_BEFORE_ITEM_LINK = "COMMON_LIST_POST_BEFORE_ITEM_LINK";
  public static $COMMON_LIST_POST_AFTER_ITEM_LINK = "COMMON_LIST_POSTT_AFTER_ITEM_LINK";


  public static $COMMON_LIST_POST_QUERY_FILTER = "SCROLLABLE_LIST_QUERY_FILTER";
  public static $COMMON_LIST_POST_VIEW_DETAIL_BTN_TEXT = "SCROLLABLE_ITEM_VIEW_MORE_BTN_TEXT";

  public static function init($args) {
    $model = new CommonListPosts();

    $model->attributes = shortcode_atts( array(
      'paged'=> 1,
      'filter'=>null,
      'order'=>'rand',
      'order_by'=>null,
      'posts_per_page'=>11,
      'id'=>'COMMON_LIST_POST',
      'title'=>'',
      'title_link'=>'',
      'identifier'=>null
    ), $args );
    return $model->generate();
  }

  public static function registerLibaray() {
    // BaseStyle::AddScript('scrollableListScript', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
    // BaseStyle::AddStyle('scrollableListStyle', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
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

    $query = apply_filters(self::$COMMON_LIST_POST_QUERY_FILTER, $query, $this->attributes);
    return new \WP_Query($query);
  }

  public function generate() {
    $query = $this->makeQuery();
    return $this->render('CommonListPosts/display', [
      'query' => $query,
      'id'=>$this->attributes['id'],
      'title'=>$this->attributes['title'],
      'titleLink'=>$this->attributes['title_link'],
      'item_show'=>$this->attributes['item_show']
    ]);
  }
}