<?php 
namespace DVChild\microsites\dvba\twenty_two;

use DV\core\DVBA;
use DV\shortcodes\CommonListPosts\CommonListPosts;
use DV\shortcodes\DVBAAwardsList\DVBAAwardsList;
use DV\shortcodes\ScrollableList\ScrollableList;
use DV\shortcodes\TaxonomyFilterList\TaxonomyFilterList;

class DVBA_2022 extends \DV\base\Factory {

  public static $year = 2022;

  public static $taxonomies = [
    [
      'name'=>'Categories',
      'singular_name'=> 'Category',
      'hierarchical'=>true,
      'slug'=>''
    ],
    [
      'name'=>'Price Ranges',
      'singular_name'=> 'Price Range',
      'hierarchical'=>false
    ],
    [
      'name'=>'Award Tiers',
      'singular_name'=> 'Award Tier',
      'hierarchical'=>false
    ],
    [
      'name'=>'Skin Types',
      'singular_name'=> 'Skin Type',
      'hierarchical'=>false
    ],
    [
      'name'=>'Skin Concerns',
      'singular_name'=> 'Skin Concern',
      'hierarchical'=>false
    ],
    [
      'name'=>'Hair Type Concerns',
      'singular_name'=> 'Hair Type Concern',
      'hierarchical'=>false
    ],
    [
      'name'=>'Brands',
      'singular_name'=> 'Brand',
      'hierarchical'=>false
    ],
    [
      'name'=>'Judges',
      'singular_name'=> 'Judge',
      'hierarchical'=>false
    ]
  ];


  public static function init() {
    \DV\core\DVBA::registering(self::$year, self::$taxonomies, [], null, '/src/microsites/dvba/twenty_two/templates');
    $model = DVBA_2022::getInstance();
    add_action('init', [$model, 'addingFilters']);    
  }

  public function addingFilters() {
    add_filter(ScrollableList::$SCROLLABLE_LIST_QUERY_FILTER, [$this, 'scrollingListQuery'], 10, 2);    
    add_filter('the_content', [$this, 'addClassToBody']);
    add_filter(DVBAAwardsList::$DVBA_AWARDS_CONTAINER_CLASS, [$this, 'paidOrNot'], 10, 2);
    add_action(ScrollableList::$SCROLLABLE_LIST_AFTER_ITEM_TITLE, [$this, 'getAwardMsg']);
    add_action(ScrollableList::$SCROLLABLE_LIST_BEFORE_ITEM_TITLE, [$this, 'getAwardBanner']);
    add_action(CommonListPosts::$COMMON_LIST_POST_AFTER_ITEM_TITLE, [$this, 'getAwardMsg']);
    add_action(CommonListPosts::$COMMON_LIST_POST_BEFORE_ITEM_TITLE, [$this, 'getAwardBanner']);

    add_filter(TaxonomyFilterList::$TAXONOMY_FILTER_LIST_QUERY_FILTER, [$this, 'taxonomyFilterQuery'], 10, 3);
    add_filter(TaxonomyFilterList::$TAXONOMY_FILTER_LIST_GROUP_TERMS_FILTER, [$this, 'orderGroupTermsFilter'], 10, 3);
    add_filter(TaxonomyFilterList::$TAXONOMY_FILTER_LIST_SECTION_ITEMS_ATTRS, [$this, 'sectionItemsAttrs']);
    add_filter(TaxonomyFilterList::$TAXONOMY_FILTER_LIST_SECTION_TITLE_FILTER, [$this, 'sectionTitle']);
    add_filter(CommonListPosts::$COMMON_LIST_POST_ITEM_CLASS, [$this, 'addingItemClass'], 10, 2);
    add_filter(ScrollableList::$SCROLLABLE_LIST_ITEM_CLASS, [$this, 'addingItemClass'], 10, 2);
    add_filter('next_posts_link_attributes', [$this, 'nextPageLinkButton']);

    add_action( 'pre_get_posts', [$this, 'commonQueryVar'] );
    add_action('posts_where', [$this, 'changeWhere']);
    
  }

