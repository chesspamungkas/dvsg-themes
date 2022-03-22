<?php
namespace DV\core;

class Constants {

  public static $DV_LINK_FB = "DV_LINK_FB";
  public static $DV_LINK_IG = "DV_LINK_IG";
  public static $DV_LINK_TELEGRAM = "DV_LINK_TELEGRAM";
  public static $DV_LINK_TIKTOK = "DV_LINK_TIKTOK";
  public static $DV_LINK_YOUTUBE = "DV_LINK_YOUTUBE";
  public static $DV_LINK_TWITTER = "DV_LINK_TWITTER";

  public static function getSocialLink($link) {
    return apply_filters($link, get_home_url(''));
  }

  public static function Define($key, $value) {
    if(!defined($key)) {
        define($key, $value);
    }
  }
}