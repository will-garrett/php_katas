<?php namespace PHPKatas;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
/**
 * OverlapTime
 * given a pair of time ranges find overlapping times between timezones
 */
class OverlapTime{
  public static function isOverlapping($a, $b){
    sort($a);
    sort($b);
    return ($a[1]->greaterThanOrEqualTo($b[0]) && $a[0]->lessThanOrEqualTo($b[1]));
  }
  public static function findMatchingTimes($one, $two){
    sort($one);
    sort($two);
    if(!self::isOverlapping($one, $two)){
      return false;
    }
    $start = $one[0]->max($two[0]);
    $end = $one[1]->min($two[1]);
    return [
      [
        $start->toImmutable()->setTimezone($one[0]->tzName),
        $end->toImmutable()->setTimezone($one[0]->tzName)
      ],
      [
        $start->toImmutable()->setTimezone($two[0]->tzName),
        $end->toImmutable()->setTimezone($two[0]->tzName)
      ]
      ];
  }
}