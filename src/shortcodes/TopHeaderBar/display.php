<style>
  .dv-background {
    position: absolute;
    bottom:50px;
    left:0;
    z-index:-1;
    height: auto;
  }

  .dv-background > img {
    width: 100%;
    height: auto;
  }

  @media (max-width: 480px) {
    .dv-background {
      height: 240px;
    }
  }

  @media (max-width: 414px) {
    .dv-background {
      height: 200px;
    }
  }

  @media (max-width: 375px) {
    .dv-background {
      height: 180px;
    }
  }

  @media (max-width: 320px) {
    .dv-background {
      height: 150px;
    }
  }
</style>
<nav class="navbar navbar-expand-md navbar-light fixed-top" id="main-header-container">
  <div class="container">
    <div class="row no-gutters align-items-center" style="flex-grow: 1;">
      <div class="col">
        <table id="top-header-table">
          <tr>
            <td><i class="fa fa-lg fa-search hover-pink-link grey-link cursor-pointer main-search-btn"></i></td>
            <td><a href="<?php echo home_url(); ?>"><img src="<?php echo TOP_HEADER_LOGO; ?>" id="logo" alt="Beauty Magazine <?php echo COUNTRY; ?> Daily Vanity Logo"></a></td>
            <td>
              <!--i class="fa fa-lg fa-bars hover-pink-link grey-link cursor-pointer main-menu-btn"></i><img src="<?php echo S3_PATH; ?>/wp-content/uploads/svg/beauty-magazine-malaysia-daily-vanity-menu.svg" class="hover-pink-link cursor-pointer main-menu-btn" /-->
              <svg version="1.1" id="menu-btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="25px" y="25px" viewBox="0 0 25 25" style="enable-background:new 0 0 25 25;" xml:space="preserve" class="cursor-pointer main-menu-btn">
                <path class="st0" d="M22.6,5.8H2.4c-0.5,0-0.9-0.4-0.9-0.9v0c0-0.5,0.4-0.9,0.9-0.9h20.2c0.5,0,0.9,0.4,0.9,0.9v0 C23.6,5.4,23.1,5.8,22.6,5.8z"/>
                <path class="st0" d="M22.6,13.3H2.4c-0.5,0-0.9-0.4-0.9-0.9v0c0-0.5,0.4-0.9,0.9-0.9h20.2c0.5,0,0.9,0.4,0.9,0.9v0 C23.6,12.9,23.1,13.3,22.6,13.3z"/>
                <path class="st0" d="M22.6,20.8H2.4c-0.5,0-0.9-0.4-0.9-0.9v0c0-0.5,0.4-0.9,0.9-0.9h20.2c0.5,0,0.9,0.4,0.9,0.9v0 C23.6,20.4,23.1,20.8,22.6,20.8z"/>
              </svg>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</nav>
<div class="container-fluid" id="main-menu-container">
  <div class="row no-gutter">
    <div class="col">
      <div class="container top-button-bar">
        <div class="row no-gutters align-items-center" style="flex-grow: 1;">
            <div class="col">
              <table class="main-menu-header-table">
                <tr>
                  <td><i class="fa fa-lg fa-search hover-pink-link grey-link cursor-pointer main-search-btn"></i></td>
                  <td>&nbsp;</td>
                  <td><!--i class="fa fa-lg fa-times pink-link cursor-pointer main-menu-btn"></i-->
                    <svg version="1.1" id="close-btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25 25" style="enable-background:new 0 0 25 25;" xml:space="preserve" class="cursor-pointer main-menu-btn">
                      <!--style type="text/css">
                        .st0{fill:none;stroke:#E94A7F;stroke-width:2;stroke-linecap:round;}
                        .st1{fill:none;stroke:#E94A7F;stroke-width:2;stroke-linecap:round;stroke-opacity:0;}
                      </style-->
                      <g id="Component_10_1" transform="translate(1 1.414)">
                        <g id="Group_1" transform="translate(0 -0.5)">
                          <line id="Line_2" class="st0" x1="4.4" y1="18.7" x2="18.6" y2="4.5"/>
                          <line id="Line_4" class="st0" x1="4.4" y1="4.5" x2="18.6" y2="18.7"/>
                        </g>
                      </g>
                    </svg>
                  </td>
                </tr>
              </table>
            </div>
            <!--div class="col-6"><i class="fa fa-lg fa-search hover-pink-link grey-link cursor-pointer main-search-btn"></i></div>
            <div class="col-6"><i class="fa fa-lg fa-times pink-link cursor-pointer main-menu-btn"></i></div-->
        </div>
      </div>
      <div class="container" id="menu-wrapper">
        <?php do_action( 'top_header_story_section' ); ?>
        <div class="row no-gutters" style="flex-grow: 1;">
            <?php do_action( 'top_header_menu_column_1' ); ?>
            <?php do_action( 'top_header_menu_column_2' ); ?>
            <?php do_action( 'top_header_menu_column_3' ); ?>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-7 dv-background"><img src="<?php echo S3_PATH; ?>/wp-content/uploads/svg/beauty-magazine-malaysia-daily-vanity-background-logo.svg" /></div>
  </div>
</div>
<div class="container-fluid" id="top-search-container">
  <div class="row no-gutter">
    <div class="col">
      <div class="container top-button-bar">
        <div class="row no-gutters align-items-center" style="flex-grow: 1;">
          <div class="col">
            <table class="main-menu-header-table">
              <tr>
                <td><i class="fa fa-lg fa-search pink-link grey-link"></i></td>
                <td>
                  <?php echo do_shortcode( '[search-bar]' ); ?>
                </td>
                <td><!--i class="fa fa-lg fa-times pink-link cursor-pointer close-search-btn"></i-->
                  <svg version="1.1" id="close-btn-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25 25" style="enable-background:new 0 0 25 25;" xml:space="preserve" class="cursor-pointer close-search-btn">
                      <!--style type="text/css">
                        .st0{fill:none;stroke:#E94A7F;stroke-width:2;stroke-linecap:round;}
                        .st1{fill:none;stroke:#E94A7F;stroke-width:2;stroke-linecap:round;stroke-opacity:0;}
                      </style-->
                      <g id="Component_10_2" transform="translate(1 1.414)">
                        <g id="Group_2" transform="translate(0 -0.5)">
                          <line id="Line_1" class="st0" x1="4.4" y1="18.7" x2="18.6" y2="4.5"/>
                          <line id="Line_3" class="st0" x1="4.4" y1="4.5" x2="18.6" y2="18.7"/>
                        </g>
                      </g>
                    </svg>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <?php echo do_shortcode( '[popular-searches]' ); ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-7 dv-background"><img src="<?php echo S3_PATH; ?>/wp-content/uploads/svg/beauty-magazine-malaysia-daily-vanity-background-logo.svg" /></div>
  </div>
</div>