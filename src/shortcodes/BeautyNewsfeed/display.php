<?php 
// global $post;
// print_r( $args );
// print_r( is_category() );
?>
<?php if($posts): ?>
  <div class="list-post-wrapper p-5 mt-2 mb-2 newsfeed-wrapper">
    <div class="container list-post-content">
      <div class="row no-gutters">
      <?php if( $paged == 1 && $args['title'] == 1 ): ?>
        <div class="col" id="newsfeed-header">
          <h1><img src="<?php echo S3_PATH; ?>/wp-content/uploads/svg/beauty-magazine-malaysia-daily-vanity-beauty-newsfeed.svg" alt="Latest Beauty Newsfeed" /></h1>
        </div>
      <?php endif; ?>
      </div>
      <div class="row justify-content-between newsfeed-content">
        <?php 
          echo $this->render( 'BeautyNewsfeed/_item', [ 'posts' => $posts, 'featured' => $featured, 'args' => $args ] ); 
        ?>
      </div>
      <?php if( $totalPages > 1 ): ?>
      <div class="row">
        <div class="col-md-12 col-12 col-sm-12 text-center">
          <button type="button" class="btn inter-bold more-stories-btn" id="<?php echo $totalPages>0?$totalPages:0; ?>-<?php echo $args['cat']>0?$args['cat']:0; ?>-<?php echo $args['author']>0?$args['author']:0; ?>-<?php echo $args['tag_id']>0?$args['tag_id']:0; ?>-<?php echo !empty($args['s'])?urlencode($args['s']):0; ?>"><?php echo MORE_STORIES_BUTTON_TEXT; ?></button>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>