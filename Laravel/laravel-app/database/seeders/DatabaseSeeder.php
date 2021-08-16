<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Course;
use App\Models\Video;
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
         User::factory(5)->create();
         Course::factory(15) -> create();
         Video::factory(100)->create();
    }
}
