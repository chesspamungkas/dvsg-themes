<?php

namespace DV\base;

abstract class Factory
{
  public static $_model = array();
  protected function __construct()
  {
  }

  final public static function getInstance()
  {
    return self::getFactory();
  }

  final public static function getFactory()
  {
    $calledClass = get_called_class();
    if (!isset(self::$_model[$calledClass])) {
      self::$_model[$calledClass] = new $calledClass();
    }
    return self::$_model[$calledClass];
  }

  final private function __clone()
  {
  }
}
