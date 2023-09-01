<style>
    @media (min-width: 481px) {
        .no-results {
            width: 100%; 
            min-height: 350px; 
            text-align:center; 
            padding-top: 50px;
        }
    }
</style>
<?php 
    if( $args['paged'] == 1 ): 
        if( $args['s'] ):
?>
<div class="container-fluid px-0 pt-0 pb-5" id="search-result-header">
    <div class="row g-0 pt-md-5 m-0">
        <div class="col-12 col-sm-12 col-md-8 pt-5 pt-md-4 mx-auto px-4 text-center">
            <h1 class="eb-garamond-regular">Search Results for: <span class="search-keyword"><?php echo $args['s']; ?></span></h1>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="container-fluid p-0" id="search-result-list">
    <div class="row no-gutters search-result-list-container">
<?php
    endif;

    // if( $products->have_posts() ):
    //     while( $products->have_posts() ):
    //         $products->the_post();

    //         // $brand = get_the_terms( get_the_id(), 'dvsha_2021_brands' );

    //         if( get_field( 'paid_service', get_the_id() ) ) {
    //             $bgColor = '#EA4A7F';
    //             $color = '#ffffff';
    //         } else {
    //             $bgColor = '#CAC4B4';
    //             $color = '#000000';
    //         }

    //         echo '<div class="col-12 p-0 m-0">';
    //         echo $this->render( 'DVSHA2021Listing/_listItem', [ 
    //             'name'      => get_the_title(),
    //             'content'   => get_the_content(),
    //             'excerpt'   => get_the_excerpt(),
    //             'url'       => get_the_permalink(),
    //             'thumbnail' => $this->getThumbnail( get_the_id(), get_the_title() ),
    //             'category'  => $this->getCategory( get_the_id() ),
    //             'awards'    => $this->getAwards( get_the_id() ),
    //             'bgColor'   => $bgColor,
    //             'color'     => $color,
    //             'hasPromo'  => $this->checkHasPromo( get_the_id() )
    //         ] ); 
    //         echo '</div>';
    //     endwhile;
    //     wp_reset_postdata();
    // endif;

    if( $args['paged'] == 1 ):
