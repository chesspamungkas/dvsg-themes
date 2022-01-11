<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= S3_PATH ?>/assets/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= S3_PATH ?>/assets/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= S3_PATH ?>/assets/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= S3_PATH ?>/assets/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?= S3_PATH ?>/assets/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?= S3_PATH ?>/assets/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?= S3_PATH ?>/assets/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?= S3_PATH ?>/assets/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="<?= S3_PATH ?>/assets/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="<?= S3_PATH ?>/assets/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?= S3_PATH ?>/assets/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?= S3_PATH ?>/assets/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="<?= S3_PATH ?>/assets/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="Daily Vanity Salon Finder"/>
    <meta name="msapplication-TileColor" content="#ef497f" />
    <meta name="msapplication-TileImage" content="<?= S3_PATH ?>/assets/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="<?= S3_PATH ?>/assets/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="<?= S3_PATH ?>/assets/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="<?= S3_PATH ?>/assets/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="<?= S3_PATH ?>/assets/mstile-310x310.png" />
    <script>
      var sfLink = <?php echo SF_LINK; ?>;
    </script>
    <?php wp_head(); ?>
    <script>

      var isMobile = false; //initiate as false
      var isAndroid = false;
      // device detection
      if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
          || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
          isMobile = true;

          if(/Android/i.test(navigator.userAgent.substr(0,4))) {
            isAndroid = true;
          }

          console.log( isMobile );
      }

      var nonce = '<?php echo wp_create_nonce("wp_nonce"); ?>';

      var homeBase = '<?php echo home_url(); ?>';
      var ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
      var isCategory = <?php echo is_category()?1:0; ?>;
      // var device = '<?php //echo $device; ?>';

      <?php if( is_category() ): ?>
      var categoryID = <?php echo $wp_query->get_queried_object_id(); ?>;
      var categorySlug = '<?php echo $wp_query->get_queried_object()->slug; ?>';
      <?php else: ?>
      var categoryID = 0;
      var categorySlug = '';
      <?php endif; ?>

      var isAuthor = <?php echo is_author()?1:0; ?>;

      <?php if( is_author() ): ?>
      var authorID = <?php echo get_the_author_meta('ID'); ?>;
      <?php else: ?>
      var authorID = 0;
      <?php endif; ?>

      <?php if( is_search() ): ?>
      var keyword = "<?php echo get_search_query(); ?>";
      var s = "<?php echo urlencode( get_search_query() ); ?>";
      <?php endif; ?>

    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo GTM_ID; ?>');</script>
    <!-- End Google Tag Manager -->

    <!-- Google Adsense -->
    <script data-ad-client="ca-pub-<?php echo ADS_ID; ?>" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- End Google Adsense -->
   
  </head>
  <body <?php body_class(); ?>>

    <?php googleTagManagerBodyScript(); ?>
    <div id="page-container"> 
    <input type="hidden" id="fbName" value="<?php echo FB_PAGE_NAME ?>">
    <input type="hidden" id="igName" value="<?php echo IG_USERNAME ?>">
    <input type="hidden" id="fbApp" value="<?php echo FB_APP_ID ?>">
      <?php
      do_shortcode( '[top-header-bar]' ); ?>
      <?php do_action( 'top-header-bar-after' ); ?>
      <div id="body" class="container-fluid no-padding">
      
