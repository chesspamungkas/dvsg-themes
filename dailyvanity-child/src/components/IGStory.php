<?php 

namespace DVChild\components;

class IGStory {

  private $_menuName = 'highlights-menu';

  static function init() {
    $self = new IGStory();
    add_action( 'top_header_story_section', [$self, 'makeObjectJavascript']);
    add_action( 'top_header_after_menu', [$self, 'afterMenuHandler']);
    add_action( 'top_header_story_section', [$self, 'menuHandler']);
    add_action( 'init', [$self, 'addNewMenu'] );
  }

  public function addNewMenu() {
    register_nav_menu($this->_menuName ,__( 'Highlights Menu' ));
  }

  public function makeObjectJavascript() {
    $stories = $this->generateIGPostArray();
    $storiesx = $this->generateIGPostBrowseCategoryArray();
    $html = '
      <script type="text/javascript">
        var igstory = ' . json_encode($stories, JSON_UNESCAPED_SLASHES) . ';			
      </script>
      <script type="text/javascript">
        var igstoryx = ' . json_encode($storiesx, JSON_UNESCAPED_SLASHES) . ';			
      </script>
    ';
    echo $html;
  }

  public function afterMenuHandler() {
    $htmlx = '<div class="col-xs-12 col-sm-12 col-md-6">'
    . '<p id="browse-categories-title">BROWSE CATEGORIES</p>'
    . '<div class="category_tags">'
    . '<div id="storiesx" class="zuckContainer" data-json="igstoryx"></div>'
    . '<div class="clearfix"></div>'
    . '</div>'
    . '</div>';
    echo $htmlx;
  }

  public function menuHandler() {
    $html= '
      <div id="stories" class="zuckContainer" data-json="igstory"></div>';
    echo $html;
  }

  function generateIGPostArray() {
    $menu_name = $this->_menuName;
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    $menuitems = wp_get_nav_menu_items( $menu->term_id, array('order'=> 'ASC', 'output' => object) );
    $stories = array();
    $story = '';
    $menu = array();

    foreach ($menuitems as $m) {
      $timelineItems = array();
      if (empty($m->menu_item_parent)){
        $timelineItems = [
          'id'=>$m->ID,
          'name'=>$m->title,
          'post_name'=>$m->post_name,
          'link'=>$m->url,
          'photoObj'=>get_field('menu_icon_image', $m), 
          'tag'=>get_field('tag', $m),
          'post_type'=>get_field('post_type', $m),
          'view_all_image'=>get_field('view_all_image', $m),
          'content_link'=>get_field('content_link', $m),
          'lastUpdated'=>get_post_timestamp(),
          'seen'=>false,
          'stories'=> []
        ];
        $timelineItems['photo'] = $timelineItems['photoObj']['url'];
        $children = array();  // all menu items under $menuID
        if($m->post_name == 'editors-pick' || $m->post_name == 'award-winners') {
          foreach($menuitems as $item){
            if($item->menu_item_parent > 0 && $item->menu_item_parent == $m->ID) {
              $child = array();
              $child = [
                'id' => get_post_meta( $item->ID, '_menu_item_object_id', true ),
                'linkText' => $item->title,
                'link' => $item->url,
                'src' => '',
                'type'=>'photo',
                'child'=> 'yes',
                'time'=>''
              ];
              switch($m->post_name) {
                case 'editors-pick':
                  $child['src'] = get_the_post_thumbnail_url( $child['id'], 'article-featured' );
                  break;
                case 'award-winners':
                  $child_image = get_field('highlights_image', $child['id']);
                  $child['src'] = $child_image['url'];
                  
                  break;
              }
              $children[] = $child;
            }
          }
        }

        if($m->post_name == 'beauty-newsfeed') {
          $posts = new \WP_Query(array(
            'post_type' => 'deal',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
          ));
          
          if( $posts->have_posts() ) {
            while($posts->have_posts()) {
              $child = array();
              $posts->the_post();
              $child = [
                'id' => get_the_ID(),
                'linkText' => get_the_title(),
                'link' => get_permalink(get_the_ID()),
                'src' => get_the_post_thumbnail_url( get_the_ID(),'article-featured' ),
                'type'=>'photo'
              ];
              $children[] = $child;
            }
            $children[] = [
              'id' => 'View All',
              'linkText' => 'View All',
              'link' => get_site_url('/#newsfeed-header'),
              'src' => $timelineItems['view_all_image']['url'],
              'type'=>'photo'
            ];
          }
        }

        if ($timelineItems['post_type'] == 'deal'){
          $posts = new \WP_Query(array(
            'post_type' => $timelineItems['post_type'],
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
          ));

          if( $posts->have_posts() ) {
            while( $posts->have_posts() ){
              $child = array();
              $posts->the_post();
              $child = [
                'id' => get_the_ID(),
                'linkText' => get_the_title(),
                'link' => get_permalink(get_the_ID()),
                'src' => get_the_post_thumbnail_url( get_the_ID(),'article-featured' ),
                'type'=>'photo'
              ];
              $children[] = $child;
            }
            $children[] = [
              'id' => 'View All',
              'linkText' => 'View All',
              'link' => get_post_type_archive_link($timelineItems['post_type']),
              'src' => $timelineItems['view_all_image']['url'],
              'type'=>'photo'
            ];
          }
        }

        if( isset( $timelineItems['tag'] ) && !empty( $timelineItems['tag'] ) ){
          // makeup-tutorials, hair-tips, skincare-beginner-guide
          $posts = new \WP_Query(array(
            'tag' => $timelineItems['tag'],
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
          ));

          if( $posts->have_posts() ) {
            while( $posts->have_posts() ){
              $child = array();
              $posts->the_post();
              $child = [
                'id' => get_the_ID(),
                'linkText' => get_the_title(),
                'link' => get_permalink(get_the_ID()),
                'src' => get_the_post_thumbnail_url( get_the_ID(),'article-featured' ),
                'type'=>'photo'
              ];
              $children[] = $child;
            }
            $children[] = [
              'id' => 'View All',
              'linkText' => 'View All',
              'link' => $timelineItems['content_link']['url'],
              'src' => $timelineItems['view_all_image']['url'],
              'type'=>'photo'
            ];
          }
        }
        $timelineItems['items'] = $children;
        $stories[] = $timelineItems;
      }
    }
    return $stories;
  }

