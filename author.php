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
<div id="top-dfp" class="dfp-div"></div>
<?= get_template_part('template_parts/author'); ?>
<div id="bottom-dfp" class="dfp-div"></div>
<?php get_footer(); ?>