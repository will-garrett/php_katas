<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use Carbon\Carbon;

use PHPKatas\DateSorter;
use PHPKatas\Formatters;

final class SortDateTest extends TestCase{

  public function test_can_be_instanced(){
    $this->assertInstanceOf(DateSorter::class, new DateSorter());
  }
  public function test_can_sort_multi_dim_array(){
    $dates_to_sort = [
      ['id'=>1,'datetime'=>'2019-02-22 11:29:45'],
      ['id'=>2,'datetime'=>'2019-02-13 11:29:45'],
      ['id'=>3,'datetime'=>'2019-02-15 12:30:00'],
      ['id'=>4,'datetime'=>'1984-02-01 13:45:00']
    ];
    $expected_order = [
      4,2,3,1
    ];
    $result = DateSorter::orderByDateASC($dates_to_sort);
    foreach($expected_order as $key=>$item){
      //echo "KEY: ".$key." Val".$item;
      $this->assertArrayHasKey('id',$result[$key], 'Contains an key `id`');
      $this->assertEquals($item, $result[$key]['id'], '$result['.$key.'][\'id\'] does not equal: '.$item);
    }
    $expected_order = array_reverse($expected_order);

    $result = DateSorter::orderByDateDESC($dates_to_sort);
    foreach($expected_order as $key=>$item){
      $this->assertArrayHasKey('id',$result[$key], 'Result does not have key of `id`');
      $this->assertEquals($item, $result[$key]['id'], '$result['.$key.'][\'id\'] does not equal: '.$item);
    }
  }
  public function test_can_use_alternate_time_fieldname(){
    $dates_to_sort = [
      ['id'=>1,'time'=>'2019-02-22 11:29:45', 'datetime'=>'2019-02-01 00:29:45'],
      ['id'=>2,'time'=>'2019-02-13 11:29:45', 'datetime'=>'2019-02-11 00:29:45'],
      ['id'=>3,'time'=>'2019-02-15 12:30:00', 'datetime'=>'2019-02-13 00:30:00'],
      ['id'=>4,'time'=>'1984-02-01 13:45:00', 'datetime'=>'2019-02-13 00:45:05']
    ];
    $expected_order = [1,2,3,4];
    $alt_expected_order = [
      4,2,3,1
    ];
    
    $result = DateSorter::orderByDateASC($dates_to_sort);
    foreach($expected_order as $key=>$item){
      $this->assertArrayHasKey('id',$result[$key], 'Result does not have key of `id`');
      $this->assertEquals($item, $result[$key]['id'], '$result['.$key.'][\'id\'] does not equal: '.$item);
    }
    $result = DateSorter::orderByDateASC($dates_to_sort, 'time');
    foreach($alt_expected_order as $key=>$item){
      $this->assertArrayHasKey('id',$result[$key], 'Result does not have key of `id`');
      $this->assertEquals($item, $result[$key]['id'], '$result['.$key.'][\'id\'] does not equal: '.$item);
    }
  }


  public function test_can_format_to_string(){

    $a_carbon = Formatters::formatToString(Carbon::parse('1984-02-01 13:45:00'));
    $this->assertIsString($a_carbon);
    $b_string = Formatters::formatToString('1984-02-01 13:45:00');
    $this->assertIsString($b_string);
    $this->assertEquals($b_string, $a_carbon);
  
  }

  public function test_can_order_by_carbons(){
    $dates_to_sort = [
      ['id'=>1,'datetime'=>Carbon::parse('2019-02-22 11:29:45')],
      ['id'=>2,'datetime'=>Carbon::parse('2019-02-13 11:29:45')],
      ['id'=>3,'datetime'=>Carbon::parse('2019-02-15 12:30:00')],
      ['id'=>4,'datetime'=>Carbon::parse('1984-02-01 13:45:00')]
    ];
    foreach($dates_to_sort as $items){
      $this->assertInstanceOf(Carbon::class, $items['datetime']);
    }
    $expected_order = [
      4,2,3,1
    ];

    $result = DateSorter::orderByDateASC($dates_to_sort);

    foreach($expected_order as $key=>$item){
      $this->assertArrayHasKey('id',$result[$key], 'Result does not have key of `id`');
      $this->assertEquals($item, $result[$key]['id'], '$result['.$key.'][\'id\'] does not equal: '.$item);
    }
    $expected_order = array_reverse($expected_order);
    $result = DateSorter::orderByDateDESC($dates_to_sort);
    foreach($expected_order as $key=>$item){
      $this->assertArrayHasKey('id',$result[$key], 'Result does not have key of `id`');
      $this->assertEquals($item, $result[$key]['id'], '$result['.$key.'][\'id\'] does not equal: '.$item);
    }
  }
  public function test_can_sort_times_by_carbon_zones(){
    $to_sort = [
      ['id'=>1, 'name'=>'Hawaii', 'datetime'=>new Carbon('1984-02-01 13:45:00', 'Pacific/Honolulu')],
      ['id'=>2, 'name'=>'Japan', 'datetime'=>new Carbon('1984-02-01 13:45:00', 'Asia/Tokyo')],
      ['id'=>3, 'name'=>'LA', 'datetime'=>new Carbon('1984-02-01 13:45:00', 'America/Los_Angeles')],
      ['id'=>4, 'name'=>'NYC', 'datetime'=>new Carbon('1984-02-01 13:45:00', 'America/New_York')],
      ['id'=>5, 'name'=>'CHI', 'datetime'=>new Carbon('1984-02-01 13:45:00', 'America/Chicago')]
    ];
    $expected_order = [2,4,5,3,1];
    $result = DateSorter::orderByDateASC($to_sort);
    
    foreach($expected_order as $key=>$item){
      $this->assertArrayHasKey('id',$result[$key], 'Result does not have key of `id`');
      $this->assertEquals($item, $result[$key]['id'], '$result['.$key.'][\'id\'] does not equal: '.$item);
    }
    $expected_order = array_reverse($expected_order);
    $result = DateSorter::orderByDateDESC($to_sort);


    foreach($expected_order as $key=>$item){
      $this->assertArrayHasKey('id',$result[$key], 'Result does not have key of `id`');
      $this->assertEquals($item, $result[$key]['id'], '$result['.$key.'][\'id\'] does not equal: '.$item);
    }
  }

}