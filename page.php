<?php
get_header();

while (have_posts()) : the_post();
?>
    <div class="container-fluid" id="page-header-container">
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
                <div class="container" id="page-header">
                    <div class="row no-gutters">
                        <div class="col-12 text-center">
                            <h1 class="eb-garamond-regular" id="page-title"><?php echo the_title(); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-content" class="d-flex">
        <div class="container">
            <div class="row no-gutters">
                <div class="col">
                    <div id="content-area" class="clearfix">
                        <?php // while ( have_posts() ) : the_post(); 
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <?php
                                the_content();
                                ?>
                            </div> <!-- .entry-content -->
                        </article> <!-- .et_pb_post -->
                        <?php // endwhile; 
                        ?>
                    </div> <!-- #content-area -->
                </div> <!-- .col -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- #main-content -->
<?php endwhile; ?>
<?php get_footer(); ?>