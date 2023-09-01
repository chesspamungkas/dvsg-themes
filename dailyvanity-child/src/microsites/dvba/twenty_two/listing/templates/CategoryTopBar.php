<?php
    global $args;

    // print_r( $args );
    // https://uploads.dailyvanity.sg/wp-content/uploads/2021/03/all.png
?>
<h1 class="eb-garamond-regular category-topbar-title"><?php echo $args['parent_name']?$args['parent_name']:$args['category_name']; ?></h1>
<div id="category-topbar-slider">
    <!-- <ul class="ps-0" id="category-topbar-nav"> -->
    <?php
        $count = 1;
        foreach( $args['menu_items'] as $menu_item ):
            if( $menu_item->menu_order == 1 ):
                $img = 'https://uploads.dailyvanity.sg/wp-content/uploads/2021/03/all.png';

                if( $args['parent_name'] ):
                    $link = get_term_link( $args['parent_term_id'] );
                else:
                    $link = get_term_link( $args['category_term_id'] );
                endif;
            else:
                $imgArr = wp_get_attachment_image_src( get_option( 'categoryimage_' . $menu_item->object_id ), 'full' );

                // wp_get_attachment_image_src will return false if there is no image
                // so check first before get
                if($imgArr){
                    $img = $imgArr[0];
                } else {
                    $img = 'https://dailyvanity-sg.tipsy.darvis.dev/wp-content/uploads/2022/03/DVBA-logo-award-tiers.png';
                }

                $link = $menu_item->url;
            endif;

            echo '<div class="poppins-semibold px-3 px-md-4 py-md-3 category-nav">'; 
            echo '<a href="' . $link . '" title="' . $menu_item->title . '">';
            echo '<img src="' . $img . '" class="cat-icon" alt="' . $menu_item->title . '" />';
            echo $menu_item->title ; 
            echo '</a>';
            echo '</div>';

            // if( ceil( count( $args['menu_items'] ) / 2 ) == $count ):
            //     echo '</br>';
            // endif;

            $count++;
        endforeach;
    ?>
    <!-- </ul> -->
</div>
<div>
    <span class="category-topbar-slider-note">< Swipe to view more ></span>
</div>