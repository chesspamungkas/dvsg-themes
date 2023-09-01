<?php
    if( $brands ):
?>
<div class="container">
    <div class="row no-gutters">
        <div class="col no-gutters">
            <div class="featured-brand-slider">
            <?php
                foreach( $brands->terms as $brand ):
                    $brandDesc = $brand->description;
                    $brandslug = $brand->slug;
                    $meta = get_term_meta( $brand->term_id );
                    echo $this->render( 'DVSHA2021Listing/_brandItem', [ 
                        'name'      => $brand->name, 
                        'desc'      => $brand->description, 
                        'slug'      => $brand->slug,
                        'image'     => wp_get_attachment_image_url( $meta['title'][0], 'full' )
                    ] );
                endforeach;
            ?>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery( document ).ready( function( $ ) {
        $('.featured-brand-slider').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            prevArrow: '<i class="fas fa-caret-left prev-arrow"></i>',
            nextArrow: '<i class="fas fa-caret-right next-arrow"></i>',
            responsive: [
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    } );
</script>
<?php
    endif;
?>