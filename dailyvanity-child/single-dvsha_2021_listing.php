<?php
    $customCss = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Listing/css/style.css?v=' . DEPLOY_VERSION;
    $customJs = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Listing/js/script.js?v=' . DEPLOY_VERSION;
    // $slickCss = '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css';
    // $slickThemeCss = 'https://kenwheeler.github.io/slick/slick/slick-theme.css';
    // $slickJs = '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js';
    $home = home_url() . '/best-spa-hair-facials-treatments-singapore/2021/';
    $fb = 'https://www.facebook.com/dailyvanity/';
    $ig = 'https://www.instagram.com/dailyvanity/?hl=en';
    $tw = 'https://twitter.com/dailyvanitysg?lang=en';
    $ytb = 'https://www.youtube.com/dailyvanity?sub_confirmation=1';

    include_once( __DIR__ . '/microsite/DVSHA/header.php' );
?>
    <style> 
        #intro > .row:not(:last-child) > .col { 
            min-height: 350px; 
        } 
        
        @media (min-width: 481px) { 
            .dvsha-logo{ 
                top: -250px; 
                width: 350px; 
                height: 350px; 
                margin-left: -175px; 
            } 
        } 

        @supports (-webkit-touch-callout: none) {
            /* CSS specific to iOS devices */ 
            .dvsha-logo{ 
                top: -200px !important; 
            } 
        }

        @supports not (-webkit-touch-callout: none) {
        /* CSS for other than iOS devices */ 
        }
    </style>

<?php
    include_once( __DIR__ . '/microsite/DVSHA/top-bar.php' );

    $dvshaLogo = 'https://uploads.dailyvanity.sg/wp-content/uploads/2021/07/dvsha-logo.png';

    if( $categories = get_the_terms( get_the_id(), 'dvsha_2021_categories' ) ):
        foreach( $categories as $category ):
            if( $category->parent == 0 ):
                $meta = get_term_meta( $category->term_id );
                $categoryImage = wp_get_attachment_image_url( $meta['title'][0], 'full' );
            else:
                $categoryName = $category->name;
                $categoryUrl = get_term_link( $category->slug, 'dvsha_2021_categories' );
            endif;
        endforeach;
    endif;

    $awards = array();
    $isPromo = false;
    $aCount = 0;
    $bgColor = '#CAC4B4';
    $color = '#000000';

    if( $brand = get_the_terms( get_the_id(), 'dvsha_2021_brands' )[0] ):
        if( get_field( 'featured_brand', 'dvsha_2021_brands_' . $brand->term_id ) ):
            $bgColor = '#EA4A7F';
            $color = '#ffffff';
        endif;
    endif;

    if( $filters = get_the_terms( get_the_id(), 'dvsha_2021_filters' ) ):
        foreach( $filters as $filter ):
            if( strpos( $filter->slug, 'choice' ) !== false ):
                $awards[$aCount]['term_id'] = $filter->term_id;
                $awards[$aCount]['slug'] = $filter->slug;
                $awards[$aCount]['name'] = $filter->name;

                $aCount++;
            endif;
        endforeach;
    endif;
?>

<div class="container-fluid p-0 m-0" id="intro">
    <div class="row p-0 m-0">
        <div class="col" style="background-image: url( '<?php echo $categoryImage; ?>' );"></div>
    </div>
    <div class="row p-0 m-0">
        <div class="col">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="dvsha-logo"><img src="<?php echo $dvshaLogo; ?>" /></div>

                        <h2 class="service-title text-center"><?php the_title(); ?></h2>

                        <ul class="service-award-list">
                        <?php foreach( $awards as $award ): ?>
                            <li style="background-color: <?php echo $bgColor; ?> ; color: <?php echo $color; ?> ;"><?php echo $award['name']; ?></li>
                        <?php endforeach; ?>
                        </ul>

                        <p class="service-category text-center"><a href="<?php echo $categoryUrl; ?>" target="_blank"><?php echo $categoryName; ?></a></p>
                        
                        <?php echo str_replace( '<p>', '<p class="service-content text-center">', str_replace( '<div id="' . DFP_300x250_C . '" class="dfp-div" style="width: 300px; height: 250px;"></div>', '', apply_filters( 'the_content', get_the_content() ) ) ); ?>

                        <div class="cta-form">
                            <?php echo apply_filters( 'the_content', get_the_excerpt() ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once(__DIR__ . '/microsite/DVSHA/footer-bar.php');
    include_once(__DIR__ . '/microsite/DVSHA/footer.php');
?>