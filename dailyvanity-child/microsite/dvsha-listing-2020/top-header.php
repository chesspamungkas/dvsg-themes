<?php

if( isset( $mode ) && $mode ) {
    $baseLink = home_url() . '/best-spa-hair-facials-treatments';

    echo '<script>';
    echo 'var isHome = "no";';
    echo '</script>';
} else {
    $baseLink = '';

    echo '<script>';
    echo 'var isHome = "yes";';
    echo '</script>';
}

$giveawayLink = home_url() . '/best-spa-hair-facials-treatments/giveaway';
?>
<!-- <div class="header-bg"> -->
<?php 
    if( !empty( $baseLink ) ) {
        echo '<div class="header-logo"><a href="' . $baseLink . '"><img src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvsha-listing-2020/img/DVSHA-LOGO.png" alt="best most popular spa hair salons facials massages grooming aesthetic services singapore" /></a></div>';
    // } else {
    //     echo '<div class="header-logo"><img src="' . esc_url(get_stylesheet_directory_uri()) . '/microsite/dvsha-listing-2020/img/shim.png" /></div>';
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark dvsha-nav sticky-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i class="fa fa-bars" style="color:#fff; font-size:28px;"></i>
        </span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item <?php echo !$baseLink?'active':''; ?>">
                <a class="nav-link" href="<?php echo $baseLink; ?>">Home</a>
            </li>
            <?php if( isset( $mode ) && $mode ) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseLink; ?>/?hash=winners">Winners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseLink; ?>/?hash=articles">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseLink; ?>/?hash=brands">Brands</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseLink; ?>#winners">Winners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseLink; ?>#articles">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseLink; ?>#brands">Brands</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
<!-- </div> -->