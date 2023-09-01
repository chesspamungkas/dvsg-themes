<?php

$term_id = get_queried_object()->term_id;

if( get_term_children( $term_id, "dvba_2020_categories" ) ) {
    $prod = 0;
    $parent_id = get_queried_object()->parent;
    $parent = get_term_by( "id", $parent_id, "dvba_2020_categories" );

    $headerSlug = get_queried_object()->slug;

    $img = wp_get_attachment_image_src( get_option( 'categoryimage_' . $term_id ), 'full' );
} else {
    $prod = 1;
    $parent_id = get_queried_object()->parent;
    $tparent = get_term_by( "id", $parent_id, "dvba_2020_categories" );
    $ancestor_id = $tparent->parent;
    $parent = get_term_by( "id", $ancestor_id, "dvba_2020_categories" );

    if( preg_match( '/\bchoices\b/', get_queried_object()->slug ) ) {
        if( preg_match( '/\bjudges-choices\b/', get_queried_object()->slug ) ) {
            $hash = 'judges';
        } else {
            $hash = 'readers';
        }
    } else if( preg_match( '/\bworth-a-shot\b/', get_queried_object()->slug ) ) {
        $hash = 'worthashot';
    }

    $headerSlug = $parent->slug;

    $img = wp_get_attachment_image_src( get_option( 'categoryimage_' . $parent->term_id ), 'full' );
}

// echo $hash;

function get_prods( $id, $is_paid, $prod, $choice ) {
    if( $prod == 1 ) {
        $args = array(
            'post_type'      => 'dvba_2020_winners',
            'posts_per_page'  => -1,
            'orderby'        => 'rand', 
            'tax_query' => array(
                array(
                    'taxonomy'         => 'dvba_2020_categories',
                    'field'            => 'term_id',
                    'include_children' => true,
                    'operator'         => 'IN',
                    'terms'            => $id,
                ),
            ),
        );
    } else {
        $args = array(
            'post_type'      => 'dvba_2020_winners',
            'posts_per_page'  => -1,
            'orderby'        => 'rand', 
            'tax_query' => array(
                // 'relation'  => 'AND',
                array(
                    'taxonomy'         => 'dvba_2020_categories',
                    'field'            => 'term_id',
                    'include_children' => true,
                    'operator'         => 'IN',
                    'terms'            => $id,
                ),
                // array(
                //     'taxonomy'         => 'dvba_2020_categories',
                //     'field'            => 'slug',
                //     'include_children' => true,
                //     'operator'         => 'EXISTS',
                //     'terms'            => $choice,
                // ),
            ),
            'meta_query'    => array(
                // 'relation'  => 'AND',
                // array(
                //     'key'       => 'choices',
                //     'value'     => $choice,
                //     'compare'   => 'like'
                // ),
                array(
                    'key'       => 'paid_advertiser',
                    'value'     => $is_paid,
                    // 'compare'   => 'like'
                ),
            ),
        );
    }
    
    $posts = new WP_Query( $args );

    // print_r( $posts->request );
    // print_r( $posts->found_posts . '---' );

    return $posts;
}

