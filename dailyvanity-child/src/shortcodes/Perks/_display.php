<div id="main-perks-content">
<?php
$posts_publish = new \WP_Query( $this->perks_publish_args );
if($posts_publish): 
    $publish_count = $posts_publish->found_posts;
    $publish_totalPages = $posts_publish->max_num_pages;
    $publish_paged = $perks_publish_args['paged'];
    ?>
    <div class="list-perks-wrapper pt-5 mt-3">
        <div class="container list-post-content">
            <div class="row no-gutters">
                <div class="col">
                    <h1 class="perks-publish">Latest Perks From You</h1>
                </div>
            </div>
            <div class="row justify-content-between perkspublish-content">
                <?php   
                echo $this->render( 'Perks/publish', [ 'posts_publish' => $posts_publish, 'args' => $args ] );
                ?>
            </div>
            <?php if( $publish_totalPages > 1 ): ?>
                <div class="row">
                    <div class="col-md-12 col-12 col-sm-12 text-center">
                        <button type="button" class="btn inter-bold see-more-perkspublish-btn" id="<?php echo $publish_totalPages>0?$publish_totalPages:0; ?>-<?php echo $args['cat']>0?$args['cat']:0; ?>-<?php echo $args['author']>0?$args['author']:0; ?>-<?php echo $args['tag_id']>0?$args['tag_id']:0; ?>-<?php echo !empty($args['s'])?urlencode($args['s']):0; ?>"><?php echo SEE_MORE_PERKS; ?></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<hr class="perks" />
<?php
$posts_expired = new \WP_Query( $this->perks_expired_args );
if($posts_expired):
    $expired_count = $posts_expired->found_posts;
    $expired_totalPages = $posts_expired->max_num_pages;
    $expired_paged = $perks_expired_args['paged'];
    ?>  
    <div class="list-perks-wrapper pt-5 mt-3">
        <div class="container list-post-content">
            <div class="row no-gutters">
                <div class="col" id="perks-header">
                    <h1 class="perks-expired">Ended Perks</h1>
                </div>
            </div>
            <div class="row justify-content-between newsfeed-content">
                <?php 
                echo $this->render( 'Perks/expired', [ 'posts_expired' => $posts_expired, 'perks_expired_args' => $perks_expired_args ] );
                ?>
            </div>
            <?php if( $expired_totalPages > 1 ): ?>
                <div class="row">
                    <div class="col-md-12 col-12 col-sm-12 text-center">
                        <button type="button" class="btn inter-bold see-more-perksexpired-btn" id="<?php echo $expired_totalPages>0?$expired_totalPages:0; ?>-<?php echo $perks_expired_args['cat']>0?$perks_expired_args['cat']:0; ?>-<?php echo $perks_expired_args['author']>0?$perks_expired_args['author']:0; ?>-<?php echo $perks_expired_args['tag_id']>0?$perks_expired_args['tag_id']:0; ?>-<?php echo !empty($args['s'])?urlencode($args['s']):0; ?>"><?php echo SEE_MORE_PERKS; ?></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<hr class="perks" />
</div>

