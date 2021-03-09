<?php
/**
 * Template Name: Home Page with 1 Column
 */
get_header();
?>

<div id="main-content">  
	<div id="content-area">
    <?php if(have_posts()): ?>		
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php
            echo do_shortcode( '[featured-daily-tips]' );
            echo do_shortcode( '[beauty-newsfeed]' );
          ?>
          <?php //the_content(); ?>
        </article> <!-- .et_pb_post -->
      <?php endwhile; ?>
    <?php endif; ?>  
	</div> <!-- #content-area -->	
</div> <!-- #main-content -->
<!--div id="bottom-dfp" class="dfp-div"></div-->
<!--div id="<?php //echo DFP_BOTTOM; ?>" class="dfp-div"></div-->
<?php get_footer(); ?>
