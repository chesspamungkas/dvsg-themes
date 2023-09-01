<?php global $isMobile; ?>
<div class="container-fluid p-0 m-0" id="intro">
    <div class="row p-0 m-0">
        <div class="col" style="background-image: url( '<?php echo $this->getCategoryImage( $parent->term_id ); ?>' );"></div>
    </div>
    <div class="row p-0 m-0">
        <div class="col">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="dvsha-logo"><h1><img src="<?php echo $dvshaLogo; ?>" alt="Best Popular Spas, Hair Salons, Facials, Massages, Grooming, Aesthetic Treatments in Singapore 2021" /></h1></div>
                    </div>
                </div>
                <div class="row justify-content-center category-list">
                    <div class="col-12 text-center px-0">
                        <h2 class="category-header-title"><?php echo $parent->name; ?></h2>
                        <div class="row no-gutters p-0">
                            <?php if( $isMobile ): ?>
                                <div class="col px-sm-0">
                                    <ul class="subcategory-list">
                                    <?php if( $parent->term_id == $args['id'] ): ?>
                                        <li style="background-color: #CAC4B4;">View All</li>
                                    <?php else: ?>
                                        <li><a href="<?php echo get_term_link( $parent->slug, 'dvsha_2021_categories' ); ?>" target="_blank">View All</a></li>
                                    <?php endif; ?>
                                    <?php 
                                        foreach( $subCategories as $category ): 
                                            if( $category->term_id == $args['id'] ):
                                    ?>
                                        <li style="background-color: #CAC4B4;"><?php echo $category->name; ?></li>
                                    <?php else: ?>
                                        <li><a href="<?php echo get_term_link( $category->slug, 'dvsha_2021_categories' ); ?>" target="_blank"><?php echo $category->name; ?></a></li>
                                    <?php 
                                            endif;
                                        endforeach; 
                                    ?>
                                    </ul>
                                </div>
                            <?php else: ?>
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>