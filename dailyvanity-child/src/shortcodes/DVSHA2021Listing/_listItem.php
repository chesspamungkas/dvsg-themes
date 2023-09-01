<div class="card list-item-card py-5">
    <div class="row no-gutters justify-content-center">
        <div class="col-12 col-md-6 card-image">
            <?php echo $thumbnail; ?>
        </div>
        <div class="col-12 col-md-5">
            <div class="card-body">
                <div class="list-item-content-top">
                    <ul class="award-list">
                    <?php
                        foreach( $awards as $award ):
                            echo '<li style="background-color: ' . $bgColor . '; color: ' . $color . ';">' . $award['name'] . '</li>';
                        endforeach;
                    ?>
                    </ul>
                    <h2 class="card-title">
                        <span class="listTitle"><?php echo $name; ?></span>
                    </h2>
                    <div class="list-item-link"><?php echo $category; ?></div>
                </div>
                <div class="list-item-content-bottom">
                    <?php echo apply_filters( 'the_content', $content ); ?>
                    <?php if( $hasPromo ): ?>
                        <p><a href="<?php echo get_field( 'cta_button_link' )?:$url; ?>" title="<?php echo get_field( 'cta_button_text' )?:$name; ?>" target="_blank" class="cta-btn"><?php echo get_field( 'cta_button_text' )?:'Get This Perk Today'; ?></a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="list-item-card-bg"></div>
</div>