<?php
namespace DV\shortcodes\FeaturedDailyTips;
use DV\base\ShortCode;

class FeaturedDailyTips extends ShortCode {
  public static $tipOrder;
  public static $pageID;

  // public function __construct() {
  //   parent::__construct();
  // }

  public static function init( $args ) {
    $model = new FeaturedDailyTips();
    $model->args = shortcode_atts( array(
    //   'header' => "Header",
    //   'subheader'=>''
    ), $args );
    $model->generate();
  }

  public function generate() {
    $args = array(  
      'post_type' => 'page',
      'post_status' => 'publish',
      'pagename' => 'daily-tips-configure'
    );

    $page = new \WP_Query( $args );

    $tipID = get_field( 'tips_id', $page->queried_object_id );
    $tipOrder = get_field( 'order_id', $page->queried_object_id );
    $tipDate = date( 'd/m/Y', strtotime( str_replace('/', '-', get_field( 'display_date', $page->queried_object_id ) ) ) );

    // print_r( $tipDate );
    // print_r( date( 'd/m/Y', strtotime( str_replace('/', '-', $tipDate ) ) ) );
    // print_r( current_time( 'd/m/Y' ) );

    // print_r( get_field( 'tipsorder', $page->queried_object_id ) );

    if( $tipDate == current_time( 'd/m/Y' ) ) {
      $tip = get_post( $tipID );
    } else {
      $group = get_field( 'tipsorder', $page->queried_object_id );
      $totalTip = COUNT( $group );

      if( $tipOrder+1 >= $totalTip ) {
        $tipOrder = 0;
      } else {
        $tipOrder = $tipOrder + 1;
      }

      $tipID = $group[$tipOrder]['tips']->ID;
      $tipDate = current_time( 'd/m/Y' );

      $tip = get_post( $tipID );

      update_field( 'tips_id', $tipID, $page->queried_object_id );
      update_field( 'order_id', $tipOrder, $page->queried_object_id );
      update_field( 'display_date', $tipDate, $page->queried_object_id );
    }

    $this->setTipOrder( $tipOrder );
    $this->setPageID( $page->queried_object_id );

    echo $this->render('FeaturedDailyTips/display', [
      'tip' => $tip,
      'orderNo' => $tipOrder
    ] );
  }

  function setTipOrder( $orderNo ) {
    self::$tipOrder = $orderNo;
  }

  function getTipOrder() {
    return self::$tipOrder;
  }

  function setPageID( $id ) {
    self::$pageID = $id;
  }

  function getPageID() {
    return self::$pageID;
  }
}