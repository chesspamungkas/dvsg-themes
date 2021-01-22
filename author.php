<?php 

get_header(); 

?>
<div class="container-fluid" id="author-header-container">
    <div class="row no-gutters">
        <div class="col">
            <div class="container header-breadcrumb">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light breadcrumb">
						<?php echo do_shortcode( '[rank_math_breadcrumb]' ); ?>
                    </div>
                </div>
            </div>
            <div class="container" id="author-header">
                <div class="row no-gutters">
                    <div class="col-12 text-center">
                        <h1 class="eb-garamond-regular" id="author-title"><?php echo get_the_author_meta( 'display_name', get_the_author_meta('ID') ); ?></h1>
                        <?php echo get_the_author_meta( 'description', get_the_author_meta('ID') ); ?>
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
<?= get_template_part('template_parts/author'); ?>
<div id="div-gpt-ad-5207510-1" class="dfp-div"></div>
<?php get_footer(); ?>