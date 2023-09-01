<?php

namespace DV\shortcodes\SearchResults;

use DV\base\ShortCode;

class SearchResults extends ShortCode
{
  private $search_args = null;

  private $additional_args = [
    'title' => "1"
  ];

  public static function init($args)
  {
    $model = new SearchResults();

    $model->search_args = shortcode_atts(array(
      'posts_per_page' => 12,
      'offset'  => 0,
      'paged' => 1,
      'orderby' => 'date',
      'title' => "1",
      'post_status' => 'publish',
      's' => ''
    ), $args);

    foreach ($model->additional_args as $key => $value) {
      if (isset($model->search_args[$key])) {
        unset($model->search_args[$key]);
      }
    }

    foreach ($model->search_args as $k => $v) {
      if (!$model->search_args[$k]) {
        unset($model->search_args[$k]);
      }
    }

    // Beauty Reads title = 1, Author page title = 0, Category page title = 2 
    if (isset($args['title'])) {
      $model->additional_args['title'] = $args['title'];
    }

    $model->additional_args = array_merge($model->additional_args, $model->search_args);
    $model->generate();
  }

  public function getTitle($keyword = null)
  {
    global $post;

    $categories = get_the_category($post->ID);
    $totalCat = count($categories);

    $content = '';

    $count = 1;

    foreach ($categories as $cat) {
      $catLink = get_category_link($cat->term_id);
      $content .= '<a href="' . esc_url($catLink) . '" class="category-link poppins-regular">' . $cat->name . '</a>';

      if ($count < $totalCat) {
        $content .= ', ';
      }

      $count++;
    }

    return $content;
  }

  public function pagination($keyword, $pageno, $totalPages)
  {
    $content = '';

    $count = 2;

    if ($pageno <= 3 && $totalPages > 5) {
      $startPage = 1;
      $endPage = 5;
    } else if (($pageno == $totalPages || $pageno == $totalPages - 1) && $totalPages > 5) {
      $startPage = $totalPages - 4;
      $endPage = $totalPages;
    } else {
      if ($totalPages > 5) {
        $startPage = max(1, $pageno - $count);
        $endPage = min($totalPages, $pageno + $count);
      } else {
        $startPage = 1;
        $endPage = $totalPages;
      }
    }

    $content .= '<nav aria-label="pagination">';
    $content .= '<ul class="pagination pagination-sm justify-content-center">';

    if ($pageno != 1 && $totalPages > 5) {
      $content .= '<li class="page-item searchresults-paginav-prev cursor-pointer" aria-current="page" id="searchresults-pageno-' . ($pageno - 1) . '"><span class="page-link">&laquo;</span></li>';
    }

    if ($pageno - $count > 1 && $totalPages > 5 && $paageno <= $totalPages - 4) {
      $content .= '<li class="page-item searchresults-paginav disabled"><span aria-hidden="true" class="page-link">...</span></li>';
    }

    for ($p = $startPage; $p <= $endPage; $p++) {
      if ($p == $pageno) {
        $current = 'active';
      } else {
        $current = '';
      }

      $content .= '<li class="page-item searchresults-paginav cursor-pointer ' . $current . '" aria-current="page" id="searchresults-pageno-' . $p . '">';
      $content .= '<span class="page-link">' . $p . '</span>';
      $content .= '</li>';
    }

    if ($totalPages - $pageno > 2 && $totalPages > 5) {
      $content .= '<li class="page-item searchresults-paginav disabled"><span aria-hidden="true" class="page-link">...</span></li>';
    }

    if ($pageno != $totalPages && $totalPages > 5) {
      $content .= '<li class="page-item searchresults-paginav-next cursor-pointer" aria-current="page" id="searchresults-pageno-' . ($pageno + 1) . '"><span class="page-link">&raquo;</span></li>';
    }

    $content .= '</ul>';
    $content .= '</nav>';

    return $content;
  }

  public function insert_keyword($keyword = null)
  {
    global $wpdb;

    if (isset($keyword) && !empty($keyword)) {
      $wpdb->query(
        $wpdb->prepare(
          "INSERT INTO `wp_search_keywords` ( `terms`, `userIP`, `userAgent`, `createdAt` ) VALUES ( %s, %s, %s, %s )",
          array(
            $keyword,
            $_SERVER['REMOTE_ADDR'],
            $_SERVER['HTTP_USER_AGENT'],
            current_time('timestamp')
          )
        )
      );
    }
  }

  public function generate()
  {
    $offset = ($this->additional_args['paged'] - 1) * $this->additional_args['posts_per_page'];
    $this->search_args['offset'] = $offset;
    $this->additional_args['offset'] = $offset;

    $posts = new \WP_Query($this->search_args);

    $this->insert_keyword($this->search_args['s']);

    echo $this->render('SearchResults/display', [
      'posts' => $posts,
      'args' => $this->additional_args,
      'count' => $posts->found_posts,
      'totalPages' => $posts->max_num_pages,
      'keyword' => $this->search_args['s']
    ]);
  }
}
