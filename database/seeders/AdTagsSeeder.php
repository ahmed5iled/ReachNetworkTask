<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['ad_id' => 1, 'tag_id' => 1],
            ['ad_id' => 2, 'tag_id' => 2],
            ['ad_id' => 3, 'tag_id' => 3],
            ['ad_id' => 4, 'tag_id' => 4],
            ['ad_id' => 5, 'tag_id' => 5],
        ];

        DB::table('ad_tags')->insert($tags);
    }
}
