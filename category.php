<?php 

// include_once( __DIR__ . '/inc/Mobile_Detect.php' );

// $detect = new Mobile_Detect;

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
<div id="div-gpt-ad-5207510-3" class="dfp-div"></div>
<?php else: ?>
<div id="div-gpt-ad-5207510-2" class="dfp-div"></div>
<?php endif; ?>
<?= get_template_part('template_parts/category'); ?>
<div id="div-gpt-ad-5207510-1" class="dfp-div"></div>
<?php get_footer(); ?>