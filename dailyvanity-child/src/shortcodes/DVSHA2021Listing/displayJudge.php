<?php
    if( $judges ):
?>
<div class="container">
    <div class="row no-gutters">
        <div class="col no-gutters">
            <div class="judges-slider">
                <?php foreach( $judges as $judge ): ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-3 col-4 text-center">
                                <div class="judge-photo" style="background-image: url( '<?php echo $judge['judge_photo']; ?>' );"></div>
                            </div>
                            <div class="col-md-9 col-8 p-0 p-md-2">
                                <div class="card-body judge-bio">
                                    <h5 class="card-title judge-name"><?php echo $judge['judge_name']; ?></h5>
                                    <?php echo apply_filters( 'the_content', $judge['judge_bio'] ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery( document ).ready( function( $ ) {
        $( '.judges-slider' ).slick( {
            dots: true,
            arrows: false,
            infinite: true,
            speed: 300,
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        } );
    } );
</script>
<?php
    endif;
?>