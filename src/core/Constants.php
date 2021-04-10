<?php
namespace DV\core;

class Constants {

  public static function Define($key, $value) {
    if(!defined($key)) {
        define($key, $value);
    }
  }
}