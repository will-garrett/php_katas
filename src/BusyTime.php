<?php namespace PHPKatas;


use Carbon\Carbon;
use Carbon\CarbonPeriod;

class BusyTime{
  public static function getAvailable(array $busy_times, string $host_tz, Carbon $start_time = null, Carbon $end_time = null){
      // Genreating Defaults
      $start_time = $start_time ?: Carbon::parse('8:00:00', $host_tz);
      $end_time = $end_time ?: Carbon::parse('20:00:00', $host_tz);

      $available_times = CarbonPeriod::create($start_time, '30 minutes' ,$end_time)->toArray();
      $busy_intervals = [];
      $add_after = [];
      foreach($busy_times as $key => $slot){
        $busy_intervals = array_merge($busy_intervals, CarbonPeriod::create($slot['start_time'], '30 minutes', $slot['end_time'])->toArray());
      }
      $results = array_diff($available_times, $busy_intervals);
      //$results = array_merge($flat_start_stop, $results);
      sort($results);
      return $results;
  }
}