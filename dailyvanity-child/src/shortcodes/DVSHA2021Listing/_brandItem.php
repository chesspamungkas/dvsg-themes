<div class="card">
    <img src="<?php echo $image; ?>" class="card-img-top" alt="<?php echo $name; ?>">
    <div class="card-body">
        <h5 class="card-title"><?php echo $name; ?></h5>
        <?php echo apply_filters( 'the_content', $desc ); ?>
    </div>
</div>