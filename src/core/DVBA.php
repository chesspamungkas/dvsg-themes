<?php
namespace DV\core;

use DV\base\Factory;

class DVBA extends Factory {

  public static $LOGO_ACTION = "LOGO_ACTION";
  public static $LOGO_ALT_FILTERS = "LOGO_ALT_FILTERS";

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

  public function logo_action($post) {
    return get_the_post_thumbnail($post, 'post-thumbnail', ['class'=>'svg-box-shadow']);
  }

  public function setUp() {
    foreach($this->_registeredDVBA as $DVBA) {
      $postType = $this->createPostType($DVBA['year'], $DVBA['slug'], $DVBA['postArg']);
      foreach($DVBA['categories'] as $taxonomy) {
        $this->createTaxonomy($DVBA['year'], array_merge(['args'=>[], 'hierarchical'=>false, 'slug'=>$DVBA['slug']], $taxonomy), $postType->name);
      }
      $this->setUpTemplates($DVBA);
    }
  }

  public function setUpTemplates($DVBA) {
    add_filter('page_template', function($template, $type, $templates) use ($DVBA) {
      $templateFile = $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . "page.php";
      foreach($templates as $_template) {
        if($_template === $templateFile) {
          load_template($_template);
          return $_template;
        }
      }
      return $template;
    }, 10, 3);
    // add_filter( 'template_include', function($template) use ($DVBA) {
    //   global $wp_query;
    //   print_r($wp_query);
    //   print_r($template);
    //   print_r(wp_get_theme()->get_page_templates());
    //   die();
    //   if(file_exists($file)) {
    //     $path = $file;
    //   }
    //   if(file_exists( $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . $file )) {
    //     $path = $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . $file;
    //   }
    //   print_r($path);
    //   die();
    //   return $path;
    // });
    if($DVBA['templateDirectory']) {
      $templateFile = $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . "page.php";
      //if(file_exists($templateFile) || file_exists($templateFile)) {
        add_filter( 'theme_page_templates', function($post_templates) use ($DVBA, $templateFile) {
          $post_templates[$templateFile] = "DVBA {$DVBA['year']} Listing Template";
          return $post_templates;
        });
      //}
      
        add_filter( 'template_include', function($template) use ($DVBA) {
          if(is_single("dvba_{$DVBA['year']}_winners")) {
            $template = $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . "single.php";
          }
          return $template;
        });
      
      foreach($DVBA['categories'] as $taxonomy) {
        $lowercaseName = $this->makeTaxonomyTypeName($taxonomy['name']);
        $templateFile = $DVBA['templateDirectory'] . DIRECTORY_SEPARATOR . "archive-{$lowercaseName}.php";

        add_filter( 'template_include', function($template) use ($DVBA, $templateFile, $lowercaseName) {
          if(is_tax("dvba_{$DVBA['year']}_{$lowercaseName}")) {
            $template = $templateFile;
          }
          return $template;
        });
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
        "rewrite" => [ "slug" => "{$slug}/{$year}", "with_front" => true ],
      ],
      $postArg
    );
    return register_post_type( "dvba_{$year}_winners", $args );    
  }

  private function makeTaxonomyTypeName($name) {
    return str_replace(' ','_',strtolower($name));
  }

  public function getPosts($year, $category, $page=0, $limit=11) {

  }

  private function createTaxonomy($year, $taxonomy, $postType) {
    $labels = [
      "name" => __( "DVBA {$year} {$taxonomy['name']}" ),
      "singular_name" => __( "DVBA {$year} {$taxonomy['singular_name']}" ),
    ];
    $lowercaseName = $this->makeTaxonomyTypeName($taxonomy['name']);
    $slug = sanitize_title($taxonomy['name']);
    $args = array_merge(
      $this->defaultTaxonomyArgs, 
      [
        "label" => __( "DVBA {$year} {$taxonomy['name']}" ),
        "labels" => $labels,
        "hierarchical" => $taxonomy['hierarchical'],
        "rewrite" => [ 'slug' => "{$taxonomy['slug']}/{$year}/{$slug}", 'with_front' => true,  'hierarchical' => $taxonomy['hierarchical']],
        "rest_base" => "dvba_{$year}_{$lowercaseName}",
      ],
      $taxonomy['args']
    );
    return register_taxonomy( "dvba_{$year}_{$lowercaseName}", [ $postType ], $args );    
  }
}