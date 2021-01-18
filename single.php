<?php

include_once( __DIR__ . '/inc/Mobile_Detect.php' );

$detect = new Mobile_Detect;

get_header();

?>
<div class="container-fluid" id="page-header-container">
    <div class="row no-gutters">
        <div class="col">
            <div class="container header-breadcrumb">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light breadcrumb">
						          <?php echo do_shortcode( '[rank_math_breadcrumb]' ); ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light">
                      <?php if( $detect->isMobile() || $detect->isTablet() ): ?>
                        <div id="div-gpt-ad-5207510-3" class="dfp-div"></div>
                      <?php else: ?>
                        <div id="div-gpt-ad-5207510-2" class="dfp-div"></div>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="container" id="page-header">
                <div class="row no-gutters justify-content-center">
                    <div class="col-12 col-md-8 text-center">
                        <h3 class="post_category"><?php the_category(",  "); ?></h3>
                        <h1 class="eb-garamond-medium" id="page-title"><?php echo the_title(); ?></h1>
                        <div class="authorName poppins-medium">By <?php the_author_posts_link(); ?></div>
                        <div class="publishDate poppins-light"><?php echo get_the_date(); ?></div>
                        <div class="post-featured-image">
                          <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'article-featured' ); ?>" alt="<?php echo the_title(); ?>" class="post-thumbnail" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="main-content">  
	<div class="container">
    <div class="row justify-content-center">
      <div class="col-xm-12 col-sm-12 col-md-8">
        <div id="content-area" class="clearfix">			
          <?php
            // echo do_shortcode( '[rtoc_mokuji]' ); 
            while ( have_posts() ) : the_post(); 
          ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <!--h3 class="post_category"><?php //the_category(",  "); ?></h3>
              <h1 class="entry-title" itemprop="headline"><?php //the_title(); ?></h1-->
              <?//= do_shortcode('[section-author additional_class="d-flex"]') ?>              
              <div class="entry-content pt-3">
                <?php
                  the_content();
                ?>
              </div> <!-- .entry-content -->
            </article> <!-- .et_pb_post -->
            <?php //echo get_template_part('template_parts/author-box') ?>
          <?php endwhile; ?>
        </div> <!-- #content-area -->
      </div>
    </div>    
  </div> <!-- .container -->
  <?//= do_shortcode('[content-upgrade]') ?>
  <?php
    $tags = get_the_tags(); 

    if( $tags ): 
  ?>
    <div class="container tags-container">
      <div class="row justify-content-center">
        <div class="col-11 col-sm-12 col-md-1 tag-title poppins-medium">Topics:</div>
        <div class="col-11 col-sm-12 col-md-11 tag-link poppins-semibold">
          <?php
              foreach( $tags as $tag ) {
                echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
              }
          ?>
        </div>
      </div>
    </div>
  <?php 
    endif;
    
    echo do_shortcode( '[beauty-newsfeed featured="0" title="2"]' );
  ?>
</div> <!-- #main-content -->

<?php get_footer(); ?>
