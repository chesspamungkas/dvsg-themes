<?php 

include_once( __DIR__ . '/inc/Mobile_Detect.php' );

$detect = new Mobile_Detect;

get_header();

?>
<div class="container-fluid" id="search-header-container">
    <div class="row no-gutters">
        <div class="col">
            <div class="container header-breadcrumb">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light breadcrumb">
						<?php echo do_shortcode( '[rank_math_breadcrumb]' ); ?>
                    </div>
                </div>
            </div>
            <div class="container" id="search-header">
                <div class="row no-gutters">
                    <div class="col-12 text-center">
                        <h1 class="eb-garamond-regular" id="search-title">SEARCH RESULTS FOUND FOR: "<?php echo strtoupper( get_search_query() ); ?>"</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if( $detect->isMobile() || $detect->isTablet() ): ?>
<div id="div-gpt-ad-5207510-3" class="dfp-div"></div>
<?php else: ?>
<div id="div-gpt-ad-5207510-2" class="dfp-div"></div>
<?php endif; ?>
<?= get_template_part('template_parts/search'); ?>
<div id="div-gpt-ad-5207510-1" class="dfp-div"></div>
<?php get_footer(); ?>
