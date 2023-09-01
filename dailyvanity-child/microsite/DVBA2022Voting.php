<?php
    // Template Name: DVBA 2022 Voting Template

    include_once( __DIR__ . '/DVBA/2022/Voting/header.php' );

    $pageID = get_queried_object()->ID;
    $votenowLink = get_field('voting_link',$pageID);
    
    echo do_shortcode( '[dvba-2022-top-bar vote_link="' . $votenowLink . '"]' );
    ?>
    <div class="fluid-container bgRainbow" id="intro">
        <div class="container">
            <div class="votingLogo">
                <img src="<?php echo bloginfo('url')?>/wp-content/themes/dailyvanity-child/microsite/DVBA/2022/Voting/images/dvba_logo.svg" alt=""> 
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="container">
        <div class="contentIntro">
            <div class="row">
                <div class="col-md-12">
                    <?php  
                        while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                     
                        if ($votenowLink){
                            echo '<a href="'.$votenowLink.'" class="gradient-button gradient-button-1" target="_blank">VOTE NOW</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="fluid-container bgRainbow2" id="giveaway">
        <div class="container">
            <div class="contentGiveaway">
                <?php 
                    $giveawayContent = get_field('giveaway_content', $pageID);
                    if ($giveawayContent) {
                        echo $giveawayContent;
                    } 
               
                     $votenowLink = get_field('voting_link',$pageID);
                     if ($votenowLink){
                         echo '<a href="'.$votenowLink.'" class="gradient-button gradient-button-1" target="_blank">VOTE NOW</a>';
                     }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php
    
    echo do_shortcode( '[dvba-2022-footer-bar]' );

    include_once(__DIR__ . '/DVBA/2022/Voting/footer.php');
?>