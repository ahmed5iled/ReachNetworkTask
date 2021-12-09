<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            ['title' => 'title 1', 'description' => 'description 1', 'category_id' => 1, 'type' => 'free'
                , 'advertiser_id' => 1, 'start_date' => '2021-12-10'],
            ['title' => 'title 2', 'description' => 'description 2', 'category_id' => 2, 'type' => 'paid'
                , 'advertiser_id' => 1, 'start_date' => '2021-12-10'],
            ['title' => 'title 3', 'description' => 'description 3', 'category_id' => 3, 'type' => 'free'
                , 'advertiser_id' => 2, 'start_date' => '2021-12-10'],
            ['title' => 'title 4', 'description' => 'description 4', 'category_id' => 4, 'type' => 'paid'
                , 'advertiser_id' => 2, 'start_date' => '2021-12-10'],
            ['title' => 'title 5', 'description' => 'description 5', 'category_id' => 5, 'type' => 'free'
                , 'advertiser_id' => 3, 'start_date' => '2021-12-10'],
            ['title' => 'title 6', 'description' => 'description 6', 'category_id' => 6, 'type' => 'paid'
                , 'advertiser_id' => 3, 'start_date' => '2021-12-10'],
        ];

        Ad::insert($ads);
    }
}
