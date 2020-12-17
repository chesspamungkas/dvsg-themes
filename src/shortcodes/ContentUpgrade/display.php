<?php 
// global $post;
// print_r( $args );
// print_r( $keyword );
?>
<style>
  .content-upgrade-container {
    background-color: #fde2ea;
  }

  .content-upgrade-container > .row > .col {
    padding: 40px 40px 60px 40px;
  }

  #contentUpgradeForm > input[type='text'], #contentUpgradeForm > input[type='email'] {
    width:100%;
    border-radius: 30px;
    padding: 25px;
    margin-left: auto;
    margin-right: auto;
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 300;
    text-transform: uppercase;
    letter-spacing: .15rem;
    border:0;
  }

  #contentUpgradeForm > input[type='text'] {
    margin-bottom: 15px;
  }

  #contentUpgradeForm > input[type='email'] {
    margin-bottom: 25px;
  }

  #contentUpgradeForm > .form-check {
    justify-content: center;
  }

  #contentUpgradeForm > .form-check > input[type="radio"] {
    opacity: 0;
    position: fixed;
    width: 0;
  }

  #contentUpgradeForm > .form-check > label {
    width: 210px;
    display: inline-block;
    padding: 15px 50px;
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .15rem;
    border: 0;
    border-radius: 30px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
  }

  #contentUpgradeForm > .male-radio > label {
    background-color: #000;
    color: #fff;
  }

  #contentUpgradeForm > .female-radio > label {
    background-color: #ea4a7f;
    color: #fff;
  }

  #contentUpgradeForm > .male-radio > label:hover, #contentUpgradeForm > .female-radio > label:hover {
    background-color: #626262;
    color: #fff;
  }

  #contentUpgradeForm > .female-radio {
    float: right;
    margin-right:0;
  }

  .content-upgrade-container > .row > .col > .container > .row > .col-md-8 > p {
    text-align: center;
  }

  .content-upgrade-container > .row > .col > .container > .row > .col-md-8 > p.content-upgrade-title {
    font-size: 48px;
    margin-bottom: .5rem;
    line-height: 1.2; x
  }

  .content-upgrade-container > .row > .col > .container > .row > .col-md-8 > p:not(.content-upgrade-title) {
    font-size: 20px;
    margin-bottom: 1.5rem;
  }

  @media (max-width: 480px) {
    #contentUpgradeForm > .form-check > label {
      padding: 15px 40px;
    }
  }
</style>
<?php if($post): ?>
  <div class="container-fluid content-upgrade-container">
    <div class="row">
      <div class="col">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <?php 
                //print_r( $segment );
                if( $segment ) {
                  $seg = $segment;
                } else {
                  $seg = 'all';
                }

                $args = [
                  'post_type' => 'content_upgrade',
                  'post_status' => 'publish',
                  'posts_per_page' => 1,
                  'orderby' => 'date',
                  'order' => 'DESC',
                  'meta_query' => [
                    'relation' => 'AND',
                    [
                      'key' => 'segment',
                      'value' => $seg
                    ],
                  ]
                ]; 

                $contentUpgrade = new WP_Query( $args );

                // print_r( $contentUpgrade->posts[0]->post_title );
              ?>
              <p class="eb-garamond-medium content-upgrade-title"><?php echo $contentUpgrade->posts[0]->post_title; ?></p>
              <p class="eb-garamond-medium"><?php echo $contentUpgrade->posts[0]->post_content; ?></p>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-5">
              <form method="post" action="<?php echo MAUTIC_LINK; ?>" name="contentUpgradeForm" id="contentUpgradeForm">
                <input class="form-control form-control-sm" type="text" placeholder="YOUR NAME" aria-label=".form-control-sm example">
                <input class="form-control form-control-sm" type="email" placeholder="EMAIL ADDRESS" aria-label=".form-control-sm example">
                <div class="form-check form-check-inline male-radio">
                  <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male">
                  <label class="form-check-label" for="maleRadio">For Men</label>
                </div>
                <div class="form-check form-check-inline female-radio">
                  <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female">
                  <label class="form-check-label" for="femaleRadio">For Women</label>
                </div>
              </form>
            </div>
          </div>  
        </div>
      </div>
    </div>  
</div>
<?php endif; ?>