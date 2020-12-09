<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0;$i < 20;$i++){
            DB::table('plans')->insert([
                'title' => 'title'.$i,
                'description' => 'description'.$i,
                'start_day' => '2020-1-1',
                'end_day' => '2020-1-1',
                'image_url' => 'image_url',
                'cost' => 10000,
                'is_open' => TRUE,
                'user_id' => 1,
                'favorite_count' => rand(1000000,1000000000),
                'number_of_views' => rand(1,1000),
                'referenced_number' => rand(1000,1000000),
            ]);
        }
    }

    // // 特定の2つの日付の例
    // $start = Carbon::create("2015", "1", "1");
    // $end = Carbon::create("2020", "12", "31");

    // function randomDate($start_date, $end_date)
    // {
    //     // Convert to timetamps
    //     $min = strtotime($start_date);
    //     $max = strtotime($end_date);

    //     // Generate random number using above bounds
    //     $val = rand($min, $max);

    //     // Convert back to desired date format
    //     return date('Y-m-d H:i:s', $val);
    // }
}
