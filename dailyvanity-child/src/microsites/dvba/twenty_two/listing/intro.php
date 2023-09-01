<?php 
    use DV\core\DVBA;
?>
<div class="container-fluid px-0 pt-0 pb-5" id="intro">
    <div class="row g-0 intro-row m-0">
        <div class="col">
            <div id="dvba-logo">
                <h1>
                    <?php do_action(DVBA::$LOGO_ACTION, $post); ?>                    
                </h1>
            </div>
        </div>
    </div>
    <div class="row g-0 intro-row pt-md-5 m-0">
        <div class="col-12 col-sm-12 col-md-8 intro-content mt-5 pt-5 mt-md-5 pt-md-5 mx-auto px-4">
            <?php the_content(); ?>
        </div>
    </div>
</div>