<nav class="navbar fixed-top navbar-expand-lg">
  <a class="navbar-brand" href="<?php echo home_url(); ?>"><img src="<?php echo $dvLogo; ?>" class="dv-logo" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars fa-1x"></i>
    <!--span class="navbar-toggler-icon"></span-->
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mobile-view">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                <svg version="1.1" id="close-btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25 25" style="enable-background:new 0 0 25 25;" xml:space="preserve" class="cursor-pointer close-menu-btn">
                    <g id="Component_10_1" transform="translate(1 1.414)">
                        <g id="Group_1" transform="translate(0 -0.5)">
                            <line id="Line_2" class="st0" x1="4.4" y1="18.7" x2="18.6" y2="4.5"></line>
                            <line id="Line_4" class="st0" x1="4.4" y1="4.5" x2="18.6" y2="18.7"></line>
                        </g>
                    </g>
                </svg>
            </button>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="#intro">Home</a>
        </li>
        <li class="nav-item mobile-view">
            <a class="nav-link" href="<?php echo $voteLink; ?>" target="_blank">Vote</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#giveaway">Giveaway</a>
        </li>
        <li class="nav-item mobile-view">
            <ul class="top-social-icon align-self-center">
                <li class="social-icon mr-4"><a href="<?php echo FB_LINK; ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>
                <li class="social-icon mr-4"><a href="<?php echo IG_LINK; ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a></li>
                <li class="social-icon mr-4"><a href="<?php echo TG_LINK; ?>" target="_blank" rel="noopener noreferrer" title="Follow Us on Telegram"><i class="fab fa-telegram-plane"></i></a></li>
                <li class="social-icon mr-4"><a href="<?php echo TW_LINK; ?>" target="_blank" rel="noopener noreferrer" title="Follow Us on Twitter"><i class="fab fa-twitter"></i></a></li>
                <li class="social-icon"><a href="<?php echo YTB_LINK; ?>" target="_blank" rel="noopener noreferrer" title="Subscribe Our YouTube Channel"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </li>
    </ul>
  </div>
</nav>