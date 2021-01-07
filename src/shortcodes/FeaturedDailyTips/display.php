<?php
  // print_r( $tip );
  // print_r( $orderNo );
  // print_r( get_the_post_thumbnail_url( $tip->ID ) );
?>
<div class="container-fluid" id="featured-daily-tip-container">
  <div class="row no-gutters align-items-center" style="flex-grow: 1;">
    <div class="col">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-12 col-sm-12 col-md-7">
            <div class="beauty-tip-of-the-day">
              <h1><img src="<?php echo S3_PATH; ?>/wp-content/uploads/svg/beauty-magazine-malaysia-daily-vanity-beauty-tip-of-the-day-01.svg" alt="Beauty Magazine <?php echo COUNTRY; ?> Daily Vanity Beauty Tip Of The Day #<?php echo $orderNo+1; ?>" /></h1>
            </div>
            <div id="featured-daily-tip" class="desktop-view">
              <!--p class="eb-garamond-regular"><?php echo $tip->post_title; ?></p-->
              <?php echo apply_filters( 'the_content', $tip->post_content ); ?>
              <p class="poppins-semibold"><?php echo DAILY_BEAUTY_TIP_CAPTION; ?></p>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-5">
            <div class="tip-order-no inter-bold">#<?php echo $orderNo+1; ?></div>
            <img src="<?php echo get_the_post_thumbnail_url( $tip->ID ); ?>" alt="Beauty Magazine <?php echo COUNTRY; ?> Daily Vanity Beauty Tip Of The Day #<?php echo $orderNo+1; ?>" />
          </div>
        </div>
        <div class="row no-gutters mobile-view">
          <div class="col-12 col-sm-12 col-md-7 eb-garamond-regular" id="featured-daily-tip">
            <!-- <h1 class="eb-garamond-regular"><?php //echo $tip->post_title; ?></h1> -->
            <?php echo apply_filters( 'the_content', $tip->post_content ); ?>
            <p class="poppins-semibold"><?php echo DAILY_BEAUTY_TIP_CAPTION; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php do_action( 'featured-daily-tip-after' ); ?>
</div>
