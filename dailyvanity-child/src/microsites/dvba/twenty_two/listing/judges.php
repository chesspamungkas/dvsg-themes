<?php
    $pageID = get_queried_object()->ID;
?>    
<a name="judges"></a>
<div class="container-fluid" id="judges-container">
    <div class="row g-0 mx-0">
        <div class="col">
            <div class="container px-3 px-md-5 pb-5">
                <div class="row g-0 mx-0">
                    <div class="col pt-5 pb-3">
                        <h2 class="eb-garamond-regular">Judges</h2>
                    </div>
                </div>
                <div class="row g-0 mx-0">
                    <div class="col" id="judges-slider">
                        <?php
                            foreach( get_field( 'judges', $pageID ) as $judge ):
                                get_template_part( 'src/microsite/dvba/twenty_two/listing/templates/DisplayJudge', null, $judge );
                            endforeach;
                        ?>
                    </div>
                    <div class="slider-dots"></div>
                </div>
            </div>
        </div>
    </div>
</div>