  public function nextPageLinkButton($value) {
    if(is_tax(DVBA::makeTaxonomyTypeYearName(self::$year, 'categories')) || is_post_type_archive(DVBA::makePostTypeName(self::$year))) {
      $value .= ' type="button" class="box-shadow py-2 px-5 poppins-bold more-products-btn"';
    }
    return $value;
  }

  public function addingItemClass($classes, $post) {
    if(is_page('best-beauty-products/2022') || is_tax(DVBA::makeTaxonomyTypeYearName(self::$year, 'categories')) || is_post_type_archive(DVBA::makePostTypeName(self::$year))) {
      $classes .=' col-6 col-md-3';
    }
    return $classes;
  }

  public function changeWhere($where) {
    global $wp_query, $table_prefix;
    
    $searchTerm = $_GET['search'];
    if(($wp_query->is_main_query() && is_post_type_archive(DVBA::makePostTypeName(self::$year))) && $searchTerm) {
      $searchTerm = esc_sql($searchTerm);
      $where = " and {$table_prefix}posts.post_title like '%{$searchTerm}%'";
    }
    return $where;
  }

  public function getCategoryLink($category, $withPage = false) {
    return get_term_link($category, DVBA::makeTaxonomyTypeYearName(self::$year, 'categories'));
  }

  public function getBaseURL() {
    return DVBA::getYearBaseURL(self::$year);
  }

  public function getProductList() {
    $searchTerm = get_query_var('s');
    $orderVar = get_query_var('orderby', null);
    $order = "rand";
    $orderBy = "rand";
    if($orderVar) {
      $orderAry = explode('-', $order);
      if($orderAry[0] === 'alphabetical') {
        $orderBy = "post_title";
        $order = $orderAry[1];
      } else if($orderAry[0] === 'featured'){
        $orderBy = "meta_value";
        $order = "DESC";
      }
    }
    return do_shortcode("[common-list-posts posts_per_page='16' order='{$order}' order_by='$orderBy' filter='$searchTerm']");
  }

  public function commonQueryVar($query) {
    if($query->is_main_query() && (is_tax(DVBA::makeTaxonomyTypeYearName(self::$year, 'categories')) || ($query->is_search() && is_post_type_archive(DVBA::makePostTypeName(self::$year))) || is_post_type_archive(DVBA::makePostTypeName(self::$year)))) {
      $orderVar = get_query_var('orderby', null);
      $order = "rand";
      $orderBy = "rand";
      $query->set('orderby', "rand");
      if($orderVar) {
        $orderAry = explode('-', $order);
        if($orderAry[0] === 'alphabetical') {
          $orderBy = "post_title";
          $order = $orderAry[1];
        } else if($orderAry[0] === 'featured'){
          $orderBy = "meta_value";
          $order = "DESC";
        }
        $query->set('orderby', $orderBy);
        $query->set('order', $order);
      }
      $query->set('posts_per_page', 16);
      
      $query->set('post_type', DVBA::makePostTypeName(self::$year));
      $query->set('relevanssi', false);
      $search = get_query_var('s', null);
      if($search) {
        //$query->set('title', '%'.$search.'%');
      }
    }
  }

  public function listProductsQuery($query) {
    if(is_tax() && $query->is_main_query()) {
      // print_r($query);
      // die();
    }
 
    if($query->is_main_query() && !is_admin() && is_post_type_archive(DVBA::makePostTypeName(self::$year))) {
      $orderVar = get_query_var('orderby', null);
      $order = "rand";
      $orderBy = "rand";

      $query->set('orderby', "rand");

      if($orderVar) {
        $orderAry = explode('-', $order);
        if($orderAry[0] === 'alphabetical') {
          $orderBy = "post_title";
          $order = $orderAry[1];
        } else if($orderAry[0] === 'featured'){
          $orderBy = "meta_value";
          $order = "DESC";
        }
        $query->set('orderby', $orderBy);
        $query->set('order', $order);
      }
      $query->set('posts_per_page', 16);
    }
  }

