<?php 
namespace DVChild\shortcodes\DVSHA2021Listing;

class Filters {
    public static function init( $args ) {
        $model = new Filters();

        $model->args = shortcode_atts( array(
            'taxonomy'         => 'dvsha_2021_filters',
            'hide_empty'       => false,
            'brands'           => '',
            'awards'           => '',
            'misc'             => '',
            'priceranges'      => '',
            'skinconcerns'     => '',
            'skintypes'        => '',
            'hairconcerns'     => '',
            'bodyconcerns'     => ''
        ), $args );

        $model->generate();
    }

    public function getBrandsFilterItem( $brands=null ) {
        $brandsArr = array();

        if( $brands ) {
            $brandsArr = explode( ',', $brands );
        }

        $child = get_terms( array( 
            'taxonomy' => 'dvsha_2021_brands', 
            'hide_empty' => false
        ) );

        $content .= '<ul>';
        foreach( $child as $item ) {
            if( in_array( $item->slug, $brandsArr ) ) {
                $checked = ' checked="checked"';
            } else {
                $checked = '';
            }

            $content .= '<li>';
            $content .= '<div class="form-check">';
            $content .= '<input class="form-check-input filter-checkbox" type="checkbox" value="' . $item->slug . '" name="brands-checkbox-group[]"' . $checked . '>';
            $content .= '<label class="form-check-label" for="brands-checkbox-group">' . $item->name . '</label>';
            $content .= '</div>';
            $content .= '</li>';
        }
        $content .= '</ul>';

        return $content;
    }

    public function getFilterItem( $id, $slug, $awards=null, $misc=null, $priceranges=null, $skinconcerns=null, $skintypes=null, $hairconcerns=null, $bodyconcerns=null ) {
        $awardsArr = array();
        $miscArr = array();
        $priceRangesArr = array();
        $skinConcernsArr = array();
        $skinTypesArr = array();
        $hairConcernsArr = array();
        $bodyConcernsArr = array();

        if( $awards ) {
            $awardsArr = explode( ',', $awards );
        }

        if( $misc ) {
            $miscArr = explode( ',', $misc );
        }

        if( $priceranges ) {
            $priceRangesArr = explode( ',', $priceranges );
        }

        if( $skinconcerns ) {
            $skinConcernsArr = explode( ',', $skinconcerns );
        }

        if( $skintypes ) {
            $skinTypesArr = explode( ',', $skintypes );
        }

        if( $hairconcerns ) {
            $hairConcernsArr = explode( ',', $hairconcerns );
        }

        if( $bodyconcerns ) {
            $bodyConcernsArr = explode( ',', $bodyconcerns );
        }

        $filtersArr = array_merge( $awardsArr, $miscArr, $priceRangesArr, $skinConcernsArr, $skinTypesArr, $hairConcernsArr, $bodyConcernsArr );

        $content = '';

        $parent = get_term_by( 'id', $id, 'dvsha_2021_filters' );

        $args = array( 
            'taxonomy' => 'dvsha_2021_filters', 
            'hide_empty' => false, 
            'parent' => $id
        );

        $child = get_terms( $args );
        $newChild = array();

        if( $parent->slug == 'price-range' ) {
            $orderArr = array( 'under-50', '51-80', '81-100', '101-200', 'above-200' );

            foreach( $child as $term ) {
                $key = array_search( $term->slug, $orderArr );
                $newChild[$key] = $term;
            }

            ksort( $newChild );

            $content .= '<ul>';
            foreach( $newChild as $item ) {
                if( in_array( $item->slug, $filtersArr ) ) {
                    $checked = ' checked="checked"';
                } else {
                    $checked = '';
                }
    
                $content .= '<li>';
                $content .= '<div class="form-check">';
                $content .= '<input class="form-check-input filter-checkbox" type="checkbox" value="' . $item->slug . '" name="' . $slug . '-checkbox-group[]"' . $checked . '>';
                $content .= '<label class="form-check-label" for="' . $slug . '-checkbox-group">' . $item->name . '</label>';
                $content .= '</div>';
                $content .= '</li>';
            }
            $content .= '</ul>';
        } else {
            $content .= '<ul>';
            foreach( $child as $item ) {
                if( in_array( $item->slug, $filtersArr ) ) {
                    $checked = ' checked="checked"';
                } else {
                    $checked = '';
                }
    
                $content .= '<li>';
                $content .= '<div class="form-check">';
                $content .= '<input class="form-check-input filter-checkbox" type="checkbox" value="' . $item->slug . '" name="' . $slug . '-checkbox-group[]"' . $checked . '>';
                $content .= '<label class="form-check-label" for="' . $slug . '-checkbox-group">' . $item->name . '</label>';
                $content .= '</div>';
                $content .= '</li>';
            }
            $content .= '</ul>';
        }

        return $content;
    }
    
    public function generate() {
        global $post;

        $slug = '';

        if( $post->parent == 0 ) {
            $slug = $post->slug;
        } else {
            $pTerm = get_term( $post->parent, 'dvsha_2021_categories' );
            $slug = $pTerm->slug;
        }

        $terms = get_terms( $this->args );
        $parent = array();
        $count = 0;
        
        foreach( $terms as $term ) {
            // print_r( $term );
            if( $term->parent == 0 ) {
                if( ( $term->slug == 'skin-type' || $term->slug == 'skin-concerns' ) && ( strpos( $slug, 'facial' ) !== false || strpos( $slug, 'aesthetic' ) !== false ) ) {
                    $parent[$count]['term_id'] = $term->term_id;
                    $parent[$count]['name'] = $term->name;
                    $parent[$count]['slug'] = $term->slug;

                    $count++;
                } elseif( $term->slug == 'body-concerns' && strpos( $slug, 'body' ) ) {
                    $parent[$count]['term_id'] = $term->term_id;
                    $parent[$count]['name'] = $term->name;
                    $parent[$count]['slug'] = $term->slug;

                    $count++;
                } elseif( $term->slug == 'hair-concerns' && strpos( $slug, 'hair' ) ) {
                    $parent[$count]['term_id'] = $term->term_id;
                    $parent[$count]['name'] = $term->name;
                    $parent[$count]['slug'] = $term->slug;

                    $count++;
                } elseif( $term->slug == 'promo' || $term->slug == 'price-range' || $term->slug == 'award-tiers' ) {
                    $parent[$count]['term_id'] = $term->term_id;
                    $parent[$count]['name'] = $term->name;
                    $parent[$count]['slug'] = $term->slug;

                    $count++;
                }
            }
        }

        echo $this->render('DVSHA2021Listing/displayFilters', [
            'post'     => $post,
            'args'     => $this->args,
            'parents'   => $parent
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