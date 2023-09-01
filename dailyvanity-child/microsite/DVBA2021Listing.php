<?php
// Template Name: DVBA Listing 2021 Template
// global $post;
get_header( 'dvba2021listing' );

// $page = get_queried_object();

$mode = 'home';

include( 'DVBA2021Listing/intro.php' );
include( 'DVBA2021Listing/category.php' );
include( 'DVBA2021Listing/giveaway.php' );
include( 'DVBA2021Listing/judges.php' );
include( 'DVBA2021Listing/deals.php' );

get_footer( 'dvba2021listing' ); 
?>
