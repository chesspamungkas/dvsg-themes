<?php 
$count = 1;
foreach( $posts as $post ) {
  if( $count == 1 ):
    echo '<div class="col-md-6 col-12 col-sm-12 featured-01">';
    echo '<div class="row no-gutters">';
  endif;
?>
    <div class="col-md-12 col-sm-12 col-xs-12 pb-3 listItem">
      <div class="card">
        <div class="row no-gutters align-items-center">
          <?php if( $count == 1 ): ?>
          <div class="col-md-12 col-12 col-sm-12">
          <?php else: ?>
          <div class="col-md-6 col-12 col-sm-12">
          <?php endif; ?>
            <a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php echo $post->post_title; ?>" target="_blank">
              <img src="<?php echo get_the_post_thumbnail_url( $post->ID ); ?>" alt="<?php echo $post->post_title; ?>" class="post-thumbnail" />
            </a>  
          </div>
          <?php if( $count == 1 ): ?>
          <div class="col-md-12 col-12 col-sm-12 text-center">
          <?php else: ?>
          <div class="col-md-6 col-12 col-sm-12">
          <?php endif; ?>
            <div class="card-body">
              <div class="catName">
                <?php echo $this->getTitle(); ?>
              </div>
              <h4 class="card-title eb-garamond-medium"><a href="<?php echo get_permalink( $post->ID ); ?>" target="_blank"><span class="listTitle"><?php echo $post->post_title; ?></span></a></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php if( $count == 1 ): ?>
  </div>
</div>
<div class="col-md-6 col-12 col-sm-12 featured-02">
<div class="row no-gutters align-items-center">
<?php elseif( $count == 3 ): ?>
  </div>
</div>
<?php 
  endif;

  $count++;
}
?>