  function generateIGPostBrowseCategoryArray() {
    $menu_name = $this->_menuName;
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    $menuitems = wp_get_nav_menu_items( $menu->term_id, array('order'=> 'ASC', 'output' => object) );
    $storiesx = array();
    $story = '';
    $menu = array();
    $number = 1;

    foreach ($menuitems as $m) {
      $timelineItems = array();
      if (empty($m->menu_item_parent)){
        $timelineItems = [
          'id'=>$m->ID,
          'name'=>$m->title,
          'post_name'=>$m->post_name,
          'link'=>$m->url,
          'photoObj'=>get_field('menu_icon_image', $m), 
          'tag'=>get_field('tag', $m),
          'post_type'=>get_field('post_type', $m),
          'view_all_image'=>get_field('view_all_image', $m),
          'content_link'=>get_field('content_link', $m),
          'lastUpdated'=>get_post_timestamp(),
          'seen'=>false,
          'number'=>$number,
          'storiesx'=> []
        ];
        $timelineItems['photo'] = '';
        $children = array();  // all menu items under $menuID
        if($m->post_name == 'editors-pick' || $m->post_name == 'award-winners') {
          foreach($menuitems as $item){
            if($item->menu_item_parent > 0 && $item->menu_item_parent == $m->ID) {
              $child = array();
              $child = [
                'id' => get_post_meta( $item->ID, '_menu_item_object_id', true ),
                'linkText' => $item->title,
                'link' => $item->url,
                'src' => '',
                'type'=>'photo',
                'time'=>''
              ];
              switch($m->post_name) {
                case 'editors-pick':
                  $child['src'] = get_the_post_thumbnail_url( $child['id'], 'article-featured' );
                  break;
                case 'award-winners':
                  $child_image = get_field('highlights_image', $child['id']);
                  $child['src'] = $child_image['url'];
                  
                  break;
              }
              $children[] = $child;
            }
          }
        }

        if($m->post_name == 'beauty-newsfeed') {
          $posts = new \WP_Query(array(
            'post_type' => 'deal',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
          ));
          
          if( $posts->have_posts() ) {
            while($posts->have_posts()) {
              $child = array();
              $posts->the_post();
              $child = [
                'id' => get_the_ID(),
                'linkText' => get_the_title(),
                'link' => get_permalink(get_the_ID()),
                'src' => get_the_post_thumbnail_url( get_the_ID(),'article-featured' ),
                'type'=>'photo'
              ];
              $children[] = $child;
            }
            $children[] = [
              'id' => 'View All',
              'linkText' => 'View All',
              'link' => get_site_url('/#newsfeed-header'),
              'src' => $timelineItems['view_all_image']['url'],
              'type'=>'photo'
            ];
          }
        }

        if ($timelineItems['post_type'] == 'deal'){
          $posts = new \WP_Query(array(
            'post_type' => $timelineItems['post_type'],
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
          ));

          if( $posts->have_posts() ) {
            while( $posts->have_posts() ){
              $child = array();
              $posts->the_post();
              $child = [
                'id' => get_the_ID(),
                'linkText' => get_the_title(),
                'link' => get_permalink(get_the_ID()),
                'src' => get_the_post_thumbnail_url( get_the_ID(),'article-featured' ),
                'type'=>'photo'
              ];
              $children[] = $child;
            }
            $children[] = [
              'id' => 'View All',
              'linkText' => 'View All',
              'link' => get_post_type_archive_link($timelineItems['post_type']),
              'src' => $timelineItems['view_all_image']['url'],
              'type'=>'photo'
            ];
          }
        }

        if( isset( $timelineItems['tag'] ) && !empty( $timelineItems['tag'] ) ){
          // makeup-tutorials, hair-tips, skincare-beginner-guide
          $posts = new \WP_Query(array(
            'tag' => $timelineItems['tag'],
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
          ));

          if( $posts->have_posts() ) {
            while( $posts->have_posts() ){
              $child = array();
              $posts->the_post();
              $child = [
                'id' => get_the_ID(),
                'linkText' => get_the_title(),
                'link' => get_permalink(get_the_ID()),
                'src' => get_the_post_thumbnail_url( get_the_ID(),'article-featured' ),
                'type'=>'photo'
              ];
              $children[] = $child;
            }
            $children[] = [
              'id' => 'View All',
              'linkText' => 'View All',
              'link' => $timelineItems['content_link']['url'],
              'src' => $timelineItems['view_all_image']['url'],
              'type'=>'photo'
            ];
          }
        }
        $timelineItems['items'] = $children;
        $timelineItems['number'] = $number;
        $storiesx[] = $timelineItems;
      }
      if (empty($storiesx['items'])) {
        $number=$number+1;
      }
    }
    return $storiesx;
  }
}