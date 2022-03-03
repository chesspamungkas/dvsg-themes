<?php
namespace DV\core;

use DV\base\Factory;

class DVBA extends Factory {

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

  public static function registering($year, $categories, $postArg=[], $slug="") {
    $model = self::getFactory();
    $model->_registeredDVBA[] = ['year'=>$year, 'categories'=>$categories, 'postArg'=>$postArg, 'slug'=>$slug?$slug:$model->defaultSlug];
  }

  public static function init() {
    $model = self::getFactory();
    add_action('init',[$model, 'setUp']);
  }

  public function setUp() {
    foreach($this->_registeredDVBA as $DVBA) {
      $postType = $this->createPostType($DVBA['year'], $DVBA['slug'], $DVBA['postArg']);
      foreach($DVBA['categories'] as $taxonomy) {
        $this->createTaxonomy($DVBA['year'], array_merge(['args'=>[], 'hierarchical'=>false, 'slug'=>$DVBA['slug']], $taxonomy), $postType->name);
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

  private function createTaxonomy($year, $taxonomy, $postType) {
    $labels = [
      "name" => __( "DVBA {$year} {$taxonomy['name']}" ),
      "singular_name" => __( "DVBA {$year} {$taxonomy['singular_name']}" ),
    ];
    $lowercaseName = str_replace(' ','_',strtolower($taxonomy['name']));
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