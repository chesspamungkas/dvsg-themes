<!DOCTYPE html>
<!--[if lt IE 9]><html <?php language_attributes(); ?> class="oldie"><![endif]-->
<!--[if (gte IE 9) | !(IE)]><!--><html <?php language_attributes(); ?> class="modern"><!--<![endif]-->

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="google-site-verification" content="fiSWk21d7qwA3ASsMSd6P64m2-m1uKg80B-QE8dfrb8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="verification" content="84d2a2a3d059c72be9d0e1b932719d6d" />
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta property="fb:pages" content="383819251700743">
<?php global $ti_option; ?>
<link rel="shortcut icon" href="<?= str_replace('http://',$pro,$ti_option['site_favicon']['url']); ?>" />
<link rel="icon" type="image/png" href="<?= str_replace('http://',$pro,$ti_option['site_retina_favicon']['url']); ?>" />
<link rel="apple-touch-icon-precomposed" href="<?= str_replace('http://',$pro,$ti_option['site_retina_favicon']['url']); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="https://uploads.dailyvanity.sg/wp-content/uploads/2015/08/favicon1.png" />
<link rel="icon" href="https://uploads.dailyvanity.sg/wp-content/uploads/2015/08/favicon1.png" type="image/x-icon" />
<link rel="shortcut icon" href="https://uploads.dailyvanity.sg/wp-content/uploads/2015/08/favicon1.png" type="image/x-icon" />
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#ef497f">
<link rel="manifest" href="/manifest.json">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#ef497f">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#ef497f">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="apple-touch-icon" href="https://uploads.dailyvanity.sg/wp-content/uploads/2017/11/launcher.png">
<link rel="apple-touch-icon" sizes="152x152" href="https://uploads.dailyvanity.sg/wp-content/uploads/2017/11/launcher-3.png">
<link rel="apple-touch-icon" sizes="180x180" href="https://uploads.dailyvanity.sg/wp-content/uploads/2017/11/launcher-4.png">
<link rel="apple-touch-icon" sizes="167x167" href="https://uploads.dailyvanity.sg/wp-content/uploads/2017/11/launcher-4.png">
<link rel="icon" sizes="192x192" href="<?= str_replace('http://',$pro,$ti_option['site_retina_favicon']['url']); ?>">

<!-- font:css -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
<!-- endinject -->
<?php wp_head(); ?>

<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/src/microsites/dvba/twenty_two/listing/css/DVBA2022Listing.css?v=<?php echo current_time( 'timestamp' ); ?>">

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js" integrity="sha512-UwcC/iaz5ziHX7V6LjSKaXgCuRRqbTp1QHpbOJ4l1nw2/boCfZ2KlFIqBUA/uRVF0onbREnY9do8rM/uT/ilqw==" crossorigin="anonymous"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri()?>/src/microsites/dvba/twenty_two/listing/js/slick-lightbox.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.6.1/jquery.zoom.js"></script>

<!-- endinject -->

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo GTM_ID; ?>');</script>
<!-- End Google Tag Manager -->

<script type='text/javascript'>
   var googletag = googletag || {};
   googletag.cmd = googletag.cmd || [];
   (function() {
       var gads = document.createElement('script');
       gads.async = true;
       gads.type = 'text/javascript';
       var useSSL = 'https:' == document.location.protocol;
       gads.src = (useSSL ? 'https:' : 'http:') +
       '//www.googletagservices.com/tag/js/gpt.js';
       var node = document.getElementsByTagName('script')[0];
       node.parentNode.insertBefore(gads, node);
   })();
</script>

<!-- Extra Global site tag (gtag.js) - Google Analytics (4/9/2019) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-38372508-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-38372508-4');
</script>

<script type='text/javascript'>
   googletag.cmd.push(function() {

       googletag.pubads().enableAsyncRendering();
       googletag.enableServices();
   });
</script>
<!-- Hotjar Tracking Code for dailyvanity.sg -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:578792,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<script>
  (function(){
    var s = document.createElement('script');
    s.onload = function(){
      rwdNS.id = 'dailyvanit';
      var s2 = document.createElement('script');
      s2.src = '//s.chipp.us/js/chipp/l.js';
      document.head.appendChild(s2);
    };
    s.src = '//s.chipp.us/rapi/v1/d/';
    document.head.appendChild(s);
  }
  )();
</script>

<script type='text/javascript'>

var nonce = '<?php echo wp_create_nonce("wp_nonce"); ?>';
var homeBase = '<?php echo home_url(); ?>';
var ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';

</script>
</head>
<?php
    $extraClass = '';
    if(wp_is_mobile())
        $extraClass = 'mobile tablet';
    if(!wp_is_mobile())
        $extraClass = 'desktop';
?>
<body <?php body_class($extraClass); ?> itemscope itemtype="http://schema.org/WebPage" ng-app="DVApp">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo GTM_ID; ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
  FB.init({
    appId      : '270127536451174',
    status: true,
    cookie: true,
	xfbml: true,
	version: 'v2.8'
  });
};
(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

    <div id="et-main-area">
      <?php get_template_part( 'src/microsites/dvba/twenty_two/templates/_topbar' ); ?>
      <div class="body-container">
