<?php if($posts): ?>
    <div class="list-perks-wrapper pt-5 mt-0">
        <div class="container list-post-content">
            <?php if ( isset($args['post_status']) && $args['post_status'] == 'expired' ): ?>
                <div class="row no-gutters">
                    <div class="col-12 poppins-light pb-5">
                        <?php do_action( 'top_dfp_ad' ); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row no-gutters">
                <div class="col">
                    <?php 
                    if( $args['title']==1 ):
                        echo isset($args['post_status'])&&$args['post_status']=='publish'?'<h1 class="perks-publish">Latest Perks For You</h1>':'<h1 class="perks-expired">Ended Perks</h1>'; 
                    endif;
                    ?>
                </div>
            </div>
            <div class="row perks-<?php echo $args['post_status']; ?>-content">
                <?php   
                echo $this->render( 'Perks/_item', [ 'posts' => $posts, 'args' => $args ] );
                ?>
            </div>
            <?php if( $totalPages > 1 ): ?>
                <div class="row">
                    <div class="col-md-12 col-12 col-sm-12 text-center">
                        <button type="button" class="btn inter-bold see-more-perks-btn" id="<?php echo $args['post_status']; ?>-<?php echo $totalPages; ?>-<?php echo $args['posts_per_page']; ?>"><?php echo isset($args['post_status'])&&$args['post_status']=='publish'?SEE_MORE_PERKS:LOAD_MORE_PERKS; ?></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php echo isset($args['post_status'])&&$args['post_status']=='publish'?'<hr class="perks" />':''; ?>
    </div>
<?php endif; ?>