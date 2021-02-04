<?php
namespace DV\shortcodes\FeaturedArticles;
use DV\base\ShortCode;

class FeaturedArticles extends ShortCode {
  private $search_args = null;

  private $additional_args = [
    // 'title'=>"1"
  ];

  public static function init($args) {
    $model = new FeaturedArticles();

    $model->search_args = shortcode_atts( array(
      'pagename'  => 'featured-articles-configure'
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
    
    // if( isset( $args['title'] ) ) {
    //   $model->additional_args['title'] = $args['title'];
    // }
 
    $model->additional_args = array_merge($model->additional_args, $model->search_args);
    $model->generate();
  }

  public function getTitle( $postID ) {
    // global $post;

    $categories = get_the_category( $postID );

    // print_r( $categories );

    $content = '';

    $count = 1;

    $totalCat = count( $categories );
    
    foreach( $categories as $cat ) {
      // print_r( $cat );
      $catLink = get_category_link( $cat->term_id );
      $content .= '<a href="' . esc_url( $catLink ) . '" class="category-link poppins-light" target="_blank">' . $cat->name . '</a>';

      if( $count < $totalCat ) {
        $content .= ', ';
      }
      $count++;
    }
      
    if( !empty( $content ) ) {
      return $content;
    } else {
      return "No Title";
    }
  }

  public function pagination() {
  }

  public function generate() {
    $postID = array();

    $page = new \WP_Query( $this->search_args );

    $articles = get_field( 'articles_order', $page->posts[0]->ID );

    foreach( $articles as $article ) {
      $postID[] = $article['articles']->ID;
    }

    // print_r( $postID );

    $args = array(
      'posts_per_page' => 3,
      'orderby' => 'post__in',
      'post__in' => $postID
    );

    $posts = get_posts( $args );

    echo $this->render('FeaturedArticles/display', [
      'posts' => $posts
    ]);
  }
}