<?php 
global $isMobile;
if( $categories ): 
    $parity = 1;
    foreach( $categories as $category ):
        if( $parity%2 == 0 ):
            $leftClass = 'float-left';
            $rightClass = 'float-right';
            $bgColor = '#CAC4B4';
        else:
            $leftClass = 'float-right';
            $rightClass = 'float-left';
            $bgColor = '#ffffff';
        endif;

        if( $isMobile ):
            $leftClass = 'no-float';
            $rightClass = 'no-float';
        endif;
?>
    <div class="container mb-5 winners-list" id="<?php echo $category['parent_slug']; ?>-container">
        <div class="row">
            <div class="col-12 col-md-6 cat-img <?php echo $leftClass ?>">
                <img src="<?php echo $category['parent_img']; ?>" alt="Best Popular Spas, Hair Salons, Facials, Massages, Grooming, Aesthetic Treatments in Singapore 2021 <?php echo $category['parent_title']; ?>" />
            </div>
            <div class="col-12 col-md-8 cat-content <?php echo $rightClass ?>" style="background-color: <?php echo $bgColor; ?>;">
                <h2 class="cat-title"><?php echo $category['parent_title']; ?></h2>
                <div class="container-fluid subcat-list no-gutters">
                    <div class="row no-gutters">
                    <?php 
                        if( $isMobile ):
                    ?>
                        <div class="col-12"><a href="<?php echo $category['parent_url']; ?>">Click To Reveal</a></div>
                    <?php
                        else:
                            foreach( $category['child'] as $child ): 
                    ?>
                        <div class="col-4 p-3"><a href="<?php echo get_term_link( $child->term_id, 'dvsha_2021_categories' ); ?>" target="_blank"><?php echo str_replace( ' (', '<br/>(', $child->name ); ?></a></div>
                    <?php 
                            endforeach; 
                        endif;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
        $parity++;
    endforeach;
?>
<script>
    jQuery( document ).ready( function($) {
        var id = '<?php echo $category['parent_slug']; ?>-container';
        var height = $( '#'+id ).find( '.cat-content' ).height();
        console.log( height );

        if( !isMobile ) {
            $( '.cat-img' ).css( 'top', height/4+'px' );
        }
    } );
</script>
<?php endif; ?>