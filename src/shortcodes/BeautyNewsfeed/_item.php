<?php
$count = 1;
$increment = 1;
$thumbnail = '';

if ($posts->have_posts()) :
  while ($posts->have_posts()) :
    $posts->the_post();

    if (strpos(get_the_post_thumbnail_url(get_the_ID()), '.gif') === false) :
      $imgId = get_post_thumbnail_id();
      $imgSrcset = wp_get_attachment_image_srcset($imgId, 'article-thumbnail');
      $imgAttributes = wp_get_attachment_image_src($imgId, 'article-thumbnail');
      $sizes = wp_get_attachment_image_sizes($imgId, 'article-thumbnail');
      $thumbnail = '<img width="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2] . '" src="' . get_the_post_thumbnail_url(get_the_ID(), 'large') . '" srcset="' . esc_attr($imgSrcset) . '" sizes="' . esc_attr($sizes) . '" alt="' . get_the_title() . '" class="post-thumbnail" />';
    else :
      $thumbnail = '<img width="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2] . '" src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" alt="' . get_the_title() . '" class="post-thumbnail" />';
    endif;

    if ($increment > 2) {
      $increment = 1;
    }

    if ($count % 5 == 0) :
      if ($increment == 1) :
?>
        <div class="col-md-12 col-sm-12 col-xs-12 pb-3 listItem post-sub-segment-1">
          <div class="card">
            <div class="row no-gutters align-items-center">
              <div class="col-md-7 col-12 col-sm-12">
                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" target="_blank">
                  <?php echo $thumbnail; ?>
                </a>
              </div>
              <div class="col-md-5 col-12 col-sm-12">
                <div class="card-body text-center">
                  <div class="catName poppins-light">
                    <?php echo !isset($args['cat']) ? $this->getTitle() : ''; ?>
                  </div>
                  <h2 class="card-title eb-garamond-medium"><a href="<?php the_permalink(); ?>" target="_blank"><span class="listTitle"><?php the_title(); ?></span></a></h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        if (isset($args['featured']) && $args['featured'] > 0) :
          do_action('beauty_newsfeed_mid', ['page' => $args['paged']]);
        endif;
        ?>

      <?php else : ?>

        <div class="col-md-12 col-sm-12 col-xs-12 pb-3 listItem post-sub-segment-2">
          <div class="row no-gutters">
            <div class="col">
              <?php echo !isset($args['cat']) ? $this->getTitle() : ''; ?>
              <h2 class="card-title"><a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><span class="listTitle"><?php the_title(); ?></span></a></h2>
              <p><a href="<?php the_permalink(); ?>" class="read-more-btn inter-bold" target="_blank" title="<?php the_title(); ?>"><?php echo READ_MORE; ?> <i class="fas fa-arrow-right"></i></a></p>
            </div>
          </div>
        </div>

      <?php
      endif;

      $increment++;
    else :
      ?>
      <div class="col-md-6 col-sm-12 col-xs-12 pb-3 listItem">
        <div class="card">
          <div class="row no-gutters">
            <div class="col-md-12 col-5 col-sm-5">
              <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" target="_blank">
                <?php echo $thumbnail; ?>
              </a>
            </div>
            <div class="col-md-12 col-7 col-sm-7">
              <div class="card-body">
                <div class="catName poppins-light">
                  <?php echo !isset($args['cat']) ? $this->getTitle() : ''; ?>
                </div>
                <h2 class="card-title eb-garamond-medium"><a href="<?php the_permalink(); ?>" target="_blank"><span class="listTitle"><?php the_title(); ?></span></a></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php
    endif;

    $count++;
  endwhile;
endif;
?>