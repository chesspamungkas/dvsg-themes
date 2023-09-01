<?php
if( $posts->have_posts() ):
  while( $posts->have_posts() ):
    $posts->the_post();
?>
    <div class="col-md-4 col-sm-12 col-xs-12 pb-3 listItem">
        <div class="card card-perks">
            <div class="row no-gutters">
                <div class="col-md-12 col-12 col-sm-12">
                    <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" target="_blank">
                    <?php
                        if( strpos( get_the_post_thumbnail_url( get_the_ID() ), '.gif' ) === false ):
                        $thumbnailSize = 'article-thumbnail';
                        else:
                        $thumbnailSize = 'full';
                        endif;
                    ?>
                        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), $thumbnailSize ); ?>" alt="<?php echo get_the_title(); ?>" class="post-thumbnail" />
                    </a>  
                </div>
                <div class="col-md-12 col-12 col-sm-12 perks-body">
                    <div class="card-body">
                        <h2 class="card-title eb-garamond-medium"><a href="<?php the_permalink(); ?>" target="_blank"><span class="listTitle"><?php the_title(); ?></span></a></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    $count++;
  endwhile;
endif;
?>