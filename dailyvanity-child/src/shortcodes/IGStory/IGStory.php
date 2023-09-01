<?php 

namespace  DVChild\shortcodes\IGStory;

class IGStory {

  private $_menuName = 'highlights-menu';
  private $search_args = null;
  private $additional_args = [
    'title'=>"1"
  ];

  private $tag_base = '/tags';

  static function init($args) {
    $args = shortcode_atts( array(
      'photo' =>  'no',
      'topheaderbarafter' => 'no',
      'noresult' => 'no',
    ), $args );
    $self = new IGStory();
    $self->addNewMenu();
    $self->makeObjectJavascript($args);
    if(get_option( 'tag_base' )) {
      $self->tag_base = get_option( 'tag_base' );
    }

    if ($args['photo']=='no')
    {
      if ($args['noresult']=='yes') {
        $self->noresultMenuHandler();
      }
      else
      {
        $self->afterMenuHandler();
      }
    }
    else
    { 
      $self->menuHandler($args);
    }
  }

  public function addNewMenu() {
    register_nav_menu($this->_menuName ,__( 'Highlights Menu' ));
  }

  public function makeObjectJavascript($args) {
    // $stories = $this->generateIGPostArray($args);
    if ($args['photo']=='no') {
      $zuck_browse_category = get_transient( 'zuckjs_highlights_menu_browse_category' ); 
      if ( false === $zuck_browse_category ) {
        $zuck_browse_category = $this->generateIGPostArray($args['photo']);
        // set_transient( 'zuckjs_highlights_menu_browse_category', $zuck_browse_category, DAY_IN_SECONDS );
      }
    }
    else
    {
        $zuck_transient = get_transient( 'zuckjs_highlights_menu' );
        if ( false === $zuck_transient ) {
          $zuck_transient = $this->generateIGPostArray($args['photo']);
          // set_transient( 'zuckjs_highlights_menu', $zuck_transient, DAY_IN_SECONDS );
        }
    }

    if ($args['photo']=='no')
    {
      if ($args['noresult']=='yes') {
        $html = '
        <script type="text/javascript">
          var igstorynoresult = ' . json_encode($zuck_browse_category, JSON_UNESCAPED_SLASHES) . ';			
        </script>
        ';
      }
      else
      {
        $html = '
        <script type="text/javascript">
          var igstoryx = ' . json_encode($zuck_browse_category, JSON_UNESCAPED_SLASHES) . ';			
        </script>
        ';
      }
    }
    else
    { 
      if ($args['topheaderbarafter']=='yes') {
        $html = '
        <script type="text/javascript">
          var igstoryafter = ' . json_encode($zuck_transient, JSON_UNESCAPED_SLASHES) . ';			
        </script>
        ';
      }
      else {
        $html = '
        <script type="text/javascript">
          var igstory = ' . json_encode($zuck_transient, JSON_UNESCAPED_SLASHES) . ';			
        </script>
        ';
      }
     
    }
   
    echo $html;
  }

  public function menuHandler($args) {
    if ($args['topheaderbarafter']=='yes') {
      $html= '
        <div id="igstoryafter" class="zuckContainer" data-json="igstoryafter"></div>';
      echo $html;
    }
    else {
      $html= '
        <div id="stories" class="zuckContainer" data-json="igstory"></div>';
      echo $html;
    }
  }

  public function afterMenuHandler() {
    $htmlx = '<div class="col-xs-12 col-sm-12 col-md-6">'
    . '<p id="browse-categories-title">BROWSE CATEGORIES</p>'
    . '<div class="category_tags">'
    . '<div id="storiesx" class="zuckContainer" data-json="igstoryx"></div>'
    . '</div>'
    . '</div>';
    echo $htmlx;
  }

  public function noresultMenuHandler() {
    $htmlresult = '<div class="col-xs-12 col-sm-12 col-md-6">'
    . '<p id="browse-categories-title">BROWSE CATEGORIES</p>'
    . '<div class="category_tags">'
    . '<div id="storiesnoresult" class="zuckContainer" data-json="igstorynoresult"></div>'
    . '</div>'
    . '</div>';
    echo $htmlresult;
  }

