<?php

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

use PHPKatas\BusyTime;

class BusyTimesTest extends TestCase{
  public function test_for_available_times(){
    $this->assertTrue(true);
    $busy_times = [
      [
        'start_time'=>Carbon::parse('08:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('09:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('11:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('12:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('15:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('16:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('19:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('20:00:00', 'America/Los_Angeles')
      ]
    ];
    $simplified_expect = [
      [
        'start_time'=>Carbon::parse('9:30:00', 'America/Los_Angeles')->setTimezone('UTC'),
        'end_time'=>Carbon::parse('11:00:00', 'America/Los_Angeles')->setTimezone('UTC')
      ],
      [
        'start_time'=>Carbon::parse('12:00:00', 'America/Los_Angeles')->setTimezone('UTC'),
        'end_time'=>Carbon::parse('15:00:00', 'America/Los_Angeles')->setTimezone('UTC')
      ],
      [
        'start_time'=>Carbon::parse('16:00:00', 'America/Los_Angeles')->setTimezone('UTC'),
        'end_time'=>Carbon::parse('19:00:00', 'America/Los_Angeles')->setTimezone('UTC')
      ]
    ];
    var_dump(BusyTime::getAvailable($busy_times, 'America/Los_Angeles'));
    //$this->assertEquals($expect, BusyTime::getAvailable($busy_times, 'UTC'));
  }
}