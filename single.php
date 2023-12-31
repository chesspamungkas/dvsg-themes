<?php
get_header();

do_action('single_header_after');

while (have_posts()) : the_post();
?>
  <div class="container-fluid" id="page-header-container">
    <div class="row no-gutters">
      <div class="col">
        <div class="container header-breadcrumb">
          <div class="row no-gutters">
            <div class="col-12 poppins-light breadcrumb">
              <?php echo do_shortcode('[rank_math_breadcrumb]'); ?>
            </div>
          </div>
        </div>
        <?php if (get_field('disable_ads_injection', $post->ID) === false || !get_field('disable_ads_injection', $post->ID)) : ?>
          <div class="container">
            <div class="row no-gutters">
              <div class="col-12 poppins-light">
                <?php do_action('top_dfp_ad'); ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="container" id="page-header">
          <div class="row no-gutters justify-content-center">
            <div class="col-12 col-md-8 text-center">
              <?php if (!is_singular('deal')) : ?>
                <h3 class="post_category"><?php the_category(",  "); ?></h3>
              <?php endif; ?>
              <h1 class="eb-garamond-medium" id="page-title"><?php echo the_title(); ?></h1>
              <?php if (!is_singular('deal')) : ?>
                <div class="authorName poppins-medium">By <?php the_author_posts_link(); ?></div>
                <div class="publishDate poppins-light"><?php echo get_the_date(); ?></div>
              <?php endif; ?>
              <div class="post-featured-image">
                <?php
                $thumbnail = '';
                $imgId = get_post_thumbnail_id();
                $imgSrcset = '';

                if (strpos(get_the_post_thumbnail_url(get_the_ID()), '.gif') === false) :
                  $imgSrcset = wp_get_attachment_image_srcset($imgId, 'article-page-image');

                  $thumbnail = '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'large') . '" srcset="' . esc_attr($imgSrcset) . '" alt="' . get_the_title() . '" class="post-thumbnail" />';
                else :
                  $thumbnail = '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" alt="' . get_the_title() . '" class="post-thumbnail" />';
                endif;

                echo $thumbnail;                                                                                                ?>" class="post-thumbnail" /-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php do_action('section_before_content'); ?>

  <div id="main-content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xm-12 col-sm-12 col-md-8">
          <div id="content-area" class="clearfix">
            <?php
            // echo do_shortcode( '[rtoc_mokuji]' ); 
            // while ( have_posts() ) : the_post(); 
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <!--h3 class="post_category"><?php //the_category(",  "); 
                                            ?></h3>
              <h1 class="entry-title" itemprop="headline"><?php //the_title(); 
                                                          ?></h1-->
              <? //= do_shortcode('[section-author additional_class="d-flex"]') 
              ?>
              <div class="entry-content pt-3">
                <?php
                the_content();
                ?>
              </div> <!-- .entry-content -->
            </article> <!-- .et_pb_post -->
            <?php //echo get_template_part('template_parts/author-box') 
            ?>
          </div> <!-- #content-area -->
        </div>
      </div>
    </div> <!-- .container -->
    <?php do_action('section_after_content') ?>
    <?php
    $tags = get_the_tags();

    if ($tags) :
    ?>
      <div class="container tags-container">
        <div class="row justify-content-center">
          <div class="col-11 col-sm-12 col-md-1 tag-title poppins-medium">Topics:</div>
          <div class="col-11 col-sm-12 col-md-11 tag-link poppins-semibold">
            <?php
            foreach ($tags as $tag) {
              echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
            }
            ?>
          </div>
        </div>
      </div>
    <?php
    endif;
    do_action('single_before_footer');
    ?>
  </div> <!-- #main-content -->
<?php endwhile; ?>

<?php do_action('video_ad'); ?>
<?php get_footer(); ?>
<?php do_action('single_footer_after'); ?>