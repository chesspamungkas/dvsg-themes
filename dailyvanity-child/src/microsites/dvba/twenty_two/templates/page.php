<?php
// Template Name: DVBA 2022 Listing Template
// global $post;

use DV\core\DVBA;
use DVChild\microsites\dvba\twenty_two\DVBA_2022;

do_action('get_header');
echo get_template_part('src/microsites/dvba/twenty_two/templates/_header');
$model = DVBA_2022::getInstance();
echo get_template_part('src/microsites/dvba/twenty_two/listing/intro');
echo do_shortcode("[scrollable-list item_show='4' identifier='skincare' id='skincare-scrollable' title='Skincare' title_link='{$model->getCategoryLink('skincare')}']");
echo do_shortcode("[scrollable-list item_show='4' identifier='makeup' id='makeup-scrollable' title='Makeup' title_link='{$model->getCategoryLink('makeup')}']");
echo do_shortcode("[scrollable-list item_show='4' identifier='body-care' id='bodycare-scrollable' title='Body Care' title_link='{$model->getCategoryLink('body-care')}']");
echo do_shortcode("[scrollable-list item_show='4' identifier='hair-care' id='haircare-scrollable' title='Hair Care' title_link='{$model->getCategoryLink('hair-care')}']");
echo get_template_part('src/microsites/dvba/twenty_two/listing/judges');
echo get_template_part('src/microsites/dvba/twenty_two/listing/deals');
do_action('get_footer');
echo get_template_part('src/microsites/dvba/twenty_two/templates/_footer');
?>
