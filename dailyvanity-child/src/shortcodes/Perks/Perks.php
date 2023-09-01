<?php 
namespace DVChild\shortcodes\Perks;

class Perks {
    private $perks_publish_args = null;
    private $perks_expired_args = null;

    private $additional_args = [
      'title'=>"1"
    ];
    
    public static function init( $args ) {
        $model = new Perks();

        $model->search_args = shortcode_atts( array(
            'posts_per_page'    => 18,
            'paged'             => 1,
            'post_type'         => 'deal',
            'post_status'       => 'publish',
            'orderby'           => 'date',
            'order'             => 'DESC',
            'title'             => '1'
        ), $args );

        foreach($model->additional_args as $key=>$value) {
            if( isset($model->search_args[$key]) ) {
              unset($model->search_args[$key]);
            }
        }

        foreach( $model->search_args as $k=>$v ) {
          if( !$model->search_args[$k] ) {
            unset( $model->search_args[$k] );
          }
        }

        if( isset( $args['title'] ) ) {
            $model->additional_args['title'] = $args['title'];
        }

        $model->additional_args = array_merge($model->additional_args, $model->search_args);

        $model->generate();
    }
    
    public function generate() {
        global $post;

        $offset = ( $this->additional_args['paged'] - 1 ) * $this->additional_args['posts_per_page'];
        $this->additional_args['offset'] = $offset;
        $this->search_args['offset'] = $offset;

        $posts = new \WP_Query( $this->search_args );

        // print_r( $posts->request );
        // print_r( '--------------------' );

        // print_r( $posts->found_posts );

        if( $this->additional_args['paged'] == 1 ) {
            echo $this->render('Perks/display', [
                'posts'         => $posts,
                'args'          => $this->additional_args,
                'count'         => $posts->found_posts,
                'totalPages'    => $posts->max_num_pages,
                'paged'         => $this->additional_args['paged']
            ]);
        } else {
            echo $this->render('Perks/_item', [
                'posts'         => $posts,
                'args'          => $this->additional_args,
                'count'         => $posts->found_posts,
                'totalPages'    => $posts->max_num_pages,
                'paged'         => $this->additional_args['paged']
            ]);
        }
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