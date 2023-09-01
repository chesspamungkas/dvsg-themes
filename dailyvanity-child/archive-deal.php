<?php 
/* Template Name: Perks */

get_header();
?>
<div class="container-fluid">
    <div class="row no-gutters">
        <div class="col">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light">
                        <?php if( !is_admin() && get_field( 'disable_ads_injection', $post->ID ) === false ): ?>
                            <div id="top-dfp" class="dfp-div"></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="perks-header-container">
    <div class="row no-gutters">
        <div class="col">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 text-center">
                        <img id="img-perks" src= "<?php echo S3_PATH; ?>/wp-content/uploads/svg/beauty-magazine-singapore-daily-vanity-perks-page-logo.svg?v=<?php echo DEPLOY_VERSION; ?>" alt="Beauty Magazine Singapore Daily Vanity Perks Logo">
                        <h1 class="philosopher-perks">Perks</h1>
                        <p class="subtitle-perks">All the latest deals and steals you don't wanna miss!</p>
                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>
<?php echo do_shortcode( '[perks post_status="publish" title="1" posts_per_page="18"]' ); ?>
<?php echo do_shortcode( '[perks post_status="expired" title="1" posts_per_page="6"]' ); ?>
<?php get_footer(); ?>