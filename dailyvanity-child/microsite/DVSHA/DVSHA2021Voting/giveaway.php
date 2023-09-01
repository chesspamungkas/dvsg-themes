<div class="container-fluid p-0 m-0" id="giveaway">
    <div class="row p-0 m-0">
        <div class="col p-md-5 px-3 py-5" style="background-image: url( '<?php echo $giveawayImg; ?>' );">
            <div class="container p-0 my-0 mx-auto">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 giveaway-title align-self-center">
                        <h2>GIVEAWAY</h2>
                    </div>
                    <div class="col-12 col-md-8 giveaway-content align-self-center">
                        <?php echo apply_filters( 'the_content', $giveawayText ); ?>
                        <a href="<?php echo $giveawayBtnLink; ?>" class="giveaway-btn" target="_blank"><?php echo $giveawayBtnText; ?></a>
                    </div>
                    <!--div class="col-md-5 giveaway-title align-self-center desktop">
                        <h2>GIVEAWAY</h2>
                    </div-->
                </div>
            </div>
        </div>
    </div>
</div>