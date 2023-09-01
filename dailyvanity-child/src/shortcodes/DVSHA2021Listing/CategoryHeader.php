<?php 
namespace DVChild\shortcodes\DVSHA2021Listing;

class CategoryHeader {
    public static function init( $args ) {
        $model = new CategoryHeader();

        $model->args = shortcode_atts( array(
            // 'taxonomy'         => 'dvsha_2021_brands',
            // 'hide_empty'       => false,
            'id'        => 0,
            'parent'    => 0,
            'name'      => ''
        ), $args );

        $model->generate();
    }

    public function getParentCategoryName( $categories ) {
        foreach( $categories as $category ):
            if( $category->parent == 0 ):
                return $category->name;
            endif;
        endforeach;
    }

    public function getCategoryImage( $id ) {
        $meta = get_term_meta( $id );
        return wp_get_attachment_image_url( $meta['title'][0], 'full' );
    }
    
    public function generate() {
        if( $this->args['parent'] ) {
            $parent = get_term( $this->args['parent'] );
            $subCategories = get_terms( array( 
                'taxonomy' => 'dvsha_2021_categories', 
                'hide_empty' => false, 
                'parent' => $this->args['parent'] 
            ) );
        } else {
            $parent = get_term( $this->args['id'] );
            $subCategories = get_terms( array( 
                'taxonomy' => 'dvsha_2021_categories', 
                'hide_empty' => false, 
                'parent' => $this->args['id'] 
            ) );
        }

        echo $this->render('DVSHA2021Listing/displayCategoryHeaderNew', [
            'args'          => $this->args,
            'parent'        => $parent, 
            'subCategories' => $subCategories,
            'dvshaLogo'     => 'https://uploads.dailyvanity.sg/wp-content/uploads/2021/07/dvsha-logo.png'
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