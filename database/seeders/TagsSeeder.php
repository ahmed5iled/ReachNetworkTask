<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'tag 1'],
            ['name' => 'tag 2'],
            ['name' => 'tag 3'],
            ['name' => 'tag 4'],
            ['name' => 'tag 5'],
            ['name' => 'tag 6'],
        ];
        Tag::insert($tags);
    }
}
