<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  App\Models\User;
use App\Models\Formation;
use App\Models\Episode;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         \App\Models\Formation::factory(15)->create();
         \App\Models\Episode::factory(150)->create();


    }
}
