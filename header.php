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
    <?php wp_head(); ?>
    <script>
      var homeBase = '<?php echo home_url(); ?>';
      var ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
      var isCategory = <?php echo is_category()?1:0; ?>;

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
  </head>
  <body <?php body_class(); ?>>
    <?php googleTagManagerBodyScript(); ?>
    <div id="page-container"> 
      <?php do_shortcode( '[top-header-bar]' ); ?>
      <?php do_action( 'top-header-bar-after' ); ?>
      <div id="body" class="container-fluid no-padding">