<?php
namespace DV\core;

use DV\base\Factory;

class DVBA extends Factory {

  public static $LOGO_ACTION = "LOGO_ACTION";
  public static $LIST_POST_QUERY_FILTERS = "LIST_POST_QUERY_FILTERS";

  private $defaultSlug = "best-beauty-products";

  private $defaultPostTypeArgs = [
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

  private $defaultTaxonomyArgs = [
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,		
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
  ];

  private $_registeredDVBA = [

  ];

  public static function registering($year, $categories, $postArg=[], $slug="", $templateDirectory=null) {
    $model = self::getFactory();
    $model->_registeredDVBA[] = ['year'=>$year, 'categories'=>$categories, 'postArg'=>$postArg, 'slug'=>$slug?$slug:$model->defaultSlug, 'templateDirectory'=>$templateDirectory];
  }

  public static function init() {
    $model = self::getFactory();
    add_action('init',[$model, 'setUp']);
    add_action(self::$LOGO_ACTION, [$model, 'logo_action']);
  }

  public static function additionalMedias($post) {
    return get_field('product_media', $post );
  }

  public function logo_action($post) {
    return get_the_post_thumbnail($post, 'post-thumbnail', ['class'=>'svg-box-shadow']);
  }

  public function setUp() {
    foreach($this->_registeredDVBA as $DVBA) {
      $postType = $this->createPostType($DVBA['year'], $DVBA['slug'], $DVBA['postArg']);
      foreach($DVBA['categories'] as $taxonomy) {
        $this->createTaxonomy($DVBA['year'], array_merge(['args'=>[], 'hierarchical'=>false, 'baseSlug'=>$DVBA['slug']], $taxonomy), $this->makePostTypeName($DVBA['year']));
      }
      
      $this->setUpTemplates($DVBA);
    }
  }

  public function setUpTemplates($DVBA) {
    add_filter('page_template', function($template, $type, $templates) use ($DVBA) {
      $templateFile = $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . "page.php";
      foreach($templates as $_template) {
        if($_template === $templateFile) {
          //load_template($_template);
          return $_template;
        }
      }
      return $template;
    }, 10, 3);
    
    if($DVBA['templateDirectory']) {
      $templateFile = $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . "page.php";
      //if(file_exists($templateFile) || file_exists($templateFile)) {
        add_filter( 'theme_page_templates', function($post_templates) use ($DVBA, $templateFile) {
          $post_templates[$templateFile] = "DVBA {$DVBA['year']} Listing Template";
          return $post_templates;
        });
      //}
    
      add_filter( 'single_template', function($template, $type, $templates) use ($DVBA) {
        global $post;
        if($post->post_type === $this->makePostTypeName($DVBA['year'])) {
          $template = $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . "single.php";
        }
        return $template;
      }, 10, 3);
    
      foreach($DVBA['categories'] as $taxonomy) {
        $lowercaseName = $this->makeTaxonomyTypeYearName($DVBA['year'], $taxonomy['name']);
        add_filter( 'taxonomy_template', function($template, $type, $templates) use ($DVBA, $lowercaseName) {     
          if(is_tax($lowercaseName)) {            
            $template = $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . "taxonomy-{$lowercaseName}.php";;
          }
          return $template;
        }, 10, 3);
      }
    }
  }

  private function createPostType($year, $slug, $postArg) {
    $labels = [
      "name" => __( "DVBA {$year} Winners" ),
      "singular_name" => __( "DVBA {$year} Winner" ),
    ];
    $args = array_merge(
      $this->defaultPostTypeArgs, 
      [
        "label" => __( "DVBA {$year} Winners" ),
        "labels" => $labels,
        "rewrite" => [ "slug" => "{$slug}/{$year}/product", "with_front" => true ],
      ],
      $postArg
    );
    return register_post_type( $this->makePostTypeName($year), $args );    
  }

  public static function makePostTypeName($year) {
    return "dvba_{$year}_winners";
  }

  public static function makeTaxonomyTypeName($name) {
    return str_replace(' ','_',strtolower($name));
  }

  public static function makeTaxonomyTypeYearName($year, $name) {
    $tax_name = self::makeTaxonomyTypeName($name);
    return "dvba_{$year}_{$tax_name}";
  }

  

  private function createTaxonomy($year, $taxonomy, $postType) {
    $labels = [
      "name" => __( "DVBA {$year} {$taxonomy['name']}" ),
      "singular_name" => __( "DVBA {$year} {$taxonomy['singular_name']}" ),
    ];    
    $slug = $taxonomy['slug'] !== null?$taxonomy['slug']:sanitize_title($taxonomy['name']);
    if($taxonomy['slug'] === "") {
      $slug = $year;
    } else {
      $slug = "{$year}/{$slug}";
    }

    $args = array_merge(
      $this->defaultTaxonomyArgs, 
      [
        "label" => __( "DVBA {$year} {$taxonomy['name']}" ),
        "labels" => $labels,
        "hierarchical" => $taxonomy['hierarchical'],
        "rewrite" => [ 'slug' => "{$taxonomy['baseSlug']}/{$slug}", 'with_front' => true, "hierarchical" => $taxonomy['hierarchical']],
        "rest_base" => $this->makeTaxonomyTypeYearName($year, $taxonomy['name']),
        "query_var" => true,
      ],
      $taxonomy['args']
    );
    return register_taxonomy( $this->makeTaxonomyTypeYearName($year, $taxonomy['name']), [ $postType ], $args );    
  }
}