function display_prods( $posts, $paid, $term, $parent, $choices, $prod ) {
    $count = 0;
    if( $posts->have_posts() ) {
        echo '<div class="container no-padding no-margin">';
        while ( $posts->have_posts() ) {
            $posts->the_post();
            $taxonomies = get_the_terms( $post->ID, get_queried_object()->taxonomy );
            $catName = '';
            $catSlug = '';

            // print_r( $taxonomies );

            foreach($taxonomies as $taxonomy) {
            //     print_r( $term . '/' . $taxonomy->term_id . '/' . $parent . '###</br>' );
            //     print_r( $catSlug .'/'. $choices .'/'. $catName .'<br/>' );
                // echo $prod;
                if( $prod == 0 ) {
                    if( $taxonomy->term_id != $term && $taxonomy->term_id != $parent && preg_match( '/\b' . $choices . '\b/', $taxonomy->slug ) ) {
                        $parent = get_term_by( 'id', $taxonomy->parent, 'dvba_2020_categories' );
                        // $catName = str_replace( "-", " ", str_replace( $choices, '', $taxonomy->slug ) );   
                        $catName = $parent->name;
                        $catSlug = $taxonomy->slug;  

                        // echo $catSlug;
                        // print_r( $term . '/' . $taxonomy->term_id . '/' . $parent . '###</br>' );
                        // print_r( $catSlug .'/'. $choices .'/'. $catName .'<br/>' );
                        // break;
                    }
                } else {
                    // echo 'here';
                    if( $taxonomy->term_id == $term ) {
                        // print_r( $taxonomy );
                        $parent = get_term_by( 'id', $taxonomy->parent, 'dvba_2020_categories' );
                        // $catName = str_replace( "-", " ", str_replace( $choices, '', $taxonomy->slug ) );   
                        $catName = $parent->name;
                        $catSlug = $taxonomy->slug;  
                        // break;
                    }
                }
            
                // wp_reset_postdata();

                // echo $catSlug.'<br>';
            }

            // print_r( $catSlug .'/'. $choices .'/'. $catName .'<br/>' );

            if( !preg_match( '/\b' . $choices . '\b/', $catSlug ) ) {
                // echo 'skip ' . $catSlug . '</br>';
                continue;
            } else {
                $count++;
            }

            // print_r( $catSlug .'/'. $choices .'/'. $catName .'<br/>' );

            $fImage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );

            if( $paid == "yes" ) {
                echo '<div class="row fbg no-margin">';
            } else {
                echo '<div class="row no-margin">';
            }
            
            // echo '<div class="col-md-4 col-sm-12 col-xs-12 no-padding grey-border prod-img" style="background-image:url(' . $fImage[0] . ');">';
            echo '<div class="col-md-4 col-sm-12 col-xs-12 no-padding grey-border prod-img"><img src="' . $fImage[0] . '" alt="best popular ' . strtolower( $catName ) . ' products singapore 2020" />';
            echo '</div>';
            echo '<div class="col-md-8 col-sm-12 col-xs-12 prod-content">';

            // if( get_term_children( $term, "dvba_2020_categories" ) ) {
                echo '<h2 class="montserrat">Best ' . $catName . '</h2>';
                echo '<h4 class="montserrat">' . get_the_title() . '</h4>';
            // } else {
            //     echo '<h2 class="montserrat">' . get_the_title() . '</h2>';
            // }
            the_content();
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
            
        wp_reset_postdata();
    }

    return $count;
}
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/mbt5uwy.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!--link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/-->
<link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvba-listing-2020/css/custom_2.css?v=<?php echo DEPLOY_VERSION; ?>">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- <script src="<?php //echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvba-listing-2020/js/bootstrap-hover-dropdown.min.js"></script> -->
<!--script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script-->

<?php include( "navigation_bar.php" ); ?>

<div class="container full-width no-padding">
    <div class="row no-margin">
        <div class="col no-padding <?php echo $headerSlug . '-header'; ?>" id="category-header" style="background-image:url('<?php echo $img[0]; ?>');">
            <header class="justify-content-center">
                <!--div id="header-title"><h1 class="flood"><?php //echo get_term_children( $term_id, "dvba_2020_categories" )?'':'Best '; ?><?php //echo get_queried_object()->name; ?></h1></div-->
            </header>
        </div>
    </div>
