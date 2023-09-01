<?php 
namespace DVChild\shortcodes\DVBA2022Voting;

class FooterBar {
    public static function init( $args ) {
        $model = new FooterBar();

        $model->args = shortcode_atts( array(
            // 'taxonomy'         => 'dvsha_2021_brands',
            // 'hide_empty'       => false,
            // 'id'        => 0,
            // 'parent'    => 0,
            // 'name'      => ''
        ), $args );

        $model->generate();
    }
    
    public function generate() {

        echo $this->render('DVBA2022Voting/displayFooterBar', [
            // 'args'          => $this->args,
            // 'parent'        => $parent, 
            // 'subCategories' => $subCategories,
            'bgImg'     => S3_PATH . '/wp-content/uploads/dvba-2021/dvba-2021-voting-footer-bg.jpg'
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