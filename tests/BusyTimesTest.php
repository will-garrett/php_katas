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
    $expect = [
      [
        'start_time'=>Carbon::parse('9:30:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('10:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('10:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('11:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('12:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('13:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('12:30:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('13:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('13:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('14:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('13:30:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('14:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('14:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('15:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('16:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('17:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('16:30:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('17:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('17:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('18:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('17:30:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('18:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('18:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('19:00:00', 'America/Los_Angeles')
      ]
    ];
    $this->assertEquals($expect, BusyTime::getAvailable($busy_times, 'America/Los_Angeles'));
  }
  public function test_additional_available_times(){
    $this->assertTrue(true);
    $busy_times = [
      [
        'start_time'=>Carbon::parse('09:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('10:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('12:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('13:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('15:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('16:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('18:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('19:00:00', 'America/Los_Angeles')
      ]
    ];
    $expect = [
      [
        'start_time'=>Carbon::parse('8:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('9:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('10:30:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('11:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('11:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('12:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('13:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('14:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('13:30:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('14:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('14:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('15:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('16:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('17:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('16:30:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('17:30:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('17:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('18:00:00', 'America/Los_Angeles')
      ],
      [
        'start_time'=>Carbon::parse('19:00:00', 'America/Los_Angeles'),
        'end_time'=>Carbon::parse('20:00:00', 'America/Los_Angeles')
      ]
    ];
    $result = BusyTime::getAvailable($busy_times, 'America/Los_Angeles');
    $this->assertEquals($expect, $result);
  }
}