</div>
<div class="container" id="winners-container">
    <div class="row no-margin">
        <div class="col">
            <ul class="nav nav-tabs" role="tablist" id="tab-button">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#" role="tab" aria-expanded="true" id="tab-judges">Judges' Choices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#" role="tab" aria-expanded="false" id="tab-readers">Readers' Choices</a>
                </li>
                <li class="nav-item worthashot-li">
                    <a class="nav-link" data-toggle="tab" href="#" role="tab" aria-expanded="false" id="tab-worthashot">Worth A Shot</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="judges" role="tabpanel" aria-expanded="true">
                    <?php 
                    // echo $prod;
                    // echo $hash;

                    if( $prod == 0 ) {
                        $fEditor = get_prods( $term_id, 'yes', $prod, 'judges-choices' );
                        $nEditor = get_prods( $term_id, 'no', $prod, 'judges-choices' );

                        $f = display_prods( $fEditor, 'yes', $term_id, $parent_id, 'judges-choices', $prod );
                        $n = display_prods( $nEditor, 'no', $term_id, $parent_id, 'judges-choices', $prod );

                        if( !$f && !$n ) {
                            echo '<h4>No Product Found.</h4>';
                        }
                    } else {
                        if( $hash == 'judges' ) {
                            // echo 'here';
                            display_prods( get_prods( $term_id, 'no', $prod, 'judges-choices' ), 'no', $term_id, $parent_id, 'judges-choices', $prod );
                        }
                    }
                    ?>
                </div>
                <div class="tab-pane fade" id="readers" role="tabpanel" aria-expanded="false">
                    <?php 
                    if( $prod == 0 ) {
                        $fUser = get_prods( $term_id, 'yes', $prod, 'readers-choices' );
                        $nUser = get_prods( $term_id, 'no', $prod, 'readers-choices' );

                        $f = display_prods( $fUser, 'yes', $term_id, $parent_id, 'readers-choices', $prod );
                        $n = display_prods( $nUser, 'no', $term_id, $parent_id, 'readers-choices', $prod );

                        if( !$f && !$n ) {
                            echo '<h4>No Product Found.</h4>';
                        }
                    } else {
                        if( $hash == 'readers' ) {
                            display_prods( get_prods( $term_id, 'no', $prod, 'readers-choices' ), 'no', $term_id, $parent_id, 'readers-choices', $prod );
                        }
                    }
                    ?>
                </div>
                <div class="tab-pane fade" id="worthashot" role="tabpanel" aria-expanded="false">
                    <?php 
                    $empty = 1;
                    if( $prod == 0 ) {
                        $fUser = get_prods( $term_id, 'yes', $prod, 'worth-a-shot' );
                        $nUser = get_prods( $term_id, 'no', $prod, 'worth-a-shot' );

                        $f = display_prods( $fUser, 'yes', $term_id, $parent_id, 'worth-a-shot', $prod );
                        $n = display_prods( $nUser, 'no', $term_id, $parent_id, 'worth-a-shot', $prod );


                        if( !$f && !$n ) {
                            echo '<h4>No Product Found.</h4>'; 
                            $empty = 0;
                        }
                    } else {
                        if( $hash == 'worthashot' ) {
                            display_prods( get_prods( $term_id, 'no', $prod, 'worth-a-shot' ), 'no', $term_id, $parent_id, 'worth-a-shot', $prod );
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
        if( !get_term_children( $term_id, "dvba_2020_categories" ) ) {
            echo '<div class="row"><div class="col text-center"><a href="' . get_term_link( $ancestor_id ) . '" class="back-btn">Back</a></div></div>';
        } 
    ?>
</div>

<script>

jQuery(document).ready(function() {
    var hash = '<?php echo $hash; ?>';
    var isProdPage = '<?php echo $prod; ?>';
    var empty = <?php echo $empty; ?>;

    console.log( hash );
    console.log( isProdPage );

    if( !empty ) {
        jQuery( '.worthashot-li' ).hide();
    }

    if( hash ) {
        // var hashId = hash.replace( '#', '' );
        if( isProdPage == '0' ) {
            jQuery( ".nav-tabs a.nav-link" ).removeClass( 'active' );
            jQuery( "#tab-" + hash ).addClass( 'active' );
        } else {
            jQuery( ".nav-tabs" ).hide();
        }
        jQuery( ".tab-content .tab-pane" ).each( function() {
            var y = jQuery( this ).attr( "id" );
            if ( hash == y ) 
                jQuery( this ).addClass( "active show" );
            else 
                jQuery( this ).removeClass( "active show" );
        });
    }

    jQuery( ".nav-tabs a.nav-link" ).click(function(){
        var id = jQuery( this ).attr( "id" );
        var arr = id.split( "-" );
        var x = arr[1];
        // x = x.replace( "#", "" );
        // console.log(window.location.hash);
        jQuery( ".nav-tabs a.nav-link" ).removeClass( 'active' );
        jQuery( this ).addClass( 'active' );
        jQuery( ".tab-content .tab-pane" ).each( function() {
            var y = jQuery( this ).attr( "id" );
            if ( x == y ) 
                jQuery( this ).addClass( "active show" );
            else 
                jQuery( this ).removeClass( "active show" );
        });
    });
});

</script>
