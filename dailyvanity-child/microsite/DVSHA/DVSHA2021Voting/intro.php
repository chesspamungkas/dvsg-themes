<div class="container-fluid p-0 m-0" id="intro">
    <div class="row p-0 m-0">
        <div class="col" style="background-image: url( '<?php echo $introImg; ?>' );"></div>
    </div>
    <div class="row p-0 m-0">
        <div class="col">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="dvsha-logo"><img src="<?php echo $dvshaLogo; ?>" /></div>
                        <div class="intro-text">
                            <?php the_content(); ?>
                            <a href="<?php echo $giveawayBtnLink; ?>" class="giveaway-btn" target="_blank"><?php echo $giveawayBtnText; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>