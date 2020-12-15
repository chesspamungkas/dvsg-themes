<?php
namespace DV\shortcodes\PopularSearches;
use DV\base\ShortCode;

class PopularSearches extends ShortCode {
  public static function init( $args ) {
    $model = new PopularSearches();
    $model->args = shortcode_atts( array(
    //   'header' => "Header",
    //   'subheader'=>''
    ), $args );
    $model->generate();
  }

  public function generate() {
    $args = array(  
      'post_type' => 'search-terms',
      'post_status' => 'publish',
      'posts_per_page' => 10, 
      'orderby' => 'date', 
      'order' => 'desc'
    );

    $terms = new \WP_Query( $args );

    echo $this->render('PopularSearches/display', [
      'terms' => $terms->posts,
    ] );
  }
}