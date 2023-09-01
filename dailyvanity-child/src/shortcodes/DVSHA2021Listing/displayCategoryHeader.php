<div class="container-fluid p-0 m-0" id="intro">
    <div class="row p-0 m-0">
        <div class="col" style="background-image: url( '<?php echo $this->getCategoryImage( $parent->term_id ); ?>' );"></div>
    </div>
    <div class="row p-0 m-0">
        <div class="col">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="dvsha-logo"><img src="<?php echo $dvshaLogo; ?>" /></div>
                    </div>
                </div>
                <div class="row justify-content-center category-list">
                    <div class="col-12 text-center">
                        <h2 class="category-header-title"><?php echo $parent->name; ?></h2>
                        <div class="row no-gutters p-0">
                        <?php if( $parent->term_id == $args['id'] ): ?>
                            <div class="col-3 subcategory-list py-2 px-2 mb-2 align-self-center" style="background-color: #CAC4B4;">View All</div>
                        <?php else: ?>
                            <div class="col-3 subcategory-list py-2 px-2 mb-2 align-self-center">
                                <a href="<?php echo get_term_link( $parent->slug, 'dvsha_2021_categories' ); ?>" target="_blank">View All</a>
                            </div>
                        <?php endif; ?>
                        <?php 
                            foreach( $subCategories as $category ): 
                                if( $category->term_id == $args['id'] ):
                        ?>
                            <div class="col-3 subcategory-list py-2 px-2 mb-2 align-self-center" style="background-color: #CAC4B4;"><?php echo $category->name; ?>
                            </div>
                        <?php else: ?>
                            <div class="col-3 subcategory-list py-2 px-2 mb-2 align-self-center">
                                <a href="<?php echo get_term_link( $category->slug, 'dvsha_2021_categories' ); ?>" target="_blank"><?php echo $category->name; ?></a>
                            </div>
                        <?php 
                                endif;
                            endforeach; 
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>