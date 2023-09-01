<?php 

namespace DVChild\components;

class NovalyMedia {
  static function init() {
    $self = new NovalyMedia();
    add_action('single_before_footer', [$self, 'novaly_ads_action'], 20);
  }

  public function novaly_ads_action() {
    global $post;

    if( is_single() && ( $post->post_type === "post" || $post->post_type === "deal" ) ) {
      echo "<div id='novaly_media_ads_wordpress'></div>";
    }
  }
}