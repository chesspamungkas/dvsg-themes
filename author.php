<?php 

get_header(); 

$author = get_queried_object();
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
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light">
                      <div id="top-dfp" class="dfp-div"></div>
                    </div>
                </div>
            </div>
            <div class="container" id="author-header">
                <div class="row no-gutters">
                    <div class="col-12 text-center">
                        <h1 class="eb-garamond-regular" id="author-title"><?php echo get_the_author_meta( 'display_name', $author->ID ); ?></h1>
                        <?php echo get_the_author_meta( 'description', $author->ID ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= get_template_part('template_parts/author'); ?>
<div id="bottom-dfp" class="dfp-div"></div>
<?php get_footer(); ?>
