<?php

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

use PHPKatas\OverlapTime;

class OverlapTimesTest extends TestCase{
  protected function setUp(): void{
    parent::setUp();
  }
  public function test_overlapping_times(){
    $la_time = [
      Carbon::createFromTime(17, 0,0,'America/Los_Angeles'),
      Carbon::createFromTime(13, 0,0,'America/Los_Angeles')
    ];
    $ny_time = [
      Carbon::createFromTime(13,0,0, 'America/New_York'),
      Carbon::createFromTime(17,0,0, 'America/New_York')
    ];

    $expected = [
      [
        Carbon::createFromTime(13,0,0,'America/Los_Angeles'),
        Carbon::createFromTime(14,0,0, 'America/Los_Angeles')
      ],
      [
        Carbon::createFromTime(16,0,0, 'America/New_York'),
        Carbon::createFromTime(17,0,0, 'America/New_York')
      ]
    ];

    $this->assertTrue(OverlapTime::isOverlapping($la_time, $ny_time));

    $this->assertEquals($expected, OverlapTime::findMatchingTimes($la_time, $ny_time));
  }
  public function test_non_overlapping_times(){
    $la_time = [
      Carbon::createFromTime(17, 0,0,'America/Los_Angeles'),
      Carbon::createFromTime(14, 0,0,'America/Los_Angeles')
    ];
    $ny_time = [
      Carbon::createFromTime(13,0,0, 'America/New_York'),
      Carbon::createFromTime(16,0,0, 'America/New_York')
    ];
    $this->assertFalse(OverlapTime::isOverlapping($la_time, $ny_time));
    $this->assertFalse(OverlapTime::findMatchingTimes($la_time, $ny_time));
  }
  public function test_additional_cases(){
    $tokyo = [
      Carbon::createFromTime(8,0,0, 'Asia/Tokyo'),
      Carbon::createFromTime(16,0,0, 'Asia/Tokyo'),
    ];
    $la = [
      Carbon::createFromTime(9,0,0, 'America/Los_Angeles'),
      Carbon::createFromTime(17,0,0, 'America/Los_Angeles'),
    ];
    $expected = [
      [
        Carbon::createFromTime(8,0,0, 'Asia/Tokyo'),
        Carbon::createFromTime(9,0,0, 'Asia/Tokyo')
      ],
      [
        Carbon::createFromTime(16,0,0, 'America/Los_Angeles'),
        Carbon::createFromTime(17,0,0, 'America/Los_Angeles')]
      ];
      $this->assertTrue(OverlapTime::isOverlapping2($tokyo, $la));
      //$this->assertEquals($expected, OverlapTime::findMatchingTimes($tokyo, $la));
  }
}