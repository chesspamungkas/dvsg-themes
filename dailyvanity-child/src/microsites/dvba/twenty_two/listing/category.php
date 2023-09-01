<?php
    $orderArr = array('skincare', 'makeup', 'body-care', 'hair-care');

    foreach( $orderArr as $k => $v ) {
    
        $typeArgs = [
            'taxonomy'  => 'dvba_2022_categories',            
            'hide_empty'    => false
        ];

        $types = new WP_Term_Query( $typeArgs );
        if($types->terms || ($types->terms && count($types->terms)>0)) {
            foreach( $types->terms as $term ) {
                $t = get_term( $term->term_id );
                $parent = array( 
                    'term_id' => $term->term_id, 
                    'term_name' => $term->name, 
                    'term_slug' => $term->slug,
                    'count' => $t->count
                );
                
                get_template_part( 'src/microsite/dvba/twenty_two/listing/templates/HomeCategory', null, $parent );
            }
        }

        
    }
?>