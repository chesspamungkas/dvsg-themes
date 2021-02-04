<div class="col-md-12 col-sm-12 col-xs-12 pb-3 listItem">
    <div class="card">
        <div class="row no-gutters align-items-center">
            <div class="col-md-12 col-12 col-sm-12">
                <a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php echo $post->post_title; ?>" target="_blank">
                    <img src="<?php echo get_the_post_thumbnail_url( $post->ID ); ?>" alt="<?php echo $post->post_title; ?>" class="post-thumbnail" />
                </a>  
            </div>
            <div class="col-md-12 col-12 col-sm-12 text-center">
                <div class="card-body">
                    <div class="catName">
                    <?php echo $this->getTitle( $post->ID ); ?>
                    </div>
                    <h4 class="card-title eb-garamond-medium"><a href="<?php echo get_permalink( $post->ID ); ?>" target="_blank"><span class="listTitle"><?php echo $post->post_title; ?></span></a></h4>
                </div>
            </div>
        </div>
    </div>
</div>