  function generateIGPostArray($args) {
    $menu_name = $this->_menuName;
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    $menuitems = wp_get_nav_menu_items( $menu->term_id, array('order'=> 'ASC', 'output' => object) );
    $stories = array();
    $storiesx = array();
    $storiesafter = array();
    $story = '';
    $menu = array();

    foreach ($menuitems as $m) {
      $timelineItems = array();
      if (empty($m->menu_item_parent)){
        $timelineItems = [
          'id'=>$m->ID,
          'name'=>$m->title,
          'post_name'=>$m->post_name,
          'photoObj'=>get_field('menu_icon_image', $m), 
          'tag'=>get_field('tag', $m),
          'post_type'=>get_field('post_type', $m),
          'view_all_image'=>get_field('view_all_image', $m),
          'content_link'=>get_field('content_link', $m),
          'lastUpdated'=>get_post_timestamp(),
          'seen'=>false,
          'stories'=> []
        ];
        
        if (!empty($timelineItems['tag']))
        {
          $timelineItems['link'] = home_url().$this->tag_base.'/'.$timelineItems['tag'];
        }
        elseif (!empty($timelineItems['post_type']))
        {
          $timelineItems['link'] = home_url().'/'.$timelineItems['post_type'];
        }
        elseif ($timelineItems['post_name'] == 'quizzes')
        {
          $timelineItems['link'] = $timelineItems['content_link']['url'];
          $timelineItems['quizzes'] = 'yes';
        }
        elseif ($timelineItems['post_name'] == 'salon-finder')
        {
          $timelineItems['link'] = $timelineItems['content_link']['url'];
          $timelineItems['salonfinder'] = 'yes';
          $timelineItems['browse'] = 'no';
        }
        else
        {
          $timelineItems['link'] = $m->url;
        }
        
        if ($args=='no' )
        {
          $timelineItems['photo'] = '';
        }
        else
        { 
          $timelineItems['photo'] = $timelineItems['photoObj']['url'];
        }

        $children = array();  // all menu items under $menuID
        if($m->post_name == 'editors-pick' || $m->post_name == 'award-winners' || $m->post_name == 'salon-finder') {
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
                  $child['linkText'] = $item->title;
                  break;
                case 'award-winners':
                  $child_image = get_field('highlights_image', $child['id']);
                  $child['src'] = $child_image['url'];
                  $child['linkText'] = 'View All';
                  break;
                case 'salon-finder':
                  $child_image = get_field('highlights_image', $child['id']);
                  $child['src'] = $child_image['url'];
                  $child['linkText'] = 'View All';
                  break;
              }
              $children[] = $child;
            } 
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

        if($m->post_name == 'quizzes') {
          $posts = new \WP_Query(array(
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'category_name' => 'beauty-quiz',
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
              'link' => $timelineItems['content_link']['url'],
              'src' => $timelineItems['view_all_image']['url'],
              'type'=>'photo'
            ];
          }
        }

        if($m->post_name == 'beauty-newsfeed') {
          $this->search_args = shortcode_atts( array(
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

          foreach($this->additional_args as $key=>$value) {
            if( isset($this->search_args[$key]) ) {
              unset($this->search_args[$key]);
            }
          }
      
          foreach($this->search_args as $k=>$v) {
            if(!$this->search_args[$k]) {
              unset($this->search_args[$k]);
            }
          }

          if( isset( $args['title'] ) ) {
            $this->additional_args['title'] = $args['title'];
          }
       
          $this->additional_args = array_merge($this->additional_args, $this->search_args);

          $offset = ( $this->additional_args['paged'] - 1 ) * $this->additional_args['posts_per_page'];
          $this->search_args['offset'] = $offset;
          $this->additional_args['offset'] = $offset;
          $posts = new \WP_Query( $this->search_args );

          $this->additional_args['title'] = '';

          $current_page = $this->additional_args['paged'];
          $per_page = 1;
          $offset_start = 0;
          $offset = ( $current_page - 1 ) * $per_page + $offset_start;
          $count = 12;
          //$ids1 = array();
          $postarray = array();
          $perksarray = array();
          //$sfpromotionsarray = array();

          /*$ids1 = array();
          if( $posts->have_posts() ):
            while ( $posts->have_posts() ):
              $posts->the_post();
              array_push($ids1, get_the_ID());
            endwhile;
          endif;*/
          wp_reset_postdata();

          $perks_args = array(
            'posts_per_page' => $per_page,
            'paged' => $current_page,
            'offset' => $offset,
            'post_type' => 'deal',
            'post_status' => 'publish',
            'has_password' => false,
            'orderby' => 'date',
            'order' => 'DESC'
          );
        
          /*$sfpromotions_args = array(
            'posts_per_page' => $per_page,
            'paged' => $current_page,
            'offset' => $offset,
            'post_type' => 'sf_promotions',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
          );*/

          $perksPosts = new \WP_Query( $perks_args );
          if($perksPosts->have_posts()) {
            // array_pop($ids1);
            $count = $count-1;
            foreach($perksPosts->posts as $key => $perkspost) {
              setup_postdata( $perkspost );
              array_push($perksarray,$perkspost);
            }
          }

          $this->additional_args['posts_per_page'] = $count;
          $postnew = new \WP_Query( $this->additional_args );
          if($postnew->have_posts()) {
            foreach($postnew->posts as $key => $post) {
              setup_postdata( $post );
              array_push($postarray,$post);
            }
          }

          array_splice($postarray,3,0,$perksarray);
          // array_splice($postarray,7,0,$sfpromotionsarray);

          $posts->posts = $postarray;
          
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
              'link' => $timelineItems['content_link']['url'],
              'src' => $timelineItems['view_all_image']['url'],
              'type'=>'photo'
            ];
          }
        }

        $timelineItems['items'] = $children;

        if ($args=='no')
        {
          $timelineItems['browse'] = 'yes';
        }
        
        $stories[] = $timelineItems;
        $storiesx[] = $timelineItems;
      }
    }

    if ($args=='no')
    {
      $timelineItemsx = [
        'id'=>'beauty-reviews',
        'name'=>'Beauty Reviews',
        'post_name'=>'beauty-reviews',
        'photoObj'=>'', 
        'photo'=>'',
        'tag'=>'',
        'post_type'=>'',
        'view_all_image'=>'',
        'content_link'=>get_home_url().'/beauty-reviews',
        'lastUpdated'=>get_post_timestamp(),
        'seen'=>false,
        'link'=>get_home_url().'/beauty-reviews',
        'beautyreviews'=>'yes',
        'browse'=>'yes',
        'stories'=> []
      ];
      $storiesx[] = $timelineItemsx;
      // return $storiesx;
      set_transient( 'zuckjs_highlights_menu_browse_category', $storiesx, DAY_IN_SECONDS );
    }
    else
    {
      // return $stories;
      set_transient( 'zuckjs_highlights_menu', $stories, DAY_IN_SECONDS );
    }
  }
}