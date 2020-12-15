<?php
namespace DV\core;

class NewsfeedAjax {
  public static function init() {
    if( $_POST['cat'] > 0 ) {
      echo do_shortcode( '[beauty-newsfeed paged=' . $_POST['pageno'] . ' cat="' . $_POST['cat'] . '" featured="0"]' );
    } elseif( $_POST['author'] > 0 ) {
      echo do_shortcode( '[beauty-newsfeed paged=' . $_POST['pageno'] . ' author="' . $_POST['author'] . '" featured="0"]' );
    } elseif( $_POST['tag_id'] > 0 ) {
      echo do_shortcode( '[beauty-newsfeed paged=' . $_POST['pageno'] . ' tag_id="' . $_POST['tag_id'] . '" featured="0"]' );
    } elseif( !empty( $_POST['s'] ) ) {
      echo do_shortcode( '[beauty-newsfeed paged=' . $_POST['pageno'] . ' s="' . urldecode( $_POST['s'] ) . '" featured="0"]' );
    } else {
      echo do_shortcode( '[beauty-newsfeed paged=' . $_POST['pageno'] . ' featured="0"]' );
    }
    
    die();
  }
}