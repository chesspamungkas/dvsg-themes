<div class="col-6 pb-3 listItem">
    <div class="card">
        <div class="row no-gutters">
            <div class="col-12 article-image">
                <a href="<?php echo $url; ?>" title="<?php echo $title; ?>" target="_blank">
                    <?php echo $thumbnail; ?>
                </a>  
            </div>
            <div class="col-12 article-content">
                <div class="card-body">
                    <div class="catName poppins-light">
                        <?php echo $this->get_category(); ?>
                    </div>
                    <h2 class="card-title eb-garamond-medium">
                        <a href="<?php echo $url; ?>" target="_blank">
                            <span class="listTitle"><?php echo $title; ?></span>
                        </a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>