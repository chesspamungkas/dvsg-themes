<?php
$args = array(  
		'post_type' => 'page',
		'post_status' => 'publish',
		'pagename' => 'daily-tips-configure'
	);

$page = new \WP_Query( $args );

$tipID = get_field( 'tips_id', $page->queried_object_id );
?>
<!-- <div class="container-related-articles"> -->
<!-- <div class="container"> -->

    <div class="row no-gutters related-articles-container p-4 justify-content-center d-flex">
        <div class="col-12 col-md-10 related-articles-container-col">
            <div class="container">
                <div class="row related-articles-wrapper p-4">
                    <div class="col-12 ps-4 pt-2 pb-4">
                        <div class="related-articles-header">RELATED ARTICLES</div>
                    </div>
                    <div class="col-12 px-4">
                        <div class="row related-articles-content justify-content-between p-0">
                            <?php
                            if( have_rows('related_articles', $tipID) ):
                                while( have_rows('related_articles', $tipID) ): the_row();
                                    $article = get_sub_field('article');
                                    $articleID = $article->ID;
                                    $thumbnail_id = get_post_thumbnail_id( $articleID );
                                    $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                    $articleImage = get_the_post_thumbnail_url($articleID, 'medium');
                                    $articleTitle = $article->post_title;
                                    $categories = get_the_category($articleID);
                                    $content = '';
                                    $count = 1;
                                    $totalCat = count( $categories );
                                    foreach ($categories as $cat):
                                        $catLink = get_category_link( $cat->term_id );
                                        $content .= '<a href="' . esc_url( $catLink ) . '" class="category-link poppins-light" target="_blank">' . $cat->name . '</a>';
                                        if ( $count < $totalCat ):
                                            $content .= ', ';
                                        endif;
                                        $count++;
                                    endforeach;
                                    ?>
                                    <div class="col-12 col-md-6 p-0">
                                        <div class="container p-1">
                                            <div class="row">
                                                <div class="featured_image col-12 col-md-6 pb-3">
                                                    <a href="<?php echo get_permalink( $articleID );?>" title="<?php echo get_the_title();?>" target="_blank">
                                                    <?php
                                                        if( strpos( get_the_post_thumbnail_url( $articleID ), '.gif' ) === false ):
                                                        $imgId = get_post_thumbnail_id( $articleID );
                                                        $imgSrcset = wp_get_attachment_image_srcset( $imgId, 'related-article-thumbnail' );
                                                        $imgAttributes = wp_get_attachment_image_src( $imgId, 'related-article-thumbnail' );
                                                        $sizes = wp_get_attachment_image_sizes( $imgId, 'related-article-thumbnail' );
                                                        echo '<img width="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2]. '" src="' . get_the_post_thumbnail_url( $articleID, 'large' ) . '" srcset="' . esc_attr( $imgSrcset ) . '" sizes="' . esc_attr( $sizes ) . '" alt="' . $alt . '" class="post-thumbnail" />';
                                                        else:
                                                        echo '<img ="' . $imgAttributes[1] .  '" heght="' . $imgAttributes[2]. '" src="' . get_the_post_thumbnail_url( $articleID, 'full' ) . '" alt="' . $alt . '" class="post-thumbnail" />';
                                                        endif;
                                                    ?>
                                                    <!--img src="<?php //echo $articleImage; ?>" alt="<?php //echo $alt; ?>" class="post-thumbnail" /-->
                                                    </a>
                                                </div>
                                                <div class="article1 col-12 col-md-6">
                                                    <p class="article-category">
                                                        <?php if( !empty( $content ) ):
                                                            echo $content;
                                                        else:
                                                            echo 'No Title';
                                                        endif; 
                                                        ?>
                                                    </p>
                                                    <p class="article-title">
                                                        <a href="<?php echo get_permalink( $articleID ); ?>" target="_blank"><?php echo $articleTitle; ?></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
