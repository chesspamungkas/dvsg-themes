<?php 

get_header(); 

?>
<div class="container-fluid" id="cat-header-container">
    <div class="row no-gutters">
        <div class="col">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 text-center">
                        <h1 class="eb-garamond-regular" id="cat-title"><?php echo get_the_category_by_ID( $wp_query->get_queried_object_id() ); ?></h1>
                        <?php echo category_description( $wp_query->get_queried_object_id() ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if( $_COOKIE['device'] == 'mobile' ): ?>
<!-- DFP Ad Size 320 x 50 - div-gpt-ad-5207510-3 -->
<div id="<?php echo DFP_MOBILE_TOP; ?>" class="dfp-div"></div>
<?php else: ?>
<!-- DFP Ad Size 780 x 90 - div-gpt-ad-5207510-2 -->
<div id="<?php echo DFP_DESKTOP_TOP; ?>" class="dfp-div"></div>
<?php endif; ?>
<?= get_template_part('template_parts/category'); ?>
<!-- DFP Ad Size 300 x 250 - div-gpt-ad-5207510-1 -->
<div id="<?php echo DFP_BOTTOM; ?>" class="dfp-div"></div>
<?php get_footer(); ?>