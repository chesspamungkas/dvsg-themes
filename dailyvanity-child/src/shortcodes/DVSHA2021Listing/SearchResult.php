<?php 
namespace DVChild\shortcodes\DVSHA2021Listing;

class SearchResult {
    public static function init( $args ) {
        $model = new SearchResult();

        $model->args = shortcode_atts( array(
            'post_type'        => 'dvsha_2021_listing',
            'posts_per_page'   => 4,
            'post_status'      => 'publish',
            's'                => '',
            'paged'            => 1,
            'term_id'          => 0,
            'parent_id'        => 0,
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

    public function getCategory( $id ) {
        $terms = get_the_terms( $id, 'dvsha_2021_categories' );
        
        foreach( $terms as $term ) {
            if( $term->parent > 0 ) {
                $url = '<a href="' . get_term_link( $term->slug, 'dvsha_2021_categories' ) . '" target="_blank">' . $term->name . '</a>';
            }
        }

        return $url;
    }

    public function getThumbnail( $id, $title ) {
        if( strpos( get_the_post_thumbnail_url( $id ), '.gif' ) === false ):
            $imgId = get_post_thumbnail_id();
            $imgSrcset = wp_get_attachment_image_srcset( $imgId, 'article-thumbnail' );
            $imgAttributes = wp_get_attachment_image_src( $imgId, 'article-thumbnail' );
            $sizes = wp_get_attachment_image_sizes( $imgId, 'article-thumbnail' );
            $thumbnail = '<img width="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2]. '" src="' . get_the_post_thumbnail_url( get_the_ID(), 'large' ) . '" srcset="' . esc_attr( $imgSrcset ) . '" sizes="' . esc_attr( $sizes ) . '" alt="' . $title . '" class="post-thumbnail" />';
        else:
            $thumbnail = '<img width="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2]. '" src="' . get_the_post_thumbnail_url( $id, 'full' ) . '" alt="' . $title . '" class="post-thumbnail" />';
        endif;

        return $thumbnail;
    }

    public function getAwards( $id ) {
        $terms = get_the_terms( $id, 'dvsha_2021_filters' );

        foreach( $terms as $term ) {
            if( $term->slug == 'award-tiers' ) {
                $parent_id = $term->term_id;
                break;
            }
        }

        $awards = array();
        $count = 0;

        foreach( $terms as $term ) {
            if( $term->parent == $parent_id ) {
                $awards[$count]['term_id'] = $term->term_id;
                $awards[$count]['name'] = $term->name;
                $awards[$count]['slug'] = $term->slug;
                $count++;
            }
        }

        return $awards;
    }

    public function checkHasPromo( $id ) {
        $terms = get_the_terms( $id, 'dvsha_2021_filters' );

        foreach( $terms as $term ) {
            if( $term->slug == 'deals' ) {
                return true;
                break;
            }
        }

        return false;
    }

    public function checkIsFeatured( $id ) {
        return get_field( 'featured_brand', 'dvsha_2021_brands_' . $id );
    }
    
    public function generate() {
        $filters = array();

        if( $this->args['brands'] ) {
            // $brands = explode( ',', $this->args['brands'] );
            $filters = array_merge( $filters, explode( ',', $this->args['brands'] ) );
        //     $brandsArr = array(
        //         'taxonomy' => 'dvsha_2021_brands',
        //         'field'    => 'slug',
        //         'terms'    => $brands,
        //         'operator' => 'IN',
        //     );
        } else {
            $brands = '';
            // $brandsArr = array();
        }

        if( $this->args['awards'] ) {
            $filters = array_merge( $filters, explode( ',', $this->args['awards'] ) );
        }

        if( $this->args['misc'] ) {
            $filters = array_merge( $filters, explode( ',', $this->args['misc'] ) );
        }

        if( $this->args['priceranges'] ) {
            $filters = array_merge( $filters, explode( ',', $this->args['priceranges'] ) );
        }

        if( $this->args['skinconcerns'] ) {
            $filters = array_merge( $filters, explode( ',', $this->args['skinconcerns'] ) );
        }

        if( $this->args['skintypes'] ) {
            $filters = array_merge( $filters, explode( ',', $this->args['skintypes'] ) );
        }

        if( $this->args['hairconcerns'] ) {
            $filters = array_merge( $filters, explode( ',', $this->args['hairconcerns'] ) );
        }

        if( $this->args['bodyconcerns'] ) {
            $filters = array_merge( $filters, explode( ',', $this->args['bodyconcerns'] ) );
        }

        // $filtersQuery = array();

        // if( count( $filters ) > 0 ) {
        //     $filtersArr = array(
        //         'taxonomy' => 'dvsha_2021_filters',
        //         'field'    => 'slug',
        //         'terms'    => $filters,
        //         'operator' => 'IN'
        //     );
        // } else {
        //     $filtersArr = array();
        // }

        // if( count( $filtersArr ) > 0 ) {
        //     if( count( $brandsArr ) > 0 ) {
        //         $filtersQuery = array(
        //             'relation'  => 'OR',
        //             $filtersArr,
        //             $brandsArr
        //         );
        //     } else {
        //         $filtersQuery = array(
        //             'relation'  => 'OR',
        //             $filtersArr,
        //         );
        //     }
        // } elseif( count( $brandsArr ) > 0 ) {
        //     $filtersQuery = array(
        //         'relation'  => 'OR',
        //         $brandsArr
        //     );
        // }

        // $offset = ($this->args['paged'] - 1) * $this->args['posts_per_page'];

        // $args = array( 
        //     'post_type'        => 'dvsha_2021_listing',
        //     'posts_per_page'   => $this->args['posts_per_page'],
        //     'post_status'      => 'publish',
        //     'paged'            => $this->args['paged'],
        //     'offset'           => $offset,
        //     'meta_key'         => 'paid_service',
        //     'meta_type'        => 'NUMERIC',
        //     'orderby'          => 'meta_value_num',
        //     'order'            => 'DESC',
        // );

        // if( $this->args['term_id'] > 0 ) {
        //     if( count( $filtersQuery ) > 0 ) {
        //         $args['tax_query'] = array(
        //             'relation'  => 'AND',
        //             array(
        //                 'taxonomy' => 'dvsha_2021_categories',
        //                 'terms' => $this->args['term_id'],
        //                 'field' => 'term_id',
        //                 'include_children' => false
        //             ),
        //             $filtersQuery
        //         );
        //     } else {
        //         $args['tax_query'] = array(
        //             array(
        //                 'taxonomy' => 'dvsha_2021_categories',
        //                 'terms' => $this->args['term_id'],
        //                 'field' => 'term_id',
        //                 'include_children' => false
        //             )
        //         );
        //     }
        // }

        // if( $this->args['s'] ) {
        //     remove_filter('posts_request', 'relevanssi_prevent_default_request'); 
        //     remove_filter('the_posts', 'relevanssi_query', 99);
    
        //     $args['s'] = $this->args['s'];
        // }

        // $products = new \WP_Query( $args );

        // print_r( json_url( 'taxonomies/dvsha_2021_categories/terms' ) );

        echo $this->render('DVSHA2021Listing/displaySearchResult', [
            // 'products'          => $products,
            'args'              => $this->args,
            'filters'           => $filters,
            // 'totalPages'        => $products->max_num_pages,
            // 'currenttotalPosts' => $products->post_count
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