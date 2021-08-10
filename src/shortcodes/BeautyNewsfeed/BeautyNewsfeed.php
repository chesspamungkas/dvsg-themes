<?php
namespace DV\shortcodes\BeautyNewsfeed;
use DV\base\ShortCode;
use DV\shortcodes\FeaturedDailyTips\FeaturedDailyTips;

class BeautyNewsfeed extends ShortCode {
  private $search_args = null;

  private $additional_args = [
    'title'=>"1"
  ];

  public static function init($args) {
    $model = new BeautyNewsfeed();

    $model->search_args = shortcode_atts( array(
      'posts_per_page' => 12,
      'offset'  => 0,
      'paged' => 1,
      'orderby' => 'date',
      'title' => "1",
      'titlename' => "Related Articles",
      'author' => 0,
      'cat' => 0,
      'tag_id' => 0,
      'post_status' => 'publish',
      's' => '',
      'featured' => 1,
      'post__not_in' => [],
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
    
    if( isset( $args['title'] ) ) {
      $model->additional_args['title'] = $args['title'];
    }
 
    $model->additional_args = array_merge($model->additional_args, $model->search_args);
    $model->generate();
  }

  public function getCatTitle( $catID ) {
    $category = get_the_category_by_ID( $catID );

    return $category;
  }

  public function getTitle() {
    global $post;

    $content = '';

    if( $post->post_type == 'deal' ) {
      $content .= '<a href="' . BASE_PATH . '/deal/" class="category-link poppins-light" target="_blank">' . PERKS . '</a>';
    } elseif( $post->post_type == 'sf_promotions' ) {
      $content .= '<a href="' . SF_LINK . '" class="category-link poppins-light" target="_blank" rel="noopener noreferrer">' . SALON_FINDER . '</a>';
    // } elseif( $post->post_type == 'post' ) {
    } else {
      $categories = get_the_category( $post->ID );

      // print_r( $categories );

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
    }
      
    if( !empty( $content ) ) {
      return $content;
    } else {
      return "";
    }
  }

  public function pagination() {
  }

  public function generate() {
    global $post;
    // $tip = new FeaturedDailyTips();
    // print_r( 'Tip Order: ' . FeaturedDailyTips::getTipOrder() );

    if( $this->additional_args['title'] == 2 ) {
      $this->search_args['post__not_in'] = array( $post->ID );
      $this->additional_args['post__not_in'] = array( $post->ID );
    }

    $offset = ( $this->additional_args['paged'] - 1 ) * $this->additional_args['posts_per_page'];
    $this->search_args['offset'] = $offset;
    $this->additional_args['offset'] = $offset;

    if( !empty( $this->search_args['s'] ) ) {
      // $posts->parse_query( $args );
      // relevanssi_do_query( $posts );
      $this->search_args['relevanssi'] = true;
      $this->search_qrgs['orderby'] = 'relevanssi_hits';
    }

    $posts = new \WP_Query( $this->search_args );

    // print_r( $posts );

    if( empty( $this->search_args['s'] ) ) {
      $returnPosts = apply_filters_ref_array( 'beauty_newsfeed_filters', [ $posts, $this->additional_args ] );
    } else {
      $returnPosts = $posts;
    }

    // print_r( $returnPosts );

    if( $this->search_args['paged'] > 1 ) {
      echo $this->render('BeautyNewsfeed/_item', [
        'posts'         => $returnPosts,
        'args'          => $this->additional_args,
        'count'         => $returnPosts->found_posts,
        'totalPages'    => $returnPosts->max_num_pages,
        'paged'         => $this->search_args['paged']
      ]);
    } else {
      echo $this->render('BeautyNewsfeed/display', [
        'posts'         => $returnPosts,
        'args'          => $this->additional_args,
        'count'         => $returnPosts->found_posts,
        'totalPages'    => $returnPosts->max_num_pages,
        'paged'         => $this->search_args['paged']
      ]);
    }

    wp_reset_postdata();
  }
}
