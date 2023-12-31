<div class="container-fluid" id="featured-daily-tip-container">
  <div class="row no-gutters align-items-center" style="flex-grow: 1;">
    <div class="col">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-12 col-sm-12 col-md-7">
            <div class="beauty-tip-of-the-day">
              <h1><img src="<?php echo S3_PATH; ?>/wp-content/uploads/svg/beauty-magazine-malaysia-daily-vanity-beauty-tip-of-the-day-01.svg" alt="Beauty Magazine <?php echo COUNTRY; ?> Daily Vanity Beauty Tip Of The Day #<?php echo $orderNo + 1; ?>" /></h1>
            </div>
            <div id="featured-daily-tip" class="desktop-view">
              <?php echo apply_filters('the_content', $tip->post_content); ?>
              <p class="poppins-semibold"><?php echo DAILY_BEAUTY_TIP_CAPTION; ?></p>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-5">
            <div class="tip-order-no inter-bold">#<?php echo $orderNo + 1; ?></div>
            <?php
            if (strpos(get_the_post_thumbnail_url($tip->ID), '.gif') === false) :
              $imgId = get_post_thumbnail_id($tip->ID);
              $imgSrcset = wp_get_attachment_image_srcset($imgId, 'daily-tips-thumbnail');
              $imgAttributes = wp_get_attachment_image_src($imgId, 'daily-tips-thumbnail');
              $sizes = wp_get_attachment_image_sizes($imgId, 'article-thumbnail');
              echo '<img width="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2] . '" src="' . get_the_post_thumbnail_url($tip->ID, 'large') . '" srcset="' . esc_attr($imgSrcset) . '" sizes="' . esc_attr($sizes) . '" alt="Beauty Magazine ' . COUNTRY . ' Daily Vanity Beauty Tip Of The Day #' . ($orderNo + 1) . '" class="post-thumbnail" />';
            else :
              echo '<img width="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2] . '" src="' . get_the_post_thumbnail_url($tip->ID, 'full') . '" alt="Beauty Magazine ' . COUNTRY . ' Daily Vanity Beauty Tip Of The Day #' . ($orderNo + 1) . '" class="post-thumbnail" />';
            endif;
            ?>
          </div>
        </div>
        <div class="row no-gutters mobile-view">
          <div class="col-12 col-sm-12 col-md-7 eb-garamond-regular" id="featured-daily-tip">
            <?php echo apply_filters('the_content', $tip->post_content); ?>
            <p class="poppins-semibold"><?php echo DAILY_BEAUTY_TIP_CAPTION; ?></p>
          </div>
        </div>
        <?php do_action('featured-daily-tips-before-caption'); ?>
      </div>
    </div>
  </div>
  <?php do_action('featured-daily-tip-after'); ?>
</div>