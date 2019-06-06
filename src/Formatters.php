<?php namespace PHPKatas;


use Carbon\Carbon;
use Carbon\CarbonImmutable;

class Formatters{
  public static function ensureString($obj){
    if(is_a($obj, Carbon::class) || is_a($obj, CarbonImmutable::class)){
      return $obj->toImmutable()->setTimezone('UTC')->toDateTimeString();
    }
    return $obj;
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