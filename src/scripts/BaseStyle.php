<?php 
namespace DV\scripts;

class BaseStyle {
  static function init() {    
    wp_enqueue_style( 'fontawesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css', [], DEPLOY_VERSION );
    wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', [] );
    wp_enqueue_style( 'jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', [], DEPLOY_VERSION );
    // wp_enqueue_script( 'boot1','https://code.jquery.com/jquery-3.3.1.slim.min.js', array( 'jquery' ), DEPLOY_VERSION, true );
    wp_enqueue_script( 'boot2','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array( 'jquery' ), DEPLOY_VERSION, true );
    wp_enqueue_script( 'boot3','https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array( 'jquery' ), DEPLOY_VERSION, true );
    wp_enqueue_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', [], DEPLOY_VERSION, false );
  
    wp_enqueue_script( 'DV_coreScript',get_template_directory_uri().'/src/.dist/index.js', array( 'jquery' ), DEPLOY_VERSION, true );
    wp_enqueue_style('DV_coreStyle', get_template_directory_uri().'/src/.dist/index.css', [], DEPLOY_VERSION);
  }
}
