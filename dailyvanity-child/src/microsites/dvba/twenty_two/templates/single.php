<?php
do_action('get_header');
echo get_template_part('src/microsites/dvba/twenty_two/templates/_header');
global $post;
?>

<div class="container-fluid px-0 pt-0 pb-5" id="single-product-container">
  <div class="row g-0 m-0">
    <div class="col">
    </div>
  </div>
  <div class="row g-0 pt-md-5 m-0">
    <div class="col-12 col-sm-12 col-md-8 mt-5 mt-md-5 mx-auto px-4">
      <div class="container" id="product-details-container">
        <?php echo get_template_part('src/microsites/dvba/twenty_two/templates/_product-detail', null, $arr); ?>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid p-0 <?php echo $parent_slug ? $parent_slug . '-product-container' : $slug . '-product-container'; ?>">
  <div class="row g-0 m-0">
    <dic class="col p-0">
      <div class="container px-0 pb-5">
        <div class="container-fluid p-0 m-0" id="winners">
          <div class="row p-0 m-0">
              <div class="col winners-header">
                  Explore more
              </div>
          </div>
          <div class="row p-0 m-0">
              <div class="col winners-content p-5" style="background-color: #f9f7f5;">
                  <?php 

                    // CSS & JS for section 'more categories'
                    wp_enqueue_style( 'dvba-2022-single', get_stylesheet_directory_uri() . '/src/microsites/dvba/twenty_two/listing/css/DVBA2022Listing-single.css?v=' . current_time( 'timestamp' ));
                    wp_enqueue_script( 'dvba-2022-single', get_stylesheet_directory_uri() . '/src/microsites/dvba/twenty_two/listing/js/DVBA2022Listing-single.js?v=' . current_time( 'timestamp' ));

                    echo do_shortcode( '[dvba-2022-single menu="dvba-2022-category-menu"]' );
                    // echo do_shortcode( '[dvba-2022-single menu="dvsha-2021-category-menu"]' ); // for testing 1
                    // echo do_shortcode( '[dvsha-2021-category menu="dvsha-2021-category-menu"]' ); // for testing 2
                  ?>
              </div>
          </div>
        </div>

      </div>
  </div>
</div>
</div>

<!-- Script for slick slider -->
<script>
  jQuery(document).ready(function($) {
    $( '.zoom-image' )
    // .wrap( '<span style="display: inline-block;"></span>' )
    .zoom({
        on: 'mouseover',
        touch: true,
        magnify: 10
    });
    var galleryArgs = {
        dots: false,
        infinite: false,
        speed: 300,
        lazyLoad: 'ondemand',
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        pauseOnFocus: true,
        pauseOnHover: true,
        arrows: true,        
        prevArrow: $( '.gallery-prev-btn' ),
        nextArrow: $( '.gallery-next-btn' ),
        responsive: [
          {
            breakpoint: 481,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 2000,
                pauseOnFocus: true,
                pauseOnHover: true,
                prevArrow: $( '.gallery-prev-btn' ),
                nextArrow: $( '.gallery-next-btn' ),                
            }
          },
        ],
    };
    $('.product-gallery').slick( galleryArgs );
  });
</script>

<!-- Script for section explore more categories -->
<script>
    jQuery( document ).ready( function($) {
        var id = 'others-container';
        var height = $( '#'+id ).find( '.cat-content' ).height();
        console.log( height );

        if( !isMobile ) {
            $( '.cat-img' ).css( 'top', height/4+'px' );
        }
    } );
</script>
<?php
do_action('get_footer');
echo get_template_part('src/microsites/dvba/twenty_two/templates/_footer');
?>