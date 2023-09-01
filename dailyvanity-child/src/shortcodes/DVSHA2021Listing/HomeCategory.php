<?php 
namespace DVChild\shortcodes\DVSHA2021Listing;

class HomeCategory {
    public static function init( $args ) {
        $model = new HomeCategory();

        $model->args = shortcode_atts( array(
            'taxonomy'         => 'dvsha_2021_categories',
            'hide_empty'       => false,
            'orderby'          => 'name',
            'order'            => 'ASC',
            'parent'           => 0,
            'menu'             => '',
            'term_id'          => 0,
            'parent'           => 0
        ), $args );

        $model->generate();
    }
    
    public function generate() {
        if( !empty( $this->args['menu'] ) ) {
            if ( false === ( $categories = get_transient( 'dvsha_2021_categories_transient' ) ) ) { 
                if ( $menu_items = wp_get_nav_menu_items( $this->args['menu'] ) ) { 
                    $categories = array();
                    $n = 0;
                    foreach ( (array)$menu_items as $key => $menu_item ) {
                        $categories[$n]['parent_term_id'] = $menu_item->object_id;
                        $categories[$n]['parent_title'] = $menu_item->title;
                        $categories[$n]['parent_url'] = $menu_item->url;

                        $parent = get_term( $menu_item->object_id, 'dvsha_2021_categories' );
                        $categories[$n]['parent_slug'] = $parent->slug;

                        $meta = get_term_meta( $menu_item->object_id );
                        $categories[$n]['parent_img'] = wp_get_attachment_image_url( $meta['title'][0], 'full' );

                        $categories[$n]['child'] = get_terms(
                            'dvsha_2021_categories', array( 'parent' => $menu_item->object_id, 'hide_empty' => false )
                        );

                        $n++;
                    }

                    set_transient( 'dvsha_2021_categories_transient', $categories, DAY_IN_SECONDS );
                }
            }

            echo $this->render('DVSHA2021Listing/displayCategory', [
                'categories'        => $categories,
            ]);
        } else {
            if( $this->args['parent'] == 0 ) {
                $terms = get_terms( array(
                    'taxonomy'      => 'dvsha_2021_categories',
                    'parent'        => 0,
                    'exclude'       => $this->args['term_id'],
                    'orderby'       => 'rand',
                    'hide_empty'    =>false
                ) );
            } else {
                $terms = get_terms( array(
                    'taxonomy'      => 'dvsha_2021_categories',
                    'parent'        => 0,
                    'exclude'       => $this->args['parent'],
                    'orderby'       => 'rand',
                    'hide_empty'    =>false
                ) );
            }

            shuffle( $terms );

            $categories = array();
            $n = 0;
            foreach ( array_slice($terms, 0, 2) as $term ) {
                $categories[$n]['parent_term_id'] = $term->term_id;
                $categories[$n]['parent_title'] = $term->name;
                $categories[$n]['parent_url'] = get_term_link( $term->term_id );

                // $parent = get_term( $term->object_id, 'dvsha_2021_categories' );
                $categories[$n]['parent_slug'] = $term->slug;

                $meta = get_term_meta( $term->term_id );
                $categories[$n]['parent_img'] = wp_get_attachment_image_url( $meta['title'][0], 'full' );

                $categories[$n]['child'] = get_terms(
                    'dvsha_2021_categories', array( 'parent' => $term->term_id, 'hide_empty' => false )
                );

                $n++;
            }

            echo $this->render('DVSHA2021Listing/displayCategory', [
                'categories'        => $categories,
            ]);
        }

        // print_r( $posts->request );
        // print_r( '--------------------' );

        // print_r( $posts->found_posts );

        // if( $this->additional_args['paged'] == 1 ) {
        //     echo $this->render('Perks/display', [
        //         'posts'         => $posts,
        //         'args'          => $this->additional_args,
        //         'count'         => $posts->found_posts,
        //         'totalPages'    => $posts->max_num_pages,
        //         'paged'         => $this->additional_args['paged']
        //     ]);
        // } else {
        //     echo $this->render('Perks/_item', [
        //         'posts'         => $posts,
        //         'args'          => $this->additional_args,
        //         'count'         => $posts->found_posts,
        //         'totalPages'    => $posts->max_num_pages,
        //         'paged'         => $this->additional_args['paged']
        //     ]);
        // }
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