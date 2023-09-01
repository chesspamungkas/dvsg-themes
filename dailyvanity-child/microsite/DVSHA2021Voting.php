<?php
// Template Name: DVSHA 2021 Voting Template

$pageID = get_queried_object()->ID;

$customCss = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Voting/css/style.css?v=' . DEPLOY_VERSION;

$customJs = get_stylesheet_directory_uri() . '/microsite/DVSHA/DVSHA2021Voting/js/script.js?v=' . DEPLOY_VERSION;

$home = home_url() . '/best-spa-hair-facials-treatments-singapore/2021/';
$fb = 'https://www.facebook.com/dailyvanity/';
$ig = 'https://www.instagram.com/dailyvanity/?hl=en';
$tw = 'https://twitter.com/dailyvanitysg?lang=en';
$ytb = 'https://www.youtube.com/dailyvanity?sub_confirmation=1';

$introImg = get_field( 'intro_image', $pageID );
$dvshaLogo = get_field( 'logo', $pageID );

$giveawayImg = get_field( 'giveaway_image', $pageID );
$giveawayText = get_field( 'giveaway_text', $pageID );
$giveawayBtnText = get_field( 'giveaway_btn_text', $pageID );
$giveawayBtnLink = get_field( 'giveaway_btn_link', $pageID );


include_once(__DIR__ . '/DVSHA/header.php');

include_once(__DIR__ . '/DVSHA/top-bar.php');

include_once(__DIR__ . '/DVSHA/DVSHA2021Voting/intro.php');

include_once(__DIR__ . '/DVSHA/DVSHA2021Voting/giveaway.php');

// include_once(__DIR__ . '/DVSHA/DVSHA2021Voting/vote.php');

include_once(__DIR__ . '/DVSHA/footer-bar.php');

include_once(__DIR__ . '/DVSHA/footer.php');
