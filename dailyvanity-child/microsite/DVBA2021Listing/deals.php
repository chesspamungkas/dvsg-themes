<?php
    $pageID = get_queried_object()->ID;
?>    
<a name="deals"></a>
<div class="container-fluid" id="deals-container">
    <div class="row g-0 mx-0">
        <div class="col">
            <div class="container px-4 pb-5 px-md-5 pb-md-5">
                <!-- <div class="row g-0 mx-0">
                    <div class="col pt-5 pb-3">
                        
                    </div>
                </div> -->
                <div class="row g-0 mx-0 align-items-center pb-4">
                    <div class="col-12 col-md-9 pt-5">
                        <h2 class="eb-garamond-regular">Deals</h2>
                        <?php echo get_field( 'deals_text', $pageID ); ?>
                    </div>
                    <div class="col-12 col-md-3 pt-5 text-md-center">
                        <a href="<?php echo get_field( 'deals_button_link', $pageID ); ?>" target="_blank" class="deals-button box-shadow py-2 px-5 poppins-bold"><?php echo get_field( 'deals_button_text', $pageID ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>