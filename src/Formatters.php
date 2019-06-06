<?php namespace PHPKatas;


use Carbon\Carbon;

class Formatters{
  public static function ensureString($obj){
    return is_a($obj, Carbon::class) ? $obj->setTimezone('UTC')->toDateTimeString() : $obj;
  }
  /**
   * formatToString
   * because I didn't want to rewrite a test that was using this method
   *
   * @param [mixed] $obj
   * @return string
   */
  public static function formatToString($obj){
    return self::ensureString($obj);
  }
}