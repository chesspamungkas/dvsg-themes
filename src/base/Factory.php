<?php
namespace DV\base;

class Factory {
  public static $_model = null;

  public static function getFactory() {
    if(!self::$_model) {
      $model = get_called_class();
      self::$_model = new $model();
    }
    return self::$_model;
  }
}