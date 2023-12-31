<?php

get_header();

$author = get_queried_object();
set_query_var('author_id', absint($author->ID));
?>
<div class="container-fluid" id="author-header-container">
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
            <div class="container" id="author-header">
                <div class="row no-gutters">
                    <div class="col-12 text-center">
                        <h1 class="eb-garamond-regular" id="author-title"><?php echo get_the_author_meta('display_name', $author->ID); ?></h1>
                        <?php echo get_the_author_meta('description', $author->ID); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_template_part('template_parts/author'); ?>
<?php get_footer(); ?>