?>
    </div>
    <div class="row load-more-btn-row">
        <div class="col text-center p-3">
            <button class="load-more-result-btn" id="<?php echo get_the_id(); ?>-<?php echo $totalPages; ?>">Load More</button>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    jQuery( document ).ready( function( $ ) {
        var url = 'https://uploads.dailyvanity.sg/wp-content/uploads/json/dvsha2021listing_22_11_2021.json';
        var termID = <?php echo $args['term_id']; ?>;
        var keyword = '<?php echo $args['s']?$args['s']:''; ?>';
        var filters = '<?php echo implode( ',', $filters ); ?>';
        var filtersArr = filters.split( ',' );

        $.getJSON(  url, ( response ) => {
            var data = _.sortBy( _.sortBy( response.data, ( d ) => d.title.rendered ).reverse(), ( d ) => d.custom_field_paid_service[0].value ).reverse();
            
            $.each( data, function( key, val ) {
                // console.log( keyword );
                if( keyword ) {
                    if( ( ContainsExactWord( val.title.rendered, keyword ) || ContainsExactWord( val.content.rendered, keyword ) || val.dvsha_2021_brands_attr[0].name.indexOf( keyword ) > -1 ) && val.status == 'publish' ) {
                        jQuery( '.search-result-list-container' ).append( display_item( val ) );
                    }
                } else {
                    if( _isContains( val.dvsha_2021_categories, termID ) && val.status == 'publish' ) {
                        if( filtersArr.length ) {
                            $.each( filtersArr, function( index, value ) {
                                if( val.dvsha_2021_filters_attr[0].link.indexOf( value ) > -1 || val.dvsha_2021_brands_attr[0].link.indexOf( value ) > -1 ) {
                                    jQuery( '.search-result-list-container' ).append( display_item( val ) );
                                }
                            } );
                        } else {
                            jQuery( '.search-result-list-container' ).append( display_item( val ) );
                        }
                    }
                }
            } );
        } ).done( function( data ) {
            if( $( '.list-item-card' ).length < 4 ) {
                $( '.load-more-btn-row' ).hide();
            }

            $( '.list-item-card' ).slice( 0, 4 ).show();
        } );

        $( 'body' ).on( 'click', '.load-more-result-btn', function( e ) {
            e.preventDefault();

            $( '.load-more-result-btn' ).html( '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...' );
            
            $( '.list-item-card:hidden' ).slice( 0, 4 ).fadeIn();
            
            if( $( '.list-item-card:hidden' ).length > 0 ) {
                jQuery( '.load-more-result-btn' ).html( 'LOAD MORE' );
            } else {
                jQuery( '.load-more-result-btn' ).fadeOut( 'slow' );
            }
        } );
    } );

    function display_item( content ) {
        let body = '';
        let bgColor, color = '';

        body += '<div class="card list-item-card py-5" style="display: none;">';
        body += '<div class="row no-gutters justify-content-center">';
        body += '<div class="col-12 col-md-6 card-image">';
        body += '<img src="' + content.dvsha_2021_listing_image_src + '" alt="' + content.title.rendered + '" class="post-thumbnail" />';
        body += '</div>';
        body += '<div class="col-12 col-md-5">';
        body += '<div class="card-body">';
        body += '<div class="list-item-content-top">';
        body += '<ul class="award-list">';

        if( content.custom_field_paid_service[0].value ) {
            bgColor = '#EA4A7F';
            color = '#ffffff';
        } else {
            bgColor = '#CAC4B4';
            color = '#000000';
        }

        body += generateAwards( content.dvsha_2021_filters_attr, bgColor, color );
        body += '</ul>';
        body += '<h2 class="card-title">';
        body += '<span class="listTitle">' + content.title.rendered + '</span>';
        body += '</h2>';
        body += '<div class="list-item-link">' + generateCategory( content.dvsha_2021_categories_attr ) + '</div>';
        body += '</div>';
        body += '<div class="list-item-content-bottom">';
        body += content.content.rendered;

        if( _isContains( content.dvsha_2021_filters_attr, 'Promotions' ) ) {
            body += generatePromo( content.custom_field_cta_button_text[0], content.custom_field_cta_button_link[0], content.link );
        }

        body += '</div>';
        body += '</div>';
        body += '</div>';
        body += '</div>';
        body += '<div class="list-item-card-bg"></div>';
        body += '</div>';

        return body;
    }

    function generateAwards( content, bgColor, color ) {
        let body = '';

        content.forEach( function( value, index ) {
            if( value.name.includes( 'Choice' ) ) {
                body += '<li style="background-color: ' + bgColor + '; color: ' + color + ';">' + value.name + '</li>';
            }
        } );

        return body;
    }

    function generateCategory( content ) {
        let body = '';

        content.forEach( function( value, index ) {
            if( value.parent != 0 ) {
                body += '<a href="' + value.link + '" target="_blank">' + value.name + '</a>';
            }
        } );
        
        return body;
    }

    function generatePromo( ctaText, ctaLink, defaultLink ) {
        let body = '';
        let url = '';
        let title = '';

        if( ctaText.value && ctaLink.value ) {
            title = ctaText.value;
            url = ctaLink.value;
        } else {
            title = 'Get This Perk Today';
            url = defaultLink;
        }

        body += '<p>';
        body += '<a href="' + url + '" title="' + title + '" target="_blank" class="cta-btn">';
        body += title;
        body += '</a>';
        body += '</p>';

        return body;
    }

    function _isContains(json, value) {
        let contains = false;
        Object.keys(json).some(key => {
            contains = typeof json[key] === 'object' ? _isContains(json[key], value) : json[key] === value;
            return contains;
        });
        return contains;
    }

    function ContainsExactWord( sentence, compare ) {
        var keywords = compare.toLowerCase().split(" ");

        keywords.push( compare.toLowerCase() );

        for( var a = 0; a < keywords.length; ++a ) {
            if( sentence.toLowerCase().includes( keywords[a] ) ) {
                return true;
                break;
            }
        }

        return false;
    }
</script>
