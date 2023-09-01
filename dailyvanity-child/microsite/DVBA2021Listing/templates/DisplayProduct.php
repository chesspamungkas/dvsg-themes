<?php
global $post;
global $arr;

if( have_posts() ):
    while( have_posts() ):
        the_post();
?>

<div class="row g-0 m-0">
    <div class="col-12 col-md-4 product-gallery-container">
        <div class="product-gallery">
            <?php 
                echo has_post_thumbnail()?'<div class="zoom-image"><img src="' . get_the_post_thumbnail_url( get_the_ID(), 'full' ) . '" alt="Daily Vanity Beauty Awards 2021 Best ' . $arr['category'] . ' Singapore ' . get_the_title() . ' ' . implode( ', ', $arr['awards'] ) . '" /></div>':'No Thumbnail';

                if( get_field( 'dvba_2021_media_1', get_the_ID() ) ):
                    if( strpos( get_field( 'dvba_2021_media_1', get_the_ID() ), 'youtube' ) !== false ):
                        echo '<div><div class="video-wrapper"><iframe src="' . get_field( 'dvba_2021_media_1', get_the_ID() ) . '?controls=1" frameborder="0" allowfullscreen></iframe></div></div>';
                    else:
                        echo '<div class="zoom-image"><img src="' . get_field( 'dvba_2021_media_1', get_the_ID() ) . '" alt="Daily Vanity Beauty Awards 2021 Best ' . $arr['category'] . ' Singapore ' . get_the_title() . ' ' . implode( ', ', $arr['awards'] ) . '" /></div>';
                    endif;
                endif;

                if( get_field( 'dvba_2021_media_2', get_the_ID() ) ):
                    if( strpos( get_field( 'dvba_2021_media_2', get_the_ID() ), 'youtube' ) !== false ):
                        echo '<div><div class="video-wrapper"><iframe src="' . get_field( 'dvba_2021_media_2', get_the_ID() ) . '?controls=1" frameborder="0" allowfullscreen></iframe></div></div>';
                    else:
                        echo '<div class="zoom-image"><img src="' . get_field( 'dvba_2021_media_2', get_the_ID() ) . '" alt="Daily Vanity Beauty Awards 2021 Best ' . $arr['category'] . ' Singapore ' . get_the_title() . ' ' . implode( ', ', $arr['awards'] ) . '" /></div>';
                    endif;
                endif;
            ?>
        </div>
        <div class="product-gallery-nav">
            <div class="col-2 lightbox-btn ps-2">
                <i class="fas fa-search-plus"></i>
                <!--script type="text/javascript">
                jQuery( document ).ready( function( $ ) {
                    $('.lightbox-btn').slickLightbox({
                        images: [
                            <?php 
                                /*if( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ):
                                    echo "'" . get_the_post_thumbnail_url( get_the_ID(), 'full' ) . "',"; 
                                endif;

                                if( get_field( 'dvba_2021_media_1', get_the_ID() ) ):
                                    echo "'" . get_field( 'dvba_2021_media_1', get_the_ID() ) . "',"; 
                                endif;

                                if( get_field( 'dvba_2021_media_2', get_the_ID() ) ):
                                    echo "'" . get_field( 'dvba_2021_media_2', get_the_ID() ) . "',"; 
                                endif;*/
                            ?>
                        ],
                        caption: false,
                    });
                } );
                </script-->
            </div>
            <div class="col-4">
                <button type="button" class="gallery-prev-btn slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                <button type="button" class="gallery-next-btn slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 ps-md-5 product-details">
        <div>
            <ul class="awards-list p-0 mt-1">
                <?php 
                    if( get_field( 'paid', get_the_id() ) == 'yes' ):
                        $bgColor = 'paid';
                    else:
                        $bgColor = 'non-paid';
                    endif;

                    foreach( $arr['awards'] as $key => $value ):
                        echo '<li class="poppins-semibold px-3 py-1 ' . $bgColor . '">' . $value . '</li>';
                    endforeach; 
                ?>
            </ul>
            <h4 class="poppins-bold py-0"><?php the_title(); ?></h4>
            <p class="poppins-regular"><?php echo $arr['category']; ?></p>
        </div>
        <div>
            <?php 
                echo preg_replace('/<p>/', '<p class="poppins-regular">', apply_filters( 'the_content', get_the_content() ) ); 

                echo '<h2 class="eb-garamond-regular where-to-buy-title">Where To Buy</h2>';

                if( $retail_links = get_field( 'retail_links', get_the_id() ) ):
                    foreach( $retail_links as $retail ):
                        echo '<a href="'. $retail['link_url'] .'" class="poppins-bold retail-btn px-md-4 py-md-2 me-md-2 box-shadow" target="_blank">' . $retail['link_title'] . '</a>';
                    endforeach;
                endif;
            ?>
        </div>
    </div>
</div>

<?php
    endwhile;
endif;
?>