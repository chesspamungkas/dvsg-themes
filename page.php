<?php

get_header();

?>
<div class="container-fluid" id="page-header-container">
    <div class="row no-gutters">
        <div class="col">
            <div class="container header-breadcrumb">
                <div class="row no-gutters">
                    <div class="col-12 poppins-light breadcrumb">
						<?php echo do_shortcode( '[rank_math_breadcrumb]' ); ?>
                    </div>
                </div>
            </div>
            <div class="container" id="page-header">
                <div class="row no-gutters">
                    <div class="col-12 text-center">
                        <h1 class="eb-garamond-regular" id="page-title"><?php echo the_title(); ?></h1>
                        <?php //echo category_description( $wp_query->get_queried_object_id() ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if( $isMobile ): ?>
<div id="div-gpt-ad-5207510-3" class="dfp-div"></div>
<?php else: ?>
<div id="div-gpt-ad-5207510-2" class="dfp-div"></div>
<?php endif; ?>

<div id="main-content" class="d-flex">  
	<div class="container">
		<div class="row no-gutters">
			<div class="col">
				<div id="content-area" class="clearfix">			
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>				
							<!--h1 class="entry-title main_title"><?php //the_title(); ?></h1-->
							<div class="entry-content">
								<?php
									the_content();

									if ( ! $is_page_builder_used )
										wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
								?>
							</div> <!-- .entry-content -->
						</article> <!-- .et_pb_post -->
					<?php endwhile; ?>
				</div> <!-- #content-area -->
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<div id="div-gpt-ad-5207510-1" class="dfp-div"></div>
<?php get_footer(); ?>