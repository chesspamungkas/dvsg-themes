<?php
$count = 1;
$increment = 1;

$posts_expired = new \WP_Query( $this->perks_expired_args );
if( $posts_expired->have_posts() ):
  while( $posts_expired->have_posts() ):
    $posts_expired->the_post();
    ?>
    <div class="col-md-4 col-sm-12 col-xs-12 pb-3 listItem">
        <div class="card-perks">
            <div class="row no-gutters">
                <div class="perks_image"><a href="<?php echo get_permalink( $articleID ); ?>" title="<?php echo get_the_title(); ?>" target="_blank"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" alt="<?php echo get_the_title(); ?>" class="perks-thumbnail" /></a></div>         
                <div class="card-perks-body">
                    <h2 class="eb-garamond-medium"><a href="<?php the_permalink(); ?>" target="_blank"><span class="card-perks-title"><?php echo get_the_title(); ?></span></a></h2>
                </div>
            </div>
        </div>
    </div>
    <?php
    $count++;
  endwhile;
endif;
?>