  public function getOrderByLinks($orderBy, $order) {
    global $wp;
    $query = $_GET;
    $query['orderby'] = $orderBy.'-'.$order;
    return get_home_url(null, add_query_arg( $query, $wp->request ));
  }

  public function sectionTitle($title) {
    $title = '';
    if(is_post_type_archive(DVBA::makePostTypeName(self::$year))) {
      foreach(self::$taxonomies as $taxonomy) {
        if(DVBA::makeTaxonomyTypeYearName(self::$year, $taxonomy['name']) === $title) {
          $title = $taxonomy['name'];
        }
      }
    }
    return $title;
  }

  public function sectionItemsAttrs($term) {
    $returnAttr = "";
    if(is_post_type_archive(DVBA::makePostTypeName(self::$year))) {
      foreach(self::$taxonomies as $taxonomy) {
        $taxonomyName = DVBA::makeTaxonomyTypeYearName(self::$year, $taxonomy['name']);
        $filterTaxonomies = get_query_var($taxonomyName, []);
        if(is_array($filterTaxonomies) && count($filterTaxonomies)) {
          foreach($filterTaxonomies as $filteredTaxonomy) {
            if($filteredTaxonomy === $term['slug']) {
              $returnAttr = "checked='checked'";
            }
          }
        }
      }
    }
    return $returnAttr;
  }

  private function makeKeyOrder($slug, $type) {
    $order = [];
    if($type === 'main') {
      switch($slug) {
        case 'skincare':
        case 'body-care':
          $order = [DVBA::makeTaxonomyTypeYearName(self::$year, 'Skin Types'), DVBA::makeTaxonomyTypeYearName(self::$year, 'Skin Concerns'), DVBA::makeTaxonomyTypeYearName(self::$year, 'brands')];
          break;
        case 'hair-care':          
          $order = [DVBA::makeTaxonomyTypeYearName(self::$year, 'Hair Type Concerns'), DVBA::makeTaxonomyTypeYearName(self::$year, 'brands')];
          break;
        case 'makeup':
          $order = [DVBA::makeTaxonomyTypeYearName(self::$year, 'brands'), DVBA::makeTaxonomyTypeYearName(self::$year, 'Award Tiers')];
      }
    } else if($type === 'sub') {
      switch($slug) {
        case 'makeup':
          $order = [DVBA::makeTaxonomyTypeYearName(self::$year, 'Price Ranges')];
          break;
        default: 
          $order = [DVBA::makeTaxonomyTypeYearName(self::$year, 'Award Tiers'), DVBA::makeTaxonomyTypeYearName(self::$year, 'Price Ranges')];
      }
    }
    return $order;
  }

  public function orderGroupTermsFilter($termOrder, $attributes, $type ) {
    if(is_tax(DVBA::makeTaxonomyTypeYearName(self::$year, 'categories'))) {
      $term = get_queried_object();
      $slug = $term->slug;
      if($term->parent) {
        $parentTerm = get_term($term->parent, $term->taxonomy);
        if($parentTerm) {
          $slug = $parentTerm->slug;
        }
      }
      $termOrder = $this->makeKeyOrder($slug, $type);
    }
    return $termOrder;    
  }

  public function taxonomyFilterQuery($query, $attributes, $type) {
    if(is_tax(DVBA::makeTaxonomyTypeYearName(self::$year, 'categories'))) {
      $term = get_queried_object();
      $slug = $term->slug;
      if($term->parent) {
        $parentTerm = get_term($term->parent, $term->taxonomy);
        if($parentTerm) {
          $slug = $parentTerm->slug;
        }
      }
      $query['taxonomy'] = $this->makeKeyOrder($slug, $type);
    }
    return $query;
  }

  public static function getTermLink($term) {
    return get_term_link($term, DVBA::makeTaxonomyTypeYearName(self::$year, 'categories'));
  }

  public function getAwardBanner($post) {
    if(get_post_type($post) === DVBA::makePostTypeName(self::$year)) {
      echo do_shortcode('[dvba-awards-list post_id="'.$post->ID.'" taxonomy="'.DVBA::makeTaxonomyTypeYearName(self::$year, 'award_tiers').'" ]');    
    }
  }

