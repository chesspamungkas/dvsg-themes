<?php if( $posts->have_posts() ): ?>
<div class="container" id="featured-article">
    <div class="row no-gutters justify-content-between">
        <?php 
            while( $posts->have_posts() ): 
                $posts->the_post(); 

                if( strpos( get_the_post_thumbnail_url( get_the_ID() ), '.gif' ) === false ):
                    $imgId = get_post_thumbnail_id();
                    $imgSrcset = wp_get_attachment_image_srcset( $imgId, 'article-thumbnail' );
                    $imgAttributes = wp_get_attachment_image_src( $imgId, 'article-thumbnail' );
                    $sizes = wp_get_attachment_image_sizes( $imgId, 'article-thumbnail' );
                    $thumbnail = '<img width="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2]. '" src="' . get_the_post_thumbnail_url( get_the_ID(), 'large' ) . '" srcset="' . esc_attr( $imgSrcset ) . '" sizes="' . esc_attr( $sizes ) . '" alt="' . get_the_title() . '" class="post-thumbnail" />';
                else:
                    $thumbnail = '<img width="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2]. '" src="' . get_the_post_thumbnail_url( get_the_ID(), 'full' ) . '" alt="' . get_the_title() . '" class="post-thumbnail" />';
                endif;

                echo $this->render( 'DVSHA2021Listing/_articleItem', [ 
                    'title'         => get_the_title(), 
                    'url'           => get_permalink(),
                    'thumbnail'     => $thumbnail
                ] );
            endwhile; 
        ?>
    </div>
    <div class="row">
        <div class="col">
            <a href="<?php echo BASE_PATH; ?>/tag/<?php echo $args['tag'] ?>" class="article-view-all-btn" target="_blank">View More</a>
        </div>
    </div>
</div>
<?php endif; ?>