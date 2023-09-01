<!-- start navigation bar -->
<?php

function generateNavLinks( $slug ) {
    $count = 1;
    $terms = get_term_by( 'slug', $slug, 'dvba_2020_categories');

    $categories = get_terms( 'dvba_2020_categories', array(
        'parent' => $terms->term_id,
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'ASC',
        'show_count' => true,
    ) );

    $numTerms = wp_count_terms( 'dvba_2020_categories', array(
        'parent' => $terms->term_id,
        'hide_empty' => false,
    ) );

    if( $numTerms >= 6 ) {
        if( $numTerms % 2 == 0 ) {
            $break = $numTerms / 2;
        } else {
            $break = ( $numTerms + ( $numTerms % 2 ) ) / 2;
        }
    } else {
        $break = $numTerms;
    }

    foreach( $categories as $category ) {
        if( $count > $break ) {
            echo '</ul>';
            echo '</div>';
            echo '<div class="col-md-6 col-6 no-padding">';
            echo '<ul class="no-padding">';
            $count = 1;
        }
        echo '<li class="no-padding">';
        echo '<a href="' . get_term_link( $category->term_id ) . '">' . $category->name . '</a>';
        echo '</li>';
        $count++;
    }
}

?>
<div class="container montserrat full-width" id="nav-container">
    <div class="row no-margin">
        <div class="col">
            <div class="navbar navbar-dark navbar-expand-md desktop-nav">
                <div class="container">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">☰</button>
                    <div class="navbar-collapse collapse justify-content-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item<?php echo $active=='intro'?' active':''; ?>">
                                <a href="<?php echo get_home_url(); ?>/best-beauty-products/2020" class="nav-link">Introduction</a>
                            </li>
                            <li class="dropdown menu-large nav-item<?php echo $active=='winners'?' active':''; ?>">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Winners</a>
                                <div class="dropdown-menu megamenu">
                                    <div class="row no-margin justify-content-center">
                                        <div class="col-md-4">
                                            <ul>
                                                <li class="no-padding">
                                                    <h6>Makeup</h6>
                                                    <div class="row no-margin">
                                                        <div class="col-md-6 no-padding">
                                                            <ul class="no-padding">
                                                                <?php generateNavLinks( 'makeup' ); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul>
                                                <li class="no-padding">
                                                    <h6>Skincare</h6>
                                                    <div class="row no-margin">
                                                        <div class="col-md-6 no-padding">
                                                            <ul class="no-padding">
                                                                <?php generateNavLinks( 'skincare' ); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2">
                                            <ul>
                                                <li class="no-padding">
                                                    <h6>Body Care</h6>
                                                    <div class="row no-margin">
                                                        <div class="col-md-12 no-padding">
                                                            <ul class="no-padding">
                                                                <?php generateNavLinks( 'body-care' ); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2">
                                            <ul>
                                                <li class="no-padding">
                                                    <h6>Hair Care</h6>
                                                    <div class="row no-margin">
                                                        <div class="col-md-12 no-padding">
                                                            <ul class="no-padding">
                                                                <?php generateNavLinks( 'hair-care' ); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo get_home_url(); ?>/?s=DVBA2020" class="nav-link">Articles</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo get_home_url(); ?>/giveaway/dvba2020?utm_source=dvba2020_giveaway&utm_medium=website&utm_campaign=dvba2020-listing" class="nav-link">Giveaway</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navbar navbar-dark navbar-expand-md mobile-nav">
                <div class="container">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">☰</button>
                    <div class="navbar-collapse collapse justify-content-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item<?php echo $active=='intro'?' active':''; ?>">
                                <a href="<?php echo get_home_url(); ?>/best-beauty-products/2020" class="nav-link">Introduction</a>
                            </li>
                            <li class="dropdown menu-large nav-item<?php echo $active=='winners'?' active':''; ?>">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Winners</a>
                                <div class="dropdown-menu megamenu">
                                    <div class="row no-margin justify-content-center">
                                        <div class="col-12 no-padding">
                                            <ul>
                                                <li class="no-padding">
                                                    <h6>Makeup</h6>
                                                    <div class="row no-margin">
                                                        <div class="col-6 no-padding">
                                                            <ul class="no-padding">
                                                                <?php generateNavLinks( 'makeup' ); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 no-padding">
                                            <ul>
                                                <li class="no-padding">
                                                    <h6>Skincare</h6>
                                                    <div class="row no-margin">
                                                        <div class="col-6 no-padding">
                                                            <ul class="no-padding">
                                                                <?php generateNavLinks( 'skincare' ); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <ul>
                                                <li class="no-padding">
                                                    <h6>Body Care</h6>
                                                    <div class="row no-margin">
                                                        <div class="col-12 no-padding">
                                                            <ul class="no-padding">
                                                                <?php generateNavLinks( 'body-care' ); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <ul>
                                                <li class="no-padding">
                                                    <h6>Hair Care</h6>
                                                    <div class="row no-margin">
                                                        <div class="col-12 no-padding">
                                                            <ul class="no-padding">
                                                                <?php generateNavLinks( 'hair-care' ); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo get_home_url(); ?>/?s=DVBA2020" class="nav-link">Articles</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo get_home_url(); ?>/giveaway/dvba2020?utm_source=dvba2020_giveaway&utm_medium=website&utm_campaign=dvba2020-listing" class="nav-link">Giveaway</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end navigation bar -->