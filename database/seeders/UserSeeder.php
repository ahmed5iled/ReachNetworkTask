<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ahmed khaled',
            'email' => 'ahmed@task.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
