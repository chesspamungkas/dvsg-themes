<?php
// Template Name: DVSHA 2020 Listing Template

get_header();
//include_once(__DIR__.'/../shortcodes/google-dfp/google-dfp.php');
//$detect = new Mobile_Detect;
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
$useragent = $_SERVER['HTTP_USER_AGENT'];
$isMobile = false;
$isIOS = false;
// $device = 'desktop';

if( preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$useragent) ) {
  $isMobile = true;
  $device = 'mobile';
  $isIOS = false;

  if( stripos( $useragent, 'iphone' ) !== false || stripos( $useragent, 'ipad' ) !== false ) {
    // $isIOS = true;
    $isIOS = true;
  }
}

$categories = get_terms([
    'post_types'    => 'dvsha_2020_listing',
    'taxonomy'      => 'dvsha_2020_categories',
    'meta_key'      => 'sort_order',
    'orderby'       => 'meta_value_num',
    'parent'        => 0,
    'hide_empty'    => false,
]);

?>
<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"/>
<!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"/>
<link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvsha-listing-2020/css/custom.css?v=<?php echo current_time( 'timestamp' ); ?>">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<div class="scroll-to-top"><a href="#top" title="Scroll To Top"><i class="fa fa-arrow-circle-up fa-lg"></i></a></div>
<a name="top"></a>
<div class="container-fluid no-padding">
    <div class="row no-margin">
        <div class="col-12 no-padding header-bg-2">
            <!-- Header above nav start -->
            <?php include( "dvsha-listing-2020/top-header.php" ); ?>
            <!-- Header above nav end -->
            <div class="row no-margin">
                <div class="col-12 header-bg no-padding">
            <!-- Introduction start -->
                    <div id="introduction">
                        <div class="intro-wrapper-outter">
                            <div class="intro-wrapper-inner">
                                <?php
                                $page = get_post(270627);
                                echo $page->post_content;
                                ?>
                                <?php echo '<script>
                                if (isMobile===true || isIOS===true) {
                                    document.write("<a name=winners id=winners></a>");
                                }</script>'; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 no-padding white-bg">
                    <?php echo '<script>
                    if (isMobile===false && isIOS===false) {
                        document.write("<a name=winners id=winners></a>");
                    }</script>'; ?>
                    <!-- Categories start -->
                    <div id="categories">
                        <h2>Categories</h2>
                        <div class="container-fluid no-padding">
                            <?php
                                $catCnt = 1;
                                $btnText = 'View Winners';
                                $btnColor = '';

                                foreach( $categories as $cat ) {
                                    $args = array(
                                        'parent'    => $cat->term_id,
                                        'orderby'   => 'name',
                                        'order'     => 'ASC',
                                        'hide_empty'  => false,
                                    ); 
                                    
                                    $terms = get_terms( 'dvsha_2020_categories', $args );

                                    if( sizeof( $terms ) == 1 ) {
                                        $link = home_url() . '/best-spa-hair-facials-treatments/' . $terms[0]->slug;
                                    } else {
                                        if( strpos( $terms[0]->slug, 'of-the-year' ) > -1 ) {
                                            $link = home_url() . '/best-spa-hair-facials-treatments/' . $cat->slug . '/' . str_replace( 'best-', '', $terms[0]->slug );
                                        } else {
                                            $link = home_url() . '/best-spa-hair-facials-treatments/' . $cat->slug . '/' . $terms[0]->slug;
                                        }
                                    }

                                    // print_r( $link );

                                    // if( $cat->slug == 'facial-treatments' || $cat->slug == 'lash-brow-treatments' ) {
                                    //     $btnColor = 'pink-view-winner-btn';
                                    // } else {
                                    //     $btnColor = '';
                                    // }
                                    
                                    if( $catCnt == 1 ) {
                                        echo '<script>
                                        var mobileios = "<div class=row no-margin>" +
                                        "<div class=col-6>" +
                                        "<div class=row no-margin>" +
                                        "<div class=col-12 id=cat-img-01></div>" +
                                        "</div>" +
                                        "</div>" +
                                        "<div class=col-6>" +
                                        "<div class=row no-margin>";

                                        var dekstop = "<div class=row no-margin>" +
                                        "<div class=col-8>" +
                                        "<div class=row no-margin>" +
                                        "<div class=col-12 id=cat-img-01></div>" +
                                        "</div>" +
                                        "</div>" +
                                        "<div class=col-4>" +
                                        "<div class=row no-margin>";

                                        if (isMobile===true || isIOS===true) {
                                            document.write(mobileios);
                                        } else {
                                            document.write(dekstop);
                                        }
                                        </script>';
                                    }

                                    if( $isMobile || $isIOS ) {
                                        if( $catCnt == 3 ) {
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="row no-margin">';
                                        }

                                        if( $catCnt == 7 ) {
                                            echo '</div>';
                                            echo '<div class="row no-margin">';
                                            echo '<div class="col-6">';
                                            echo '<div class="row no-margin">';
                                        }

                                        if( $catCnt == 9 ) {
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="col-6">';
                                            echo '<div class="row no-margin">';
                                            echo '<div class="col-12" id="cat-img-02"></div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="row no-margin">';
                                        }

                                        if( $catCnt >= 1 && $catCnt <=2 || $catCnt >= 7 && $catCnt <=8 ) {
                                            echo '<div class="col-12 sub-cat">';
                                            echo $cat->name . '</br>';
                                            echo '<img class="dash" src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvsha-listing-2020/img/dash.jpg" /></br>';
                                            echo '<a href="' . $link . '" class="view-winners-btn ' . $btnColor . '">' . strtoupper( $btnText ) .'</a>';
                                            echo '</div>';
                                        } else if( $catCnt >= 3 && $catCnt <=6 || $catCnt >= 9 ) {
 echo '<div class="col-6 sub-cat">';
                                            echo $cat->name . '</br>';
                                            echo '<img class="dash" src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvsha-listing-2020/img/dash.jpg" /></br>';
                                            echo '<a href="' . $link . '" class="view-winners-btn ' . $btnColor . '">' . strtoupper( $btnText ) .'</a>';
                                            echo '</div>';
                                        }
                                    } else {
                                        if( $catCnt == 5 ) {
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="row no-margin">';
                                        }

                                        if( $catCnt == 8 ) {
                                            echo '</div>';
                                            echo '<div class="row no-margin">';
                                            echo '<div class="col-4">';
                                            echo '<div class="row no-margin">';
                                        }

                                        if( $catCnt == 10 ) {
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="col-8">';
                                            echo '<div class="row no-margin">';
                                            echo '<div class="col-12" id="cat-img-02"></div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="row no-margin">';
                                        }

                                        if( $catCnt >= 1 && $catCnt <=4 || $catCnt >= 8 && $catCnt <=9 ) {
                                            echo '<div class="col-12 sub-cat">';
                                            echo $cat->name . '</br>';
                                            echo '<img class="dash" src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvsha-listing-2020/img/dash.jpg" /></br>';
                                            echo '<a href="' . $link . '" class="view-winners-btn ' . $btnColor . '">' . strtoupper( $btnText ) .'</a>';
                                            echo '</div>';
                                        } else if( $catCnt >= 5 && $catCnt <=7 || $catCnt >= 10 ) {
                                            echo '<div class="col-4 sub-cat">';
                                            echo $cat->name . '</br>';
                                            echo '<img class="dash" src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvsha-listing-2020/img/dash.jpg" /></br>';
                                            echo '<a href="' . $link . '" class="view-winners-btn ' . $btnColor . '">' . strtoupper( $btnText ) .'</a>';
                                            echo '</div>';
                                        }
                                    }

                                    if( $catCnt == 12 ) {
                                        echo '</div>';
                                        echo '</div>';
                                    }

                                    $catCnt++;
                                }
                            ?>
                            <?php echo '<script>
                                if (isMobile===true || isIOS===true) {
                                    document.write("<a name=articles id=articles></a>");
                                }</script>'; ?>
                            <div class="row no-margin">
                                <div class="col-12" id="cat-bottom-bar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Categories end -->
                </div>
                <div class="col-12 no-padding" id="featured-section">
                    <!-- Featured Articles start -->
                    <?php echo '<script>
                    if (isMobile===false && isIOS===false) {
                        document.write("<a name=articles id=articles></a>");
                    }</script>'; ?>
                    <div id="featured-articles">
                        <h2>Featured Articles</h2>
                        <?php
                            //$articleTag = get_field( 'featured_articles_tag' );
                            $articleTag = 'dvsha2020';
                            $args = array( 
                                'post_status'    => 'publish',
                                'posts_per_page' => 3,
                                'tag'            => $articleTag,
                                'orderby'        => 'rand'
                            );
                        
                            // $postslist = get_posts( $args );
                            $posts = new WP_Query( $args );

                            // print_r( $posts );

                            foreach( $posts->posts as $post ) {
                                // echo $post->post_title;
                                echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" target="_blank"><h4>' . $post->post_title . '</h4></a>';
                                echo '<img src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvsha-listing-2020/img/w_dash.jpg" />';
                            }
                            echo '<script>
                                if (isMobile===true || isIOS===true) {
                                    document.write("<a name=brands id=brands></a>");
                                }</script>';
                            echo '<br/><br/><a href="https://dailyvanity.sg/?s=' . $articleTag . '" class="pink-btn read-more-btn" target="_blank">' . strtoupper( 'Read More' ) . '</a>';
                        ?>
                        <div class="clear"></div>
                    </div>
                    <!-- Featured Articles end -->
                    <!-- Featured Brands start -->
                    <?php echo '<script>
                    if (isMobile===false && isIOS===false) {
                        document.write("<a name=brands id=brands></a>");
                    }</script>'; ?>
                    <div id="featured-brands">
                        <h2>Featured Brands</h2>
                        <div class="slider">
                            <?php 

                                $brands = get_terms([
                                    'post_types'    => 'dvsha_2020_listing', 
                                    'taxonomy'      => 'dvsha_2020_brands',
                                    'meta_key'      => 'featured_brand',
                                    'meta_value'    => 'yes',
                                    // 'orderby'       => 'meta_value_num',
                                    // 'parent'        => 0,
                                    // 'hide_empty'    => false,
                                ]);

                                foreach( $brands as $brand ) { 
                                    $image = wp_get_attachment_image_src( get_option( 'categoryimage_' . $brand->term_id ), 'full' );
                            ?>
                            <div class="slider__item">
                                <?php 
                                    if( $image ) {
                                        echo '<img src="' . $image[0] . '" />';
                                    } else {
                                        echo '<img src="https://uploads.dailyvanity.sg/wp-content/uploads/2020/08/thumbnail.jpg" />';
                                    }

                                    $args = array(
                                    'post_type'       => 'dvsha_2020_listing',
                                    'posts_per_page'  => -1,
                                    'orderby'         => 'post_title', 
                                    'order'           => 'ASC',
                                    'tax_query' => array(
                                        array(
                                        'taxonomy'  => 'dvsha_2020_brands',
                                        'field'     => 'term_id',
                                        'terms'     => $brand->term_id,
                                        ),
                                    ),
                                    );
            
                                    $posts = new WP_Query( $args );

                                    echo '<ul>';
                                    foreach( $posts as $post ) {
                                        $awards = get_the_terms( $post->ID, 'dvsha_2020_categories' );

                                        if( $awards ) {
                                            foreach( $awards as $award ) {
                                                // print_r( $awards );
                                                if( strpos( $award->slug, 'editors-choice' ) === false && strpos( $award->slug, 'readers-favourite' ) === false && strpos( $award->slug, 'best-value' ) === false && strpos( $award->slug, 'best-selling' ) === false && strpos( $award->slug, 'promotion' ) === false && $award->parent != 0 ) {
                                                    $customLink = get_term_link( $award->term_id );

                                                    if( strpos( $award->name, 'Best' ) === false ) {
                                                        $awardName = 'Best ' . $award->name;
                                                    } else {
                                                        $awardName = $award->name;
                                                    }

                                                    echo '<li><a href="' . $customLink . '" class="award-link">' . $awardName . '</a></li>';
                                                }
                                            }
                                        }
                                    }
                                    echo '</ul>';
                                ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Featured Brands end -->
                </div>
            </div>
            <!-- Introduction end -->
        </div>
    </div>
</div>

<script src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvsha-listing-2020/js/custom.js"></script>

<?php
get_footer();
?>
