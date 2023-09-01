<?php

$voteText = get_field( 'voting_text', $pageID );
$voteBtnText = get_field( 'voting_btn_text', $pageID );
$voteBtnlink = get_field( 'voting_btn_link', $pageID );

?>
<div class="container-fluid p-0 m-0" id="vote">
    <div class="row p-0 m-0">
        <div class="col text-center">
            <?php echo apply_filters( 'the_content', $voteText ); ?>
            <a href="<?php echo $voteBtnlink; ?>" class="vote-btn" target="_blank"><?php echo $voteBtnText; ?></a>
        </div>
    </div>
</div>