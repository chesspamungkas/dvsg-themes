<?php 
namespace DVChild\shortcodes\DVSHA2021Listing;

class FeaturedBrands {
    public static function init( $args ) {
        $model = new FeaturedBrands();

        $model->args = shortcode_atts( array(
            'taxonomy'         => 'dvsha_2021_brands',
            'hide_empty'       => false,
            'orderby'          => 'rand'
        ), $args );

        $model->generate();
    }
    
    public function generate() {
        $this->args['meta_query'] = array(
            array(
                'key'     => 'featured_brand',
                'value'   => true,
                'compare' => '==',
            ),
        );
        
        $brands = new \Wp_Term_Query( $this->args );

        echo $this->render('DVSHA2021Listing/displayBrand', [
            'brands'        => $brands,
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