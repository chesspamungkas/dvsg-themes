<?php
// Template Name: DVSHA 2021 Listing Template

    $pageID = get_queried_object()->ID;
    $customCss = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Listing/css/style.css?v=' . DEPLOY_VERSION;
    $customJs = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Listing/js/script.js?v=' . DEPLOY_VERSION;
    $slickCss = '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css';
    $slickThemeCss = 'https://kenwheeler.github.io/slick/slick/slick-theme.css';
    $slickJs = '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js';
    $home = home_url() . '/best-spa-hair-facials-treatments-singapore/2021/';
    $fb = 'https://www.facebook.com/dailyvanity/';
    $ig = 'https://www.instagram.com/dailyvanity/?hl=en';
    $tw = 'https://twitter.com/dailyvanitysg?lang=en';
    $ytb = 'https://www.youtube.com/dailyvanity?sub_confirmation=1';

    $introImg = get_field( 'header_image', $pageID );
    $dvshaLogo = get_field( 'logo', $pageID );
    $winnersHeaderText = get_field( 'winners_section_header', $pageID );
    $winnersHeaderImg = get_field( 'winners_section_header_image', $pageID );
    $winnersBgColor = get_field( 'winners_section_background_color', $pageID );

    include_once( __DIR__ . '/DVSHA/header.php' );

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

    include_once( __DIR__ . '/DVSHA/top-bar.php' );
?>

<a name="intro"></a>
<div class="container-fluid p-0 m-0" id="intro">
    <div class="row p-0 m-0">
        <div class="col" style="background-image: url( '<?php echo $introImg; ?>' );"></div>
    </div>
    <div class="row p-0 m-0">
        <div class="col">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="dvsha-logo"><h1><img src="<?php echo $dvshaLogo; ?>" alt="Best Popular Spas, Hair Salons, Facials, Massages, Grooming, Aesthetic Treatments in Singapore 2021" /></h1></div>
                        <div class="intro-text">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a name="winners"></a>
<div class="container-fluid p-0 m-0" id="winners">
    <div class="row p-0 m-0">
        <div class="col winners-header" style="background-image: url('<?php echo $winnersHeaderImg; ?>');">
            <?php echo $winnersHeaderText; ?>
        </div>
    </div>
    <div class="row p-0 m-0">
        <div class="col winners-content p-5" style="background-color: <?php echo $winnersBgColor; ?>;">
            <?php echo do_shortcode( '[dvsha-2021-category menu="dvsha-2021-category-menu"]' ); ?>
        </div>
    </div>
</div>

<a name="featured-brands"></a>
<div class="container-fluid no-gutters p-0" id="featured-brands">
    <div class="row no-gutters p-0">
        <div class="col featured-brands-content py-5 px-3" style="background-image: url('<?php echo $winnersHeaderImg; ?>');">
            <h2>Featured Brands</h2>
            <?php echo do_shortcode( '[dvsha-2021-brand]' ); ?>
        </div>
    </div>
</div>

<a name="featured-articles"></a>
<div class="container-fluid no-gutters p-0" id="featured-articles">
    <div class="row no-gutters p-0">
        <div class="col featured-articles-content py-5 px-3">
            <h2>Featured Articles</h2>
            <?php 
                if( $isMobile ):
                    $postsPerPage = 2;
                else:
                    $postsPerPage = 4;
                endif;

                echo do_shortcode( '[dvsha-2021-article tag="' . get_field( 'featured_article_tag', $pageID ) . '" posts_per_page="' . $postsPerPage . '"]' ); 
            ?>
        </div>
    </div>
</div>

<a name="judges"></a>
<div class="container-fluid no-gutters p-0" id="judges" style="background-image:url('<?php echo get_field( 'judges_background_image', $pageID ); ?>');">
    <div class="row no-gutters p-0">
        <div class="col judges-content py-5 px-3">
            <h2>Judges</h2>
            <?php 
                echo do_shortcode( '[dvsha-2021-judge page_id="' . $pageID . '"]' ); 
            ?>
        </div>
    </div>
</div>

<?php
    include_once(__DIR__ . '/DVSHA/footer-bar.php');
    include_once(__DIR__ . '/DVSHA/footer.php');
?>