<?php
namespace DV\core;

class SearchAjax {
  public static function init() {
    $keyword = $_POST[ 'keyword' ];

    // print_r( $keyword );

    $args = array(  
      'post_type' => 'search-terms',
      'post_status' => 'publish',
      'posts_per_page' => -1, 
      'orderby' => 'date', 
      'order' => 'desc', 
      's' => $keyword
    );

    $terms = new \WP_Query( $args );

    $result = array();

    foreach( $terms->posts as $term ) {
      $result[] = $term->post_title;
    }
    
    // echo $_POST['pageno'];

    print_r( json_encode( $result ) );

    wp_die();
  }
}