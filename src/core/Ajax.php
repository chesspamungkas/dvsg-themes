<?php
namespace DV\core;

class Ajax {
  public static function init() {
    // print_r( $_POST );

    if( $_POST['isCategory'] ) {
      // print_r( 'category' );
      echo do_shortcode( '[list-posts paged=' . $_POST['pageno'] . ' cat="'. $_POST['categoryID'] .'" title="0"]' );
    } elseif( $_POST['isAuthor'] ) {
      // print_r( 'author' );
      echo do_shortcode( '[list-posts paged=' . $_POST['pageno'] . ' author="'. $_POST['authorID'] .'" title="0"]' );
    } else {
      echo do_shortcode( '[list-posts paged=' . $_POST['pageno'] . ' title="1"]' );
    }
    
    // echo $_POST['pageno'];
    die();
  }
}