<div class="col-md-12 col-sm-12 col-xs-12 pb-3 listItem">
    <div class="card">
        <div class="row no-gutters align-items-center">
            <div class="col-md-12 col-12 col-sm-12">
                <a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php echo $post->post_title; ?>" target="_blank">
                    <?php
                        if( strpos( get_the_post_thumbnail_url( $post->ID ), '.gif' ) === false ):
                            $imgId = get_post_thumbnail_id( $post->ID );
                            $imgSrcset = wp_get_attachment_image_srcset( $imgId, 'article-thumbnail' );
                            
                            echo '<img src="' . get_the_post_thumbnail_url( $post->ID, 'large' ) . '" srcset="' . esc_attr( $imgSrcset ) . '" alt="' . $post->post_title . '" class="post-thumbnail" />';
                        else:
                            echo '<img src="' . get_the_post_thumbnail_url( $post->ID, 'full' ) . '" alt="' . $post->post_title . '" class="post-thumbnail" />';
                        endif;
                    ?>
                    <!--img src="<?php //echo get_the_post_thumbnail_url( $post->ID ); ?>" alt="<?php //echo $post->post_title; ?>" class="post-thumbnail" /-->
                </a>  
            </div>
            <div class="col-md-12 col-12 col-sm-12 text-center">
                <div class="card-body">
                    <div class="catName">
                    <?php echo $this->getTitle( $post->ID ); ?>
                    </div>
                    <h2 class="card-title eb-garamond-medium"><a href="<?php echo get_permalink( $post->ID ); ?>" target="_blank"><span class="listTitle"><?php echo $post->post_title; ?></span></a></h2>
                </div>
            </div>
        </div>
    </div>
</div>