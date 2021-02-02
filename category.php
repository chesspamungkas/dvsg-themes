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

<div id="top-dfp" class="dfp-div"></div>
<?= get_template_part('template_parts/category'); ?>
<div id="bottom-dfp" class="dfp-div"></div>
<?php get_footer(); ?>