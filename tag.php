<?php
get_header();
?>
<div class="container-fluid" id="tag-header-container">
    <div class="row no-gutters">
        <div class="col">
            <div class="container header-breadcrumb">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light breadcrumb">
                        <?php echo do_shortcode('[rank_math_breadcrumb]'); ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light">
                        <?php do_action('top_dfp_ad'); ?>
                    </div>
                </div>
            </div>
            <div class="container" id="tag-header">
                <div class="row no-gutters">
                    <div class="col-12 text-center">
                        <h1 class="eb-garamond-regular" id="tag-title"><?php echo get_tag(get_queried_object()->term_id)->name; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= get_template_part('template_parts/tag'); ?>
<?php get_footer(); ?>