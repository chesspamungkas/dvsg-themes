<?php 
// global $post;
// print_r( $posts );
?>
<div class="list-post-wrapper p-5 mt-2 mb-2 full-width">
  <div class="container featured-container">
    <div class="row">
      <div class="col-md-3 col-10 col-sm-10" id="featured-header">
        <img src="<?php echo S3_PATH; ?>/wp-content/uploads/svg/featured-beauty-reads-videos-malaysia.svg" alt="Featured beauty reads and videos in <?php echo COUNTRY; ?>" />
      </div>
    </div>
    <div class="row align-items-center">
      <?php 
        echo $this->render('FeaturedArticles/_item', [ 
          'posts' => $posts 
        ]); 
      ?>
    </div>
  </div>
</div>