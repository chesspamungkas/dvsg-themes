<?php 

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
<?php if( $_COOKIE['device'] == 'mobile' ): ?>
<!-- DFP Ad Size 320 x 50 - div-gpt-ad-5207510-3 -->
<div id="<?php echo DFP_MOBILE_TOP; ?>" class="dfp-div"></div>
<?php else: ?>
<!-- DFP Ad Size 780 x 90 - div-gpt-ad-5207510-2 -->
<div id="<?php echo DFP_DESKTOP_TOP; ?>" class="dfp-div"></div>
<?php endif; ?>
<?= get_template_part('template_parts/search'); ?>
<!-- DFP Ad Size 300 x 250 - div-gpt-ad-5207510-1 -->
<div id="<?php echo DFP_BOTTOM; ?>" class="dfp-div"></div>
<?php get_footer(); ?>
