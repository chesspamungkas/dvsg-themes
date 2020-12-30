<?php 
global $post;
setup_postdata($post);
?>
<div class="col-md-4 col-sm-12 col-xs-12 pb-3 listItem">
  <div class="card">
    <?php do_action('listPost-beforeImg', $post) ?>
    <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
      <?php echo '<img src="' . str_replace( 'dailyvanity-my.test', 'my.dailyvanity.com', get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) . '" alt="' . get_the_title() . '" class="post-thumbnail" />'; ?>
    </a>  
    <?php do_action('listPost-afterImg', $post) ?>
    <div class="card-body text-center">
      <div class="catName">
        <?php echo $this->getTitle(); ?>
      </div>
      <?php do_action('listPost-beforeTitle', $post) ?>
      <h4 class="card-title eb-garamond-regular"><a href="<?php the_permalink(); ?>"><span class="listTitle"><?php the_title(); ?></span></a></h4>
      <?php do_action('listPost-afterTitle', $post) ?>
      <?php //do_shortcode('[section-author additional_class="d-flex justify-content-between"]') ?>
    </div>
  </div>
</div>
