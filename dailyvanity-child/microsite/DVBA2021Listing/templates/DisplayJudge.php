<?php
    global $judge;
?>
<div class="card judge-profile">
    <div class="row g-0 m-0">
        <div class="col-md-9 pe-md-5">
            <div class="card-body p-0 judge-profile-body">
                <h5 class="card-title poppins-bold"><?php echo $judge['judge_name']; ?></h5>
                <?php echo str_replace( '<p>', '<p class="card-text">', apply_filters( 'the_content', $judge['judge_profile'] ) ); ?>
            </div>
        </div>
        <div class="col-md-3 py-4 py-md-0">
            <div class="judge-photo mx-auto" style="background-image: url( '<?php echo $judge['judge_photo']['url']; ?>' );"><!--img src="<?php echo $judge['judge_photo']['url']; ?>" alt="<?php echo $judge['judge_name']; ?>"--></div>
        </div>
    </div>
</div>