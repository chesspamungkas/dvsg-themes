<?php
global $mode;

$home = home_url() . '/best-beauty-products-singapore/2021/';
$fb = 'https://www.facebook.com/dailyvanity/';
$ig = 'https://www.instagram.com/dailyvanity/?hl=en';
$tw = 'https://twitter.com/dailyvanitysg?lang=en';
$ytb = 'https://www.youtube.com/dailyvanity?sub_confirmation=1';

$skincare = $home . 'skincare/';
$makeup = $home . 'makeup/';
$bodycare = $home . 'body-care/';
$haircare = $home . 'hair-care/';
$giveaway = $home . '?hash=giveaway';
$judges = $home . '?hash=judges';
$deals = $home . '?hash=deals';

?>
<div id="top-bar">
    <nav class="navbar navbar-expand-lg px-2 px-md-4 py-0 navbar-light desktop-view">
        <div class="container-fluid">
            <div class="collapse navbar-collapse mx-auto justify-content-center" id="navbarText">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link px-md-4 poppins-bold" href="<?php echo $home; ?>">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-md-4 poppins-bold" href="<?php echo $skincare; ?>">SKINCARE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-md-4 poppins-bold" href="<?php echo $makeup; ?>">MAKEUP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-md-4 poppins-bold" href="<?php echo $bodycare; ?>">BODY CARE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-md-4 poppins-bold" href="<?php echo $haircare; ?>">HAIR CARE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-md-4 poppins-bold" href="<?php echo $giveaway; ?>">GIVEAWAY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-md-4 poppins-bold" href="<?php echo $judges; ?>">JUDGES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-md-4 poppins-bold" href="<?php echo $deals; ?>">DEALS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg px-2 px-md-4 py-0 navbar-light desktop-view top-bar-2">
        <div class="container">
            <div class="row g-0 mx-0 align-items-center" style="width: 100%;">
                <div class="col-2 pe-md-4">
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo S3_PATH; ?>/wp-content/uploads/svg/beauty-magazine-daily-vanity-logo.svg" alt="" id="top-logo" /></a>
                </div>
                <div class="col-8">
                    <div class="wrapper">
                        <form method="" action="<?php echo $home; ?>search/" class="searchForm">
                            <div class="search-icon"></div>
                            <input placeholder="SEARCH FOR BRANDS OR PRODUCTS" type="text" class="search" name="k" id="keyword" />
                        </form>
                    </div>
                </div>
                <div class="col-2 ps-3">
                    <div class="row g-0 justify-content-center mx-0">
                        <div class="col-3 social-media"><a href="<?php echo $fb; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></div>
                        <div class="col-3 social-media"><a href="<?php echo $ig; ?>" target="_blank"><i class="fab fa-instagram"></i></a></div>
                        <div class="col-3 social-media"><a href="<?php echo $tw; ?>" target="_blank"><i class="fab fa-twitter"></i></a></div>
                        <div class="col-3 social-media"><a href="<?php echo $ytb; ?>" target="_blank"><i class="fab fa-youtube"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg px-2 px-md-4 py-0 navbar-light mobile-view py-2">
        <div class="container-fluid">
            <div class="row g-0 mx-0 align-items-center">
                <div class="col">
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo S3_PATH; ?>/wp-content/uploads/svg/beauty-magazine-daily-vanity-logo.svg" alt="" id="top-logo" /></a>
                </div>
                <div class="col toggle-button-container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" id="topbar-toggle-open-btn">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>

            <div class="collapse navbar-collapse mx-auto justify-content-center px-4 pt-4 pb-5" id="navbarText">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="true" aria-label="Toggle navigation" id="topbar-toggle-close-btn">
                    <i class="fas fa-times"></i>
                </button>
                <ul class="navbar-nav">
                    <!--li class="nav-item">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="true" aria-label="Toggle navigation" id="topbar-toggle-close-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </li-->
                    <li class="nav-item pb-3">
                        <a class="nav-link px-md-4 poppins-bold text-center" href="<?php echo $home; ?>">HOME</a>
                    </li>
                    <li class="nav-item pb-3">
                        <a class="nav-link px-md-4 poppins-bold text-center" href="<?php echo $skincare; ?>">SKINCARE</a>
                    </li>
                    <li class="nav-item pb-3">
                        <a class="nav-link px-md-4 poppins-bold text-center" href="<?php echo $makeup; ?>">MAKEUP</a>
                    </li>
                    <li class="nav-item pb-3">
                        <a class="nav-link px-md-4 poppins-bold text-center" href="<?php echo $bodycare; ?>">BODY CARE</a>
                    </li>
                    <li class="nav-item pb-3">
                        <a class="nav-link px-md-4 poppins-bold text-center" href="<?php echo $haircare; ?>">HAIR CARE</a>
                    </li>
                    <li class="nav-item pb-3">
                        <a class="nav-link px-md-4 poppins-bold text-center" href="<?php echo $giveaway; ?>">GIVEAWAY</a>
                    </li>
                    <li class="nav-item pb-3">
                        <a class="nav-link px-md-4 poppins-bold text-center" href="<?php echo $judges; ?>">JUDGES</a>
                    </li>
                    <li class="nav-item pb-3">
                        <a class="nav-link px-md-4 poppins-bold text-center" href="<?php echo $deals; ?>">DEALS</a>
                    </li>
                    <li class="nav-item pb-4 mobile-view search-li">
                        <div class="wrapper">
                            <form method="" action="<?php echo $home; ?>search/" class="searchForm">
                                <div class="search-icon"></div>
                                <input placeholder="SEARCH FOR BRANDS OR PRODUCTS" type="text" class="search" name="k" />
                            </form>
                        </div>
                    </li>
                    <li class="nav-item mobile-view social-media">
                        <div class="container">
                            <div class="row g-0 justify-content-center mx-0">
                                <div class="col-3"><a href="<?php echo $fb; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></div>
                                <div class="col-3"><a href="<?php echo $ig; ?>" target="_blank"><i class="fab fa-instagram"></i></a></div>
                                <div class="col-3"><a href="<?php echo $tw; ?>" target="_blank"><i class="fab fa-twitter"></i></a></div>
                                <div class="col-3"><a href=“<?php echo $ytb; ?>” target="_blank"><i class="fab fa-youtube"></i></a></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div id="navbarText-bg" class="hide"></div>
        </div>
    </nav>
</div>