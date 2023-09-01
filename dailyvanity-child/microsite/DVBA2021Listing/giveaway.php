<?php
    $pageID = get_queried_object()->ID;

    $imgArr = get_field( 'giveaway_background_image', $pageID );
?>
<a name="giveaway"></a>
<div class="container-fluid" id="giveaway-container" style="background-image: url( '<?php echo $imgArr['url']; ?>' );">
    <div class="row no-gutters mx-0 py-md-4 py-5 px-0">
        <div class="col py-md-5 px-md-3 px-0">
            <div class="container">
                <div class="row g-0 m-0">
                    <div class="col py-md-5 px-md-5 px-3 py-3 mx-auto white-shim-bg">
                        <div class="p-3 p-md-5">
                            <h2 class="poppins-bold mb-3">Giveaway</h2>
                            <?php echo apply_filters( 'the_content', get_field( 'giveaway_text', $pageID ) ); ?>
                            <p class="mb-4 pt-5"><a href="<?php echo get_field( 'giveaway_button_link', $pageID ); ?>" class="giveaway-btn box-shadow py-2 px-3 px-md-5 poppins-bold" target="_blank"><?php echo get_field( 'giveaway_button_text', $pageID ); ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>