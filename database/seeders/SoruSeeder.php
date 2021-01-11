<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SoruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Soru::factory(100)->create();
    }
}
