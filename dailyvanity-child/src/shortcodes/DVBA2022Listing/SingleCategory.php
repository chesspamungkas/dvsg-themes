<?php 
namespace DVChild\shortcodes\DVBA2022Listing;

class SingleCategory {
    public static function init( $args ) {
        $model = new SingleCategory();

        $model->args = shortcode_atts( array(
            'taxonomy'         => 'dvba_2022_winners',
            'hide_empty'       => false,
            'orderby'          => 'name',
            'order'            => 'ASC',
            'parent'           => 0,
            'menu'             => '', // dvba-2022-category-menu
            'term_id'          => 0,
            'parent'           => 0
        ), $args );

        $model->generate();
    }
    
    public function generate() {

        $transient_name = 'dvba_2022_winners_transient';
        
        // Debug: Turn this on for debugging (delete transient data)
        // delete_transient($transient_name); 

        if( !empty( $this->args['menu'] ) ) {
            if ( false === ( $categories = get_transient( $transient_name ) ) ) {
                if ( $menu_items = wp_get_nav_menu_items( $this->args['menu'] ) ) {

                    $categories = array();
                    $n = 0;

                    // Shuffle and get only 2 items
                    shuffle($menu_items);
                    $menu_items = array_slice( $menu_items, 0, 2 );

                    foreach ( (array)$menu_items as $key => $menu_item ) {

                        $categories[$n]['parent_term_id'] = $menu_item->object_id;
                        $categories[$n]['parent_title'] = $menu_item->title;
                        $categories[$n]['parent_url'] = $menu_item->url;

                        $parent = get_term( $menu_item->object_id, 'dvba_2022_winners' );
                        $categories[$n]['parent_slug'] = $parent->slug;

                        $meta = get_term_meta( $menu_item->object_id );
                        $categories[$n]['parent_img'] = wp_get_attachment_image_url( $meta['title'][0], 'full' );

                        /*
                         * To get child categories. Uncomments these:
                         */
                        // $categories[$n]['child'] = get_terms(
                        //     'dvba_2022_winners', array( 'parent' => $menu_item->object_id, 'hide_empty' => false )
                        // );

                        $n++;
                    }

                    // Change the time for data resetting of each random period (DAY_IN_SECONDS)
                    set_transient( $transient_name, $categories, DAY_IN_SECONDS );
                }
            }

            echo $this->render('DVBA2022Listing/displayCategory', [
                'categories'        => $categories,
            ]);
        };
    }

    public function renderPhpFile($_file_, $_params_ = []) {
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