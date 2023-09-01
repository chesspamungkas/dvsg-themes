<?php
    $orderArr = array('skincare', 'makeup', 'body-care', 'hair-care');

    foreach( $orderArr as $k => $v ) {
    
        $typeArgs = [
            'taxonomy'  => 'dvba_2021_categories',
            'slug'      => $v,
            'hide_empty'    => false
        ];

        $types = new WP_Term_Query( $typeArgs );

        foreach( $types->terms as $term ) {
            $t = get_term( $term->term_id );
            $parent = array( 
                'term_id' => $term->term_id, 
                'term_name' => $term->name, 
                'term_slug' => $term->slug,
                'count' => $t->count
            );
            
            get_template_part( 'microsite/DVBA2021Listing/templates/HomeCategory', null, $parent );
        }
    }
?>