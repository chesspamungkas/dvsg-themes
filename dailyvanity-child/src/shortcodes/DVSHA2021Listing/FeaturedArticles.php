<?php 
namespace DVChild\shortcodes\DVSHA2021Listing;

class FeaturedArticles {
    public static function init( $args ) {
        $model = new FeaturedArticles();

        $model->args = shortcode_atts( array(
            // 'taxonomy'         => 'dvsha_2021_brands',
            // 'hide_empty'       => false,
            'orderby'          => 'rand',
            'tag'           => 'dvsha2020',
            'posts_per_page'    => 4,
        ), $args );

        $model->generate();
    }

    public function get_category() {
        global $post;
    
        $content = '';
    
        if( $post->post_type == 'deal' ) {
          $content .= '<a href="' . BASE_PATH . '/deal/" class="category-link poppins-light" target="_blank">' . PERKS . '</a>';
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
    
    public function generate() {
        $posts = new \WP_Query( $this->args );

        echo $this->render('DVSHA2021Listing/displayArticle', [
            'posts'     => $posts,
            'args'      => $this->args
        ]);
    }

    public function renderPhpFile($_file_, $_params_ = [])
    {
        $_obInitialLevel_ = ob_get_level();
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        try {
        require $_file_;
        return ob_get_clean();
        } catch (\Exception $e) {
        while (ob_get_level() > $_obInitialLevel_) {
            if (!@ob_end_clean()) {
            ob_clean();
            }
        }
        throw $e;
        } catch (\Throwable $e) {
        while (ob_get_level() > $_obInitialLevel_) {
            if (!@ob_end_clean()) {
            ob_clean();
            }
        }
        throw $e;
        }
    }

    public function render($pathAlias, $params=[]) {
        $viewFile = path_join(get_stylesheet_directory().'/src/shortcodes/',$pathAlias).'.php';
        $returnText = '';
        if (file_exists($viewFile)) {      
            try {
                $returnText = $this->renderPhpFile($viewFile, $params);
            } catch(\Exception $e) {
                
            }
        }
        return $returnText;
    }
}