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
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light">
                      <div id="top-dfp" class="dfp-div"></div>
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
<?= get_template_part('template_parts/search'); ?>
<div id="bottom-dfp" class="dfp-div"></div>
<?php get_footer(); ?>
