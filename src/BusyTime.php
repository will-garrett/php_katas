<?php namespace PHPKatas;


use Carbon\Carbon;
use Carbon\CarbonPeriod;

use PHPKatas\OverlapTime;

class BusyTime{
  /**
   * isOverlapping
   *
   * @param [array] @type Carbon $a
   * @param [array] @type Carbon $b
   * @return boolean
   */
  public static function isOverlapping($a, $b){
    sort($a);
    sort($b); 
    return ($a[1]->greaterThan($b[0]) && $a[0]->lessThan($b[1]));
  }
  public static function getAvailable(array $busy_times, string $host_tz, string $target_tz = 'UTC', Carbon $start_time = null, Carbon $end_time = null){
      // Genreating Defaults
      $start_time = $start_time ?: Carbon::parse('8:00:00', $host_tz);
      $end_time = $end_time ?: Carbon::parse('20:00:00', $host_tz);
      $time_ints = CarbonPeriod::create($start_time, '30 minutes' ,$end_time)->toArray();
      $available_chunks = [];
      
      for($i = 0; $i < count($time_ints)-3; $i++){
        foreach($busy_times as $b_time){
            $does_overlap = self::isOverlapping([$time_ints[$i], $time_ints[$i+2]],[$b_time['start_time'], $b_time['end_time']]);
            if($does_overlap){
              break;
            }
        }
        $block1 = $time_ints[$i];
        $block2 = $time_ints[$i+2];
        if(!$does_overlap){

          $available_chunks[]=['start_time'=>$block1->tz($target_tz), 'end_time'=>$block2->tz($target_tz)];
        }
      }
      foreach($available_chunks as $chunk){
        echo $chunk['start_time']->toISOString()." - ".$chunk['end_time']->toISOString()."\n";
      }
      return $available_chunks;
  }
}