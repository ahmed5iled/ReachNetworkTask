<?php

namespace Database\Seeders;

use App\Models\Advertiser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategoriesSeeder::class,
            AdvertisersSeeder::class,
            TagsSeeder::class,
            AdsSeeder::class,
            AdTagsSeeder::class,
        ]);
    }
}
