<?php

$mode = 'subpage';

$term_id = get_queried_object()->term_id;
$slug = get_queried_object()->slug;
$parent_id = get_queried_object()->parent;

$pTerms = get_term_by( "id", $parent_id, "dvsha_2020_categories" );

$singleList = array( 'innovative-treatment', 'makeover-service' );

$term_children = get_terms(
  'dvsha_2020_categories',
  array(
    'parent'      => $parent_id,
    'hide_empty'  => false,
  )
);

$isSingle = false;

foreach( $term_children as $term_child ) { 
  if( in_array( $term_child->slug, $singleList ) ) {
    $isSingle = true;
  }
}

get_header();

// $detect = new Mobile_Detect;
echo '<script language="javascript">

      var isMobile = false; //initiate as false
      var isAndroid = false;
      var isIOS = false;
      // device detection
      if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
          || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
          isMobile = true;

          if(/Android/i.test(navigator.userAgent.substr(0,4))) {
            isAndroid = true;
          }
      }

      if(/iphone/i.test(navigator.userAgent.toLowerCase()) || /ipad/i.test(navigator.userAgent.toLowerCase())) {
            isIOS = true;
       }
</script>';
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
                    <h1 id="category-page-title">
                    <?php 
                    if( strpos( $pTerms->name, 'Aesthetic Treatments' ) > -1 ) {
                      echo str_replace( 'Best ', '', $pTerms->name );
                    } else {
                      if( strpos( $pTerms->name, 'Best' ) !== false ) {
                        echo $pTerms->name;
                      } else {
                        echo 'Best ' . $pTerms->name; 
                      }
                    }
                    ?>
                    </h1>
                    <?php
                      if( !$isSingle ) {
                        echo '<div id="subcat-links">';
                        echo '<ul class="nav justify-content-center">';
                        foreach( $term_children as $child ) {
                          if( $child->term_id == $term_id ) {
                            echo '<li class="nav-item current"><h2>' . str_replace( 'Best', '', $child->name ) . '</h2></li>';
                            
                            if( strpos( $child->name, 'Of The Year' ) ) {
                              $award = str_replace( 'Best ', '', $child->name );
                            } else {
                              if( strpos( $child->name, 'Best' ) > -1 ) {
                                $award = $child->name;
                              } else {
                                $award = 'Best ' . $child->name; 
                              }
                            }

                          } else {
                            if( strpos( $child->name, 'Of The Year' ) ) {
                              echo '<li class="nav-item"><a href="' . home_url() . '/best-spa-hair-facials-treatments/' . $pTerms->slug . '/' . str_replace( 'best-', '', $child->slug ) . '"><h2>' . str_replace( 'Best', '', $child->name ) . '</h2></a></li>';
                            } else {
                              echo '<li class="nav-item"><a href="' . home_url() . '/best-spa-hair-facials-treatments/' . $pTerms->slug . '/' . $child->slug . '"><h2>' . str_replace( 'Best', '', $child->name ) . '</h2></a></li>';
                            }
                          }
                        }
                        echo '</ul>';

                        echo '<script>
                            if (isMobile===true || isIOS===true) {
                                document.write("<center style=color: #efefef; font-size:16px; font-style: italic;> << swipe left or right >> </center>");
                            }</script>';

                        echo '</div>';
                      // } else {
                      //   if( strpos( 'Best', $pTerms->name ) !== false ) { 
                      //     $award = $pTerms->name;
                      //   } else {
                      //     $award = 'Best ' . $pTerms->name;
                      //   }
                      }
                    ?>
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
                      $slugArr = array( 'editors-choice-' . $slug, 'readers-favourite-' . $slug, 'best-selling-' . $slug , 'best-value-' . $slug );

                      foreach( $slugArr as $value ) {
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
                              'terms'     => $value,
                            ),
                          ),
                        );

                        $posts = new WP_Query( $args );

                        // print_r( $posts );

                        if( strpos( $value, 'editors-choice' ) !== false ) {
                          $tag = "Editor's Choice";
                        } else if( strpos( $value, 'readers-favourite' ) !== false ) {
                          $tag = "Readers' Favourite";
                        } else if( strpos( $value, 'best-selling' ) !== false ) {
                          $tag = "Best Selling";
                        } else if( strpos( $value, 'best-value' ) !== false ) {
                          $tag = "Best Value";
                        }

                        if( $posts->have_posts() ) : 
                          while( $posts->have_posts() ) : 
                            $posts->the_post(); 
                            $promotion = false;
                            $bg = ' beige-bg';
                            // print_r( get_field( 'have_promotion', get_the_ID() ) );

                            $brand = get_the_terms( get_the_ID(), 'dvsha_2020_brands' );

                            if( get_field( 'have_promotion', get_the_ID() ) == 'yes' ) {
                              $promotion = true;
                              $bg = ' brown-bg';
                            }

                            echo '<div class="col-xs-12 col-sm-12 col-md-3 winners-div">';
                            echo '<div class="winners-inner-div' . $bg . '">';
                            echo '<div class="subcat-tag">' . $tag . '</div>';
                            
                            if( get_field( 'testimonials', get_the_ID() ) ) {
                              echo '<div class="product-img" style="cursor: poitner;">';
                              echo '<div class="product-testimonial"><div class="overlay-div"><img src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvsha-listing-2020/img/blue-overlay.png" /><div class="testimonial-text"><i>"' . get_field( 'testimonials', get_the_ID() ) . '"</i></div></div></div><i class="fa fa-hand-pointer-o hover"></i>';
                            } else {
                              echo '<div class="product-img">';
                            }

                            if( strpos( $award, 'Best ' ) > -1 ) {
                              $alt = str_replace( 'Best ', 'Best Popular ' . $pTerms->name . ' ', $award );
                            } else {
                              $alt = 'Best Popular ' . $pTerms->name . ' ' . $award;
                            }

                            if( has_post_thumbnail() ) :
                              echo '<img src="' . get_the_post_thumbnail_url() . '" alt="' . $alt . ' ' . $tag . ' Singapore ' . $brand[0]->name . '" />';
                            endif;

                            echo '</div>';
                            echo '<div class="product-title">';
                            echo $brand[0]->name . ' - ' . get_the_title();
                            echo '</div>';

                            if( strpos( $award, 'Of The Year' ) > -1 ) {
                              $award = str_replace( 'Best ', '', $award );
                            }
                            
                            echo '<div class="product-award">' . $award . '</div>';
                            echo '<div class="product-content">'; 
                            the_content();
                            echo '</div>';
                            echo $promotion?'<div class="promo-btn" id="promo-' . get_the_ID() . '">' . get_field( 'button_name', get_the_ID() ) . '</div>':'';

                            echo '</div>';
                            echo '</div>';
                          endwhile;
                        endif;
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

<script src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvsha-listing-2020/js/custom.js"></script>

<?php

get_footer(); 

?>