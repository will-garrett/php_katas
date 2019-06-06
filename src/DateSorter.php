<?php namespace PHPKatas;


use Carbon\Carbon;


use PHPKatas\Formatters;
/**
 * SortDates
 * @desc - sort array items of a specific field by date
 */
class DateSorter{
  /**
   * orderByDateASC
   * sorts dates in ascending order
   * 
   * @param array $dates
   * @param string $field
   * @return array 
   */
  public static function orderByDateASC(array $dates, string $field = 'datetime'){
    usort($dates, function($one, $two) use ($field){
      $a = strtotime(Formatters::ensureString($one[$field]));
      $b = strtotime(Formatters::ensureString($two[$field]));
      return $a - $b;
    });
    return $dates;
  }
  /**
   * orderByDateDESC
   * sorts dates in descending order
   *
   * @param array $dates
   * @param string $field
   * @return array
   */
  public static function orderByDateDESC(array $dates, string $field = 'datetime'){
    return array_reverse(self::orderByDateASC($dates, $field));
  }


  
}
