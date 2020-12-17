<?php
namespace DV\shortcodes\ContentUpgrade;
use DV\base\ShortCode;

class ContentUpgrade extends ShortCode {
  private $search_args = null;

  private $additional_args = [
    'title'=>"1"
  ];

  public static function init($args) {
    $model = new ContentUpgrade();

    $model->search_args = shortcode_atts( array(
      'title' => "1",
    ), $args );

    foreach($model->additional_args as $key=>$value) {
      if( isset($model->search_args[$key]) ) {
        unset($model->search_args[$key]);
      }
    }

    foreach( $model->search_args as $k=>$v ) {
      if( !$model->search_args[$k] ) {
        unset( $model->search_args[$k] );
      }
    }

    // Beauty Reads title = 1, Author page title = 0, Category page title = 2 
    if( isset( $args['title'] ) ) {
      $model->additional_args['title'] = $args['title'];
    }
 
    $model->additional_args = array_merge($model->additional_args, $model->search_args);
    $model->generate();
  }

  // public function getTitle( $keyword=null ) {
  //   global $post;

  //   $categories = get_the_category( $post->ID );
  //   $totalCat = count($categories);

  //   $content = '';
    
  //   $count = 1;

  //   foreach( $categories as $cat ) {
  //     $catLink = get_category_link( $cat->term_id );
  //     $content .= '<a href="' . esc_url( $catLink ) . '" class="category-link poppins-regular">' . $cat->name . '</a>';

  //     if( $count < $totalCat ) {
  //       $content .= ', ';
  //     }

  //     $count++;
  //   }
      
  //   return $content;
  // }

  public function generate() {
    global $post;

    $segment = get_field( 'segment', $post->ID );

    echo $this->render('ContentUpgrade/display', [
      'post'=>$post,
      'segment'=>$segment,
      'args'=>$this->additional_args
    ]);
  }
}