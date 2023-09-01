<?php 
namespace DVChild\shortcodes\DVSHA2021Listing;

class HomeJudges {
    public static function init( $args ) {
        $model = new HomeJudges();

        $model->args = shortcode_atts( array(
            'page_id' => 0
        ), $args );

        $model->generate();
    }
    
    public function generate() {
        if( false === ( $judges = get_transient( 'dvsha_2021_judges_transient' ) ) ) {
            $judges = get_field( 'judges', $this->args['page_id'] );
            set_transient( 'dvsha_2021_judges_transient', $judges, DAY_IN_SECONDS );
        }

        echo $this->render('DVSHA2021Listing/displayJudge', [
            'judges'    => $judges,
        ] );
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