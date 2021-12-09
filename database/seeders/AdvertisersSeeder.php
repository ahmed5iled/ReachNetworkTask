<?php

namespace Database\Seeders;

use App\Models\Advertiser;
use Illuminate\Database\Seeder;

class AdvertisersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $advertisers = [
            ['name' => 'Ahmed Khaled', 'email' => 'ahmedkhaledmedica@gmail.com'],
            ['name' => 'Amr', 'email' => 'aaaahmed91@gmail.com'],
            ['name' => 'Mohamed', 'email' => 'tottibebo50@gmail.com'],
        ];

        Advertiser::insert($advertisers);
    }
}
