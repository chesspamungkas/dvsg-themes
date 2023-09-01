<?php

$mode = 'subpage';

$term_id = get_queried_object()->term_id;
$slug = get_queried_object()->slug;
$name = get_queried_object()->name;
// $parent_id = get_queried_object()->parent;

include_once(__DIR__.'/shortcodes/google-dfp/google-dfp.php');
get_header();

?>
<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvsha-listing-2020/css/custom.css?v=<?php echo current_time( 'timestamp' ); ?>">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script>
  var baseURL = '<?php echo home_url(); ?>/best-spa-hair-facials-treatments/';
</script>

<div class="scroll-to-top"><a href="#top" title="Scroll To Top"><i class="fa fa-arrow-circle-up fa-lg"></i></a></div>
<a name="top"></a>
<div class="container-fluid no-padding">
    <?php /* <div class="row no-margin">
      <div class="col-12 no-padding header-bg" style="padding-bottom: 0;">
          <!-- Header above nav start -->
          <?php include( "microsite/dvsha-listing-2020/top-header.php" ); ?>
          <!-- Header above nav end -->
      </div>
    </div> */ ?>
    <div class="row no-margin">
      <div class="col-12 no-padding header-bg-2">
        <!-- Header above nav start -->
        <?php include( "microsite/dvsha-listing-2020/top-header.php" ); ?>
        <!-- Header above nav end -->
        <div class="container-fluid no-padding white-bg">
          <div class="row no-margin">
            <div class="col-12 no-padding">
              <div class="container no-padding">
                <div class="row no-margin">
                  <div class="col-12 no-padding">
                    <h1 id="category-page-title"><?php echo $name; ?></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row no-margin">
            <div class="col-12 no-padding header-bg">
              <div class="container no-padding">
                <div class="row no-margin">
                  <div class="row no-margin justify-content-center">
                    <?php 
                      $args = array(
                        'post_type'       => 'dvsha_2020_listing',
                        'posts_per_page'  => -1,
                        'meta_key'        => 'have_promotion',
                        'orderby'         => 'post_title', 
                        'order'           => 'ASC',
                        'tax_query' => array(
                            array(
                              'taxonomy'  => 'dvsha_2020_brands',
                              'field'     => 'term_id',
                              'terms'     => $term_id,
                            ),
                        ),
                      );

                      $results = new WP_Query( $args );

                      // print_r( $results );

                      if( $results->have_posts() ) {
                        // foreach( $results as $result ) {
                        while( $results->have_posts() ) {
                          $results->the_post();
                          // if( $result->ID ) {
                            $awards = get_the_terms( get_the_ID(), 'dvsha_2020_categories' );

                            // print_r( $result->ID );

                            if( $awards ) {
                              foreach( $awards as $award ) {
                                if( $award->parent != 0 && strpos( $award->slug, 'editors-choice' ) === false && strpos( $award->slug, 'readers-favourite' ) === false && strpos( $award->slug, 'best-value' ) === false && strpos( $award->slug, 'best-selling' ) === false && strpos( $award->slug, 'promotion' ) === false ) {
                                  $awardName = $award->name;
                                }
                                if( ( strpos( $award->slug, 'editors-choice' ) > -1 || strpos( $award->slug, 'readers-favourite' ) > -1 || strpos( $award->slug, 'best-value' ) > -1 || strpos( $award->slug, 'best-selling' ) > -1 ) && strpos( $award->slug, 'promotion' ) === false ) {

                                  $args = array(
                                    'post_type'       => 'dvsha_2020_listing',
                                    'posts_per_page'  => -1,
                                    'meta_key'        => 'have_promotion',
                                    'orderby'         => 'meta_value', 
                                    'order'           => 'DESC',
                                    'tax_query' => array(
                                      array(
                                        'taxonomy'  => 'dvsha_2020_categories',
                                        'field'     => 'slug',
                                        'terms'     => $award->slug,
                                      ),
                                    ),
                                  );
          
                                  $posts = new WP_Query( $args );

                                  if( strpos( $award->slug, 'editors-choice' ) !== false ) {
                                    $tag = "Editor's Choice";
                                  } else if( strpos( $award->slug, 'readers-favourite' ) !== false ) {
                                    $tag = "Readers' Favourite";
                                  } else if( strpos( $award->slug, 'best-selling' ) !== false ) {
                                    $tag = "Best Selling";
                                  } else if( strpos( $award->slug, 'best-value' ) !== false ) {
                                    $tag = "Best Value";
                                  }

                                  if( $posts->have_posts() ) : 
                                    while( $posts->have_posts() ) : 
                                      $posts->the_post(); 
                                      $promotion = false;
                                      $bg = ' beige-bg';
                                      // print_r( get_field( 'have_promotion', get_the_ID() ) );
          
                                      // $brand = get_the_terms( get_the_ID(), 'dvsha_2020_brands' );
          
                                      if( get_field( 'have_promotion', get_the_ID() ) == 'yes' ) {
                                        $promotion = true;
                                        $bg = ' brown-bg';
                                      }
          
                                      echo '<div class="col-xs-12 col-sm-12 col-md-3 winners-div">';
                                      echo '<div class="winners-inner-div' . $bg . '">';
                                      echo '<div class="subcat-tag">' . $tag . '</div>';
                                      // echo '<div class="product-img">';
                            
                                      if( get_field( 'testimonials', get_the_ID() ) ) {
                                        echo '<div class="product-img" style="cursor: poitner;">';
                                        echo '<div class="product-testimonial"><div class="overlay-div"><img src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvsha-listing-2020/img/blue-overlay.png" /><div class="testimonial-text"><i>"' . get_field( 'testimonials', get_the_ID() ) . '"</i></div></div></div><i class="fa fa-hand-pointer-o hover"></i>';
                                      } else {
                                        echo '<div class="product-img">';
                                      }

                                      if( has_post_thumbnail() ) :
                                        echo '<img src="' . get_the_post_thumbnail_url() . '" title="' . get_the_title() . '" />';
                                      endif;
                                      
                                      echo '</div>';
                                      echo '<div class="product-title">';
                                      echo get_the_title();
                                      echo '</div>';

                                      if( strpos( $awardName, 'Of The Year' ) > -1 ) {
                                        $awardName = str_replace( 'Best ', '', $awardName );
                                      }

                                      echo '<div class="product-award">' . $awardName . '</div>';
                                      echo '<div class="product-content">'; 
                                      the_content();
                                      echo '</div>';
                                      echo $promotion?'<div class="promo-btn" id="promo-' . get_the_ID() . '">' . get_field( 'button_name', get_the_ID() ) . '</div>':'';
                                      echo '</div>';
                                      echo '</div>';
                                    endwhile;
                                  endif;
                                }
                              }
                            }
                          // }
                        }
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvsha-listing-2020/js/custom.js?v=<?php echo current_time( 'timestamp' ); ?>"></script>

<?php

get_footer(); 

?>