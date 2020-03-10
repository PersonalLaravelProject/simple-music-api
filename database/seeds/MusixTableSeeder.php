<?php

use Illuminate\Database\Seeder;

class MusixTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     factory(App\Music::class, 7)->create();      
    }
}