  public function getAwardMsg($post) {
    if(get_post_type($post) === DVBA::makePostTypeName(self::$year) && get_field('awards_won', $post)) {
      $msg = get_field('awards_won', $post);
      if($msg) {
        echo "<span class='award-msg'>{$msg}</span>";  
      }
    }
    
  }

  public static function awardsTreament($post) {
    $terms = get_the_terms($post, DVBA::makeTaxonomyTypeYearName(self::$year, 'categories'));
    if(!$terms || $terms instanceof \WP_Error) {
      return null;
    }
    foreach($terms as $term) {
      if($term->parent >0) {
        $count = count(get_term_children($term->term_id, DVBA::makeTaxonomyTypeYearName(self::$year, 'categories')));
        if($count === 4) {
          return $term->name;
        }
      }      
    }
  }

  public function paidOrNot($classes, $post_id) {
    if(get_post_type($post_id) === DVBA::makePostTypeName(self::$year) && get_field('paid_customer', $post_id)) {
      $classes .= ' paid';
    }
    return $classes;
  }

  public function addClassToBody($content) {
    global $post;
    if($post->post_type == DVBA::makePostTypeName(self::$year))
      return preg_replace('/<p>/', '<p class="poppins-regular">', $content);
    return $content;
  }

  public function getFilterTerms() {
    $returnTerms = [];
    foreach(self::$taxonomies as $taxonomy) {
      $taxonomyName = DVBA::makeTaxonomyTypeYearName(self::$year, $taxonomy['name']);
      $filterTaxonomies = get_query_var($taxonomyName, []);
      if(is_array($filterTaxonomies) && count($filterTaxonomies)) {
        $terms = get_terms([
          'slug'=>$filterTaxonomies,
          'taxonomy'=>$taxonomyName
        ]);
        $returnTerms = array_merge($returnTerms, $terms);
      }
    }
    return $returnTerms;
  }

  public function listQuery($query, $attributes) {
    if(is_tax(DVBA::makeTaxonomyTypeYearName(self::$year, 'categories'))) {
      remove_filter('posts_request', 'relevanssi_prevent_default_request'); 
      remove_filter('the_posts', 'relevanssi_query', 99);
      $query['post_type'] = DVBA::makePostTypeName(self::$year);
      $term = get_queried_object();  
      $taxArr = array(
        'taxonomy' => $term->taxonomy,
        'terms' => $term->term_id,
        'field' => 'term_id'
      );
      $query['tax_query'][] = $taxArr;
      $additionalTax = [];
      foreach(self::$taxonomies as $taxonomy) {
        $taxonomyName = DVBA::makeTaxonomyTypeYearName(self::$year, $taxonomy['name']);
        $filterTaxonomies = get_query_var($taxonomyName, []);
        if(is_array($filterTaxonomies) && count($filterTaxonomies)) {
          $additionalTax[] = [
            'taxonomy' => $taxonomyName,
            'terms' => $filterTaxonomies,
            'field' => 'slug',
            'operator' => 'IN'
          ];
        }
      }
      $additionalTax['relation'] = 'OR';
      $query['tax_query'][] = $additionalTax;
      $query['tax_query']['relation'] = 'AND';
      $query['meta_key'] = 'paid_customer';
    }
    return $query;
  }

  public function scrollingListQuery($query, $attributes) {
    if(in_array($attributes['identifier'], ['skincare', 'hair-care', 'makeup', 'body-care'])) {
      remove_filter('posts_request', 'relevanssi_prevent_default_request'); 
      remove_filter('the_posts', 'relevanssi_query', 99);
      $query['post_type'] = DVBA::makePostTypeName(self::$year);
      $taxArr = array(
        'taxonomy' => DVBA::makeTaxonomyTypeYearName(self::$year, 'categories'),
        'terms' => $attributes['identifier'],
        'field' => 'slug',
        'include_children' => false
      );
    
      $query['tax_query'][] = $taxArr;
    }
    return $query;
  }
}