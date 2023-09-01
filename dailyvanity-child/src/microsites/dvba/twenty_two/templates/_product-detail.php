<?php

use DV\core\DVBA;
use DVChild\microsites\dvba\twenty_two\DVBA_2022;

global $post;
global $arr;

if (have_posts()) :
  while (have_posts()) :
    the_post();
?>

  <div class="row g-0 m-0">
    <div class="col-12 col-md-4 product-gallery-container">
      <div class="product-gallery">
        <?php if(has_post_thumbnail()): ?>
        <div class="zoom-image">
          <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>" />          
        </div>
        <?php else: ?>
          No Thumbnail
        <?php endif; ?>
        <?php if (have_rows('product_media')): ?>
          <?php while(have_rows('product_media')): the_row(); ?>
            <?php if(get_sub_field('type') === 'image'): ?>
              <div class="zoom-image"><img src="<?php echo get_sub_field('url') ?>" alt="Daily Vanity Beauty Awards 2021 Best ' . $arr['category'] . ' Singapore ' . get_the_title() . ' ' . implode(', ', $arr['awards']) . '" /></div>
            <?php else: ?>
              <div><div class="video-wrapper"><iframe src="<?php echo get_sub_field('url') ?>?controls=1" frameborder="0" allowfullscreen></iframe></div></div>
            <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <div class="product-gallery-nav">
        <div class="col-2 lightbox-btn ps-2">
          <i class="fas fa-search-plus"></i>
        </div>
        <div class="col-4">
          <button type="button" class="gallery-prev-btn slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
          <button type="button" class="gallery-next-btn slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8 ps-md-5 product-details">
      <div>
        <?php echo do_shortcode('[dvba-awards-list post_id="'.$post->ID.'" taxonomy="'.DVBA::makeTaxonomyTypeYearName(2022, 'award_tiers').'" ]') ?>
        <h4 class="poppins-bold py-0"><?php the_title(); ?></h4>
        <p class="poppins-regular"><?php echo DVBA_2022::awardsTreament($post); ?></p>
      </div>
      <div>
        <p><strong><?php echo get_field('awards_won'); ?></strong></p>
        <?php the_content(); ?>
        <hr />
        <?php echo do_shortcode('[dvba-where-to-buy post_id="'.$post->ID.'"]')?>
      </div>
    </div>
  </div>

<?php
  endwhile;
endif;
?>