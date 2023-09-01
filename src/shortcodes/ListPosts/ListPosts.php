<?php

namespace DV\shortcodes\ListPosts;

use DV\base\ShortCode;

class ListPosts extends ShortCode
{
  private $search_args = null;

  private $additional_args = [
    'title' => "1",
    'header' => 'LATEST',
    'sub_header' => 'BEAUTY READS',
    'taxonomy' => 'cat',
  ];
  public static function init($args)
  {
    $model = new ListPosts();

    $model->search_args = shortcode_atts(array(
      'posts_per_page' => 18,
      'offset'  => 0,
      'paged' => 1,
      'orderby' => 'date',
      'post_type' => 'post',
      'title' => "1",
      'header' => 'LATEST',
      'sub_header' => 'BEAUTY READS',
      'author' => 0,
      'cat' => 0,
      'tag_id' => 0,
      'taxonomy' => 'cat',
      'post_status' => 'publish'
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

  public function getTaxonomy($mode = null, $id = null, $postID = null)
  {
    global $post;

    if (isset($id)) {
      if (isset($mode) && $mode == 'cat') {
        $category = get_the_category_by_ID($id);
        $totalCat = 0;
      } else if (isset($mode) && $mode == 'tag') {
        $tag = get_tag($id);
        $totalTag = 0;
      }
    } else {
      $categories = get_the_category($post->ID);
      $totalCat = count($categories);
    }

    $content = '';

    if ($totalCat >= 1) {
      $count = 1;

      foreach ($categories as $cat) {
        $catLink = get_category_link($cat->term_id);
        $content .= '<a href="' . esc_url($catLink) . '" class="category-link poppins-regular">' . $cat->name . '</a>';

        if ($count < $totalCat) {
          $content .= ', ';
        }
        $count++;
      }
    } else {
      if (isset($mode) && $mode == 'cat') {
        $content .= $category;
      } else if (isset($mode) && $mode == 'tag') {
        $content .= $tag->name;
      }
    }

    if (!empty($content)) {
      return $content;
    } else {
      return "No Title";
    }
  }

  public function pagination($author, $pageno, $totalPages)
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

    if (isset($author)) {
      $author = 'author';
    } else {
      $author = '';
    }

    if ($pageno != 1) {
      $content .= '<li class="page-item listposts-paginav-prev cursor-pointer ' . $author . '" aria-current="page" id="listposts-pageno-' . ($pageno - 1) . '"><span class="page-link">&laquo;</span></li>';
    }

    if ($pageno - $count > 1 && $totalPages > 5 && $paageno <= $totalPages - 4) {
      $content .= '<li class="page-item listposts-paginav disabled"><span aria-hidden="true" class="page-link">...</span></li>';
    }

    for ($p = $startPage; $p <= $endPage; $p++) {
      if ($p == $pageno) {
        $current = 'active';
      } else {
        $current = '';
      }

      $content .= '<li class="page-item listposts-paginav cursor-pointer ' . $current . ' ' . $author . '" aria-current="page" id="listposts-pageno-' . $p . '">';
      $content .= '<span class="page-link">' . $p . '</span>';
      $content .= '</li>';
    }

    if ($totalPages - $pageno > 2 && $totalPages > 5) {
      $content .= '<li class="page-item listposts-paginav disabled"><span aria-hidden="true" class="page-link">...</span></li>';
    }

    if ($pageno != $totalPages) {
      $content .= '<li class="page-item listposts-paginav-next cursor-pointer ' . $author . '" aria-current="page" id="listposts-pageno-' . ($pageno + 1) . '"><span class="page-link">&raquo;</span></li>';
    }

    $content .= '</ul>';
    $content .= '</nav>';

    return $content;
  }

  public function generate()
  {
    $offset = ($this->additional_args['paged'] - 1) * $this->additional_args['posts_per_page'];
    $this->search_args['offset'] = $offset;
    $this->additional_args['offset'] = $offset;

    $posts = new \WP_Query($this->search_args);

    echo $this->render('ListPosts/display', [
      'posts' => $posts,
      'args' => $this->additional_args,
      'count' => $posts->found_posts,
      'totalPages' => $posts->max_num_pages
    ]);
  }
}
